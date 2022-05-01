<?php

// Global variable for table object
$rc25_a_planos_aplicacao = NULL;

//
// Table class for rc25_a_planos_aplicacao
//
class crc25_a_planos_aplicacao extends cTable {
	var $plano_id;
	var $plano_exercicio;
	var $plano_despesa;
	var $plano_custo_mensal;
	var $plano_custo_exercicio;
	var $plano_recurso_municipal;
	var $plano_outros_recursos;
	var $plano_data_cadastro;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_a_planos_aplicacao';
		$this->TableName = 'rc25_a_planos_aplicacao';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_a_planos_aplicacao`";
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

		// plano_id
		$this->plano_id = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_id', 'plano_id', '`plano_id`', '`plano_id`', 20, -1, FALSE, '`plano_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->plano_id->Sortable = FALSE; // Allow sort
		$this->plano_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_id'] = &$this->plano_id;

		// plano_exercicio
		$this->plano_exercicio = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_exercicio', 'plano_exercicio', '`plano_exercicio`', '`plano_exercicio`', 3, -1, FALSE, '`plano_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->plano_exercicio->Sortable = FALSE; // Allow sort
		$this->plano_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->plano_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->plano_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_exercicio'] = &$this->plano_exercicio;

		// plano_despesa
		$this->plano_despesa = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_despesa', 'plano_despesa', '`plano_despesa`', '`plano_despesa`', 3, -1, FALSE, '`plano_despesa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->plano_despesa->Sortable = FALSE; // Allow sort
		$this->plano_despesa->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->plano_despesa->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->plano_despesa->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_despesa'] = &$this->plano_despesa;

		// plano_custo_mensal
		$this->plano_custo_mensal = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_custo_mensal', 'plano_custo_mensal', '`plano_custo_mensal`', '`plano_custo_mensal`', 5, -1, FALSE, '`plano_custo_mensal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_custo_mensal->Sortable = FALSE; // Allow sort
		$this->plano_custo_mensal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_custo_mensal'] = &$this->plano_custo_mensal;

		// plano_custo_exercicio
		$this->plano_custo_exercicio = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_custo_exercicio', 'plano_custo_exercicio', '`plano_custo_exercicio`', '`plano_custo_exercicio`', 5, -1, FALSE, '`plano_custo_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_custo_exercicio->Sortable = FALSE; // Allow sort
		$this->plano_custo_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_custo_exercicio'] = &$this->plano_custo_exercicio;

		// plano_recurso_municipal
		$this->plano_recurso_municipal = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_recurso_municipal', 'plano_recurso_municipal', '`plano_recurso_municipal`', '`plano_recurso_municipal`', 5, -1, FALSE, '`plano_recurso_municipal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_recurso_municipal->Sortable = FALSE; // Allow sort
		$this->plano_recurso_municipal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_recurso_municipal'] = &$this->plano_recurso_municipal;

		// plano_outros_recursos
		$this->plano_outros_recursos = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_outros_recursos', 'plano_outros_recursos', '`plano_outros_recursos`', '`plano_outros_recursos`', 5, -1, FALSE, '`plano_outros_recursos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_outros_recursos->Sortable = FALSE; // Allow sort
		$this->plano_outros_recursos->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_outros_recursos'] = &$this->plano_outros_recursos;

