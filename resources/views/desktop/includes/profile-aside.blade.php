
    <div class="col-xs-4 padding-top">
        <div class="panel panel-default photo-list-panel">
            <div class="panel-heading">
                <a href="#" class="block">
                    <h3 class="panel-title">My Photos</h3>
                </a>
            </div>
            <div class="panel-body no-padding">
                <ul>
                    @php
                        $vectors = glob(PUBLIC_PATH.'/assets/images/png/*.png');
                    @endphp
                    @foreach($vectors as $key => $vector)
                        @php if($key > 8) continue;  $asset = str_replace(PUBLIC_PATH, "", $vector); @endphp
                        <li class="col-xs-4 no-padding padding-half">
                            <a class="thumbnail no-margin   " href="profile.html">
                                <img src="{{asset($asset)}}"/>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div> <!-- panel-body -->
        </div> <!-- panel -->

        <div class="panel panel-default friend-list-panel">
            <div class="panel-heading">
                <a href="#" class="block">
                    <h3 class="panel-title">My Friends</h3>
                </a>
            </div>
            <div class="panel-body frind-list-content no-padding padding-half-left padding-half-top">
                @foreach($vectors as $key => $vector)
                    @php if($key > 8) continue;  $vector = str_replace(PUBLIC_PATH, "", $vector); @endphp
                    <div class="friend-content inline-content  col-xs-4 no-padding padding-half-bottom padding-half-right">
                        <a href="#" class="thumbnail no-margin friend-content-link" data-userid="{{$key}}" data-toggle="popover" data-content="And here's some amazing content. It's very engaging. Right?">
                            <img src="{{asset($vector)}}"/>
                            <span class="gradient">User names</span>
                        </a>
                    </div> <!-- group-item -->
                    @if($key==2||$key==5||$key==8)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div> <!-- panel body -->
        </div> <!-- groups panel -->

    </div> <!-- md 4 -->

    @section('scripts')
        @parent
        <script>
            $('.friend-content-link').popover({
                trigger: 'hover',
                placement: function (context, source) {
                    var win = $(document).height();
                    var position = $(source).offset();
                    var elePosition = $(window).scrollTop();
                    var final = parseInt(position.top)-parseInt(elePosition);
                    console.log(final);
                    if (final < 150){
                        return "bottom";
                    }

                    return "top";
                },
                container: 'body'
            });
        </script>
    @endsection