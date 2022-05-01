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

$rc25_a_planos_aplicacao_list = NULL; // Initialize page object first

class crc25_a_planos_aplicacao_list extends crc25_a_planos_aplicacao {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_planos_aplicacao';

	// Page object name
	var $PageObjName = 'rc25_a_planos_aplicacao_list';

	// Grid form hidden field names
	var $FormName = 'frc25_a_planos_aplicacaolist';
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

		// Table object (rc25_a_planos_aplicacao)
		if (!isset($GLOBALS["rc25_a_planos_aplicacao"]) || get_class($GLOBALS["rc25_a_planos_aplicacao"]) == "crc25_a_planos_aplicacao") {
			$GLOBALS["rc25_a_planos_aplicacao"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_planos_aplicacao"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rc25_a_planos_aplicacaoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rc25_a_planos_aplicacaodelete.php";
		$this->MultiUpdateUrl = "rc25_a_planos_aplicacaoupdate.php";

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption frc25_a_planos_aplicacaolistsrch";

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
		$this->plano_exercicio->SetVisibility();
		$this->plano_despesa->SetVisibility();
		$this->plano_custo_mensal->SetVisibility();
		$this->plano_custo_exercicio->SetVisibility();
		$this->plano_recurso_municipal->SetVisibility();
		$this->plano_outros_recursos->SetVisibility();

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

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
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

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

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
			$this->plano_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->plano_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->plano_exercicio->AdvancedSearch->ToJson(), ","); // Field plano_exercicio
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "frc25_a_planos_aplicacaolistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field plano_exercicio
		$this->plano_exercicio->AdvancedSearch->SearchValue = @$filter["x_plano_exercicio"];
		$this->plano_exercicio->AdvancedSearch->SearchOperator = @$filter["z_plano_exercicio"];
		$this->plano_exercicio->AdvancedSearch->SearchCondition = @$filter["v_plano_exercicio"];
		$this->plano_exercicio->AdvancedSearch->SearchValue2 = @$filter["y_plano_exercicio"];
		$this->plano_exercicio->AdvancedSearch->SearchOperator2 = @$filter["w_plano_exercicio"];
		$this->plano_exercicio->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $this->plano_exercicio, $Default, FALSE); // plano_exercicio

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->plano_exercicio->AdvancedSearch->Save(); // plano_exercicio
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = $Fld->FldParm();
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->plano_exercicio, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		if ($this->plano_exercicio->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->plano_exercicio->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->plano_exercicio->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->plano_exercicio); // plano_exercicio
			$this->UpdateSort($this->plano_despesa); // plano_despesa
			$this->UpdateSort($this->plano_custo_mensal); // plano_custo_mensal
			$this->UpdateSort($this->plano_custo_exercicio); // plano_custo_exercicio
			$this->UpdateSort($this->plano_recurso_municipal); // plano_recurso_municipal
			$this->UpdateSort($this->plano_outros_recursos); // plano_outros_recursos
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

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->plano_exercicio->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->plano_exercicio->setSort("");
				$this->plano_despesa->setSort("");
				$this->plano_custo_mensal->setSort("");
				$this->plano_custo_exercicio->setSort("");
				$this->plano_recurso_municipal->setSort("");
				$this->plano_outros_recursos->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->plano_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"frc25_a_planos_aplicacaolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"frc25_a_planos_aplicacaolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.frc25_a_planos_aplicacaolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frc25_a_planos_aplicacaolistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// plano_exercicio