		// plano_data_cadastro
		$this->plano_data_cadastro = new cField('rc25_a_planos_aplicacao', 'rc25_a_planos_aplicacao', 'x_plano_data_cadastro', 'plano_data_cadastro', '`plano_data_cadastro`', ew_CastDateFieldForLike('`plano_data_cadastro`', 1, "DB"), 135, 1, FALSE, '`plano_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_data_cadastro->Sortable = FALSE; // Allow sort
		$this->plano_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['plano_data_cadastro'] = &$this->plano_data_cadastro;
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "rc25_a_termos") {
			if ($this->plano_exercicio->getSessionValue() <> "")
				$sMasterFilter .= "`processo_exercicio`=" . ew_QuotedValue($this->plano_exercicio->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "rc25_a_termos") {
			if ($this->plano_exercicio->getSessionValue() <> "")
				$sDetailFilter .= "`plano_exercicio`=" . ew_QuotedValue($this->plano_exercicio->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_rc25_a_termos() {
		return "`processo_exercicio`=@processo_exercicio@";
	}

	// Detail filter
	function SqlDetailFilter_rc25_a_termos() {
		return "`plano_exercicio`=@plano_exercicio@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_a_planos_aplicacao`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`plano_id` DESC";
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
			$this->plano_id->setDbValue($conn->Insert_ID());
			$rs['plano_id'] = $this->plano_id->DbValue;
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
			if (array_key_exists('plano_id', $rs))
				ew_AddFilter($where, ew_QuotedName('plano_id', $this->DBID) . '=' . ew_QuotedValue($rs['plano_id'], $this->plano_id->FldDataType, $this->DBID));
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
		return "`plano_id` = @plano_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->plano_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->plano_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@plano_id@", ew_AdjustSql($this->plano_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_a_planos_aplicacaolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_a_planos_aplicacaoview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_a_planos_aplicacaoedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_a_planos_aplicacaoadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_a_planos_aplicacaolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_planos_aplicacaoview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_planos_aplicacaoview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_a_planos_aplicacaoadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_a_planos_aplicacaoadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_planos_aplicacaoedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_planos_aplicacaoadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_a_planos_aplicacaodelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "rc25_a_termos" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_processo_exercicio=" . urlencode($this->plano_exercicio->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "plano_id:" . ew_VarToJson($this->plano_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->plano_id->CurrentValue)) {
			$sUrl .= "plano_id=" . urlencode($this->plano_id->CurrentValue);
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
			if ($isPost && isset($_POST["plano_id"]))
				$arKeys[] = $_POST["plano_id"];
			elseif (isset($_GET["plano_id"]))
				$arKeys[] = $_GET["plano_id"];
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
			$this->plano_id->CurrentValue = $key;
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
		$this->plano_id->setDbValue($rs->fields('plano_id'));
		$this->plano_exercicio->setDbValue($rs->fields('plano_exercicio'));
		$this->plano_despesa->setDbValue($rs->fields('plano_despesa'));
		$this->plano_custo_mensal->setDbValue($rs->fields('plano_custo_mensal'));
		$this->plano_custo_exercicio->setDbValue($rs->fields('plano_custo_exercicio'));
		$this->plano_recurso_municipal->setDbValue($rs->fields('plano_recurso_municipal'));
		$this->plano_outros_recursos->setDbValue($rs->fields('plano_outros_recursos'));
		$this->plano_data_cadastro->setDbValue($rs->fields('plano_data_cadastro'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// plano_id

		$this->plano_id->CellCssStyle = "white-space: nowrap;";

		// plano_exercicio
		// plano_despesa

		$this->plano_despesa->CellCssStyle = "white-space: nowrap;";

		// plano_custo_mensal
		$this->plano_custo_mensal->CellCssStyle = "white-space: nowrap;";

		// plano_custo_exercicio
		$this->plano_custo_exercicio->CellCssStyle = "white-space: nowrap;";

		// plano_recurso_municipal
		$this->plano_recurso_municipal->CellCssStyle = "white-space: nowrap;";

		// plano_outros_recursos
		$this->plano_outros_recursos->CellCssStyle = "white-space: nowrap;";

		// plano_data_cadastro
		$this->plano_data_cadastro->CellCssStyle = "white-space: nowrap;";

		// plano_id
		$this->plano_id->ViewValue = $this->plano_id->CurrentValue;
		$this->plano_id->ViewCustomAttributes = "";

		// plano_exercicio
		if (strval($this->plano_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->plano_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->plano_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->plano_exercicio->ViewValue = $this->plano_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->plano_exercicio->ViewValue = $this->plano_exercicio->CurrentValue;
			}
		} else {
			$this->plano_exercicio->ViewValue = NULL;
		}
		$this->plano_exercicio->ViewCustomAttributes = "";

		// plano_despesa
		if (strval($this->plano_despesa->CurrentValue) <> "") {
			$sFilterWrk = "`despesa_id`" . ew_SearchString("=", $this->plano_despesa->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `despesa_id`, `despesa_nome` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_planos_despesas`";
		$sWhereWrk = "";
		$this->plano_despesa->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->plano_despesa, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->plano_despesa->ViewValue = $this->plano_despesa->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->plano_despesa->ViewValue = $this->plano_despesa->CurrentValue;
			}
		} else {
			$this->plano_despesa->ViewValue = NULL;
		}
		$this->plano_despesa->ViewCustomAttributes = "";

		// plano_custo_mensal
		$this->plano_custo_mensal->ViewValue = $this->plano_custo_mensal->CurrentValue;
		$this->plano_custo_mensal->ViewValue = ew_FormatCurrency($this->plano_custo_mensal->ViewValue, 2, -2, -2, -2);
		$this->plano_custo_mensal->CellCssStyle .= "text-align: right;";
		$this->plano_custo_mensal->ViewCustomAttributes = "";

		// plano_custo_exercicio
		$this->plano_custo_exercicio->ViewValue = $this->plano_custo_exercicio->CurrentValue;
		$this->plano_custo_exercicio->ViewValue = ew_FormatCurrency($this->plano_custo_exercicio->ViewValue, 2, -2, -2, -2);
		$this->plano_custo_exercicio->CellCssStyle .= "text-align: right;";
		$this->plano_custo_exercicio->ViewCustomAttributes = "";

		// plano_recurso_municipal
		$this->plano_recurso_municipal->ViewValue = $this->plano_recurso_municipal->CurrentValue;
		$this->plano_recurso_municipal->ViewValue = ew_FormatCurrency($this->plano_recurso_municipal->ViewValue, 2, -2, -2, -2);
		$this->plano_recurso_municipal->CellCssStyle .= "text-align: right;";
		$this->plano_recurso_municipal->ViewCustomAttributes = "";

		// plano_outros_recursos
		$this->plano_outros_recursos->ViewValue = $this->plano_outros_recursos->CurrentValue;
		$this->plano_outros_recursos->ViewValue = ew_FormatCurrency($this->plano_outros_recursos->ViewValue, 2, -1, -2, -2);
		$this->plano_outros_recursos->CellCssStyle .= "text-align: right;";
		$this->plano_outros_recursos->ViewCustomAttributes = "";

		// plano_data_cadastro
		$this->plano_data_cadastro->ViewValue = $this->plano_data_cadastro->CurrentValue;
		$this->plano_data_cadastro->ViewValue = ew_FormatDateTime($this->plano_data_cadastro->ViewValue, 1);
		$this->plano_data_cadastro->CellCssStyle .= "text-align: center;";
		$this->plano_data_cadastro->ViewCustomAttributes = "";

		// plano_id
		$this->plano_id->LinkCustomAttributes = "";
		$this->plano_id->HrefValue = "";
		$this->plano_id->TooltipValue = "";

		// plano_exercicio
		$this->plano_exercicio->LinkCustomAttributes = "";
		$this->plano_exercicio->HrefValue = "";
		$this->plano_exercicio->TooltipValue = "";

		// plano_despesa
		$this->plano_despesa->LinkCustomAttributes = "";
		$this->plano_despesa->HrefValue = "";
		$this->plano_despesa->TooltipValue = "";

		// plano_custo_mensal
		$this->plano_custo_mensal->LinkCustomAttributes = "";
		$this->plano_custo_mensal->HrefValue = "";
		$this->plano_custo_mensal->TooltipValue = "";

		// plano_custo_exercicio
		$this->plano_custo_exercicio->LinkCustomAttributes = "";
		$this->plano_custo_exercicio->HrefValue = "";
		$this->plano_custo_exercicio->TooltipValue = "";

		// plano_recurso_municipal
		$this->plano_recurso_municipal->LinkCustomAttributes = "";
		$this->plano_recurso_municipal->HrefValue = "";
		$this->plano_recurso_municipal->TooltipValue = "";

		// plano_outros_recursos
		$this->plano_outros_recursos->LinkCustomAttributes = "";
		$this->plano_outros_recursos->HrefValue = "";
		$this->plano_outros_recursos->TooltipValue = "";

		// plano_data_cadastro
		$this->plano_data_cadastro->LinkCustomAttributes = "";
		$this->plano_data_cadastro->HrefValue = "";
		$this->plano_data_cadastro->TooltipValue = "";

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

		// plano_id
		$this->plano_id->EditAttrs["class"] = "form-control";
		$this->plano_id->EditCustomAttributes = "";
		$this->plano_id->EditValue = $this->plano_id->CurrentValue;
		$this->plano_id->ViewCustomAttributes = "";

		// plano_exercicio
		$this->plano_exercicio->EditAttrs["class"] = "form-control";
		$this->plano_exercicio->EditCustomAttributes = "";
		if ($this->plano_exercicio->getSessionValue() <> "") {
			$this->plano_exercicio->CurrentValue = $this->plano_exercicio->getSessionValue();
		if (strval($this->plano_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->plano_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->plano_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->plano_exercicio->ViewValue = $this->plano_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->plano_exercicio->ViewValue = $this->plano_exercicio->CurrentValue;
			}
		} else {
			$this->plano_exercicio->ViewValue = NULL;
		}
		$this->plano_exercicio->ViewCustomAttributes = "";
		} else {
		}

		// plano_despesa
		$this->plano_despesa->EditAttrs["class"] = "form-control";
		$this->plano_despesa->EditCustomAttributes = "";

		// plano_custo_mensal
		$this->plano_custo_mensal->EditAttrs["class"] = "form-control";
		$this->plano_custo_mensal->EditCustomAttributes = "";
		$this->plano_custo_mensal->EditValue = $this->plano_custo_mensal->CurrentValue;
		$this->plano_custo_mensal->PlaceHolder = ew_RemoveHtml($this->plano_custo_mensal->FldCaption());
		if (strval($this->plano_custo_mensal->EditValue) <> "" && is_numeric($this->plano_custo_mensal->EditValue)) $this->plano_custo_mensal->EditValue = ew_FormatNumber($this->plano_custo_mensal->EditValue, -2, -2, -2, -2);

		// plano_custo_exercicio
		$this->plano_custo_exercicio->EditAttrs["class"] = "form-control";
		$this->plano_custo_exercicio->EditCustomAttributes = "";
		$this->plano_custo_exercicio->EditValue = $this->plano_custo_exercicio->CurrentValue;
		$this->plano_custo_exercicio->PlaceHolder = ew_RemoveHtml($this->plano_custo_exercicio->FldCaption());
		if (strval($this->plano_custo_exercicio->EditValue) <> "" && is_numeric($this->plano_custo_exercicio->EditValue)) $this->plano_custo_exercicio->EditValue = ew_FormatNumber($this->plano_custo_exercicio->EditValue, -2, -2, -2, -2);

		// plano_recurso_municipal
		$this->plano_recurso_municipal->EditAttrs["class"] = "form-control";
		$this->plano_recurso_municipal->EditCustomAttributes = "";
		$this->plano_recurso_municipal->EditValue = $this->plano_recurso_municipal->CurrentValue;
		$this->plano_recurso_municipal->PlaceHolder = ew_RemoveHtml($this->plano_recurso_municipal->FldCaption());
		if (strval($this->plano_recurso_municipal->EditValue) <> "" && is_numeric($this->plano_recurso_municipal->EditValue)) $this->plano_recurso_municipal->EditValue = ew_FormatNumber($this->plano_recurso_municipal->EditValue, -2, -2, -2, -2);

		// plano_outros_recursos
		$this->plano_outros_recursos->EditAttrs["class"] = "form-control";
		$this->plano_outros_recursos->EditCustomAttributes = "";
		$this->plano_outros_recursos->EditValue = $this->plano_outros_recursos->CurrentValue;
		$this->plano_outros_recursos->PlaceHolder = ew_RemoveHtml($this->plano_outros_recursos->FldCaption());
		if (strval($this->plano_outros_recursos->EditValue) <> "" && is_numeric($this->plano_outros_recursos->EditValue)) $this->plano_outros_recursos->EditValue = ew_FormatNumber($this->plano_outros_recursos->EditValue, -2, -1, -2, -2);

		// plano_data_cadastro
		// Call Row Rendered event

		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->plano_custo_mensal->CurrentValue))
				$this->plano_custo_mensal->Total += $this->plano_custo_mensal->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_custo_exercicio->CurrentValue))
				$this->plano_custo_exercicio->Total += $this->plano_custo_exercicio->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_recurso_municipal->CurrentValue))
				$this->plano_recurso_municipal->Total += $this->plano_recurso_municipal->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_outros_recursos->CurrentValue))
				$this->plano_outros_recursos->Total += $this->plano_outros_recursos->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->plano_custo_mensal->CurrentValue = $this->plano_custo_mensal->Total;
			$this->plano_custo_mensal->ViewValue = $this->plano_custo_mensal->CurrentValue;
			$this->plano_custo_mensal->ViewValue = ew_FormatCurrency($this->plano_custo_mensal->ViewValue, 2, -2, -2, -2);
			$this->plano_custo_mensal->CellCssStyle .= "text-align: right;";
			$this->plano_custo_mensal->ViewCustomAttributes = "";
			$this->plano_custo_mensal->HrefValue = ""; // Clear href value
			$this->plano_custo_exercicio->CurrentValue = $this->plano_custo_exercicio->Total;
			$this->plano_custo_exercicio->ViewValue = $this->plano_custo_exercicio->CurrentValue;
			$this->plano_custo_exercicio->ViewValue = ew_FormatCurrency($this->plano_custo_exercicio->ViewValue, 2, -2, -2, -2);
			$this->plano_custo_exercicio->CellCssStyle .= "text-align: right;";
			$this->plano_custo_exercicio->ViewCustomAttributes = "";
			$this->plano_custo_exercicio->HrefValue = ""; // Clear href value
			$this->plano_recurso_municipal->CurrentValue = $this->plano_recurso_municipal->Total;
			$this->plano_recurso_municipal->ViewValue = $this->plano_recurso_municipal->CurrentValue;
			$this->plano_recurso_municipal->ViewValue = ew_FormatCurrency($this->plano_recurso_municipal->ViewValue, 2, -2, -2, -2);
			$this->plano_recurso_municipal->CellCssStyle .= "text-align: right;";
			$this->plano_recurso_municipal->ViewCustomAttributes = "";
			$this->plano_recurso_municipal->HrefValue = ""; // Clear href value
			$this->plano_outros_recursos->CurrentValue = $this->plano_outros_recursos->Total;
			$this->plano_outros_recursos->ViewValue = $this->plano_outros_recursos->CurrentValue;
			$this->plano_outros_recursos->ViewValue = ew_FormatCurrency($this->plano_outros_recursos->ViewValue, 2, -1, -2, -2);
			$this->plano_outros_recursos->CellCssStyle .= "text-align: right;";
			$this->plano_outros_recursos->ViewCustomAttributes = "";
			$this->plano_outros_recursos->HrefValue = ""; // Clear href value

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
					if ($this->plano_exercicio->Exportable) $Doc->ExportCaption($this->plano_exercicio);
					if ($this->plano_despesa->Exportable) $Doc->ExportCaption($this->plano_despesa);
					if ($this->plano_custo_mensal->Exportable) $Doc->ExportCaption($this->plano_custo_mensal);
					if ($this->plano_custo_exercicio->Exportable) $Doc->ExportCaption($this->plano_custo_exercicio);
					if ($this->plano_recurso_municipal->Exportable) $Doc->ExportCaption($this->plano_recurso_municipal);
					if ($this->plano_outros_recursos->Exportable) $Doc->ExportCaption($this->plano_outros_recursos);
					if ($this->plano_data_cadastro->Exportable) $Doc->ExportCaption($this->plano_data_cadastro);
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
				$this->AggregateListRowValues(); // Aggregate row values

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->plano_exercicio->Exportable) $Doc->ExportField($this->plano_exercicio);
						if ($this->plano_despesa->Exportable) $Doc->ExportField($this->plano_despesa);
						if ($this->plano_custo_mensal->Exportable) $Doc->ExportField($this->plano_custo_mensal);
						if ($this->plano_custo_exercicio->Exportable) $Doc->ExportField($this->plano_custo_exercicio);
						if ($this->plano_recurso_municipal->Exportable) $Doc->ExportField($this->plano_recurso_municipal);
						if ($this->plano_outros_recursos->Exportable) $Doc->ExportField($this->plano_outros_recursos);
						if ($this->plano_data_cadastro->Exportable) $Doc->ExportField($this->plano_data_cadastro);
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

		// Export aggregates (horizontal format only)
		if ($Doc->Horizontal) {
			$this->RowType = EW_ROWTYPE_AGGREGATE;
			$this->ResetAttrs();
			$this->AggregateListRow();
			if (!$Doc->ExportCustom) {
				$Doc->BeginExportRow(-1);
				$Doc->EndExportRow();
			}
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
