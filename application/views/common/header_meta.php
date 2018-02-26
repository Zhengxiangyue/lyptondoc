<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<?php define('G_STATIC_URL',base_url().'static/')?>
<!--<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">-->

<!-- common css -->
<link href="<?=G_STATIC_URL?>css/common/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?=G_STATIC_URL?>css/common/global.css" rel="stylesheet" />

<link href="<?=G_STATIC_URL?>font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="<?=G_STATIC_URL?>css/common/nprogress.css" rel="stylesheet" />

<link rel="shortcut icon" type="image/ico" href="<?=G_STATIC_URL?>img/favicon.ico?ti=a">

<!--flat ui-->
<link href="<?=base_url()?>static/flatUI/dist/css/flat-ui.css" rel="stylesheet" />


<script src="<?=G_STATIC_URL?>js/common/jquery.js"></script>

<script src="<?=G_STATIC_URL?>js/common/application.js"></script>
<!-- common js -->
<script src="<?=G_STATIC_URL?>js/common/bootstrap.min.js"></script>

<script src="<?=G_STATIC_URL?>js/common/vue.js"></script>
<script src="<?=G_STATIC_URL?>js/common/vue_helper.js"></script>

<script src="<?=G_STATIC_URL?>js/common/nprogress.js"></script>
<script src="<?=G_STATIC_URL?>js/common/js_helper.js"></script>
<script src="<?=G_STATIC_URL?>js/common/jquery.nicescroll.js"></script>
<script src="<?=G_STATIC_URL?>js/common/jsencrypt.js"></script>



<style>
    body{
        color: #999;
        font-family: "Open Sans","lucida grande","Segoe UI",arial,verdana,"lucida sans unicode",tahoma,sans-serif;
        overflow-y: hidden;
    }
    a{
        font-weight: 300;
    }
    .navbar-nav > li > a,.navbar-brand{
        font-weight: 400;
    }
    .row20 {
        margin-top: 20px;
    }
    .vertical-center{
        top: 50%;
        transform: translate(0, -50%);
        -moz-transform:translate(0, -50%);
        -webkit-transform: translate(0, -50%);
        -o-transform: translate(0, -50%);
        -ms-transform: translate(0, -50%);
    }
    .navbar-form{
        height: 49px;
    }

</style>

<script>
    NProgress.configure(
        {
            parent: '#mainContent',
            showSpinner: true,
        }
    );
    function json_decode(str) {
        return JSON.parse(str);
    }
</script>

<body>