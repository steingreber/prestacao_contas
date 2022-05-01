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

$rc25_a_recursos_humanos_list = NULL; // Initialize page object first

class crc25_a_recursos_humanos_list extends crc25_a_recursos_humanos {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recursos_humanos';

	// Page object name
	var $PageObjName = 'rc25_a_recursos_humanos_list';

	// Grid form hidden field names
	var $FormName = 'frc25_a_recursos_humanoslist';
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

		// Table object (rc25_a_recursos_humanos)
		if (!isset($GLOBALS["rc25_a_recursos_humanos"]) || get_class($GLOBALS["rc25_a_recursos_humanos"]) == "crc25_a_recursos_humanos") {
			$GLOBALS["rc25_a_recursos_humanos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recursos_humanos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rc25_a_recursos_humanosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rc25_a_recursos_humanosdelete.php";
		$this->MultiUpdateUrl = "rc25_a_recursos_humanosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption frc25_a_recursos_humanoslistsrch";

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
		$this->rh_exercicio->SetVisibility();
		$this->rh_nome->SetVisibility();
		$this->rh_funcao->SetVisibility();
		$this->rh_sala_turma->SetVisibility();

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
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

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
			$this->rh_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->rh_id->FormValue))
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
		$sFilterList = ew_Concat($sFilterList, $this->rh_exercicio->AdvancedSearch->ToJson(), ","); // Field rh_exercicio
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "frc25_a_recursos_humanoslistsrch", $filters);

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

		// Field rh_exercicio
		$this->rh_exercicio->AdvancedSearch->SearchValue = @$filter["x_rh_exercicio"];
		$this->rh_exercicio->AdvancedSearch->SearchOperator = @$filter["z_rh_exercicio"];
		$this->rh_exercicio->AdvancedSearch->SearchCondition = @$filter["v_rh_exercicio"];
		$this->rh_exercicio->AdvancedSearch->SearchValue2 = @$filter["y_rh_exercicio"];
		$this->rh_exercicio->AdvancedSearch->SearchOperator2 = @$filter["w_rh_exercicio"];
		$this->rh_exercicio->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $this->rh_exercicio, $Default, FALSE); // rh_exercicio

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->rh_exercicio->AdvancedSearch->Save(); // rh_exercicio
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
		$this->BuildBasicSearchSQL($sWhere, $this->rh_exercicio, $arKeywords, $type);
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
		if ($this->rh_exercicio->AdvancedSearch->IssetSession())
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
		$this->rh_exercicio->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->rh_exercicio->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->rh_exercicio); // rh_exercicio
			$this->UpdateSort($this->rh_nome); // rh_nome
			$this->UpdateSort($this->rh_funcao); // rh_funcao
			$this->UpdateSort($this->rh_sala_turma); // rh_sala_turma
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

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->rh_exercicio->setSort("");
				$this->rh_nome->setSort("");
				$this->rh_funcao->setSort("");
				$this->rh_sala_turma->setSort("");
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->rh_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"frc25_a_recursos_humanoslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"frc25_a_recursos_humanoslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.frc25_a_recursos_humanoslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frc25_a_recursos_humanoslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		// rh_exercicio

		$this->rh_exercicio->AdvancedSearch->SearchValue = @$_GET["x_rh_exercicio"];
		if ($this->rh_exercicio->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->rh_exercicio->AdvancedSearch->SearchOperator = @$_GET["z_rh_exercicio"];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// rh_id

		$this->rh_id->CellCssStyle = "white-space: nowrap;";

		// rh_exercicio
		// rh_pg_recurso_publico

		$this->rh_pg_recurso_publico->CellCssStyle = "white-space: nowrap;";

		// rh_terceirizado
		$this->rh_terceirizado->CellCssStyle = "white-space: nowrap;";

		// rh_nome
		$this->rh_nome->CellCssStyle = "white-space: nowrap;";

		// rh_funcao
		$this->rh_funcao->CellCssStyle = "white-space: nowrap;";

		// rh_escolaridade
		$this->rh_escolaridade->CellCssStyle = "white-space: nowrap;";

		// rh_sala_turma
		$this->rh_sala_turma->CellCssStyle = "white-space: nowrap;";

		// rh_carga_horaria_semanal
		$this->rh_carga_horaria_semanal->CellCssStyle = "white-space: nowrap;";

		// rh_remuneracao
		$this->rh_remuneracao->CellCssStyle = "white-space: nowrap;";

		// rh_hora_entra_i
		$this->rh_hora_entra_i->CellCssStyle = "white-space: nowrap;";

		// rh_hora_saida_i
		$this->rh_hora_saida_i->CellCssStyle = "white-space: nowrap;";

		// rh_hora_entra_ii
		$this->rh_hora_entra_ii->CellCssStyle = "white-space: nowrap;";

		// rh_hora_saida_ii
		$this->rh_hora_saida_ii->CellCssStyle = "white-space: nowrap;";

		// rh_data_cadastro
		$this->rh_data_cadastro->CellCssStyle = "white-space: nowrap;";
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

		// rh_sala_turma
		$this->rh_sala_turma->ViewValue = $this->rh_sala_turma->CurrentValue;
		$this->rh_sala_turma->ViewCustomAttributes = "";

			// rh_exercicio
			$this->rh_exercicio->LinkCustomAttributes = "";
			$this->rh_exercicio->HrefValue = "";
			$this->rh_exercicio->TooltipValue = "";

			// rh_nome
			$this->rh_nome->LinkCustomAttributes = "";
			$this->rh_nome->HrefValue = "";
			$this->rh_nome->TooltipValue = "";

			// rh_funcao
			$this->rh_funcao->LinkCustomAttributes = "";
			$this->rh_funcao->HrefValue = "";
			$this->rh_funcao->TooltipValue = "";

			// rh_sala_turma
			$this->rh_sala_turma->LinkCustomAttributes = "";
			$this->rh_sala_turma->HrefValue = "";
			$this->rh_sala_turma->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// rh_exercicio
			$this->rh_exercicio->EditAttrs["class"] = "form-control";
			$this->rh_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->rh_exercicio->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->rh_exercicio->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
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

			// rh_nome
			$this->rh_nome->EditAttrs["class"] = "form-control";
			$this->rh_nome->EditCustomAttributes = "";

			// rh_funcao
			$this->rh_funcao->EditAttrs["class"] = "form-control";
			$this->rh_funcao->EditCustomAttributes = "";

			// rh_sala_turma
			$this->rh_sala_turma->EditAttrs["class"] = "form-control";
			$this->rh_sala_turma->EditCustomAttributes = "";
			$this->rh_sala_turma->EditValue = ew_HtmlEncode($this->rh_sala_turma->AdvancedSearch->SearchValue);
			$this->rh_sala_turma->PlaceHolder = ew_RemoveHtml($this->rh_sala_turma->FldCaption());
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
		$this->rh_exercicio->AdvancedSearch->Load();
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
if (!isset($rc25_a_recursos_humanos_list)) $rc25_a_recursos_humanos_list = new crc25_a_recursos_humanos_list();

// Page init
$rc25_a_recursos_humanos_list->Page_Init();

// Page main
$rc25_a_recursos_humanos_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recursos_humanos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = frc25_a_recursos_humanoslist = new ew_Form("frc25_a_recursos_humanoslist", "list");
frc25_a_recursos_humanoslist.FormKeyCountName = '<?php echo $rc25_a_recursos_humanos_list->FormKeyCountName ?>';

// Form_CustomValidate event
frc25_a_recursos_humanoslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recursos_humanoslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recursos_humanoslist.Lists["x_rh_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recursos_humanoslist.Lists["x_rh_exercicio"].Data = "<?php echo $rc25_a_recursos_humanos_list->rh_exercicio->LookupFilterQuery(FALSE, "list") ?>";
frc25_a_recursos_humanoslist.Lists["x_rh_nome"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recursos_humanoslist.Lists["x_rh_nome"].Data = "<?php echo $rc25_a_recursos_humanos_list->rh_nome->LookupFilterQuery(FALSE, "list") ?>";
frc25_a_recursos_humanoslist.Lists["x_rh_funcao"] = {"LinkField":"x_rhf_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhf_funcao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhfuncoes"};
frc25_a_recursos_humanoslist.Lists["x_rh_funcao"].Data = "<?php echo $rc25_a_recursos_humanos_list->rh_funcao->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = frc25_a_recursos_humanoslistsrch = new ew_Form("frc25_a_recursos_humanoslistsrch");

// Validate function for search
frc25_a_recursos_humanoslistsrch.Validate = function(fobj) {
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
frc25_a_recursos_humanoslistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recursos_humanoslistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recursos_humanoslistsrch.Lists["x_rh_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recursos_humanoslistsrch.Lists["x_rh_exercicio"].Data = "<?php echo $rc25_a_recursos_humanos_list->rh_exercicio->LookupFilterQuery(FALSE, "extbs") ?>";
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($rc25_a_recursos_humanos_list->TotalRecs > 0 && $rc25_a_recursos_humanos_list->ExportOptions->Visible()) { ?>
<?php $rc25_a_recursos_humanos_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_recursos_humanos_list->SearchOptions->Visible()) { ?>
<?php $rc25_a_recursos_humanos_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_recursos_humanos_list->FilterOptions->Visible()) { ?>
<?php $rc25_a_recursos_humanos_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $rc25_a_recursos_humanos_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_recursos_humanos_list->TotalRecs <= 0)
			$rc25_a_recursos_humanos_list->TotalRecs = $rc25_a_recursos_humanos->ListRecordCount();
	} else {
		if (!$rc25_a_recursos_humanos_list->Recordset && ($rc25_a_recursos_humanos_list->Recordset = $rc25_a_recursos_humanos_list->LoadRecordset()))
			$rc25_a_recursos_humanos_list->TotalRecs = $rc25_a_recursos_humanos_list->Recordset->RecordCount();
	}
	$rc25_a_recursos_humanos_list->StartRec = 1;
	if ($rc25_a_recursos_humanos_list->DisplayRecs <= 0 || ($rc25_a_recursos_humanos->Export <> "" && $rc25_a_recursos_humanos->ExportAll)) // Display all records
		$rc25_a_recursos_humanos_list->DisplayRecs = $rc25_a_recursos_humanos_list->TotalRecs;
	if (!($rc25_a_recursos_humanos->Export <> "" && $rc25_a_recursos_humanos->ExportAll))
		$rc25_a_recursos_humanos_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rc25_a_recursos_humanos_list->Recordset = $rc25_a_recursos_humanos_list->LoadRecordset($rc25_a_recursos_humanos_list->StartRec-1, $rc25_a_recursos_humanos_list->DisplayRecs);

	// Set no record found message
	if ($rc25_a_recursos_humanos->CurrentAction == "" && $rc25_a_recursos_humanos_list->TotalRecs == 0) {
		if ($rc25_a_recursos_humanos_list->SearchWhere == "0=101")
			$rc25_a_recursos_humanos_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_recursos_humanos_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$rc25_a_recursos_humanos_list->RenderOtherOptions();
?>
<?php if ($rc25_a_recursos_humanos->Export == "" && $rc25_a_recursos_humanos->CurrentAction == "") { ?>
<form name="frc25_a_recursos_humanoslistsrch" id="frc25_a_recursos_humanoslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($rc25_a_recursos_humanos_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="frc25_a_recursos_humanoslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rc25_a_recursos_humanos">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$rc25_a_recursos_humanos_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$rc25_a_recursos_humanos->RowType = EW_ROWTYPE_SEARCH;

// Render row
$rc25_a_recursos_humanos->ResetAttrs();
$rc25_a_recursos_humanos_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
	<div id="xsc_rh_exercicio" class="ewCell form-group">
		<label for="x_rh_exercicio" class="ewSearchCaption ewLabel"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_rh_exercicio" id="z_rh_exercicio" value="="></span>
		<span class="ewSearchField">
<select data-table="rc25_a_recursos_humanos" data-field="x_rh_exercicio" data-value-separator="<?php echo $rc25_a_recursos_humanos->rh_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_rh_exercicio" name="x_rh_exercicio"<?php echo $rc25_a_recursos_humanos->rh_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->SelectOptionListHtml("x_rh_exercicio") ?>
</select>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($rc25_a_recursos_humanos_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $rc25_a_recursos_humanos_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($rc25_a_recursos_humanos_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($rc25_a_recursos_humanos_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($rc25_a_recursos_humanos_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($rc25_a_recursos_humanos_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $rc25_a_recursos_humanos_list->ShowPageHeader(); ?>
<?php
$rc25_a_recursos_humanos_list->ShowMessage();
?>
<?php if ($rc25_a_recursos_humanos_list->TotalRecs > 0 || $rc25_a_recursos_humanos->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_recursos_humanos_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_recursos_humanos">
<div class="box-header ewGridUpperPanel">
<?php if ($rc25_a_recursos_humanos->CurrentAction <> "gridadd" && $rc25_a_recursos_humanos->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recursos_humanos_list->Pager)) $rc25_a_recursos_humanos_list->Pager = new cPrevNextPager($rc25_a_recursos_humanos_list->StartRec, $rc25_a_recursos_humanos_list->DisplayRecs, $rc25_a_recursos_humanos_list->TotalRecs, $rc25_a_recursos_humanos_list->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_list->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_recursos_humanos_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="frc25_a_recursos_humanoslist" id="frc25_a_recursos_humanoslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recursos_humanos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recursos_humanos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recursos_humanos">
<div id="gmp_rc25_a_recursos_humanos" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($rc25_a_recursos_humanos_list->TotalRecs > 0 || $rc25_a_recursos_humanos->CurrentAction == "gridedit") { ?>
<table id="tbl_rc25_a_recursos_humanoslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_recursos_humanos_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_recursos_humanos_list->RenderListOptions();

// Render list options (header, left)
$rc25_a_recursos_humanos_list->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
	<?php if ($rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_exercicio) == "") { ?>
		<th data-name="rh_exercicio" class="<?php echo $rc25_a_recursos_humanos->rh_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_recursos_humanos_rh_exercicio" class="rc25_a_recursos_humanos_rh_exercicio"><div class="ewTableHeaderCaption"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rh_exercicio" class="<?php echo $rc25_a_recursos_humanos->rh_exercicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_exercicio) ?>',1);"><div id="elh_rc25_a_recursos_humanos_rh_exercicio" class="rc25_a_recursos_humanos_rh_exercicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_recursos_humanos->rh_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_recursos_humanos->rh_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
	<?php if ($rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_nome) == "") { ?>
		<th data-name="rh_nome" class="<?php echo $rc25_a_recursos_humanos->rh_nome->HeaderCellClass() ?>"><div id="elh_rc25_a_recursos_humanos_rh_nome" class="rc25_a_recursos_humanos_rh_nome"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rh_nome" class="<?php echo $rc25_a_recursos_humanos->rh_nome->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_nome) ?>',1);"><div id="elh_rc25_a_recursos_humanos_rh_nome" class="rc25_a_recursos_humanos_rh_nome">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_recursos_humanos->rh_nome->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_recursos_humanos->rh_nome->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
	<?php if ($rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_funcao) == "") { ?>
		<th data-name="rh_funcao" class="<?php echo $rc25_a_recursos_humanos->rh_funcao->HeaderCellClass() ?>"><div id="elh_rc25_a_recursos_humanos_rh_funcao" class="rc25_a_recursos_humanos_rh_funcao"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rh_funcao" class="<?php echo $rc25_a_recursos_humanos->rh_funcao->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_funcao) ?>',1);"><div id="elh_rc25_a_recursos_humanos_rh_funcao" class="rc25_a_recursos_humanos_rh_funcao">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_recursos_humanos->rh_funcao->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_recursos_humanos->rh_funcao->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
	<?php if ($rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_sala_turma) == "") { ?>
		<th data-name="rh_sala_turma" class="<?php echo $rc25_a_recursos_humanos->rh_sala_turma->HeaderCellClass() ?>"><div id="elh_rc25_a_recursos_humanos_rh_sala_turma" class="rc25_a_recursos_humanos_rh_sala_turma"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_recursos_humanos->rh_sala_turma->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rh_sala_turma" class="<?php echo $rc25_a_recursos_humanos->rh_sala_turma->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_recursos_humanos->SortUrl($rc25_a_recursos_humanos->rh_sala_turma) ?>',1);"><div id="elh_rc25_a_recursos_humanos_rh_sala_turma" class="rc25_a_recursos_humanos_rh_sala_turma">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_recursos_humanos->rh_sala_turma->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_recursos_humanos->rh_sala_turma->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_recursos_humanos->rh_sala_turma->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_recursos_humanos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rc25_a_recursos_humanos->ExportAll && $rc25_a_recursos_humanos->Export <> "") {
	$rc25_a_recursos_humanos_list->StopRec = $rc25_a_recursos_humanos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rc25_a_recursos_humanos_list->TotalRecs > $rc25_a_recursos_humanos_list->StartRec + $rc25_a_recursos_humanos_list->DisplayRecs - 1)
		$rc25_a_recursos_humanos_list->StopRec = $rc25_a_recursos_humanos_list->StartRec + $rc25_a_recursos_humanos_list->DisplayRecs - 1;
	else
		$rc25_a_recursos_humanos_list->StopRec = $rc25_a_recursos_humanos_list->TotalRecs;
}
$rc25_a_recursos_humanos_list->RecCnt = $rc25_a_recursos_humanos_list->StartRec - 1;
if ($rc25_a_recursos_humanos_list->Recordset && !$rc25_a_recursos_humanos_list->Recordset->EOF) {
	$rc25_a_recursos_humanos_list->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_recursos_humanos_list->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_recursos_humanos_list->StartRec > 1)
		$rc25_a_recursos_humanos_list->Recordset->Move($rc25_a_recursos_humanos_list->StartRec - 1);
} elseif (!$rc25_a_recursos_humanos->AllowAddDeleteRow && $rc25_a_recursos_humanos_list->StopRec == 0) {
	$rc25_a_recursos_humanos_list->StopRec = $rc25_a_recursos_humanos->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_recursos_humanos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_recursos_humanos->ResetAttrs();
$rc25_a_recursos_humanos_list->RenderRow();
while ($rc25_a_recursos_humanos_list->RecCnt < $rc25_a_recursos_humanos_list->StopRec) {
	$rc25_a_recursos_humanos_list->RecCnt++;
	if (intval($rc25_a_recursos_humanos_list->RecCnt) >= intval($rc25_a_recursos_humanos_list->StartRec)) {
		$rc25_a_recursos_humanos_list->RowCnt++;

		// Set up key count
		$rc25_a_recursos_humanos_list->KeyCount = $rc25_a_recursos_humanos_list->RowIndex;

		// Init row class and style
		$rc25_a_recursos_humanos->ResetAttrs();
		$rc25_a_recursos_humanos->CssClass = "";
		if ($rc25_a_recursos_humanos->CurrentAction == "gridadd") {
		} else {
			$rc25_a_recursos_humanos_list->LoadRowValues($rc25_a_recursos_humanos_list->Recordset); // Load row values
		}
		$rc25_a_recursos_humanos->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rc25_a_recursos_humanos->RowAttrs = array_merge($rc25_a_recursos_humanos->RowAttrs, array('data-rowindex'=>$rc25_a_recursos_humanos_list->RowCnt, 'id'=>'r' . $rc25_a_recursos_humanos_list->RowCnt . '_rc25_a_recursos_humanos', 'data-rowtype'=>$rc25_a_recursos_humanos->RowType));

		// Render row
		$rc25_a_recursos_humanos_list->RenderRow();

		// Render list options
		$rc25_a_recursos_humanos_list->RenderListOptions();
?>
	<tr<?php echo $rc25_a_recursos_humanos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_recursos_humanos_list->ListOptions->Render("body", "left", $rc25_a_recursos_humanos_list->RowCnt);
?>
	<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
		<td data-name="rh_exercicio"<?php echo $rc25_a_recursos_humanos->rh_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_list->RowCnt ?>_rc25_a_recursos_humanos_rh_exercicio" class="rc25_a_recursos_humanos_rh_exercicio">
<span<?php echo $rc25_a_recursos_humanos->rh_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
		<td data-name="rh_nome"<?php echo $rc25_a_recursos_humanos->rh_nome->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_list->RowCnt ?>_rc25_a_recursos_humanos_rh_nome" class="rc25_a_recursos_humanos_rh_nome">
<span<?php echo $rc25_a_recursos_humanos->rh_nome->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_nome->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
		<td data-name="rh_funcao"<?php echo $rc25_a_recursos_humanos->rh_funcao->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_list->RowCnt ?>_rc25_a_recursos_humanos_rh_funcao" class="rc25_a_recursos_humanos_rh_funcao">
<span<?php echo $rc25_a_recursos_humanos->rh_funcao->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_funcao->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
		<td data-name="rh_sala_turma"<?php echo $rc25_a_recursos_humanos->rh_sala_turma->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_list->RowCnt ?>_rc25_a_recursos_humanos_rh_sala_turma" class="rc25_a_recursos_humanos_rh_sala_turma">
<span<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_recursos_humanos_list->ListOptions->Render("body", "right", $rc25_a_recursos_humanos_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($rc25_a_recursos_humanos->CurrentAction <> "gridadd")
		$rc25_a_recursos_humanos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rc25_a_recursos_humanos_list->Recordset)
	$rc25_a_recursos_humanos_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($rc25_a_recursos_humanos->CurrentAction <> "gridadd" && $rc25_a_recursos_humanos->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_recursos_humanos_list->Pager)) $rc25_a_recursos_humanos_list->Pager = new cPrevNextPager($rc25_a_recursos_humanos_list->StartRec, $rc25_a_recursos_humanos_list->DisplayRecs, $rc25_a_recursos_humanos_list->TotalRecs, $rc25_a_recursos_humanos_list->AutoHidePager) ?>
<?php if ($rc25_a_recursos_humanos_list->Pager->RecordCount > 0 && $rc25_a_recursos_humanos_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_recursos_humanos_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_recursos_humanos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_recursos_humanos_list->PageUrl() ?>start=<?php echo $rc25_a_recursos_humanos_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_recursos_humanos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_recursos_humanos_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_recursos_humanos_list->TotalRecs == 0 && $rc25_a_recursos_humanos->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_recursos_humanos_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
frc25_a_recursos_humanoslistsrch.FilterList = <?php echo $rc25_a_recursos_humanos_list->GetFilterList() ?>;
frc25_a_recursos_humanoslistsrch.Init();
frc25_a_recursos_humanoslist.Init();
</script>
<?php
$rc25_a_recursos_humanos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recursos_humanos_list->Page_Terminate();
?>
