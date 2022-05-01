<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php

// Global variable for table object
$report_recursos_apl_ = NULL;
$recebe_ano =  intval($_GET['ano']);

//
// Table class for report_recursos_apl_
//
class creport_recursos_apl_ extends cTableBase {
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
		$this->TableVar = 'report_recursos_apl_';
		$this->TableName = 'report_recursos_apl_';
		$this->TableType = 'REPORT';

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
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// ra_id
		$this->ra_id = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_id', 'ra_id', '`ra_id`', '`ra_id`', 20, -1, FALSE, '`ra_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ra_id->Sortable = FALSE; // Allow sort
		$this->ra_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_id'] = &$this->ra_id;

		// ra_exercicio
		$this->ra_exercicio = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_exercicio', 'ra_exercicio', '`ra_exercicio`', '`ra_exercicio`', 3, -1, FALSE, '`ra_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_exercicio->Sortable = FALSE; // Allow sort
		$this->ra_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_exercicio'] = &$this->ra_exercicio;

		// ra_data_cadastro
		$this->ra_data_cadastro = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_data_cadastro', 'ra_data_cadastro', '`ra_data_cadastro`', ew_CastDateFieldForLike('`ra_data_cadastro`', 7, "DB"), 133, 7, FALSE, '`ra_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_data_cadastro->Sortable = FALSE; // Allow sort
		$this->ra_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ra_data_cadastro'] = &$this->ra_data_cadastro;

		// ra_data_pagamento
		$this->ra_data_pagamento = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_data_pagamento', 'ra_data_pagamento', '`ra_data_pagamento`', ew_CastDateFieldForLike('`ra_data_pagamento`', 7, "DB"), 133, 7, FALSE, '`ra_data_pagamento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_data_pagamento->Sortable = TRUE; // Allow sort
		$this->ra_data_pagamento->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['ra_data_pagamento'] = &$this->ra_data_pagamento;

		// ra_especificacoes
		$this->ra_especificacoes = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_especificacoes', 'ra_especificacoes', '`ra_especificacoes`', '`ra_especificacoes`', 200, -1, FALSE, '`ra_especificacoes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_especificacoes->Sortable = FALSE; // Allow sort
		$this->fields['ra_especificacoes'] = &$this->ra_especificacoes;

		// ra_credor
		$this->ra_credor = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_credor', 'ra_credor', '`ra_credor`', '`ra_credor`', 3, -1, FALSE, '`ra_credor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_credor->Sortable = FALSE; // Allow sort
		$this->ra_credor->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_credor->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_credor->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_credor'] = &$this->ra_credor;

		// ra_identificador
		$this->ra_identificador = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_identificador', 'ra_identificador', '`ra_identificador`', '`ra_identificador`', 3, -1, FALSE, '`ra_identificador`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_identificador->Sortable = FALSE; // Allow sort
		$this->ra_identificador->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_identificador->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['ra_identificador'] = &$this->ra_identificador;

		// ra_plano
		$this->ra_plano = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_plano', 'ra_plano', '`ra_plano`', '`ra_plano`', 200, -1, FALSE, '`ra_plano`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_plano->Sortable = FALSE; // Allow sort
		$this->fields['ra_plano'] = &$this->ra_plano;

		// ra_natureza
		$this->ra_natureza = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_natureza', 'ra_natureza', '`ra_natureza`', '`ra_natureza`', 3, -1, FALSE, '`ra_natureza`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->ra_natureza->Sortable = FALSE; // Allow sort
		$this->ra_natureza->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->ra_natureza->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->ra_natureza->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ra_natureza'] = &$this->ra_natureza;

