<?php

// Global variable for table object
$rc25_a_recurso_aplicados = NULL;

//
// Table class for rc25_a_recurso_aplicados
//
class crc25_a_recurso_aplicados extends cTable {
	var $ra_id;
	var $ra_exercicio;
	var $ra_data_cadastro;
	var $ra_data_pagamento;
	var $ra_especificacoes;
	var $ra_credor;
	var $ra_identificador;
	var $ra_plano;
	var $ra_natureza;
	var $ra_valor;
	var $ra_comprovante;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_a_recurso_aplicados';
		$this->TableName = 'rc25_a_recurso_aplicados';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_a_recurso_aplicados`";
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

		// ra_id
		$this->ra_id = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_id', 'ra_id', '`ra_id`', '`ra_id`', 20, -1, FALSE, '`ra_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ra_id->Sortable = FALSE; // Allow sort
		$this->ra_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_id'] = &$this->ra_id;

		// ra_exercicio
		$this->ra_exercicio = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_exercicio', 'ra_exercicio', '`ra_exercicio`', '`ra_exercicio`', 3, -1, FALSE, '`ra_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_exercicio->Sortable = FALSE; // Allow sort
		$this->ra_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_exercicio'] = &$this->ra_exercicio;

		// ra_data_cadastro
		$this->ra_data_cadastro = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_data_cadastro', 'ra_data_cadastro', '`ra_data_cadastro`', ew_CastDateFieldForLike('`ra_data_cadastro`', 7, "DB"), 133, 7, FALSE, '`ra_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_data_cadastro->Sortable = FALSE; // Allow sort
		$this->ra_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ra_data_cadastro'] = &$this->ra_data_cadastro;

		// ra_data_pagamento
		$this->ra_data_pagamento = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_data_pagamento', 'ra_data_pagamento', '`ra_data_pagamento`', ew_CastDateFieldForLike('`ra_data_pagamento`', 7, "DB"), 133, 7, FALSE, '`ra_data_pagamento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_data_pagamento->Sortable = FALSE; // Allow sort
		$this->ra_data_pagamento->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ra_data_pagamento'] = &$this->ra_data_pagamento;

		// ra_especificacoes
		$this->ra_especificacoes = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_especificacoes', 'ra_especificacoes', '`ra_especificacoes`', '`ra_especificacoes`', 200, -1, FALSE, '`ra_especificacoes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_especificacoes->Sortable = FALSE; // Allow sort
		$this->fields['ra_especificacoes'] = &$this->ra_especificacoes;

		// ra_credor
		$this->ra_credor = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_credor', 'ra_credor', '`ra_credor`', '`ra_credor`', 3, -1, FALSE, '`ra_credor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_credor->Sortable = FALSE; // Allow sort
		$this->ra_credor->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_credor->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_credor->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_credor'] = &$this->ra_credor;

		// ra_identificador
		$this->ra_identificador = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_identificador', 'ra_identificador', '`ra_identificador`', '`ra_identificador`', 3, -1, FALSE, '`ra_identificador`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_identificador->Sortable = FALSE; // Allow sort
		$this->ra_identificador->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_identificador->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['ra_identificador'] = &$this->ra_identificador;

		// ra_plano
		$this->ra_plano = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_plano', 'ra_plano', '`ra_plano`', '`ra_plano`', 200, -1, FALSE, '`ra_plano`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_plano->Sortable = FALSE; // Allow sort
		$this->fields['ra_plano'] = &$this->ra_plano;

		// ra_natureza
		$this->ra_natureza = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_natureza', 'ra_natureza', '`ra_natureza`', '`ra_natureza`', 3, -1, FALSE, '`ra_natureza`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_natureza->Sortable = FALSE; // Allow sort
		$this->ra_natureza->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_natureza->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_natureza->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_natureza'] = &$this->ra_natureza;

		// ra_valor
		$this->ra_valor = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_valor', 'ra_valor', '`ra_valor`', '`ra_valor`', 5, -1, FALSE, '`ra_valor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_valor->Sortable = FALSE; // Allow sort
		$this->ra_valor->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ra_valor'] = &$this->ra_valor;

