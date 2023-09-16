<!DOCTYPE html>
@extends('layouts.app')

@section('content')

<link href="{{ asset('assets/old/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/old/css/style.css') }}" rel="stylesheet">
           <div class="login-section">
    <div class="card-body">
      <h3 class="text-center mt-0 m-b-15"> <a href="#" class="logo logo-admin">
        <!--Digiestate-->
        <img src="{{URL('assets/login-icon_old.png')}}">
      </a> </h3>
      <h4 class="text-muted text-center font-18"><b>Sign In</b></h4>
      <div class="p-3">
        <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
          {{csrf_field()}}
          {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
          <div class="form-group row{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-12">
              <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
               @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
               @endif
            </div>
          </div>
          <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-12">
              <input  type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                {{-- <label class="custom-control-label" for="customCheck1">Remember me</label> --}}
              </div>
            </div>
          </div>
          <div class="form-group text-center row m-t-20">
            <div class="col-12">
              <button type="submit" class="btn btn-info btn-block waves-effect waves-light" >Log In</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

@section('extrajs')
@endsection
