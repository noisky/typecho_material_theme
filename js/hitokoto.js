// 一言异步加载代码
(function getHitokoto() {
$.ajax({
        url: "https://api.imjad.cn/hitokoto/?encode=jsc&charset=utf-8&length=50",
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
// 定义图片地址
var imgUrl = ['https://static.ffis.me/img/billboard-xiweier.jpg', 'https://static.ffis.me/img/billboard-lakesi.jpg', 'https://static.ffis.me/img/billboard-aixi.jpg'];
var imgUrl_Phone = ['https://static.ffis.me/img/billboard-1-xiweier.jpg', 'https://static.ffis.me/img/billboard-1-lakesi.jpg', 'https://static.ffis.me/img/billboard-1-aixi.jpg'];
// 获取星期
var day = new Date().getDay();
// 获取图片元素
var ele = document.getElementsByClassName("billboard")[0];
// 获取屏幕宽度，进行手机端的判断
var clientWidth = document.body.clientWidth;
if (clientWidth < 768) {
	ele.style.backgroundImage = 'url(' + imgUrl_Phone[day % 3] + ')';
} else {
	ele.style.backgroundImage = 'url(' + imgUrl[day % 3] + ')';
}
