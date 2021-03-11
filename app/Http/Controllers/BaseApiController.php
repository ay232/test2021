<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class BaseApiController extends Controller
{
    /**
     * @var BaseRepository
     */
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }




    /**
     * @param $result
     * @param $message
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public function sendResponse($result = null, $message = "Ok", $httpStatusCode = JsonResponse::HTTP_OK)
    {
        $response = [
            'data' => $result,
            'success' => true,
            'message' => $message,
            'errors' => null,
            'code' => $httpStatusCode,
        ];

        return new JsonResponse($response, $httpStatusCode);
    }

    /**
     * @param null $errors
     * @param string $message
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public function sendError($errors = null, $message = '', $httpStatusCode = JsonResponse::HTTP_NOT_FOUND)
    {
        $response = [
            'success' => false,
            'data' => null,
            'message' => $message,
            'errors' => $errors,
        ];

        return new JsonResponse($response, $httpStatusCode);
    }
}
