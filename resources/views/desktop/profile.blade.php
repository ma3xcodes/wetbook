@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                @include('includes.profile-aside')
                <div class="col-md-8">
                    <div class="profile">
                        <h1 class="page-header">{{auth::user()->username}}</h1>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset(auth::user()->profile->avatar->photo_medium)}}" class="img-thumbnail"/>
                            </div> <!-- col md 4 -->
                            <div class="col-md-8">
                                <ul>
                                    <li><strong>Name:</strong> {{auth::user()->first_name . " " . auth::user()->middle_name}}</li>
                                    <li><strong>Email:</strong> johndoe@gmail.com</li>
                                    <li><strong>City:</strong> Boston</li>
                                    <li><strong>State:</strong> Massachusetts</li>
                                    <li><strong>Gender:</strong> Male</li>
                                    <li><strong>Age:</strong> {{auth::user()->birthday ? auth::user()->age : 'Not definned'}}</li>
                                    <li><strong>Profession:</strong> Web Developer</li>
                                </ul>
                            </div> <!-- col md 8 -->
                        </div> <!-- row -->

                        <br/><br/>
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