<?php

namespace App\Http\Controllers\Api;

use Validator;

trait ApiResponseTrait
{
    public $paginateNumber = 10;

    public function apiResponse($data = null, $error = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->successCode()) ? true : false,
            'error' => $error
        ];
        return response($array, $code);
    }

    public function successCode()
    {
        return [
            200, 201, 202
        ];
    }

    public function createdResponse($data)
    {
        return $this->apiResponse($data, null, 201);
    }

    public function deletedResponse()
    {
        return $this->apiResponse(true, null, 200);
    }

    public function notFoundResponse()
    {
        return $this->apiResponse(null, 'We Not Found!', 404);
    }

    public function unknownError()
    {
        return $this->apiResponse(null, 'unknown Error', 520);
    }

    public function apiValidation($request, $array)
    {
        $validate = Validator::make($request->all(), $array);

        if ($validate->fails()) {
            return $this->apiResponse(null, $validate->errors(), 422);
        }
    }
}
