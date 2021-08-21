<?php
require_once 'vendor/autoload.php';
use \App\Entidades\Contacto;

//=======Cadastrando===========
$contacto = new Contacto;
$contacto->nome = "António Cárter";
$contacto->telefone = "+244936602568";
$contacto->cadastrar();