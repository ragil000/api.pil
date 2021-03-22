<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ContentController extends CI_Controller {

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
        $this->load->model('ContentModel');
    }

    public function index_get($menu_id) {        
        $results = $this->ContentModel->getDataByMenuID($menu_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function detail_get($menu_id, $_id) {        
        $results = $this->ContentModel->getDataByMenuIDAndID($menu_id, $_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_post() {
        $post = $this->post();

        $results = $this->ContentModel->postData($post);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_put() {
        $_id = $this->get('_id');
        $put = $this->put();

        $results = $this->ContentModel->putData($_id, $put);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }

    public function index_delete() {
        $_id = $this->get('_id');

        $results = $this->ContentModel->deleteData($_id);
        $responseCode = $results['response_code'];
        unset($results['response_code']);
        $this->response($results, $responseCode);
    }
}
