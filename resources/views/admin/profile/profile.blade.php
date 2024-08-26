@extends('layouts.app')
@section('title', 'Profile')
@section('content')
{{-- <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> --}}
<div class="container">
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3">
                <br>
                <div class="panel">
                    <div class="user-heading round" style = "text-align: center">
                        <a href="#">
                            @if ($profile->profile_photo)
                                <img src="{{ asset('uploads/' . $profile->profile_photo) }}" class="rounded-circle" alt="{{ $profile->fullname }}" style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ asset('default-avatar.png') }}" class="rounded-circle" alt="Default Avatar" style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </a>
                            <h1>{{ $profile->firstname }} {{ $profile->lastname }}</h1>
                            <p>{{ $profile->email }}</p>
                            <a href="#" 
                                style="color:#333; text-decoration:none; font-weight:bold;" 
                                onmouseover="this.style.color='#333';" 
                                onmouseout="this.style.color='#333';">
                                <i class="fa fa-user"></i> Profile
                            </a> <br>
                            <a href="{{ route('profile.edit', ['id' => auth()->user()->id]) }}" 
                                style="color:#666; text-decoration:none;" 
                                onmouseover="this.style.color='#333';" 
                                onmouseout="this.style.color='#666';">
                                <i class="fa fa-pen"></i> Edit
                             </a>                             
                        </div>
      </div>
  </div>
  <div class="profile-info col-md-9">
    <br>
      <div class="panel">
          <div class="panel-body bio-graph-info">
              <h1>Profile Info</h1>
              <div class="row" >
                    <div class="bio-row">
                        <p>First Name: {{ $profile->firstname }}</p>
                    </div>
                    <div class="bio-row">
                        <p>Last Name: {{ $profile->lastname }}</p>
                    </div>
                    <div class="bio-row">
                    <p>Email: {{ $profile->email }}</p>
                    </div>
                    <div class="bio-row">
                        <p>Phone: {{ $profile->phone }}</p>
                    </div>
                    <div class="bio-row">
                        <p>Address: {{ $profile->address }}</p>
                    </div>
              </div>
          </div>
      </div>
<br>
<div class="row">
        <h1>Settings</h1>
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Security</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
                </li>
            </ul>
            <h5 class="mb-0 mt-5">Security Settings</h5>
            <p>These settings helps you keep your account secure.</p>
            <div class="list-group mb-5 shadow">
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">Enable Activity Logs</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="activityLog" checked="">
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">2FA Authentication</strong>
                            <span class="badge badge-pill badge-success">Enabled</span>
                            <p class="text-muted mb-0">Maecenas sed diam eget risus varius blandit.</p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary btn-sm">Disable</button>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-2">Activate Pin Code</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="pinCode">
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="mb-0">Recent Activity</h5>
            <p>Last activities with your account.</p>
            <table class="table border bg-white">
                <thead>
                    <tr>
                        <th>Device</th>
                        <th>Location</th>
                        <th>IP</th>
                        <th>Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - Windows 10</th>
                        <td>Paris, France</td>
                        <td>192.168.1.10</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                    <tr>
                        <th scope="col"><i class="fe fe-smartphone fe-12 text-muted mr-2"></i>App - Mac OS</th>
                        <td>Newyork, USA</td>
                        <td>10.0.0.10</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                    <tr>
                        <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - iOS</th>
                        <td>London, UK</td>
                        <td>255.255.255.0</td>
                        <td>Apr 24, 2019</td>
                        <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

</div>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}");
        });
    </script>
    @endif
@endsection