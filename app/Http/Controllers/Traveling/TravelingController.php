<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Country\Country;
use App\Models\City\City;
use App\Models\Reservation\Reservation;

class TravelingController extends Controller
{
    //about
    public function about($id)
    {

        $cities = City::select()->orderBy('id', 'desc')->take(5)
            ->where('country_id', $id)->get();

        $counties = Country::find($id);

        $citiesCount = City::select()->where('country_id', $id)->count();

        return view('traveling.about', compact('cities', 'counties', 'citiesCount'));
    }


    //makeReservation
    public function makeReservations($id)
    {

        $city = City::find($id);

        return view('traveling.reservation', compact('city'));
    }


    //storeReservations
    public function storeReservations(Request $request, $id)
    {

        $city = City::find($id);

        if ($request->check_in_date > date('Y-m-d')) {

            $storeReservations = Reservation::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'number_guests' => $request->number_guests,
                'check_in_date' => $request->check_in_date,
                'destination' => $request->destination,
                'price' => (float)$city->price * (int)$request->number_guests,
                'user_id' => Auth::user()->id,
            ]);

            if ($storeReservations) {


                $price = Session::put('price', $city->price * $request->number_guests);


                $newPrice = Session::get($price);

                // echo "Reservation is made successfully";
                return redirect()->route('traveling.pay');
            }
        } else {
            echo "Please enter a valid date";
        }
    }

    //payWithPayPal
    public function payWithPayPal()
    {
        return view('traveling.pay');
    }

    //success
    public function success()
    {
        Session::forget('price');

        return view('traveling.success');
    }


    //deals
    public function deals()
    {
        $cities = City::select()->orderBy('id', 'desc')->take(4)->get();
        $countries = Country::all();


        return view('traveling.deals', compact('cities', 'countries'));
    }


    //searchDeals
    public function searchDeals(Request $request)
    {
        $country_id = $request->get('country_id');
        $price = $request->get('price');

        $searches = City::where('country_id', $country_id)->where('price', '<=', $price)->orderBy('id', 'desc')->take(4)->get();

        $countries = Country::all();
        $cities = City::all();

        return view('traveling.searchdeals', compact('searches', 'countries', 'cities'));
    }
}
