@extends('auth.auth-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin: 50px 0;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone No,') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="name" class="form-control  " name="phone" value=""  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <label class="radio-inline col-form-label text-md-right">
                                    <input type="radio" name="gender" value="male">
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Male') }}</font></font>
                                </label>
                                &nbsp;
                                <label class="radio-inline col-form-label text-md-right">
                                    <input type="radio" name="gender" value="female">
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Female') }}</font></font>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="name" class="form-control" name="address" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="name" class="form-control" name="postcode" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="name" class="form-control" name="city"  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <input id="state" type="name" class="form-control" name="state" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pcountry" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="name" class="form-control" name="country"  >
                            </div>
                        </div>

                        <!-- <hr> -->

                        <!-- <div class="row">
                            <div class="col-xl-12 text-center" style="margin:20px 0">
                                <h3>Choose Your Membership Plan</h3>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="member_type" value="basic">
                                    <label class="form-check-label">
                                        {{ ('Choose Basic Plan') }}
                                    </label>
                                </div>
                                <div class="card bg-warning">
                                    <div class="card-body text-center " style="margin:30px 0">
                                        <h3 class="card-text text-white">BASIC MEMBERSHIP</h3>
                                        <h3 class="card-text text-white">RM20</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="member_type" value="gold">
                                    <label class="form-check-label">
                                    {{ ('Choose Gold Plan') }}
                                    </label>
                                </div>
                                <div class="card bg-warning ">
                                    <div class="card-body text-center" style="margin:30px 0">
                                        <h3 class="card-text text-white">GOLD MEMBERSHIP</h3>
                                        <h3 class="card-text text-white">RM20 + RM150 Every Month</h3>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        
                        <div class="form-group row mb-0 mx-auto" style="width: 50%; margin:30px 0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
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
@endsection
