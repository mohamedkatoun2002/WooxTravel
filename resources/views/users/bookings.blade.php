@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>My Bookings</h2>
                    </div>
                </div>
            </div>
        </div>



        <div class="amazing-deals">
            <div class="container">
                <div class="row">
                    < class="col-lg-6 offset-lg-3">
                        <div class="section-heading text-center">
                            <h2 class="text-black">Here are your bookings </h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore.</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Guest Number</th>
                                        <th scope="col">Check In</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">User_id</th>
                                        <th scope="col">Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->phone_number }}</td>
                                            <td>{{ $booking->number_guests }}</td>
                                            <td>{{ $booking->check_in_date }}</td>
                                            <td> {{ $booking->destination }}</td>
                                            <td>{{ $booking->price }}</td>
                                            <td>{{ $booking->user_id }}</td>
                                            <td>{{ $booking->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
