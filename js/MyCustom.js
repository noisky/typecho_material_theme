// 一言异步加载代码
// (function getHitokoto() {
//     $.ajax({
//         // url: "https://api.imjad.cn/hitokoto/?encode=jsc&charset=utf-8&length=50",
//         url: "https://v1.hitokoto.cn/?encode=json&charset=utf-8",
//         dataType: "jsonp",
//         async: true,
//         jsonp: "callback",
//         jsonpCallback: "hitokoto",
//         success: function (result) {
//             $('#hitokoto').text(result.hitokoto)
//         },
//         error: function () {
//             $('#hitokoto').text("读取数据失败了的说……_(:з」∠)_")
//         }
//     });
// })();
/* 首屏图片根据星期获取 */
// 电脑版图片地址
// var imgUrl = [
//     'https://static.ffis.me/img/indexImg/Sivir.jpg',
//     'https://static.ffis.me/img/indexImg/Lux.jpg',
//     'https://static.ffis.me/img/indexImg/Ashe.jpg',
//     'https://static.ffis.me/img/indexImg/Ali.jpg'
// ];
// 手机版图片地址
// var imgUrl_Phone = [
//     'https://static.ffis.me/img/indexImg/phone/Sivir-1.jpg',
//     'https://static.ffis.me/img/indexImg/phone/Lux-1.jpg',
//     'https://static.ffis.me/img/indexImg/phone/Ashe-1.jpg',
//     'https://static.ffis.me/img/indexImg/phone/Ali-1.jpg'
// ];
// 获取星期
// var day = new Date().getDay();
// 获取图片元素
// var ele = document.getElementsByClassName("billboard")[0];
// if (ele) {
    // 获取屏幕宽度，进行手机端的判断
//     var clientWidth = document.body.clientWidth;
//     if (clientWidth < 768) {
//         ele.style.backgroundImage = 'url(' + imgUrl_Phone[day % 4] + ')';
//     } else {
//         ele.style.backgroundImage = 'url(' + imgUrl[day % 4] + ')';
//     }
// }

