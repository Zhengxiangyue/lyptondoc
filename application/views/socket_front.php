<?php require_once "common/header_meta.php";?>

<div class="container-fluid" id="socketFront">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">

                    <div class="jumbotron">
                        <div class="col-md-7">
                            <p>
                                SOCKET 测试平台 （当前用户状态 : <span data-bind="text:userStatus,style:{color: userStatus() == '在线' ? 'green' : 'red' }"></span>）
                            </p>
                        </div>

                        <div class="col-md-5 text-right">

                            <div class="col-md-8">
                                <input data-bind="textInput:userName" type="text" class="form-control" />
                            </div>

                            <div class="col-md-4">
                                <a class="btn btn-primary btn-large" data-bind="click:setUserName">设置姓名</a>
                            </div>
                        </div>

                        <p><input data-bind="textInput:inputMessage,event:{keyup:pressKey}" type="text" class="form-control" /></p>
                        <p><a class="btn btn-primary btn-large" data-bind="click:sendMessage">发送</a></p>

                        <div  data-bind="foreach:message">
                            <p data-bind="text:$data"></p>
                        </div>
                    </div>

                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    var Socket = new WebSocket("ws://127.0.0.1:1234");

    socket_front_VM = new Vue({
        el : "#socketFront",
        data : {
            inputMessage : '',
            userStatus : '离线',
            userName : '路人',
        },
        methods : {

            // 给所有人发送消息

            boardCastMessage : function () {
                var self = this;
                $.ajax({
                    url: '/?/api/communicate/get/',
                    type: 'post',
                    timeout: 3000,
                    async: true,
                    cache: false,
                    dataType: 'json',
                    data: {
                        paid : paid
                    },
                    success: function (result, textStatus) {

                    }
                })
            },
        }
    });

    Socket.onopen = function () {

        var data = {
            'type' : 'create_user',
            'user_name' : socket_front_VM.userName(),
        }

        var returnData = objToJson(data);

        Socket.send(returnData);
        socket_front_VM.userStatus('在线');
    };
    
    Socket.onmessage = function (event) {

        returnObj = jsonToObj(event.data);

        socket_front_VM.message.push(returnObj.user + ":" + returnObj.data + "  " + returnObj.time);
    };
    
    Socket.onclose = function (event) {
        socket_front_VM.userStatus('离线');
    };

    Socket.onerror = function (event) {

    }
    

</script>

<script type="text/javascript">

</script>