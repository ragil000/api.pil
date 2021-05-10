<?php

class ChatModel extends CI_Model {

    public function getData($user_id = null) {
                        if($user_id !== null) {
                            $this->db->join('users', 'users._id=chats.user_id');
                            $this->db->where('user_id', $user_id);
                            $this->db->select('chats._id, users._id as user_id, users.username, chats.chat, chats.created_at, chats.created_by as sender_id');
                        }else {
                            $this->db->join('users', 'users._id=chats.user_id');
                            $this->db->select('chats._id, users._id as user_id, users.username, chats.chat, chats.created_at, chats.created_by as sender_id');
                            $this->db->group_by('chats.user_id');
                            $this->db->order_by('created_at', 'DESC');
                        }
        $get =    $this->db->get('chats');
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

    public function postData($post) {
        $allowPost = ['user_id', 'chat', 'created_by'];
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

        $insert = $this->db->insert('chats', $post);
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

}