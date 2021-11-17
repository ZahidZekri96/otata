@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form name="user">
                        @csrf
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="ori_password" class="col-form-label">{{ __('Original Password') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="{{ __('Enter original password') }}" id="ori_password" name="ori_password" required>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10" id="pwd-container">
                                    <label for="password" class="col-form-label">{{ __('Password') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="{{ __('Enter new password') }}" id="password" name="password" required>
                                    </div>
                                    <div class="col-sm-12 col-sm-offset-2 pt-3">
                                        <div class="pwstrength_viewport_progress"></div>
                                    </div>
                                    <span style="color: #17a2b8">{{ __('Minimum 8 characters') }}</span>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="confirm_password" class="col-form-label">{{ __('Retype Password') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="{{ __('Re-enter new password') }}" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <input type="hidden" name="id" id="id" value="{{$getUser->id}}">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-block btn-success" id="update_password">{{ __('Change Password') }}</button>
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