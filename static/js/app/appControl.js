/**
 * Created by Cancel on 3/3/2017.
 */

app = new Vue({
    el : "#appControl",
    data : {
        startApp : false,
        // 当前 app 的 控制器
        controller : '',
        // 当前 app 的 方法
        method : '',
        // 当前外链
        url : '',
        // 当前用户状态
        userInfo : {},
        uid : null,

        request : {
            status : 200,
        }
    },
    methods : {
        lajax : function(controller,method,data,requestType,async) {

            if(requestType == undefined || requestType == null)
            {
                requestType = 'POST';
            }

            if(async == undefined || requestType == null)
            {
                async = true;
            }

            if(requestType == undefined || requestType == null)
            {
                requestType = 'json'
            }

            var self = this;

            // requesting ? abort
            if(self.request.status == undefined){
                self.request.abort();
                self.request = {};
                NProgress.done();
            }

            NProgress.start();

            self.request = $.ajax({
                url: "/?/" + controller + "/" + method,
                type: requestType,
                async: true,
                data : data,
                dataType: 'json',
                timeout : 7000,
                // 请求数据成功了
                success: function (result) {

                    if(result.code != 1)
                    {
                        alert(result.msg);
                    }
                    else{
                        // console.log(result.data);
                        $("#mainContent").html(result.data);
                        self.controller = controller;
                        self.method = method;
                        self.url = '';
                        setCookie('controller',controller);
                        setCookie('method',method);
                        setCookie('url','');
                    }


                },
                // 请求数据完成 成功或失败都调用
                complete : function(XHR,TS){
                    NProgress.done();
                },
                // 请求出现错误
                error : function (a,b) {
                    console.log(a);
                    console.log(b);
                },

            });
        },

        lajaxUrl : function(url) {
            var self = this;

            NProgress.start();
            self.request = $.ajax({
                url: "/?/api/api/load_page",
                type: "POST",
                async: true,
                data : {
                    url : url,
                },
                dataType: 'json',
                timeout : 7000,
                // 请求数据成功了
                success: function (result) {
                    self.url = url;
                    self.method = '';
                    self.controller = '';
                    setCookie('url',url);
                    setCookie('controller','');
                    setCookie('method','');
                    $("#mainContent").html(result.data);
                },
                // 请求数据完成 成功或失败都调用
                complete : function(XHR,TS){
                    NProgress.done();
                },
                // 请求出现错误
                error : function (a,b) {
                    console.log(a);
                    console.log(b);
                    alert(b);
                },

            });
        },

        getUserInfo : function () {
            var self = this;
            $.ajax({
                url: "/?/api/user/info",
                type: "POST",
                async: true,
                data : {},
                dataType: 'json',
                timeout : 7000,
                // 请求数据成功了
                success: function (result) {
                    // if(result.code == 1){
                        self.userInfo = result.data.userInfo;
                        self.uid = result.data.uid;
                    // }else{
                        // alert(result.msg);
                    // }
                },
                // 请求数据完成 成功或失败都调用
                complete : function(XHR,TS){
                },
                // 请求出现错误
                error : function (a,b) {
                    console.log(a);
                    console.log(b);
                    alert(b);
                },

            });
        }
    },
})

app.getUserInfo();

// $('body').niceScroll({
//     cursorcolor: "#ccc",//#CC0071 光标颜色
//     cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
//     touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
//     cursorwidth: "5px", //像素光标的宽度
//     cursorborder: "0", //     游标边框css定义
//     cursorborderradius: "5px",//以像素为光标边界半径
//     autohidemode: true, //是否隐藏滚动条
//     smoothscroll :true,
//     scrollspeed : 0,
// });