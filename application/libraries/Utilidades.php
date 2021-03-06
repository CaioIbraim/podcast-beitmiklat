<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilidades {

        public function inverteData($data)
        {
          if(count(explode("/",$data)) > 1){
              return implode("-",array_reverse(explode("/",$data)));
          }elseif(count(explode("-",$data)) > 1){
              return implode("/",array_reverse(explode("-",$data)));
          }
        }

          public function sanitizeString($str){

            $str = preg_replace('/[áàãâä]/ui', 'a', $str);
            $str = preg_replace('/[éèêë]/ui', 'e', $str);
            $str = preg_replace('/[íìîï]/ui', 'i', $str);
            $str = preg_replace('/[óòõôö]/ui', 'o', $str);
            $str = preg_replace('/[úùûü]/ui', 'u', $str);
            $str = preg_replace('/[ç]/ui', 'c', $str);
            // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
            $str = preg_replace('/[^a-z0-9]/i', '_', $str);
            $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
            return $str;

          }

          public function simpleReplace($str){
          //  / str_replace ( mixed $search , mixed $replace , mixed $subject [, int &$count ] )
          }
}
