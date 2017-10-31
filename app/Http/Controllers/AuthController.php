<?php
namespace App\Http\Controllers;

use App\Auth;
Use Dribly\User;

class AuthController extends Controller
{

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function auth(Request $request) {
        return User::findOrFail($request->email, $request->password);
    }
}
