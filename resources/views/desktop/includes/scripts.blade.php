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
        $('html').on('mouseup', function(e) {
            if(!$(e.target).closest('.popover').length) {
                console.log($(e.target).closest('.popover'));
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