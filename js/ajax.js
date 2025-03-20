jQuery(document).ready(function($){
    $('.testing_selector').change(function(){
        $.post(
            my_ajax_obj.ajax_url,
            {
            _ajax_nonce: my_ajax_obj.nonce,
            action:"bisnu_ajax_testing",
            },
            function(data){
                console.log(data);
                // console.log(my_ajax_obj.bisnu);
            }
        )
    })
});