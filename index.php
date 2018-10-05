<?php

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/


//CARREGA UM USUÁRIO
//$root = new Usuario();
//$root->loadById(3);
//echo $root;


//CARREGA UMA LISTA DE USUÁRIOS
///$lista = Usuario::getList();

//echo json_encode($lista);

/// carrega uma lista de user buscando pelo login
//$search = Usuario::search("au");
//echo json_encode($search);

/*/CARREGA UM USUÁRIO USANDO LOGIN E SENHA
$user = new Usuario();
$user->login("root","root");
echo $user;*/

/*
AULA INSERT SEM O CONTRUCT

$aluno = new Usuario();
$aluno->setDeslogin("aluno");
$aluno->setDessenha("@luN0");

$aluno->insert();

uUSANDO CONSTRUTOR

echo $aluno;

$aluno = new Usuario("Fabio Cunha","@lun0s");

$aluno->insert();

echo $aluno;*/
/*

	----- UPDATE -----
$user = new Usuario();

$user->loadById(7);

$user->update("professor","&#%@*@!");

echo $user;
*/
$user = new Usuario();

$user->loadById(7);
$user->delete();
echo $user;

?>