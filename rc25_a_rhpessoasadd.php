<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_rhpessoasinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_rhpessoas_add = NULL; // Initialize page object first

class crc25_a_rhpessoas_add extends crc25_a_rhpessoas {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_rhpessoas';

	// Page object name
	var $PageObjName = 'rc25_a_rhpessoas_add';

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

		// Table object (rc25_a_rhpessoas)
		if (!isset($GLOBALS["rc25_a_rhpessoas"]) || get_class($GLOBALS["rc25_a_rhpessoas"]) == "crc25_a_rhpessoas") {
			$GLOBALS["rc25_a_rhpessoas"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_rhpessoas"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_rhpessoas', TRUE);

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
		$this->rhp_fis_jur->SetVisibility();
		$this->rhp_nome->SetVisibility();
		$this->rhp_documento->SetVisibility();
		$this->rhp_data_cadastro->SetVisibility();

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
		global $EW_EXPORT, $rc25_a_rhpessoas;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_rhpessoas);
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
					if ($pageName == "rc25_a_rhpessoasview.php")
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

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["rhp_id"] != "") {
				$this->rhp_id->setQueryStringValue($_GET["rhp_id"]);
				$this->setKey("rhp_id", $this->rhp_id->CurrentValue); // Set up key
			} else {
				$this->setKey("rhp_id", ""); // Clear key
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
					$this->Page_Terminate("rc25_a_rhpessoaslist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rc25_a_rhpessoaslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rc25_a_rhpessoasview.php")
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
		$this->rhp_id->CurrentValue = NULL;
		$this->rhp_id->OldValue = $this->rhp_id->CurrentValue;
		$this->rhp_fis_jur->CurrentValue = NULL;
		$this->rhp_fis_jur->OldValue = $this->rhp_fis_jur->CurrentValue;
		$this->rhp_nome->CurrentValue = NULL;
		$this->rhp_nome->OldValue = $this->rhp_nome->CurrentValue;
		$this->rhp_documento->CurrentValue = NULL;
		$this->rhp_documento->OldValue = $this->rhp_documento->CurrentValue;
		$this->rhp_data_cadastro->CurrentValue = NULL;
		$this->rhp_data_cadastro->OldValue = $this->rhp_data_cadastro->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->rhp_fis_jur->FldIsDetailKey) {
			$this->rhp_fis_jur->setFormValue($objForm->GetValue("x_rhp_fis_jur"));
		}
		if (!$this->rhp_nome->FldIsDetailKey) {
			$this->rhp_nome->setFormValue($objForm->GetValue("x_rhp_nome"));
		}
		if (!$this->rhp_documento->FldIsDetailKey) {
			$this->rhp_documento->setFormValue($objForm->GetValue("x_rhp_documento"));
		}
		if (!$this->rhp_data_cadastro->FldIsDetailKey) {
			$this->rhp_data_cadastro->setFormValue($objForm->GetValue("x_rhp_data_cadastro"));
			$this->rhp_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->rhp_data_cadastro->CurrentValue, 1);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->rhp_fis_jur->CurrentValue = $this->rhp_fis_jur->FormValue;
		$this->rhp_nome->CurrentValue = $this->rhp_nome->FormValue;
		$this->rhp_documento->CurrentValue = $this->rhp_documento->FormValue;
		$this->rhp_data_cadastro->CurrentValue = $this->rhp_data_cadastro->FormValue;
		$this->rhp_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->rhp_data_cadastro->CurrentValue, 1);
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
		$this->rhp_id->setDbValue($row['rhp_id']);
		$this->rhp_fis_jur->setDbValue($row['rhp_fis_jur']);
		$this->rhp_nome->setDbValue($row['rhp_nome']);
		$this->rhp_documento->setDbValue($row['rhp_documento']);
		$this->rhp_data_cadastro->setDbValue($row['rhp_data_cadastro']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['rhp_id'] = $this->rhp_id->CurrentValue;
		$row['rhp_fis_jur'] = $this->rhp_fis_jur->CurrentValue;
		$row['rhp_nome'] = $this->rhp_nome->CurrentValue;
		$row['rhp_documento'] = $this->rhp_documento->CurrentValue;
		$row['rhp_data_cadastro'] = $this->rhp_data_cadastro->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rhp_id->DbValue = $row['rhp_id'];
		$this->rhp_fis_jur->DbValue = $row['rhp_fis_jur'];
		$this->rhp_nome->DbValue = $row['rhp_nome'];
		$this->rhp_documento->DbValue = $row['rhp_documento'];
		$this->rhp_data_cadastro->DbValue = $row['rhp_data_cadastro'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("rhp_id")) <> "")
			$this->rhp_id->CurrentValue = $this->getKey("rhp_id"); // rhp_id
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// rhp_id
		// rhp_fis_jur
		// rhp_nome
		// rhp_documento
		// rhp_data_cadastro

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rhp_fis_jur
		if (strval($this->rhp_fis_jur->CurrentValue) <> "") {
			$this->rhp_fis_jur->ViewValue = $this->rhp_fis_jur->OptionCaption($this->rhp_fis_jur->CurrentValue);
		} else {
			$this->rhp_fis_jur->ViewValue = NULL;
		}
		$this->rhp_fis_jur->ViewCustomAttributes = "";

		// rhp_nome
		$this->rhp_nome->ViewValue = $this->rhp_nome->CurrentValue;
		$this->rhp_nome->ViewCustomAttributes = "";

		// rhp_documento
		$this->rhp_documento->ViewValue = $this->rhp_documento->CurrentValue;
		$this->rhp_documento->ViewCustomAttributes = "";

		// rhp_data_cadastro
		$this->rhp_data_cadastro->ViewValue = $this->rhp_data_cadastro->CurrentValue;
		$this->rhp_data_cadastro->ViewValue = ew_FormatDateTime($this->rhp_data_cadastro->ViewValue, 1);
		$this->rhp_data_cadastro->ViewCustomAttributes = "";

			// rhp_fis_jur
			$this->rhp_fis_jur->LinkCustomAttributes = "";
			$this->rhp_fis_jur->HrefValue = "";
			$this->rhp_fis_jur->TooltipValue = "";

			// rhp_nome
			$this->rhp_nome->LinkCustomAttributes = "";
			$this->rhp_nome->HrefValue = "";
			$this->rhp_nome->TooltipValue = "";

			// rhp_documento
			$this->rhp_documento->LinkCustomAttributes = "";
			$this->rhp_documento->HrefValue = "";
			$this->rhp_documento->TooltipValue = "";

			// rhp_data_cadastro
			$this->rhp_data_cadastro->LinkCustomAttributes = "";
			$this->rhp_data_cadastro->HrefValue = "";
			$this->rhp_data_cadastro->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// rhp_fis_jur
			$this->rhp_fis_jur->EditCustomAttributes = "";
			$this->rhp_fis_jur->EditValue = $this->rhp_fis_jur->Options(FALSE);

			// rhp_nome
			$this->rhp_nome->EditAttrs["class"] = "form-control";
			$this->rhp_nome->EditCustomAttributes = "";
			$this->rhp_nome->EditValue = ew_HtmlEncode($this->rhp_nome->CurrentValue);
			$this->rhp_nome->PlaceHolder = ew_RemoveHtml($this->rhp_nome->FldCaption());

			// rhp_documento
			$this->rhp_documento->EditAttrs["class"] = "form-control";
			$this->rhp_documento->EditCustomAttributes = "";
			$this->rhp_documento->EditValue = ew_HtmlEncode($this->rhp_documento->CurrentValue);
			$this->rhp_documento->PlaceHolder = ew_RemoveHtml($this->rhp_documento->FldCaption());

			// rhp_data_cadastro
			// Add refer script
			// rhp_fis_jur

			$this->rhp_fis_jur->LinkCustomAttributes = "";
			$this->rhp_fis_jur->HrefValue = "";

			// rhp_nome
			$this->rhp_nome->LinkCustomAttributes = "";
			$this->rhp_nome->HrefValue = "";

			// rhp_documento
			$this->rhp_documento->LinkCustomAttributes = "";
			$this->rhp_documento->HrefValue = "";

			// rhp_data_cadastro
			$this->rhp_data_cadastro->LinkCustomAttributes = "";
			$this->rhp_data_cadastro->HrefValue = "";
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
		if ($this->rhp_fis_jur->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rhp_fis_jur->FldCaption(), $this->rhp_fis_jur->ReqErrMsg));
		}
		if (!$this->rhp_nome->FldIsDetailKey && !is_null($this->rhp_nome->FormValue) && $this->rhp_nome->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rhp_nome->FldCaption(), $this->rhp_nome->ReqErrMsg));
		}
		if (!$this->rhp_documento->FldIsDetailKey && !is_null($this->rhp_documento->FormValue) && $this->rhp_documento->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rhp_documento->FldCaption(), $this->rhp_documento->ReqErrMsg));
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
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// rhp_fis_jur
		$this->rhp_fis_jur->SetDbValueDef($rsnew, $this->rhp_fis_jur->CurrentValue, 0, FALSE);

		// rhp_nome
		$this->rhp_nome->SetDbValueDef($rsnew, $this->rhp_nome->CurrentValue, "", FALSE);

		// rhp_documento
		$this->rhp_documento->SetDbValueDef($rsnew, $this->rhp_documento->CurrentValue, NULL, FALSE);

		// rhp_data_cadastro
		$this->rhp_data_cadastro->SetDbValueDef($rsnew, ew_CurrentDateTime(), ew_CurrentDate());
		$rsnew['rhp_data_cadastro'] = &$this->rhp_data_cadastro->DbValue;

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_rhpessoaslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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
if (!isset($rc25_a_rhpessoas_add)) $rc25_a_rhpessoas_add = new crc25_a_rhpessoas_add();

