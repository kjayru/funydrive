<header>
    <nav class="navbar nav-bar-expand-lg  navbar-dark bg-dark">

        <div class="container">

            <a href="{{ url('/') }}" class="navbar-brand">
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">

                </ul>

                <ul class="navbar-nav ml-auto">
                    @include('partials.navigations.'.\App\User::navigation())
                </ul>
            </div>
        </div>
    </nav>
</header>