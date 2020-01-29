<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
  }

  public function logout(){
    $this->session->unset_userdata('sky_user_id');
    $this->session->unset_userdata('sky_company_id');
    $this->session->unset_userdata('sky_roll_id');
    // $this->session->sess_destroy();
    header('location:'.base_url().'User');
  }

  public function index(){
    $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('User/login');
    } else{
      $mobile = $this->input->post('mobile');
      $password = $this->input->post('password');

      $login = $this->User_Model->check_login($mobile, $password);
      // print_r($login);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'User');
      } else{
        // echo 'null not';
        $this->session->set_userdata('sky_user_id', $login[0]['user_id']);
        $this->session->set_userdata('sky_company_id', $login[0]['company_id']);
        $this->session->set_userdata('sky_roll_id', $login[0]['roll_id']);
        header('location:'.base_url().'User/dashboard');
      }
    }
  }
/************************************ Dashboard *********************************/
  public function dashboard(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['user_cnt'] = $this->User_Model->get_user_count($sky_company_id);
    if($sky_roll_id == 1 || $sky_roll_id == 2){
      $data['cust_cnt'] = $this->User_Model->get_count('customer_id',$sky_company_id,'customer_status','active','customer');
    } else{
      $data['cust_cnt'] = $this->User_Model->get_count2('customer_id',$sky_company_id,'customer_status','active','user_id',$sky_user_id,'customer');
    }


    $data['sale_cnt'] = $this->User_Model->get_count('sale_id',$sky_company_id,'','','sale');
    $data['news_cnt'] = $this->User_Model->get_count('news_id',$sky_company_id,'','','news');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/dashboard',$data);
    $this->load->view('Include/footer',$data);
  }
/************************************ Company Informatiom *********************************/
// Company List...
  public function company_information_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    $data['company_list'] = $this->User_Model->get_list($sky_company_id,'company_id','ASC','company');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/company_information_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit Company...
  public function edit_company($company_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $up_data = array(
        'company_name' => $this->input->post('company_name'),
        'company_address' => $this->input->post('company_address'),
        'company_city' => $this->input->post('company_city'),
        'company_state' => $this->input->post('company_state'),
        'company_district' => $this->input->post('company_district'),
        'company_statecode' => $this->input->post('company_statecode'),
        'company_mob1' => $this->input->post('company_mob1'),
        'company_mob2' => $this->input->post('company_mob2'),
        'company_email' => $this->input->post('company_email'),
        'company_website' => $this->input->post('company_website'),
        'company_pan_no' => $this->input->post('company_pan_no'),
        'company_gst_no' => $this->input->post('company_gst_no'),
        'company_lic1' => $this->input->post('company_lic1'),
        'company_lic2' => $this->input->post('company_lic2'),
        'company_start_date' => $this->input->post('company_start_date'),
        'company_end_date' => $this->input->post('company_end_date'),
      );
      $this->User_Model->update_info('company_id', $company_id, 'company', $up_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/company_information_list');
    }
    $company_info = $this->User_Model->get_info('company_id', $company_id, 'company');
    if($company_info){
      foreach($company_info as $info){
        $data['update'] = 'update';
        $data['company_id'] = $info->company_id;
        $data['company_name'] = $info->company_name;
        $data['company_address'] = $info->company_address;
        $data['company_city'] = $info->company_city;
        $data['company_state'] = $info->company_state;
        $data['company_district'] = $info->company_district;
        $data['company_statecode'] = $info->company_statecode;
        $data['company_mob1'] = $info->company_mob1;
        $data['company_mob2'] = $info->company_mob2;
        $data['company_email'] = $info->company_email;
        $data['company_website'] = $info->company_website;
        $data['company_pan_no'] = $info->company_pan_no;
        $data['company_gst_no'] = $info->company_gst_no;
        $data['company_lic1'] = $info->company_lic1;
        $data['company_lic2'] = $info->company_lic2;
        $data['company_start_date'] = $info->company_start_date;
        $data['company_end_date'] = $info->company_end_date;
      }
      $this->load->view('Include/head', $data);
      $this->load->view('Include/navbar', $data);
      $this->load->view('User/company_information', $data);
      $this->load->view('Include/footer', $data);
    }
  }
