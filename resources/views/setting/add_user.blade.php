@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label for="code" class="col-form-label"></label>
                                <span style="color:#800000;"><b>* {{ __('Field is required') }}</b></span>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <form id="add_user">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label class="col-form-label" for="text-input"><strong>{{ __('Full Name') }}</strong></label>
                                <input class="form-control" id="text-input" type="text" name="name" placeholder="{{ __('Enter Full Name') }}">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label class="col-form-label" for="text-input"><strong>{{ __('Email') }}</strong></label>
                                <input class="form-control" id="text-input" type="text" name="email" placeholder="{{ __('Enter Email') }}">
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Password') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Password') }}" id="password" name="password" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="stock" class="col-form-label"><strong>{{ __('Gender') }}</strong><span style="color:darkred">*</span></label><br/>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="male">
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Male') }}</font></font>
                                </label>
                                &nbsp;
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="female">
                                    <font style="vertical-align: inherit;"><font style="font-weight: normal !important;">{{ __('Female') }}</font></font>
                                </label>
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Type') }}</strong><span style="color:darkred">*</span></label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">{{ __('Select Type') }}</option>
                                    <option value="admin">{{ __('Admin') }}</option>
                                    <option value="member">{{ __('Member') }}</option>
                                    </select>
                                </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="phone" class="col-form-label"><strong>{{ __('Phone No.') }}</strong><span style="color:darkred">*</span></label><br/>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Phone No.') }}" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-1"></div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <label for="name" class="col-form-label"><strong>{{ __('Address') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Address') }}" id="address" name="address" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Postcode') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Postcode') }}" id="postcode" name="postcode" required>
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('City') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter City') }}" id="city" name="city" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('State') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter State') }}" id="state" name="state" required>
                            </div>
                            <div class="col-md-5">
                                <label for="name" class="col-form-label"><strong>{{ __('Country') }}</strong><span style="color:darkred">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ __('Enter Country') }}" id="country" name="country" required>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4" style="margin-top: 25px;">
                                <button type="button" class="btn btn-block btn-success" id="save_agent">{{ __('Save') }}</button>
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
            url: "{{ route('setting.user.create') }}",
            data:data,
            type: "POST",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                } else{
                    toastr.success('@lang("New user has been added")', {timeOut: 5000});
                }
            }
        });
    });
</script>
@endpush