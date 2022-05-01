<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_recurso_aplicadosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_recurso_aplicados_edit = NULL; // Initialize page object first

class crc25_a_recurso_aplicados_edit extends crc25_a_recurso_aplicados {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recurso_aplicados';

	// Page object name
	var $PageObjName = 'rc25_a_recurso_aplicados_edit';

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

		// Table object (rc25_a_recurso_aplicados)
		if (!isset($GLOBALS["rc25_a_recurso_aplicados"]) || get_class($GLOBALS["rc25_a_recurso_aplicados"]) == "crc25_a_recurso_aplicados") {
			$GLOBALS["rc25_a_recurso_aplicados"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recurso_aplicados"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_recurso_aplicados', TRUE);

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
		$this->ra_exercicio->SetVisibility();
		$this->ra_data_cadastro->SetVisibility();
		$this->ra_data_pagamento->SetVisibility();
		$this->ra_especificacoes->SetVisibility();
		$this->ra_identificador->SetVisibility();
		$this->ra_plano->SetVisibility();
		$this->ra_natureza->SetVisibility();
		$this->ra_valor->SetVisibility();
		$this->ra_comprovante->SetVisibility();

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
		global $EW_EXPORT, $rc25_a_recurso_aplicados;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_recurso_aplicados);
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
					if ($pageName == "rc25_a_recurso_aplicadosview.php")
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $RecCnt;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_ra_id")) {
				$this->ra_id->setFormValue($objForm->GetValue("x_ra_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["ra_id"])) {
				$this->ra_id->setQueryStringValue($_GET["ra_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->ra_id->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($this->Recordset = $this->LoadRecordset()) // Load records
			$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$this->Page_Terminate("rc25_a_recurso_aplicadoslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->ra_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->ra_id->CurrentValue) == strval($this->Recordset->fields('ra_id'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$this->Recordset->MoveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->LoadRowValues($this->Recordset);

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
					$this->Page_Terminate("rc25_a_recurso_aplicadoslist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "rc25_a_recurso_aplicadoslist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->ra_exercicio->FldIsDetailKey) {
			$this->ra_exercicio->setFormValue($objForm->GetValue("x_ra_exercicio"));
		}
		if (!$this->ra_data_cadastro->FldIsDetailKey) {
			$this->ra_data_cadastro->setFormValue($objForm->GetValue("x_ra_data_cadastro"));
			$this->ra_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->ra_data_cadastro->CurrentValue, 7);
		}
		if (!$this->ra_data_pagamento->FldIsDetailKey) {
			$this->ra_data_pagamento->setFormValue($objForm->GetValue("x_ra_data_pagamento"));
			$this->ra_data_pagamento->CurrentValue = ew_UnFormatDateTime($this->ra_data_pagamento->CurrentValue, 7);
		}
		if (!$this->ra_especificacoes->FldIsDetailKey) {
			$this->ra_especificacoes->setFormValue($objForm->GetValue("x_ra_especificacoes"));
		}
		if (!$this->ra_identificador->FldIsDetailKey) {
			$this->ra_identificador->setFormValue($objForm->GetValue("x_ra_identificador"));
		}
		if (!$this->ra_plano->FldIsDetailKey) {
			$this->ra_plano->setFormValue($objForm->GetValue("x_ra_plano"));
		}
		if (!$this->ra_natureza->FldIsDetailKey) {
			$this->ra_natureza->setFormValue($objForm->GetValue("x_ra_natureza"));
		}
		if (!$this->ra_valor->FldIsDetailKey) {
			$this->ra_valor->setFormValue($objForm->GetValue("x_ra_valor"));
		}
		if (!$this->ra_comprovante->FldIsDetailKey) {
			$this->ra_comprovante->setFormValue($objForm->GetValue("x_ra_comprovante"));
		}
		if (!$this->ra_id->FldIsDetailKey)
			$this->ra_id->setFormValue($objForm->GetValue("x_ra_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->ra_id->CurrentValue = $this->ra_id->FormValue;
		$this->ra_exercicio->CurrentValue = $this->ra_exercicio->FormValue;
		$this->ra_data_cadastro->CurrentValue = $this->ra_data_cadastro->FormValue;
		$this->ra_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->ra_data_cadastro->CurrentValue, 7);
		$this->ra_data_pagamento->CurrentValue = $this->ra_data_pagamento->FormValue;
		$this->ra_data_pagamento->CurrentValue = ew_UnFormatDateTime($this->ra_data_pagamento->CurrentValue, 7);
		$this->ra_especificacoes->CurrentValue = $this->ra_especificacoes->FormValue;
		$this->ra_identificador->CurrentValue = $this->ra_identificador->FormValue;
		$this->ra_plano->CurrentValue = $this->ra_plano->FormValue;
		$this->ra_natureza->CurrentValue = $this->ra_natureza->FormValue;
		$this->ra_valor->CurrentValue = $this->ra_valor->FormValue;
		$this->ra_comprovante->CurrentValue = $this->ra_comprovante->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->ra_id->setDbValue($row['ra_id']);
		$this->ra_exercicio->setDbValue($row['ra_exercicio']);
		$this->ra_data_cadastro->setDbValue($row['ra_data_cadastro']);
		$this->ra_data_pagamento->setDbValue($row['ra_data_pagamento']);
		$this->ra_especificacoes->setDbValue($row['ra_especificacoes']);
		$this->ra_credor->setDbValue($row['ra_credor']);
		$this->ra_identificador->setDbValue($row['ra_identificador']);
		$this->ra_plano->setDbValue($row['ra_plano']);
		$this->ra_natureza->setDbValue($row['ra_natureza']);
		$this->ra_valor->setDbValue($row['ra_valor']);
		$this->ra_comprovante->setDbValue($row['ra_comprovante']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['ra_id'] = NULL;
		$row['ra_exercicio'] = NULL;
		$row['ra_data_cadastro'] = NULL;
		$row['ra_data_pagamento'] = NULL;
		$row['ra_especificacoes'] = NULL;
		$row['ra_credor'] = NULL;
		$row['ra_identificador'] = NULL;
		$row['ra_plano'] = NULL;
		$row['ra_natureza'] = NULL;
		$row['ra_valor'] = NULL;
		$row['ra_comprovante'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ra_id->DbValue = $row['ra_id'];
		$this->ra_exercicio->DbValue = $row['ra_exercicio'];
		$this->ra_data_cadastro->DbValue = $row['ra_data_cadastro'];
		$this->ra_data_pagamento->DbValue = $row['ra_data_pagamento'];
		$this->ra_especificacoes->DbValue = $row['ra_especificacoes'];
		$this->ra_credor->DbValue = $row['ra_credor'];
		$this->ra_identificador->DbValue = $row['ra_identificador'];
		$this->ra_plano->DbValue = $row['ra_plano'];
		$this->ra_natureza->DbValue = $row['ra_natureza'];
		$this->ra_valor->DbValue = $row['ra_valor'];
		$this->ra_comprovante->DbValue = $row['ra_comprovante'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("ra_id")) <> "")
			$this->ra_id->CurrentValue = $this->getKey("ra_id"); // ra_id
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

		// ra_exercicio
		if (strval($this->ra_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->ra_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->ra_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->CurrentValue;
			}
		} else {
			$this->ra_exercicio->ViewValue = NULL;
		}
		$this->ra_exercicio->ViewCustomAttributes = "";

		// ra_data_cadastro
		$this->ra_data_cadastro->ViewValue = $this->ra_data_cadastro->CurrentValue;
		$this->ra_data_cadastro->ViewValue = ew_FormatDateTime($this->ra_data_cadastro->ViewValue, 7);
		$this->ra_data_cadastro->ViewCustomAttributes = "";

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
		$this->Lookup_Selecting($this->ra_identificador, $sWhereWrk); // Call Lookup Selecting
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
		$this->Lookup_Selecting($this->ra_natureza, $sWhereWrk); // Call Lookup Selecting
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
		$this->ra_comprovante->ViewCustomAttributes = "";

			// ra_exercicio
			$this->ra_exercicio->LinkCustomAttributes = "";
			$this->ra_exercicio->HrefValue = "";
			$this->ra_exercicio->TooltipValue = "";

			// ra_data_cadastro
			$this->ra_data_cadastro->LinkCustomAttributes = "";
			$this->ra_data_cadastro->HrefValue = "";
			$this->ra_data_cadastro->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// ra_exercicio
			$this->ra_exercicio->EditAttrs["class"] = "form-control";
			$this->ra_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->ra_exercicio->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->ra_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$this->ra_exercicio->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ra_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ra_exercicio->EditValue = $arwrk;

			// ra_data_cadastro
			// ra_data_pagamento

			$this->ra_data_pagamento->EditAttrs["class"] = "form-control";
			$this->ra_data_pagamento->EditCustomAttributes = "";
			$this->ra_data_pagamento->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ra_data_pagamento->CurrentValue, 7));
			$this->ra_data_pagamento->PlaceHolder = ew_RemoveHtml($this->ra_data_pagamento->FldCaption());

			// ra_especificacoes
			$this->ra_especificacoes->EditAttrs["class"] = "form-control";
			$this->ra_especificacoes->EditCustomAttributes = "";
			$this->ra_especificacoes->EditValue = ew_HtmlEncode($this->ra_especificacoes->CurrentValue);
			$this->ra_especificacoes->PlaceHolder = ew_RemoveHtml($this->ra_especificacoes->FldCaption());

			// ra_identificador
			$this->ra_identificador->EditAttrs["class"] = "form-control";
			$this->ra_identificador->EditCustomAttributes = "";
			if (trim(strval($this->ra_identificador->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->ra_identificador->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_rhpessoas`";
			$sWhereWrk = "";
			$this->ra_identificador->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ra_identificador, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ra_identificador->EditValue = $arwrk;

			// ra_plano
			$this->ra_plano->EditAttrs["class"] = "form-control";
			$this->ra_plano->EditCustomAttributes = "";
			$this->ra_plano->EditValue = ew_HtmlEncode($this->ra_plano->CurrentValue);
			$this->ra_plano->PlaceHolder = ew_RemoveHtml($this->ra_plano->FldCaption());

			// ra_natureza
			$this->ra_natureza->EditAttrs["class"] = "form-control";
			$this->ra_natureza->EditCustomAttributes = "";
			if (trim(strval($this->ra_natureza->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ran_id`" . ew_SearchString("=", $this->ra_natureza->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ran_id`, `ran_descricao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_ra_natureza`";
			$sWhereWrk = "";
			$this->ra_natureza->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->ra_natureza, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->ra_natureza->EditValue = $arwrk;

			// ra_valor
			$this->ra_valor->EditAttrs["class"] = "form-control";
			$this->ra_valor->EditCustomAttributes = "";
			$this->ra_valor->EditValue = ew_HtmlEncode($this->ra_valor->CurrentValue);
			$this->ra_valor->PlaceHolder = ew_RemoveHtml($this->ra_valor->FldCaption());
			if (strval($this->ra_valor->EditValue) <> "" && is_numeric($this->ra_valor->EditValue)) $this->ra_valor->EditValue = ew_FormatNumber($this->ra_valor->EditValue, -2, -1, -2, -2);

			// ra_comprovante
			$this->ra_comprovante->EditAttrs["class"] = "form-control";
			$this->ra_comprovante->EditCustomAttributes = "";
			$this->ra_comprovante->EditValue = ew_HtmlEncode($this->ra_comprovante->CurrentValue);
			$this->ra_comprovante->PlaceHolder = ew_RemoveHtml($this->ra_comprovante->FldCaption());

			// Edit refer script
			// ra_exercicio

			$this->ra_exercicio->LinkCustomAttributes = "";
			$this->ra_exercicio->HrefValue = "";

			// ra_data_cadastro
			$this->ra_data_cadastro->LinkCustomAttributes = "";
			$this->ra_data_cadastro->HrefValue = "";

			// ra_data_pagamento
			$this->ra_data_pagamento->LinkCustomAttributes = "";
			$this->ra_data_pagamento->HrefValue = "";

			// ra_especificacoes
			$this->ra_especificacoes->LinkCustomAttributes = "";
			$this->ra_especificacoes->HrefValue = "";

			// ra_identificador
			$this->ra_identificador->LinkCustomAttributes = "";
			$this->ra_identificador->HrefValue = "";

			// ra_plano
			$this->ra_plano->LinkCustomAttributes = "";
			$this->ra_plano->HrefValue = "";

			// ra_natureza
			$this->ra_natureza->LinkCustomAttributes = "";
			$this->ra_natureza->HrefValue = "";

			// ra_valor
			$this->ra_valor->LinkCustomAttributes = "";
			$this->ra_valor->HrefValue = "";

			// ra_comprovante
			$this->ra_comprovante->LinkCustomAttributes = "";
			$this->ra_comprovante->HrefValue = "";
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
		if (!$this->ra_exercicio->FldIsDetailKey && !is_null($this->ra_exercicio->FormValue) && $this->ra_exercicio->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_exercicio->FldCaption(), $this->ra_exercicio->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->ra_data_pagamento->FormValue)) {
			ew_AddMessage($gsFormError, $this->ra_data_pagamento->FldErrMsg());
		}
		if (!$this->ra_especificacoes->FldIsDetailKey && !is_null($this->ra_especificacoes->FormValue) && $this->ra_especificacoes->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_especificacoes->FldCaption(), $this->ra_especificacoes->ReqErrMsg));
		}
		if (!$this->ra_identificador->FldIsDetailKey && !is_null($this->ra_identificador->FormValue) && $this->ra_identificador->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_identificador->FldCaption(), $this->ra_identificador->ReqErrMsg));
		}
		if (!$this->ra_natureza->FldIsDetailKey && !is_null($this->ra_natureza->FormValue) && $this->ra_natureza->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_natureza->FldCaption(), $this->ra_natureza->ReqErrMsg));
		}
		if (!$this->ra_valor->FldIsDetailKey && !is_null($this->ra_valor->FormValue) && $this->ra_valor->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_valor->FldCaption(), $this->ra_valor->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->ra_valor->FormValue)) {
			ew_AddMessage($gsFormError, $this->ra_valor->FldErrMsg());
		}
		if (!$this->ra_comprovante->FldIsDetailKey && !is_null($this->ra_comprovante->FormValue) && $this->ra_comprovante->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ra_comprovante->FldCaption(), $this->ra_comprovante->ReqErrMsg));
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// ra_exercicio
			$this->ra_exercicio->SetDbValueDef($rsnew, $this->ra_exercicio->CurrentValue, 0, $this->ra_exercicio->ReadOnly);

			// ra_data_cadastro
			$this->ra_data_cadastro->SetDbValueDef($rsnew, ew_CurrentDate(), ew_CurrentDate());
			$rsnew['ra_data_cadastro'] = &$this->ra_data_cadastro->DbValue;

			// ra_data_pagamento
			$this->ra_data_pagamento->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ra_data_pagamento->CurrentValue, 7), NULL, $this->ra_data_pagamento->ReadOnly);

			// ra_especificacoes
			$this->ra_especificacoes->SetDbValueDef($rsnew, $this->ra_especificacoes->CurrentValue, "", $this->ra_especificacoes->ReadOnly);

			// ra_identificador
			$this->ra_identificador->SetDbValueDef($rsnew, $this->ra_identificador->CurrentValue, 0, $this->ra_identificador->ReadOnly);

			// ra_plano
			$this->ra_plano->SetDbValueDef($rsnew, $this->ra_plano->CurrentValue, NULL, $this->ra_plano->ReadOnly);

			// ra_natureza
			$this->ra_natureza->SetDbValueDef($rsnew, $this->ra_natureza->CurrentValue, NULL, $this->ra_natureza->ReadOnly);

			// ra_valor
			$this->ra_valor->SetDbValueDef($rsnew, $this->ra_valor->CurrentValue, 0, $this->ra_valor->ReadOnly);

			// ra_comprovante
			$this->ra_comprovante->SetDbValueDef($rsnew, $this->ra_comprovante->CurrentValue, "", $this->ra_comprovante->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recurso_aplicadoslist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_ra_exercicio":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ano_ano` AS `LinkFld`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ano_ano` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ra_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_ra_identificador":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `rhp_id` AS `LinkFld`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`rhp_id` IN ({filter_value})', "t0" => "20", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ra_identificador, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_ra_natureza":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ran_id` AS `LinkFld`, `ran_descricao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_ra_natureza`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ran_id` IN ({filter_value})', "t0" => "20", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->ra_natureza, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($rc25_a_recurso_aplicados_edit)) $rc25_a_recurso_aplicados_edit = new crc25_a_recurso_aplicados_edit();