		// ra_comprovante
		$this->ra_comprovante = new cField('rc25_a_recurso_aplicados', 'rc25_a_recurso_aplicados', 'x_ra_comprovante', 'ra_comprovante', '`ra_comprovante`', '`ra_comprovante`', 200, -1, FALSE, '`ra_comprovante`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_comprovante->Sortable = FALSE; // Allow sort
		$this->fields['ra_comprovante'] = &$this->ra_comprovante;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_a_recurso_aplicados`";
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
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`ra_id` DESC";
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
			$this->ra_id->setDbValue($conn->Insert_ID());
			$rs['ra_id'] = $this->ra_id->DbValue;
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
			if (array_key_exists('ra_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ra_id', $this->DBID) . '=' . ew_QuotedValue($rs['ra_id'], $this->ra_id->FldDataType, $this->DBID));
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
		return "`ra_id` = @ra_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ra_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->ra_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@ra_id@", ew_AdjustSql($this->ra_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_a_recurso_aplicadoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_a_recurso_aplicadosview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_a_recurso_aplicadosedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_a_recurso_aplicadosadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_a_recurso_aplicadoslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_recurso_aplicadosview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_recurso_aplicadosview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_a_recurso_aplicadosadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_a_recurso_aplicadosadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_recurso_aplicadosedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_recurso_aplicadosadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_a_recurso_aplicadosdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "ra_id:" . ew_VarToJson($this->ra_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ra_id->CurrentValue)) {
			$sUrl .= "ra_id=" . urlencode($this->ra_id->CurrentValue);
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
			if ($isPost && isset($_POST["ra_id"]))
				$arKeys[] = $_POST["ra_id"];
			elseif (isset($_GET["ra_id"]))
				$arKeys[] = $_GET["ra_id"];
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
			$this->ra_id->CurrentValue = $key;
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
		$this->ra_id->setDbValue($rs->fields('ra_id'));
		$this->ra_exercicio->setDbValue($rs->fields('ra_exercicio'));
		$this->ra_data_cadastro->setDbValue($rs->fields('ra_data_cadastro'));
		$this->ra_data_pagamento->setDbValue($rs->fields('ra_data_pagamento'));
		$this->ra_especificacoes->setDbValue($rs->fields('ra_especificacoes'));
		$this->ra_credor->setDbValue($rs->fields('ra_credor'));
		$this->ra_identificador->setDbValue($rs->fields('ra_identificador'));
		$this->ra_plano->setDbValue($rs->fields('ra_plano'));
		$this->ra_natureza->setDbValue($rs->fields('ra_natureza'));
		$this->ra_valor->setDbValue($rs->fields('ra_valor'));
		$this->ra_comprovante->setDbValue($rs->fields('ra_comprovante'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// ra_id

		$this->ra_id->CellCssStyle = "white-space: nowrap;";

		// ra_exercicio
		// ra_data_cadastro

		$this->ra_data_cadastro->CellCssStyle = "white-space: nowrap;";

		// ra_data_pagamento
		$this->ra_data_pagamento->CellCssStyle = "white-space: nowrap;";

		// ra_especificacoes
		$this->ra_especificacoes->CellCssStyle = "white-space: nowrap;";

		// ra_credor
		$this->ra_credor->CellCssStyle = "white-space: nowrap;";

		// ra_identificador
		$this->ra_identificador->CellCssStyle = "white-space: nowrap;";

		// ra_plano
		$this->ra_plano->CellCssStyle = "white-space: nowrap;";

		// ra_natureza
		$this->ra_natureza->CellCssStyle = "white-space: nowrap;";

		// ra_valor
		$this->ra_valor->CellCssStyle = "white-space: nowrap;";

		// ra_comprovante
		$this->ra_comprovante->CellCssStyle = "white-space: nowrap;";

		// ra_id
		$this->ra_id->ViewValue = $this->ra_id->CurrentValue;
		$this->ra_id->ViewCustomAttributes = "";

		// ra_exercicio
		if (strval($this->ra_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->ra_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->ra_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->CurrentValue;
			}
		} else {
			$this->ra_exercicio->ViewValue = NULL;
		}
		$this->ra_exercicio->ViewCustomAttributes = "";

		// ra_data_cadastro
		$this->ra_data_cadastro->ViewValue = $this->ra_data_cadastro->CurrentValue;
		$this->ra_data_cadastro->ViewValue = ew_FormatDateTime($this->ra_data_cadastro->ViewValue, 7);
		$this->ra_data_cadastro->ViewCustomAttributes = "";

		// ra_data_pagamento
		$this->ra_data_pagamento->ViewValue = $this->ra_data_pagamento->CurrentValue;
		$this->ra_data_pagamento->ViewValue = ew_FormatDateTime($this->ra_data_pagamento->ViewValue, 7);
		$this->ra_data_pagamento->ViewCustomAttributes = "";

		// ra_especificacoes
		$this->ra_especificacoes->ViewValue = $this->ra_especificacoes->CurrentValue;
		$this->ra_especificacoes->ViewCustomAttributes = "";

		// ra_credor
		if (strval($this->ra_credor->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->ra_credor->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->ra_credor->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_credor, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_credor->ViewValue = $this->ra_credor->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_credor->ViewValue = $this->ra_credor->CurrentValue;
			}
		} else {
			$this->ra_credor->ViewValue = NULL;
		}
		$this->ra_credor->ViewCustomAttributes = "";

		// ra_identificador
		if (strval($this->ra_identificador->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->ra_identificador->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->ra_identificador->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_identificador, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->ra_identificador->ViewValue = $this->ra_identificador->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_identificador->ViewValue = $this->ra_identificador->CurrentValue;
			}
		} else {
			$this->ra_identificador->ViewValue = NULL;
		}
		$this->ra_identificador->ViewCustomAttributes = "";

		// ra_plano
		$this->ra_plano->ViewValue = $this->ra_plano->CurrentValue;
		$this->ra_plano->ViewCustomAttributes = "";

		// ra_natureza
		if (strval($this->ra_natureza->CurrentValue) <> "") {
			$sFilterWrk = "`ran_id`" . ew_SearchString("=", $this->ra_natureza->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ran_id`, `ran_descricao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_ra_natureza`";
		$sWhereWrk = "";
		$this->ra_natureza->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_natureza, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_natureza->ViewValue = $this->ra_natureza->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_natureza->ViewValue = $this->ra_natureza->CurrentValue;
			}
		} else {
			$this->ra_natureza->ViewValue = NULL;
		}
		$this->ra_natureza->ViewCustomAttributes = "";

		// ra_valor
		$this->ra_valor->ViewValue = $this->ra_valor->CurrentValue;
		$this->ra_valor->ViewValue = ew_FormatCurrency($this->ra_valor->ViewValue, 2, -1, -2, -2);
		$this->ra_valor->CellCssStyle .= "text-align: right;";
		$this->ra_valor->ViewCustomAttributes = "";

		// ra_comprovante
		$this->ra_comprovante->ViewValue = $this->ra_comprovante->CurrentValue;
		$this->ra_comprovante->ViewCustomAttributes = "";

		// ra_id
		$this->ra_id->LinkCustomAttributes = "";
		$this->ra_id->HrefValue = "";
		$this->ra_id->TooltipValue = "";

		// ra_exercicio
		$this->ra_exercicio->LinkCustomAttributes = "";
		$this->ra_exercicio->HrefValue = "";
		$this->ra_exercicio->TooltipValue = "";

		// ra_data_cadastro
		$this->ra_data_cadastro->LinkCustomAttributes = "";
		$this->ra_data_cadastro->HrefValue = "";
		$this->ra_data_cadastro->TooltipValue = "";

		// ra_data_pagamento
		$this->ra_data_pagamento->LinkCustomAttributes = "";
		$this->ra_data_pagamento->HrefValue = "";
		$this->ra_data_pagamento->TooltipValue = "";

		// ra_especificacoes
		$this->ra_especificacoes->LinkCustomAttributes = "";
		$this->ra_especificacoes->HrefValue = "";
		$this->ra_especificacoes->TooltipValue = "";

		// ra_credor
		$this->ra_credor->LinkCustomAttributes = "";
		$this->ra_credor->HrefValue = "";
		$this->ra_credor->TooltipValue = "";

		// ra_identificador
		$this->ra_identificador->LinkCustomAttributes = "";
		$this->ra_identificador->HrefValue = "";
		$this->ra_identificador->TooltipValue = "";

		// ra_plano
		$this->ra_plano->LinkCustomAttributes = "";
		$this->ra_plano->HrefValue = "";
		$this->ra_plano->TooltipValue = "";

		// ra_natureza
		$this->ra_natureza->LinkCustomAttributes = "";
		$this->ra_natureza->HrefValue = "";
		$this->ra_natureza->TooltipValue = "";

		// ra_valor
		$this->ra_valor->LinkCustomAttributes = "";
		$this->ra_valor->HrefValue = "";
		$this->ra_valor->TooltipValue = "";

		// ra_comprovante
		$this->ra_comprovante->LinkCustomAttributes = "";
		$this->ra_comprovante->HrefValue = "";
		$this->ra_comprovante->TooltipValue = "";

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

		// ra_id
		$this->ra_id->EditAttrs["class"] = "form-control";
		$this->ra_id->EditCustomAttributes = "";
		$this->ra_id->EditValue = $this->ra_id->CurrentValue;
		$this->ra_id->ViewCustomAttributes = "";

		// ra_exercicio
		$this->ra_exercicio->EditAttrs["class"] = "form-control";
		$this->ra_exercicio->EditCustomAttributes = "";

		// ra_data_cadastro
		// ra_data_pagamento

		$this->ra_data_pagamento->EditAttrs["class"] = "form-control";
		$this->ra_data_pagamento->EditCustomAttributes = "";
		$this->ra_data_pagamento->EditValue = ew_FormatDateTime($this->ra_data_pagamento->CurrentValue, 7);
		$this->ra_data_pagamento->PlaceHolder = ew_RemoveHtml($this->ra_data_pagamento->FldCaption());

		// ra_especificacoes
		$this->ra_especificacoes->EditAttrs["class"] = "form-control";
		$this->ra_especificacoes->EditCustomAttributes = "";
		$this->ra_especificacoes->EditValue = $this->ra_especificacoes->CurrentValue;
		$this->ra_especificacoes->PlaceHolder = ew_RemoveHtml($this->ra_especificacoes->FldCaption());

		// ra_credor
		$this->ra_credor->EditAttrs["class"] = "form-control";
		$this->ra_credor->EditCustomAttributes = "";

		// ra_identificador
		$this->ra_identificador->EditAttrs["class"] = "form-control";
		$this->ra_identificador->EditCustomAttributes = "";

		// ra_plano
		$this->ra_plano->EditAttrs["class"] = "form-control";
		$this->ra_plano->EditCustomAttributes = "";
		$this->ra_plano->EditValue = $this->ra_plano->CurrentValue;
		$this->ra_plano->PlaceHolder = ew_RemoveHtml($this->ra_plano->FldCaption());

		// ra_natureza
		$this->ra_natureza->EditAttrs["class"] = "form-control";
		$this->ra_natureza->EditCustomAttributes = "";

		// ra_valor
		$this->ra_valor->EditAttrs["class"] = "form-control";
		$this->ra_valor->EditCustomAttributes = "";
		$this->ra_valor->EditValue = $this->ra_valor->CurrentValue;
		$this->ra_valor->PlaceHolder = ew_RemoveHtml($this->ra_valor->FldCaption());
		if (strval($this->ra_valor->EditValue) <> "" && is_numeric($this->ra_valor->EditValue)) $this->ra_valor->EditValue = ew_FormatNumber($this->ra_valor->EditValue, -2, -1, -2, -2);

		// ra_comprovante
		$this->ra_comprovante->EditAttrs["class"] = "form-control";
		$this->ra_comprovante->EditCustomAttributes = "";
		$this->ra_comprovante->EditValue = $this->ra_comprovante->CurrentValue;
		$this->ra_comprovante->PlaceHolder = ew_RemoveHtml($this->ra_comprovante->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->ra_valor->CurrentValue))
				$this->ra_valor->Total += $this->ra_valor->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->ra_valor->CurrentValue = $this->ra_valor->Total;
			$this->ra_valor->ViewValue = $this->ra_valor->CurrentValue;
			$this->ra_valor->ViewValue = ew_FormatCurrency($this->ra_valor->ViewValue, 2, -1, -2, -2);
			$this->ra_valor->CellCssStyle .= "text-align: right;";
			$this->ra_valor->ViewCustomAttributes = "";
			$this->ra_valor->HrefValue = ""; // Clear href value

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
					if ($this->ra_exercicio->Exportable) $Doc->ExportCaption($this->ra_exercicio);
					if ($this->ra_data_cadastro->Exportable) $Doc->ExportCaption($this->ra_data_cadastro);
					if ($this->ra_data_pagamento->Exportable) $Doc->ExportCaption($this->ra_data_pagamento);
					if ($this->ra_especificacoes->Exportable) $Doc->ExportCaption($this->ra_especificacoes);
					if ($this->ra_identificador->Exportable) $Doc->ExportCaption($this->ra_identificador);
					if ($this->ra_plano->Exportable) $Doc->ExportCaption($this->ra_plano);
					if ($this->ra_natureza->Exportable) $Doc->ExportCaption($this->ra_natureza);
					if ($this->ra_valor->Exportable) $Doc->ExportCaption($this->ra_valor);
					if ($this->ra_comprovante->Exportable) $Doc->ExportCaption($this->ra_comprovante);
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
						if ($this->ra_exercicio->Exportable) $Doc->ExportField($this->ra_exercicio);
						if ($this->ra_data_cadastro->Exportable) $Doc->ExportField($this->ra_data_cadastro);
						if ($this->ra_data_pagamento->Exportable) $Doc->ExportField($this->ra_data_pagamento);
						if ($this->ra_especificacoes->Exportable) $Doc->ExportField($this->ra_especificacoes);
						if ($this->ra_identificador->Exportable) $Doc->ExportField($this->ra_identificador);
						if ($this->ra_plano->Exportable) $Doc->ExportField($this->ra_plano);
						if ($this->ra_natureza->Exportable) $Doc->ExportField($this->ra_natureza);
						if ($this->ra_valor->Exportable) $Doc->ExportField($this->ra_valor);
						if ($this->ra_comprovante->Exportable) $Doc->ExportField($this->ra_comprovante);
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
