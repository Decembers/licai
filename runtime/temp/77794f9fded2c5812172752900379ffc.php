<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\shopplog.html";i:1514260017;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<!--<title>牧场超市</title>-->
		<title>趣味农场</title>
		<link rel="stylesheet" type="text/css" href="__WAP__/bootstrap-3.3.7/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css"/>
		<style type="text/css">
			.bgCo {
				background: #f0f0f3;
				padding: 0.5rem;
				width: 100%;
			}

			.no_record {
				width: 12rem;
				height: 14rem;
				margin: 10rem auto 0 auto;
				background: url(__WAP__/img/no_record.png) no-repeat center center;
				background-size: 100%;
			}
			.wrapper ul li {
				background-color: white;
				color: #a9a9a9;
				font-size: 1rem;
				box-sizing: border-box;
				padding: 1rem 2rem;
				margin-top: 1px;
				overflow: hidden;
				border-radius:1rem ;
				margin-top: 0.5rem;
			}

			.wrapper ul li>div>div:nth-child(1) {
				line-height: 2.5rem;
			}
			.wrapper ul li>div>div:nth-child(2) {
				line-height: 1.5rem;
			}
			.wrapper ul li>div>div {
				display: flex;
			}

			.chtx {
				font-size: 1.8rem;
			}

			.fw_right div {
				text-align: right;
				display: flex;
				font-size: 1.3rem;
			}

			.fw_left div:nth-child(2) {
				font-size: 1.3rem;
			}

			.redPackets_0 {
				width: 5rem;
				height: 3.5rem;
				margin-right: 1rem;
				margin-top: 0.5rem;

			}
			.redPackets_0 img{
				width: 100%;
				height: 100%;
			}
			.ri {
				color: black;
			}

			.ri span:nth-child(2) {
				font-size: 2.5rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper" id="shopping_mall">
			<div class="header">
				<div class="" >
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>购物清单</h3>

			</div>
			<div class="invest bgCo" style="display: none;">
				<ul>
					<input type="hidden" id="response_code" value="1">

					<div class="no_record"></div>

				</ul>


			</div>
			<ul>
			<?php if($arr): if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<li>
					<div class="redPackets_0 fl">
					<img src="__WAP__/img/59561844b1f79.jpg"/>
					</div>
					<div class="fw_left fl">
						<div class="chtx a1"><?php echo $vo['name']; ?></div>
						<div class="exlimit">
							<span class="name"><?php echo $vo['number']; ?></span> </div>
					</div>
					<div class="fw_right fr">
						<div class="ri"><span>￥</span><span><?php echo $vo['order_price']; ?></span></div>
						<div>数量：<?php echo $vo['sp_count']; ?>个</div>
					</div>
				</li>
			<?php endforeach; endif; else: echo "" ;endif; else: ?>
				<div class="no_record"></div>
			<?php endif; ?>
			</ul>
		</div>
		<div class="background"></div>
		<p class="overtop"></p>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
	</body>

</html>