<link href="<?= base_url('static/');?>summernote/dist/summernote.css" rel="stylesheet">
<link href="<?= base_url('bower_components/');?>editor.md/css/editormd.min.css" rel="stylesheet"  />

<style>
    .note-editor.note-frame {
        border-color: #eee;
    }

    .note-btn {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        color: #9fadc7;
        border: 0;
        background-color: #f5f5f5;
    }

    .note-resizebar {
        display: none;
    }

    #editorButton {
        margin: 10px auto;
    }

    #editorButton .btn-sm, .btn-group-sm > .btn {
        padding: 5px 10px;
    }

    .functionButton {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .rowRight {
        text-align: right;
    }

    .btn-small-padding {
        padding: 6px 15px;
    }

    .btn-middle-padding {
        padding: 8px 12px;
    }

    .btn-white {
        background-color: white;
        border: 1px white solid;
        color: #2f4154;
    }

    .btn-white:focus {
        background-color: white;
        border: 1px rgb(213, 222, 237) solid;
        color: #2f4154;
    }

    .btn-white:hover {
        color: rgb(213, 222, 237);
    }

    .good-font {
        font-family: "Source Sans Pro", sans-serif;
    }

    .row10{
        margin-top: 10px;
    }
    .functionItem {
        margin: 10px 16px 10px 0;
    }

    .btn-xsm {
        font-size: 12px;
    }
    .md-function{
        border-radius: 0;
    }
    .md-function-group{
        margin-top: 20px;
        border: 1px solid #e1e4e7;
        border-bottom: 0;
    }

    h2{
        font-size: x-large;
    }

    #preView{
        height: calc(100vh - 53px - 62px);
        margin-bottom: 0;
        overflow-y: scroll;
        padding-top: 20px;
    }

    .editorFullScreen{
        top: 53px;
        z-index: 100;
        width: 100vw;
        position: fixed;
        left: 0;
        padding:0 !important;
        height: calc( 100vh - 53px );
    }
    .editorFullScreen .note-editing-area{
        height: 100%;
    }

    .note-editor{
        margin-top: 20px;
    }

    .editorFullScreen .note-editor{
        height: 100%;
        margin-top: 0px;
    }
    .editorFullScreen .note-editable{
        height: 100% !important;
        max-height:  100% !important;
        padding: 0 calc((100vw - 16.6667vw - 750px)/2) !important;
    }

    .editorFullScreen{
        padding-left: calc((100vw - 16.6667vw - 750px)/2);
        padding-right: calc((100vw - 16.6667vw - 750px)/2);
    }

    h1,.jumbotron h1, .jumbotron .h1{
        font-size:41px
    }

    h2,.jumbotron h2, .jumbotron .h2{
        font-size:37px
    }

    h3,.jumbotron h3, .jumbotron .h3{
        font-size:33px
    }

    h4,.jumbotron h4, .jumbotron .h4{
        font-size:29px
    }

    h5,.jumbotron h5, .jumbotron .h5{
        font-size:25px
    }

    h6,.jumbotron h6, .jumbotron .h6{
        font-size:21px
    }

    .topBar{
        background-color: whitesmoke;
    }
    .CodeMirror-scroll{
        overflow: hidden!important;
    }
    .editormd-menu>li>a>.editormd-bold{
        font-family: inherit;
    }

    .select2-choice{
        padding: 0;
    }

    .select2-arrow{
        display: none;
    }

    .dropdown{
        display: inline-block;
    }

    .bootstrap-tagsinput{
        margin: 0;
    }

    .form-control{
        border-color: whitesmoke;
        display: inline-block;
    }

    .mdfunction-button{

    }

    .leftDirectory{
        height: calc(100vh - 54px);
    }

    .btn-directory{
        background-color: rgb(66, 66, 66);
        border-radius: 0;text-align: left;font-size: large
    }

    .btn-directory-2{
        background-color: rgb(66, 66, 66);
        border-radius: 0;
        text-align: left;
        font-size: large;
    }

    .donTShow{
        display: none;
    }

    .note-toolbar p,pre,{
        margin: 0;
    }

    .note-toolbar h1,h2,h3,h4,h5{
        font-weight: 400;
    }

    .note-editable > h1,h2,h3,h4,h5{
        margin: 10px auto!important;
    }

    .note-editable > p{
        margin-bottom: 10px;
    }
    .dropdown-menu > li > a > p{
        margin: 0!important;
    }

    .note-popover .popover-content .note-style h1, .panel-heading.note-toolbar .note-style h1, .note-popover .popover-content .note-style h2, .panel-heading.note-toolbar .note-style h2, .note-popover .popover-content .note-style h3, .panel-heading.note-toolbar .note-style h3, .note-popover .popover-content .note-style h4, .panel-heading.note-toolbar .note-style h4, .note-popover .popover-content .note-style h5, .panel-heading.note-toolbar .note-style h5, .note-popover .popover-content .note-style h6, .panel-heading.note-toolbar .note-style h6, .note-popover .popover-content .note-style blockquote, .panel-heading.note-toolbar .note-style blockquote{
        margin: 0!important;
    }

    .floatRight{
        float: right;
    }

    .padding-middle{
        padding-left: calc((100vw - 16.6667vw - 750px)/2);
        padding-right: calc((100vw - 16.6667vw - 750px)/2);
    }

    .directory-ul-2{
        /*padding: 10px;*/
        padding-left: 23px;
    }

    .btn-directory-2{
        padding: 0;
    }

    .fullScreen{
        position: fixed;
        width: 100vh;
        height: 100vh;
    }

    #summernoteEditor{
        height: calc(100vh - 53px - 62px);
    }

    #rightEditor{
        float: right;
        height: calc(100vh - 53px);
        /*-webkit-transition: width .3s;*/
    }
    .newPorjectButton{
        margin-top: 20px;
    }
    .btn-new-project{
        background-color: #212121;
        color: #656565;
        border:2px solid #656565;
    }
    .btn-new-project:hover{
        background-color: #212121;
        color: #959595;
        border:2px solid #959595;
    }
