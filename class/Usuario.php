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

			$this->setData($result[0]);

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

			$this->setData($result[0]);

		}else{
			throw new Exception("Login e/ou senha invalido(a)!");
			
		}
	}

	//ATÉ AQUI: AULA LIST - SECÇÃO 13, AULA 64


	//AULA INSERT - DAO 

	Public function setData($data){

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro( new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();
		//SQL SERVER UTUILIA: EXECUTE E NÃO CALL
		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		if (count($result)>0){

			$this->setData($result[0]);

		}

	}

	public function update($login, $senha){

		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = 	:ID", array(
			":LOGIN"=>$this->getDeslogin(),
			":SENHA"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
		));


	}
	//ATRIBUÍDO NULL PARA AS VARIÁVEIS POIS NAS UTILIZAÇÕES SEM PARÂMENTROS NÃO VAI INFLUENCIAR
	public function __construct($login="", $password=""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}

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