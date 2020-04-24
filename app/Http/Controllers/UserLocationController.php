<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use App\UserLocation;
use Freshbitsweb\Laratables\Laratables;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::all();
        $userLocation = UserLocation::create();
        $collection = collect([$locations, $userLocation]);
        

        // return response(Location::all()->jsonSerialize(), Response::HTTP_OK);
        return response($collection->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->input();

        $userLocation = UserLocation::create($input);
        $userLocation->user_id = auth('api')->id();
        $userLocation->location_id = $request->location_id;
        $userLocation->check_in = date('Y/m/d h:i:s', time());
        $userLocation->save();

        return response($userLocation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function show(UserLocation $userLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLocation $userLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $userLocation = UserLocation::findOrFail($request->input('id'));
        $userLocation->check_out = date('Y-m-d h:i:s', time());
        $userLocation->save();
        
        $user_location = auth('api')->user()->userLocations->whereNull('check_out')->last();
        
        return response($user_location);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLocation $userLocation)
    {
        //
    }

    
    /**
     * Fetch the most recent
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function lastCheckIn()
    {
        $user_location = auth('api')->user()->userLocations->whereNull('check_out')->last();
        
        return response($user_location);
    }

    /**
     * Fetch the most recent
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        // dd(UserLocation::with(['user','location'])->get());
        return Laratables::recordsOf(UserLocation::class, function ($query) {
            return $query->with(['user','location']);
        });
    }
}
