


@extends('layouts.app')

@section('content')
        <div class="p-10 m-10 container text">
          <div class="card">
                <div class="card-body">
                      <h3 class="mt-0 m-b-15"> <a href="#" class="logo logo-admin">
                        
                        {{-- <img src="{{URL('assets/frontend')}}/img/toplogo.png"> --}}
                      </a> </h3>
                      <h4 class="text-muted font-18 text text-center well"><b>Sign In Form</b></h4>
                      <hr/>
                      <div class="">
                         <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}

                                        <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="col-sm-6">
                                                <label for="name" class="col-md-4 control-label">Name</label>
                                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                
                                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="col-sm-6">
                                                <label for="password" class="col-md-4 control-label">Password</label>

                                                    <input id="password" type="password" class="form-control" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Register
                                                </button>
                                            </div>
                                        </div>
                         </form>
                      </div>
                </div>
          </div>
        </div>
@endsection


<div class="accountbg"></div>
