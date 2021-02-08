<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\User;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function index()
    {
        //get all genders
        $genders = Gender::orderBy('genderType','desc')->get();

        return api_response(true, null, 'success',
            'successfully fetched genders', $genders);
    }



    public function store(Request $request)
    {
        try{
            $gender = new Gender();
            $gender->genderType = $request['genderType'];
            $gender->save();

            return api_response(true, null, 'success',
                'successfully added gender information', $gender);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error adding gender information', null);
        }
    }


    public function show($id)
    {
        try{
            $gender = Gender::find($id);

            return api_response(true, null, 'success',
                'successfully fetched gender information', $gender);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error fetching gender information', null);
        }
    }


    public function update(Request $request, $id)
    {

        try{
            $gender = Gender::find($id);
            $gender->genderType = $request['genderType'];
            $gender->save();

            return api_response(true, null, 'success',
                'successfully updated gender information', $gender);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error updating gender information', null);
        }
    }


    public function destroy($id)
    {
        try{
            $gender = Gender::find($id);

            //get all users who have that gender and put null
            $users = User::where('genderId', $id)->update(['genderId',NULL]);

            $gender->delete();

            return api_response(true, null, 'success',
                'successfully deleted gender information', null);

        }catch (\Exception $ex){
            return api_response(false, $ex->getMessage(), 'error',
                'error deleting gender information', null);
        }
    }
}
