<div class="modal fade" id="addOrderModalside">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="register_event">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <label for="name" class="col-form-label">{{ __('Photo') }}<span style="color:darkred">*</span></label>
                            <br/>
                            <img id="preview" class="img-thumbnail" style="display:none;width:350px;">
                            <div>
                                <input type="file" name="photo" id="photo" class="file" accept="image/*">
                                <a class="btn btn-default" id="removeFile" style="display:none;">{{ __('Remove')}}</a>
                                <input type="hidden" id="current_photo" name="current_photo">
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Link</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Date</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Time</label>
                        <input type="time" class="form-control" name="time" id="time">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event type</label>
                        <div class="dropdown bootstrap-select form-control form-control-lg default-select">
                            <select class="form-control form-control-lg default-select eventtype" tabindex="-98" name="type">
                                <option value="free">Free Event</option>
                                <option value="paid">Paid Event</option>
                            </select>
                        </div>
                    </div>
                    <div class="eventprice form-group" style="display:none">
                        <label class="text-black font-w500">Event Price</label>
                        <input type="name" class="form-control" name="price" id="price_event">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Description</label>
                        <textarea class="form-control" rows="4" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="save_event">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
$
<script>

    $(document).ready(function(){
        $(".eventtype").on('change', function() {
            var type = $(this).val();
            if(type == 'paid'){
                $('.eventprice').show();
            }else if(type == 'free'){
                $('.eventprice').hide();
                $('#price_event').val('');
            }
        });

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#removeFile, #preview').show();
            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $("#removeFile").click(function(){
            $(".file").val('');
            $(' #preview').hide();
            $('#current_photo').val('');
            $(this).hide();
        });
    });

    $('#save_event').on('click', async function(){
        var form1 = $('#register_event');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        let fr = new FormData();
        let photo = $('#photo').prop('files')[0];
        let curr_photo = $('#current_photo').val();
        fr.append('photo', photo);
        fr.append('curr_photo', curr_photo);
        fr.append('edit', 'no');
        fr.append('_method', 'PUT');

        $.ajax({
            url: "{{ route('event.store') }}",
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
                                        $('#addOrderModalside').hide();
                                        toastr.success('@lang("New event has been added")', {timeOut: 5000});
                                    }
                                }
                            });
                        }
                    $('#addOrderModalside').hide();
                    toastr.success('@lang("New event has been added")', {timeOut: 5000});
                }
            }
        });
    });
</script>
<script src="{{ asset('js/custm.js') }}"></script>
@endpush