// Page init
$rc25_a_rhpessoas_add->Page_Init();

// Page main
$rc25_a_rhpessoas_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_rhpessoas_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frc25_a_rhpessoasadd = new ew_Form("frc25_a_rhpessoasadd", "add");

// Validate form
frc25_a_rhpessoasadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_rhp_fis_jur");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_rhpessoas->rhp_fis_jur->FldCaption(), $rc25_a_rhpessoas->rhp_fis_jur->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rhp_nome");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_rhpessoas->rhp_nome->FldCaption(), $rc25_a_rhpessoas->rhp_nome->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rhp_documento");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_rhpessoas->rhp_documento->FldCaption(), $rc25_a_rhpessoas->rhp_documento->ReqErrMsg)) ?>");

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
frc25_a_rhpessoasadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_rhpessoasadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_rhpessoasadd.Lists["x_rhp_fis_jur"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frc25_a_rhpessoasadd.Lists["x_rhp_fis_jur"].Options = <?php echo json_encode($rc25_a_rhpessoas_add->rhp_fis_jur->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_rhpessoas_add->ShowPageHeader(); ?>
<?php
$rc25_a_rhpessoas_add->ShowMessage();
?>
<form name="frc25_a_rhpessoasadd" id="frc25_a_rhpessoasadd" class="<?php echo $rc25_a_rhpessoas_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_rhpessoas_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_rhpessoas_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_rhpessoas">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_rhpessoas_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_rhpessoas->rhp_fis_jur->Visible) { // rhp_fis_jur ?>
	<div id="r_rhp_fis_jur" class="form-group">
		<label id="elh_rc25_a_rhpessoas_rhp_fis_jur" class="<?php echo $rc25_a_rhpessoas_add->LeftColumnClass ?>"><?php echo $rc25_a_rhpessoas->rhp_fis_jur->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_rhpessoas_add->RightColumnClass ?>"><div<?php echo $rc25_a_rhpessoas->rhp_fis_jur->CellAttributes() ?>>
<span id="el_rc25_a_rhpessoas_rhp_fis_jur">
<div id="tp_x_rhp_fis_jur" class="ewTemplate"><input type="radio" data-table="rc25_a_rhpessoas" data-field="x_rhp_fis_jur" data-value-separator="<?php echo $rc25_a_rhpessoas->rhp_fis_jur->DisplayValueSeparatorAttribute() ?>" name="x_rhp_fis_jur" id="x_rhp_fis_jur" value="{value}"<?php echo $rc25_a_rhpessoas->rhp_fis_jur->EditAttributes() ?>></div>
<div id="dsl_x_rhp_fis_jur" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $rc25_a_rhpessoas->rhp_fis_jur->RadioButtonListHtml(FALSE, "x_rhp_fis_jur") ?>
</div></div>
</span>
<?php echo $rc25_a_rhpessoas->rhp_fis_jur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_rhpessoas->rhp_nome->Visible) { // rhp_nome ?>
	<div id="r_rhp_nome" class="form-group">
		<label id="elh_rc25_a_rhpessoas_rhp_nome" for="x_rhp_nome" class="<?php echo $rc25_a_rhpessoas_add->LeftColumnClass ?>"><?php echo $rc25_a_rhpessoas->rhp_nome->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_rhpessoas_add->RightColumnClass ?>"><div<?php echo $rc25_a_rhpessoas->rhp_nome->CellAttributes() ?>>
<span id="el_rc25_a_rhpessoas_rhp_nome">
<input type="text" data-table="rc25_a_rhpessoas" data-field="x_rhp_nome" name="x_rhp_nome" id="x_rhp_nome" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_rhpessoas->rhp_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_rhpessoas->rhp_nome->EditValue ?>"<?php echo $rc25_a_rhpessoas->rhp_nome->EditAttributes() ?>>
</span>
<?php echo $rc25_a_rhpessoas->rhp_nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_rhpessoas->rhp_documento->Visible) { // rhp_documento ?>
	<div id="r_rhp_documento" class="form-group">
		<label id="elh_rc25_a_rhpessoas_rhp_documento" for="x_rhp_documento" class="<?php echo $rc25_a_rhpessoas_add->LeftColumnClass ?>"><?php echo $rc25_a_rhpessoas->rhp_documento->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_rhpessoas_add->RightColumnClass ?>"><div<?php echo $rc25_a_rhpessoas->rhp_documento->CellAttributes() ?>>
<span id="el_rc25_a_rhpessoas_rhp_documento">
<input type="text" data-table="rc25_a_rhpessoas" data-field="x_rhp_documento" name="x_rhp_documento" id="x_rhp_documento" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($rc25_a_rhpessoas->rhp_documento->getPlaceHolder()) ?>" value="<?php echo $rc25_a_rhpessoas->rhp_documento->EditValue ?>"<?php echo $rc25_a_rhpessoas->rhp_documento->EditAttributes() ?>>
</span>
<?php echo $rc25_a_rhpessoas->rhp_documento->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rc25_a_rhpessoas_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_rhpessoas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_rhpessoas_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_rhpessoasadd.Init();
</script>
<?php
$rc25_a_rhpessoas_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_rhpessoas_add->Page_Terminate();
?>
