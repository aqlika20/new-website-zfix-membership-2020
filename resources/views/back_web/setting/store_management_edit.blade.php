{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Store Management
                                            <div class="text-muted pt-2 font-size-sm">Edit Store Management</div></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!--begin: Search Form-->
                                        <!--begin::Search Form-->
                                        <div class="mb-7">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="row">
                                                        <div class="col-md-6 my-2 my-md-0">
                                                            <form method="POST" action="{{ route('setting.store-management.edit',[$store->id]) }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-md-6 col-form-label text-md-left">{{ __('Name') }}</label>

                                                                    <div class="col-md-12">
                                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $store->name }}" required autocomplete="name" autofocus>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="address" class="col-md-6 col-form-label text-md-left">{{ __('Address') }}</label>

                                                                    <div class="col-md-12">
                                                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $store->address }}" required autocomplete="address" autofocus>
                                                                    </div>
                                                                </div>
                                                                
                                                                <a href="/setting/store-management" class="btn btn-secondary">Back</a>
                                                                <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Search Form-->
                                        <!--end: Search Form-->
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