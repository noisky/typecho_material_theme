// 一言异步加载代码
(function getHitokoto() {
$.ajax({
        //url: "https://api.imjad.cn/hitokoto/?encode=jsc&charset=utf-8&length=50",
        url: "https://v1.hitokoto.cn/?encode=json&charset=utf-8",
        dataType: "jsonp",
        async: true,
      jsonp: "callback",
      jsonpCallback: "hitokoto",
        success: function(result) {
  $('#hitokoto').html(result.hitokoto)
        },
        error: function() {
  $('#hitokoto').html("读取数据失败了的说……_(:з」∠)_")
        }
         });
 })();
/* 首屏图片根据星期获取 */
    // 电脑版图片地址
    var imgUrl = [
        'https://static.ffis.me/img/indexImg/Sivir.jpg',
        'https://static.ffis.me/img/indexImg/Lux.jpg',
        'https://static.ffis.me/img/indexImg/Ashe.jpg',
        'https://static.ffis.me/img/indexImg/Ali.jpg'
    ];
    // 手机版图片地址
    var imgUrl_Phone = [
        'https://static.ffis.me/img/indexImg/phone/Sivir-1.jpg',
        'https://static.ffis.me/img/indexImg/phone/Lux-1.jpg',
        'https://static.ffis.me/img/indexImg/phone/Ashe-1.jpg',
        'https://static.ffis.me/img/indexImg/phone/Ali-1.jpg'
    ];
    // 获取星期
    var day = new Date().getDay();
    // 获取图片元素
    var ele = document.getElementsByClassName("billboard")[0];
	if (ele) {
		// 获取屏幕宽度，进行手机端的判断
		var clientWidth = document.body.clientWidth;
		if (clientWidth < 768) {
			ele.style.backgroundImage = 'url(' + imgUrl_Phone[day % 4] + ')';
		} else {
			ele.style.backgroundImage = 'url(' + imgUrl[day % 4] + ')';
		}
	}
    