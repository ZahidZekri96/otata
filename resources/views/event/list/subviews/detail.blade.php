@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-10">
							</div>
							<div class="col-md-2">
								<a class="btn btn-default" href="{{ route('event.list') }}" style="float: right;"><i class="fas fa-arrow-left"></i>&nbsp;{{ __('Back') }}</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<table class="table table-bordered table-striped" width="100%">
									<tbody>
										<tr>
										</tr>
										<tr>
											<td width="20%">{{ __('Event') }}</td>
											<td>{{ $getEvent->event }}</td>
										</tr>
										<tr>
											<td>{{ __('Event Link') }}</td>
											<td>{{ $getEvent->link }}</td>
										</tr>
										<tr>
											<td>{{ __('Event Date') }}</td>
											<td>{{ date("d-m-Y", strtotime($getEvent->event_date)) }}</td>
										</tr>
										<tr>
											<td>{{ __('Event Time') }}</td>
											<td>{{date("h:i A", strtotime($getEvent->event_time))}}</td>
										</tr>
										<tr>
											<td>{{ __('Description') }}</td>
											<td>{{ $getEvent->description }}</td>
										</tr>
										<tr>
											<td>{{ __('Type') }}</td>
											<td>{{ ucfirst($getEvent->type) }}</td>
										</tr>
										<tr>
											<td>{{ __('Price') }}</td>
											<td>RM {{  $getEvent->type == "paid" ? $getEvent->price : '0.00' }}</td>
										</tr>
										<tr>
											<td>{{ __('Created Date') }}</td>
											<td>{{ Carbon\Carbon::parse($getEvent->created_at)->format('d/m/Y') }}</td>
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