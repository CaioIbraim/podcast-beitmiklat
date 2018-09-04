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
        $this->data['musicas']     = $this->getMusics();

        $this->parser->parse('layout/podcast', $this->data);
    }

    public function getMusics(){

      $url = base_url();
      $array = [];
      $myObj  = new \stdClass();
      $myObj2 = new \stdClass();

      $myObj->mp3    = $url."uploads/mp3/gad_elbaz_mizmor_ldavid__hUv8Qy4pKNs.mp3";
      $myObj->ogg    = $url."uploads/mp3/gad_elbaz_mizmor_ldavid__hUv8Qy4pKNs.ogg";
      $myObj->titulo = "Mizmor le David";

      $var1 = $myObj;
      array_unshift($array, $var1);

      $myObj2->mp3    = $url."uploads/mp3/omer_adam_modeh_ani_lyrics_zEgrqzmTwJs.mp3";
      $myObj2->ogg    = $url."uploads/mp3/omer_adam_modeh_ani_lyrics_zEgrqzmTwJs.ogg";
      $myObj2->titulo = "Modê Ani";

      $var2 = $myObj2;
      array_unshift($array, $var2);

      $myJSON = json_encode(array_reverse($array));
    return  $myJSON;
    }



    public function getMusics2(){

      //$url = base_url();
      $array = [];

      $myObj->mp3    = $url."uploads/mp3/gad_elbaz_mizmor_ldavid__hUv8Qy4pKNs.mp3";
      $myObj->ogg    = $url."uploads/mp3/gad_elbaz_mizmor_ldavid__hUv8Qy4pKNs.ogg";
      $myObj->titulo = "Mizmor le David";

      $var1 = $myObj;
      array_unshift($array, $var1);

      $myObj2->mp3    = $url."uploads/mp3/omer_adam_modeh_ani_lyrics_zEgrqzmTwJs.mp3";
      $myObj2->ogg    = $url."uploads/mp3/omer_adam_modeh_ani_lyrics_zEgrqzmTwJs.ogg";
      $myObj2->titulo = "Modê Ani";

      $var2 = $myObj2;
      array_unshift($array, $var2);

      $myJSON = json_encode(array_reverse($array));
    return  $myJSON;
    }


}
