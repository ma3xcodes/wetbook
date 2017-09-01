@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                @include('includes.aside')

                <div class="col-xs-8">
                    <div class="panel panel-default publish-post">
                        <div class="panel-heading type-post-buttons">
                                <div class="text-center" style="display: inline-block;vertical-align: middle;width: 48%;">
                                    <button class="btn btn-link" autofocus  >
                                        <i class="icon icon-pencil"></i>
                                        Crear una publicacion
                                    </button>
                                </div>
                                <div class="text-center" style="display: inline-block;vertical-align: middle;width: 48%;">
                                    <button class="btn btn-link" name="change-file">
                                        <i class="icon icon-camera"></i>
                                        Publicar una foto
                                    </button>
                                </div>
                        </div>
                        <div class="panel-body">
                            <form class="post-home-form" onsubmit="return false;" enctype="multipart/form-data">
                                <input type="file" name="file" class="hide">
                                <input type="hidden" name="post-type" value="0">
                                <div class="form-group">
                                    <textarea class="form-control input-sm" name="post-text" placeholder="Write on the wall" style="max-width: 100%;max-height: 10em"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                                <div class="pull-right preview-photo">

                                </div> <!-- pull-right -->
                            </form>
                        </div> <!-- panel body -->
                    </div> <!-- panel -->
                    @foreach($posts->reverse() as $key => $post)
                    <div class="panel panel-default post">
                        <div class="panel-body">
                            <div class="row panel-content-x{{$key}}">
                                <div class="col-xs-12">
                                    <div style="display: block;max-width: 15%;display: inline-block;vertical-align: middle;margin: 0">
                                        <a class="post-avatar thumbnail" href="{{$post->user_id==Auth::user()->id ? route('main.profile') : route('home')}}" style="margin: 0">
                                            <img src="{{route('asset.manage', ['size'=>'small', 'id'=>\Hashids::encode(Auth::user()->profile->avatar->id)])}}"/>
                                        </a>
                                    </div>
                                    <div class="text-left" style="display: inline-block;vertical-align: middle;white-space: nowrap;max-width: 75%">
                                        <div class="text-left" style="text-overflow:ellipsis;overflow: hidden;">{{$post->user->user_name}}</div>
                                        <div class="text-left">
                                            <small class="text-muted">{{$post->created_at->diffForHumans()}}</small>
                                        </div>
                                    </div>
                                    <div class="post-options" style="position: absolute;top: 0px;right: 15px;max-width: 10%;">
                                        <button class="btn btn-link" data-container=".panel-content-x{{$key}}" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus.">
                                            <i class="icon icon-ellipsis-horizontal"></i>
                                        </button>
                                    </div>
                                </div> <!-- col sm 2 -->

                                <div class="col-xs-12">
                                    <div class="bubble">
                                        <div class="pointer">
                                            <p>
                                                {{$post->text}}
                                            </p>
                                            @if($post->photo_id)
                                                <img src="{{route('asset.manage',['size'=>'medium', 'id'=>\Hashids::encode($post->photo_id)])}}" alt="" style="max-width: 100%">
                                            @endif
                                        </div> <!-- pointer -->
                                        <div class="pointer-border"></div>
                                    </div> <!-- bubble -->
                                    <div class="post-actions padding-half" style="position: relative">

                                        <a href="#"><i class="icon icon-heart"></i> Like</a> · <a href="#"><i class="icon icon-comment"></i> Commnet</a> · <a href="#"><i class="icon icon-share-alt"></i> Share</a>
                                        <div style="position: absolute;right: 15px;top: 0;">
                                            <a href="" class="text-muted">
                                                <small>
                                                    <i class="icon icon-heart"></i> 234
                                                </small>
                                            </a>
                                        </div>
                                    </div> <!-- post-actions -->
                                    <div class="divider" style="background: #ccd0d2;margin: 7.5px 0;min-height: 1px"></div>
                                    <div class="comment-form">
                                        <form class="form-inline">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm" id="exampleInputName2" placeholder="Enter Comment">
                                            </div>
                                            <!--<button type="submit" class="btn btn-default btn-sm">Add</button>-->
                                        </form>
                                    </div> <!-- comment-form -->
                                    <div class="clearfix"></div> <!-- to clear all floats -->

                                    <div class="comments">
                                        <div class="comment">
                                            <a href="#" class="comment-avatar pull-left"><img src="{{asset('assets/images/profile-image-2.png')}}" width="30"/></a>
                                            <div class="comment-text">
                                                Nam eu eros tristique, feugiat augue ac, commodo nunc. Suspendisse consequat facilisis ante in sodales.
                                            </div> <!-- comment-text -->
                                        </div> <!-- comment -->
                                        <div class="clearfix"></div> <!-- clear floats -->
                                        <div class="comment">
                                            <a href="#" class="comment-avatar pull-left"><img src="{{asset('assets/images/profile-image-3.jpg')}}" width="30"/></a>
                                            <div class="comment-text">
                                                Donec viverra aliquam est quis aliquam. Donec aliquam tortor ac nulla aliquet, id cursus dui mattis.
                                            </div> <!-- comment-text -->
                                        </div> <!-- comment -->
                                        <div class="clearfix"></div> <!-- clear floats -->
                                    </div> <!-- comments -->

                                </div> <!-- col sm 10 -->
                            </div> <!-- row -->
                        </div> <!-- panel body -->
                    </div> <!-- panel -->
                    @endforeach
                </div> <!-- md 8 -->

            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    @section('scripts')
        @parent
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()

                $('.post-home-form').submit(function(){
                    let element = $(this);

                    var file_data = $('.post-home-form input[type="file"]').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file_name', file_data);
                    form_data.append('post-type',0);
                    form_data.append('post-text', element.find('textarea[name="post-text"]').val());
                    console.log(element.find('textarea[name="post-text"]').val());
                    $.ajax({
                        url: '{{route('create.post')}}',
                        method: 'POST',
                        contentType: false, // high importance!
                        processData: false, // high importance!
                        data: form_data,
                        dataType: 'text',
                        success: function(res){
                            console.log(res);
                            element[0].reset();
                            iziToast.success({
                                title: 'Hey',
                                message: 'What would you like to add?'
                            });
                        }
                    });
                });
                $('.type-post-buttons button[name="change-file"]').click(function(){
                    let element = $(this);
                    $('.post-home-form input[type="file"]').click();
                });
                $('.post-home-form input[type="file"]').change(function(){
                    $('.post-home-form input[name="post-type"]').val(1);
                    var imgPath = $(this)[0].value;
                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

                    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                        if (typeof (FileReader) != "undefined") {

                            var image_holder = $(".preview-photo");
                            image_holder.empty();

                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $("<img />", {
                                    "src": e.target.result,
                                    "class": "thumb-image",
                                    "width": "80"
                                }).appendTo(image_holder);

                            }
                            image_holder.show();
                            reader.readAsDataURL($(this)[0].files[0]);
                        } else {
                            alert("This browser does not support FileReader.");
                        }
                    }
                });
            })
        </script>
    @endsection
@endsection