</style>

<style>
    .sidenav-dropdown a{
        padding: 10px 40px;
    }
    .treemenu{
        width: 100%;
        margin-top: 20px;
        border-radius: 3px;
    }
    .treemenu ul{
        font-size: smaller;
        padding: 0;
    }
    .mrm, .mhm, .mam{
        margin-top: 10px;
        margin-right: 0;
    }
    .todo li{
        padding: 10px;
    }
    .sidenav-dropdown a{
        background: #212121;
    }

    .thrPage{
        padding: 5px 50px!important;
    }

    .todo-search-field::-moz-placeholder {
        color: #a3a3a3;
        opacity: 1;
        font-weight: 300;
    }
    .todo-search-field::-moz-placeholder {
        color: #a3a3a3;
        opacity: 1;
        font-weight: 300;
    }
    .todo-search-field:-ms-input-placeholder {
        color: #a3a3a3;
        font-weight: 300;
        opacity: 1;
    }
    .todo-search-field::-webkit-input-placeholder {
        color: #a3a3a3;
        opacity: 1;
        font-weight: 300;
    }
    .popover-title{
        margin-top: 0!important;
        margin-bottom: 0!important;
    }
    .popoverInput{
        margin-top: 5px;
    }

    .folder-function-plus:hover{
        display: inline-block;
        color: red;
    }

    .folder-function-plus{
        float:right;color: #212121;
    }

    /*.sidenav-menu a:hover .folder-function-plus{*/
        /*color: red;*/
    /*}*/

</style>

