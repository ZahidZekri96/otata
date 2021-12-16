@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form id="update_event">
                        @csrf
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="event" class="col-form-label">{{ __('Event Name') }}<span style="color:darkred">*</span></label>
                                    <div class="input-group">
                                        <input type="name" class="form-control" placeholder="{{ __('Enter event') }} ..." id="event" name="event" value="{{ $getEvent->event }}" >
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <label for="event_date" class="col-form-label">{{ __('Event Date') }}<span style="color:darkred">*</span></label>
                                    <input type="date" class="form-control" placeholder="{{ __('Enter event date') }} ..." id="event_date" name="event_date" value='{{ $getEvent->event_date }}' >
                                </div>
                                <div class="col-md-5">
                                    <label for="first_name" class="col-form-label">{{ __('Event Time') }}<span style="color:darkred">*</span></label>
                                    <input type="time" class="form-control" placeholder="{{ __('Enter event time') }} ..." id="event_time" name="event_time" value="{{ $getEvent->event_time }}" >
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="event_date" class="col-form-label">{{ __('Event Link') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter Event Link') }} ..." id="event_link" name="event_link" value='{{ $getEvent->link }}' >
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <label for="first_name" class="col-form-label">{{ __('Event Type') }}<span style="color:darkred">*</span></label>
                                    <div class="dropdown bootstrap-select form-control form-control-lg default-select">
                                        <select class="form-control form-control-lg default-select" tabindex="-98" name="type">
                                        @php
                                        if($getEvent->type == 'free'){
                                            echo '<option value="free">Free Event</option>';
                                        }else if($getEvent->type == 'paid'){
                                            echo '<option value="paid">Paid Event</option>';
                                        }
                                        @endphp
                                        </select>
                                    </div>
                                </div>
								<div class="col-md-5">
                                    <label for="type" class="col-form-label">{{ __('Price') }}<span style="color:darkred">*</span></label>
                                    @php
                                    if($getEvent->type == 'free'){
                                        $price = 0.00;
                                    }else if($getEvent->type == 'paid'){
                                        $price = $getEvent->price;
                                    }
                                    @endphp
                                    <input type="text" class="form-control" placeholder="{{ __('Price') }}" id="price" name="price" value="RM {{ number_format($price, 2, '.', '') }}">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="description" class="col-form-label">{{ __('Event Description') }}<span style="color:darkred">*</span></label>
                                    <textarea class="form-control" rows="4" id="description" name="description">{{ $getEvent->description }}</textarea>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <input type="hidden" name="id" id="id" value="{{ $getEvent->id }}">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-block btn-success" id="save_event">{{ __('Edit') }}</button>
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
$(document).ready(function () {
    $('.btn-success').on('click', async function(){
        var form1 = $('#update_event');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        $.ajax({
            url: "{{ route('event.update') }}",
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
                    $('#addOrderModalside').hide();
                    toastr.success('@lang("Event has been edited")', {timeOut: 5000});
                }
            }
        });
    });
});
</script>
@endpush