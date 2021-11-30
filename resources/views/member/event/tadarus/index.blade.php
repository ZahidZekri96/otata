@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<!-- Add Order -->
		<div class="row">
			<div class="col-xl-12">
				<div class="tab-content">
					<div id="All" class="tab-pane active fade show">
						<div class="table-responsive">
							<table id="example2" class="table card-table display dataTablesCard">
								<thead>
									<tr class="text-center">
										<th>ID</th>
										<th>Event</th>
										<th>Event Time</th>
										<th>{{ ('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$y=1
									@endphp
									@foreach ($getEvent as $event)
									<tr class="text-center">
										<td>{{ $y }}</td>
										<td>{{ $event->event }}</td>
										<td>{{ date("h:i A", strtotime($event->event_time)) }}</td>
										<td>
											<button type="button" class="btn btn-primary btn-sm"><a href="{{ route('tadarus.edit',$event->id) }}" class="text-white">{{ ('Detail') }}</a></button>
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
@endcontent

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