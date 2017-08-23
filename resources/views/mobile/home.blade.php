@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- SIDEBAR -->
                @include('includes.aside')

                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Wall</h3>
                        </div>
                        <div class="panel-body">
                            <form class="post-home-form" onsubmit="return false;" enctype="multipart/form-data">
                                <input type="file" name="file" class="hide">
                                <input type="hidden" name="post-type" value="0">
                                <div class="form-group">
                                    <textarea class="form-control input-sm" name="post-text" placeholder="Write on the wall" style="max-width: 100%;max-height: 10em"></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-link"><i class="icon icon-pencil"></i></button>
                                        <button type="button" name="change-file" class="btn btn-link"><i class="icon icon-picture"></i></button>
                                        <!--<button type="button" class="btn btn-link"><i class="icon icon-facetime-video"></i></button>-->
                                    </div>
                                </div> <!-- pull-right -->
                            </form>
                        </div> <!-- panel body -->
                    </div> <!-- panel -->
                    @for($i=0;$i<=10;$i++)
                    <div class="panel panel-default post">
                        <div class="panel-body">
                            <div class="row panel-content-x{{$i}}">
                                <div class="col-xs-12">
                                    <div style="display: block;max-width: 15%;display: inline-block;vertical-align: middle;margin: 0">
                                        <a class="post-avatar thumbnail" href="profile.html" style="margin: 0">
                                            <img src="{{asset('assets/images/profile-image-1.png')}}"/>
                                        </a>
                                    </div>
                                    <div class="text-left" style="display: inline-block;vertical-align: middle;white-space: nowrap;max-width: 75%">
                                        <div class="text-left" style="text-overflow:ellipsis;overflow: hidden;">DevUser{{$i}}</div>
                                        <div class="text-left">
                                            <small class="text-muted">time ago</small>
                                        </div>
                                    </div>
                                    <div class="post-options" style="position: absolute;top: 0px;right: 15px;max-width: 10%;">
                                        <button class="btn btn-link" data-container=".panel-content-x{{$i}}" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus.">
                                            <i class="icon icon-ellipsis-horizontal"></i>
                                        </button>
                                    </div>
                                </div> <!-- col sm 2 -->

                                <div class="col-xs-12">
                                    <div class="bubble">
                                        <div class="pointer">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat, magna ornare euismod consectetur, dolor arcu finibus erat, in finibus ex elit quis nunc. Aliquam erat volutpat. Cras posuere feugiat ligula nec lacinia. Suspendisse potenti. Quisque venenatis tincidunt magna, non molestie turpis. Vestibulum sagittis enim maximus sapien maximus vehicula. Aenean et condimentum ligula, id venenatis metus.
                                        </div> <!-- pointer -->
                                        <div class="pointer-border"></div>
                                    </div> <!-- bubble -->
                                    <div class="post-actions" style="position: relative">
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
                    @endfor
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
                $('.post-home-form button[name="change-file"]').click(function(){
                    let element = $(this);
                    $('.post-home-form input[type="file"]').click();
                });
                $('.post-home-form input[type="file"]').change(function(){
                    $('.post-home-form input[name="post-type"]').val(1);
                });
            })
        </script>
    @endsection
@endsection
