@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content col s12 m6">
      <div class="error-page center">
        <div class="error-content">
          <h3 class="black-text">Unauthorized 401.</h3>
          <span class="icon-stack" style="font-size: 8rem;">
            <!--<i class="icon-link red-text"></i>-->
            <i class="icon-ban-circle icon-stack-base black-text"></i>
          </span>
          <p class="black-text">
            Unauthorized access.
            Meanwhile, you may go @if(Auth::check()) <a href="{{ url('/home') }}">to home page @else <a href="{{ url('/auth/login') }}">to login page @endif <i class="{{ (Auth::check()) ? 'icon-home' : 'icon-signin' }}"></i></a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
@endsection