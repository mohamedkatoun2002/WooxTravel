@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4> Searching Results </h4>
                        <h2>Amazing Prices &amp; More</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="search-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="search-form" name="gs" method="POST" role="search"
                            action="{{ route('traveling.deals.search') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-2">
                                    <h4>Sort Deals By:</h4>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset>
                                        <select name="country_id" class="form-select" aria-label="Default select example"
                                            id="chooseLocation" onChange="this.form.click()">
                                            <option selected>Destinations</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-4">
                                    <fieldset>
                                        <select name="price" class="form-select" aria-label="Default select example"
                                            id="choosePrice" onChange="this.form.click()">
                                            <option selected>Price</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->price }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-lg-2">
                                    <fieldset>
                                        <button type="submit" class="border-button">Search Results</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="amazing-deals">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading text-center">
                            <h2 class="text-white">Best Weekly Offers In Each City</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore.</p>
                        </div>
                    </div>

                    @if ($searches->count() > 0)
                        @foreach ($searches as $city)
                            <div class="col-lg-6 col-sm-6">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="image">
                                                <img src="{{ asset('assets/images/' . $city->image . '') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 align-self-center">
                                            <div class="content">
                                                <span class="info">*Limited Offer Today</span>
                                                <h4 style="color: #22b3c1">{{ $city->name }}</h4>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <i class="fa fa-clock"></i>
                                                        <span class="list">{{ $city->num_days }} Days</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <i class="fa fa-map"></i>
                                                        <span class="list">Daily Places</span>
                                                    </div>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet dire consectetur adipiscing elit.</p>
                                                <div class="main-button">
                                                    <a href="{{ route('traveling.reservation', $city->id) }}">Make a
                                                        Reservation</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            <p class="alert alert-success">we have no search Like this for now</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
