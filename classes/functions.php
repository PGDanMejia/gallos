<?php 

class functions {

	private $_db;

    function __construct($db, $dir, $siteemail){
    	$this->_db = $db;
    	$this->_dir = $dir;
    	$this->_siteemail = $siteemail;
    }

	// FUNCIONES PARA REPORTES MENSUALES
    public function getYearsForReport() {
    	try {
			$stmt = $this->_db->prepare('
				SELECT (LEFT(fechaIngreso, 4)) AS anios FROM export_import
				GROUP BY anios
				ORDER BY anios DESC
			');
			$stmt->execute();		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
    }


	public function listarReporte($formato, $tipo, $mes, $anio) {

		$fechaReporte = $anio.'-'.$mes.'-01';

		try {
			if($formato == 1) {
				$stmt = $this->_db->prepare('
					SELECT fa.codigoFraccionArancelaria, fa.nombreFraccionArancelaria, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario, pa.pais_nombre
					FROM export_import AS ie
					JOIN fraccion_arancelaria AS fa ON fa.idFraccionArancelaria = ie.idFraccionArancelaria
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso = :fechaReporte
					AND ui.estado = "0"
					GROUP BY ie.idFraccionArancelaria, pa.codigo_pais
					ORDER BY sum(ie.cantidad) DESC
				');
			}
			else if($formato == 3) 
			{
				$stmt = $this->_db->prepare('
					SELECT fa.codigoFraccionArancelaria, fa.nombreFraccionArancelaria, ie.cantidad AS cantidad, ie.valorMonetario AS valorMonetario, pa.pais_nombre
					FROM export_import AS ie
					JOIN fraccion_arancelaria AS fa ON fa.idFraccionArancelaria = ie.idFraccionArancelaria
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso = :fechaReporte
					AND ui.estado = "0"
					ORDER BY ie.cantidad DESC
				');	
			} 
			else 
			{
				$stmt = $this->_db->prepare('
					SELECT * FROM (
						SELECT pa.pais, pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
						FROM export_import AS ie
						JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
						JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
						WHERE ie.idTipoIngreso = :tipo
						AND ie.fechaIngreso = :fechaReporte
						AND ui.estado = "0"
						GROUP BY pa.codigo_pais
						ORDER BY sum(ie.cantidad) DESC
						LIMIT 22
					) AS TM

					UNION

					SELECT "N/A","Otros", FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
					FROM export_import AS ie
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso = :fechaReporte
					AND ui.estado = "0"
					AND pa.pais_nombre NOT IN (
						SELECT pais_nombre FROM ( 
							SELECT pa.pais, pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
							FROM export_import AS ie
							JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
							JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
							WHERE ie.idTipoIngreso = :tipo
							AND ie.fechaIngreso = :fechaReporte
							AND ui.estado = "0"
							AND pa.codigo_pais IS NOT NULL
							GROUP BY pa.codigo_pais
							ORDER BY sum(ie.cantidad) DESC 
							LIMIT 22
						) AS T1
					)
				');
			}
			$stmt->execute(array(':tipo' => $tipo, 'fechaReporte' => $fechaReporte));
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function listarReporteAdmin($formato, $tipo, $mesInicio, $mesFin, $anio) {

		$fechaInicio = $anio.'-'.$mesInicio.'-01';
		$fechaFin = $anio.'-'.$mesFin.'-01';

		try {
			if($formato == 1) {
				$stmt = $this->_db->prepare('
					SELECT fa.codigoFraccionArancelaria, fa.nombreFraccionArancelaria, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario, pa.pais_nombre
					FROM export_import AS ie
					JOIN fraccion_arancelaria AS fa ON fa.idFraccionArancelaria = ie.idFraccionArancelaria
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso BETWEEN :fechaInicio AND :fechaFin
					AND ui.estado = "0"
					GROUP BY ie.idFraccionArancelaria, pa.codigo_pais
					ORDER BY sum(ie.cantidad) DESC
				');
			}
			else if($formato == 3) 
			{
				$stmt = $this->_db->prepare('
					SELECT fa.codigoFraccionArancelaria, fa.nombreFraccionArancelaria, ie.cantidad AS cantidad, ie.valorMonetario AS valorMonetario, pa.pais_nombre, ie.fechaIngreso
					FROM export_import AS ie
					JOIN fraccion_arancelaria AS fa ON fa.idFraccionArancelaria = ie.idFraccionArancelaria
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso BETWEEN :fechaInicio AND :fechaFin
					AND ui.estado = "0"
					ORDER BY ie.cantidad DESC
				');	
			} 
			else 
			{
				$stmt = $this->_db->prepare('
					SELECT * FROM (
						SELECT pa.pais, pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
						FROM export_import AS ie
						JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
						JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
						WHERE ie.idTipoIngreso = :tipo
						AND ie.fechaIngreso BETWEEN :fechaInicio AND :fechaFin
						AND ui.estado = "0"
						GROUP BY pa.codigo_pais
						ORDER BY sum(ie.cantidad) DESC
						LIMIT 22
					) AS TM

					UNION

					SELECT "N/A","Otros", FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
					FROM export_import AS ie
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso BETWEEN :fechaInicio AND :fechaFin
					AND ui.estado = "0"
					AND pa.pais_nombre NOT IN (
						SELECT pais_nombre FROM ( 
							SELECT pa.pais, pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
							FROM export_import AS ie
							JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
							JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
							WHERE ie.idTipoIngreso = :tipo
							AND ie.fechaIngreso BETWEEN :fechaInicio AND :fechaFin
							AND ui.estado = "0"
							AND pa.codigo_pais IS NOT NULL
							GROUP BY pa.codigo_pais
							ORDER BY sum(ie.cantidad) DESC 
							LIMIT 22
						) AS T1
					)
				');
			}
			$stmt->execute(array(':tipo' => $tipo, 'fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin));
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}


	public function listarReporteAnual($formato, $tipo, $anio) {

		$anioReporte = $anio.'%';

		try {
			if($formato == 1) {
				$stmt = $this->_db->prepare('
					SELECT fa.codigoFraccionArancelaria, fa.nombreFraccionArancelaria, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario, pa.pais_nombre
					FROM export_import AS ie
					JOIN fraccion_arancelaria AS fa ON fa.idFraccionArancelaria = ie.idFraccionArancelaria
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso LIKE :anioReporte
					AND ui.estado = "0"
					GROUP BY ie.idFraccionArancelaria, pa.codigo_pais
					ORDER BY sum(ie.cantidad) DESC
				');
			} else {
				$stmt = $this->_db->prepare('
					SELECT * FROM (
						SELECT pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
						FROM export_import AS ie
						JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
						JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
						WHERE ie.idTipoIngreso = :tipo
						AND ie.fechaIngreso LIKE :anioReporte
						AND ui.estado = "0"
						GROUP BY pa.codigo_pais
						ORDER BY sum(ie.cantidad) DESC
						LIMIT 22
					) AS TM

					UNION

					SELECT "Otros", FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
					FROM export_import AS ie
					JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
					JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
					WHERE ie.idTipoIngreso = :tipo
					AND ie.fechaIngreso LIKE :anioReporte
					AND ui.estado = "0"
					AND pa.pais_nombre NOT IN (
						SELECT pais_nombre FROM ( 
							SELECT pa.pais_nombre, FORMAT(sum(ie.cantidad),2) AS cantidad, FORMAT(sum(ie.valorMonetario),2) AS valorMonetario
							FROM export_import AS ie
							JOIN paises AS pa ON pa.codigo_pais = ie.codigo_pais
							JOIN usuario_ingreso AS ui ON ui.idArchivo = ie.idArchivo
							WHERE ie.idTipoIngreso = :tipo
							AND ie.fechaIngreso LIKE :anioReporte
							AND ui.estado = "0"
							AND pa.codigo_pais IS NOT NULL
							GROUP BY pa.codigo_pais
							ORDER BY sum(ie.cantidad) DESC 
							LIMIT 22
						) AS T1
					)
				');
			}
			$stmt->execute(array(':tipo' => $tipo, 'anioReporte' => $anioReporte));
			
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}



	// FUNCIONES PARA SUPERUSUARIO

    public function listarUsuarios() {
    	try {
			$stmt = $this->_db->prepare('
				CALL sp_consulta_usuarios_registrados()
			');
			$stmt->execute();		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
    }

    public function listarArchivos() {
    	try {
			$stmt = $this->_db->prepare('
				CALL sp_consulta_archivos()
			');
			$stmt->execute();		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
    }

	public function listarPosiciones() {
		require 'conexion.php';
		$idUltimoTorneo = mysqli_query($conexion, "SELECT MAX(idTorneo) as UltimoTorneo from torneos");
		$datos = $idUltimoTorneo->fetch_assoc();
		$idTorneoActual = $datos['UltimoTorneo'];
		try {
			$stmt = $this->_db->prepare('
				SELECT nombreEquipo, puntos
				FROM equipos
				WHERE idTorneo = :idTorneoActual
				ORDER BY puntos DESC
				
			');
			$stmt->execute(array(':idTorneoActual' => $idTorneoActual));		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function listarImportacionesUsuarios() {

		try {
			$stmt = $this->_db->prepare('
				SELECT b.nombre, b.apellido, a.fecha_ingreso, a.fechaArchivo, c.tipoIngreso
				FROM usuario b
				INNER JOIN usuario_ingreso a ON a.idUsuario = b.idUsuario
				INNER JOIN tipo_ingreso c ON a.idTipoIngreso = c.idTipoIngreso 
				ORDER BY a.fecha_ingreso ASC
			');
			$stmt->execute();		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function listarArchivosEliminados() {

		try {
			$stmt = $this->_db->prepare('
				SELECT a.idArchivo, a.fechaArchivo, b.tipoIngreso, a.fecha_ingreso, c.fecha
				FROM usuario_ingreso a
				INNER JOIN tipo_ingreso b ON a.idTipoIngreso = b.idTipoIngreso
				INNER JOIN log_eliminar c ON a.idArchivo = c.idArchivo 
				ORDER BY a.fecha_ingreso ASC
			');
			$stmt->execute();		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}


	public function listarGallosEquipo($idEquipo) {

		try {
			$stmt = $this->_db->prepare('
			SELECT b.nombreEquipo, a.chapa, a.peso, a.descripcion
			FROM gallos a
			INNER JOIN equipos b ON a.idEquipos = b.idEquipos
			WHERE a.idEquipos = :idEquipo 
			');
			$stmt->execute(array(':idEquipo' => $idEquipo));		
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $row;
		} 
		catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

}

?>