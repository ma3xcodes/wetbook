<script>
    (function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.change-language-link').click(function(){
            let element = $(this);
            let url = "{{route('show.languages')}}";
            $.ajax({
                type: 'GET',
                url: url,
                beforeSend: function(){

                },
                success: function(response){
                    $('.main-modal').html(response).modal('toggle');
                }
            });
            return false;
        });

        $(document).on('click','.select-language',function(){
            let element = $(this);
            let lang = element.data('lang');
            $.ajax({
                type: 'POST',
                url: "{{route('change.lang')}}",
                data: {lang:lang},
                beforeSend: function(){

                },
                success: function(res){
                    iziToast.success({
                        title: 'Hey',
                        message: res
                    });
                    $('.change-language-link').text(element.text());
                    $('.main-modal').modal('toggle');
                },
                error: function(err){
                    iziToast.error({
                        title: 'Hey',
                        message: err
                    });
                }
            });
        });
        $('html').on('mouseup', function(e) {
            if(!$(e.target).closest('.popover').length) {
                //console.log($(e.target).closest('.popover'));
                $('.popover').popover('hide');
            }
        });
        $('.show-photo').click(function(e){
            let element = $(this);
            let url = element.data('url');
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function(){

                },
                success: function(response){
                    console.log('Show photo success.');
                    $('.main-modal').html(response).modal('toggle');
                }
            });
            return false;
        });
    })();
</script>