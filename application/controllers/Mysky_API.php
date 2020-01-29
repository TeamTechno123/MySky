<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mysky_API extends CI_Controller{
  public function __construct(){
    header('Access-Control-Allow-Origin: *');
	  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
  }

  public function login(){
    $phoneno = $_REQUEST['mobile_no'];
    $password = $_REQUEST['password'];

		$login = $this->User_Model->check_login($phoneno, $password);
    // $response["msg"] = $user;
    if($login == null){
			$response["status"] = FALSE;
			$response["msg"] = "Login not SuccessFul \n\n Check Your Phone Number or Password";
		}else{
      $roll_id = $login[0]['roll_id'];
      $user_id = $login[0]['user_id'];
      $roll_list = $this->User_Model->get_info_arr('roll_id', $roll_id, 'roll');
      $cust_list = $this->User_Model->cust_list_by_ref($user_id);

			$response["status"] = TRUE;
			$response["msg"] = "Login SuccessFul";
      $response["sky_user_id"] = $login[0]['user_id'];
      $response["sky_company_id"] = $login[0]['company_id'];
      $response["sky_roll_id"] = $login[0]['roll_id'];
      $response["roll_name"] = $roll_list[0]['roll_name'];
      $response["customer_list"] = $cust_list;
		}

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function customer_list(){
    $user_id = $_REQUEST['sky_user_id'];
    $cust_list = $this->User_Model->cust_list_by_ref($user_id);
    $response["status"] = TRUE;
    $response["customer_list"] = $cust_list;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }


  public function add_customer(){
    $cust_data = array(
      'company_id' => $_REQUEST['sky_company_id'],
      'user_id' =>$_REQUEST['ref_user_id'],
      'customer_type_id' =>$_REQUEST['customer_type_id'],
      'customer_name' =>$_REQUEST['customer_name'],
      'customer_address' =>$_REQUEST['customer_address'],
      'customer_mob1' =>$_REQUEST['customer_mob1'],
      'customer_mob2' =>$_REQUEST['customer_mob2'],
      'customer_city' =>$_REQUEST['customer_city'],
      'customer_state' =>$_REQUEST['customer_state'],
      'customer_adhar_no' =>$_REQUEST['customer_adhar_no'],
      'customer_pan_no' =>$_REQUEST['customer_pan_no'],
      'customer_bank' =>$_REQUEST['customer_bank'],
      'customer_b_branch' =>$_REQUEST['customer_b_branch'],
      'customer_acc_no' =>$_REQUEST['customer_acc_no'],
      'customer_b_ifsc' =>$_REQUEST['customer_b_ifsc'],
      'customer_password' =>$_REQUEST['customer_password'],
      'customer_status' =>$_REQUEST['customer_status'],
      'customer_addedby' =>$_REQUEST['sky_user_id'],
    );

    // Save In User...
    $user_data = array(
      'company_id' => $_REQUEST['sky_company_id'],
      'roll_id' => 5,
      'user_name' => $_REQUEST['customer_name'],
      'user_city' => $_REQUEST['customer_city'],
      'user_mobile' => $_REQUEST['customer_mob1'],
      'user_password' => $_REQUEST['customer_password'],
      'user_status' => $_REQUEST['customer_status'],
      'user_addedby' => $_REQUEST['sky_user_id'],
    );
    $company_id = $_REQUEST['sky_company_id'];
    
    $check_dup = $this->User_Model->check_duplication($_REQUEST['sky_company_id'],$_REQUEST['customer_mob1'],'customer_mob1','customer');
    if($check_dup){
      $response["status"] = FALSE;
      $response["msg"] = "Mobile Number Exist";
    } else{
      $customer_id = $this->User_Model->save_data('customer', $cust_data);
      $user_id = $this->User_Model->save_data('user', $user_data);
      // Save Customer Id..
      $customer_type_id = $_REQUEST['customer_type_id'];
      $customer_type_info = $this->User_Model->get_info_arr('customer_type_id', $customer_type_id, 'customer_type');
      $customer_type2 = $customer_type_info[0]['type_name'];
      $customer_type_arr = (explode(" ",$customer_type2));
      $customer_type = $customer_type_arr[0];
      $cust_pre_id = $customer_type.'_'.$customer_id;
      $up_data['cust_pre_id'] = $cust_pre_id;
      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $up_data);

        $ref_user_info = $this->User_Model->get_info_arr('user_id', $user_id, 'user');
        $mobile_num = $ref_user_info[0]['user_mobile'];
        $customer_name = $this->input->post('customer_name');
        $customer_mob1 = $this->input->post('customer_mob1');

        $date = date('d-m-Y h:ia');
        // $mob =
        // $SMS = 'My-Sky Register- Customer:'.$customer_name.' Mobile:'.$customer_mob1.' Id:'.$cust_pre_id.' Created At: '.$date.'';
  			// $param['uname'] = 'wbcare';
  			// $param['password'] = '123123';
  			// $param['sender'] = 'AKCENT';
  			// $param['receiver'] = $mobile_num.','.$customer_mob1;
  			// $param['route'] = 'TA';
  			// $param['msgtype'] = 1;
  			// $param['sms'] = $SMS;
  			// $parameters = http_build_query($param);
  			// $url="http://msgblast.in/index.php/smsapi/httpapi";
  			// $ch = curl_init();
  			// curl_setopt($ch, CURLOPT_URL, $url);
  			// curl_setopt($ch,CURLOPT_HEADER, false);
  			// curl_setopt($ch, CURLOPT_POST, 1);
  			// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
  			// curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
  			// $result = curl_exec($ch);

        $response["status"] = TRUE;
        $response["msg"] = "Customer Register Successfully";
    }

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

// Update Customer...
  public function update_customer(){
    $customer_id = $_REQUEST['customer_id'];

    $cust = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
    $mobile = $cust[0]['customer_mob1'];

    $cust_data = array(
      'user_id' =>$_REQUEST['ref_user_id'],
      'customer_type_id' =>$_REQUEST['customer_type_id'],
      'customer_name' =>$_REQUEST['customer_name'],
      'customer_address' =>$_REQUEST['customer_address'],
      'customer_mob1' =>$_REQUEST['customer_mob1'],
      'customer_mob2' =>$_REQUEST['customer_mob2'],
      'customer_city' =>$_REQUEST['customer_city'],
      'customer_state' =>$_REQUEST['customer_state'],
      'customer_adhar_no' =>$_REQUEST['customer_adhar_no'],
      'customer_pan_no' =>$_REQUEST['customer_pan_no'],
      'customer_bank' =>$_REQUEST['customer_bank'],
      'customer_b_branch' =>$_REQUEST['customer_b_branch'],
      'customer_acc_no' =>$_REQUEST['customer_acc_no'],
      'customer_b_ifsc' =>$_REQUEST['customer_b_ifsc'],
      'customer_password' =>$_REQUEST['customer_password'],
      'customer_status' =>$_REQUEST['customer_status'],
      'customer_addedby' =>$_REQUEST['sky_user_id'],
    );
    $this->User_Model->update_info('customer_id', $customer_id, 'customer', $cust_data);

    $customer_type_id = $_REQUEST['customer_type_id'];
    $customer_type_info = $this->User_Model->get_info_arr('customer_type_id', $customer_type_id, 'customer_type');
    $customer_type = $customer_type_info[0]['type_name'];
    $customer_type_arr = (explode(" ",$customer_type));
    $customer_type = $customer_type_arr[0];
    $cust_pre_id = $customer_type.'_'.$customer_id;
    $up_data['cust_pre_id'] = $cust_pre_id;
    $this->User_Model->update_info('customer_id', $customer_id, 'customer', $up_data);

    $user_data = array(
      'user_name' => $_REQUEST['customer_name'],
      'user_city' => $_REQUEST['customer_city'],
      'user_mobile' => $_REQUEST['customer_mob1'],
      'user_password' => $_REQUEST['customer_password'],
      'user_status' => $_REQUEST['customer_status'],
      'user_addedby' => $_REQUEST['sky_user_id'],
    );
    $this->User_Model->update_info('user_mobile', $mobile, 'user', $user_data);

    $response["status"] = TRUE;
    $response["msg"] = "Customer Updated Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  // Delete Customer...
  public function delete_customer(){
    $customer_id = $_REQUEST['customer_id'];
    $cust = $this->User_Model->get_info_arr('customer_id', $customer_id, 'customer');
    $mobile = $cust[0]['customer_mob1'];
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer');
    $this->User_Model->delete_info('user_mobile', $mobile, 'user');

    $response["status"] = TRUE;
    $response["msg"] = "Customer Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);

  }


}
