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
class MyForm extends CI_Controller{
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

   }

public function index(){

      $this->form_validation->set_rules('username', 'Usuário', 'required');
      $this->form_validation->set_rules('password', 'Senha', 'trim|required|max_length[8]|min_length[3]');
      $this->form_validation->set_rules('passconf', 'Confirmar Senha', 'trim|required|matches[password]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

      if ($this->form_validation->run() == FALSE){
         $this->load->view('login');
      }
      else{
         $this->load->view('formsuccess');
      }
}


public function username_check($str){
   if ($str == 'test'){
         $this->form_validation->set_message('username_check', 'O {field} Não pode conter a palavra "test"');
         return FALSE;
   }
   else{
        return TRUE;
   }
}

public function censurar($string = ""){
  $disallowed = array(
    '.xxx',
    '4tube.com',
    'clickme.net',
    'cnnamador.com',
    'extremefuse.com',
    'fakku.net',
    'fux.com.br', //Com .br é de advogados
    'heavy-r.com',
    'kaotic.com',
    'xhamster.com',
    'porndoe.com',
    'pornocarioca.com',
    'rapebait.net',
    'redtube.com',
    'sex.com',
    'vidmax.com',
    'wipfilms.net',
    'xvideos.com',
    'xvideos.net',
    'porntube.com',
);
  $string = word_censor($string, $disallowed, '[CENSURADO]');
  echo $string;
}


}
