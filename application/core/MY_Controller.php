<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library('parser'); //template
        $this->load->library('utilidades'); //library
        $this->load->library('table');

        //$this->form_validation->set_error_delimiters('<div><strong>Atenção! </strong>', '</div>');
        $name = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
        session_name();
        session_cache_expire(1);//Define o tempo de sessão para 1  minutos


        //Configurando mensagens de erro
        $this->form_validation->set_message('min_length' ,  '{field} deve ter pelo menos {param} caracteres.');
        $this->form_validation->set_message('max_length' ,  '{field} deve ter até {param} caracteres.');
        $this->form_validation->set_message('required'   ,  '{field} é um campo obrigatório.');
        $this->form_validation->set_message('valid_email',  '{field} deve conter um email válido.');
        $this->form_validation->set_message('matches',      '{field} deve ser igual ao campo {param}.');
        $this->form_validation->set_message('differs',      '{field} deve ser diferente ao campo {param}.');

        //Inicia variáveis
        $this->data['title'] = ucfirst($this->uri->segment(1));


        $this->data['NAME'] = "BEIT MIKLAT";

        //Manobra com tabelas
        $template = array('table_open' => '<table id="big_table" class="table table-striped table-bordered dataTable no-footer table-hover" role="grid" aria-describedby="datatable_info">' );
        $this->table->set_template($template); //Gerando o template
    }

    //FUNÇÃO PARA GERAR FORMULÁRIOS BÁSICOS VERSÃO 0.1
    //ESTAT FUNÇÃO VISA DISPONIBILIZAR UMA FORMA PRÁTICA DE CRIAÇÃO  E PADRONIZAÇÃO DE FORMULÁRIOS
    public function gerarForm($array, $titulo, $btn, $urlAction) {
       //URL BASE
        $form = '<form id="formulario" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="'.$urlAction.'">';
        for ($i = 0; $i < count($array); $i++) {
            ($array[$i]['required']) ? $span = '<span class="required"> * </span>' : $span = ''; //Verifica se é campo obrigatório
            ($array[$i]['readonly']) ? $readonly = 'readonly = readonly"' : $readonly = ''; //Verifica se é campo obrigatório
            ($array[$i]['id'])?$id = $array[$i]['id']:$id = 'none';

            $tag = $array[$i]["tag"];

            $form .= $this->$tag($id,$array[$i]["type"],$array[$i]["name"],$array[$i]["value"],$readonly,$array[$i]["titulo"],$span,$array[$i]["options"],$array[$i]["class"]);//recebe o código do input


        }
        $form .= '<div class="ln_solid"></div>
                           <div class="form-group">
                                   <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                          <a id="btnAction" class="btn btn-primary">' . $btn . '</a>
                                          <a href="'.base_url().''.$this->uri->segment(1).'" class="btn btn-default" type="button">Cancelar</a>
                                   </div>
                           </div>
                   </form>
               ';
        return $form;
    }

    public function input($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="",$class=""){
       return '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="'.$id.'" class="form-control col-md-7 col-xs-12 '.$class.'" name="' . $name . '"  type="' . $type . '" value="' . $value . '"  ' . $readonly . '>
                           </div>
                     </div>';
    }




     public function inputP($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       return '<div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <div class="input-group">
                             <input id="'.$id.'" class="form-control col-md-7 col-xs-12" name="' . $name . '"  type="' . $type . '" value="' . $value . '"  ' . $readonly . '>
                            <span class="input-group-btn">
                                 <button type="button" id="pesquisar" class="btn btn-primary">Go!</button>
                             </span>
                          </div>
                       </div>
                  </div>';
    }

    public function textarea($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       return '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                             <textarea class="form-control" name='.$name.'></textarea>
                           </div>
                     </div>';
    }

   public function select($id = "", $type="", $name="", $value="", $readonly="",$titulo,$span,$option="" ){
       $valor = $value;
       $selected = '';
       $select = '<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">' . $titulo . ' ' . $span . '</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                             <select id='.$id.' class="form-control" name='.$name.'>';
                                 foreach ($option as $key => $value) {
                                       if($key == $valor){
                                            $selected = 'selected';
                                            $select  .=   '<option value='.$key.' '.$selected.'>'.$value.'</option>';
                                            continue;
                                         }
                                          $select  .=   '<option value='.$key.'>'.$value.'</option>';
                                 }
       $select .=    '</select>
                           </div>
                     </div>';
       return $select;
    }







    public function do_upload($file,$name,$path){
      $uploadOk = 1;
      $msgAux = '';
      $msg  = new \stdClass();

      if(empty($file[$name]["name"])){
        $msg->msg    = "Ops.";
        $msg->status = 0;
        return json_encode($msg);
      }


      $target_dir = "uploads/".$path."/";
      $target_file = $target_dir . basename($file[$name]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image

      // Check if file already exists
      if (file_exists($target_file)) {
          $uploadOk = 0;
          $msgAux    .= " Desculpe, o arquivo já existe.";
          $msg->status = 0;
      }
      // Check file size
      if ($file[$name]["size"] > 50000000) {
          $msgAux    .= " Desculpe, o tamanho do seu arquivo ultrapassa o limite permitido.";
          $msg->status = 0;
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "mp3" ) {
          $msgAux    .= " Desculpe, apenas arquivos JPG, JPEG, PNG , GIF & mp3 são permitidos.";
          $msg->status = 0;
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $msgAux    .= " Desculpe, seus arquivos não foram carregados corretamente.";
          $msg->status = 0;
          // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($file[$name]["tmp_name"], $target_file)) {
              $msgAux    .= " O arquivo  " . basename( $file[$name]["name"]). " foi enviado corretamente.";
              $msg->status = 1;

          } else {
              $msgAux    .= " Desculpe, houve um erro no upload.";
              $msg->status = 0;
          }
      }

      $msg->msg = $msgAux;

      return json_encode($msg);
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
        'fux.com', //Com .br é de advogados
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



  ///Retorna Categorias

  public function returnCategories(){
      return $this->db->query("select * from category")->result_array();
  }


}
