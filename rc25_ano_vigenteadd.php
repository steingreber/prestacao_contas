<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_ano_vigenteinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_ano_vigente_add = NULL; // Initialize page object first

class crc25_ano_vigente_add extends crc25_ano_vigente {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_ano_vigente';

	// Page object name
	var $PageObjName = 'rc25_ano_vigente_add';

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

		// Table object (rc25_ano_vigente)
		if (!isset($GLOBALS["rc25_ano_vigente"]) || get_class($GLOBALS["rc25_ano_vigente"]) == "crc25_ano_vigente") {
			$GLOBALS["rc25_ano_vigente"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_ano_vigente"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_ano_vigente', TRUE);

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
		$this->ano_ano->SetVisibility();
		$this->ano_descri->SetVisibility();
		$this->ano_valor_total->SetVisibility();
		$this->ano_vigencia_ini->SetVisibility();
		$this->ano_vigencia_fim->SetVisibility();
		$this->ano_prest_contas->SetVisibility();

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
		global $EW_EXPORT, $rc25_ano_vigente;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_ano_vigente);
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
					if ($pageName == "rc25_ano_vigenteview.php")
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
			if (@$_GET["ano_id"] != "") {
				$this->ano_id->setQueryStringValue($_GET["ano_id"]);
				$this->setKey("ano_id", $this->ano_id->CurrentValue); // Set up key
			} else {
				$this->setKey("ano_id", ""); // Clear key
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
					$this->Page_Terminate("rc25_ano_vigentelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rc25_ano_vigentelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rc25_ano_vigenteview.php")
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
		$this->ano_id->CurrentValue = NULL;
		$this->ano_id->OldValue = $this->ano_id->CurrentValue;
		$this->ano_ano->CurrentValue = NULL;
		$this->ano_ano->OldValue = $this->ano_ano->CurrentValue;
		$this->ano_descri->CurrentValue = NULL;
		$this->ano_descri->OldValue = $this->ano_descri->CurrentValue;
		$this->ano_valor_total->CurrentValue = NULL;
		$this->ano_valor_total->OldValue = $this->ano_valor_total->CurrentValue;
		$this->ano_vigencia_ini->CurrentValue = NULL;
		$this->ano_vigencia_ini->OldValue = $this->ano_vigencia_ini->CurrentValue;
		$this->ano_vigencia_fim->CurrentValue = NULL;
		$this->ano_vigencia_fim->OldValue = $this->ano_vigencia_fim->CurrentValue;
		$this->ano_prest_contas->CurrentValue = NULL;
		$this->ano_prest_contas->OldValue = $this->ano_prest_contas->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->ano_ano->FldIsDetailKey) {
			$this->ano_ano->setFormValue($objForm->GetValue("x_ano_ano"));
		}
		if (!$this->ano_descri->FldIsDetailKey) {
			$this->ano_descri->setFormValue($objForm->GetValue("x_ano_descri"));
		}
		if (!$this->ano_valor_total->FldIsDetailKey) {
			$this->ano_valor_total->setFormValue($objForm->GetValue("x_ano_valor_total"));
		}
		if (!$this->ano_vigencia_ini->FldIsDetailKey) {
			$this->ano_vigencia_ini->setFormValue($objForm->GetValue("x_ano_vigencia_ini"));
			$this->ano_vigencia_ini->CurrentValue = ew_UnFormatDateTime($this->ano_vigencia_ini->CurrentValue, 7);
		}
		if (!$this->ano_vigencia_fim->FldIsDetailKey) {
			$this->ano_vigencia_fim->setFormValue($objForm->GetValue("x_ano_vigencia_fim"));
			$this->ano_vigencia_fim->CurrentValue = ew_UnFormatDateTime($this->ano_vigencia_fim->CurrentValue, 7);
		}
		if (!$this->ano_prest_contas->FldIsDetailKey) {
			$this->ano_prest_contas->setFormValue($objForm->GetValue("x_ano_prest_contas"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->ano_ano->CurrentValue = $this->ano_ano->FormValue;
		$this->ano_descri->CurrentValue = $this->ano_descri->FormValue;
		$this->ano_valor_total->CurrentValue = $this->ano_valor_total->FormValue;
		$this->ano_vigencia_ini->CurrentValue = $this->ano_vigencia_ini->FormValue;
		$this->ano_vigencia_ini->CurrentValue = ew_UnFormatDateTime($this->ano_vigencia_ini->CurrentValue, 7);
		$this->ano_vigencia_fim->CurrentValue = $this->ano_vigencia_fim->FormValue;
		$this->ano_vigencia_fim->CurrentValue = ew_UnFormatDateTime($this->ano_vigencia_fim->CurrentValue, 7);
		$this->ano_prest_contas->CurrentValue = $this->ano_prest_contas->FormValue;
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
		$this->ano_id->setDbValue($row['ano_id']);
		$this->ano_ano->setDbValue($row['ano_ano']);
		$this->ano_descri->setDbValue($row['ano_descri']);
		$this->ano_valor_total->setDbValue($row['ano_valor_total']);
		$this->ano_vigencia_ini->setDbValue($row['ano_vigencia_ini']);
		$this->ano_vigencia_fim->setDbValue($row['ano_vigencia_fim']);
		$this->ano_prest_contas->setDbValue($row['ano_prest_contas']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['ano_id'] = $this->ano_id->CurrentValue;
		$row['ano_ano'] = $this->ano_ano->CurrentValue;
		$row['ano_descri'] = $this->ano_descri->CurrentValue;
		$row['ano_valor_total'] = $this->ano_valor_total->CurrentValue;
		$row['ano_vigencia_ini'] = $this->ano_vigencia_ini->CurrentValue;
		$row['ano_vigencia_fim'] = $this->ano_vigencia_fim->CurrentValue;
		$row['ano_prest_contas'] = $this->ano_prest_contas->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ano_id->DbValue = $row['ano_id'];
		$this->ano_ano->DbValue = $row['ano_ano'];
		$this->ano_descri->DbValue = $row['ano_descri'];
		$this->ano_valor_total->DbValue = $row['ano_valor_total'];
		$this->ano_vigencia_ini->DbValue = $row['ano_vigencia_ini'];
		$this->ano_vigencia_fim->DbValue = $row['ano_vigencia_fim'];
		$this->ano_prest_contas->DbValue = $row['ano_prest_contas'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("ano_id")) <> "")
			$this->ano_id->CurrentValue = $this->getKey("ano_id"); // ano_id
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
		$this->ano_vigencia_ini->ViewValue = ew_FormatDateTime($this->ano_vigencia_ini->ViewValue, 7);
		$this->ano_vigencia_ini->ViewCustomAttributes = "";

		// ano_vigencia_fim
		$this->ano_vigencia_fim->ViewValue = $this->ano_vigencia_fim->CurrentValue;
		$this->ano_vigencia_fim->ViewValue = ew_FormatDateTime($this->ano_vigencia_fim->ViewValue, 7);
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// ano_ano
			$this->ano_ano->EditAttrs["class"] = "form-control";
			$this->ano_ano->EditCustomAttributes = "";
			$this->ano_ano->EditValue = ew_HtmlEncode($this->ano_ano->CurrentValue);
			$this->ano_ano->PlaceHolder = ew_RemoveHtml($this->ano_ano->FldCaption());

			// ano_descri
			$this->ano_descri->EditAttrs["class"] = "form-control";
			$this->ano_descri->EditCustomAttributes = "";
			$this->ano_descri->EditValue = ew_HtmlEncode($this->ano_descri->CurrentValue);
			$this->ano_descri->PlaceHolder = ew_RemoveHtml($this->ano_descri->FldCaption());

			// ano_valor_total
			$this->ano_valor_total->EditAttrs["class"] = "form-control";
			$this->ano_valor_total->EditCustomAttributes = "";
			$this->ano_valor_total->EditValue = ew_HtmlEncode($this->ano_valor_total->CurrentValue);
			$this->ano_valor_total->PlaceHolder = ew_RemoveHtml($this->ano_valor_total->FldCaption());
			if (strval($this->ano_valor_total->EditValue) <> "" && is_numeric($this->ano_valor_total->EditValue)) $this->ano_valor_total->EditValue = ew_FormatNumber($this->ano_valor_total->EditValue, -2, -2, -2, -2);

			// ano_vigencia_ini
			$this->ano_vigencia_ini->EditAttrs["class"] = "form-control";
			$this->ano_vigencia_ini->EditCustomAttributes = "";
			$this->ano_vigencia_ini->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ano_vigencia_ini->CurrentValue, 7));
			$this->ano_vigencia_ini->PlaceHolder = ew_RemoveHtml($this->ano_vigencia_ini->FldCaption());

			// ano_vigencia_fim
			$this->ano_vigencia_fim->EditAttrs["class"] = "form-control";
			$this->ano_vigencia_fim->EditCustomAttributes = "";
			$this->ano_vigencia_fim->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ano_vigencia_fim->CurrentValue, 7));
			$this->ano_vigencia_fim->PlaceHolder = ew_RemoveHtml($this->ano_vigencia_fim->FldCaption());