		$this->plano_exercicio->AdvancedSearch->SearchValue = @$_GET["x_plano_exercicio"];
		if ($this->plano_exercicio->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->plano_exercicio->AdvancedSearch->SearchOperator = @$_GET["z_plano_exercicio"];
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("plano_id")) <> "")
			$this->plano_id->CurrentValue = $this->getKey("plano_id"); // plano_id
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

		$this->plano_id->CellCssStyle = "white-space: nowrap;";

		// plano_exercicio
		// plano_despesa

		$this->plano_despesa->CellCssStyle = "white-space: nowrap;";

		// plano_custo_mensal
		$this->plano_custo_mensal->CellCssStyle = "white-space: nowrap;";

		// plano_custo_exercicio
		$this->plano_custo_exercicio->CellCssStyle = "white-space: nowrap;";

		// plano_recurso_municipal
		$this->plano_recurso_municipal->CellCssStyle = "white-space: nowrap;";

		// plano_outros_recursos
		$this->plano_outros_recursos->CellCssStyle = "white-space: nowrap;";

		// plano_data_cadastro
		$this->plano_data_cadastro->CellCssStyle = "white-space: nowrap;";

		// Accumulate aggregate value
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT && $this->RowType <> EW_ROWTYPE_AGGREGATE) {
			if (is_numeric($this->plano_custo_mensal->CurrentValue))
				$this->plano_custo_mensal->Total += $this->plano_custo_mensal->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_custo_exercicio->CurrentValue))
				$this->plano_custo_exercicio->Total += $this->plano_custo_exercicio->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_recurso_municipal->CurrentValue))
				$this->plano_recurso_municipal->Total += $this->plano_recurso_municipal->CurrentValue; // Accumulate total
			if (is_numeric($this->plano_outros_recursos->CurrentValue))
				$this->plano_outros_recursos->Total += $this->plano_outros_recursos->CurrentValue; // Accumulate total
		}
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// plano_exercicio
			$this->plano_exercicio->EditAttrs["class"] = "form-control";
			$this->plano_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->plano_exercicio->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->plano_exercicio->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$this->plano_exercicio->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->plano_exercicio->EditValue = $arwrk;

			// plano_despesa
			$this->plano_despesa->EditAttrs["class"] = "form-control";
			$this->plano_despesa->EditCustomAttributes = "";

			// plano_custo_mensal
			$this->plano_custo_mensal->EditAttrs["class"] = "form-control";
			$this->plano_custo_mensal->EditCustomAttributes = "";
			$this->plano_custo_mensal->EditValue = ew_HtmlEncode($this->plano_custo_mensal->AdvancedSearch->SearchValue);
			$this->plano_custo_mensal->PlaceHolder = ew_RemoveHtml($this->plano_custo_mensal->FldCaption());

			// plano_custo_exercicio
			$this->plano_custo_exercicio->EditAttrs["class"] = "form-control";
			$this->plano_custo_exercicio->EditCustomAttributes = "";
			$this->plano_custo_exercicio->EditValue = ew_HtmlEncode($this->plano_custo_exercicio->AdvancedSearch->SearchValue);
			$this->plano_custo_exercicio->PlaceHolder = ew_RemoveHtml($this->plano_custo_exercicio->FldCaption());

			// plano_recurso_municipal
			$this->plano_recurso_municipal->EditAttrs["class"] = "form-control";
			$this->plano_recurso_municipal->EditCustomAttributes = "";
			$this->plano_recurso_municipal->EditValue = ew_HtmlEncode($this->plano_recurso_municipal->AdvancedSearch->SearchValue);
			$this->plano_recurso_municipal->PlaceHolder = ew_RemoveHtml($this->plano_recurso_municipal->FldCaption());

			// plano_outros_recursos
			$this->plano_outros_recursos->EditAttrs["class"] = "form-control";
			$this->plano_outros_recursos->EditCustomAttributes = "";
			$this->plano_outros_recursos->EditValue = ew_HtmlEncode($this->plano_outros_recursos->AdvancedSearch->SearchValue);
			$this->plano_outros_recursos->PlaceHolder = ew_RemoveHtml($this->plano_outros_recursos->FldCaption());
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATEINIT) { // Initialize aggregate row
			$this->plano_custo_mensal->Total = 0; // Initialize total
			$this->plano_custo_exercicio->Total = 0; // Initialize total
			$this->plano_recurso_municipal->Total = 0; // Initialize total
			$this->plano_outros_recursos->Total = 0; // Initialize total
		} elseif ($this->RowType == EW_ROWTYPE_AGGREGATE) { // Aggregate row
			$this->plano_custo_mensal->CurrentValue = $this->plano_custo_mensal->Total;
			$this->plano_custo_mensal->ViewValue = $this->plano_custo_mensal->CurrentValue;
			$this->plano_custo_mensal->ViewValue = ew_FormatCurrency($this->plano_custo_mensal->ViewValue, 2, -2, -2, -2);
			$this->plano_custo_mensal->CellCssStyle .= "text-align: right;";
			$this->plano_custo_mensal->ViewCustomAttributes = "";
			$this->plano_custo_mensal->HrefValue = ""; // Clear href value
			$this->plano_custo_exercicio->CurrentValue = $this->plano_custo_exercicio->Total;
			$this->plano_custo_exercicio->ViewValue = $this->plano_custo_exercicio->CurrentValue;
			$this->plano_custo_exercicio->ViewValue = ew_FormatCurrency($this->plano_custo_exercicio->ViewValue, 2, -2, -2, -2);
			$this->plano_custo_exercicio->CellCssStyle .= "text-align: right;";
			$this->plano_custo_exercicio->ViewCustomAttributes = "";
			$this->plano_custo_exercicio->HrefValue = ""; // Clear href value
			$this->plano_recurso_municipal->CurrentValue = $this->plano_recurso_municipal->Total;
			$this->plano_recurso_municipal->ViewValue = $this->plano_recurso_municipal->CurrentValue;
			$this->plano_recurso_municipal->ViewValue = ew_FormatCurrency($this->plano_recurso_municipal->ViewValue, 2, -2, -2, -2);
			$this->plano_recurso_municipal->CellCssStyle .= "text-align: right;";
			$this->plano_recurso_municipal->ViewCustomAttributes = "";
			$this->plano_recurso_municipal->HrefValue = ""; // Clear href value
			$this->plano_outros_recursos->CurrentValue = $this->plano_outros_recursos->Total;
			$this->plano_outros_recursos->ViewValue = $this->plano_outros_recursos->CurrentValue;
			$this->plano_outros_recursos->ViewValue = ew_FormatCurrency($this->plano_outros_recursos->ViewValue, 2, -1, -2, -2);
			$this->plano_outros_recursos->CellCssStyle .= "text-align: right;";
			$this->plano_outros_recursos->ViewCustomAttributes = "";
			$this->plano_outros_recursos->HrefValue = ""; // Clear href value
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->plano_exercicio->AdvancedSearch->Load();
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
		case "x_plano_exercicio":
			$sSqlWrk = "";
				$sSqlWrk = "SELECT `ano_ano` AS `LinkFld`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
				$sWhereWrk = "";
				$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ano_ano` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->plano_exercicio, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
			}
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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
if (!isset($rc25_a_planos_aplicacao_list)) $rc25_a_planos_aplicacao_list = new crc25_a_planos_aplicacao_list();

// Page init
$rc25_a_planos_aplicacao_list->Page_Init();

// Page main
$rc25_a_planos_aplicacao_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_planos_aplicacao_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = frc25_a_planos_aplicacaolist = new ew_Form("frc25_a_planos_aplicacaolist", "list");
frc25_a_planos_aplicacaolist.FormKeyCountName = '<?php echo $rc25_a_planos_aplicacao_list->FormKeyCountName ?>';

// Form_CustomValidate event
frc25_a_planos_aplicacaolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_aplicacaolist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_planos_aplicacaolist.Lists["x_plano_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_planos_aplicacaolist.Lists["x_plano_exercicio"].Data = "<?php echo $rc25_a_planos_aplicacao_list->plano_exercicio->LookupFilterQuery(FALSE, "list") ?>";
frc25_a_planos_aplicacaolist.Lists["x_plano_despesa"] = {"LinkField":"x_despesa_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_despesa_nome","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_planos_despesas"};
frc25_a_planos_aplicacaolist.Lists["x_plano_despesa"].Data = "<?php echo $rc25_a_planos_aplicacao_list->plano_despesa->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = frc25_a_planos_aplicacaolistsrch = new ew_Form("frc25_a_planos_aplicacaolistsrch");

// Validate function for search
frc25_a_planos_aplicacaolistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
frc25_a_planos_aplicacaolistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_aplicacaolistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_planos_aplicacaolistsrch.Lists["x_plano_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_planos_aplicacaolistsrch.Lists["x_plano_exercicio"].Data = "<?php echo $rc25_a_planos_aplicacao_list->plano_exercicio->LookupFilterQuery(FALSE, "extbs") ?>";
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($rc25_a_planos_aplicacao_list->TotalRecs > 0 && $rc25_a_planos_aplicacao_list->ExportOptions->Visible()) { ?>
<?php $rc25_a_planos_aplicacao_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_list->SearchOptions->Visible()) { ?>
<?php $rc25_a_planos_aplicacao_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_list->FilterOptions->Visible()) { ?>
<?php $rc25_a_planos_aplicacao_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php if (($rc25_a_planos_aplicacao->Export == "") || (EW_EXPORT_MASTER_RECORD && $rc25_a_planos_aplicacao->Export == "print")) { ?>
<?php
if ($rc25_a_planos_aplicacao_list->DbMasterFilter <> "" && $rc25_a_planos_aplicacao->getCurrentMasterTable() == "rc25_a_termos") {
	if ($rc25_a_planos_aplicacao_list->MasterRecordExists) {
?>
<?php include_once "rc25_a_termosmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $rc25_a_planos_aplicacao_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_planos_aplicacao_list->TotalRecs <= 0)
			$rc25_a_planos_aplicacao_list->TotalRecs = $rc25_a_planos_aplicacao->ListRecordCount();
	} else {
		if (!$rc25_a_planos_aplicacao_list->Recordset && ($rc25_a_planos_aplicacao_list->Recordset = $rc25_a_planos_aplicacao_list->LoadRecordset()))
			$rc25_a_planos_aplicacao_list->TotalRecs = $rc25_a_planos_aplicacao_list->Recordset->RecordCount();
	}
	$rc25_a_planos_aplicacao_list->StartRec = 1;
	if ($rc25_a_planos_aplicacao_list->DisplayRecs <= 0 || ($rc25_a_planos_aplicacao->Export <> "" && $rc25_a_planos_aplicacao->ExportAll)) // Display all records
		$rc25_a_planos_aplicacao_list->DisplayRecs = $rc25_a_planos_aplicacao_list->TotalRecs;
	if (!($rc25_a_planos_aplicacao->Export <> "" && $rc25_a_planos_aplicacao->ExportAll))
		$rc25_a_planos_aplicacao_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rc25_a_planos_aplicacao_list->Recordset = $rc25_a_planos_aplicacao_list->LoadRecordset($rc25_a_planos_aplicacao_list->StartRec-1, $rc25_a_planos_aplicacao_list->DisplayRecs);

	// Set no record found message
	if ($rc25_a_planos_aplicacao->CurrentAction == "" && $rc25_a_planos_aplicacao_list->TotalRecs == 0) {
		if ($rc25_a_planos_aplicacao_list->SearchWhere == "0=101")
			$rc25_a_planos_aplicacao_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_planos_aplicacao_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$rc25_a_planos_aplicacao_list->RenderOtherOptions();
?>
<?php if ($rc25_a_planos_aplicacao->Export == "" && $rc25_a_planos_aplicacao->CurrentAction == "") { ?>
<form name="frc25_a_planos_aplicacaolistsrch" id="frc25_a_planos_aplicacaolistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($rc25_a_planos_aplicacao_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="frc25_a_planos_aplicacaolistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rc25_a_planos_aplicacao">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$rc25_a_planos_aplicacao_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_SEARCH;

// Render row
$rc25_a_planos_aplicacao->ResetAttrs();
$rc25_a_planos_aplicacao_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
	<div id="xsc_plano_exercicio" class="ewCell form-group">
		<label for="x_plano_exercicio" class="ewSearchCaption ewLabel"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_plano_exercicio" id="z_plano_exercicio" value="="></span>
		<span class="ewSearchField">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_plano_exercicio" name="x_plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->SelectOptionListHtml("x_plano_exercicio") ?>
</select>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $rc25_a_planos_aplicacao_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($rc25_a_planos_aplicacao_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($rc25_a_planos_aplicacao_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($rc25_a_planos_aplicacao_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($rc25_a_planos_aplicacao_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $rc25_a_planos_aplicacao_list->ShowPageHeader(); ?>
<?php
$rc25_a_planos_aplicacao_list->ShowMessage();
?>
<?php if ($rc25_a_planos_aplicacao_list->TotalRecs > 0 || $rc25_a_planos_aplicacao->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_planos_aplicacao_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_planos_aplicacao">
<div class="box-header ewGridUpperPanel">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "gridadd" && $rc25_a_planos_aplicacao->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_planos_aplicacao_list->Pager)) $rc25_a_planos_aplicacao_list->Pager = new cPrevNextPager($rc25_a_planos_aplicacao_list->StartRec, $rc25_a_planos_aplicacao_list->DisplayRecs, $rc25_a_planos_aplicacao_list->TotalRecs, $rc25_a_planos_aplicacao_list->AutoHidePager) ?>
<?php if ($rc25_a_planos_aplicacao_list->Pager->RecordCount > 0 && $rc25_a_planos_aplicacao_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_planos_aplicacao_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_planos_aplicacao_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="frc25_a_planos_aplicacaolist" id="frc25_a_planos_aplicacaolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_planos_aplicacao_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_planos_aplicacao_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_planos_aplicacao">
<?php if ($rc25_a_planos_aplicacao->getCurrentMasterTable() == "rc25_a_termos" && $rc25_a_planos_aplicacao->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="rc25_a_termos">
<input type="hidden" name="fk_processo_exercicio" value="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() ?>">
<?php } ?>
<div id="gmp_rc25_a_planos_aplicacao" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($rc25_a_planos_aplicacao_list->TotalRecs > 0 || $rc25_a_planos_aplicacao->CurrentAction == "gridedit") { ?>
<table id="tbl_rc25_a_planos_aplicacaolist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_planos_aplicacao_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_planos_aplicacao_list->RenderListOptions();

// Render list options (header, left)
$rc25_a_planos_aplicacao_list->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_exercicio) == "") { ?>
		<th data-name="plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio"><div class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_exercicio) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_despesa) == "") { ?>
		<th data-name="plano_despesa" class="<?php echo $rc25_a_planos_aplicacao->plano_despesa->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_despesa" class="<?php echo $rc25_a_planos_aplicacao->plano_despesa->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_despesa) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_despesa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_despesa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_mensal) == "") { ?>
		<th data-name="plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_mensal) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_custo_mensal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_exercicio) == "") { ?>
		<th data-name="plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_exercicio) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_custo_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_recurso_municipal) == "") { ?>
		<th data-name="plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_recurso_municipal) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_recurso_municipal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_outros_recursos) == "") { ?>
		<th data-name="plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_outros_recursos) ?>',1);"><div id="elh_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_outros_recursos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_planos_aplicacao_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rc25_a_planos_aplicacao->ExportAll && $rc25_a_planos_aplicacao->Export <> "") {
	$rc25_a_planos_aplicacao_list->StopRec = $rc25_a_planos_aplicacao_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rc25_a_planos_aplicacao_list->TotalRecs > $rc25_a_planos_aplicacao_list->StartRec + $rc25_a_planos_aplicacao_list->DisplayRecs - 1)
		$rc25_a_planos_aplicacao_list->StopRec = $rc25_a_planos_aplicacao_list->StartRec + $rc25_a_planos_aplicacao_list->DisplayRecs - 1;
	else
		$rc25_a_planos_aplicacao_list->StopRec = $rc25_a_planos_aplicacao_list->TotalRecs;
}
$rc25_a_planos_aplicacao_list->RecCnt = $rc25_a_planos_aplicacao_list->StartRec - 1;
if ($rc25_a_planos_aplicacao_list->Recordset && !$rc25_a_planos_aplicacao_list->Recordset->EOF) {
	$rc25_a_planos_aplicacao_list->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_planos_aplicacao_list->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_planos_aplicacao_list->StartRec > 1)
		$rc25_a_planos_aplicacao_list->Recordset->Move($rc25_a_planos_aplicacao_list->StartRec - 1);
} elseif (!$rc25_a_planos_aplicacao->AllowAddDeleteRow && $rc25_a_planos_aplicacao_list->StopRec == 0) {
	$rc25_a_planos_aplicacao_list->StopRec = $rc25_a_planos_aplicacao->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_planos_aplicacao->ResetAttrs();
$rc25_a_planos_aplicacao_list->RenderRow();
while ($rc25_a_planos_aplicacao_list->RecCnt < $rc25_a_planos_aplicacao_list->StopRec) {
	$rc25_a_planos_aplicacao_list->RecCnt++;
	if (intval($rc25_a_planos_aplicacao_list->RecCnt) >= intval($rc25_a_planos_aplicacao_list->StartRec)) {
		$rc25_a_planos_aplicacao_list->RowCnt++;

		// Set up key count
		$rc25_a_planos_aplicacao_list->KeyCount = $rc25_a_planos_aplicacao_list->RowIndex;

		// Init row class and style
		$rc25_a_planos_aplicacao->ResetAttrs();
		$rc25_a_planos_aplicacao->CssClass = "";
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd") {
		} else {
			$rc25_a_planos_aplicacao_list->LoadRowValues($rc25_a_planos_aplicacao_list->Recordset); // Load row values
		}
		$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rc25_a_planos_aplicacao->RowAttrs = array_merge($rc25_a_planos_aplicacao->RowAttrs, array('data-rowindex'=>$rc25_a_planos_aplicacao_list->RowCnt, 'id'=>'r' . $rc25_a_planos_aplicacao_list->RowCnt . '_rc25_a_planos_aplicacao', 'data-rowtype'=>$rc25_a_planos_aplicacao->RowType));

		// Render row
		$rc25_a_planos_aplicacao_list->RenderRow();

		// Render list options
		$rc25_a_planos_aplicacao_list->RenderListOptions();
?>
	<tr<?php echo $rc25_a_planos_aplicacao->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_planos_aplicacao_list->ListOptions->Render("body", "left", $rc25_a_planos_aplicacao_list->RowCnt);
?>
	<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
		<td data-name="plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
		<td data-name="plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa">
<span<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
		<td data-name="plano_custo_mensal"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
		<td data-name="plano_custo_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
		<td data-name="plano_recurso_municipal"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal">
<span<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
		<td data-name="plano_outros_recursos"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_planos_aplicacao_list->RowCnt ?>_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos">
<span<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_planos_aplicacao_list->ListOptions->Render("body", "right", $rc25_a_planos_aplicacao_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($rc25_a_planos_aplicacao->CurrentAction <> "gridadd")
		$rc25_a_planos_aplicacao_list->Recordset->MoveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_AGGREGATE;
$rc25_a_planos_aplicacao->ResetAttrs();
$rc25_a_planos_aplicacao_list->RenderRow();
?>
<?php if ($rc25_a_planos_aplicacao_list->TotalRecs > 0 && ($rc25_a_planos_aplicacao->CurrentAction <> "gridadd" && $rc25_a_planos_aplicacao->CurrentAction <> "gridedit")) { ?>
<tfoot><!-- Table footer -->
	<tr class="ewTableFooter">
<?php

// Render list options
$rc25_a_planos_aplicacao_list->RenderListOptions();

// Render list options (footer, left)
$rc25_a_planos_aplicacao_list->ListOptions->Render("footer", "left");
?>
	<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
		<td data-name="plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
		<td data-name="plano_despesa" class="<?php echo $rc25_a_planos_aplicacao->plano_despesa->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
		<td data-name="plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
		<td data-name="plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
		<td data-name="plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
		<td data-name="plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FooterCellClass() ?>"><span id="elf_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos">
<span class="ewAggregate"><?php echo $Language->Phrase("TOTAL") ?></span><span class="ewAggregateValue">
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewValue ?></span>
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$rc25_a_planos_aplicacao_list->ListOptions->Render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rc25_a_planos_aplicacao_list->Recordset)
	$rc25_a_planos_aplicacao_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "gridadd" && $rc25_a_planos_aplicacao->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_planos_aplicacao_list->Pager)) $rc25_a_planos_aplicacao_list->Pager = new cPrevNextPager($rc25_a_planos_aplicacao_list->StartRec, $rc25_a_planos_aplicacao_list->DisplayRecs, $rc25_a_planos_aplicacao_list->TotalRecs, $rc25_a_planos_aplicacao_list->AutoHidePager) ?>
<?php if ($rc25_a_planos_aplicacao_list->Pager->RecordCount > 0 && $rc25_a_planos_aplicacao_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_planos_aplicacao_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_planos_aplicacao_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_planos_aplicacao_list->PageUrl() ?>start=<?php echo $rc25_a_planos_aplicacao_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_planos_aplicacao_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_list->TotalRecs == 0 && $rc25_a_planos_aplicacao->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_planos_aplicacao_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
frc25_a_planos_aplicacaolistsrch.FilterList = <?php echo $rc25_a_planos_aplicacao_list->GetFilterList() ?>;
frc25_a_planos_aplicacaolistsrch.Init();
frc25_a_planos_aplicacaolist.Init();
</script>
<?php
$rc25_a_planos_aplicacao_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_planos_aplicacao_list->Page_Terminate();
?>
