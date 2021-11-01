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
										<th>Register</th>
										<th>Action</th>
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
										<td>{{ $event->event_date }}</td>
										<td>{{ $event->event_time }}</td>
										<td>{{ ucfirst($event->type) }}</td>
										<td></td>
										<td>
											<div class="d-flex align-items-center">
												<a href="javascript:void(0)" class="mr-4" id="register" data-event="4" data-id="{{ $event->id }}">
													<i class="las la-registered scale-2"></i>
												</a>
												<a href="javascript:void(0)" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
											</div>
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
										<th>Register</th>
										<th>Action</th>
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
										<td>{{ $freeEvent->event_date }}</td>
										<td>{{ $freeEvent->event_time }}</td>
										<td>{{ ucfirst($freeEvent->type) }}</td>
										<td></td>
										<td>
											<div class="d-flex align-items-center">
												<a href="javascript:void(0)" class="mr-4" id="register" data-event="4" data-id="{{ $freeEvent->id }}">
													<i class="las la-registered scale-2"></i>
												</a>
												<a href="javascript:void(0)" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
											</div>
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
										<th>Register</th>
										<th>Action</th>
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
										<td>{{ $paidEvent->event_date }}</td>
										<td>{{ $paidEvent->event_time }}</td>
										<td>{{ ucfirst($paidEvent->type) }}</td>
										<td></td>
										<td>
											<div class="d-flex align-items-center">
												<a href="javascript:void(0)" class="mr-4" id="register" data-event="4" data-id="{{ $paidEvent->id }}">
													<i class="las la-registered scale-2"></i>
												</a>
												<a href="javascript:void(0)" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
											</div>
										</td>
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

<script>
$(document).ready(function(){
  $("#register").click(function(){
    $.ajax({
		url: "{{ route('member.register.add') }}",
		data:{
			"_token": "{{ csrf_token() }}",
			"id": id,
			"event": event
		},
		type: "POST",
		dataType: "json",
		success: function(data) {
			if(data.message != 'success'){
				var errors = data;
				$.each(errors, function(index, sm){
					toastr.error(sm, {timeOut: 5000});
				});
			} else{
				window.location.href = "{{ route('member.event.list') }}";
				toastr.success('@lang("You have registered the event")', {timeOut: 5000});
			}
		}
	});
  });
});
</script>
@endpush