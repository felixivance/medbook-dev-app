<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        //get all patients
        $patient = Patient::orderBy('firstName','desc')->get();

        return api_response(true, null, 'success',
            'successfully fetched patients', $patient);
    }



    public function store(Request $request)
    {

        try{
            $patient = new Patient();
            $patient->genderId = $request['genderId'];
            $patient->serviceId = $request['serviceId'];
            $patient->firstName = $request['firstName'];
            $patient->lastName = $request['lastName'];
            $patient->dateOfBirth = $request['dateOfBirth'];
            $patient->comments = $request['comments'];
            $patient->save();

            return api_response(true, null, 'success',
                'successfully added patient information', $patient);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error adding patient information', null);
        }
    }


    public function show($id)
    {
        try{
            $patient = Patient::find($id);

            return api_response(true, null, 'success',
                'successfully fetched patient information', $patient);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error fetching patient information', null);
        }
    }


    public function update(Request $request, $id)
    {

        try{
//            'genderId','serviceId', 'firstName','lastName','dateOfBirth','comments'
            $patient = Patient::find($id);
            $patient->genderId = $request['genderId'];
            $patient->serviceId = $request['serviceId'];
            $patient->firstName = $request['firstName'];
            $patient->lastName = $request['lastName'];
            $patient->dateOfBirth = $request['dateOfBirth'];
            $patient->comments = $request['comments'];

            $patient->save();

            return api_response(true, null, 'success',
                'successfully updated patient information', $patient);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error updating patient information', null);
        }
    }


    public function destroy($id)
    {
        try{
            $patient = Patient::find($id);
            $patient->delete();

            return api_response(true, null, 'success',
                'successfully deleted patient information', null);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error deleting patient information', null);
        }
    }
}
