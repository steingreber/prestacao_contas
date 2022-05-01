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

$rc25_a_repasses_list = NULL; // Initialize page object first

class crc25_a_repasses_list extends crc25_a_repasses {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_repasses';

	// Page object name
	var $PageObjName = 'rc25_a_repasses_list';

	// Grid form hidden field names
	var $FormName = 'frc25_a_repasseslist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Table object (rc25_a_repasses)
		if (!isset($GLOBALS["rc25_a_repasses"]) || get_class($GLOBALS["rc25_a_repasses"]) == "crc25_a_repasses") {
			$GLOBALS["rc25_a_repasses"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_repasses"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rc25_a_repassesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rc25_a_repassesdelete.php";
		$this->MultiUpdateUrl = "rc25_a_repassesupdate.php";

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption frc25_a_repasseslistsrch";

		// List actions
		$this->ListActions = new cListActions();
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
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

		// Set up master detail parameters
		$this->SetupMasterParms();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Set up sorting order
			$this->SetupSortOrder();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Build filter
		$sFilter = "";

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "rc25_a_termos") {
			global $rc25_a_termos;
			$rsmaster = $rc25_a_termos->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("rc25_a_termoslist.php"); // Return to master page
			} else {
				$rc25_a_termos->LoadListRowValues($rsmaster);
				$rc25_a_termos->RowType = EW_ROWTYPE_MASTER; // Master row
				$rc25_a_termos->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->repasse_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->repasse_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->repasse_id_termos); // repasse_id_termos
			$this->UpdateSort($this->repasse_faixa_etaria); // repasse_faixa_etaria
			$this->UpdateSort($this->repasse_meta); // repasse_meta
			$this->UpdateSort($this->repasse_valor_unitario); // repasse_valor_unitario
			$this->UpdateSort($this->repasse_valor_mes); // repasse_valor_mes
			$this->UpdateSort($this->repasse_valor_previsto); // repasse_valor_previsto
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->repasse_id_termos->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->repasse_id_termos->setSort("");
				$this->repasse_faixa_etaria->setSort("");
				$this->repasse_meta->setSort("");
				$this->repasse_valor_unitario->setSort("");
				$this->repasse_valor_mes->setSort("");
				$this->repasse_valor_previsto->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = TRUE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if (TRUE)
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->repasse_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "");
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = TRUE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"frc25_a_repasseslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"frc25_a_repasseslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.frc25_a_repasseslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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
		$row = array();
		$row['repasse_id'] = NULL;
		$row['repasse_id_termos'] = NULL;
		$row['repasse_faixa_etaria'] = NULL;
		$row['repasse_meta'] = NULL;
		$row['repasse_valor_unitario'] = NULL;
		$row['repasse_valor_mes'] = NULL;
		$row['repasse_valor_previsto'] = NULL;
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

		$this->repasse_id->CellCssStyle = "white-space: nowrap;";

		// repasse_id_termos
		// repasse_faixa_etaria
		// repasse_meta
		// repasse_valor_unitario
		// repasse_valor_mes
		// repasse_valor_previsto
		// Accumulate aggregate value

		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT && $this->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($this->repasse_valor_previsto->CurrentValue))
				$this->repasse_valor_previsto->Total += $this->repasse_valor_previsto->CurrentValue; // Accumulate total
		}
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
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->repasse_valor_previsto->Total = 0; // Initialize total
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$this->repasse_valor_previsto->CurrentValue = $this->repasse_valor_previsto->Total;
			$this->repasse_valor_previsto->ViewValue = $this->repasse_valor_previsto->CurrentValue;
			$this->repasse_valor_previsto->ViewValue = ew_FormatCurrency($this->repasse_valor_previsto->ViewValue, 2, -2, -2, -2);
			$this->repasse_valor_previsto->CellCssStyle .= "text-align: right;";
			$this->repasse_valor_previsto->ViewCustomAttributes = "";
			$this->repasse_valor_previsto->HrefValue = ""; // Clear href value
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

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($rc25_a_repasses_list)) $rc25_a_repasses_list = new crc25_a_repasses_list();

// Page init
$rc25_a_repasses_list->Page_Init();

