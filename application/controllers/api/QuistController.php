<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class QuistController extends CI_Controller {

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
        $this->load->model('QuistModel');
    }

    public function index_get($_id = null) {        
        $results = $this->QuistModel->getData($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_post() {
        $post = $this->post();

        $results = $this->QuistModel->postData($post);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function answer_post() {
        $post = $this->post();
        if(is_array($post['quist_id'])) {
            for($i=0; $i < count($post['quist_id']); $i++) {
                $new_post = [];
                $new_post['user_id'] = $post['user_id'];
                $new_post['quist_id'] = $post['quist_id'][$i];
                $new_post['is_correct'] = $post['is_correct'][$i];
                $results = $this->QuistModel->postAnswer($new_post);
            }
        }else {
            $results = $this->QuistModel->postAnswer($post);
        }

        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function answer_get($_id = null) {
        $results = $this->QuistModel->getAnswer($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    // public function index_put() {
    //     $_id = $this->get('_id');
    //     $put = $this->put();

    //     $results = $this->QuistModel->putData($_id, $put);
    //     $responseCode = $results['response_code'];
    //     unset($results['response_code']);
    //     $this->response($results, $responseCode);
    // }

    public function index_delete() {
        $_id = $this->get('_id');

        $results = $this->QuistModel->deleteData($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }
}
