@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Donation</h4>
					</div>
                    <div class="card-body">
						<canvas id="myChart" width="400" height="200"></canvas>
					</div>
				</div>
			</div>

			<div class="col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Register</h4>
					</div>
                    <div class="card-body">
						<canvas id="myChart2" width="400" height="200"></canvas>
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

        tableDonationWeekly();

        tableRegisterWeekly();

    });

    function tableDonationWeekly(){
        $.ajax({
            url: "{{ route('donation.report.weekly') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {

                var curr = new Date();
                var first = curr.getDate() - curr.getDay();
                var last = first + 7; 
                var lastday = new Date(curr.setDate(last));

                var test = [];
                var taxis = [];  
                
                var i;
                var t=0;

                for (i = 6; i >= 0; i--) {
                    const yesterday = new Date(lastday);
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

    function tableRegisterWeekly(){
        $.ajax({
            url: "{{ route('register.report.weekly') }}",
            type: "GET",
            dataType: "json",
            success: function(data) {

                var curr = new Date();
                var first = curr.getDate() - curr.getDay();
                var last = first + 7; 
                var lastday = new Date(curr.setDate(last));

                var test = [];
                var taxis = [];  
                
                var i;
                var t=0;

                for (i = 6; i >= 0; i--) {
                    const yesterday = new Date(lastday);
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
                            test[t]=[d.count];
                        }
                    });
                    
                    t++;
                }

                const ctx = document.getElementById('myChart2').getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: taxis,
                        datasets: [{
                            label: 'Total Register',
                            data: test,
                            borderWidth: 1,
                            backgroundColor: "#FE634E",
                        }],
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision:0
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