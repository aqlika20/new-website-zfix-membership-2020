{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">App Version
                                            <div class="text-muted pt-2 font-size-sm">Edit App Version For Mobile</div></h3>
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
                                                            <form method="POST" action="{{ route('setting.app-version.edit') }}">
                                                                @csrf
                                                                @method('PATCH')
                                                                
                                                                <div class="form-group row">
                                                                    <label for="version" class="col-md-6 col-form-label text-md-left">{{ __('Version') }}</label>

                                                                    <div class="col-md-12">
                                                                        <input id="version" type="text" class="form-control @error('version') is-invalid @enderror" name="version" value="{{ $app_version->version }}" required autocomplete="version" autofocus>
                                                                    </div>
                                                                </div>

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