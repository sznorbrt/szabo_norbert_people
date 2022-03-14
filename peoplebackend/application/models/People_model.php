<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Autok_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function people_listazasa()
    {
        return $this->db->get('people')->result_array();
    }

    public function people_torlese($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('people');
    }
}
?>