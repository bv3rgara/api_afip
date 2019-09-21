<?php
include("Afip.php");

class API{
	function printJSON($array){
		echo '<code>'.json_encode($array).'</code>';
	}

	function error($mensaje){
		echo '<code>'.json_encode(array('mensaje' => $mensaje)).'</code>';
	}

	// 1) GET TIPOS DE COMPROBANTES DISPONIBLES
	function voucher_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetVoucherTypes();
		$this->printJSON($afip);
	}

	// 2) GET TIPOS DE CONCEPTOS DISPONIBLES
	function concept_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetConceptTypes();
		$this->printJSON($afip);
	}

	// 3) GET TIPOS DE DOCUMENTOS DISPONIBLES
	function document_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetDocumentTypes();
		$this->printJSON($afip);
	}

	// 4) GET ALICUOTAS DISPONIBLES
	function aloquot_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetAliquotTypes();
		$this->printJSON($afip);
	}

	// 5) GET TIPOS DE MONEDAS DISPONIBLES
	function currencies_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetCurrenciesTypes();
		$this->printJSON($afip);
	}

	// 6) GET TIPOS DE OPCIONES DISPONIBLES PARA EL COMOPROBANTE
	function option_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetOptionsTypes();
		$this->printJSON($afip);
	}

	// 7) GET TIPOS DE TRIBUTOS DISPONIBLES
	function tax_types(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetTaxTypes();
		$this->printJSON($afip);
	}

	// 8) FORMATO DE FECHA yyyymmdd => yyyy-mm-dd
	function date(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->FormatDate('20190427'); //1997-05-08
		$this->printJSON($afip);
	}

	// 9) ESTADO DEL SERVIDOR
	function server_status(){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetServerStatus();
		$this->printJSON($afip);
	}

	// 10) OBTENER INFORMACION DEL COMPROBANTE
	function voucher_info($nro_comp, $pto_venta, $tipo_comp){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetVoucherInfo($nro_comp, $pto_venta, $tipo_comp);
		$this->printJSON($afip);
	}

	// 11) OBTENER NUMERO DEL ULTIMO COMPROBANTE
	function last_voucher($pto_venta, $tipo_comp){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->GetLastVoucher($pto_venta, $tipo_comp);
		$this->printJSON($afip);
	}

	// 12) CREAR Y ASIGNAR CAE A UN COMPROBANTE
	function voucher_create($array){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->CreateVoucher($array, TRUE);
		$this->printJSON($afip);
	}

	// 13) CREAR Y ASIGNAR CAE A SIGUIENTE COMPROBANTE
	function voucher_create_next($array){
		$class_afip = new Afip(array('CUIT' => 20056602349));
		$afip = $class_afip->ElectronicBilling->CreateNextVoucher($array);
		$this->printJSON($afip);
	}
}
?>