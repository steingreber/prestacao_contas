<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php require_once("clsTexto.php") ?>
<?php

// Global variable for table object
$report_parceria_repasse = NULL;


//echo $recebe_ano;
//
// Table class for report_parceria_repasse
//
class creport_parceria_repasse extends cTableBase {
	var $pExercicio;
	var $pTermoNumero;
	var $pNumero;
	var $pInicioVigencia;
	var $pFimVigencia;
	var $pData;
	var $pValor;
	var $pObjeto;
	var $pMetas;
	var $pOrigem;
	var $pEntidadeEdereco;
	var $pEntidadeEstatuto;
	var $pEntidadeLei;
	var $pEntidadeCebas;
	var $pRespNome;
	var $pRespCargo;
	var $pRespEdereco;
	var $pRespContato;
	var $pRespAta;
	var $pContNome;
	var $pContEndereco;
	var $pContContato;
	var $pContDocumento;
	var $pPrencherNome;
	var $pPrencherCargo;
	var $pPrencherEndereco;
	var $pPrencherContato;
	var $pPrencherDocumento;
	var $rIDRepasse;
	var $rFaixaEtaria;
	var $rMeta;
	var $rValorUnitario;
	var $rValorMensal;
	var $rValorPrevisto;
	var $repasse;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'report_parceria_repasse';
		$this->TableName = 'report_parceria_repasse';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`view_parceira_repase`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// pExercicio
		$this->pExercicio = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pExercicio', 'pExercicio', '`pExercicio`', '`pExercicio`', 3, -1, FALSE, '`pExercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pExercicio->Sortable = FALSE; // Allow sort
		$this->pExercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pExercicio'] = &$this->pExercicio;

		// pTermoNumero
		$this->pTermoNumero = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pTermoNumero', 'pTermoNumero', '`pTermoNumero`', '`pTermoNumero`', 200, -1, FALSE, '`pTermoNumero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pTermoNumero->Sortable = FALSE; // Allow sort
		$this->fields['pTermoNumero'] = &$this->pTermoNumero;

		// pNumero
		$this->pNumero = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pNumero', 'pNumero', '`pNumero`', '`pNumero`', 200, -1, FALSE, '`pNumero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pNumero->Sortable = FALSE; // Allow sort
		$this->fields['pNumero'] = &$this->pNumero;

		// pInicioVigencia
		$this->pInicioVigencia = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pInicioVigencia', 'pInicioVigencia', '`pInicioVigencia`', ew_CastDateFieldForLike('`pInicioVigencia`', 7, "DB"), 133, 7, FALSE, '`pInicioVigencia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pInicioVigencia->Sortable = FALSE; // Allow sort
		$this->pInicioVigencia->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pInicioVigencia'] = &$this->pInicioVigencia;

		// pFimVigencia
		$this->pFimVigencia = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pFimVigencia', 'pFimVigencia', '`pFimVigencia`', ew_CastDateFieldForLike('`pFimVigencia`', 7, "DB"), 133, 7, FALSE, '`pFimVigencia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pFimVigencia->Sortable = FALSE; // Allow sort
		$this->pFimVigencia->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pFimVigencia'] = &$this->pFimVigencia;

		// pData
		$this->pData = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pData', 'pData', '`pData`', ew_CastDateFieldForLike('`pData`', 7, "DB"), 133, 7, FALSE, '`pData`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pData->Sortable = FALSE; // Allow sort
		$this->pData->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['pData'] = &$this->pData;

		// pValor
		$this->pValor = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pValor', 'pValor', '`pValor`', '`pValor`', 5, -1, FALSE, '`pValor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pValor->Sortable = FALSE; // Allow sort
		$this->pValor->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pValor'] = &$this->pValor;

		// pObjeto
		$this->pObjeto = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pObjeto', 'pObjeto', '`pObjeto`', '`pObjeto`', 201, -1, FALSE, '`pObjeto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pObjeto->Sortable = FALSE; // Allow sort
		$this->fields['pObjeto'] = &$this->pObjeto;

		// pMetas
		$this->pMetas = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pMetas', 'pMetas', '`pMetas`', '`pMetas`', 201, -1, FALSE, '`pMetas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pMetas->Sortable = FALSE; // Allow sort
		$this->fields['pMetas'] = &$this->pMetas;

		// pOrigem
		$this->pOrigem = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pOrigem', 'pOrigem', '`pOrigem`', '`pOrigem`', 200, -1, FALSE, '`pOrigem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pOrigem->Sortable = FALSE; // Allow sort
		$this->fields['pOrigem'] = &$this->pOrigem;

		// pEntidadeEdereco
		$this->pEntidadeEdereco = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pEntidadeEdereco', 'pEntidadeEdereco', '`pEntidadeEdereco`', '`pEntidadeEdereco`', 200, -1, FALSE, '`pEntidadeEdereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeEdereco->Sortable = FALSE; // Allow sort
		$this->fields['pEntidadeEdereco'] = &$this->pEntidadeEdereco;

		// pEntidadeEstatuto
		$this->pEntidadeEstatuto = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pEntidadeEstatuto', 'pEntidadeEstatuto', '`pEntidadeEstatuto`', '`pEntidadeEstatuto`', 205, -1, TRUE, '`pEntidadeEstatuto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->pEntidadeEstatuto->Sortable = FALSE; // Allow sort
		$this->fields['pEntidadeEstatuto'] = &$this->pEntidadeEstatuto;

		// pEntidadeLei
		$this->pEntidadeLei = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pEntidadeLei', 'pEntidadeLei', '`pEntidadeLei`', '`pEntidadeLei`', 200, -1, FALSE, '`pEntidadeLei`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeLei->Sortable = FALSE; // Allow sort
		$this->fields['pEntidadeLei'] = &$this->pEntidadeLei;

		// pEntidadeCebas
		$this->pEntidadeCebas = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pEntidadeCebas', 'pEntidadeCebas', '`pEntidadeCebas`', '`pEntidadeCebas`', 200, -1, FALSE, '`pEntidadeCebas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeCebas->Sortable = FALSE; // Allow sort
		$this->fields['pEntidadeCebas'] = &$this->pEntidadeCebas;

		// pRespNome
		$this->pRespNome = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pRespNome', 'pRespNome', '`pRespNome`', '`pRespNome`', 200, -1, FALSE, '`pRespNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespNome->Sortable = FALSE; // Allow sort
		$this->fields['pRespNome'] = &$this->pRespNome;

		// pRespCargo
		$this->pRespCargo = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pRespCargo', 'pRespCargo', '`pRespCargo`', '`pRespCargo`', 200, -1, FALSE, '`pRespCargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespCargo->Sortable = FALSE; // Allow sort
		$this->fields['pRespCargo'] = &$this->pRespCargo;

		// pRespEdereco
		$this->pRespEdereco = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pRespEdereco', 'pRespEdereco', '`pRespEdereco`', '`pRespEdereco`', 200, -1, FALSE, '`pRespEdereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespEdereco->Sortable = FALSE; // Allow sort
		$this->fields['pRespEdereco'] = &$this->pRespEdereco;

		// pRespContato
		$this->pRespContato = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pRespContato', 'pRespContato', '`pRespContato`', '`pRespContato`', 200, -1, FALSE, '`pRespContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespContato->Sortable = FALSE; // Allow sort
		$this->fields['pRespContato'] = &$this->pRespContato;

