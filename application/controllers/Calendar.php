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
class Calendar extends CI_Controller{
   //put your code here
   public function __construct() {
      parent::__construct();

   }

  public function index(){
    $this->load->library('calendar');

    $data = array(
            3  => 'http://example.com/news/article/2006/06/03/',
            7  => 'http://example.com/news/article/2006/06/07/',
            13 => 'http://example.com/news/article/2006/06/13/',
            26 => 'http://example.com/news/article/2006/06/26/'
    );

    echo $this->calendar->generate(2006, 6, $data);
  }
}
