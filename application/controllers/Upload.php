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
class Upload extends MY_Controller{
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
      if(!isset($_SESSION)){
        redirect('admin/logout', 'refresh');
      }

      if($_SESSION['perfil'] !== '0'){
          redirect('admin/logout', 'refresh');
      }
   }

public function index(){
     $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $this->data, true);
     $this->parser->parse('layout/blanc', $this->data);
}



public function do_upload(){
  $target_dir = "uploads/mp3/";
  $target_file = $target_dir . basename($_FILES["mp3_url"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["mp3_url"]["size"] > 50000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "mp3" ) {
      echo "Sorry, only JPG, JPEG, PNG , GIF & mp3 files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["mp3_url"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["mp3_url"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
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
