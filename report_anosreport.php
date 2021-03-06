<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php

// Global variable for table object
$report_anos = NULL;

//
// Table class for report_anos
//
class creport_anos extends cTableBase {
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
		$this->TableVar = 'report_anos';
		$this->TableName = 'report_anos';
		$this->TableType = 'REPORT';

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
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// ano_id
		$this->ano_id = new cField('report_anos', 'report_anos', 'x_ano_id', 'ano_id', '`ano_id`', '`ano_id`', 20, -1, FALSE, '`ano_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ano_id->Sortable = FALSE; // Allow sort
		$this->ano_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ano_id'] = &$this->ano_id;

		// ano_ano
		$this->ano_ano = new cField('report_anos', 'report_anos', 'x_ano_ano', 'ano_ano', '`ano_ano`', '`ano_ano`', 3, -1, FALSE, '`ano_ano`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_ano->Sortable = FALSE; // Allow sort
		$this->ano_ano->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ano_ano'] = &$this->ano_ano;

		// ano_descri
		$this->ano_descri = new cField('report_anos', 'report_anos', 'x_ano_descri', 'ano_descri', '`ano_descri`', '`ano_descri`', 200, -1, FALSE, '`ano_descri`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_descri->Sortable = FALSE; // Allow sort
		$this->fields['ano_descri'] = &$this->ano_descri;

		// ano_valor_total
		$this->ano_valor_total = new cField('report_anos', 'report_anos', 'x_ano_valor_total', 'ano_valor_total', '`ano_valor_total`', '`ano_valor_total`', 5, -1, FALSE, '`ano_valor_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_valor_total->Sortable = FALSE; // Allow sort
		$this->ano_valor_total->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ano_valor_total'] = &$this->ano_valor_total;

		// ano_vigencia_ini
		$this->ano_vigencia_ini = new cField('report_anos', 'report_anos', 'x_ano_vigencia_ini', 'ano_vigencia_ini', '`ano_vigencia_ini`', ew_CastDateFieldForLike('`ano_vigencia_ini`', 0, "DB"), 133, 0, FALSE, '`ano_vigencia_ini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_vigencia_ini->Sortable = FALSE; // Allow sort
		$this->ano_vigencia_ini->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ano_vigencia_ini'] = &$this->ano_vigencia_ini;

		// ano_vigencia_fim
		$this->ano_vigencia_fim = new cField('report_anos', 'report_anos', 'x_ano_vigencia_fim', 'ano_vigencia_fim', '`ano_vigencia_fim`', ew_CastDateFieldForLike('`ano_vigencia_fim`', 0, "DB"), 133, 0, FALSE, '`ano_vigencia_fim`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_vigencia_fim->Sortable = FALSE; // Allow sort
		$this->ano_vigencia_fim->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['ano_vigencia_fim'] = &$this->ano_vigencia_fim;

		// ano_prest_contas
		$this->ano_prest_contas = new cField('report_anos', 'report_anos', 'x_ano_prest_contas', 'ano_prest_contas', '`ano_prest_contas`', '`ano_prest_contas`', 200, -1, FALSE, '`ano_prest_contas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ano_prest_contas->Sortable = FALSE; // Allow sort
		$this->fields['ano_prest_contas'] = &$this->ano_prest_contas;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Report detail level SQL
	var $_SqlDetailSelect = "";

	function getSqlDetailSelect() { // Select
		return ($this->_SqlDetailSelect <> "") ? $this->_SqlDetailSelect : "SELECT * FROM `rc25_ano_vigente`";
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
		return ($this->_SqlDetailOrderBy <> "") ? $this->_SqlDetailOrderBy : "`ano_ano` DESC";
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
			return "report_anosreport.php";
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
		return "report_anosreport.php";
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

$report_anos_report = NULL; // Initialize page object first

class creport_anos_report extends creport_anos {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'report_anos';

	// Page object name
	var $PageObjName = 'report_anos_report';

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

		// Table object (report_anos)
		if (!isset($GLOBALS["report_anos"]) || get_class($GLOBALS["report_anos"]) == "creport_anos") {
			$GLOBALS["report_anos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_anos"];
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
			define("EW_TABLE_NAME", 'report_anos', TRUE);

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
		$this->ReportGroups = &ew_InitArray(1, NULL);
		$this->ReportCounts = &ew_InitArray(1, 0);
		$this->LevelBreak = &ew_InitArray(1, FALSE);
		$this->ReportTotals = &ew_Init2DArray(1, 7, 0);
		$this->ReportMaxs = &ew_Init2DArray(1, 7, 0);
		$this->ReportMins = &ew_Init2DArray(1, 7, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->ano_valor_total->FormValue == $this->ano_valor_total->CurrentValue && is_numeric(ew_StrToFloat($this->ano_valor_total->CurrentValue)))
			$this->ano_valor_total->CurrentValue = ew_StrToFloat($this->ano_valor_total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ano_id
		// ano_ano
		// ano_descri
		// ano_valor_total
		// ano_vigencia_ini
		// ano_vigencia_fim
		// ano_prest_contas

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$this->ano_vigencia_ini->ViewValue = ew_FormatDateTime($this->ano_vigencia_ini->ViewValue, 0);
		$this->ano_vigencia_ini->ViewCustomAttributes = "";

		// ano_vigencia_fim
		$this->ano_vigencia_fim->ViewValue = $this->ano_vigencia_fim->CurrentValue;
		$this->ano_vigencia_fim->ViewValue = ew_FormatDateTime($this->ano_vigencia_fim->ViewValue, 0);
		$this->ano_vigencia_fim->ViewCustomAttributes = "";

		// ano_prest_contas
		$this->ano_prest_contas->ViewValue = $this->ano_prest_contas->CurrentValue;
		$this->ano_prest_contas->ViewCustomAttributes = "";

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
if (!isset($report_anos_report)) $report_anos_report = new creport_anos_report();

// Page init
$report_anos_report->Page_Init();

// Page main
$report_anos_report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$report_anos_report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($report_anos->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<link rel="stylesheet" type="text/css" href="phpcss/meucss<?php echo $MyCor?>.css">

<?php } ?>
<?php
$report_anos_report->RecCnt = 1; // No grouping
if ($report_anos_report->DbDetailFilter <> "") {
	if ($report_anos_report->ReportFilter <> "") $report_anos_report->ReportFilter .= " AND ";
	$report_anos_report->ReportFilter .= "(" . $report_anos_report->DbDetailFilter . ")";
}
$ReportConn = &$report_anos_report->Connection();

// Set up detail SQL
$report_anos->CurrentFilter = $report_anos_report->ReportFilter;
$report_anos_report->ReportSql = $report_anos->DetailSQL();

// Load recordset
$report_anos_report->Recordset = $ReportConn->Execute($report_anos_report->ReportSql);
$report_anos_report->RecordExists = !$report_anos_report->Recordset->EOF;
?>
<?php if ($report_anos->Export == "") { ?>
<?php if ($report_anos_report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $report_anos_report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $report_anos_report->ShowPageHeader(); ?>

<?php

	// Get detail records
	$report_anos_report->ReportFilter = $report_anos_report->DefaultFilter;
	if ($report_anos_report->DbDetailFilter <> "") {
		if ($report_anos_report->ReportFilter <> "")
			$report_anos_report->ReportFilter .= " AND ";
		$report_anos_report->ReportFilter .= "(" . $report_anos_report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$report_anos->CurrentFilter = $report_anos_report->ReportFilter;
	$report_anos_report->ReportSql = $report_anos->DetailSQL();

	// Load detail records
	$report_anos_report->DetailRecordset = $ReportConn->Execute($report_anos_report->ReportSql);
	$report_anos_report->DtlRecordCount = $report_anos_report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$report_anos_report->DetailRecordset->EOF) {
		$report_anos_report->RecCnt++;
	}
	if ($report_anos_report->RecCnt == 1) {
		$report_anos_report->ReportCounts[0] = 0;
	}
	$report_anos_report->ReportCounts[0] += $report_anos_report->DtlRecordCount;
	if ($report_anos_report->RecordExists) {
?>
<?php include_once "report_navbar_anos.php" ?>

		<div class="container">
			<div class="row">
				<div  class="col-md-12">
				<p align="center" class="aviso0"><b>Nesta p??gina voce ter?? acesso a dados, informa????es, relatorios,documentos e outros<br> recursos para acompanhar os contratos de parceria entre a entidade e o setor p??blico.</b></p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
<?php
	$cor_div = "cordiv1";
	}
	while (!$report_anos_report->DetailRecordset->EOF) {
		$report_anos_report->RowCnt++;
		$report_anos->ano_ano->setDbValue($report_anos_report->DetailRecordset->fields('ano_ano'));
		$report_anos->ano_descri->setDbValue($report_anos_report->DetailRecordset->fields('ano_descri'));
		$report_anos->ano_valor_total->setDbValue($report_anos_report->DetailRecordset->fields('ano_valor_total'));
		$report_anos->ano_vigencia_ini->setDbValue($report_anos_report->DetailRecordset->fields('ano_vigencia_ini'));
		$report_anos->ano_vigencia_fim->setDbValue($report_anos_report->DetailRecordset->fields('ano_vigencia_fim'));
		$report_anos->ano_prest_contas->setDbValue($report_anos_report->DetailRecordset->fields('ano_prest_contas'));

		// Render for view
		$report_anos->RowType = EW_ROWTYPE_VIEW;
		$report_anos->ResetAttrs();
		$report_anos_report->RenderRow();
?>
	<div class="col-md-3">
		<a href="report_parceria_repassereport.php?ano=<?php echo $report_anos->ano_ano->ViewValue; ?>" target="" style="text-decoration:none; color:#000;">
		<div class="col-md-12 <?php echo $cor_div; ?>">
	<?php echo "<h2>Ano ".$report_anos->ano_ano->ViewValue."</h2>"; ?><br>
	<?php echo $report_anos->ano_descri->ViewValue; ?><hr>
	<?php echo "Valor: <b>R".$report_anos->ano_valor_total->ViewValue."</b>"; ?><br>
	<?php echo "Vig??ncia: ".$report_anos->ano_vigencia_ini->ViewValue; ?>
	<?php echo " a ".$report_anos->ano_vigencia_fim->ViewValue; ?><br>
	<?php echo $report_anos->ano_prest_contas->ViewValue; ?>
		</div>
		</a>
	</div>
<?php
		$cor_div="cordiv0";
		$report_anos_report->DetailRecordset->MoveNext();
	}
	$report_anos_report->DetailRecordset->Close();
?>

	</div>
</div>
<hr>
	
<?php
$report_anos_report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($report_anos->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$report_anos_report->Page_Terminate();
?>
