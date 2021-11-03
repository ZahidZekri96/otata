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
								<span class="fs-35 text-black font-w600">RM 10.00
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
								<span class="fs-35 text-black font-w600">RM 93.00
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
								<span class="fs-35 text-black font-w600">2
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
                                @foreach ($getFreeEvent as $free)
                                <tr>
                                    <td>{{ $y }}</td>
                                    <td>{{ $free->event  }}</td>
                                    <td>{{ date("d-m-Y", strtotime($free->event_date)) }} {{date("h:i A", strtotime($free->event_time))}}</td>
                                    <td><button type="button" class="btn btn-primary btn-sm">Join</button></td>
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
                                    <td><button type="button" class="btn btn-primary btn-sm">Register</button></td>
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
                                    <td><button type="button" class="btn btn-primary btn-sm">Register</button></td>
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

@endcontent


@push('script')
<script src="{{ asset('theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('theme/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('theme/js/plugins-init/chartjs-init.js') }}"></script>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        datasets: [{
            label: 'Total Donation',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endpush