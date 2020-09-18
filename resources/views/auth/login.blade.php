@extends('layouts.auth.master')

@section('title', 'Login')

@section('css')
@endsection

@section('content')

    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
        <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
            <div class="d-flex flex-row-fluid flex-column justify-content-between">
                <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                    <a href="{{url('/')}}" class="mb-15 text-center">
                        <img src="{{asset('img/logo.png')}}" class="max-h-150px" alt="logo" />
                    </a>
                    <div class="login-form login-signin">
                        <div class="text-center mb-10 mb-lg-20">
                            <h2 class="font-weight-bold">Sign In</h2>
                            <p class="text-muted font-weight-bold">Enter your username and password</p>
                        </div>
                        <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group py-3 m-0">
                                <input id="email" type="email" placeholder="Email Address" class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input id="password" type="password" placeholder="Password" class="form-control h-auto border-0 px-0 placeholder-dark-75 @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-outline m-0 text-muted">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <span></span>Remember me</label>
                                </div>
                            </div>
                            <div class="form-group d-flex flex-wrap justify-content-center align-items-center mt-2">
                                <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url(assets/media/bg/bg-4.jpg);">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-lg-center">
                <div class="d-flex flex-column justify-content-center">
                    <h3 class="display-3 font-weight-bold my-7 text-white">Welcome to WMS</h3>
                    <p class="font-weight-bold font-size-lg text-white opacity-80">WMS is (Warehouse Management System)</p> 
                    <p class="font-weight-bold font-size-lg text-white opacity-80">a simple solution to manage your stock of items, this system should help you to manage your stock of items</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
//--------------------------------------------------------------//
    $(function(){
        _handleSignInForm();
    });
//--------------------------------------------------------------//
    function _handleSignInForm() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'),
            {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email Address is required'
                            },
                            emailAddress: {
                                message: 'Enter a valid Email Address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            },
                            stringLength:{
                                min: 8,
                                message: 'Password must be at least 8 characters'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    $('#kt_login_signin_form').submit();
                } else {
                    
                }
            });
        });
    }
//--------------------------------------------------------------//
</script>
@endsection