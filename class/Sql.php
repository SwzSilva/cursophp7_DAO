<?php
/*
		DAO - DATA ACCESS OBJECT
	* Camadas: BD, PHP, FRONT
	* Cria uma abstração do banco com o intuito de gerar a segurança do banco de dados e praticidade no caso de mudanças realizadas pelo DBO. 
	
	* Foi criado a separação dos acessos e definições de classes e distribuídas pelas paginas por meio do autoload
 */
	class Sql extends PDO {
		private $conn;
		//Gera a conexão automaticamente
		public function __construct(){
			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		}
		//Prepara a execução dos comandos SQL (+ de 1)
		private function setParams($statment, $parameters=array()){
			foreach($parameters as $key => $values){

				$statment->bindParam($key,$value);

			}
		}

		//Prepara a execução dos comandos SQL 
		private function setParam($statment, $key, $value){

			$statment -> bindParam($key, $value);

		}

		public function query($rawQuery,$params = array()){
			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt,$params);

			$stmt->execute();

			return $stmt;
		}

		public function select($rawQuery,$params = array()):array{

			$stmt = $this->query($rawQuery,$params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}
	}
?>