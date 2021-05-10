<?php

class QuistModel extends CI_Model {

    public function getData($_id = null) {
                        if($_id !== null) {
                            $this->db->where('_id', $_id);
                        }
                        $this->db->select('_id, question, status');
                        $this->db->order_by('rand()');
        $get_quist =    $this->db->get('quists');
        if($get_quist->num_rows() > 0) {
            $fetch_quists = $get_quist->result();
            $data = [];
            foreach($fetch_quists as $quist) {
                                $this->db->select('_id, answer, is_correct');
                                $this->db->order_by('rand()');
                $get_answer =   $this->db->get_where('answers', ['quist_id' => $quist->_id]);
                if($get_answer->num_rows() > 0) {
                    $temp = (object) [
                        'question' => $quist->question,
                        'answers' => $get_answer->result()
                    ];
                    array_push($data, $temp);
                }
            } 

            if(count($data)) {
                $results = [
                    'status' => true,
                    'message' => 'data tertampil',
                    'data' => $data,
                    'response_code' => 200
                ];
            }else {
                $results = [
                    'status' => false,
                    'message' => 'data kosong',
                    'response_code' => 200
                ];
            }
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
        $allowPost = ['question', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'is_correct'];
        $answers = ['answer_a', 'answer_b', 'answer_c', 'answer_d'];
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

        if($countPost != 6) {
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

        $get = $this->db->get_where('quists', ['LOWER(question)' => strtolower($post['question'])]);
        if($get->num_rows() > 0) {
            $results = [
                'status' => false,
                'message' => 'pertanyaan sudah ada',
                'response_code' => 400
            ];
        }else {
            $post_quist = [];

            $post_quist['question'] = $post['question'];
            $post_quist['created_by'] = 1;
            $insert_quist = $this->db->insert('quists', $post_quist);
            if($insert_quist) {
                $quist_id = $this->db->insert_id();
                $status_insert = true;
                for($i=0; $i < count($answers); $i++) {
                    $post_answer = [];
                    $post_answer['quist_id'] = $quist_id;
                    $post_answer['answer'] = $post[$answers[$i]];
                    if($answers[$i] == $answers[$post['is_correct']]) {
                        $post_answer['is_correct'] = 'yes';
                    }
                    $insert_answer = $this->db->insert('answers', $post_answer);
                    if(!$insert_answer) {
                        $this->db->delete('quists', ['_id' => $quist_id]);
                        $this->db->delete('answers', ['quist_id' => $quist_id]);
                        $status_insert = false;
                        break;
                    }
                }
                
                if($status_insert) {
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

    public function postAnswer($post) {
        $allowPost = ['user_id', 'quist_id', 'is_correct'];
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

        $this->db->delete('quist_histories', ['user_id' => $post['user_id'], 'quist_id' => $post['quist_id']]);
        $insert = $this->db->insert('quist_histories', $post);
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

    public function getAnswer($_id = null) {
                $this->db->select('_id, quist_id, is_correct');
        $get =  $this->db->get_where('quist_histories', ['user_id' => $_id]);
        if($get->num_rows() > 0) {
            $total_correct = 0;
            foreach($get->result() as $row) {
                if($row->is_correct == 'yes') {
                    $total_correct++;
                }
            } 

            $results = [
                'status' => true,
                'message' => 'data tertampil',
                'data' => $get->result(),
                'total_quist' => $get->num_rows(),
                'total_correct' => $total_correct,
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

    public function deleteData($id = null) {
        if($id === null) {
            return $this->db->affected_rows();
        }else {
            $this->db->delete('quists', ['_id' => $id]);
            $this->db->delete('answers', ['quist_id' => $id]);
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