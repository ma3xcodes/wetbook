@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content col-xs-12 text-center">
        <div class="error-page center">
            <div class="error-content">
                <h3 class="black-text">Oops! Page not found.</h3>
                <span class="icon-stack" style="font-size: 8rem;">
                    <i class="icon-link text-danger"></i>
                    <i class="icon-ban-circle icon-stack-base black-text"></i>
                </span>
                <p class="black-text">
                    We could not find the page you were looking for.
                    Meanwhile, you may go @if(\Auth::user())
                                        <a href="{{ url(route('home')) }}">to home page
                                    @else
                                        <a href="{{ url(route('login')) }}">to login page
                                    @endif <i class="{{ \Auth::user() ? 'icon-home' : 'icon-signin' }}"></i></a>
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
@endsection