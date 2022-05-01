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

$rc25_a_planos_aplicacao_view = NULL; // Initialize page object first

class crc25_a_planos_aplicacao_view extends crc25_a_planos_aplicacao {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_planos_aplicacao';

	// Page object name
	var $PageObjName = 'rc25_a_planos_aplicacao_view';

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

		// Table object (rc25_a_planos_aplicacao)
		if (!isset($GLOBALS["rc25_a_planos_aplicacao"]) || get_class($GLOBALS["rc25_a_planos_aplicacao"]) == "crc25_a_planos_aplicacao") {
			$GLOBALS["rc25_a_planos_aplicacao"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_planos_aplicacao"];
		}
		$KeyUrl = "";
		if (@$_GET["plano_id"] <> "") {
			$this->RecKey["plano_id"] = $_GET["plano_id"];
			$KeyUrl .= "&amp;plano_id=" . urlencode($this->RecKey["plano_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Set up master/detail parameters
		$this->SetupMasterParms();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["plano_id"] <> "") {
				$this->plano_id->setQueryStringValue($_GET["plano_id"]);
				$this->RecKey["plano_id"] = $this->plano_id->QueryStringValue;
			} elseif (@$_POST["plano_id"] <> "") {
				$this->plano_id->setFormValue($_POST["plano_id"]);
				$this->RecKey["plano_id"] = $this->plano_id->FormValue;
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
						$this->Page_Terminate("rc25_a_planos_aplicacaolist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->plano_id->CurrentValue) == strval($this->Recordset->fields('plano_id'))) {
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
						$sReturnUrl = "rc25_a_planos_aplicacaolist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "rc25_a_planos_aplicacaolist.php"; // Not page request, return to list
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
		$row = array();
		$row['plano_id'] = NULL;
		$row['plano_exercicio'] = NULL;
		$row['plano_despesa'] = NULL;
		$row['plano_custo_mensal'] = NULL;
		$row['plano_custo_exercicio'] = NULL;
		$row['plano_recurso_municipal'] = NULL;
		$row['plano_outros_recursos'] = NULL;
		$row['plano_data_cadastro'] = NULL;
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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
			$this->setSessionWhere($this->GetDetailFilter());

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
if (!isset($rc25_a_planos_aplicacao_view)) $rc25_a_planos_aplicacao_view = new crc25_a_planos_aplicacao_view();

// Page init
$rc25_a_planos_aplicacao_view->Page_Init();

// Page main
$rc25_a_planos_aplicacao_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_planos_aplicacao_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frc25_a_planos_aplicacaoview = new ew_Form("frc25_a_planos_aplicacaoview", "view");

// Form_CustomValidate event
frc25_a_planos_aplicacaoview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_aplicacaoview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_planos_aplicacaoview.Lists["x_plano_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_planos_aplicacaoview.Lists["x_plano_exercicio"].Data = "<?php echo $rc25_a_planos_aplicacao_view->plano_exercicio->LookupFilterQuery(FALSE, "view") ?>";
frc25_a_planos_aplicacaoview.Lists["x_plano_despesa"] = {"LinkField":"x_despesa_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_despesa_nome","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_planos_despesas"};
frc25_a_planos_aplicacaoview.Lists["x_plano_despesa"].Data = "<?php echo $rc25_a_planos_aplicacao_view->plano_despesa->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $rc25_a_planos_aplicacao_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rc25_a_planos_aplicacao_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $rc25_a_planos_aplicacao_view->ShowPageHeader(); ?>
<?php
$rc25_a_planos_aplicacao_view->ShowMessage();
?>
<?php if (!$rc25_a_planos_aplicacao_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_planos_aplicacao_view->Pager)) $rc25_a_planos_aplicacao_view->Pager = new cPrevNextPager($rc25_a_planos_aplicacao_view->StartRec, $rc25_a_planos_aplicacao_view->DisplayRecs, $rc25_a_planos_aplicacao_view->TotalRecs, $rc25_a_planos_aplicacao_view->AutoHidePager) ?>
<?php if ($rc25_a_planos_aplicacao_view->Pager->RecordCount > 0 && $rc25_a_planos_aplicacao_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_planos_aplicacao_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_planos_aplicacaoview" id="frc25_a_planos_aplicacaoview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_planos_aplicacao_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_planos_aplicacao_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_planos_aplicacao">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_planos_aplicacao_view->IsModal) ?>">
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
	<tr id="r_plano_exercicio">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_exercicio"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></span></td>
		<td data-name="plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
	<tr id="r_plano_despesa">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_despesa"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span></td>
		<td data-name="plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_despesa">
<span<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
	<tr id="r_plano_custo_mensal">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_custo_mensal"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></span></td>
		<td data-name="plano_custo_mensal"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_mensal">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
	<tr id="r_plano_custo_exercicio">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></span></td>
		<td data-name="plano_custo_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
	<tr id="r_plano_recurso_municipal">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></span></td>
		<td data-name="plano_recurso_municipal"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_recurso_municipal">
<span<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
	<tr id="r_plano_outros_recursos">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_outros_recursos"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></span></td>
		<td data-name="plano_outros_recursos"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_outros_recursos">
<span<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_data_cadastro->Visible) { // plano_data_cadastro ?>
	<tr id="r_plano_data_cadastro">
		<td class="col-sm-2"><span id="elh_rc25_a_planos_aplicacao_plano_data_cadastro"><?php echo $rc25_a_planos_aplicacao->plano_data_cadastro->FldCaption() ?></span></td>
		<td data-name="plano_data_cadastro"<?php echo $rc25_a_planos_aplicacao->plano_data_cadastro->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_data_cadastro">
<span<?php echo $rc25_a_planos_aplicacao->plano_data_cadastro->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_data_cadastro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$rc25_a_planos_aplicacao_view->IsModal) { ?>
<?php if (!isset($rc25_a_planos_aplicacao_view->Pager)) $rc25_a_planos_aplicacao_view->Pager = new cPrevNextPager($rc25_a_planos_aplicacao_view->StartRec, $rc25_a_planos_aplicacao_view->DisplayRecs, $rc25_a_planos_aplicacao_view->TotalRecs, $rc25_a_planos_aplicacao_view->AutoHidePager) ?>
<?php if ($rc25_a_planos_aplicacao_view->Pager->RecordCount > 0 && $rc25_a_planos_aplicacao_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_planos_aplicacao_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_planos_aplicacao_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_planos_aplicacao_view->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_planos_aplicacaoview.Init();
</script>
<?php
$rc25_a_planos_aplicacao_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_planos_aplicacao_view->Page_Terminate();
?>
