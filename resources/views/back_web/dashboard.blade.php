{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            @if ($currentUser->roles_id != 4 && $currentUser->roles_id != 5) 
            <div class="card card-custom bg-gray-100 {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title font-weight-bolder text-white">All Process</h3>
                </div>
                {{-- Body --}}
                <div class="card-body p-0 position-relative overflow-hidden">
                    {{-- Chart --}}
                    <div class="card-rounded-bottom bg-danger" style="height: 50px"></div>

                    {{-- Stats --}}
                    <div class="card-spacer mt-n25">
                        {{-- Row --}}
                        <div class="row m-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-xl mb-7 mr-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Code/Time-schedule.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                                <a href="{{ route('process.queue.index') }}" class="text-warning font-weight-bold font-size-h6">
                                    Queue
                                </a>
                                <h3><span class="badge badge-warning mt-2">{{ $count_queue }}</span><h3>
                            </div>
                            <div class="col bg-light-success px-6 py-8 rounded-xl mb-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Code/Done-circle.svg", "svg-icon-3x svg-icon-success d-block my-2") }}
                                <a href="{{ route('process.approved.index') }}" class="text-success font-weight-bold font-size-h6 mt-2">
                                    Approved
                                </a>
                                <h3><span class="badge badge-success mt-2">{{ $count_approved }}</span><h3>
                            </div>
                        </div>
                        {{-- Row --}}
                        <div class="row m-0">
                            <div class="col bg-light-danger px-6 py-8 rounded-xl mb-7 mr-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Code/Error-circle.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                                <a href="{{ route('process.rejected.index') }}" class="text-danger font-weight-bold font-size-h6 mt-2">
                                    Rejected
                                </a>
                                <h3><span class="badge badge-danger mt-2">{{ $count_rejected }}</span><h3>
                            </div>
                            <div class="col bg-light-secondary px-6 py-8 rounded-xl mb-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Code/Stop.svg", "svg-icon-3x svg-icon-secondary d-block my-2") }}
                                <a href="{{ route('process.expired.index') }}" class="text-secondary font-weight-bold font-size-h6 mt-2">
                                    Expired
                                </a>
                                <h3><span class="badge badge-secondary mt-2">{{ $count_expired }}</span><h3>
                            </div>
                        </div>
                        {{-- Row --}}
                        <div class="row m-0">
                            
                            <div class="col bg-light-info px-6 py-8 rounded-xl  mb-7 mr-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Tools/Tools.svg", "svg-icon-3x svg-icon-info d-block my-2") }}
                                <a href="{{ route('process.request-for-claim.index') }}" class="text-info font-weight-bold font-size-h6 mt-2">
                                    Request for Claim
                                </a>
                                <h3><span class="badge badge-info mt-2">{{ $count_request_for_claim }}</span><h3>
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-xl  mb-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Shopping/Box3.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                                <a href="{{ route('process.claimed.index') }}" class="text-primary font-weight-bold font-size-h6 mt-2">
                                    Claimed
                                </a>
                                <h3><span class="badge badge-primary mt-2">{{ $count_claimed }}</span><h3>
                            </div>
                        </div>
                         {{-- Row --}}
                         <div class="row m-0">
                            
                            <div class="col bg-light-dark px-6 py-8 rounded-xl  mb-7 mr-7 text-center">
                                {{ Metronic::getSVG("media/svg/icons/Code/Error-circle.svg", "svg-icon-3x svg-icon-dark d-block my-2") }}
                                <a href="{{ route('process.rejected-claim.index') }}" class="text-dark font-weight-bold font-size-h6 mt-2">
                                    Rejected Claim
                                </a>
                                <h3><span class="badge badge-dark mt-2">{{ $count_rejected_claim }}</span><h3>
                            </div>
                            <div class="col px-6 py-8 rounded-xl  mb-7 text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if ($currentUser->roles_id == 4) 
            <div class="card card-custom bg-gray-100 {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 py-5">
                    <h3 class="card-title font-weight-bolder">Welcome, Partner!</h3>
                </div>
                {{-- Body --}}
                <div class="card-body py-5 position-relative overflow-hidden">
                    <p>You can access the partner menu to access more feature.</p>
                </div>
            </div>
            @endif
            @if ($currentUser->roles_id == 5) 
            <div class="card card-custom bg-gray-100 {{ @$class }}">
                {{-- Header --}}
                <div class="card-header border-0 py-5">
                    <h3 class="card-title font-weight-bolder">Welcome, Customer!</h3>
                </div>
                {{-- Body --}}
                <div class="card-body py-5 position-relative overflow-hidden">
                    <p>You must use the ZFix Membership App to access more feature.</p>
                </div>
            </div>
            @endif
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
