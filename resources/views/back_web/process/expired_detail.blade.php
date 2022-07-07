{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Expired
                                                <div class="text-muted pt-2 font-size-sm">Detail of Expired</div></h3>
                                        </div>
                                        <h1><span><span class="badge  badge-secondary">Expired</span></span></h1>
                                    </div>
                                    <div class="card-body">
                                        <a href="/process/expired" class="btn btn-secondary">Back</a><br><br>
                                        <div class="accordion accordion-solid accordion-toggle-plus">
                                            <div class="card">
                                                <div class="card-header" id="headingOne6">
                                                    <div class="card-title" data-toggle="collapse" data-target="#general">
                                                        <i class="flaticon2-file"></i> General
                                                    </div>
                                                </div>
                                                <div id="general" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form>
                                                                            <div class="form-group row">
                                                                                <label for="customer-type" class="col-md-6 col-form-label text-md-left">{{ __('Customer Type') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    @if ($process->vouchers->partners->users->name == 'ZFix')
                                                                                    <input id="customer-type" type="text" class="form-control @error('customer-type') is-invalid @enderror" name="customer-type" value="Individual" required autocomplete="customer-type" readonly>
                                                                                    @else 
                                                                                    <input id="customer-type" type="text" class="form-control @error('customer-type') is-invalid @enderror" name="customer-type" value="{{ $process->vouchers->partners->users->name }}" required autocomplete="customer-type" readonly>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="customer-name" class="col-md-6 col-form-label text-md-left">{{ __('Customer Name') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="customer-name" type="text" class="form-control @error('customer-name') is-invalid @enderror" name="customer-name" value="{{ $process->customers->users->name }}" required autocomplete="customer-name" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="customer-email" class="col-md-6 col-form-label text-md-left">{{ __('Customer Email') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="customer-email" type="text" class="form-control @error('customer-email') is-invalid @enderror" name="customer-email" value="{{ $process->customers->users->email }}" required autocomplete="customer-email" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="customer-email" class="col-md-6 col-form-label text-md-left">{{ __('No. KTP') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="customer-identity" type="text" class="form-control @error('customer-identity') is-invalid @enderror" name="customer-identity" value="{{ $process->customers->identity }}" required autocomplete="customer-email" readonly>
                                                                                </div>
                                                                            </div> 

                                                                            <div class="form-group row">
                                                                                <label for="customer-email" class="col-md-6 col-form-label text-md-left">{{ __('Birth Date') }}</label> 
                
                                                                                <div class="col-md-12">
                                                                                    <input id="customer-birth_date" type="text" class="form-control @error('customer-birth_date') is-invalid @enderror" name="customer-birth_date" value="{{ $process->customers->birth_date }}" required autocomplete="customer-email" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="customer-address" class="col-md-6 col-form-label text-md-left">{{ __('Customer Address') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <textarea id="customer-address" rows="4" class="form-control @error('customer-address') is-invalid @enderror" name="customer-address" required autocomplete="customer-address" readonly>{{ $process->customers->address }}</textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="customer-contact" class="col-md-6 col-form-label text-md-left">{{ __('Customer Contact') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="customer-contact" type="tel" class="form-control @error('customer-contact') is-invalid @enderror" name="customer-contact" value="{{ $process->customers->contact }}" required autocomplete="customer-contact" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form>
                                                                            <div class="form-group row">
                                                                                <label for="voucher-type" class="col-md-6 col-form-label text-md-left">{{ __('Voucher Type') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="voucher-type" type="text" class="form-control @error('voucher-type') is-invalid @enderror" name="voucher-type" value="{{ $process->vouchers->type }}" required autocomplete="voucher-type" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="lokasi_beli_voucher" class="col-md-6 col-form-label text-md-left">{{ __('Lokasi Beli Voucher') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="lokasi_beli_voucher" type="text" class="form-control @error('lokasi_beli_voucher') is-invalid @enderror" name="lokasi_beli_voucher" value="{{ $process->lokasi_beli_voucher }}" required autocomplete="voucher-type" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="activation-date" class="col-md-6 col-form-label text-md-left">{{ __('Activation Date') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="activation-date" type="text" class="form-control @error('activation-date') is-invalid @enderror" name="activation-date" value="{{ $process->actived_at }}" required autocomplete="activation-date" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="expiration-date" class="col-md-6 col-form-label text-md-left">{{ __('Expiration Date') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="expiration-date" type="text" class="form-control @error('expiration-date') is-invalid @enderror" name="expiration-date" value="{{ $process->expired_at }}" required autocomplete="expiration-date" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="headingTwo6">
                                                    <div class="card-title" data-toggle="collapse" data-target="#about-device">
                                                        <i class="flaticon2-shield"></i> About Device
                                                    </div>
                                                </div>
                                                <div id="about-device" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form>
                                                                            <div class="form-group row">
                                                                                <label for="imei" class="col-md-6 col-form-label text-md-left">{{ __('IMEI') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="imei" type="text" class="form-control @error('imei') is-invalid @enderror" name="imei" value="{{ $process->imei }}" required autocomplete="imei" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="device-type" class="col-md-6 col-form-label text-md-left">{{ __('Device Type') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-type" type="text" class="form-control @error('device-type') is-invalid @enderror" name="device-type" value="{{ $process->device_type }}" required autocomplete="device-type" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="device-version" class="col-md-6 col-form-label text-md-left">{{ __('Device Version ') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-version" type="text" class="form-control @error('device-version') is-invalid @enderror" name="device-version" value="{{ $process->device_version }}" required autocomplete="device-version" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="device-manufacturer" class="col-md-6 col-form-label text-md-left">{{ __('Device Manufacturer') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-manufacturer" type="text" class="form-control @error('device-manufacturer') is-invalid @enderror" name="device-manufacturer" value="{{ $process->device_manufacturer }}" required autocomplete="device-manufacturer" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="device-model" class="col-md-6 col-form-label text-md-left">{{ __('Device Model') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-model" type="text" class="form-control @error('device-model') is-invalid @enderror" name="device-model" value="{{ $process->device_model }}" required autocomplete="device-model" readonly>
                                                                                </div>
                                                                            </div>

                                                                            @if ($process->device_type == 'Android')
                                                                            <div class="form-group row">
                                                                                <label for="device-ram" class="col-md-6 col-form-label text-md-left">{{ __('Device RAM') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-ram" type="text" class="form-control @error('device-ram') is-invalid @enderror" name="device-ram" value="{{ $process->device_ram }}" required autocomplete="device-ram" readonly>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="device-storage" class="col-md-6 col-form-label text-md-left">{{ __('Device Storage') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="device-storage" type="text" class="form-control @error('device-storage') is-invalid @enderror" name="device-storage" value="{{ $process->device_storage }}" required autocomplete="device-storage" readonly>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form>
                                                                            <div class="form-group row">
                                                                                <label for="screen-has-problem" class="col-md-6 col-form-label text-md-left">{{ __('Screen Has Problem?') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    @if ($process->screen_has_problem == 1)
                                                                                    <input id="screen-has-problem" type="text" style="font-weight: bold; color: red" class="form-control @error('screen-has-problem') is-invalid @enderror" name="screen-has-problem" value="Yes" required autocomplete="screen-has-problem" readonly>
                                                                                    @elseif ($process->screen_has_problem == 0)
                                                                                    <input id="customer-type" type="text" class="form-control @error('customer-type') is-invalid @enderror" name="customer-type" value="No" required autocomplete="customer-type" readonly>
                                                                                    @endif
                                                                                    
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="form-group row col-md-6">
                                                                                    <label for="screen-image" class="col-md-12 col-form-label text-md-left">{{ __('Screen Image') }}</label>
                                                                                    <div class="col-md-12">
                                                                                    <img id="screen-image" class="screen-image" src="http://zfix.id/api/screen-image/{{ $process->uniqueLinks->screen_image }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row col-md-6">
                                                                                    <label for="side-image" class="col-md-12 col-form-label text-md-left">{{ __('Side Image') }}</label>
                                                                                    <div class="col-md-12">
                                                                                    <img id="side-image" class="side-image" src="http://zfix.id/api/side-image/{{ $process->uniqueLinks->side_image }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            @if ($process->device_version < 10)
                                                                            <div class="form-group row">
                                                                                <div class="form-group row col-md-6">
                                                                                    <label for="imei-image" class="col-md-12 col-form-label text-md-left">{{ __('IMEI Image') }}</label>
                                                                                    <div class="col-md-12">
                                                                                    <img id="imei-image" class="imei-image" src="http://zfix.id/api/imei-image/{{ $process->uniqueLinks->imei_image }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif

                                                                            @if ($process->device_version >= 10)
                                                                            <div class="form-group row">
                                                                                <div class="form-group row col-md-6">
                                                                                    <label for="imei-video" class="col-md-12 col-form-label text-md-left">{{ __('IMEI Video') }}</label>
                                                                                    <div class="col-md-12">
                                                                                    <video width="320" height="240" controls>
                                                                                    <source src="https://zfix.id/api/imei-video/{{ $process->uniqueLinks->imei_video }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        </form>
                                                                    </div>
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

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection