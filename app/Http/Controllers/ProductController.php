<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationException;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    private $request;

    public function __construct(ProductRepository $repository, Request $request)
    {
        parent::__construct($repository);
        $this->repository = $repository;
        $this->request = $request;
    }

    public function index($id = null)
    {
        if ($id) {
            try{
                $result = new ProductResource($this->repository->findOrFail($id));
            }catch (\Exception $e){
                return $this->sendError('No such record','No such record',JsonResponse::HTTP_NOT_FOUND);
            }
        } else {
            $result = new ProductResourceCollection($this->repository->all());
        }
        return $this->sendResponse($result);
    }

    public function create()
    {
        try{
            $this->repository->create($this->request->all());
            return $this->sendResponse(new ProductResource($this->repository->getInstance()));
        }catch (ValidationException $e){
            return $this->sendError($e->getValidationErrors(),$e->getMessage());
        }
    }

    public function update()
    {
        try{
            $result = $this->repository->update($this->request->all());
            return $this->sendResponse(new ProductResource($result));
        }catch (ValidationException $e){
            return $this->sendError($e->getValidationErrors(),$e->getMessage());
        }
    }

    public function destroy()
    {
        try{
            $result = $this->repository->destroy($this->request->all());
            return $this->sendResponse();
        }catch (ValidationException $e){
            return $this->sendError($e->getValidationErrors(),$e->getMessage());
        }
    }
}
