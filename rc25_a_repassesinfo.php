<?php

// Global variable for table object
$rc25_a_repasses = NULL;

//
// Table class for rc25_a_repasses
//
class crc25_a_repasses extends cTable {
	var $repasse_id;
	var $repasse_id_termos;
	var $repasse_faixa_etaria;
	var $repasse_meta;
	var $repasse_valor_unitario;
	var $repasse_valor_mes;
	var $repasse_valor_previsto;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rc25_a_repasses';
		$this->TableName = 'rc25_a_repasses';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rc25_a_repasses`";
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

		// repasse_id
		$this->repasse_id = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_id', 'repasse_id', '`repasse_id`', '`repasse_id`', 21, -1, FALSE, '`repasse_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->repasse_id->Sortable = FALSE; // Allow sort
		$this->repasse_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['repasse_id'] = &$this->repasse_id;

		// repasse_id_termos
		$this->repasse_id_termos = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_id_termos', 'repasse_id_termos', '`repasse_id_termos`', '`repasse_id_termos`', 3, -1, FALSE, '`repasse_id_termos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->repasse_id_termos->Sortable = TRUE; // Allow sort
		$this->repasse_id_termos->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->repasse_id_termos->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->repasse_id_termos->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['repasse_id_termos'] = &$this->repasse_id_termos;

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_faixa_etaria', 'repasse_faixa_etaria', '`repasse_faixa_etaria`', '`repasse_faixa_etaria`', 200, -1, FALSE, '`repasse_faixa_etaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->repasse_faixa_etaria->Sortable = TRUE; // Allow sort
		$this->fields['repasse_faixa_etaria'] = &$this->repasse_faixa_etaria;

		// repasse_meta
		$this->repasse_meta = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_meta', 'repasse_meta', '`repasse_meta`', '`repasse_meta`', 3, -1, FALSE, '`repasse_meta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->repasse_meta->Sortable = TRUE; // Allow sort
		$this->repasse_meta->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['repasse_meta'] = &$this->repasse_meta;

		// repasse_valor_unitario
		$this->repasse_valor_unitario = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_valor_unitario', 'repasse_valor_unitario', '`repasse_valor_unitario`', '`repasse_valor_unitario`', 5, -1, FALSE, '`repasse_valor_unitario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->repasse_valor_unitario->Sortable = TRUE; // Allow sort
		$this->repasse_valor_unitario->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['repasse_valor_unitario'] = &$this->repasse_valor_unitario;

