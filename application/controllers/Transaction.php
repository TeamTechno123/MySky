<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
  }
  public function salebill(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('sale_no', 'sale_no', 'trim|required');
    $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $sale_data = array(
        'company_id' => $sky_company_id,
        'sale_no' => $this->input->post('sale_no'),
        'sale_date' => $this->input->post('sale_date'),
        'customer_id' => $this->input->post('customer_id'),
        'total_amount' => $this->input->post('total_amount'),
        'sale_addedby' => $sky_user_id,
      );
      $sale_id = $this->User_Model->save_data('sale', $sale_data);
      foreach($_POST['input'] as $user){
        $user['sale_id'] = $sale_id;
        $this->db->insert('sale_descr', $user);
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Transaction/salebill_list');
    }
    $data['sale_no'] = $this->Transaction_Model->get_count_no('sale_no', 'sale');
    $data['customer_list'] = $this->User_Model->get_list($sky_company_id,'customer_id','DESC','customer');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/salebill',$data);
    $this->load->view('Include/footer',$data);
  }
  public function salebill_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['salebill_list'] = $this->User_Model->get_list($sky_company_id,'sale_id','DESC','sale');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
   $this->load->view('Transaction/salebill_list',$data);
   $this->load->view('Include/footer',$data);
  }

  public function edit_salebill($sale_id){
      $sky_user_id = $this->session->userdata('sky_user_id');
      $sky_company_id = $this->session->userdata('sky_company_id');
      $sky_roll_id = $this->session->userdata('sky_roll_id');
      if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
      $this->form_validation->set_rules('sale_no', 'sale_no', 'trim|required');
      $this->form_validation->set_rules('customer_id', 'customer_id', 'trim|required');
      if ($this->form_validation->run() != FALSE) {
        $sale_data = array(
          'sale_date' => $this->input->post('sale_date'),
          'customer_id' => $this->input->post('customer_id'),
          'total_amount' => $this->input->post('total_amount'),
          'sale_addedby' => $sky_user_id,
        );
        $this->User_Model->update_info('sale_id', $sale_id, 'sale', $sale_data);

        foreach($_POST['input'] as $user){
          if(isset($user['sale_descr_id'])){
            $sale_descr_id = $user['sale_descr_id'];
            if(!isset($user['sale_description'])){
              $this->User_Model->delete_info('sale_descr_id', $sale_descr_id, 'sale_descr');
            }else{
                $this->User_Model->update_info('sale_descr_id', $sale_descr_id, 'sale_descr', $user);
            }
          }
          else{
            $user['sale_id'] = $sale_id;
            $this->db->insert('sale_descr', $user);
          }
        }

        $this->session->set_flashdata('update_success','success');
        header('location:'.base_url().'Transaction/salebill_list');
      }
      $sale_details = $this->User_Model->get_info_arr('sale_id', $sale_id, 'sale');
      if($sale_details == ''){ header('location:'.base_url().'Transaction/salebill_list'); }
      $data['update'] = 'update';
      $data['sale_no'] = $sale_details[0]['sale_no'];
      $data['sale_date'] = $sale_details[0]['sale_date'];
      $data['customer_id'] = $sale_details[0]['customer_id'];
      $data['total_amount'] = $sale_details[0]['total_amount'];
      $data['sale_descr_list'] = $this->Transaction_Model->sale_descr_list($sale_id);
      $data['customer_list'] = $this->User_Model->get_list($sky_company_id,'customer_id','DESC','customer');
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
      $this->load->view('Transaction/salebill',$data);
      $this->load->view('Include/footer',$data);
  }
}
