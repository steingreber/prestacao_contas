<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php

// Global variable for table object
$report_planos_aplicacao_ = NULL;

//
// Table class for report_planos_aplicacao_
//
class creport_planos_aplicacao_ extends cTableBase {
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
		$this->TableVar = 'report_planos_aplicacao_';
		$this->TableName = 'report_planos_aplicacao_';
		$this->TableType = 'REPORT';

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
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// plano_id
		$this->plano_id = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_id', 'plano_id', '`plano_id`', '`plano_id`', 20, -1, FALSE, '`plano_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->plano_id->Sortable = FALSE; // Allow sort
		$this->plano_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_id'] = &$this->plano_id;

		// plano_exercicio
		$this->plano_exercicio = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_exercicio', 'plano_exercicio', '`plano_exercicio`', '`plano_exercicio`', 3, -1, FALSE, '`plano_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->plano_exercicio->Sortable = FALSE; // Allow sort
		$this->plano_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->plano_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->plano_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_exercicio'] = &$this->plano_exercicio;

		// plano_despesa
		$this->plano_despesa = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_despesa', 'plano_despesa', '`plano_despesa`', '`plano_despesa`', 3, -1, FALSE, '`plano_despesa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->plano_despesa->Sortable = FALSE; // Allow sort
		$this->plano_despesa->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->plano_despesa->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->plano_despesa->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['plano_despesa'] = &$this->plano_despesa;

		// plano_custo_mensal
		$this->plano_custo_mensal = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_custo_mensal', 'plano_custo_mensal', '`plano_custo_mensal`', '`plano_custo_mensal`', 5, -1, FALSE, '`plano_custo_mensal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_custo_mensal->Sortable = FALSE; // Allow sort
		$this->plano_custo_mensal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_custo_mensal'] = &$this->plano_custo_mensal;

		// plano_custo_exercicio
		$this->plano_custo_exercicio = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_custo_exercicio', 'plano_custo_exercicio', '`plano_custo_exercicio`', '`plano_custo_exercicio`', 5, -1, FALSE, '`plano_custo_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_custo_exercicio->Sortable = FALSE; // Allow sort
		$this->plano_custo_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_custo_exercicio'] = &$this->plano_custo_exercicio;

		// plano_recurso_municipal
		$this->plano_recurso_municipal = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_recurso_municipal', 'plano_recurso_municipal', '`plano_recurso_municipal`', '`plano_recurso_municipal`', 5, -1, FALSE, '`plano_recurso_municipal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_recurso_municipal->Sortable = FALSE; // Allow sort
		$this->plano_recurso_municipal->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_recurso_municipal'] = &$this->plano_recurso_municipal;

		// plano_outros_recursos
		$this->plano_outros_recursos = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_outros_recursos', 'plano_outros_recursos', '`plano_outros_recursos`', '`plano_outros_recursos`', 5, -1, FALSE, '`plano_outros_recursos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_outros_recursos->Sortable = FALSE; // Allow sort
		$this->plano_outros_recursos->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['plano_outros_recursos'] = &$this->plano_outros_recursos;

		// plano_data_cadastro
		$this->plano_data_cadastro = new cField('report_planos_aplicacao_', 'report_planos_aplicacao_', 'x_plano_data_cadastro', 'plano_data_cadastro', '`plano_data_cadastro`', ew_CastDateFieldForLike('`plano_data_cadastro`', 1, "DB"), 135, 1, FALSE, '`plano_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->plano_data_cadastro->Sortable = FALSE; // Allow sort
		$this->plano_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['plano_data_cadastro'] = &$this->plano_data_cadastro;
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
		return ($this->_SqlGroupSelect <> "") ? $this->_SqlGroupSelect : "SELECT DISTINCT `plano_exercicio` FROM `rc25_a_planos_aplicacao` where plano_exercicio = $recebe_ano";
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
		return ($this->_SqlGroupOrderBy <> "") ? $this->_SqlGroupOrderBy : "`plano_exercicio` ASC";
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
		return ($this->_SqlDetailSelect <> "") ? $this->_SqlDetailSelect : "SELECT * FROM `rc25_a_planos_aplicacao`";
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
		return ($this->_SqlDetailOrderBy <> "") ? $this->_SqlDetailOrderBy : "";
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
			return "report_planos_aplicacao_report.php";
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
		return "report_planos_aplicacao_report.php";
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

$report_planos_aplicacao__report = NULL; // Initialize page object first

class creport_planos_aplicacao__report extends creport_planos_aplicacao_ {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'report_planos_aplicacao_';

