@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<!-- Add Order -->
		<div class="d-flex flex-wrap mb-2 align-items-center justify-content-between">
			<div class="event-tabs mb-3 mr-3">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#All" role="tab" aria-selected="true">
							All
						</a>
					</li>
				</ul>
			</div>
			<div class="d-flex mb-3">
				<a href="javascript:void(0)" class="btn btn-primary text-nowrap" data-toggle="modal" data-target="#addTadarusModalside"><i class="fa fa-file-text scale5 mr-3" aria-hidden="true"></i>{{ ('Add New Event') }}</a>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="tab-content">
					<div id="All" class="tab-pane active fade show">
						<div class="table-responsive">
							<table id="example2" class="table card-table display dataTablesCard">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event</th>
										<th>Event Time</th>
										<th>Created Date</th>
										<th width="20%">{{ ('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$y=1
									@endphp
									@foreach ($getEvent as $event)
									<tr>
										<td>{{ $y }}</td>
										<td>{{ $event->event }}</td>
										<td>{{ date("h:i A", strtotime($event->event_time)) }}</td>
										<td>{{ date("d/m/Y h:i A", strtotime($event->created_at)) }}</td>
										<td>
											<a href="{{ route('tadarus.edit',$event->id) }}" class="text-white"><button type="button" class="btn btn-primary btn-sm">{{ ('Edit') }}</button></a>
											<a class="text-white" href="{{ route('tadarus.detail',$event->id) }}"><button type="button" class="btn btn-primary btn-sm" data-id="{{ $event->id }}">{{ ('Detail') }}</button></a>							
											<button type="button" class="btn btn-primary btn-sm btn-delete" data-id="{{ $event->id }}" data-name="{{ $event->event }}">{{ ('Delete') }}</button>
										</td>
									</tr>
									@php 
										$y++
									@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--begin::Modal-->
@include('event.tadarus.modals.add_event')
@include('event.tadarus.modals.delete_modal')
<!--end::Modal-->
@endsection

@push('script')
<script src="{{ asset('theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script>
	(function($) {
		var table = $('#example2').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		$('#example tbody').on('click', 'tr', function () {
			var data = table.row( this ).data();
			
		});
	})(jQuery);
</script>
<script>
	$(document).ready(function(){
		$(".btn-delete").click(function(){

			var id      = $(this).data('id');
			var name    = $(this).data('name');

			$('.delete_id').val(id);
			document.getElementById('delete_name').innerHTML    = name;

			$('#modal_delete_event').modal('show');
		});
	});

	$(document).ready(function() {
        $('.btn-delete-event').on('click', function () {
            deleteEvent();
        });
	});

	function deleteEvent() {
        var id = $('.delete_id').val();
        var url = "{{ route('tadarus.destroy', ':id') }}";
        url = url.replace(':id',id);

        $.ajax({
            url: url,
            type: "DELETE",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                } else{
                    toastr.success('@lang("Event Deleted")', {timeOut: 5000});
					window.location.href = "{{ route('tadarus.index') }}";
                }
            }
        });
    }
</script>
@endpush