<div id="login" class="col-xs-12 pd0" style="margin-top: 50px">
    <div class="col-xs-4"></div>

    <div class="col-xs-4">
<!--        <div class="login-icon">-->
<!--            <img src="--><?//=base_url()?><!--/static/flatUI/img/login/icon.png" alt="Welcome to Mail App" />-->
<!--            <h4>Welcome to <small>Mail App</small></h4>-->
<!--        </div>-->

        <div class="login-form">

            <div class="form-group">
                <input v-model="email" type="text" class="form-control login-field" value="" placeholder="Enter your email" id="login-name" />
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
                <input @keyup.13="loginAction" v-model="password" type="password" class="form-control login-field" placeholder="Password" id="login-pass" />
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <a class="btn btn-primary btn-lg btn-block" @click="loginAction">Log in</a>
            <a class="login-link" href="#">Lost your password?</a>
        </div>
    </div>
</div>



<script>
    login_VM = new Vue({
        el : "#login",
        data : {
            userName : '',
            password : '',
            email : '',
        },
        methods : {
            loginAction : function(){
                var self = this;

                var encrypt = new JSEncrypt();
                encrypt.setPublicKey(public_key)

                $.ajax({
                    url: '/?/api/user/login/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
//                        userName: self.userName,
                        password: encrypt.encrypt(self.password),
                        email : self.email,
                    },
                    success: function (result, textStatus) {
                        if(result.code == 1)
                        {
                            self.message = result.data;
                            app.getUserInfo();
                            app.lajax('lajax/project','lists')
                        }else{
                            alert(result.msg);
                        }

                        console.log(result.data);
                    },
                    error : function(result){

                    }
                })
            }
        }
    })
</script>
