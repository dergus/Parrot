$(function(){
    $('.js_reviewForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'?r=site/addReview',
            type:'post',
            dataType: 'json',
            data:$(this).serialize(),
            success:function(data,status){
                if(status=='success'){
                    if(data.status==1){
                        $('.js_reviewForm, .js_fail').addClass('hidden');
                        $('.js_success').removeClass('hidden');
                    }
                    else{
                        var elem=$($('.js_errorItem')[0]).clone();
                        $('.js_errorItem').remove();

                        for(var e in data.errors){
                            data.errors[e].forEach(function(text){
                                var clone=elem.clone();
                                clone.text(text);
                                clone.appendTo('.js_errors');
                            });
                        }


                        $('.js_fail').removeClass('hidden');
                    }
                }
            }
        });
    });
});