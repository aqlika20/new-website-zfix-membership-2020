{{-- Extends layout --}}
@extends('layout.back_web')

{{-- Content --}}
@section('content')

                                <div class="card card-custom">
                                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                                        <div class="card-title">
                                            <h3 class="card-label">Profile
                                            <div class="text-muted pt-2 font-size-sm">About Your Profile</div></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-preview">
                                            <div class="card">
                                                <div class="card-header" id="headingOne6">
                                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#data">
                                                        <i class="flaticon2-file"></i> Data
                                                    </div>
                                                </div>
                                                <div id="data" class="collapse" data-parent="#accordion-preview">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form method="POST" action="{{ route('profile.edit') }}">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            
                                                                            <div class="form-group row">
                                                                                <label for="name" class="col-md-6 col-form-label text-md-left">{{ __('Name') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $currentUser->name }}" required autocomplete="name" autofocus>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="form-group row">
                                                                                <label for="email" class="col-md-6 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $currentUser->email }}" required autocomplete="email" readonly>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            @if ($currentUser->roles->id == 5)
                                                                            <div class="form-group row">
                                                                                <label for="address" class="col-md-6 col-form-label text-md-left">{{ __('Address') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <textarea id="address" rows="4" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>{{ $currentCustomer->address }}</textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label for="contact" class="col-md-6 col-form-label text-md-left">{{ __('Contact') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $currentCustomer->contact }}" required autocomplete="contact" autofocus>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            
                                                                            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
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
                                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#password">
                                                        <i class="flaticon2-shield"></i> Password
                                                    </div>
                                                </div>
                                                <div id="password" class="collapse" data-parent="#accordion-preview">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 my-2 my-md-0">
                                                                        <form method="POST" action="{{ route('profile.change-password') }}">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                            
                                                                            <div class="form-group row">
                                                                                <label for="new-password" class="col-md-6 col-form-label text-md-left">{{ __('New Password') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="new-password" type="password" minlength="8" class="form-control @error('new-password') is-invalid @enderror" name="new_password" required autocomplete="new-password" autofocus>
                                                                                </div>
                                                                            </div>
                
                                                                            <div class="form-group row">
                                                                                <label for="new-password" class="col-md-6 col-form-label text-md-left">{{ __('Confirm New Password') }}</label>
                
                                                                                <div class="col-md-12">
                                                                                    <input id="new-password-confirm" type="password" minlength="8" class="form-control" name="new_password_confirmation" required autocomplete="new-password" autofocus>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <button type="submit" class="btn btn-primary">{{ __('Change') }}</button>
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