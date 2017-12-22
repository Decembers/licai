/*有.footer 时 .wrapper 下面的外边距 */
$(".wrapper").css("padding-bottom", $(".footer").height() + "px");

/*有.footer 时他与 .wrapper 的宽等宽 */
$(".header").css("width", $(".wrapper").width() + "px");
/*有.header 时 .wrapper 上面的外边距 */
$(".wrapper").css("padding-top", ($(".header").height()) + "px");
/*$(".packet").css("width", $(".wrapper").width() + "px");*/



/*禁止右键 点击  复制*/
/*$(document).bind("contextmenu copy selectstart", function() {
	return false;
});
$(document).keydown(function(e) {
	if(e.ctrlKey && (e.keyCode == 65 || e.keyCode == 67)) {
		return false;
	}
})*/

if($("body").width() > 900) {
	$(".wrapper").css("left", ($("body").width() - 800) / 2 + "px");
}
$("div.header>div").click(function() {
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
