<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSender extends CI_Controller {
   //put your code here

   public function __construct() {
      parent::__construct();
   }

public function index(){

  $this->load->library('email');
  $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'smtp.mailtrap.io',
  'smtp_port' => 2525,
  'smtp_user' => '0dd34f44eea3bf',
  'smtp_pass' => '4325dfc3ed3345',
  'crlf' => "\r\n",
  'newline' => "\r\n"
);

  $this->email->initialize($config);

      $this->email->from($config['smtp_user']);
      $this->email->to($config['smtp_pass']);


      $this->email->subject("Teste"); #change
      $this->email->message("Teste"); #change
      if($this->email->send())
      {

          echo "mail send";
      }
      else
      {
          show_error($this->email->print_debugger());

      }
}


}
