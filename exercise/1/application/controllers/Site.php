<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->database();
  }

	public function index()
	{
    if (isset($_GET['search'])){

      if($_GET['search']){

        $search_string = $_GET['search'];

        $this->db->where('sapid', $search_string);
        $this->db->or_like('hostname', $search_string);
        $this->db->or_like('loopback', $search_string);
        $this->db->or_like('macaddress', $search_string);
      }

      $sites = $this->db->get('sites')->result();
      $data['result'] = $sites;
      echo json_encode($data);
      exit;
    }else{
      $sites = $this->db->get('sites')->result();
      $this->load->view('site/index', ['sites' => $sites]);
    }
	}

  public function create()
  {

    $this->load->view('site/create');
  }

  public function edit($id)
  {
    $site = $this->db->where(['sid' => $id])->get('sites')->row();
    $this->load->view('site/edit', ['site' => $site]);
  }

  public function store()
  {
      $this->site_form_rules();

      if ($this->form_validation->run()) {
        $site = array (
          'sapid' => $this->input->post('sapid'),
          'hostname' => $this->input->post('hostname'),
          'loopback' => $this->input->post('loopback'),
          'macaddress' => $this->input->post('macaddress'),
        );

        $this->db->insert('sites', $site);
      } else {
        $errors = $this->form_validation->error_array();
        $this->session->set_flashdata('errors', $errors);
        redirect(base_url('site/create'));
      }

      redirect('/site');
  }

  public function site_form_rules(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('sapid', 'Sapid', 'required|min_length[10]|max_length[18]');
    $this->form_validation->set_rules('hostname', 'Hostname', 'required|min_length[10]|max_length[14]');
    $this->form_validation->set_rules('loopback', 'Loopback','required|min_length[8]|max_length[18]');
    $this->form_validation->set_rules('macaddress', 'Macaddress','required|min_length[14]|max_length[17]');
  }

  public function update($id)
  {
    $this->site_form_rules();

    if ($this->form_validation->run()) {
      $site = array (
        'sapid' => $this->input->post('sapid'),
        'hostname' => $this->input->post('hostname'),
        'loopback' => $this->input->post('loopback'),
        'macaddress' => $this->input->post('macaddress'),
      );

       $this->db->where(['sid' => $id])->update('sites', $site);
    } else {
      $errors = $this->form_validation->error_array();
      $this->session->set_flashdata('errors', $errors);
      redirect(base_url('site/edit/'. $id));
    }

     redirect('/site');
  }

  public function show($id) {
     $site = $this->db->where(['sid' => $id])->get('sites')->row();
     $this->load->view('site/show',['site' => $site]);
  }

  public function delete($id)
  {
     $this->db->where(['sid' => $id])->delete('sites');

     redirect('/site');
  }

  function validate_member($str)
  {
     $field_value = $str;

     if($this->members_model->validate_member($field_value))
     {
       return TRUE;
     }
     else
     {
       return FALSE;
     }
  }

}
