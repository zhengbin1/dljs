$(document).ready(function (){
	var num = 0;
	var count = 4;  // 图片的总数
	var inter = 0;
	var slidertime = 5000;  // 多长时间滚动一次，单位毫秒
	
	// 显示图片
	$("#main_qslider>div").css("display","none");
	$("#main_qslider>div").eq(num).css("display","block");
	
	function powerpoint(){  // 幻灯片显示
		inter = setInterval(function(){
			// 显示图片
			$("#main_qslider>div").css("display","none");
			$("#main_qslider>div").eq(num).css("display","block");
			$("#main_qslider>div").eq(num).animate({backgroundPosition:'0%'},4100);
			$("#main_qslider>div").eq(num).animate({backgroundPosition:'900px'},300);
			$("#main_qslider>div").eq(num).animate({backgroundPosition:'800px'},300);
			$("#main_qslider>div").eq(num).animate({backgroundPosition:'-900px'},300);

			num ++;
			if(num >= count){
				num = 0;
			}
		}, slidertime);
	}
	
	powerpoint();  // 幻灯片显示
	
});