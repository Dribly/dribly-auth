<?php
namespace App\Http\Controllers;

use App\Auth;
use Dribly\User;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends \App\Http\Controllers\DriblyController {

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function auth(Request $request) {
        try
        {
        $user = User::findOrFail($request->email);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            $user = null;
        }
        $response = false;

        if ($user instanceof User)
        {
            if (Hash::check($request->password. $user->password))
            {
                $response = $this->respondSuccess($user);
            }
        }
        else
        {
            // crazy securoty. dont let them know the email was not a match in a timing attack
            Hash::check('passwoota', 'thisisnotpasswoota');
        }
        if ($response)
        {
            return $response;
        }
        else
        {
            return $this->respondError(404, [], 'User not found');
        }
    }
}
