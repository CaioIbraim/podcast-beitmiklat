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
class Upload extends CI_Controller{
   //put your code here

   public function __construct() {
      parent::__construct();
      $this->load->helper(array('form', 'url'));
      $this->load->helper('text');
      $this->load->library('form_validation');
      $this->load->library('parser'); //template
      $this->load->library('utilidades'); //library
      $this->form_validation->set_error_delimiters('<div class="alert alert-warning"><strong>Atenção! </strong>', '</div>');

      //Configurando mensagens de erro
      $this->form_validation->set_message('min_length' ,  '{field} deve ter pelo menos {param} caracteres.');
      $this->form_validation->set_message('max_length' ,  '{field} deve ter até {param} caracteres.');
      $this->form_validation->set_message('required'   ,  '{field} é um campo obrigatório.');
      $this->form_validation->set_message('valid_email',  '{field} deve conter um email válido.');
      $this->form_validation->set_message('matches',      '{field} deve ser igual ao campo {param}.');

      $this->data['title']       = 'Publique seu podcast aqui!';
      $this->data['error']       = '';
      $this->data['success']     = '';
   }

public function index(){

    /*  $this->form_validation->set_rules('description', 'Descrição', 'trim|required|max_length[500]');
      $this->form_validation->set_rules('tags', 'tags', 'trim');
      if (!isset($_FILES['mp3_url']['name'])){
          $this->form_validation->set_rules('mp3_url', 'Arquivo MP3', 'trim|required|max_length[200]|min_length[3]');
      }

      if (!isset($_FILES['img_url']['name'])){
          $this->form_validation->set_rules('img_url', 'Imagem', 'trim|required');
      }



      if ($this->form_validation->run() == FALSE){*/
       $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $this->data, true);
    /*  } */

$this->parser->parse('layout/blanc', $this->data);
}


public function upload(){
  //Se o formulário estiver OK
  $config['upload_path']          = './uploads/mp3/';
  $config['allowed_types']        = 'mp3';
  $config['max_size']             = 100;
  $config['max_width']            = 1024;
  $config['max_height']           = 768;

  $this->load->library('upload', $config);

  if(!$this->upload->do_upload('mp3_url')){
      $data    = array('error' => $this->upload->display_errors());
      $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $data, true);
   }else{
      $this->data['success']  = array('upload_data' => $this->upload->data());
      $this->data['conteudo'] = $this->parser->parse('telas/default/formsuccess', $this->data, true);
  }
  $this->parser->parse('layout/blanc', $this->data);
}


}
