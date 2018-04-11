/**
 * Created by RoseTong on 15/9/21.
 */
define(["jquery","sly"],function($) {

    //嵌入iosapp
    function isIosapp(){
        var isIPhone = /iPhone/i.test(navigator.userAgent),
            isIPad = /iPad/i.test(navigator.userAgent),
            isAndroid = /android/i.test(navigator.userAgent);
        var isIOS = isIPhone  || isIPad;
        var sW=screen.width,
            sH=screen.height,
            wW=$(window).width(),
            wH=$(window).height();
        var home='<a id="return" href="http://wap.fruitday.com/roseapp/" style="display:block; position:fixed; bottom:120px; left:20px; z-index:3000; width:46px; height:46px; background:rgba(0,0,0,.8); font-size:2.4em; line-height:46px; color:#f00; text-align:center; border-radius:10px; text-decoration:none;">A</a>'
        if(isIPhone && sW===wW && sH===wH){
            $('body').css({'paddingTop':'1%', 'height':'99%'}).append(home);
        }
    }

    (function ($) {
        $.extend({
            tipsBox: function (options) {
                options = $.extend({
                    obj: null,  //jq对象，要在那个html标签上显示
                    str: "+1",  //字符串，要显示的内容;也可以传一段html，如: "<b style='font-family:Microsoft YaHei;'>+1</b>"
                    startSize: "12px",  //动画开始的文字大小
                    endSize: "30px",    //动画结束的文字大小
                    interval: 600,  //动画时间间隔
                    color: "red",    //文字颜色
                    callback: function () { }    //回调函数
                }, options);
                $("body").append("<span class='num'>" + options.str + "</span>");
                var box = $(".num");
                var left = options.obj.offset().left + options.obj.width() / 2;
                var top = options.obj.offset().top - options.obj.height();
                box.css({
                    "position": "absolute",
                    "left": left + "px",
                    "top": top + "px",
                    "z-index": 9999,
                    "font-size": options.startSize,
                    "line-height": options.endSize,
                    "color": options.color
                });
                box.animate({
                    "font-size": options.endSize,
                    "opacity": "0",
                    "top": top - parseInt(options.endSize) + "px"
                }, options.interval, function () {
                    box.remove();
                    options.callback();
                });
            }
        });
    })(jQuery);


    function niceIn(prop){
        prop.find('i').addClass('niceIn');

        setTimeout(function(){
            prop.find('i').removeClass('niceIn').addClass(' icon-supported');
        },1000);
    }

    function published(a,b){
        $('#publish').on('touchstart', function(){
            var _val=$('#appraiseText').val(),
                _this=$(this),
                t=parseInt( $('#message').find('em').text() ),
                _li='<li>' +
                    '<span class="avatar"><img src="../images/avatar.png" alt="" class="img-circle"></span>' +
                    '<div class="info">' +
                    '<span class="username">果园新人</span>' +
                    '<!--<span class="level user-level_3"></span> 没有等级icon--> ' +
                    '<span class="time">刚刚</span> ' +
                    '</div> ' +
                    '<div class="cont">'+(b ? '<span class="usernamed">回复 '+a+'</span> ' : '') +_val+'</div>' +
                    '</li>';
            //以上li里的数据要进行交互
            if(_val!=""){
                if($('#appraiseList>li').size()<1){
                    $('#appraiseList').removeClass('hide').next('h5').remove();
                }
                $('#appraiseList').prepend(_li);
                $('.modal-tips').fadeIn(300);
                setTimeout(function(){
                    $('#appraiseModal').modal('hide');
                    $('.modal-tips').hide();
                    $('#appraiseText').val('');
                    $('#message').find('em').text(t+1);
                },600);
            }
            _this.off('touchstart');
        });

        $('#appraiseModal').on('hidden.bs.modal', function(){
            $('#publish').off('touchstart');
        });
    }




    //edit by romy 2016-01-19
    //会员中心banner
    function slideMemberBanner() {
        var $frameBanner = $('#frameBanner'),
            $selector = $frameBanner.find('li');
        $selector.width($frameBanner.width());
        $frameBanner.sly({
            horizontal: 1,
            itemNav: 'forceCentered',
            itemSelector: $selector,
            smart: true,
            activateMiddle: 1,
            pagesBar: $(".slidebtn"),
            activatePageOn: "click",
            cycleBy: 'pages',
            cycleInterval: 3800,
            pauseOnHover: 1,
            touchDragging: 1,
            startPaused: 0,
            mouseDragging: 1,
            releaseSwing: 1,
            speed: 800,
            elasticBounds: 1,
            pageBuilder: function () {
                return '<li>&nbsp;</li>';
            }
        });
    }
    /*
     function slideMemberLayout() {
     var $frameLayout = $('.frameLayout'),
     $selector = $frameLayout.find('li');
     $selector.width( $frameLayout.width()* .7) ;
     $frameLayout.sly({
     horizontal: 1,
     itemNav: 'basic',
     smart: 1,
     activateOn: 'click',
     mouseDragging: 1,
     touchDragging: 1,
     releaseSwing: 1,
     startAt: 0,
     activatePageOn: 'click',
     speed: 300,
     elasticBounds: 1,
     dragHandle: 1,
     dynamicHandle: 1,
     clickBar: 1
     });
     }
     */

    function slideMemberLayout0() {
        var $frameLayout = $('.frameLayout0'),
            $selector = $frameLayout.find('li');
        $selector.width( $frameLayout.width()* .25) ;
        $frameLayout.sly({
            horizontal: 1,
            itemNav: 'basic',
            smart: 1,
            activateOn: 'click',
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            startAt: 0,
            activatePageOn: 'click',
            speed: 300,
            elasticBounds: 1,
            dragHandle: 1,
            dynamicHandle: 1,
            clickBar: 1
        });
    }

    function slideMemberLayout5() {
        var $frameLayout = $('.frameLayout5'),
            $selector = $frameLayout.find('li'),
            $box=$('.m-member-tabBox');
        $selector.width( $frameLayout.width()* .30) ;

        var i=$frameLayout.find('li.active').index();

        $frameLayout.sly({
                horizontal: 1,
                itemNav: 'basic',
                smart: 1,
                activateOn: 'click',
                mouseDragging: 1,
                touchDragging: 1,
                releaseSwing: 1,
                startAt: i,
                activatePageOn: 'click',
                speed: 300,
                elasticBounds: 1,
                dragHandle: 1,
                dynamicHandle: 1,
                clickBar: 1
            }, {
                load: function(){
                    $box.find('div').eq(i).slideDown(200)
                }
            }
        );

        $selector.on('click', function(){
            var i=$(this).index();
            $box.find('div').eq(i).slideDown(200).siblings('div').hide(0);
        })

    }

    function tabMemberLayout2(){
        var $box=$('.m-member-tabBox'),
            $menu=$('.m-member-tabMenu');

        $menu.find('li').on('click', function(){
            var i=$(this).index();
            $(this).addClass('cur').siblings('li').removeClass('cur');
            $box.find('div').eq(i).slideDown(200).siblings('div').hide(0);
        })

    }

    function slideMemberLayout4() {
        var $frameLayout = $('.frameLayout4'),
            $selector = $frameLayout.find('li');
        $selector.width( $frameLayout.width()* .33) ;
        var i=$frameLayout.find('li.active').index();
        $frameLayout.sly({
            horizontal: 1,
            itemNav: 'basic',
            smart: 1,
            activateOn: null,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            startAt: i,
            activatePageOn: null,
            speed: 300,
            elasticBounds: 1,
            dragHandle: 1,
            dynamicHandle: 1,
            clickBar: 1
        });
        //$frameLayout.find('li:last-child').width( $frameLayout.find('.slidee').width() *.72).delay(200).show();

        $frameLayout.find('li.active').css('margin-left',window.innerWidth*0.3);
        var widtha = 0;
        var halfUnit = $frameLayout.find('li:last-child').prev().width() / 2;
        $frameLayout.find('li:last-child').siblings().each(function(){
            widtha = widtha + $(this).width();
        });
        widtha = widtha + window.innerWidth*0.3 - halfUnit;
        $frameLayout.find('li:last-child').width(widtha).delay(200).show();
    }


    //置顶
    function scrollFun(){
        $("#goTop").click(function(){
            //alert(1);
            $('body').animate({scrollTop: 0},100);
        });
    }

    //弹窗显示隐藏
    function dialogFun(){
        $('.modal-orderpay .icon-close,.m-cancel').on('click', function(){
            $(this).parents('.modal-orderpay').modal('hide');

        });
    }

    //积分兑换
    function changePoint(){
        $('.change-point li p.change-btn').on('click', function(){
            //alert(needPoint+"||"+nowPoint);
            if($(this).parent().data("kind")=="fruit"){
                $("#m-fruit").modal('show');
            }else{
                $("#m-coupon").modal('show');
            }

        })
    }


    function init() {
        //isIosapp();

        if($('#m-app').length){

            //初始化评论信息
            $.getJSON('app-appraise-data.json', function( data ) {
                var items = [], _li;
                if(data!=''){
                    $.each( data, function( k, v ) {
                        _li='<li>' +
                        '<span class="avatar"><img src="' + v.avatarSrc + '" alt="" class="img-circle"></span>' +
                        '<div class="info">' +
                        '<span class="username">' + v.username + '</span>' + (v.level!='' ? '<span class="level user-level_' + v.level + '"></span>' : '')+
                        '<span class="time">' + v.time + '</span> ' +
                        '</div> ' +
                        '<div class="cont">'+(v.reply!='' ? '<span class="usernamed">回复 '+v.reply+'</span> ' : '') + v.content+'</div>' +
                        '</li>';
                        items.push( _li);
                    });
                    $('#appraiseList').append(items.join( "" ) );
                }else{
                    $('.page-appraise').append('<h5>暂无评论</h5>').find('ul').addClass('hide');  // 评价为空时
                }
                $('#message').find('em').text($('#appraiseList>li').size());
            });
        }




        $("#support").one('touchstart', function () {
            var _this=$(this);
            $.tipsBox({
                obj: _this,
                str: "+1",
                color: "#64a131",
                interval: 800,
                callback: function () {
                    //在这里加点赞的数据变化
                    var t=parseInt( _this.find('em').text() );
                    _this.find('em').text(t+1);
                }
            });
            niceIn(_this);
        });

        $('#appraiseList').delegate('li', 'click', function(){
            var tt= $(this).find('.username').text();
            $('#appraiseModal').modal('show');
            published(tt, true);
        });

        $('#message').on('touchstart', function(){
            console.log(1)
            $('#appraiseModal').modal('show');
            published();
        });

        $('.m-close').click(function(){
            $('#downloadApp').slideUp(200);
            if($('#m-app').length){
                $('#m-app').css({'paddingBottom':44}).find('.page-func').css({'bottom':0})
            }
        });

        $(window).scroll(function(){
            if($('#m-app').length){
                $('#downloadApp').slideUp(200);
                $('body').css({'paddingBottom':0});
                $('#m-app').css({'paddingBottom':44}).find('.page-func').css({'bottom':0});
            }
        });
        //alert(1);
        if($(".m-member-center").length){
            //alert(1);
            slideMemberBanner();
            scrollFun();
            changePoint();
            dialogFun();
        };

        if($(".m-member_center_new").length){

            // alert(12)
            // slideMemberLayout();
            slideMemberLayout0();
            slideMemberLayout4();
            //slideMemberLayout5();

            tabMemberLayout2();

        }
    }

    return {
        init:init
    }
})





