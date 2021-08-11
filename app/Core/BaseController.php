<?php

namespace App\Core;

use App\Http\Controllers\Controller;


class BaseController extends Controller
{

    protected $errors = false;


    /**
     * Return a json Response
     *
     * @param mixed $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data, $status = 200)
    {
        return response()->json($data, $status);
    }

    /**
     * Returns a Successful response for a request
     *
     * @param $message
     * @param int $code
     * @param null $resource
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($message, $code = 200, $resource = null)
    {
        $response = [
            'message' => $message,
            'code' => $code,
            'data' => ''
        ];

        if (is_array($resource) && array_key_exists('data', $resource)) {
            $response['data'] = $resource['data'];
        } else {
            $response['data'] = $resource;
        }

        return $this->jsonResponse($response);
    }

    /**
     * Returns an Error response for a request
     *
     * @param string $message
     * @param int|null $code
     * @param mixed|null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code = 400, $data = null)
    {
        $response = [
            'message' => $message,
            'errors' => true,
            'data' => $data,
        ];

        if ($code) {
            $response['code'] = $code;
            return $this->jsonResponse($response, $code);
        }

        return $this->jsonResponse($response);
    }
}
