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
            }
            
            if(empty($value)){
                $checkPost = false;
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

    public function signin($post) {
        $allowPost = ['username', 'password'];
        $checkPost = true;
        $countPost = 0;
        foreach($post as $key => $value) {
            if(!in_array($key, $allowPost)) {
                $results = [
                    'status' => false,
                    'message' => 'data ['.$key.'] tidak dikenali',
                    'response_code' => 400
                ];
                return $results;
            }
            
            if(empty($value)){
                $checkPost = false;
            }
            $countPost++;
        }

        if($countPost != 2) {
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

        $get = $this->db->get_where('users', ['username' => $post['username']]);
        if($get->num_rows() > 0) {
            $row = $get->row();
            $checkPassword = password_verify($post['password'], $row->password);
            if($checkPassword) {
                $results = [
                    'status' => false,
                    'message' => 'berhasil masuk',
                    'data' => [
                        '_id' => $row->_id,
                        'username' => $row->username,
                        'role' => $row->role,
                        'status' => $row->status
                    ],
                    'response_code' => 200
                ];
            }else {
                $results = [
                    'status' => false,
                    'message' => 'password salah',
                    'response_code' => 400
                ];
            }
        }else {
            $results = [
                'status' => false,
                'message' => 'username salah',
                'response_code' => 400
            ];
        }
        return $results;
    }

    public function signup($post) {
        $allowPost = ['username', 'password', 'role'];
        $checkPost = true;
        $countPost = 0;
        $post['role'] = 'user';
        foreach($post as $key => $value) {
            if(!in_array($key, $allowPost)) {
                $results = [
                    'status' => false,
                    'message' => 'data ['.$key.'] tidak dikenali',
                    'response_code' => 400
                ];
                return $results;
            }
            
            if(empty($value)){
                $checkPost = false;
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

        $get = $this->db->get_where('users', ['username' => $post['username']]);
        if($get->num_rows() > 0) {
            $results = [
                'status' => false,
                'message' => 'username sudah dipakai',
                'response_code' => 400
            ];
        }else {
            $password_hash = password_hash($post['password'], PASSWORD_BCRYPT);
            $post['password'] = $password_hash;
            $insert = $this->db->insert('users', $post);
            if($insert) {
                $results = [
                    'status' => true,
                    'message' => 'berhasil mendaftar',
                    'response_code' => 200
                ];
            }else {
                $results = [
                    'status' => false,
                    'message' => 'kesalahan saat memproses request',
                    'response_code' => 500
                ];
            }
        }
        return $results;
    }

    public function deleteAccount($id = null) {
        if($id === null) {
            return $this->db->affected_rows();
        }else {
            $this->db->delete('tb_akun', ['id_tb_akun' => $id]);
            return $this->db->affected_rows();
        }
    }

    public function putAccount($data = null, $id = null) {
        if($id === null || $data === null) {
            return $this->db->affected_rows();
        }else {
            $this->db->update('tb_akun', $data, ['id_tb_akun' => $id]);
            return $this->db->affected_rows();
        }
    }
}