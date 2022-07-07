{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Queue
                                            <div class="text-muted pt-2 font-size-sm">List of Queue</div></h3>
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
                                                                <input type="text" class="form-control" placeholder="Search IMEI" id="queue_search_query" />
                                                                <span>
                                                                    <i class="flaticon2-search-1 text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="queue" method="POST" enctype="multipart/form-data" id="filter_form">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <div class="input-group from_date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" id="from_date" placeholder="From date" data-target="#date" name="from_date" readonly/>
                                                        <div class="input-group-append" data-target="#from_date" data-toggle="datetimepicker">
                                                            <span class="input-group-text">
                                                                <i class="ki ki-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                                <div class="col-md-4" >
                                                    <div class="input-group to_date" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" id="to_date" placeholder="To date" data-target="#date" name="to_date" readonly/>
                                                        <div class="input-group-append" data-target="#to_date" data-toggle="datetimepicker">
                                                            <span class="input-group-text">
                                                                <i class="ki ki-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
                                                            <a class="navi-link" id="filter">
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
                                        </form>
                                        <!--end::Search Form-->
                                        <!--end: Search Form-->
                                        <!--begin: Datatable-->
                                        <table class="datatable datatable-borderless" id="queue">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer Type</th>
                                                    <th>IMEI</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Voucher Type</th>
                                                    <th>Duration</th>
                                                    <th>Request Activation Date</th>
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
                                                     <td>{{ $process->updated_at }}</td>
                                                    <td>
                                                        <form id="form" method="POST" action="{{ route('process.queue.action',[$process->id]) }}">
                                                            @csrf 
                                                            @method('PATCH')
                                                            <a href="{{ route('process.queue.detail',[$process->id]) }}" title="Detail" class="btn btn-icon btn-light btn-sm mx-1">
                                                                {{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-primary") }}
                                                            </a>
                                                           
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

    $('#filter').click(function() {
        if ($('#from_date').val() == "" || $('#to_date').val() == "") {
            return alert("Fill date filter.");
        }
        $('#filter_form').submit();
        
    });

    $('#from_date').datepicker({
        format: 'yyyy-mm-dd', 
        orientation: "bottom left"
    });
    $('#to_date').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom left"

    });
</script>
<script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection