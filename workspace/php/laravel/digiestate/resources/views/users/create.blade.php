@extends('layouts.master')


@section('content')
<div class="basic-form-area mg-tb-15">
 <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                  <div class="form-group">
                                      <div class="col-sm-6"><h1>{{$page_title}}</span></h1></div>
                                      <div class="col-sm-6 text text-right">
                                        <a class="btn btn-primary" href="{{ URL("admin/users")}}">List</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                  @if(Request::segment(4)==='edit')
           {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'id' => 'userForm')) }} 
            
            <?php  
                //$roleid             = old('roles')?old('roles'):$user->role_id;
                $name               = old('name')?old('name'):$user->name;
                $email              = $user->email;
                $Phone              = $user->mobile_no;
                $address        = $user->address;
                $occupation        = $user->occupation;
                //$Language           = $user->language_known;
                $readonly = 'readonly';
                
            ?>
            {!! Form::hidden('id',$user->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/users', 'id' => 'userForm')) }}
            {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
            <?php 
               
                //$roleid           = '';
                if(old('roles')){
                  $roleid  = old('roles');
                }else{
                  $roleid  = '';
                }
                
                $name             = '';
                $email            = '';
                $Phone            = '';
                $Designation      = '';
                $Language      = '';
                $readonly = '';
               
                             
            ?>
            @endif

          
          <div class="row">
          {{-- <input type="hidden" name="vendor_id" value="{{$vendor_id}}"> --}}
          </div>
            <div class="col-md-6">
              <div class="form-group">
               {{ Form::label('name', 'Name') }}

               <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','id'=>'name','required')) }}
                  @if($errors->has('name'))
                    <div class="text text-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>
              </div>
            </div>

            
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('email', 'Email') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::email('email', $email, array('class' => 'form-control','placeholder'=>'Email','id'=>'email','required',$readonly)) }}
                   @if($errors->has('email'))
                    <div class="text text-danger">{{ $errors->first('email') }}</div>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              {{ Form::label('Contact Number', 'Contact Number') }}
              <span class="text text-danger">*</span>
              <div>
                 
              {{ Form::text('mobile_no', $Phone, array('class' => 'form-control only-numeric','placeholder'=>'Contact Number')) }}
               @if($errors->has('mobile_no'))
                    <div class="text text-danger">{{ $errors->first('mobile_no') }}</div>
                  @endif
              </div>
              </div>
            </div>

            
            <div class="col-md-6">
              <div class="form-group">
              {{ Form::label('Address', 'Address') }}
              <div>

              {{ Form::text('address', $address, array('class' => 'form-control','placeholder'=>'Address')) }}
              </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
              {{ Form::label('Occupation', 'Occupation') }}
              <div>

              {{ Form::text('occupation', $occupation, array('class' => 'form-control','placeholder'=>'Occupation')) }}
              </div>
              </div>
            </div>
            
            {{-- <div class='col-md-6 form-group'>
                {{ Form::label('Role', 'Role') }}
                <span class="text text-danger">*</span>
                <select class="form-control" name="roles" id="roles" required="">
                 <option value="0" selected="" disabled="">Select Role</option> 
                  @foreach ($roles as $role)
                    
                      <option value="{{$role->id}}" @if($roleid==$role->id) selected @endif>{{$role->name}}</option> 
                  @endforeach
                </select>
            </div> --}}
            
            </div>
           
            <div class="col-sm-12 form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/users') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
            </div>
         {!! Form::close() !!}
        </div>
      </div>
    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
@endsection

@section('extrajs')
 <link rel="stylesheet" href="{{ asset('assets/css/form/all-type-forms.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/css/summernote/summernote.css')}}  ">
    <script src="{{ asset('assets/js/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('assets/js/summernote/summernote-active.js')}}"></script>
      <script type="text/javascript">
        
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#imagePreview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
});
      </script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('public/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('public/js/jquery.datetimepicker.full.min.js') }}"></script>

<script type="text/javascript">
  $( function() {
    $('.select').select2({
      width: '100%',
      placeholder: 'Select Language',
    });  
  });

 
</script>
@endsection