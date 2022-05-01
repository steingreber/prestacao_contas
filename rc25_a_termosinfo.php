<?php

// Global variable for table object
$rc25_a_termos = NULL;

//
// Table class for rc25_a_termos
//
class crc25_a_termos extends cTable {
	var $processo_id;
	var $processo_exercicio;
	var $processo_termo_num;
	var $processo_numero;
	var $processo_vigencia_ini;
	var $processo_vigencia_fim;
	var $processo_data;
	var $processo_valor;
	var $processo_objeto;
	var $processo_metas;
	var $processo_origem;
	var $processo_ent_endereco;
	var $processo_ent_estatuto;
	var $processo_ent_lei;
	var $processo_ent_cebas;
	var $processo_resp_nome;
	var $processo_resp_cargo;
	var $processo_resp_end;
	var $processo_resp_contato;
	var $processo_resp_ata;
	var $processo_cont_nome;
	var $processo_cont_end;
	var $processo_cont_contato;
	var $processo_cont_indent;
	var $processo_preenc_nome;
	var $processo_preenc_carg;
	var $processo_preenc_end;
	var $processo_preenc_contato;
	var $processo_preenc_indentifica;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_a_termos';
		$this->TableName = 'rc25_a_termos';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_a_termos`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// processo_id
		$this->processo_id = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_id', 'processo_id', '`processo_id`', '`processo_id`', 21, -1, FALSE, '`processo_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->processo_id->Sortable = FALSE; // Allow sort
		$this->processo_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['processo_id'] = &$this->processo_id;

		// processo_exercicio
		$this->processo_exercicio = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_exercicio', 'processo_exercicio', '`processo_exercicio`', '`processo_exercicio`', 3, -1, FALSE, '`processo_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->processo_exercicio->Sortable = FALSE; // Allow sort
		$this->processo_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->processo_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->processo_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['processo_exercicio'] = &$this->processo_exercicio;

		// processo_termo_num
		$this->processo_termo_num = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_termo_num', 'processo_termo_num', '`processo_termo_num`', '`processo_termo_num`', 200, -1, FALSE, '`processo_termo_num`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_termo_num->Sortable = FALSE; // Allow sort
		$this->fields['processo_termo_num'] = &$this->processo_termo_num;

		// processo_numero
		$this->processo_numero = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_numero', 'processo_numero', '`processo_numero`', '`processo_numero`', 200, -1, FALSE, '`processo_numero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_numero->Sortable = FALSE; // Allow sort
		$this->fields['processo_numero'] = &$this->processo_numero;

		// processo_vigencia_ini
		$this->processo_vigencia_ini = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_vigencia_ini', 'processo_vigencia_ini', '`processo_vigencia_ini`', ew_CastDateFieldForLike('`processo_vigencia_ini`', 6, "DB"), 133, 6, FALSE, '`processo_vigencia_ini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_vigencia_ini->Sortable = FALSE; // Allow sort
		$this->processo_vigencia_ini->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateMDY"));
		$this->fields['processo_vigencia_ini'] = &$this->processo_vigencia_ini;

		// processo_vigencia_fim
		$this->processo_vigencia_fim = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_vigencia_fim', 'processo_vigencia_fim', '`processo_vigencia_fim`', ew_CastDateFieldForLike('`processo_vigencia_fim`', 7, "DB"), 133, 7, FALSE, '`processo_vigencia_fim`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_vigencia_fim->Sortable = FALSE; // Allow sort
		$this->processo_vigencia_fim->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['processo_vigencia_fim'] = &$this->processo_vigencia_fim;

		// processo_data
		$this->processo_data = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_data', 'processo_data', '`processo_data`', ew_CastDateFieldForLike('`processo_data`', 7, "DB"), 133, 7, FALSE, '`processo_data`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_data->Sortable = FALSE; // Allow sort
		$this->processo_data->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['processo_data'] = &$this->processo_data;

		// processo_valor
		$this->processo_valor = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_valor', 'processo_valor', '`processo_valor`', '`processo_valor`', 5, -1, FALSE, '`processo_valor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_valor->Sortable = FALSE; // Allow sort
		$this->processo_valor->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['processo_valor'] = &$this->processo_valor;

		// processo_objeto
		$this->processo_objeto = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_objeto', 'processo_objeto', '`processo_objeto`', '`processo_objeto`', 201, -1, FALSE, '`processo_objeto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->processo_objeto->Sortable = FALSE; // Allow sort
		$this->fields['processo_objeto'] = &$this->processo_objeto;

		// processo_metas
		$this->processo_metas = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_metas', 'processo_metas', '`processo_metas`', '`processo_metas`', 201, -1, FALSE, '`processo_metas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->processo_metas->Sortable = FALSE; // Allow sort
		$this->fields['processo_metas'] = &$this->processo_metas;

		// processo_origem
		$this->processo_origem = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_origem', 'processo_origem', '`processo_origem`', '`processo_origem`', 200, -1, FALSE, '`processo_origem`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_origem->Sortable = FALSE; // Allow sort
		$this->fields['processo_origem'] = &$this->processo_origem;

		// processo_ent_endereco
		$this->processo_ent_endereco = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_ent_endereco', 'processo_ent_endereco', '`processo_ent_endereco`', '`processo_ent_endereco`', 200, -1, FALSE, '`processo_ent_endereco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_ent_endereco->Sortable = FALSE; // Allow sort
		$this->fields['processo_ent_endereco'] = &$this->processo_ent_endereco;

		// processo_ent_estatuto
		$this->processo_ent_estatuto = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_ent_estatuto', 'processo_ent_estatuto', '`processo_ent_estatuto`', '`processo_ent_estatuto`', 205, -1, TRUE, '`processo_ent_estatuto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->processo_ent_estatuto->Sortable = FALSE; // Allow sort
		$this->fields['processo_ent_estatuto'] = &$this->processo_ent_estatuto;

		// processo_ent_lei
		$this->processo_ent_lei = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_ent_lei', 'processo_ent_lei', '`processo_ent_lei`', '`processo_ent_lei`', 200, -1, FALSE, '`processo_ent_lei`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_ent_lei->Sortable = FALSE; // Allow sort
		$this->fields['processo_ent_lei'] = &$this->processo_ent_lei;

