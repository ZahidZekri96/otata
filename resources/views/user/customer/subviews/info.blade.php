@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
		<div class="row">
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-end"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
							<div>
								<p class="fs-14 mb-1">Donation</p>
								<span class="fs-35 text-black font-w600">93
									<svg class="ml-1" width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.00401 11.1924C0.222201 11.1924 -0.670134 9.0381 0.589795 7.77817L7.78218 0.585786C8.56323 -0.195262 9.82956 -0.195262 10.6106 0.585786L17.803 7.77817C19.0629 9.0381 18.1706 11.1924 16.3888 11.1924H2.00401Z" fill="#33C25B"></path>
									</svg>
								</span>
							</div>
							<canvas class="lineChart chartjs-render-monitor" id="chart_widget_2" height="85" style="display: block;" width="143"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-end"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
							<div>
								<p class="fs-14 mb-1">Joined Event</p>
								<span class="fs-35 text-black font-w600">93
									<svg class="ml-1" width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.00401 11.1924C0.222201 11.1924 -0.670134 9.0381 0.589795 7.77817L7.78218 0.585786C8.56323 -0.195262 9.82956 -0.195262 10.6106 0.585786L17.803 7.77817C19.0629 9.0381 18.1706 11.1924 16.3888 11.1924H2.00401Z" fill="#33C25B"></path>
									</svg>
								</span>
							</div>
							<canvas class="lineChart chartjs-render-monitor" id="chart_widget_2" height="85" style="display: block;" width="143"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-end"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
							<div>
								<p class="fs-14 mb-1">Subscription</p>
								<span class="fs-35 text-black font-w600">93
									<svg class="ml-1" width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M2.00401 11.1924C0.222201 11.1924 -0.670134 9.0381 0.589795 7.77817L7.78218 0.585786C8.56323 -0.195262 9.82956 -0.195262 10.6106 0.585786L17.803 7.77817C19.0629 9.0381 18.1706 11.1924 16.3888 11.1924H2.00401Z" fill="#33C25B"></path>
									</svg>
								</span>
							</div>
							<canvas class="lineChart chartjs-render-monitor" id="chart_widget_2" height="85" style="display: block;" width="143"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-10">
							</div>
							<div class="col-md-2">
								<a class="btn btn-default" href="" style="float: right;"><i class="fas fa-arrow-left"></i>&nbsp;{{ __('Back') }}</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<table class="table table-bordered table-striped" width="100%">
									<tbody>
										<tr>
											<td>{{ __('Name') }}</td>
											<td>{{ $dataUser->name }}</td>
										</tr>
										<tr>
											<td>{{ __('Email') }}</td>
											<td>{{ $dataUser->email }}</td>
										</tr>
										<tr>
											<td>{{ __('Phone Number') }}</td>
											<td>{{ $dataUser->userinfo->hpnum }}</td>
										</tr>
										<tr>
											<td>{{ __('Gender') }}</td>
											<td>{{ ucfirst($dataUser->userinfo->gender) }}</td>
										</tr>
										<tr>
											<td>{{ __('Address') }}</td>
											<td>{{ $dataUser->userinfo->address }}</td>
										</tr>
										<tr>
											<td>{{ __('City') }}</td>
											<td>{{ $dataUser->userinfo->city }}</td>
										</tr>
										<tr>
											<td>{{ __('State') }}</td>
											<td>{{ $dataUser->userinfo->state }}</td>
										</tr>
										<tr>
											<td>{{ __('Country') }}</td>
											<td>{{ $dataUser->userinfo->country }}</td>
										</tr>
										<tr>
											<td>{{ __('Registration Date') }}</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-1"></div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection