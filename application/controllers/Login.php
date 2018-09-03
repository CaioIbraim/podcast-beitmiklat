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
class Login extends MY_Controller{
   //put your code here

   public function __construct() {
      parent::__construct();
   }

public function index(){
        $this->form_validation->set_rules('password', 'Senha', 'trim|required|max_length[8]|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->data['erros']       = '';

        if ($this->form_validation->run() == FALSE){
           $this->data['conteudo'] = $this->parser->parse('telas/login/form', $this->data, true);
        }
        else{
            //cadastrar usuario
            $this->load->model('Crud_Model');
            $data = $this->input->post();
            //Verificar se o email informado já está cadastrado
            $query =   $this->Crud_Model->select_where('email',$data['email'],'login');
            if(count($query) > 0){
                //Se o email já existir no banco de dados retorno um erro para a tela do login
                $data['password'] = MD5($data['password']);
                if($query[0]['password'] === $data['password']){
                  $this->data['conteudo'] = $this->parser->parse('telas/default/formsuccess', $this->data, true);
                }else{
                  $this->data['erros']       = 'A email ou senha informados não estão corretos.';
                  $this->data['conteudo'] = $this->parser->parse('telas/login/form', $this->data, true);
                }
            }else{
                $this->data['erros']       = 'O email informado não foi encontrado.';
                $this->data['conteudo'] = $this->parser->parse('telas/login/form', $this->data, true);
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
