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
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#FreeEvent" role="tab" aria-selected="false">
							Free Event
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#PaidEvent" role="tab" aria-selected="false">
							Paid Event
						</a>
					</li>
				</ul>
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
										<th>Event Date</th>
										<th>Event Time </th>
										<th>Type</th>
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
										<td>{{ date("d-m-Y", strtotime($event->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($event->event_time))}}</td>
										<td>{{ ucfirst($event->type) }}</td>
										<td><a class="text-white" href="{{ route('event.detail',$event->id) }}"><button type="button" class="btn btn-primary btn-sm" data-id="{{ $event->id }}">{{ ('Edit') }}</button></a></td>
									</tr>
									@php 
										$y++
									@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div id="FreeEvent" class="tab-pane fade">
						<div class="table-responsive">
							<table id="example3" class="table card-table display dataTablesCard">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event</th>
										<th>Event Date</th>
										<th>Event Time </th>
										<th>Type</th>
										<th>{{ ('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$t=1
									@endphp
									@foreach ($getFreeEvent as $freeEvent)
									<tr>
										<td>{{ $t }}</td>
										<td>{{ $freeEvent->event }}</td>
										<td>{{ date("d-m-Y", strtotime($freeEvent->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($freeEvent->event_time))}}</td>
										<td>{{ ucfirst($freeEvent->type) }}</td>
										<td><a class="text-white" href="{{ route('event.detail',$freeEvent->id) }}"><button type="button" class="btn btn-primary btn-sm" data-id="{{ $freeEvent->id }}">{{ ('Edit') }}</button></a></td>
									</tr>
									@php 
										$t++
									@endphp
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div id="PaidEvent" class="tab-pane fade">
						<div class="table-responsive">
							<table id="example4" class="table card-table display dataTablesCard">
								<thead>
									<tr>
										<th>ID</th>
										<th>Event</th>
										<th>Event Date</th>
										<th>Event Time </th>
										<th>Type</th>
										<th>{{ ('Action') }}</th>
									</tr>
								</thead>
								<tbody>
									@php
										$p=1
									@endphp
									@foreach ($getPaidEvent as $paidEvent)
									<tr>
										<td>{{ $p }}</td>
										<td>{{ $paidEvent->event }}</td>
										<td>{{ date("d-m-Y", strtotime($paidEvent->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($paidEvent->event_time))}}</td>
										<td>{{ ucfirst($paidEvent->type) }}</td>
										<td><a class="text-white" href="{{ route('event.detail',$paidEvent->id) }}"><button type="button" class="btn btn-primary btn-sm" data-id="{{ $paidEvent->id }}">{{ ('Edit') }}</button></a></td>
									</tr>
									@php 
										$p++
									@endphp
									@endforeach
								</tbody>
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
		var table = $('#example3').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example4').DataTable({
			searching: false,
			paging:true,
			select: false,
			//info: false,         
			lengthChange:false 
			
		});
		var table = $('#example5').DataTable({
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