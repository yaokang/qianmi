var ua=navigator.userAgent;!function(){var t={IS_DEBUG:!1,HOST_API:location.protocol+"//"+location.host+"/",HOST_IMAGE:"http://img.fruitday.com/",DEF_IMG_URL:"../../images/common/EmptyList.png",RATIO_OF_ADSPIC:75/106,RATIO_OF_MAINPIC:375/410,RATIO_OF_DETAILPIC:1.6,RATIO_OF_MAINCOVER:640/137,ACTIVITY_BANNER:1.875,BAIDU_ID:"",VERSION:"1.0.1"};if(t.IS_DEBUG){t.SHARE_HOSTS=[location.protocol+"//"+location.host];for(var e=0,n=t.LOCALHOSTS.length;e<n&&t.LOCALHOSTS[e]!=location.hostname;e++);t.BAIDU_ID=""}window.config=t}(),function(){function t(t,e){var n=t,o={"M+":n.getMonth()+1,"d+":n.getDate(),"h+":n.getHours(),"m+":n.getMinutes(),"s+":n.getSeconds(),"q+":Math.floor((n.getMonth()+3)/3),S:n.getMilliseconds()};/(y+)/.test(e)&&(e=e.replace(RegExp.$1,(n.getFullYear()+"").substr(4-RegExp.$1.length)));for(var i in o)new RegExp("("+i+")").test(e)&&(e=e.replace(RegExp.$1,1==RegExp.$1.length?o[i]:("00"+o[i]).substr((""+o[i]).length)));return e}var e,n,o,a,s=0,l=function(t,e){var o=this;o.panel=t||$("#fruitday-panel"),o.panelBg=n||$("#fruitday-panel-bg"),o.dialogContent=o.panel.find(".dialog-content"),o.panelContent=o.panel.find(".panel-content"),o.panelTitle=o.panel.find(".panel-title"),o.panelTips=o.panel.find(".panel-tips"),o.panelButtons=o.panel.find(".panel-buttons"),o.btnOk=o.panel.find(".btn-primary"),o.btnCancel=o.panel.find(".btn-default"),o.panelText=o.panel.find(".panel-text"),o.panelTick=o.panel.find(".panel-tick"),o.panelInput=o.panel.find(".panel-input"),o.options={type:"error",tick:0,okText:"确定",cancelText:"取消",showTitle:!1,showTips:!1,textAline:"center"},o.panel.on("click",".btn-primary",function(t){t.preventDefault(),o.hide(!0)}),o.panel.on("click",".btn-default",function(t){t.preventDefault(),o.hide()})};l.prototype={delay:void 0,count:0,setOptions:function(t){var e=this;for(i in t)e.options[i]=t[i];e.options.showTitle?e.panelTitle.show():e.panelTitle.hide(),e.options.showTips?e.panelTips.show():e.panelTips.hide(),e.options.panelInput?e.panelInput.show():e.panelInput.hide(),e.options.okText&&e.btnOk.text(e.options.okText),e.options.cancelText&&e.btnCancel.text(e.options.cancelText),e.options.tipsText&&e.panelTips.html(e.options.tipsText),e.options.titleText&&e.panelTitle.text(e.options.titleText),"confirm"==e.options.type?(e.btnOk.show(),e.btnCancel.show()):"prompt"==e.options.type?(e.btnOk.show(),e.btnCancel.show()):(e.btnOk.show(),e.btnCancel.hide()),e.options.className?e.panelText.addClass(e.options.className):e.panelText.removeClass(e.options.className),e.panelText.html(e.options.message),e.panel.show(),e.panelBg.show(),e.dialogContent.height()>$(window).height()?e.dialogContent.css({"margin-top":0,top:0}):e.dialogContent.css({"margin-top":-(e.dialogContent.height()/2),top:"50%"}),e.panelContent.css("max-height",$(window).height()-e.panelButtons.height()),e.options.tick>1e3?(e.panelTick.text(e.options.tick/1e3),e.delay=setInterval(function(){e.count<e.options.tick-1e3?(e.count=s+1e3,e.panelTick.text((e.options.tick-s)/1e3)):(e._end(),e.count=0,clearInterval(e.delay))},1e3)):e.options.tick<=1e3&&e.options.tick>0&&(e.delay=setTimeout(function(){e._end()},e.options.tick))},_end:function(){var t=this;t.panel.hide(),t.panelBg.hide(),"function"==typeof t.options.tipsCallback?(t.options.tipsCallback(),t.options.tipsCallback=void 0):"function"==typeof t.options.yesCallback&&(t.options.yesCallback(),t.options.yesCallback=void 0)},show:function(){},hide:function(t){var e=this;e.delay&&clearTimeout(e.delay),e.panel&&(e.panel.hide(),e.panelBg.hide(),t?"function"==typeof e.options.yesCallback&&e.options.yesCallback():"function"==typeof e.options.noCallback&&e.options.noCallback(),e.options.yesCallback=void 0,e.options.noCallback=void 0)},preventDefault:function(t){t.preventDefault()}};var r={absImg:function(t,e){if(!t)switch(e){case 1:return config.WHITE_IMG_URL;default:return e||config.DEF_IMG_URL}return"object"==typeof t&&t.length>0&&(t=t[0]),t&&0==t.indexOf("http://")?t:config.HOST_IMAGE+t},formatDate:function(e,n,o){if(0==e)return"--";var i=n||"yyyy-MM-dd hh:mm";if(isNaN(e)||null==e)return o||e;if("object"==typeof e){var a=dd.getFullYear(),s=dd.getMonth()+1,l=dd.getDate();s<10&&(s="0"+s);var r=a+"-"+s+"-"+l,c=r.match(/(\d+)/g),p=new Date(c[0],c[1]-1,c[2]);return t(p,i)}"string"==typeof e&&(e=1*e),e<9999999999&&(e=1e3*e);var p=new Date(parseInt(e));return t(p,i)},formatCurrency:function(t,e,n){if(!t)return e||"--";t+="";var o,i,a=t.indexOf(".");a>0?(o=t.substring(0,a),i=t.substring(a,t.length)):(o=t,i="");var s=o.toString().length%3,l="";return 1==s?l="00":2==s&&(l="0"),o=l+o,o=o.replace(/(\d{3})/g,"$1,"),o=o.substring(0,o.length-1),l.length>0&&(o=o.replace(l,"")),i&&(2==i.length?i+="0":1==i.length&&(i+="00"),i=i.substring(0,3)),o+i},strToDate:function(t){var e=t.split(" "),n=e[0].split("-"),o=parseInt(n[0],10),i=parseInt(n[1],10)-1,a=parseInt(n[2],10),s=e[1].split(":"),l=parseInt(s[0],10),r=parseInt(s[1],10)-1,c=parseInt(s[2],10),p=new Date(o,i,a,l,r,c);return p},getRunTime:function(t,e,n,o){if(!t||isNaN(t)||!e||isNaN(e))return"数据错误";var i=parseInt(e)-parseInt(t),a="",s="";switch(n){case 1:s="距结束&nbsp",a="";break;default:s="剩余",a="结束"}if(i<=0)return"已结束";var l=Math.floor(i/86400),c=Math.floor(i/3600)%24,p=Math.floor(i/60)%60,h=Math.floor(i)%60;return 0==o?l>=3?s+"大于3天":s+r.checkTime(24*l+c)+":"+r.checkTime(p)+":"+r.checkTime(h)+a:"<em>"+r.checkTime(l)+"</em>天<em>"+r.checkTime(c)+"</em>时<em>"+r.checkTime(p)+"</em>分<em>"+r.checkTime(h)+"</em>秒</span> "},checkTime:function(t){return t<10&&(t="0"+t),t},showDialog:function(){},showOverlay:function(){},showConfirm:function(t,n,o){var i={};"object"==typeof t?i=t:(i.message=t,i.yesCallback=n,i.noCallback=o),i.type="confirm",i.showTitle=!0,i.showTip=!1,i.titleText=i.titleText||"提示",i.className=i.className||"text-c",e=e||new l,e.setOptions(i)},showAlert:function(t,n,o){var i={};"object"==typeof t?i=t:(i.message=t,i.tick=n,i.yesCallback=o),"boolean"!=typeof i.showTitle&&(i.showTitle=!1),i.type="alert",e=e||new l,e.setOptions(i)},showPrompt:function(t,n,o,i){var a={};"object"==typeof t?a=t:(a.message=t,a.tick=o,a.yesCallback=i),"boolean"!=typeof a.showTitle&&(a.showTitle=!1),a.showTitle=!0,a.panelInput=!0,a.showTip=!1,a.titleText=n||"提示",a.type="prompt",e=e||new l,e.setOptions(a)},showLoading:function(){$("#fruitday-loading").show()},hideLoading:function(){$("#fruitday-loading").hide()},hidePanel:function(t){e&&e.hide(t)},showToast:function(t,e){a=a||$("#fruitday-toast"),e=e||4e3,o&&clearTimeout(o),t=t.replace(/！/g,"！<br/>"),t=t.replace(/！<br\/>$/,"！"),t=t.replace(/。/g,"。<br/>"),t=t.replace(/。<br\/>$/,"。"),a.find("span").html(t),a.show(),o=setTimeout(function(){a.hide()},e)},formJson:function(t){var e={},n=$(t).serializeArray();return $.each(n,function(){void 0!==e[this.name]?(e[this.name].push||(e[this.name]=[e[this.name]]),e[this.name].push(this.value||"")):e[this.name]=this.value||""}),e},fruitdayFormatCurrency:function(t){if(!t||isNaN(t))return t;var e=parseFloat(t),n=e.toFixed(2);return n.indexOf(".00")>=0&&(n=parseFloat(t).toFixed(0)),n},_GET:function(){var t=location.search,e={};if(""===t||void 0===t)return e;t=t.substr(1).split("&");for(var n in t){var o=t[n].split("=");e[o[0]]=o[1]}return e.from&&delete e.code,e}};window.Tools=r}(),function(){"FastClick"in window&&FastClick.attach(document.body),$(".back-top").click(function(t){t.preventDefault(),window.scrollTo(0,0)})}(),function(){var t={};t.lazyload=function(t){function e(){$(t).each(function(t,e){if(""!=$(this).attr("data-src")){var e=$(this).offset(),i=$(this).height()+8;e.top+i>=o&&e.top<o+5*n&&$(this).attr("src",$(this).attr("data-src"))}})}var n=($(document).height(),$(window).height()),o=0;$(window).scroll(function(){o=$(window).scrollTop(),e()}),setTimeout(e,200)},window.common=t}(),function(){var t={AUTH:"FLV-AUTH",ACCOUNT:"FLV-ACCOUNT",REMEMBER:"FLV-REMEMBER",LOGIN_HISTORY:"LH",AREA:"FLV-AREA",get:function(t,e){if(this.isLocalStorage()){var n=this.getStorage(e).getItem(t);return n&&"undefined"!=n?JSON.parse(n):void 0}},set:function(t,e,n){this.isLocalStorage()&&(e=JSON.stringify(e),this.getStorage(n).setItem(t,e))},remove:function(t,e){this.isLocalStorage()&&this.getStorage(e).removeItem(t)},getStorage:function(t){return t?sessionStorage:localStorage},isLocalStorage:function(){try{return window.localStorage?(localStorage.setItem("FORTEST",1),!0):(log("不支持本地存储"),!1)}catch(t){return log("本地存储已关闭"),!1}}};window.Storage=t}(),function(){$("nav .next").on("click",function(t){t.preventDefault(),$("nav .list").fadeToggle(200)}),$("body").hasClass("has-app")&&$(".back").html("").click(function(t){t.preventDefault()})}();