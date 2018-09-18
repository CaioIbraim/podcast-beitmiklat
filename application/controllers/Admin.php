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
class Admin extends MY_Controller{
   //put your code here

   public function __construct() {
      parent::__construct();
      $this->load->library('Datatables');
      $this->data['erros']        = '';
      $this->data['error_img']    = '';
      $this->data['error_mp3']    = '';
      $this->data['pg_header']    = "Principal";
      $this->data['description']  = "Sistema de plublicação de podcasts";
      $this->data['controller']   = "admin";
      $this->data['categories']   = parent::returnCategories();
      $this->data['ancora']       = "main";
   }

public function index(){

        $this->form_validation->set_rules('password', 'Senha', 'trim|required|max_length[8]|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->data['erros']  = '';

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

                  $_SESSION['id_login'] = $query[0]['id_login'];
                  $_SESSION['name']     = $query[0]['name'];
                  $_SESSION['perfil']   = $query[0]['perfil'];

                  redirect('admin/main', 'refresh');

                }else{
                  $this->data['erros']    = 'O email ou a senha informados não estão corretos.';
                  $this->data['conteudo'] = $this->parser->parse('telas/login/form', $this->data, true);
                }
            }else{
                $this->data['erros']    = 'O email informado não foi encontrado.';
                $this->data['conteudo'] = $this->parser->parse('telas/login/form', $this->data, true);
            }
        }

$this->parser->parse('layout_admin/login', $this->data);
}



public function main(){




  if(!isset($_SESSION)){
    redirect('admin/logout', 'refresh');
  }

  if($_SESSION['perfil'] !== '0'){
      redirect('admin/logout', 'refresh');
  }

  $this->data['conteudo'] = $_SESSION['name'];
  $this->parser->parse('layout_admin/layout', $this->data);
}



public function logout(){
  session_destroy();
	redirect('/admin', 'refresh');
}














//Função para fazer upload de podcast
public function uploadPodcast(){

  $this->data['pg_header']    = "Upload";
  $this->data['description']  = "Tela para cadastro de podcast";


  $aux = 0;
  if(empty($_FILES['img_url']['name'])){
    $this->data['error_img'] = "Selecione uma imagem para fazer o upload.";
    $aux = 1;
  }

  if(empty($_FILES['mp3_url']['name'])){
    $this->data['error_mp3'] = "Selecione um arquivo MP3 para fazer o upload.";
    $aux = 1;
  }

  $this->form_validation->set_rules('title', 'Titulo', 'trim|required|max_length[60]|min_length[3]');
  $this->form_validation->set_rules('id_category', 'Categoria', 'trim|required|max_length[4]|min_length[3]');
  $this->form_validation->set_rules('description', 'Descrição', 'trim|required|max_length[200]');
  $this->form_validation->set_rules('tags', 'Tags', 'trim|required|max_length[60]|min_length[4]');


  //Valida o formulário
  if ( ($this->form_validation->run() == FALSE) || $aux == 1 ){
     $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $this->data, true);
     return $this->parser->parse('layout_admin/layout', $this->data);
  }

  if(!empty($_FILES)){
    $upload = parent::do_upload($_FILES, "mp3_url", "mp3");
    $upload = json_decode($upload, true);
    if($upload['status'] === 0){
      $this->data['error_mp3'] = $upload['msg'];
      $aux = 1;
    }

    $upload = parent::do_upload($_FILES, "img_url", "img");
    $upload = json_decode($upload, true);
    if($upload['status'] === 0){
      $this->data['error_img'] = $upload['msg'];
      $aux = 1;
    }

    if($aux == 0){
        $dados             =  $this->input->post();
        $dados['id_login'] = $_SESSION['id_login'];
        $dados['img_url']  = "uploads/img/".$_FILES['img_url']['name'];
        $dados['mp3_url']  = "uploads/mp3/".$_FILES['mp3_url']['name'];
        $title             = strtolower($dados['title']);
        $dados['link']     =  str_replace(" ","-",$title);

        $this->load->model('Crud_Model');
        if($this->Crud_Model->insert($dados,'podcast') > 0){
          //Se inserir apresenta tela de sucesso
            $this->data['ancora']       = "searchPodcast";
            $this->data['conteudo'] = $this->parser->parse('telas/default/formsuccess', $this->data, true);
        }else{
          //senão inserir retorna Erro
          $this->data['erros']       = 'Encontramos um erro com sua conta, por favor entre em contato com o nosso suporte.';
          $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $this->data, true);
        }
    }else{
        $this->data['conteudo'] = $this->parser->parse('telas/upload/form', $this->data, true);
    }

    return $this->parser->parse('layout_admin/layout', $this->data);
 }

}















//Função para fazer upload de podcast
public function alterarPodcast($id){
  $this->data['pg_header']    = "Alterar";
  $this->data['description']  = "Tela para alteração de podcast";

  $this->data['formData'] = $this->db->query("SELECT * FROM podcast WHERE id_podcast = '$id' ")->result_array();

  $aux = 0;
  if(!empty($_FILES['img_url']['name'])){
    $aux = 2;
  }

  if(!empty($_FILES['mp3_url']['name'])){
    $aux = 2;
  }

  $this->form_validation->set_rules('title', 'Titulo', 'trim|required|max_length[60]|min_length[3]');
  $this->form_validation->set_rules('id_category', 'Categoria', 'trim|required|max_length[4]|min_length[3]');
  $this->form_validation->set_rules('description', 'Descrição', 'trim|required|max_length[200]');
  $this->form_validation->set_rules('tags', 'Tags', 'trim|required|max_length[60]|min_length[4]');

  //Valida o formulário
  if ( ($this->form_validation->run() == FALSE) || $aux == 1 ){
     $this->data['conteudo'] = $this->parser->parse('telas/upload/form_alt', $this->data, true);
     return $this->parser->parse('layout_admin/layout', $this->data);
  }

  if($aux == 2){

    $upload = parent::do_upload($_FILES, "mp3_url", "mp3");
    $upload = json_decode($upload, true);
    if($upload['status'] === 0){
      $this->data['error_mp3'] = $upload['msg'];
      $aux = 1;
    }

    $upload = parent::do_upload($_FILES, "img_url", "img");
    $upload = json_decode($upload, true);
    if($upload['status'] === 0){
      $this->data['error_img'] = $upload['msg'];
      $aux = 1;
    }
  }

  if($aux == 0){
        $dados =  $this->input->post();
        $dados['id_login'] = $_SESSION['id_login'];
        $dados['img_url']  = "uploads/img/".$_FILES['img_url']['name'];
        $dados['mp3_url']  = "uploads/mp3/".$_FILES['mp3_url']['name'];
        $title             = strtolower($dados['title']);
        $dados['link']     =  str_replace(" ","-",$title);

        $this->load->model('Crud_Model');
        if($this->Crud_Model->update('id_podcast',$dados['id_podcast'],$dados,'podcast') > 0){
          //Se inserir apresenta tela de sucesso
          $this->data['ancora']       = "searchPodcast";
          $this->data['conteudo'] = $this->parser->parse('telas/default/formsuccess', $this->data, true);
        }else{
          //senão inserir retorna Erro
          $this->data['erros']       = 'Houve um erro ao atualizar os dados, por favor entre em contato.';
          $this->data['conteudo'] = $this->parser->parse('telas/upload/form_alt', $this->data, true);
        }
    }else{
        $this->data['erros']       = 'Encontramos um erro com sua conta, por favor entre em contato com o nosso suporte.';
        $this->data['conteudo'] = $this->parser->parse('telas/upload/form_alt', $this->data, true);
    }

  return $this->parser->parse('layout_admin/layout', $this->data);
}


//carrega a tela com o filtro
public function searchPodcast(){

  $this->data['pg_header']    = "Buscar Podcast";
  $this->data['description']  = "Tela para alteração de podcast";
  $this->data['table']        = $this->table->generate();


  $this->data['conteudo']     = $this->parser->parse('telas/upload/filtro', $this->data, true);
  return $this->parser->parse('layout_admin/layout', $this->data);
}

//carrega a tabela
public function tabela(){
      $this->data['title']  = $this->input->post('title');
      $this->data['cat'] = $this->input->post('cat');
      $this->data['status']  = $this->input->post('status');

      $this->table->set_heading(array('Titulo','Descrição','Categoria','Status','Editar'));
      //Setar o número de colunas
      $this->data['columns']   =  'null,null,null,null,null';
      //Setar o coteúdo que deverá ser apresentado
      $this->data['pg_header']    = "Pesquiar";
      $this->data['description']  = "Tela para administração de podcast";
      $this->data['table'] = $this->table->generate();

      echo  $this->parser->parse('telas/upload/tabelas', $this->data, true);
}

//Função para gerar datatables
   public function dtable(){
      $title  = $this->input->post('title');
      $cat    = $this->input->post('cat');
      $status = $this->input->post('status');

      $this->podcastTable($title, $cat, $status);
   }


   public function podcastTable($title, $cat, $status){
         function formataStatus($check) { if($check == "1") return 'Habilitado'; else return 'Desabilitado'; } //Função para formatar o status
         $this->datatables
           ->select("podcast.title,
                     podcast.description,
                     category.name,
                     podcast.status,
                     podcast.id_podcast", FALSE)
           ->from('podcast', FALSE)
           ->join('category', 'podcast.id_category = category.id_category')
           ->edit_column('status', '$1', "formataStatus('status')")
           ->edit_column('id_podcast', '<a href="alterarPodcast/$1"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>', 'id_podcast');
           if($title !== "0"){
              $this->datatables->where("podcast.title like '%$title%' ");
           }
           if($cat !== "0"){
              $this->datatables->where("category.id_category = '$cat' ");
           }
           if($status !== ""){
              $this->datatables->where("podcast.status = '$status' ");
           }
         echo $this->datatables->generate();
   }






}
