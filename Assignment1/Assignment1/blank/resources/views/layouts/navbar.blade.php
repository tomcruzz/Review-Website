<nav class="navbar d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/logo1.png') }}" alt="Mollywood" style="height: 40px;">
    </a>
    
    <ul class="navbar-nav d-flex flex-row">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('movies') }}">Movies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('directors') }}">Directors</a> <!-- Updated link -->
        </li>
        <li class="nav-item">
            <a class="nav-link" >About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" >Contact</a>
        </li>
    </ul>
    
    <form class="d-flex align-items-center" role="search">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width: 200px;">
        <button class="btn btn-outline-success btn-primary" type="submit">Search</button>
    </form>

    <div class="nav-item">
        <a href="/login" class="btn btn-primary">Login</a>
    </div>
</nav>

<style>
  .navbar {
    padding: 10px;
  }
  .navbar-nav .nav-item {
    margin-left: 15px;
  }
</style>
