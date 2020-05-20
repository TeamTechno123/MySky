<?php
class Transaction_Model extends CI_Model{

  //Auto Number...
  public function get_count_no($field_name, $tbl_name){
    $query = $this->db->select('MAX('.$field_name.') as num')
    ->from($tbl_name)
    ->get();
    $result =  $query->result_array();
    if($result){
      $old_num = $result[0]['num'];
    } else{
      $old_num = 0;
    }             //separating numeric part
    $value = $old_num + 1;             //concatenating incremented value
    return $value;
  }

  public function sale_descr_list($sale_id){
    $this->db->select('*');
    $this->db->where('sale_id',$sale_id);
    $this->db->from('sale_descr');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  public function get_user_by_roll($company_id,$roll_id){
    $this->db->select('*');
    $this->db->where('roll_id', $roll_id);
    $this->db->where('company_id',$company_id);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  public function customer_report_list($user_id,$customer_type_id){
    $this->db->select('customer.*,customer_type.*,user.user_id as this_user_id');
    $this->db->from('customer');
    if($user_id != ''){
      $this->db->where('customer.user_id', $user_id);
    }
    if($customer_type_id != ''){
      $this->db->where('customer_type.customer_type_id', $customer_type_id);
    }
    $this->db->join('customer_type','customer.customer_type_id = customer_type.customer_type_id', 'LEFT');
    $this->db->join('user','customer.customer_mob1 = user.user_mobile', 'LEFT');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  public function customer_target_report_list($from_date,$to_date,$customer_type_id){
    $this->db->select('customer.*,customer_type.*,user.user_id as this_user_id');
    $this->db->from('customer');
    if($customer_type_id != ''){
      $this->db->where('customer_type.customer_type_id', $customer_type_id);
    }
    $this->db->where("str_to_date(customer.customer_date,'%Y-%m-%d') BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $this->db->join('customer_type','customer.customer_type_id = customer_type.customer_type_id', 'LEFT');
    $this->db->join('user','customer.customer_mob1 = user.user_mobile', 'LEFT');
    $query = $this->db->get();
    $result = $query->result();
    // $q = $this->db->last_query();
    return $result;
  }

}
?>
