$(function(){
    $("#add1").click(function(){
        var oldValue=parseInt($("#add").val()); //取出现在的值，并使用parseInt转为int类型数据
        oldValue++   //自加1
        $("#add").val(oldValue)  //将增加后的值付给控件

        var num = parseInt($("#add").val());
        var str = 'X'+num;
        $('.frnum').html(str);
    });
    $("#redu").click(function(){
        var oldValue=parseInt($("#add").val()); //取出现在的值，并使用parseInt转为int类型数据
        oldValue--;
        if (oldValue<=0){
            $("#add").val(1);
        }
        else{
            $("#add").val(oldValue); //将增加后的值付给控件
        }
        var num = parseInt($("#add").val());
        var str = 'X'+num;
        $('.frnum').html(str);
    });
     $("#add").focus(function() {
      $(this).css("outline","none");  
     });
     $("#add").keyup(function() {
        var reg=/\s+/;
        if(parseInt($(this).val())<1 || isNaN(Number($(this).val())) || reg.test($(this).val())){
          $(this).val(1); 
        }
     });
     $("#add").blur(function() {
        if($(this).val()==""){
          $(this).val(1); 
        }
     });

});