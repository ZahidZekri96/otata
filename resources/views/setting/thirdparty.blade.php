@extends('theme.main')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_toyyib" value="1" id="isToyyib" onclick="isToyyibPayFunct()">
                                    <label class="form-check-label">{{ __('Activate the toyyibPay function') }}</label>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div id="isActivateToyyib" style="display: none;">
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="secret_toyyib" class="col-md-2 col-form-label">{{ __('Secret Key') }}<br/>({{ __('Secret Key') }})<span style="color:darkred">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="secret_toyyib" name="secret_toyyib" placeholder="{{ __('Enter the secret key provided by toyyibPay') }} ..." required>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="code_toyyib" class="col-md-2 col-form-label">{{ __('Code Category') }}<br/>({{ __('Category Code') }})<span style="color:darkred">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="code_toyyib" name="code_toyyib" placeholder="{{ __('Enter the code toyyibPay') }} ..." required>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="channel_toyyib" class="col-md-2 col-form-label">{{ __('Payment Channel') }}<span style="color:darkred">*</span></label>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input type="radio" name="channel_toyyib" value="1">
                                        <label for="still" class="col-form-label" style="font-weight: normal !important;">{{ __('Online Banking (FPX)') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="channel_toyyib" value="2">
                                        <label for="percent" class="col-form-label" style="font-weight: normal !important;">{{ __('Credit / Debit Card') }}</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="channel_toyyib" value="3">
                                        <label for="percent" class="col-form-label" style="font-weight: normal !important;">{{ __('Online Banking (FPX) & Credit / Debit Card') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1"></div>
                                <label for="oc_toyyib" class="col-md-2 col-form-label">{{ __('Operating Charges') }}</label>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="oc_toyyib" value="1" id="isChargesToyyib" onclick="isCheckToyyibFunct()">
                                        <label class="form-check-label">{{ __('Charge handling charges to customers') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div id="moreFieldChargesToyyib" style="display: none;">
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="toc_toyyib" class="col-md-2 col-form-label">{{ __('Types of Operating Charges') }}<span style="color:darkred">*</span></label>
                                    <div class="col-md-8">
                                        <input type="radio" name="toc_toyyib" value="0" onclick="javascript:typeOpToyyib();">
                                        <label for="still" class="col-form-label" style="font-weight: normal !important;">{{ __('Still') }}</label>
                                            &nbsp;
                                        <input type="radio" name="toc_toyyib" value="1" id="toyyib" onclick="javascript:typeOpToyyib();" checked="checked">
                                        <label for="percent" class="col-form-label" style="font-weight: normal !important;">{{ __('Percent') }}</label>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-1"></div>
                                    <label for="voc_toyyib" class="col-md-2 col-form-label">{{ __('Value of Operating Charges') }}<span style="color:darkred">*</span></label>
                                    <div class="col-md-8" id="isPerToyyib">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="percent_toyyib" name="percent_toyyib" placeholder="{{ __('Enter operating charge value') }} ..." required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ __('%') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8" id="isMnyToyyib" style="display: none;">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ __('MYR') }}</span>
                                            </div>
                                            <input type="text" class="form-control" id="rm_toyyib" name="rm_toyyib" placeholder="{{ __('Enter operating charge value') }} ..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection