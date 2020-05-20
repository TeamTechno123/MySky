<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

	public function index()
	{
		$this->load->view('Website/index');
	}
  public function products()
  {
    $this->load->view('Website/products');
  }
  public function vehicle()
  {
    $this->load->view('Website/vehicle');
  }
  public function business()
  {
    $this->load->view('Website/business');
  }
  public function enquiry()
  {
    $this->load->view('Website/enquiry');
  }
  public function login()
  {
    $this->load->view('Website/login');
  }
  public function contact()
  {
    $this->load->view('Website/contact');
  }

	public function send_mail(){
	 $this->load->library('email');
	$name = $this->input->post('name');
	$email = $this->input->post('email');
	// $subject = $this->input->post('subject');
	$mobile = $this->input->post('mobile');
	$message = $this->input->post('message');
	$message1 = $message.' mobile No.'.$mobile;
	$from_email = $email;
	$recipient = "myskyrakha12@gmail.com";
$subject = "Enquiry Mail";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from_email."\r\n".
'Reply-To: '.$from_email."\r\n" .
'X-Mailer: PHP/' . phpversion();

$send = mail($recipient, $subject, $message1, $headers);
if($send){
	$this->session->set_flashdata('send_email','success');
}
else{
	$this->session->set_flashdata('send_email','error');
}
header('Location:'.base_url('Website/enquiry'));
}

}