			// ano_prest_contas
			$this->ano_prest_contas->EditAttrs["class"] = "form-control";
			$this->ano_prest_contas->EditCustomAttributes = "";
			$this->ano_prest_contas->EditValue = ew_HtmlEncode($this->ano_prest_contas->CurrentValue);
			$this->ano_prest_contas->PlaceHolder = ew_RemoveHtml($this->ano_prest_contas->FldCaption());

			// Add refer script
			// ano_ano

			$this->ano_ano->LinkCustomAttributes = "";
			$this->ano_ano->HrefValue = "";

			// ano_descri
			$this->ano_descri->LinkCustomAttributes = "";
			$this->ano_descri->HrefValue = "";

			// ano_valor_total
			$this->ano_valor_total->LinkCustomAttributes = "";
			$this->ano_valor_total->HrefValue = "";

			// ano_vigencia_ini
			$this->ano_vigencia_ini->LinkCustomAttributes = "";
			$this->ano_vigencia_ini->HrefValue = "";

			// ano_vigencia_fim
			$this->ano_vigencia_fim->LinkCustomAttributes = "";
			$this->ano_vigencia_fim->HrefValue = "";

			// ano_prest_contas
			$this->ano_prest_contas->LinkCustomAttributes = "";
			$this->ano_prest_contas->HrefValue = "";
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
		if (!$this->ano_ano->FldIsDetailKey && !is_null($this->ano_ano->FormValue) && $this->ano_ano->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_ano->FldCaption(), $this->ano_ano->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->ano_ano->FormValue)) {
			ew_AddMessage($gsFormError, $this->ano_ano->FldErrMsg());
		}
		if (!$this->ano_descri->FldIsDetailKey && !is_null($this->ano_descri->FormValue) && $this->ano_descri->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_descri->FldCaption(), $this->ano_descri->ReqErrMsg));
		}
		if (!$this->ano_valor_total->FldIsDetailKey && !is_null($this->ano_valor_total->FormValue) && $this->ano_valor_total->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_valor_total->FldCaption(), $this->ano_valor_total->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->ano_valor_total->FormValue)) {
			ew_AddMessage($gsFormError, $this->ano_valor_total->FldErrMsg());
		}
		if (!$this->ano_vigencia_ini->FldIsDetailKey && !is_null($this->ano_vigencia_ini->FormValue) && $this->ano_vigencia_ini->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_vigencia_ini->FldCaption(), $this->ano_vigencia_ini->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->ano_vigencia_ini->FormValue)) {
			ew_AddMessage($gsFormError, $this->ano_vigencia_ini->FldErrMsg());
		}
		if (!$this->ano_vigencia_fim->FldIsDetailKey && !is_null($this->ano_vigencia_fim->FormValue) && $this->ano_vigencia_fim->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_vigencia_fim->FldCaption(), $this->ano_vigencia_fim->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->ano_vigencia_fim->FormValue)) {
			ew_AddMessage($gsFormError, $this->ano_vigencia_fim->FldErrMsg());
		}
		if (!$this->ano_prest_contas->FldIsDetailKey && !is_null($this->ano_prest_contas->FormValue) && $this->ano_prest_contas->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ano_prest_contas->FldCaption(), $this->ano_prest_contas->ReqErrMsg));
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
		if ($this->ano_ano->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(ano_ano = " . ew_AdjustSql($this->ano_ano->CurrentValue, $this->DBID) . ")";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->ano_ano->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->ano_ano->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// ano_ano
		$this->ano_ano->SetDbValueDef($rsnew, $this->ano_ano->CurrentValue, 0, FALSE);

		// ano_descri
		$this->ano_descri->SetDbValueDef($rsnew, $this->ano_descri->CurrentValue, "", FALSE);

		// ano_valor_total
		$this->ano_valor_total->SetDbValueDef($rsnew, $this->ano_valor_total->CurrentValue, 0, FALSE);

		// ano_vigencia_ini
		$this->ano_vigencia_ini->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ano_vigencia_ini->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// ano_vigencia_fim
		$this->ano_vigencia_fim->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ano_vigencia_fim->CurrentValue, 7), ew_CurrentDate(), FALSE);

		// ano_prest_contas
		$this->ano_prest_contas->SetDbValueDef($rsnew, $this->ano_prest_contas->CurrentValue, "", FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_ano_vigentelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rc25_ano_vigente_add)) $rc25_ano_vigente_add = new crc25_ano_vigente_add();

// Page init
$rc25_ano_vigente_add->Page_Init();

// Page main
$rc25_ano_vigente_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_ano_vigente_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frc25_ano_vigenteadd = new ew_Form("frc25_ano_vigenteadd", "add");

// Validate form
frc25_ano_vigenteadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_ano_ano");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_ano->FldCaption(), $rc25_ano_vigente->ano_ano->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ano_ano");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_ano_vigente->ano_ano->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ano_descri");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_descri->FldCaption(), $rc25_ano_vigente->ano_descri->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ano_valor_total");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_valor_total->FldCaption(), $rc25_ano_vigente->ano_valor_total->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ano_valor_total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_ano_vigente->ano_valor_total->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ano_vigencia_ini");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_vigencia_ini->FldCaption(), $rc25_ano_vigente->ano_vigencia_ini->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ano_vigencia_ini");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_ano_vigente->ano_vigencia_ini->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ano_vigencia_fim");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_vigencia_fim->FldCaption(), $rc25_ano_vigente->ano_vigencia_fim->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ano_vigencia_fim");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_ano_vigente->ano_vigencia_fim->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ano_prest_contas");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_ano_vigente->ano_prest_contas->FldCaption(), $rc25_ano_vigente->ano_prest_contas->ReqErrMsg)) ?>");

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
frc25_ano_vigenteadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_ano_vigenteadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_ano_vigente_add->ShowPageHeader(); ?>
<?php
$rc25_ano_vigente_add->ShowMessage();
?>
<form name="frc25_ano_vigenteadd" id="frc25_ano_vigenteadd" class="<?php echo $rc25_ano_vigente_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_ano_vigente_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_ano_vigente_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_ano_vigente">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rc25_ano_vigente_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_ano_vigente->ano_ano->Visible) { // ano_ano ?>
	<div id="r_ano_ano" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_ano" for="x_ano_ano" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_ano->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_ano->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_ano">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_ano" name="x_ano_ano" id="x_ano_ano" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_ano->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_ano->EditValue ?>"<?php echo $rc25_ano_vigente->ano_ano->EditAttributes() ?>>
</span>
<?php echo $rc25_ano_vigente->ano_ano->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_ano_vigente->ano_descri->Visible) { // ano_descri ?>
	<div id="r_ano_descri" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_descri" for="x_ano_descri" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_descri->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_descri->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_descri">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_descri" name="x_ano_descri" id="x_ano_descri" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_descri->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_descri->EditValue ?>"<?php echo $rc25_ano_vigente->ano_descri->EditAttributes() ?>>
</span>
<?php echo $rc25_ano_vigente->ano_descri->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_ano_vigente->ano_valor_total->Visible) { // ano_valor_total ?>
	<div id="r_ano_valor_total" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_valor_total" for="x_ano_valor_total" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_valor_total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_valor_total->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_valor_total">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_valor_total" name="x_ano_valor_total" id="x_ano_valor_total" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_valor_total->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_valor_total->EditValue ?>"<?php echo $rc25_ano_vigente->ano_valor_total->EditAttributes() ?>>
</span>
<?php echo $rc25_ano_vigente->ano_valor_total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_ano_vigente->ano_vigencia_ini->Visible) { // ano_vigencia_ini ?>
	<div id="r_ano_vigencia_ini" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_vigencia_ini" for="x_ano_vigencia_ini" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_vigencia_ini->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_vigencia_ini->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_vigencia_ini">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_vigencia_ini" data-format="7" name="x_ano_vigencia_ini" id="x_ano_vigencia_ini" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_vigencia_ini->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_vigencia_ini->EditValue ?>"<?php echo $rc25_ano_vigente->ano_vigencia_ini->EditAttributes() ?>>
<?php if (!$rc25_ano_vigente->ano_vigencia_ini->ReadOnly && !$rc25_ano_vigente->ano_vigencia_ini->Disabled && !isset($rc25_ano_vigente->ano_vigencia_ini->EditAttrs["readonly"]) && !isset($rc25_ano_vigente->ano_vigencia_ini->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_ano_vigenteadd", "x_ano_vigencia_ini", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $rc25_ano_vigente->ano_vigencia_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_ano_vigente->ano_vigencia_fim->Visible) { // ano_vigencia_fim ?>
	<div id="r_ano_vigencia_fim" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_vigencia_fim" for="x_ano_vigencia_fim" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_vigencia_fim->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_vigencia_fim->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_vigencia_fim">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_vigencia_fim" data-format="7" name="x_ano_vigencia_fim" id="x_ano_vigencia_fim" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_vigencia_fim->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_vigencia_fim->EditValue ?>"<?php echo $rc25_ano_vigente->ano_vigencia_fim->EditAttributes() ?>>
<?php if (!$rc25_ano_vigente->ano_vigencia_fim->ReadOnly && !$rc25_ano_vigente->ano_vigencia_fim->Disabled && !isset($rc25_ano_vigente->ano_vigencia_fim->EditAttrs["readonly"]) && !isset($rc25_ano_vigente->ano_vigencia_fim->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_ano_vigenteadd", "x_ano_vigencia_fim", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $rc25_ano_vigente->ano_vigencia_fim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_ano_vigente->ano_prest_contas->Visible) { // ano_prest_contas ?>
	<div id="r_ano_prest_contas" class="form-group">
		<label id="elh_rc25_ano_vigente_ano_prest_contas" for="x_ano_prest_contas" class="<?php echo $rc25_ano_vigente_add->LeftColumnClass ?>"><?php echo $rc25_ano_vigente->ano_prest_contas->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_ano_vigente_add->RightColumnClass ?>"><div<?php echo $rc25_ano_vigente->ano_prest_contas->CellAttributes() ?>>
<span id="el_rc25_ano_vigente_ano_prest_contas">
<input type="text" data-table="rc25_ano_vigente" data-field="x_ano_prest_contas" name="x_ano_prest_contas" id="x_ano_prest_contas" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_ano_vigente->ano_prest_contas->getPlaceHolder()) ?>" value="<?php echo $rc25_ano_vigente->ano_prest_contas->EditValue ?>"<?php echo $rc25_ano_vigente->ano_prest_contas->EditAttributes() ?>>
</span>
<?php echo $rc25_ano_vigente->ano_prest_contas->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rc25_ano_vigente_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_ano_vigente_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_ano_vigente_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frc25_ano_vigenteadd.Init();
</script>
<?php
$rc25_ano_vigente_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_ano_vigente_add->Page_Terminate();
?>
