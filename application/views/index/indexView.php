
<style>
    .indexWords{
        padding-top: 0vh;
        text-align: center;
        font-size: 5vh;
        background-color: whitesmoke;
        height: calc(100vh - 54px);
    }

    #indexPage{
        height: calc(100vh - 54px);
        overflow-y: scroll
    }
    .section { text-align: center;
        font-size: 50px; color: #000000;}

    .section1 {
        background-image: url(<?=base_url('static/img')?>/2bg.jpg);
        background-size: 100% 100%;
    }

    .section2{

        background-color: whitesmoke;
        background-size: 100% 100%;
    }
</style>

<script src="<?=base_url('static/js/common')?>/jquery.fullPage.js"></script>

<script>
    $(document).ready(function () {
        $('#dowebok').fullpage({
            navigation: true,
            sectionsColor: ['whitesmoke', '#aaaaaa', ]
        });

    })
</script>

<div id="dowebok">
    <div class="section">
        <div>
            <button class="btn btn-info">Create Your Own Doc</button>
        </div>
    </div>

    <div class=" section">
        <div>this is the one</div>
        <div>this is the one</div>
        <div>this is the one</div>
    </div>

</div>