<div id="myMenu"></div>
<div class="container-fluid col-xs-12 pd0 clearfix" id="editor">

    <nav id="leftProjectList" data-sidenav data-sidenav-toggle="#sidenav-toggle" class="sidenav show" style="margin-top: 52px;width: 16.66667vw;height: calc(100vh - 52px)">
        <div id="inLeftProjectList" style="height: 100%">
            <div class="sidenav-header">
                <input :placeholder="'search in 技术人'" style="width: 100%;color: whitesmoke" class="todo-search-field" type="search" value="" >
            </div>

            <ul class="sidenav-menu">
                <li class="mainDirectory-li" v-for="mainDirectory in directory">
                    <a v-if="mainDirectory.type == 'folder'" data-sidenav-dropdown-toggle class="pointer">
                        <i class="fui-folder"></i>
                        {{ mainDirectory.name }}
                        <i class="fui-plus folder-function-plus"></i>
                    </a>
                    <ul v-if="mainDirectory.project != undefined" class="sidenav-dropdown" data-sidenav-dropdown>
                        <li v-for="subDirectory in mainDirectory.project" class="subDirectory-li">
                            <a v-if="subDirectory.type == 'folder'" data-sidenav-dropdown-toggle class="pointer"><i class="fui-folder"></i> {{ subDirectory.name }}</a>
                            <ul v-if="subDirectory.project != undefined" class="sidenav-dropdown" data-sidenav-dropdown>
                                <li class="thrDirectory-li" v-for="thrDirectory in subDirectory.project"><a class="pointer thrPage" style="font-size: small" >{{ thrDirectory.name}}</a></li>
                            </ul>
                            <a v-if="subDirectory.type == 'page'" @click="loadPage(subDirectory.paid)" class="pointer">{{ subDirectory.name }}</a>
                        </li>
                    </ul>
                    <a v-if="mainDirectory.type == 'page'" @click="loadPage(mainDirectory.paid)" class="pointer">{{ mainDirectory.name }}</a>
                </li>
            </ul>

            <div class="newPorjectButton col-xs-12 clearfix">
                <div class="col-xs-12">
                    <button @click="addNewPage" style="width: 100%" class="btn btn-new-project btn-sm"><i class="fui-new"></i> new page</button>
                </div>
                <div class="col-xs-12 " style="margin-top: 10px;padding-bottom: 20px">
                    <button style="width: 100%" class="btn btn-new-project btn-sm"><i class="fui-folder"></i> new folder</button>
                </div>
            </div>
        </div>
    </nav>


    <div id="rightEditor" :class="editorFull ? 'col-xs-12': 'col-xs-10'" class="pd0">
        <!--  功能按钮  -->
        <div class="topBar col-xs-12 pd0">
            <div class="col-xs-8 clearfix">
                <button id="sidenav-toggle" class="btn btn-primary toggle functionItem btn-middle-padding" @click="closeLeft">
                    {{ editorFull ? '展开文档列表' : '收起文档列表'}}
                </button>
<!--                <div style="display: inline-block;">-->
<!--                    <span v-text="pageTitle" v-show="previewMode"></span>-->
<!--                </div>-->
                <input id="pageTitle" style="width: 200px;" type="text" v-model="pageTitle" placeholder="文档名称" class="form-control topInput functionItem" />
            </div>

            <div class="col-xs-4 clearfix text-right">
                <span id="saving" style="display: none">saving complete</span>
<!--                <button @click="saveContent" class="btn btn-info btn-middle-padding functionItem">--><?//=lang('save')?><!--</button>-->
                <button v-show="!addingNewPage" @click="changePreviewMode" class="btn btn-info btn-middle-padding functionItem">{{ previewMode ? '编辑' : '预览' }}</button>
                <button v-show="addingNewPage" @click="createNewPage" class="btn btn-info btn-middle-padding functionItem">创建该文档</button>
            </div>

        </div>
        <!--  summernote editor  -->
        <div id="summernoteEditor" v-show="currentEditor == 'summernote'" class="col-xs-12 pd0">
            <div class="col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                    <div class="row">
                        <div :class="fullScreen ? 'editorFullScreen' : ''" class="col-xs-12 pd0 padding-middle" id="editor1" v-show="!previewMode">
                            <div id="summernote" ></div>
                        </div>
                        <div id="preView" v-show="previewMode" :class="previewMode ? 'col-md-12 padding-middle' : 'col-md-6'">
                            <div>
                                <p v-html="html1"></p>
                            </div>
                        </div>
                        <div class="col-xs-2" v-show="previewMode"></div>
                    </div>

                </div>
            </div>
        </div>
        <!--  md editor  -->
        <div id="mdeditor" v-show="currentEditor == 'mdeditor'">
            <div class="col-xs-12 clearfix">
                <div class="col-xs-6 pd0">
                    <div style="display: inline-block" class="dropdown mdfunction-button">
                        <button class="dropdown-toggle btn btn-white btn-xsm btn-middle-padding" data-toggle="dropdown">
                            编辑器风格
                        </button>
                        <ul class="dropdown-menu scroll-menu" style="max-height: 20vh;">
                            <li><a @click="setMdTheme('default')">默认</a></li>
                            <li><a @click="setMdTheme('dark')">黑色</a></li>
                        </ul>
                    </div>

                    <div style="display: inline-block" class="dropdown mdfunction-button">
                        <button class="dropdown-toggle btn btn-xsm btn-white btn-middle-padding" data-toggle="dropdown">
                            插入模板
                        </button>
                        <ul class="dropdown-menu scroll-menu" style="max-height: 20vh;">
                            <li><a href="#">api通用模板</a></li>
                            <li><a href="#">php post通用模板</a></li>
                            <li><a href="#">json格式模板</a></li>
                            <li><a href="#">api通用模板</a></li>
                            <li><a href="#">php post通用模板</a></li>
                            <li><a href="#">json格式模板</a></li>
                            <li><a href="#">api通用模板</a></li>
                            <li><a href="#">php post通用模板</a></li>
                            <li><a href="#">json格式模板</a></li>
                            <li><a href="#">api通用模板</a></li>
                            <li><a href="#">php post通用模板</a></li>
                            <li><a href="#">json格式模板</a></li>
                            <li class="divider"></li>
                            <li><a href="#">创建新模板</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="editormd" style=";width: 100%;" class="col-xs-12 pd0">
                <textarea style="display: none;">### Hello Lypton.doc !</textarea>
            </div>
        </div>
    </div>
