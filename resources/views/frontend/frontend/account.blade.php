@extends('layouts.frontend.app')

@section('title', 'Jay Jewellery | My Account')

@section('content')

<section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <div class="aa-myaccount-area">         
              <div class="row">
                  <div class="col-md-6">
                      <div class="aa-myaccount-register">                 
                          <h4>Register</h4>
                          <form action="{{ url('/customer/register') }}" method="POST" class="aa-login-form">
                              @csrf
                              <label for="firstname">First Name<span>*</span></label>
                              <input type="text" name="firstname" placeholder="First Name" required>

                              <label for="lastname">Last Name<span>*</span></label>
                              <input type="text" name="lastname" placeholder="Last Name" required>

                              <label for="email">Email<span>*</span></label>
                              <input type="text" name="email" placeholder="Email" required>

                              <label for="password">Password<span>*</span></label>
                              <input type="password" name="password" placeholder="Password" required>

                              <label for="password_confirmation">Confirm Password<span>*</span></label>
                              <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                              <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
                                @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                                @if ($errors->has('postal_code'))
                                    <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}">
                                @if ($errors->has('country'))
                                    <span class="text-danger">{{ $errors->first('country') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label><br>
                                <input type="radio" id="male" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label for="male">Male</label>
                                <input type="radio" id="female" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label for="female">Female</label><br>
                                <input type="radio" id="other" name="gender" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}>
                                <label for="other">Other</label><br>
                                @if ($errors->has('gender'))
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>        
                              <button type="submit" class="aa-browse-btn">Register</button>                    
                          </form>
                      </div>
                  </div>
              </div>          
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
