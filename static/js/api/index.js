/**
 * Created by Cancel on 5/2/2017.
 */

//HelloButton按钮
var HelloButton = function (context) {
    var ui = $.summernote.ui;

    // create button
    var button = ui.button({
        contents: 'hello',
        tooltip: 'hello',
        click: function () {
            // invoke insertText method with 'hello' on editor module.
            context.invoke('editor.insertText', 'hello');
        }
    });
    // note-btn btn btn-default btn-sm dropdown-toggle
    // note-btn btn btn-default btn-sm note-current-color-button
    return button.render();   // return button as jquery object
};

$('#summernote').summernote({

    height: 300,                 // set editor height
    minHeight: 300,             // set minimum height of editor
    maxHeight: 300,             // set maximum height of editor
    focus: true,                  // set focus to editable area after initializing summernote
    // airMode: true,

    toolbar: [
        // [groupName, [list of button]]
        ['style1', ['bold']],
        ['style4', ['superscript']],
        ['style5', ['code']],
        ['style2', ['italic']],
        ['style3', ['underline']],
        ['fontsize', ['fontname']],
        ['fontsize', ['fontsize']],
        ['fontsize', ['hello']],
        ['para2', ['ul']],
        ['para3', ['ol']],
        ['insert1',['picture']],
        ['insert2',['link']],
        ['insert3',['video']],
        ['misc',['fullscreen']],
        ['misc',['codeview']],
        ['misc',['undo']],
        ['misc',['redo']],
        ['misc',['help']],
    ],

    buttons: {
        hello: HelloButton
    },

    callbacks: {
        onInit: function() {
            console.log('Summernote is launched');
        },

        onEnter: function() {
            console.log('Enter/Return key pressed');
        },

        onFocus: function() {
            console.log('Editable area is focused');
        },

        onBlur: function() {
            console.log('Editable area loses focus');
        },

        onKeyup: function(e) {
            console.log('Key is released:', e.keyCode);
        },

        onKeydown: function(e) {
            console.log('Key is downed:', e.keyCode);
        },

        onPaste: function(e) {
            console.log('Called event paste');
        },

        // upload image when image is selected
        onImageUpload: function(files) {

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
                success: function(result) {
                    console.log(result);

                    if(result.code == -1){
                        alert(result.msg);
                    }
                    if(result.code == 1){
                        $("#summernote").summernote('insertImage', result.data, 'image name'); // the insertImage API
                    }

                }
            });

        },


        onChange: function(contents, $editable) {
            console.log('onChange:', contents, $editable);
            app.html1 = $('#summernote').summernote('code');

        }
    }
});

app = new Vue({
    el: '#editor',
    data: {
        html1 : '<?=$two?>',
        ws : {},
        socketData : {
            uid : 'inituid',
            connected : false,
        }
    },
    methods : {

        getInitStr : function(){
            var self = this;
            $.ajax({
                url : '/api/api/randomStr/',
                type : 'post',
                timeout : 3000,
                async : true,
                cache : false,
                dataType : 'json',
                data : {
                    len : 4
                },
                success : function(result,textStatus){
                    self.message = result.data;
                    console.log(result.data);
                }
            })
        },

        publish : function () {

            alert('即将发布');

            var self = this;

            $.ajax({
                url : '/api/api/publish/',
                type : 'post',
                timeout : 3000,
                dataType : 'json',
                data : {
                    content : self.html1
                },
                success : function(result,textStatus){

                    if(result.code == 1){
                        alert('保存成功');
                    }
                    if(result.code == -1){
                        alert(result.msg);
                    }

                }
            })
        },

        createSocket : function () {
            var self = this;
            self.ws = new WebSocket('ws://127.0.0.1:1234');
            self.socketData.connected = true;
            self.ws.onmessage = function(e){
                var data = json_decode(e.data);
                switch (data.type){
                    case "userConnect" : self.socketData.uid = data.data;
                    break;
                }
            };
            self.ws.onclose = function () {
                self.socketData.connected = false;
            }
        }

    },
    computed : {
    }
});


function create(){
    new WebSocket('ws://127.0.0.1:1234?user=abc&token=3ackj');
}

// create();



