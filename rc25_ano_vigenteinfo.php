<?php

// Global variable for table object
$rc25_ano_vigente = NULL;

//
// Table class for rc25_ano_vigente
//
class crc25_ano_vigente extends cTable {
	var $ano_id;
	var $ano_ano;
	var $ano_descri;
	var $ano_valor_total;
	var $ano_vigencia_ini;
	var $ano_vigencia_fim;
	var $ano_prest_contas;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_ano_vigente';
		$this->TableName = 'rc25_ano_vigente';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_ano_vigente`";
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

		// ano_id
		$this->ano_id = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_id', 'ano_id', '`ano_id`', '`ano_id`', 20, -1, FALSE, '`ano_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ano_id->Sortable = FALSE; // Allow sort
		$this->ano_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ano_id'] = &$this->ano_id;

		// ano_ano
		$this->ano_ano = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_ano', 'ano_ano', '`ano_ano`', '`ano_ano`', 3, -1, FALSE, '`ano_ano`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_ano->Sortable = TRUE; // Allow sort
		$this->ano_ano->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ano_ano'] = &$this->ano_ano;

		// ano_descri
		$this->ano_descri = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_descri', 'ano_descri', '`ano_descri`', '`ano_descri`', 200, -1, FALSE, '`ano_descri`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_descri->Sortable = TRUE; // Allow sort
		$this->fields['ano_descri'] = &$this->ano_descri;

		// ano_valor_total
		$this->ano_valor_total = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_valor_total', 'ano_valor_total', '`ano_valor_total`', '`ano_valor_total`', 5, -1, FALSE, '`ano_valor_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_valor_total->Sortable = TRUE; // Allow sort
		$this->ano_valor_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ano_valor_total'] = &$this->ano_valor_total;

		// ano_vigencia_ini
		$this->ano_vigencia_ini = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_vigencia_ini', 'ano_vigencia_ini', '`ano_vigencia_ini`', ew_CastDateFieldForLike('`ano_vigencia_ini`', 7, "DB"), 133, 7, FALSE, '`ano_vigencia_ini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_vigencia_ini->Sortable = TRUE; // Allow sort
		$this->ano_vigencia_ini->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ano_vigencia_ini'] = &$this->ano_vigencia_ini;

		// ano_vigencia_fim
		$this->ano_vigencia_fim = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_vigencia_fim', 'ano_vigencia_fim', '`ano_vigencia_fim`', ew_CastDateFieldForLike('`ano_vigencia_fim`', 7, "DB"), 133, 7, FALSE, '`ano_vigencia_fim`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_vigencia_fim->Sortable = TRUE; // Allow sort
		$this->ano_vigencia_fim->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ano_vigencia_fim'] = &$this->ano_vigencia_fim;

