@extends('layouts.checkout')

@section('title', 'Checkout')

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
                                <li class="breadcrumb-item">
                                    Details
                                </li>
                                <li class="breadcrumb-item active">
                                    Checkout
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 pl-lg-0">
                        <div class="card card-details">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h1>Who is Going?</h1>
                            <p>
                                Trip to {{ $item->travel_package->title }}, {{ $item->travel_package->location }}
                            </p>
                            <div class="attendee table-responsive-sm">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Name</td>
                                            <td>Nationality</td>
                                            <td>VISA</td>
                                            <td>Passport</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            <tr>
                                                <td>
                                                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}"
                                                        height="60" class="rounded-circle">
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->username }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->nationality }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $detail->is_visa ? '30 Days' : 'N/A' }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ \Illuminate\Support\Carbon::createFromDate($detail->doe_passport) > \Illuminate\Support\Carbon::now() ? 'Active' : 'Inactive' }}
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout-remove', $detail->id) }}">
                                                        <img src="{{ url('frontend/images/ic_remove.png') }}" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No visitor
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form action="{{ route('checkout-create', 1) }}" class="form-inline" method="post">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col">
                                            <label for="username" class="visually-hidden">Name</label>
                                            <input type="text" name="username" id="username" placeholder="Username"
                                                class="form-control mb-2 me-sm-2" required>
                                        </div>
                                        <div class="col">
                                            <label for="nationality" class="visually-hidden">Name</label>
                                            <input type="text" name="nationality" id="nationality" placeholder="Nationality"
                                                class="form-control mb-2 me-sm-2" required>
                                        </div>
                                        <div class="col">
                                            <label for="is_visa" class="visually-hidden">Visa</label>
                                            <select name="is_visa" id="is_visa"
                                                class="custom-select form-select mb-2 me-sm-2" required>
                                                <option value="" selected>VISA</option>
                                                <option value="1">30 Days</option>
                                                <option value="0">N/A</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="doe_passport" class="visually-hidden">DOE Passport</label>
                                            <input type="date" name="doe_passport" id="doePassport"
                                                class="form-control mb-2 me-sm-2" placeholder="DOE Passport">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-add-now mb-2 px-4">Add Now</button>
                                        </div>
                                    </div>
                                </form>
                                <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">You are only able to invite member that has registered in Nomads.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right mb-sm-10">
                            <h2>Checkout Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Members</th>
                                    <td width="50%" class="text-end">
                                        {{ $item->details->count() }} person
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Additional VISA</th>
                                    <td width="50%" class="text-end">
                                        $ {{ $item->additional_visa }},00
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Total Price</th>
                                    <td width="50%" class="text-end">
                                        $ {{ $item->travel_package->price }},00 / person
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Sub Total</th>
                                    <td width="50%" class="text-end">
                                        $ {{ $item->transaction_total }},00
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Total (+Unique)</th>
                                    <td width="50%" class="text-end text-total">
                                        <span class="text-blue">$ {{ $item->transaction_total }},</span>
                                        <span class="text-orange">{{ mt_rand('0', '99') }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <h2>Payment Instruction</h2>
                            <p class="payment-instructions">
                                You will be redirected to another page to pay using GO-PAY
                            </p>
                            <img src="{{ url('frontend/images/gopay.png') }}" class="w-50">
                        </div>
                        <div class="join-container d-grid">
                            <a href="{{ route('checkout-success', $item->id) }}" class="btn btn-join-now mt-3 py-2">
                                I Have Made Payment
                            </a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">
                                Cancel Booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
