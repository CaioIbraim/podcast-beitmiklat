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
class Account extends CI_Controller{
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

      $this->form_validation->set_rules('name', 'Nome', 'required');
      $this->form_validation->set_rules('password', 'Senha', 'trim|required|max_length[8]|min_length[3]');
      $this->form_validation->set_rules('passconf', 'Confirmar Senha', 'trim|required|matches[password]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');


      $this->data['title']       = 'Junte-se a nós!';
      $this->data['erros']       = '';



      if ($this->form_validation->run() == FALSE){
         $this->data['conteudo'] = $this->parser->parse('telas/account/form', $this->data, true);
      }
      else{
          //cadastrar usuario
          $this->load->model('Crud_Model', 'l');
          $data = $this->input->post();

          //Verificar se o email informado já está cadastrado
          $query =   $this->l->select_where('email',$data['email'],'login');

          if(count($query) > 0){
              //Se o email já existir no banco de dados retorno um erro para a tela do login
              $this->data['erros']       = 'O email informado já existe.';
              $this->data['conteudo'] = $this->parser->parse('telas/account/form', $this->data, true);
          }else{
              //Insere usuário no banco de dados
              //Preparando as variáveis
              //removo passconf
              $data['password'] = MD5($data['password']);
              $data['perfil']   = 1;
              unset($data['passconf']);


              //inserindo dados
              if($this->l->insert($data,'login') > 0){
                //Se inserir apresenta tela de sucesso
                  $this->data['conteudo'] = $this->parser->parse('telas/default/formsuccess', $this->data, true);
              }else{
                //senão inserir retorna Erro
                $this->data['erros']       = 'Encontramos um erro ao criar sua conta, por favor entre em contato com o nosso suporte.';
                $this->data['conteudo'] = $this->parser->parse('telas/account/form', $this->data, true);
              }

          }

      }
      $this->parser->parse('layout/blanc', $this->data);
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
    '<script>',
    '</script>',
    'DROP',
    'drop',
    '--'
);
  $string = word_censor($string, $disallowed, '[CENSURADO]');
  echo $string;
}


}
