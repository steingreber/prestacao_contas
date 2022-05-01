<?php

// Global variable for table object
$view_parceira_repase = NULL;

//
// Table class for view_parceira_repase
//
class cview_parceira_repase extends cTable {
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

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'view_parceira_repase';
		$this->TableName = 'view_parceira_repase';
		$this->TableType = 'VIEW';

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
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// pExercicio
		$this->pExercicio = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pExercicio', 'pExercicio', '`pExercicio`', '`pExercicio`', 3, -1, FALSE, '`pExercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pExercicio->Sortable = TRUE; // Allow sort
		$this->pExercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pExercicio'] = &$this->pExercicio;

		// pTermoNumero
		$this->pTermoNumero = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pTermoNumero', 'pTermoNumero', '`pTermoNumero`', '`pTermoNumero`', 200, -1, FALSE, '`pTermoNumero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pTermoNumero->Sortable = TRUE; // Allow sort
		$this->fields['pTermoNumero'] = &$this->pTermoNumero;

		// pNumero
		$this->pNumero = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pNumero', 'pNumero', '`pNumero`', '`pNumero`', 200, -1, FALSE, '`pNumero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pNumero->Sortable = TRUE; // Allow sort
		$this->fields['pNumero'] = &$this->pNumero;

		// pInicioVigencia
		$this->pInicioVigencia = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pInicioVigencia', 'pInicioVigencia', '`pInicioVigencia`', ew_CastDateFieldForLike('`pInicioVigencia`', 0, "DB"), 133, 0, FALSE, '`pInicioVigencia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pInicioVigencia->Sortable = TRUE; // Allow sort
		$this->pInicioVigencia->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['pInicioVigencia'] = &$this->pInicioVigencia;

		// pFimVigencia
		$this->pFimVigencia = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pFimVigencia', 'pFimVigencia', '`pFimVigencia`', ew_CastDateFieldForLike('`pFimVigencia`', 0, "DB"), 133, 0, FALSE, '`pFimVigencia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pFimVigencia->Sortable = TRUE; // Allow sort
		$this->pFimVigencia->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['pFimVigencia'] = &$this->pFimVigencia;

		// pData
		$this->pData = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pData', 'pData', '`pData`', ew_CastDateFieldForLike('`pData`', 0, "DB"), 133, 0, FALSE, '`pData`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pData->Sortable = TRUE; // Allow sort
		$this->pData->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['pData'] = &$this->pData;

		// pValor
		$this->pValor = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pValor', 'pValor', '`pValor`', '`pValor`', 5, -1, FALSE, '`pValor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pValor->Sortable = TRUE; // Allow sort
		$this->pValor->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['pValor'] = &$this->pValor;

		// pObjeto
		$this->pObjeto = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pObjeto', 'pObjeto', '`pObjeto`', '`pObjeto`', 201, -1, FALSE, '`pObjeto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pObjeto->Sortable = TRUE; // Allow sort
		$this->fields['pObjeto'] = &$this->pObjeto;

		// pMetas
		$this->pMetas = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pMetas', 'pMetas', '`pMetas`', '`pMetas`', 201, -1, FALSE, '`pMetas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pMetas->Sortable = TRUE; // Allow sort
		$this->fields['pMetas'] = &$this->pMetas;

		// pOrigem
		$this->pOrigem = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pOrigem', 'pOrigem', '`pOrigem`', '`pOrigem`', 200, -1, FALSE, '`pOrigem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pOrigem->Sortable = TRUE; // Allow sort
		$this->fields['pOrigem'] = &$this->pOrigem;

		// pEntidadeEdereco
		$this->pEntidadeEdereco = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pEntidadeEdereco', 'pEntidadeEdereco', '`pEntidadeEdereco`', '`pEntidadeEdereco`', 200, -1, FALSE, '`pEntidadeEdereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeEdereco->Sortable = TRUE; // Allow sort
		$this->fields['pEntidadeEdereco'] = &$this->pEntidadeEdereco;

		// pEntidadeEstatuto
		$this->pEntidadeEstatuto = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pEntidadeEstatuto', 'pEntidadeEstatuto', '`pEntidadeEstatuto`', '`pEntidadeEstatuto`', 205, -1, TRUE, '`pEntidadeEstatuto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->pEntidadeEstatuto->Sortable = TRUE; // Allow sort
		$this->fields['pEntidadeEstatuto'] = &$this->pEntidadeEstatuto;

		// pEntidadeLei
		$this->pEntidadeLei = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pEntidadeLei', 'pEntidadeLei', '`pEntidadeLei`', '`pEntidadeLei`', 200, -1, FALSE, '`pEntidadeLei`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeLei->Sortable = TRUE; // Allow sort
		$this->fields['pEntidadeLei'] = &$this->pEntidadeLei;

		// pEntidadeCebas
		$this->pEntidadeCebas = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pEntidadeCebas', 'pEntidadeCebas', '`pEntidadeCebas`', '`pEntidadeCebas`', 200, -1, FALSE, '`pEntidadeCebas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pEntidadeCebas->Sortable = TRUE; // Allow sort
		$this->fields['pEntidadeCebas'] = &$this->pEntidadeCebas;

