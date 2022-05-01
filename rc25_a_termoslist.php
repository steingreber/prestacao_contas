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

$rc25_a_termos_list = NULL; // Initialize page object first

class crc25_a_termos_list extends crc25_a_termos {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_termos';

	// Page object name
	var $PageObjName = 'rc25_a_termos_list';

	// Grid form hidden field names
	var $FormName = 'frc25_a_termoslist';
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

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS["rc25_a_termos"]) || get_class($GLOBALS["rc25_a_termos"]) == "crc25_a_termos") {
			$GLOBALS["rc25_a_termos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_termos"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "rc25_a_termosadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "rc25_a_termosdelete.php";
		$this->MultiUpdateUrl = "rc25_a_termosupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption frc25_a_termoslistsrch";

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
		$this->processo_exercicio->SetVisibility();
		$this->processo_termo_num->SetVisibility();
		$this->processo_numero->SetVisibility();
		$this->processo_vigencia_ini->SetVisibility();
		$this->processo_vigencia_fim->SetVisibility();

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

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("rc25_a_repasses", $DetailTblVar)) {

					// Process auto fill for detail table 'rc25_a_repasses'
					if (preg_match('/^frc25_a_repasses(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["rc25_a_repasses_grid"])) $GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid;
						$GLOBALS["rc25_a_repasses_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("rc25_a_planos_aplicacao", $DetailTblVar)) {

					// Process auto fill for detail table 'rc25_a_planos_aplicacao'
					if (preg_match('/^frc25_a_planos_aplicacao(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"])) $GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid;
						$GLOBALS["rc25_a_planos_aplicacao_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
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
			$this->processo_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->processo_id->FormValue))
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
		$sFilterList = ew_Concat($sFilterList, $this->processo_exercicio->AdvancedSearch->ToJson(), ","); // Field processo_exercicio
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "frc25_a_termoslistsrch", $filters);

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

		// Field processo_exercicio
		$this->processo_exercicio->AdvancedSearch->SearchValue = @$filter["x_processo_exercicio"];
		$this->processo_exercicio->AdvancedSearch->SearchOperator = @$filter["z_processo_exercicio"];
		$this->processo_exercicio->AdvancedSearch->SearchCondition = @$filter["v_processo_exercicio"];
		$this->processo_exercicio->AdvancedSearch->SearchValue2 = @$filter["y_processo_exercicio"];
		$this->processo_exercicio->AdvancedSearch->SearchOperator2 = @$filter["w_processo_exercicio"];
		$this->processo_exercicio->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $this->processo_exercicio, $Default, FALSE); // processo_exercicio

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->processo_exercicio->AdvancedSearch->Save(); // processo_exercicio
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
		$this->BuildBasicSearchSQL($sWhere, $this->processo_exercicio, $arKeywords, $type);
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
		if ($this->processo_exercicio->AdvancedSearch->IssetSession())
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
		$this->processo_exercicio->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->processo_exercicio->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->processo_exercicio); // processo_exercicio
			$this->UpdateSort($this->processo_termo_num); // processo_termo_num
			$this->UpdateSort($this->processo_numero); // processo_numero
			$this->UpdateSort($this->processo_vigencia_ini); // processo_vigencia_ini
			$this->UpdateSort($this->processo_vigencia_fim); // processo_vigencia_fim
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
				$this->processo_exercicio->setSort("");
				$this->processo_termo_num->setSort("");
				$this->processo_numero->setSort("");
				$this->processo_vigencia_ini->setSort("");
				$this->processo_vigencia_fim->setSort("");
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

		// "detail_rc25_a_repasses"
		$item = &$this->ListOptions->Add("detail_rc25_a_repasses");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["rc25_a_repasses_grid"])) $GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid;

		// "detail_rc25_a_planos_aplicacao"
		$item = &$this->ListOptions->Add("detail_rc25_a_planos_aplicacao");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"])) $GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("rc25_a_repasses");
		$pages->Add("rc25_a_planos_aplicacao");
		$this->DetailPages = $pages;

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
		$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_rc25_a_repasses"
		$oListOpt = &$this->ListOptions->Items["detail_rc25_a_repasses"];
		if (TRUE) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("rc25_a_repasses", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("rc25_a_repasseslist.php?" . EW_TABLE_SHOW_MASTER . "=rc25_a_termos&fk_processo_id=" . urlencode(strval($this->processo_id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["rc25_a_repasses_grid"]->DetailView) {
				$caption = $Language->Phrase("MasterDetailViewLink");
				$url = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_repasses");
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "rc25_a_repasses";
			}
			if ($GLOBALS["rc25_a_repasses_grid"]->DetailEdit) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_repasses");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "rc25_a_repasses";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}

		// "detail_rc25_a_planos_aplicacao"
		$oListOpt = &$this->ListOptions->Items["detail_rc25_a_planos_aplicacao"];
		if (TRUE) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("rc25_a_planos_aplicacao", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("rc25_a_planos_aplicacaolist.php?" . EW_TABLE_SHOW_MASTER . "=rc25_a_termos&fk_processo_exercicio=" . urlencode(strval($this->processo_exercicio->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailView) {
				$caption = $Language->Phrase("MasterDetailViewLink");
				$url = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_planos_aplicacao");
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "rc25_a_planos_aplicacao";
			}
			if ($GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailEdit) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_planos_aplicacao");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "rc25_a_planos_aplicacao";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
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
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->processo_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$option = $options["detail"];
		$DetailTableLink = "";
		$item = &$option->Add("detailadd_rc25_a_repasses");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_repasses");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["rc25_a_repasses"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["rc25_a_repasses"]->DetailAdd);
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "rc25_a_repasses";
		}
		$item = &$option->Add("detailadd_rc25_a_planos_aplicacao");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=rc25_a_planos_aplicacao");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["rc25_a_planos_aplicacao"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["rc25_a_planos_aplicacao"]->DetailAdd);
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "rc25_a_planos_aplicacao";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->Add("detailsadd");
			$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailTableLink);
			$caption = $Language->Phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = ($DetailTableLink <> "");

			// Hide single master/detail items
			$ar = explode(",", $DetailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = &$option->GetItem("detailadd_" . $ar[$i]))
					$item->Visible = FALSE;
			}
		}
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"frc25_a_termoslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"frc25_a_termoslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.frc25_a_termoslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"frc25_a_termoslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		// processo_exercicio

		$this->processo_exercicio->AdvancedSearch->SearchValue = @$_GET["x_processo_exercicio"];
		if ($this->processo_exercicio->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->processo_exercicio->AdvancedSearch->SearchOperator = @$_GET["z_processo_exercicio"];
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("processo_id")) <> "")
			$this->processo_id->CurrentValue = $this->getKey("processo_id"); // processo_id
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
		// processo_id

		$this->processo_id->CellCssStyle = "white-space: nowrap;";

		// processo_exercicio
		// processo_termo_num

		$this->processo_termo_num->CellCssStyle = "white-space: nowrap;";

		// processo_numero
		$this->processo_numero->CellCssStyle = "white-space: nowrap;";

		// processo_vigencia_ini
		$this->processo_vigencia_ini->CellCssStyle = "width: 120px; white-space: nowrap;";

		// processo_vigencia_fim
		$this->processo_vigencia_fim->CellCssStyle = "width: 120px; white-space: nowrap;";

		// processo_data
		$this->processo_data->CellCssStyle = "white-space: nowrap;";

		// processo_valor
		$this->processo_valor->CellCssStyle = "white-space: nowrap;";

		// processo_objeto
		$this->processo_objeto->CellCssStyle = "white-space: nowrap;";

		// processo_metas
		$this->processo_metas->CellCssStyle = "white-space: nowrap;";

		// processo_origem
		$this->processo_origem->CellCssStyle = "white-space: nowrap;";

		// processo_ent_endereco
		$this->processo_ent_endereco->CellCssStyle = "white-space: nowrap;";

		// processo_ent_estatuto
		$this->processo_ent_estatuto->CellCssStyle = "white-space: nowrap;";

		// processo_ent_lei
		$this->processo_ent_lei->CellCssStyle = "white-space: nowrap;";

		// processo_ent_cebas
		$this->processo_ent_cebas->CellCssStyle = "white-space: nowrap;";

		// processo_resp_nome
		$this->processo_resp_nome->CellCssStyle = "white-space: nowrap;";

		// processo_resp_cargo
		$this->processo_resp_cargo->CellCssStyle = "white-space: nowrap;";

		// processo_resp_end
		$this->processo_resp_end->CellCssStyle = "white-space: nowrap;";

		// processo_resp_contato
		$this->processo_resp_contato->CellCssStyle = "white-space: nowrap;";

		// processo_resp_ata
		$this->processo_resp_ata->CellCssStyle = "white-space: nowrap;";

		// processo_cont_nome
		$this->processo_cont_nome->CellCssStyle = "white-space: nowrap;";

		// processo_cont_end
		$this->processo_cont_end->CellCssStyle = "white-space: nowrap;";

		// processo_cont_contato
		$this->processo_cont_contato->CellCssStyle = "white-space: nowrap;";

		// processo_cont_indent
		$this->processo_cont_indent->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_nome
		$this->processo_preenc_nome->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_carg
		$this->processo_preenc_carg->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_end
		$this->processo_preenc_end->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_contato
		$this->processo_preenc_contato->CellCssStyle = "white-space: nowrap;";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->CellCssStyle = "white-space: nowrap;";
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
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// processo_exercicio
			$this->processo_exercicio->EditAttrs["class"] = "form-control";
			$this->processo_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->processo_exercicio->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->processo_exercicio->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_ano_vigente`";
			$sWhereWrk = "";
			$this->processo_exercicio->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->processo_exercicio, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->processo_exercicio->EditValue = $arwrk;

			// processo_termo_num
			$this->processo_termo_num->EditAttrs["class"] = "form-control";
			$this->processo_termo_num->EditCustomAttributes = "";
			$this->processo_termo_num->EditValue = ew_HtmlEncode($this->processo_termo_num->AdvancedSearch->SearchValue);
			$this->processo_termo_num->PlaceHolder = ew_RemoveHtml($this->processo_termo_num->FldCaption());

			// processo_numero
			$this->processo_numero->EditAttrs["class"] = "form-control";
			$this->processo_numero->EditCustomAttributes = "";
			$this->processo_numero->EditValue = ew_HtmlEncode($this->processo_numero->AdvancedSearch->SearchValue);
			$this->processo_numero->PlaceHolder = ew_RemoveHtml($this->processo_numero->FldCaption());

			// processo_vigencia_ini
			$this->processo_vigencia_ini->EditAttrs["class"] = "form-control";
			$this->processo_vigencia_ini->EditCustomAttributes = "";
			$this->processo_vigencia_ini->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->processo_vigencia_ini->AdvancedSearch->SearchValue, 6), 6));
			$this->processo_vigencia_ini->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_ini->FldCaption());

			// processo_vigencia_fim
			$this->processo_vigencia_fim->EditAttrs["class"] = "form-control";
			$this->processo_vigencia_fim->EditCustomAttributes = "";
			$this->processo_vigencia_fim->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->processo_vigencia_fim->AdvancedSearch->SearchValue, 7), 7));
			$this->processo_vigencia_fim->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_fim->FldCaption());
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
		$this->processo_exercicio->AdvancedSearch->Load();
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
		case "x_processo_exercicio":
			$sSqlWrk = "";
				$sSqlWrk = "SELECT `ano_ano` AS `LinkFld`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
				$sWhereWrk = "";
				$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`ano_ano` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->processo_exercicio, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($rc25_a_termos_list)) $rc25_a_termos_list = new crc25_a_termos_list();

// Page init
$rc25_a_termos_list->Page_Init();

// Page main
$rc25_a_termos_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_termos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = frc25_a_termoslist = new ew_Form("frc25_a_termoslist", "list");
frc25_a_termoslist.FormKeyCountName = '<?php echo $rc25_a_termos_list->FormKeyCountName ?>';

// Form_CustomValidate event
frc25_a_termoslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_termoslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_termoslist.Lists["x_processo_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_termoslist.Lists["x_processo_exercicio"].Data = "<?php echo $rc25_a_termos_list->processo_exercicio->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = frc25_a_termoslistsrch = new ew_Form("frc25_a_termoslistsrch");

// Validate function for search
frc25_a_termoslistsrch.Validate = function(fobj) {
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
frc25_a_termoslistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_termoslistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_termoslistsrch.Lists["x_processo_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_termoslistsrch.Lists["x_processo_exercicio"].Data = "<?php echo $rc25_a_termos_list->processo_exercicio->LookupFilterQuery(FALSE, "extbs") ?>";
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($rc25_a_termos_list->TotalRecs > 0 && $rc25_a_termos_list->ExportOptions->Visible()) { ?>
<?php $rc25_a_termos_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_termos_list->SearchOptions->Visible()) { ?>
<?php $rc25_a_termos_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($rc25_a_termos_list->FilterOptions->Visible()) { ?>
<?php $rc25_a_termos_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $rc25_a_termos_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_termos_list->TotalRecs <= 0)
			$rc25_a_termos_list->TotalRecs = $rc25_a_termos->ListRecordCount();
	} else {
		if (!$rc25_a_termos_list->Recordset && ($rc25_a_termos_list->Recordset = $rc25_a_termos_list->LoadRecordset()))
			$rc25_a_termos_list->TotalRecs = $rc25_a_termos_list->Recordset->RecordCount();
	}
	$rc25_a_termos_list->StartRec = 1;
	if ($rc25_a_termos_list->DisplayRecs <= 0 || ($rc25_a_termos->Export <> "" && $rc25_a_termos->ExportAll)) // Display all records
		$rc25_a_termos_list->DisplayRecs = $rc25_a_termos_list->TotalRecs;
	if (!($rc25_a_termos->Export <> "" && $rc25_a_termos->ExportAll))
		$rc25_a_termos_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rc25_a_termos_list->Recordset = $rc25_a_termos_list->LoadRecordset($rc25_a_termos_list->StartRec-1, $rc25_a_termos_list->DisplayRecs);

	// Set no record found message
	if ($rc25_a_termos->CurrentAction == "" && $rc25_a_termos_list->TotalRecs == 0) {
		if ($rc25_a_termos_list->SearchWhere == "0=101")
			$rc25_a_termos_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_termos_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$rc25_a_termos_list->RenderOtherOptions();
?>
<?php if ($rc25_a_termos->Export == "" && $rc25_a_termos->CurrentAction == "") { ?>
<form name="frc25_a_termoslistsrch" id="frc25_a_termoslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($rc25_a_termos_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="frc25_a_termoslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="rc25_a_termos">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$rc25_a_termos_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$rc25_a_termos->RowType = EW_ROWTYPE_SEARCH;

// Render row
$rc25_a_termos->ResetAttrs();
$rc25_a_termos_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
	<div id="xsc_processo_exercicio" class="ewCell form-group">
		<label for="x_processo_exercicio" class="ewSearchCaption ewLabel"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_processo_exercicio" id="z_processo_exercicio" value="="></span>
		<span class="ewSearchField">
<select data-table="rc25_a_termos" data-field="x_processo_exercicio" data-value-separator="<?php echo $rc25_a_termos->processo_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_processo_exercicio" name="x_processo_exercicio"<?php echo $rc25_a_termos->processo_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->SelectOptionListHtml("x_processo_exercicio") ?>
</select>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($rc25_a_termos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($rc25_a_termos_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $rc25_a_termos_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($rc25_a_termos_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($rc25_a_termos_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($rc25_a_termos_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($rc25_a_termos_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $rc25_a_termos_list->ShowPageHeader(); ?>
<?php
$rc25_a_termos_list->ShowMessage();
?>
<?php if ($rc25_a_termos_list->TotalRecs > 0 || $rc25_a_termos->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_termos_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_termos">
<div class="box-header ewGridUpperPanel">
<?php if ($rc25_a_termos->CurrentAction <> "gridadd" && $rc25_a_termos->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_termos_list->Pager)) $rc25_a_termos_list->Pager = new cPrevNextPager($rc25_a_termos_list->StartRec, $rc25_a_termos_list->DisplayRecs, $rc25_a_termos_list->TotalRecs, $rc25_a_termos_list->AutoHidePager) ?>
<?php if ($rc25_a_termos_list->Pager->RecordCount > 0 && $rc25_a_termos_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_termos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_termos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_termos_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_termos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_termos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_termos_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_termos_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="frc25_a_termoslist" id="frc25_a_termoslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_termos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_termos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_termos">
<div id="gmp_rc25_a_termos" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($rc25_a_termos_list->TotalRecs > 0 || $rc25_a_termos->CurrentAction == "gridedit") { ?>
<table id="tbl_rc25_a_termoslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_termos_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_termos_list->RenderListOptions();

// Render list options (header, left)
$rc25_a_termos_list->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
	<?php if ($rc25_a_termos->SortUrl($rc25_a_termos->processo_exercicio) == "") { ?>
		<th data-name="processo_exercicio" class="<?php echo $rc25_a_termos->processo_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_termos_processo_exercicio" class="rc25_a_termos_processo_exercicio"><div class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="processo_exercicio" class="<?php echo $rc25_a_termos->processo_exercicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_termos->SortUrl($rc25_a_termos->processo_exercicio) ?>',1);"><div id="elh_rc25_a_termos_processo_exercicio" class="rc25_a_termos_processo_exercicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_termos->processo_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_termos->processo_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
	<?php if ($rc25_a_termos->SortUrl($rc25_a_termos->processo_termo_num) == "") { ?>
		<th data-name="processo_termo_num" class="<?php echo $rc25_a_termos->processo_termo_num->HeaderCellClass() ?>"><div id="elh_rc25_a_termos_processo_termo_num" class="rc25_a_termos_processo_termo_num"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="processo_termo_num" class="<?php echo $rc25_a_termos->processo_termo_num->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_termos->SortUrl($rc25_a_termos->processo_termo_num) ?>',1);"><div id="elh_rc25_a_termos_processo_termo_num" class="rc25_a_termos_processo_termo_num">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_termos->processo_termo_num->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_termos->processo_termo_num->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
	<?php if ($rc25_a_termos->SortUrl($rc25_a_termos->processo_numero) == "") { ?>
		<th data-name="processo_numero" class="<?php echo $rc25_a_termos->processo_numero->HeaderCellClass() ?>"><div id="elh_rc25_a_termos_processo_numero" class="rc25_a_termos_processo_numero"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="processo_numero" class="<?php echo $rc25_a_termos->processo_numero->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_termos->SortUrl($rc25_a_termos->processo_numero) ?>',1);"><div id="elh_rc25_a_termos_processo_numero" class="rc25_a_termos_processo_numero">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_termos->processo_numero->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_termos->processo_numero->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
	<?php if ($rc25_a_termos->SortUrl($rc25_a_termos->processo_vigencia_ini) == "") { ?>
		<th data-name="processo_vigencia_ini" class="<?php echo $rc25_a_termos->processo_vigencia_ini->HeaderCellClass() ?>"><div id="elh_rc25_a_termos_processo_vigencia_ini" class="rc25_a_termos_processo_vigencia_ini"><div class="ewTableHeaderCaption" style="width: 120px; white-space: nowrap;"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="processo_vigencia_ini" class="<?php echo $rc25_a_termos->processo_vigencia_ini->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_termos->SortUrl($rc25_a_termos->processo_vigencia_ini) ?>',1);"><div id="elh_rc25_a_termos_processo_vigencia_ini" class="rc25_a_termos_processo_vigencia_ini">
			<div class="ewTableHeaderBtn" style="width: 120px; white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_termos->processo_vigencia_ini->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_termos->processo_vigencia_ini->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
	<?php if ($rc25_a_termos->SortUrl($rc25_a_termos->processo_vigencia_fim) == "") { ?>
		<th data-name="processo_vigencia_fim" class="<?php echo $rc25_a_termos->processo_vigencia_fim->HeaderCellClass() ?>"><div id="elh_rc25_a_termos_processo_vigencia_fim" class="rc25_a_termos_processo_vigencia_fim"><div class="ewTableHeaderCaption" style="width: 120px; white-space: nowrap;"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="processo_vigencia_fim" class="<?php echo $rc25_a_termos->processo_vigencia_fim->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $rc25_a_termos->SortUrl($rc25_a_termos->processo_vigencia_fim) ?>',1);"><div id="elh_rc25_a_termos_processo_vigencia_fim" class="rc25_a_termos_processo_vigencia_fim">
			<div class="ewTableHeaderBtn" style="width: 120px; white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_termos->processo_vigencia_fim->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_termos->processo_vigencia_fim->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_termos_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rc25_a_termos->ExportAll && $rc25_a_termos->Export <> "") {
	$rc25_a_termos_list->StopRec = $rc25_a_termos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($rc25_a_termos_list->TotalRecs > $rc25_a_termos_list->StartRec + $rc25_a_termos_list->DisplayRecs - 1)
		$rc25_a_termos_list->StopRec = $rc25_a_termos_list->StartRec + $rc25_a_termos_list->DisplayRecs - 1;
	else
		$rc25_a_termos_list->StopRec = $rc25_a_termos_list->TotalRecs;
}
$rc25_a_termos_list->RecCnt = $rc25_a_termos_list->StartRec - 1;
if ($rc25_a_termos_list->Recordset && !$rc25_a_termos_list->Recordset->EOF) {
	$rc25_a_termos_list->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_termos_list->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_termos_list->StartRec > 1)
		$rc25_a_termos_list->Recordset->Move($rc25_a_termos_list->StartRec - 1);
} elseif (!$rc25_a_termos->AllowAddDeleteRow && $rc25_a_termos_list->StopRec == 0) {
	$rc25_a_termos_list->StopRec = $rc25_a_termos->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_termos->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_termos->ResetAttrs();
$rc25_a_termos_list->RenderRow();
while ($rc25_a_termos_list->RecCnt < $rc25_a_termos_list->StopRec) {
	$rc25_a_termos_list->RecCnt++;
	if (intval($rc25_a_termos_list->RecCnt) >= intval($rc25_a_termos_list->StartRec)) {
		$rc25_a_termos_list->RowCnt++;

		// Set up key count
		$rc25_a_termos_list->KeyCount = $rc25_a_termos_list->RowIndex;

		// Init row class and style
		$rc25_a_termos->ResetAttrs();
		$rc25_a_termos->CssClass = "";
		if ($rc25_a_termos->CurrentAction == "gridadd") {
		} else {
			$rc25_a_termos_list->LoadRowValues($rc25_a_termos_list->Recordset); // Load row values
		}
		$rc25_a_termos->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rc25_a_termos->RowAttrs = array_merge($rc25_a_termos->RowAttrs, array('data-rowindex'=>$rc25_a_termos_list->RowCnt, 'id'=>'r' . $rc25_a_termos_list->RowCnt . '_rc25_a_termos', 'data-rowtype'=>$rc25_a_termos->RowType));

		// Render row
		$rc25_a_termos_list->RenderRow();

		// Render list options
		$rc25_a_termos_list->RenderListOptions();
?>
	<tr<?php echo $rc25_a_termos->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_termos_list->ListOptions->Render("body", "left", $rc25_a_termos_list->RowCnt);
?>
	<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
		<td data-name="processo_exercicio"<?php echo $rc25_a_termos->processo_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_list->RowCnt ?>_rc25_a_termos_processo_exercicio" class="rc25_a_termos_processo_exercicio">
<span<?php echo $rc25_a_termos->processo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
		<td data-name="processo_termo_num"<?php echo $rc25_a_termos->processo_termo_num->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_list->RowCnt ?>_rc25_a_termos_processo_termo_num" class="rc25_a_termos_processo_termo_num">
<span<?php echo $rc25_a_termos->processo_termo_num->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_termo_num->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
		<td data-name="processo_numero"<?php echo $rc25_a_termos->processo_numero->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_list->RowCnt ?>_rc25_a_termos_processo_numero" class="rc25_a_termos_processo_numero">
<span<?php echo $rc25_a_termos->processo_numero->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_numero->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
		<td data-name="processo_vigencia_ini"<?php echo $rc25_a_termos->processo_vigencia_ini->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_list->RowCnt ?>_rc25_a_termos_processo_vigencia_ini" class="rc25_a_termos_processo_vigencia_ini">
<span<?php echo $rc25_a_termos->processo_vigencia_ini->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_ini->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
		<td data-name="processo_vigencia_fim"<?php echo $rc25_a_termos->processo_vigencia_fim->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_list->RowCnt ?>_rc25_a_termos_processo_vigencia_fim" class="rc25_a_termos_processo_vigencia_fim">
<span<?php echo $rc25_a_termos->processo_vigencia_fim->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_fim->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_termos_list->ListOptions->Render("body", "right", $rc25_a_termos_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($rc25_a_termos->CurrentAction <> "gridadd")
		$rc25_a_termos_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($rc25_a_termos->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rc25_a_termos_list->Recordset)
	$rc25_a_termos_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($rc25_a_termos->CurrentAction <> "gridadd" && $rc25_a_termos->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($rc25_a_termos_list->Pager)) $rc25_a_termos_list->Pager = new cPrevNextPager($rc25_a_termos_list->StartRec, $rc25_a_termos_list->DisplayRecs, $rc25_a_termos_list->TotalRecs, $rc25_a_termos_list->AutoHidePager) ?>
<?php if ($rc25_a_termos_list->Pager->RecordCount > 0 && $rc25_a_termos_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($rc25_a_termos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($rc25_a_termos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $rc25_a_termos_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($rc25_a_termos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($rc25_a_termos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $rc25_a_termos_list->PageUrl() ?>start=<?php echo $rc25_a_termos_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($rc25_a_termos_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $rc25_a_termos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_termos_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_termos_list->TotalRecs == 0 && $rc25_a_termos->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_termos_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
frc25_a_termoslistsrch.FilterList = <?php echo $rc25_a_termos_list->GetFilterList() ?>;
frc25_a_termoslistsrch.Init();
frc25_a_termoslist.Init();
</script>
<?php
$rc25_a_termos_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_termos_list->Page_Terminate();
?>