/************************************ User Information ******************************/
  // Add User...
  public function user_information(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = 'active'; }
      $roll_id = $this->input->post('roll_id');
      if($roll_id == 4){ $srm_id = $this->input->post('srm_id'); }
      elseif ($roll_id == 6) { $srm_id = $this->input->post('rm_id'); }
      else{ $srm_id = null; }

      $save_data = array(
        'company_id' => $sky_company_id,
        'roll_id' => $this->input->post('roll_id'),
        'srm_id' => $srm_id,
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_email' => $this->input->post('user_email'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_status' => $user_status,
        'user_addedby' => $sky_user_id,
      );
      $user_id = $this->User_Model->save_data('user', $save_data);
      // $roll_id = $this->input->post('roll_id');
      // $srm_id = $this->input->post('srm_id');
      // if($roll_id == 4 && $srm_id != ''){
      //   $user_rel_data = array(
      //     'rm_id' => $user_id,
      //     'srm_id' => $srm_id,
      //   );
      //   $this->User_Model->save_data('user_rel', $user_rel_data);
      // }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/user_information_list');
    }
    $data['roll_list'] = $this->User_Model->roll_list();
    $data['srm_list'] = $this->User_Model->get_srm_list($sky_company_id);
    $data['rm_list'] = $this->User_Model->get_rm_list($sky_company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_information',$data);
    $this->load->view('Include/footer',$data);
  }
  // User List...
  public function user_information_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['user_list'] = $this->User_Model->user_list($sky_company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_information_list',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit/Update User...
  public function edit_user($user_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $user_status = $this->input->post('user_status');
      if(!isset($user_status)){ $user_status = 'active'; }
      $roll_id = $this->input->post('roll_id');
      if($roll_id == 4){ $srm_id = $this->input->post('srm_id'); }
      elseif ($roll_id == 6) { $srm_id = $this->input->post('rm_id'); }
      else{ $srm_id = null; }
      $update_data = array(
        'roll_id' => $this->input->post('roll_id'),
        'srm_id' => $srm_id,
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_email' => $this->input->post('user_email'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_status' => $user_status,
        'user_addedby' => $sky_user_id,
      );
      $this->User_Model->update_info('user_id', $user_id, 'user', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/user_information_list');
    }

    $user_info = $this->User_Model->get_info('user_id', $user_id, 'user');
    if($user_info == ''){ header('location:'.base_url().'User/user_information_list'); }
    foreach($user_info as $info){
      $data['update'] = 'update';
      $data['roll_id'] = $info->roll_id;
      $data['srm_id'] = $info->srm_id;
      $data['user_name'] = $info->user_name;
      $data['user_mobile'] = $info->user_mobile;
      $data['user_email'] = $info->user_email;
      $data['user_city'] = $info->user_city;
      $data['user_password'] = $info->user_password;
      $data['user_status'] = $info->user_status;
    }
    $data['srm_list'] = $this->User_Model->get_srm_list($sky_company_id);
    $data['roll_list'] = $this->User_Model->roll_list();
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_information',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete User...
  public function delete_user($user_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    // $user_info = $user_info = $this->User_Model->get_info_arr('user_id', $user_id, 'user');
    // $roll_id = $user_info[0]['roll_id'];
    // if($roll_id == 4){
    //   $this->User_Model->delete_info('user_id', $user_id, 'user');
    // }
    $this->User_Model->delete_info('rm_id', $user_id, 'user_rel');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/user_information_list');
  }

/********************************** Customer ***************************************/
  // Add Customer...
  public function customer_information(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('customer_name','customer_name','trim|required');
    if($this->form_validation->run() != FALSE){
      $customer_status = $this->input->post('customer_status');
      if(!isset($customer_status)){ $customer_status = 'active'; }
      // Save In Customer...
      $cust_data = array(
        'company_id' => $sky_company_id,
        'user_id' => $this->input->post('user_id'),
        'customer_type_id' => $this->input->post('customer_type_id'),
        'customer_name' => $this->input->post('customer_name'),
        'customer_address' => $this->input->post('customer_address'),
        'customer_mob1' => $this->input->post('customer_mob1'),
        'customer_mob2' => $this->input->post('customer_mob2'),
        'customer_city' => $this->input->post('customer_city'),
        'customer_state' => $this->input->post('customer_state'),
        'customer_adhar_no' => $this->input->post('customer_adhar_no'),
        'customer_pan_no' => $this->input->post('customer_pan_no'),
        'customer_bank' => $this->input->post('customer_bank'),
        'customer_b_branch' => $this->input->post('customer_b_branch'),
        'customer_acc_no' => $this->input->post('customer_acc_no'),
        'customer_b_ifsc' => $this->input->post('customer_b_ifsc'),
        'customer_password' => $this->input->post('customer_password'),
        'customer_status' => $customer_status,
        'customer_addedby' => $sky_user_id,
      );
      $customer_id = $this->User_Model->save_data('customer', $cust_data);
      // Save In User...
      $user_data = array(
        'company_id' => $sky_company_id,
        'roll_id' => 5,
        'user_name' => $this->input->post('customer_name'),
        'user_city' => $this->input->post('customer_city'),
        'user_mobile' => $this->input->post('customer_mob1'),
        'user_password' => $this->input->post('customer_password'),
        'user_status' => $customer_status,
        'user_addedby' => $sky_user_id,
      );
      $this->User_Model->save_data('user', $user_data);
      $customer_type_id = $this->input->post('customer_type_id');
      $customer_type_info = $this->User_Model->get_info_arr('customer_type_id', $customer_type_id, 'customer_type');
      $customer_type2 = $customer_type_info[0]['type_name'];
      $customer_type_arr = (explode(" ",$customer_type2));
      $customer_type = $customer_type_arr[0];
      $cust_pre_id = $customer_type.'_'.$customer_id;
      $up_data['cust_pre_id'] = $cust_pre_id;
      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $up_data);

      if(isset($_FILES['customer_img']['name'])){
        $time = time();
        $image_name = 'customer_'.$customer_id.'_'.$time;
        $_FILES['customer_img']['name'];
        $_FILES['customer_img']['type'];
        $_FILES['customer_img']['tmp_name'];
        $_FILES['customer_img']['error'];
        $_FILES['customer_img']['size'];
        $config['upload_path'] = 'assets/images/customer/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $image_name;
        $config['overwrite']     = FALSE;
        $filename = $files['customer_img']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        if($this->upload->do_upload('customer_img')){
          $file_data['customer_img'] = $image_name.'.'.$ext;
          $this->User_Model->update_info('customer_id', $customer_id, 'customer', $file_data);
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('status',$this->upload->display_errors());
        }
      }

      $ref_user_info = $this->User_Model->get_info_arr('user_id', $user_id, 'user');
      $mobile_num = $ref_user_info[0]['user_mobile'];
      $customer_name = $this->input->post('customer_name');
      $customer_mob1 = $this->input->post('customer_mob1');

      $date = date('d-m-Y h:ia');
      $SMS = 'My-Sky Register- Customer:'.$customer_name.' Mobile:'.$customer_mob1.' Id:'.$cust_pre_id.' Created At: '.$date.'';
			$param['uname'] = 'wbcare';
			$param['password'] = '123123';
			$param['sender'] = 'AKCENT';
			$param['receiver'] = $mobile_num.','.$customer_mob1;
			$param['route'] = 'TA';
			$param['msgtype'] = 1;
			$param['sms'] = $SMS;
			$parameters = http_build_query($param);
			$url="http://msgblast.in/index.php/smsapi/httpapi";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
			curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
			$result = curl_exec($ch);

      //
      // $SMS2 = 'My-Sky Register- Customer:'.$customer_name.' Mobile:'.$customer_mob1.' Id:'.$cust_pre_id.' Created At: '.$date.'';
			// $param['uname'] = 'wbcare';
			// $param['password'] = '123123';
			// $param['sender'] = 'AKCENT';
			// $param['receiver'] = $customer_mob1;
			// $param['route'] = 'TA';
			// $param['msgtype'] = 1;
			// $param['sms'] = $SMS2;
			// $parameters = http_build_query($param);
			// $url="http://msgblast.in/index.php/smsapi/httpapi";
			// $ch = curl_init();
			// curl_setopt($ch, CURLOPT_URL, $url);
			// curl_setopt($ch,CURLOPT_HEADER, false);
			// curl_setopt($ch, CURLOPT_POST, 1);
			// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
			// curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
			// $result = curl_exec($ch);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/customer_information_list');
    }
    $data['user_list'] = $this->User_Model->user_list2($sky_company_id);
    $data['type_list'] = $this->User_Model->get_list2('customer_type_id','ASC','customer_type');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/customer_information',$data);
    $this->load->view('Include/footer',$data);
  }
  // Customer List...
  public function customer_information_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    if($sky_roll_id == 1 || $sky_roll_id == 2){
      $data['customer_list'] = $this->User_Model->get_list($sky_company_id,'customer_id','DESC','customer');
    } else {
      // echo $sky_user_id;
      $data['customer_list'] = $this->User_Model->cust_list_by_ref($sky_user_id);
      // print_r($data['customer_list']);
    }
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/customer_information_list',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit Customer...
  public function edit_customer($customer_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('customer_name','customer_name','trim|required');
    if($this->form_validation->run() != FALSE){
      $cust = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
      $mobile = $cust[0]['customer_mob1'];

      $customer_status = $this->input->post('customer_status');
      if(!isset($customer_status)){ $customer_status = 'active'; }
      // Update In Customer...
      $cust_data = array(
        'user_id' => $this->input->post('user_id'),
        'customer_type_id' => $this->input->post('customer_type_id'),
        'customer_name' => $this->input->post('customer_name'),
        'customer_address' => $this->input->post('customer_address'),
        'customer_mob1' => $this->input->post('customer_mob1'),
        'customer_mob2' => $this->input->post('customer_mob2'),
        'customer_city' => $this->input->post('customer_city'),
        'customer_state' => $this->input->post('customer_state'),
        'customer_adhar_no' => $this->input->post('customer_adhar_no'),
        'customer_pan_no' => $this->input->post('customer_pan_no'),
        'customer_bank' => $this->input->post('customer_bank'),
        'customer_b_branch' => $this->input->post('customer_b_branch'),
        'customer_acc_no' => $this->input->post('customer_acc_no'),
        'customer_b_ifsc' => $this->input->post('customer_b_ifsc'),
        'customer_password' => $this->input->post('customer_password'),
        'customer_status' => $customer_status,
        'customer_addedby' => $sky_user_id,
      );
      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $cust_data);
      $customer_type_id = $this->input->post('customer_type_id');
      $customer_type_info = $this->User_Model->get_info_arr('customer_type_id', $customer_type_id, 'customer_type');
      $customer_type = $customer_type_info[0]['type_name'];
      $customer_type_arr = (explode(" ",$customer_type));
      $customer_type = $customer_type_arr[0];
      $cust_pre_id = $customer_type.'_'.$customer_id;
      $up_data['cust_pre_id'] = $cust_pre_id;
      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $up_data);
      // Update In User...
      $user_data = array(
        'user_name' => $this->input->post('customer_name'),
        'user_city' => $this->input->post('customer_city'),
        'user_mobile' => $this->input->post('customer_mob1'),
        'user_password' => $this->input->post('customer_password'),
        'user_status' => $customer_status,
        'user_addedby' => $sky_user_id,
      );
      $this->User_Model->update_info('user_mobile', $mobile, 'user', $user_data);
      $customer_img = $this->input->post('old_cust_img');
      if(isset($_FILES['customer_img']['name'])){
        $time = time();
        $image_name = 'customer_'.$customer_id.'_'.$time;
        $_FILES['customer_img']['name'];
        $_FILES['customer_img']['type'];
        $_FILES['customer_img']['tmp_name'];
        $_FILES['customer_img']['error'];
        $_FILES['customer_img']['size'];
        $config['upload_path'] = 'assets/images/customer/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $image_name;
        $config['overwrite']     = FALSE;
        $filename = $_FILES['customer_img']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        if($this->upload->do_upload('customer_img')){
          $file_data['customer_img'] = $image_name.'.'.$ext;
          $this->User_Model->update_info('customer_id', $customer_id, 'customer', $file_data);
          unlink("assets/images/customer/".$customer_img);
        }
        else{
          echo $error = $this->upload->display_errors();
          $this->session->set_flashdata('status',$this->upload->display_errors());
        }
      }
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/customer_information_list');
    }

    $cust_details = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
    if($cust_details == ''){ header('location:'.base_url().'User/customer_information_list'); }
    $data['update'] = 'update';
    $data['user_id'] = $cust_details[0]['user_id'];
    $data['customer_id'] = $cust_details[0]['customer_id'];
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
    $data['customer_img'] = $cust_details[0]['customer_img'];

    $data['user_list'] = $this->User_Model->user_list2($sky_company_id);
    $data['type_list'] = $this->User_Model->get_list2('customer_type_id','ASC','customer_type');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/customer_information',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_customer($customer_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $cust = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
    $mobile = $cust[0]['customer_mob1'];
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer');
    $this->User_Model->delete_info('user_mobile', $mobile, 'user');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/customer_information_list');
  }

  // Customer List...
  public function customer_list2($customer_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }

    $data['customer_list'] = $this->User_Model->cust_list_by_ref($customer_id);
    if(!$data['customer_list']){ header('location:'.base_url().'User/customer_information_list'); }
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/customer_information_list',$data);
    $this->load->view('Include/footer',$data);
  }

