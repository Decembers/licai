<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\dhpacket.html";i:1514174395;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<!--<title>我的</title>-->
		<title>趣味农场</title>
		<link rel="stylesheet" type="text/css" href="__WAP__/bootstrap-3.3.7/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css"/>
		<style type="text/css">


			.wrapper ul {
				width: 95%;
				overflow: auto;
				margin: 0 auto;
				padding: 1rem 0;
			}

			.voucher_ex_block li:nth-child(odd) {
				float: left;
			}

			.voucher_ex_block li {
				width: 48.5%;
				box-sizing: border-box;
				padding: 0.5rem 0;
				border-radius: 0.4rem;
				background: linear-gradient(to top, #fc6d6d, #ff9191);
				margin-bottom: 0.5rem;
				margin-right: 0.5rem;
				text-align: center;
				color: #fff;
			}

			.voucher_ex_block li:nth-child(even) {
				float: right;
				margin-right: 0;
			}

			.voucher_ex_block .name {
				font-size: 1.7rem;
				margin-top: 0.75rem;
				line-height: 2rem;
			}

			.value {
				display: flex;
				justify-content: center;
				font-size: 2rem;
				line-height: 3rem;
			}

			.consume,
			.consume {
				font-size: 1rem;
				opacity: 0.6;
				display: flex;
				justify-content: center;
			}

			.consume i {
				font-style: normal;
			}

			.voucher_ex_block .exchange {
				display: block;
				box-sizing: border-box;
				width: 7rem;
				height: 3rem;
				line-height: 3rem;
				border: 2px solid #fff;
				border-radius: 1.5rem;
				text-align: center;
				font-size: 1.5rem;
				color: #fff;
				margin: 0.8rem auto 0.5rem auto;
			}

			.modal1 {
				width: 20rem;
				height: 8rem;
				position: fixed;
				z-index: 1002;
				left: 50%;
				margin-left: -10rem;
				border-radius: 0.5rem;
				top: 50%;
				margin-top: -8rem;
				text-align: center;
				background: #e8e8e8;
				color: #3d4145;
				display: none;
			}

			.modal1 p {
				line-height: 4rem;
				font-size: 1.5rem;
			}

			.modal1 p:nth-child(2) {
				display: flex;
				border-top: 1px solid white;
			}

			.modal1 p:nth-child(2) span {
				width: 50%;
				text-align: center;
				padding: 0 .25rem;
				height: 2rem;
				line-height: 2rem;
				text-align: center;
				color: #0894ec;
				background: #e8e8e8;
				box-sizing: border-box;
				margin-top: 1rem;
			}

			.modal1 p:nth-child(2) span:nth-child(1) {
				border-right: 1px solid white;
			}

			#goodcover {
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				width: 100vw;
				height: 100vh;
				background-color: black;
				z-index: 1001;
				-moz-opacity: 0.65;
				opacity: 0.65;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>兑换红包</h3>

			</div>

			<div class="voucher_ex_block clearfix">
				<ul>
<?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<li>
						<div class="name"><?php echo $vo['remark']; ?></div>
						<div class="value">
							<span class="symbol">￥</span>
							<span class="num"><?php echo $vo['money']; ?></span>
							<span class="cheng">X</span>
							<span class="num"><?php echo $vo['number']; ?></span>
							<span class="symbol">个</span>
						</div>
						<div class="consume">有效期至：无限</div>
						<div class="consume">所需积分：<i><?php echo $vo['integral']; ?></i>积分</div>
						<a class="exchange" href="#" url=" " data-id="28" onclick="duihuan(<?php echo $vo['id']; ?>)">兑换</a>
					</li>
<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>

		</div>
		<div class="modal1">
			<p>确定要兑换吗？</p>
			<p class="modal1_p"><span class="modal-button">取消</span><span class="modal-button modal-button-bold">确定</span></p>
		</div>
		<div id="goodcover"></div>
		<p class="overtop">积分不足</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// var t0 = 99999;
			// var t1 = 0;
			// $(".voucher_ex_block ul li a").click(function() {
			// 	var tt1 = $(".voucher_ex_block ul li").index($(this).parent());
			// 	$(".modal1").css("display", "block");
			// 	$("#goodcover").css("display", "block");
			// 	t1 = $(".voucher_ex_block ul li:nth-child(" + (tt1 + 1) + ") .consume i").text();

			// })

			var id;
			function duihuan(pid){
				$(".modal1").css("display", "block");
				$("#goodcover").css("display", "block");
				id = pid;
			}


			$(".modal1_p span:last").click(function() {
				$(".modal1").css("display", "none");
				$("#goodcover").css("display", "none");
				$.ajax({
                    type : "POST",  //提交方式
                    url : "<?php echo url('member/dhpacket'); ?>",//路径
                    data : {
                        "id" : id
                    },
                    dataType : "json",//数据，这里使用的是Json格式进行传输
                    success : function(result) {
						var aa = JSON.parse(result);
						$("body>p.overtop").text(aa.msg);
						overtop1();
					}
			    });
			})
			$(".modal1_p span:first").click(function() {
				$(".modal1").css("display", "none");
				$("#goodcover").css("display", "none");
			})
			$("#goodcover").click(function(){
				$(".modal1").css("display", "none");
				$("#goodcover").css("display", "none");
			})
			function overtop1(){
				$(".header").after($("body>p.overtop").clone(true));
						var ss1 = $(".wrapper .overtop");
						ss1.css("display", "block");
						ss1.css("opacity", "1");
						setTimeout(function() {
							ss1.css("opacity", "0");
							ss1.remove();
						}, 1000);
			}



		</script>
	</body>

</html>