// Page main
$rc25_a_repasses_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_repasses_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = frc25_a_repasseslist = new ew_Form("frc25_a_repasseslist", "list");
frc25_a_repasseslist.FormKeyCountName = '<?php echo $rc25_a_repasses_list->FormKeyCountName ?>';

// Form_CustomValidate event
frc25_a_repasseslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_repasseslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_repasseslist.Lists["x_repasse_id_termos"] = {"LinkField":"x_processo_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_processo_termo_num","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_termos"};
frc25_a_repasseslist.Lists["x_repasse_id_termos"].Data = "<?php echo $rc25_a_repasses_list->repasse_id_termos->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($rc25_a_repasses_list->TotalRecs > 0 && $rc25_a_repasses_list->ExportOptions->Visible()) { ?>
<?php $rc25_a_repasses_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php if (($rc25_a_repasses->Export == "") || (EW_EXPORT_MASTER_RECORD && $rc25_a_repasses->Export == "print")) { ?>
<?php
if ($rc25_a_repasses_list->DbMasterFilter <> "" && $rc25_a_repasses->getCurrentMasterTable() == "rc25_a_termos") {
	if ($rc25_a_repasses_list->MasterRecordExists) {
?>
<?php include_once "rc25_a_termosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $rc25_a_repasses_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_repasses_list->TotalRecs <= 0)
			$rc25_a_repasses_list->TotalRecs = $rc25_a_repasses->ListRecordCount();
	} else {
		if (!$rc25_a_repasses_list->Recordset && ($rc25_a_repasses_list->Recordset = $rc25_a_repasses_list->LoadRecordset()))
			$rc25_a_repasses_list->TotalRecs = $rc25_a_repasses_list->Recordset->RecordCount();
	}
	$rc25_a_repasses_list->StartRec = 1;
	if ($rc25_a_repasses_list->DisplayRecs <= 0 || ($rc25_a_repasses->Export <> "" && $rc25_a_repasses->ExportAll)) // Display all records
		$rc25_a_repasses_list->DisplayRecs = $rc25_a_repasses_list->TotalRecs;
	if (!($rc25_a_repasses->Export <> "" && $rc25_a_repasses->ExportAll))
		$rc25_a_repasses_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rc25_a_repasses_list->Recordset = $rc25_a_repasses_list->LoadRecordset($rc25_a_repasses_list->StartRec-1, $rc25_a_repasses_list->DisplayRecs);

	// Set no record found message
	if ($rc25_a_repasses->CurrentAction == "" && $rc25_a_repasses_list->TotalRecs == 0) {
		if ($rc25_a_repasses_list->SearchWhere == "0=101")
			$rc25_a_repasses_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_repasses_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$rc25_a_repasses_list->RenderOtherOptions();
?>
<?php $rc25_a_repasses_list->ShowPageHeader(); ?>
<?php
$rc25_a_repasses_list->ShowMessage();
?>
<?php if ($rc25_a_repasses_list->TotalRecs > 0 || $rc25_a_repasses->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_repasses_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_repasses">
<div class="box-header ewGridUpperPanel">
<?php if ($rc25_a_repasses->CurrentAction <> "gridadd" && $rc25_a_repasses->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_repasses_list->Pager)) $rc25_a_repasses_list->Pager = new cPrevNextPager($rc25_a_repasses_list->StartRec, $rc25_a_repasses_list->DisplayRecs, $rc25_a_repasses_list->TotalRecs, $rc25_a_repasses_list->AutoHidePager) ?>
<?php if ($rc25_a_repasses_list->Pager->RecordCount > 0 && $rc25_a_repasses_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_repasses_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_repasses_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_repasses_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_repasses_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_repasses_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_repasses_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_repasses_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="frc25_a_repasseslist" id="frc25_a_repasseslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_repasses_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_repasses_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_repasses">
<?php if ($rc25_a_repasses->getCurrentMasterTable() == "rc25_a_termos" && $rc25_a_repasses->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="rc25_a_termos">
<input type="hidden" name="fk_processo_id" value="<?php echo $rc25_a_repasses->repasse_id_termos->getSessionValue() ?>">
<?php } ?>
<div id="gmp_rc25_a_repasses" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($rc25_a_repasses_list->TotalRecs > 0 || $rc25_a_repasses->CurrentAction == "gridedit") { ?>
<table id="tbl_rc25_a_repasseslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_repasses_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_repasses_list->RenderListOptions();

// Render list options (header, left)
$rc25_a_repasses_list->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_id_termos) == "") { ?>
		<th data-name="repasse_id_termos" class="<?php echo $rc25_a_repasses->repasse_id_termos->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_id_termos" class="<?php echo $rc25_a_repasses->repasse_id_termos->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_id_termos) ?>',1);"><div id="elh_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_id_termos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_id_termos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_faixa_etaria) == "") { ?>
		<th data-name="repasse_faixa_etaria" class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_faixa_etaria" class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_faixa_etaria) ?>',1);"><div id="elh_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_faixa_etaria->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_faixa_etaria->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_meta) == "") { ?>
		<th data-name="repasse_meta" class="<?php echo $rc25_a_repasses->repasse_meta->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_meta" class="<?php echo $rc25_a_repasses->repasse_meta->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_meta) ?>',1);"><div id="elh_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_meta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_meta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_unitario) == "") { ?>
		<th data-name="repasse_valor_unitario" class="<?php echo $rc25_a_repasses->repasse_valor_unitario->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_unitario" class="<?php echo $rc25_a_repasses->repasse_valor_unitario->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_unitario) ?>',1);"><div id="elh_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_unitario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_unitario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_mes) == "") { ?>
		<th data-name="repasse_valor_mes" class="<?php echo $rc25_a_repasses->repasse_valor_mes->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_mes" class="<?php echo $rc25_a_repasses->repasse_valor_mes->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_mes) ?>',1);"><div id="elh_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_mes->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_mes->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_previsto) == "") { ?>
		<th data-name="repasse_valor_previsto" class="<?php echo $rc25_a_repasses->repasse_valor_previsto->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_previsto" class="<?php echo $rc25_a_repasses->repasse_valor_previsto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_previsto) ?>',1);"><div id="elh_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_previsto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_previsto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_repasses_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rc25_a_repasses->ExportAll && $rc25_a_repasses->Export <> "") {
	$rc25_a_repasses_list->StopRec = $rc25_a_repasses_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rc25_a_repasses_list->TotalRecs > $rc25_a_repasses_list->StartRec + $rc25_a_repasses_list->DisplayRecs - 1)
		$rc25_a_repasses_list->StopRec = $rc25_a_repasses_list->StartRec + $rc25_a_repasses_list->DisplayRecs - 1;
	else
		$rc25_a_repasses_list->StopRec = $rc25_a_repasses_list->TotalRecs;
}
$rc25_a_repasses_list->RecCnt = $rc25_a_repasses_list->StartRec - 1;
if ($rc25_a_repasses_list->Recordset && !$rc25_a_repasses_list->Recordset->EOF) {
	$rc25_a_repasses_list->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_repasses_list->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_repasses_list->StartRec > 1)
		$rc25_a_repasses_list->Recordset->Move($rc25_a_repasses_list->StartRec - 1);
} elseif (!$rc25_a_repasses->AllowAddDeleteRow && $rc25_a_repasses_list->StopRec == 0) {
	$rc25_a_repasses_list->StopRec = $rc25_a_repasses->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_repasses->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_repasses->ResetAttrs();
$rc25_a_repasses_list->RenderRow();
while ($rc25_a_repasses_list->RecCnt < $rc25_a_repasses_list->StopRec) {
	$rc25_a_repasses_list->RecCnt++;
	if (intval($rc25_a_repasses_list->RecCnt) >= intval($rc25_a_repasses_list->StartRec)) {
		$rc25_a_repasses_list->RowCnt++;

		// Set up key count
		$rc25_a_repasses_list->KeyCount = $rc25_a_repasses_list->RowIndex;

		// Init row class and style
		$rc25_a_repasses->ResetAttrs();
		$rc25_a_repasses->CssClass = "";
		if ($rc25_a_repasses->CurrentAction == "gridadd") {
		} else {
			$rc25_a_repasses_list->LoadRowValues($rc25_a_repasses_list->Recordset); // Load row values
		}
		$rc25_a_repasses->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rc25_a_repasses->RowAttrs = array_merge($rc25_a_repasses->RowAttrs, array('data-rowindex'=>$rc25_a_repasses_list->RowCnt, 'id'=>'r' . $rc25_a_repasses_list->RowCnt . '_rc25_a_repasses', 'data-rowtype'=>$rc25_a_repasses->RowType));

		// Render row
		$rc25_a_repasses_list->RenderRow();

		// Render list options
		$rc25_a_repasses_list->RenderListOptions();
?>
	<tr<?php echo $rc25_a_repasses->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_repasses_list->ListOptions->Render("body", "left", $rc25_a_repasses_list->RowCnt);
?>
	<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<td data-name="repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<td data-name="repasse_faixa_etaria"<?php echo $rc25_a_repasses->repasse_faixa_etaria->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
<span<?php echo $rc25_a_repasses->repasse_faixa_etaria->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_faixa_etaria->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<td data-name="repasse_meta"<?php echo $rc25_a_repasses->repasse_meta->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
<span<?php echo $rc25_a_repasses->repasse_meta->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_meta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<td data-name="repasse_valor_unitario"<?php echo $rc25_a_repasses->repasse_valor_unitario->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
<span<?php echo $rc25_a_repasses->repasse_valor_unitario->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_unitario->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<td data-name="repasse_valor_mes"<?php echo $rc25_a_repasses->repasse_valor_mes->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
<span<?php echo $rc25_a_repasses->repasse_valor_mes->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_mes->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<td data-name="repasse_valor_previsto"<?php echo $rc25_a_repasses->repasse_valor_previsto->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_list->RowCnt ?>_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
<span<?php echo $rc25_a_repasses->repasse_valor_previsto->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_previsto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_repasses_list->ListOptions->Render("body", "right", $rc25_a_repasses_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($rc25_a_repasses->CurrentAction <> "gridadd")
		$rc25_a_repasses_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$rc25_a_repasses->RowType = EW_ROWTYPE_AGGREGATE;
$rc25_a_repasses->ResetAttrs();
$rc25_a_repasses_list->RenderRow();
?>
<?php if ($rc25_a_repasses_list->TotalRecs > 0 && ($rc25_a_repasses->CurrentAction <> "gridadd" && $rc25_a_repasses->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$rc25_a_repasses_list->RenderListOptions();

// Render list options (footer, left)
$rc25_a_repasses_list->ListOptions->Render("footer", "left");
?>
	<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<td data-name="repasse_id_termos" class="<?php echo $rc25_a_repasses->repasse_id_termos->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<td data-name="repasse_faixa_etaria" class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<td data-name="repasse_meta" class="<?php echo $rc25_a_repasses->repasse_meta->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<td data-name="repasse_valor_unitario" class="<?php echo $rc25_a_repasses->repasse_valor_unitario->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<td data-name="repasse_valor_mes" class="<?php echo $rc25_a_repasses->repasse_valor_mes->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<td data-name="repasse_valor_previsto" class="<?php echo $rc25_a_repasses->repasse_valor_previsto->FooterCellClass() ?>"><span id="elf_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $rc25_a_repasses->repasse_valor_previsto->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$rc25_a_repasses_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table>
<?php } ?>
<?php if ($rc25_a_repasses->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rc25_a_repasses_list->Recordset)
	$rc25_a_repasses_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($rc25_a_repasses->CurrentAction <> "gridadd" && $rc25_a_repasses->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_repasses_list->Pager)) $rc25_a_repasses_list->Pager = new cPrevNextPager($rc25_a_repasses_list->StartRec, $rc25_a_repasses_list->DisplayRecs, $rc25_a_repasses_list->TotalRecs, $rc25_a_repasses_list->AutoHidePager) ?>
<?php if ($rc25_a_repasses_list->Pager->RecordCount > 0 && $rc25_a_repasses_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_repasses_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_repasses_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_repasses_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_repasses_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_repasses_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_repasses_list->PageUrl() ?>start=<?php echo $rc25_a_repasses_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_repasses_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_repasses_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_repasses_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_repasses_list->TotalRecs == 0 && $rc25_a_repasses->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_repasses_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
frc25_a_repasseslist.Init();
</script>
<?php
$rc25_a_repasses_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_repasses_list->Page_Terminate();
?>
