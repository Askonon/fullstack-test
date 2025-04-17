<?php

namespace App\Controllers;

use App\Models\CommentModel;
use CodeIgniter\API\ResponseTrait;
class Comments extends BaseController
{
    use ResponseTrait;
    private int $limit = 3;

    public function index(): string
    {
        $commentsModel = new CommentModel();
        $data = [
            'sort'     => ['orderBy' => 'id', 'direction' => 'asc'],
            'comments' => $commentsModel->orderBy('id', 'asc')->paginate($this->limit),
            'pager'    => $commentsModel->pager
        ];
        return view('templates/header').view('templates/comments/list',  $data)
        .view('templates/comments/form').view('templates/footer');
    }

    public function create() {
        
        $rules = [
            'name' => 'required|max_length[254]|valid_email',
            'text' => 'required|max_length[255]',
            'date' => 'required|max_length[255]|valid_date[Y-m-d]',
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        
        $validData = $this->validator->getValidated();
        
        $commentsModel = new CommentModel();
        $commentsModel->insert([
            'name' => $validData['name'], 
            'text' => $validData['text'],
            'date' => $validData['date']
        ]);

        return $this->respondCreated();
    }

    public function read() {
        $rules = [
            'page'      => 'required|integer',
            'orderBy'   => 'required|in_list[id, date]',
            'direction' => 'required|in_list[asc, desc]',
        ];

        $data = $this->request->getGet(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
        $commentsModel = new CommentModel();
        $data = [
            'sort'     => ['orderBy' => $data['orderBy'], 'direction' => $data['direction']],
            'comments' => $commentsModel->orderBy($data['orderBy'], $data['direction'])->paginate($this->limit),
            'pager'    => $commentsModel->pager,
            'ajax'     => true,
        ];
        return view('templates/comments/list',  $data);
    }

    public function update() {
        $rules = [
            'id'   => 'required|integer',
            'name' => 'required|max_length[254]|valid_email',
            'text' => 'required|max_length[255]',
            'date' => 'required|max_length[255]|valid_date[Y-m-d]',
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $validData = $this->validator->getValidated();

        $commentsModel = new CommentModel();
        $result = $commentsModel->update($validData['id'], [
            'name' => $validData['name'], 
            'text' => $validData['text'],
            'date' => $validData['date']
        ]);
        return $this->respondUpdated(); 
    }

    public function delete() {
        $rules = [
            'id'   => 'required|integer',
        ];

        $data = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors([$this->validator->getErrors()]);
        }

        $validData = $this->validator->getValidated();

        $commentsModel = new CommentModel();
        $result = $commentsModel->delete($validData['id']);
        return $this->respondDeleted();
    }
}
