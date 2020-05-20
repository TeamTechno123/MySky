<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
  }

  public function customer_report(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['roll_list'] = $this->User_Model->roll_list2();
    $data['type_list'] = $this->User_Model->get_list2('customer_type_id','ASC','customer_type');
    $this->form_validation->set_rules('roll_id','User Roll','trim|required');
    if($this->form_validation->run() != FALSE){
      $roll_id = $this->input->post('roll_id');
      $user_id = $this->input->post('user_id');
      $customer_type_id = $this->input->post('customer_type_id');
      $data['customer_type_id2'] = $customer_type_id;
      $data['user_id2'] = $user_id;
      $data['roll_id2'] = $roll_id;
      $data['customer_list'] = $this->Transaction_Model->customer_report_list($user_id,$customer_type_id);
    }

    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/customer_report',$data);
    $this->load->view('Include/footer',$data);
  }

  public function customer_details_print($customer_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    // Company Info..
    $company_info = $this->User_Model->get_info('company_id', $sky_company_id, 'company');
    if($company_info == ''){ header('location:'.base_url().'User'); }
    foreach($company_info as $info){
      $data['company_name'] = $info->company_name;
      $data['company_address'] = $info->company_address;
      $data['company_mob1'] = $info->company_mob1;
      $data['company_email'] = $info->company_email;
    }
    // Customer Details...
    $cust_details = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
    $user_details = $this->User_Model->get_info_arr('user_id', $sky_user_id, 'user');
    if($cust_details == ''){ header('location:'.base_url().'User/customer_information_list'); }
    $data['user_id'] = $cust_details[0]['user_id'];
    $data['cust_pre_id'] = $cust_details[0]['cust_pre_id'];
    $data['customer_type_id'] = $cust_details[0]['customer_type_id'];
    $data['customer_name'] = $cust_details[0]['customer_name'];
    $data['customer_address'] = $cust_details[0]['customer_address'];
    $data['customer_mob1'] = $cust_details[0]['customer_mob1'];
    $data['customer_mob2'] = $cust_details[0]['customer_mob2'];
    $data['customer_city'] = $cust_details[0]['customer_city'];
    $data['customer_state'] = $cust_details[0]['customer_state'];
    $data['customer_adhar_no'] = $cust_details[0]['customer_adhar_no'];
    $data['customer_pan_no'] = $cust_details[0]['customer_pan_no'];
    $data['customer_bank'] = $cust_details[0]['customer_bank'];
    $data['customer_b_branch'] = $cust_details[0]['customer_b_branch'];
    $data['customer_acc_no'] = $cust_details[0]['customer_acc_no'];
    $data['customer_b_ifsc'] = $cust_details[0]['customer_b_ifsc'];
    $data['customer_password'] = $cust_details[0]['customer_password'];
    $data['customer_status'] = $cust_details[0]['customer_status'];
    $data['customer_date'] = $cust_details[0]['customer_date'];
    $data['customer_img'] = $cust_details[0]['customer_img'];
    $this->load->view('Report/customer_details_print',$data);
  }

  public function invoice_report($sale_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    // Company Info..
    $company_info = $this->User_Model->get_info('company_id', $sky_company_id, 'company');
    if($company_info == ''){ header('location:'.base_url().'User'); }
    foreach($company_info as $info){
      $data['company_name'] = $info->company_name;
      $data['company_address'] = $info->company_address;
      $data['company_mob1'] = $info->company_mob1;
      $data['company_email'] = $info->company_email;
    }

    $sale_details = $this->User_Model->get_info_arr('sale_id', $sale_id, 'sale');
    if($sale_details == ''){ header('location:'.base_url().'Transaction/salebill_list'); }
    $data['sale_no'] = $sale_details[0]['sale_no'];
    $data['sale_id'] = $sale_details[0]['sale_id'];
    $data['sale_date'] = $sale_details[0]['sale_date'];
    $data['customer_id'] = $sale_details[0]['customer_id'];
    $data['total_amount'] = $sale_details[0]['total_amount'];
    $cust_details = $this->User_Model->get_info_arr('customer_id', $data['customer_id'], 'customer');
    $data['customer_name'] = $cust_details[0]['customer_name'];
    $data['customer_address'] = $cust_details[0]['customer_address'];
    $data['customer_mob1'] = $cust_details[0]['customer_mob1'];
    // $data['customer_name'] = $cust_details[0]['customer_name'];
    if($sale_details == ''){ header('location:'.base_url().'Transaction/salebill_list'); }
    $data['sale_descr_list'] = $this->Transaction_Model->sale_descr_list($sale_id);

    $this->load->view('Report/invoice_print',$data);
  }

  // Target Report...
  public function target_report(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    // $data['roll_list'] = $this->User_Model->roll_list2();
    $data['type_list'] = $this->User_Model->get_list2('customer_type_id','ASC','customer_type');
    // $data['target_report'] = 'target_report';
    $this->form_validation->set_rules('from_date','User Roll','trim|required');
    if($this->form_validation->run() != FALSE){
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $customer_type_id = $this->input->post('customer_type_id');
      $data['customer_type_id2'] = $customer_type_id;
      $data['from_date2'] = $from_date;
      $data['to_date2'] = $to_date;
      $data['customer_list'] = $this->Transaction_Model->customer_target_report_list($from_date,$to_date,$customer_type_id);
      // print_r($data['customer_list']);
    }

    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/target_report',$data);
    $this->load->view('Include/footer',$data);
  }

  public function get_user_by_roll(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');

    $roll_id = $this->input->post('roll_id');
    $user_list = $this->Transaction_Model->get_user_by_roll($sky_company_id,$roll_id);
    echo "<option value='' selected >Select Name</option>";
    foreach ($user_list as $list) {
      echo "<option class='' value='".$list->user_id."'> ".$list->user_name." </option>";
    }
  }
}
