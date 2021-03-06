<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\GitHub\licai./application/wap\view\member\invite.html";i:1513912059;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>
		<style type="text/css">
			.imgs {
				width: 100%;
				background: #4278A9;
				height: 100vh;
			}

			.qrcode-top {
				position: relative;
				width: 100%;
				background: url(__WAP__/img/invita.jpg) no-repeat center center;
				background-size: cover;
			}

			.qrcode-bottom {
				width: 16rem;
				height: 6.1rem;
				border: 2px dashed #fff;
				position: relative;
				margin: 1.25rem auto 2.25rem auto;
				line-height: 1.2rem;
				color: #fff;
				padding: 0.5rem 0.4rem;
				font-size: 0.9rem;
			}

			.serial_number {
				display: inline-block;
				float: left;
				width: 0.8rem;
				height: 1.5rem;
				text-align: left;
			}

			.yellow {
				color: #fbff00;
			}

			.qrcode-bottom .sheep {
				width: 5rem;
				height: 4.75rem;
				background: url(__WAP__/img/sheep.png)no-repeat center left;
				background-size: cover;
				position: absolute;
				right: -10%;
				top: 4.5rem;
			}

			#share {
				display: block;
				width: 11.25rem;
				height: 2rem;
				line-height: 2rem;
				border-radius: 1rem;
				color: #fff;
				text-align: center;
				font-size: 1rem;
				background: linear-gradient(to right, #f5aa02, #fdce23);
				margin: 1rem auto 0 auto;
			}

			#click_share {
				width: 100%;
				height: 12.25rem;
				position: absolute;
				top: 4rem;
				left: 0;
				z-index: 99999;
				background: url(__WAP__/img/jiantou.png) no-repeat 95% 5%;
				background-size: 5.75rem;
				display: none;
			}

			.shane_box {
				width: 80vw;
				box-sizing: border-box;
				border-radius: 0.4rem;
				opacity: 0.9;
				position: fixed;
				left: 50%;
				margin-left: -40vw;
				top: 4.75rem;
				padding: 1.5rem 1rem 1.5rem 6rem;
				background: url(__WAP__/img/small.png) no-repeat 0.7rem center;
				background-size: 4.5rem;
				background-color: #fff;
			}
			.shane_box p{
				line-height: 1.5rem;
			}
			.m_co1 {
				color: #3db4cc;
				/* display: flex; */
				justify-content: center;
				align-items: flex-end;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="" >
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>我的邀请</h3>
				<a href="<?php echo url('member/invitehb'); ?>">我的回报</a>
			</div>
			<div class="imgs">
				<div class="qrcode-top">
					<div id="click_share">
						<div class="shane_box">
							<p style="font-size: 0.8rem;padding-top: 0">请您点击微信右上角按钮，<b class="m_co1">刷新本页</b>后再发送给朋友或分享到朋友圈哦。</p>
						</div>
					</div>
				</div>
				<div class="qrcode-bottom">
					<div><span class="serial_number">1.</span>推荐好友注册，被邀请人将获得<span class="yellow">一分钱买羊</span>体验资格和<span class="yellow">200元</span>现金红包哦！</div>
					<div><span class="serial_number">2.</span>好友成功购买，您将获得好友购羊交易金额<span class="yellow">0.5%</span>的推广回报。</div>
					<div><span class="serial_number">3.</span>交易推广回报<span class="yellow">不限首次，长期有效</span>。</div>
					<div class="sheep"></div>

				</div>
				<button id="share">朕去邀请好友</button>

			</div>
		</div>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(".qrcode-top").height(($(".qrcode-top").width() / 750 * 574) + "px");
			$("#share").click(function() {
				$("#click_share").css("display", "block");
			})
			$("#click_share .m_co1").click(function() {
				window.location.reload();
			})
		</script>
	</body>

</html>