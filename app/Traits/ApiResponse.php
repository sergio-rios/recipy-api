<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponse
{
    /**
     * Returns a successful JSON response.
     *
     * @return \Illuminate\Http\Response
     */
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }


    /**
     * Returns a error JSON response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function errorResponse($msg, $code)
    {
        return response()->json([
            'error' => $msg,
            'code' => $code
        ], $code);
    }


    /**
     * Returns a successful JSON response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function showAll(Collection $collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }

    /**
     * Returns a successful JSON response.
     *
     * @return \Illuminate\Http\Response
     */
    protected function showOne(Model $instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    /**
     * Returns a successful JSON response with a message.
     *
     * @return \Illuminate\Http\Response
     */
    protected function showMessage($msg, $code = 200)
    {
        return $this->successResponse(['data' => $msg], $code);
    }
}
