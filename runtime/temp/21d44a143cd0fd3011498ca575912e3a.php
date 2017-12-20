<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\GitHub\licai./application/wap\view\order\infolist.html";i:1513738245;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title style="width: 100%; text-align: center;">趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			@media screen and (max-width: 900px) {
				body {
					background-color: rgb(240, 240, 243);
				}
				.wrapper {
					background-color: rgb(240, 240, 243);
				}
			}
			@font-face {
				font-family: 'FontAwesome'
			}
			@media screen and (min-width: 900px) {
				.wrapper {
					background-color: rgba(255, 255, 255, 0.01);
				}
			}

			.bgCo {
				background: #f0f0f3;
				padding: 0.5rem;
			}

			.holds {
				height: 7.4rem;
				width: 100%;
				background: url(__WAP__/img/holds.jpg);
				 filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')";
			   -moz-background-size:100% 100%;
			   background-size:100% 100%;
				background-size: cover;
				color: #3db4cc;
				text-align: center;
				margin-bottom: 0.5rem;
				border: 1px solid #ededed;
				border-radius: 0.4rem;
			}



			.holds h5 {
				color: #3db4cc;
				padding: 0;
				margin: 0;
				font-size: 3.1rem;
				line-height: 3.5rem;
				margin-top: 1rem;
			}

			.this_period {
				font-size: 0.7rem;
			}

			.come_on {
				font-size: 0.9rem;
			}

			.trade_detail_list li:nth-child(1) {
				background: #189e71;
			}

			.trade_detail_list li {
				height: 2.75rem;
				line-height: 2.7rem;
				font-size: 0.85rem;
				color: #fff;
				background: #75d9aa;
				border-radius: 0.4rem;
				margin-bottom: 0.3rem;
				padding: 0 0.3rem;
				overflow: hidden;
			}

			.fl {
				float: left;
			}

			.fr {
				float: right;
			}

			.userName {
				width: 6rem;
			}

			.avatar {
				width: 1.8rem;
				height: 1.8rem;
				border-radius: 50%;
				margin-top: 0.45rem;
				margin-right: 0.25rem;
				border: 1px solid #fff;
				background: #f9f9f9;
				overflow: hidden;
			}

			.avatar img {
				width: 100%;
				height: 100%;
			}

			.trade_detail_list li:nth-child(1) .use_nam {
				padding-top: 0.45rem;
				background: url(__WAP__/img/king.png) no-repeat left 0.5rem;
				background-size: 1rem;
			}

			.buy_sheep_num {
				width: 15%;
				height: 100%;
				padding-left: 1.25rem;
				background: url(__WAP__/img/iconlist_04.png) no-repeat left 86%;
				background-size: 2.5rem;
			}

			.trade_detail_list li:nth-child(2) {
				background: #3cb287;
			}
		</style>

	</head>

	<body>
		<div class="background"></div>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon" onClick="javascript :history.back(-1);"></span><span>返回</span>
				</div>
				<h3>交易详情</h3>
				<a href="####" style="opacity: 0;">交易统计</a>
			</div>

			<div class="content bgCo native-scroll">
				<!-- 这里是页面内容区 -->

				<div class="fillet holds">
					<h5>9</h5>
					<p class="this_period">本期牧主（位）</p>
					<p class="come_on">欢迎各位牧主大大继续购买哦∩_∩</p>
				</div>
				<div class="trade_detail_list">
					<ul>
					<?php if($status['status'] == 1): if(is_array($row) || $row instanceof \think\Collection || $row instanceof \think\Paginator): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li>
							<div class="userName fl">
								<div class="avatar fl">
									<img src="__WAP__/img/touxiang.png">
								</div>
								<div class="use_nam fl"><?php echo $vo['name']; ?></div>
							</div>
							<div class="buy_sheep_num fl">&Chi;<?php echo $vo['sp_count']; ?></div>
							<div class="fr"><?php echo date("y-m-d h:i:s",$vo['create_time']); ?></div>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; else: ?>
						<li>
							<div>
								暂无信息
							</div>
						</li>
					<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(".fillet h5").text($(".trade_detail_list ul li").length);


		</script>
	</body>

</html>