@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="cover-parent">
                        <div class="cover-content" style="background-image: url({{asset('assets/images/mountains1.png')}})">
                            <div class="edit-cover-button">
                                    <a href="#">
                                        <span>
                                            <i class="icon icon-camera"></i>
                                        </span>
                                        <span class="hidden-not-important">Actualizar cover</span>
                                    </a>
                            </div>
                            <div class="cover-user-names">
                                <h2>{{auth::user()->first_name." ".auth::user()->last_name}}</h2>
                                <h4>{{auth::user()->username}}</h4>
                            </div>
                            <div class="cover-profile-edit-button">
                                <button class="btn btn-xs">
                                    <i class="icon icon-pencil"></i> Editar Perfil
                                </button>
                            </div>
                        </div>
                        <div class="profile-menu-buttons">
                            <div class="profile-menu-avatar">
                                <img src="{{asset(auth::user()->profile->avatar->photo_medium)}}" class="img-thumbnail"/>
                            </div>
                            <div class="profile-menu-button">
                                <a href="#" class="selected">Link 1</a>
                            </div>
                            <div class="profile-menu-button">
                                <a href="#">Link 2</a>
                            </div>
                            <div class="profile-menu-button">
                                <a href="#">Link 3</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-content">

                        </div>
                    </div>
                </div>
                <!-- SIDEBAR -->
                @include('includes.profile-aside')
                <div class="col-md-8 padding-top">
                    <div class="profile">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Profile Wall</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Write on the wall"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">Submit</button>
                                            <div class="pull-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Text</button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-file-image-o"></i> Image</button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-file-video-o"></i> Video</button>
                                                </div>
                                            </div> <!-- pull-right -->
                                        </form>
                                    </div> <!-- panel body -->
                                </div> <!-- panel -->
                            </div> <!-- cold-md-12 -->
                        </div> <!-- row -->

                    </div> <!-- profile div -->
                </div> <!-- md 8 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
@endsection