		// ano_prest_contas
		$this->ano_prest_contas = new cField('rc25_ano_vigente', 'rc25_ano_vigente', 'x_ano_prest_contas', 'ano_prest_contas', '`ano_prest_contas`', '`ano_prest_contas`', 200, -1, FALSE, '`ano_prest_contas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_prest_contas->Sortable = TRUE; // Allow sort
		$this->fields['ano_prest_contas'] = &$this->ano_prest_contas;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_ano_vigente`";
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
			$this->ano_id->setDbValue($conn->Insert_ID());
			$rs['ano_id'] = $this->ano_id->DbValue;
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
			if (array_key_exists('ano_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ano_id', $this->DBID) . '=' . ew_QuotedValue($rs['ano_id'], $this->ano_id->FldDataType, $this->DBID));
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
		return "`ano_id` = @ano_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ano_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->ano_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@ano_id@", ew_AdjustSql($this->ano_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_ano_vigentelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_ano_vigenteview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_ano_vigenteedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_ano_vigenteadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_ano_vigentelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_ano_vigenteview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_ano_vigenteview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_ano_vigenteadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_ano_vigenteadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rc25_ano_vigenteedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rc25_ano_vigenteadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_ano_vigentedelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "ano_id:" . ew_VarToJson($this->ano_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ano_id->CurrentValue)) {
			$sUrl .= "ano_id=" . urlencode($this->ano_id->CurrentValue);
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
			if ($isPost && isset($_POST["ano_id"]))
				$arKeys[] = $_POST["ano_id"];
			elseif (isset($_GET["ano_id"]))
				$arKeys[] = $_GET["ano_id"];
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
			$this->ano_id->CurrentValue = $key;
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
		$this->ano_id->setDbValue($rs->fields('ano_id'));
		$this->ano_ano->setDbValue($rs->fields('ano_ano'));
		$this->ano_descri->setDbValue($rs->fields('ano_descri'));
		$this->ano_valor_total->setDbValue($rs->fields('ano_valor_total'));
		$this->ano_vigencia_ini->setDbValue($rs->fields('ano_vigencia_ini'));
		$this->ano_vigencia_fim->setDbValue($rs->fields('ano_vigencia_fim'));
		$this->ano_prest_contas->setDbValue($rs->fields('ano_prest_contas'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// ano_id

		$this->ano_id->CellCssStyle = "white-space: nowrap;";

		// ano_ano
		// ano_descri
		// ano_valor_total
		// ano_vigencia_ini
		// ano_vigencia_fim
		// ano_prest_contas
		// ano_id

		$this->ano_id->ViewValue = $this->ano_id->CurrentValue;
		$this->ano_id->ViewCustomAttributes = "";

		// ano_ano
		$this->ano_ano->ViewValue = $this->ano_ano->CurrentValue;
		$this->ano_ano->CssStyle = "font-weight: bold;";
		$this->ano_ano->CellCssStyle .= "text-align: center;";
		$this->ano_ano->ViewCustomAttributes = "";

		// ano_descri
		$this->ano_descri->ViewValue = $this->ano_descri->CurrentValue;
		$this->ano_descri->ViewCustomAttributes = "";

		// ano_valor_total
		$this->ano_valor_total->ViewValue = $this->ano_valor_total->CurrentValue;
		$this->ano_valor_total->ViewValue = ew_FormatCurrency($this->ano_valor_total->ViewValue, 2, -2, -2, -2);
		$this->ano_valor_total->CellCssStyle .= "text-align: right;";
		$this->ano_valor_total->ViewCustomAttributes = "";

		// ano_vigencia_ini
		$this->ano_vigencia_ini->ViewValue = $this->ano_vigencia_ini->CurrentValue;
		$this->ano_vigencia_ini->ViewValue = ew_FormatDateTime($this->ano_vigencia_ini->ViewValue, 7);
		$this->ano_vigencia_ini->ViewCustomAttributes = "";

		// ano_vigencia_fim
		$this->ano_vigencia_fim->ViewValue = $this->ano_vigencia_fim->CurrentValue;
		$this->ano_vigencia_fim->ViewValue = ew_FormatDateTime($this->ano_vigencia_fim->ViewValue, 7);
		$this->ano_vigencia_fim->ViewCustomAttributes = "";

		// ano_prest_contas
		$this->ano_prest_contas->ViewValue = $this->ano_prest_contas->CurrentValue;
		$this->ano_prest_contas->ViewCustomAttributes = "";

		// ano_id
		$this->ano_id->LinkCustomAttributes = "";
		$this->ano_id->HrefValue = "";
		$this->ano_id->TooltipValue = "";

		// ano_ano
		$this->ano_ano->LinkCustomAttributes = "";
		$this->ano_ano->HrefValue = "";
		$this->ano_ano->TooltipValue = "";

		// ano_descri
		$this->ano_descri->LinkCustomAttributes = "";
		$this->ano_descri->HrefValue = "";
		$this->ano_descri->TooltipValue = "";

		// ano_valor_total
		$this->ano_valor_total->LinkCustomAttributes = "";
		$this->ano_valor_total->HrefValue = "";
		$this->ano_valor_total->TooltipValue = "";

		// ano_vigencia_ini
		$this->ano_vigencia_ini->LinkCustomAttributes = "";
		$this->ano_vigencia_ini->HrefValue = "";
		$this->ano_vigencia_ini->TooltipValue = "";

		// ano_vigencia_fim
		$this->ano_vigencia_fim->LinkCustomAttributes = "";
		$this->ano_vigencia_fim->HrefValue = "";
		$this->ano_vigencia_fim->TooltipValue = "";

		// ano_prest_contas
		$this->ano_prest_contas->LinkCustomAttributes = "";
		$this->ano_prest_contas->HrefValue = "";
		$this->ano_prest_contas->TooltipValue = "";

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

		// ano_id
		$this->ano_id->EditAttrs["class"] = "form-control";
		$this->ano_id->EditCustomAttributes = "";
		$this->ano_id->EditValue = $this->ano_id->CurrentValue;
		$this->ano_id->ViewCustomAttributes = "";

		// ano_ano
		$this->ano_ano->EditAttrs["class"] = "form-control";
		$this->ano_ano->EditCustomAttributes = "";
		$this->ano_ano->EditValue = $this->ano_ano->CurrentValue;
		$this->ano_ano->PlaceHolder = ew_RemoveHtml($this->ano_ano->FldCaption());

		// ano_descri
		$this->ano_descri->EditAttrs["class"] = "form-control";
		$this->ano_descri->EditCustomAttributes = "";
		$this->ano_descri->EditValue = $this->ano_descri->CurrentValue;
		$this->ano_descri->PlaceHolder = ew_RemoveHtml($this->ano_descri->FldCaption());

		// ano_valor_total
		$this->ano_valor_total->EditAttrs["class"] = "form-control";
		$this->ano_valor_total->EditCustomAttributes = "";
		$this->ano_valor_total->EditValue = $this->ano_valor_total->CurrentValue;
		$this->ano_valor_total->PlaceHolder = ew_RemoveHtml($this->ano_valor_total->FldCaption());
		if (strval($this->ano_valor_total->EditValue) <> "" && is_numeric($this->ano_valor_total->EditValue)) $this->ano_valor_total->EditValue = ew_FormatNumber($this->ano_valor_total->EditValue, -2, -2, -2, -2);

		// ano_vigencia_ini
		$this->ano_vigencia_ini->EditAttrs["class"] = "form-control";
		$this->ano_vigencia_ini->EditCustomAttributes = "";
		$this->ano_vigencia_ini->EditValue = ew_FormatDateTime($this->ano_vigencia_ini->CurrentValue, 7);
		$this->ano_vigencia_ini->PlaceHolder = ew_RemoveHtml($this->ano_vigencia_ini->FldCaption());

		// ano_vigencia_fim
		$this->ano_vigencia_fim->EditAttrs["class"] = "form-control";
		$this->ano_vigencia_fim->EditCustomAttributes = "";
		$this->ano_vigencia_fim->EditValue = ew_FormatDateTime($this->ano_vigencia_fim->CurrentValue, 7);
		$this->ano_vigencia_fim->PlaceHolder = ew_RemoveHtml($this->ano_vigencia_fim->FldCaption());

		// ano_prest_contas
		$this->ano_prest_contas->EditAttrs["class"] = "form-control";
		$this->ano_prest_contas->EditCustomAttributes = "";
		$this->ano_prest_contas->EditValue = $this->ano_prest_contas->CurrentValue;
		$this->ano_prest_contas->PlaceHolder = ew_RemoveHtml($this->ano_prest_contas->FldCaption());

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
					if ($this->ano_ano->Exportable) $Doc->ExportCaption($this->ano_ano);
					if ($this->ano_descri->Exportable) $Doc->ExportCaption($this->ano_descri);
					if ($this->ano_valor_total->Exportable) $Doc->ExportCaption($this->ano_valor_total);
					if ($this->ano_vigencia_ini->Exportable) $Doc->ExportCaption($this->ano_vigencia_ini);
					if ($this->ano_vigencia_fim->Exportable) $Doc->ExportCaption($this->ano_vigencia_fim);
					if ($this->ano_prest_contas->Exportable) $Doc->ExportCaption($this->ano_prest_contas);
				} else {
					if ($this->ano_ano->Exportable) $Doc->ExportCaption($this->ano_ano);
					if ($this->ano_descri->Exportable) $Doc->ExportCaption($this->ano_descri);
					if ($this->ano_valor_total->Exportable) $Doc->ExportCaption($this->ano_valor_total);
					if ($this->ano_vigencia_ini->Exportable) $Doc->ExportCaption($this->ano_vigencia_ini);
					if ($this->ano_vigencia_fim->Exportable) $Doc->ExportCaption($this->ano_vigencia_fim);
					if ($this->ano_prest_contas->Exportable) $Doc->ExportCaption($this->ano_prest_contas);
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
						if ($this->ano_ano->Exportable) $Doc->ExportField($this->ano_ano);
						if ($this->ano_descri->Exportable) $Doc->ExportField($this->ano_descri);
						if ($this->ano_valor_total->Exportable) $Doc->ExportField($this->ano_valor_total);
						if ($this->ano_vigencia_ini->Exportable) $Doc->ExportField($this->ano_vigencia_ini);
						if ($this->ano_vigencia_fim->Exportable) $Doc->ExportField($this->ano_vigencia_fim);
						if ($this->ano_prest_contas->Exportable) $Doc->ExportField($this->ano_prest_contas);
					} else {
						if ($this->ano_ano->Exportable) $Doc->ExportField($this->ano_ano);
						if ($this->ano_descri->Exportable) $Doc->ExportField($this->ano_descri);
						if ($this->ano_valor_total->Exportable) $Doc->ExportField($this->ano_valor_total);
						if ($this->ano_vigencia_ini->Exportable) $Doc->ExportField($this->ano_vigencia_ini);
						if ($this->ano_vigencia_fim->Exportable) $Doc->ExportField($this->ano_vigencia_fim);
						if ($this->ano_prest_contas->Exportable) $Doc->ExportField($this->ano_prest_contas);
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
