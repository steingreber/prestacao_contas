<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php

// Global variable for table object
$report_terceiros_ = NULL;
$recebe_ano =  intval($_GET['ano']);

//
// Table class for report_terceiros_
//
class creport_terceiros_ extends cTableBase {
	var $rh_id;
	var $rh_exercicio;
	var $rh_terceirizado;
	var $rh_nome;
	var $rh_funcao;
	var $rh_escolaridade;
	var $rh_sala_turma;
	var $rh_carga_horaria_semanal;
	var $rh_remuneracao;
	var $rh_pg_recurso_publico;
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
		$this->TableVar = 'report_terceiros_';
		$this->TableName = 'report_terceiros_';
		$this->TableType = 'REPORT';

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
		$this->UserIDAllowSecurity = 0; // User ID Allow

		// rh_id
		$this->rh_id = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_id', 'rh_id', '`rh_id`', '`rh_id`', 20, -1, FALSE, '`rh_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rh_id->Sortable = FALSE; // Allow sort
		$this->rh_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_id'] = &$this->rh_id;

		// rh_exercicio
		$this->rh_exercicio = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_exercicio', 'rh_exercicio', '`rh_exercicio`', '`rh_exercicio`', 3, -1, FALSE, '`rh_exercicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_exercicio->Sortable = FALSE; // Allow sort
		$this->rh_exercicio->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_exercicio->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->rh_exercicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_exercicio'] = &$this->rh_exercicio;

		// rh_terceirizado
		$this->rh_terceirizado = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_terceirizado', 'rh_terceirizado', '`rh_terceirizado`', '`rh_terceirizado`', 16, -1, FALSE, '`rh_terceirizado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->rh_terceirizado->Sortable = FALSE; // Allow sort
		$this->rh_terceirizado->OptionCount = 2;
		$this->rh_terceirizado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_terceirizado'] = &$this->rh_terceirizado;

		// rh_nome
		$this->rh_nome = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_nome', 'rh_nome', '`rh_nome`', '`rh_nome`', 3, -1, FALSE, '`rh_nome`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_nome->Sortable = TRUE; // Allow sort
		$this->rh_nome->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_nome->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['rh_nome'] = &$this->rh_nome;

		// rh_funcao
		$this->rh_funcao = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_funcao', 'rh_funcao', '`rh_funcao`', '`rh_funcao`', 3, -1, FALSE, '`rh_funcao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rh_funcao->Sortable = FALSE; // Allow sort
		$this->rh_funcao->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rh_funcao->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['rh_funcao'] = &$this->rh_funcao;

		// rh_escolaridade
		$this->rh_escolaridade = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_escolaridade', 'rh_escolaridade', '`rh_escolaridade`', '`rh_escolaridade`', 200, -1, FALSE, '`rh_escolaridade`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_escolaridade->Sortable = FALSE; // Allow sort
		$this->fields['rh_escolaridade'] = &$this->rh_escolaridade;

		// rh_sala_turma
		$this->rh_sala_turma = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_sala_turma', 'rh_sala_turma', '`rh_sala_turma`', '`rh_sala_turma`', 200, -1, FALSE, '`rh_sala_turma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_sala_turma->Sortable = FALSE; // Allow sort
		$this->fields['rh_sala_turma'] = &$this->rh_sala_turma;

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_carga_horaria_semanal', 'rh_carga_horaria_semanal', '`rh_carga_horaria_semanal`', '`rh_carga_horaria_semanal`', 200, -1, FALSE, '`rh_carga_horaria_semanal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_carga_horaria_semanal->Sortable = FALSE; // Allow sort
		$this->fields['rh_carga_horaria_semanal'] = &$this->rh_carga_horaria_semanal;

		// rh_remuneracao
		$this->rh_remuneracao = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_remuneracao', 'rh_remuneracao', '`rh_remuneracao`', '`rh_remuneracao`', 5, -1, FALSE, '`rh_remuneracao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_remuneracao->Sortable = FALSE; // Allow sort
		$this->rh_remuneracao->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['rh_remuneracao'] = &$this->rh_remuneracao;

		// rh_pg_recurso_publico
		$this->rh_pg_recurso_publico = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_pg_recurso_publico', 'rh_pg_recurso_publico', '`rh_pg_recurso_publico`', '`rh_pg_recurso_publico`', 16, -1, FALSE, '`rh_pg_recurso_publico`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->rh_pg_recurso_publico->Sortable = FALSE; // Allow sort
		$this->rh_pg_recurso_publico->OptionCount = 2;
		$this->rh_pg_recurso_publico->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_pg_recurso_publico'] = &$this->rh_pg_recurso_publico;

		// rh_hora_entra_i
		$this->rh_hora_entra_i = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_hora_entra_i', 'rh_hora_entra_i', '`rh_hora_entra_i`', '`rh_hora_entra_i`', 200, -1, FALSE, '`rh_hora_entra_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_entra_i->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_entra_i'] = &$this->rh_hora_entra_i;

