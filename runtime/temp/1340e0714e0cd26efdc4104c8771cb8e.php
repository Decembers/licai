<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"E:\GitHub\licai./application/wap\view\index\index.html";i:1514270169;}*/ ?>
<!DOCTYPE html>

<html>



	<head>

		<meta charset="utf-8" />

		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">

		<!--<title>首页</title>-->

		<title>趣味农场</title>

		<link rel="stylesheet" type="text/css" href="__WAP__/bootstrap-3.3.7/dist/css/bootstrap.min.css" />

		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />

		<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />

		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />

		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />

		<script src="__WAP__/js/jQuery v2.1.1.js"></script>

		<script src="__WAP__/bootstrap-3.3.7/dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>



		<style type="text/css">

			body,

			div,

			ul,

			li,

			p,

			a,

			span,

			i {

				margin: 0;

				padding: 0;

				display: block;

			}

			/*移动端 长按下滑 	未实现*/

			/*.pull-to-refresh-layer {

				position: relative;

				left: 0;

				top: 0;

				width: 100%;

				height: 2.2rem;

			}



			.pull-to-refresh-content:not(.refreshing) .pull-to-refresh-layer .preloader {

				-webkit-animation: none;

				animation: none;

			}



			.pull-to-refresh-layer .preloader {

				position: absolute;

				left: 50%;

				top: 50%;

				margin-left: -.5rem;

				margin-top: -.5rem;

				visibility: hidden;

			}



			.preloader {

				display: inline-block;

				width: 1rem;

				height: 1rem;

				-webkit-transform-origin: 50%;

				transform-origin: 50%;

				-webkit-animation: preloader-spin 1s steps(12, end) infinite;

				animation: preloader-spin 1s steps(12, end) infinite;

			}



			.preloader:after {

				display: block;

				content: "";

				width: 100%;

				height: 100%;

				background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20viewBox%3D'0%200%20120%20120'%20x…%3D'.85'%20transform%3D'rotate(330%2060%2C60)'%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E);

 				background-position: 50%;

				background-size: 100%;

				background-repeat: no-repeat;

			}



			.pull-to-refresh-layer .pull-to-refresh-arrow {

				width: .65rem;

				height: 1rem;

				position: absolute;

				left: 50%;

				top: 50%;

				margin-left: -.15rem;

				margin-top: -.5rem;

				background: no-repeat center;

				background-image: url(data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D'http%3A%2F%2Fwww.w3.org%…C22%2026%2C22%2013.5%2C40%200%2C22'%20fill%3D'%238c8c8c'%2F%3E%3C%2Fsvg%3E);

				background-size: .65rem 1rem;

				z-index: 10;

				-webkit-transform: rotate(0) translate3d(0, 0, 0);

				transform: rotate(0) translate3d(0, 0, 0);

				-webkit-transition-duration: .3s;

				transition-duration: .3s;

			}*/

		</style>

	</head>



	<body>



		<div class="wrapper" style="padding-bottom: 1px;">

			<!--移动端 长按下滑-->

			<!--<div class="pull-to-refresh-layer">

    <div class="preloader"></div>

    <div class="pull-to-refresh-arrow"></div>

