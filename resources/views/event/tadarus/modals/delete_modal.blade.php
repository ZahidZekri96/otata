<div class="modal fade" id="modal_delete_event" style="z-index: 99999">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete Event') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('Do you want to delete this event?') }}</p>
                <label id="delete_name"></label>
                <input type="hidden" name="delete_id" class="form-control m-input delete_id" id="delete_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-delete-event">{{ __('Yes') }}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('No') }}</button>
            </div>
        </div>
    </div>
</div>