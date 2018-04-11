
// 大选项卡----
 $(function() {
                $(".assess .good-details span").click(
                    function(){
                        $(this).addClass("cur").siblings().removeClass("cur").parent().siblings().children("ul").eq($(this).index()).show().siblings().hide();
                    }
                );
                //小选项卡
                $(".detail-user .detail-user-title ul li").click(
                    function(){
                        $(this).addClass("now-gray").siblings().removeClass("now-gray").parent().parent().siblings().children().eq($(this).index()).show().siblings().hide();
                });
                $('.Tastepart').delegate('.detail-user-says-right ul li img', 'click', function(e){ 
                  var url=$(this).attr('src');
                $('.bs-appraise-modal-sm').modal('show')    
                    .find('.appraise-img-dialog>img').attr({'src': url});
                $('.bs-appraise-modal-sm').on('click', function(){
                    $(this).modal('hide')
                })      
             });
            //置顶
             var gao=$("#js_fixed").offset().top; 
            $(window).scroll(function(event){
                var val=$(document).scrollTop();
                if(val>=gao)
                { 
                    $("#js_fixed").css({"position":"fixed", "top":"0"});
                    $("#js_fixed").fadeIn(300);
                }
                else
                {
                    $("#js_fixed").css({"position":"static"});
                }
        });
            //遮罩
                $('.detail-user').delegate('.detail-allsays .detail-allsays01 .detail-user-says .detail-user-says-right li img', 'click', function(e){ 
                var url=$(this).attr('src');
                $('.bs-appraise-modal-sm').modal('show').find('.appraise-img-dialog>img').attr({'src': url});
                $('.bs-appraise-modal-sm').on('click', function(){
                    $(this).modal('hide')
                });      
            })

})
   
