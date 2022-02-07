<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function country()
    {
        return view('backend.country.country',[
            'countries' => Country::orderBy('name', 'ASC')->get()
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required'
        ],[
            'country_id.required' => 'The country filed is required'
        ]);


        foreach(Country::where('status', 1)->get() as $oldCountry)
        {
            Country::where('id', $oldCountry->id)->update([
                'status' => 2
            ]);
        }

        foreach($request->country_id as $country)
        {
            Country::where('id', $country)->update([
                'status' => 1
            ]);
        }
        return back()->with('success', 'Successfull');
    }
}
