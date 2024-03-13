<?php 

namespace App\Traits;

trait HttpResponses
{
    /**
     * @param mixed $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(array $data = [], int $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Operação realizada com sucesso.',
            'data' => $data
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(mixed $error, int $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Ocorreu um erro.',
            'errors' => $error
        ], $status);
    }
}