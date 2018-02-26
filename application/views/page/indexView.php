<div id="rightEidtor" :class="editorFull ? 'col-xs-12' : 'col-xs-10'" class="pd0">
    <!--  功能按钮  -->
    <div class="topBar col-xs-12 pd0">
        <div class="col-xs-8 clearfix">
            <button class="btn btn-primary functionItem btn-middle-padding" @click="closeLeft">返回文档列表</button>
            <button @click="saveContent" class="btn btn-info btn-middle-padding functionItem">保存</button>
            <input style="width: 200px;" type="text" placeholder="文档名称" class="form-control topInput functionItem" />

            <li class="dropdown">
                <button href="#" class="dropdown-toggle btn-middle-padding btn btn-white" data-toggle="dropdown">
                    {{ parentDirectory }}
                    <b class="caret"></b></button>
                <ul class="dropdown-menu">
                    <li v-for="item in directoryList"><a class="pointer" @click="selectDropdown('parentDirectory',item)" v-text="item"></a></li>
                    <li><a class="pointer" @click="selectDropdown('parentDirectory','2')">2</a></li>
                    <li><a class="pointer" @click="selectDropdown('parentDirectory','3')">3</a></li>
                    <li class="divider" ></li>
                    <li><a href="#">创建目录</a></li>

                </ul>
            </li>
        </div>

        <div class="col-xs-4 clearfix text-right">
            <li class="dropdown">
                <button href="#" class="dropdown-toggle btn-middle-padding btn btn-white" data-toggle="dropdown">
                    {{ parentDirectory }}
                    <b class="caret"></b></button>
                <ul class="dropdown-menu">
                    <li v-for="item in directoryList"><a class="pointer" @click="selectDropdown('parentDirectory',item)" v-text="item"></a></li>
                    <li><a class="pointer" @click="selectDropdown('parentDirectory','2')">2</a></li>
                    <li><a class="pointer" @click="selectDropdown('parentDirectory','3')">3</a></li>
                    <li class="divider" ></li>
                    <li><a href="#">创建目录</a></li>

                </ul>
            </li>
            <button @click="previewMode" class="btn btn-info btn-middle-padding functionItem">预览模式</button>
        </div>

    </div>
    <!--  summernote editor  -->
    <div id="summernoteEditor" v-show="currentEditor == 'summernote'" class="col-xs-12 row20">

        <div class="col-xs-12 pd0">
            <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                <div class="col-md-6 col-xs-12 pd0" id="editor1">
                    <div id="summernote" ></div>
                </div>
                <div class="col-md-6 pd0">
                    <div class="" style="padding: 10px;overflow: scroll;">
                        <p v-html="html1"></p>
                    </div>
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
