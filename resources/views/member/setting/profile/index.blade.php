@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form>
                        @csrf
                            <!-- <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <label for="description" class="col-form-label">{{ __('Photo') }}</label>
                                    <img id="preview" class="img-thumbnail" style="display:none;width:350px;">
                                    <div>
                                        <input type="file" name="photo" id="photo" class="file" accept="image/*">
                                        <a class="btn btn-default" id="removeFile" style="display:none;">{{ __('Remove')}}</a>
                                        <input type="hidden" id="current_photo" name="current_photo" value="">
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="email" class="col-form-label">{{ __('Email') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="{{ __('Enter email') }} ..." id="email" name="email" value="{{ $getUser->email }}" required>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="first_name" class="col-form-label">{{ __('Full Name') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter first name') }} ..." id="full_name" name="full_name" value="{{ $getUser->name }}" required>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="first_name" class="col-form-label">{{ __('Address') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter first name') }} ..." id="first_name" name="first_name" value="{{ $getUser->userinfo->address }}" required>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <label for="vity" class="col-form-label">{{ __('City') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('City') }}" id="city" name="city" value="{{ $getUser->userinfo->city }}">
                                </div>
                                <div class="col-md-5">
                                    <label for="state" class="col-form-label">{{ __('State') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('State') }}" id="city" name="state" value="{{ $getUser->userinfo->state }}">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <label for="vity" class="col-form-label">{{ __('Postcode') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="" id="city" name="city" value="{{ $getUser->userinfo->postcode }}">
                                </div>
                                <div class="col-md-5">
                                    <label for="state" class="col-form-label">{{ __('Telephone No.') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="" id="city" name="state" value="{{ $getUser->userinfo->hpnum }}">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-block btn-success" id="update_profile">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
</script>
@endpush