<?php 
include_once 'api.php';
$api = new API();

if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(is_numeric($id)){
		if ($id == 1) {
			// 1) GET TIPOS DE COMPROBANTES DISPONIBLES
			$api->voucher_types();
		} elseif ($id == 2) {
			// 2) GET TIPOS DE CONCEPTOS DISPONIBLES
			$api->concept_types();
		} elseif ($id == 3) {
			// 3) GET TIPOS DE DOCUMENTOS DISPONIBLES
			$api->document_types();
		} elseif ($id == 4) {
			// 4) GET ALICUOTAS DISPONIBLES
			$api->aloquot_types();
		} elseif ($id == 5) {
			// 5) GET TIPOS DE MONEDAS DISPONIBLES
			$api->currencies_types();
		} elseif ($id == 6) {
			// 6) GET TIPOS DE OPCIONES DISPONIBLES PARA EL COMOPROBANTE
			$api->option_types();
		} elseif ($id == 7) {
			// 7) GET TIPOS DE TRIBUTOS DISPONIBLES
			$api->tax_types();
		} elseif ($id == 8) {
			// 8) FORMATO DE FECHA yyyymmdd => yyyy-mm-dd
			$api->date();
		} elseif ($id == 9) {
			// 9) ESTADO DEL SERVIDOR
			$api->server_status();
		} elseif ($id == 10) {
			// 10) OBTENER INFORMACION DEL COMPROBANTE >>>>>> http://localhost/api/?id=10&nro_comp=1&pto_venta=1&tipo_comp=6
			if ($_GET['nro_comp'] AND $_GET['pto_venta'] AND $_GET['tipo_comp']) {
				$api->voucher_info($_GET['nro_comp'], $_GET['pto_venta'], $_GET['tipo_comp']);
			}
		} elseif ($id == 11) {
			// 11) OBTENER NUMERO DEL ULTIMO COMPROBANTE >>>>>> http://localhost/api/?id=11&pto_venta=1&tipo_comp=6
			if ($_GET['pto_venta'] AND $_GET['tipo_comp']) {
				$api->last_voucher($_GET["pto_venta"], $_GET["tipo_comp"]);
			}
		} elseif ($id == 12) {
			// 12) CREAR Y ASIGNAR CAE A UN COMPROBANTE >>>>>> http://localhost/api/?id=12&pto_venta=1&tipo_comp=6
			if ($_GET['pto_venta'] AND $_GET['tipo_comp']) {
				$id_ult_comp = $api->last_voucher($_GET["pto_venta"], $_GET["tipo_comp"]);
		        $new_id_comp = $id_ult_comp + 1;
		        $data = array(
		            'CantReg'   => 1,  // Cantidad de comprobantes a registrar
		            'PtoVta'    => 1,  // Punto de venta
		            'CbteTipo'  => 6,  // Tipo de comprobante (ver tipos disponibles) 
		            'Concepto'  => 1,  // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
		            'DocTipo'   => 99, // Tipo de documento del comprador (99 consumidor final, ver tipos disponibles)
		            'DocNro'    => 0,  // Número de documento del comprador (0 consumidor final)
		            'CbteDesde' => $new_id_comp,  // Número de comprobante o numero del primer comprobante en caso de ser mas de uno
		            'CbteHasta' => $new_id_comp,  // Número de comprobante o numero del último comprobante en caso de ser mas de uno
		            'CbteFch'   => intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
		            'ImpTotal'  => 121, // Importe total del comprobante
		            'ImpTotConc'=> 0,   // Importe neto no gravado
		            'ImpNeto'   => 100, // Importe neto gravado
		            'ImpOpEx'   => 0,   // Importe exento de IVA
		            'ImpIVA'    => 21,  //Importe total de IVA
		            'ImpTrib'   => 0,   //Importe total de tributos
		            'MonId'     => 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos) 
		            'MonCotiz'  => 1,     // Cotización de la moneda usada (1 para pesos argentinos)  
		            'Iva'       => array( // (Opcional) Alícuotas asociadas al comprobante
		                array(
		                    'Id'     => 5, // Id del tipo de IVA (5 para 21%)(ver tipos disponibles) 
		                    'BaseImp'=> 100, // Base imponible
		                    'Importe'=> 21 // Importe 
		                )
		            ), 
		        );
				$api->voucher_create($data);
			}
		} elseif ($id == 13) {
			// 13) CREAR Y ASIGNAR CAE A SIGUIENTE COMPROBANTE
			$api->voucher_create_next($array);
		}
	}else{
		$api->error('Los parametros deben ser numericos');
	}
}else{
	$api->error('No es posible obtener esa informacion');
}
?>