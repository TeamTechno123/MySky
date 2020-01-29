<?php
class User_Model extends CI_Model{

  function check_login($mobile, $password){
    $query = $this->db->select('*')
      ->where('user_mobile', $mobile)
      ->where('user_password', $password)
      ->where('user_status', 'active')
      ->from('user')
      ->get();
    $result = $query->result_array();
    return $result;
  }

  public function save_data($tbl_name, $data){
    $this->db->insert($tbl_name, $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function get_list($company_id,$id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->where('company_id', $company_id)
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_list2($id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_info($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_info_arr($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result_array();
    return $result;
  }

  public function update_info($id_type, $id, $tbl_name, $data){
    $this->db->where($id_type, $id)
    ->update($tbl_name, $data);
  }

  public function delete_info($id_type, $id, $tbl_name){
    $this->db->where($id_type, $id)
    ->delete($tbl_name);
  }

  public function check_duplication($company_id,$value,$field_name,$table_name){
    $query = $this->db->select($field_name)
      // ->where('company_id', $company_id)
      ->where($field_name,$value)
      ->from($table_name)
      ->get();
    $result = $query->num_rows();
    return $result;
  }

  public function check_dupli_num($company_id,$value,$field_name,$table_name){
    $this->db->select($field_name);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    $this->db->where($field_name,$value);
    $this->db->from($table_name);
    $query = $this->db->get();
    $num = $query->num_rows();
    return $num;
  }

/*****************************************************************************/
  // Get Roll List..
  public function roll_list(){
    $this->db->select('*');
    $this->db->where('roll_id !=',1);
    $this->db->where('roll_id !=',5);
    $this->db->from('roll');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  // Used In Report...
  public function roll_list2(){
    $this->db->select('*');
    $this->db->where('roll_id !=',1);
    $this->db->where('roll_id !=',2);
    $this->db->from('roll');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  // Get User List...
  public function user_list($company_id){
    $this->db->select('*');
    $this->db->where('roll_id !=',1);
    $this->db->where('roll_id !=',5);
    $this->db->where('company_id',$company_id);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  public function user_list2($company_id){
    $this->db->select('*');
    $this->db->where('roll_id !=',1);
    // $this->db->where('roll_id !=',5);
    $this->db->where('company_id',$company_id);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  // User List By Roll... Used in 1. add user
  public function get_srm_list($company_id){
    $this->db->select('*');
    $this->db->where('roll_id', 3);
    $this->db->where('company_id',$company_id);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // User List By Roll... Used in 1. add user
  public function get_rm_list($company_id){
    $this->db->select('*');
    $this->db->where('roll_id', 4);
    $this->db->where('company_id',$company_id);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  public function get_count($id_type,$company_id,$key_type,$key,$tbl_name){
    $this->db->select($id_type);
    if($key != ''){
      $this->db->where($key_type, $key);
    }
    $this->db->where('company_id', $company_id);
    $this->db->from($tbl_name);
    $query =  $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

  public function get_count2($id_type,$company_id,$key_type,$key,$key_type2,$key2,$tbl_name){
    $this->db->select($id_type);
    if($key != ''){
      $this->db->where($key_type, $key);
    }
    if($key2 != ''){
      $this->db->where($key_type2, $key2);
    }
    $this->db->where('company_id', $company_id);
    $this->db->from($tbl_name);
    $query =  $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

  public function get_user_count($company_id){
    $this->db->select('user_id');
    $this->db->where('roll_id !=',1);
    $this->db->where('roll_id !=',5);
    $this->db->where('company_id', $company_id);
    $this->db->from('user');
      $query =  $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

  public function cust_list_by_ref($sky_user_id){
    $this->db->select('*');
    $this->db->where('user_id', $sky_user_id);
    $this->db->from('customer');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // function check_otp($otp, $user_id){
  //   $query = $this->db->select('*')
  //       ->where('user_otp', $otp)
  //       ->where('user_id', $user_id)
  //       ->from('law_user')
  //       ->get();
  //   $result = $query->result_array();
  //   return $result;
  // }
  //

  function check_pwd($user_id,$old_password){
    $query = $this->db->select('user_id')
        ->where('user_password', $old_password)
        ->where('user_id', $user_id)
        ->from('law_user')
        ->get();
    $result = $query->result_array();
    return $result;
  }

  // public function get_count($id_type,$company_id,$key,$tbl_name){
  //   $this->db->select($id_type);
  //   if($key != ''){
  //     $this->db->where('application_status', $key);
  //   }
  //   $this->db->where('company_id', $company_id);
  //   $this->db->from($tbl_name);
  //     $query =  $this->db->get();
  //   $result = $query->num_rows();
  //   return $result;
  // }


}
?>