		// ra_valor
		$this->ra_valor = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_valor', 'ra_valor', '`ra_valor`', '`ra_valor`', 5, -1, FALSE, '`ra_valor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_valor->Sortable = FALSE; // Allow sort
		$this->ra_valor->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['ra_valor'] = &$this->ra_valor;

		// ra_comprovante
		$this->ra_comprovante = new cField('report_recursos_apl_', 'report_recursos_apl_', 'x_ra_comprovante', 'ra_comprovante', '`ra_comprovante`', '`ra_comprovante`', 200, -1, FALSE, '`ra_comprovante`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ra_comprovante->Sortable = FALSE; // Allow sort
		$this->fields['ra_comprovante'] = &$this->ra_comprovante;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Report detail level SQL
	var $_SqlDetailSelect = "";

	function getSqlDetailSelect() { // Select
		$recebe_ano =  intval($_GET['ano']);
		return ($this->_SqlDetailSelect <> "") ? $this->_SqlDetailSelect : "SELECT * FROM `rc25_a_recurso_aplicados` Where ra_exercicio = $recebe_ano";
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
		return ($this->_SqlDetailOrderBy <> "") ? $this->_SqlDetailOrderBy : "`ra_data_pagamento` DESC";
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
			return "report_recursos_apl_report.php";
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
		return "report_recursos_apl_report.php";
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

$report_recursos_apl__report = NULL; // Initialize page object first

class creport_recursos_apl__report extends creport_recursos_apl_ {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'report_recursos_apl_';

	// Page object name
	var $PageObjName = 'report_recursos_apl__report';

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

		// Table object (report_recursos_apl_)
		if (!isset($GLOBALS["report_recursos_apl_"]) || get_class($GLOBALS["report_recursos_apl_"]) == "creport_recursos_apl_") {
			$GLOBALS["report_recursos_apl_"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_recursos_apl_"];
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
			define("EW_TABLE_NAME", 'report_recursos_apl_', TRUE);

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
		$this->ReportTotals = &ew_Init2DArray(1, 8, 0);
		$this->ReportMaxs = &ew_Init2DArray(1, 8, 0);
		$this->ReportMins = &ew_Init2DArray(1, 8, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->ra_valor->FormValue == $this->ra_valor->CurrentValue && is_numeric(ew_StrToFloat($this->ra_valor->CurrentValue)))
			$this->ra_valor->CurrentValue = ew_StrToFloat($this->ra_valor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ra_id
		// ra_exercicio
		// ra_data_cadastro
		// ra_data_pagamento
		// ra_especificacoes
		// ra_credor
		// ra_identificador
		// ra_plano
		// ra_natureza
		// ra_valor
		// ra_comprovante

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// ra_data_pagamento
		$this->ra_data_pagamento->ViewValue = $this->ra_data_pagamento->CurrentValue;
		$this->ra_data_pagamento->ViewValue = ew_FormatDateTime($this->ra_data_pagamento->ViewValue, 7);
		$this->ra_data_pagamento->ViewCustomAttributes = "";

		// ra_especificacoes
		$this->ra_especificacoes->ViewValue = $this->ra_especificacoes->CurrentValue;
		$this->ra_especificacoes->ViewCustomAttributes = "";

		// ra_identificador
		if (strval($this->ra_identificador->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->ra_identificador->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->ra_identificador->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
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
		$this->ra_comprovante->CellCssStyle .= "text-align: left;";
		$this->ra_comprovante->ViewCustomAttributes = "";

			// ra_data_pagamento
			$this->ra_data_pagamento->LinkCustomAttributes = "";
			$this->ra_data_pagamento->HrefValue = "";
			$this->ra_data_pagamento->TooltipValue = "";

			// ra_especificacoes
			$this->ra_especificacoes->LinkCustomAttributes = "";
			$this->ra_especificacoes->HrefValue = "";
			$this->ra_especificacoes->TooltipValue = "";

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
if (!isset($report_recursos_apl__report)) $report_recursos_apl__report = new creport_recursos_apl__report();

// Page init
$report_recursos_apl__report->Page_Init();

// Page main
$report_recursos_apl__report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$report_recursos_apl__report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($report_recursos_apl_->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>

<link rel="stylesheet" type="text/css" href="phpcss/meucss<?php echo $MyCor?>.css">

<?php } ?>
<?php
$report_recursos_apl__report->RecCnt = 1; // No grouping
if ($report_recursos_apl__report->DbDetailFilter <> "") {
	if ($report_recursos_apl__report->ReportFilter <> "") $report_recursos_apl__report->ReportFilter .= " AND ";
	$report_recursos_apl__report->ReportFilter .= "(" . $report_recursos_apl__report->DbDetailFilter . ")";
}
$ReportConn = &$report_recursos_apl__report->Connection();

// Set up detail SQL
$report_recursos_apl_->CurrentFilter = $report_recursos_apl__report->ReportFilter;
$report_recursos_apl__report->ReportSql = $report_recursos_apl_->DetailSQL();

// Load recordset
$report_recursos_apl__report->Recordset = $ReportConn->Execute($report_recursos_apl__report->ReportSql);
$report_recursos_apl__report->RecordExists = !$report_recursos_apl__report->Recordset->EOF;
?>
<?php if ($report_recursos_apl_->Export == "") { ?>
<?php if ($report_recursos_apl__report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $report_recursos_apl__report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $report_recursos_apl__report->ShowPageHeader(); ?>

<!--<table class="ewReportTable">-->

<?php

	// Get detail records
	$report_recursos_apl__report->ReportFilter = $report_recursos_apl__report->DefaultFilter;
	if ($report_recursos_apl__report->DbDetailFilter <> "") {
		if ($report_recursos_apl__report->ReportFilter <> "")
			$report_recursos_apl__report->ReportFilter .= " AND ";
		$report_recursos_apl__report->ReportFilter .= "(" . $report_recursos_apl__report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$report_recursos_apl_->CurrentFilter = $report_recursos_apl__report->ReportFilter;
	$report_recursos_apl__report->ReportSql = $report_recursos_apl_->DetailSQL();

	// Load detail records
	$report_recursos_apl__report->DetailRecordset = $ReportConn->Execute($report_recursos_apl__report->ReportSql);
	$report_recursos_apl__report->DtlRecordCount = $report_recursos_apl__report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$report_recursos_apl__report->DetailRecordset->EOF) {
		$report_recursos_apl__report->RecCnt++;
	}
	if ($report_recursos_apl__report->RecCnt == 1) {
		$report_recursos_apl__report->ReportCounts[0] = 0;
	}
	$report_recursos_apl__report->ReportCounts[0] += $report_recursos_apl__report->DtlRecordCount;
	if ($report_recursos_apl__report->RecordExists) {
?>

<?php include_once "report_navbar.php" ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center" style="background-color: #fff; box-shadow: 3px 3px 6px; border-radius:10px;">
			<br>
			<div class="quadros">
				<h1>Recursos Aplicados Exercício <?php echo $recebe_ano ?></h1>
			</div>

			<table border="0" style="border-collapse: collapse; width: 100%;">

	<tr class="tr-campos">
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_data_pagamento->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_especificacoes->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_identificador->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_plano->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_natureza->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_valor->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_recursos_apl_->ra_comprovante->FldCaption() ?></td>
	</tr>
<?php
	}
	while (!$report_recursos_apl__report->DetailRecordset->EOF) {
		$report_recursos_apl__report->RowCnt++;
		$report_recursos_apl_->ra_data_pagamento->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_data_pagamento'));
		$report_recursos_apl_->ra_especificacoes->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_especificacoes'));
		$report_recursos_apl_->ra_identificador->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_identificador'));
		$report_recursos_apl_->ra_plano->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_plano'));
		$report_recursos_apl_->ra_natureza->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_natureza'));
		$report_recursos_apl_->ra_valor->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_valor'));
		$report_recursos_apl_->ra_comprovante->setDbValue($report_recursos_apl__report->DetailRecordset->fields('ra_comprovante'));

		// Render for view
		$report_recursos_apl_->RowType = EW_ROWTYPE_VIEW;
		$report_recursos_apl_->ResetAttrs();
		$report_recursos_apl__report->RenderRow();
?>
	<tr>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_data_pagamento->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_data_pagamento->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_especificacoes->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_especificacoes->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_identificador->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_identificador->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_plano->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_plano->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_natureza->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_natureza->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_valor->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_valor->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_recursos_apl_->ra_comprovante->ViewAttributes() ?>>
<?php echo $report_recursos_apl_->ra_comprovante->ViewValue ?></span>
</td>
	</tr>
<?php
		$report_recursos_apl__report->DetailRecordset->MoveNext();
	}
	$report_recursos_apl__report->DetailRecordset->Close();
?>
<?php if ($report_recursos_apl__report->RecordExists) { ?>
	<tr><td colspan=7>&nbsp;<br></td></tr>
	<tr class="tr-campos"><td colspan=7 class="ewGrandSummary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($report_recursos_apl__report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($report_recursos_apl__report->RecordExists) { ?>
	<tr><td colspan=7>&nbsp;<br></td></tr>
<?php } else { ?>
	<!--<tr><td><?php echo $Language->Phrase("NoRecord") ?></td></tr>-->

	<div class="container">
			<div class="row"><br>
			<?php include_once "report_navbar.php" ?>
				<div  class="col-md-11 text-center" style="border-radius:10px;background:#e63946;margin:10px;padding-bottom:10px;box-shadow:1px 1px 8px 0px #000000;">
				
				<h3><span style="color: #f1faee;"><b>Nenhum registro encontrado!!</b></span></h3>
				<p><a href="report_anosreport.php"><strong>Voltar</strong></a></p>
				</div>
			</div>
	</div>

<?php } ?>
</table>

<br>

		</div>
	</div>
</div>
<br><br><br>

<?php
$report_recursos_apl__report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($report_recursos_apl_->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$report_recursos_apl__report->Page_Terminate();
?>