// Page init
$rc25_a_recurso_aplicados_edit->Page_Init();

// Page main
$rc25_a_recurso_aplicados_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recurso_aplicados_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = frc25_a_recurso_aplicadosedit = new ew_Form("frc25_a_recurso_aplicadosedit", "edit");

// Validate form
frc25_a_recurso_aplicadosedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_ra_exercicio");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_exercicio->FldCaption(), $rc25_a_recurso_aplicados->ra_exercicio->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ra_data_pagamento");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_recurso_aplicados->ra_data_pagamento->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ra_especificacoes");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_especificacoes->FldCaption(), $rc25_a_recurso_aplicados->ra_especificacoes->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ra_identificador");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_identificador->FldCaption(), $rc25_a_recurso_aplicados->ra_identificador->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ra_natureza");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_natureza->FldCaption(), $rc25_a_recurso_aplicados->ra_natureza->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ra_valor");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_valor->FldCaption(), $rc25_a_recurso_aplicados->ra_valor->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ra_valor");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_recurso_aplicados->ra_valor->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_ra_comprovante");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recurso_aplicados->ra_comprovante->FldCaption(), $rc25_a_recurso_aplicados->ra_comprovante->ReqErrMsg)) ?>");

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
frc25_a_recurso_aplicadosedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recurso_aplicadosedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recurso_aplicadosedit.Lists["x_ra_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recurso_aplicadosedit.Lists["x_ra_exercicio"].Data = "<?php echo $rc25_a_recurso_aplicados_edit->ra_exercicio->LookupFilterQuery(FALSE, "edit") ?>";
frc25_a_recurso_aplicadosedit.Lists["x_ra_identificador"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recurso_aplicadosedit.Lists["x_ra_identificador"].Data = "<?php echo $rc25_a_recurso_aplicados_edit->ra_identificador->LookupFilterQuery(FALSE, "edit") ?>";
frc25_a_recurso_aplicadosedit.Lists["x_ra_natureza"] = {"LinkField":"x_ran_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_ran_descricao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_ra_natureza"};
frc25_a_recurso_aplicadosedit.Lists["x_ra_natureza"].Data = "<?php echo $rc25_a_recurso_aplicados_edit->ra_natureza->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_recurso_aplicados_edit->ShowPageHeader(); ?>
<?php
$rc25_a_recurso_aplicados_edit->ShowMessage();
?>
<?php if (!$rc25_a_recurso_aplicados_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recurso_aplicados_edit->Pager)) $rc25_a_recurso_aplicados_edit->Pager = new cPrevNextPager($rc25_a_recurso_aplicados_edit->StartRec, $rc25_a_recurso_aplicados_edit->DisplayRecs, $rc25_a_recurso_aplicados_edit->TotalRecs, $rc25_a_recurso_aplicados_edit->AutoHidePager) ?>
<?php if ($rc25_a_recurso_aplicados_edit->Pager->RecordCount > 0 && $rc25_a_recurso_aplicados_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recurso_aplicados_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_recurso_aplicadosedit" id="frc25_a_recurso_aplicadosedit" class="<?php echo $rc25_a_recurso_aplicados_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recurso_aplicados_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recurso_aplicados_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recurso_aplicados">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_recurso_aplicados_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($rc25_a_recurso_aplicados->ra_exercicio->Visible) { // ra_exercicio ?>
	<div id="r_ra_exercicio" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_exercicio" for="x_ra_exercicio" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_exercicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_exercicio">
<select data-table="rc25_a_recurso_aplicados" data-field="x_ra_exercicio" data-value-separator="<?php echo $rc25_a_recurso_aplicados->ra_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_ra_exercicio" name="x_ra_exercicio"<?php echo $rc25_a_recurso_aplicados->ra_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_exercicio->SelectOptionListHtml("x_ra_exercicio") ?>
</select>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_exercicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_data_pagamento->Visible) { // ra_data_pagamento ?>
	<div id="r_ra_data_pagamento" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_data_pagamento" for="x_ra_data_pagamento" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_data_pagamento">
<input type="text" data-table="rc25_a_recurso_aplicados" data-field="x_ra_data_pagamento" data-format="7" name="x_ra_data_pagamento" id="x_ra_data_pagamento" placeholder="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_data_pagamento->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->EditValue ?>"<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->EditAttributes() ?>>
<?php if (!$rc25_a_recurso_aplicados->ra_data_pagamento->ReadOnly && !$rc25_a_recurso_aplicados->ra_data_pagamento->Disabled && !isset($rc25_a_recurso_aplicados->ra_data_pagamento->EditAttrs["readonly"]) && !isset($rc25_a_recurso_aplicados->ra_data_pagamento->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_a_recurso_aplicadosedit", "x_ra_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_especificacoes->Visible) { // ra_especificacoes ?>
	<div id="r_ra_especificacoes" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_especificacoes" for="x_ra_especificacoes" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_especificacoes->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_especificacoes">
<input type="text" data-table="rc25_a_recurso_aplicados" data-field="x_ra_especificacoes" name="x_ra_especificacoes" id="x_ra_especificacoes" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_especificacoes->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->EditValue ?>"<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_identificador->Visible) { // ra_identificador ?>
	<div id="r_ra_identificador" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_identificador" for="x_ra_identificador" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_identificador->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_identificador->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_identificador">
<select data-table="rc25_a_recurso_aplicados" data-field="x_ra_identificador" data-value-separator="<?php echo $rc25_a_recurso_aplicados->ra_identificador->DisplayValueSeparatorAttribute() ?>" id="x_ra_identificador" name="x_ra_identificador"<?php echo $rc25_a_recurso_aplicados->ra_identificador->EditAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_identificador->SelectOptionListHtml("x_ra_identificador") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_recurso_aplicados->ra_identificador->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_ra_identificador',url:'rc25_a_rhpessoasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_ra_identificador"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados->ra_identificador->FldCaption() ?></span></button>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_identificador->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_plano->Visible) { // ra_plano ?>
	<div id="r_ra_plano" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_plano" for="x_ra_plano" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_plano->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_plano->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_plano">
<input type="text" data-table="rc25_a_recurso_aplicados" data-field="x_ra_plano" name="x_ra_plano" id="x_ra_plano" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_plano->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recurso_aplicados->ra_plano->EditValue ?>"<?php echo $rc25_a_recurso_aplicados->ra_plano->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_plano->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_natureza->Visible) { // ra_natureza ?>
	<div id="r_ra_natureza" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_natureza" for="x_ra_natureza" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_natureza->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_natureza->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_natureza">
<select data-table="rc25_a_recurso_aplicados" data-field="x_ra_natureza" data-value-separator="<?php echo $rc25_a_recurso_aplicados->ra_natureza->DisplayValueSeparatorAttribute() ?>" id="x_ra_natureza" name="x_ra_natureza"<?php echo $rc25_a_recurso_aplicados->ra_natureza->EditAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_natureza->SelectOptionListHtml("x_ra_natureza") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_recurso_aplicados->ra_natureza->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_ra_natureza',url:'rc25_a_ra_naturezaaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_ra_natureza"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados->ra_natureza->FldCaption() ?></span></button>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_natureza->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_valor->Visible) { // ra_valor ?>
	<div id="r_ra_valor" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_valor" for="x_ra_valor" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_valor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_valor->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_valor">
<input type="text" data-table="rc25_a_recurso_aplicados" data-field="x_ra_valor" name="x_ra_valor" id="x_ra_valor" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_valor->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recurso_aplicados->ra_valor->EditValue ?>"<?php echo $rc25_a_recurso_aplicados->ra_valor->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_comprovante->Visible) { // ra_comprovante ?>
	<div id="r_ra_comprovante" class="form-group">
		<label id="elh_rc25_a_recurso_aplicados_ra_comprovante" for="x_ra_comprovante" class="<?php echo $rc25_a_recurso_aplicados_edit->LeftColumnClass ?>"><?php echo $rc25_a_recurso_aplicados->ra_comprovante->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recurso_aplicados_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recurso_aplicados->ra_comprovante->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_comprovante">
<input type="text" data-table="rc25_a_recurso_aplicados" data-field="x_ra_comprovante" name="x_ra_comprovante" id="x_ra_comprovante" size="30" maxlength="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_comprovante->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recurso_aplicados->ra_comprovante->EditValue ?>"<?php echo $rc25_a_recurso_aplicados->ra_comprovante->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recurso_aplicados->ra_comprovante->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<input type="hidden" data-table="rc25_a_recurso_aplicados" data-field="x_ra_id" name="x_ra_id" id="x_ra_id" value="<?php echo ew_HtmlEncode($rc25_a_recurso_aplicados->ra_id->CurrentValue) ?>">
<?php if (!$rc25_a_recurso_aplicados_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_recurso_aplicados_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_recurso_aplicados_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$rc25_a_recurso_aplicados_edit->IsModal) { ?>
<?php if (!isset($rc25_a_recurso_aplicados_edit->Pager)) $rc25_a_recurso_aplicados_edit->Pager = new cPrevNextPager($rc25_a_recurso_aplicados_edit->StartRec, $rc25_a_recurso_aplicados_edit->DisplayRecs, $rc25_a_recurso_aplicados_edit->TotalRecs, $rc25_a_recurso_aplicados_edit->AutoHidePager) ?>
<?php if ($rc25_a_recurso_aplicados_edit->Pager->RecordCount > 0 && $rc25_a_recurso_aplicados_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recurso_aplicados_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recurso_aplicados_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recurso_aplicados_edit->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_recurso_aplicadosedit.Init();
</script>
<?php
$rc25_a_recurso_aplicados_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recurso_aplicados_edit->Page_Terminate();
?>
