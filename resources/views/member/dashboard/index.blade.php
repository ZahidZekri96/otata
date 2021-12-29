@extends('theme.main')

@section('content')

<div class="content-body">
    <div class="container-fluid">
		<div class="row" id="summary">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="mx-auto">
							<div class="text-center">
								<p class="fs-14 mb-1">Donation of This Week</p>
								<span class="fs-35 text-black font-w600">RM {{ $totalDonationWeek }}
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
                        <div class="mx-auto">
							<div class="text-center">
								<p class="fs-14 mb-1">Total Donation</p>
								<span class="fs-35 text-black font-w600">RM {{ $totalDonation }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
                        <div class="mx-auto">
							<div class="text-center">
								<p class="fs-14 mb-1">Joined Event</p>
								<span class="fs-35 text-black font-w600">{{ $totalEventRegister }}
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        
        <div class="row" id="donation">
            <div class="col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Upcoming Event</h4>
					</div>
                    <div class="card-body">
                        <table id="example2" class="table card-table display dataTablesCard">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $y=1
                                @endphp
                                @foreach ($getUpcomingEvent as $upcoming)
                                <tr>
                                    <td>{{ $y }}</td>
                                    <td>{{ $upcoming->event->event  }}</td>
                                    <td>{{ date("d-m-Y", strtotime($upcoming->event->event_date)) }} {{date("h:i A", strtotime($upcoming->event_time))}}</td>
                                    <td><a href="{{ $upcoming->event->link }}"><button type="button" class="btn btn-primary btn-sm">{{ __('Redirect') }}</button></a></td>
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

        <div class="row" id="event">
            <div class="col-xl-6">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Free Event</h4>
					</div>
                    <div class="card-body">
                        <table id="example2" class="table card-table display dataTablesCard">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $y=1
                                @endphp
                                @foreach ($getFreeEvent as $free)
                                <tr>
                                    <td>{{ $y }}</td>
                                    <td>{{ $free->event }}</td>
                                    <td>{{ date("d-m-Y", strtotime($free->event_date)) }} {{date("h:i A", strtotime($free->event_time))}}</td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#basicModal" class="mr-4 register" data-id="{{ Auth::user()->id }}" data-event="{{ $free->id }}" data-ename="{{ $free->event }}" data-type="{{ $free->type }}">
                                            <button type="button" class="btn btn-primary btn-sm">Register</button>
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

            <div class="col-xl-6">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Paid Event</h4>
					</div>
                    <div class="card-body">
                        <table id="example2" class="table card-table display dataTablesCard">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Date & Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $y=1
                                @endphp
                                @foreach ($getPaidEvent as $paid)
                                <tr>
                                    <td>{{ $y }}</td>
                                    <td>{{ $paid->event }}</td>
                                    <td>{{ $paid->event_date }} {{date("h:i A", strtotime($paid->event_time))}}</td>
                                    <td>
                                        <a href="" data-toggle="modal" data-target="#basicModal" class="mr-4 register" data-id="{{ Auth::user()->id }}" data-event="{{ $paid->id }}" data-ename="{{ $paid->event }}" data-type="{{ $paid->type }}">
                                            <button type="button" class="btn btn-primary btn-sm">Register</button>
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



@include('member.dashboard.modal.register')

@endsection


@push('script')
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