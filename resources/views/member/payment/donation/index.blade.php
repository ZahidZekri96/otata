@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="card ">
                    <div class="card-body">
                        <form>
                            <div id="selectAmount" class="form-group mx-auto w-50">
                                <button id="amount-0" class="btn btn-info btnprice" type="button" value="25.00" class="btn btn-light">RM25</button>
                                <button id="amount-1" class="btn btn-info btnprice" type="button" value="50.00">RM50</button>
                                <button id="amount-2" class="btn btn-info btnprice" type="button" value="100.00">RM100</button>
                                <button id="amount-3" class="btn btn-info btnprice" type="button" value="250.00">RM250</button>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">or enter amount</label>
                                <input type="text" class="form-control" name="donation_price" id="donation_price" placeholder="RM">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Payment Method</label>
                                <div class="dropdown bootstrap-select form-control form-control-lg default-select">
                                    <select class="form-control form-control-lg default-select" tabindex="-98" name="donation_type" id="donation_type">
                                        <option value="senangpay">senangPay</option>
                                    </select>
                                </div>
                                <input type="hidden" name="userid" id="userid" value="{{ Auth::user()->id }}">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btn-donate">Donate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
$(document).ready(function(){

    $('.btnprice').click(function(){
        var btnprice = $(this).val();
        $('#donation_price').val(btnprice);
    });

    $("#btn-donate").click(function(){
        
        var cost = $('#donation_price').val();
        var type = $('#donation_type').val();
        var userid = $('#userid').val();

        $.ajax({
            url: "{{ route('member.donation.add') }}",
            data:{
                "cost": cost,
                "type": type,
                "userid": userid
            },
            type: "POST",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                } else{
                    var url         = "{{ route('senangpay.donation.paid', [':donation',':order_id']) }}";
					let order_id = data.object.order_id;
                    let donation = data.object.donation;
					
					url             = url.replace(':donation',donation);
					url				= url.replace(':order_id',order_id);
					window.location.href = url;
                }
            }
        });
    });
});
</script>
@endpush