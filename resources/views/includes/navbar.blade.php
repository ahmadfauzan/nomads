<!-- Navbar -->
{{-- @foreach ($carts as $car)
    {{ dd($car->travel_packageGallery) }}
@endforeach --}}
<div class="container container-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('frontend/images/logo.png') }}" alt="Logo NOMADS" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navb"
            aria-controls="navb" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item mx-md-2">
                    <a href="{{ route('home') }}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#popular" class="nav-link">Paket Travel</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#testimonialHeading" class="nav-link">Testimonial</a>
                </li>
                <li class="nav-item dropstart mx-md-2">
                    <a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                        <h5>
                            <i class="ph-shopping-cart-bold">
                                @auth
                                    @if ($carts->count())
                                        <span
                                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $carts->count() }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                @endauth
                                @guest

                                @endguest
                            </i>
                        </h5>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @auth
                            @forelse ($carts as $cart)
                                <li class="dropdown-item">
                                    <a href="{{ route('checkout', $cart->id) }}" class="text-decoration-none"
                                        style="color: #071C4D">
                                        <div class="card" style="width: 300px">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="{{ Storage::url($cart->travel_package->galleries[0]->image) }}"
                                                        class="img-fluid rounded">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $cart->travel_package->title }}</h5>
                                                        <p class="card-text"><small
                                                                class="text-muted">{{ $cart->travel_package->location }}</small>
                                                        </p>
                                                        <h4 class="card-text">${{ $cart->travel_package->price }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="dropdown-item">Kosong</li>
                            @endforelse
                        @endauth
                        @guest
                            <li class="dropdown-item">Please &nbsp;<a href="{{ route('login') }}">Login</a>&nbsp;to
                                checkout
                            </li>
                        @endguest
                    </ul>
                </li>
            </ul>

            @guest
                <!-- Mobile Button -->
                <form class="form-inline d-lg-none d-sm-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                        Masuk
                    </button>
                </form>

                <!-- Dekstop Button -->
                <form class="form-inline my-2 my-lg-0 d-none d-lg-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button"
                        onclick="event.preventDefault(); location.href='{{ url('login') }}';">
                        Masuk
                    </button>
                </form>
            @endguest

            @auth
                <!-- Mobile Button -->
                <form class="form-inline d-lg-none d-sm-block" action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0" type="submit">
                        Keluar
                    </button>
                </form>

                <!-- Dekstop Button -->
                <form class="form-inline my-2 my-lg-0 d-none d-lg-block" action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
                        Keluar
                    </button>
                </form>
            @endauth

        </div>
    </nav>
</div>
