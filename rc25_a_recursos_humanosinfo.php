<?php

// Global variable for table object
$rc25_a_recursos_humanos = NULL;

//
// Table class for rc25_a_recursos_humanos
//
class crc25_a_recursos_humanos extends cTable {
	var $rh_id;
	var $rh_exercicio;
	var $rh_pg_recurso_publico;
	var $rh_terceirizado;
	var $rh_nome;
	var $rh_funcao;
	var $rh_escolaridade;
	var $rh_sala_turma;
	var $rh_carga_horaria_semanal;
	var $rh_remuneracao;
	var $rh_hora_entra_i;
	var $rh_hora_saida_i;
	var $rh_hora_entra_ii;
	var $rh_hora_saida_ii;
	var $rh_data_cadastro;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_a_recursos_humanos';
		$this->TableName = 'rc25_a_recursos_humanos';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_a_recursos_humanos`";
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

		// rh_id
		$this->rh_id = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_id', 'rh_id', '`rh_id`', '`rh_id`', 20, -1, FALSE, '`rh_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rh_id->Sortable = FALSE; // Allow sort
		$this->rh_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_id'] = &$this->rh_id;

		// rh_exercicio
		$this->rh_exercicio = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_exercicio', 'rh_exercicio', '`rh_exercicio`', '`rh_exercicio`', 3, -1, FALSE, '`rh_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_exercicio->Sortable = FALSE; // Allow sort
		$this->rh_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->rh_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_exercicio'] = &$this->rh_exercicio;

		// rh_pg_recurso_publico
		$this->rh_pg_recurso_publico = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_pg_recurso_publico', 'rh_pg_recurso_publico', '`rh_pg_recurso_publico`', '`rh_pg_recurso_publico`', 16, -1, FALSE, '`rh_pg_recurso_publico`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->rh_pg_recurso_publico->Sortable = FALSE; // Allow sort
		$this->rh_pg_recurso_publico->OptionCount = 2;
		$this->rh_pg_recurso_publico->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_pg_recurso_publico'] = &$this->rh_pg_recurso_publico;

		// rh_terceirizado
		$this->rh_terceirizado = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_terceirizado', 'rh_terceirizado', '`rh_terceirizado`', '`rh_terceirizado`', 16, -1, FALSE, '`rh_terceirizado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->rh_terceirizado->Sortable = FALSE; // Allow sort
		$this->rh_terceirizado->OptionCount = 2;
		$this->rh_terceirizado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_terceirizado'] = &$this->rh_terceirizado;

		// rh_nome
		$this->rh_nome = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_nome', 'rh_nome', '`rh_nome`', '`rh_nome`', 3, -1, FALSE, '`rh_nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_nome->Sortable = TRUE; // Allow sort
		$this->rh_nome->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_nome->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['rh_nome'] = &$this->rh_nome;

		// rh_funcao
		$this->rh_funcao = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_funcao', 'rh_funcao', '`rh_funcao`', '`rh_funcao`', 3, -1, FALSE, '`rh_funcao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_funcao->Sortable = FALSE; // Allow sort
		$this->rh_funcao->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_funcao->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['rh_funcao'] = &$this->rh_funcao;

		// rh_escolaridade
		$this->rh_escolaridade = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_escolaridade', 'rh_escolaridade', '`rh_escolaridade`', '`rh_escolaridade`', 200, -1, FALSE, '`rh_escolaridade`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_escolaridade->Sortable = FALSE; // Allow sort
		$this->fields['rh_escolaridade'] = &$this->rh_escolaridade;

		// rh_sala_turma
		$this->rh_sala_turma = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_sala_turma', 'rh_sala_turma', '`rh_sala_turma`', '`rh_sala_turma`', 200, -1, FALSE, '`rh_sala_turma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_sala_turma->Sortable = FALSE; // Allow sort
		$this->fields['rh_sala_turma'] = &$this->rh_sala_turma;

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_carga_horaria_semanal', 'rh_carga_horaria_semanal', '`rh_carga_horaria_semanal`', '`rh_carga_horaria_semanal`', 200, -1, FALSE, '`rh_carga_horaria_semanal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_carga_horaria_semanal->Sortable = FALSE; // Allow sort
		$this->fields['rh_carga_horaria_semanal'] = &$this->rh_carga_horaria_semanal;

