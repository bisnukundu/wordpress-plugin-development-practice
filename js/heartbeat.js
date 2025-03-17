jQuery(document).ready(function($){
    $(document).on('heartbeat-send',function(event, data){
        data.bisnu_post_count = true
    })

    $(document).on('heartbeat-tick',function(event,data){
            console.log(data.bisnu_post_count);
    });
})