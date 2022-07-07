{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Not Completed
                                            <div class="text-muted pt-2 font-size-sm">List of Not Completed</div></h3>
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
                                                                <input type="text" class="form-control" placeholder="Search IMEI" id="not_completed_search_query" />
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
                                        <!--begin: Datatable-->
                                        <table class="datatable datatable-borderless" id="not_completed">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>IMEI</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Customer Contact</th>
                                                    <th>Lokasi Beli Voucher</th>
                                                    <th>Serial Number Voucher</th>
                                                    <th>Link Melanjutkan Aktivasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $num = 0
                                            @endphp
                                            @foreach ($processes as $process)
                                                <tr>
                                                    <td>{{ $num+=1 }}</td>
                                                    <td>{{ $process->imei }}</td>
                                                    <td>{{ $process->customers->users->name }}</td>
                                                    <td>{{ $process->customers->users->email }}</td>
                                                    <td>{{ $process->customers->contact }}</td>
                                                    <td>{{ $process->lokasi_beli_voucher }}</td>
                                                    <td>{{ $process->vouchers->serial_number }}</td>
                                                    <td><a href="https://zfix.id/code/{{ $process->uniqueLinks->code }}">https://zfix.id/code/{{ $process->uniqueLinks->code }}</a></td>
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