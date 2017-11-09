<?php

namespace App\Http\Controllers;


use Laravel\Lumen\Http;

class DriblyController extends Controller
{
    /**
     * return an error status responding to the correct code
     * @param int $code
     * @param array $errors
     * @param string $message
     */
    public function respondError(int $code, $errors, string $message)
    {
        $response =  new \Laravel\Lumen\Http\ResponseFactory();
        return $response->json(["errors"=>$errors, "message"=>$message], $code);
    }
}
