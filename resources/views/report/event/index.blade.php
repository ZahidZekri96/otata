@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
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
										<th>Event Data</th>
										<th>Event Time </th>
										<th>Type</th>
									</tr>
								</thead>
								<tbody>
									@php
										$t=1
									@endphp
									@foreach ($getEvent as $event)
									<tr>
										<td>{{ $t }}</td>
										<td>{{ $event->event }}</td>
										<td>{{ $event->event_date }}</td>
										<td>{{ $event->event_time }}</td>
										<td>{{ $event->type }}</td>
									</tr>
									@php 
										$t++
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
@endsection