		// processo_ent_cebas
		$this->processo_ent_cebas = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_ent_cebas', 'processo_ent_cebas', '`processo_ent_cebas`', '`processo_ent_cebas`', 200, -1, FALSE, '`processo_ent_cebas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_ent_cebas->Sortable = FALSE; // Allow sort
		$this->fields['processo_ent_cebas'] = &$this->processo_ent_cebas;

		// processo_resp_nome
		$this->processo_resp_nome = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_resp_nome', 'processo_resp_nome', '`processo_resp_nome`', '`processo_resp_nome`', 200, -1, FALSE, '`processo_resp_nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_resp_nome->Sortable = FALSE; // Allow sort
		$this->fields['processo_resp_nome'] = &$this->processo_resp_nome;

		// processo_resp_cargo
		$this->processo_resp_cargo = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_resp_cargo', 'processo_resp_cargo', '`processo_resp_cargo`', '`processo_resp_cargo`', 200, -1, FALSE, '`processo_resp_cargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_resp_cargo->Sortable = FALSE; // Allow sort
		$this->fields['processo_resp_cargo'] = &$this->processo_resp_cargo;

		// processo_resp_end
		$this->processo_resp_end = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_resp_end', 'processo_resp_end', '`processo_resp_end`', '`processo_resp_end`', 200, -1, FALSE, '`processo_resp_end`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_resp_end->Sortable = FALSE; // Allow sort
		$this->fields['processo_resp_end'] = &$this->processo_resp_end;

		// processo_resp_contato
		$this->processo_resp_contato = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_resp_contato', 'processo_resp_contato', '`processo_resp_contato`', '`processo_resp_contato`', 200, -1, FALSE, '`processo_resp_contato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_resp_contato->Sortable = FALSE; // Allow sort
		$this->fields['processo_resp_contato'] = &$this->processo_resp_contato;

		// processo_resp_ata
		$this->processo_resp_ata = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_resp_ata', 'processo_resp_ata', '`processo_resp_ata`', '`processo_resp_ata`', 200, -1, FALSE, '`processo_resp_ata`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_resp_ata->Sortable = FALSE; // Allow sort
		$this->fields['processo_resp_ata'] = &$this->processo_resp_ata;

		// processo_cont_nome
		$this->processo_cont_nome = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_cont_nome', 'processo_cont_nome', '`processo_cont_nome`', '`processo_cont_nome`', 200, -1, FALSE, '`processo_cont_nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_cont_nome->Sortable = FALSE; // Allow sort
		$this->fields['processo_cont_nome'] = &$this->processo_cont_nome;

		// processo_cont_end
		$this->processo_cont_end = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_cont_end', 'processo_cont_end', '`processo_cont_end`', '`processo_cont_end`', 200, -1, FALSE, '`processo_cont_end`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_cont_end->Sortable = FALSE; // Allow sort
		$this->fields['processo_cont_end'] = &$this->processo_cont_end;

		// processo_cont_contato
		$this->processo_cont_contato = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_cont_contato', 'processo_cont_contato', '`processo_cont_contato`', '`processo_cont_contato`', 200, -1, FALSE, '`processo_cont_contato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_cont_contato->Sortable = FALSE; // Allow sort
		$this->fields['processo_cont_contato'] = &$this->processo_cont_contato;

		// processo_cont_indent
		$this->processo_cont_indent = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_cont_indent', 'processo_cont_indent', '`processo_cont_indent`', '`processo_cont_indent`', 200, -1, FALSE, '`processo_cont_indent`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_cont_indent->Sortable = FALSE; // Allow sort
		$this->fields['processo_cont_indent'] = &$this->processo_cont_indent;

		// processo_preenc_nome
		$this->processo_preenc_nome = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_preenc_nome', 'processo_preenc_nome', '`processo_preenc_nome`', '`processo_preenc_nome`', 200, -1, FALSE, '`processo_preenc_nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_preenc_nome->Sortable = FALSE; // Allow sort
		$this->fields['processo_preenc_nome'] = &$this->processo_preenc_nome;

		// processo_preenc_carg
		$this->processo_preenc_carg = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_preenc_carg', 'processo_preenc_carg', '`processo_preenc_carg`', '`processo_preenc_carg`', 200, -1, FALSE, '`processo_preenc_carg`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_preenc_carg->Sortable = FALSE; // Allow sort
		$this->fields['processo_preenc_carg'] = &$this->processo_preenc_carg;

		// processo_preenc_end
		$this->processo_preenc_end = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_preenc_end', 'processo_preenc_end', '`processo_preenc_end`', '`processo_preenc_end`', 200, -1, FALSE, '`processo_preenc_end`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_preenc_end->Sortable = FALSE; // Allow sort
		$this->fields['processo_preenc_end'] = &$this->processo_preenc_end;

		// processo_preenc_contato
		$this->processo_preenc_contato = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_preenc_contato', 'processo_preenc_contato', '`processo_preenc_contato`', '`processo_preenc_contato`', 200, -1, FALSE, '`processo_preenc_contato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_preenc_contato->Sortable = FALSE; // Allow sort
		$this->fields['processo_preenc_contato'] = &$this->processo_preenc_contato;

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica = new cField('rc25_a_termos', 'rc25_a_termos', 'x_processo_preenc_indentifica', 'processo_preenc_indentifica', '`processo_preenc_indentifica`', '`processo_preenc_indentifica`', 200, -1, FALSE, '`processo_preenc_indentifica`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->processo_preenc_indentifica->Sortable = FALSE; // Allow sort
		$this->fields['processo_preenc_indentifica'] = &$this->processo_preenc_indentifica;
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

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "rc25_a_repasses") {
			$sDetailUrl = $GLOBALS["rc25_a_repasses"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_processo_id=" . urlencode($this->processo_id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "rc25_a_planos_aplicacao") {
			$sDetailUrl = $GLOBALS["rc25_a_planos_aplicacao"]->GetListUrl() . "?" . EW_TABLE_SHOW_MASTER . "=" . $this->TableVar;
			$sDetailUrl .= "&fk_processo_exercicio=" . urlencode($this->processo_exercicio->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "rc25_a_termoslist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_a_termos`";
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

			// Get insert id if necessary
			$this->processo_id->setDbValue($conn->Insert_ID());
			$rs['processo_id'] = $this->processo_id->DbValue;
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

		// Cascade Update detail table 'rc25_a_repasses'
		$bCascadeUpdate = FALSE;
		$rscascade = array();
		if (!is_null($rsold) && (isset($rs['processo_id']) && $rsold['processo_id'] <> $rs['processo_id'])) { // Update detail field 'repasse_id_termos'
			$bCascadeUpdate = TRUE;
			$rscascade['repasse_id_termos'] = $rs['processo_id']; 
		}
		if ($bCascadeUpdate) {
			if (!isset($GLOBALS["rc25_a_repasses"])) $GLOBALS["rc25_a_repasses"] = new crc25_a_repasses();
			$rswrk = $GLOBALS["rc25_a_repasses"]->LoadRs("`repasse_id_termos` = " . ew_QuotedValue($rsold['processo_id'], EW_DATATYPE_NUMBER, 'DB')); 
			while ($rswrk && !$rswrk->EOF) {
				$rskey = array();
				$fldname = 'repasse_id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$bUpdate = $GLOBALS["rc25_a_repasses"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($bUpdate)
					$bUpdate = $GLOBALS["rc25_a_repasses"]->Update($rscascade, $rskey, $rswrk->fields);
				if (!$bUpdate) return FALSE;

				// Call Row_Updated event
				$GLOBALS["rc25_a_repasses"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->MoveNext();
			}
		}
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('processo_id', $rs))
				ew_AddFilter($where, ew_QuotedName('processo_id', $this->DBID) . '=' . ew_QuotedValue($rs['processo_id'], $this->processo_id->FldDataType, $this->DBID));
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

		// Cascade delete detail table 'rc25_a_repasses'
		if (!isset($GLOBALS["rc25_a_repasses"])) $GLOBALS["rc25_a_repasses"] = new crc25_a_repasses();
		$rscascade = $GLOBALS["rc25_a_repasses"]->LoadRs("`repasse_id_termos` = " . ew_QuotedValue($rs['processo_id'], EW_DATATYPE_NUMBER, "DB")); 
		$dtlrows = ($rscascade) ? $rscascade->GetRows() : array();

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$bDelete = $GLOBALS["rc25_a_repasses"]->Row_Deleting($dtlrow);
			if (!$bDelete) break;
		}
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$bDelete = $GLOBALS["rc25_a_repasses"]->Delete($dtlrow); // Delete
				if ($bDelete === FALSE)
					break;
			}
		}

