<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_planos_aplicacaoinfo.php" ?>
<?php include_once "rc25_a_termosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_planos_aplicacao_add = NULL; // Initialize page object first

class crc25_a_planos_aplicacao_add extends crc25_a_planos_aplicacao {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_planos_aplicacao';

	// Page object name
	var $PageObjName = 'rc25_a_planos_aplicacao_add';

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
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

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
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
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

		// Table object (rc25_a_planos_aplicacao)
		if (!isset($GLOBALS["rc25_a_planos_aplicacao"]) || get_class($GLOBALS["rc25_a_planos_aplicacao"]) == "crc25_a_planos_aplicacao") {
			$GLOBALS["rc25_a_planos_aplicacao"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_planos_aplicacao"];
		}

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_planos_aplicacao', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->plano_exercicio->SetVisibility();
		$this->plano_despesa->SetVisibility();
		$this->plano_custo_mensal->SetVisibility();
		$this->plano_custo_exercicio->SetVisibility();
		$this->plano_recurso_municipal->SetVisibility();
		$this->plano_outros_recursos->SetVisibility();
		$this->plano_data_cadastro->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $rc25_a_planos_aplicacao;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_planos_aplicacao);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "rc25_a_planos_aplicacaoview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["plano_id"] != "") {
				$this->plano_id->setQueryStringValue($_GET["plano_id"]);
				$this->setKey("plano_id", $this->plano_id->CurrentValue); // Set up key
			} else {
				$this->setKey("plano_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("rc25_a_planos_aplicacaolist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rc25_a_planos_aplicacaolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rc25_a_planos_aplicacaoview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->plano_id->CurrentValue = NULL;
		$this->plano_id->OldValue = $this->plano_id->CurrentValue;
		$this->plano_exercicio->CurrentValue = NULL;
		$this->plano_exercicio->OldValue = $this->plano_exercicio->CurrentValue;
		$this->plano_despesa->CurrentValue = NULL;
		$this->plano_despesa->OldValue = $this->plano_despesa->CurrentValue;
		$this->plano_custo_mensal->CurrentValue = NULL;
		$this->plano_custo_mensal->OldValue = $this->plano_custo_mensal->CurrentValue;
		$this->plano_custo_exercicio->CurrentValue = NULL;
		$this->plano_custo_exercicio->OldValue = $this->plano_custo_exercicio->CurrentValue;
		$this->plano_recurso_municipal->CurrentValue = NULL;
		$this->plano_recurso_municipal->OldValue = $this->plano_recurso_municipal->CurrentValue;
		$this->plano_outros_recursos->CurrentValue = 0;
		$this->plano_data_cadastro->CurrentValue = NULL;
		$this->plano_data_cadastro->OldValue = $this->plano_data_cadastro->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->plano_exercicio->FldIsDetailKey) {
			$this->plano_exercicio->setFormValue($objForm->GetValue("x_plano_exercicio"));
		}
		if (!$this->plano_despesa->FldIsDetailKey) {
			$this->plano_despesa->setFormValue($objForm->GetValue("x_plano_despesa"));
		}
		if (!$this->plano_custo_mensal->FldIsDetailKey) {
			$this->plano_custo_mensal->setFormValue($objForm->GetValue("x_plano_custo_mensal"));
		}
		if (!$this->plano_custo_exercicio->FldIsDetailKey) {
			$this->plano_custo_exercicio->setFormValue($objForm->GetValue("x_plano_custo_exercicio"));
		}
		if (!$this->plano_recurso_municipal->FldIsDetailKey) {
			$this->plano_recurso_municipal->setFormValue($objForm->GetValue("x_plano_recurso_municipal"));
		}
		if (!$this->plano_outros_recursos->FldIsDetailKey) {
			$this->plano_outros_recursos->setFormValue($objForm->GetValue("x_plano_outros_recursos"));
		}
		if (!$this->plano_data_cadastro->FldIsDetailKey) {
			$this->plano_data_cadastro->setFormValue($objForm->GetValue("x_plano_data_cadastro"));
			$this->plano_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->plano_data_cadastro->CurrentValue, 1);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->plano_exercicio->CurrentValue = $this->plano_exercicio->FormValue;
		$this->plano_despesa->CurrentValue = $this->plano_despesa->FormValue;
		$this->plano_custo_mensal->CurrentValue = $this->plano_custo_mensal->FormValue;
		$this->plano_custo_exercicio->CurrentValue = $this->plano_custo_exercicio->FormValue;
		$this->plano_recurso_municipal->CurrentValue = $this->plano_recurso_municipal->FormValue;
		$this->plano_outros_recursos->CurrentValue = $this->plano_outros_recursos->FormValue;
		$this->plano_data_cadastro->CurrentValue = $this->plano_data_cadastro->FormValue;
		$this->plano_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->plano_data_cadastro->CurrentValue, 1);
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->plano_id->setDbValue($row['plano_id']);
		$this->plano_exercicio->setDbValue($row['plano_exercicio']);
		$this->plano_despesa->setDbValue($row['plano_despesa']);
		$this->plano_custo_mensal->setDbValue($row['plano_custo_mensal']);
		$this->plano_custo_exercicio->setDbValue($row['plano_custo_exercicio']);
		$this->plano_recurso_municipal->setDbValue($row['plano_recurso_municipal']);
		$this->plano_outros_recursos->setDbValue($row['plano_outros_recursos']);
		$this->plano_data_cadastro->setDbValue($row['plano_data_cadastro']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['plano_id'] = $this->plano_id->CurrentValue;
		$row['plano_exercicio'] = $this->plano_exercicio->CurrentValue;
		$row['plano_despesa'] = $this->plano_despesa->CurrentValue;
		$row['plano_custo_mensal'] = $this->plano_custo_mensal->CurrentValue;
		$row['plano_custo_exercicio'] = $this->plano_custo_exercicio->CurrentValue;
		$row['plano_recurso_municipal'] = $this->plano_recurso_municipal->CurrentValue;
		$row['plano_outros_recursos'] = $this->plano_outros_recursos->CurrentValue;
		$row['plano_data_cadastro'] = $this->plano_data_cadastro->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->plano_id->DbValue = $row['plano_id'];
		$this->plano_exercicio->DbValue = $row['plano_exercicio'];
		$this->plano_despesa->DbValue = $row['plano_despesa'];
		$this->plano_custo_mensal->DbValue = $row['plano_custo_mensal'];
		$this->plano_custo_exercicio->DbValue = $row['plano_custo_exercicio'];
		$this->plano_recurso_municipal->DbValue = $row['plano_recurso_municipal'];
		$this->plano_outros_recursos->DbValue = $row['plano_outros_recursos'];
		$this->plano_data_cadastro->DbValue = $row['plano_data_cadastro'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("plano_id")) <> "")
			$this->plano_id->CurrentValue = $this->getKey("plano_id"); // plano_id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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
			if (trim(strval($this->plano_exercicio->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->plano_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$this->plano_exercicio->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->plano_exercicio->EditValue = $arwrk;
			}

			// plano_despesa
			$this->plano_despesa->EditAttrs["class"] = "form-control";
			$this->plano_despesa->EditCustomAttributes = "";
			if (trim(strval($this->plano_despesa->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`despesa_id`" . ew_SearchString("=", $this->plano_despesa->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `despesa_id`, `despesa_nome` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_planos_despesas`";
			$sWhereWrk = "";
			$this->plano_despesa->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->plano_despesa, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->plano_despesa->EditValue = $arwrk;

			// plano_custo_mensal
			$this->plano_custo_mensal->EditAttrs["class"] = "form-control";
			$this->plano_custo_mensal->EditCustomAttributes = "";
			$this->plano_custo_mensal->EditValue = ew_HtmlEncode($this->plano_custo_mensal->CurrentValue);
			$this->plano_custo_mensal->PlaceHolder = ew_RemoveHtml($this->plano_custo_mensal->FldCaption());
			if (strval($this->plano_custo_mensal->EditValue) <> "" && is_numeric($this->plano_custo_mensal->EditValue)) $this->plano_custo_mensal->EditValue = ew_FormatNumber($this->plano_custo_mensal->EditValue, -2, -2, -2, -2);

			// plano_custo_exercicio
			$this->plano_custo_exercicio->EditAttrs["class"] = "form-control";
			$this->plano_custo_exercicio->EditCustomAttributes = "";
			$this->plano_custo_exercicio->EditValue = ew_HtmlEncode($this->plano_custo_exercicio->CurrentValue);
			$this->plano_custo_exercicio->PlaceHolder = ew_RemoveHtml($this->plano_custo_exercicio->FldCaption());
			if (strval($this->plano_custo_exercicio->EditValue) <> "" && is_numeric($this->plano_custo_exercicio->EditValue)) $this->plano_custo_exercicio->EditValue = ew_FormatNumber($this->plano_custo_exercicio->EditValue, -2, -2, -2, -2);

			// plano_recurso_municipal
			$this->plano_recurso_municipal->EditAttrs["class"] = "form-control";
			$this->plano_recurso_municipal->EditCustomAttributes = "";
			$this->plano_recurso_municipal->EditValue = ew_HtmlEncode($this->plano_recurso_municipal->CurrentValue);
			$this->plano_recurso_municipal->PlaceHolder = ew_RemoveHtml($this->plano_recurso_municipal->FldCaption());
			if (strval($this->plano_recurso_municipal->EditValue) <> "" && is_numeric($this->plano_recurso_municipal->EditValue)) $this->plano_recurso_municipal->EditValue = ew_FormatNumber($this->plano_recurso_municipal->EditValue, -2, -2, -2, -2);

			// plano_outros_recursos
			$this->plano_outros_recursos->EditAttrs["class"] = "form-control";
			$this->plano_outros_recursos->EditCustomAttributes = "";
			$this->plano_outros_recursos->EditValue = ew_HtmlEncode($this->plano_outros_recursos->CurrentValue);
			$this->plano_outros_recursos->PlaceHolder = ew_RemoveHtml($this->plano_outros_recursos->FldCaption());
			if (strval($this->plano_outros_recursos->EditValue) <> "" && is_numeric($this->plano_outros_recursos->EditValue)) $this->plano_outros_recursos->EditValue = ew_FormatNumber($this->plano_outros_recursos->EditValue, -2, -1, -2, -2);

			// plano_data_cadastro
			// Add refer script
			// plano_exercicio

			$this->plano_exercicio->LinkCustomAttributes = "";
			$this->plano_exercicio->HrefValue = "";

			// plano_despesa
			$this->plano_despesa->LinkCustomAttributes = "";
			$this->plano_despesa->HrefValue = "";

			// plano_custo_mensal
			$this->plano_custo_mensal->LinkCustomAttributes = "";
			$this->plano_custo_mensal->HrefValue = "";

			// plano_custo_exercicio
			$this->plano_custo_exercicio->LinkCustomAttributes = "";
			$this->plano_custo_exercicio->HrefValue = "";

			// plano_recurso_municipal
			$this->plano_recurso_municipal->LinkCustomAttributes = "";
			$this->plano_recurso_municipal->HrefValue = "";

			// plano_outros_recursos
			$this->plano_outros_recursos->LinkCustomAttributes = "";
			$this->plano_outros_recursos->HrefValue = "";

			// plano_data_cadastro
			$this->plano_data_cadastro->LinkCustomAttributes = "";
			$this->plano_data_cadastro->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->plano_exercicio->FldIsDetailKey && !is_null($this->plano_exercicio->FormValue) && $this->plano_exercicio->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->plano_exercicio->FldCaption(), $this->plano_exercicio->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->plano_custo_mensal->FormValue)) {
			ew_AddMessage($gsFormError, $this->plano_custo_mensal->FldErrMsg());
		}
		if (!ew_CheckNumber($this->plano_custo_exercicio->FormValue)) {
			ew_AddMessage($gsFormError, $this->plano_custo_exercicio->FldErrMsg());
		}
		if (!ew_CheckNumber($this->plano_recurso_municipal->FormValue)) {
			ew_AddMessage($gsFormError, $this->plano_recurso_municipal->FldErrMsg());
		}
		if (!ew_CheckNumber($this->plano_outros_recursos->FormValue)) {
			ew_AddMessage($gsFormError, $this->plano_outros_recursos->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Check referential integrity for master table 'rc25_a_termos'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_rc25_a_termos();
		if (strval($this->plano_exercicio->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@processo_exercicio@", ew_AdjustSql($this->plano_exercicio->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["rc25_a_termos"])) $GLOBALS["rc25_a_termos"] = new crc25_a_termos();
			$rsmaster = $GLOBALS["rc25_a_termos"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "rc25_a_termos", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// plano_exercicio
		$this->plano_exercicio->SetDbValueDef($rsnew, $this->plano_exercicio->CurrentValue, 0, FALSE);

		// plano_despesa
		$this->plano_despesa->SetDbValueDef($rsnew, $this->plano_despesa->CurrentValue, NULL, FALSE);

		// plano_custo_mensal
		$this->plano_custo_mensal->SetDbValueDef($rsnew, $this->plano_custo_mensal->CurrentValue, NULL, FALSE);

		// plano_custo_exercicio
		$this->plano_custo_exercicio->SetDbValueDef($rsnew, $this->plano_custo_exercicio->CurrentValue, NULL, FALSE);

		// plano_recurso_municipal
		$this->plano_recurso_municipal->SetDbValueDef($rsnew, $this->plano_recurso_municipal->CurrentValue, NULL, FALSE);

		// plano_outros_recursos
		$this->plano_outros_recursos->SetDbValueDef($rsnew, $this->plano_outros_recursos->CurrentValue, NULL, FALSE);

		// plano_data_cadastro
		$this->plano_data_cadastro->SetDbValueDef($rsnew, ew_CurrentDateTime(), ew_CurrentDate());
		$rsnew['plano_data_cadastro'] = &$this->plano_data_cadastro->DbValue;

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "rc25_a_termos") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_processo_exercicio"] <> "") {
					$GLOBALS["rc25_a_termos"]->processo_exercicio->setQueryStringValue($_GET["fk_processo_exercicio"]);
					$this->plano_exercicio->setQueryStringValue($GLOBALS["rc25_a_termos"]->processo_exercicio->QueryStringValue);
					$this->plano_exercicio->setSessionValue($this->plano_exercicio->QueryStringValue);
					if (!is_numeric($GLOBALS["rc25_a_termos"]->processo_exercicio->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "rc25_a_termos") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_processo_exercicio"] <> "") {
					$GLOBALS["rc25_a_termos"]->processo_exercicio->setFormValue($_POST["fk_processo_exercicio"]);
					$this->plano_exercicio->setFormValue($GLOBALS["rc25_a_termos"]->processo_exercicio->FormValue);
					$this->plano_exercicio->setSessionValue($this->plano_exercicio->FormValue);
					if (!is_numeric($GLOBALS["rc25_a_termos"]->processo_exercicio->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "rc25_a_termos") {
				if ($this->plano_exercicio->CurrentValue == "") $this->plano_exercicio->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_planos_aplicacaolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_plano_exercicio":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ano_ano` AS `LinkFld`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ano_ano` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_plano_despesa":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `despesa_id` AS `LinkFld`, `despesa_nome` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_planos_despesas`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`despesa_id` IN ({filter_value})', "t0" => "20", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->plano_despesa, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_planos_aplicacao_add)) $rc25_a_planos_aplicacao_add = new crc25_a_planos_aplicacao_add();

// Page init
$rc25_a_planos_aplicacao_add->Page_Init();

// Page main
$rc25_a_planos_aplicacao_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_planos_aplicacao_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frc25_a_planos_aplicacaoadd = new ew_Form("frc25_a_planos_aplicacaoadd", "add");

// Validate form
frc25_a_planos_aplicacaoadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_plano_exercicio");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_planos_aplicacao->plano_exercicio->FldCaption(), $rc25_a_planos_aplicacao->plano_exercicio->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_plano_custo_mensal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_custo_mensal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_custo_exercicio");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_custo_exercicio->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_recurso_municipal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_recurso_municipal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_outros_recursos");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_outros_recursos->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
frc25_a_planos_aplicacaoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_aplicacaoadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_planos_aplicacaoadd.Lists["x_plano_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_planos_aplicacaoadd.Lists["x_plano_exercicio"].Data = "<?php echo $rc25_a_planos_aplicacao_add->plano_exercicio->LookupFilterQuery(FALSE, "add") ?>";
frc25_a_planos_aplicacaoadd.Lists["x_plano_despesa"] = {"LinkField":"x_despesa_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_despesa_nome","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_planos_despesas"};
frc25_a_planos_aplicacaoadd.Lists["x_plano_despesa"].Data = "<?php echo $rc25_a_planos_aplicacao_add->plano_despesa->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_planos_aplicacao_add->ShowPageHeader(); ?>
<?php
$rc25_a_planos_aplicacao_add->ShowMessage();
?>
<form name="frc25_a_planos_aplicacaoadd" id="frc25_a_planos_aplicacaoadd" class="<?php echo $rc25_a_planos_aplicacao_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_planos_aplicacao_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_planos_aplicacao_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_planos_aplicacao">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_planos_aplicacao_add->IsModal) ?>">
<?php if ($rc25_a_planos_aplicacao->getCurrentMasterTable() == "rc25_a_termos") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="rc25_a_termos">
<input type="hidden" name="fk_processo_exercicio" value="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
	<div id="r_plano_exercicio" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_exercicio" for="x_plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() <> "") { ?>
<span id="el_rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_plano_exercicio" name="x_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->CurrentValue) ?>">
<?php } else { ?>
<span id="el_rc25_a_planos_aplicacao_plano_exercicio">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_plano_exercicio" name="x_plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->SelectOptionListHtml("x_plano_exercicio") ?>
</select>
</span>
<?php } ?>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
	<div id="r_plano_despesa" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_despesa" for="x_plano_despesa" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_despesa->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_despesa">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_despesa->DisplayValueSeparatorAttribute() ?>" id="x_plano_despesa" name="x_plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->SelectOptionListHtml("x_plano_despesa") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_plano_despesa',url:'rc25_a_planos_despesasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_plano_despesa"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span></button>
</span>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
	<div id="r_plano_custo_mensal" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_custo_mensal" for="x_plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_mensal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x_plano_custo_mensal" id="x_plano_custo_mensal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditAttributes() ?>>
</span>
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
	<div id="r_plano_custo_exercicio" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio" for="x_plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_exercicio">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x_plano_custo_exercicio" id="x_plano_custo_exercicio" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditAttributes() ?>>
</span>
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
	<div id="r_plano_recurso_municipal" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal" for="x_plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_recurso_municipal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x_plano_recurso_municipal" id="x_plano_recurso_municipal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditAttributes() ?>>
</span>
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
	<div id="r_plano_outros_recursos" class="form-group">
		<label id="elh_rc25_a_planos_aplicacao_plano_outros_recursos" for="x_plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao_add->LeftColumnClass ?>"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_planos_aplicacao_add->RightColumnClass ?>"><div<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_outros_recursos">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x_plano_outros_recursos" id="x_plano_outros_recursos" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditAttributes() ?>>
</span>
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rc25_a_planos_aplicacao_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_planos_aplicacao_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_planos_aplicacao_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_planos_aplicacaoadd.Init();
</script>
<?php
$rc25_a_planos_aplicacao_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_planos_aplicacao_add->Page_Terminate();
?>
