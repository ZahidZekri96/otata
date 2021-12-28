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
										<th>ID</th>
										<th>{{ __('Event') }}</th>
										<th>{{ __('Event Date') }}</th>
										<th>{{ __('Event Time') }} </th>
										<th>{{ __('Type') }}</th>
										<th>{{ __('Total Registerd') }}</th>
										<th>{{ __('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$t=1
									@endphp
									@foreach ($getEvent as $event)
									<tr>
										<td>{{ $t }}</td>
										<td>{{ $event->event }}</td>
										<td>{{ date("d-m-Y", strtotime($event->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($event->event_time))}}</td>
										<td>{{ ucfirst($event->type) }}</td>
										<td></td>
										<td>
											<button type="button" class="btn btn-primary btn-sm"><a href="{{ $event->link }}" class="text-white">{{ ('Redirect') }}</a></button>
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