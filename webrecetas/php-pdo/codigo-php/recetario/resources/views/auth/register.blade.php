@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5"  style="margin-top:8rem!important">
        <div class="col-md-6 nomarpad">
            <div class="card" style="height:100%;position:none;border: 5px solid #BF4D67; border-right:0px;border-radius: 5px 0px 0px 5px;">
                <div class="card-body nomarpad" style="background: no-repeat;text-align:center;background-image: url(../images/cutlery.jpg);background-size: 100%;background-origin: content-box;background-position: center;">
                </div>
            </div>
        </div>
        <div class="col-md-6 nomarpad">
            <div class="card" style="border: 5px solid #BF4D67;border-radius: 0px 5px 5px 0px;">
                <div class="card-header" style="border-radius:0px;border-bottom: 2px solid #BF4D67;font-family:Pacifico;font-size:25px;background-color:#D88E8E">{{ __('Registro') }}</div>
                <div class="card-body" style="background-color:#AEE5D8;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="font-family:Lato">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror category-select" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="font-family:Lato">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror category-select" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="font-family:Lato">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror category-select" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="font-family:Lato">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control category-select" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn navbar-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>      
<footer>
    <div class="col-12 nomarpad" style="height:150px; background-color:#63A6A6;padding-top: 0px!important;margin-top:202px !important">
        <h1 style="position:absolute;right: 36%;top: 40%;font-family:Lato;color:#BF4D67;font-size:40px;">Copyright© 2021 WebRecetas</h1>
        <img class="img-fluid" src="../images/backhome.png" alt="" style="width:100%;height: 165px;object-fit: cover;object-position: 0px -1000px;"></img>
    </div>
</footer>
@endsection