		// pRespNome
		$this->pRespNome = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pRespNome', 'pRespNome', '`pRespNome`', '`pRespNome`', 200, -1, FALSE, '`pRespNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespNome->Sortable = TRUE; // Allow sort
		$this->fields['pRespNome'] = &$this->pRespNome;

		// pRespCargo
		$this->pRespCargo = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pRespCargo', 'pRespCargo', '`pRespCargo`', '`pRespCargo`', 200, -1, FALSE, '`pRespCargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespCargo->Sortable = TRUE; // Allow sort
		$this->fields['pRespCargo'] = &$this->pRespCargo;

		// pRespEdereco
		$this->pRespEdereco = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pRespEdereco', 'pRespEdereco', '`pRespEdereco`', '`pRespEdereco`', 200, -1, FALSE, '`pRespEdereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespEdereco->Sortable = TRUE; // Allow sort
		$this->fields['pRespEdereco'] = &$this->pRespEdereco;

		// pRespContato
		$this->pRespContato = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pRespContato', 'pRespContato', '`pRespContato`', '`pRespContato`', 200, -1, FALSE, '`pRespContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespContato->Sortable = TRUE; // Allow sort
		$this->fields['pRespContato'] = &$this->pRespContato;

		// pRespAta
		$this->pRespAta = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pRespAta', 'pRespAta', '`pRespAta`', '`pRespAta`', 200, -1, FALSE, '`pRespAta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pRespAta->Sortable = TRUE; // Allow sort
		$this->fields['pRespAta'] = &$this->pRespAta;

		// pContNome
		$this->pContNome = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pContNome', 'pContNome', '`pContNome`', '`pContNome`', 200, -1, FALSE, '`pContNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContNome->Sortable = TRUE; // Allow sort
		$this->fields['pContNome'] = &$this->pContNome;

		// pContEndereco
		$this->pContEndereco = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pContEndereco', 'pContEndereco', '`pContEndereco`', '`pContEndereco`', 200, -1, FALSE, '`pContEndereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContEndereco->Sortable = TRUE; // Allow sort
		$this->fields['pContEndereco'] = &$this->pContEndereco;

		// pContContato
		$this->pContContato = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pContContato', 'pContContato', '`pContContato`', '`pContContato`', 200, -1, FALSE, '`pContContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContContato->Sortable = TRUE; // Allow sort
		$this->fields['pContContato'] = &$this->pContContato;

		// pContDocumento
		$this->pContDocumento = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pContDocumento', 'pContDocumento', '`pContDocumento`', '`pContDocumento`', 200, -1, FALSE, '`pContDocumento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pContDocumento->Sortable = TRUE; // Allow sort
		$this->fields['pContDocumento'] = &$this->pContDocumento;

		// pPrencherNome
		$this->pPrencherNome = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pPrencherNome', 'pPrencherNome', '`pPrencherNome`', '`pPrencherNome`', 200, -1, FALSE, '`pPrencherNome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherNome->Sortable = TRUE; // Allow sort
		$this->fields['pPrencherNome'] = &$this->pPrencherNome;

		// pPrencherCargo
		$this->pPrencherCargo = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pPrencherCargo', 'pPrencherCargo', '`pPrencherCargo`', '`pPrencherCargo`', 200, -1, FALSE, '`pPrencherCargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherCargo->Sortable = TRUE; // Allow sort
		$this->fields['pPrencherCargo'] = &$this->pPrencherCargo;

		// pPrencherEndereco
		$this->pPrencherEndereco = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pPrencherEndereco', 'pPrencherEndereco', '`pPrencherEndereco`', '`pPrencherEndereco`', 200, -1, FALSE, '`pPrencherEndereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherEndereco->Sortable = TRUE; // Allow sort
		$this->fields['pPrencherEndereco'] = &$this->pPrencherEndereco;

		// pPrencherContato
		$this->pPrencherContato = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pPrencherContato', 'pPrencherContato', '`pPrencherContato`', '`pPrencherContato`', 200, -1, FALSE, '`pPrencherContato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherContato->Sortable = TRUE; // Allow sort
		$this->fields['pPrencherContato'] = &$this->pPrencherContato;

		// pPrencherDocumento
		$this->pPrencherDocumento = new cField('view_parceira_repase', 'view_parceira_repase', 'x_pPrencherDocumento', 'pPrencherDocumento', '`pPrencherDocumento`', '`pPrencherDocumento`', 200, -1, FALSE, '`pPrencherDocumento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pPrencherDocumento->Sortable = TRUE; // Allow sort
		$this->fields['pPrencherDocumento'] = &$this->pPrencherDocumento;

		// rIDRepasse
		$this->rIDRepasse = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rIDRepasse', 'rIDRepasse', '`rIDRepasse`', '`rIDRepasse`', 3, -1, FALSE, '`rIDRepasse`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rIDRepasse->Sortable = TRUE; // Allow sort
		$this->rIDRepasse->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rIDRepasse'] = &$this->rIDRepasse;

		// rFaixaEtaria
		$this->rFaixaEtaria = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rFaixaEtaria', 'rFaixaEtaria', '`rFaixaEtaria`', '`rFaixaEtaria`', 200, -1, FALSE, '`rFaixaEtaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rFaixaEtaria->Sortable = TRUE; // Allow sort
		$this->fields['rFaixaEtaria'] = &$this->rFaixaEtaria;

		// rMeta
		$this->rMeta = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rMeta', 'rMeta', '`rMeta`', '`rMeta`', 3, -1, FALSE, '`rMeta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rMeta->Sortable = TRUE; // Allow sort
		$this->rMeta->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rMeta'] = &$this->rMeta;

