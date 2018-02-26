/**
 * Created by Cancel on 6/3/2017.
 */

Vue.directive('fade', {
    inserted: function (el,binding,vnode,oldVnode) {

        el.style.display = 'none';

        if(binding.value){
            $(el).fadeIn(500);
        }
    },
    update: function(el,binding,vnode,oldVnode){
        console.log('updated')
        if(binding.value)
            $(el).fadeIn(500);
        else
            $(el).fadeOut(500);
    },
    componentUpdated : function(){
        console.log('com updated');
    }
})
