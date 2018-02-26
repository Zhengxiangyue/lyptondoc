<div id="welcome" class="col-ld-12" style="text-align: center">
    <p>这个是welcome show_message的view</p>
    <p>这个是welcome show_message的view</p>
    <p>这个是welcome show_message的view</p>
    <p>这个是welcome show_message的view</p>
    <p>这个是welcome show_message的view</p>
    <p>这个是welcome show_message的view</p>
    <span @click="lajax('welcome','index')">点击点击</span>
</div>
<script>
    welcome_VM = new Vue({
        el : "#welcome",
        data : {

        },
        methods : {
            lajax : app.lajax,
            lajaxUrl : app.lajaxUrl,
        }
    })
</script>