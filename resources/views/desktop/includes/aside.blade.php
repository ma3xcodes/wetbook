
    <div class="col-xs-4">
    <div class="panel panel-default friends">
        <div class="panel-body">
            <div class="aside-profile">
                <div>
                    <a href="{{route('main.profile')}}">
                        <img src="{{route('asset.manage', ['size'=>'small', 'id'=>\Hashids::encode(auth::user()->profile->avatar->id)])}}" alt="avatar" class="thumbnail no-padding" width="40">
                    </a>
                </div>
                <div>
                    <a href="{{ route('main.profile') }}">
                        <span>{{auth::user()->first_name . " " . auth::user()->last_name}}</span>
                        <small>{{ auth::user()->user_name }}</small>
                    </a>
                </div>
            </div>
            <div class="list-group aside-menu">
                <a href="#" class="list-group-item link">
                    {{trans('home.aside.notices')}} <i class="icon icon-globe"></i>
                </a>
                <a href="#" class="list-group-item">
                    Fotos <i class="icon icon-picture"></i>
                </a>
                <a href="#" class="list-group-item">
                    Mensajes <i class="icon icon-comments"></i>
                </a>
                <a href="#" class="list-group-item">
                    Amigos <i class="icon icon-group"></i>
                </a>
                <a href="#" class="list-group-item">
                    Buscar <i class="icon icon-search"></i>
                </a>
            </div> <!-- list-group -->
        </div> <!-- panel-body -->
    </div> <!-- panel -->
    <div class="panel panel-default groups">
        <div class="panel-body">
            <div class="list-group">
                <div class="list-group-item">
                    <span class="icon-stack">
                        <i class="icon-circle icon-stack-base"></i>
                        <i class="icon-group icon-light"></i>
                    </span>
                    Grupos
                    <a href="#" class="pull-right" style="display: -webkit-inline-box">
                        <i class="icon icon-plus"></i>
                    </a>
                </div>
            </div>
        </div> <!-- panel body -->
    </div> <!-- groups panel -->
    <div class="footer">
        <footer>
            <p>&copy; {{config('app.name')}} · Language <a href="#" class="change-language-link">{{app()->getLocale()}}</a></p>
        </footer>
    </div>
</div> <!-- md 4 -->