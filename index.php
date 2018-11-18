<?php

require_once("config.php");
// $sql = new Sql();
// $usuarios = $sql->select("SELECT * FROM tb_usuarios");
// echo json_encode($usuarios);

//carrega 1 usuario
//$root = new Usuario();
//$root->loadById(2);
//echo $root;

//CARREGA UMA LISTA DE USUARIOS
// $lista = Usuario::getList();
// echo json_encode($lista);

//CARREGA LISTA BUSCANDO PELO LOGIN
// $busca = Usuario::search("di");
// echo json_encode($busca);

//BUSCAR USUARIO AUTENTICANDO O LOGIN E SENHA
$usuario = new Usuario();
$usuario->login("diego", "1234");
echo $usuario;
?>