/****************************** News Information ******************************/
  // Add News...
  public function news_information(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('news_name','news_name','trim|required');
    if($this->form_validation->run() != FALSE){
      $news_data = array(
        'company_id' => $sky_company_id,
        'news_name' => $this->input->post('news_name'),
        'news_addedby' => $sky_user_id,
      );
      $this->User_Model->save_data('news', $news_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/news_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/news_information');
    $this->load->view('Include/footer');
  }
  // News List...
  public function news_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['news_list'] = $this->User_Model->get_list($sky_company_id,'news_id','DESC','news');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/news_list',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit/Update News...
  public function edit_news($news_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('news_name','news_name','trim|required');
    if($this->form_validation->run() != FALSE){
      $news_data = array(
        'news_name' => $this->input->post('news_name'),
        'news_addedby' => $sky_user_id,
      );
      $this->User_Model->update_info('news_id', $news_id, 'news', $news_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/news_list');
    }
    $news_details = $this->User_Model->get_info_arr('news_id', $news_id, 'news');
    if($news_details == ''){ header('location:'.base_url().'User/news_list'); }
    $data['update'] = 'update';
    $data['news_name'] = $news_details[0]['news_name'];
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/news_information',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete News...
  public function delete_news($news_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('news_id', $news_id, 'news');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/news_list');
  }

/*********************************** Vehicle Information **************************/
  // Add News...
  public function vehicle_registration(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('sponser_id','sponser_id','trim|required');
    if($this->form_validation->run() != FALSE){
      $vehicle_reg_data = array(
        'company_id' => $sky_company_id,
        'sponser_id' => $this->input->post('sponser_id'),
        'full_name' => $this->input->post('full_name'),
        'mobile_no' => $this->input->post('mobile_no'),
        'email' => $this->input->post('email'),
        'address' => $this->input->post('address'),
        'city' => $this->input->post('city'),
        'state' => $this->input->post('state'),
        'country' => $this->input->post('country'),
        'amount' => $this->input->post('amount'),
        'payment_type' => $this->input->post('payment_type'),
        'transaction_no' => $this->input->post('transaction_no'),
        'vehicle_name' => $this->input->post('vehicle_name'),
        'vehicle_reg_addedby' => $sky_user_id,
      );
      $vehicle_reg_id = $this->User_Model->save_data('vehicle_reg', $vehicle_reg_data);

      if(isset($_FILES['vehicle_image']['name'])){
        $time = time();
        $image_name = 'vehicle_'.$vehicle_reg_id.'_'.$time;
        $_FILES['vehicle_image']['name'];
        $_FILES['vehicle_image']['type'];
        $_FILES['vehicle_image']['tmp_name'];
        $_FILES['vehicle_image']['error'];
        $_FILES['vehicle_image']['size'];
        $config['upload_path'] = 'assets/images/vehicle/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $image_name;
        $config['overwrite']     = FALSE;
        $filename = $files['vehicle_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        if($this->upload->do_upload('vehicle_image')){
          $file_data['vehicle_image'] = $image_name.'.'.$ext;
          $this->User_Model->update_info('vehicle_reg_id', $vehicle_reg_id, 'vehicle_reg', $file_data);
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('status',$this->upload->display_errors());
        }
      }


      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/vehicle_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/vehicle_registration');
    $this->load->view('Include/footer');
  }
  // News List...
  public function vehicle_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $data['vehicle_list'] = $this->User_Model->get_list($sky_company_id,'vehicle_reg_id','DESC','vehicle_reg');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/vehicle_list',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit/Update News...
  public function edit_vehicle($vehicle_reg_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('sponser_id','sponser_id','trim|required');
    if($this->form_validation->run() != FALSE){
      $vehicle_reg_data = array(
        'sponser_id' => $this->input->post('sponser_id'),
        'full_name' => $this->input->post('full_name'),
        'mobile_no' => $this->input->post('mobile_no'),
        'email' => $this->input->post('email'),
        'address' => $this->input->post('address'),
        'city' => $this->input->post('city'),
        'state' => $this->input->post('state'),
        'country' => $this->input->post('country'),
        'amount' => $this->input->post('amount'),
        'payment_type' => $this->input->post('payment_type'),
        'transaction_no' => $this->input->post('transaction_no'),
        'vehicle_name' => $this->input->post('vehicle_name'),
        'vehicle_reg_addedby' => $sky_user_id,
      );
      $this->User_Model->update_info('vehicle_reg_id', $vehicle_reg_id, 'vehicle_reg', $vehicle_reg_data);

      if(isset($_FILES['vehicle_image']['name'])){
        $time = time();
        $image_name = 'vehicle_'.$vehicle_reg_id.'_'.$time;
        $_FILES['vehicle_image']['name'];
        $_FILES['vehicle_image']['type'];
        $_FILES['vehicle_image']['tmp_name'];
        $_FILES['vehicle_image']['error'];
        $_FILES['vehicle_image']['size'];
        $config['upload_path'] = 'assets/images/vehicle/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $image_name;
        $config['overwrite']     = FALSE;
        $filename = $files['vehicle_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config);
        if($this->upload->do_upload('vehicle_image')){
          $file_data['vehicle_image'] = $image_name.'.'.$ext;
          $this->User_Model->update_info('vehicle_reg_id', $vehicle_reg_id, 'vehicle_reg', $file_data);
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('status',$this->upload->display_errors());
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/vehicle_list');
    }

    $vehicle_details = $this->User_Model->get_info_arr('vehicle_reg_id', $vehicle_reg_id, 'vehicle_reg');
    if($vehicle_details == ''){ header('location:'.base_url().'User/vehicle_list'); }
    $data['update'] = 'update';
    $data['sponser_id'] = $vehicle_details[0]['sponser_id'];
    $data['full_name'] = $vehicle_details[0]['full_name'];
    $data['mobile_no'] = $vehicle_details[0]['mobile_no'];
    $data['email'] = $vehicle_details[0]['email'];
    $data['address'] = $vehicle_details[0]['address'];
    $data['city'] = $vehicle_details[0]['city'];
    $data['state'] = $vehicle_details[0]['state'];
    $data['country'] = $vehicle_details[0]['country'];
    $data['amount'] = $vehicle_details[0]['amount'];
    $data['payment_type'] = $vehicle_details[0]['payment_type'];
    $data['transaction_no'] = $vehicle_details[0]['transaction_no'];
    $data['vehicle_name'] = $vehicle_details[0]['vehicle_name'];
    $data['vehicle_image'] = $vehicle_details[0]['vehicle_image'];
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/vehicle_registration',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete News...
  public function delete_vehicle($vehicle_reg_id){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('vehicle_reg_id', $vehicle_reg_id, 'vehicle_reg');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/vehicle_list');
  }

/****************************** Change Password *********************************/
  public function change_password(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');
    if($sky_user_id == '' && $sky_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_password','Password','trim|required');
    if($this->form_validation->run() != FALSE){
      $up_data = array(
        'user_password' => $this->input->post('user_password'),
      );
      $this->User_Model->update_info('user_id', $sky_user_id, 'user', $up_data);

      $user_info = $this->User_Model->get_info_arr('user_id', $sky_user_id, 'user');
      $user_mob = $user_info[0]['user_mobile'];
      $up_data2 = array(
        'customer_password' => $this->input->post('user_password'),
      );
      $this->User_Model->update_info('customer_mob1', $user_mob, 'customer', $up_data2);
    }
    $user_info = $this->User_Model->get_info_arr('user_id', $sky_user_id, 'user');
    if(!$user_info){ header('location:'.base_url().'User'); }
    $data['user_password'] = $user_info[0]['user_password'];
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/change_password',$data);
    $this->load->view('Include/footer',$data);
  }

/*********************************************************************************************************/

  // Check Duplication
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->User_Model->check_dupli_num($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }

  public function get_srm_list(){
    $sky_user_id = $this->session->userdata('sky_user_id');
    $sky_company_id = $this->session->userdata('sky_company_id');
    $sky_roll_id = $this->session->userdata('sky_roll_id');

    $roll_id = $this->input->post('roll_id');
    $user_list = $this->User_Model->get_srm_list($sky_company_id);
    echo "<option value='' selected >Select SRM</option>";
    foreach ($user_list as $list) {
      echo "<option class='' value='".$list->user_id."'> ".$list->user_name." </option>";
    }
  }





}
?>
