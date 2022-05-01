<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_recursos_humanosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_recursos_humanos_edit = NULL; // Initialize page object first

class crc25_a_recursos_humanos_edit extends crc25_a_recursos_humanos {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recursos_humanos';

	// Page object name
	var $PageObjName = 'rc25_a_recursos_humanos_edit';

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

		// Table object (rc25_a_recursos_humanos)
		if (!isset($GLOBALS["rc25_a_recursos_humanos"]) || get_class($GLOBALS["rc25_a_recursos_humanos"]) == "crc25_a_recursos_humanos") {
			$GLOBALS["rc25_a_recursos_humanos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recursos_humanos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_recursos_humanos', TRUE);

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
		$this->rh_exercicio->SetVisibility();
		$this->rh_pg_recurso_publico->SetVisibility();
		$this->rh_terceirizado->SetVisibility();
		$this->rh_nome->SetVisibility();
		$this->rh_funcao->SetVisibility();
		$this->rh_escolaridade->SetVisibility();
		$this->rh_sala_turma->SetVisibility();
		$this->rh_carga_horaria_semanal->SetVisibility();
		$this->rh_remuneracao->SetVisibility();
		$this->rh_hora_entra_i->SetVisibility();
		$this->rh_hora_saida_i->SetVisibility();
		$this->rh_hora_entra_ii->SetVisibility();
		$this->rh_hora_saida_ii->SetVisibility();
		$this->rh_data_cadastro->SetVisibility();

		// Set up multi page object
		$this->SetupMultiPages();

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
		global $EW_EXPORT, $rc25_a_recursos_humanos;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_recursos_humanos);
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
					if ($pageName == "rc25_a_recursos_humanosview.php")
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
	var $MultiPages; // Multi pages object

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
			if ($objForm->HasValue("x_rh_id")) {
				$this->rh_id->setFormValue($objForm->GetValue("x_rh_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["rh_id"])) {
				$this->rh_id->setQueryStringValue($_GET["rh_id"]);
				$loadByQuery = TRUE;
			} else {
				$this->rh_id->CurrentValue = NULL;
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
			$this->Page_Terminate("rc25_a_recursos_humanoslist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->SetupStartRec(); // Set up start record position

			// Point to current record
			if (intval($this->StartRec) <= intval($this->TotalRecs)) {
				$this->Recordset->Move($this->StartRec-1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if (!is_null($this->rh_id->CurrentValue)) {
				while (!$this->Recordset->EOF) {
					if (strval($this->rh_id->CurrentValue) == strval($this->Recordset->fields('rh_id'))) {
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
					$this->Page_Terminate("rc25_a_recursos_humanoslist.php"); // Return to list page
				} else {
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "rc25_a_recursos_humanoslist.php")
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
		if (!$this->rh_exercicio->FldIsDetailKey) {
			$this->rh_exercicio->setFormValue($objForm->GetValue("x_rh_exercicio"));
		}
		if (!$this->rh_pg_recurso_publico->FldIsDetailKey) {
			$this->rh_pg_recurso_publico->setFormValue($objForm->GetValue("x_rh_pg_recurso_publico"));
		}
		if (!$this->rh_terceirizado->FldIsDetailKey) {
			$this->rh_terceirizado->setFormValue($objForm->GetValue("x_rh_terceirizado"));
		}
		if (!$this->rh_nome->FldIsDetailKey) {
			$this->rh_nome->setFormValue($objForm->GetValue("x_rh_nome"));
		}
		if (!$this->rh_funcao->FldIsDetailKey) {
			$this->rh_funcao->setFormValue($objForm->GetValue("x_rh_funcao"));
		}
		if (!$this->rh_escolaridade->FldIsDetailKey) {
			$this->rh_escolaridade->setFormValue($objForm->GetValue("x_rh_escolaridade"));
		}
		if (!$this->rh_sala_turma->FldIsDetailKey) {
			$this->rh_sala_turma->setFormValue($objForm->GetValue("x_rh_sala_turma"));
		}
		if (!$this->rh_carga_horaria_semanal->FldIsDetailKey) {
			$this->rh_carga_horaria_semanal->setFormValue($objForm->GetValue("x_rh_carga_horaria_semanal"));
		}
		if (!$this->rh_remuneracao->FldIsDetailKey) {
			$this->rh_remuneracao->setFormValue($objForm->GetValue("x_rh_remuneracao"));
		}
		if (!$this->rh_hora_entra_i->FldIsDetailKey) {
			$this->rh_hora_entra_i->setFormValue($objForm->GetValue("x_rh_hora_entra_i"));
		}
		if (!$this->rh_hora_saida_i->FldIsDetailKey) {
			$this->rh_hora_saida_i->setFormValue($objForm->GetValue("x_rh_hora_saida_i"));
		}
		if (!$this->rh_hora_entra_ii->FldIsDetailKey) {
			$this->rh_hora_entra_ii->setFormValue($objForm->GetValue("x_rh_hora_entra_ii"));
		}
		if (!$this->rh_hora_saida_ii->FldIsDetailKey) {
			$this->rh_hora_saida_ii->setFormValue($objForm->GetValue("x_rh_hora_saida_ii"));
		}
		if (!$this->rh_data_cadastro->FldIsDetailKey) {
			$this->rh_data_cadastro->setFormValue($objForm->GetValue("x_rh_data_cadastro"));
			$this->rh_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->rh_data_cadastro->CurrentValue, 7);
		}
		if (!$this->rh_id->FldIsDetailKey)
			$this->rh_id->setFormValue($objForm->GetValue("x_rh_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->rh_id->CurrentValue = $this->rh_id->FormValue;
		$this->rh_exercicio->CurrentValue = $this->rh_exercicio->FormValue;
		$this->rh_pg_recurso_publico->CurrentValue = $this->rh_pg_recurso_publico->FormValue;
		$this->rh_terceirizado->CurrentValue = $this->rh_terceirizado->FormValue;
		$this->rh_nome->CurrentValue = $this->rh_nome->FormValue;
		$this->rh_funcao->CurrentValue = $this->rh_funcao->FormValue;
		$this->rh_escolaridade->CurrentValue = $this->rh_escolaridade->FormValue;
		$this->rh_sala_turma->CurrentValue = $this->rh_sala_turma->FormValue;
		$this->rh_carga_horaria_semanal->CurrentValue = $this->rh_carga_horaria_semanal->FormValue;
		$this->rh_remuneracao->CurrentValue = $this->rh_remuneracao->FormValue;
		$this->rh_hora_entra_i->CurrentValue = $this->rh_hora_entra_i->FormValue;
		$this->rh_hora_saida_i->CurrentValue = $this->rh_hora_saida_i->FormValue;
		$this->rh_hora_entra_ii->CurrentValue = $this->rh_hora_entra_ii->FormValue;
		$this->rh_hora_saida_ii->CurrentValue = $this->rh_hora_saida_ii->FormValue;
		$this->rh_data_cadastro->CurrentValue = $this->rh_data_cadastro->FormValue;
		$this->rh_data_cadastro->CurrentValue = ew_UnFormatDateTime($this->rh_data_cadastro->CurrentValue, 7);
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
		$this->rh_id->setDbValue($row['rh_id']);
		$this->rh_exercicio->setDbValue($row['rh_exercicio']);
		$this->rh_pg_recurso_publico->setDbValue($row['rh_pg_recurso_publico']);
		$this->rh_terceirizado->setDbValue($row['rh_terceirizado']);
		$this->rh_nome->setDbValue($row['rh_nome']);
		$this->rh_funcao->setDbValue($row['rh_funcao']);
		$this->rh_escolaridade->setDbValue($row['rh_escolaridade']);
		$this->rh_sala_turma->setDbValue($row['rh_sala_turma']);
		$this->rh_carga_horaria_semanal->setDbValue($row['rh_carga_horaria_semanal']);
		$this->rh_remuneracao->setDbValue($row['rh_remuneracao']);
		$this->rh_hora_entra_i->setDbValue($row['rh_hora_entra_i']);
		$this->rh_hora_saida_i->setDbValue($row['rh_hora_saida_i']);
		$this->rh_hora_entra_ii->setDbValue($row['rh_hora_entra_ii']);
		$this->rh_hora_saida_ii->setDbValue($row['rh_hora_saida_ii']);
		$this->rh_data_cadastro->setDbValue($row['rh_data_cadastro']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['rh_id'] = NULL;
		$row['rh_exercicio'] = NULL;
		$row['rh_pg_recurso_publico'] = NULL;
		$row['rh_terceirizado'] = NULL;
		$row['rh_nome'] = NULL;
		$row['rh_funcao'] = NULL;
		$row['rh_escolaridade'] = NULL;
		$row['rh_sala_turma'] = NULL;
		$row['rh_carga_horaria_semanal'] = NULL;
		$row['rh_remuneracao'] = NULL;
		$row['rh_hora_entra_i'] = NULL;
		$row['rh_hora_saida_i'] = NULL;
		$row['rh_hora_entra_ii'] = NULL;
		$row['rh_hora_saida_ii'] = NULL;
		$row['rh_data_cadastro'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rh_id->DbValue = $row['rh_id'];
		$this->rh_exercicio->DbValue = $row['rh_exercicio'];
		$this->rh_pg_recurso_publico->DbValue = $row['rh_pg_recurso_publico'];
		$this->rh_terceirizado->DbValue = $row['rh_terceirizado'];
		$this->rh_nome->DbValue = $row['rh_nome'];
		$this->rh_funcao->DbValue = $row['rh_funcao'];
		$this->rh_escolaridade->DbValue = $row['rh_escolaridade'];
		$this->rh_sala_turma->DbValue = $row['rh_sala_turma'];
		$this->rh_carga_horaria_semanal->DbValue = $row['rh_carga_horaria_semanal'];
		$this->rh_remuneracao->DbValue = $row['rh_remuneracao'];
		$this->rh_hora_entra_i->DbValue = $row['rh_hora_entra_i'];
		$this->rh_hora_saida_i->DbValue = $row['rh_hora_saida_i'];
		$this->rh_hora_entra_ii->DbValue = $row['rh_hora_entra_ii'];
		$this->rh_hora_saida_ii->DbValue = $row['rh_hora_saida_ii'];
		$this->rh_data_cadastro->DbValue = $row['rh_data_cadastro'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("rh_id")) <> "")
			$this->rh_id->CurrentValue = $this->getKey("rh_id"); // rh_id
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

		if ($this->rh_remuneracao->FormValue == $this->rh_remuneracao->CurrentValue && is_numeric(ew_StrToFloat($this->rh_remuneracao->CurrentValue)))
			$this->rh_remuneracao->CurrentValue = ew_StrToFloat($this->rh_remuneracao->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// rh_id
		// rh_exercicio
		// rh_pg_recurso_publico
		// rh_terceirizado
		// rh_nome
		// rh_funcao
		// rh_escolaridade
		// rh_sala_turma
		// rh_carga_horaria_semanal
		// rh_remuneracao
		// rh_hora_entra_i
		// rh_hora_saida_i
		// rh_hora_entra_ii
		// rh_hora_saida_ii
		// rh_data_cadastro

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rh_exercicio
		if (strval($this->rh_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->rh_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->rh_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rh_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rh_exercicio->ViewValue = $this->rh_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rh_exercicio->ViewValue = $this->rh_exercicio->CurrentValue;
			}
		} else {
			$this->rh_exercicio->ViewValue = NULL;
		}
		$this->rh_exercicio->ViewCustomAttributes = "";

		// rh_pg_recurso_publico
		if (strval($this->rh_pg_recurso_publico->CurrentValue) <> "") {
			$this->rh_pg_recurso_publico->ViewValue = $this->rh_pg_recurso_publico->OptionCaption($this->rh_pg_recurso_publico->CurrentValue);
		} else {
			$this->rh_pg_recurso_publico->ViewValue = NULL;
		}
		$this->rh_pg_recurso_publico->ViewCustomAttributes = "";

		// rh_terceirizado
		if (strval($this->rh_terceirizado->CurrentValue) <> "") {
			$this->rh_terceirizado->ViewValue = $this->rh_terceirizado->OptionCaption($this->rh_terceirizado->CurrentValue);
		} else {
			$this->rh_terceirizado->ViewValue = NULL;
		}
		$this->rh_terceirizado->ViewCustomAttributes = "";

		// rh_nome
		if (strval($this->rh_nome->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->rh_nome->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->rh_nome->LookupFilters = array();
		$lookuptblfilter = "`rhp_fis_jur`=0";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rh_nome, $sWhereWrk); // Call Lookup Selecting
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
		$this->Lookup_Selecting($this->rh_funcao, $sWhereWrk); // Call Lookup Selecting
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

		// rh_escolaridade
		$this->rh_escolaridade->ViewValue = $this->rh_escolaridade->CurrentValue;
		$this->rh_escolaridade->ViewCustomAttributes = "";

		// rh_sala_turma
		$this->rh_sala_turma->ViewValue = $this->rh_sala_turma->CurrentValue;
		$this->rh_sala_turma->ViewCustomAttributes = "";

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->ViewValue = $this->rh_carga_horaria_semanal->CurrentValue;
		$this->rh_carga_horaria_semanal->ViewCustomAttributes = "";

		// rh_remuneracao
		$this->rh_remuneracao->ViewValue = $this->rh_remuneracao->CurrentValue;
		$this->rh_remuneracao->ViewCustomAttributes = "";

		// rh_hora_entra_i
		$this->rh_hora_entra_i->ViewValue = $this->rh_hora_entra_i->CurrentValue;
		$this->rh_hora_entra_i->ViewCustomAttributes = "";

		// rh_hora_saida_i
		$this->rh_hora_saida_i->ViewValue = $this->rh_hora_saida_i->CurrentValue;
		$this->rh_hora_saida_i->ViewCustomAttributes = "";

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->ViewValue = $this->rh_hora_entra_ii->CurrentValue;
		$this->rh_hora_entra_ii->ViewCustomAttributes = "";

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->ViewValue = $this->rh_hora_saida_ii->CurrentValue;
		$this->rh_hora_saida_ii->ViewCustomAttributes = "";

		// rh_data_cadastro
		$this->rh_data_cadastro->ViewValue = $this->rh_data_cadastro->CurrentValue;
		$this->rh_data_cadastro->ViewValue = ew_FormatDateTime($this->rh_data_cadastro->ViewValue, 7);
		$this->rh_data_cadastro->ViewCustomAttributes = "";

			// rh_exercicio
			$this->rh_exercicio->LinkCustomAttributes = "";
			$this->rh_exercicio->HrefValue = "";
			$this->rh_exercicio->TooltipValue = "";

			// rh_pg_recurso_publico
			$this->rh_pg_recurso_publico->LinkCustomAttributes = "";
			$this->rh_pg_recurso_publico->HrefValue = "";
			$this->rh_pg_recurso_publico->TooltipValue = "";

			// rh_terceirizado
			$this->rh_terceirizado->LinkCustomAttributes = "";
			$this->rh_terceirizado->HrefValue = "";
			$this->rh_terceirizado->TooltipValue = "";

			// rh_nome
			$this->rh_nome->LinkCustomAttributes = "";
			$this->rh_nome->HrefValue = "";
			$this->rh_nome->TooltipValue = "";

			// rh_funcao
			$this->rh_funcao->LinkCustomAttributes = "";
			$this->rh_funcao->HrefValue = "";
			$this->rh_funcao->TooltipValue = "";

			// rh_escolaridade
			$this->rh_escolaridade->LinkCustomAttributes = "";
			$this->rh_escolaridade->HrefValue = "";
			$this->rh_escolaridade->TooltipValue = "";

			// rh_sala_turma
			$this->rh_sala_turma->LinkCustomAttributes = "";
			$this->rh_sala_turma->HrefValue = "";
			$this->rh_sala_turma->TooltipValue = "";

			// rh_carga_horaria_semanal
			$this->rh_carga_horaria_semanal->LinkCustomAttributes = "";
			$this->rh_carga_horaria_semanal->HrefValue = "";
			$this->rh_carga_horaria_semanal->TooltipValue = "";

			// rh_remuneracao
			$this->rh_remuneracao->LinkCustomAttributes = "";
			$this->rh_remuneracao->HrefValue = "";
			$this->rh_remuneracao->TooltipValue = "";

			// rh_hora_entra_i
			$this->rh_hora_entra_i->LinkCustomAttributes = "";
			$this->rh_hora_entra_i->HrefValue = "";
			$this->rh_hora_entra_i->TooltipValue = "";

			// rh_hora_saida_i
			$this->rh_hora_saida_i->LinkCustomAttributes = "";
			$this->rh_hora_saida_i->HrefValue = "";
			$this->rh_hora_saida_i->TooltipValue = "";

			// rh_hora_entra_ii
			$this->rh_hora_entra_ii->LinkCustomAttributes = "";
			$this->rh_hora_entra_ii->HrefValue = "";
			$this->rh_hora_entra_ii->TooltipValue = "";

			// rh_hora_saida_ii
			$this->rh_hora_saida_ii->LinkCustomAttributes = "";
			$this->rh_hora_saida_ii->HrefValue = "";
			$this->rh_hora_saida_ii->TooltipValue = "";

			// rh_data_cadastro
			$this->rh_data_cadastro->LinkCustomAttributes = "";
			$this->rh_data_cadastro->HrefValue = "";
			$this->rh_data_cadastro->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// rh_exercicio
			$this->rh_exercicio->EditAttrs["class"] = "form-control";
			$this->rh_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->rh_exercicio->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->rh_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$this->rh_exercicio->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->rh_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->rh_exercicio->EditValue = $arwrk;

			// rh_pg_recurso_publico
			$this->rh_pg_recurso_publico->EditCustomAttributes = "";
			$this->rh_pg_recurso_publico->EditValue = $this->rh_pg_recurso_publico->Options(FALSE);

			// rh_terceirizado
			$this->rh_terceirizado->EditCustomAttributes = "";
			$this->rh_terceirizado->EditValue = $this->rh_terceirizado->Options(FALSE);

			// rh_nome
			$this->rh_nome->EditAttrs["class"] = "form-control";
			$this->rh_nome->EditCustomAttributes = "";
			if (trim(strval($this->rh_nome->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->rh_nome->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_rhpessoas`";
			$sWhereWrk = "";
			$this->rh_nome->LookupFilters = array();
			$lookuptblfilter = "`rhp_fis_jur`=0";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->rh_nome, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->rh_nome->EditValue = $arwrk;

			// rh_funcao
			$this->rh_funcao->EditAttrs["class"] = "form-control";
			$this->rh_funcao->EditCustomAttributes = "";
			if (trim(strval($this->rh_funcao->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`rhf_id`" . ew_SearchString("=", $this->rh_funcao->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `rhf_id`, `rhf_funcao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_rhfuncoes`";
			$sWhereWrk = "";
			$this->rh_funcao->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->rh_funcao, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->rh_funcao->EditValue = $arwrk;

			// rh_escolaridade
			$this->rh_escolaridade->EditAttrs["class"] = "form-control";
			$this->rh_escolaridade->EditCustomAttributes = "";
			$this->rh_escolaridade->EditValue = ew_HtmlEncode($this->rh_escolaridade->CurrentValue);
			$this->rh_escolaridade->PlaceHolder = ew_RemoveHtml($this->rh_escolaridade->FldCaption());

			// rh_sala_turma
			$this->rh_sala_turma->EditAttrs["class"] = "form-control";
			$this->rh_sala_turma->EditCustomAttributes = "";
			$this->rh_sala_turma->EditValue = ew_HtmlEncode($this->rh_sala_turma->CurrentValue);
			$this->rh_sala_turma->PlaceHolder = ew_RemoveHtml($this->rh_sala_turma->FldCaption());

			// rh_carga_horaria_semanal
			$this->rh_carga_horaria_semanal->EditAttrs["class"] = "form-control";
			$this->rh_carga_horaria_semanal->EditCustomAttributes = "";
			$this->rh_carga_horaria_semanal->EditValue = ew_HtmlEncode($this->rh_carga_horaria_semanal->CurrentValue);
			$this->rh_carga_horaria_semanal->PlaceHolder = ew_RemoveHtml($this->rh_carga_horaria_semanal->FldCaption());

			// rh_remuneracao
			$this->rh_remuneracao->EditAttrs["class"] = "form-control";
			$this->rh_remuneracao->EditCustomAttributes = "";
			$this->rh_remuneracao->EditValue = ew_HtmlEncode($this->rh_remuneracao->CurrentValue);
			$this->rh_remuneracao->PlaceHolder = ew_RemoveHtml($this->rh_remuneracao->FldCaption());
			if (strval($this->rh_remuneracao->EditValue) <> "" && is_numeric($this->rh_remuneracao->EditValue)) $this->rh_remuneracao->EditValue = ew_FormatNumber($this->rh_remuneracao->EditValue, -2, -1, -2, 0);

			// rh_hora_entra_i
			$this->rh_hora_entra_i->EditAttrs["class"] = "form-control";
			$this->rh_hora_entra_i->EditCustomAttributes = "";
			$this->rh_hora_entra_i->EditValue = ew_HtmlEncode($this->rh_hora_entra_i->CurrentValue);
			$this->rh_hora_entra_i->PlaceHolder = ew_RemoveHtml($this->rh_hora_entra_i->FldCaption());

			// rh_hora_saida_i
			$this->rh_hora_saida_i->EditAttrs["class"] = "form-control";
			$this->rh_hora_saida_i->EditCustomAttributes = "";
			$this->rh_hora_saida_i->EditValue = ew_HtmlEncode($this->rh_hora_saida_i->CurrentValue);
			$this->rh_hora_saida_i->PlaceHolder = ew_RemoveHtml($this->rh_hora_saida_i->FldCaption());

			// rh_hora_entra_ii
			$this->rh_hora_entra_ii->EditAttrs["class"] = "form-control";
			$this->rh_hora_entra_ii->EditCustomAttributes = "";
			$this->rh_hora_entra_ii->EditValue = ew_HtmlEncode($this->rh_hora_entra_ii->CurrentValue);
			$this->rh_hora_entra_ii->PlaceHolder = ew_RemoveHtml($this->rh_hora_entra_ii->FldCaption());

			// rh_hora_saida_ii
			$this->rh_hora_saida_ii->EditAttrs["class"] = "form-control";
			$this->rh_hora_saida_ii->EditCustomAttributes = "";
			$this->rh_hora_saida_ii->EditValue = ew_HtmlEncode($this->rh_hora_saida_ii->CurrentValue);
			$this->rh_hora_saida_ii->PlaceHolder = ew_RemoveHtml($this->rh_hora_saida_ii->FldCaption());

			// rh_data_cadastro
			// Edit refer script
			// rh_exercicio

			$this->rh_exercicio->LinkCustomAttributes = "";
			$this->rh_exercicio->HrefValue = "";

			// rh_pg_recurso_publico
			$this->rh_pg_recurso_publico->LinkCustomAttributes = "";
			$this->rh_pg_recurso_publico->HrefValue = "";

			// rh_terceirizado
			$this->rh_terceirizado->LinkCustomAttributes = "";
			$this->rh_terceirizado->HrefValue = "";

			// rh_nome
			$this->rh_nome->LinkCustomAttributes = "";
			$this->rh_nome->HrefValue = "";

			// rh_funcao
			$this->rh_funcao->LinkCustomAttributes = "";
			$this->rh_funcao->HrefValue = "";

			// rh_escolaridade
			$this->rh_escolaridade->LinkCustomAttributes = "";
			$this->rh_escolaridade->HrefValue = "";

			// rh_sala_turma
			$this->rh_sala_turma->LinkCustomAttributes = "";
			$this->rh_sala_turma->HrefValue = "";

			// rh_carga_horaria_semanal
			$this->rh_carga_horaria_semanal->LinkCustomAttributes = "";
			$this->rh_carga_horaria_semanal->HrefValue = "";

			// rh_remuneracao
			$this->rh_remuneracao->LinkCustomAttributes = "";
			$this->rh_remuneracao->HrefValue = "";

			// rh_hora_entra_i
			$this->rh_hora_entra_i->LinkCustomAttributes = "";
			$this->rh_hora_entra_i->HrefValue = "";

			// rh_hora_saida_i
			$this->rh_hora_saida_i->LinkCustomAttributes = "";
			$this->rh_hora_saida_i->HrefValue = "";

			// rh_hora_entra_ii
			$this->rh_hora_entra_ii->LinkCustomAttributes = "";
			$this->rh_hora_entra_ii->HrefValue = "";

			// rh_hora_saida_ii
			$this->rh_hora_saida_ii->LinkCustomAttributes = "";
			$this->rh_hora_saida_ii->HrefValue = "";

			// rh_data_cadastro
			$this->rh_data_cadastro->LinkCustomAttributes = "";
			$this->rh_data_cadastro->HrefValue = "";
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
		if (!$this->rh_exercicio->FldIsDetailKey && !is_null($this->rh_exercicio->FormValue) && $this->rh_exercicio->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rh_exercicio->FldCaption(), $this->rh_exercicio->ReqErrMsg));
		}
		if ($this->rh_pg_recurso_publico->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rh_pg_recurso_publico->FldCaption(), $this->rh_pg_recurso_publico->ReqErrMsg));
		}
		if ($this->rh_terceirizado->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rh_terceirizado->FldCaption(), $this->rh_terceirizado->ReqErrMsg));
		}
		if (!$this->rh_nome->FldIsDetailKey && !is_null($this->rh_nome->FormValue) && $this->rh_nome->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rh_nome->FldCaption(), $this->rh_nome->ReqErrMsg));
		}
		if (!$this->rh_funcao->FldIsDetailKey && !is_null($this->rh_funcao->FormValue) && $this->rh_funcao->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->rh_funcao->FldCaption(), $this->rh_funcao->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->rh_remuneracao->FormValue)) {
			ew_AddMessage($gsFormError, $this->rh_remuneracao->FldErrMsg());
		}
		if (!ew_CheckInteger($this->rh_hora_saida_ii->FormValue)) {
			ew_AddMessage($gsFormError, $this->rh_hora_saida_ii->FldErrMsg());
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

			// rh_exercicio
			$this->rh_exercicio->SetDbValueDef($rsnew, $this->rh_exercicio->CurrentValue, NULL, $this->rh_exercicio->ReadOnly);

			// rh_pg_recurso_publico
			$this->rh_pg_recurso_publico->SetDbValueDef($rsnew, $this->rh_pg_recurso_publico->CurrentValue, NULL, $this->rh_pg_recurso_publico->ReadOnly);

			// rh_terceirizado
			$this->rh_terceirizado->SetDbValueDef($rsnew, $this->rh_terceirizado->CurrentValue, NULL, $this->rh_terceirizado->ReadOnly);

			// rh_nome
			$this->rh_nome->SetDbValueDef($rsnew, $this->rh_nome->CurrentValue, 0, $this->rh_nome->ReadOnly);

			// rh_funcao
			$this->rh_funcao->SetDbValueDef($rsnew, $this->rh_funcao->CurrentValue, NULL, $this->rh_funcao->ReadOnly);

			// rh_escolaridade
			$this->rh_escolaridade->SetDbValueDef($rsnew, $this->rh_escolaridade->CurrentValue, NULL, $this->rh_escolaridade->ReadOnly);

			// rh_sala_turma
			$this->rh_sala_turma->SetDbValueDef($rsnew, $this->rh_sala_turma->CurrentValue, NULL, $this->rh_sala_turma->ReadOnly);

			// rh_carga_horaria_semanal
			$this->rh_carga_horaria_semanal->SetDbValueDef($rsnew, $this->rh_carga_horaria_semanal->CurrentValue, NULL, $this->rh_carga_horaria_semanal->ReadOnly);

			// rh_remuneracao
			$this->rh_remuneracao->SetDbValueDef($rsnew, $this->rh_remuneracao->CurrentValue, NULL, $this->rh_remuneracao->ReadOnly);

			// rh_hora_entra_i
			$this->rh_hora_entra_i->SetDbValueDef($rsnew, $this->rh_hora_entra_i->CurrentValue, NULL, $this->rh_hora_entra_i->ReadOnly);

			// rh_hora_saida_i
			$this->rh_hora_saida_i->SetDbValueDef($rsnew, $this->rh_hora_saida_i->CurrentValue, NULL, $this->rh_hora_saida_i->ReadOnly);

			// rh_hora_entra_ii
			$this->rh_hora_entra_ii->SetDbValueDef($rsnew, $this->rh_hora_entra_ii->CurrentValue, NULL, $this->rh_hora_entra_ii->ReadOnly);

			// rh_hora_saida_ii
			$this->rh_hora_saida_ii->SetDbValueDef($rsnew, $this->rh_hora_saida_ii->CurrentValue, NULL, $this->rh_hora_saida_ii->ReadOnly);

			// rh_data_cadastro
			$this->rh_data_cadastro->SetDbValueDef($rsnew, ew_CurrentDateTime(), ew_CurrentDate());
			$rsnew['rh_data_cadastro'] = &$this->rh_data_cadastro->DbValue;

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recursos_humanoslist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "pills";
		$pages->Add(0);
		$pages->Add(1);
		$pages->Add(2);
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_rh_exercicio":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `ano_ano` AS `LinkFld`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ano_ano` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->rh_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_rh_nome":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `rhp_id` AS `LinkFld`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$lookuptblfilter = "`rhp_fis_jur`=0";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`rhp_id` IN ({filter_value})', "t0" => "20", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->rh_nome, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_rh_funcao":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `rhf_id` AS `LinkFld`, `rhf_funcao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhfuncoes`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`rhf_id` IN ({filter_value})', "t0" => "20", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->rh_funcao, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($rc25_a_recursos_humanos_edit)) $rc25_a_recursos_humanos_edit = new crc25_a_recursos_humanos_edit();

// Page init
$rc25_a_recursos_humanos_edit->Page_Init();

// Page main
$rc25_a_recursos_humanos_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recursos_humanos_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = frc25_a_recursos_humanosedit = new ew_Form("frc25_a_recursos_humanosedit", "edit");

// Validate form
frc25_a_recursos_humanosedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_rh_exercicio");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recursos_humanos->rh_exercicio->FldCaption(), $rc25_a_recursos_humanos->rh_exercicio->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rh_pg_recurso_publico");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recursos_humanos->rh_pg_recurso_publico->FldCaption(), $rc25_a_recursos_humanos->rh_pg_recurso_publico->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rh_terceirizado");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recursos_humanos->rh_terceirizado->FldCaption(), $rc25_a_recursos_humanos->rh_terceirizado->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rh_nome");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recursos_humanos->rh_nome->FldCaption(), $rc25_a_recursos_humanos->rh_nome->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rh_funcao");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_recursos_humanos->rh_funcao->FldCaption(), $rc25_a_recursos_humanos->rh_funcao->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rh_remuneracao");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_recursos_humanos->rh_remuneracao->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_rh_hora_saida_ii");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_recursos_humanos->rh_hora_saida_ii->FldErrMsg()) ?>");

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
frc25_a_recursos_humanosedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recursos_humanosedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frc25_a_recursos_humanosedit.MultiPage = new ew_MultiPage("frc25_a_recursos_humanosedit");

// Dynamic selection lists
frc25_a_recursos_humanosedit.Lists["x_rh_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recursos_humanosedit.Lists["x_rh_exercicio"].Data = "<?php echo $rc25_a_recursos_humanos_edit->rh_exercicio->LookupFilterQuery(FALSE, "edit") ?>";
frc25_a_recursos_humanosedit.Lists["x_rh_pg_recurso_publico"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frc25_a_recursos_humanosedit.Lists["x_rh_pg_recurso_publico"].Options = <?php echo json_encode($rc25_a_recursos_humanos_edit->rh_pg_recurso_publico->Options()) ?>;
frc25_a_recursos_humanosedit.Lists["x_rh_terceirizado"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frc25_a_recursos_humanosedit.Lists["x_rh_terceirizado"].Options = <?php echo json_encode($rc25_a_recursos_humanos_edit->rh_terceirizado->Options()) ?>;
frc25_a_recursos_humanosedit.Lists["x_rh_nome"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recursos_humanosedit.Lists["x_rh_nome"].Data = "<?php echo $rc25_a_recursos_humanos_edit->rh_nome->LookupFilterQuery(FALSE, "edit") ?>";
frc25_a_recursos_humanosedit.Lists["x_rh_funcao"] = {"LinkField":"x_rhf_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhf_funcao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhfuncoes"};
frc25_a_recursos_humanosedit.Lists["x_rh_funcao"].Data = "<?php echo $rc25_a_recursos_humanos_edit->rh_funcao->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_recursos_humanos_edit->ShowPageHeader(); ?>
<?php
$rc25_a_recursos_humanos_edit->ShowMessage();
?>
<?php if (!$rc25_a_recursos_humanos_edit->IsModal) { ?>
<form name="ewPagerForm" class="form-horizontal ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recursos_humanos_edit->Pager)) $rc25_a_recursos_humanos_edit->Pager = new cPrevNextPager($rc25_a_recursos_humanos_edit->StartRec, $rc25_a_recursos_humanos_edit->DisplayRecs, $rc25_a_recursos_humanos_edit->TotalRecs, $rc25_a_recursos_humanos_edit->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_edit->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_recursos_humanosedit" id="frc25_a_recursos_humanosedit" class="<?php echo $rc25_a_recursos_humanos_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recursos_humanos_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recursos_humanos_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recursos_humanos">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_recursos_humanos_edit->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="rc25_a_recursos_humanos_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $rc25_a_recursos_humanos_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $rc25_a_recursos_humanos_edit->MultiPages->TabStyle("1") ?>><a href="#tab_rc25_a_recursos_humanos1" data-toggle="tab"><?php echo $rc25_a_recursos_humanos->PageCaption(1) ?></a></li>
		<li<?php echo $rc25_a_recursos_humanos_edit->MultiPages->TabStyle("2") ?>><a href="#tab_rc25_a_recursos_humanos2" data-toggle="tab"><?php echo $rc25_a_recursos_humanos->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $rc25_a_recursos_humanos_edit->MultiPages->PageStyle("1") ?>" id="tab_rc25_a_recursos_humanos1"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
	<div id="r_rh_exercicio" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_exercicio" for="x_rh_exercicio" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_exercicio">
<select data-table="rc25_a_recursos_humanos" data-field="x_rh_exercicio" data-page="1" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_rh_exercicio" name="x_rh_exercicio"<?php echo $rc25_a_recursos_humanos->rh_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->SelectOptionListHtml("x_rh_exercicio") ?>
</select>
</span>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_pg_recurso_publico->Visible) { // rh_pg_recurso_publico ?>
	<div id="r_rh_pg_recurso_publico" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_pg_recurso_publico" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_pg_recurso_publico">
<div id="tp_x_rh_pg_recurso_publico" class="ewTemplate"><input type="radio" data-table="rc25_a_recursos_humanos" data-field="x_rh_pg_recurso_publico" data-page="1" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->DisplayValueSeparatorAttribute() ?>" name="x_rh_pg_recurso_publico" id="x_rh_pg_recurso_publico" value="{value}"<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->EditAttributes() ?>></div>
<div id="dsl_x_rh_pg_recurso_publico" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->RadioButtonListHtml(FALSE, "x_rh_pg_recurso_publico", 1) ?>
</div></div>
</span>
<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_terceirizado->Visible) { // rh_terceirizado ?>
	<div id="r_rh_terceirizado" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_terceirizado" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_terceirizado->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_terceirizado->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_terceirizado">
<div id="tp_x_rh_terceirizado" class="ewTemplate"><input type="radio" data-table="rc25_a_recursos_humanos" data-field="x_rh_terceirizado" data-page="1" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_terceirizado->DisplayValueSeparatorAttribute() ?>" name="x_rh_terceirizado" id="x_rh_terceirizado" value="{value}"<?php echo $rc25_a_recursos_humanos->rh_terceirizado->EditAttributes() ?>></div>
<div id="dsl_x_rh_terceirizado" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $rc25_a_recursos_humanos->rh_terceirizado->RadioButtonListHtml(FALSE, "x_rh_terceirizado", 1) ?>
</div></div>
</span>
<?php echo $rc25_a_recursos_humanos->rh_terceirizado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
	<div id="r_rh_nome" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_nome" for="x_rh_nome" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_nome->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_nome">
<select data-table="rc25_a_recursos_humanos" data-field="x_rh_nome" data-page="1" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_nome->DisplayValueSeparatorAttribute() ?>" id="x_rh_nome" name="x_rh_nome"<?php echo $rc25_a_recursos_humanos->rh_nome->EditAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_nome->SelectOptionListHtml("x_rh_nome") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_recursos_humanos->rh_nome->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_rh_nome',url:'rc25_a_rhpessoasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_rh_nome"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?></span></button>
</span>
<?php echo $rc25_a_recursos_humanos->rh_nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
	<div id="r_rh_funcao" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_funcao" for="x_rh_funcao" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_funcao->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_funcao">
<select data-table="rc25_a_recursos_humanos" data-field="x_rh_funcao" data-page="1" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_funcao->DisplayValueSeparatorAttribute() ?>" id="x_rh_funcao" name="x_rh_funcao"<?php echo $rc25_a_recursos_humanos->rh_funcao->EditAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_funcao->SelectOptionListHtml("x_rh_funcao") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_rh_funcao',url:'rc25_a_rhfuncoesaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_rh_funcao"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?></span></button>
</span>
<?php echo $rc25_a_recursos_humanos->rh_funcao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_escolaridade->Visible) { // rh_escolaridade ?>
	<div id="r_rh_escolaridade" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_escolaridade" for="x_rh_escolaridade" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_escolaridade->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_escolaridade->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_escolaridade">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_escolaridade" data-page="1" name="x_rh_escolaridade" id="x_rh_escolaridade" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_escolaridade->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_escolaridade->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_escolaridade->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_escolaridade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
	<div id="r_rh_sala_turma" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_sala_turma" for="x_rh_sala_turma" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_sala_turma->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_sala_turma->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_sala_turma">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_sala_turma" data-page="1" name="x_rh_sala_turma" id="x_rh_sala_turma" size="20" maxlength="20" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_sala_turma->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_sala_turma->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_sala_turma->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_sala_turma->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rc25_a_recursos_humanos_edit->MultiPages->PageStyle("2") ?>" id="tab_rc25_a_recursos_humanos2"><!-- multi-page .tab-pane -->
<div class="ewEditDiv"><!-- page* -->
<?php if ($rc25_a_recursos_humanos->rh_carga_horaria_semanal->Visible) { // rh_carga_horaria_semanal ?>
	<div id="r_rh_carga_horaria_semanal" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_carga_horaria_semanal" for="x_rh_carga_horaria_semanal" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_carga_horaria_semanal">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_carga_horaria_semanal" data-page="2" name="x_rh_carga_horaria_semanal" id="x_rh_carga_horaria_semanal" size="10" maxlength="10" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_carga_horaria_semanal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_remuneracao->Visible) { // rh_remuneracao ?>
	<div id="r_rh_remuneracao" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_remuneracao" for="x_rh_remuneracao" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_remuneracao->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_remuneracao->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_remuneracao">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_remuneracao" data-page="2" name="x_rh_remuneracao" id="x_rh_remuneracao" size="10" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_remuneracao->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_remuneracao->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_remuneracao->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_remuneracao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_entra_i->Visible) { // rh_hora_entra_i ?>
	<div id="r_rh_hora_entra_i" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_hora_entra_i" for="x_rh_hora_entra_i" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_entra_i">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_hora_entra_i" data-page="2" name="x_rh_hora_entra_i" id="x_rh_hora_entra_i" size="12" maxlength="20" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_hora_entra_i->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_saida_i->Visible) { // rh_hora_saida_i ?>
	<div id="r_rh_hora_saida_i" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_hora_saida_i" for="x_rh_hora_saida_i" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_saida_i">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_hora_saida_i" data-page="2" name="x_rh_hora_saida_i" id="x_rh_hora_saida_i" size="12" maxlength="20" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_hora_saida_i->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_entra_ii->Visible) { // rh_hora_entra_ii ?>
	<div id="r_rh_hora_entra_ii" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_hora_entra_ii" for="x_rh_hora_entra_ii" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_entra_ii">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_hora_entra_ii" data-page="2" name="x_rh_hora_entra_ii" id="x_rh_hora_entra_ii" size="12" maxlength="20" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_hora_entra_ii->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_saida_ii->Visible) { // rh_hora_saida_ii ?>
	<div id="r_rh_hora_saida_ii" class="form-group">
		<label id="elh_rc25_a_recursos_humanos_rh_hora_saida_ii" for="x_rh_hora_saida_ii" class="<?php echo $rc25_a_recursos_humanos_edit->LeftColumnClass ?>"><?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_recursos_humanos_edit->RightColumnClass ?>"><div<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_saida_ii">
<input type="text" data-table="rc25_a_recursos_humanos" data-field="x_rh_hora_saida_ii" data-page="2" name="x_rh_hora_saida_ii" id="x_rh_hora_saida_ii" size="12" maxlength="12" placeholder="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_hora_saida_ii->getPlaceHolder()) ?>" value="<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->EditValue ?>"<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->EditAttributes() ?>>
</span>
<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<input type="hidden" data-table="rc25_a_recursos_humanos" data-field="x_rh_id" name="x_rh_id" id="x_rh_id" value="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos->rh_id->CurrentValue) ?>">
<?php if (!$rc25_a_recursos_humanos_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_recursos_humanos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_recursos_humanos_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$rc25_a_recursos_humanos_edit->IsModal) { ?>
<?php if (!isset($rc25_a_recursos_humanos_edit->Pager)) $rc25_a_recursos_humanos_edit->Pager = new cPrevNextPager($rc25_a_recursos_humanos_edit->StartRec, $rc25_a_recursos_humanos_edit->DisplayRecs, $rc25_a_recursos_humanos_edit->TotalRecs, $rc25_a_recursos_humanos_edit->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_edit->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_edit->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_edit->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_edit->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_edit->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_edit->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_edit->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_recursos_humanosedit.Init();
</script>
<?php
$rc25_a_recursos_humanos_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recursos_humanos_edit->Page_Terminate();
?>
