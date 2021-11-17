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
                            <div class="form-group row">
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
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="email" class="col-form-label">{{ __('Event Name') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="{{ __('Enter email') }} ..." id="email" name="email" value="{{ $getEvent->event }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="first_name" class="col-form-label">{{ __('Date & Time') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter first name') }} ..." id="full_name" name="full_name" value="{{ $getEvent->event_date }}" disabled>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <label for="first_name" class="col-form-label">{{ __('Event Type') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter first name') }} ..." id="first_name" name="first_name" value="{{ $getEvent->type }}" disabled>
                                </div>
								<div class="col-md-5">
                                    <label for="vity" class="col-form-label">{{ __('Price') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Price') }}" id="city" name="city" value="RM {{ $getEvent->price }}">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="first_name" class="col-form-label">{{ __('Event Description') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter first name') }} ..." id="full_name" name="full_name" value="{{ $getEvent->description }}" disabled>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-block btn-success" id="update_profile">{{ __('Register') }}</button>
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