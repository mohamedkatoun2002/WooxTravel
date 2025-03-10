@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="container">
                        @if (session()->has('delete'))
                            <div class="alert alert-success">
                                {{ session()->get('delete') }}
                            </div>
                        @endif
                    </div>
                    <h5 class="card-title mb-4 d-inline">Cities</h5>
                    <a href="{{ route('admin.create.cities') }}" class="btn btn-primary mb-4 text-center float-right">Create
                        cities</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">trip_days</th>
                                <th scope="col">price</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <th scope="row">{{ $city->id }}</th>
                                    <td>{{ $city->name }}</td>
                                    <td><img src="{{ asset('assets/images/' . $city->image . '') }}" alt=""
                                            width="100px"></td>
                                    <td>{{ $city->num_days }}</td>
                                    <td>${{ $city->price }}</td>
                                    <td><a href="{{ route('admin.delete.cities', $city->id) }}"
                                            class="btn btn-danger  text-center ">delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
