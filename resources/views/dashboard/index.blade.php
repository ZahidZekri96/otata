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
								<p class="fs-14 mb-1">Membership Registration</p>
								<span class="fs-35 text-black font-w600">{{ $totalMember }}
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        
        <div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Donation</h4>
					</div>
                    <div class="card-body">
						<canvas id="myChart" width="200" height="80"></canvas>
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
                                    <td>{{ $upcoming->event  }}</td>
                                    <td>{{ date("d-m-Y", strtotime($upcoming->event_date)) }} {{date("h:i A", strtotime($upcoming->event_time))}}</td>
                                    <td><a href="{{ route('event.detail', $upcoming->id) }}"><button type="button" class="btn btn-primary btn-sm">{{ ('Detail') }}</button></a></td>
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
                                    <td><a href="{{ route('event.detail', $free->id) }}"><button type="button" class="btn btn-primary btn-sm">{{ ('Detail') }}</button></a></td>
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
                                    <td>{{  date("d-m-Y", strtotime($paid->event_date)) }} {{date("h:i A", strtotime($paid->event_time))}}</td>
                                    <td><a href="{{ route('event.detail', $paid->id) }}"><button type="button" class="btn btn-primary btn-sm">{{ ('Detail') }}</button></a></td>
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

@endsection


@push('script')
<script src="{{ asset('theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins-init/chartjs-init.js') }}"></script>

<script>
    $(document).ready(function() {

        tableSalesGraph();

    });

    function tableSalesGraph(){
        $.ajax({
            url: "{{ route('main.seven') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {

                const today = new Date();
                var test = [];
                var taxis = [];  
                
                var i;
                var t=0;

                for (i = 6; i >= 0; i--) {
                    const yesterday = new Date(today);
                    yesterday.setDate(yesterday.getDate() - i);

                    yesterday.toDateString();
                    var month = yesterday.getMonth()+1;
                    if(month<10){
                        month = "0"+month;
                    }

                    var toda = yesterday.getDate();
                    if(toda<10){
                        toda="0"+toda;
                    }

                    var y = toda+"-"+month+"-"+yesterday.getFullYear();
                    var z = yesterday.getFullYear()+"-"+month+"-"+toda;

                    taxis.push([y]);

                    $.each(data.object.seven, function(index, d){
                        if(z == d.date){
                            test[t]=[d.total_donation];
                        }
                    });
                    
                    t++;
                }

                const ctx = document.getElementById('myChart').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: taxis,
                        datasets: [{
                            label: 'Total Donation (RM)',
                            data: test,
                            borderWidth: 1,
                            backgroundColor: "#FE634E",
                        }],
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            }
        });
    }
</script>

@endpush