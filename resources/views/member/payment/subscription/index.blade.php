@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ str_replace("_", " ", $errors->first()) }}
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
                            <div class="purchaseList">
                                <table class="table table-bordered" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Membership Subscription:</td>
                                            <td style="text-align: center" id="sub_price">RM 150.00/month</td>
                                        </tr>
                                        <tr>
                                            <td><b>Subscription Start:</b></td>
                                            <td style="text-align: center">{{ $subscription != null ? date("d/m/Y h:i A", strtotime($subscription->valid_start)) : "-" }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Subscription End:</b></td>
                                            <td style="text-align: center">{{ $subscription != null ? date("d/m/Y h:i A", strtotime($subscription->valid_end)) : "-" }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status:</b></td>
                                            <td style="text-align: center">{{ $subscription != null ? ucfirst($subscription->status) : "Not Subscribe" }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                @php
                                if($subscription != null){
                                    if($subscription->status == "active")
                                        echo '<button type="button" class="btn btn-primary float-right btn-cancel-subscribe">Cancel Subscribe</button>';
                                    else
                                        echo '<button type="button" class="btn btn-primary float-right btn-subscribe">Subscribe</button>';
                                }else{
                                    echo '<button type="button" class="btn btn-primary float-right btn-subscribe" >Subscribe</button>';  
                                }
                                @endphp
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

$(".btn-subscribe").click(function(){
    $.ajax({
        url: "{{ route('member.subscription.add') }}",
        data:{
            "cost": 150.00,
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
                var url         = "{{ route('senangpay.subscription.paid', ':order_id') }}";
                let order_id = data.object.order_id;
                
                url				= url.replace(':order_id',order_id);
                window.location.href = url;
            }
        }
    });
});
});
</script>
@endpush