		// rh_remuneracao
		$this->rh_remuneracao = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_remuneracao', 'rh_remuneracao', '`rh_remuneracao`', '`rh_remuneracao`', 5, -1, FALSE, '`rh_remuneracao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_remuneracao->Sortable = FALSE; // Allow sort
		$this->rh_remuneracao->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rh_remuneracao'] = &$this->rh_remuneracao;

		// rh_hora_entra_i
		$this->rh_hora_entra_i = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_hora_entra_i', 'rh_hora_entra_i', '`rh_hora_entra_i`', '`rh_hora_entra_i`', 200, -1, FALSE, '`rh_hora_entra_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_entra_i->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_entra_i'] = &$this->rh_hora_entra_i;

		// rh_hora_saida_i
		$this->rh_hora_saida_i = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_hora_saida_i', 'rh_hora_saida_i', '`rh_hora_saida_i`', '`rh_hora_saida_i`', 200, -1, FALSE, '`rh_hora_saida_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_saida_i->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_saida_i'] = &$this->rh_hora_saida_i;

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_hora_entra_ii', 'rh_hora_entra_ii', '`rh_hora_entra_ii`', '`rh_hora_entra_ii`', 200, -1, FALSE, '`rh_hora_entra_ii`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_entra_ii->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_entra_ii'] = &$this->rh_hora_entra_ii;

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_hora_saida_ii', 'rh_hora_saida_ii', '`rh_hora_saida_ii`', '`rh_hora_saida_ii`', 3, -1, FALSE, '`rh_hora_saida_ii`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_saida_ii->Sortable = FALSE; // Allow sort
		$this->rh_hora_saida_ii->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_hora_saida_ii'] = &$this->rh_hora_saida_ii;

		// rh_data_cadastro
		$this->rh_data_cadastro = new cField('rc25_a_recursos_humanos', 'rc25_a_recursos_humanos', 'x_rh_data_cadastro', 'rh_data_cadastro', '`rh_data_cadastro`', ew_CastDateFieldForLike('`rh_data_cadastro`', 7, "DB"), 135, 7, FALSE, '`rh_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_data_cadastro->Sortable = FALSE; // Allow sort
		$this->rh_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['rh_data_cadastro'] = &$this->rh_data_cadastro;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_a_recursos_humanos`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`rh_id` DESC";
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
			$this->rh_id->setDbValue($conn->Insert_ID());
			$rs['rh_id'] = $this->rh_id->DbValue;
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
			if (array_key_exists('rh_id', $rs))
				ew_AddFilter($where, ew_QuotedName('rh_id', $this->DBID) . '=' . ew_QuotedValue($rs['rh_id'], $this->rh_id->FldDataType, $this->DBID));
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
		return "`rh_id` = @rh_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->rh_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->rh_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@rh_id@", ew_AdjustSql($this->rh_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_a_recursos_humanoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_a_recursos_humanosview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_a_recursos_humanosedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_a_recursos_humanosadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_a_recursos_humanoslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_recursos_humanosview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_recursos_humanosview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_a_recursos_humanosadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_a_recursos_humanosadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_recursos_humanosedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_recursos_humanosadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_a_recursos_humanosdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "rh_id:" . ew_VarToJson($this->rh_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->rh_id->CurrentValue)) {
			$sUrl .= "rh_id=" . urlencode($this->rh_id->CurrentValue);
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
			if ($isPost && isset($_POST["rh_id"]))
				$arKeys[] = $_POST["rh_id"];
			elseif (isset($_GET["rh_id"]))
				$arKeys[] = $_GET["rh_id"];
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
			$this->rh_id->CurrentValue = $key;
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
		$this->rh_id->setDbValue($rs->fields('rh_id'));
		$this->rh_exercicio->setDbValue($rs->fields('rh_exercicio'));
		$this->rh_pg_recurso_publico->setDbValue($rs->fields('rh_pg_recurso_publico'));
		$this->rh_terceirizado->setDbValue($rs->fields('rh_terceirizado'));
		$this->rh_nome->setDbValue($rs->fields('rh_nome'));
		$this->rh_funcao->setDbValue($rs->fields('rh_funcao'));
		$this->rh_escolaridade->setDbValue($rs->fields('rh_escolaridade'));
		$this->rh_sala_turma->setDbValue($rs->fields('rh_sala_turma'));
		$this->rh_carga_horaria_semanal->setDbValue($rs->fields('rh_carga_horaria_semanal'));
		$this->rh_remuneracao->setDbValue($rs->fields('rh_remuneracao'));
		$this->rh_hora_entra_i->setDbValue($rs->fields('rh_hora_entra_i'));
		$this->rh_hora_saida_i->setDbValue($rs->fields('rh_hora_saida_i'));
		$this->rh_hora_entra_ii->setDbValue($rs->fields('rh_hora_entra_ii'));
		$this->rh_hora_saida_ii->setDbValue($rs->fields('rh_hora_saida_ii'));
		$this->rh_data_cadastro->setDbValue($rs->fields('rh_data_cadastro'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// rh_id

		$this->rh_id->CellCssStyle = "white-space: nowrap;";

		// rh_exercicio
		// rh_pg_recurso_publico

		$this->rh_pg_recurso_publico->CellCssStyle = "white-space: nowrap;";

		// rh_terceirizado
		$this->rh_terceirizado->CellCssStyle = "white-space: nowrap;";

		// rh_nome
		$this->rh_nome->CellCssStyle = "white-space: nowrap;";

		// rh_funcao
		$this->rh_funcao->CellCssStyle = "white-space: nowrap;";

		// rh_escolaridade
		$this->rh_escolaridade->CellCssStyle = "white-space: nowrap;";

		// rh_sala_turma
		$this->rh_sala_turma->CellCssStyle = "white-space: nowrap;";

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->CellCssStyle = "white-space: nowrap;";

		// rh_remuneracao
		$this->rh_remuneracao->CellCssStyle = "white-space: nowrap;";

		// rh_hora_entra_i
		$this->rh_hora_entra_i->CellCssStyle = "white-space: nowrap;";

		// rh_hora_saida_i
		$this->rh_hora_saida_i->CellCssStyle = "white-space: nowrap;";

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->CellCssStyle = "white-space: nowrap;";

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->CellCssStyle = "white-space: nowrap;";

		// rh_data_cadastro
		$this->rh_data_cadastro->CellCssStyle = "white-space: nowrap;";

		// rh_id
		$this->rh_id->ViewValue = $this->rh_id->CurrentValue;
		$this->rh_id->ViewCustomAttributes = "";

		// rh_exercicio
		if (strval($this->rh_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->rh_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->rh_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rh_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rh_exercicio->ViewValue = $this->rh_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rh_exercicio->ViewValue = $this->rh_exercicio->CurrentValue;
			}
		} else {
			$this->rh_exercicio->ViewValue = NULL;
		}
		$this->rh_exercicio->ViewCustomAttributes = "";

		// rh_pg_recurso_publico
		if (strval($this->rh_pg_recurso_publico->CurrentValue) <> "") {
			$this->rh_pg_recurso_publico->ViewValue = $this->rh_pg_recurso_publico->OptionCaption($this->rh_pg_recurso_publico->CurrentValue);
		} else {
			$this->rh_pg_recurso_publico->ViewValue = NULL;
		}
		$this->rh_pg_recurso_publico->ViewCustomAttributes = "";

		// rh_terceirizado
		if (strval($this->rh_terceirizado->CurrentValue) <> "") {
			$this->rh_terceirizado->ViewValue = $this->rh_terceirizado->OptionCaption($this->rh_terceirizado->CurrentValue);
		} else {
			$this->rh_terceirizado->ViewValue = NULL;
		}
		$this->rh_terceirizado->ViewCustomAttributes = "";

		// rh_nome
		if (strval($this->rh_nome->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->rh_nome->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->rh_nome->LookupFilters = array();
		$lookuptblfilter = "`rhp_fis_jur`=0";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rh_nome, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->rh_nome->ViewValue = $this->rh_nome->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rh_nome->ViewValue = $this->rh_nome->CurrentValue;
			}
		} else {
			$this->rh_nome->ViewValue = NULL;
		}
		$this->rh_nome->ViewCustomAttributes = "";

		// rh_funcao
		if (strval($this->rh_funcao->CurrentValue) <> "") {
			$sFilterWrk = "`rhf_id`" . ew_SearchString("=", $this->rh_funcao->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhf_id`, `rhf_funcao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhfuncoes`";
		$sWhereWrk = "";
		$this->rh_funcao->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rh_funcao, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rh_funcao->ViewValue = $this->rh_funcao->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rh_funcao->ViewValue = $this->rh_funcao->CurrentValue;
			}
		} else {
			$this->rh_funcao->ViewValue = NULL;
		}
		$this->rh_funcao->ViewCustomAttributes = "";

		// rh_escolaridade
		$this->rh_escolaridade->ViewValue = $this->rh_escolaridade->CurrentValue;
		$this->rh_escolaridade->ViewCustomAttributes = "";

		// rh_sala_turma
		$this->rh_sala_turma->ViewValue = $this->rh_sala_turma->CurrentValue;
		$this->rh_sala_turma->ViewCustomAttributes = "";

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->ViewValue = $this->rh_carga_horaria_semanal->CurrentValue;
		$this->rh_carga_horaria_semanal->ViewCustomAttributes = "";

		// rh_remuneracao
		$this->rh_remuneracao->ViewValue = $this->rh_remuneracao->CurrentValue;
		$this->rh_remuneracao->ViewCustomAttributes = "";

		// rh_hora_entra_i
		$this->rh_hora_entra_i->ViewValue = $this->rh_hora_entra_i->CurrentValue;
		$this->rh_hora_entra_i->ViewCustomAttributes = "";

		// rh_hora_saida_i
		$this->rh_hora_saida_i->ViewValue = $this->rh_hora_saida_i->CurrentValue;
		$this->rh_hora_saida_i->ViewCustomAttributes = "";

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->ViewValue = $this->rh_hora_entra_ii->CurrentValue;
		$this->rh_hora_entra_ii->ViewCustomAttributes = "";

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->ViewValue = $this->rh_hora_saida_ii->CurrentValue;
		$this->rh_hora_saida_ii->ViewCustomAttributes = "";

		// rh_data_cadastro
		$this->rh_data_cadastro->ViewValue = $this->rh_data_cadastro->CurrentValue;
		$this->rh_data_cadastro->ViewValue = ew_FormatDateTime($this->rh_data_cadastro->ViewValue, 7);
		$this->rh_data_cadastro->ViewCustomAttributes = "";

		// rh_id
		$this->rh_id->LinkCustomAttributes = "";
		$this->rh_id->HrefValue = "";
		$this->rh_id->TooltipValue = "";

		// rh_exercicio
		$this->rh_exercicio->LinkCustomAttributes = "";
		$this->rh_exercicio->HrefValue = "";
		$this->rh_exercicio->TooltipValue = "";

		// rh_pg_recurso_publico
		$this->rh_pg_recurso_publico->LinkCustomAttributes = "";
		$this->rh_pg_recurso_publico->HrefValue = "";
		$this->rh_pg_recurso_publico->TooltipValue = "";

		// rh_terceirizado
		$this->rh_terceirizado->LinkCustomAttributes = "";
		$this->rh_terceirizado->HrefValue = "";
		$this->rh_terceirizado->TooltipValue = "";

		// rh_nome
		$this->rh_nome->LinkCustomAttributes = "";
		$this->rh_nome->HrefValue = "";
		$this->rh_nome->TooltipValue = "";

		// rh_funcao
		$this->rh_funcao->LinkCustomAttributes = "";
		$this->rh_funcao->HrefValue = "";
		$this->rh_funcao->TooltipValue = "";

		// rh_escolaridade
		$this->rh_escolaridade->LinkCustomAttributes = "";
		$this->rh_escolaridade->HrefValue = "";
		$this->rh_escolaridade->TooltipValue = "";

		// rh_sala_turma
		$this->rh_sala_turma->LinkCustomAttributes = "";
		$this->rh_sala_turma->HrefValue = "";
		$this->rh_sala_turma->TooltipValue = "";

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->LinkCustomAttributes = "";
		$this->rh_carga_horaria_semanal->HrefValue = "";
		$this->rh_carga_horaria_semanal->TooltipValue = "";

		// rh_remuneracao
		$this->rh_remuneracao->LinkCustomAttributes = "";
		$this->rh_remuneracao->HrefValue = "";
		$this->rh_remuneracao->TooltipValue = "";

		// rh_hora_entra_i
		$this->rh_hora_entra_i->LinkCustomAttributes = "";
		$this->rh_hora_entra_i->HrefValue = "";
		$this->rh_hora_entra_i->TooltipValue = "";

		// rh_hora_saida_i
		$this->rh_hora_saida_i->LinkCustomAttributes = "";
		$this->rh_hora_saida_i->HrefValue = "";
		$this->rh_hora_saida_i->TooltipValue = "";

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->LinkCustomAttributes = "";
		$this->rh_hora_entra_ii->HrefValue = "";
		$this->rh_hora_entra_ii->TooltipValue = "";

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->LinkCustomAttributes = "";
		$this->rh_hora_saida_ii->HrefValue = "";
		$this->rh_hora_saida_ii->TooltipValue = "";

		// rh_data_cadastro
		$this->rh_data_cadastro->LinkCustomAttributes = "";
		$this->rh_data_cadastro->HrefValue = "";
		$this->rh_data_cadastro->TooltipValue = "";

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

		// rh_id
		$this->rh_id->EditAttrs["class"] = "form-control";
		$this->rh_id->EditCustomAttributes = "";
		$this->rh_id->EditValue = $this->rh_id->CurrentValue;
		$this->rh_id->ViewCustomAttributes = "";

		// rh_exercicio
		$this->rh_exercicio->EditAttrs["class"] = "form-control";
		$this->rh_exercicio->EditCustomAttributes = "";

		// rh_pg_recurso_publico
		$this->rh_pg_recurso_publico->EditCustomAttributes = "";
		$this->rh_pg_recurso_publico->EditValue = $this->rh_pg_recurso_publico->Options(FALSE);

		// rh_terceirizado
		$this->rh_terceirizado->EditCustomAttributes = "";
		$this->rh_terceirizado->EditValue = $this->rh_terceirizado->Options(FALSE);

		// rh_nome
		$this->rh_nome->EditAttrs["class"] = "form-control";
		$this->rh_nome->EditCustomAttributes = "";

		// rh_funcao
		$this->rh_funcao->EditAttrs["class"] = "form-control";
		$this->rh_funcao->EditCustomAttributes = "";

		// rh_escolaridade
		$this->rh_escolaridade->EditAttrs["class"] = "form-control";
		$this->rh_escolaridade->EditCustomAttributes = "";
		$this->rh_escolaridade->EditValue = $this->rh_escolaridade->CurrentValue;
		$this->rh_escolaridade->PlaceHolder = ew_RemoveHtml($this->rh_escolaridade->FldCaption());

		// rh_sala_turma
		$this->rh_sala_turma->EditAttrs["class"] = "form-control";
		$this->rh_sala_turma->EditCustomAttributes = "";
		$this->rh_sala_turma->EditValue = $this->rh_sala_turma->CurrentValue;
		$this->rh_sala_turma->PlaceHolder = ew_RemoveHtml($this->rh_sala_turma->FldCaption());

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->EditAttrs["class"] = "form-control";
		$this->rh_carga_horaria_semanal->EditCustomAttributes = "";
		$this->rh_carga_horaria_semanal->EditValue = $this->rh_carga_horaria_semanal->CurrentValue;
		$this->rh_carga_horaria_semanal->PlaceHolder = ew_RemoveHtml($this->rh_carga_horaria_semanal->FldCaption());

		// rh_remuneracao
		$this->rh_remuneracao->EditAttrs["class"] = "form-control";
		$this->rh_remuneracao->EditCustomAttributes = "";
		$this->rh_remuneracao->EditValue = $this->rh_remuneracao->CurrentValue;
		$this->rh_remuneracao->PlaceHolder = ew_RemoveHtml($this->rh_remuneracao->FldCaption());
		if (strval($this->rh_remuneracao->EditValue) <> "" && is_numeric($this->rh_remuneracao->EditValue)) $this->rh_remuneracao->EditValue = ew_FormatNumber($this->rh_remuneracao->EditValue, -2, -1, -2, 0);

		// rh_hora_entra_i
		$this->rh_hora_entra_i->EditAttrs["class"] = "form-control";
		$this->rh_hora_entra_i->EditCustomAttributes = "";
		$this->rh_hora_entra_i->EditValue = $this->rh_hora_entra_i->CurrentValue;
		$this->rh_hora_entra_i->PlaceHolder = ew_RemoveHtml($this->rh_hora_entra_i->FldCaption());

		// rh_hora_saida_i
		$this->rh_hora_saida_i->EditAttrs["class"] = "form-control";
		$this->rh_hora_saida_i->EditCustomAttributes = "";
		$this->rh_hora_saida_i->EditValue = $this->rh_hora_saida_i->CurrentValue;
		$this->rh_hora_saida_i->PlaceHolder = ew_RemoveHtml($this->rh_hora_saida_i->FldCaption());

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->EditAttrs["class"] = "form-control";
		$this->rh_hora_entra_ii->EditCustomAttributes = "";
		$this->rh_hora_entra_ii->EditValue = $this->rh_hora_entra_ii->CurrentValue;
		$this->rh_hora_entra_ii->PlaceHolder = ew_RemoveHtml($this->rh_hora_entra_ii->FldCaption());

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->EditAttrs["class"] = "form-control";
		$this->rh_hora_saida_ii->EditCustomAttributes = "";
		$this->rh_hora_saida_ii->EditValue = $this->rh_hora_saida_ii->CurrentValue;
		$this->rh_hora_saida_ii->PlaceHolder = ew_RemoveHtml($this->rh_hora_saida_ii->FldCaption());

		// rh_data_cadastro
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
					if ($this->rh_exercicio->Exportable) $Doc->ExportCaption($this->rh_exercicio);
					if ($this->rh_pg_recurso_publico->Exportable) $Doc->ExportCaption($this->rh_pg_recurso_publico);
					if ($this->rh_terceirizado->Exportable) $Doc->ExportCaption($this->rh_terceirizado);
					if ($this->rh_nome->Exportable) $Doc->ExportCaption($this->rh_nome);
					if ($this->rh_funcao->Exportable) $Doc->ExportCaption($this->rh_funcao);
					if ($this->rh_escolaridade->Exportable) $Doc->ExportCaption($this->rh_escolaridade);
					if ($this->rh_sala_turma->Exportable) $Doc->ExportCaption($this->rh_sala_turma);
					if ($this->rh_carga_horaria_semanal->Exportable) $Doc->ExportCaption($this->rh_carga_horaria_semanal);
					if ($this->rh_remuneracao->Exportable) $Doc->ExportCaption($this->rh_remuneracao);
					if ($this->rh_hora_entra_i->Exportable) $Doc->ExportCaption($this->rh_hora_entra_i);
					if ($this->rh_hora_saida_i->Exportable) $Doc->ExportCaption($this->rh_hora_saida_i);
					if ($this->rh_hora_entra_ii->Exportable) $Doc->ExportCaption($this->rh_hora_entra_ii);
					if ($this->rh_hora_saida_ii->Exportable) $Doc->ExportCaption($this->rh_hora_saida_ii);
					if ($this->rh_data_cadastro->Exportable) $Doc->ExportCaption($this->rh_data_cadastro);
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
						if ($this->rh_exercicio->Exportable) $Doc->ExportField($this->rh_exercicio);
						if ($this->rh_pg_recurso_publico->Exportable) $Doc->ExportField($this->rh_pg_recurso_publico);
						if ($this->rh_terceirizado->Exportable) $Doc->ExportField($this->rh_terceirizado);
						if ($this->rh_nome->Exportable) $Doc->ExportField($this->rh_nome);
						if ($this->rh_funcao->Exportable) $Doc->ExportField($this->rh_funcao);
						if ($this->rh_escolaridade->Exportable) $Doc->ExportField($this->rh_escolaridade);
						if ($this->rh_sala_turma->Exportable) $Doc->ExportField($this->rh_sala_turma);
						if ($this->rh_carga_horaria_semanal->Exportable) $Doc->ExportField($this->rh_carga_horaria_semanal);
						if ($this->rh_remuneracao->Exportable) $Doc->ExportField($this->rh_remuneracao);
						if ($this->rh_hora_entra_i->Exportable) $Doc->ExportField($this->rh_hora_entra_i);
						if ($this->rh_hora_saida_i->Exportable) $Doc->ExportField($this->rh_hora_saida_i);
						if ($this->rh_hora_entra_ii->Exportable) $Doc->ExportField($this->rh_hora_entra_ii);
						if ($this->rh_hora_saida_ii->Exportable) $Doc->ExportField($this->rh_hora_saida_ii);
						if ($this->rh_data_cadastro->Exportable) $Doc->ExportField($this->rh_data_cadastro);
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
