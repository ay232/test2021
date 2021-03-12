<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * @var Request
     */
    private $request;

    /**
     * ProductController constructor.
     * @param ProductRepository $repository
     * @param Request $request
     */
    public function __construct(ProductRepository $repository, Request $request)
    {
        parent::__construct($repository);
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * @param null $id
     * @return JsonResponse
     */
    public function index($id = null)
    {
        if ($id) {
            try {
                $result = new ProductResource($this->repository->findOrFail($id));
            } catch (Exception $e) {
                return $this->sendError('No such record', 'No such record', JsonResponse::HTTP_NOT_FOUND);
            }
        } else {
            $result = new ProductResourceCollection($this->repository->all());
        }
        return $this->sendResponse($result);
    }

    /**
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $result = $this->repository->create($this->request->all());
            return $this->sendResponse(new ProductResource($result));
        } catch (ValidationException $e) {
            return $this->sendError($e->getValidationErrors(), $e->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function update()
    {
        try {
            $result = $this->repository->update($this->request->all());
            return $this->sendResponse(new ProductResource($result));
        } catch (ValidationException $e) {
            return $this->sendError($e->getValidationErrors(), $e->getMessage());
        }
    }

    /**
     * @return JsonResponse
     */
    public function destroy()
    {
        try {
            $this->repository->destroy($this->request->all());
            return $this->sendResponse();
        } catch (ValidationException $e) {
            return $this->sendError($e->getValidationErrors(), $e->getMessage());
        }
    }
}
