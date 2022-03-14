<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class people extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');           
        $this->load->library('session');
        $this->api_url = base_url().'api/people';
    }

    public function index()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);     
        $people = json_decode($output, true);

        $data['people'] = $people;

        $fejlec_data['title'] = "Emberek listája";
        $fejlec_data['stylesheets'] = ['listaz'];
        
        $this->load->view('people/listaz', $data);
    }

    public function torol($id = "")
    {
        if ($id == "") {
            $data = array(
                "heading" => "Hiba",
                "message" => "<p>Az oldal nem található</p>"
            );
            $this->load->view("errors/html/error_404.php",$data);
            return;
        }
        
        $ch = curl_init();
        $url = $this->api_url.'/'.$id;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $output = curl_exec($ch);
        curl_close($ch);     
        $eredmeny = json_decode($output, true);
        $sikeres = $eredmeny['success'];

        if(!$sikeres){
            $data = array(
                "heading" => "Adatbázis hiba",
                "message" => "<p>Az adott azonosítóval nem található ember</p>"
            );
            $this->load->view("errors/html/error_db.php",$data);
            return;
        }
        $success = "<p>$id azonosítójú ember sikeresen törölve</p>";
        $array['success'] = $success;
        $this->session->set_flashdata( $array );
        redirect('people/index');
    }   
}
?>