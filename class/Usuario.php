<?php
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//USUARIO
	public function getIdusuario(){
		return $this->idusuario;
	}
	public function setIdusuario($value){
		$this->idusuario = $value;
	}
	//LOGIN
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($value){
		$this->deslogin = $value;
	}
	//SENHA
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($value){
		$this->dessenha = $value;
	}
  	//CADASTRO
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($value){
		$this->dtcadastro = $value;
	}

	public function loadById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

		if (isset($result[0])){

			$row = $result[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro( new DateTime($row['dtcadastro']));

		}
	}

	//AULA LIST - SECÇÃO 13, AULA 64
	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			':SEARCH'=>"%".$login."%"
			));
	}

	//POSSUI A MESMA ESTRUTURA DO LOADBYID
	
	public function login($login, $password){
				$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
				":LOGIN"=>$login,
				":SENHA"=>$password
			));

		if (isset($result[0])){

			$row = $result[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro( new DateTime($row['dtcadastro']));

		}else{
			throw new Exception("Login e/ou senha invalido(a)!");
			
		}
	}

	//ÁTÉ AQUI: AULA LIST - SECÇÃO 13, AULA 64

	public function __toString(){

		return json_encode(array(
		"idusuario"=> $this->getIdusuario(),
		"deslogin"=>$this->getDeslogin(),
		"dessenha"=>$this->getDessenha(),
		"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));

		/*PROBLEMAS COM O 'FORMAT' DEVIDO ERRO DE SINTAXE NO CONTEÚDO. 

		DEVIDO ERRO DE ATRIBUIÇÃO NO WHERE, O RESULTADO QUE O SELECT TROUXE ERA NULL; LOGO, O METODO FORMAT NÃO CONSEGUE TRABALHAR COM UM RESULTADO NULL.*/
	}


}
?>