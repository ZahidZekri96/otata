@extends('theme.main')

@section('content')

<!--begin::Modal-->
@include('member.event.list.modal.register')
<!--end::Modal-->

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
										<td>{{ date("d-m-Y", strtotime($event->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($event->event_time))}}</td>
										<td>{{ ucfirst($event->type) }}</td>
										@php
											$id = Auth::user()->id;
											$r=0;
											foreach ($event->event_register as $value) {
												$userid = $value['user_id'];
												if ($userid == $id) {
													$r = 1;
												}
											}
											if($r == 1){
												echo '<td><span class="badge badge-success">Register</span></td>';
											}else{
												echo '<td><span class="badge badge-warning">Not Register</span></td>';
											}
											
										@endphp
										<td>
											<div class="d-flex align-items-center">
												<a href="detail/{{$event->id}}" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
												@php
												if($r == 0){
												@endphp
													<a href="" data-toggle="modal" data-target="#basicModal" class="mr-4 register" data-id="{{ Auth::user()->id }}" data-event="{{ $event->id }}" data-ename="{{ $event->event }}" data-type="{{ $event->type }}">
													<i class="las la-registered scale-2"></i>
													</a>
												@php
												}else if($r==1){
												@endphp
												<a href="{{ $event->link }}"  class="mr-4" id="redirect">
													<i class="las la-external-link-alt scale-2"></i>
												</a>
												@php
												}
												@endphp
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
										<td>{{ date("d-m-Y", strtotime($freeEvent->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($freeEvent->event_time))}}</td>
										<td>{{ ucfirst($freeEvent->type) }}</td>
										@php
											$id = Auth::user()->id;
											$r=0;
											foreach ($freeEvent->event_register as $value) {
												$userid = $value['user_id'];
												if ($userid == $id) {
													$r = 1;
												}
											}
											if($r == 1){
												echo '<td><span class="badge badge-success">Register</span></td>';
											}else{
												echo '<td><span class="badge badge-warning">Not Register</span></td>';
											}
											
										@endphp
										<td>
											<div class="d-flex align-items-center">
												<a href="detail/{{$freeEvent->id}}" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
												@php
												if($r == 0){
												@endphp
													<a href="javascript:void(0)" class="mr-4" id="register" data-id="{{ Auth::user()->id }}" data-event="{{ $freeEvent->id }}">
														<i class="las la-registered scale-2"></i>
													</a>
												@php
												}else if($r==1){
												@endphp
												<a href="{{ $freeEvent->link }}"  class="mr-4" id="redirect">
													<i class="las la-external-link-alt scale-2"></i>
												</a>
												@php
												}
												@endphp
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
										<td>{{ date("d-m-Y", strtotime($paidEvent->event_date)) }}</td>
										<td>{{date("h:i A", strtotime($paidEvent->event_time))}}</td>
										<td>{{ ucfirst($paidEvent->type) }}</td>
										@php
											$id = Auth::user()->id;
											$r=0;
											foreach ($paidEvent->event_register as $value) {
												$userid = $value['user_id'];
												if ($userid == $id) {
													$r = 1;
												}
											}
											if($r == 1){
												echo '<td><span class="badge badge-success">Register</span></td>';
											}else{
												echo '<td><span class="badge badge-warning">Not Register</span></td>';
											}
											
										@endphp
										<td>
											<div class="d-flex align-items-center">
												
												<a href="detail/{{$paidEvent->id}}" class="mr-4">
													<i class="las la-list-alt scale-2"></i>
												</a>
												@php
												if($r == 0){
												@endphp
													<a href="javascript:void(0)" class="mr-4" id="register" data-id="{{ Auth::user()->id }}" data-event="{{ $paidEvent->id }}">
														<i class="las la-registered scale-2"></i>
													</a>
												@php
												}else if($r==1){
												@endphp
												<a href="{{ $paidEvent->link }}"  class="mr-4" id="redirect">
													<i class="las la-external-link-alt scale-2"></i>
												</a>
												@php
												}
												@endphp
											</div>
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

@include('member.event.list.modal.register')

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
		$('#example tbody').on('click', 'tr', function () {
			var data = table.row( this ).data();
			
		});
	})(jQuery);
</script>
<script>
	$(document).ready(function(){
		$(".register").on('click', function() {
			var id = $(this).data('id');
			var event = $(this).data('event');
			var ename = $(this).data('ename');
			var type = $(this).data('type');

			$('#register_id').val(id);
			$('#register_event').val(event);
			$('#register_type').val(type);
			document.getElementById('event_name').innerHTML = ename;

			$('#basicModal').modal('show');
		});
	});
</script>

<script>
$(document).ready(function(){
  $("#btn-register").click(function(){
	  
	var id = $('#register_id').val();
	var event = $('#register_event').val();
	var type = $('#register_type').val();
	
	if(type == 'free'){
		$.ajax({
			url: "{{ route('member.register.add') }}",
			data:{
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
	}else if(type == 'paid'){
		$.ajax({
			url: "{{ route('member.register.paid') }}",
			data:{
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
					var url         = "{{ route('senangpay.event.paid', [':id',':order_id']) }}";
					let order_id = data.object.order_id;
					
					url             = url.replace(':id',event);
					url				= url.replace(':order_id',order_id);
					window.location.href = url;
					
				}
			}
		});
	}
  });
});
</script>
@endpush