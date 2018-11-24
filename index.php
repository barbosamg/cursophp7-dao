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
// $usuario = new Usuario();
// $usuario->login("diego", "1234");
// echo $usuario;

//FAZ O INSERT
// $aluno = new Usuario("junia", "123");
// $aluno->insert();
// echo $aluno;

//FAZ O UPDATE
// $usuario = new Usuario();
// $usuario->loadById(8);
// $usuario->update("aluno", "senha");
// echo $usuario;

//FAZ O DELETE DO USUARIOS
$usuario = new Usuario();
$usuario->loadById(5);
$usuario->delete();
echo $usuario;

?>