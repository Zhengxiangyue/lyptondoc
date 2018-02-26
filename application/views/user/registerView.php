<style>
    #hint-message{
        color: red;
        text-align: right;
    }
</style>

<div id="register" class="col-xs-12 pd0" style="margin-top: 50px">
    <div class="col-xs-4"></div>

    <div class="col-xs-4">
        <!--        <div class="login-icon">-->
        <!--            <img src="--><?//=base_url()?><!--/static/flatUI/img/login/icon.png" alt="Welcome to Mail App" />-->
        <!--            <h4>Welcome to <small>Mail App</small></h4>-->
        <!--        </div>-->

        <div class="login-form">

            <div class="form-group">
                <input v-model="email" type="text" class="form-control login-field" placeholder="Enter your email" id="login-email" />
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
                <input v-model="userName" type="text" class="form-control login-field" value="" placeholder="Enter your nickname" id="login-name" />
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group">
                <input @keyup.13="registerAction" v-model="password" type="password" class="form-control login-field" placeholder="Password" id="login-password" />
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <div class="form-group">
                <input @keyup.13="registerAction" v-model="confirm" type="password" class="form-control login-field" placeholder="Confirm password" id="login-confirm" />
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>

            <a class="btn btn-primary btn-lg btn-block" @click="registerAction">create account</a>
        </div>
        <div id="hint-message" style="display: none">
            <span v-text="hintMessage" ></span>
        </div>
    </div>
</div>



<script>
    login_VM = new Vue({
        el : "#register",
        data : {
            userName : '',
            password : '',
            confirm : '',
            email : '',
            hintMessage : '',
            timeoutId : null,
        },
        methods : {
            registerAction : function(){
                var self = this;

                // 没有填写邮箱

                if(self.email == '')
                {
                    self.hintMessage = 'please input your email';
                    $("#hint-message").fadeIn();
                    $("#login-email").focus();
                    clearTimeout(self.timeoutId);
                    self.timeoutId = setTimeout(function(){$("#hint-message").fadeOut();},3000)
                    return 0;
                }

                // 没有填写用户名

                if(self.userName == '')
                {
                    self.hintMessage = 'please input your nickname';
                    $("#hint-message").fadeIn();
                    $("#login-name").focus();
                    clearTimeout(self.timeoutId);
                    self.timeoutId = setTimeout(function(){$("#hint-message").fadeOut();},3000)
                    return 0;
                }

                if(self.password == '')
                {
                    self.hintMessage = 'please input your password';
                    $("#hint-message").fadeIn();
                    $("#login-password").focus();
                    clearTimeout(self.timeoutId);
                    self.timeoutId = setTimeout(function(){$("#hint-message").fadeOut();},3000)
                    return 0;
                }

                if(self.confirm != self.password)
                {
                    self.hintMessage = "password don't match";
                    $("#hint-message").fadeIn();
                    $("#login-confirm").focus();
                    clearTimeout(self.timeoutId);
                    self.timeoutId = setTimeout(function(){$("#hint-message").fadeOut();},3000)
                    return 0;
                }

                var encrypt = new JSEncrypt();
                encrypt.setPublicKey(public_key)

                $.ajax({
                    url: '/?/api/user/register/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        userName: self.userName,
                        password: encrypt.encrypt(self.password),
                        email : self.email,
                    },
                    success: function (result, textStatus) {
                        if(result.code == 1)
                        {
                            self.message = result.data;
//                            app.getUserInfo();
                            alert('good');
//                            app.lajax('lajax/project','lists')
                        }else{
                            alert(retult.msg);
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
