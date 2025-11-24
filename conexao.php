<?php

// Site na web: arthur-dassoler.wuaze.com

class Conexao {

	private $host = 'sql212.infinityfree.com';
	private $dbname = 'if0_40161552_alunos';
	private $user = 'if0_40161552';
	private $pass = 'aRTHUR922';

	public function conectar() {
		try {

			$conexao = new PDO(
				"mysql:host=$this->host;dbname=$this->dbname",
				"$this->user",
				"$this->pass"				
			);

			return $conexao;


		} catch (PDOException $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
}

?>