	// Page object name
	var $PageObjName = 'report_planos_aplicacao__report';

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

		// Table object (report_planos_aplicacao_)
		if (!isset($GLOBALS["report_planos_aplicacao_"]) || get_class($GLOBALS["report_planos_aplicacao_"]) == "creport_planos_aplicacao_") {
			$GLOBALS["report_planos_aplicacao_"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_planos_aplicacao_"];
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
			define("EW_TABLE_NAME", 'report_planos_aplicacao_', TRUE);

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
		$this->ReportTotals = &ew_Init2DArray(2, 6, 0);
		$this->ReportMaxs = &ew_Init2DArray(2, 6, 0);
		$this->ReportMins = &ew_Init2DArray(2, 6, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Check level break
	function ChkLvlBreak() {
		$this->LevelBreak[1] = FALSE;
		if ($this->RecCnt == 0) { // Start Or End of Recordset
			$this->LevelBreak[1] = TRUE;
		} else {
			if (!ew_CompareValue($this->plano_exercicio->CurrentValue, $this->ReportGroups[0])) {
				$this->LevelBreak[1] = TRUE;
			}
		}
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->plano_custo_mensal->FormValue == $this->plano_custo_mensal->CurrentValue && is_numeric(ew_StrToFloat($this->plano_custo_mensal->CurrentValue)))
			$this->plano_custo_mensal->CurrentValue = ew_StrToFloat($this->plano_custo_mensal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->plano_custo_exercicio->FormValue == $this->plano_custo_exercicio->CurrentValue && is_numeric(ew_StrToFloat($this->plano_custo_exercicio->CurrentValue)))
			$this->plano_custo_exercicio->CurrentValue = ew_StrToFloat($this->plano_custo_exercicio->CurrentValue);

		// Convert decimal values if posted back
		if ($this->plano_recurso_municipal->FormValue == $this->plano_recurso_municipal->CurrentValue && is_numeric(ew_StrToFloat($this->plano_recurso_municipal->CurrentValue)))
			$this->plano_recurso_municipal->CurrentValue = ew_StrToFloat($this->plano_recurso_municipal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->plano_outros_recursos->FormValue == $this->plano_outros_recursos->CurrentValue && is_numeric(ew_StrToFloat($this->plano_outros_recursos->CurrentValue)))
			$this->plano_outros_recursos->CurrentValue = ew_StrToFloat($this->plano_outros_recursos->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// plano_id
		// plano_exercicio
		// plano_despesa
		// plano_custo_mensal
		// plano_custo_exercicio
		// plano_recurso_municipal
		// plano_outros_recursos
		// plano_data_cadastro

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// plano_exercicio
		if (strval($this->plano_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->plano_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->plano_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
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
		$this->plano_despesa->CssStyle = "font-weight: bold;";
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
if (!isset($report_planos_aplicacao__report)) $report_planos_aplicacao__report = new creport_planos_aplicacao__report();

// Page init
$report_planos_aplicacao__report->Page_Init();

// Page main
$report_planos_aplicacao__report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$report_planos_aplicacao__report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($report_planos_aplicacao_->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<link rel="stylesheet" type="text/css" href="phpcss/meucss<?php echo $MyCor?>.css">

<?php } ?>
<?php
$report_planos_aplicacao__report->DefaultFilter = "";
$report_planos_aplicacao__report->ReportFilter = $report_planos_aplicacao__report->DefaultFilter;
if ($report_planos_aplicacao__report->DbDetailFilter <> "") {
	if ($report_planos_aplicacao__report->ReportFilter <> "") $report_planos_aplicacao__report->ReportFilter .= " AND ";
	$report_planos_aplicacao__report->ReportFilter .= "(" . $report_planos_aplicacao__report->DbDetailFilter . ")";
}
$ReportConn = &$report_planos_aplicacao__report->Connection();

// Set up filter and load Group level sql
$report_planos_aplicacao_->CurrentFilter = $report_planos_aplicacao__report->ReportFilter;
$report_planos_aplicacao__report->ReportSql = $report_planos_aplicacao_->GroupSQL();

// Load recordset
$report_planos_aplicacao__report->Recordset = $ReportConn->Execute($report_planos_aplicacao__report->ReportSql);
$report_planos_aplicacao__report->RecordExists = !$report_planos_aplicacao__report->Recordset->EOF;
?>
<?php if ($report_planos_aplicacao_->Export == "") { ?>
<?php if ($report_planos_aplicacao__report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $report_planos_aplicacao__report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $report_planos_aplicacao__report->ShowPageHeader(); ?>


<!--<table class="ewReportTable">-->


<?php

// Get First Row
if ($report_planos_aplicacao__report->RecordExists) {
	$report_planos_aplicacao_->plano_exercicio->setDbValue($report_planos_aplicacao__report->Recordset->fields('plano_exercicio'));
	$report_planos_aplicacao__report->ReportGroups[0] = $report_planos_aplicacao_->plano_exercicio->DbValue;
}
$report_planos_aplicacao__report->RecCnt = 0;
$report_planos_aplicacao__report->ReportCounts[0] = 0;
$report_planos_aplicacao__report->ChkLvlBreak();
while (!$report_planos_aplicacao__report->Recordset->EOF) {

	// Render for view
	$report_planos_aplicacao_->RowType = EW_ROWTYPE_VIEW;
	$report_planos_aplicacao_->ResetAttrs();
	$report_planos_aplicacao__report->RenderRow();

	// Show group headers
	if ($report_planos_aplicacao__report->LevelBreak[1]) { // Reset counter and aggregation
?>
<!--	<tr><td class="ewGroupField"><?php echo $report_planos_aplicacao_->plano_exercicio->FldCaption() ?></td>
	<td colspan=5 class="ewGroupName">
<span<?php echo $report_planos_aplicacao_->plano_exercicio->ViewAttributes() ?>>
	-->
<?php include_once "report_navbar.php" ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center" style="background-color: #fff; box-shadow: 3px 3px 6px; border-radius:10px;">
			<br>
			<div class="quadros">
				<h1>Planos de apicação Exercício <?php echo $report_planos_aplicacao_->plano_exercicio->ViewValue ?></h1>
			</div>

			<table border=0 style="border-collapse: collapse; width: 100%;">
<?php

	}

	// Get detail records
	$report_planos_aplicacao__report->ReportFilter = $report_planos_aplicacao__report->DefaultFilter;
	if ($report_planos_aplicacao__report->ReportFilter <> "") $report_planos_aplicacao__report->ReportFilter .= " AND ";
	if (is_null($report_planos_aplicacao_->plano_exercicio->CurrentValue)) {
		$report_planos_aplicacao__report->ReportFilter .= "(`plano_exercicio` IS NULL)";
	} else {
		$report_planos_aplicacao__report->ReportFilter .= "(`plano_exercicio` = " . ew_QuotedValue($report_planos_aplicacao_->plano_exercicio->CurrentValue, EW_DATATYPE_NUMBER, $report_planos_aplicacao__report->DBID) . ")";
	}
	if ($report_planos_aplicacao__report->DbDetailFilter <> "") {
		if ($report_planos_aplicacao__report->ReportFilter <> "")
			$report_planos_aplicacao__report->ReportFilter .= " AND ";
		$report_planos_aplicacao__report->ReportFilter .= "(" . $report_planos_aplicacao__report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$report_planos_aplicacao_->CurrentFilter = $report_planos_aplicacao__report->ReportFilter;
	$report_planos_aplicacao__report->ReportSql = $report_planos_aplicacao_->DetailSQL();

	// Load detail records
	$report_planos_aplicacao__report->DetailRecordset = $ReportConn->Execute($report_planos_aplicacao__report->ReportSql);
	$report_planos_aplicacao__report->DtlRecordCount = $report_planos_aplicacao__report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$report_planos_aplicacao__report->DetailRecordset->EOF) {
		$report_planos_aplicacao__report->RecCnt++;
		$report_planos_aplicacao_->plano_custo_mensal->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_custo_mensal'));
		$report_planos_aplicacao_->plano_custo_exercicio->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_custo_exercicio'));
		$report_planos_aplicacao_->plano_recurso_municipal->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_recurso_municipal'));
		$report_planos_aplicacao_->plano_outros_recursos->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_outros_recursos'));
	}
	if ($report_planos_aplicacao__report->RecCnt == 1) {
		$report_planos_aplicacao__report->ReportCounts[0] = 0;
		$report_planos_aplicacao__report->ReportTotals[0][1] = 0;
		$report_planos_aplicacao__report->ReportTotals[0][2] = 0;
		$report_planos_aplicacao__report->ReportTotals[0][3] = 0;
		$report_planos_aplicacao__report->ReportTotals[0][4] = 0;
	}
	for ($i = 1; $i <= 1; $i++) {
		if ($report_planos_aplicacao__report->LevelBreak[$i]) { // Reset counter and aggregation
			$report_planos_aplicacao__report->ReportCounts[$i] = 0;
			$report_planos_aplicacao__report->ReportTotals[$i][1] = 0;
			$report_planos_aplicacao__report->ReportTotals[$i][2] = 0;
			$report_planos_aplicacao__report->ReportTotals[$i][3] = 0;
			$report_planos_aplicacao__report->ReportTotals[$i][4] = 0;
		}
	}
	$report_planos_aplicacao__report->ReportCounts[0] += $report_planos_aplicacao__report->DtlRecordCount;
	$report_planos_aplicacao__report->ReportCounts[1] += $report_planos_aplicacao__report->DtlRecordCount;
	if ($report_planos_aplicacao__report->RecordExists) {
?>
	<tr class="tr-campos">
		<td class="td-direita"><?php echo $report_planos_aplicacao_->plano_despesa->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_planos_aplicacao_->plano_custo_mensal->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_planos_aplicacao_->plano_custo_exercicio->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_planos_aplicacao_->plano_recurso_municipal->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_planos_aplicacao_->plano_outros_recursos->FldCaption() ?></td>
	</tr>
<?php
	}
	while (!$report_planos_aplicacao__report->DetailRecordset->EOF) {
		$report_planos_aplicacao__report->RowCnt++;
		$report_planos_aplicacao_->plano_despesa->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_despesa'));
		$report_planos_aplicacao_->plano_custo_mensal->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_custo_mensal'));
		$report_planos_aplicacao__report->ReportTotals[0][1] += $report_planos_aplicacao_->plano_custo_mensal->CurrentValue;
		$report_planos_aplicacao__report->ReportTotals[1][1] += $report_planos_aplicacao_->plano_custo_mensal->CurrentValue;
		$report_planos_aplicacao_->plano_custo_exercicio->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_custo_exercicio'));
		$report_planos_aplicacao__report->ReportTotals[0][2] += $report_planos_aplicacao_->plano_custo_exercicio->CurrentValue;
		$report_planos_aplicacao__report->ReportTotals[1][2] += $report_planos_aplicacao_->plano_custo_exercicio->CurrentValue;
		$report_planos_aplicacao_->plano_recurso_municipal->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_recurso_municipal'));
		$report_planos_aplicacao__report->ReportTotals[0][3] += $report_planos_aplicacao_->plano_recurso_municipal->CurrentValue;
		$report_planos_aplicacao__report->ReportTotals[1][3] += $report_planos_aplicacao_->plano_recurso_municipal->CurrentValue;
		$report_planos_aplicacao_->plano_outros_recursos->setDbValue($report_planos_aplicacao__report->DetailRecordset->fields('plano_outros_recursos'));
		$report_planos_aplicacao__report->ReportTotals[0][4] += $report_planos_aplicacao_->plano_outros_recursos->CurrentValue;
		$report_planos_aplicacao__report->ReportTotals[1][4] += $report_planos_aplicacao_->plano_outros_recursos->CurrentValue;

		// Render for view
		$report_planos_aplicacao_->RowType = EW_ROWTYPE_VIEW;
		$report_planos_aplicacao_->ResetAttrs();
		$report_planos_aplicacao__report->RenderRow();
?>
	<tr>
		<td class="td-direita">
<span <?php echo $report_planos_aplicacao_->plano_despesa->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_despesa->ViewValue ?></span>
</td>
		<td class="td-direita">
<span <?php echo $report_planos_aplicacao_->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_custo_mensal->ViewValue ?></span>
</td>
		<td class="td-direita">
<span <?php echo $report_planos_aplicacao_->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_custo_exercicio->ViewValue ?></span>
</td>
		<td class="td-direita">
<span <?php echo $report_planos_aplicacao_->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_recurso_municipal->ViewValue ?></span>
</td>
		<td class="td-direita">
<span <?php echo $report_planos_aplicacao_->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_outros_recursos->ViewValue ?></span>
</td>
	</tr>
<?php
		$report_planos_aplicacao__report->DetailRecordset->MoveNext();
	}
	$report_planos_aplicacao__report->DetailRecordset->Close();

	// Save old group data
	$report_planos_aplicacao__report->ReportGroups[0] = $report_planos_aplicacao_->plano_exercicio->CurrentValue;

	// Get next record
	$report_planos_aplicacao__report->Recordset->MoveNext();
	if ($report_planos_aplicacao__report->Recordset->EOF) {
		$report_planos_aplicacao__report->RecCnt = 0; // EOF, force all level breaks
	} else {
		$report_planos_aplicacao_->plano_exercicio->setDbValue($report_planos_aplicacao__report->Recordset->fields('plano_exercicio'));
	}
	$report_planos_aplicacao__report->ChkLvlBreak();

	// Show footers
	if ($report_planos_aplicacao__report->LevelBreak[1]) {
		$report_planos_aplicacao_->plano_exercicio->CurrentValue = $report_planos_aplicacao__report->ReportGroups[0];

		// Render row for view
		$report_planos_aplicacao_->RowType = EW_ROWTYPE_VIEW;
		$report_planos_aplicacao_->ResetAttrs();
		$report_planos_aplicacao__report->RenderRow();
		$report_planos_aplicacao_->plano_exercicio->CurrentValue = $report_planos_aplicacao_->plano_exercicio->DbValue;
?>
	<tr><td colspan=6 class="ewGroupSummary"><?php echo $Language->Phrase("RptSumHead") ?>&nbsp;<?php echo $report_planos_aplicacao_->plano_exercicio->FldCaption() ?>:&nbsp;<?php echo $report_planos_aplicacao_->plano_exercicio->ViewValue ?> (<?php echo ew_FormatNumber($report_planos_aplicacao__report->ReportCounts[1],0) ?> <?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php
	$report_planos_aplicacao_->plano_custo_mensal->CurrentValue = $report_planos_aplicacao__report->ReportTotals[1][1];
	$report_planos_aplicacao_->plano_custo_exercicio->CurrentValue = $report_planos_aplicacao__report->ReportTotals[1][2];
	$report_planos_aplicacao_->plano_recurso_municipal->CurrentValue = $report_planos_aplicacao__report->ReportTotals[1][3];
	$report_planos_aplicacao_->plano_outros_recursos->CurrentValue = $report_planos_aplicacao__report->ReportTotals[1][4];

	// Render row for view
	$report_planos_aplicacao_->RowType = EW_ROWTYPE_VIEW;
	$report_planos_aplicacao_->ResetAttrs();
	$report_planos_aplicacao__report->RenderRow();
?>
	<tr class="tr-campos">
		<td class="ewGroupAggregate"><?php echo $Language->Phrase("RptSum") ?></td>
		<td class="td-direita">
<span<?php echo $report_planos_aplicacao_->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_custo_mensal->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_planos_aplicacao_->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_custo_exercicio->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_planos_aplicacao_->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_recurso_municipal->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_planos_aplicacao_->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $report_planos_aplicacao_->plano_outros_recursos->ViewValue ?></span>
</td>
	</tr>
	<tr><td colspan=5>&nbsp;<br></td></tr>
<?php
}
}

// Close recordset
$report_planos_aplicacao__report->Recordset->Close();
?>
<?php if ($report_planos_aplicacao__report->RecordExists) { ?>
	<tr><td colspan=5>&nbsp;<br></td></tr>
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
$report_planos_aplicacao__report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($report_planos_aplicacao_->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$report_planos_aplicacao__report->Page_Terminate();
?>
