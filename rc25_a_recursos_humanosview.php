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

$rc25_a_recursos_humanos_view = NULL; // Initialize page object first

class crc25_a_recursos_humanos_view extends crc25_a_recursos_humanos {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recursos_humanos';

	// Page object name
	var $PageObjName = 'rc25_a_recursos_humanos_view';

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

		// Table object (rc25_a_recursos_humanos)
		if (!isset($GLOBALS["rc25_a_recursos_humanos"]) || get_class($GLOBALS["rc25_a_recursos_humanos"]) == "crc25_a_recursos_humanos") {
			$GLOBALS["rc25_a_recursos_humanos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recursos_humanos"];
		}
		$KeyUrl = "";
		if (@$_GET["rh_id"] <> "") {
			$this->RecKey["rh_id"] = $_GET["rh_id"];
			$KeyUrl .= "&amp;rh_id=" . urlencode($this->RecKey["rh_id"]);
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
			define("EW_TABLE_NAME", 'rc25_a_recursos_humanos', TRUE);

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
	var $MultiPages; // Multi pages object

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
			if (@$_GET["rh_id"] <> "") {
				$this->rh_id->setQueryStringValue($_GET["rh_id"]);
				$this->RecKey["rh_id"] = $this->rh_id->QueryStringValue;
			} elseif (@$_POST["rh_id"] <> "") {
				$this->rh_id->setFormValue($_POST["rh_id"]);
				$this->RecKey["rh_id"] = $this->rh_id->FormValue;
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
						$this->Page_Terminate("rc25_a_recursos_humanoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->rh_id->CurrentValue) == strval($this->Recordset->fields('rh_id'))) {
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
						$sReturnUrl = "rc25_a_recursos_humanoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "rc25_a_recursos_humanoslist.php"; // Not page request, return to list
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recursos_humanoslist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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
if (!isset($rc25_a_recursos_humanos_view)) $rc25_a_recursos_humanos_view = new crc25_a_recursos_humanos_view();

// Page init
$rc25_a_recursos_humanos_view->Page_Init();

// Page main
$rc25_a_recursos_humanos_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recursos_humanos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frc25_a_recursos_humanosview = new ew_Form("frc25_a_recursos_humanosview", "view");

// Form_CustomValidate event
frc25_a_recursos_humanosview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recursos_humanosview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frc25_a_recursos_humanosview.MultiPage = new ew_MultiPage("frc25_a_recursos_humanosview");

// Dynamic selection lists
frc25_a_recursos_humanosview.Lists["x_rh_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recursos_humanosview.Lists["x_rh_exercicio"].Data = "<?php echo $rc25_a_recursos_humanos_view->rh_exercicio->LookupFilterQuery(FALSE, "view") ?>";
frc25_a_recursos_humanosview.Lists["x_rh_pg_recurso_publico"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frc25_a_recursos_humanosview.Lists["x_rh_pg_recurso_publico"].Options = <?php echo json_encode($rc25_a_recursos_humanos_view->rh_pg_recurso_publico->Options()) ?>;
frc25_a_recursos_humanosview.Lists["x_rh_terceirizado"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
frc25_a_recursos_humanosview.Lists["x_rh_terceirizado"].Options = <?php echo json_encode($rc25_a_recursos_humanos_view->rh_terceirizado->Options()) ?>;
frc25_a_recursos_humanosview.Lists["x_rh_nome"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recursos_humanosview.Lists["x_rh_nome"].Data = "<?php echo $rc25_a_recursos_humanos_view->rh_nome->LookupFilterQuery(FALSE, "view") ?>";
frc25_a_recursos_humanosview.Lists["x_rh_funcao"] = {"LinkField":"x_rhf_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhf_funcao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhfuncoes"};
frc25_a_recursos_humanosview.Lists["x_rh_funcao"].Data = "<?php echo $rc25_a_recursos_humanos_view->rh_funcao->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $rc25_a_recursos_humanos_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rc25_a_recursos_humanos_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $rc25_a_recursos_humanos_view->ShowPageHeader(); ?>
<?php
$rc25_a_recursos_humanos_view->ShowMessage();
?>
<?php if (!$rc25_a_recursos_humanos_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recursos_humanos_view->Pager)) $rc25_a_recursos_humanos_view->Pager = new cPrevNextPager($rc25_a_recursos_humanos_view->StartRec, $rc25_a_recursos_humanos_view->DisplayRecs, $rc25_a_recursos_humanos_view->TotalRecs, $rc25_a_recursos_humanos_view->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_view->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_recursos_humanosview" id="frc25_a_recursos_humanosview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recursos_humanos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recursos_humanos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recursos_humanos">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_recursos_humanos_view->IsModal) ?>">
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="rc25_a_recursos_humanos_view">
	<ul class="nav<?php echo $rc25_a_recursos_humanos_view->MultiPages->NavStyle() ?>">
		<li<?php echo $rc25_a_recursos_humanos_view->MultiPages->TabStyle("1") ?>><a href="#tab_rc25_a_recursos_humanos1" data-toggle="tab"><?php echo $rc25_a_recursos_humanos->PageCaption(1) ?></a></li>
		<li<?php echo $rc25_a_recursos_humanos_view->MultiPages->TabStyle("2") ?>><a href="#tab_rc25_a_recursos_humanos2" data-toggle="tab"><?php echo $rc25_a_recursos_humanos->PageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_recursos_humanos_view->MultiPages->PageStyle("1") ?>" id="tab_rc25_a_recursos_humanos1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
	<tr id="r_rh_exercicio">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_exercicio"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?></span></td>
		<td data-name="rh_exercicio"<?php echo $rc25_a_recursos_humanos->rh_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_exercicio" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_pg_recurso_publico->Visible) { // rh_pg_recurso_publico ?>
	<tr id="r_rh_pg_recurso_publico">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_pg_recurso_publico"><?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->FldCaption() ?></span></td>
		<td data-name="rh_pg_recurso_publico"<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_pg_recurso_publico" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_pg_recurso_publico->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_terceirizado->Visible) { // rh_terceirizado ?>
	<tr id="r_rh_terceirizado">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_terceirizado"><?php echo $rc25_a_recursos_humanos->rh_terceirizado->FldCaption() ?></span></td>
		<td data-name="rh_terceirizado"<?php echo $rc25_a_recursos_humanos->rh_terceirizado->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_terceirizado" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_terceirizado->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_terceirizado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
	<tr id="r_rh_nome">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_nome"><?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?></span></td>
		<td data-name="rh_nome"<?php echo $rc25_a_recursos_humanos->rh_nome->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_nome" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_nome->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_nome->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
	<tr id="r_rh_funcao">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_funcao"><?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?></span></td>
		<td data-name="rh_funcao"<?php echo $rc25_a_recursos_humanos->rh_funcao->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_funcao" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_funcao->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_funcao->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_escolaridade->Visible) { // rh_escolaridade ?>
	<tr id="r_rh_escolaridade">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_escolaridade"><?php echo $rc25_a_recursos_humanos->rh_escolaridade->FldCaption() ?></span></td>
		<td data-name="rh_escolaridade"<?php echo $rc25_a_recursos_humanos->rh_escolaridade->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_escolaridade" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_escolaridade->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_escolaridade->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
	<tr id="r_rh_sala_turma">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_sala_turma"><?php echo $rc25_a_recursos_humanos->rh_sala_turma->FldCaption() ?></span></td>
		<td data-name="rh_sala_turma"<?php echo $rc25_a_recursos_humanos->rh_sala_turma->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_sala_turma" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_data_cadastro->Visible) { // rh_data_cadastro ?>
	<tr id="r_rh_data_cadastro">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_data_cadastro"><?php echo $rc25_a_recursos_humanos->rh_data_cadastro->FldCaption() ?></span></td>
		<td data-name="rh_data_cadastro"<?php echo $rc25_a_recursos_humanos->rh_data_cadastro->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_data_cadastro" data-page="1">
<span<?php echo $rc25_a_recursos_humanos->rh_data_cadastro->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_data_cadastro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_recursos_humanos_view->MultiPages->PageStyle("2") ?>" id="tab_rc25_a_recursos_humanos2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_recursos_humanos->rh_carga_horaria_semanal->Visible) { // rh_carga_horaria_semanal ?>
	<tr id="r_rh_carga_horaria_semanal">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_carga_horaria_semanal"><?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->FldCaption() ?></span></td>
		<td data-name="rh_carga_horaria_semanal"<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_carga_horaria_semanal" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_carga_horaria_semanal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_remuneracao->Visible) { // rh_remuneracao ?>
	<tr id="r_rh_remuneracao">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_remuneracao"><?php echo $rc25_a_recursos_humanos->rh_remuneracao->FldCaption() ?></span></td>
		<td data-name="rh_remuneracao"<?php echo $rc25_a_recursos_humanos->rh_remuneracao->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_remuneracao" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_remuneracao->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_remuneracao->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_entra_i->Visible) { // rh_hora_entra_i ?>
	<tr id="r_rh_hora_entra_i">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_hora_entra_i"><?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->FldCaption() ?></span></td>
		<td data-name="rh_hora_entra_i"<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_entra_i" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_hora_entra_i->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_saida_i->Visible) { // rh_hora_saida_i ?>
	<tr id="r_rh_hora_saida_i">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_hora_saida_i"><?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->FldCaption() ?></span></td>
		<td data-name="rh_hora_saida_i"<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_saida_i" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_hora_saida_i->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_entra_ii->Visible) { // rh_hora_entra_ii ?>
	<tr id="r_rh_hora_entra_ii">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_hora_entra_ii"><?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->FldCaption() ?></span></td>
		<td data-name="rh_hora_entra_ii"<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_entra_ii" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_hora_entra_ii->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_hora_saida_ii->Visible) { // rh_hora_saida_ii ?>
	<tr id="r_rh_hora_saida_ii">
		<td class="col-sm-2"><span id="elh_rc25_a_recursos_humanos_rh_hora_saida_ii"><?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->FldCaption() ?></span></td>
		<td data-name="rh_hora_saida_ii"<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->CellAttributes() ?>>
<span id="el_rc25_a_recursos_humanos_rh_hora_saida_ii" data-page="2">
<span<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_hora_saida_ii->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$rc25_a_recursos_humanos_view->IsModal) { ?>
<?php if (!isset($rc25_a_recursos_humanos_view->Pager)) $rc25_a_recursos_humanos_view->Pager = new cPrevNextPager($rc25_a_recursos_humanos_view->StartRec, $rc25_a_recursos_humanos_view->DisplayRecs, $rc25_a_recursos_humanos_view->TotalRecs, $rc25_a_recursos_humanos_view->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_view->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_view->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_recursos_humanosview.Init();
</script>
<?php
$rc25_a_recursos_humanos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recursos_humanos_view->Page_Terminate();
?>