		// pRespAta
		$this->pRespAta = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pRespAta', 'pRespAta', '`pRespAta`', '`pRespAta`', 200, -1, FALSE, '`pRespAta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespAta->Sortable = FALSE; // Allow sort
		$this->fields['pRespAta'] = &$this->pRespAta;

		// pContNome
		$this->pContNome = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pContNome', 'pContNome', '`pContNome`', '`pContNome`', 200, -1, FALSE, '`pContNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContNome->Sortable = FALSE; // Allow sort
		$this->fields['pContNome'] = &$this->pContNome;

		// pContEndereco
		$this->pContEndereco = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pContEndereco', 'pContEndereco', '`pContEndereco`', '`pContEndereco`', 200, -1, FALSE, '`pContEndereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContEndereco->Sortable = FALSE; // Allow sort
		$this->fields['pContEndereco'] = &$this->pContEndereco;

		// pContContato
		$this->pContContato = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pContContato', 'pContContato', '`pContContato`', '`pContContato`', 200, -1, FALSE, '`pContContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContContato->Sortable = FALSE; // Allow sort
		$this->fields['pContContato'] = &$this->pContContato;

		// pContDocumento
		$this->pContDocumento = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pContDocumento', 'pContDocumento', '`pContDocumento`', '`pContDocumento`', 200, -1, FALSE, '`pContDocumento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContDocumento->Sortable = FALSE; // Allow sort
		$this->fields['pContDocumento'] = &$this->pContDocumento;

		// pPrencherNome
		$this->pPrencherNome = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pPrencherNome', 'pPrencherNome', '`pPrencherNome`', '`pPrencherNome`', 200, -1, FALSE, '`pPrencherNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherNome->Sortable = FALSE; // Allow sort
		$this->fields['pPrencherNome'] = &$this->pPrencherNome;

		// pPrencherCargo
		$this->pPrencherCargo = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pPrencherCargo', 'pPrencherCargo', '`pPrencherCargo`', '`pPrencherCargo`', 200, -1, FALSE, '`pPrencherCargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherCargo->Sortable = FALSE; // Allow sort
		$this->fields['pPrencherCargo'] = &$this->pPrencherCargo;

		// pPrencherEndereco
		$this->pPrencherEndereco = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pPrencherEndereco', 'pPrencherEndereco', '`pPrencherEndereco`', '`pPrencherEndereco`', 200, -1, FALSE, '`pPrencherEndereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherEndereco->Sortable = FALSE; // Allow sort
		$this->fields['pPrencherEndereco'] = &$this->pPrencherEndereco;

		// pPrencherContato
		$this->pPrencherContato = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pPrencherContato', 'pPrencherContato', '`pPrencherContato`', '`pPrencherContato`', 200, -1, FALSE, '`pPrencherContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherContato->Sortable = FALSE; // Allow sort
		$this->fields['pPrencherContato'] = &$this->pPrencherContato;

		// pPrencherDocumento
		$this->pPrencherDocumento = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_pPrencherDocumento', 'pPrencherDocumento', '`pPrencherDocumento`', '`pPrencherDocumento`', 200, -1, FALSE, '`pPrencherDocumento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherDocumento->Sortable = FALSE; // Allow sort
		$this->fields['pPrencherDocumento'] = &$this->pPrencherDocumento;

		// rIDRepasse
		$this->rIDRepasse = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rIDRepasse', 'rIDRepasse', '`rIDRepasse`', '`rIDRepasse`', 3, -1, FALSE, '`rIDRepasse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rIDRepasse->Sortable = FALSE; // Allow sort
		$this->rIDRepasse->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rIDRepasse'] = &$this->rIDRepasse;

		// rFaixaEtaria
		$this->rFaixaEtaria = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rFaixaEtaria', 'rFaixaEtaria', '`rFaixaEtaria`', '`rFaixaEtaria`', 200, -1, FALSE, '`rFaixaEtaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rFaixaEtaria->Sortable = FALSE; // Allow sort
		$this->fields['rFaixaEtaria'] = &$this->rFaixaEtaria;

		// rMeta
		$this->rMeta = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rMeta', 'rMeta', '`rMeta`', '`rMeta`', 3, -1, FALSE, '`rMeta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rMeta->Sortable = FALSE; // Allow sort
		$this->rMeta->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rMeta'] = &$this->rMeta;

		// rValorUnitario
		$this->rValorUnitario = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rValorUnitario', 'rValorUnitario', '`rValorUnitario`', '`rValorUnitario`', 5, -1, FALSE, '`rValorUnitario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorUnitario->Sortable = FALSE; // Allow sort
		$this->rValorUnitario->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorUnitario'] = &$this->rValorUnitario;

		// rValorMensal
		$this->rValorMensal = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rValorMensal', 'rValorMensal', '`rValorMensal`', '`rValorMensal`', 5, -1, FALSE, '`rValorMensal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorMensal->Sortable = FALSE; // Allow sort
		$this->rValorMensal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorMensal'] = &$this->rValorMensal;

		// rValorPrevisto
		$this->rValorPrevisto = new cField('report_parceria_repasse', 'report_parceria_repasse', 'x_rValorPrevisto', 'rValorPrevisto', '`rValorPrevisto`', '`rValorPrevisto`', 5, -1, FALSE, '`rValorPrevisto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorPrevisto->Sortable = FALSE; // Allow sort
		$this->rValorPrevisto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorPrevisto'] = &$this->rValorPrevisto;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Report group level SQL
	var $_SqlGroupSelect = "";

	function getSqlGroupSelect() { // Select
		$recebe_ano =  intval($_GET['ano']);
		//echo ">>SELECT DISTINCT pExercicio FROM view_parceira_repase WHERE pExercicio = $recebe_ano";
			
		return ($this->_SqlGroupSelect <> "") ? $this->_SqlGroupSelect : "SELECT DISTINCT pExercicio FROM view_parceira_repase WHERE pExercicio = $recebe_ano";
	}

	function SqlGroupSelect() { // For backward compatibility
		return $this->getSqlGroupSelect();
	}

	function setSqlGroupSelect($v) {
		$this->_SqlGroupSelect = $v;
	}
	var $_SqlGroupWhere = "";

	function getSqlGroupWhere() { // Where
		return ($this->_SqlGroupWhere <> "") ? $this->_SqlGroupWhere : "";
	}

	function SqlGroupWhere() { // For backward compatibility
		return $this->getSqlGroupWhere();
	}

	function setSqlGroupWhere($v) {
		$this->_SqlGroupWhere = $v;
	}
	var $_SqlGroupGroupBy = "";

	function getSqlGroupGroupBy() { // Group By
		return ($this->_SqlGroupGroupBy <> "") ? $this->_SqlGroupGroupBy : "";
	}

	function SqlGroupGroupBy() { // For backward compatibility
		return $this->getSqlGroupGroupBy();
	}

	function setSqlGroupGroupBy($v) {
		$this->_SqlGroupGroupBy = $v;
	}
	var $_SqlGroupHaving = "";

	function getSqlGroupHaving() { // Having
		return ($this->_SqlGroupHaving <> "") ? $this->_SqlGroupHaving : "";
	}

	function SqlGroupHaving() { // For backward compatibility
		return $this->getSqlGroupHaving();
	}

	function setSqlGroupHaving($v) {
		$this->_SqlGroupHaving = $v;
	}
	var $_SqlGroupOrderBy = "";

