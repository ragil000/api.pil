<?php

class AccountModel extends CI_Model {

    public function getAccount($_id = null) {
        if($_id === null) {
            return $this->db->get('users')->result_array();
        }else {
            return $this->db->get_where('users', ['_id' => $_id])->result_array();
        }
    }

    public function postAccount($data = null) {
        if($data === null) {
            return $this->db->affected_rows();
        }else {
            $this->db->insert('users', $data);
            return $this->db->affected_rows();
        }
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
                    'status' => true,
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