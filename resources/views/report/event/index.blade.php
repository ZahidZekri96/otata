@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="tab-content">
					<div id="All" class="tab-pane active fade show">
						<div class="table-responsive">
							<table id="example2" class="table card-table display dataTablesCard">
                                <thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">{{ __('Event') }}</th>
										<th class="text-center">{{ __('Event Date') }}</th>
										<th class="text-center">{{ __('Event Time') }} </th>
										<th class="text-center">{{ __('Type') }}</th>
										<th class="text-center">{{ __('Total Registerd') }}</th>
										<th class="text-center">{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$t=1
									@endphp
									@foreach ($getEvent as $event)
									<tr>
										<td class="text-center">{{ $t }}</td>
										<td class="text-center">{{ $event->event }}</td>
										<td class="text-center">{{ date("d-m-Y", strtotime($event->event_date)) }}</td>
										<td class="text-center">{{date("h:i A", strtotime($event->event_time))}}</td>
										<td class="text-center">{{ ucfirst($event->type) }}</td>
										<td class="text-center">{{ $event->event_register_count }}</td>
										<td class="text-center">
											<button type="button" class="btn btn-primary btn-sm"><a href="{{ route('report.registered',$event->id) }}" class="text-white">{{ ('Registered') }}</a></button>
										</td>
									</tr>
									@php 
										$t++
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