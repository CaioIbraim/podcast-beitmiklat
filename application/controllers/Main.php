<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('text');

        $this->load->library('form_validation');
        $this->load->library('parser'); //template
        $this->load->library('utilidades'); //library
        $this->data['NAME'] = "BEIT MIKLAT";
        $this->data['url_pagina'] = base_url().''.$this->uri->segment(1);
 }

    //Função default
    public function index() {
        //Setar o coteúdo que deverá ser apresentado
        $this->data['title']       = 'Principal';
        $this->data['pagina']      = '';
        $this->data['controller']  = '';
        $this->data['conteudo']    = '';
        $this->parser->parse('layout/layout', $this->data);
    }

}
