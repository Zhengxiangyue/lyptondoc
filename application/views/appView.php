<?php $this->load->view('common/header_meta')?>
<style>
    .pointer{
        cursor: pointer;
    }
    .pointer:hover{
        text-decoration: none;
    }
    .vertical-center{
        top: 50%;
        /*-webkit-transform: translateY(-50%);*/
        /*-moz-transform:  translateY(-50%);*/
        /*-ms-transform:  translateY(-50%);*/
        /*-o-transform:  translateY(-50%);*/
        /*transform:  translateY(-50%);*/
    }
    .top-bar{
        padding: 20px;
    }

    body,html{
        padding: 0;
        margin: 0;
    }

    .pd0{
        padding: 0;
    }

    .navbar-collapse .navbar-nav.navbar-left:first-child{
        margin-left: 0;
    }

    .mainContent{
        margin-top: 51px;
    }
</style>
<div v-show="startApp" id="appControl" class="col-lg-12 clearfix " style="z-index:3;"></div>
<!-- load top menu -->
<script src="<?=G_STATIC_URL?>js/app/appControl.js?time=<?=time()?>"></script>

<?php $this->load->view('global/topMenuView')?>

<?php $this->load->view('global/leftMenuView')?>

<?php $this->load->view('common/mask')?>

<div class="col-sm-12 pd0">
<!-- app main content -->
    <div id="mainContent" class="col-lg-12 pd0 clearfix mainContent" style="z-index: 1;"></div>
</div>

<script>

    var historyController = getCookie('controller');
    var historyMethod = getCookie('method');
    var historyUrl = getCookie('url');


    if(historyController != '' && historyMethod != '') {
        app.lajax(historyController,historyMethod);
    }else if(historyUrl != ''){
        app.lajaxUrl(historyUrl)
    }else{
        app.lajax('welcome','index')
    }

    $(document).ready(function(){
        app.startApp = true;
    })
</script>

<?php $this->load->view('common/footer')?>

