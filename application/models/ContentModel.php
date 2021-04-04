<?php

class ContentModel extends CI_Model {

    public function getDataByMenuID($menu_id) {
        $imageUrl = base_url('assets/img/post/');

                $this->db->where('menu_id', $menu_id);
                $this->db->select('_id, menu_id, title, CONCAT("'.$imageUrl.'", image) as image, youtube, description, slug, status');
        $get =  $this->db->get('contents');
        if($get->num_rows() > 0) {
            $results = [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get->result(),
                'response_code' => 200
            ];
        }else {
            $results = [
                'status' => false,
                'message' => 'data kosong',
                'response_code' => 200
            ];
        }
        return $results;
    }

    public function getDataByMenuIDAndID($menu_id, $_id) {
        $imageUrl = base_url('assets/img/post/');

                $this->db->where('menu_id', $menu_id);
                $this->db->where('_id', $_id);
                $this->db->select('_id, menu_id, title, CONCAT("'.$imageUrl.'", image) as image, youtube, description, slug, status');
        $get =  $this->db->get('contents');
        if($get->num_rows() > 0) {
            $results = [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get->row(),
                'response_code' => 200
            ];
        }else {
            $results = [
                'status' => false,
                'message' => 'data kosong',
                'response_code' => 200
            ];
        }
        return $results;
    }

    public function postData($post) {
        $allowPost = ['menu_id', 'title', 'description'];
        $optionalPost = ['image', 'youtube'];
        $checkPost = true;
        $countPost = 0;
        $uploadImage = $this->__uploadImage();
        if($uploadImage['status']) {
            $post['image'] = $uploadImage['file_name'];
        }

        foreach($post as $key => $value) {
            if(!in_array($key, $allowPost)) {
                if(!in_array($key, $optionalPost)) {
                    $results = [
                        'status' => false,
                        'message' => 'data ['.$key.'] tidak dikenali',
                        'response_code' => 400
                    ];
                    return $results;
                }else {
                    $countPost--;
                }
            }else {
                if(empty($value)){
                    $checkPost = false;
                }
            }
            
            $countPost++;
        }

        if($countPost != 3) {
            $checkPost = false;
        }

        if(!$checkPost) {
            $results = [
                'status' => false,
                'message' => 'data request salah',
                'response_code' => 400
            ];
            return $results;
        }

        $slug = strtolower(str_replace(' ', '-', $post['title']));
        $post['slug'] = $slug.'-'.time();
        $post['created_by'] = 1;

        $get = $this->db->get_where('contents', ['slug' => $post['slug']]);
        if($get->num_rows() > 0) {
            $post['slug'] = $slug.'-'.time();
        }
        
        $insert = $this->db->insert('contents', $post);
        if($insert) {
            $results = [
                'status' => true,
                'message' => 'berhasil menambahkan data',
                'response_code' => 200
            ];
        }else {
            $results = [
                'status' => false,
                'message' => 'kesalahan saat memproses request',
                'response_code' => 500
            ];
        }
        return $results;
    }

    public function putData($_id, $put) {
        $get = $this->db->get_where('contents', ['_id' => $_id]);
        if($get->num_rows() > 0) {
            $allowPut = ['title', 'description'];
            $optionalPut = ['image', 'youtube'];
            $checkPut = true;
            $countPut = 0;
            $uploadImage = $this->__uploadImage();
            $row = $get->row();
            if($uploadImage['status']) {
                $put['image'] = $uploadImage['file_name'];
                if($row->image) {
                    unlink('./assets/img/post/'.$row->image);
                }
            }else {
                $put['image'] = $row->image;
            }
    
            foreach($put as $key => $value) {
                if(!in_array($key, $allowPut)) {
                    if(!in_array($key, $optionalPut)) {
                        $results = [
                            'status' => false,
                            'message' => 'data ['.$key.'] tidak dikenali',
                            'response_code' => 400
                        ];
                        return $results;
                    }else {
                        $countPut--;
                    }
                }else {
                    if(empty($value)){
                        $checkPost = false;
                    }
                }
                
                $countPut++;
            }
    
            if($countPut != 2) {
                $checkPut = false;
            }
    
            if(!$checkPut) {
                $results = [
                    'status' => false,
                    'message' => 'data request salah',
                    'response_code' => 400
                ];
                return $results;
            }
    
            $put['slug'] = $row->slug;
            $put['updated_at'] = date('Y-m-d h:m:s');
            $put['updated_by'] = 1;
            
            $update = $this->db->update('contents', $put, ['_id' => $_id]);
            if($update) {
                $results = [
                    'status' => true,
                    'message' => 'berhasil mengubah data',
                    'response_code' => 200
                ];
            }else {
                $results = [
                    'status' => false,
                    'message' => 'kesalahan saat memproses request',
                    'response_code' => 500
                ];
            }
        }else {
            $results = [
                'status' => false,
                'message' => 'data tidak ditemukan',
                'response_code' => 400
            ];
        }
        return $results;
    }

    public function deleteData($_id) {
        $get = $this->db->get_where('contents', ['_id' => $_id]);
        if($get->num_rows() > 0) {
            $row = $get->row();
            if($row->image) {
                unlink('./assets/img/post/'.$row->image);
            }
            $delete = $this->db->delete('contents', ['_id' => $_id]);
            if($delete) {
                $results = [
                    'status' => true,
                    'message' => 'berhasil menghapus data',
                    'response_code' => 200
                ];
            }else {
                $results = [
                    'status' => false,
                    'message' => 'kesalahan saat memproses request',
                    'response_code' => 500
                ];
            }
        }else {
            $results = [
                'status' => false,
                'message' => 'data tidak ditemukan',
                'response_code' => 400
            ];
        }
        return $results;
    }

    protected function __uploadImage(){
        $time                       = time();
        $config['upload_path']      = './assets/img/post/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['file_name']        = $time.'.jpg';
        $config['overwrite']		= TRUE;
        $config['max_size']         =  2048;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')){
            $results        = [
                'status'    => FALSE
            ];
        }else{
            $results        = [
                'status'    => TRUE,
                'file_name' => $config['file_name']
            ];
            $resize_image   = $this->__createThumbs($config['file_name']);
            if(!$resize_image) {
                $results    = [
                    'status'    => FALSE
                ];
            }
        }
        return $results;
    }

    protected function __createThumbs($file_name){
        $status     = TRUE;
        // Image resizing config
        $config = array(
            // image Medium
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/post/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 600,
                'height'        => 400,
                'new_image'     => './assets/img/post/smalls/'.$file_name
                ),
            // Image Small
            array(
                'image_library' => 'GD2',
                'source_image'  => './assets/img/post/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 80,
                'height'        => 60,
                'new_image'     => './assets/img/post/thumbs/'.$file_name
            )
        );
 
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item){
            $this->image_lib->initialize($item);
            if(!$this->image_lib->resize()){
                $status    = FALSE;
            }
            $this->image_lib->clear();
        }
        return $status;
    }
}