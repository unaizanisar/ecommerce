<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  </head>
  <body>
    <aside class="sidebar">
      <div class="logo" >
        <img src="{{ asset('images/ringlogo.jpeg') }}" alt="logo">
        <h2>Jays Jewelry</h2>
      </div>
      <ul class="links">
        <li>
          <span class="material-symbols-outlined">dashboard</span>
          <a href="dashboard">Dashboard</a>
        </li>
        <li>
          <span class="material-symbols-outlined">group</span>
          <a href="{{ url('/users') }}">Users</a>
        </li>
        <li>
          <span class="material-symbols-outlined">category</span>
          <a href="{{ url('/categories') }}">Categories</a>
        </li>
        <li>
          <span class="material-symbols-outlined">shopping_bag</span>
          <a href="{{ url('/products') }}">Products</a>
        </li>
        <li>
          <span class="material-symbols-outlined">shopping_cart</span>
          <a href="{{ url('/orders') }}">Orders</a>
        </li>
        <li>
          <span class="material-symbols-outlined">user_attributes</span>
          <a href="{{ url('/customers') }}">Customers</a>
        </li>
        <li>
          <span class="material-symbols-outlined">planner_banner_ad_pt
          </span>
          <a href="{{ url('/banners') }}">Banners</a>
        </li>
        <li>
          <span class="material-symbols-outlined">supervised_user_circle</span>
          <a href="{{ url('/roles') }}">Roles</a>
        </li>
        <li>
          <span class="material-symbols-outlined">lock_person</span>
          <a href="{{ url('/permissions') }}">Permissions</a>
        </li>
        
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
      </ul>
    </aside>
  </body>
</html>
