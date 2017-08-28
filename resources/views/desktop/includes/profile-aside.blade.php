
    <div class="col-xs-4 padding-top">
        <div class="panel panel-default photo-list-panel">
            <div class="panel-heading">
                <a href="#" class="block">
                    <h3 class="panel-title">My Photos</h3>
                </a>
            </div>
            <div class="panel-body no-padding padding-half-top padding-half-left">
                <ul>
                    @php
                        $vectors = glob(PUBLIC_PATH.'/assets/images/png/*.png');
                    @endphp
                    @foreach($vectors as $key => $vector)
                        @php if($key > 8) continue;  $asset = str_replace(PUBLIC_PATH, "", $vector); @endphp
                        <li class="col-xs-4 no-padding padding-half-bottom padding-half-right">
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
                        <a href="#" class="thumbnail no-margin friend-content-link" data-userid="{{\Hashids::connection('user')->encode($key)}}" >
                            <img src="{{asset($vector)}}"/>
                            <span class="gradient">User names</span>
                        </a>
                    </div> <!-- group-item -->
                @endforeach
            </div> <!-- panel body -->
        </div> <!-- groups panel -->

    </div> <!-- md 4 -->