<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyForm
 *
 * @author 13125877
 */
class UserAgent extends CI_Controller{
   //put your code here
   public function __construct() {
      parent::__construct();

   }

  public function index(){
    $this->load->library('user_agent');
    if ($this->agent->is_browser())
    {
            $agent = $this->agent->browser().' '.$this->agent->version();
    }
    elseif ($this->agent->is_robot())
    {
            $agent = $this->agent->robot();
    }
    elseif ($this->agent->is_mobile())
    {
            $agent = $this->agent->mobile();
    }
    else
    {
            $agent = 'Unidentified User Agent';
    }
    echo $agent;
    echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
  }
}
