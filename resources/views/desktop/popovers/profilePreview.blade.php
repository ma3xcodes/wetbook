<div class="content-popover">
    <div>
        <div class="user-options">
            <div  class="user-cover gradient" style="background-image: url({{asset('assets/images/profile_bg.png')}});opacity: .8">

            </div>
            <div class="user-info">
                <div>
                    <p class="no-margin">
                        <span>
                            {{auth::user()->first_name." ".auth::user()->last_name}}
                        </span>
                    </p>
                    <p class="no-margin">
                        <small>
                            {{auth::user()->user_name}}
                        </small>
                    </p>
                    <p class="no-margin padding-half-top">
                        <a href="#" class="@if(!auth::user()->user_name) text-muted @endif">
                            <i class="icon icon-group"></i> Amigos
                        </a>
                    </p>
                    <p>
                        <a href="#">Others</a>
                    </p>
                </div>
                <img src="{{auth()->user()->profile->avatar->photo_small}}" class="thumbnail">
            </div>
            <div class="user-buttons">
                <div class="col-xs-4 no-padding text-center">
                    <a href="#" class="btn-modified">First</a>
                </div>
                <div class="col-xs-4 no-padding text-center">
                    <a href="#" class="btn-modified">Seccond</a>
                </div>
                <div class="col-xs-4 no-padding text-center">
                    <a href="#" class="btn-modified">Last</a>
                </div>
            </div>
        </div>
    </div>
</div>