<nav class="navbar navbar-expand-sm navbar-light  border-bottom">
  <button class="btn btn-info" id="menu-toggle"><i class="fa fa-bars"></i></button>
  <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Profile
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="profile.php">My profile</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="profile.php?scroll_to=technical_support">Technical support</a>
      </div>
    </li>
  </ul>
</nav>

<script>

  $(document).ready(function() {

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  });

</script>