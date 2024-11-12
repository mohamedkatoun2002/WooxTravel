@extends('layouts.app')

@section('content')
    <div class="about-main-content" style="margin-top: -25px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="blur-bg"></div>
                        <H4 class="main-button">You booked this tour successfuly</H4>
                        <div class="line-dec"></div>
                        <div class="main-button"><a href="{{ route('home') }}">Home</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
