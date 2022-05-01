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

$rc25_a_recurso_aplicados_view = NULL; // Initialize page object first

class crc25_a_recurso_aplicados_view extends crc25_a_recurso_aplicados {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recurso_aplicados';

	// Page object name
	var $PageObjName = 'rc25_a_recurso_aplicados_view';

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
		$KeyUrl = "";
		if (@$_GET["ra_id"] <> "") {
			$this->RecKey["ra_id"] = $_GET["ra_id"];
			$KeyUrl .= "&amp;ra_id=" . urlencode($this->RecKey["ra_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $gbSkipHeaderFooter, $EW_EXPORT;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["ra_id"] <> "") {
				$this->ra_id->setQueryStringValue($_GET["ra_id"]);
				$this->RecKey["ra_id"] = $this->ra_id->QueryStringValue;
			} elseif (@$_POST["ra_id"] <> "") {
				$this->ra_id->setFormValue($_POST["ra_id"]);
				$this->RecKey["ra_id"] = $this->ra_id->FormValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					$this->StartRec = 1; // Initialize start position
					if ($this->Recordset = $this->LoadRecordset()) // Load records
						$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
					if ($this->TotalRecs <= 0) { // No record found
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("rc25_a_recurso_aplicadoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->ra_id->CurrentValue) == strval($this->Recordset->fields('ra_id'))) {
								$this->setStartRecordNumber($this->StartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->StartRec++;
								$this->Recordset->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "rc25_a_recurso_aplicadoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "rc25_a_recurso_aplicadoslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "");

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "");

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddQuery($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "");

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recurso_aplicadoslist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_recurso_aplicados_view)) $rc25_a_recurso_aplicados_view = new crc25_a_recurso_aplicados_view();

// Page init
$rc25_a_recurso_aplicados_view->Page_Init();

// Page main
$rc25_a_recurso_aplicados_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recurso_aplicados_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frc25_a_recurso_aplicadosview = new ew_Form("frc25_a_recurso_aplicadosview", "view");

// Form_CustomValidate event
frc25_a_recurso_aplicadosview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recurso_aplicadosview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recurso_aplicadosview.Lists["x_ra_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recurso_aplicadosview.Lists["x_ra_exercicio"].Data = "<?php echo $rc25_a_recurso_aplicados_view->ra_exercicio->LookupFilterQuery(FALSE, "view") ?>";
frc25_a_recurso_aplicadosview.Lists["x_ra_identificador"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recurso_aplicadosview.Lists["x_ra_identificador"].Data = "<?php echo $rc25_a_recurso_aplicados_view->ra_identificador->LookupFilterQuery(FALSE, "view") ?>";
frc25_a_recurso_aplicadosview.Lists["x_ra_natureza"] = {"LinkField":"x_ran_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_ran_descricao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_ra_natureza"};
frc25_a_recurso_aplicadosview.Lists["x_ra_natureza"].Data = "<?php echo $rc25_a_recurso_aplicados_view->ra_natureza->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $rc25_a_recurso_aplicados_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rc25_a_recurso_aplicados_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $rc25_a_recurso_aplicados_view->ShowPageHeader(); ?>
<?php
$rc25_a_recurso_aplicados_view->ShowMessage();
?>
<?php if (!$rc25_a_recurso_aplicados_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recurso_aplicados_view->Pager)) $rc25_a_recurso_aplicados_view->Pager = new cPrevNextPager($rc25_a_recurso_aplicados_view->StartRec, $rc25_a_recurso_aplicados_view->DisplayRecs, $rc25_a_recurso_aplicados_view->TotalRecs, $rc25_a_recurso_aplicados_view->AutoHidePager) ?>
<?php if ($rc25_a_recurso_aplicados_view->Pager->RecordCount > 0 && $rc25_a_recurso_aplicados_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recurso_aplicados_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_recurso_aplicadosview" id="frc25_a_recurso_aplicadosview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recurso_aplicados_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recurso_aplicados_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recurso_aplicados">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_recurso_aplicados_view->IsModal) ?>">
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_recurso_aplicados->ra_exercicio->Visible) { // ra_exercicio ?>
	<tr id="r_ra_exercicio">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_exercicio"><?php echo $rc25_a_recurso_aplicados->ra_exercicio->FldCaption() ?></span></td>
		<td data-name="ra_exercicio"<?php echo $rc25_a_recurso_aplicados->ra_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_exercicio">
<span<?php echo $rc25_a_recurso_aplicados->ra_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_exercicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_data_cadastro->Visible) { // ra_data_cadastro ?>
	<tr id="r_ra_data_cadastro">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_data_cadastro"><?php echo $rc25_a_recurso_aplicados->ra_data_cadastro->FldCaption() ?></span></td>
		<td data-name="ra_data_cadastro"<?php echo $rc25_a_recurso_aplicados->ra_data_cadastro->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_data_cadastro">
<span<?php echo $rc25_a_recurso_aplicados->ra_data_cadastro->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_data_cadastro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_data_pagamento->Visible) { // ra_data_pagamento ?>
	<tr id="r_ra_data_pagamento">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_data_pagamento"><?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->FldCaption() ?></span></td>
		<td data-name="ra_data_pagamento"<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_data_pagamento">
<span<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_especificacoes->Visible) { // ra_especificacoes ?>
	<tr id="r_ra_especificacoes">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_especificacoes"><?php echo $rc25_a_recurso_aplicados->ra_especificacoes->FldCaption() ?></span></td>
		<td data-name="ra_especificacoes"<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_especificacoes">
<span<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_identificador->Visible) { // ra_identificador ?>
	<tr id="r_ra_identificador">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_identificador"><?php echo $rc25_a_recurso_aplicados->ra_identificador->FldCaption() ?></span></td>
		<td data-name="ra_identificador"<?php echo $rc25_a_recurso_aplicados->ra_identificador->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_identificador">
<span<?php echo $rc25_a_recurso_aplicados->ra_identificador->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_identificador->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_plano->Visible) { // ra_plano ?>
	<tr id="r_ra_plano">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_plano"><?php echo $rc25_a_recurso_aplicados->ra_plano->FldCaption() ?></span></td>
		<td data-name="ra_plano"<?php echo $rc25_a_recurso_aplicados->ra_plano->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_plano">
<span<?php echo $rc25_a_recurso_aplicados->ra_plano->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_plano->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_natureza->Visible) { // ra_natureza ?>
	<tr id="r_ra_natureza">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_natureza"><?php echo $rc25_a_recurso_aplicados->ra_natureza->FldCaption() ?></span></td>
		<td data-name="ra_natureza"<?php echo $rc25_a_recurso_aplicados->ra_natureza->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_natureza">
<span<?php echo $rc25_a_recurso_aplicados->ra_natureza->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_natureza->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_valor->Visible) { // ra_valor ?>
	<tr id="r_ra_valor">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_valor"><?php echo $rc25_a_recurso_aplicados->ra_valor->FldCaption() ?></span></td>
		<td data-name="ra_valor"<?php echo $rc25_a_recurso_aplicados->ra_valor->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_valor">
<span<?php echo $rc25_a_recurso_aplicados->ra_valor->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_valor->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_comprovante->Visible) { // ra_comprovante ?>
	<tr id="r_ra_comprovante">
		<td class="col-sm-2"><span id="elh_rc25_a_recurso_aplicados_ra_comprovante"><?php echo $rc25_a_recurso_aplicados->ra_comprovante->FldCaption() ?></span></td>
		<td data-name="ra_comprovante"<?php echo $rc25_a_recurso_aplicados->ra_comprovante->CellAttributes() ?>>
<span id="el_rc25_a_recurso_aplicados_ra_comprovante">
<span<?php echo $rc25_a_recurso_aplicados->ra_comprovante->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_comprovante->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rc25_a_recurso_aplicados_view->IsModal) { ?>
<?php if (!isset($rc25_a_recurso_aplicados_view->Pager)) $rc25_a_recurso_aplicados_view->Pager = new cPrevNextPager($rc25_a_recurso_aplicados_view->StartRec, $rc25_a_recurso_aplicados_view->DisplayRecs, $rc25_a_recurso_aplicados_view->TotalRecs, $rc25_a_recurso_aplicados_view->AutoHidePager) ?>
<?php if ($rc25_a_recurso_aplicados_view->Pager->RecordCount > 0 && $rc25_a_recurso_aplicados_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recurso_aplicados_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recurso_aplicados_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recurso_aplicados_view->PageUrl() ?>start=<?php echo $rc25_a_recurso_aplicados_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recurso_aplicados_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_recurso_aplicadosview.Init();
</script>
<?php
$rc25_a_recurso_aplicados_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recurso_aplicados_view->Page_Terminate();
?>
