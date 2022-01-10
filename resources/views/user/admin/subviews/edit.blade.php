@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-md-10">
                            </div>
                            <div class="col-md-2">
                            <a class="btn btn-default" href="{{ route('admin.list') }}" style="float: right;"><i class="fas fa-arrow-left"></i>&nbsp;{{ __('Back') }}</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label for="code" class="col-form-label"></label>
                                <span style="color:#800000;"><b>* {{ __('Field is required') }}</b></span>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <form>
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="col-form-label" for="text-input"><strong>{{ __('Full Name') }}</strong></label>
                                <input class="form-control" id="text-input" type="text" name="name" value="{{ $dataUser->name }}" placeholder="{{ __('Enter Full Name') }}">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label class="col-form-label" for="text-input"><strong>{{ __('Email') }}</strong></label>
                                <input class="form-control" id="text-input" type="text" name="email" value="{{ $dataUser->email }}" placeholder="{{ __('Enter Email') }}">
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label" for="text-input"><strong>{{ __('Phone No.') }}</strong></label>
                                <input class="form-control" id="text-input" type="text" name="phone" value="{{ $dataUser->userinfo->hpnum }}" placeholder="{{ __('Enter Phone No.') }}">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="stock" class="col-form-label"><strong>{{ __('Gender') }}</strong><span style="color:darkred">*</span></label><br/>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="male" {{ $dataUser->userinfo->gender == 'male' ? "checked" : '' }} >
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Male') }}</font></font>
                                </label>
                                &nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female" {{ $dataUser->userinfo->gender == 'female' ? "checked" : '' }}>
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Female') }}</font></font>
                                </label>
                            </div>
                            <div class="col-md-5">
                            <label for="name" class="col-form-label"><strong>{{ __('Type') }}</strong><span style="color:darkred">*</span></label>
                            <select class="form-control" id="type" name="type">
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="admin" {{ $dataUser->type == 'admin' ? "selected='selected'" : '' }}>{{ __('Admin') }}</option>
                                <option value="member" {{ $dataUser->type == 'member' ? "selected='selected'" : '' }}>{{ __('Member') }}</option>
                                </select>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label for="name" class="col-form-label"><strong>{{ __('Address') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Address') }}" id="address" name="address" value="{{ $dataUser->userinfo->address }}" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Postcode') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Postcode') }}" id="postcode" name="postcode" value="{{ $dataUser->userinfo->postcode }}" required>
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('City') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter City') }}" id="city" name="city" value="{{ $dataUser->userinfo->city }}" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('State') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter State') }}" id="state" name="state" value="{{ $dataUser->userinfo->state }}" required>
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Country') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Country') }}" id="country" name="country" value="{{ $dataUser->userinfo->country }}" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4" style="margin-top: 25px;">
                                <input type="hidden" name="id" value="{{ $dataUser->id }}" >
                                <input type="hidden" name="userinfo_id" value="{{ $dataUser->userinfo->id }}" >
                                <button type="button" class="btn btn-block btn-success" id="save_agent">{{ __('Update') }}</button>
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
    $('#save_agent').on('click', async function(){
        var form1 = $('.btn-success').closest('form');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        $.ajax({
            url: "{{ route('admin.update') }}",
            data:data,
            type: "PUT",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                } else{
                    window.location.href = "{{ route('admin.list') }}";
                    toastr.success('@lang("New affiliate agent has been added")', {timeOut: 5000});
                }
            }
        });
    });
</script>
<script src="{{ asset('js/custm.js') }}"></script>
@endpush