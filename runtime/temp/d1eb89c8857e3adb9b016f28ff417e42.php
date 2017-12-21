<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\licai./application/wap\view\index\orlist.html";i:1513827981;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<!--<title>购买羊只</title>-->
		<title>趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<!--<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />-->
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
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

			@media screen and (max-width: 900px) {
				.wrapper {
					background-color: rgb(240, 240, 243);
				}
			}

			@media screen and (min-width: 900px) {
				.wrapper {
					background-color: rgba(255, 255, 255, 0.01);
				}
			}

			i {
				font-style: normal;
			}


			#nav1>li.type1 {
				background-color: #3db4cc !important;
			}

			#nav2>li.type1 {
				background-image: url(__WAP__/img/vip.jpg) !important;
				-moz-background-size: 100% 100% !important;
				background-size: 100% 100% !important;
			}

			#nav3>li.type1 {
				background-color: #41d1a1 !important;
			}

			#nav1 li.type1 .sellOut01 {
				color: #3db4cc !important;
				background: #fff !important;
			}

			#nav2 li.type1 .sellOut02 {
				color: #ffbe4c !important;
				background: #fff !important;
			}

			#nav3 li.type1 .sellOut03 {
				color: #41d1a1;
				!important;
				background: #fff !important;
			}

			#nav1 li.type1 .project_name,
			#nav2 li.type1 .project_name,
			#nav3 li.type1 .project_name {
				color: white !important;
			}

			#nav1 li.type1 .m_co,
			#nav2 li.type1 .m_co,
			#nav3 li.type1 .m_co {
				color: white !important;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>购买羊只</h3>
				<a href="index1-navs2-1.html">项目介绍</a>
			</div>
			<div class="menu">
				<div class="subnav">
					<p id="type1" class="active1">常规羊群</p>
					<p id="type2">VIP羊群</p>
					<p id="type3">辅助羊群</p>
				</div>
				<!--常规羊群-->
				<ul class="recommended_nav_2" id="nav1">
					<?php if(is_array($cgy) || $cgy instanceof \think\Collection || $cgy instanceof \think\Paginator): $i = 0; $__LIST__ = $cgy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['isdelete'] != 1): ?>
					<li class="type1 fillet" onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut01  fl">进行</div>
						<p class="project_name">原生态苏尼特羔羊171211A<span class=" fr">剩余：<?php echo $vo['number']; ?></span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php else: ?>
					<li class="fillet" onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut01  fl">售完</div>
						<p class="project_name">原生态苏尼特羔羊171211A<span class=" fr">剩余：0</span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<!--VIP羊群-->
				<ul class="recommended_nav_2"  id="nav2">
					<?php if(is_array($vipy) || $vipy instanceof \think\Collection || $vipy instanceof \think\Paginator): $i = 0; $__LIST__ = $vipy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['isdelete'] != 1): ?>
					<li class="type1 fillet"onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut02  fl">进行</div>
						<p class="project_name">VIP私人订制续订羊群B171211<span class="fr">剩余：<?php echo $vo['number']; ?></span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php else: ?>
					<li class="fillet" onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut02  fl">售完</div>
						<p class="project_name a9">VIP私人订制续订羊群B171211<span class="a9 fr">剩余：0</span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small a9">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small a9">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small a9">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<!--辅助羊群-->
				<ul class="recommended_nav_2" 	 id="nav3">
					<?php if(is_array($fzy) || $fzy instanceof \think\Collection || $fzy instanceof \think\Paginator): $i = 0; $__LIST__ = $fzy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['isdelete'] != 1): ?>
					<li class="type1 fillet"onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut03  fl">进行</div>
						<p class="project_name ">蒙高丽亚店铺辅助羊群171211<span class=" fr">剩余：<?php echo $vo['number']; ?></span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php else: ?>
					<li class="fillet" onclick="window.location='<?php echo url("Order/info",["id"=>$vo['id']]);; ?>'">
						<div class="stage sellOut03  fl">售完</div>
						<p class="project_name a9">蒙高丽亚店铺辅助羊群171211<span class="a9 fr">剩余：<?php echo $vo['number']; ?></span></p>
						<div class="title_nav">
							<div class="con_height">
								<div class="w_b tc">
									<div class="tl je">
										<p class="m_co"><i class="big"><?php echo $vo['price']; ?></i><i class="small">元</i></p>
										<p class="small a9">羊单价</p>
									</div>
									<div class="tl sj">
										<p class="m_co"><i class="big"><?php echo $vo['numbers']; ?></i><i class="small">只</i></p>
										<p class="small a9">羊只数量</p>
									</div>
									<div class="tl lv">
										<p class="m_co"><i class="big"><?php echo $vo['rate']; ?></i><i class="small">天</i></p>
										<p class="small a9">联养周期</p>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div class="background">

		</div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(".menu .recommended_nav_2").css("display", "none");
			$("#nav1").css("display", "block");
			/*点击切换*/
			$(".menu .subnav p").click(function() {
				tt = $(".menu .subnav p").index($(this));
				if(tt == 0) {
					$(".menu .subnav p").removeClass();
					$(this).addClass("active1");
					$(".menu .recommended_nav_2").css("display", "none");
					$("#nav1").css("display", "block");
				} else if(tt == 1) {
					$(".menu .subnav p").removeClass();
					$(this).addClass("active2");
					$(".menu .recommended_nav_2").css("display", "none");
					$("#nav2").css("display", "block");
				} else if(tt == 2) {
					$(".menu .subnav p").removeClass();
					$(this).addClass("active3");
					$(".menu .recommended_nav_2").css("display", "none");
					$("#nav3").css("display", "block");
				}
			})

		</script>
	</body>

</html>