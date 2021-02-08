<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        //get all patients
        $service = Service::orderBy('typeOfService','desc')->get();

        return api_response(true, null, 'success',
            'successfully fetched services', $service);
    }



    public function store(Request $request)
    {

        try{
            $service = new Service();
            $service->typeOfService = $request['typeOfService'];
            $service->save();

            return api_response(true, null, 'success',
                'successfully added service information', $service);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error adding service information', null);
        }
    }


    public function show($id)
    {
        try{
            $service = Service::find($id);

            return api_response(true, null, 'success',
                'successfully fetched service information', $service);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error fetching service information', null);
        }
    }


    public function update(Request $request, $id)
    {

        try{
            $service = Service::find($id);
            $service->typeOfService = $request['typeOfService'];
            $service->save();

            return api_response(true, null, 'success',
                'successfully updated service information', $service);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error updating service information', null);
        }
    }


    public function destroy($id)
    {
        try{
            $service = Service::find($id);

            //get all users who have that serviceId and put null
            $users = User::where('serviceId', $id)->update(['serviceId',NULL]);


            $service->delete();

            return api_response(true, null, 'success',
                'successfully deleted service information', null);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error deleting service information', null);
        }
    }
}
