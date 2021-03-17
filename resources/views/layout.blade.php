<!DOCTYPE html>
<html>
<head>
  <title>Media Selling Template</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    body, html {
      height: 100%;
      line-height: 1.8;
    }
    /* Full height image header */
    .bgimg-1 {
      background-position: center;
      background-size: cover;
      background-image: url("images/mac.jpg");
      min-height: 100%;
    }
    .w3-bar .w3-button {
      padding: 16px;
    }
  </style>
</head>
<body>
  <!-- Navbar (sit on top) -->
  <div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
      <a href="/" class="w3-bar-item w3-button w3-wide">Duel Marketing</a>
      <!-- Right-sided navbar links -->
      <div class="w3-right w3-hide-small">
        @auth
          <a href="/all-media-groups" class="w3-bar-item w3-button">All Media</a>
          <a href="/media-groups" class="w3-bar-item w3-button">My Media Groups</a>
          <a href="/account" class="w3-bar-item w3-button">My Account</a>
          <a href="/logout" class="w3-bar-item w3-button">Logout</a>
        @endauth

        @guest
          <a href="/all-media-groups" class="w3-bar-item w3-button">All Media</a>
          <a href="/login" class="w3-bar-item w3-button">Login</a>
          <a href="/signup" class="w3-bar-item w3-button">Sign Up</a>
          <a href="/contact" class="w3-bar-item w3-button">Contact</a>
        @endguest
      </div>
      <!-- Hide right-floated links on small screens and replace them with a menu icon -->
      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
  </div>
  <!-- Sidebar on small screens when clicking the menu icon -->
  <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">About</a>
    <a href="/login" onclick="w3_close()" class="w3-bar-item w3-button">Login</a>
    <a href="/signup" onclick="w3_close()" class="w3-bar-item w3-button">Sign Up</a>
  </nav>
  @yield('content')
  @include('footer')
  <script>
  // Toggle between showing and hiding the sidebar when clicking the menu icon
  var mySidebar = document.getElementById("mySidebar");

  function w3_open() {
    if (mySidebar.style.display === 'block') {
      mySidebar.style.display = 'none';
    } else {
      mySidebar.style.display = 'block';
    }
  }

  // Close the sidebar with the close button
  function w3_close() {
    mySidebar.style.display = "none";
  }
  </script>
  @yield('js-asset')
</body>
</html>