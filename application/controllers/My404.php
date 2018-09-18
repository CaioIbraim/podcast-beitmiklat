<?php
class My404 extends My_Controller
{
 public function __construct()
 {
    parent::__construct();
 }

 public function index()
 {
    $this->data['title'] = "Nada encontrado!";
    $this->output->set_status_header('404');
    $this->data['conteudo'] = '<h1>404 - Ops! Nenhum conteúdo encontrado.</h1>';
    $this->parser->parse('layout/404', $this->data);
 }
}
