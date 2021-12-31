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
                                    <label for="name" class="col-form-label">{{ __('Photo') }}<span style="color:darkred">*</span></label>
                                    <br/>
                                    <img id="event_preview" class="img-thumbnail" style="display:none;width:350px;">
                                    <div>
                                        <input type="file" name="event_photo" id="event_photo" class="event_file" accept="image/*">
                                        <a class="btn btn-default" id="event_removeFile" style="display:none;">{{ __('Remove')}}</a>
                                        <input type="hidden" id="event_current_photo" name="event_current_photo">
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
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
                                    <label for="event_link" class="col-form-label">{{ __('Event Link') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter Event Link') }} ..." id="event_link" name="event_link" value='{{ $getEvent->link }}' >
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <label for="location" class="col-form-label">{{ __('Event Location') }}<span style="color:darkred">*</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('Enter Event Location') }} ..." id="location" name="location" value='{{ $getEvent->location }}' >
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

    $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#event_removeFile, #event_preview').show();
            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("event_preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $("#event_removeFile").click(function(){
            $(".event_file").val('');
            $('#event_preview').hide();
            $('event_#current_photo').val('');
            $(this).hide();
        });

        var hold = "{{ $getEvent->banner != null ? $getEvent->banner->filename : 'null' }}";
        if(hold != 'null'){
            $('#event_removeFile, #event_preview').show();
            document.getElementById("event_preview").src = "../../storage/images/"+hold;
            $('#event_current_photo').val(hold);
        }


    $('.btn-success').on('click', async function(){
        var form1 = $('#update_event');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        let fr = new FormData();
        let photo = $('#event_photo').prop('files')[0];
        let curr_photo = $('#event_current_photo').val();
        fr.append('photo', photo);
        fr.append('edit', 'yes');
        fr.append('curr_photo', curr_photo);
        fr.append('_method', 'PUT');

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
                    if(photo)
                    {
                        fr.append('id', data.object);
                        $.ajax({
                            url: "{{ route('event.store.banner') }}",
                            data:fr,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            success: function(data) {
                                if(data.message != 'success'){
                                    $("#loading-overlay").hide();
                                    var errors = data;
                                    $.each(errors, function(index, sm){
                                        toastr.error(sm, {timeOut: 5000});
                                    });
                                } else{
                                    window.location.href = "{{ route('event.list') }}";
                                    toastr.success('@lang("Event has been updated")', {timeOut: 5000});
                                }
                            }
                        });
                    }
                    else {
                        fr.append('id', data.object);
                        $.ajax({
                            url: "{{ route('event.store.banner') }}",
                            data:fr,
                            type: "POST",
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            success: function(data) {
                                if(data.message != 'success'){
                                    $("#loading-overlay").hide();
                                    var errors = data;
                                    $.each(errors, function(index, sm){
                                        toastr.error(sm, {timeOut: 5000});
                                    });
                                } else{
                                    window.location.href = "{{ route('event.list') }}";
                                    toastr.success('@lang("Event has been updated")', {timeOut: 5000});
                                }
                            }
                        });
                    }
                    $('#addOrderModalside').hide();
                    toastr.success('@lang("Event has been edited")', {timeOut: 5000});
                }
            }
        });
    });
});
</script>
<script src="{{ asset('js/custm.js') }}"></script>
@endpush