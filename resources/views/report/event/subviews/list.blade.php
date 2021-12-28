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
										<th>{{ __('Name') }}</th>
										<th>{{ __('E-mail') }}</th>
										<th>{{ __('Registered Date') }}</th>
										<th>{{ __('Registered Time') }} </th>
								</thead>
								<tbody>
									@php
										$t=1
									@endphp
									@foreach ($getRegistered as $registered)
									@if ($registered->user != null)
									<tr>
										<td>{{ $t }}</td>
										<td>{{ $registered->user->name}}</td>
										<td>{{ $registered->user->email}}</td>
										<td>{{ date("d-m-Y", strtotime($registered->created_at)) }}</td>
										<td>{{date("h:i A", strtotime($registered->created_at))}}</td>
									</tr>
									@endif
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
@endpush