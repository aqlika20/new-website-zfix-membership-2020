{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Register New Partner
                                            <div class="text-muted pt-2 font-size-sm">Detail of Register New Partner</div></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="/partner/register-new-partner" class="btn btn-secondary">Back</a><br><br>

                                        <div class="tab-preview">
                                            <ul class="nav nav-tabs" id="detailTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="in-active-tab" data-toggle="tab" href="#in-active">
                                                        <span class="nav-text">In-Active ({{ $vouchers_in_active }})</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="sold-tab" data-toggle="tab" href="#sold">
                                                        <span class="nav-text">Sold ({{ $vouchers_sold }})</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="active-tab" data-toggle="tab" href="#active" aria-controls="active">
                                                        <span class="nav-text">Active ({{ $vouchers_active }})</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-5" id="detailTabContent">
                                                <div class="tab-pane fade" id="in-active" role="tabpanel" aria-labelledby="in-active-tab">
                                                    <!--begin: Search Form-->
                                                    <!--begin::Search Form-->
                                                    <div class="mb-7">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-4 my-2 my-md-0">
                                                                        <div class="input-icon">
                                                                            <input type="text" class="form-control" placeholder="Search Serial Number" id="register_new_partner_detail_in_active_search_query" />
                                                                            <span>
                                                                                <i class="flaticon2-search-1 text-muted"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Search Form-->
                                                    <!--end: Search Form-->
                                                    <div class="mb-7">
                                                    <!--begin::Dropdown-->
                                                    <div class="dropdown dropdown-inline mr-2">
                                                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="svg-icon svg-icon-md">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>Export</button>
                                                            <!--begin::Dropdown Menu-->
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <!--begin::Navigation-->
                                                                <ul class="navi flex-column navi-hover py-2">
                                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                                                    <li class="navi-item">
                                                                        <a href="{{ route('partner.register-new-partner.export',[$id, 0]) }}" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="la la-file-excel-o"></i>
                                                                            </span>
                                                                            <span class="navi-text">Excel</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <!--end::Navigation-->
                                                            </div>
                                                            <!--end::Dropdown Menu-->
                                                        </div>
                                                        <!--end::Dropdown-->
                                                    </div>
                                                    <!--begin: Datatable-->
                                                    <table class="datatable datatable-borderless" id="register_new_partner_detail_in_active">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Voucher Key</th>
                                                                <th>Serial Number</th>
                                                                <th>Type</th>
                                                                <th>Duration</th>
                                                                <th>Created Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $num = 0
                                                        @endphp
                                                        @foreach ($vouchers as $voucher)
                                                            @if ($voucher->status == 0)
                                                            <tr>
                                                                <td>{{ $num+=1 }}</td>
                                                                <td>{{ $voucher->partners->users->name }}</td>
                                                                <td>{{ $voucher->voucher_key }}</td>
                                                                <td>{{ $voucher->serial_number }}</td>
                                                                <td>{{ $voucher->type }}</td>
                                                                @if ( $voucher->type == 'Z Prime Lite')
                                                                <td>30 Hari</td> 
                                                                @endif
                                                                @if ( $voucher->type == 'Z Prime')
                                                                <td>6 Bulan</td> 
                                                                @endif
                                                                @if ( $voucher->type == 'Z Prime+')
                                                                <td>12 Bulan</td> 
                                                                @endif
                                                                <td>{{ $voucher->updated_at }}</td>
                                                                @if ($currentUser->roles_id == 1)
                                                                
                                                                @endif
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!--end: Datatable-->
                                                </div>
                                                <div class="tab-pane fade" id="sold" role="tabpanel" aria-labelledby="sold-tab">
                                                    <!--begin: Search Form-->
                                                    <!--begin::Search Form-->
                                                    <div class="mb-7">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-4 my-2 my-md-0">
                                                                        <div class="input-icon">
                                                                            <input type="text" class="form-control" placeholder="Search Serial Number" id="register_new_partner_detail_sold_search_query" />
                                                                            <span>
                                                                                <i class="flaticon2-search-1 text-muted"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Search Form-->
                                                    <!--end: Search Form-->
                                                    <div class="mb-7">
                                                    <!--begin::Dropdown-->
                                                    <div class="dropdown dropdown-inline mr-2">
                                                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="svg-icon svg-icon-md">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>Export</button>
                                                            <!--begin::Dropdown Menu-->
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <!--begin::Navigation-->
                                                                <ul class="navi flex-column navi-hover py-2">
                                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                                                    <li class="navi-item">
                                                                        <a href="{{ route('partner.register-new-partner.export',[$id, 1]) }}" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="la la-file-excel-o"></i>
                                                                            </span>
                                                                            <span class="navi-text">Excel</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <!--end::Navigation-->
                                                            </div>
                                                            <!--end::Dropdown Menu-->
                                                        </div>
                                                        <!--end::Dropdown-->
                                                    </div>
                                                    <!--begin: Datatable-->
                                                    <table class="datatable datatable-borderless" id="register_new_partner_detail_sold">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Voucher Key</th>
                                                                <th>Serial Number</th>
                                                                <th>Type</th>
                                                                <th>Sold Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $num = 0
                                                        @endphp
                                                        @foreach ($vouchers as $voucher)
                                                            @if ($voucher->status == 1)
                                                            <tr>
                                                                <td>{{ $num+=1 }}</td>
                                                                <td>{{ $voucher->partners->users->name }}</td>
                                                                <td>{{ $voucher->voucher_key }}</td>
                                                                <td>{{ $voucher->serial_number }}</td>
                                                                <td>{{ $voucher->type }}</td>
                                                                <td>{{ $voucher->updated_at }}</td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!--end: Datatable-->
                                                </div>
                                                <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
                                                    <!--begin: Search Form-->
                                                    <!--begin::Search Form-->
                                                    <div class="mb-7">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-4 my-2 my-md-0">
                                                                        <div class="input-icon">
                                                                            <input type="text" class="form-control" placeholder="Search Serial Number" id="register_new_partner_detail_active_search_query" />
                                                                            <span>
                                                                                <i class="flaticon2-search-1 text-muted"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Search Form-->
                                                    <!--end: Search Form-->
                                                    <div class="mb-7">
                                                    <!--begin::Dropdown-->
                                                    <div class="dropdown dropdown-inline mr-2">
                                                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="svg-icon svg-icon-md">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>Export</button>
                                                            <!--begin::Dropdown Menu-->
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <!--begin::Navigation-->
                                                                <ul class="navi flex-column navi-hover py-2">
                                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                                                    <li class="navi-item">
                                                                        <a href="{{ route('partner.register-new-partner.export',[$id, 2]) }}" class="navi-link">
                                                                            <span class="navi-icon">
                                                                                <i class="la la-file-excel-o"></i>
                                                                            </span>
                                                                            <span class="navi-text">Excel</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <!--end::Navigation-->
                                                            </div>
                                                            <!--end::Dropdown Menu-->
                                                        </div>
                                                        <!--end::Dropdown-->
                                                    </div>
                                                    <!--begin: Datatable-->
                                                    <table class="datatable datatable-borderless" id="register_new_partner_detail_active">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Name</th>
                                                                <th>Voucher Key</th>
                                                                <th>Serial Number</th>
                                                                <th>Type</th>
                                                                <th>Actived Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php
                                                            $num = 0
                                                        @endphp
                                                        @foreach ($vouchers as $voucher)
                                                            @if ($voucher->status == 2)
                                                            <tr>
                                                                <td>{{ $num+=1 }}</td>
                                                                <td>{{ $voucher->partners->users->name }}</td>
                                                                <td>{{ $voucher->voucher_key }}</td>
                                                                <td>{{ $voucher->serial_number }}</td>
                                                                <td>{{ $voucher->type }}</td>
                                                                <td>{{ $voucher->updated_at }}</td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <!--end: Datatable-->
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
<script>
    $('#in-active').tab('show')
</script>
<script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection