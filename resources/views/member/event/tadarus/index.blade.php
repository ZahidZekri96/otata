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
										<td>
											<a href="{{ $event->link }}"  class="mr-4" id="redirect">
												<i class="las la-external-link-alt scale-2"></i>
											</a>
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