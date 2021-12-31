@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form id="register_tadarus">
                        @csrf
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="email" class="col-form-label">{{ __('Event Name') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="{{ __('Enter email') }} ..." id="event" name="event" value="{{ $getEvent->event }}" >
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="event_date" class="col-form-label">{{ __('Event Link') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter Event Link') }} ..." id="link" name="link" value='{{ $getEvent->link }}' >
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="event_date" class="col-form-label">{{ __('Event Time') }}<span style="color:darkred">*</span></label>
                                    <input type="time" class="form-control" placeholder="{{ __('Enter Event Time') }} ..." id="event_time" name="event_time" value='{{ $getEvent->event_time }}' >
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="description" class="col-form-label">{{ __('Event Description') }}<span style="color:darkred">*</span></label>
                                    <textarea class="form-control" rows="4" id="description">{{ $getEvent->description }}</textarea>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <input type="hidden" name="event_id" id="event_id" value="{{ $getEvent->id }}">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-block btn-success" id="save_tadarus">{{ __('Edit') }}</button>
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
    $('#save_tadarus').on('click', async function(){
        var form1 = $('#register_tadarus');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        $.ajax({
            url: "{{ route('tadarus.update') }}",
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
                    toastr.success('@lang("Event has been edited")', {timeOut: 5000});
                    window.location.href= "{{ route('tadarus.index') }}";
                }
            }
        });
    });
</script>
@endpush