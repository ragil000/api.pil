<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class MenuController extends CI_Controller {

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
        $this->load->model('MenuModel');
    }

    public function index_get($_id = null) {        
        $results = $this->MenuModel->getData($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_post() {
        $post = $this->post();

        $results = $this->MenuModel->postData($post);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_put() {
        $_id = $this->get('_id');
        $put = $this->put();

        $results = $this->MenuModel->putData($_id, $put);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_delete() {
        $_id = $this->get('_id');

        $results = $this->MenuModel->deleteData($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }
}
