<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class People extends REST_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index_get($id = 0)
    {
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
        } else if ($id == 0) {
            $adatok = $this->db->get("people")->result_array();
            $this->response($adatok, REST_Controller::HTTP_OK);
        } else {
            $this->db->where('id', $id);
            $adatok = $this->db->get("people")->row_array();
            if (empty($adatok)) {
                $this->response(["A megadott azonosítóval nem található ember."], REST_Controller::HTTP_NOT_FOUND);
            } else {
                $this->response($adatok, REST_Controller::HTTP_OK);
            }
        }
    }

    public function index_post()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->post());
        $this->form_validation->set_rules('name', 'Az ember neve', 'trim|required');
        $this->form_validation->set_rules('email', 'Az ember e-mail címe', 'trim|required');
        $this->form_validation->set_rules('age', 'Az ember életkora', 'trim|required|numeric|greater_than_equal_to[20]|less_than_equal_to[80]');
        if (!$this->form_validation->run()) {
            $message = validation_errors();
            $message = str_replace('<p>', '', $message);
            $message = str_replace('</p>', '', $message);
            $message = str_replace("\n", " ", $message);
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
        else {
            $data = [];
            $data['name'] = $this->post('name');
            $data['email'] = $this->post('email');
            $data['age'] = $this->post('age');
            $this->db->insert('people', $data);
            $data['id'] = $this->db->insert_id();
            $this->response($data, REST_Controller::HTTP_CREATED);
        }
    }

    public function index_put($id)
    {
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $this->db->where('id', $id);
        $adatok = $this->db->get("people")->row_array();
        if (empty($adatok)) {
            $this->response(["A megadott azonosítóval nem található ember."], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_data($this->put());
        $this->form_validation->set_rules('name', 'Az ember neve', 'trim|required');
        $this->form_validation->set_rules('email', 'Az ember e-mail címe', 'trim|required');
        $this->form_validation->set_rules('age', 'Az ember életkora', 'trim|required|numeric|greater_than_equal_to[20]|less_than_equal_to[80]');
        if (!$this->form_validation->run()) {
            $message = validation_errors();
            $message = str_replace('<p>', '', $message);
            $message = str_replace('</p>', '', $message);
            $message = str_replace("\n", " ", $message);
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
        }
        else {
            $data = [];
            $data['name'] = $this->put('name');
            $data['email'] = $this->put('email');
            $data['age'] = $this->put('age');
            $this->db->where('id', $id);
            $this->db->update('people', $data);
            $data['id'] = $id;
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    public function index_delete($id)
    {
        if (!is_numeric($id)) {
            $this->response(["Az azonosítónak számnak kell lennie."], REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $this->db->where('id', $id);
        $adatok = $this->db->get("people")->row_array();
        if (empty($adatok)) {
            $this->response(["A megadott azonosítóval nem található ember."], REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        $this->db->where('id', $id);
        $this->delete('people');
        $this->response(NULL,REST_Controller::HTTP_NO_CONTENT);
    }
}
?>