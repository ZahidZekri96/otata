@extends('theme.main')

@section('content')

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<!-- Add Order -->
		<div class="row">
			<div class="col-xl-12">
				<div class="tab-content">
					<div id="All" class="tab-pane active fade show">
						<div class="table-responsive">
							<table id="example2" class="table card-table display dataTablesCard">
								<thead>
									<tr>
										<th>ID</th>
										<th>User</th>
										<th>Order ID</th>
										<th>Valid Start</th>
                                        <th>Valid End</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@php
										$y=1
									@endphp
									@foreach ($getSubscription as $sub)
									<tr>
										<td>{{ $y }}</td>
										<td>{{ $sub->user->name }}</td>
                                        <td>{{ $sub->order_id }}</td>
										<td>{{ date("d/m/Y h:i A", strtotime($sub->valid_start)) }}</td>
										<td>{{date("d/m/Y h:i A", strtotime($sub->valid_end))}}</td>
										<td>{{ ucfirst($sub->status) }}</td>
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