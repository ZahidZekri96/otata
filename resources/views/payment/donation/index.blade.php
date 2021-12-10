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
										<th style="text-align:center">ID</th>
										<th style="text-align:center">User</th>
										<th style="text-align:center">Order ID</th>
										<th style="text-align:center">Donation</th>
                                        <th style="text-align:center">Senangpay ID</th>
										<th style="text-align:center">Status</th>
									</tr>
								</thead>
								<tbody>
									@php
										$y=1
									@endphp
									@foreach ($getDonation as $donation)
									<tr>
										<td style="text-align:center"> {{ $y }}</td>
										<td style="text-align:center">{{ $donation->user->name }}</td>
										<td style="text-align:center">{{ $donation->order_id }}</td>
                                        <td style="text-align:center">RM {{ $donation->cost }}</td>
										<td style="text-align:center">{{ $donation->senangpay != null ? $donation->senangpay->transaction_id : "-"  }}</td>
										<td style="text-align:center">{{ ucfirst($donation->status) }}</td>
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
        $('#example2 tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            
        });
    })(jQuery);
</script>
@endpush