		// rValorUnitario
		$this->rValorUnitario = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rValorUnitario', 'rValorUnitario', '`rValorUnitario`', '`rValorUnitario`', 5, -1, FALSE, '`rValorUnitario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorUnitario->Sortable = TRUE; // Allow sort
		$this->rValorUnitario->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorUnitario'] = &$this->rValorUnitario;

		// rValorMensal
		$this->rValorMensal = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rValorMensal', 'rValorMensal', '`rValorMensal`', '`rValorMensal`', 5, -1, FALSE, '`rValorMensal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorMensal->Sortable = TRUE; // Allow sort
		$this->rValorMensal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorMensal'] = &$this->rValorMensal;

		// rValorPrevisto
		$this->rValorPrevisto = new cField('view_parceira_repase', 'view_parceira_repase', 'x_rValorPrevisto', 'rValorPrevisto', '`rValorPrevisto`', '`rValorPrevisto`', 5, -1, FALSE, '`rValorPrevisto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rValorPrevisto->Sortable = TRUE; // Allow sort
		$this->rValorPrevisto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rValorPrevisto'] = &$this->rValorPrevisto;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`view_parceira_repase`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
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

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
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
			return "view_parceira_repaselist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "view_parceira_repaseview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "view_parceira_repaseedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "view_parceira_repaseadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "view_parceira_repaselist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("view_parceira_repaseview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("view_parceira_repaseview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "view_parceira_repaseadd.php?" . $this->UrlParm($parm);
		else
			$url = "view_parceira_repaseadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("view_parceira_repaseedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("view_parceira_repaseadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("view_parceira_repasedelete.php", $this->UrlParm());
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

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->pExercicio->setDbValue($rs->fields('pExercicio'));
		$this->pTermoNumero->setDbValue($rs->fields('pTermoNumero'));
		$this->pNumero->setDbValue($rs->fields('pNumero'));
		$this->pInicioVigencia->setDbValue($rs->fields('pInicioVigencia'));
		$this->pFimVigencia->setDbValue($rs->fields('pFimVigencia'));
		$this->pData->setDbValue($rs->fields('pData'));
		$this->pValor->setDbValue($rs->fields('pValor'));
		$this->pObjeto->setDbValue($rs->fields('pObjeto'));
		$this->pMetas->setDbValue($rs->fields('pMetas'));
		$this->pOrigem->setDbValue($rs->fields('pOrigem'));
		$this->pEntidadeEdereco->setDbValue($rs->fields('pEntidadeEdereco'));
		$this->pEntidadeEstatuto->Upload->DbValue = $rs->fields('pEntidadeEstatuto');
		$this->pEntidadeLei->setDbValue($rs->fields('pEntidadeLei'));
		$this->pEntidadeCebas->setDbValue($rs->fields('pEntidadeCebas'));
		$this->pRespNome->setDbValue($rs->fields('pRespNome'));
		$this->pRespCargo->setDbValue($rs->fields('pRespCargo'));
		$this->pRespEdereco->setDbValue($rs->fields('pRespEdereco'));
		$this->pRespContato->setDbValue($rs->fields('pRespContato'));
		$this->pRespAta->setDbValue($rs->fields('pRespAta'));
		$this->pContNome->setDbValue($rs->fields('pContNome'));
		$this->pContEndereco->setDbValue($rs->fields('pContEndereco'));
		$this->pContContato->setDbValue($rs->fields('pContContato'));
		$this->pContDocumento->setDbValue($rs->fields('pContDocumento'));
		$this->pPrencherNome->setDbValue($rs->fields('pPrencherNome'));
		$this->pPrencherCargo->setDbValue($rs->fields('pPrencherCargo'));
		$this->pPrencherEndereco->setDbValue($rs->fields('pPrencherEndereco'));
		$this->pPrencherContato->setDbValue($rs->fields('pPrencherContato'));
		$this->pPrencherDocumento->setDbValue($rs->fields('pPrencherDocumento'));
		$this->rIDRepasse->setDbValue($rs->fields('rIDRepasse'));
		$this->rFaixaEtaria->setDbValue($rs->fields('rFaixaEtaria'));
		$this->rMeta->setDbValue($rs->fields('rMeta'));
		$this->rValorUnitario->setDbValue($rs->fields('rValorUnitario'));
		$this->rValorMensal->setDbValue($rs->fields('rValorMensal'));
		$this->rValorPrevisto->setDbValue($rs->fields('rValorPrevisto'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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
		$this->pInicioVigencia->ViewValue = ew_FormatDateTime($this->pInicioVigencia->ViewValue, 0);
		$this->pInicioVigencia->ViewCustomAttributes = "";

		// pFimVigencia
		$this->pFimVigencia->ViewValue = $this->pFimVigencia->CurrentValue;
		$this->pFimVigencia->ViewValue = ew_FormatDateTime($this->pFimVigencia->ViewValue, 0);
		$this->pFimVigencia->ViewCustomAttributes = "";

		// pData
		$this->pData->ViewValue = $this->pData->CurrentValue;
		$this->pData->ViewValue = ew_FormatDateTime($this->pData->ViewValue, 0);
		$this->pData->ViewCustomAttributes = "";

		// pValor
		$this->pValor->ViewValue = $this->pValor->CurrentValue;
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
		$this->rValorUnitario->ViewCustomAttributes = "";

		// rValorMensal
		$this->rValorMensal->ViewValue = $this->rValorMensal->CurrentValue;
		$this->rValorMensal->ViewCustomAttributes = "";

		// rValorPrevisto
		$this->rValorPrevisto->ViewValue = $this->rValorPrevisto->CurrentValue;
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// pExercicio
		$this->pExercicio->EditAttrs["class"] = "form-control";
		$this->pExercicio->EditCustomAttributes = "";
		$this->pExercicio->EditValue = $this->pExercicio->CurrentValue;
		$this->pExercicio->PlaceHolder = ew_RemoveHtml($this->pExercicio->FldCaption());

		// pTermoNumero
		$this->pTermoNumero->EditAttrs["class"] = "form-control";
		$this->pTermoNumero->EditCustomAttributes = "";
		$this->pTermoNumero->EditValue = $this->pTermoNumero->CurrentValue;
		$this->pTermoNumero->PlaceHolder = ew_RemoveHtml($this->pTermoNumero->FldCaption());

		// pNumero
		$this->pNumero->EditAttrs["class"] = "form-control";
		$this->pNumero->EditCustomAttributes = "";
		$this->pNumero->EditValue = $this->pNumero->CurrentValue;
		$this->pNumero->PlaceHolder = ew_RemoveHtml($this->pNumero->FldCaption());

		// pInicioVigencia
		$this->pInicioVigencia->EditAttrs["class"] = "form-control";
		$this->pInicioVigencia->EditCustomAttributes = "";
		$this->pInicioVigencia->EditValue = ew_FormatDateTime($this->pInicioVigencia->CurrentValue, 8);
		$this->pInicioVigencia->PlaceHolder = ew_RemoveHtml($this->pInicioVigencia->FldCaption());

		// pFimVigencia
		$this->pFimVigencia->EditAttrs["class"] = "form-control";
		$this->pFimVigencia->EditCustomAttributes = "";
		$this->pFimVigencia->EditValue = ew_FormatDateTime($this->pFimVigencia->CurrentValue, 8);
		$this->pFimVigencia->PlaceHolder = ew_RemoveHtml($this->pFimVigencia->FldCaption());

		// pData
		$this->pData->EditAttrs["class"] = "form-control";
		$this->pData->EditCustomAttributes = "";
		$this->pData->EditValue = ew_FormatDateTime($this->pData->CurrentValue, 8);
		$this->pData->PlaceHolder = ew_RemoveHtml($this->pData->FldCaption());

		// pValor
		$this->pValor->EditAttrs["class"] = "form-control";
		$this->pValor->EditCustomAttributes = "";
		$this->pValor->EditValue = $this->pValor->CurrentValue;
		$this->pValor->PlaceHolder = ew_RemoveHtml($this->pValor->FldCaption());
		if (strval($this->pValor->EditValue) <> "" && is_numeric($this->pValor->EditValue)) $this->pValor->EditValue = ew_FormatNumber($this->pValor->EditValue, -2, -1, -2, 0);

		// pObjeto
		$this->pObjeto->EditAttrs["class"] = "form-control";
		$this->pObjeto->EditCustomAttributes = "";
		$this->pObjeto->EditValue = $this->pObjeto->CurrentValue;
		$this->pObjeto->PlaceHolder = ew_RemoveHtml($this->pObjeto->FldCaption());

		// pMetas
		$this->pMetas->EditAttrs["class"] = "form-control";
		$this->pMetas->EditCustomAttributes = "";
		$this->pMetas->EditValue = $this->pMetas->CurrentValue;
		$this->pMetas->PlaceHolder = ew_RemoveHtml($this->pMetas->FldCaption());

		// pOrigem
		$this->pOrigem->EditAttrs["class"] = "form-control";
		$this->pOrigem->EditCustomAttributes = "";
		$this->pOrigem->EditValue = $this->pOrigem->CurrentValue;
		$this->pOrigem->PlaceHolder = ew_RemoveHtml($this->pOrigem->FldCaption());

		// pEntidadeEdereco
		$this->pEntidadeEdereco->EditAttrs["class"] = "form-control";
		$this->pEntidadeEdereco->EditCustomAttributes = "";
		$this->pEntidadeEdereco->EditValue = $this->pEntidadeEdereco->CurrentValue;
		$this->pEntidadeEdereco->PlaceHolder = ew_RemoveHtml($this->pEntidadeEdereco->FldCaption());

		// pEntidadeEstatuto
		$this->pEntidadeEstatuto->EditAttrs["class"] = "form-control";
		$this->pEntidadeEstatuto->EditCustomAttributes = "";
		if (!ew_Empty($this->pEntidadeEstatuto->Upload->DbValue)) {
			$this->pEntidadeEstatuto->EditValue = " alt=" . $Language->Phrase("PrimaryKeyUnspecified");
			$this->pEntidadeEstatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->pEntidadeEstatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->pEntidadeEstatuto->EditValue = "";
		}

		// pEntidadeLei
		$this->pEntidadeLei->EditAttrs["class"] = "form-control";
		$this->pEntidadeLei->EditCustomAttributes = "";
		$this->pEntidadeLei->EditValue = $this->pEntidadeLei->CurrentValue;
		$this->pEntidadeLei->PlaceHolder = ew_RemoveHtml($this->pEntidadeLei->FldCaption());

		// pEntidadeCebas
		$this->pEntidadeCebas->EditAttrs["class"] = "form-control";
		$this->pEntidadeCebas->EditCustomAttributes = "";
		$this->pEntidadeCebas->EditValue = $this->pEntidadeCebas->CurrentValue;
		$this->pEntidadeCebas->PlaceHolder = ew_RemoveHtml($this->pEntidadeCebas->FldCaption());

		// pRespNome
		$this->pRespNome->EditAttrs["class"] = "form-control";
		$this->pRespNome->EditCustomAttributes = "";
		$this->pRespNome->EditValue = $this->pRespNome->CurrentValue;
		$this->pRespNome->PlaceHolder = ew_RemoveHtml($this->pRespNome->FldCaption());

		// pRespCargo
		$this->pRespCargo->EditAttrs["class"] = "form-control";
		$this->pRespCargo->EditCustomAttributes = "";
		$this->pRespCargo->EditValue = $this->pRespCargo->CurrentValue;
		$this->pRespCargo->PlaceHolder = ew_RemoveHtml($this->pRespCargo->FldCaption());

		// pRespEdereco
		$this->pRespEdereco->EditAttrs["class"] = "form-control";
		$this->pRespEdereco->EditCustomAttributes = "";
		$this->pRespEdereco->EditValue = $this->pRespEdereco->CurrentValue;
		$this->pRespEdereco->PlaceHolder = ew_RemoveHtml($this->pRespEdereco->FldCaption());

		// pRespContato
		$this->pRespContato->EditAttrs["class"] = "form-control";
		$this->pRespContato->EditCustomAttributes = "";
		$this->pRespContato->EditValue = $this->pRespContato->CurrentValue;
		$this->pRespContato->PlaceHolder = ew_RemoveHtml($this->pRespContato->FldCaption());

		// pRespAta
		$this->pRespAta->EditAttrs["class"] = "form-control";
		$this->pRespAta->EditCustomAttributes = "";
		$this->pRespAta->EditValue = $this->pRespAta->CurrentValue;
		$this->pRespAta->PlaceHolder = ew_RemoveHtml($this->pRespAta->FldCaption());

		// pContNome
		$this->pContNome->EditAttrs["class"] = "form-control";
		$this->pContNome->EditCustomAttributes = "";
		$this->pContNome->EditValue = $this->pContNome->CurrentValue;
		$this->pContNome->PlaceHolder = ew_RemoveHtml($this->pContNome->FldCaption());

		// pContEndereco
		$this->pContEndereco->EditAttrs["class"] = "form-control";
		$this->pContEndereco->EditCustomAttributes = "";
		$this->pContEndereco->EditValue = $this->pContEndereco->CurrentValue;
		$this->pContEndereco->PlaceHolder = ew_RemoveHtml($this->pContEndereco->FldCaption());

		// pContContato
		$this->pContContato->EditAttrs["class"] = "form-control";
		$this->pContContato->EditCustomAttributes = "";
		$this->pContContato->EditValue = $this->pContContato->CurrentValue;
		$this->pContContato->PlaceHolder = ew_RemoveHtml($this->pContContato->FldCaption());

		// pContDocumento
		$this->pContDocumento->EditAttrs["class"] = "form-control";
		$this->pContDocumento->EditCustomAttributes = "";
		$this->pContDocumento->EditValue = $this->pContDocumento->CurrentValue;
		$this->pContDocumento->PlaceHolder = ew_RemoveHtml($this->pContDocumento->FldCaption());

		// pPrencherNome
		$this->pPrencherNome->EditAttrs["class"] = "form-control";
		$this->pPrencherNome->EditCustomAttributes = "";
		$this->pPrencherNome->EditValue = $this->pPrencherNome->CurrentValue;
		$this->pPrencherNome->PlaceHolder = ew_RemoveHtml($this->pPrencherNome->FldCaption());

		// pPrencherCargo
		$this->pPrencherCargo->EditAttrs["class"] = "form-control";
		$this->pPrencherCargo->EditCustomAttributes = "";
		$this->pPrencherCargo->EditValue = $this->pPrencherCargo->CurrentValue;
		$this->pPrencherCargo->PlaceHolder = ew_RemoveHtml($this->pPrencherCargo->FldCaption());

		// pPrencherEndereco
		$this->pPrencherEndereco->EditAttrs["class"] = "form-control";
		$this->pPrencherEndereco->EditCustomAttributes = "";
		$this->pPrencherEndereco->EditValue = $this->pPrencherEndereco->CurrentValue;
		$this->pPrencherEndereco->PlaceHolder = ew_RemoveHtml($this->pPrencherEndereco->FldCaption());

		// pPrencherContato
		$this->pPrencherContato->EditAttrs["class"] = "form-control";
		$this->pPrencherContato->EditCustomAttributes = "";
		$this->pPrencherContato->EditValue = $this->pPrencherContato->CurrentValue;
		$this->pPrencherContato->PlaceHolder = ew_RemoveHtml($this->pPrencherContato->FldCaption());

		// pPrencherDocumento
		$this->pPrencherDocumento->EditAttrs["class"] = "form-control";
		$this->pPrencherDocumento->EditCustomAttributes = "";
		$this->pPrencherDocumento->EditValue = $this->pPrencherDocumento->CurrentValue;
		$this->pPrencherDocumento->PlaceHolder = ew_RemoveHtml($this->pPrencherDocumento->FldCaption());

		// rIDRepasse
		$this->rIDRepasse->EditAttrs["class"] = "form-control";
		$this->rIDRepasse->EditCustomAttributes = "";
		$this->rIDRepasse->EditValue = $this->rIDRepasse->CurrentValue;
		$this->rIDRepasse->PlaceHolder = ew_RemoveHtml($this->rIDRepasse->FldCaption());

		// rFaixaEtaria
		$this->rFaixaEtaria->EditAttrs["class"] = "form-control";
		$this->rFaixaEtaria->EditCustomAttributes = "";
		$this->rFaixaEtaria->EditValue = $this->rFaixaEtaria->CurrentValue;
		$this->rFaixaEtaria->PlaceHolder = ew_RemoveHtml($this->rFaixaEtaria->FldCaption());

		// rMeta
		$this->rMeta->EditAttrs["class"] = "form-control";
		$this->rMeta->EditCustomAttributes = "";
		$this->rMeta->EditValue = $this->rMeta->CurrentValue;
		$this->rMeta->PlaceHolder = ew_RemoveHtml($this->rMeta->FldCaption());

		// rValorUnitario
		$this->rValorUnitario->EditAttrs["class"] = "form-control";
		$this->rValorUnitario->EditCustomAttributes = "";
		$this->rValorUnitario->EditValue = $this->rValorUnitario->CurrentValue;
		$this->rValorUnitario->PlaceHolder = ew_RemoveHtml($this->rValorUnitario->FldCaption());
		if (strval($this->rValorUnitario->EditValue) <> "" && is_numeric($this->rValorUnitario->EditValue)) $this->rValorUnitario->EditValue = ew_FormatNumber($this->rValorUnitario->EditValue, -2, -1, -2, 0);

		// rValorMensal
		$this->rValorMensal->EditAttrs["class"] = "form-control";
		$this->rValorMensal->EditCustomAttributes = "";
		$this->rValorMensal->EditValue = $this->rValorMensal->CurrentValue;
		$this->rValorMensal->PlaceHolder = ew_RemoveHtml($this->rValorMensal->FldCaption());
		if (strval($this->rValorMensal->EditValue) <> "" && is_numeric($this->rValorMensal->EditValue)) $this->rValorMensal->EditValue = ew_FormatNumber($this->rValorMensal->EditValue, -2, -1, -2, 0);

		// rValorPrevisto
		$this->rValorPrevisto->EditAttrs["class"] = "form-control";
		$this->rValorPrevisto->EditCustomAttributes = "";
		$this->rValorPrevisto->EditValue = $this->rValorPrevisto->CurrentValue;
		$this->rValorPrevisto->PlaceHolder = ew_RemoveHtml($this->rValorPrevisto->FldCaption());
		if (strval($this->rValorPrevisto->EditValue) <> "" && is_numeric($this->rValorPrevisto->EditValue)) $this->rValorPrevisto->EditValue = ew_FormatNumber($this->rValorPrevisto->EditValue, -2, -1, -2, 0);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->pExercicio->Exportable) $Doc->ExportCaption($this->pExercicio);
					if ($this->pTermoNumero->Exportable) $Doc->ExportCaption($this->pTermoNumero);
					if ($this->pNumero->Exportable) $Doc->ExportCaption($this->pNumero);
					if ($this->pInicioVigencia->Exportable) $Doc->ExportCaption($this->pInicioVigencia);
					if ($this->pFimVigencia->Exportable) $Doc->ExportCaption($this->pFimVigencia);
					if ($this->pData->Exportable) $Doc->ExportCaption($this->pData);
					if ($this->pValor->Exportable) $Doc->ExportCaption($this->pValor);
					if ($this->pObjeto->Exportable) $Doc->ExportCaption($this->pObjeto);
					if ($this->pMetas->Exportable) $Doc->ExportCaption($this->pMetas);
					if ($this->pOrigem->Exportable) $Doc->ExportCaption($this->pOrigem);
					if ($this->pEntidadeEdereco->Exportable) $Doc->ExportCaption($this->pEntidadeEdereco);
					if ($this->pEntidadeEstatuto->Exportable) $Doc->ExportCaption($this->pEntidadeEstatuto);
					if ($this->pEntidadeLei->Exportable) $Doc->ExportCaption($this->pEntidadeLei);
					if ($this->pEntidadeCebas->Exportable) $Doc->ExportCaption($this->pEntidadeCebas);
					if ($this->pRespNome->Exportable) $Doc->ExportCaption($this->pRespNome);
					if ($this->pRespCargo->Exportable) $Doc->ExportCaption($this->pRespCargo);
					if ($this->pRespEdereco->Exportable) $Doc->ExportCaption($this->pRespEdereco);
					if ($this->pRespContato->Exportable) $Doc->ExportCaption($this->pRespContato);
					if ($this->pRespAta->Exportable) $Doc->ExportCaption($this->pRespAta);
					if ($this->pContNome->Exportable) $Doc->ExportCaption($this->pContNome);
					if ($this->pContEndereco->Exportable) $Doc->ExportCaption($this->pContEndereco);
					if ($this->pContContato->Exportable) $Doc->ExportCaption($this->pContContato);
					if ($this->pContDocumento->Exportable) $Doc->ExportCaption($this->pContDocumento);
					if ($this->pPrencherNome->Exportable) $Doc->ExportCaption($this->pPrencherNome);
					if ($this->pPrencherCargo->Exportable) $Doc->ExportCaption($this->pPrencherCargo);
					if ($this->pPrencherEndereco->Exportable) $Doc->ExportCaption($this->pPrencherEndereco);
					if ($this->pPrencherContato->Exportable) $Doc->ExportCaption($this->pPrencherContato);
					if ($this->pPrencherDocumento->Exportable) $Doc->ExportCaption($this->pPrencherDocumento);
					if ($this->rIDRepasse->Exportable) $Doc->ExportCaption($this->rIDRepasse);
					if ($this->rFaixaEtaria->Exportable) $Doc->ExportCaption($this->rFaixaEtaria);
					if ($this->rMeta->Exportable) $Doc->ExportCaption($this->rMeta);
					if ($this->rValorUnitario->Exportable) $Doc->ExportCaption($this->rValorUnitario);
					if ($this->rValorMensal->Exportable) $Doc->ExportCaption($this->rValorMensal);
					if ($this->rValorPrevisto->Exportable) $Doc->ExportCaption($this->rValorPrevisto);
				} else {
					if ($this->pExercicio->Exportable) $Doc->ExportCaption($this->pExercicio);
					if ($this->pTermoNumero->Exportable) $Doc->ExportCaption($this->pTermoNumero);
					if ($this->pNumero->Exportable) $Doc->ExportCaption($this->pNumero);
					if ($this->pInicioVigencia->Exportable) $Doc->ExportCaption($this->pInicioVigencia);
					if ($this->pFimVigencia->Exportable) $Doc->ExportCaption($this->pFimVigencia);
					if ($this->pData->Exportable) $Doc->ExportCaption($this->pData);
					if ($this->pValor->Exportable) $Doc->ExportCaption($this->pValor);
					if ($this->pOrigem->Exportable) $Doc->ExportCaption($this->pOrigem);
					if ($this->pEntidadeEdereco->Exportable) $Doc->ExportCaption($this->pEntidadeEdereco);
					if ($this->pEntidadeLei->Exportable) $Doc->ExportCaption($this->pEntidadeLei);
					if ($this->pEntidadeCebas->Exportable) $Doc->ExportCaption($this->pEntidadeCebas);
					if ($this->pRespNome->Exportable) $Doc->ExportCaption($this->pRespNome);
					if ($this->pRespCargo->Exportable) $Doc->ExportCaption($this->pRespCargo);
					if ($this->pRespEdereco->Exportable) $Doc->ExportCaption($this->pRespEdereco);
					if ($this->pRespContato->Exportable) $Doc->ExportCaption($this->pRespContato);
					if ($this->pRespAta->Exportable) $Doc->ExportCaption($this->pRespAta);
					if ($this->pContNome->Exportable) $Doc->ExportCaption($this->pContNome);
					if ($this->pContEndereco->Exportable) $Doc->ExportCaption($this->pContEndereco);
					if ($this->pContContato->Exportable) $Doc->ExportCaption($this->pContContato);
					if ($this->pContDocumento->Exportable) $Doc->ExportCaption($this->pContDocumento);
					if ($this->pPrencherNome->Exportable) $Doc->ExportCaption($this->pPrencherNome);
					if ($this->pPrencherCargo->Exportable) $Doc->ExportCaption($this->pPrencherCargo);
					if ($this->pPrencherEndereco->Exportable) $Doc->ExportCaption($this->pPrencherEndereco);
					if ($this->pPrencherContato->Exportable) $Doc->ExportCaption($this->pPrencherContato);
					if ($this->pPrencherDocumento->Exportable) $Doc->ExportCaption($this->pPrencherDocumento);
					if ($this->rIDRepasse->Exportable) $Doc->ExportCaption($this->rIDRepasse);
					if ($this->rFaixaEtaria->Exportable) $Doc->ExportCaption($this->rFaixaEtaria);
					if ($this->rMeta->Exportable) $Doc->ExportCaption($this->rMeta);
					if ($this->rValorUnitario->Exportable) $Doc->ExportCaption($this->rValorUnitario);
					if ($this->rValorMensal->Exportable) $Doc->ExportCaption($this->rValorMensal);
					if ($this->rValorPrevisto->Exportable) $Doc->ExportCaption($this->rValorPrevisto);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->pExercicio->Exportable) $Doc->ExportField($this->pExercicio);
						if ($this->pTermoNumero->Exportable) $Doc->ExportField($this->pTermoNumero);
						if ($this->pNumero->Exportable) $Doc->ExportField($this->pNumero);
						if ($this->pInicioVigencia->Exportable) $Doc->ExportField($this->pInicioVigencia);
						if ($this->pFimVigencia->Exportable) $Doc->ExportField($this->pFimVigencia);
						if ($this->pData->Exportable) $Doc->ExportField($this->pData);
						if ($this->pValor->Exportable) $Doc->ExportField($this->pValor);
						if ($this->pObjeto->Exportable) $Doc->ExportField($this->pObjeto);
						if ($this->pMetas->Exportable) $Doc->ExportField($this->pMetas);
						if ($this->pOrigem->Exportable) $Doc->ExportField($this->pOrigem);
						if ($this->pEntidadeEdereco->Exportable) $Doc->ExportField($this->pEntidadeEdereco);
						if ($this->pEntidadeEstatuto->Exportable) $Doc->ExportField($this->pEntidadeEstatuto);
						if ($this->pEntidadeLei->Exportable) $Doc->ExportField($this->pEntidadeLei);
						if ($this->pEntidadeCebas->Exportable) $Doc->ExportField($this->pEntidadeCebas);
						if ($this->pRespNome->Exportable) $Doc->ExportField($this->pRespNome);
						if ($this->pRespCargo->Exportable) $Doc->ExportField($this->pRespCargo);
						if ($this->pRespEdereco->Exportable) $Doc->ExportField($this->pRespEdereco);
						if ($this->pRespContato->Exportable) $Doc->ExportField($this->pRespContato);
						if ($this->pRespAta->Exportable) $Doc->ExportField($this->pRespAta);
						if ($this->pContNome->Exportable) $Doc->ExportField($this->pContNome);
						if ($this->pContEndereco->Exportable) $Doc->ExportField($this->pContEndereco);
						if ($this->pContContato->Exportable) $Doc->ExportField($this->pContContato);
						if ($this->pContDocumento->Exportable) $Doc->ExportField($this->pContDocumento);
						if ($this->pPrencherNome->Exportable) $Doc->ExportField($this->pPrencherNome);
						if ($this->pPrencherCargo->Exportable) $Doc->ExportField($this->pPrencherCargo);
						if ($this->pPrencherEndereco->Exportable) $Doc->ExportField($this->pPrencherEndereco);
						if ($this->pPrencherContato->Exportable) $Doc->ExportField($this->pPrencherContato);
						if ($this->pPrencherDocumento->Exportable) $Doc->ExportField($this->pPrencherDocumento);
						if ($this->rIDRepasse->Exportable) $Doc->ExportField($this->rIDRepasse);
						if ($this->rFaixaEtaria->Exportable) $Doc->ExportField($this->rFaixaEtaria);
						if ($this->rMeta->Exportable) $Doc->ExportField($this->rMeta);
						if ($this->rValorUnitario->Exportable) $Doc->ExportField($this->rValorUnitario);
						if ($this->rValorMensal->Exportable) $Doc->ExportField($this->rValorMensal);
						if ($this->rValorPrevisto->Exportable) $Doc->ExportField($this->rValorPrevisto);
					} else {
						if ($this->pExercicio->Exportable) $Doc->ExportField($this->pExercicio);
						if ($this->pTermoNumero->Exportable) $Doc->ExportField($this->pTermoNumero);
						if ($this->pNumero->Exportable) $Doc->ExportField($this->pNumero);
						if ($this->pInicioVigencia->Exportable) $Doc->ExportField($this->pInicioVigencia);
						if ($this->pFimVigencia->Exportable) $Doc->ExportField($this->pFimVigencia);
						if ($this->pData->Exportable) $Doc->ExportField($this->pData);
						if ($this->pValor->Exportable) $Doc->ExportField($this->pValor);
						if ($this->pOrigem->Exportable) $Doc->ExportField($this->pOrigem);
						if ($this->pEntidadeEdereco->Exportable) $Doc->ExportField($this->pEntidadeEdereco);
						if ($this->pEntidadeLei->Exportable) $Doc->ExportField($this->pEntidadeLei);
						if ($this->pEntidadeCebas->Exportable) $Doc->ExportField($this->pEntidadeCebas);
						if ($this->pRespNome->Exportable) $Doc->ExportField($this->pRespNome);
						if ($this->pRespCargo->Exportable) $Doc->ExportField($this->pRespCargo);
						if ($this->pRespEdereco->Exportable) $Doc->ExportField($this->pRespEdereco);
						if ($this->pRespContato->Exportable) $Doc->ExportField($this->pRespContato);
						if ($this->pRespAta->Exportable) $Doc->ExportField($this->pRespAta);
						if ($this->pContNome->Exportable) $Doc->ExportField($this->pContNome);
						if ($this->pContEndereco->Exportable) $Doc->ExportField($this->pContEndereco);
						if ($this->pContContato->Exportable) $Doc->ExportField($this->pContContato);
						if ($this->pContDocumento->Exportable) $Doc->ExportField($this->pContDocumento);
						if ($this->pPrencherNome->Exportable) $Doc->ExportField($this->pPrencherNome);
						if ($this->pPrencherCargo->Exportable) $Doc->ExportField($this->pPrencherCargo);
						if ($this->pPrencherEndereco->Exportable) $Doc->ExportField($this->pPrencherEndereco);
						if ($this->pPrencherContato->Exportable) $Doc->ExportField($this->pPrencherContato);
						if ($this->pPrencherDocumento->Exportable) $Doc->ExportField($this->pPrencherDocumento);
						if ($this->rIDRepasse->Exportable) $Doc->ExportField($this->rIDRepasse);
						if ($this->rFaixaEtaria->Exportable) $Doc->ExportField($this->rFaixaEtaria);
						if ($this->rMeta->Exportable) $Doc->ExportField($this->rMeta);
						if ($this->rValorUnitario->Exportable) $Doc->ExportField($this->rValorUnitario);
						if ($this->rValorMensal->Exportable) $Doc->ExportField($this->rValorMensal);
						if ($this->rValorPrevisto->Exportable) $Doc->ExportField($this->rValorPrevisto);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

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
