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
								<p class="fs-14 mb-1">Event Register</p>
								<span class="fs-35 text-black font-w600">{{ $totalRegister }}
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
								<p class="fs-14 mb-1">Subscription</p>
								<span class="fs-35 text-black font-w600">{{ ucfirst($subscribeStatus) }}
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
											<td>{{ Carbon\Carbon::parse($dataUser->created_at)->format('d/m/Y') }}</td>
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