	function getSqlGroupOrderBy() { // Order By
		return ($this->_SqlGroupOrderBy <> "") ? $this->_SqlGroupOrderBy : "`pExercicio` ASC";
	}

	function SqlGroupOrderBy() { // For backward compatibility
		return $this->getSqlGroupOrderBy();
	}

	function setSqlGroupOrderBy($v) {
		$this->_SqlGroupOrderBy = $v;
	}

	// Report detail level SQL
	var $_SqlDetailSelect = "";

	function getSqlDetailSelect() { // Select
		return ($this->_SqlDetailSelect <> "") ? $this->_SqlDetailSelect : "SELECT * FROM `view_parceira_repase`";
	}

	function SqlDetailSelect() { // For backward compatibility
		return $this->getSqlDetailSelect();
	}

	function setSqlDetailSelect($v) {
		$this->_SqlDetailSelect = $v;
	}
	var $_SqlDetailWhere = "";

	function getSqlDetailWhere() { // Where
		return ($this->_SqlDetailWhere <> "") ? $this->_SqlDetailWhere : "";
	}

	function SqlDetailWhere() { // For backward compatibility
		return $this->getSqlDetailWhere();
	}

	function setSqlDetailWhere($v) {
		$this->_SqlDetailWhere = $v;
	}
	var $_SqlDetailGroupBy = "";

	function getSqlDetailGroupBy() { // Group By
		return ($this->_SqlDetailGroupBy <> "") ? $this->_SqlDetailGroupBy : "";
	}

	function SqlDetailGroupBy() { // For backward compatibility
		return $this->getSqlDetailGroupBy();
	}

	function setSqlDetailGroupBy($v) {
		$this->_SqlDetailGroupBy = $v;
	}
	var $_SqlDetailHaving = "";

	function getSqlDetailHaving() { // Having
		return ($this->_SqlDetailHaving <> "") ? $this->_SqlDetailHaving : "";
	}

	function SqlDetailHaving() { // For backward compatibility
		return $this->getSqlDetailHaving();
	}

	function setSqlDetailHaving($v) {
		$this->_SqlDetailHaving = $v;
	}
	var $_SqlDetailOrderBy = "";

	function getSqlDetailOrderBy() { // Order By
		return ($this->_SqlDetailOrderBy <> "") ? $this->_SqlDetailOrderBy : "`rFaixaEtaria` ASC";
	}

	function SqlDetailOrderBy() { // For backward compatibility
		return $this->getSqlDetailOrderBy();
	}

	function setSqlDetailOrderBy($v) {
		$this->_SqlDetailOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Report group SQL
	function GroupSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->getSqlGroupSelect(), $this->getSqlGroupWhere(),
			 $this->getSqlGroupGroupBy(), $this->getSqlGroupHaving(),
			 $this->getSqlGroupOrderBy(), $sFilter, $sSort);
	}

	// Report detail SQL
	function DetailSQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = "";
		return ew_BuildSelectSql($this->getSqlDetailSelect(), $this->getSqlDetailWhere(),
			$this->getSqlDetailGroupBy(), $this->getSqlDetailHaving(),
			$this->getSqlDetailOrderBy(), $sFilter, $sSort);
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "report_parceria_repassereport.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "")
			return $Language->Phrase("View");
		elseif ($pageName == "")
			return $Language->Phrase("Edit");
		elseif ($pageName == "")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "report_parceria_repassereport.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "?" . $this->UrlParm($parm);
		else
			$url = "";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$report_parceria_repasse_report = NULL; // Initialize page object first

class creport_parceria_repasse_report extends creport_parceria_repasse {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'report_parceria_repasse';

