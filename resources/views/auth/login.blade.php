@extends('layouts.master-without-nav')

@section('content')
        <!-- Begin page -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="index" class="logo logo-admin"><img src="{{ URL::asset('images/bliomi-logo.png') }}" height="60" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                            @if ($errors->any())
                            <div class="alert {{ $errors->has('success') ? 'bg-success alert-success' : 'bg-danger alert-danger'}} text-white">
                            
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                            </div>
                        @endif
                        <h5 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h5>
                        <p class="text-muted text-center">Please Sign In to Continue</p>

                    <form method="POST" class="form-horizontal m-t-30" action="{{ route('admin.authenticate') }}">
                        @csrf

                        <div class="form-group row">

                                <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row">

                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Login</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="text-center">
                <p>© {{date('Y')}} Bliomi. Crafted with <i class="mdi mdi-heart text-danger"></i> by vantura</p>
                </div>
            </div>
        </div>

    <div class="m-t-40 text-center">
            {{-- <p>Don't have an account ? <a href="{{route('register')}}" class=" text-primary"> Signup Now </a> </p> --}}
               
            </div>

        </div>
        
@endsection