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
										<th>Name</th>
										<th>Email</th>
										<th>Type</th>
										<th style="width:20%;">Action</th>
									</tr>
								</thead>
								<tbody>
									@php
										$y=1
									@endphp
									@foreach ($getUser as $user)
									<tr>
										<td>{{ $y }}</td>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ ucfirst($user->type) }}</td>
										<td>
											<a href="{{ route('admin.edit', $user->id) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">{{ __('Edit') }}</a>
											<a href="{{ route('admin.info', $user->id) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">{{ __('Detail') }}</a>
											<button type="button" class="btn btn-primary btn-sm btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">{{ ('Delete') }}</button>
										</td>
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

@include('user.customer.modals.delete_modal')
@endsection

@push('script')
<script src="{{ asset('theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$(".btn-delete").click(function(){

			var id      = $(this).data('id');
			var name    = $(this).data('name');

			$('.delete_id').val(id);
			document.getElementById('delete_name').innerHTML    = name;

			$('#modal_delete_customer').modal('show');
		});
	});

	$(document).ready(function() {
        $('.btn-delete-customer').on('click', function () {
            deleteCustomer();
        });
	});

	function deleteCustomer() {
        var id = $('.delete_id').val();
        var url = "{{ route('customer.destroy', ':id') }}";
        url = url.replace(':id',id);

        $.ajax({
            url: url,
            type: "DELETE",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                } else{
                    toastr.success('@lang("Customer Deleted")', {timeOut: 5000});
                    $('#modal_delete_customer').modal('hide');
					window.location.href = "{{ route('customer.list') }}";
                }
            }
        });
    }
</script>
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