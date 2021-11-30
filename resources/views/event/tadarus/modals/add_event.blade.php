<div class="modal fade" id="addTadarusModalside">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="register_tadarus">
                    @csrf
                    <div class="form-group">
                        <label class="text-black font-w500">Event Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Link</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Event Time</label>
                        <input type="time" class="form-control" name="time" id="time">
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Description</label>
                        <textarea class="form-control" rows="4" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="save_tadarus">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script>
    $('#save_tadarus').on('click', async function(){
        var form1 = $('#register_tadarus');
        var formData = await getAllInput(form1);
        var data = processSerialize(formData);

        $.ajax({
            url: "{{ route('tadarus.add') }}",
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
                    $('#addTadarusModalside').hide();
                    toastr.success('@lang("New event has been added")', {timeOut: 5000});
                    window.location.href= "{{ route('tadarus.index') }}";
                }
            }
        });
    });
</script>
<script src="{{ asset('js/custm.js') }}"></script>
@endpush