/*有.footer 时 .wrapper 下面的外边距 */
$(".wrapper").css("padding-bottom", $(".footer").height() + "px");

/*有.header 时 .wrapper 上面的外边距 */
$(".wrapper").css("padding-top", ($(".header").height()) + "px");
$(".wrapper").css("box-sizing", "border-box");
/*$(".packet").css("width", $(".wrapper").width() + "px");*/

$("div.header>div").click(function() {/*window.history.back(); */
	history.go(-1)

/*history.back(-1)*/
})
/*提示*/
function overtop() {
				$(".wrapper>div:nth-child(1)").after($("body>p.overtop").clone(true));
				
				var ss1 = $(".wrapper .overtop");
				$(".wrapper .overtop").css("background-color","rgba(0,0,0,0.7)");
				ss1.css("display", "block");
				ss1.css("opacity", "1");
				setTimeout(function() {
					ss1.css("opacity", "0");
					ss1.remove();
				}, 1000);
			}
function overtop2() {
				$(".wrapper>div:nth-child(1)").after($("body>p.overtop").clone(true));
				var ss2 = $(".wrapper .overtop");
				$(".wrapper .overtop").css("background-color","rgba(0,0,0,0.7)");
				ss2.css("display", "block");
				ss2.css("opacity", "1");
				setTimeout(function() {
					ss2.css("opacity", "0");
					ss2.remove();
				}, 2000);  
			}

	/*转换 为两位小数*/
function ts2(n) {
				var one = n % 1;
				if(one == 0) {
					n = n+".00"
				} else {
					var len = n.toString().split(".")[1].length;

					if(len == 1) {
						n = n + "0";
					} else if(len == 2) {
						n = n;
					} else if(len > 2) {
						n = n.toString().substr(0, n.toString().indexOf(".") + 3)
					} else {
						n = n + ".00";
					}
				}
				

			}

/*function ts1(n) {
				var one = n % 1;
				if(one == 0) {
					n = n+".00"
				} else {
					var len = n.toString().split(".")[1].length;

					if(len == 1) {
						n = n + "0";
					} else if(len == 2) {
						n = n;
					} else if(len > 2) {
						n = n.toString().substr(0, n.toString().indexOf(".") + 3)
					} 
				}
				alert(n);
				return n;
				$("#em1").text(n);

			}*/