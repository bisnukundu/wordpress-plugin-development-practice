jQuery(document).ready(function($){
    $(document).on('heartbeat-send',function(event, data){
        data.bisnu_post_count = true
    })

    $(document).on('heartbeat-tick',function(event,data){
            console.log("post count:" + data.bisnu_post_count);
    });


    // Get Cats

    $(document).on('heartbeat-send',function(event, data){
        data.random_cat_image_bisnu = true
    })

    $(document).on('heartbeat-tick',function(event,data){
        let cats = JSON.parse(data.random_cat_image_bisnu);
        console.log(cats);
    })
})