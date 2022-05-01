<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_repassesinfo.php" ?>
<?php include_once "rc25_a_termosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_repasses_add = NULL; // Initialize page object first

class crc25_a_repasses_add extends crc25_a_repasses {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_repasses';

	// Page object name
	var $PageObjName = 'rc25_a_repasses_add';

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

		// Table object (rc25_a_repasses)
		if (!isset($GLOBALS["rc25_a_repasses"]) || get_class($GLOBALS["rc25_a_repasses"]) == "crc25_a_repasses") {
			$GLOBALS["rc25_a_repasses"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_repasses"];
		}

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_repasses', TRUE);

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
		$this->repasse_id_termos->SetVisibility();
		$this->repasse_faixa_etaria->SetVisibility();
		$this->repasse_meta->SetVisibility();
		$this->repasse_valor_unitario->SetVisibility();
		$this->repasse_valor_mes->SetVisibility();
		$this->repasse_valor_previsto->SetVisibility();

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
		global $EW_EXPORT, $rc25_a_repasses;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_repasses);
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
					if ($pageName == "rc25_a_repassesview.php")
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
			if (@$_GET["repasse_id"] != "") {
				$this->repasse_id->setQueryStringValue($_GET["repasse_id"]);
				$this->setKey("repasse_id", $this->repasse_id->CurrentValue); // Set up key
			} else {
				$this->setKey("repasse_id", ""); // Clear key
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
					$this->Page_Terminate("rc25_a_repasseslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rc25_a_repasseslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rc25_a_repassesview.php")
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
		$this->repasse_id->CurrentValue = NULL;
		$this->repasse_id->OldValue = $this->repasse_id->CurrentValue;
		$this->repasse_id_termos->CurrentValue = NULL;
		$this->repasse_id_termos->OldValue = $this->repasse_id_termos->CurrentValue;
		$this->repasse_faixa_etaria->CurrentValue = NULL;
		$this->repasse_faixa_etaria->OldValue = $this->repasse_faixa_etaria->CurrentValue;
		$this->repasse_meta->CurrentValue = NULL;
		$this->repasse_meta->OldValue = $this->repasse_meta->CurrentValue;
		$this->repasse_valor_unitario->CurrentValue = NULL;
		$this->repasse_valor_unitario->OldValue = $this->repasse_valor_unitario->CurrentValue;
		$this->repasse_valor_mes->CurrentValue = NULL;
		$this->repasse_valor_mes->OldValue = $this->repasse_valor_mes->CurrentValue;
		$this->repasse_valor_previsto->CurrentValue = NULL;
		$this->repasse_valor_previsto->OldValue = $this->repasse_valor_previsto->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->repasse_id_termos->FldIsDetailKey) {
			$this->repasse_id_termos->setFormValue($objForm->GetValue("x_repasse_id_termos"));
		}
		if (!$this->repasse_faixa_etaria->FldIsDetailKey) {
			$this->repasse_faixa_etaria->setFormValue($objForm->GetValue("x_repasse_faixa_etaria"));
		}
		if (!$this->repasse_meta->FldIsDetailKey) {
			$this->repasse_meta->setFormValue($objForm->GetValue("x_repasse_meta"));
		}
		if (!$this->repasse_valor_unitario->FldIsDetailKey) {
			$this->repasse_valor_unitario->setFormValue($objForm->GetValue("x_repasse_valor_unitario"));
		}
		if (!$this->repasse_valor_mes->FldIsDetailKey) {
			$this->repasse_valor_mes->setFormValue($objForm->GetValue("x_repasse_valor_mes"));
		}
		if (!$this->repasse_valor_previsto->FldIsDetailKey) {
			$this->repasse_valor_previsto->setFormValue($objForm->GetValue("x_repasse_valor_previsto"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->FormValue;
		$this->repasse_faixa_etaria->CurrentValue = $this->repasse_faixa_etaria->FormValue;
		$this->repasse_meta->CurrentValue = $this->repasse_meta->FormValue;
		$this->repasse_valor_unitario->CurrentValue = $this->repasse_valor_unitario->FormValue;
		$this->repasse_valor_mes->CurrentValue = $this->repasse_valor_mes->FormValue;
		$this->repasse_valor_previsto->CurrentValue = $this->repasse_valor_previsto->FormValue;
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
		$this->repasse_id->setDbValue($row['repasse_id']);
		$this->repasse_id_termos->setDbValue($row['repasse_id_termos']);
		$this->repasse_faixa_etaria->setDbValue($row['repasse_faixa_etaria']);
		$this->repasse_meta->setDbValue($row['repasse_meta']);
		$this->repasse_valor_unitario->setDbValue($row['repasse_valor_unitario']);
		$this->repasse_valor_mes->setDbValue($row['repasse_valor_mes']);
		$this->repasse_valor_previsto->setDbValue($row['repasse_valor_previsto']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['repasse_id'] = $this->repasse_id->CurrentValue;
		$row['repasse_id_termos'] = $this->repasse_id_termos->CurrentValue;
		$row['repasse_faixa_etaria'] = $this->repasse_faixa_etaria->CurrentValue;
		$row['repasse_meta'] = $this->repasse_meta->CurrentValue;
		$row['repasse_valor_unitario'] = $this->repasse_valor_unitario->CurrentValue;
		$row['repasse_valor_mes'] = $this->repasse_valor_mes->CurrentValue;
		$row['repasse_valor_previsto'] = $this->repasse_valor_previsto->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->repasse_id->DbValue = $row['repasse_id'];
		$this->repasse_id_termos->DbValue = $row['repasse_id_termos'];
		$this->repasse_faixa_etaria->DbValue = $row['repasse_faixa_etaria'];
		$this->repasse_meta->DbValue = $row['repasse_meta'];
		$this->repasse_valor_unitario->DbValue = $row['repasse_valor_unitario'];
		$this->repasse_valor_mes->DbValue = $row['repasse_valor_mes'];
		$this->repasse_valor_previsto->DbValue = $row['repasse_valor_previsto'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("repasse_id")) <> "")
			$this->repasse_id->CurrentValue = $this->getKey("repasse_id"); // repasse_id
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

		if ($this->repasse_valor_unitario->FormValue == $this->repasse_valor_unitario->CurrentValue && is_numeric(ew_StrToFloat($this->repasse_valor_unitario->CurrentValue)))
			$this->repasse_valor_unitario->CurrentValue = ew_StrToFloat($this->repasse_valor_unitario->CurrentValue);

		// Convert decimal values if posted back
		if ($this->repasse_valor_mes->FormValue == $this->repasse_valor_mes->CurrentValue && is_numeric(ew_StrToFloat($this->repasse_valor_mes->CurrentValue)))
			$this->repasse_valor_mes->CurrentValue = ew_StrToFloat($this->repasse_valor_mes->CurrentValue);

		// Convert decimal values if posted back
		if ($this->repasse_valor_previsto->FormValue == $this->repasse_valor_previsto->CurrentValue && is_numeric(ew_StrToFloat($this->repasse_valor_previsto->CurrentValue)))
			$this->repasse_valor_previsto->CurrentValue = ew_StrToFloat($this->repasse_valor_previsto->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// repasse_id
		// repasse_id_termos
		// repasse_faixa_etaria
		// repasse_meta
		// repasse_valor_unitario
		// repasse_valor_mes
		// repasse_valor_previsto

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

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
			if (trim(strval($this->repasse_id_termos->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`processo_id`" . ew_SearchString("=", $this->repasse_id_termos->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `processo_id`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_termos`";
			$sWhereWrk = "";
			$this->repasse_id_termos->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->repasse_id_termos->EditValue = $arwrk;
			}

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->EditAttrs["class"] = "form-control";
			$this->repasse_faixa_etaria->EditCustomAttributes = "";
			$this->repasse_faixa_etaria->EditValue = ew_HtmlEncode($this->repasse_faixa_etaria->CurrentValue);
			$this->repasse_faixa_etaria->PlaceHolder = ew_RemoveHtml($this->repasse_faixa_etaria->FldCaption());

			// repasse_meta
			$this->repasse_meta->EditAttrs["class"] = "form-control";
			$this->repasse_meta->EditCustomAttributes = "";
			$this->repasse_meta->EditValue = ew_HtmlEncode($this->repasse_meta->CurrentValue);
			$this->repasse_meta->PlaceHolder = ew_RemoveHtml($this->repasse_meta->FldCaption());

			// repasse_valor_unitario
			$this->repasse_valor_unitario->EditAttrs["class"] = "form-control";
			$this->repasse_valor_unitario->EditCustomAttributes = "";
			$this->repasse_valor_unitario->EditValue = ew_HtmlEncode($this->repasse_valor_unitario->CurrentValue);
			$this->repasse_valor_unitario->PlaceHolder = ew_RemoveHtml($this->repasse_valor_unitario->FldCaption());
			if (strval($this->repasse_valor_unitario->EditValue) <> "" && is_numeric($this->repasse_valor_unitario->EditValue)) $this->repasse_valor_unitario->EditValue = ew_FormatNumber($this->repasse_valor_unitario->EditValue, -2, -2, -2, -2);

			// repasse_valor_mes
			$this->repasse_valor_mes->EditAttrs["class"] = "form-control";
			$this->repasse_valor_mes->EditCustomAttributes = "";
			$this->repasse_valor_mes->EditValue = ew_HtmlEncode($this->repasse_valor_mes->CurrentValue);
			$this->repasse_valor_mes->PlaceHolder = ew_RemoveHtml($this->repasse_valor_mes->FldCaption());
			if (strval($this->repasse_valor_mes->EditValue) <> "" && is_numeric($this->repasse_valor_mes->EditValue)) $this->repasse_valor_mes->EditValue = ew_FormatNumber($this->repasse_valor_mes->EditValue, -2, -2, -2, -2);

			// repasse_valor_previsto
			$this->repasse_valor_previsto->EditAttrs["class"] = "form-control";
			$this->repasse_valor_previsto->EditCustomAttributes = "";
			$this->repasse_valor_previsto->EditValue = ew_HtmlEncode($this->repasse_valor_previsto->CurrentValue);
			$this->repasse_valor_previsto->PlaceHolder = ew_RemoveHtml($this->repasse_valor_previsto->FldCaption());
			if (strval($this->repasse_valor_previsto->EditValue) <> "" && is_numeric($this->repasse_valor_previsto->EditValue)) $this->repasse_valor_previsto->EditValue = ew_FormatNumber($this->repasse_valor_previsto->EditValue, -2, -2, -2, -2);

			// Add refer script
			// repasse_id_termos

			$this->repasse_id_termos->LinkCustomAttributes = "";
			$this->repasse_id_termos->HrefValue = "";

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->LinkCustomAttributes = "";
			$this->repasse_faixa_etaria->HrefValue = "";

			// repasse_meta
			$this->repasse_meta->LinkCustomAttributes = "";
			$this->repasse_meta->HrefValue = "";

			// repasse_valor_unitario
			$this->repasse_valor_unitario->LinkCustomAttributes = "";
			$this->repasse_valor_unitario->HrefValue = "";

			// repasse_valor_mes
			$this->repasse_valor_mes->LinkCustomAttributes = "";
			$this->repasse_valor_mes->HrefValue = "";

			// repasse_valor_previsto
			$this->repasse_valor_previsto->LinkCustomAttributes = "";
			$this->repasse_valor_previsto->HrefValue = "";
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
		if (!$this->repasse_faixa_etaria->FldIsDetailKey && !is_null($this->repasse_faixa_etaria->FormValue) && $this->repasse_faixa_etaria->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->repasse_faixa_etaria->FldCaption(), $this->repasse_faixa_etaria->ReqErrMsg));
		}
		if (!$this->repasse_meta->FldIsDetailKey && !is_null($this->repasse_meta->FormValue) && $this->repasse_meta->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->repasse_meta->FldCaption(), $this->repasse_meta->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->repasse_meta->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_meta->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_unitario->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_unitario->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_mes->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_mes->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_previsto->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_previsto->FldErrMsg());
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
		if (strval($this->repasse_id_termos->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@processo_id@", ew_AdjustSql($this->repasse_id_termos->CurrentValue, "DB"), $sMasterFilter);
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

		// repasse_id_termos
		$this->repasse_id_termos->SetDbValueDef($rsnew, $this->repasse_id_termos->CurrentValue, NULL, FALSE);

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria->SetDbValueDef($rsnew, $this->repasse_faixa_etaria->CurrentValue, NULL, FALSE);

		// repasse_meta
		$this->repasse_meta->SetDbValueDef($rsnew, $this->repasse_meta->CurrentValue, NULL, FALSE);

		// repasse_valor_unitario
		$this->repasse_valor_unitario->SetDbValueDef($rsnew, $this->repasse_valor_unitario->CurrentValue, NULL, FALSE);

		// repasse_valor_mes
		$this->repasse_valor_mes->SetDbValueDef($rsnew, $this->repasse_valor_mes->CurrentValue, NULL, FALSE);

		// repasse_valor_previsto
		$this->repasse_valor_previsto->SetDbValueDef($rsnew, $this->repasse_valor_previsto->CurrentValue, NULL, FALSE);

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
				if (@$_GET["fk_processo_id"] <> "") {
					$GLOBALS["rc25_a_termos"]->processo_id->setQueryStringValue($_GET["fk_processo_id"]);
					$this->repasse_id_termos->setQueryStringValue($GLOBALS["rc25_a_termos"]->processo_id->QueryStringValue);
					$this->repasse_id_termos->setSessionValue($this->repasse_id_termos->QueryStringValue);
					if (!is_numeric($GLOBALS["rc25_a_termos"]->processo_id->QueryStringValue)) $bValidMaster = FALSE;
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
				if (@$_POST["fk_processo_id"] <> "") {
					$GLOBALS["rc25_a_termos"]->processo_id->setFormValue($_POST["fk_processo_id"]);
					$this->repasse_id_termos->setFormValue($GLOBALS["rc25_a_termos"]->processo_id->FormValue);
					$this->repasse_id_termos->setSessionValue($this->repasse_id_termos->FormValue);
					if (!is_numeric($GLOBALS["rc25_a_termos"]->processo_id->FormValue)) $bValidMaster = FALSE;
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
				if ($this->repasse_id_termos->CurrentValue == "") $this->repasse_id_termos->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_repasseslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_repasse_id_termos":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `processo_id` AS `LinkFld`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_termos`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`processo_id` IN ({filter_value})', "t0" => "21", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($rc25_a_repasses_add)) $rc25_a_repasses_add = new crc25_a_repasses_add();

// Page init
$rc25_a_repasses_add->Page_Init();

// Page main
$rc25_a_repasses_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_repasses_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frc25_a_repassesadd = new ew_Form("frc25_a_repassesadd", "add");

// Validate form
frc25_a_repassesadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_repasse_faixa_etaria");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_repasses->repasse_faixa_etaria->FldCaption(), $rc25_a_repasses->repasse_faixa_etaria->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_repasse_meta");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_repasses->repasse_meta->FldCaption(), $rc25_a_repasses->repasse_meta->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_repasse_meta");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_meta->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_unitario");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_unitario->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_mes");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_mes->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_previsto");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_previsto->FldErrMsg()) ?>");

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
frc25_a_repassesadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_repassesadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_repassesadd.Lists["x_repasse_id_termos"] = {"LinkField":"x_processo_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_processo_termo_num","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_termos"};
frc25_a_repassesadd.Lists["x_repasse_id_termos"].Data = "<?php echo $rc25_a_repasses_add->repasse_id_termos->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_repasses_add->ShowPageHeader(); ?>
<?php
$rc25_a_repasses_add->ShowMessage();
?>
<form name="frc25_a_repassesadd" id="frc25_a_repassesadd" class="<?php echo $rc25_a_repasses_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_repasses_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_repasses_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_repasses">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_repasses_add->IsModal) ?>">
<?php if ($rc25_a_repasses->getCurrentMasterTable() == "rc25_a_termos") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="rc25_a_termos">
<input type="hidden" name="fk_processo_id" value="<?php echo $rc25_a_repasses->repasse_id_termos->getSessionValue() ?>">
<?php } ?>
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
	<div id="r_repasse_id_termos" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_id_termos" for="x_repasse_id_termos" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_id_termos->CellAttributes() ?>>
<?php if ($rc25_a_repasses->repasse_id_termos->getSessionValue() <> "") { ?>
<span id="el_rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_id_termos->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_repasse_id_termos" name="x_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->CurrentValue) ?>">
<?php } else { ?>
<span id="el_rc25_a_repasses_repasse_id_termos">
<select data-table="rc25_a_repasses" data-field="x_repasse_id_termos" data-value-separator="<?php echo $rc25_a_repasses->repasse_id_termos->DisplayValueSeparatorAttribute() ?>" id="x_repasse_id_termos" name="x_repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->EditAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->SelectOptionListHtml("x_repasse_id_termos") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_repasses->repasse_id_termos->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_repasse_id_termos',url:'rc25_a_termosaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_repasse_id_termos"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span></button>
</span>
<?php } ?>
<?php echo $rc25_a_repasses->repasse_id_termos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
	<div id="r_repasse_faixa_etaria" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_faixa_etaria" for="x_repasse_faixa_etaria" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_faixa_etaria->CellAttributes() ?>>
<span id="el_rc25_a_repasses_repasse_faixa_etaria">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x_repasse_faixa_etaria" id="x_repasse_faixa_etaria" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditValue ?>"<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditAttributes() ?>>
</span>
<?php echo $rc25_a_repasses->repasse_faixa_etaria->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
	<div id="r_repasse_meta" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_meta" for="x_repasse_meta" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_meta->CellAttributes() ?>>
<span id="el_rc25_a_repasses_repasse_meta">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x_repasse_meta" id="x_repasse_meta" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_meta->EditValue ?>"<?php echo $rc25_a_repasses->repasse_meta->EditAttributes() ?>>
</span>
<?php echo $rc25_a_repasses->repasse_meta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
	<div id="r_repasse_valor_unitario" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_valor_unitario" for="x_repasse_valor_unitario" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_valor_unitario->CellAttributes() ?>>
<span id="el_rc25_a_repasses_repasse_valor_unitario">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x_repasse_valor_unitario" id="x_repasse_valor_unitario" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_unitario->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_unitario->EditAttributes() ?>>
</span>
<?php echo $rc25_a_repasses->repasse_valor_unitario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
	<div id="r_repasse_valor_mes" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_valor_mes" for="x_repasse_valor_mes" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_valor_mes->CellAttributes() ?>>
<span id="el_rc25_a_repasses_repasse_valor_mes">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x_repasse_valor_mes" id="x_repasse_valor_mes" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_mes->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_mes->EditAttributes() ?>>
</span>
<?php echo $rc25_a_repasses->repasse_valor_mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
	<div id="r_repasse_valor_previsto" class="form-group">
		<label id="elh_rc25_a_repasses_repasse_valor_previsto" for="x_repasse_valor_previsto" class="<?php echo $rc25_a_repasses_add->LeftColumnClass ?>"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_repasses_add->RightColumnClass ?>"><div<?php echo $rc25_a_repasses->repasse_valor_previsto->CellAttributes() ?>>
<span id="el_rc25_a_repasses_repasse_valor_previsto">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x_repasse_valor_previsto" id="x_repasse_valor_previsto" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_previsto->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_previsto->EditAttributes() ?>>
</span>
<?php echo $rc25_a_repasses->repasse_valor_previsto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rc25_a_repasses_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_repasses_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_repasses_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_repassesadd.Init();
</script>
<?php
$rc25_a_repasses_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_repasses_add->Page_Terminate();
?>
