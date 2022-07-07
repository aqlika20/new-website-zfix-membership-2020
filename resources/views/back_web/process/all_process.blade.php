{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">All Process
                                            <div class="text-muted pt-2 font-size-sm">List of All Process</div></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--begin: Search Form-->
                                        <!--begin::Search Form-->
                                        <div class="mb-7">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="row">
                                                        <div class="col-md-4 my-2 my-md-0">
                                                            <div class="input-icon">
                                                                <input type="text" class="form-control" placeholder="Search IMEI" id="all_process_search_query" />
                                                                <span>
                                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 my-2 my-md-0">
                                                            <div class="d-flex align-items-center">
                                                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                                <select class="form-control" id="all_process_search_status">
                                                                    <option value="">All</option>
                                                                    <option value="Queue">Queue</option>
                                                                    <option value="Approved">Approved</option>
                                                                    <option value="Rejected">Rejected</option>
                                                                    <option value="Expired">Expired</option>
                                                                    <option value="Request for Claim">Request for Claim</option>
                                                                    <option value="Claimed">Claimed</option>
                                                                    <option value="Rejected Claim">Rejected Claim</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Search Form-->
                                        <!--end: Search Form-->
                                        <!--begin: Datatable-->
                                        <table class="datatable datatable-borderless" id="all_process">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer Type</th>
                                                    <th>IMEI</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Voucher Type</th>
                                                    <th>Duration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $num = 0
                                            @endphp
                                            @foreach ($processes as $process)
                                                <tr>
                                                    <td>{{ $num+=1 }}</td>
                                                    <td>
                                                    @if ($process->vouchers->partners->users->name == 'ZFix')
                                                    {{ 'Individual' }}
                                                    @else 
                                                    {{ $process->vouchers->partners->users->name }}
                                                    @endif
                                                    </td>
                                                    <td>{{ $process->imei }}</td>
                                                    <td>{{ $process->customers->users->name }}</td>
                                                    <td>{{ $process->customers->users->email }}</td>
                                                    <td>{{ $process->vouchers->type }}</td>
                                                    @if ( $process->vouchers->type == 'Z Prime Lite')
                                                    <td>30 Hari</td> 
                                                    @endif
                                                    @if ( $process->vouchers->type == 'Z Prime')
                                                    <td>6 Bulan</td> 
                                                    @endif
                                                    @if ( $process->vouchers->type == 'Z Prime+')
                                                    <td>12 Bulan</td> 
                                                     @endif
                                                    <td>
                                                    @if ($process->status == '0')
                                                    {{ 'Queue' }}
                                                    @elseif ($process->status == '1')
                                                    {{ 'Approved' }}
                                                    @elseif ($process->status == '-1')
                                                    {{ 'Rejected' }}
                                                    @elseif ($process->status == '-2')
                                                    {{ 'Expired' }}
                                                    @elseif ($process->status == '2')
                                                    {{ 'Request for Claim' }}
                                                    @elseif ($process->status == '3')
                                                    {{ 'Claimed' }}
                                                    @endif
                                                    </td>
                                                    <td>
                                                        <form>
                                                            @if ($process->status == '0')
                                                            <a href="{{ route('process.queue.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @elseif ($process->status == '1')
                                                            <a href="{{ route('process.approved.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @elseif ($process->status == '-1')
                                                            <a href="{{ route('process.rejected.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @elseif ($process->status == '-2')
                                                            <a href="{{ route('process.expired.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @elseif ($process->status == '2')
                                                            <a href="{{ route('process.request-for-claim.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @elseif ($process->status == '3')
                                                            <a href="{{ route('process.claimed.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                            @endif
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <!--end: Datatable-->
                                        
                                    </div>

                                </div>


@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script>
    $('#available').tab('show')
</script>
<script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection