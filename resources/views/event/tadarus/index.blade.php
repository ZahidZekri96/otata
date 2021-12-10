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
										<th>{{ ('Action') }}</th>
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
											<button type="button" class="btn btn-primary btn-sm"><a href="{{ route('tadarus.edit',$event->id) }}" class="text-white">{{ ('Edit') }}</a></button>
											<button type="button" class="btn btn-primary btn-sm"><a href="{{ $event->link }}" class="text-white">{{ ('Redirect') }}</a></button>									
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
@endpush