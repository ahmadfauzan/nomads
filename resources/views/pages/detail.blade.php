@extends('layouts.app')

@section('title', 'Detail Travel')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                Paket Travel
                            </li>
                            <li class="breadcrumb-item active">
                                Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details ">
                        <h1>{{ $item->title }}</h1>
                        <p>
                            {{ $item->location }}
                        </p>
                        <div class="gallery">
                            <div class="xzoom-container">
                                <img src="{{ Storage::url($item->galleries->skip(1)->first()->image) }}" class="xzoom"
                                    id="xzoom-default"
                                    xoriginal="{{ Storage::url($item->galleries->skip(1)->first()->image) }}">
                            </div>
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries->skip(1) as $gallery)
                                    <a href="{{ Storage::url($gallery->image) }}">
                                        <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery"
                                            width="128" xpreview="{{ Storage::url($gallery->image) }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <h2>Tentang Wisata</h2>
                        <p>
                            {!! $item->about !!}
                        </p>
                        <div class="features row">
                            <div class="col-md-4 border-end">
                                <img src="{{ url('frontend/images/ic_event.png') }}" alt="" class="features-image">
                                <div class="description">
                                    <h3>Featured Event</h3>
                                    <p>{{ $item->featured_event }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 border-end">
                                <img src="{{ url('frontend/images/ic_language.png') }}" alt="" class="features-image">
                                <div class="description">
                                    <h3>Language</h3>
                                    <p>{{ $item->language }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ url('frontend/images/ic_foods.png') }}" alt="" class="features-image">
                                <div class="description">
                                    <h3>Foods</h3>
                                    <p>{{ $item->foods }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-10">
                    <div class="card card-details card-right ">
                        <h2>Members are going</h2>
                        <div class="members my-2">
                            <img src="/frontend/images/member-1.png" alt="" class="member-image me-1">
                            <img src="/frontend/images/member-2.png" alt="" class="member-image me-1">
                            <img src="/frontend/images/member-3.png" alt="" class="member-image me-1">
                            <img src="/frontend/images/member-4.png" alt="" class="member-image me-1">
                            <img src="/frontend/images/member-5.png" alt="" class="member-image me-1">
                        </div>
                        <hr>
                        <h2>Trip Informations</h2>
                        <table class="trip-informations">
                            <tr>
                                <th width="50%">Date of Departure</th>
                                <td width="50%" class="text-end">
                                    {{ \Carbon\Carbon::create($item->date_of_departure)->format('F n, Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Duration</th>
                                <td width="50%" class="text-end">
                                    {{ $item->duration }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Type</th>
                                <td width="50%" class="text-end">
                                    {{ $item->type }}
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">Price</th>
                                <td width="50%" class="text-end">
                                    ${{ $item->price }},00 / person
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="join-container d-grid">
                        @auth
                            <form action="{{ route('checkout_process', $item->id) }}" method="post">
                                @csrf
                                <div class="d-grid">
                                    <button class="btn btn-join-now mt-3 py-2" type="submit">
                                        Join Now
                                    </button>
                                </div>
                            </form>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-join-now mt-3 py-2">
                                Login or Register to Join
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.min.css') }}" />
@endpush

@push('prepend-script')
<script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 500,
            title: false,
            tint: '#333',
            Xoffset: 15
        });
    });
</script>
@endpush
