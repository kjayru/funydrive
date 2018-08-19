<header>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container"> 
            <a href="{{ url('/') }}" class="navbar-brand">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                 
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">
                    @include('partials.navigations.'.\App\User::navigation())
                </ul>
              
            </div>
        </div>
    </nav>
</header>