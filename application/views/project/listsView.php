
<style>
    .row-middle{
        margin-left: auto;
        margin-right: auto;
        width: 60%;
    }
    .tile{
        background-color: #ecf0f5;
        /*height: 500px;*/
        /*overflow-y: scroll;*/
    }
    .tile h3{
        height: 80px;
        overflow: hidden;
        overflow-wrap: normal;
        margin-bottom: 10px;
    }

    .new-project{
        position:fixed;
        margin:auto;
        left:0;
        right:0;
        top:20vh;
        width:66vw;
        height: 40vh;
        border: 1px solid #34495E;
        border-radius: 5px;
        background-color: #ECF0F1;
    }

    #new-project{
        height:calc(100vh - 73px );
        overflow-y: scroll;
        padding-left: calc((100vw - 930px)/2);
        padding-right: calc((100vw - 930px)/2);
    }

</style>

<div id="new-project" class="row20 ">

    <div style="text-align: center">
        <button class="btn btn-lg btn-info" @click="addProject">创建新项目</button>
    </div>

    <div class="row20 col-xs-12">
        <div class="col-xs-3" v-for="project in projectList">
            <div class="tile">
                <img src="<?=base_url()?>/static/flatUI/img/icons/svg/compas.svg" alt="Compas" class="tile-image big-illustration">
                <h3 class="tile-title" v-text="project.projectName"></h3>
                <a @click="openProject(project.proid)" class="btn btn-primary btn-large btn-block">Get Pro</a>
            </div>
        </div>

        <div class="col-xs-3" id="add-new-project" style="display: none">
            <div class="tile">
                <img src="<?=base_url()?>/static/flatUI/img/icons/svg/compas.svg" alt="Compas" class="tile-image big-illustration">
                <input @keyup.13="createNewProject" v-model="newProjectName" id="addNewProject" class="form-control" />
            </div>
        </div>
    </div> <!-- /tiles -->
</div>

<script>

    list_VM = new Vue({
        el : "#new-project",
        data : {
            projectList : [],
            showAddProect : false,
            newProjectName : '',
        },

        methods : {
            lajax : app.lajax,
            getProjectList : function(){
                var self = this;
                $.ajax({
                    url: '/?/api/project/get/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    success: function (result, textStatus) {
                        if(result.code == 1){
                            self.projectList = result.data;
                        }else{
                            alert(result.msg)
                        }
                    }
                })
            },
            openProject : function(proid){
                var self = this;
                mask_VM.show();
                self.lajax('welcome','editor?proid=' + proid);
            },
            addProject : function(){
                $("#add-new-project").fadeIn()
                setTimeout(function(){$("#addNewProject").focus();},300)
            },
            createNewProject : function()
            {
                var self = this;
                if(!self.newProjectName)
                {
                    return 0;
                }
                $.ajax({
                    url: '/?/api/project/create/',
                    type: 'post',
                    timeout: 3000,
                    data: {
                        projectName : self.newProjectName,
                        privacy : 0,
                    },
                    async: true,
                    cache: false,
                    dataType: 'json',
                    success: function (result, textStatus) {
                        if(result.code == 1){
                            self.projectList = result.data;
                            self.newProjectName = '';
                            $("#add-new-project").css('display','none');
                        }else{
                            alert(result.msg)
                        }
                    }
                })
            }
        },
    });

    list_VM.getProjectList();

    $(document).ready(function(){
//        alert('here');
        $('#new-project').niceScroll({
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
    })

</script>