		// repasse_valor_mes
		$this->repasse_valor_mes = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_valor_mes', 'repasse_valor_mes', '`repasse_valor_mes`', '`repasse_valor_mes`', 5, -1, FALSE, '`repasse_valor_mes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->repasse_valor_mes->Sortable = TRUE; // Allow sort
		$this->repasse_valor_mes->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['repasse_valor_mes'] = &$this->repasse_valor_mes;

		// repasse_valor_previsto
		$this->repasse_valor_previsto = new cField('rc25_a_repasses', 'rc25_a_repasses', 'x_repasse_valor_previsto', 'repasse_valor_previsto', '`repasse_valor_previsto`', '`repasse_valor_previsto`', 5, -1, FALSE, '`repasse_valor_previsto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->repasse_valor_previsto->Sortable = TRUE; // Allow sort
		$this->repasse_valor_previsto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['repasse_valor_previsto'] = &$this->repasse_valor_previsto;
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
			if ($this->repasse_id_termos->getSessionValue() <> "")
				$sMasterFilter .= "`processo_id`=" . ew_QuotedValue($this->repasse_id_termos->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
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
			if ($this->repasse_id_termos->getSessionValue() <> "")
				$sDetailFilter .= "`repasse_id_termos`=" . ew_QuotedValue($this->repasse_id_termos->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_rc25_a_termos() {
		return "`processo_id`=@processo_id@";
	}

	// Detail filter
	function SqlDetailFilter_rc25_a_termos() {
		return "`repasse_id_termos`=@repasse_id_termos@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rc25_a_repasses`";
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
			$this->repasse_id->setDbValue($conn->Insert_ID());
			$rs['repasse_id'] = $this->repasse_id->DbValue;
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
			if (array_key_exists('repasse_id', $rs))
				ew_AddFilter($where, ew_QuotedName('repasse_id', $this->DBID) . '=' . ew_QuotedValue($rs['repasse_id'], $this->repasse_id->FldDataType, $this->DBID));
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
		return "`repasse_id` = @repasse_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->repasse_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->repasse_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@repasse_id@", ew_AdjustSql($this->repasse_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rc25_a_repasseslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "rc25_a_repassesview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "rc25_a_repassesedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "rc25_a_repassesadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "rc25_a_repasseslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rc25_a_repassesview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rc25_a_repassesview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rc25_a_repassesadd.php?" . $this->UrlParm($parm);
		else
			$url = "rc25_a_repassesadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_repassesedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rc25_a_repassesadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rc25_a_repassesdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "rc25_a_termos" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_processo_id=" . urlencode($this->repasse_id_termos->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "repasse_id:" . ew_VarToJson($this->repasse_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->repasse_id->CurrentValue)) {
			$sUrl .= "repasse_id=" . urlencode($this->repasse_id->CurrentValue);
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
			if ($isPost && isset($_POST["repasse_id"]))
				$arKeys[] = $_POST["repasse_id"];
			elseif (isset($_GET["repasse_id"]))
				$arKeys[] = $_GET["repasse_id"];
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
			$this->repasse_id->CurrentValue = $key;
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
		$this->repasse_id->setDbValue($rs->fields('repasse_id'));
		$this->repasse_id_termos->setDbValue($rs->fields('repasse_id_termos'));
		$this->repasse_faixa_etaria->setDbValue($rs->fields('repasse_faixa_etaria'));
		$this->repasse_meta->setDbValue($rs->fields('repasse_meta'));
		$this->repasse_valor_unitario->setDbValue($rs->fields('repasse_valor_unitario'));
		$this->repasse_valor_mes->setDbValue($rs->fields('repasse_valor_mes'));
		$this->repasse_valor_previsto->setDbValue($rs->fields('repasse_valor_previsto'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// repasse_id

		$this->repasse_id->CellCssStyle = "white-space: nowrap;";

		// repasse_id_termos
		// repasse_faixa_etaria
		// repasse_meta
		// repasse_valor_unitario
		// repasse_valor_mes
		// repasse_valor_previsto
		// repasse_id

		$this->repasse_id->ViewValue = $this->repasse_id->CurrentValue;
		$this->repasse_id->ViewCustomAttributes = "";

		// repasse_id_termos
		if (strval($this->repasse_id_termos->CurrentValue) <> "") {
			$sFilterWrk = "`processo_id`" . ew_SearchString("=", $this->repasse_id_termos->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `processo_id`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_termos`";
		$sWhereWrk = "";
		$this->repasse_id_termos->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->repasse_id_termos->ViewValue = $this->repasse_id_termos->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->repasse_id_termos->ViewValue = $this->repasse_id_termos->CurrentValue;
			}
		} else {
			$this->repasse_id_termos->ViewValue = NULL;
		}
		$this->repasse_id_termos->ViewCustomAttributes = "";

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria->ViewValue = $this->repasse_faixa_etaria->CurrentValue;
		$this->repasse_faixa_etaria->ViewCustomAttributes = "";

		// repasse_meta
		$this->repasse_meta->ViewValue = $this->repasse_meta->CurrentValue;
		$this->repasse_meta->ViewValue = ew_FormatNumber($this->repasse_meta->ViewValue, 0, -2, -2, -2);
		$this->repasse_meta->ViewCustomAttributes = "";

		// repasse_valor_unitario
		$this->repasse_valor_unitario->ViewValue = $this->repasse_valor_unitario->CurrentValue;
		$this->repasse_valor_unitario->ViewValue = ew_FormatCurrency($this->repasse_valor_unitario->ViewValue, 2, -2, -2, -2);
		$this->repasse_valor_unitario->CellCssStyle .= "text-align: right;";
		$this->repasse_valor_unitario->ViewCustomAttributes = "";

		// repasse_valor_mes
		$this->repasse_valor_mes->ViewValue = $this->repasse_valor_mes->CurrentValue;
		$this->repasse_valor_mes->ViewValue = ew_FormatCurrency($this->repasse_valor_mes->ViewValue, 2, -2, -2, -2);
		$this->repasse_valor_mes->CellCssStyle .= "text-align: right;";
		$this->repasse_valor_mes->ViewCustomAttributes = "";

		// repasse_valor_previsto
		$this->repasse_valor_previsto->ViewValue = $this->repasse_valor_previsto->CurrentValue;
		$this->repasse_valor_previsto->ViewValue = ew_FormatCurrency($this->repasse_valor_previsto->ViewValue, 2, -2, -2, -2);
		$this->repasse_valor_previsto->CellCssStyle .= "text-align: right;";
		$this->repasse_valor_previsto->ViewCustomAttributes = "";

		// repasse_id
		$this->repasse_id->LinkCustomAttributes = "";
		$this->repasse_id->HrefValue = "";
		$this->repasse_id->TooltipValue = "";

		// repasse_id_termos
		$this->repasse_id_termos->LinkCustomAttributes = "";
		$this->repasse_id_termos->HrefValue = "";
		$this->repasse_id_termos->TooltipValue = "";

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria->LinkCustomAttributes = "";
		$this->repasse_faixa_etaria->HrefValue = "";
		$this->repasse_faixa_etaria->TooltipValue = "";

		// repasse_meta
		$this->repasse_meta->LinkCustomAttributes = "";
		$this->repasse_meta->HrefValue = "";
		$this->repasse_meta->TooltipValue = "";

		// repasse_valor_unitario
		$this->repasse_valor_unitario->LinkCustomAttributes = "";
		$this->repasse_valor_unitario->HrefValue = "";
		$this->repasse_valor_unitario->TooltipValue = "";

		// repasse_valor_mes
		$this->repasse_valor_mes->LinkCustomAttributes = "";
		$this->repasse_valor_mes->HrefValue = "";
		$this->repasse_valor_mes->TooltipValue = "";

		// repasse_valor_previsto
		$this->repasse_valor_previsto->LinkCustomAttributes = "";
		$this->repasse_valor_previsto->HrefValue = "";
		$this->repasse_valor_previsto->TooltipValue = "";

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

		// repasse_id
		$this->repasse_id->EditAttrs["class"] = "form-control";
		$this->repasse_id->EditCustomAttributes = "";
		$this->repasse_id->EditValue = $this->repasse_id->CurrentValue;
		$this->repasse_id->ViewCustomAttributes = "";

		// repasse_id_termos
		$this->repasse_id_termos->EditAttrs["class"] = "form-control";
		$this->repasse_id_termos->EditCustomAttributes = "";
		if ($this->repasse_id_termos->getSessionValue() <> "") {
			$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->getSessionValue();
		if (strval($this->repasse_id_termos->CurrentValue) <> "") {
			$sFilterWrk = "`processo_id`" . ew_SearchString("=", $this->repasse_id_termos->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `processo_id`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_termos`";
		$sWhereWrk = "";
		$this->repasse_id_termos->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->repasse_id_termos->ViewValue = $this->repasse_id_termos->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->repasse_id_termos->ViewValue = $this->repasse_id_termos->CurrentValue;
			}
		} else {
			$this->repasse_id_termos->ViewValue = NULL;
		}
		$this->repasse_id_termos->ViewCustomAttributes = "";
		} else {
		}

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria->EditAttrs["class"] = "form-control";
		$this->repasse_faixa_etaria->EditCustomAttributes = "";
		$this->repasse_faixa_etaria->EditValue = $this->repasse_faixa_etaria->CurrentValue;
		$this->repasse_faixa_etaria->PlaceHolder = ew_RemoveHtml($this->repasse_faixa_etaria->FldCaption());

		// repasse_meta
		$this->repasse_meta->EditAttrs["class"] = "form-control";
		$this->repasse_meta->EditCustomAttributes = "";
		$this->repasse_meta->EditValue = $this->repasse_meta->CurrentValue;
		$this->repasse_meta->PlaceHolder = ew_RemoveHtml($this->repasse_meta->FldCaption());

		// repasse_valor_unitario
		$this->repasse_valor_unitario->EditAttrs["class"] = "form-control";
		$this->repasse_valor_unitario->EditCustomAttributes = "";
		$this->repasse_valor_unitario->EditValue = $this->repasse_valor_unitario->CurrentValue;
		$this->repasse_valor_unitario->PlaceHolder = ew_RemoveHtml($this->repasse_valor_unitario->FldCaption());
		if (strval($this->repasse_valor_unitario->EditValue) <> "" && is_numeric($this->repasse_valor_unitario->EditValue)) $this->repasse_valor_unitario->EditValue = ew_FormatNumber($this->repasse_valor_unitario->EditValue, -2, -2, -2, -2);

		// repasse_valor_mes
		$this->repasse_valor_mes->EditAttrs["class"] = "form-control";
		$this->repasse_valor_mes->EditCustomAttributes = "";
		$this->repasse_valor_mes->EditValue = $this->repasse_valor_mes->CurrentValue;
		$this->repasse_valor_mes->PlaceHolder = ew_RemoveHtml($this->repasse_valor_mes->FldCaption());
		if (strval($this->repasse_valor_mes->EditValue) <> "" && is_numeric($this->repasse_valor_mes->EditValue)) $this->repasse_valor_mes->EditValue = ew_FormatNumber($this->repasse_valor_mes->EditValue, -2, -2, -2, -2);

		// repasse_valor_previsto
		$this->repasse_valor_previsto->EditAttrs["class"] = "form-control";
		$this->repasse_valor_previsto->EditCustomAttributes = "";
		$this->repasse_valor_previsto->EditValue = $this->repasse_valor_previsto->CurrentValue;
		$this->repasse_valor_previsto->PlaceHolder = ew_RemoveHtml($this->repasse_valor_previsto->FldCaption());
		if (strval($this->repasse_valor_previsto->EditValue) <> "" && is_numeric($this->repasse_valor_previsto->EditValue)) $this->repasse_valor_previsto->EditValue = ew_FormatNumber($this->repasse_valor_previsto->EditValue, -2, -2, -2, -2);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
			if (is_numeric($this->repasse_valor_previsto->CurrentValue))
				$this->repasse_valor_previsto->Total += $this->repasse_valor_previsto->CurrentValue; // Accumulate total
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
			$this->repasse_valor_previsto->CurrentValue = $this->repasse_valor_previsto->Total;
			$this->repasse_valor_previsto->ViewValue = $this->repasse_valor_previsto->CurrentValue;
			$this->repasse_valor_previsto->ViewValue = ew_FormatCurrency($this->repasse_valor_previsto->ViewValue, 2, -2, -2, -2);
			$this->repasse_valor_previsto->CellCssStyle .= "text-align: right;";
			$this->repasse_valor_previsto->ViewCustomAttributes = "";
			$this->repasse_valor_previsto->HrefValue = ""; // Clear href value

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
					if ($this->repasse_id_termos->Exportable) $Doc->ExportCaption($this->repasse_id_termos);
					if ($this->repasse_faixa_etaria->Exportable) $Doc->ExportCaption($this->repasse_faixa_etaria);
					if ($this->repasse_meta->Exportable) $Doc->ExportCaption($this->repasse_meta);
					if ($this->repasse_valor_unitario->Exportable) $Doc->ExportCaption($this->repasse_valor_unitario);
					if ($this->repasse_valor_mes->Exportable) $Doc->ExportCaption($this->repasse_valor_mes);
					if ($this->repasse_valor_previsto->Exportable) $Doc->ExportCaption($this->repasse_valor_previsto);
				} else {
					if ($this->repasse_id_termos->Exportable) $Doc->ExportCaption($this->repasse_id_termos);
					if ($this->repasse_faixa_etaria->Exportable) $Doc->ExportCaption($this->repasse_faixa_etaria);
					if ($this->repasse_meta->Exportable) $Doc->ExportCaption($this->repasse_meta);
					if ($this->repasse_valor_unitario->Exportable) $Doc->ExportCaption($this->repasse_valor_unitario);
					if ($this->repasse_valor_mes->Exportable) $Doc->ExportCaption($this->repasse_valor_mes);
					if ($this->repasse_valor_previsto->Exportable) $Doc->ExportCaption($this->repasse_valor_previsto);
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
						if ($this->repasse_id_termos->Exportable) $Doc->ExportField($this->repasse_id_termos);
						if ($this->repasse_faixa_etaria->Exportable) $Doc->ExportField($this->repasse_faixa_etaria);
						if ($this->repasse_meta->Exportable) $Doc->ExportField($this->repasse_meta);
						if ($this->repasse_valor_unitario->Exportable) $Doc->ExportField($this->repasse_valor_unitario);
						if ($this->repasse_valor_mes->Exportable) $Doc->ExportField($this->repasse_valor_mes);
						if ($this->repasse_valor_previsto->Exportable) $Doc->ExportField($this->repasse_valor_previsto);
					} else {
						if ($this->repasse_id_termos->Exportable) $Doc->ExportField($this->repasse_id_termos);
						if ($this->repasse_faixa_etaria->Exportable) $Doc->ExportField($this->repasse_faixa_etaria);
						if ($this->repasse_meta->Exportable) $Doc->ExportField($this->repasse_meta);
						if ($this->repasse_valor_unitario->Exportable) $Doc->ExportField($this->repasse_valor_unitario);
						if ($this->repasse_valor_mes->Exportable) $Doc->ExportField($this->repasse_valor_mes);
						if ($this->repasse_valor_previsto->Exportable) $Doc->ExportField($this->repasse_valor_previsto);
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
				if ($this->repasse_id_termos->Exportable) $Doc->ExportAggregate($this->repasse_id_termos, '');
				if ($this->repasse_faixa_etaria->Exportable) $Doc->ExportAggregate($this->repasse_faixa_etaria, '');
				if ($this->repasse_meta->Exportable) $Doc->ExportAggregate($this->repasse_meta, '');
				if ($this->repasse_valor_unitario->Exportable) $Doc->ExportAggregate($this->repasse_valor_unitario, '');
				if ($this->repasse_valor_mes->Exportable) $Doc->ExportAggregate($this->repasse_valor_mes, '');
				if ($this->repasse_valor_previsto->Exportable) $Doc->ExportAggregate($this->repasse_valor_previsto, 'TOTAL');
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
