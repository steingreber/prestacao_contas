<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_termosinfo.php" ?>
<?php include_once "rc25_a_repassesgridcls.php" ?>
<?php include_once "rc25_a_planos_aplicacaogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_termos_view = NULL; // Initialize page object first

class crc25_a_termos_view extends crc25_a_termos {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_termos';

	// Page object name
	var $PageObjName = 'rc25_a_termos_view';

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

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS["rc25_a_termos"]) || get_class($GLOBALS["rc25_a_termos"]) == "crc25_a_termos") {
			$GLOBALS["rc25_a_termos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_termos"];
		}
		$KeyUrl = "";
		if (@$_GET["processo_id"] <> "") {
			$this->RecKey["processo_id"] = $_GET["processo_id"];
			$KeyUrl .= "&amp;processo_id=" . urlencode($this->RecKey["processo_id"]);
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
			define("EW_TABLE_NAME", 'rc25_a_termos', TRUE);

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
		$this->processo_exercicio->SetVisibility();
		$this->processo_termo_num->SetVisibility();
		$this->processo_numero->SetVisibility();
		$this->processo_vigencia_ini->SetVisibility();
		$this->processo_vigencia_fim->SetVisibility();
		$this->processo_data->SetVisibility();
		$this->processo_valor->SetVisibility();
		$this->processo_objeto->SetVisibility();
		$this->processo_metas->SetVisibility();
		$this->processo_origem->SetVisibility();
		$this->processo_ent_endereco->SetVisibility();
		$this->processo_ent_estatuto->SetVisibility();
		$this->processo_ent_lei->SetVisibility();
		$this->processo_ent_cebas->SetVisibility();
		$this->processo_resp_nome->SetVisibility();
		$this->processo_resp_cargo->SetVisibility();
		$this->processo_resp_end->SetVisibility();
		$this->processo_resp_contato->SetVisibility();
		$this->processo_resp_ata->SetVisibility();
		$this->processo_cont_nome->SetVisibility();
		$this->processo_cont_end->SetVisibility();
		$this->processo_cont_contato->SetVisibility();
		$this->processo_cont_indent->SetVisibility();
		$this->processo_preenc_nome->SetVisibility();
		$this->processo_preenc_carg->SetVisibility();
		$this->processo_preenc_end->SetVisibility();
		$this->processo_preenc_contato->SetVisibility();
		$this->processo_preenc_indentifica->SetVisibility();

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
		global $EW_EXPORT, $rc25_a_termos;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_termos);
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
					if ($pageName == "rc25_a_termosview.php")
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
			if (@$_GET["processo_id"] <> "") {
				$this->processo_id->setQueryStringValue($_GET["processo_id"]);
				$this->RecKey["processo_id"] = $this->processo_id->QueryStringValue;
			} elseif (@$_POST["processo_id"] <> "") {
				$this->processo_id->setFormValue($_POST["processo_id"]);
				$this->RecKey["processo_id"] = $this->processo_id->FormValue;
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
						$this->Page_Terminate("rc25_a_termoslist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetupStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->StartRec) <= intval($this->TotalRecs)) {
							$bMatchRecord = TRUE;
							$this->Recordset->Move($this->StartRec-1);
						}
					} else { // Match key values
						while (!$this->Recordset->EOF) {
							if (strval($this->processo_id->CurrentValue) == strval($this->Recordset->fields('processo_id'))) {
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
						$sReturnUrl = "rc25_a_termoslist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($this->Recordset); // Load row values
					}
			}
		} else {
			$sReturnUrl = "rc25_a_termoslist.php"; // Not page request, return to list
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

		// Set up detail parameters
		$this->SetupDetailParms();
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
		$option = &$options["detail"];
		$DetailTableLink = "";
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_rc25_a_repasses"
		$item = &$option->Add("detail_rc25_a_repasses");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("rc25_a_repasses", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("rc25_a_repasseslist.php?" . EW_TABLE_SHOW_MASTER . "=rc25_a_termos&fk_processo_id=" . urlencode(strval($this->processo_id->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["rc25_a_repasses_grid"] && $GLOBALS["rc25_a_repasses_grid"]->DetailView) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_repasses")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "rc25_a_repasses";
		}
		if ($GLOBALS["rc25_a_repasses_grid"] && $GLOBALS["rc25_a_repasses_grid"]->DetailEdit) {
			$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_repasses")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
			$DetailEditTblVar .= "rc25_a_repasses";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = TRUE;
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "rc25_a_repasses";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// "detail_rc25_a_planos_aplicacao"
		$item = &$option->Add("detail_rc25_a_planos_aplicacao");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("rc25_a_planos_aplicacao", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("rc25_a_planos_aplicacaolist.php?" . EW_TABLE_SHOW_MASTER . "=rc25_a_termos&fk_processo_exercicio=" . urlencode(strval($this->processo_exercicio->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["rc25_a_planos_aplicacao_grid"] && $GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailView) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_planos_aplicacao")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "rc25_a_planos_aplicacao";
		}
		if ($GLOBALS["rc25_a_planos_aplicacao_grid"] && $GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailEdit) {
			$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_planos_aplicacao")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
			$DetailEditTblVar .= "rc25_a_planos_aplicacao";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = TRUE;
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "rc25_a_planos_aplicacao";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$option->Add("details");
			$oListOpt->Body = $body;
		}

		// Set up detail default
		$option = &$options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$option->UseImageAndText = TRUE;
		$ar = explode(",", $DetailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = TRUE;
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
		$this->processo_id->setDbValue($row['processo_id']);
		$this->processo_exercicio->setDbValue($row['processo_exercicio']);
		$this->processo_termo_num->setDbValue($row['processo_termo_num']);
		$this->processo_numero->setDbValue($row['processo_numero']);
		$this->processo_vigencia_ini->setDbValue($row['processo_vigencia_ini']);
		$this->processo_vigencia_fim->setDbValue($row['processo_vigencia_fim']);
		$this->processo_data->setDbValue($row['processo_data']);
		$this->processo_valor->setDbValue($row['processo_valor']);
		$this->processo_objeto->setDbValue($row['processo_objeto']);
		$this->processo_metas->setDbValue($row['processo_metas']);
		$this->processo_origem->setDbValue($row['processo_origem']);
		$this->processo_ent_endereco->setDbValue($row['processo_ent_endereco']);
		$this->processo_ent_estatuto->Upload->DbValue = $row['processo_ent_estatuto'];
		if (is_array($this->processo_ent_estatuto->Upload->DbValue) || is_object($this->processo_ent_estatuto->Upload->DbValue)) // Byte array
			$this->processo_ent_estatuto->Upload->DbValue = ew_BytesToStr($this->processo_ent_estatuto->Upload->DbValue);
		$this->processo_ent_lei->setDbValue($row['processo_ent_lei']);
		$this->processo_ent_cebas->setDbValue($row['processo_ent_cebas']);
		$this->processo_resp_nome->setDbValue($row['processo_resp_nome']);
		$this->processo_resp_cargo->setDbValue($row['processo_resp_cargo']);
		$this->processo_resp_end->setDbValue($row['processo_resp_end']);
		$this->processo_resp_contato->setDbValue($row['processo_resp_contato']);
		$this->processo_resp_ata->setDbValue($row['processo_resp_ata']);
		$this->processo_cont_nome->setDbValue($row['processo_cont_nome']);
		$this->processo_cont_end->setDbValue($row['processo_cont_end']);
		$this->processo_cont_contato->setDbValue($row['processo_cont_contato']);
		$this->processo_cont_indent->setDbValue($row['processo_cont_indent']);
		$this->processo_preenc_nome->setDbValue($row['processo_preenc_nome']);
		$this->processo_preenc_carg->setDbValue($row['processo_preenc_carg']);
		$this->processo_preenc_end->setDbValue($row['processo_preenc_end']);
		$this->processo_preenc_contato->setDbValue($row['processo_preenc_contato']);
		$this->processo_preenc_indentifica->setDbValue($row['processo_preenc_indentifica']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['processo_id'] = NULL;
		$row['processo_exercicio'] = NULL;
		$row['processo_termo_num'] = NULL;
		$row['processo_numero'] = NULL;
		$row['processo_vigencia_ini'] = NULL;
		$row['processo_vigencia_fim'] = NULL;
		$row['processo_data'] = NULL;
		$row['processo_valor'] = NULL;
		$row['processo_objeto'] = NULL;
		$row['processo_metas'] = NULL;
		$row['processo_origem'] = NULL;
		$row['processo_ent_endereco'] = NULL;
		$row['processo_ent_estatuto'] = NULL;
		$row['processo_ent_lei'] = NULL;
		$row['processo_ent_cebas'] = NULL;
		$row['processo_resp_nome'] = NULL;
		$row['processo_resp_cargo'] = NULL;
		$row['processo_resp_end'] = NULL;
		$row['processo_resp_contato'] = NULL;
		$row['processo_resp_ata'] = NULL;
		$row['processo_cont_nome'] = NULL;
		$row['processo_cont_end'] = NULL;
		$row['processo_cont_contato'] = NULL;
		$row['processo_cont_indent'] = NULL;
		$row['processo_preenc_nome'] = NULL;
		$row['processo_preenc_carg'] = NULL;
		$row['processo_preenc_end'] = NULL;
		$row['processo_preenc_contato'] = NULL;
		$row['processo_preenc_indentifica'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->processo_id->DbValue = $row['processo_id'];
		$this->processo_exercicio->DbValue = $row['processo_exercicio'];
		$this->processo_termo_num->DbValue = $row['processo_termo_num'];
		$this->processo_numero->DbValue = $row['processo_numero'];
		$this->processo_vigencia_ini->DbValue = $row['processo_vigencia_ini'];
		$this->processo_vigencia_fim->DbValue = $row['processo_vigencia_fim'];
		$this->processo_data->DbValue = $row['processo_data'];
		$this->processo_valor->DbValue = $row['processo_valor'];
		$this->processo_objeto->DbValue = $row['processo_objeto'];
		$this->processo_metas->DbValue = $row['processo_metas'];
		$this->processo_origem->DbValue = $row['processo_origem'];
		$this->processo_ent_endereco->DbValue = $row['processo_ent_endereco'];
		$this->processo_ent_estatuto->Upload->DbValue = $row['processo_ent_estatuto'];
		$this->processo_ent_lei->DbValue = $row['processo_ent_lei'];
		$this->processo_ent_cebas->DbValue = $row['processo_ent_cebas'];
		$this->processo_resp_nome->DbValue = $row['processo_resp_nome'];
		$this->processo_resp_cargo->DbValue = $row['processo_resp_cargo'];
		$this->processo_resp_end->DbValue = $row['processo_resp_end'];
		$this->processo_resp_contato->DbValue = $row['processo_resp_contato'];
		$this->processo_resp_ata->DbValue = $row['processo_resp_ata'];
		$this->processo_cont_nome->DbValue = $row['processo_cont_nome'];
		$this->processo_cont_end->DbValue = $row['processo_cont_end'];
		$this->processo_cont_contato->DbValue = $row['processo_cont_contato'];
		$this->processo_cont_indent->DbValue = $row['processo_cont_indent'];
		$this->processo_preenc_nome->DbValue = $row['processo_preenc_nome'];
		$this->processo_preenc_carg->DbValue = $row['processo_preenc_carg'];
		$this->processo_preenc_end->DbValue = $row['processo_preenc_end'];
		$this->processo_preenc_contato->DbValue = $row['processo_preenc_contato'];
		$this->processo_preenc_indentifica->DbValue = $row['processo_preenc_indentifica'];
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
		if ($this->processo_valor->FormValue == $this->processo_valor->CurrentValue && is_numeric(ew_StrToFloat($this->processo_valor->CurrentValue)))
			$this->processo_valor->CurrentValue = ew_StrToFloat($this->processo_valor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// processo_id
		// processo_exercicio
		// processo_termo_num
		// processo_numero
		// processo_vigencia_ini
		// processo_vigencia_fim
		// processo_data
		// processo_valor
		// processo_objeto
		// processo_metas
		// processo_origem
		// processo_ent_endereco
		// processo_ent_estatuto
		// processo_ent_lei
		// processo_ent_cebas
		// processo_resp_nome
		// processo_resp_cargo
		// processo_resp_end
		// processo_resp_contato
		// processo_resp_ata
		// processo_cont_nome
		// processo_cont_end
		// processo_cont_contato
		// processo_cont_indent
		// processo_preenc_nome
		// processo_preenc_carg
		// processo_preenc_end
		// processo_preenc_contato
		// processo_preenc_indentifica

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// processo_exercicio
		if (strval($this->processo_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->processo_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->processo_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->processo_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->processo_exercicio->ViewValue = $this->processo_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->processo_exercicio->ViewValue = $this->processo_exercicio->CurrentValue;
			}
		} else {
			$this->processo_exercicio->ViewValue = NULL;
		}
		$this->processo_exercicio->CssStyle = "font-weight: bold;";
		$this->processo_exercicio->ViewCustomAttributes = "";

		// processo_termo_num
		$this->processo_termo_num->ViewValue = $this->processo_termo_num->CurrentValue;
		$this->processo_termo_num->ViewCustomAttributes = "";

		// processo_numero
		$this->processo_numero->ViewValue = $this->processo_numero->CurrentValue;
		$this->processo_numero->ViewCustomAttributes = "";

		// processo_vigencia_ini
		$this->processo_vigencia_ini->ViewValue = $this->processo_vigencia_ini->CurrentValue;
		$this->processo_vigencia_ini->ViewValue = ew_FormatDateTime($this->processo_vigencia_ini->ViewValue, 6);
		$this->processo_vigencia_ini->ViewCustomAttributes = "";

		// processo_vigencia_fim
		$this->processo_vigencia_fim->ViewValue = $this->processo_vigencia_fim->CurrentValue;
		$this->processo_vigencia_fim->ViewValue = ew_FormatDateTime($this->processo_vigencia_fim->ViewValue, 7);
		$this->processo_vigencia_fim->ViewCustomAttributes = "";

		// processo_data
		$this->processo_data->ViewValue = $this->processo_data->CurrentValue;
		$this->processo_data->ViewValue = ew_FormatDateTime($this->processo_data->ViewValue, 7);
		$this->processo_data->ViewCustomAttributes = "";

		// processo_valor
		$this->processo_valor->ViewValue = $this->processo_valor->CurrentValue;
		$this->processo_valor->ViewValue = ew_FormatCurrency($this->processo_valor->ViewValue, 2, -1, -2, -2);
		$this->processo_valor->ViewCustomAttributes = "";

		// processo_objeto
		$this->processo_objeto->ViewValue = $this->processo_objeto->CurrentValue;
		$this->processo_objeto->ViewCustomAttributes = "";

		// processo_metas
		$this->processo_metas->ViewValue = $this->processo_metas->CurrentValue;
		$this->processo_metas->ViewCustomAttributes = "";

		// processo_origem
		$this->processo_origem->ViewValue = $this->processo_origem->CurrentValue;
		$this->processo_origem->ViewCustomAttributes = "";

		// processo_ent_endereco
		$this->processo_ent_endereco->ViewValue = $this->processo_ent_endereco->CurrentValue;
		$this->processo_ent_endereco->ViewCustomAttributes = "";

		// processo_ent_estatuto
		if (!ew_Empty($this->processo_ent_estatuto->Upload->DbValue)) {
			$this->processo_ent_estatuto->ViewValue = "rc25_a_termos_processo_ent_estatuto_bv.php?" . "processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->processo_ent_estatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->processo_ent_estatuto->ViewValue = "";
		}
		$this->processo_ent_estatuto->ViewCustomAttributes = "";

		// processo_ent_lei
		$this->processo_ent_lei->ViewValue = $this->processo_ent_lei->CurrentValue;
		$this->processo_ent_lei->ViewCustomAttributes = "";

		// processo_ent_cebas
		$this->processo_ent_cebas->ViewValue = $this->processo_ent_cebas->CurrentValue;
		$this->processo_ent_cebas->ViewCustomAttributes = "";

		// processo_resp_nome
		$this->processo_resp_nome->ViewValue = $this->processo_resp_nome->CurrentValue;
		$this->processo_resp_nome->ViewCustomAttributes = "";

		// processo_resp_cargo
		$this->processo_resp_cargo->ViewValue = $this->processo_resp_cargo->CurrentValue;
		$this->processo_resp_cargo->ViewCustomAttributes = "";

		// processo_resp_end
		$this->processo_resp_end->ViewValue = $this->processo_resp_end->CurrentValue;
		$this->processo_resp_end->ViewCustomAttributes = "";

		// processo_resp_contato
		$this->processo_resp_contato->ViewValue = $this->processo_resp_contato->CurrentValue;
		$this->processo_resp_contato->ViewCustomAttributes = "";

		// processo_resp_ata
		$this->processo_resp_ata->ViewValue = $this->processo_resp_ata->CurrentValue;
		$this->processo_resp_ata->ViewCustomAttributes = "";

		// processo_cont_nome
		$this->processo_cont_nome->ViewValue = $this->processo_cont_nome->CurrentValue;
		$this->processo_cont_nome->ViewCustomAttributes = "";

		// processo_cont_end
		$this->processo_cont_end->ViewValue = $this->processo_cont_end->CurrentValue;
		$this->processo_cont_end->ViewCustomAttributes = "";

		// processo_cont_contato
		$this->processo_cont_contato->ViewValue = $this->processo_cont_contato->CurrentValue;
		$this->processo_cont_contato->ViewCustomAttributes = "";

		// processo_cont_indent
		$this->processo_cont_indent->ViewValue = $this->processo_cont_indent->CurrentValue;
		$this->processo_cont_indent->ViewCustomAttributes = "";

		// processo_preenc_nome
		$this->processo_preenc_nome->ViewValue = $this->processo_preenc_nome->CurrentValue;
		$this->processo_preenc_nome->ViewCustomAttributes = "";

		// processo_preenc_carg
		$this->processo_preenc_carg->ViewValue = $this->processo_preenc_carg->CurrentValue;
		$this->processo_preenc_carg->ViewCustomAttributes = "";

		// processo_preenc_end
		$this->processo_preenc_end->ViewValue = $this->processo_preenc_end->CurrentValue;
		$this->processo_preenc_end->ViewCustomAttributes = "";

		// processo_preenc_contato
		$this->processo_preenc_contato->ViewValue = $this->processo_preenc_contato->CurrentValue;
		$this->processo_preenc_contato->ViewCustomAttributes = "";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->ViewValue = $this->processo_preenc_indentifica->CurrentValue;
		$this->processo_preenc_indentifica->ViewCustomAttributes = "";

			// processo_exercicio
			$this->processo_exercicio->LinkCustomAttributes = "";
			$this->processo_exercicio->HrefValue = "";
			$this->processo_exercicio->TooltipValue = "";

			// processo_termo_num
			$this->processo_termo_num->LinkCustomAttributes = "";
			$this->processo_termo_num->HrefValue = "";
			$this->processo_termo_num->TooltipValue = "";

			// processo_numero
			$this->processo_numero->LinkCustomAttributes = "";
			$this->processo_numero->HrefValue = "";
			$this->processo_numero->TooltipValue = "";

			// processo_vigencia_ini
			$this->processo_vigencia_ini->LinkCustomAttributes = "";
			$this->processo_vigencia_ini->HrefValue = "";
			$this->processo_vigencia_ini->TooltipValue = "";

			// processo_vigencia_fim
			$this->processo_vigencia_fim->LinkCustomAttributes = "";
			$this->processo_vigencia_fim->HrefValue = "";
			$this->processo_vigencia_fim->TooltipValue = "";

			// processo_data
			$this->processo_data->LinkCustomAttributes = "";
			$this->processo_data->HrefValue = "";
			$this->processo_data->TooltipValue = "";

			// processo_valor
			$this->processo_valor->LinkCustomAttributes = "";
			$this->processo_valor->HrefValue = "";
			if ($this->Export == "") {
				$this->processo_valor->TooltipValue = ($this->processo_valor->ViewValue <> "") ? $this->processo_valor->ViewValue : $this->processo_valor->CurrentValue;
				if ($this->processo_valor->HrefValue == "") $this->processo_valor->HrefValue = "javascript:void(0);";
				ew_AppendClass($this->processo_valor->LinkAttrs["class"], "ewTooltipLink");
				$this->processo_valor->LinkAttrs["data-tooltip-id"] = "tt_rc25_a_termos_x_processo_valor";
				$this->processo_valor->LinkAttrs["data-tooltip-width"] = $this->processo_valor->TooltipWidth;
				$this->processo_valor->LinkAttrs["data-placement"] = $GLOBALS["EW_CSS_FLIP"] ? "left" : "right";
			}

			// processo_objeto
			$this->processo_objeto->LinkCustomAttributes = "";
			$this->processo_objeto->HrefValue = "";
			$this->processo_objeto->TooltipValue = "";

			// processo_metas
			$this->processo_metas->LinkCustomAttributes = "";
			$this->processo_metas->HrefValue = "";
			$this->processo_metas->TooltipValue = "";

			// processo_origem
			$this->processo_origem->LinkCustomAttributes = "";
			$this->processo_origem->HrefValue = "";
			$this->processo_origem->TooltipValue = "";

			// processo_ent_endereco
			$this->processo_ent_endereco->LinkCustomAttributes = "";
			$this->processo_ent_endereco->HrefValue = "";
			$this->processo_ent_endereco->TooltipValue = "";

			// processo_ent_estatuto
			$this->processo_ent_estatuto->LinkCustomAttributes = "";
			if (!empty($this->processo_ent_estatuto->Upload->DbValue)) {
				$this->processo_ent_estatuto->HrefValue = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
				$this->processo_ent_estatuto->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->processo_ent_estatuto->HrefValue = ew_FullUrl($this->processo_ent_estatuto->HrefValue, "href");
			} else {
				$this->processo_ent_estatuto->HrefValue = "";
			}
			$this->processo_ent_estatuto->HrefValue2 = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->TooltipValue = "";

			// processo_ent_lei
			$this->processo_ent_lei->LinkCustomAttributes = "";
			$this->processo_ent_lei->HrefValue = "";
			$this->processo_ent_lei->TooltipValue = "";

			// processo_ent_cebas
			$this->processo_ent_cebas->LinkCustomAttributes = "";
			$this->processo_ent_cebas->HrefValue = "";
			$this->processo_ent_cebas->TooltipValue = "";

			// processo_resp_nome
			$this->processo_resp_nome->LinkCustomAttributes = "";
			$this->processo_resp_nome->HrefValue = "";
			$this->processo_resp_nome->TooltipValue = "";

			// processo_resp_cargo
			$this->processo_resp_cargo->LinkCustomAttributes = "";
			$this->processo_resp_cargo->HrefValue = "";
			$this->processo_resp_cargo->TooltipValue = "";

			// processo_resp_end
			$this->processo_resp_end->LinkCustomAttributes = "";
			$this->processo_resp_end->HrefValue = "";
			$this->processo_resp_end->TooltipValue = "";

			// processo_resp_contato
			$this->processo_resp_contato->LinkCustomAttributes = "";
			$this->processo_resp_contato->HrefValue = "";
			$this->processo_resp_contato->TooltipValue = "";

			// processo_resp_ata
			$this->processo_resp_ata->LinkCustomAttributes = "";
			$this->processo_resp_ata->HrefValue = "";
			$this->processo_resp_ata->TooltipValue = "";

			// processo_cont_nome
			$this->processo_cont_nome->LinkCustomAttributes = "";
			$this->processo_cont_nome->HrefValue = "";
			$this->processo_cont_nome->TooltipValue = "";

			// processo_cont_end
			$this->processo_cont_end->LinkCustomAttributes = "";
			$this->processo_cont_end->HrefValue = "";
			$this->processo_cont_end->TooltipValue = "";

			// processo_cont_contato
			$this->processo_cont_contato->LinkCustomAttributes = "";
			$this->processo_cont_contato->HrefValue = "";
			$this->processo_cont_contato->TooltipValue = "";

			// processo_cont_indent
			$this->processo_cont_indent->LinkCustomAttributes = "";
			$this->processo_cont_indent->HrefValue = "";
			$this->processo_cont_indent->TooltipValue = "";

			// processo_preenc_nome
			$this->processo_preenc_nome->LinkCustomAttributes = "";
			$this->processo_preenc_nome->HrefValue = "";
			$this->processo_preenc_nome->TooltipValue = "";

			// processo_preenc_carg
			$this->processo_preenc_carg->LinkCustomAttributes = "";
			$this->processo_preenc_carg->HrefValue = "";
			$this->processo_preenc_carg->TooltipValue = "";

			// processo_preenc_end
			$this->processo_preenc_end->LinkCustomAttributes = "";
			$this->processo_preenc_end->HrefValue = "";
			$this->processo_preenc_end->TooltipValue = "";

			// processo_preenc_contato
			$this->processo_preenc_contato->LinkCustomAttributes = "";
			$this->processo_preenc_contato->HrefValue = "";
			$this->processo_preenc_contato->TooltipValue = "";

			// processo_preenc_indentifica
			$this->processo_preenc_indentifica->LinkCustomAttributes = "";
			$this->processo_preenc_indentifica->HrefValue = "";
			$this->processo_preenc_indentifica->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("rc25_a_repasses", $DetailTblVar)) {
				if (!isset($GLOBALS["rc25_a_repasses_grid"]))
					$GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid;
				if ($GLOBALS["rc25_a_repasses_grid"]->DetailView) {
					$GLOBALS["rc25_a_repasses_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["rc25_a_repasses_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["rc25_a_repasses_grid"]->setStartRecordNumber(1);
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->FldIsDetailKey = TRUE;
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->CurrentValue = $this->processo_id->CurrentValue;
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->setSessionValue($GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->CurrentValue);
				}
			}
			if (in_array("rc25_a_planos_aplicacao", $DetailTblVar)) {
				if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"]))
					$GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid;
				if ($GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailView) {
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->setStartRecordNumber(1);
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->FldIsDetailKey = TRUE;
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->CurrentValue = $this->processo_exercicio->CurrentValue;
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->setSessionValue($GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_termoslist.php"), "", $this->TableVar, TRUE);
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
		$pages->Add(3);
		$pages->Add(4);
		$pages->Add(5);
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
if (!isset($rc25_a_termos_view)) $rc25_a_termos_view = new crc25_a_termos_view();

// Page init
$rc25_a_termos_view->Page_Init();

// Page main
$rc25_a_termos_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_termos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frc25_a_termosview = new ew_Form("frc25_a_termosview", "view");

// Form_CustomValidate event
frc25_a_termosview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_termosview.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frc25_a_termosview.MultiPage = new ew_MultiPage("frc25_a_termosview");

// Dynamic selection lists
frc25_a_termosview.Lists["x_processo_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_termosview.Lists["x_processo_exercicio"].Data = "<?php echo $rc25_a_termos_view->processo_exercicio->LookupFilterQuery(FALSE, "view") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $rc25_a_termos_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rc25_a_termos_view->OtherOptions as &$option)
		$option->Render("body");
?>
<div class="clearfix"></div>
</div>
<?php $rc25_a_termos_view->ShowPageHeader(); ?>
<?php
$rc25_a_termos_view->ShowMessage();
?>
<?php if (!$rc25_a_termos_view->IsModal) { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_termos_view->Pager)) $rc25_a_termos_view->Pager = new cPrevNextPager($rc25_a_termos_view->StartRec, $rc25_a_termos_view->DisplayRecs, $rc25_a_termos_view->TotalRecs, $rc25_a_termos_view->AutoHidePager) ?>
<?php if ($rc25_a_termos_view->Pager->RecordCount > 0 && $rc25_a_termos_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_termos_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_termos_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_termos_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_termos_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_termos_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_termos_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frc25_a_termosview" id="frc25_a_termosview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_termos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_termos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_termos">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_termos_view->IsModal) ?>">
<?php if ($rc25_a_termos->Export == "") { ?>
<div class="ewMultiPage">
<div class="nav-tabs-custom" id="rc25_a_termos_view">
	<ul class="nav<?php echo $rc25_a_termos_view->MultiPages->NavStyle() ?>">
		<li<?php echo $rc25_a_termos_view->MultiPages->TabStyle("1") ?>><a href="#tab_rc25_a_termos1" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(1) ?></a></li>
		<li<?php echo $rc25_a_termos_view->MultiPages->TabStyle("2") ?>><a href="#tab_rc25_a_termos2" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(2) ?></a></li>
		<li<?php echo $rc25_a_termos_view->MultiPages->TabStyle("3") ?>><a href="#tab_rc25_a_termos3" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(3) ?></a></li>
		<li<?php echo $rc25_a_termos_view->MultiPages->TabStyle("4") ?>><a href="#tab_rc25_a_termos4" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(4) ?></a></li>
		<li<?php echo $rc25_a_termos_view->MultiPages->TabStyle("5") ?>><a href="#tab_rc25_a_termos5" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_termos_view->MultiPages->PageStyle("1") ?>" id="tab_rc25_a_termos1">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
	<tr id="r_processo_exercicio">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_exercicio"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></span></td>
		<td data-name="processo_exercicio"<?php echo $rc25_a_termos->processo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_exercicio" data-page="1">
<span<?php echo $rc25_a_termos->processo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
	<tr id="r_processo_termo_num">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_termo_num"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?></span></td>
		<td data-name="processo_termo_num"<?php echo $rc25_a_termos->processo_termo_num->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_termo_num" data-page="1">
<span<?php echo $rc25_a_termos->processo_termo_num->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_termo_num->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
	<tr id="r_processo_numero">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_numero"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?></span></td>
		<td data-name="processo_numero"<?php echo $rc25_a_termos->processo_numero->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_numero" data-page="1">
<span<?php echo $rc25_a_termos->processo_numero->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_numero->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
	<tr id="r_processo_vigencia_ini">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_vigencia_ini"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></span></td>
		<td data-name="processo_vigencia_ini"<?php echo $rc25_a_termos->processo_vigencia_ini->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_ini" data-page="1">
<span<?php echo $rc25_a_termos->processo_vigencia_ini->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_ini->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
	<tr id="r_processo_vigencia_fim">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_vigencia_fim"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></span></td>
		<td data-name="processo_vigencia_fim"<?php echo $rc25_a_termos->processo_vigencia_fim->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_fim" data-page="1">
<span<?php echo $rc25_a_termos->processo_vigencia_fim->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_fim->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_data->Visible) { // processo_data ?>
	<tr id="r_processo_data">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_data"><?php echo $rc25_a_termos->processo_data->FldCaption() ?></span></td>
		<td data-name="processo_data"<?php echo $rc25_a_termos->processo_data->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_data" data-page="1">
<span<?php echo $rc25_a_termos->processo_data->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_data->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_valor->Visible) { // processo_valor ?>
	<tr id="r_processo_valor">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_valor"><?php echo $rc25_a_termos->processo_valor->FldCaption() ?></span></td>
		<td data-name="processo_valor"<?php echo $rc25_a_termos->processo_valor->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_valor" data-page="1">
<span<?php echo $rc25_a_termos->processo_valor->ViewAttributes() ?>>
<?php if ((!ew_EmptyStr($rc25_a_termos->processo_valor->TooltipValue)) && $rc25_a_termos->processo_valor->LinkAttributes() <> "") { ?>
<a<?php echo $rc25_a_termos->processo_valor->LinkAttributes() ?>><?php echo $rc25_a_termos->processo_valor->ViewValue ?></a>
<?php } else { ?>
<?php echo $rc25_a_termos->processo_valor->ViewValue ?>
<?php } ?>
<span id="tt_rc25_a_termos_x_processo_valor" style="display: none">
<?php echo $rc25_a_termos->processo_valor->TooltipValue ?>
</span></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_objeto->Visible) { // processo_objeto ?>
	<tr id="r_processo_objeto">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_objeto"><?php echo $rc25_a_termos->processo_objeto->FldCaption() ?></span></td>
		<td data-name="processo_objeto"<?php echo $rc25_a_termos->processo_objeto->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_objeto" data-page="1">
<span<?php echo $rc25_a_termos->processo_objeto->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_objeto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_metas->Visible) { // processo_metas ?>
	<tr id="r_processo_metas">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_metas"><?php echo $rc25_a_termos->processo_metas->FldCaption() ?></span></td>
		<td data-name="processo_metas"<?php echo $rc25_a_termos->processo_metas->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_metas" data-page="1">
<span<?php echo $rc25_a_termos->processo_metas->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_metas->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_origem->Visible) { // processo_origem ?>
	<tr id="r_processo_origem">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_origem"><?php echo $rc25_a_termos->processo_origem->FldCaption() ?></span></td>
		<td data-name="processo_origem"<?php echo $rc25_a_termos->processo_origem->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_origem" data-page="1">
<span<?php echo $rc25_a_termos->processo_origem->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_origem->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_termos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_termos_view->MultiPages->PageStyle("2") ?>" id="tab_rc25_a_termos2">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_termos->processo_ent_endereco->Visible) { // processo_ent_endereco ?>
	<tr id="r_processo_ent_endereco">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_ent_endereco"><?php echo $rc25_a_termos->processo_ent_endereco->FldCaption() ?></span></td>
		<td data-name="processo_ent_endereco"<?php echo $rc25_a_termos->processo_ent_endereco->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_endereco" data-page="2">
<span<?php echo $rc25_a_termos->processo_ent_endereco->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_ent_endereco->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_estatuto->Visible) { // processo_ent_estatuto ?>
	<tr id="r_processo_ent_estatuto">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_ent_estatuto"><?php echo $rc25_a_termos->processo_ent_estatuto->FldCaption() ?></span></td>
		<td data-name="processo_ent_estatuto"<?php echo $rc25_a_termos->processo_ent_estatuto->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_estatuto" data-page="2">
<span<?php echo $rc25_a_termos->processo_ent_estatuto->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($rc25_a_termos->processo_ent_estatuto, $rc25_a_termos->processo_ent_estatuto->ViewValue) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_lei->Visible) { // processo_ent_lei ?>
	<tr id="r_processo_ent_lei">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_ent_lei"><?php echo $rc25_a_termos->processo_ent_lei->FldCaption() ?></span></td>
		<td data-name="processo_ent_lei"<?php echo $rc25_a_termos->processo_ent_lei->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_lei" data-page="2">
<span<?php echo $rc25_a_termos->processo_ent_lei->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_ent_lei->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_cebas->Visible) { // processo_ent_cebas ?>
	<tr id="r_processo_ent_cebas">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_ent_cebas"><?php echo $rc25_a_termos->processo_ent_cebas->FldCaption() ?></span></td>
		<td data-name="processo_ent_cebas"<?php echo $rc25_a_termos->processo_ent_cebas->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_cebas" data-page="2">
<span<?php echo $rc25_a_termos->processo_ent_cebas->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_ent_cebas->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_termos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_termos_view->MultiPages->PageStyle("3") ?>" id="tab_rc25_a_termos3">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_termos->processo_resp_nome->Visible) { // processo_resp_nome ?>
	<tr id="r_processo_resp_nome">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_resp_nome"><?php echo $rc25_a_termos->processo_resp_nome->FldCaption() ?></span></td>
		<td data-name="processo_resp_nome"<?php echo $rc25_a_termos->processo_resp_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_nome" data-page="3">
<span<?php echo $rc25_a_termos->processo_resp_nome->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_resp_nome->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_cargo->Visible) { // processo_resp_cargo ?>
	<tr id="r_processo_resp_cargo">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_resp_cargo"><?php echo $rc25_a_termos->processo_resp_cargo->FldCaption() ?></span></td>
		<td data-name="processo_resp_cargo"<?php echo $rc25_a_termos->processo_resp_cargo->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_cargo" data-page="3">
<span<?php echo $rc25_a_termos->processo_resp_cargo->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_resp_cargo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_end->Visible) { // processo_resp_end ?>
	<tr id="r_processo_resp_end">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_resp_end"><?php echo $rc25_a_termos->processo_resp_end->FldCaption() ?></span></td>
		<td data-name="processo_resp_end"<?php echo $rc25_a_termos->processo_resp_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_end" data-page="3">
<span<?php echo $rc25_a_termos->processo_resp_end->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_resp_end->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_contato->Visible) { // processo_resp_contato ?>
	<tr id="r_processo_resp_contato">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_resp_contato"><?php echo $rc25_a_termos->processo_resp_contato->FldCaption() ?></span></td>
		<td data-name="processo_resp_contato"<?php echo $rc25_a_termos->processo_resp_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_contato" data-page="3">
<span<?php echo $rc25_a_termos->processo_resp_contato->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_resp_contato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_ata->Visible) { // processo_resp_ata ?>
	<tr id="r_processo_resp_ata">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_resp_ata"><?php echo $rc25_a_termos->processo_resp_ata->FldCaption() ?></span></td>
		<td data-name="processo_resp_ata"<?php echo $rc25_a_termos->processo_resp_ata->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_ata" data-page="3">
<span<?php echo $rc25_a_termos->processo_resp_ata->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_resp_ata->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_termos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_termos_view->MultiPages->PageStyle("4") ?>" id="tab_rc25_a_termos4">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_termos->processo_cont_nome->Visible) { // processo_cont_nome ?>
	<tr id="r_processo_cont_nome">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_cont_nome"><?php echo $rc25_a_termos->processo_cont_nome->FldCaption() ?></span></td>
		<td data-name="processo_cont_nome"<?php echo $rc25_a_termos->processo_cont_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_nome" data-page="4">
<span<?php echo $rc25_a_termos->processo_cont_nome->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_cont_nome->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_end->Visible) { // processo_cont_end ?>
	<tr id="r_processo_cont_end">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_cont_end"><?php echo $rc25_a_termos->processo_cont_end->FldCaption() ?></span></td>
		<td data-name="processo_cont_end"<?php echo $rc25_a_termos->processo_cont_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_end" data-page="4">
<span<?php echo $rc25_a_termos->processo_cont_end->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_cont_end->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_contato->Visible) { // processo_cont_contato ?>
	<tr id="r_processo_cont_contato">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_cont_contato"><?php echo $rc25_a_termos->processo_cont_contato->FldCaption() ?></span></td>
		<td data-name="processo_cont_contato"<?php echo $rc25_a_termos->processo_cont_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_contato" data-page="4">
<span<?php echo $rc25_a_termos->processo_cont_contato->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_cont_contato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_indent->Visible) { // processo_cont_indent ?>
	<tr id="r_processo_cont_indent">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_cont_indent"><?php echo $rc25_a_termos->processo_cont_indent->FldCaption() ?></span></td>
		<td data-name="processo_cont_indent"<?php echo $rc25_a_termos->processo_cont_indent->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_indent" data-page="4">
<span<?php echo $rc25_a_termos->processo_cont_indent->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_cont_indent->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_termos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
		<div class="tab-pane<?php echo $rc25_a_termos_view->MultiPages->PageStyle("5") ?>" id="tab_rc25_a_termos5">
<?php } ?>
<table class="table table-striped table-bordered table-hover table-condensed ewViewTable">
<?php if ($rc25_a_termos->processo_preenc_nome->Visible) { // processo_preenc_nome ?>
	<tr id="r_processo_preenc_nome">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_preenc_nome"><?php echo $rc25_a_termos->processo_preenc_nome->FldCaption() ?></span></td>
		<td data-name="processo_preenc_nome"<?php echo $rc25_a_termos->processo_preenc_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_nome" data-page="5">
<span<?php echo $rc25_a_termos->processo_preenc_nome->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_preenc_nome->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_carg->Visible) { // processo_preenc_carg ?>
	<tr id="r_processo_preenc_carg">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_preenc_carg"><?php echo $rc25_a_termos->processo_preenc_carg->FldCaption() ?></span></td>
		<td data-name="processo_preenc_carg"<?php echo $rc25_a_termos->processo_preenc_carg->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_carg" data-page="5">
<span<?php echo $rc25_a_termos->processo_preenc_carg->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_preenc_carg->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_end->Visible) { // processo_preenc_end ?>
	<tr id="r_processo_preenc_end">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_preenc_end"><?php echo $rc25_a_termos->processo_preenc_end->FldCaption() ?></span></td>
		<td data-name="processo_preenc_end"<?php echo $rc25_a_termos->processo_preenc_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_end" data-page="5">
<span<?php echo $rc25_a_termos->processo_preenc_end->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_preenc_end->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_contato->Visible) { // processo_preenc_contato ?>
	<tr id="r_processo_preenc_contato">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_preenc_contato"><?php echo $rc25_a_termos->processo_preenc_contato->FldCaption() ?></span></td>
		<td data-name="processo_preenc_contato"<?php echo $rc25_a_termos->processo_preenc_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_contato" data-page="5">
<span<?php echo $rc25_a_termos->processo_preenc_contato->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_preenc_contato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_indentifica->Visible) { // processo_preenc_indentifica ?>
	<tr id="r_processo_preenc_indentifica">
		<td class="col-sm-2"><span id="elh_rc25_a_termos_processo_preenc_indentifica"><?php echo $rc25_a_termos->processo_preenc_indentifica->FldCaption() ?></span></td>
		<td data-name="processo_preenc_indentifica"<?php echo $rc25_a_termos->processo_preenc_indentifica->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_indentifica" data-page="5">
<span<?php echo $rc25_a_termos->processo_preenc_indentifica->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_preenc_indentifica->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rc25_a_termos->Export == "") { ?>
		</div>
<?php } ?>
<?php if ($rc25_a_termos->Export == "") { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$rc25_a_termos_view->IsModal) { ?>
<?php if (!isset($rc25_a_termos_view->Pager)) $rc25_a_termos_view->Pager = new cPrevNextPager($rc25_a_termos_view->StartRec, $rc25_a_termos_view->DisplayRecs, $rc25_a_termos_view->TotalRecs, $rc25_a_termos_view->AutoHidePager) ?>
<?php if ($rc25_a_termos_view->Pager->RecordCount > 0 && $rc25_a_termos_view->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_termos_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_termos_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_termos_view->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_termos_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_termos_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_termos_view->PageUrl() ?>start=<?php echo $rc25_a_termos_view->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_termos_view->Pager->PageCount ?></span>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php
	if (in_array("rc25_a_repasses", explode(",", $rc25_a_termos->getCurrentDetailTable())) && $rc25_a_repasses->DetailView) {
?>
<?php if ($rc25_a_termos->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("rc25_a_repasses", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rc25_a_repassesgrid.php" ?>
<?php } ?>
<?php
	if (in_array("rc25_a_planos_aplicacao", explode(",", $rc25_a_termos->getCurrentDetailTable())) && $rc25_a_planos_aplicacao->DetailView) {
?>
<?php if ($rc25_a_termos->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("rc25_a_planos_aplicacao", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rc25_a_planos_aplicacaogrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_termosview.Init();
</script>
<?php
$rc25_a_termos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_termos_view->Page_Terminate();
?>
