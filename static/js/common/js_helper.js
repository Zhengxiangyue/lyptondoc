
/*
*
* item 是否在arr中
*
* */

function inArray(item,arr){
    for(key in arr){
        if(arr[key] === item){
            return true;
        }
    }
    return false;
}

/*
*
* 字符串转时间戳
* */

function strtotime(str){
    var _arr = str.split(' ');
    var _day = _arr[0].split('-');
    _arr[1] = (_arr[1] == null) ? '0:0:0' :_arr[1];
    var _time = _arr[1].split(':');
    for (var i = _day.length - 1; i >= 0; i--) {
        _day[i] = isNaN(parseInt(_day[i])) ? 0 :parseInt(_day[i]);
    };
    for (var i = _time.length - 1; i >= 0; i--) {
        _time[i] = isNaN(parseInt(_time[i])) ? 0 :parseInt(_time[i]);
    };
    var _temp = new Date(_day[0],_day[1]-1,_day[2],_time[0],_time[1],_time[2]);
    return _temp.getTime() / 1000;
}

function CurentTime()
{
    var now = new Date();

    var year = now.getFullYear();       //年
    var month = now.getMonth() + 1;     //月
    var day = now.getDate();            //日

    var hh = now.getHours();            //时
    var mm = now.getMinutes();          //分
    var ss = now.getSeconds();           //秒

    var clock = year + "-";

    if(month < 10)
        clock += "0";

    clock += month + "-";

    if(day < 10)
        clock += "0";

    clock += day + " ";

    if(hh < 10)
        clock += "0";

    clock += hh + ":";
    if (mm < 10) clock += '0';
    clock += mm + ":";

    if (ss < 10) clock += '0';
    clock += ss;
    return(clock);
}

function mergeArray (arr1,arr2){
    for(var key in arr2){
        arr1.push(arr2[key]);
    }
    return arr1;
}

/*

    判断页面到底部的方法

*/

var headerScroll = {
    getScrollTop : function(){
        var scrollTop = 0;
        if (document.documentElement && document.documentElement.scrollTop) {
            scrollTop = document.documentElement.scrollTop;
        }
        else if (document.body) {
            scrollTop = document.body.scrollTop;
        }
        return parseInt(scrollTop);
    },

    getClientHeight:function() {
        var clientHeight = 0;
        if (document.body.clientHeight && document.documentElement.clientHeight) {
            clientHeight = Math.min(document.body.clientHeight, document.documentElement.clientHeight);
        }
        else {
            clientHeight = Math.max(document.body.clientHeight, document.documentElement.clientHeight);
        }
        return parseInt(clientHeight);
    },

    getScrollHeight : function(){
        return parseInt(Math.max(document.body.scrollHeight, document.documentElement.scrollHeight));
    },

    toBottom : function (){
        if (headerScroll.getScrollTop() + headerScroll.getClientHeight() == headerScroll.getScrollHeight()
            || headerScroll.getScrollTop() + headerScroll.getClientHeight() + 1 == headerScroll.getScrollHeight()
        ) {
            return true;
        }
        return false;
    },

    bottomAcation : function(){}
}

window.onscroll = function () {
    if (headerScroll.toBottom()) {
        headerScroll.bottomAcation();
    }
}

function jsonToObj(str){
    return JSON.parse(str);
}

function objToJson(obj){
    return JSON.stringify(obj);
}

function setCookie(c_name,value,expiredays)
{
    var exdate=new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie=c_name+ "=" +escape(value)+
        ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}

function getCookie(c_name)
{
    if (document.cookie.length>0)
    {
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1)
        {
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}


