<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Http;

class DriblyController extends Controller {

    /**
     * return an error status responding to the correct code
     * @param int $code
     * @param array $fieldErrors
     * @param string $error
     */
    public function respondError(int $code, array $fieldErrors = [], string $error = "") {
        $response = new \Laravel\Lumen\Http\ResponseFactory();
        \Log::error($code . " : " . $error . " " . implode($fieldErrors));
        return $response->json(["fieldErrors" => $fieldErrors, "error" => $error], $code);
    }

    public function respondSuccess($data) {
        $response = new \Laravel\Lumen\Http\ResponseFactory();
        return $response->json($data, 200);
    }
}
