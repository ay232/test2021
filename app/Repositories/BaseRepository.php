<?php

namespace App\Repositories;

use App\Exceptions\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    private $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getInstance()
    {
        return $this->model;
    }


    /**
     * @param $data
     * @throws ValidationException
     */
    public function validateData($data)
    {
        if ($data instanceof Request) {
            $validatingData = $data->all();
        } elseif (is_array($data)) {
            $validatingData = $data;
        }
        $rules = $this->getValidationRules();
        $messages = $this->getValidationMessages();
        $validator = Validator::make($validatingData, $rules, $messages);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors());
        }
    }

    /**
     * @param $data
     * @return Model
     */
    public function create(array $data)
    {
        $this->validateData($data);
        $this->model->create($data);
        $result = $this->getJustCreatedModel($data);
        return $result;
    }

    /**
     * @param $data
     * @return Model
     */
    public function update(array $data)
    {
        $this->validateData($data);
        $this->findOrFail($data['id']);
        $result = $this->model->update($data);
        return $this->findOrFail($data['id']);
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function findOrFail($id)
    {
        $this->model = $this->model->findOrFail($id);
        return $this->model;
    }

    public function destroy($data)
    {
        $this->validateData($data);
        $this->findOrFail($data['id']);
        $this->model->delete($data['id']);
    }

    /**
     * @return Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $data
     * @return Model
     */
    public function getJustCreatedModel($data)
    {
        return null;
    }

    /**
     * @return array
     */
    public function getValidationRules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getValidationMessages()
    {
        return [];
    }

}