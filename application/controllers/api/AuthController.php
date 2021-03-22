<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class AuthController extends CI_Controller {

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

    public function signin_post() {
        $post = $this->post();
        
        $results = $this->AccountModel->signin($post);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function signup_post() {
        $post = $this->post();

        $results = $this->AccountModel->signup($post);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }
}
