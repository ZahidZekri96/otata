@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="card ">
                    <div class="card-body">
                        <form>
                            <div id="selectAmount" class="form-group mx-auto w-50">
                                <button id="amount-0" class="btn btn-info" type="button" value="25" class="btn btn-light">RM25</button>
                                <button id="amount-1" class="btn btn-info" type="button" value="50">RM50</button>
                                <button id="amount-2" class="btn btn-info" type="button" value="100">RM100</button>
                                <button id="amount-3" class="btn btn-info" type="button" value="250">RM250</button>
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">or enter amount</label>
                                <input type="text" class="form-control" placeholder="RM">
                            </div>
                            <div class="form-group">
                                <label class="text-black font-w500">Payment Method</label>
                                <div class="dropdown bootstrap-select form-control form-control-lg default-select">
                                    <select class="form-control form-control-lg default-select" tabindex="-98" name="type">
                                        <option value="free">toyyibPay</option>
                                        <option value="paid">senangPay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary">Donate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection