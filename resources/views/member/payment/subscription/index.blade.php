@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card ">
                    <div class="card-body">
                        <form>
                            <div class="purchaseList">
                                <table class="table table-bordered" width="100%">
                                    <thead class="tble-header">
                                        <tr>
                                            <th class="50%">Product</th>
                                            <th width="17%" style="text-align: center">Price (RM)</th>
                                            <th width="10%" style="text-align: center">Month</th>
                                            <th width="23%" style="text-align: right">Sub Total (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Otata Subscription</td>
                                            <td style="text-align: center" id="sub_price">10.00</td>
                                            <td style="text-align: center"><input type="number" id="sub_quantity" name="sub_quantity" min="1" max="30" value="1" style="text-align: center"></td>
                                            <td style="text-align: right" id="total_sub">10.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="text-align: right"><b>OVERALL TOTAL (RM)</b></td>
                                            <td style="text-align: right"><b id="total_sub2">10.00</b></td>
                                        </tr>
                                    </tbody>
                                    <input type="hidden" id="subprice" name="subprice" value="10.00">
                                    <input type="hidden" id="total_sub" name="total_sub" value="10.00">
                                </table>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btn-subscribe">Subscribe</button>
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

$("#btn-subscribe").click(function(){
    $.ajax({
        url: "{{ route('member.subscription.add') }}",
        data:{
            "cost": 100.00,
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
                window.location.href = data.object;
                toastr.success('@lang("Thank you for your donation")', {timeOut: 5000});
            }
        }
    });
});
});
</script>
@endpush