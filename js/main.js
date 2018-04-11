//配置页面加载模块参数
require.config({
    paths: {
        "jquery"		:'lib/jquery-1.11.0.min',
        "bootstrap"		:'lib/bootstrap.min',
        "sly"     		:'lib/sly.min',
        "lazyload"      :'lib/jquery.lazyload.min',
        "rose"          :'rose',
        "messagebox"    :'MessageBox',
        
    },
    shim: {//模块依赖关系
        jquery	: {exports: '$'},
        'bootstrap' : {deps: ['jquery']},
        'sly' : {deps: ['jquery']},
        'lazyload' : {deps: ['jquery']},
        'rose' : {deps: ['jquery']},
      
        'messagebox' : {deps: ['jquery']}
        
    }
});

var commonJs = ['jquery','bootstrap','sly','lazyload','rose','messagebox'];




require(commonJs,function($){
    $(function(){
        rosefunction();
    });
});

