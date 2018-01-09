<?php
/**
 * @Author: Marte
 * @Date:   2018-01-08 15:06:15
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-09 17:07:08
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Request;
use think\Db;
use think\Loader;
use think\Session;
use think\Cookie;
use app\common\model\User;
use app\common\model\Detail;


class Wxpay extends Yang
{
    /**
     * 支付
     * @return [type] [description]
     */
    public function getinfo(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            if ($_POST['money']=='') {
                echo '请求数据都不能为空';
                return;
            }
            //生成订单
            $str = $this->generate_password();//随机字符串
            $order_id = time().$str;
            $money = $_POST['money'];
            $name = '微信充值';

            $row['order_id']= $order_id;
            $row['user_id']=Session::get('user.id');
            $row['or']=1;
            $row['money']=$money;
            $row['comment']= $name;
            $row['create_time']=time();

            $result = Detail::insert($row);
            if (isset($result)) {

                Loader::import('Weixinpay.WxPayPubHelper', EXTEND_PATH);
                //使用jsapi接口
                 $jsApi = new \JsApi_pub();
                //openid 登录时自动获取
                $openid = Session::get('user.openid');
                //=========步骤2：使用统一支付接口，获取prepay_id(预支付id)============
                //使用统一支付接口
                $unifiedOrder = new \UnifiedOrder_pub();
                /*此处做数据库的查询  这里操作数据库把产品信息显示出来*/
                //设置统一支付接口参数
                //设置必填参数
                //appid已填,商户无需重复填写
                //mch_id已填,商户无需重复填写
                //noncestr已填,商户无需重复填写
                //spbill_create_ip已填,商户无需重复填写
                //sign已填,商户无需重复填写
                $NOTIFY_URL=URLL.url('wxpay/weixinjsapnotify');
                $unifiedOrder->setParameter("openid",$openid);//openid
                $unifiedOrder->setParameter("body",'充值');//商品描述
                $unifiedOrder->setParameter("out_trade_no",$order_id);//商户订单号
                $unifiedOrder->setParameter("total_fee",$money);//总金额
                $unifiedOrder->setParameter("notify_url",$NOTIFY_URL);//通知地址
                $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
                //非必填参数，商户可根据实际情况选填
                $prepay_id = $unifiedOrder->getPrepayId();
                //=========步骤3：使用jsapi调起支付============
                $jsApi->setPrepayId($prepay_id);
                $jsApiParameters = $jsApi->getParameters();
                    return $jsApiParameters;
                }else{
                    echo '订单生成失败，请返回重试';
                }
            }
        }

    /**
     * 微信jsapi 异步请求地址
     * @return [type] [description]
     */
    public function weixinjsapnotify() {
        $name = 'wxlog/log.txt';
        //使用通用通知接口
        Loader::import('Weixinpay.WxPayPubHelper', EXTEND_PATH);
        $notify = new \Notify_pub();

        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);
        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败了啊");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        //数组转换成xml
        $returnXml = $notify->returnXml();
        echo $returnXml;
        //=====商户根据实际情况设置相应的处理流程，此处仅作举例=======
        if($notify->checkSign() == TRUE){
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                file_put_contents($name,'ERROR == 【通信出错】'.date('Y-m-d H:i:s',time()).'-'.$xml.PHP_EOL,FILE_APPEND);
                return "fail";
            }elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                file_put_contents($name,'ERROR == 【业务出错】'.date('Y-m-d H:i:s',time()).'-'.$xml.PHP_EOL,FILE_APPEND);
                return "fail";
            }else{
                /*支付成功*/
                $out_trade_no=$notify->data["out_trade_no"];//订单号
                $total_fee=$notify->data['total_fee'];//订单总金额，单位为分，详见支付金额
                $openid=$notify->data['openid'];//订单总金额，单位为分，详见支付金额
                /*更新订单状态这里写数据库的操作*/
                $info = Detail::where(['order_id'=>$out_trade_no])->find();
                if($info['status'] == 1){
                    //已经修改订单状态
                    return true;
                }else{
                    Db::startTrans();
                    try{
                        //修改数据库 增加余额 修改状态
                        Detail::where(['order_id'=>$out_trade_no])->update(['status'=>1]);
                        $user = User::where(['openid'=>$openid])->find();
                        $balance = $user['balance'] + $total_fee;
                        User::where(['openid'=>$openid])->update(['balance'=>$balance]);
                        // 提交事务
                        Db::commit();
                    } catch (\think\Exception $e) {
                        // 回滚事务
                        Db::rollback();
                        return "fail";
                    }
                    return "fail";
                }
            }
        }
    }

    /**
     * 随机字符串
     * @return [type] [description]
     */
    public function generate_password( $length = 6 ) {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
        }
}
