<title>Jays Jewellery | Profile</title>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
<link href="{{ asset('frontend/css/customer-profile.css') }}" rel="stylesheet">
{{-- @include('layouts.frontend.header') --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8 mx-auto">
            <h2 class="h3 mb-4 page-title">Settings</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="my-4">
                <form method="POST" action="{{ route('customer.updateProfile') }}">
                    @csrf
                    <div class="row mt-5 align-items-center">
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h4 class="mb-1">{{ $customer->firstname }} {{ $customer->lastname }}</h4>
                                    <p class="small mb-3"><span class="badge badge-success">{{ $customer->state }}, {{ $customer->country }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Firstname</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $customer->firstname }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Lastname</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $customer->lastname }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $customer->address }}" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $customer->city }}" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{ $customer->state }}" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="postal_code">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $customer->postal_code }}" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ $customer->country }}" />
                        </div>
                    </div>
                    <hr class="my-4" />

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">Password requirements</p>
                            <ul class="small text-muted pl-4 mb-0">
                                <li>Minimum 8 characters</li>
                                <li>At least one special character</li>
                                <li>At least one number</li>
                                <li>Cannot be the same as a previous password</li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-dark" onclick="window.history.back();">Exit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