</div>-->

			<div id="myCarousel" class="carousel slide">

				<!-- 轮播（Carousel）指标     引用bootstrap -->

				<ol class="carousel-indicators">

					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>

					<li data-target="#myCarousel" data-slide-to="1"></li>

					<li data-target="#myCarousel" data-slide-to="2"></li>

				</ol>

				<!-- 轮播（Carousel）项目 -->

				<div class="carousel-inner">

					<div class="item active">

						<img src="__WAP__/img/banner1.jpg" alt="First slide">

						<div class="carousel-caption"></div>

					</div>

					<div class="item">

						<img src="__WAP__/img/banner2.jpg" alt="Second slide">

						<div class="carousel-caption"></div>

					</div>

					<div class="item">

						<img src="__WAP__/img/banner3.jpg" alt="Third slide">

						<div class="carousel-caption"></div>

					</div>

				</div>

				<!-- 轮播（Carousel）导航 -->

				<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;

				</a>

				<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;

				</a>

			</div>



			<div class="navigation">

				<!--nav 导航-->

				<div class="nav">

					<div class="nav1">

						<div class="navs">

							<a href="index1-navs1.html" class="icon0"><span class="icon1"></span></a>

							<a href="index1-navs1.html">新手指导</a>

						</div>

						<div class="navs">

							<a href="<?php echo url('Index/orlist'); ?>" class="icon0"><span class="icon2"></span></a>

							<a href="<?php echo url('Index/orlist'); ?>">购买羊只</a>

						</div>

						<div class="navs">

							<a href="index1-navs3.html" class="icon0"><span class="icon3"></span></a>

							<a href="index1-navs3.html">我的牧场</a>

						</div>

					</div>

					<div class="nav1" style="margin: 0;">

						<div class="navs">

							<a href="index1-navs4.html" class="icon0"><span class="icon4"></span></a>

							<a href="index1-navs4.html">官方公告</a>

						</div>

						<div class="navs">

							<a href="index1-navs5.html" class="icon0"><span class="icon5"></span></a>

							<a href="index1-navs5.html">牧场视频</a>

						</div>

						<div class="navs">

							<a href="index1-navs6.html" class="icon0"><span class="icon6"></span></a>

							<a href="index1-navs6.html">安全保障</a>

						</div>

					</div>

				</div>

			</div>

			<div class="shop">



			<?php if(is_array($row) || $row instanceof \think\Collection || $row instanceof \think\Paginator): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['classify'] == 1): ?>

				<!--常规羊群-->

				<a href="<?php echo url('Order/info',['id'=>$vo['id']]);; ?>" class="shop1">

					<div class="shops_top">

						<p>常规</p>

						<p><?php echo $vo['name']; ?></p>

						<p>剩余:<?php echo $vo['number']; ?></p>

						<i class="clear"></i>

					</div>

					<div class="shops_cen">

						<div class="">

							<h2><?php echo $vo['price']; ?><em>元</em></h2>

							<p>羊单价</p>

						</div>

						<div class="">

							<h2><?php echo $vo['numbers']; ?><em>只</em></h2>

							<p>羊数量</p>

						</div>

						<div class="">

							<h2><?php echo $vo['rate']; ?><em>天</em></h2>

							<p>联养周期</p>

						</div>

					</div>

					<div class="shops_bottom">

						<!--<span class="icon icon7"></span>-->

						<p class="return">本羊群年联养回报<?php echo $vo['return_price']; ?>%，快养只自己的小羊吧！</p>

					</div>



				</a>

			<?php elseif($vo['classify'] == 2): ?>

				<!--辅助羊群-->

				<a href="<?php echo url('Order/info',['id'=>$vo['id']]);; ?>" class="shop2">

					<div class="shops_top">

						<p>辅助</p>

						<p><?php echo $vo['name']; ?></p>

						<p>剩余:<?php echo $vo['number']; ?></p>

						<i class="clear"></i>

					</div>

					<div class="shops_cen">

						<div class="">

							<h2><?php echo $vo['price']; ?><em>元</em></h2>

							<p>羊单价</p>

						</div>

						<div class="">

							<h2><?php echo $vo['numbers']; ?><em>只</em></h2>

							<p>羊数量</p>

						</div>

						<div class="">

							<h2><?php echo $vo['rate']; ?><em>天</em></h2>

							<p>联养周期</p>

						</div>

					</div>

					<div class="shops_bottom">



						<p class="return">本羊群年联养回报<?php echo $vo['return_price']; ?>% , 快养只自己的小羊吧！</p>



					</div>



				</a>

			<?php elseif($vo['classify'] == 3): ?>

				<!--VIP羊群-->

				<a href="<?php echo url('Order/info',['id'=>$vo['id']]);; ?>"  class="shop3">

					<div class="shops_top">

						<p>VIP</p>

						<p><?php echo $vo['name']; ?>(请联系客服订购)</p>



						<i class="clear"></i>

					</div>

					<div class="shops_cen">

						<div class="">

							<h2>私人订制  做超级牧主</h2>



						</div>

					</div>

					<div class="shops_bottom">



						<p class="return">VIP羊群年联养回报<?php echo $vo['return_price']; ?>%，私人订制，回报尊享！</p>



					</div>



				</a>

			<?php endif; endforeach; endif; else: echo "" ;endif; ?>





			</div>

			<!--footer-->

			<div class="footer">

				<a href="<?php echo url('index/index'); ?>">

					<span class="icons "></span>

					<p>牧场</p>

				</a>

				<a href="index2.html">

					<span class="icons"></span>

					<p>超市</p>

				</a>

				<a href="index3.html">

					<span class="icons"></span>

					<p>发现</p>

				</a>

				<a href="<?php echo url('member/index'); ?>">

					<span class="icons"></span>

					<p>我的</p>

				</a>

			</div>

		</div>

		<div class="background">



		</div>

		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>

		<script type="text/javascript">

			/*轮播 左右 箭头 行高

			 */

			$("#myCarousel .carousel-control").css("line-height", $("#myCarousel").height() + "px");

			/*footer 当前页选中状态*/

			$(".footer a:nth-child(1) .icons").css("background", "url(__WAP__/img/iconlist_05.png) no-repeat center 10%");

			$(".footer a:nth-child(1) .icons").css("background-size", "3rem");

		</script>

	</body>



</html>