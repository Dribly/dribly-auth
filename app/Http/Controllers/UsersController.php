<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dribly\User;

class UsersController extends DriblyController {

    public function index(Request $request) {
        $items = User::on();
        if ($request->has('email')) {
            $items->where('email', $request->query('email'));
        }
        if ($request->has('firstname')) {
            $items->where('firstname', $request->input('firstname'));
        }
        if ($request->has('lastname')) {
            $items->where('lastname', $request->input('lastname'));
        }
        
        $result = $items->get();
        return $this->respondSuccess($result);
    }
    
    public function emailIsValid(Request $request) {
        $items = User::on();
        if ($request->has('email')) {
            $items->where('email', $request->query('email'));
            $result = $items->first();
            if ($result)
            {
                $response = $this->respondSuccess(true);
            }
            else
            {
                $response = $this->respondSuccess(false);
            }
        }
        else
        {
            $response = $this->respondError(400, ['email'=>'You Must supply an email address'], 'Search parameters missing');
        }
        
        return $response;
        
    }
}
