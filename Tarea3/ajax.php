<?php
require_once('db_config.php');

class Ajax {
	public $buscador;

	public function Buscar($a) {
		$db = DbConfig::getConnection() or die("No se ha podido conectar: " . pg_last_error());
		$this->buscador = $db->real_escape_string($a);

		$sql = $db->query("SELECT * FROM participante WHERE nombre LIKE '%".$this->buscador."%';");

		while ($arr = $sql->fetch_assoc()) {
			$resultado[] = $arr['nombre'];
		}
		return $resultado;

	}
}

$busqueda = new Ajax();
echo json_encode($busqueda->Buscar($_GET['term']));

?>