		// Call Row Deleted event
		if ($bDelete) {
			foreach ($dtlrows as $dtlrow) {
				$GLOBALS["rc25_a_repasses"]->Row_Deleted($dtlrow);
			}
		}
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`processo_id` = @processo_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->processo_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->processo_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@processo_id@", ew_AdjustSql($this->processo_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_a_termoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_a_termosview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_a_termosedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_a_termosadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_a_termoslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_termosview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_termosview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_a_termosadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_a_termosadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_termosedit.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_termosedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_termosadd.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_termosadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_a_termosdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "processo_id:" . ew_VarToJson($this->processo_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->processo_id->CurrentValue)) {
			$sUrl .= "processo_id=" . urlencode($this->processo_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
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
			if ($isPost && isset($_POST["processo_id"]))
				$arKeys[] = $_POST["processo_id"];
			elseif (isset($_GET["processo_id"]))
				$arKeys[] = $_GET["processo_id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
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
			$this->processo_id->CurrentValue = $key;
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
		$this->processo_id->setDbValue($rs->fields('processo_id'));
		$this->processo_exercicio->setDbValue($rs->fields('processo_exercicio'));
		$this->processo_termo_num->setDbValue($rs->fields('processo_termo_num'));
		$this->processo_numero->setDbValue($rs->fields('processo_numero'));
		$this->processo_vigencia_ini->setDbValue($rs->fields('processo_vigencia_ini'));
		$this->processo_vigencia_fim->setDbValue($rs->fields('processo_vigencia_fim'));
		$this->processo_data->setDbValue($rs->fields('processo_data'));
		$this->processo_valor->setDbValue($rs->fields('processo_valor'));
		$this->processo_objeto->setDbValue($rs->fields('processo_objeto'));
		$this->processo_metas->setDbValue($rs->fields('processo_metas'));
		$this->processo_origem->setDbValue($rs->fields('processo_origem'));
		$this->processo_ent_endereco->setDbValue($rs->fields('processo_ent_endereco'));
		$this->processo_ent_estatuto->Upload->DbValue = $rs->fields('processo_ent_estatuto');
		$this->processo_ent_lei->setDbValue($rs->fields('processo_ent_lei'));
		$this->processo_ent_cebas->setDbValue($rs->fields('processo_ent_cebas'));
		$this->processo_resp_nome->setDbValue($rs->fields('processo_resp_nome'));
		$this->processo_resp_cargo->setDbValue($rs->fields('processo_resp_cargo'));
		$this->processo_resp_end->setDbValue($rs->fields('processo_resp_end'));
		$this->processo_resp_contato->setDbValue($rs->fields('processo_resp_contato'));
		$this->processo_resp_ata->setDbValue($rs->fields('processo_resp_ata'));
		$this->processo_cont_nome->setDbValue($rs->fields('processo_cont_nome'));
		$this->processo_cont_end->setDbValue($rs->fields('processo_cont_end'));
		$this->processo_cont_contato->setDbValue($rs->fields('processo_cont_contato'));
		$this->processo_cont_indent->setDbValue($rs->fields('processo_cont_indent'));
		$this->processo_preenc_nome->setDbValue($rs->fields('processo_preenc_nome'));
		$this->processo_preenc_carg->setDbValue($rs->fields('processo_preenc_carg'));
		$this->processo_preenc_end->setDbValue($rs->fields('processo_preenc_end'));
		$this->processo_preenc_contato->setDbValue($rs->fields('processo_preenc_contato'));
		$this->processo_preenc_indentifica->setDbValue($rs->fields('processo_preenc_indentifica'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// processo_id

		$this->processo_id->CellCssStyle = "white-space: nowrap;";

		// processo_exercicio
		// processo_termo_num

		$this->processo_termo_num->CellCssStyle = "white-space: nowrap;";

		// processo_numero
		$this->processo_numero->CellCssStyle = "white-space: nowrap;";

		// processo_vigencia_ini
		$this->processo_vigencia_ini->CellCssStyle = "width: 120px; white-space: nowrap;";

		// processo_vigencia_fim
		$this->processo_vigencia_fim->CellCssStyle = "width: 120px; white-space: nowrap;";

		// processo_data
		$this->processo_data->CellCssStyle = "white-space: nowrap;";

		// processo_valor
		$this->processo_valor->CellCssStyle = "white-space: nowrap;";

		// processo_objeto
		$this->processo_objeto->CellCssStyle = "white-space: nowrap;";

		// processo_metas
		$this->processo_metas->CellCssStyle = "white-space: nowrap;";

		// processo_origem
		$this->processo_origem->CellCssStyle = "white-space: nowrap;";

		// processo_ent_endereco
		$this->processo_ent_endereco->CellCssStyle = "white-space: nowrap;";

		// processo_ent_estatuto
		$this->processo_ent_estatuto->CellCssStyle = "white-space: nowrap;";

		// processo_ent_lei
		$this->processo_ent_lei->CellCssStyle = "white-space: nowrap;";

		// processo_ent_cebas
		$this->processo_ent_cebas->CellCssStyle = "white-space: nowrap;";

		// processo_resp_nome
		$this->processo_resp_nome->CellCssStyle = "white-space: nowrap;";

		// processo_resp_cargo
		$this->processo_resp_cargo->CellCssStyle = "white-space: nowrap;";

		// processo_resp_end
		$this->processo_resp_end->CellCssStyle = "white-space: nowrap;";

		// processo_resp_contato
		$this->processo_resp_contato->CellCssStyle = "white-space: nowrap;";

		// processo_resp_ata
		$this->processo_resp_ata->CellCssStyle = "white-space: nowrap;";

		// processo_cont_nome
		$this->processo_cont_nome->CellCssStyle = "white-space: nowrap;";

		// processo_cont_end
		$this->processo_cont_end->CellCssStyle = "white-space: nowrap;";

		// processo_cont_contato
		$this->processo_cont_contato->CellCssStyle = "white-space: nowrap;";

		// processo_cont_indent
		$this->processo_cont_indent->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_nome
		$this->processo_preenc_nome->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_carg
		$this->processo_preenc_carg->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_end
		$this->processo_preenc_end->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_contato
		$this->processo_preenc_contato->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->CellCssStyle = "white-space: nowrap;";

		// processo_id
		$this->processo_id->ViewValue = $this->processo_id->CurrentValue;
		$this->processo_id->ViewCustomAttributes = "";

		// processo_exercicio
		if (strval($this->processo_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->processo_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->processo_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->processo_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->processo_exercicio->ViewValue = $this->processo_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->processo_exercicio->ViewValue = $this->processo_exercicio->CurrentValue;
			}
		} else {
			$this->processo_exercicio->ViewValue = NULL;
		}
		$this->processo_exercicio->CssStyle = "font-weight: bold;";
		$this->processo_exercicio->ViewCustomAttributes = "";

		// processo_termo_num
		$this->processo_termo_num->ViewValue = $this->processo_termo_num->CurrentValue;
		$this->processo_termo_num->ViewCustomAttributes = "";

		// processo_numero
		$this->processo_numero->ViewValue = $this->processo_numero->CurrentValue;
		$this->processo_numero->ViewCustomAttributes = "";

		// processo_vigencia_ini
		$this->processo_vigencia_ini->ViewValue = $this->processo_vigencia_ini->CurrentValue;
		$this->processo_vigencia_ini->ViewValue = ew_FormatDateTime($this->processo_vigencia_ini->ViewValue, 6);
		$this->processo_vigencia_ini->ViewCustomAttributes = "";

		// processo_vigencia_fim
		$this->processo_vigencia_fim->ViewValue = $this->processo_vigencia_fim->CurrentValue;
		$this->processo_vigencia_fim->ViewValue = ew_FormatDateTime($this->processo_vigencia_fim->ViewValue, 7);
		$this->processo_vigencia_fim->ViewCustomAttributes = "";

		// processo_data
		$this->processo_data->ViewValue = $this->processo_data->CurrentValue;
		$this->processo_data->ViewValue = ew_FormatDateTime($this->processo_data->ViewValue, 7);
		$this->processo_data->ViewCustomAttributes = "";

		// processo_valor
		$this->processo_valor->ViewValue = $this->processo_valor->CurrentValue;
		$this->processo_valor->ViewValue = ew_FormatCurrency($this->processo_valor->ViewValue, 2, -1, -2, -2);
		$this->processo_valor->ViewCustomAttributes = "";

		// processo_objeto
		$this->processo_objeto->ViewValue = $this->processo_objeto->CurrentValue;
		$this->processo_objeto->ViewCustomAttributes = "";

		// processo_metas
		$this->processo_metas->ViewValue = $this->processo_metas->CurrentValue;
		$this->processo_metas->ViewCustomAttributes = "";

		// processo_origem
		$this->processo_origem->ViewValue = $this->processo_origem->CurrentValue;
		$this->processo_origem->ViewCustomAttributes = "";

		// processo_ent_endereco
		$this->processo_ent_endereco->ViewValue = $this->processo_ent_endereco->CurrentValue;
		$this->processo_ent_endereco->ViewCustomAttributes = "";

		// processo_ent_estatuto
		if (!ew_Empty($this->processo_ent_estatuto->Upload->DbValue)) {
			$this->processo_ent_estatuto->ViewValue = "rc25_a_termos_processo_ent_estatuto_bv.php?" . "processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->processo_ent_estatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->processo_ent_estatuto->ViewValue = "";
		}
		$this->processo_ent_estatuto->ViewCustomAttributes = "";

		// processo_ent_lei
		$this->processo_ent_lei->ViewValue = $this->processo_ent_lei->CurrentValue;
		$this->processo_ent_lei->ViewCustomAttributes = "";

		// processo_ent_cebas
		$this->processo_ent_cebas->ViewValue = $this->processo_ent_cebas->CurrentValue;
		$this->processo_ent_cebas->ViewCustomAttributes = "";

		// processo_resp_nome
		$this->processo_resp_nome->ViewValue = $this->processo_resp_nome->CurrentValue;
		$this->processo_resp_nome->ViewCustomAttributes = "";

		// processo_resp_cargo
		$this->processo_resp_cargo->ViewValue = $this->processo_resp_cargo->CurrentValue;
		$this->processo_resp_cargo->ViewCustomAttributes = "";

		// processo_resp_end
		$this->processo_resp_end->ViewValue = $this->processo_resp_end->CurrentValue;
		$this->processo_resp_end->ViewCustomAttributes = "";

		// processo_resp_contato
		$this->processo_resp_contato->ViewValue = $this->processo_resp_contato->CurrentValue;
		$this->processo_resp_contato->ViewCustomAttributes = "";

		// processo_resp_ata
		$this->processo_resp_ata->ViewValue = $this->processo_resp_ata->CurrentValue;
		$this->processo_resp_ata->ViewCustomAttributes = "";

		// processo_cont_nome
		$this->processo_cont_nome->ViewValue = $this->processo_cont_nome->CurrentValue;
		$this->processo_cont_nome->ViewCustomAttributes = "";

		// processo_cont_end
		$this->processo_cont_end->ViewValue = $this->processo_cont_end->CurrentValue;
		$this->processo_cont_end->ViewCustomAttributes = "";

		// processo_cont_contato
		$this->processo_cont_contato->ViewValue = $this->processo_cont_contato->CurrentValue;
		$this->processo_cont_contato->ViewCustomAttributes = "";

		// processo_cont_indent
		$this->processo_cont_indent->ViewValue = $this->processo_cont_indent->CurrentValue;
		$this->processo_cont_indent->ViewCustomAttributes = "";

		// processo_preenc_nome
		$this->processo_preenc_nome->ViewValue = $this->processo_preenc_nome->CurrentValue;
		$this->processo_preenc_nome->ViewCustomAttributes = "";

		// processo_preenc_carg
		$this->processo_preenc_carg->ViewValue = $this->processo_preenc_carg->CurrentValue;
		$this->processo_preenc_carg->ViewCustomAttributes = "";

		// processo_preenc_end
		$this->processo_preenc_end->ViewValue = $this->processo_preenc_end->CurrentValue;
		$this->processo_preenc_end->ViewCustomAttributes = "";

		// processo_preenc_contato
		$this->processo_preenc_contato->ViewValue = $this->processo_preenc_contato->CurrentValue;
		$this->processo_preenc_contato->ViewCustomAttributes = "";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->ViewValue = $this->processo_preenc_indentifica->CurrentValue;
		$this->processo_preenc_indentifica->ViewCustomAttributes = "";

		// processo_id
		$this->processo_id->LinkCustomAttributes = "";
		$this->processo_id->HrefValue = "";
		$this->processo_id->TooltipValue = "";

		// processo_exercicio
		$this->processo_exercicio->LinkCustomAttributes = "";
		$this->processo_exercicio->HrefValue = "";
		$this->processo_exercicio->TooltipValue = "";

		// processo_termo_num
		$this->processo_termo_num->LinkCustomAttributes = "";
		$this->processo_termo_num->HrefValue = "";
		$this->processo_termo_num->TooltipValue = "";

		// processo_numero
		$this->processo_numero->LinkCustomAttributes = "";
		$this->processo_numero->HrefValue = "";
		$this->processo_numero->TooltipValue = "";

		// processo_vigencia_ini
		$this->processo_vigencia_ini->LinkCustomAttributes = "";
		$this->processo_vigencia_ini->HrefValue = "";
		$this->processo_vigencia_ini->TooltipValue = "";

		// processo_vigencia_fim
		$this->processo_vigencia_fim->LinkCustomAttributes = "";
		$this->processo_vigencia_fim->HrefValue = "";
		$this->processo_vigencia_fim->TooltipValue = "";

		// processo_data
		$this->processo_data->LinkCustomAttributes = "";
		$this->processo_data->HrefValue = "";
		$this->processo_data->TooltipValue = "";

		// processo_valor
		$this->processo_valor->LinkCustomAttributes = "";
		$this->processo_valor->HrefValue = "";
		if ($this->Export == "") {
			$this->processo_valor->TooltipValue = ($this->processo_valor->ViewValue <> "") ? $this->processo_valor->ViewValue : $this->processo_valor->CurrentValue;
			if ($this->processo_valor->HrefValue == "") $this->processo_valor->HrefValue = "javascript:void(0);";
			ew_AppendClass($this->processo_valor->LinkAttrs["class"], "ewTooltipLink");
			$this->processo_valor->LinkAttrs["data-tooltip-id"] = "tt_rc25_a_termos_x" . (($this->RowType <> EW_ROWTYPE_MASTER) ? @$this->RowCnt : "") . "_processo_valor";
			$this->processo_valor->LinkAttrs["data-tooltip-width"] = $this->processo_valor->TooltipWidth;
			$this->processo_valor->LinkAttrs["data-placement"] = $GLOBALS["EW_CSS_FLIP"] ? "left" : "right";
		}

		// processo_objeto
		$this->processo_objeto->LinkCustomAttributes = "";
		$this->processo_objeto->HrefValue = "";
		$this->processo_objeto->TooltipValue = "";

		// processo_metas
		$this->processo_metas->LinkCustomAttributes = "";
		$this->processo_metas->HrefValue = "";
		$this->processo_metas->TooltipValue = "";

		// processo_origem
		$this->processo_origem->LinkCustomAttributes = "";
		$this->processo_origem->HrefValue = "";
		$this->processo_origem->TooltipValue = "";

		// processo_ent_endereco
		$this->processo_ent_endereco->LinkCustomAttributes = "";
		$this->processo_ent_endereco->HrefValue = "";
		$this->processo_ent_endereco->TooltipValue = "";

		// processo_ent_estatuto
		$this->processo_ent_estatuto->LinkCustomAttributes = "";
		if (!empty($this->processo_ent_estatuto->Upload->DbValue)) {
			$this->processo_ent_estatuto->HrefValue = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->processo_ent_estatuto->HrefValue = ew_FullUrl($this->processo_ent_estatuto->HrefValue, "href");
		} else {
			$this->processo_ent_estatuto->HrefValue = "";
		}
		$this->processo_ent_estatuto->HrefValue2 = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
		$this->processo_ent_estatuto->TooltipValue = "";

		// processo_ent_lei
		$this->processo_ent_lei->LinkCustomAttributes = "";
		$this->processo_ent_lei->HrefValue = "";
		$this->processo_ent_lei->TooltipValue = "";

		// processo_ent_cebas
		$this->processo_ent_cebas->LinkCustomAttributes = "";
		$this->processo_ent_cebas->HrefValue = "";
		$this->processo_ent_cebas->TooltipValue = "";

		// processo_resp_nome
		$this->processo_resp_nome->LinkCustomAttributes = "";
		$this->processo_resp_nome->HrefValue = "";
		$this->processo_resp_nome->TooltipValue = "";

		// processo_resp_cargo
		$this->processo_resp_cargo->LinkCustomAttributes = "";
		$this->processo_resp_cargo->HrefValue = "";
		$this->processo_resp_cargo->TooltipValue = "";

		// processo_resp_end
		$this->processo_resp_end->LinkCustomAttributes = "";
		$this->processo_resp_end->HrefValue = "";
		$this->processo_resp_end->TooltipValue = "";

		// processo_resp_contato
		$this->processo_resp_contato->LinkCustomAttributes = "";
		$this->processo_resp_contato->HrefValue = "";
		$this->processo_resp_contato->TooltipValue = "";

		// processo_resp_ata
		$this->processo_resp_ata->LinkCustomAttributes = "";
		$this->processo_resp_ata->HrefValue = "";
		$this->processo_resp_ata->TooltipValue = "";

		// processo_cont_nome
		$this->processo_cont_nome->LinkCustomAttributes = "";
		$this->processo_cont_nome->HrefValue = "";
		$this->processo_cont_nome->TooltipValue = "";

		// processo_cont_end
		$this->processo_cont_end->LinkCustomAttributes = "";
		$this->processo_cont_end->HrefValue = "";
		$this->processo_cont_end->TooltipValue = "";

		// processo_cont_contato
		$this->processo_cont_contato->LinkCustomAttributes = "";
		$this->processo_cont_contato->HrefValue = "";
		$this->processo_cont_contato->TooltipValue = "";

		// processo_cont_indent
		$this->processo_cont_indent->LinkCustomAttributes = "";
		$this->processo_cont_indent->HrefValue = "";
		$this->processo_cont_indent->TooltipValue = "";

		// processo_preenc_nome
		$this->processo_preenc_nome->LinkCustomAttributes = "";
		$this->processo_preenc_nome->HrefValue = "";
		$this->processo_preenc_nome->TooltipValue = "";

		// processo_preenc_carg
		$this->processo_preenc_carg->LinkCustomAttributes = "";
		$this->processo_preenc_carg->HrefValue = "";
		$this->processo_preenc_carg->TooltipValue = "";

		// processo_preenc_end
		$this->processo_preenc_end->LinkCustomAttributes = "";
		$this->processo_preenc_end->HrefValue = "";
		$this->processo_preenc_end->TooltipValue = "";

		// processo_preenc_contato
		$this->processo_preenc_contato->LinkCustomAttributes = "";
		$this->processo_preenc_contato->HrefValue = "";
		$this->processo_preenc_contato->TooltipValue = "";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->LinkCustomAttributes = "";
		$this->processo_preenc_indentifica->HrefValue = "";
		$this->processo_preenc_indentifica->TooltipValue = "";

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

		// processo_id
		$this->processo_id->EditAttrs["class"] = "form-control";
		$this->processo_id->EditCustomAttributes = "";
		$this->processo_id->EditValue = $this->processo_id->CurrentValue;
		$this->processo_id->ViewCustomAttributes = "";

		// processo_exercicio
		$this->processo_exercicio->EditAttrs["class"] = "form-control";
		$this->processo_exercicio->EditCustomAttributes = "";

		// processo_termo_num
		$this->processo_termo_num->EditAttrs["class"] = "form-control";
		$this->processo_termo_num->EditCustomAttributes = "";
		$this->processo_termo_num->EditValue = $this->processo_termo_num->CurrentValue;
		$this->processo_termo_num->PlaceHolder = ew_RemoveHtml($this->processo_termo_num->FldCaption());

		// processo_numero
		$this->processo_numero->EditAttrs["class"] = "form-control";
		$this->processo_numero->EditCustomAttributes = "";
		$this->processo_numero->EditValue = $this->processo_numero->CurrentValue;
		$this->processo_numero->PlaceHolder = ew_RemoveHtml($this->processo_numero->FldCaption());

		// processo_vigencia_ini
		$this->processo_vigencia_ini->EditAttrs["class"] = "form-control";
		$this->processo_vigencia_ini->EditCustomAttributes = "";
		$this->processo_vigencia_ini->EditValue = ew_FormatDateTime($this->processo_vigencia_ini->CurrentValue, 6);
		$this->processo_vigencia_ini->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_ini->FldCaption());

		// processo_vigencia_fim
		$this->processo_vigencia_fim->EditAttrs["class"] = "form-control";
		$this->processo_vigencia_fim->EditCustomAttributes = "";
		$this->processo_vigencia_fim->EditValue = ew_FormatDateTime($this->processo_vigencia_fim->CurrentValue, 7);
		$this->processo_vigencia_fim->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_fim->FldCaption());

		// processo_data
		$this->processo_data->EditAttrs["class"] = "form-control";
		$this->processo_data->EditCustomAttributes = "";
		$this->processo_data->EditValue = ew_FormatDateTime($this->processo_data->CurrentValue, 7);
		$this->processo_data->PlaceHolder = ew_RemoveHtml($this->processo_data->FldCaption());

		// processo_valor
		$this->processo_valor->EditAttrs["class"] = "form-control";
		$this->processo_valor->EditCustomAttributes = "";
		$this->processo_valor->EditValue = $this->processo_valor->CurrentValue;
		$this->processo_valor->PlaceHolder = ew_RemoveHtml($this->processo_valor->FldCaption());
		if (strval($this->processo_valor->EditValue) <> "" && is_numeric($this->processo_valor->EditValue)) $this->processo_valor->EditValue = ew_FormatNumber($this->processo_valor->EditValue, -2, -1, -2, -2);

		// processo_objeto
		$this->processo_objeto->EditAttrs["class"] = "form-control";
		$this->processo_objeto->EditCustomAttributes = "";
		$this->processo_objeto->EditValue = $this->processo_objeto->CurrentValue;
		$this->processo_objeto->PlaceHolder = ew_RemoveHtml($this->processo_objeto->FldCaption());

		// processo_metas
		$this->processo_metas->EditAttrs["class"] = "form-control";
		$this->processo_metas->EditCustomAttributes = "";
		$this->processo_metas->EditValue = $this->processo_metas->CurrentValue;
		$this->processo_metas->PlaceHolder = ew_RemoveHtml($this->processo_metas->FldCaption());

		// processo_origem
		$this->processo_origem->EditAttrs["class"] = "form-control";
		$this->processo_origem->EditCustomAttributes = "";
		$this->processo_origem->EditValue = $this->processo_origem->CurrentValue;
		$this->processo_origem->PlaceHolder = ew_RemoveHtml($this->processo_origem->FldCaption());

		// processo_ent_endereco
		$this->processo_ent_endereco->EditAttrs["class"] = "form-control";
		$this->processo_ent_endereco->EditCustomAttributes = "";
		$this->processo_ent_endereco->EditValue = $this->processo_ent_endereco->CurrentValue;
		$this->processo_ent_endereco->PlaceHolder = ew_RemoveHtml($this->processo_ent_endereco->FldCaption());

		// processo_ent_estatuto
		$this->processo_ent_estatuto->EditAttrs["class"] = "form-control";
		$this->processo_ent_estatuto->EditCustomAttributes = "";
		if (!ew_Empty($this->processo_ent_estatuto->Upload->DbValue)) {
			$this->processo_ent_estatuto->EditValue = "rc25_a_termos_processo_ent_estatuto_bv.php?" . "processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->processo_ent_estatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->processo_ent_estatuto->EditValue = "";
		}

		// processo_ent_lei
		$this->processo_ent_lei->EditAttrs["class"] = "form-control";
		$this->processo_ent_lei->EditCustomAttributes = "";
		$this->processo_ent_lei->EditValue = $this->processo_ent_lei->CurrentValue;
		$this->processo_ent_lei->PlaceHolder = ew_RemoveHtml($this->processo_ent_lei->FldCaption());

		// processo_ent_cebas
		$this->processo_ent_cebas->EditAttrs["class"] = "form-control";
		$this->processo_ent_cebas->EditCustomAttributes = "";
		$this->processo_ent_cebas->EditValue = $this->processo_ent_cebas->CurrentValue;
		$this->processo_ent_cebas->PlaceHolder = ew_RemoveHtml($this->processo_ent_cebas->FldCaption());

		// processo_resp_nome
		$this->processo_resp_nome->EditAttrs["class"] = "form-control";
		$this->processo_resp_nome->EditCustomAttributes = "";
		$this->processo_resp_nome->EditValue = $this->processo_resp_nome->CurrentValue;
		$this->processo_resp_nome->PlaceHolder = ew_RemoveHtml($this->processo_resp_nome->FldCaption());

		// processo_resp_cargo
		$this->processo_resp_cargo->EditAttrs["class"] = "form-control";
		$this->processo_resp_cargo->EditCustomAttributes = "";
		$this->processo_resp_cargo->EditValue = $this->processo_resp_cargo->CurrentValue;
		$this->processo_resp_cargo->PlaceHolder = ew_RemoveHtml($this->processo_resp_cargo->FldCaption());

		// processo_resp_end
		$this->processo_resp_end->EditAttrs["class"] = "form-control";
		$this->processo_resp_end->EditCustomAttributes = "";
		$this->processo_resp_end->EditValue = $this->processo_resp_end->CurrentValue;
		$this->processo_resp_end->PlaceHolder = ew_RemoveHtml($this->processo_resp_end->FldCaption());

		// processo_resp_contato
		$this->processo_resp_contato->EditAttrs["class"] = "form-control";
		$this->processo_resp_contato->EditCustomAttributes = "";
		$this->processo_resp_contato->EditValue = $this->processo_resp_contato->CurrentValue;
		$this->processo_resp_contato->PlaceHolder = ew_RemoveHtml($this->processo_resp_contato->FldCaption());

		// processo_resp_ata
		$this->processo_resp_ata->EditAttrs["class"] = "form-control";
		$this->processo_resp_ata->EditCustomAttributes = "";
		$this->processo_resp_ata->EditValue = $this->processo_resp_ata->CurrentValue;
		$this->processo_resp_ata->PlaceHolder = ew_RemoveHtml($this->processo_resp_ata->FldCaption());

		// processo_cont_nome
		$this->processo_cont_nome->EditAttrs["class"] = "form-control";
		$this->processo_cont_nome->EditCustomAttributes = "";
		$this->processo_cont_nome->EditValue = $this->processo_cont_nome->CurrentValue;
		$this->processo_cont_nome->PlaceHolder = ew_RemoveHtml($this->processo_cont_nome->FldCaption());

		// processo_cont_end
		$this->processo_cont_end->EditAttrs["class"] = "form-control";
		$this->processo_cont_end->EditCustomAttributes = "";
		$this->processo_cont_end->EditValue = $this->processo_cont_end->CurrentValue;
		$this->processo_cont_end->PlaceHolder = ew_RemoveHtml($this->processo_cont_end->FldCaption());

		// processo_cont_contato
		$this->processo_cont_contato->EditAttrs["class"] = "form-control";
		$this->processo_cont_contato->EditCustomAttributes = "";
		$this->processo_cont_contato->EditValue = $this->processo_cont_contato->CurrentValue;
		$this->processo_cont_contato->PlaceHolder = ew_RemoveHtml($this->processo_cont_contato->FldCaption());

		// processo_cont_indent
		$this->processo_cont_indent->EditAttrs["class"] = "form-control";
		$this->processo_cont_indent->EditCustomAttributes = "";
		$this->processo_cont_indent->EditValue = $this->processo_cont_indent->CurrentValue;
		$this->processo_cont_indent->PlaceHolder = ew_RemoveHtml($this->processo_cont_indent->FldCaption());

		// processo_preenc_nome
		$this->processo_preenc_nome->EditAttrs["class"] = "form-control";
		$this->processo_preenc_nome->EditCustomAttributes = "";
		$this->processo_preenc_nome->EditValue = $this->processo_preenc_nome->CurrentValue;
		$this->processo_preenc_nome->PlaceHolder = ew_RemoveHtml($this->processo_preenc_nome->FldCaption());

		// processo_preenc_carg
		$this->processo_preenc_carg->EditAttrs["class"] = "form-control";
		$this->processo_preenc_carg->EditCustomAttributes = "";
		$this->processo_preenc_carg->EditValue = $this->processo_preenc_carg->CurrentValue;
		$this->processo_preenc_carg->PlaceHolder = ew_RemoveHtml($this->processo_preenc_carg->FldCaption());

		// processo_preenc_end
		$this->processo_preenc_end->EditAttrs["class"] = "form-control";
		$this->processo_preenc_end->EditCustomAttributes = "";
		$this->processo_preenc_end->EditValue = $this->processo_preenc_end->CurrentValue;
		$this->processo_preenc_end->PlaceHolder = ew_RemoveHtml($this->processo_preenc_end->FldCaption());

		// processo_preenc_contato
		$this->processo_preenc_contato->EditAttrs["class"] = "form-control";
		$this->processo_preenc_contato->EditCustomAttributes = "";
		$this->processo_preenc_contato->EditValue = $this->processo_preenc_contato->CurrentValue;
		$this->processo_preenc_contato->PlaceHolder = ew_RemoveHtml($this->processo_preenc_contato->FldCaption());

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->EditAttrs["class"] = "form-control";
		$this->processo_preenc_indentifica->EditCustomAttributes = "";
		$this->processo_preenc_indentifica->EditValue = $this->processo_preenc_indentifica->CurrentValue;
		$this->processo_preenc_indentifica->PlaceHolder = ew_RemoveHtml($this->processo_preenc_indentifica->FldCaption());

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
					if ($this->processo_exercicio->Exportable) $Doc->ExportCaption($this->processo_exercicio);
					if ($this->processo_termo_num->Exportable) $Doc->ExportCaption($this->processo_termo_num);
					if ($this->processo_numero->Exportable) $Doc->ExportCaption($this->processo_numero);
					if ($this->processo_vigencia_ini->Exportable) $Doc->ExportCaption($this->processo_vigencia_ini);
					if ($this->processo_vigencia_fim->Exportable) $Doc->ExportCaption($this->processo_vigencia_fim);
					if ($this->processo_data->Exportable) $Doc->ExportCaption($this->processo_data);
					if ($this->processo_valor->Exportable) $Doc->ExportCaption($this->processo_valor);
					if ($this->processo_objeto->Exportable) $Doc->ExportCaption($this->processo_objeto);
					if ($this->processo_metas->Exportable) $Doc->ExportCaption($this->processo_metas);
					if ($this->processo_origem->Exportable) $Doc->ExportCaption($this->processo_origem);
					if ($this->processo_ent_endereco->Exportable) $Doc->ExportCaption($this->processo_ent_endereco);
					if ($this->processo_ent_estatuto->Exportable) $Doc->ExportCaption($this->processo_ent_estatuto);
					if ($this->processo_ent_lei->Exportable) $Doc->ExportCaption($this->processo_ent_lei);
					if ($this->processo_ent_cebas->Exportable) $Doc->ExportCaption($this->processo_ent_cebas);
					if ($this->processo_resp_nome->Exportable) $Doc->ExportCaption($this->processo_resp_nome);
					if ($this->processo_resp_cargo->Exportable) $Doc->ExportCaption($this->processo_resp_cargo);
					if ($this->processo_resp_end->Exportable) $Doc->ExportCaption($this->processo_resp_end);
					if ($this->processo_resp_contato->Exportable) $Doc->ExportCaption($this->processo_resp_contato);
					if ($this->processo_resp_ata->Exportable) $Doc->ExportCaption($this->processo_resp_ata);
					if ($this->processo_cont_nome->Exportable) $Doc->ExportCaption($this->processo_cont_nome);
					if ($this->processo_cont_end->Exportable) $Doc->ExportCaption($this->processo_cont_end);
					if ($this->processo_cont_contato->Exportable) $Doc->ExportCaption($this->processo_cont_contato);
					if ($this->processo_cont_indent->Exportable) $Doc->ExportCaption($this->processo_cont_indent);
					if ($this->processo_preenc_nome->Exportable) $Doc->ExportCaption($this->processo_preenc_nome);
					if ($this->processo_preenc_carg->Exportable) $Doc->ExportCaption($this->processo_preenc_carg);
					if ($this->processo_preenc_end->Exportable) $Doc->ExportCaption($this->processo_preenc_end);
					if ($this->processo_preenc_contato->Exportable) $Doc->ExportCaption($this->processo_preenc_contato);
					if ($this->processo_preenc_indentifica->Exportable) $Doc->ExportCaption($this->processo_preenc_indentifica);
				} else {
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
						if ($this->processo_exercicio->Exportable) $Doc->ExportField($this->processo_exercicio);
						if ($this->processo_termo_num->Exportable) $Doc->ExportField($this->processo_termo_num);
						if ($this->processo_numero->Exportable) $Doc->ExportField($this->processo_numero);
						if ($this->processo_vigencia_ini->Exportable) $Doc->ExportField($this->processo_vigencia_ini);
						if ($this->processo_vigencia_fim->Exportable) $Doc->ExportField($this->processo_vigencia_fim);
						if ($this->processo_data->Exportable) $Doc->ExportField($this->processo_data);
						if ($this->processo_valor->Exportable) $Doc->ExportField($this->processo_valor);
						if ($this->processo_objeto->Exportable) $Doc->ExportField($this->processo_objeto);
						if ($this->processo_metas->Exportable) $Doc->ExportField($this->processo_metas);
						if ($this->processo_origem->Exportable) $Doc->ExportField($this->processo_origem);
						if ($this->processo_ent_endereco->Exportable) $Doc->ExportField($this->processo_ent_endereco);
						if ($this->processo_ent_estatuto->Exportable) $Doc->ExportField($this->processo_ent_estatuto);
						if ($this->processo_ent_lei->Exportable) $Doc->ExportField($this->processo_ent_lei);
						if ($this->processo_ent_cebas->Exportable) $Doc->ExportField($this->processo_ent_cebas);
						if ($this->processo_resp_nome->Exportable) $Doc->ExportField($this->processo_resp_nome);
						if ($this->processo_resp_cargo->Exportable) $Doc->ExportField($this->processo_resp_cargo);
						if ($this->processo_resp_end->Exportable) $Doc->ExportField($this->processo_resp_end);
						if ($this->processo_resp_contato->Exportable) $Doc->ExportField($this->processo_resp_contato);
						if ($this->processo_resp_ata->Exportable) $Doc->ExportField($this->processo_resp_ata);
						if ($this->processo_cont_nome->Exportable) $Doc->ExportField($this->processo_cont_nome);
						if ($this->processo_cont_end->Exportable) $Doc->ExportField($this->processo_cont_end);
						if ($this->processo_cont_contato->Exportable) $Doc->ExportField($this->processo_cont_contato);
						if ($this->processo_cont_indent->Exportable) $Doc->ExportField($this->processo_cont_indent);
						if ($this->processo_preenc_nome->Exportable) $Doc->ExportField($this->processo_preenc_nome);
						if ($this->processo_preenc_carg->Exportable) $Doc->ExportField($this->processo_preenc_carg);
						if ($this->processo_preenc_end->Exportable) $Doc->ExportField($this->processo_preenc_end);
						if ($this->processo_preenc_contato->Exportable) $Doc->ExportField($this->processo_preenc_contato);
						if ($this->processo_preenc_indentifica->Exportable) $Doc->ExportField($this->processo_preenc_indentifica);
					} else {
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
