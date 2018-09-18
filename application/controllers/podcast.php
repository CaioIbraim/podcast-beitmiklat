<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Podcast extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    //Função default
    public function index() {
        //Setar o coteúdo que deverá ser apresentado
        $this->data['conteudo']    = '';

        $this->data['og_description']    = 'Compartilhamento de podcast Beit Miklat';
        $this->data['og_image']          = 'http://beitmiklat-com-br.umbler.net/theme/gray/img/gray-wallpapers-1.jpg';
        $this->data['og_image_width']    = '2560';
        $this->data['og_image_height']   = '1440';
        $this->data['og_data_hora']      = date("d/m/Y");
        $this->data['og_tag']            = "Judaísmo, Podcast";

        $this->data['musicas']     = $this->getMusics();
        $this->parser->parse('layout/podcast', $this->data);
    }

    public function getMusics(){

      $url    = base_url();
      $array  = [];
      $query  = $this->db->query("SELECT * FROM podcast WHERE status = 1 ")->result_array();

      for($i = 0; $i < count($query); $i++){
            $myObj  = new \stdClass();
            $myObj->mp3    = $url."".$query[$i]['mp3_url'];;
            $myObj->titulo = $query[$i]['title'];
            $var = $myObj;
            array_push($array, $var);
      }

      $myJSON = json_encode($array);
      return   $myJSON;
    }

    public function display($link){

      $query  = $this->db->query("SELECT * FROM podcast WHERE link = '$link' ")->result_array();

      if(count($query) === 0){
        redirect('My404');
      }


      $this->data['title']             = $query[0]['title'];
      $this->data['og_description']    = $query[0]['description'];
      $this->data['og_image']          = 'http://beitmiklat-com-br.umbler.net/theme/gray/img/gray-wallpapers-1.jpg';
      $this->data['og_image_width']    = '2560';
      $this->data['og_image_height']   = '1440';
      $this->data['og_data_hora']      = $query[0]['dt_include'];
      $this->data['og_tag']            = $query[0]['tags'];


      $this->data['conteudo']    = '';
      $this->data['musicas']     = $this->getMusic($query);
      $this->parser->parse('layout/podcast', $this->data);
    }

    public function getMusic($query){

      $url    = base_url();
      $array  = [];
       for($i = 0; $i < count($query); $i++){
            $myObj  = new \stdClass();
             $myObj->mp3    = $url."".$query[$i]['mp3_url'];;
             $myObj->titulo = $query[$i]['title'];
             $var = $myObj;
             array_push($array, $var);
       }
       $myJSON = json_encode($array);
       return   $myJSON;
    }


}
