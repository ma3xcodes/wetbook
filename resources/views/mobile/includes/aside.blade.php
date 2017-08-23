
    <div class="col-md-4 hidden-xs hidden-md">
    <div class="panel panel-default friends">
        <div class="panel-body">
            <div class="aside-profile">
                <div>
                    <a href="{{route('main.profile')}}">
                        <img src="{{auth::user()->profile->avatar->photo_small}}" alt="avatar" class="thumbnail no-padding" width="40">
                    </a>
                </div>
                <div>
                    <a href="{{ route('main.profile') }}">
                        <span>{{auth::user()->first_name . " " . auth::user()->last_name}}</span>
                        <small>{{ auth::user()->username }}</small>
                    </a>
                </div>
            </div>
            <div class="list-group aside-menu">
                <a href="#" class="list-group-item link">
                    Noticias <i class="icon icon-globe"></i>
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
        <div class="panel-heading">
            <h3 class="panel-title">Latest Groups</h3>
        </div>
        <div class="panel-body">
            <div class="group-item">
                <img src="img/group.png"/>
                <h4><a href="#">Sample Group One</a></h4>
                <p>This is a Dobble social network sample group</p>
            </div> <!-- group-item -->
            <div class="clearfix"></div> <!-- clear floats -->
            <div class="group-item">
                <img src="img/group.png"/>
                <h4><a href="#">Sample Group Two</a></h4>
                <p>This is a Dobble social network sample group</p>
            </div> <!-- group-item -->
            <div class="clearfix"></div> <!-- clear floats -->
            <div class="group-item">
                <img src="img/group.png"/>
                <h4><a href="#">Sample Group Three</a></h4>
                <p>This is a Dobble social network sample group</p>
            </div> <!-- group-item -->
            <div class="clearfix"></div> <!-- clear floats -->
            <a class="btn btn-primary" href="#">View All Groups</a>
        </div> <!-- panel body -->
    </div> <!-- groups panel -->
    <div class="footer">
        <footer>
            <p>&copy; {{APP_NAME}}</p>
        </footer>
    </div>
</div> <!-- md 4 -->