/* scrollup */
!function (l, o, e) {
    "use strict";
    l.fn.scrollUp = function (o) {
        l.data(e.body, "scrollUp") || (l.data(e.body, "scrollUp", !0), l.fn.scrollUp.init(o))
    }, l.fn.scrollUp.init = function (r) {
        var s, t, c, i, n, a, d, p = l.fn.scrollUp.settings = l.extend({}, l.fn.scrollUp.defaults, r), f = !1;
        switch (d = p.scrollTrigger ? l(p.scrollTrigger) : l("<a/>", {
            id: p.scrollName,
            href: "#top"
        }), p.scrollTitle && d.attr("title", p.scrollTitle), d.appendTo("body"), p.scrollImg || p.scrollTrigger || d.html(p.scrollText), d.css({
            display: "none",
            position: "fixed",
            zIndex: p.zIndex
        }), p.activeOverlay && l("<div/>", {id: p.scrollName + "-active"}).css({
            position: "absolute",
            top: p.scrollDistance + "px",
            width: "100%",
            borderTop: "1px dotted" + p.activeOverlay,
            zIndex: p.zIndex
        }).appendTo("body"), p.animation) {
            case"fade":
                s = "fadeIn", t = "fadeOut", c = p.animationSpeed;
                break;
            case"slide":
                s = "slideDown", t = "slideUp", c = p.animationSpeed;
                break;
            default:
                s = "show", t = "hide", c = 0
        }
        i = "top" === p.scrollFrom ? p.scrollDistance : l(e).height() - l(o).height() - p.scrollDistance, n = l(o).scroll(function () {
            l(o).scrollTop() > i ? f || (d[s](c), f = !0) : f && (d[t](c), f = !1)
        }), p.scrollTarget ? "number" == typeof p.scrollTarget ? a = p.scrollTarget : "string" == typeof p.scrollTarget && (a = Math.floor(l(p.scrollTarget).offset().top)) : a = 0, d.click(function (o) {
            o.preventDefault(), l("html, body").animate({scrollTop: a}, p.scrollSpeed, p.easingType)
        })
    }, l.fn.scrollUp.defaults = {
        scrollName: "scrollUp",
        scrollDistance: 300,
        scrollFrom: "top",
        scrollSpeed: 300,
        easingType: "linear",
        animation: "fade",
        animationSpeed: 200,
        scrollTrigger: !1,
        scrollTarget: !1,
        scrollText: "Scroll to top",
        scrollTitle: !1,
        scrollImg: !1,
        activeOverlay: !1,
        zIndex: 2147483647
    }, l.fn.scrollUp.destroy = function (r) {
        l.removeData(e.body, "scrollUp"), l("#" + l.fn.scrollUp.settings.scrollName).remove(), l("#" + l.fn.scrollUp.settings.scrollName + "-active").remove(), l.fn.jquery.split(".")[1] >= 7 ? l(o).off("scroll", r) : l(o).unbind("scroll", r)
    }, l.scrollUp = l.fn.scrollUp
}(jQuery, window, document);
$.material.init();
$.scrollUp({
    scrollImg: true,
    scrollText: "回顶部"
});
$('#scrollUp').addClass('btn btn-info btn-fab btn-raised fa fa-angle-up');
/* 鼠标点击特效 */
//定义获取词语下标
var a_idx = 0;
jQuery(document).ready(function($) {
    //点击body时触发事件
    $("body").click(function(e) {
        //需要显示的词语
        var a = new Array("富强","民主", "文明", "和谐","自由", "平等", "公正","法治", "爱国", "敬业","诚信", "友善");
        //设置词语给span标签
        var $i = $("<span/>").text(a[a_idx]);
        //下标等于原来下标+1  余 词语总数
        a_idx = (a_idx + 1)% a.length;
        //获取鼠标指针的位置，分别相对于文档的左和右边缘。
        //获取x和y的指针坐标
        var x = e.pageX, y = e.pageY;
        //在鼠标的指针的位置给$i定义的span标签添加css样式
        $i.css({"z-index" : 999999999999999999999999999999999999999999999999999999999999999999999,
            "top" : y - 20,
            "left" : x,
            "position" : "absolute",
            "font-weight" : "bold",
            "color" : "#ff6651"
        });
        //在body添加这个标签
        $("body").append($i);
        //animate() 方法执行 CSS 属性集的自定义动画。
        //该方法通过CSS样式将元素从一个状态改变为另一个状态。CSS属性值是逐渐改变的，这样就可以创建动画效果。
        //详情请看http://www.w3school.com.cn/jquery/effect_animate.asp
        $i.animate({
            //将原来的位置向上移动180
            "top" : y - 180,
            "opacity" : 0
            //1500动画的速度
        }, 1500, function() {
            //时间到了自动删除
            $i.remove();
        });
    });
});
/* 文章页面目录索引配置 */
$(function () {
    $(document).headIndex({
        articleWrapSelector: '.post-content',//包裹文章的元素的选择器
        indexBoxSelector: '.index-box',//用来放目录索引的元素的选择器
        scrollSelector: 'body,html',
        scrollWrap: window,
        offset: 0,
    });
});
/* 保持文章目录树标题和目录同步显示和隐藏 */
$(function () {
    let indexBoxTitle = $(".index-item").length;
    if (0 === indexBoxTitle) {
        $("#index-box-title").css("display", "none");
    }
});
/* 极验验证码 */
$(function () {
    var handler = function (captchaObj) {
        captchaObj.appendTo('#captcha');
        captchaObj.onReady(function () {
            $("#wait").hide();
        });
        // $('#sub_btn').click(function () {
        $('#comment_form').submit(function () {
            var result = captchaObj.getValidate();
            if (!result) {
                alert('请完成验证码验证嗷~');
                return false;
            }
            var submit = false;
            $.ajax({
                url: 'https://api.ffis.me/geetest/validate',
                async: false, //二次验证改为同步请求，方便处理请求结果
                type: 'POST',
                xhrFields: {
                    withCredentials: true
                },
                dataType: 'json',
                data: {
                    challenge: result.geetest_challenge,
                    validate: result.geetest_validate,
                    seccode: result.geetest_seccode
                },
                success: function (data) {
                    if (data.data.result === 'success') {
                        // alert('验证成功');
                        submit = true;
                    } else if (data.data.result === 'fail') {
                        alert('验证失败，请重新验证');
                        captchaObj.reset();
                        submit = false;
                    }
                }
            });
            //控制表单提交
            if (submit) {
                return submit;
            } else {
                return submit;
            }
        })
        window.gt = captchaObj;
    };
    var errHanlder = function () {
        $('#comment_form').submit(function () {
            alert('验证码加载失败！无法提交评论');
            return false;
        })
    };
    $.ajax({
        url: "https://api.ffis.me/geetest/register?t=" + (new Date()).getTime(), // 加随机数防止缓存
        // async: false,
        timeout: 2000,
        type: "get",
        xhrFields: {
            withCredentials: true
        },
        dataType: "json",
        success: function (data) {
            $('#text').hide();
            $('#wait').show();
            // 调用 initGeetest 进行初始化
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它调用相应的接口
            initGeetest({
                // 以下 4 个配置参数为必须，不能缺少
                gt: data.data.gt,
                challenge: data.data.challenge,
                offline: !data.data.success, // 表示用户后台检测极验服务器是否宕机
                new_captcha: data.data.new_captcha, // 用于宕机时表示是新验证码的宕机
                product: "float", // 产品形式，包括：float，popup
                width: "200px",
                // https: false
            }, handler);
        },
        error: function (data) {
            $('#text').html("行为验证™ 安全组件 <span class='loadErr'>加载失败！</span>")
            errHanlder()
        }
    });
});
