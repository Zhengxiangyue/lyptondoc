
<style>
    #top-menu{
        position: fixed; left: 0; right: 0; top: 0;
        z-index: 99999;
    }
</style>

<div class="row demo-row" id="top-menu" style="width: 100%;margin: 0">
    <div class="col-xs-12 pd0">
        <nav class="navbar-inverse navbar-embossed" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a @click="lajax('lajax/index','index')" class="navbar-brand pointer"><?=lang('front_title');?></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-01">
                <ul class="nav navbar-nav navbar-left">
                    <li><a class="pointer" @click="lajax('lajax/project','lists')">My Project</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Messages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a >Action</a></li>
                            <li><a>Another action</a></li>
                            <li><a >Something else here</a></li>
                            <li class="divider"></li>
                            <li><a>Separated link</a></li>
                        </ul>
                    </li>
<!--                    <li><a class="pointer" @click="lajax('welcome','editor')">Editor</a></li>-->
<!--                    <li><a class="toggle pointer">open menu</a></li>-->
                </ul>

                <div class="navbar-form navbar-right" role="search">
                    <div class="form-group" v-if="uid == null">
<!--                        <img src="--><?//=base_url('static')?><!--/img/logo.png" class="img-circle" />-->
<!--                        <div class="input-group">-->
<!--                            <input class="form-control" id="navbarInput-01" type="search" placeholder="Search">-->
<!--                            <span class="input-group-btn">-->
<!--                                    <button type="submit" class="btn"><span class="fui-search"></span></button>-->
<!--                                </span>-->
<!--                        </div>-->
                            <button @click="lajax('lajax/user','login')" class="btn btn-info">Log In</button>
                            <a @click="lajax('lajax/user','register')" class="pointer" style="color: white;margin-left: 10px;font-size: 13px">Sign Up</a>
                    </div>
                    <div class="form-group" v-else>
                        <a class="pointer" style="color: white;margin-left: 10px;font-size: 13px">{{ userInfo.userName }}</a>
                        <a @click="logoutAction" class="pointer" style="color: white;margin-left: 10px;font-size: 13px">Log out</a>
                    </div>
                </div>
            </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
    </div>
</div> <!-- /row -->

<script>
    top_menu_VM = new Vue({
        el : "#top-menu",
        data : {},
        computed : {
            uid : function(){
                return app.uid;
            },
            userInfo : function(){
                return app.userInfo;
            }
        },
        methods : {
            lajax : app.lajax,
            logoutAction : function(){
                var self = this;
                $.ajax({
                    url: "/?/api/user/logout",
                    type: "POST",
                    async: true,
                    data : {},
                    dataType: 'json',
                    timeout : 7000,
                    // 请求数据成功了
                    success: function (result) {
                        app.getUserInfo();
                        self.lajax('lajax/user','login');
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
        }
    });
</script>