	// Page object name
	var $PageObjName = 'report_parceria_repasse_report';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (report_parceria_repasse)
		if (!isset($GLOBALS["report_parceria_repasse"]) || get_class($GLOBALS["report_parceria_repasse"]) == "creport_parceria_repasse") {
			$GLOBALS["report_parceria_repasse"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_parceria_repasse"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'report', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'report_parceria_repasse', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbOldSkipHeaderFooter = $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = TRUE;

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = $gbOldSkipHeaderFooter;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT_REPORT;
		if ($this->Export <> "" && array_key_exists($this->Export, $EW_EXPORT_REPORT)) {
			$sContent = ob_get_clean(); // ob_get_contents() and ob_end_clean()
			$fn = $EW_EXPORT_REPORT[$this->Export];
			$this->$fn($sContent);
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
	}
	var $ExportOptions; // Export options
	var $RecCnt = 0;
	var $RowCnt = 0; // For custom view tag
	var $ReportSql = "";
	var $ReportFilter = "";
	var $DefaultFilter = "";
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $MasterRecordExists;
	var $Command;
	var $DtlRecordCount;
	var $ReportGroups;
	var $ReportCounts;
	var $LevelBreak;
	var $ReportTotals;
	var $ReportMaxs;
	var $ReportMins;
	var $Recordset;
	var $DetailRecordset;
	var $RecordExists;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;
		$this->ReportGroups = &ew_InitArray(2, NULL);
		$this->ReportCounts = &ew_InitArray(2, 0);
		$this->LevelBreak = &ew_InitArray(2, FALSE);
		$this->ReportTotals = &ew_Init2DArray(2, 34, 0);
		$this->ReportMaxs = &ew_Init2DArray(2, 34, 0);
		$this->ReportMins = &ew_Init2DArray(2, 34, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Check level break
	function ChkLvlBreak() {
		$this->LevelBreak[1] = FALSE;
		if ($this->RecCnt == 0) { // Start Or End of Recordset
			$this->LevelBreak[1] = TRUE;
		} else {
			if (!ew_CompareValue($this->pExercicio->CurrentValue, $this->ReportGroups[0])) {
				$this->LevelBreak[1] = TRUE;
			}
		}
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->pValor->FormValue == $this->pValor->CurrentValue && is_numeric(ew_StrToFloat($this->pValor->CurrentValue)))
			$this->pValor->CurrentValue = ew_StrToFloat($this->pValor->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorUnitario->FormValue == $this->rValorUnitario->CurrentValue && is_numeric(ew_StrToFloat($this->rValorUnitario->CurrentValue)))
			$this->rValorUnitario->CurrentValue = ew_StrToFloat($this->rValorUnitario->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorMensal->FormValue == $this->rValorMensal->CurrentValue && is_numeric(ew_StrToFloat($this->rValorMensal->CurrentValue)))
			$this->rValorMensal->CurrentValue = ew_StrToFloat($this->rValorMensal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorPrevisto->FormValue == $this->rValorPrevisto->CurrentValue && is_numeric(ew_StrToFloat($this->rValorPrevisto->CurrentValue)))
			$this->rValorPrevisto->CurrentValue = ew_StrToFloat($this->rValorPrevisto->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// pExercicio
		// pTermoNumero
		// pNumero
		// pInicioVigencia
		// pFimVigencia
		// pData
		// pValor
		// pObjeto
		// pMetas
		// pOrigem
		// pEntidadeEdereco
		// pEntidadeEstatuto
		// pEntidadeLei
		// pEntidadeCebas
		// pRespNome
		// pRespCargo
		// pRespEdereco
		// pRespContato
		// pRespAta
		// pContNome
		// pContEndereco
		// pContContato
		// pContDocumento
		// pPrencherNome
		// pPrencherCargo
		// pPrencherEndereco
		// pPrencherContato
		// pPrencherDocumento
		// rIDRepasse
		// rFaixaEtaria
		// rMeta
		// rValorUnitario
		// rValorMensal
		// rValorPrevisto

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pExercicio
		$this->pExercicio->ViewValue = $this->pExercicio->CurrentValue;
		$this->pExercicio->ViewCustomAttributes = "";

		// pTermoNumero
		$this->pTermoNumero->ViewValue = $this->pTermoNumero->CurrentValue;
		$this->pTermoNumero->ViewCustomAttributes = "";

		// pNumero
		$this->pNumero->ViewValue = $this->pNumero->CurrentValue;
		$this->pNumero->ViewCustomAttributes = "";

		// pInicioVigencia
		$this->pInicioVigencia->ViewValue = $this->pInicioVigencia->CurrentValue;
		$this->pInicioVigencia->ViewValue = ew_FormatDateTime($this->pInicioVigencia->ViewValue, 7);
		$this->pInicioVigencia->CssStyle = "font-weight: bold;";
		$this->pInicioVigencia->ViewCustomAttributes = "";

		// pFimVigencia
		$this->pFimVigencia->ViewValue = $this->pFimVigencia->CurrentValue;
		$this->pFimVigencia->ViewValue = ew_FormatDateTime($this->pFimVigencia->ViewValue, 7);
		$this->pFimVigencia->CssStyle = "font-weight: bold;";
		$this->pFimVigencia->ViewCustomAttributes = "";

		// pData
		$this->pData->ViewValue = $this->pData->CurrentValue;
		$this->pData->ViewValue = ew_FormatDateTime($this->pData->ViewValue, 7);
		$this->pData->ViewCustomAttributes = "";

		// pValor
		$this->pValor->ViewValue = $this->pValor->CurrentValue;
		$this->pValor->ViewValue = ew_FormatCurrency($this->pValor->ViewValue, 2, -1, -2, -2);
		$this->pValor->CssStyle = "font-weight: bold;";
		$this->pValor->ViewCustomAttributes = "";

		// pObjeto
		$this->pObjeto->ViewValue = $this->pObjeto->CurrentValue;
		$this->pObjeto->ViewCustomAttributes = "";

		// pMetas
		$this->pMetas->ViewValue = $this->pMetas->CurrentValue;
		$this->pMetas->ViewCustomAttributes = "";

		// pOrigem
		$this->pOrigem->ViewValue = $this->pOrigem->CurrentValue;
		$this->pOrigem->ViewCustomAttributes = "";

		// pEntidadeEdereco
		$this->pEntidadeEdereco->ViewValue = $this->pEntidadeEdereco->CurrentValue;
		$this->pEntidadeEdereco->ViewCustomAttributes = "";

		// pEntidadeEstatuto
		if (!ew_Empty($this->pEntidadeEstatuto->Upload->DbValue)) {
			$this->pEntidadeEstatuto->ViewValue = " alt=" . $Language->Phrase("PrimaryKeyUnspecified");
			$this->pEntidadeEstatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->pEntidadeEstatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->pEntidadeEstatuto->ViewValue = "";
		}
		$this->pEntidadeEstatuto->ViewCustomAttributes = "";

		// pEntidadeLei
		$this->pEntidadeLei->ViewValue = $this->pEntidadeLei->CurrentValue;
		$this->pEntidadeLei->ViewCustomAttributes = "";

		// pEntidadeCebas
		$this->pEntidadeCebas->ViewValue = $this->pEntidadeCebas->CurrentValue;
		$this->pEntidadeCebas->ViewCustomAttributes = "";

		// pRespNome
		$this->pRespNome->ViewValue = $this->pRespNome->CurrentValue;
		$this->pRespNome->ViewCustomAttributes = "";

		// pRespCargo
		$this->pRespCargo->ViewValue = $this->pRespCargo->CurrentValue;
		$this->pRespCargo->ViewCustomAttributes = "";

		// pRespEdereco
		$this->pRespEdereco->ViewValue = $this->pRespEdereco->CurrentValue;
		$this->pRespEdereco->ViewCustomAttributes = "";

		// pRespContato
		$this->pRespContato->ViewValue = $this->pRespContato->CurrentValue;
		$this->pRespContato->ViewCustomAttributes = "";

		// pRespAta
		$this->pRespAta->ViewValue = $this->pRespAta->CurrentValue;
		$this->pRespAta->ViewCustomAttributes = "";

		// pContNome
		$this->pContNome->ViewValue = $this->pContNome->CurrentValue;
		$this->pContNome->ViewCustomAttributes = "";

		// pContEndereco
		$this->pContEndereco->ViewValue = $this->pContEndereco->CurrentValue;
		$this->pContEndereco->ViewCustomAttributes = "";

		// pContContato
		$this->pContContato->ViewValue = $this->pContContato->CurrentValue;
		$this->pContContato->ViewCustomAttributes = "";

		// pContDocumento
		$this->pContDocumento->ViewValue = $this->pContDocumento->CurrentValue;
		$this->pContDocumento->ViewCustomAttributes = "";

		// pPrencherNome
		$this->pPrencherNome->ViewValue = $this->pPrencherNome->CurrentValue;
		$this->pPrencherNome->ViewCustomAttributes = "";

		// pPrencherCargo
		$this->pPrencherCargo->ViewValue = $this->pPrencherCargo->CurrentValue;
		$this->pPrencherCargo->ViewCustomAttributes = "";

		// pPrencherEndereco
		$this->pPrencherEndereco->ViewValue = $this->pPrencherEndereco->CurrentValue;
		$this->pPrencherEndereco->ViewCustomAttributes = "";

		// pPrencherContato
		$this->pPrencherContato->ViewValue = $this->pPrencherContato->CurrentValue;
		$this->pPrencherContato->ViewCustomAttributes = "";

		// pPrencherDocumento
		$this->pPrencherDocumento->ViewValue = $this->pPrencherDocumento->CurrentValue;
		$this->pPrencherDocumento->ViewCustomAttributes = "";

		// rIDRepasse
		$this->rIDRepasse->ViewValue = $this->rIDRepasse->CurrentValue;
		$this->rIDRepasse->ViewCustomAttributes = "";

		// rFaixaEtaria
		$this->rFaixaEtaria->ViewValue = $this->rFaixaEtaria->CurrentValue;
		$this->rFaixaEtaria->ViewCustomAttributes = "";

		// rMeta
		$this->rMeta->ViewValue = $this->rMeta->CurrentValue;
		$this->rMeta->ViewCustomAttributes = "";

		// rValorUnitario
		$this->rValorUnitario->ViewValue = $this->rValorUnitario->CurrentValue;
		$this->rValorUnitario->ViewValue = ew_FormatCurrency($this->rValorUnitario->ViewValue, 2, -1, -2, -2);
		$this->rValorUnitario->CellCssStyle .= "text-align: right;";
		$this->rValorUnitario->ViewCustomAttributes = "";

		// rValorMensal
		$this->rValorMensal->ViewValue = $this->rValorMensal->CurrentValue;
		$this->rValorMensal->ViewValue = ew_FormatCurrency($this->rValorMensal->ViewValue, 2, -1, -2, -2);
		$this->rValorMensal->CellCssStyle .= "text-align: right;";
		$this->rValorMensal->ViewCustomAttributes = "";

		// rValorPrevisto
		$this->rValorPrevisto->ViewValue = $this->rValorPrevisto->CurrentValue;
		$this->rValorPrevisto->ViewValue = ew_FormatCurrency($this->rValorPrevisto->ViewValue, 2, -1, -2, -2);
		$this->rValorPrevisto->CellCssStyle .= "text-align: right;";
		$this->rValorPrevisto->ViewCustomAttributes = "";

			// pExercicio
			$this->pExercicio->LinkCustomAttributes = "";
			$this->pExercicio->HrefValue = "";
			$this->pExercicio->TooltipValue = "";

			// pTermoNumero
			$this->pTermoNumero->LinkCustomAttributes = "";
			$this->pTermoNumero->HrefValue = "";
			$this->pTermoNumero->TooltipValue = "";

			// pNumero
			$this->pNumero->LinkCustomAttributes = "";
			$this->pNumero->HrefValue = "";
			$this->pNumero->TooltipValue = "";

			// pInicioVigencia
			$this->pInicioVigencia->LinkCustomAttributes = "";
			$this->pInicioVigencia->HrefValue = "";
			$this->pInicioVigencia->TooltipValue = "";

			// pFimVigencia
			$this->pFimVigencia->LinkCustomAttributes = "";
			$this->pFimVigencia->HrefValue = "";
			$this->pFimVigencia->TooltipValue = "";

			// pData
			$this->pData->LinkCustomAttributes = "";
			$this->pData->HrefValue = "";
			$this->pData->TooltipValue = "";

			// pValor
			$this->pValor->LinkCustomAttributes = "";
			$this->pValor->HrefValue = "";
			$this->pValor->TooltipValue = "";

			// pObjeto
			$this->pObjeto->LinkCustomAttributes = "";
			$this->pObjeto->HrefValue = "";
			$this->pObjeto->TooltipValue = "";

			// pMetas
			$this->pMetas->LinkCustomAttributes = "";
			$this->pMetas->HrefValue = "";
			$this->pMetas->TooltipValue = "";

			// pOrigem
			$this->pOrigem->LinkCustomAttributes = "";
			$this->pOrigem->HrefValue = "";
			$this->pOrigem->TooltipValue = "";

			// pEntidadeEdereco
			$this->pEntidadeEdereco->LinkCustomAttributes = "";
			$this->pEntidadeEdereco->HrefValue = "";
			$this->pEntidadeEdereco->TooltipValue = "";

			// pEntidadeEstatuto
			$this->pEntidadeEstatuto->LinkCustomAttributes = "";
			if (!empty($this->pEntidadeEstatuto->Upload->DbValue)) {
				$this->pEntidadeEstatuto->HrefValue = "";
				$this->pEntidadeEstatuto->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->pEntidadeEstatuto->HrefValue = ew_FullUrl($this->pEntidadeEstatuto->HrefValue, "href");
			} else {
				$this->pEntidadeEstatuto->HrefValue = "";
			}
			$this->pEntidadeEstatuto->HrefValue2 = "";
			$this->pEntidadeEstatuto->TooltipValue = "";

			// pEntidadeLei
			$this->pEntidadeLei->LinkCustomAttributes = "";
			$this->pEntidadeLei->HrefValue = "";
			$this->pEntidadeLei->TooltipValue = "";

			// pEntidadeCebas
			$this->pEntidadeCebas->LinkCustomAttributes = "";
			$this->pEntidadeCebas->HrefValue = "";
			$this->pEntidadeCebas->TooltipValue = "";

			// pRespNome
			$this->pRespNome->LinkCustomAttributes = "";
			$this->pRespNome->HrefValue = "";
			$this->pRespNome->TooltipValue = "";

			// pRespCargo
			$this->pRespCargo->LinkCustomAttributes = "";
			$this->pRespCargo->HrefValue = "";
			$this->pRespCargo->TooltipValue = "";

			// pRespEdereco
			$this->pRespEdereco->LinkCustomAttributes = "";
			$this->pRespEdereco->HrefValue = "";
			$this->pRespEdereco->TooltipValue = "";

			// pRespContato
			$this->pRespContato->LinkCustomAttributes = "";
			$this->pRespContato->HrefValue = "";
			$this->pRespContato->TooltipValue = "";

			// pRespAta
			$this->pRespAta->LinkCustomAttributes = "";
			$this->pRespAta->HrefValue = "";
			$this->pRespAta->TooltipValue = "";

			// pContNome
			$this->pContNome->LinkCustomAttributes = "";
			$this->pContNome->HrefValue = "";
			$this->pContNome->TooltipValue = "";

			// pContEndereco
			$this->pContEndereco->LinkCustomAttributes = "";
			$this->pContEndereco->HrefValue = "";
			$this->pContEndereco->TooltipValue = "";

			// pContContato
			$this->pContContato->LinkCustomAttributes = "";
			$this->pContContato->HrefValue = "";
			$this->pContContato->TooltipValue = "";

			// pContDocumento
			$this->pContDocumento->LinkCustomAttributes = "";
			$this->pContDocumento->HrefValue = "";
			$this->pContDocumento->TooltipValue = "";

			// pPrencherNome
			$this->pPrencherNome->LinkCustomAttributes = "";
			$this->pPrencherNome->HrefValue = "";
			$this->pPrencherNome->TooltipValue = "";

			// pPrencherCargo
			$this->pPrencherCargo->LinkCustomAttributes = "";
			$this->pPrencherCargo->HrefValue = "";
			$this->pPrencherCargo->TooltipValue = "";

			// pPrencherEndereco
			$this->pPrencherEndereco->LinkCustomAttributes = "";
			$this->pPrencherEndereco->HrefValue = "";
			$this->pPrencherEndereco->TooltipValue = "";

			// pPrencherContato
			$this->pPrencherContato->LinkCustomAttributes = "";
			$this->pPrencherContato->HrefValue = "";
			$this->pPrencherContato->TooltipValue = "";

			// pPrencherDocumento
			$this->pPrencherDocumento->LinkCustomAttributes = "";
			$this->pPrencherDocumento->HrefValue = "";
			$this->pPrencherDocumento->TooltipValue = "";

			// rIDRepasse
			$this->rIDRepasse->LinkCustomAttributes = "";
			$this->rIDRepasse->HrefValue = "";
			$this->rIDRepasse->TooltipValue = "";

			// rFaixaEtaria
			$this->rFaixaEtaria->LinkCustomAttributes = "";
			$this->rFaixaEtaria->HrefValue = "";
			$this->rFaixaEtaria->TooltipValue = "";

			// rMeta
			$this->rMeta->LinkCustomAttributes = "";
			$this->rMeta->HrefValue = "";
			$this->rMeta->TooltipValue = "";

			// rValorUnitario
			$this->rValorUnitario->LinkCustomAttributes = "";
			$this->rValorUnitario->HrefValue = "";
			$this->rValorUnitario->TooltipValue = "";

			// rValorMensal
			$this->rValorMensal->LinkCustomAttributes = "";
			$this->rValorMensal->HrefValue = "";
			$this->rValorMensal->TooltipValue = "";

			// rValorPrevisto
			$this->rValorPrevisto->LinkCustomAttributes = "";
			$this->rValorPrevisto->HrefValue = "";
			$this->rValorPrevisto->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("report", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($report_parceria_repasse_report)) $report_parceria_repasse_report = new creport_parceria_repasse_report();

// Page init
$report_parceria_repasse_report->Page_Init();

// Page main
$report_parceria_repasse_report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

$repasse = 1;

// Page Rendering event
$report_parceria_repasse_report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($report_parceria_repasse->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<link rel="stylesheet" type="text/css" href="phpcss/meucss<?php echo $MyCor?>.css">


<?php } ?>
<?php
$report_parceria_repasse_report->DefaultFilter = "";
$report_parceria_repasse_report->ReportFilter = $report_parceria_repasse_report->DefaultFilter;
if ($report_parceria_repasse_report->DbDetailFilter <> "") {
	if ($report_parceria_repasse_report->ReportFilter <> "") $report_parceria_repasse_report->ReportFilter .= " AND ";
	$report_parceria_repasse_report->ReportFilter .= "(" . $report_parceria_repasse_report->DbDetailFilter . ")";
}
$ReportConn = &$report_parceria_repasse_report->Connection();

// Set up filter and load Group level sql
$report_parceria_repasse->CurrentFilter = $report_parceria_repasse_report->ReportFilter;
$report_parceria_repasse_report->ReportSql = $report_parceria_repasse->GroupSQL();

// Load recordset
$report_parceria_repasse_report->Recordset = $ReportConn->Execute($report_parceria_repasse_report->ReportSql);
$report_parceria_repasse_report->RecordExists = !$report_parceria_repasse_report->Recordset->EOF;
?>
<?php if ($report_parceria_repasse->Export == "") { ?>
<?php if ($report_parceria_repasse_report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $report_parceria_repasse_report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $report_parceria_repasse_report->ShowPageHeader(); ?>

<?php

// Get First Row
if ($report_parceria_repasse_report->RecordExists) {
	$report_parceria_repasse->pExercicio->setDbValue($report_parceria_repasse_report->Recordset->fields('pExercicio'));
	$report_parceria_repasse_report->ReportGroups[0] = $report_parceria_repasse->pExercicio->DbValue;
}
$report_parceria_repasse_report->RecCnt = 0;
$report_parceria_repasse_report->ReportCounts[0] = 0;
$report_parceria_repasse_report->ChkLvlBreak();
while (!$report_parceria_repasse_report->Recordset->EOF) {

	// Render for view
	$report_parceria_repasse->RowType = EW_ROWTYPE_VIEW;
	$report_parceria_repasse->ResetAttrs();
	$report_parceria_repasse_report->RenderRow();

	// Show group headers
	if ($report_parceria_repasse_report->LevelBreak[1]) { // Reset counter and aggregation
?>
	<!--<?php echo $report_parceria_repasse->pExercicio->FldCaption() ?></td>
	<td colspan="6" class="ewGroupName">
<span<?php echo $report_parceria_repasse->pExercicio->ViewAttributes() ?>>-->

<!--inicio dados -->

<?php include_once "report_navbar.php" ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center" style="background-color: #fff; box-shadow: 3px 3px 6px; border-radius:10px;">
		<br>	
		<div class="quadros">
				<h1>Parcerias Exercício <?php echo $report_parceria_repasse->pExercicio->ViewValue ?></h1>
			</div>
<?php
	}

	// Get detail records
	$report_parceria_repasse_report->ReportFilter = $report_parceria_repasse_report->DefaultFilter;
	if ($report_parceria_repasse_report->ReportFilter <> "") $report_parceria_repasse_report->ReportFilter .= " AND ";
	if (is_null($report_parceria_repasse->pExercicio->CurrentValue)) {
		$report_parceria_repasse_report->ReportFilter .= "(`pExercicio` IS NULL)";
	} else {
		$report_parceria_repasse_report->ReportFilter .= "(`pExercicio` = " . ew_QuotedValue($report_parceria_repasse->pExercicio->CurrentValue, EW_DATATYPE_NUMBER, $report_parceria_repasse_report->DBID) . ")";
	}
	if ($report_parceria_repasse_report->DbDetailFilter <> "") {
		if ($report_parceria_repasse_report->ReportFilter <> "")
			$report_parceria_repasse_report->ReportFilter .= " AND ";
		$report_parceria_repasse_report->ReportFilter .= "(" . $report_parceria_repasse_report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$report_parceria_repasse->CurrentFilter = $report_parceria_repasse_report->ReportFilter;
	$report_parceria_repasse_report->ReportSql = $report_parceria_repasse->DetailSQL();

	// Load detail records
	$report_parceria_repasse_report->DetailRecordset = $ReportConn->Execute($report_parceria_repasse_report->ReportSql);
	$report_parceria_repasse_report->DtlRecordCount = $report_parceria_repasse_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$report_parceria_repasse_report->DetailRecordset->EOF) {
		$report_parceria_repasse_report->RecCnt++;
		$report_parceria_repasse->rMeta->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rMeta'));
		$report_parceria_repasse->rValorUnitario->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorUnitario'));
		$report_parceria_repasse->rValorMensal->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorMensal'));
		$report_parceria_repasse->rValorPrevisto->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorPrevisto'));
	}
	if ($report_parceria_repasse_report->RecCnt == 1) {
		$report_parceria_repasse_report->ReportCounts[0] = 0;
		$report_parceria_repasse_report->ReportTotals[0][29] = 0;
		$report_parceria_repasse_report->ReportTotals[0][30] = 0;
		$report_parceria_repasse_report->ReportTotals[0][31] = 0;
		$report_parceria_repasse_report->ReportTotals[0][32] = 0;
	}
	for ($i = 1; $i <= 1; $i++) {
		if ($report_parceria_repasse_report->LevelBreak[$i]) { // Reset counter and aggregation
			$report_parceria_repasse_report->ReportCounts[$i] = 0;
			$report_parceria_repasse_report->ReportTotals[$i][29] = 0;
			$report_parceria_repasse_report->ReportTotals[$i][30] = 0;
			$report_parceria_repasse_report->ReportTotals[$i][31] = 0;
			$report_parceria_repasse_report->ReportTotals[$i][32] = 0;
		}
	}
	$report_parceria_repasse_report->ReportCounts[0] += $report_parceria_repasse_report->DtlRecordCount;
	$report_parceria_repasse_report->ReportCounts[1] += $report_parceria_repasse_report->DtlRecordCount;
	if ($report_parceria_repasse_report->RecordExists) {
?>

<?php

	}

	while (!$report_parceria_repasse_report->DetailRecordset->EOF) {
		$report_parceria_repasse_report->RowCnt++;
		$report_parceria_repasse->pTermoNumero->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pTermoNumero'));
		$report_parceria_repasse->pNumero->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pNumero'));
		$report_parceria_repasse->pInicioVigencia->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pInicioVigencia'));
		$report_parceria_repasse->pFimVigencia->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pFimVigencia'));
		$report_parceria_repasse->pData->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pData'));
		$report_parceria_repasse->pValor->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pValor'));
		$report_parceria_repasse->pObjeto->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pObjeto'));
		$report_parceria_repasse->pMetas->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pMetas'));
		$report_parceria_repasse->pOrigem->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pOrigem'));
		$report_parceria_repasse->pEntidadeEdereco->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pEntidadeEdereco'));
		$report_parceria_repasse->pEntidadeEstatuto->Upload->DbValue = $report_parceria_repasse_report->DetailRecordset->fields('pEntidadeEstatuto');
		$report_parceria_repasse->pEntidadeLei->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pEntidadeLei'));
		$report_parceria_repasse->pEntidadeCebas->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pEntidadeCebas'));
		$report_parceria_repasse->pRespNome->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pRespNome'));
		$report_parceria_repasse->pRespCargo->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pRespCargo'));
		$report_parceria_repasse->pRespEdereco->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pRespEdereco'));
		$report_parceria_repasse->pRespContato->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pRespContato'));
		$report_parceria_repasse->pRespAta->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pRespAta'));
		$report_parceria_repasse->pContNome->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pContNome'));
		$report_parceria_repasse->pContEndereco->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pContEndereco'));
		$report_parceria_repasse->pContContato->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pContContato'));
		$report_parceria_repasse->pContDocumento->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pContDocumento'));
		$report_parceria_repasse->pPrencherNome->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pPrencherNome'));
		$report_parceria_repasse->pPrencherCargo->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pPrencherCargo'));
		$report_parceria_repasse->pPrencherEndereco->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pPrencherEndereco'));
		$report_parceria_repasse->pPrencherContato->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pPrencherContato'));
		$report_parceria_repasse->pPrencherDocumento->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('pPrencherDocumento'));
		$report_parceria_repasse->rIDRepasse->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rIDRepasse'));
		$report_parceria_repasse->rFaixaEtaria->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rFaixaEtaria'));
		$report_parceria_repasse->rMeta->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rMeta'));
		$report_parceria_repasse_report->ReportTotals[0][29] += $report_parceria_repasse->rMeta->CurrentValue;
		$report_parceria_repasse_report->ReportTotals[1][29] += $report_parceria_repasse->rMeta->CurrentValue;
		$report_parceria_repasse->rValorUnitario->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorUnitario'));
		$report_parceria_repasse_report->ReportTotals[0][30] += $report_parceria_repasse->rValorUnitario->CurrentValue;
		$report_parceria_repasse_report->ReportTotals[1][30] += $report_parceria_repasse->rValorUnitario->CurrentValue;
		$report_parceria_repasse->rValorMensal->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorMensal'));
		$report_parceria_repasse_report->ReportTotals[0][31] += $report_parceria_repasse->rValorMensal->CurrentValue;
		$report_parceria_repasse_report->ReportTotals[1][31] += $report_parceria_repasse->rValorMensal->CurrentValue;
		$report_parceria_repasse->rValorPrevisto->setDbValue($report_parceria_repasse_report->DetailRecordset->fields('rValorPrevisto'));
		$report_parceria_repasse_report->ReportTotals[0][32] += $report_parceria_repasse->rValorPrevisto->CurrentValue;
		$report_parceria_repasse_report->ReportTotals[1][32] += $report_parceria_repasse->rValorPrevisto->CurrentValue;

		// Render for view
		$report_parceria_repasse->RowType = EW_ROWTYPE_VIEW;
		$report_parceria_repasse->ResetAttrs();
		$report_parceria_repasse_report->RenderRow();
?>
	
	<?php
		if ($repasse == 1) {
	?>

	
<h3>Termo de Colaboração nº <?php echo $report_parceria_repasse->pTermoNumero->ViewValue ?></h3>

		<div class="quadrosCinza">
<h4>Dados da Parceria</h4>
		</div>
<b>Processo: </b><?php echo $report_parceria_repasse->pNumero->ViewValue ?><br>
<b>Vigencia: </b><?php echo $report_parceria_repasse->pInicioVigencia->ViewValue ?> a <?php echo $report_parceria_repasse->pFimVigencia->ViewValue ?><br>
<b>Data Assinatura: </b><?php echo $report_parceria_repasse->pData->ViewValue ?><br>
<h3>Valor: <?php echo $report_parceria_repasse->pValor->ViewValue ?></h3>
<p><strong>(<?php echo clsTexto::valorPorExtenso($report_parceria_repasse->pValor->ViewValue, true, false); ?>)</strong></p>
<b>Objeto: </b><?php echo $report_parceria_repasse->pObjeto->ViewValue ?><br>
<b>Metas: </b><?php echo $report_parceria_repasse->pMetas->ViewValue ?><br>
<b>Origem: </b><?php echo $report_parceria_repasse->pOrigem->ViewValue ?>
		<div class="quadrosCinza">
<h4>Dados da Entidade</h4>
		</div>
<b>Endereço: </b><?php echo $report_parceria_repasse->pEntidadeEdereco->ViewValue ?><br>
<b>Estatuto: </b><?php echo ew_GetFileViewTag($report_parceria_repasse->pEntidadeEstatuto, $report_parceria_repasse->pEntidadeEstatuto->ViewValue) ?><br>
<b>Lei Utilidade Publica Municipal: </b><?php echo $report_parceria_repasse->pEntidadeLei->ViewValue ?><br>
<b>Cebas: </b><?php echo $report_parceria_repasse->pEntidadeCebas->ViewValue ?>
<div class="quadrosCinza">
<h4>Responsável</h4>
		</div>
<b>Nome: </b><?php echo $report_parceria_repasse->pRespNome->ViewValue ?><br>
<b>Cargo: </b><?php echo $report_parceria_repasse->pRespCargo->ViewValue ?><br>
<b>Endereço: </b><?php echo $report_parceria_repasse->pRespEdereco->ViewValue ?><br>
<b>Contato: </b><?php echo $report_parceria_repasse->pRespContato->ViewValue ?><br>
<b>Ata Nomeação: </b><?php echo $report_parceria_repasse->pRespAta->ViewValue ?>
<div class="quadrosCinza">
<h4>Contador(a)</h4>
		</div>
<b>Nome: </b><?php echo $report_parceria_repasse->pContNome->ViewValue ?><br>
<b>Endereço: </b><?php echo $report_parceria_repasse->pContEndereco->ViewValue ?><br>
<b>Contato: </b><?php echo $report_parceria_repasse->pContContato->ViewValue ?><br>
<b>Identificação: </b><?php echo $report_parceria_repasse->pContDocumento->ViewValue ?>
<div class="quadrosCinza">
<h4>Responsável pelo Preenchimento</h4>
		</div>
<b>Nome: </b><?php echo $report_parceria_repasse->pPrencherNome->ViewValue ?><br>
<b>Cargo: </b><?php echo $report_parceria_repasse->pPrencherCargo->ViewValue ?><br>
<b>Endereço: </b><?php echo $report_parceria_repasse->pPrencherEndereco->ViewValue ?><br>
<b>Contato: </b><?php echo $report_parceria_repasse->pPrencherContato->ViewValue ?><br>
<b>Identificação: </b><?php echo $report_parceria_repasse->pPrencherDocumento->ViewValue ?>
<div class="quadros">
<h2>Valores dos repasses em R$</h2>
		</div>
	<?php
		$repasse = 2;
		echo "<table border=0 style='border-collapse: collapse; width: 100%;'>\n";
		echo "	<tr class='tr-campos'>\n";
		echo "		<td></td>\n";
		echo "		<td class='td-direita'>Faixa etária</td>\n";
		echo "		<td class='td-direita'>Meta de atendimento</td>\n";
		echo "		<td class='td-direita'>Valor per capita R$</td>\n";
		echo "		<td class='td-direita'>Valor repasse mês R$</td>\n";
		echo "		<td class='td-direita'>Valor repasse previsto R$</td>\n";
		echo "	</tr>\n";
		}
	?>
	<tr>
		<td class="td-direita"<?php echo $report_parceria_repasse->rIDRepasse->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rIDRepasse->ViewAttributes() ?>><?php echo $report_parceria_repasse->rIDRepasse->ViewValue ?></span></td>
		<td class="td-direita"<?php echo $report_parceria_repasse->rFaixaEtaria->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rFaixaEtaria->ViewAttributes() ?>><?php echo $report_parceria_repasse->rFaixaEtaria->ViewValue ?></span></td>
		<td class="td-direita"<?php echo $report_parceria_repasse->rMeta->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rMeta->ViewAttributes() ?>><?php echo $report_parceria_repasse->rMeta->ViewValue ?></span></td>
		<td class="td-direita"<?php echo $report_parceria_repasse->rValorUnitario->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rValorUnitario->ViewAttributes() ?>><?php echo $report_parceria_repasse->rValorUnitario->ViewValue ?></span></td>
		<td class="td-direita"<?php echo $report_parceria_repasse->rValorMensal->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rValorMensal->ViewAttributes() ?>><?php echo $report_parceria_repasse->rValorMensal->ViewValue ?></span></td>
		<td class="td-direita"<?php echo $report_parceria_repasse->rValorPrevisto->CellAttributes() ?>><span<?php echo $report_parceria_repasse->rValorPrevisto->ViewAttributes() ?>><?php echo $report_parceria_repasse->rValorPrevisto->ViewValue ?></span></td>
	</tr>
<?php
	$report_parceria_repasse_report->DetailRecordset->MoveNext();
	}
	$report_parceria_repasse_report->DetailRecordset->Close();

	// Save old group data
	$report_parceria_repasse_report->ReportGroups[0] = $report_parceria_repasse->pExercicio->CurrentValue;

	// Get next record
	$report_parceria_repasse_report->Recordset->MoveNext();
	if ($report_parceria_repasse_report->Recordset->EOF) {
		$report_parceria_repasse_report->RecCnt = 0; // EOF, force all level breaks
	} else {
		$report_parceria_repasse->pExercicio->setDbValue($report_parceria_repasse_report->Recordset->fields('pExercicio'));
	}
	$report_parceria_repasse_report->ChkLvlBreak();

	// Show footers
	if ($report_parceria_repasse_report->LevelBreak[1]) {
		$report_parceria_repasse->pExercicio->CurrentValue = $report_parceria_repasse_report->ReportGroups[0];

		// Render row for view
		$report_parceria_repasse->RowType = EW_ROWTYPE_VIEW;
		$report_parceria_repasse->ResetAttrs();
		$report_parceria_repasse_report->RenderRow();
		$report_parceria_repasse->pExercicio->CurrentValue = $report_parceria_repasse->pExercicio->DbValue;
?>
	<!--
	<tr><td colspan="6" class="ewGroupSummary">
		<?php //echo $Language->Phrase("RptSumHead") ?>&nbsp;
		<?php //echo $report_parceria_repasse->pExercicio->FldCaption() ?>:&nbsp;
		<?php //echo $report_parceria_repasse->pExercicio->ViewValue ?> (
		<?php //echo ew_FormatNumber($report_parceria_repasse_report->ReportCounts[1],0) ?> 
		<?php //echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
	-->
<?php
	$report_parceria_repasse->rMeta->CurrentValue = $report_parceria_repasse_report->ReportTotals[1][29];
	$report_parceria_repasse->rValorUnitario->CurrentValue = $report_parceria_repasse_report->ReportTotals[1][30];
	$report_parceria_repasse->rValorMensal->CurrentValue = $report_parceria_repasse_report->ReportTotals[1][31];
	$report_parceria_repasse->rValorPrevisto->CurrentValue = $report_parceria_repasse_report->ReportTotals[1][32];

	// Render row for view
	$report_parceria_repasse->RowType = EW_ROWTYPE_VIEW;
	$report_parceria_repasse->ResetAttrs();
	$report_parceria_repasse_report->RenderRow();
?>
	<tr class="tr-campos">
	
		<td></td>
		<td class="ewGroupAggregate"><?php echo $Language->Phrase("RptSum") ?></td>

		<td class="td-direita" <?php echo $report_parceria_repasse->rMeta->CellAttributes() ?>>
<span<?php echo $report_parceria_repasse->rMeta->ViewAttributes() ?>>
<?php echo $report_parceria_repasse->rMeta->ViewValue ?></span>
</td>
		<td class="td-direita" <?php echo $report_parceria_repasse->rValorUnitario->CellAttributes() ?>>
<span<?php echo $report_parceria_repasse->rValorUnitario->ViewAttributes() ?>>
<?php echo $report_parceria_repasse->rValorUnitario->ViewValue ?></span>
</td>
		<td class="td-direita" <?php echo $report_parceria_repasse->rValorMensal->CellAttributes() ?>>
<span<?php echo $report_parceria_repasse->rValorMensal->ViewAttributes() ?>>
<?php echo $report_parceria_repasse->rValorMensal->ViewValue ?></span>
</td>
		<td class="td-direita" <?php echo $report_parceria_repasse->rValorPrevisto->CellAttributes() ?>>
<span<?php echo $report_parceria_repasse->rValorPrevisto->ViewAttributes() ?>>
<?php echo $report_parceria_repasse->rValorPrevisto->ViewValue ?></span>
</td>
	</tr>
	<tr><td class="quadros" colspan="6" style="text-align: center;">	
	<h2>
	(<?php
	//$trocaponto = str_replace( ".", ",", $report_parceria_repasse->rValorPrevisto->ViewValue );
	$trocaponto = $report_parceria_repasse->rValorPrevisto->ViewValue;
	echo clsTexto::valorPorExtenso($trocaponto, true, false); ?>)
	</h2><?php //echo $trocaponto ?>
	</td></tr>
<?php
}
}

// Close recordset
$report_parceria_repasse_report->Recordset->Close();
?>
<?php if ($report_parceria_repasse_report->RecordExists) { ?>
	<!--
	<?php //echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(
	<?php //echo ew_FormatNumber($report_parceria_repasse_report->ReportCounts[0], 0) ?>&nbsp;
	<?php //echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
	-->
<?php
	$report_parceria_repasse->rMeta->CurrentValue = $report_parceria_repasse_report->ReportTotals[0][29];
	$report_parceria_repasse->rValorUnitario->CurrentValue = $report_parceria_repasse_report->ReportTotals[0][30];
	$report_parceria_repasse->rValorMensal->CurrentValue = $report_parceria_repasse_report->ReportTotals[0][31];
	$report_parceria_repasse->rValorPrevisto->CurrentValue = $report_parceria_repasse_report->ReportTotals[0][32];

	// Render row for view
	$report_parceria_repasse->RowType = EW_ROWTYPE_VIEW;
	$report_parceria_repasse->ResetAttrs();
	$report_parceria_repasse_report->RenderRow();
?>

<?php } ?>
<?php if ($report_parceria_repasse_report->RecordExists) { ?>
</table>
<br>

		</div>
	</div>
</div>
<br><br><br>	

<?php } else { ?>
	<?php //echo $Language->Phrase("NoRecord") ?>
	
	<div class="container">
			<div class="row"><br>
			<?php include_once "report_navbar.php" ?>	
			<div class="col-md-11 text-center" style="border-radius:10px;background:#e63946;margin:10px;padding-bottom:10px;box-shadow:1px 1px 8px 0px #000000;">
				
				<h3><span style="color: #f1faee;"><b>Nenhum registro encontrado!!</b></span></h3>
				<p><a href="report_anosreport.php"><strong>Voltar</strong></a></p>
				</div>
			</div>
		</div>

<?php } ?>


<?php

$report_parceria_repasse_report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($report_parceria_repasse->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$report_parceria_repasse_report->Page_Terminate();
?>
