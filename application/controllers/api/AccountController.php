<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class AccountController extends CI_Controller {

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct() {
        // Construct the parent class
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        $this->__resTraitConstruct();
        $this->load->model('AccountModel');
    }

    public function index_get() {
        $_id = $this->get('_id');
        
        $result = $this->AccountModel->getAccount($_id);
        if($result) {
            $this->response([
                'status' => true,
                'message' => 'Data tertampil',
                'data' => $result
            ], 200);
        }else {
            $this->response([
                'status' => false,
                'message' => 'Data kosong'
            ], 200);
        }
    }

    public function index_post() {
        $data = [
            'username' => $this->post('username'),
            'password' => md5($this->post('password')),
            'role' => $this->post('role')
        ];

        $result = $this->AccountModel->postAccount($data);
        if($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil ditambahkan'
            ], 201);
        }else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal ditambahkan'
            ], 400);
        }
    }

    public function index_delete() {
        $_id = $this->delete('_id');

        $result = $this->AccountModel->deleteAccount($_id);
        if($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ], 200);
        }else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal dihapus'
            ], 400);
        }
    }

    public function index_put() {
        $_id = $this->put('_id');
        $data = [
            'username' => $this->put('username'),
            'password' => md5($this->put('password')),
            'role' => $this->put('role'),
        ];

        $result = $this->AccountModel->putAccount($data, $_id);
        if($result > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ], 202);
        }else {
            $this->response([
                'status' => false,
                'message' => 'Data gagal diubah'
            ], 400);
        }
    }
}