</div>


<script src="<?=base_url('static/') ?>summernote/dist/summernote.js"></script>
<script src="<?=base_url('bower_components/');?>editor.md/editormd.min.js"></script>
<script type="text/javascript">

    mask_VM.show();
    var proid = <?=$proid;?>

    editor_VM = new Vue({
        el: '#editor',
        data: {

            // 编辑器html内容
            html1: '<?=lang('page_preview')?>',
            // markdown编辑器对象
            mdeditor: {},
            editors:['mdeditor','summernote'],
            currentEditor: 'summernote',
            // 预览模式
            previewMode : true,
            // h5编辑器全屏模式
            editorFull : false,
            // 收起左边菜单
            fullScreen : false,

            searchFocus : true,

            // 文章标题
            pageTitle : '',

            // paid
            paid : 0,

            directory : [],

            addingNewPage : false,
        },
        methods: {

            // 点击文件夹的加号
            showAddFunction : function(){
                alert('plus');
            },

            // 点击了新建文件夹
            creatingNewFolder : false,

            closeLeft : function(){
                var self = this;
                self.editorFull = !self.editorFull;
            },

            // 加载对应的文档
            loadPage : function(paid){

                var self = this;

                NProgress.start();

                $.ajax({
                    url: '/?/api/page/get/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        paid : paid
                    },
                    success: function (result, textStatus) {
                        self.paid = paid;
                        self.pageTitle = result.data.title
                        self.html1 = result.data.html;
                        $('#summernote').summernote('code',self.html1);
                        NProgress.done();
                    }
                })
            },

            changePreviewMode : function () {
                this.previewMode = !this.previewMode;

                // 如果切换回了预览模式，保存文档
                if(this.previewMode){
                    this.saveContent();
                }

            },

            getInitStr: function () {
                var self = this;
                $.ajax({
                    url: '/api/api/randomStr/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        len: 4
                    },
                    success: function (result, textStatus) {
                        self.message = result.data;
                        console.log(result.data);
                    }
                })
            },

            getFontSize: function () {
                var range = $('#summernote').summernote('createRange');

                console.log(range);
            },

            publish: function () {

                alert('即将发布');

                var self = this;

                $.ajax({
                    url: '/api/api/publish/',
                    type: 'post',
                    timeout: 3000,
                    dataType: 'json',
                    data: {
                        content: self.html1
                    },
                    success: function (result, textStatus) {

                        if (result.code == 1) {
                            alert('保存成功');
                        }
                        if (result.code == -1) {
                            alert(result.msg);
                        }

                    }
                });
            },

            createSocket: function () {
                var self = this;
                self.ws = new WebSocket('ws://127.0.0.1:1234');
                self.socketData.connected = true;
                self.ws.onmessage = function (e) {
                    var data = json_decode(e.data);
                    switch (data.type) {
                        case "userConnect" :
                            self.socketData.uid = data.data;
                            break;
                    }
                };
                self.ws.onclose = function () {
                    self.socketData.connected = false;
                }
            },

            setMdTheme : function (themeName) {
                var self = this;

//                self.mdeditor.setTheme(themeName);
                self.mdeditor.setPreviewTheme(themeName);
//
                switch (themeName){
                    case 'dark' :
                        self.mdeditor.setEditorTheme('monokai');
                        break;
                    case "default" :
                        self.mdeditor.setEditorTheme('default');
                        break;
                }


            },

            changeEditor : function (editor) {
                var self = this;
                self.currentEditor = editor;
            },

            // 保存文档内容
            saveContent : function(){
                var self = this;
                $.ajax({
                    url: '/?/api/page/update/',
                    type: 'post',
                    timeout: 3000,
                    dataType: 'json',
                    data: {
                        content: 'the value is not useable',
                        paid : self.paid,
                        title : self.pageTitle,
                        htmlContent : self.html1,
                    },
                    success: function (result, textStatus) {
                        if (result.code == 1) {

                            // 更新目录
                            self.getDirectory(proid);

                            $("#saving").fadeIn();
                            setTimeout(function(){$("#saving").fadeOut()},1500);
                        }
                        if (result.code == -1) {
                            alert(result.msg);
                        }

                    }
                });
            },

            getContent : function(){
                var self = this;
                $.ajax({
                    url: '/?/api/page/get/',
                    type: 'post',
                    timeout: 3000,
                    dataType: 'json',
                    data: {},
                    success: function (result, textStatus) {

                        self.html1 = result.data;
                        $('#summernote').summernote('code',self.html1);
                    }
                });
            },

            // 获取proid项目的目录结构
            getDirectory : function(proid){
                var self = this;
                $.ajax({
                    url: '/?/api/user/directory/',
                    type: 'post',
                    timeout: 3000,
                    dataType: 'json',
                    data: {
                        proid : proid
                    },
                    success: function (result, textStatus) {

                        self.directory = result.data;
                    }
                });
            },

            // 新建文件夹
            newFolder : function (folderName,parentFid) {
                console.log(folderName);return 0;
                $.ajax({
                    data: {
                        pid : proid,
                        parentFid : parentFid,
                        folderName : folderName,
                    },
                    type: "POST",
                    url: '/?/api/folder/create',
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        console.log(result);
                        if (result.code == -1) {
                            alert(result.msg);
                        }
                        if (result.code == 1) {

                        }

                    }
                });
            },

            fullScreenEditor : function () {
                var self = this;
                self.fullScreen = !self.fullScreen;
            },

            // 点击了添加新的页面
            addNewPage : function()
            {
                var self = this;

                // 添加新页面模式

                self.addingNewPage = true;

                // 清空文本区内容
                self.pageTitle = '';
                self.html1 = '您即将创建一篇新的页面';
                $('#summernote').summernote('code',self.html1);

                // 关闭编辑模式
                self.previewMode = true;

                // 输入框聚焦
                $("#pageTitle").focus();

            },

            // 请求创建新的页面
            createNewPage : function(){
                var self = this;

                console.log(proid)
                console.log(self.html1)


                if(!self.pageTitle){
                    alert('标题不能为空');return;
                }
                $.ajax({
                    data: {
                        proid : proid,
                        htmlContent : self.html1,
                        content : '',
                        title : self.pageTitle,
                    },
                    type: "POST",
                    url: '/?/api/page/create/',
                    cache: false,
                    dataType: 'json',
                    success: function (result) {
                        if (result.code == -1) {
                            alert(result.msg);
                        }
                        if (result.code == 1) {
                            self.directory = result.data.directory;
                            self.paid = result.data.paid
                        }
                        self.addingNewPage = false;

                    }
                });
            }

        },
    });

    // 获取项目目录列表

    editor_VM.getDirectory(proid);

    function setMdEditor(){
        editor_VM.mdeditor = editormd("editormd", {
//            autoHeight : true,
            height : 'calc(100vh - 168px)',
            saveHTMLToTextarea : true,
            // Editor.md theme, default or dark, change at v1.5.0
            // You can also custom css class .editormd-theme-xxxx
            theme : "default",
            // Preview container theme, added v1.5.0
            // You can also custom css class .editormd-preview-theme-xxxx
            previewTheme : "dark",
            // Added @v1.5.0 & after version this is CodeMirror (editor area) theme
            editorTheme : 'base16-dark',
            path : "<?=base_url('bower_components/');?>editor.md/lib/" // Autoload modules mode, codemirror, marked... dependents libs path
        });
    }

    $(document).ready(function () {
//        alert('开始执行js')
        $('#preView').niceScroll({
            cursorcolor: "#ccc",//#CC0071 光标颜色
            cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
            touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
            cursorwidth: "5px", //像素光标的宽度
            cursorborder: "0", //     游标边框css定义
            cursorborderradius: "5px",//以像素为光标边界半径
            autohidemode: true, //是否隐藏滚动条
            smoothscroll: true,
            scrollspeed: 0,
        });
        $('#inLeftProjectList').niceScroll({
            cursorcolor: "#ccc",//#CC0071 光标颜色
            cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
            touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
            cursorwidth: "5px", //像素光标的宽度
            cursorborder: "0", //     游标边框css定义
            cursorborderradius: "5px",//以像素为光标边界半径
            autohidemode: true, //是否隐藏滚动条
            smoothscroll: true,
            scrollspeed: 0,
        });
        var fullScreenButton = function (context) {
            var ui = $.summernote.ui;

            // create button
            var button = ui.button({
                contents: '<i class="fa fui-resize"/>',
                tooltip: 'full screen',
                click: function () {
                    // invoke insertText method with 'hello' on editor module.
                    editor_VM.fullScreenEditor();
                }
            });

            return button.render();   // return button as jquery object
        }
        $('#summernote').summernote({

            height: 'calc(100vh - 208px)',                 // set editor height
            minHeight: 'calc(100vh - 208px)',             // set minimum height of editor
            maxHeight: 'calc(100vh - 208px)',             // set maximum height of editor
            focus: true,                  // set focus to editable area after initializing summernote
            // airMode: true,

            buttons: {
                fullScreen: fullScreenButton,
            },

            toolbar: [
                // [groupName, [list of button]]
                ['style1', ['bold']],
                ['style4', ['superscript']],
                ['style5', ['code']],
                ['style2', ['italic']],
                ['style3', ['underline']],
                ['style',['style']],
                ['fontsize', ['fontname']],
//                ['fontsize', ['fontsize']],
                ['para2', ['ul']],
                ['para3', ['ol']],
//            ['insert1',['picture']],
                ['insert2',['link']],
//            ['insert3',['video']],
//                ['misc',['fullscreen']],
//                ['misc',['codeview']],
//            ['misc',['undo']],
//            ['misc',['redo']],
//            ['misc',['help']],
                ['mybutton', ['fullScreen']],

            ],

            callbacks: {
                onInit: function () {
//                    console.log('Summernote is launched');
                },

                onEnter: function () {
//                    console.log('Enter/Return key pressed');
                },

                onFocus: function () {
//                    console.log('Editable area is focused');
                },

                onBlur: function () {
//                    console.log('Editable area loses focus');
                },

                onKeyup: function (e) {
//                    console.log('Key is released:', e.keyCode);
                },

                onKeydown: function (e) {
//                    console.log('Key is downed:', e.keyCode);
                },

                onPaste: function (e) {
//                    console.log('Called event paste');
                },

                // upload image when image is selected
                onImageUpload: function (files) {

                    var file = files[0];

                    data = new FormData();
                    data.append("aws_upload_file", file);
                    console.log(data);
                    $.ajax({
                        data: data,
                        type: "POST",
                        url: '/api/api/upload_img',
                        cache: false,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            console.log(result);

                            if (result.code == -1) {
                                alert(result.msg);
                            }
                            if (result.code == 1) {
                                $("#summernote").summernote('insertImage', result.data, 'image name'); // the insertImage API
                            }

                        }
                    });

                },

                onChange: function (contents, $editable) {
//                console.log('onChange:', contents, $editable);

                    editor_VM.html1 = $('#summernote').summernote('code');
//
                }
            }
        });
        $('.note-editable').niceScroll({
            cursorcolor: "#ccc",//#CC0071 光标颜色
            cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
            touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
            cursorwidth: "5px", //像素光标的宽度
            cursorborder: "0", //     游标边框css定义
            cursorborderradius: "5px",//以像素为光标边界半径
            autohidemode: true, //是否隐藏滚动条
            smoothscroll: true,
            scrollspeed: 0,
        });
        $('.scroll-menu').niceScroll({
            cursorcolor: "#ccc",//#CC0071 光标颜色
            cursoropacitymax: 1, //改变不透明度非常光标处于活动状态（scrollabar“可见”状态），范围从1到0
            touchbehavior: false, //使光标拖动滚动像在台式电脑触摸设备
            cursorwidth: "5px", //像素光标的宽度
            cursorborder: "0", //     游标边框css定义
            cursorborderradius: "5px",//以像素为光标边界半径
            autohidemode: true, //是否隐藏滚动条
            smoothscroll: true,
            scrollspeed: 0,
        });
        if ($('[data-toggle="switch"]').length) {
            $('[data-toggle="switch"]').bootstrapSwitch({
                onText: '开启',
            });
        }
        $("[data-toggle='popover']").popover({
            html : true,
            trigger : 'click',
        });
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        $('[data-sidenav]').sidenav();
//        alert('结束执行js')
        setTimeout(function(){mask_VM.hide();},800);
    })

    // is there any content in the cookie ?

</script>


<!--<script type="text/javascript" src="--><? //=G_STATIC_URL?><!--js/api/index.js?time=--><? //=time()?><!--"></script>-->
