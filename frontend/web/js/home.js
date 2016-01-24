/**
 * powered by php-shaman
 *  12.01.2016
 * Hashtag
 */


$('[role="like"]').on('click', function(){
    var self = this;
    var url = $(self).attr('href');
    $.ajax({
        type: "POST",
        url: url,
        dataType: 'json',
        cache: false,
        data: ({type : 'add'}),
        success: function(msg){
            if(msg.e){
                alert(msg.e);
            }else{
                $(self).children('span').html(msg.likes);
            }
        }
    });
    return false;
});