<style>
.navbar {
    background-color: black !important; /* Set background color to black */
  }

  .navbar-brand:hover {
    /* Add your hover styles here */
    color: white; /* Example: Change text color to yellow on hover */
    /* Add any other styles you want to apply on hover */
  }

  .navbar-brand,
  .navbar-nav .nav-link,
  .navbar-text {
    color: white; /* Set text color to white */
  }

  .navbar-nav .nav-link:hover, .navbar-text:hover {
    color: #8DB600; /* Change text color to green on hover */
  }

  .navbar-nav {
    margin-left: 75%; /* Align navbar buttons to the right */
    margin-right: auto;
  }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid" style="color: #FFFFFF;">
      <img src="{{ asset('car_icon2.ico') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
      AutoBazaar
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('main')}}">Home</a>
        </li>
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{route('sellcar')}}">Sell car</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('myprofile')}}">My profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('registration')}}">Registration</a>
          </li>
        @endauth
      </ul>
      <span class="navbar-text">
        @auth
          {{auth()->user()->name}}
        @endauth
      </span>
    </div>
  </div>
</nav>