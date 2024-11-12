<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\Admins\Admins;
use App\Models\Country\Country;
use App\Models\City\City;
use App\Models\Reservation\Reservation;

class AdminsController extends Controller
{

    //viewLogin
    public function viewLogin()
    {
        return view('admins.login');
    }

    //checkLogin
    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }


    // dashboard
    public function index()
    {
        $countriesCount = Country::select()->count();
        $citiesCount = City::select()->count();
        $adminsCount = Admins::select()->count();

        return view('admins.index', compact('countriesCount', 'citiesCount', 'adminsCount'));
    }


    //allAdmins
    public function allAdmins()
    {
        $allAdmins = Admins::select()->orderBy('id', 'desc')->get();

        return view('admins.alladmins', compact('allAdmins'));
    }

    //createAdmins
    public function createAdmins()
    {
        return view('admins.createadmins');
    }

    //storeAdmins
    public function storeAdmins(Request $request)
    {

        $storeAdmins = Admins::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        if ($storeAdmins) {
            return Redirect::route('admin.all.admins')->with(['success' => 'Admin created successfully']);
        }
    }


    //deleteAdmins
    public function deleteAdmins($id)
    {
        $deleteAdmins = Admins::find($id);
        $deleteAdmins->delete();
        if ($deleteAdmins) {
            return Redirect::route('admin.all.admins')->with(['delete' => 'Admin deleted successfully']);
        }
    }



    //allCountries
    public function allCountries()
    {
        $countries = Country::select()->orderBy('id', 'desc')->get();
        return view('admins.allcountries', compact('countries'));
    }

    //createCountries
    public function createCountries()
    {
        return view('admins.createcountries');
    }

    //storeCountries
    public function storeCountries(Request $request)
    {
        Request()->validate([
            'name' => 'required|max:255',
            'image' => 'required | image | max: 2048',
            'continent' => 'required | max: 255',
            'population' => 'required | max: 255',
            'territory' => 'required | max: 255',
            'avg_price' => 'required | max: 255',
            'description' => 'required',
        ]);


        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);


        $storeCountries = Country::create([
            "name" => $request->name,
            "image" => $myimage,
            "continent" => $request->continent,
            "population" => $request->population,
            "territory" => $request->territory,
            "avg_price" => $request->avg_price,
            "description" => $request->description,

        ]);
        if ($storeCountries) {
            return Redirect::route('admin.all.countries')->with(['success' => 'Country created successfully']);
        }
    }

    // //editHotels
    // public function editHotels($id)
    // {
    //     $hotels = Hotel::find($id);
    //     return view('admins.edithotels', compact('hotels'));
    // }
    // //updateHotels
    // public function updateHotels(Request $request, $id)
    // {

    //     Request()->validate([
    //         'name' => 'required|max:255',
    //         'description' => 'required',
    //         'location' => 'required | max: 255',
    //     ]);

    //     // $updateHotels = Hotel::where('id', $id)->update([
    //     //     "name" => $request->name,
    //     //     "description" => $request->description,
    //     //     "location" => $request->location,
    //     // ]);

    //     $hotels = Hotel::find($id);
    //     $hotels->update($request->all());

    //     if ($hotels) {
    //         return Redirect::route('hotels.all')->with(['update' => 'Hotel updated successfully']);
    //     }
    // }

    //deleteCountries
    public function deleteCountries($id)
    {
        $deleteCountries = Country::find($id);

        if (File::exists(public_path('assets/images/' . $deleteCountries->image))) {
            File::delete(public_path('assets/images/' . $deleteCountries->image));
        } else {
            //dd('File does not exists.');
        }

        $deleteCountries->delete();
        if ($deleteCountries) {
            return Redirect::route('admin.all.countries')->with(['delete' => 'Country deleted successfully']);
        }
    }

    //allCities
    public function allCities()
    {
        $cities = City::select()->orderBy('id', 'desc')->get();
        return view('admins.allcities', compact('cities'));
    }

    //createCities
    public function createCities(Request $request)
    {
        $cities = City::all();
        $countries = Country::all();
        return view('admins.createcities', compact('cities', 'countries'));
    }


    //storeCities
    public function storeCities(Request $request)
    {
        Request()->validate([
            'name' => 'required|max:255',
            'image' => 'required | image | max: 2048',
            'num_days' => 'required',
            'price' => 'required',
            'country_id' => 'required',
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeCities = City::create([
            "name" => $request->name,
            "image" => $myimage,
            "num_days" => $request->num_days,
            "price" => $request->price,
            "country_id" => $request->country_id,
        ]);
        if ($storeCities) {
            return Redirect::route('admin.all.cities')->with(['success' => 'City created successfully']);
        }
    }

    //deleteCities
    public function deleteCities($id)
    {
        $deleteCities = City::find($id);
        if (File::exists(public_path('assets/images/' . $deleteCities->image))) {
            File::delete(public_path('assets/images/' . $deleteCities->image));
        } else {
            //dd('File does not exists.');
        }
        $deleteCities->delete();
        if ($deleteCities) {
            return Redirect::route('admin.all.cities')->with(['delete' => 'City deleted successfully']);
        }
    }


    //allBookings
    public function allBookings()
    {
        $bookings = Reservation::select()->orderBy('id', 'desc')->get();
        return view('admins.allbookings', compact('bookings'));
    }

    //editBookings
    public function editStatus($id)
    {
        $bookings = Reservation::find($id);
        return view('admins.editstatus', compact('bookings'));
    }

    //updateStatus
    public function updateStatus(Request $request, $id)
    {


        $bookings = Reservation::find($id);
        $bookings->update($request->all());
        if ($bookings) {
            return Redirect::route('admin.all.bookings')->with(['update' => 'Status updated successfully']);
        }
    }

    //deleteBookings
    public function deleteBookings($id)
    {
        $deleteBookings = Reservation::find($id);
        $deleteBookings->delete();
        if ($deleteBookings) {
            return Redirect::route('admin.all.bookings')->with(['delete' => 'Booking deleted successfully']);
        }
    }
}
