/*index1-shop1.html 倒计时 自动获取现在时间 与上午十点对比    取时差	 倒计时*/

var date1 = new Date();
var hours = date1.getHours();
var minu = date1.getMinutes();
var Second = date1.getSeconds()
var min = 0;
var sec = 0;
var ms = 0;
var msStr1 = ms;
var secStr1 = sec;
var minStr1 = min;
var timer = null;
/*与上午十点对比    取时差*/
if(hours > 10) {
	min = 24 - hours - 1 + 10;
	sec = 60 - minu;
	ms = 60 - Second;
	strs();
} else if(hours < 10) {
	min = 10 - hours - 1;
	sec = 60 - minu;
	ms = 60 - Second;
	strs();
} else if(hours == 10) {
	min = 23;
	sec = 60 - minu;
	ms = 60 - Second;
	strs();
}
/*倒计时开始*/
clearInterval(timer);
timer = setInterval(show, 1000)
//添加事件	

//生成时间
function show() {
	ms--;
	if(sec == 0) {
		min--;
		sec = 59;
	}
	if(ms == 0) {
		sec--;
		ms = 59;
	}
	if(sec == 0 && ms == 0) {
		if(min == 0) {
			clearInterval(timer);
			$("#big-button").html("朕要买羊");
			$("#big-button").removeAttr("disabled");
			$("#timer").html("进行中");
		}
	}
	var msStr = ms;
	if(ms < 10) {
		msStr = "0" + ms;
	}
	var secStr = sec;
	if(sec < 10) {
		secStr = "0" + sec;
	}
	var minStr = min;
	if(min < 10) {
		minStr = "0" + min;
	}

	$('#timer .hour').html(minStr);
	$('#timer .minute').html(secStr);
	$('#timer .second').html(msStr);
}
/*定时器开始前 时间写入*/
function strs() {
	var msStr1 = ms;
	if(ms < 10) {
		msStr1 = "0" + ms;
	}
	var secStr1 = sec;
	if(sec < 10) {
		secStr1 = "0" + sec;
	}
	var minStr1 = min;
	if(min < 10) {
		minStr1 = "0" + min;
	}
	$('#timer .hour').html(minStr1);
	$('#timer .minute').html(secStr1);
	$('#timer .second').html(msStr1);
}