		// rh_hora_saida_i
		$this->rh_hora_saida_i = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_hora_saida_i', 'rh_hora_saida_i', '`rh_hora_saida_i`', '`rh_hora_saida_i`', 200, -1, FALSE, '`rh_hora_saida_i`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_saida_i->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_saida_i'] = &$this->rh_hora_saida_i;

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_hora_entra_ii', 'rh_hora_entra_ii', '`rh_hora_entra_ii`', '`rh_hora_entra_ii`', 200, -1, FALSE, '`rh_hora_entra_ii`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_entra_ii->Sortable = FALSE; // Allow sort
		$this->fields['rh_hora_entra_ii'] = &$this->rh_hora_entra_ii;

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_hora_saida_ii', 'rh_hora_saida_ii', '`rh_hora_saida_ii`', '`rh_hora_saida_ii`', 3, -1, FALSE, '`rh_hora_saida_ii`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_hora_saida_ii->Sortable = FALSE; // Allow sort
		$this->rh_hora_saida_ii->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rh_hora_saida_ii'] = &$this->rh_hora_saida_ii;

		// rh_data_cadastro
		$this->rh_data_cadastro = new cField('report_terceiros_', 'report_terceiros_', 'x_rh_data_cadastro', 'rh_data_cadastro', '`rh_data_cadastro`', ew_CastDateFieldForLike('`rh_data_cadastro`', 7, "DB"), 135, 7, FALSE, '`rh_data_cadastro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rh_data_cadastro->Sortable = FALSE; // Allow sort
		$this->rh_data_cadastro->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateDMY"));
		$this->fields['rh_data_cadastro'] = &$this->rh_data_cadastro;
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
		return ($this->_SqlDetailSelect <> "") ? $this->_SqlDetailSelect : "SELECT * FROM `rc25_a_recursos_humanos` Where rh_exercicio = $recebe_ano and rh_terceirizado = 1";
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
		return ($this->_SqlDetailOrderBy <> "") ? $this->_SqlDetailOrderBy : "`rh_id` DESC";
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
			return "report_terceiros_report.php";
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
		return "report_terceiros_report.php";
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

$report_terceiros__report = NULL; // Initialize page object first

class creport_terceiros__report extends creport_terceiros_ {

	// Page ID
	var $PageID = 'report';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'report_terceiros_';

	// Page object name
	var $PageObjName = 'report_terceiros__report';

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

		// Table object (report_terceiros_)
		if (!isset($GLOBALS["report_terceiros_"]) || get_class($GLOBALS["report_terceiros_"]) == "creport_terceiros_") {
			$GLOBALS["report_terceiros_"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["report_terceiros_"];
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
			define("EW_TABLE_NAME", 'report_terceiros_', TRUE);

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
		$this->ReportTotals = &ew_Init2DArray(1, 6, 0);
		$this->ReportMaxs = &ew_Init2DArray(1, 6, 0);
		$this->ReportMins = &ew_Init2DArray(1, 6, 0);

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->rh_remuneracao->FormValue == $this->rh_remuneracao->CurrentValue && is_numeric(ew_StrToFloat($this->rh_remuneracao->CurrentValue)))
			$this->rh_remuneracao->CurrentValue = ew_StrToFloat($this->rh_remuneracao->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// rh_id
		// rh_exercicio
		// rh_terceirizado
		// rh_nome
		// rh_funcao
		// rh_escolaridade
		// rh_sala_turma
		// rh_carga_horaria_semanal
		// rh_remuneracao
		// rh_pg_recurso_publico
		// rh_hora_entra_i
		// rh_hora_saida_i
		// rh_hora_entra_ii
		// rh_hora_saida_ii
		// rh_data_cadastro

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rh_nome
		if (strval($this->rh_nome->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->rh_nome->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->rh_nome->LookupFilters = array();
		$lookuptblfilter = "`rhp_fis_jur`=0";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
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

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->ViewValue = $this->rh_carga_horaria_semanal->CurrentValue;
		$this->rh_carga_horaria_semanal->ViewCustomAttributes = "";

		// rh_remuneracao
		$this->rh_remuneracao->ViewValue = $this->rh_remuneracao->CurrentValue;
		$this->rh_remuneracao->ViewValue = ew_FormatCurrency($this->rh_remuneracao->ViewValue, 2, -2, -2, -2);
		$this->rh_remuneracao->ViewCustomAttributes = "";

		// rh_pg_recurso_publico
		if (strval($this->rh_pg_recurso_publico->CurrentValue) <> "") {
			$this->rh_pg_recurso_publico->ViewValue = $this->rh_pg_recurso_publico->OptionCaption($this->rh_pg_recurso_publico->CurrentValue);
		} else {
			$this->rh_pg_recurso_publico->ViewValue = NULL;
		}
		$this->rh_pg_recurso_publico->ViewCustomAttributes = "";

			// rh_nome
			$this->rh_nome->LinkCustomAttributes = "";
			$this->rh_nome->HrefValue = "";
			$this->rh_nome->TooltipValue = "";

			// rh_funcao
			$this->rh_funcao->LinkCustomAttributes = "";
			$this->rh_funcao->HrefValue = "";
			$this->rh_funcao->TooltipValue = "";

			// rh_carga_horaria_semanal
			$this->rh_carga_horaria_semanal->LinkCustomAttributes = "";
			$this->rh_carga_horaria_semanal->HrefValue = "";
			$this->rh_carga_horaria_semanal->TooltipValue = "";

			// rh_remuneracao
			$this->rh_remuneracao->LinkCustomAttributes = "";
			$this->rh_remuneracao->HrefValue = "";
			$this->rh_remuneracao->TooltipValue = "";

			// rh_pg_recurso_publico
			$this->rh_pg_recurso_publico->LinkCustomAttributes = "";
			$this->rh_pg_recurso_publico->HrefValue = "";
			$this->rh_pg_recurso_publico->TooltipValue = "";
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
if (!isset($report_terceiros__report)) $report_terceiros__report = new creport_terceiros__report();

// Page init
$report_terceiros__report->Page_Init();

// Page main
$report_terceiros__report->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$report_terceiros__report->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($report_terceiros_->Export == "") { ?>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>

<link rel="stylesheet" type="text/css" href="phpcss/meucss<?php echo $MyCor?>.css">

<?php } ?>
<?php
$report_terceiros__report->RecCnt = 1; // No grouping
if ($report_terceiros__report->DbDetailFilter <> "") {
	if ($report_terceiros__report->ReportFilter <> "") $report_terceiros__report->ReportFilter .= " AND ";
	$report_terceiros__report->ReportFilter .= "(" . $report_terceiros__report->DbDetailFilter . ")";
}
$ReportConn = &$report_terceiros__report->Connection();

// Set up detail SQL
$report_terceiros_->CurrentFilter = $report_terceiros__report->ReportFilter;
$report_terceiros__report->ReportSql = $report_terceiros_->DetailSQL();

// Load recordset
$report_terceiros__report->Recordset = $ReportConn->Execute($report_terceiros__report->ReportSql);
$report_terceiros__report->RecordExists = !$report_terceiros__report->Recordset->EOF;
?>
<?php if ($report_terceiros_->Export == "") { ?>
<?php if ($report_terceiros__report->RecordExists) { ?>
<div class="ewViewExportOptions"><?php $report_terceiros__report->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php } ?>
<?php $report_terceiros__report->ShowPageHeader(); ?>
<!--<table class="ewReportTable">-->
<?php

	// Get detail records
	$report_terceiros__report->ReportFilter = $report_terceiros__report->DefaultFilter;
	if ($report_terceiros__report->DbDetailFilter <> "") {
		if ($report_terceiros__report->ReportFilter <> "")
			$report_terceiros__report->ReportFilter .= " AND ";
		$report_terceiros__report->ReportFilter .= "(" . $report_terceiros__report->DbDetailFilter . ")";
	}

	// Set up detail SQL
	$report_terceiros_->CurrentFilter = $report_terceiros__report->ReportFilter;
	$report_terceiros__report->ReportSql = $report_terceiros_->DetailSQL();

	// Load detail records
	$report_terceiros__report->DetailRecordset = $ReportConn->Execute($report_terceiros__report->ReportSql);
	$report_terceiros__report->DtlRecordCount = $report_terceiros__report->DetailRecordset->RecordCount();

	// Initialize aggregates
	if (!$report_terceiros__report->DetailRecordset->EOF) {
		$report_terceiros__report->RecCnt++;
	}
	if ($report_terceiros__report->RecCnt == 1) {
		$report_terceiros__report->ReportCounts[0] = 0;
	}
	$report_terceiros__report->ReportCounts[0] += $report_terceiros__report->DtlRecordCount;
	if ($report_terceiros__report->RecordExists) {
?>
<?php include_once "report_navbar.php" ?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center" style="background-color: #fff; box-shadow: 3px 3px 6px; border-radius:10px;">
			<br>
			<div class="quadros">
				<h1>Serviços de Terceiros Exercício <?php echo $recebe_ano ?></h1>
			</div>

			<table border="0" style="border-collapse: collapse; width: 100%;">

	<tr class="tr-campos">
		<td class="td-direita"><?php echo $report_terceiros_->rh_nome->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_terceiros_->rh_funcao->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_terceiros_->rh_carga_horaria_semanal->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_terceiros_->rh_remuneracao->FldCaption() ?></td>
		<td class="td-direita"><?php echo $report_terceiros_->rh_pg_recurso_publico->FldCaption() ?></td>
	</tr>
<?php
	}
	while (!$report_terceiros__report->DetailRecordset->EOF) {
		$report_terceiros__report->RowCnt++;
		$report_terceiros_->rh_nome->setDbValue($report_terceiros__report->DetailRecordset->fields('rh_nome'));
		$report_terceiros_->rh_funcao->setDbValue($report_terceiros__report->DetailRecordset->fields('rh_funcao'));
		$report_terceiros_->rh_carga_horaria_semanal->setDbValue($report_terceiros__report->DetailRecordset->fields('rh_carga_horaria_semanal'));
		$report_terceiros_->rh_remuneracao->setDbValue($report_terceiros__report->DetailRecordset->fields('rh_remuneracao'));
		$report_terceiros_->rh_pg_recurso_publico->setDbValue($report_terceiros__report->DetailRecordset->fields('rh_pg_recurso_publico'));

		// Render for view
		$report_terceiros_->RowType = EW_ROWTYPE_VIEW;
		$report_terceiros_->ResetAttrs();
		$report_terceiros__report->RenderRow();
?>
	<tr>
		<td class="td-direita">
<span<?php echo $report_terceiros_->rh_nome->ViewAttributes() ?>>
<?php echo $report_terceiros_->rh_nome->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_terceiros_->rh_funcao->ViewAttributes() ?>>
<?php echo $report_terceiros_->rh_funcao->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_terceiros_->rh_carga_horaria_semanal->ViewAttributes() ?>>
<?php echo $report_terceiros_->rh_carga_horaria_semanal->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_terceiros_->rh_remuneracao->ViewAttributes() ?>>
<?php echo $report_terceiros_->rh_remuneracao->ViewValue ?></span>
</td>
		<td class="td-direita">
<span<?php echo $report_terceiros_->rh_pg_recurso_publico->ViewAttributes() ?>>
<?php echo $report_terceiros_->rh_pg_recurso_publico->ViewValue ?></span>
</td>
	</tr>
<?php
		$report_terceiros__report->DetailRecordset->MoveNext();
	}
	$report_terceiros__report->DetailRecordset->Close();
?>
<?php if ($report_terceiros__report->RecordExists) { ?>
	<tr><td colspan=5>&nbsp;<br></td></tr>
	<tr class="tr-campos"><td colspan=5 class="ewGrandSummary"><?php echo $Language->Phrase("RptGrandTotal") ?>&nbsp;(<?php echo ew_FormatNumber($report_terceiros__report->ReportCounts[0], 0) ?>&nbsp;<?php echo $Language->Phrase("RptDtlRec") ?>)</td></tr>
<?php } ?>
<?php if ($report_terceiros__report->RecordExists) { ?>
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
$report_terceiros__report->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($report_terceiros_->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$report_terceiros__report->Page_Terminate();
?>
