<?php

namespace App\Http\Controllers\Auth;

use Dribly\User as User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends \App\Http\Controllers\DriblyController
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = null;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $response = null;
        try {
            $requestData = $request->only('firstname', 'lastname', 'email', 'password', 'password_confirmation');

            \Log::debug(print_r($requestData, true));
            $this->validator($requestData)->validate();
            $user = $this->create($requestData);
            if ($this->registered($request, $user)) {
                $response = $this->respondSuccess($user);
            } else {
                $response = $this->respondError(400, [], "Error when registering");
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error("HERE");
            \Log::error(print_r($e->errors(), true));
            \Log::error("THERE");
            $response = $this->respondError(400, $e->errors(), "Some fields are not correct");
            \Log::error(print_r($e->getMessage(), true));
        } catch (\Exception $e) {
            $response = $this->respondError(500, [], $e->getMessage());
            \Log::error(print_r($e->getMessage(), true));
            var_dump($e);
            echo "no valid";
            die();
        }
        return $response;
    }

    /**
     * Note that this always returns a n array with each of the fields mentioned
     * @param \App\Http\Controllers\Auth\stdClass $input
     * @param type $fields
     * @return array
     */
    protected function getDataValueArray(stdClass $input, $fields)
    {
        $result = [];
        foreach ($fields as $fieldName) {
            // Populate an array member whether the property exists or not
            $result[$fieldName] = ((property_exists($input, $fieldName)) ? $input->fieldName : null);
        }
        return $result;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \Dribly\User
     */
    protected function create(array $data): \Dribly\User
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
       return (0 < $user->id)   ; //
    }
}
