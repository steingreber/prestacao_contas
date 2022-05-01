<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "view_parceira_repaseinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$view_parceira_repase_list = NULL; // Initialize page object first

class cview_parceira_repase_list extends cview_parceira_repase {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'view_parceira_repase';

	// Page object name
	var $PageObjName = 'view_parceira_repase_list';

	// Grid form hidden field names
	var $FormName = 'fview_parceira_repaselist';
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

		// Table object (view_parceira_repase)
		if (!isset($GLOBALS["view_parceira_repase"]) || get_class($GLOBALS["view_parceira_repase"]) == "cview_parceira_repase") {
			$GLOBALS["view_parceira_repase"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["view_parceira_repase"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "view_parceira_repaseadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "view_parceira_repasedelete.php";
		$this->MultiUpdateUrl = "view_parceira_repaseupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'view_parceira_repase', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fview_parceira_repaselistsrch";

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
		$this->pExercicio->SetVisibility();
		$this->pTermoNumero->SetVisibility();
		$this->pNumero->SetVisibility();
		$this->pInicioVigencia->SetVisibility();
		$this->pFimVigencia->SetVisibility();
		$this->pData->SetVisibility();
		$this->pValor->SetVisibility();
		$this->pOrigem->SetVisibility();
		$this->pEntidadeEdereco->SetVisibility();
		$this->pEntidadeLei->SetVisibility();
		$this->pEntidadeCebas->SetVisibility();
		$this->pRespNome->SetVisibility();
		$this->pRespCargo->SetVisibility();
		$this->pRespEdereco->SetVisibility();
		$this->pRespContato->SetVisibility();
		$this->pRespAta->SetVisibility();
		$this->pContNome->SetVisibility();
		$this->pContEndereco->SetVisibility();
		$this->pContContato->SetVisibility();
		$this->pContDocumento->SetVisibility();
		$this->pPrencherNome->SetVisibility();
		$this->pPrencherCargo->SetVisibility();
		$this->pPrencherEndereco->SetVisibility();
		$this->pPrencherContato->SetVisibility();
		$this->pPrencherDocumento->SetVisibility();
		$this->rIDRepasse->SetVisibility();
		$this->rFaixaEtaria->SetVisibility();
		$this->rMeta->SetVisibility();
		$this->rValorUnitario->SetVisibility();
		$this->rValorMensal->SetVisibility();
		$this->rValorPrevisto->SetVisibility();

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
		global $EW_EXPORT, $view_parceira_repase;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($view_parceira_repase);
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

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

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
		if (count($arrKeyFlds) >= 0) {
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->pExercicio->AdvancedSearch->ToJson(), ","); // Field pExercicio
		$sFilterList = ew_Concat($sFilterList, $this->pTermoNumero->AdvancedSearch->ToJson(), ","); // Field pTermoNumero
		$sFilterList = ew_Concat($sFilterList, $this->pNumero->AdvancedSearch->ToJson(), ","); // Field pNumero
		$sFilterList = ew_Concat($sFilterList, $this->pInicioVigencia->AdvancedSearch->ToJson(), ","); // Field pInicioVigencia
		$sFilterList = ew_Concat($sFilterList, $this->pFimVigencia->AdvancedSearch->ToJson(), ","); // Field pFimVigencia
		$sFilterList = ew_Concat($sFilterList, $this->pData->AdvancedSearch->ToJson(), ","); // Field pData
		$sFilterList = ew_Concat($sFilterList, $this->pValor->AdvancedSearch->ToJson(), ","); // Field pValor
		$sFilterList = ew_Concat($sFilterList, $this->pObjeto->AdvancedSearch->ToJson(), ","); // Field pObjeto
		$sFilterList = ew_Concat($sFilterList, $this->pMetas->AdvancedSearch->ToJson(), ","); // Field pMetas
		$sFilterList = ew_Concat($sFilterList, $this->pOrigem->AdvancedSearch->ToJson(), ","); // Field pOrigem
		$sFilterList = ew_Concat($sFilterList, $this->pEntidadeEdereco->AdvancedSearch->ToJson(), ","); // Field pEntidadeEdereco
		$sFilterList = ew_Concat($sFilterList, $this->pEntidadeLei->AdvancedSearch->ToJson(), ","); // Field pEntidadeLei
		$sFilterList = ew_Concat($sFilterList, $this->pEntidadeCebas->AdvancedSearch->ToJson(), ","); // Field pEntidadeCebas
		$sFilterList = ew_Concat($sFilterList, $this->pRespNome->AdvancedSearch->ToJson(), ","); // Field pRespNome
		$sFilterList = ew_Concat($sFilterList, $this->pRespCargo->AdvancedSearch->ToJson(), ","); // Field pRespCargo
		$sFilterList = ew_Concat($sFilterList, $this->pRespEdereco->AdvancedSearch->ToJson(), ","); // Field pRespEdereco
		$sFilterList = ew_Concat($sFilterList, $this->pRespContato->AdvancedSearch->ToJson(), ","); // Field pRespContato
		$sFilterList = ew_Concat($sFilterList, $this->pRespAta->AdvancedSearch->ToJson(), ","); // Field pRespAta
		$sFilterList = ew_Concat($sFilterList, $this->pContNome->AdvancedSearch->ToJson(), ","); // Field pContNome
		$sFilterList = ew_Concat($sFilterList, $this->pContEndereco->AdvancedSearch->ToJson(), ","); // Field pContEndereco
		$sFilterList = ew_Concat($sFilterList, $this->pContContato->AdvancedSearch->ToJson(), ","); // Field pContContato
		$sFilterList = ew_Concat($sFilterList, $this->pContDocumento->AdvancedSearch->ToJson(), ","); // Field pContDocumento
		$sFilterList = ew_Concat($sFilterList, $this->pPrencherNome->AdvancedSearch->ToJson(), ","); // Field pPrencherNome
		$sFilterList = ew_Concat($sFilterList, $this->pPrencherCargo->AdvancedSearch->ToJson(), ","); // Field pPrencherCargo
		$sFilterList = ew_Concat($sFilterList, $this->pPrencherEndereco->AdvancedSearch->ToJson(), ","); // Field pPrencherEndereco
		$sFilterList = ew_Concat($sFilterList, $this->pPrencherContato->AdvancedSearch->ToJson(), ","); // Field pPrencherContato
		$sFilterList = ew_Concat($sFilterList, $this->pPrencherDocumento->AdvancedSearch->ToJson(), ","); // Field pPrencherDocumento
		$sFilterList = ew_Concat($sFilterList, $this->rIDRepasse->AdvancedSearch->ToJson(), ","); // Field rIDRepasse
		$sFilterList = ew_Concat($sFilterList, $this->rFaixaEtaria->AdvancedSearch->ToJson(), ","); // Field rFaixaEtaria
		$sFilterList = ew_Concat($sFilterList, $this->rMeta->AdvancedSearch->ToJson(), ","); // Field rMeta
		$sFilterList = ew_Concat($sFilterList, $this->rValorUnitario->AdvancedSearch->ToJson(), ","); // Field rValorUnitario
		$sFilterList = ew_Concat($sFilterList, $this->rValorMensal->AdvancedSearch->ToJson(), ","); // Field rValorMensal
		$sFilterList = ew_Concat($sFilterList, $this->rValorPrevisto->AdvancedSearch->ToJson(), ","); // Field rValorPrevisto
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fview_parceira_repaselistsrch", $filters);

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

		// Field pExercicio
		$this->pExercicio->AdvancedSearch->SearchValue = @$filter["x_pExercicio"];
		$this->pExercicio->AdvancedSearch->SearchOperator = @$filter["z_pExercicio"];
		$this->pExercicio->AdvancedSearch->SearchCondition = @$filter["v_pExercicio"];
		$this->pExercicio->AdvancedSearch->SearchValue2 = @$filter["y_pExercicio"];
		$this->pExercicio->AdvancedSearch->SearchOperator2 = @$filter["w_pExercicio"];
		$this->pExercicio->AdvancedSearch->Save();

		// Field pTermoNumero
		$this->pTermoNumero->AdvancedSearch->SearchValue = @$filter["x_pTermoNumero"];
		$this->pTermoNumero->AdvancedSearch->SearchOperator = @$filter["z_pTermoNumero"];
		$this->pTermoNumero->AdvancedSearch->SearchCondition = @$filter["v_pTermoNumero"];
		$this->pTermoNumero->AdvancedSearch->SearchValue2 = @$filter["y_pTermoNumero"];
		$this->pTermoNumero->AdvancedSearch->SearchOperator2 = @$filter["w_pTermoNumero"];
		$this->pTermoNumero->AdvancedSearch->Save();

		// Field pNumero
		$this->pNumero->AdvancedSearch->SearchValue = @$filter["x_pNumero"];
		$this->pNumero->AdvancedSearch->SearchOperator = @$filter["z_pNumero"];
		$this->pNumero->AdvancedSearch->SearchCondition = @$filter["v_pNumero"];
		$this->pNumero->AdvancedSearch->SearchValue2 = @$filter["y_pNumero"];
		$this->pNumero->AdvancedSearch->SearchOperator2 = @$filter["w_pNumero"];
		$this->pNumero->AdvancedSearch->Save();

		// Field pInicioVigencia
		$this->pInicioVigencia->AdvancedSearch->SearchValue = @$filter["x_pInicioVigencia"];
		$this->pInicioVigencia->AdvancedSearch->SearchOperator = @$filter["z_pInicioVigencia"];
		$this->pInicioVigencia->AdvancedSearch->SearchCondition = @$filter["v_pInicioVigencia"];
		$this->pInicioVigencia->AdvancedSearch->SearchValue2 = @$filter["y_pInicioVigencia"];
		$this->pInicioVigencia->AdvancedSearch->SearchOperator2 = @$filter["w_pInicioVigencia"];
		$this->pInicioVigencia->AdvancedSearch->Save();

		// Field pFimVigencia
		$this->pFimVigencia->AdvancedSearch->SearchValue = @$filter["x_pFimVigencia"];
		$this->pFimVigencia->AdvancedSearch->SearchOperator = @$filter["z_pFimVigencia"];
		$this->pFimVigencia->AdvancedSearch->SearchCondition = @$filter["v_pFimVigencia"];
		$this->pFimVigencia->AdvancedSearch->SearchValue2 = @$filter["y_pFimVigencia"];
		$this->pFimVigencia->AdvancedSearch->SearchOperator2 = @$filter["w_pFimVigencia"];
		$this->pFimVigencia->AdvancedSearch->Save();

		// Field pData
		$this->pData->AdvancedSearch->SearchValue = @$filter["x_pData"];
		$this->pData->AdvancedSearch->SearchOperator = @$filter["z_pData"];
		$this->pData->AdvancedSearch->SearchCondition = @$filter["v_pData"];
		$this->pData->AdvancedSearch->SearchValue2 = @$filter["y_pData"];
		$this->pData->AdvancedSearch->SearchOperator2 = @$filter["w_pData"];
		$this->pData->AdvancedSearch->Save();

		// Field pValor
		$this->pValor->AdvancedSearch->SearchValue = @$filter["x_pValor"];
		$this->pValor->AdvancedSearch->SearchOperator = @$filter["z_pValor"];
		$this->pValor->AdvancedSearch->SearchCondition = @$filter["v_pValor"];
		$this->pValor->AdvancedSearch->SearchValue2 = @$filter["y_pValor"];
		$this->pValor->AdvancedSearch->SearchOperator2 = @$filter["w_pValor"];
		$this->pValor->AdvancedSearch->Save();

		// Field pObjeto
		$this->pObjeto->AdvancedSearch->SearchValue = @$filter["x_pObjeto"];
		$this->pObjeto->AdvancedSearch->SearchOperator = @$filter["z_pObjeto"];
		$this->pObjeto->AdvancedSearch->SearchCondition = @$filter["v_pObjeto"];
		$this->pObjeto->AdvancedSearch->SearchValue2 = @$filter["y_pObjeto"];
		$this->pObjeto->AdvancedSearch->SearchOperator2 = @$filter["w_pObjeto"];
		$this->pObjeto->AdvancedSearch->Save();

		// Field pMetas
		$this->pMetas->AdvancedSearch->SearchValue = @$filter["x_pMetas"];
		$this->pMetas->AdvancedSearch->SearchOperator = @$filter["z_pMetas"];
		$this->pMetas->AdvancedSearch->SearchCondition = @$filter["v_pMetas"];
		$this->pMetas->AdvancedSearch->SearchValue2 = @$filter["y_pMetas"];
		$this->pMetas->AdvancedSearch->SearchOperator2 = @$filter["w_pMetas"];
		$this->pMetas->AdvancedSearch->Save();

		// Field pOrigem
		$this->pOrigem->AdvancedSearch->SearchValue = @$filter["x_pOrigem"];
		$this->pOrigem->AdvancedSearch->SearchOperator = @$filter["z_pOrigem"];
		$this->pOrigem->AdvancedSearch->SearchCondition = @$filter["v_pOrigem"];
		$this->pOrigem->AdvancedSearch->SearchValue2 = @$filter["y_pOrigem"];
		$this->pOrigem->AdvancedSearch->SearchOperator2 = @$filter["w_pOrigem"];
		$this->pOrigem->AdvancedSearch->Save();

		// Field pEntidadeEdereco
		$this->pEntidadeEdereco->AdvancedSearch->SearchValue = @$filter["x_pEntidadeEdereco"];
		$this->pEntidadeEdereco->AdvancedSearch->SearchOperator = @$filter["z_pEntidadeEdereco"];
		$this->pEntidadeEdereco->AdvancedSearch->SearchCondition = @$filter["v_pEntidadeEdereco"];
		$this->pEntidadeEdereco->AdvancedSearch->SearchValue2 = @$filter["y_pEntidadeEdereco"];
		$this->pEntidadeEdereco->AdvancedSearch->SearchOperator2 = @$filter["w_pEntidadeEdereco"];
		$this->pEntidadeEdereco->AdvancedSearch->Save();

		// Field pEntidadeLei
		$this->pEntidadeLei->AdvancedSearch->SearchValue = @$filter["x_pEntidadeLei"];
		$this->pEntidadeLei->AdvancedSearch->SearchOperator = @$filter["z_pEntidadeLei"];
		$this->pEntidadeLei->AdvancedSearch->SearchCondition = @$filter["v_pEntidadeLei"];
		$this->pEntidadeLei->AdvancedSearch->SearchValue2 = @$filter["y_pEntidadeLei"];
		$this->pEntidadeLei->AdvancedSearch->SearchOperator2 = @$filter["w_pEntidadeLei"];
		$this->pEntidadeLei->AdvancedSearch->Save();

		// Field pEntidadeCebas
		$this->pEntidadeCebas->AdvancedSearch->SearchValue = @$filter["x_pEntidadeCebas"];
		$this->pEntidadeCebas->AdvancedSearch->SearchOperator = @$filter["z_pEntidadeCebas"];
		$this->pEntidadeCebas->AdvancedSearch->SearchCondition = @$filter["v_pEntidadeCebas"];
		$this->pEntidadeCebas->AdvancedSearch->SearchValue2 = @$filter["y_pEntidadeCebas"];
		$this->pEntidadeCebas->AdvancedSearch->SearchOperator2 = @$filter["w_pEntidadeCebas"];
		$this->pEntidadeCebas->AdvancedSearch->Save();

		// Field pRespNome
		$this->pRespNome->AdvancedSearch->SearchValue = @$filter["x_pRespNome"];
		$this->pRespNome->AdvancedSearch->SearchOperator = @$filter["z_pRespNome"];
		$this->pRespNome->AdvancedSearch->SearchCondition = @$filter["v_pRespNome"];
		$this->pRespNome->AdvancedSearch->SearchValue2 = @$filter["y_pRespNome"];
		$this->pRespNome->AdvancedSearch->SearchOperator2 = @$filter["w_pRespNome"];
		$this->pRespNome->AdvancedSearch->Save();

		// Field pRespCargo
		$this->pRespCargo->AdvancedSearch->SearchValue = @$filter["x_pRespCargo"];
		$this->pRespCargo->AdvancedSearch->SearchOperator = @$filter["z_pRespCargo"];
		$this->pRespCargo->AdvancedSearch->SearchCondition = @$filter["v_pRespCargo"];
		$this->pRespCargo->AdvancedSearch->SearchValue2 = @$filter["y_pRespCargo"];
		$this->pRespCargo->AdvancedSearch->SearchOperator2 = @$filter["w_pRespCargo"];
		$this->pRespCargo->AdvancedSearch->Save();

		// Field pRespEdereco
		$this->pRespEdereco->AdvancedSearch->SearchValue = @$filter["x_pRespEdereco"];
		$this->pRespEdereco->AdvancedSearch->SearchOperator = @$filter["z_pRespEdereco"];
		$this->pRespEdereco->AdvancedSearch->SearchCondition = @$filter["v_pRespEdereco"];
		$this->pRespEdereco->AdvancedSearch->SearchValue2 = @$filter["y_pRespEdereco"];
		$this->pRespEdereco->AdvancedSearch->SearchOperator2 = @$filter["w_pRespEdereco"];
		$this->pRespEdereco->AdvancedSearch->Save();

		// Field pRespContato
		$this->pRespContato->AdvancedSearch->SearchValue = @$filter["x_pRespContato"];
		$this->pRespContato->AdvancedSearch->SearchOperator = @$filter["z_pRespContato"];
		$this->pRespContato->AdvancedSearch->SearchCondition = @$filter["v_pRespContato"];
		$this->pRespContato->AdvancedSearch->SearchValue2 = @$filter["y_pRespContato"];
		$this->pRespContato->AdvancedSearch->SearchOperator2 = @$filter["w_pRespContato"];
		$this->pRespContato->AdvancedSearch->Save();

		// Field pRespAta
		$this->pRespAta->AdvancedSearch->SearchValue = @$filter["x_pRespAta"];
		$this->pRespAta->AdvancedSearch->SearchOperator = @$filter["z_pRespAta"];
		$this->pRespAta->AdvancedSearch->SearchCondition = @$filter["v_pRespAta"];
		$this->pRespAta->AdvancedSearch->SearchValue2 = @$filter["y_pRespAta"];
		$this->pRespAta->AdvancedSearch->SearchOperator2 = @$filter["w_pRespAta"];
		$this->pRespAta->AdvancedSearch->Save();

		// Field pContNome
		$this->pContNome->AdvancedSearch->SearchValue = @$filter["x_pContNome"];
		$this->pContNome->AdvancedSearch->SearchOperator = @$filter["z_pContNome"];
		$this->pContNome->AdvancedSearch->SearchCondition = @$filter["v_pContNome"];
		$this->pContNome->AdvancedSearch->SearchValue2 = @$filter["y_pContNome"];
		$this->pContNome->AdvancedSearch->SearchOperator2 = @$filter["w_pContNome"];
		$this->pContNome->AdvancedSearch->Save();

		// Field pContEndereco
		$this->pContEndereco->AdvancedSearch->SearchValue = @$filter["x_pContEndereco"];
		$this->pContEndereco->AdvancedSearch->SearchOperator = @$filter["z_pContEndereco"];
		$this->pContEndereco->AdvancedSearch->SearchCondition = @$filter["v_pContEndereco"];
		$this->pContEndereco->AdvancedSearch->SearchValue2 = @$filter["y_pContEndereco"];
		$this->pContEndereco->AdvancedSearch->SearchOperator2 = @$filter["w_pContEndereco"];
		$this->pContEndereco->AdvancedSearch->Save();

		// Field pContContato
		$this->pContContato->AdvancedSearch->SearchValue = @$filter["x_pContContato"];
		$this->pContContato->AdvancedSearch->SearchOperator = @$filter["z_pContContato"];
		$this->pContContato->AdvancedSearch->SearchCondition = @$filter["v_pContContato"];
		$this->pContContato->AdvancedSearch->SearchValue2 = @$filter["y_pContContato"];
		$this->pContContato->AdvancedSearch->SearchOperator2 = @$filter["w_pContContato"];
		$this->pContContato->AdvancedSearch->Save();

		// Field pContDocumento
		$this->pContDocumento->AdvancedSearch->SearchValue = @$filter["x_pContDocumento"];
		$this->pContDocumento->AdvancedSearch->SearchOperator = @$filter["z_pContDocumento"];
		$this->pContDocumento->AdvancedSearch->SearchCondition = @$filter["v_pContDocumento"];
		$this->pContDocumento->AdvancedSearch->SearchValue2 = @$filter["y_pContDocumento"];
		$this->pContDocumento->AdvancedSearch->SearchOperator2 = @$filter["w_pContDocumento"];
		$this->pContDocumento->AdvancedSearch->Save();

		// Field pPrencherNome
		$this->pPrencherNome->AdvancedSearch->SearchValue = @$filter["x_pPrencherNome"];
		$this->pPrencherNome->AdvancedSearch->SearchOperator = @$filter["z_pPrencherNome"];
		$this->pPrencherNome->AdvancedSearch->SearchCondition = @$filter["v_pPrencherNome"];
		$this->pPrencherNome->AdvancedSearch->SearchValue2 = @$filter["y_pPrencherNome"];
		$this->pPrencherNome->AdvancedSearch->SearchOperator2 = @$filter["w_pPrencherNome"];
		$this->pPrencherNome->AdvancedSearch->Save();

		// Field pPrencherCargo
		$this->pPrencherCargo->AdvancedSearch->SearchValue = @$filter["x_pPrencherCargo"];
		$this->pPrencherCargo->AdvancedSearch->SearchOperator = @$filter["z_pPrencherCargo"];
		$this->pPrencherCargo->AdvancedSearch->SearchCondition = @$filter["v_pPrencherCargo"];
		$this->pPrencherCargo->AdvancedSearch->SearchValue2 = @$filter["y_pPrencherCargo"];
		$this->pPrencherCargo->AdvancedSearch->SearchOperator2 = @$filter["w_pPrencherCargo"];
		$this->pPrencherCargo->AdvancedSearch->Save();

		// Field pPrencherEndereco
		$this->pPrencherEndereco->AdvancedSearch->SearchValue = @$filter["x_pPrencherEndereco"];
		$this->pPrencherEndereco->AdvancedSearch->SearchOperator = @$filter["z_pPrencherEndereco"];
		$this->pPrencherEndereco->AdvancedSearch->SearchCondition = @$filter["v_pPrencherEndereco"];
		$this->pPrencherEndereco->AdvancedSearch->SearchValue2 = @$filter["y_pPrencherEndereco"];
		$this->pPrencherEndereco->AdvancedSearch->SearchOperator2 = @$filter["w_pPrencherEndereco"];
		$this->pPrencherEndereco->AdvancedSearch->Save();

		// Field pPrencherContato
		$this->pPrencherContato->AdvancedSearch->SearchValue = @$filter["x_pPrencherContato"];
		$this->pPrencherContato->AdvancedSearch->SearchOperator = @$filter["z_pPrencherContato"];
		$this->pPrencherContato->AdvancedSearch->SearchCondition = @$filter["v_pPrencherContato"];
		$this->pPrencherContato->AdvancedSearch->SearchValue2 = @$filter["y_pPrencherContato"];
		$this->pPrencherContato->AdvancedSearch->SearchOperator2 = @$filter["w_pPrencherContato"];
		$this->pPrencherContato->AdvancedSearch->Save();

		// Field pPrencherDocumento
		$this->pPrencherDocumento->AdvancedSearch->SearchValue = @$filter["x_pPrencherDocumento"];
		$this->pPrencherDocumento->AdvancedSearch->SearchOperator = @$filter["z_pPrencherDocumento"];
		$this->pPrencherDocumento->AdvancedSearch->SearchCondition = @$filter["v_pPrencherDocumento"];
		$this->pPrencherDocumento->AdvancedSearch->SearchValue2 = @$filter["y_pPrencherDocumento"];
		$this->pPrencherDocumento->AdvancedSearch->SearchOperator2 = @$filter["w_pPrencherDocumento"];
		$this->pPrencherDocumento->AdvancedSearch->Save();

		// Field rIDRepasse
		$this->rIDRepasse->AdvancedSearch->SearchValue = @$filter["x_rIDRepasse"];
		$this->rIDRepasse->AdvancedSearch->SearchOperator = @$filter["z_rIDRepasse"];
		$this->rIDRepasse->AdvancedSearch->SearchCondition = @$filter["v_rIDRepasse"];
		$this->rIDRepasse->AdvancedSearch->SearchValue2 = @$filter["y_rIDRepasse"];
		$this->rIDRepasse->AdvancedSearch->SearchOperator2 = @$filter["w_rIDRepasse"];
		$this->rIDRepasse->AdvancedSearch->Save();

		// Field rFaixaEtaria
		$this->rFaixaEtaria->AdvancedSearch->SearchValue = @$filter["x_rFaixaEtaria"];
		$this->rFaixaEtaria->AdvancedSearch->SearchOperator = @$filter["z_rFaixaEtaria"];
		$this->rFaixaEtaria->AdvancedSearch->SearchCondition = @$filter["v_rFaixaEtaria"];
		$this->rFaixaEtaria->AdvancedSearch->SearchValue2 = @$filter["y_rFaixaEtaria"];
		$this->rFaixaEtaria->AdvancedSearch->SearchOperator2 = @$filter["w_rFaixaEtaria"];
		$this->rFaixaEtaria->AdvancedSearch->Save();

		// Field rMeta
		$this->rMeta->AdvancedSearch->SearchValue = @$filter["x_rMeta"];
		$this->rMeta->AdvancedSearch->SearchOperator = @$filter["z_rMeta"];
		$this->rMeta->AdvancedSearch->SearchCondition = @$filter["v_rMeta"];
		$this->rMeta->AdvancedSearch->SearchValue2 = @$filter["y_rMeta"];
		$this->rMeta->AdvancedSearch->SearchOperator2 = @$filter["w_rMeta"];
		$this->rMeta->AdvancedSearch->Save();

		// Field rValorUnitario
		$this->rValorUnitario->AdvancedSearch->SearchValue = @$filter["x_rValorUnitario"];
		$this->rValorUnitario->AdvancedSearch->SearchOperator = @$filter["z_rValorUnitario"];
		$this->rValorUnitario->AdvancedSearch->SearchCondition = @$filter["v_rValorUnitario"];
		$this->rValorUnitario->AdvancedSearch->SearchValue2 = @$filter["y_rValorUnitario"];
		$this->rValorUnitario->AdvancedSearch->SearchOperator2 = @$filter["w_rValorUnitario"];
		$this->rValorUnitario->AdvancedSearch->Save();

		// Field rValorMensal
		$this->rValorMensal->AdvancedSearch->SearchValue = @$filter["x_rValorMensal"];
		$this->rValorMensal->AdvancedSearch->SearchOperator = @$filter["z_rValorMensal"];
		$this->rValorMensal->AdvancedSearch->SearchCondition = @$filter["v_rValorMensal"];
		$this->rValorMensal->AdvancedSearch->SearchValue2 = @$filter["y_rValorMensal"];
		$this->rValorMensal->AdvancedSearch->SearchOperator2 = @$filter["w_rValorMensal"];
		$this->rValorMensal->AdvancedSearch->Save();

		// Field rValorPrevisto
		$this->rValorPrevisto->AdvancedSearch->SearchValue = @$filter["x_rValorPrevisto"];
		$this->rValorPrevisto->AdvancedSearch->SearchOperator = @$filter["z_rValorPrevisto"];
		$this->rValorPrevisto->AdvancedSearch->SearchCondition = @$filter["v_rValorPrevisto"];
		$this->rValorPrevisto->AdvancedSearch->SearchValue2 = @$filter["y_rValorPrevisto"];
		$this->rValorPrevisto->AdvancedSearch->SearchOperator2 = @$filter["w_rValorPrevisto"];
		$this->rValorPrevisto->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->pTermoNumero, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pNumero, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pObjeto, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pMetas, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pOrigem, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pEntidadeEdereco, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pEntidadeLei, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pEntidadeCebas, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pRespNome, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pRespCargo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pRespEdereco, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pRespContato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pRespAta, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pContNome, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pContEndereco, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pContContato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pContDocumento, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pPrencherNome, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pPrencherCargo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pPrencherEndereco, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pPrencherContato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pPrencherDocumento, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->rFaixaEtaria, $arKeywords, $type);
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
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->pExercicio); // pExercicio
			$this->UpdateSort($this->pTermoNumero); // pTermoNumero
			$this->UpdateSort($this->pNumero); // pNumero
			$this->UpdateSort($this->pInicioVigencia); // pInicioVigencia
			$this->UpdateSort($this->pFimVigencia); // pFimVigencia
			$this->UpdateSort($this->pData); // pData
			$this->UpdateSort($this->pValor); // pValor
			$this->UpdateSort($this->pOrigem); // pOrigem
			$this->UpdateSort($this->pEntidadeEdereco); // pEntidadeEdereco
			$this->UpdateSort($this->pEntidadeLei); // pEntidadeLei
			$this->UpdateSort($this->pEntidadeCebas); // pEntidadeCebas
			$this->UpdateSort($this->pRespNome); // pRespNome
			$this->UpdateSort($this->pRespCargo); // pRespCargo
			$this->UpdateSort($this->pRespEdereco); // pRespEdereco
			$this->UpdateSort($this->pRespContato); // pRespContato
			$this->UpdateSort($this->pRespAta); // pRespAta
			$this->UpdateSort($this->pContNome); // pContNome
			$this->UpdateSort($this->pContEndereco); // pContEndereco
			$this->UpdateSort($this->pContContato); // pContContato
			$this->UpdateSort($this->pContDocumento); // pContDocumento
			$this->UpdateSort($this->pPrencherNome); // pPrencherNome
			$this->UpdateSort($this->pPrencherCargo); // pPrencherCargo
			$this->UpdateSort($this->pPrencherEndereco); // pPrencherEndereco
			$this->UpdateSort($this->pPrencherContato); // pPrencherContato
			$this->UpdateSort($this->pPrencherDocumento); // pPrencherDocumento
			$this->UpdateSort($this->rIDRepasse); // rIDRepasse
			$this->UpdateSort($this->rFaixaEtaria); // rFaixaEtaria
			$this->UpdateSort($this->rMeta); // rMeta
			$this->UpdateSort($this->rValorUnitario); // rValorUnitario
			$this->UpdateSort($this->rValorMensal); // rValorMensal
			$this->UpdateSort($this->rValorPrevisto); // rValorPrevisto
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
				$this->pExercicio->setSort("");
				$this->pTermoNumero->setSort("");
				$this->pNumero->setSort("");
				$this->pInicioVigencia->setSort("");
				$this->pFimVigencia->setSort("");
				$this->pData->setSort("");
				$this->pValor->setSort("");
				$this->pOrigem->setSort("");
				$this->pEntidadeEdereco->setSort("");
				$this->pEntidadeLei->setSort("");
				$this->pEntidadeCebas->setSort("");
				$this->pRespNome->setSort("");
				$this->pRespCargo->setSort("");
				$this->pRespEdereco->setSort("");
				$this->pRespContato->setSort("");
				$this->pRespAta->setSort("");
				$this->pContNome->setSort("");
				$this->pContEndereco->setSort("");
				$this->pContContato->setSort("");
				$this->pContDocumento->setSort("");
				$this->pPrencherNome->setSort("");
				$this->pPrencherCargo->setSort("");
				$this->pPrencherEndereco->setSort("");
				$this->pPrencherContato->setSort("");
				$this->pPrencherDocumento->setSort("");
				$this->rIDRepasse->setSort("");
				$this->rFaixaEtaria->setSort("");
				$this->rMeta->setSort("");
				$this->rValorUnitario->setSort("");
				$this->rValorMensal->setSort("");
				$this->rValorPrevisto->setSort("");
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
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fview_parceira_repaselistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fview_parceira_repaselistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fview_parceira_repaselist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fview_parceira_repaselistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		$this->pExercicio->setDbValue($row['pExercicio']);
		$this->pTermoNumero->setDbValue($row['pTermoNumero']);
		$this->pNumero->setDbValue($row['pNumero']);
		$this->pInicioVigencia->setDbValue($row['pInicioVigencia']);
		$this->pFimVigencia->setDbValue($row['pFimVigencia']);
		$this->pData->setDbValue($row['pData']);
		$this->pValor->setDbValue($row['pValor']);
		$this->pObjeto->setDbValue($row['pObjeto']);
		$this->pMetas->setDbValue($row['pMetas']);
		$this->pOrigem->setDbValue($row['pOrigem']);
		$this->pEntidadeEdereco->setDbValue($row['pEntidadeEdereco']);
		$this->pEntidadeEstatuto->Upload->DbValue = $row['pEntidadeEstatuto'];
		if (is_array($this->pEntidadeEstatuto->Upload->DbValue) || is_object($this->pEntidadeEstatuto->Upload->DbValue)) // Byte array
			$this->pEntidadeEstatuto->Upload->DbValue = ew_BytesToStr($this->pEntidadeEstatuto->Upload->DbValue);
		$this->pEntidadeLei->setDbValue($row['pEntidadeLei']);
		$this->pEntidadeCebas->setDbValue($row['pEntidadeCebas']);
		$this->pRespNome->setDbValue($row['pRespNome']);
		$this->pRespCargo->setDbValue($row['pRespCargo']);
		$this->pRespEdereco->setDbValue($row['pRespEdereco']);
		$this->pRespContato->setDbValue($row['pRespContato']);
		$this->pRespAta->setDbValue($row['pRespAta']);
		$this->pContNome->setDbValue($row['pContNome']);
		$this->pContEndereco->setDbValue($row['pContEndereco']);
		$this->pContContato->setDbValue($row['pContContato']);
		$this->pContDocumento->setDbValue($row['pContDocumento']);
		$this->pPrencherNome->setDbValue($row['pPrencherNome']);
		$this->pPrencherCargo->setDbValue($row['pPrencherCargo']);
		$this->pPrencherEndereco->setDbValue($row['pPrencherEndereco']);
		$this->pPrencherContato->setDbValue($row['pPrencherContato']);
		$this->pPrencherDocumento->setDbValue($row['pPrencherDocumento']);
		$this->rIDRepasse->setDbValue($row['rIDRepasse']);
		$this->rFaixaEtaria->setDbValue($row['rFaixaEtaria']);
		$this->rMeta->setDbValue($row['rMeta']);
		$this->rValorUnitario->setDbValue($row['rValorUnitario']);
		$this->rValorMensal->setDbValue($row['rValorMensal']);
		$this->rValorPrevisto->setDbValue($row['rValorPrevisto']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['pExercicio'] = NULL;
		$row['pTermoNumero'] = NULL;
		$row['pNumero'] = NULL;
		$row['pInicioVigencia'] = NULL;
		$row['pFimVigencia'] = NULL;
		$row['pData'] = NULL;
		$row['pValor'] = NULL;
		$row['pObjeto'] = NULL;
		$row['pMetas'] = NULL;
		$row['pOrigem'] = NULL;
		$row['pEntidadeEdereco'] = NULL;
		$row['pEntidadeEstatuto'] = NULL;
		$row['pEntidadeLei'] = NULL;
		$row['pEntidadeCebas'] = NULL;
		$row['pRespNome'] = NULL;
		$row['pRespCargo'] = NULL;
		$row['pRespEdereco'] = NULL;
		$row['pRespContato'] = NULL;
		$row['pRespAta'] = NULL;
		$row['pContNome'] = NULL;
		$row['pContEndereco'] = NULL;
		$row['pContContato'] = NULL;
		$row['pContDocumento'] = NULL;
		$row['pPrencherNome'] = NULL;
		$row['pPrencherCargo'] = NULL;
		$row['pPrencherEndereco'] = NULL;
		$row['pPrencherContato'] = NULL;
		$row['pPrencherDocumento'] = NULL;
		$row['rIDRepasse'] = NULL;
		$row['rFaixaEtaria'] = NULL;
		$row['rMeta'] = NULL;
		$row['rValorUnitario'] = NULL;
		$row['rValorMensal'] = NULL;
		$row['rValorPrevisto'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pExercicio->DbValue = $row['pExercicio'];
		$this->pTermoNumero->DbValue = $row['pTermoNumero'];
		$this->pNumero->DbValue = $row['pNumero'];
		$this->pInicioVigencia->DbValue = $row['pInicioVigencia'];
		$this->pFimVigencia->DbValue = $row['pFimVigencia'];
		$this->pData->DbValue = $row['pData'];
		$this->pValor->DbValue = $row['pValor'];
		$this->pObjeto->DbValue = $row['pObjeto'];
		$this->pMetas->DbValue = $row['pMetas'];
		$this->pOrigem->DbValue = $row['pOrigem'];
		$this->pEntidadeEdereco->DbValue = $row['pEntidadeEdereco'];
		$this->pEntidadeEstatuto->Upload->DbValue = $row['pEntidadeEstatuto'];
		$this->pEntidadeLei->DbValue = $row['pEntidadeLei'];
		$this->pEntidadeCebas->DbValue = $row['pEntidadeCebas'];
		$this->pRespNome->DbValue = $row['pRespNome'];
		$this->pRespCargo->DbValue = $row['pRespCargo'];
		$this->pRespEdereco->DbValue = $row['pRespEdereco'];
		$this->pRespContato->DbValue = $row['pRespContato'];
		$this->pRespAta->DbValue = $row['pRespAta'];
		$this->pContNome->DbValue = $row['pContNome'];
		$this->pContEndereco->DbValue = $row['pContEndereco'];
		$this->pContContato->DbValue = $row['pContContato'];
		$this->pContDocumento->DbValue = $row['pContDocumento'];
		$this->pPrencherNome->DbValue = $row['pPrencherNome'];
		$this->pPrencherCargo->DbValue = $row['pPrencherCargo'];
		$this->pPrencherEndereco->DbValue = $row['pPrencherEndereco'];
		$this->pPrencherContato->DbValue = $row['pPrencherContato'];
		$this->pPrencherDocumento->DbValue = $row['pPrencherDocumento'];
		$this->rIDRepasse->DbValue = $row['rIDRepasse'];
		$this->rFaixaEtaria->DbValue = $row['rFaixaEtaria'];
		$this->rMeta->DbValue = $row['rMeta'];
		$this->rValorUnitario->DbValue = $row['rValorUnitario'];
		$this->rValorMensal->DbValue = $row['rValorMensal'];
		$this->rValorPrevisto->DbValue = $row['rValorPrevisto'];
	}

	// Load old record
	function LoadOldRecord() {
		return FALSE;
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
		if ($this->pValor->FormValue == $this->pValor->CurrentValue && is_numeric(ew_StrToFloat($this->pValor->CurrentValue)))
			$this->pValor->CurrentValue = ew_StrToFloat($this->pValor->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorUnitario->FormValue == $this->rValorUnitario->CurrentValue && is_numeric(ew_StrToFloat($this->rValorUnitario->CurrentValue)))
			$this->rValorUnitario->CurrentValue = ew_StrToFloat($this->rValorUnitario->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorMensal->FormValue == $this->rValorMensal->CurrentValue && is_numeric(ew_StrToFloat($this->rValorMensal->CurrentValue)))
			$this->rValorMensal->CurrentValue = ew_StrToFloat($this->rValorMensal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->rValorPrevisto->FormValue == $this->rValorPrevisto->CurrentValue && is_numeric(ew_StrToFloat($this->rValorPrevisto->CurrentValue)))
			$this->rValorPrevisto->CurrentValue = ew_StrToFloat($this->rValorPrevisto->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// pExercicio
		// pTermoNumero
		// pNumero
		// pInicioVigencia
		// pFimVigencia
		// pData
		// pValor
		// pObjeto
		// pMetas
		// pOrigem
		// pEntidadeEdereco
		// pEntidadeEstatuto
		// pEntidadeLei
		// pEntidadeCebas
		// pRespNome
		// pRespCargo
		// pRespEdereco
		// pRespContato
		// pRespAta
		// pContNome
		// pContEndereco
		// pContContato
		// pContDocumento
		// pPrencherNome
		// pPrencherCargo
		// pPrencherEndereco
		// pPrencherContato
		// pPrencherDocumento
		// rIDRepasse
		// rFaixaEtaria
		// rMeta
		// rValorUnitario
		// rValorMensal
		// rValorPrevisto

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pExercicio
		$this->pExercicio->ViewValue = $this->pExercicio->CurrentValue;
		$this->pExercicio->ViewCustomAttributes = "";

		// pTermoNumero
		$this->pTermoNumero->ViewValue = $this->pTermoNumero->CurrentValue;
		$this->pTermoNumero->ViewCustomAttributes = "";

		// pNumero
		$this->pNumero->ViewValue = $this->pNumero->CurrentValue;
		$this->pNumero->ViewCustomAttributes = "";

		// pInicioVigencia
		$this->pInicioVigencia->ViewValue = $this->pInicioVigencia->CurrentValue;
		$this->pInicioVigencia->ViewValue = ew_FormatDateTime($this->pInicioVigencia->ViewValue, 0);
		$this->pInicioVigencia->ViewCustomAttributes = "";

		// pFimVigencia
		$this->pFimVigencia->ViewValue = $this->pFimVigencia->CurrentValue;
		$this->pFimVigencia->ViewValue = ew_FormatDateTime($this->pFimVigencia->ViewValue, 0);
		$this->pFimVigencia->ViewCustomAttributes = "";

		// pData
		$this->pData->ViewValue = $this->pData->CurrentValue;
		$this->pData->ViewValue = ew_FormatDateTime($this->pData->ViewValue, 0);
		$this->pData->ViewCustomAttributes = "";

		// pValor
		$this->pValor->ViewValue = $this->pValor->CurrentValue;
		$this->pValor->ViewCustomAttributes = "";

		// pOrigem
		$this->pOrigem->ViewValue = $this->pOrigem->CurrentValue;
		$this->pOrigem->ViewCustomAttributes = "";

		// pEntidadeEdereco
		$this->pEntidadeEdereco->ViewValue = $this->pEntidadeEdereco->CurrentValue;
		$this->pEntidadeEdereco->ViewCustomAttributes = "";

		// pEntidadeLei
		$this->pEntidadeLei->ViewValue = $this->pEntidadeLei->CurrentValue;
		$this->pEntidadeLei->ViewCustomAttributes = "";

		// pEntidadeCebas
		$this->pEntidadeCebas->ViewValue = $this->pEntidadeCebas->CurrentValue;
		$this->pEntidadeCebas->ViewCustomAttributes = "";

		// pRespNome
		$this->pRespNome->ViewValue = $this->pRespNome->CurrentValue;
		$this->pRespNome->ViewCustomAttributes = "";

		// pRespCargo
		$this->pRespCargo->ViewValue = $this->pRespCargo->CurrentValue;
		$this->pRespCargo->ViewCustomAttributes = "";

		// pRespEdereco
		$this->pRespEdereco->ViewValue = $this->pRespEdereco->CurrentValue;
		$this->pRespEdereco->ViewCustomAttributes = "";

		// pRespContato
		$this->pRespContato->ViewValue = $this->pRespContato->CurrentValue;
		$this->pRespContato->ViewCustomAttributes = "";

		// pRespAta
		$this->pRespAta->ViewValue = $this->pRespAta->CurrentValue;
		$this->pRespAta->ViewCustomAttributes = "";

		// pContNome
		$this->pContNome->ViewValue = $this->pContNome->CurrentValue;
		$this->pContNome->ViewCustomAttributes = "";

		// pContEndereco
		$this->pContEndereco->ViewValue = $this->pContEndereco->CurrentValue;
		$this->pContEndereco->ViewCustomAttributes = "";

		// pContContato
		$this->pContContato->ViewValue = $this->pContContato->CurrentValue;
		$this->pContContato->ViewCustomAttributes = "";

		// pContDocumento
		$this->pContDocumento->ViewValue = $this->pContDocumento->CurrentValue;
		$this->pContDocumento->ViewCustomAttributes = "";

		// pPrencherNome
		$this->pPrencherNome->ViewValue = $this->pPrencherNome->CurrentValue;
		$this->pPrencherNome->ViewCustomAttributes = "";

		// pPrencherCargo
		$this->pPrencherCargo->ViewValue = $this->pPrencherCargo->CurrentValue;
		$this->pPrencherCargo->ViewCustomAttributes = "";

		// pPrencherEndereco
		$this->pPrencherEndereco->ViewValue = $this->pPrencherEndereco->CurrentValue;
		$this->pPrencherEndereco->ViewCustomAttributes = "";

		// pPrencherContato
		$this->pPrencherContato->ViewValue = $this->pPrencherContato->CurrentValue;
		$this->pPrencherContato->ViewCustomAttributes = "";

		// pPrencherDocumento
		$this->pPrencherDocumento->ViewValue = $this->pPrencherDocumento->CurrentValue;
		$this->pPrencherDocumento->ViewCustomAttributes = "";

		// rIDRepasse
		$this->rIDRepasse->ViewValue = $this->rIDRepasse->CurrentValue;
		$this->rIDRepasse->ViewCustomAttributes = "";

		// rFaixaEtaria
		$this->rFaixaEtaria->ViewValue = $this->rFaixaEtaria->CurrentValue;
		$this->rFaixaEtaria->ViewCustomAttributes = "";

		// rMeta
		$this->rMeta->ViewValue = $this->rMeta->CurrentValue;
		$this->rMeta->ViewCustomAttributes = "";

		// rValorUnitario
		$this->rValorUnitario->ViewValue = $this->rValorUnitario->CurrentValue;
		$this->rValorUnitario->ViewCustomAttributes = "";

		// rValorMensal
		$this->rValorMensal->ViewValue = $this->rValorMensal->CurrentValue;
		$this->rValorMensal->ViewCustomAttributes = "";

		// rValorPrevisto
		$this->rValorPrevisto->ViewValue = $this->rValorPrevisto->CurrentValue;
		$this->rValorPrevisto->ViewCustomAttributes = "";

			// pExercicio
			$this->pExercicio->LinkCustomAttributes = "";
			$this->pExercicio->HrefValue = "";
			$this->pExercicio->TooltipValue = "";

			// pTermoNumero
			$this->pTermoNumero->LinkCustomAttributes = "";
			$this->pTermoNumero->HrefValue = "";
			$this->pTermoNumero->TooltipValue = "";

			// pNumero
			$this->pNumero->LinkCustomAttributes = "";
			$this->pNumero->HrefValue = "";
			$this->pNumero->TooltipValue = "";

			// pInicioVigencia
			$this->pInicioVigencia->LinkCustomAttributes = "";
			$this->pInicioVigencia->HrefValue = "";
			$this->pInicioVigencia->TooltipValue = "";

			// pFimVigencia
			$this->pFimVigencia->LinkCustomAttributes = "";
			$this->pFimVigencia->HrefValue = "";
			$this->pFimVigencia->TooltipValue = "";

			// pData
			$this->pData->LinkCustomAttributes = "";
			$this->pData->HrefValue = "";
			$this->pData->TooltipValue = "";

			// pValor
			$this->pValor->LinkCustomAttributes = "";
			$this->pValor->HrefValue = "";
			$this->pValor->TooltipValue = "";

			// pOrigem
			$this->pOrigem->LinkCustomAttributes = "";
			$this->pOrigem->HrefValue = "";
			$this->pOrigem->TooltipValue = "";

			// pEntidadeEdereco
			$this->pEntidadeEdereco->LinkCustomAttributes = "";
			$this->pEntidadeEdereco->HrefValue = "";
			$this->pEntidadeEdereco->TooltipValue = "";

			// pEntidadeLei
			$this->pEntidadeLei->LinkCustomAttributes = "";
			$this->pEntidadeLei->HrefValue = "";
			$this->pEntidadeLei->TooltipValue = "";

			// pEntidadeCebas
			$this->pEntidadeCebas->LinkCustomAttributes = "";
			$this->pEntidadeCebas->HrefValue = "";
			$this->pEntidadeCebas->TooltipValue = "";

			// pRespNome
			$this->pRespNome->LinkCustomAttributes = "";
			$this->pRespNome->HrefValue = "";
			$this->pRespNome->TooltipValue = "";

			// pRespCargo
			$this->pRespCargo->LinkCustomAttributes = "";
			$this->pRespCargo->HrefValue = "";
			$this->pRespCargo->TooltipValue = "";

			// pRespEdereco
			$this->pRespEdereco->LinkCustomAttributes = "";
			$this->pRespEdereco->HrefValue = "";
			$this->pRespEdereco->TooltipValue = "";

			// pRespContato
			$this->pRespContato->LinkCustomAttributes = "";
			$this->pRespContato->HrefValue = "";
			$this->pRespContato->TooltipValue = "";

			// pRespAta
			$this->pRespAta->LinkCustomAttributes = "";
			$this->pRespAta->HrefValue = "";
			$this->pRespAta->TooltipValue = "";

			// pContNome
			$this->pContNome->LinkCustomAttributes = "";
			$this->pContNome->HrefValue = "";
			$this->pContNome->TooltipValue = "";

			// pContEndereco
			$this->pContEndereco->LinkCustomAttributes = "";
			$this->pContEndereco->HrefValue = "";
			$this->pContEndereco->TooltipValue = "";

			// pContContato
			$this->pContContato->LinkCustomAttributes = "";
			$this->pContContato->HrefValue = "";
			$this->pContContato->TooltipValue = "";

			// pContDocumento
			$this->pContDocumento->LinkCustomAttributes = "";
			$this->pContDocumento->HrefValue = "";
			$this->pContDocumento->TooltipValue = "";

			// pPrencherNome
			$this->pPrencherNome->LinkCustomAttributes = "";
			$this->pPrencherNome->HrefValue = "";
			$this->pPrencherNome->TooltipValue = "";

			// pPrencherCargo
			$this->pPrencherCargo->LinkCustomAttributes = "";
			$this->pPrencherCargo->HrefValue = "";
			$this->pPrencherCargo->TooltipValue = "";

			// pPrencherEndereco
			$this->pPrencherEndereco->LinkCustomAttributes = "";
			$this->pPrencherEndereco->HrefValue = "";
			$this->pPrencherEndereco->TooltipValue = "";

			// pPrencherContato
			$this->pPrencherContato->LinkCustomAttributes = "";
			$this->pPrencherContato->HrefValue = "";
			$this->pPrencherContato->TooltipValue = "";

			// pPrencherDocumento
			$this->pPrencherDocumento->LinkCustomAttributes = "";
			$this->pPrencherDocumento->HrefValue = "";
			$this->pPrencherDocumento->TooltipValue = "";

			// rIDRepasse
			$this->rIDRepasse->LinkCustomAttributes = "";
			$this->rIDRepasse->HrefValue = "";
			$this->rIDRepasse->TooltipValue = "";

			// rFaixaEtaria
			$this->rFaixaEtaria->LinkCustomAttributes = "";
			$this->rFaixaEtaria->HrefValue = "";
			$this->rFaixaEtaria->TooltipValue = "";

			// rMeta
			$this->rMeta->LinkCustomAttributes = "";
			$this->rMeta->HrefValue = "";
			$this->rMeta->TooltipValue = "";

			// rValorUnitario
			$this->rValorUnitario->LinkCustomAttributes = "";
			$this->rValorUnitario->HrefValue = "";
			$this->rValorUnitario->TooltipValue = "";

			// rValorMensal
			$this->rValorMensal->LinkCustomAttributes = "";
			$this->rValorMensal->HrefValue = "";
			$this->rValorMensal->TooltipValue = "";

			// rValorPrevisto
			$this->rValorPrevisto->LinkCustomAttributes = "";
			$this->rValorPrevisto->HrefValue = "";
			$this->rValorPrevisto->TooltipValue = "";
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
if (!isset($view_parceira_repase_list)) $view_parceira_repase_list = new cview_parceira_repase_list();

// Page init
$view_parceira_repase_list->Page_Init();

// Page main
$view_parceira_repase_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_parceira_repase_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fview_parceira_repaselist = new ew_Form("fview_parceira_repaselist", "list");
fview_parceira_repaselist.FormKeyCountName = '<?php echo $view_parceira_repase_list->FormKeyCountName ?>';

// Form_CustomValidate event
fview_parceira_repaselist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fview_parceira_repaselist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fview_parceira_repaselistsrch = new ew_Form("fview_parceira_repaselistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($view_parceira_repase_list->TotalRecs > 0 && $view_parceira_repase_list->ExportOptions->Visible()) { ?>
<?php $view_parceira_repase_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($view_parceira_repase_list->SearchOptions->Visible()) { ?>
<?php $view_parceira_repase_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($view_parceira_repase_list->FilterOptions->Visible()) { ?>
<?php $view_parceira_repase_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $view_parceira_repase_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($view_parceira_repase_list->TotalRecs <= 0)
			$view_parceira_repase_list->TotalRecs = $view_parceira_repase->ListRecordCount();
	} else {
		if (!$view_parceira_repase_list->Recordset && ($view_parceira_repase_list->Recordset = $view_parceira_repase_list->LoadRecordset()))
			$view_parceira_repase_list->TotalRecs = $view_parceira_repase_list->Recordset->RecordCount();
	}
	$view_parceira_repase_list->StartRec = 1;
	if ($view_parceira_repase_list->DisplayRecs <= 0 || ($view_parceira_repase->Export <> "" && $view_parceira_repase->ExportAll)) // Display all records
		$view_parceira_repase_list->DisplayRecs = $view_parceira_repase_list->TotalRecs;
	if (!($view_parceira_repase->Export <> "" && $view_parceira_repase->ExportAll))
		$view_parceira_repase_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$view_parceira_repase_list->Recordset = $view_parceira_repase_list->LoadRecordset($view_parceira_repase_list->StartRec-1, $view_parceira_repase_list->DisplayRecs);

	// Set no record found message
	if ($view_parceira_repase->CurrentAction == "" && $view_parceira_repase_list->TotalRecs == 0) {
		if ($view_parceira_repase_list->SearchWhere == "0=101")
			$view_parceira_repase_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$view_parceira_repase_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$view_parceira_repase_list->RenderOtherOptions();
?>
<?php if ($view_parceira_repase->Export == "" && $view_parceira_repase->CurrentAction == "") { ?>
<form name="fview_parceira_repaselistsrch" id="fview_parceira_repaselistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($view_parceira_repase_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fview_parceira_repaselistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_parceira_repase">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($view_parceira_repase_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($view_parceira_repase_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $view_parceira_repase_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($view_parceira_repase_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($view_parceira_repase_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($view_parceira_repase_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($view_parceira_repase_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $view_parceira_repase_list->ShowPageHeader(); ?>
<?php
$view_parceira_repase_list->ShowMessage();
?>
<?php if ($view_parceira_repase_list->TotalRecs > 0 || $view_parceira_repase->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($view_parceira_repase_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> view_parceira_repase">
<div class="box-header ewGridUpperPanel">
<?php if ($view_parceira_repase->CurrentAction <> "gridadd" && $view_parceira_repase->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($view_parceira_repase_list->Pager)) $view_parceira_repase_list->Pager = new cPrevNextPager($view_parceira_repase_list->StartRec, $view_parceira_repase_list->DisplayRecs, $view_parceira_repase_list->TotalRecs, $view_parceira_repase_list->AutoHidePager) ?>
<?php if ($view_parceira_repase_list->Pager->RecordCount > 0 && $view_parceira_repase_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($view_parceira_repase_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_parceira_repase_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_parceira_repase_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($view_parceira_repase_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($view_parceira_repase_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($view_parceira_repase_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($view_parceira_repase_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<form name="fview_parceira_repaselist" id="fview_parceira_repaselist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($view_parceira_repase_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $view_parceira_repase_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_parceira_repase">
<div id="gmp_view_parceira_repase" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($view_parceira_repase_list->TotalRecs > 0 || $view_parceira_repase->CurrentAction == "gridedit") { ?>
<table id="tbl_view_parceira_repaselist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$view_parceira_repase_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$view_parceira_repase_list->RenderListOptions();

// Render list options (header, left)
$view_parceira_repase_list->ListOptions->Render("header", "left");
?>
<?php if ($view_parceira_repase->pExercicio->Visible) { // pExercicio ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pExercicio) == "") { ?>
		<th data-name="pExercicio" class="<?php echo $view_parceira_repase->pExercicio->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pExercicio" class="view_parceira_repase_pExercicio"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pExercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pExercicio" class="<?php echo $view_parceira_repase->pExercicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pExercicio) ?>',1);"><div id="elh_view_parceira_repase_pExercicio" class="view_parceira_repase_pExercicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pExercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pExercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pExercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pTermoNumero->Visible) { // pTermoNumero ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pTermoNumero) == "") { ?>
		<th data-name="pTermoNumero" class="<?php echo $view_parceira_repase->pTermoNumero->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pTermoNumero" class="view_parceira_repase_pTermoNumero"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pTermoNumero->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pTermoNumero" class="<?php echo $view_parceira_repase->pTermoNumero->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pTermoNumero) ?>',1);"><div id="elh_view_parceira_repase_pTermoNumero" class="view_parceira_repase_pTermoNumero">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pTermoNumero->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pTermoNumero->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pTermoNumero->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pNumero->Visible) { // pNumero ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pNumero) == "") { ?>
		<th data-name="pNumero" class="<?php echo $view_parceira_repase->pNumero->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pNumero" class="view_parceira_repase_pNumero"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pNumero->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pNumero" class="<?php echo $view_parceira_repase->pNumero->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pNumero) ?>',1);"><div id="elh_view_parceira_repase_pNumero" class="view_parceira_repase_pNumero">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pNumero->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pNumero->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pNumero->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pInicioVigencia->Visible) { // pInicioVigencia ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pInicioVigencia) == "") { ?>
		<th data-name="pInicioVigencia" class="<?php echo $view_parceira_repase->pInicioVigencia->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pInicioVigencia" class="view_parceira_repase_pInicioVigencia"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pInicioVigencia->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pInicioVigencia" class="<?php echo $view_parceira_repase->pInicioVigencia->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pInicioVigencia) ?>',1);"><div id="elh_view_parceira_repase_pInicioVigencia" class="view_parceira_repase_pInicioVigencia">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pInicioVigencia->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pInicioVigencia->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pInicioVigencia->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pFimVigencia->Visible) { // pFimVigencia ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pFimVigencia) == "") { ?>
		<th data-name="pFimVigencia" class="<?php echo $view_parceira_repase->pFimVigencia->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pFimVigencia" class="view_parceira_repase_pFimVigencia"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pFimVigencia->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pFimVigencia" class="<?php echo $view_parceira_repase->pFimVigencia->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pFimVigencia) ?>',1);"><div id="elh_view_parceira_repase_pFimVigencia" class="view_parceira_repase_pFimVigencia">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pFimVigencia->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pFimVigencia->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pFimVigencia->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pData->Visible) { // pData ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pData) == "") { ?>
		<th data-name="pData" class="<?php echo $view_parceira_repase->pData->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pData" class="view_parceira_repase_pData"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pData->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pData" class="<?php echo $view_parceira_repase->pData->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pData) ?>',1);"><div id="elh_view_parceira_repase_pData" class="view_parceira_repase_pData">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pData->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pData->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pData->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pValor->Visible) { // pValor ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pValor) == "") { ?>
		<th data-name="pValor" class="<?php echo $view_parceira_repase->pValor->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pValor" class="view_parceira_repase_pValor"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pValor->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pValor" class="<?php echo $view_parceira_repase->pValor->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pValor) ?>',1);"><div id="elh_view_parceira_repase_pValor" class="view_parceira_repase_pValor">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pValor->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pValor->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pValor->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pOrigem->Visible) { // pOrigem ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pOrigem) == "") { ?>
		<th data-name="pOrigem" class="<?php echo $view_parceira_repase->pOrigem->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pOrigem" class="view_parceira_repase_pOrigem"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pOrigem->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pOrigem" class="<?php echo $view_parceira_repase->pOrigem->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pOrigem) ?>',1);"><div id="elh_view_parceira_repase_pOrigem" class="view_parceira_repase_pOrigem">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pOrigem->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pOrigem->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pOrigem->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pEntidadeEdereco->Visible) { // pEntidadeEdereco ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeEdereco) == "") { ?>
		<th data-name="pEntidadeEdereco" class="<?php echo $view_parceira_repase->pEntidadeEdereco->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pEntidadeEdereco" class="view_parceira_repase_pEntidadeEdereco"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeEdereco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pEntidadeEdereco" class="<?php echo $view_parceira_repase->pEntidadeEdereco->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeEdereco) ?>',1);"><div id="elh_view_parceira_repase_pEntidadeEdereco" class="view_parceira_repase_pEntidadeEdereco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeEdereco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pEntidadeEdereco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pEntidadeEdereco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pEntidadeLei->Visible) { // pEntidadeLei ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeLei) == "") { ?>
		<th data-name="pEntidadeLei" class="<?php echo $view_parceira_repase->pEntidadeLei->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pEntidadeLei" class="view_parceira_repase_pEntidadeLei"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeLei->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pEntidadeLei" class="<?php echo $view_parceira_repase->pEntidadeLei->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeLei) ?>',1);"><div id="elh_view_parceira_repase_pEntidadeLei" class="view_parceira_repase_pEntidadeLei">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeLei->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pEntidadeLei->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pEntidadeLei->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pEntidadeCebas->Visible) { // pEntidadeCebas ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeCebas) == "") { ?>
		<th data-name="pEntidadeCebas" class="<?php echo $view_parceira_repase->pEntidadeCebas->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pEntidadeCebas" class="view_parceira_repase_pEntidadeCebas"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeCebas->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pEntidadeCebas" class="<?php echo $view_parceira_repase->pEntidadeCebas->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pEntidadeCebas) ?>',1);"><div id="elh_view_parceira_repase_pEntidadeCebas" class="view_parceira_repase_pEntidadeCebas">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pEntidadeCebas->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pEntidadeCebas->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pEntidadeCebas->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pRespNome->Visible) { // pRespNome ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pRespNome) == "") { ?>
		<th data-name="pRespNome" class="<?php echo $view_parceira_repase->pRespNome->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pRespNome" class="view_parceira_repase_pRespNome"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespNome->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pRespNome" class="<?php echo $view_parceira_repase->pRespNome->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pRespNome) ?>',1);"><div id="elh_view_parceira_repase_pRespNome" class="view_parceira_repase_pRespNome">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespNome->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pRespNome->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pRespNome->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pRespCargo->Visible) { // pRespCargo ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pRespCargo) == "") { ?>
		<th data-name="pRespCargo" class="<?php echo $view_parceira_repase->pRespCargo->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pRespCargo" class="view_parceira_repase_pRespCargo"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespCargo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pRespCargo" class="<?php echo $view_parceira_repase->pRespCargo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pRespCargo) ?>',1);"><div id="elh_view_parceira_repase_pRespCargo" class="view_parceira_repase_pRespCargo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespCargo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pRespCargo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pRespCargo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pRespEdereco->Visible) { // pRespEdereco ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pRespEdereco) == "") { ?>
		<th data-name="pRespEdereco" class="<?php echo $view_parceira_repase->pRespEdereco->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pRespEdereco" class="view_parceira_repase_pRespEdereco"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespEdereco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pRespEdereco" class="<?php echo $view_parceira_repase->pRespEdereco->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pRespEdereco) ?>',1);"><div id="elh_view_parceira_repase_pRespEdereco" class="view_parceira_repase_pRespEdereco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespEdereco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pRespEdereco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pRespEdereco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pRespContato->Visible) { // pRespContato ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pRespContato) == "") { ?>
		<th data-name="pRespContato" class="<?php echo $view_parceira_repase->pRespContato->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pRespContato" class="view_parceira_repase_pRespContato"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespContato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pRespContato" class="<?php echo $view_parceira_repase->pRespContato->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pRespContato) ?>',1);"><div id="elh_view_parceira_repase_pRespContato" class="view_parceira_repase_pRespContato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespContato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pRespContato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pRespContato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pRespAta->Visible) { // pRespAta ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pRespAta) == "") { ?>
		<th data-name="pRespAta" class="<?php echo $view_parceira_repase->pRespAta->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pRespAta" class="view_parceira_repase_pRespAta"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespAta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pRespAta" class="<?php echo $view_parceira_repase->pRespAta->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pRespAta) ?>',1);"><div id="elh_view_parceira_repase_pRespAta" class="view_parceira_repase_pRespAta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pRespAta->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pRespAta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pRespAta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pContNome->Visible) { // pContNome ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pContNome) == "") { ?>
		<th data-name="pContNome" class="<?php echo $view_parceira_repase->pContNome->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pContNome" class="view_parceira_repase_pContNome"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContNome->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pContNome" class="<?php echo $view_parceira_repase->pContNome->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pContNome) ?>',1);"><div id="elh_view_parceira_repase_pContNome" class="view_parceira_repase_pContNome">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContNome->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pContNome->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pContNome->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pContEndereco->Visible) { // pContEndereco ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pContEndereco) == "") { ?>
		<th data-name="pContEndereco" class="<?php echo $view_parceira_repase->pContEndereco->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pContEndereco" class="view_parceira_repase_pContEndereco"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContEndereco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pContEndereco" class="<?php echo $view_parceira_repase->pContEndereco->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pContEndereco) ?>',1);"><div id="elh_view_parceira_repase_pContEndereco" class="view_parceira_repase_pContEndereco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContEndereco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pContEndereco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pContEndereco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pContContato->Visible) { // pContContato ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pContContato) == "") { ?>
		<th data-name="pContContato" class="<?php echo $view_parceira_repase->pContContato->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pContContato" class="view_parceira_repase_pContContato"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContContato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pContContato" class="<?php echo $view_parceira_repase->pContContato->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pContContato) ?>',1);"><div id="elh_view_parceira_repase_pContContato" class="view_parceira_repase_pContContato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContContato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pContContato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pContContato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pContDocumento->Visible) { // pContDocumento ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pContDocumento) == "") { ?>
		<th data-name="pContDocumento" class="<?php echo $view_parceira_repase->pContDocumento->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pContDocumento" class="view_parceira_repase_pContDocumento"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContDocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pContDocumento" class="<?php echo $view_parceira_repase->pContDocumento->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pContDocumento) ?>',1);"><div id="elh_view_parceira_repase_pContDocumento" class="view_parceira_repase_pContDocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pContDocumento->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pContDocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pContDocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pPrencherNome->Visible) { // pPrencherNome ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pPrencherNome) == "") { ?>
		<th data-name="pPrencherNome" class="<?php echo $view_parceira_repase->pPrencherNome->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pPrencherNome" class="view_parceira_repase_pPrencherNome"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherNome->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pPrencherNome" class="<?php echo $view_parceira_repase->pPrencherNome->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pPrencherNome) ?>',1);"><div id="elh_view_parceira_repase_pPrencherNome" class="view_parceira_repase_pPrencherNome">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherNome->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pPrencherNome->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pPrencherNome->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pPrencherCargo->Visible) { // pPrencherCargo ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pPrencherCargo) == "") { ?>
		<th data-name="pPrencherCargo" class="<?php echo $view_parceira_repase->pPrencherCargo->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pPrencherCargo" class="view_parceira_repase_pPrencherCargo"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherCargo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pPrencherCargo" class="<?php echo $view_parceira_repase->pPrencherCargo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pPrencherCargo) ?>',1);"><div id="elh_view_parceira_repase_pPrencherCargo" class="view_parceira_repase_pPrencherCargo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherCargo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pPrencherCargo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pPrencherCargo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pPrencherEndereco->Visible) { // pPrencherEndereco ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pPrencherEndereco) == "") { ?>
		<th data-name="pPrencherEndereco" class="<?php echo $view_parceira_repase->pPrencherEndereco->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pPrencherEndereco" class="view_parceira_repase_pPrencherEndereco"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherEndereco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pPrencherEndereco" class="<?php echo $view_parceira_repase->pPrencherEndereco->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pPrencherEndereco) ?>',1);"><div id="elh_view_parceira_repase_pPrencherEndereco" class="view_parceira_repase_pPrencherEndereco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherEndereco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pPrencherEndereco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pPrencherEndereco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pPrencherContato->Visible) { // pPrencherContato ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pPrencherContato) == "") { ?>
		<th data-name="pPrencherContato" class="<?php echo $view_parceira_repase->pPrencherContato->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pPrencherContato" class="view_parceira_repase_pPrencherContato"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherContato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pPrencherContato" class="<?php echo $view_parceira_repase->pPrencherContato->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pPrencherContato) ?>',1);"><div id="elh_view_parceira_repase_pPrencherContato" class="view_parceira_repase_pPrencherContato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherContato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pPrencherContato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pPrencherContato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->pPrencherDocumento->Visible) { // pPrencherDocumento ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->pPrencherDocumento) == "") { ?>
		<th data-name="pPrencherDocumento" class="<?php echo $view_parceira_repase->pPrencherDocumento->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_pPrencherDocumento" class="view_parceira_repase_pPrencherDocumento"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherDocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pPrencherDocumento" class="<?php echo $view_parceira_repase->pPrencherDocumento->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->pPrencherDocumento) ?>',1);"><div id="elh_view_parceira_repase_pPrencherDocumento" class="view_parceira_repase_pPrencherDocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->pPrencherDocumento->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->pPrencherDocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->pPrencherDocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rIDRepasse->Visible) { // rIDRepasse ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rIDRepasse) == "") { ?>
		<th data-name="rIDRepasse" class="<?php echo $view_parceira_repase->rIDRepasse->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rIDRepasse" class="view_parceira_repase_rIDRepasse"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rIDRepasse->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rIDRepasse" class="<?php echo $view_parceira_repase->rIDRepasse->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rIDRepasse) ?>',1);"><div id="elh_view_parceira_repase_rIDRepasse" class="view_parceira_repase_rIDRepasse">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rIDRepasse->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rIDRepasse->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rIDRepasse->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rFaixaEtaria->Visible) { // rFaixaEtaria ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rFaixaEtaria) == "") { ?>
		<th data-name="rFaixaEtaria" class="<?php echo $view_parceira_repase->rFaixaEtaria->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rFaixaEtaria" class="view_parceira_repase_rFaixaEtaria"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rFaixaEtaria->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rFaixaEtaria" class="<?php echo $view_parceira_repase->rFaixaEtaria->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rFaixaEtaria) ?>',1);"><div id="elh_view_parceira_repase_rFaixaEtaria" class="view_parceira_repase_rFaixaEtaria">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rFaixaEtaria->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rFaixaEtaria->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rFaixaEtaria->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rMeta->Visible) { // rMeta ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rMeta) == "") { ?>
		<th data-name="rMeta" class="<?php echo $view_parceira_repase->rMeta->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rMeta" class="view_parceira_repase_rMeta"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rMeta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rMeta" class="<?php echo $view_parceira_repase->rMeta->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rMeta) ?>',1);"><div id="elh_view_parceira_repase_rMeta" class="view_parceira_repase_rMeta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rMeta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rMeta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rMeta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rValorUnitario->Visible) { // rValorUnitario ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rValorUnitario) == "") { ?>
		<th data-name="rValorUnitario" class="<?php echo $view_parceira_repase->rValorUnitario->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rValorUnitario" class="view_parceira_repase_rValorUnitario"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorUnitario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rValorUnitario" class="<?php echo $view_parceira_repase->rValorUnitario->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rValorUnitario) ?>',1);"><div id="elh_view_parceira_repase_rValorUnitario" class="view_parceira_repase_rValorUnitario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorUnitario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rValorUnitario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rValorUnitario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rValorMensal->Visible) { // rValorMensal ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rValorMensal) == "") { ?>
		<th data-name="rValorMensal" class="<?php echo $view_parceira_repase->rValorMensal->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rValorMensal" class="view_parceira_repase_rValorMensal"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorMensal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rValorMensal" class="<?php echo $view_parceira_repase->rValorMensal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rValorMensal) ?>',1);"><div id="elh_view_parceira_repase_rValorMensal" class="view_parceira_repase_rValorMensal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorMensal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rValorMensal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rValorMensal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_parceira_repase->rValorPrevisto->Visible) { // rValorPrevisto ?>
	<?php if ($view_parceira_repase->SortUrl($view_parceira_repase->rValorPrevisto) == "") { ?>
		<th data-name="rValorPrevisto" class="<?php echo $view_parceira_repase->rValorPrevisto->HeaderCellClass() ?>"><div id="elh_view_parceira_repase_rValorPrevisto" class="view_parceira_repase_rValorPrevisto"><div class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorPrevisto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rValorPrevisto" class="<?php echo $view_parceira_repase->rValorPrevisto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $view_parceira_repase->SortUrl($view_parceira_repase->rValorPrevisto) ?>',1);"><div id="elh_view_parceira_repase_rValorPrevisto" class="view_parceira_repase_rValorPrevisto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $view_parceira_repase->rValorPrevisto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($view_parceira_repase->rValorPrevisto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($view_parceira_repase->rValorPrevisto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_parceira_repase_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_parceira_repase->ExportAll && $view_parceira_repase->Export <> "") {
	$view_parceira_repase_list->StopRec = $view_parceira_repase_list->TotalRecs;
} else {

	// Set the last record to display
	if ($view_parceira_repase_list->TotalRecs > $view_parceira_repase_list->StartRec + $view_parceira_repase_list->DisplayRecs - 1)
		$view_parceira_repase_list->StopRec = $view_parceira_repase_list->StartRec + $view_parceira_repase_list->DisplayRecs - 1;
	else
		$view_parceira_repase_list->StopRec = $view_parceira_repase_list->TotalRecs;
}
$view_parceira_repase_list->RecCnt = $view_parceira_repase_list->StartRec - 1;
if ($view_parceira_repase_list->Recordset && !$view_parceira_repase_list->Recordset->EOF) {
	$view_parceira_repase_list->Recordset->MoveFirst();
	$bSelectLimit = $view_parceira_repase_list->UseSelectLimit;
	if (!$bSelectLimit && $view_parceira_repase_list->StartRec > 1)
		$view_parceira_repase_list->Recordset->Move($view_parceira_repase_list->StartRec - 1);
} elseif (!$view_parceira_repase->AllowAddDeleteRow && $view_parceira_repase_list->StopRec == 0) {
	$view_parceira_repase_list->StopRec = $view_parceira_repase->GridAddRowCount;
}

// Initialize aggregate
$view_parceira_repase->RowType = EW_ROWTYPE_AGGREGATEINIT;
$view_parceira_repase->ResetAttrs();
$view_parceira_repase_list->RenderRow();
while ($view_parceira_repase_list->RecCnt < $view_parceira_repase_list->StopRec) {
	$view_parceira_repase_list->RecCnt++;
	if (intval($view_parceira_repase_list->RecCnt) >= intval($view_parceira_repase_list->StartRec)) {
		$view_parceira_repase_list->RowCnt++;

		// Set up key count
		$view_parceira_repase_list->KeyCount = $view_parceira_repase_list->RowIndex;

		// Init row class and style
		$view_parceira_repase->ResetAttrs();
		$view_parceira_repase->CssClass = "";
		if ($view_parceira_repase->CurrentAction == "gridadd") {
		} else {
			$view_parceira_repase_list->LoadRowValues($view_parceira_repase_list->Recordset); // Load row values
		}
		$view_parceira_repase->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_parceira_repase->RowAttrs = array_merge($view_parceira_repase->RowAttrs, array('data-rowindex'=>$view_parceira_repase_list->RowCnt, 'id'=>'r' . $view_parceira_repase_list->RowCnt . '_view_parceira_repase', 'data-rowtype'=>$view_parceira_repase->RowType));

		// Render row
		$view_parceira_repase_list->RenderRow();

		// Render list options
		$view_parceira_repase_list->RenderListOptions();
?>
	<tr<?php echo $view_parceira_repase->RowAttributes() ?>>
<?php

// Render list options (body, left)
$view_parceira_repase_list->ListOptions->Render("body", "left", $view_parceira_repase_list->RowCnt);
?>
	<?php if ($view_parceira_repase->pExercicio->Visible) { // pExercicio ?>
		<td data-name="pExercicio"<?php echo $view_parceira_repase->pExercicio->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pExercicio" class="view_parceira_repase_pExercicio">
<span<?php echo $view_parceira_repase->pExercicio->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pExercicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pTermoNumero->Visible) { // pTermoNumero ?>
		<td data-name="pTermoNumero"<?php echo $view_parceira_repase->pTermoNumero->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pTermoNumero" class="view_parceira_repase_pTermoNumero">
<span<?php echo $view_parceira_repase->pTermoNumero->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pTermoNumero->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pNumero->Visible) { // pNumero ?>
		<td data-name="pNumero"<?php echo $view_parceira_repase->pNumero->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pNumero" class="view_parceira_repase_pNumero">
<span<?php echo $view_parceira_repase->pNumero->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pNumero->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pInicioVigencia->Visible) { // pInicioVigencia ?>
		<td data-name="pInicioVigencia"<?php echo $view_parceira_repase->pInicioVigencia->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pInicioVigencia" class="view_parceira_repase_pInicioVigencia">
<span<?php echo $view_parceira_repase->pInicioVigencia->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pInicioVigencia->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pFimVigencia->Visible) { // pFimVigencia ?>
		<td data-name="pFimVigencia"<?php echo $view_parceira_repase->pFimVigencia->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pFimVigencia" class="view_parceira_repase_pFimVigencia">
<span<?php echo $view_parceira_repase->pFimVigencia->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pFimVigencia->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pData->Visible) { // pData ?>
		<td data-name="pData"<?php echo $view_parceira_repase->pData->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pData" class="view_parceira_repase_pData">
<span<?php echo $view_parceira_repase->pData->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pData->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pValor->Visible) { // pValor ?>
		<td data-name="pValor"<?php echo $view_parceira_repase->pValor->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pValor" class="view_parceira_repase_pValor">
<span<?php echo $view_parceira_repase->pValor->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pValor->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pOrigem->Visible) { // pOrigem ?>
		<td data-name="pOrigem"<?php echo $view_parceira_repase->pOrigem->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pOrigem" class="view_parceira_repase_pOrigem">
<span<?php echo $view_parceira_repase->pOrigem->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pOrigem->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pEntidadeEdereco->Visible) { // pEntidadeEdereco ?>
		<td data-name="pEntidadeEdereco"<?php echo $view_parceira_repase->pEntidadeEdereco->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pEntidadeEdereco" class="view_parceira_repase_pEntidadeEdereco">
<span<?php echo $view_parceira_repase->pEntidadeEdereco->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pEntidadeEdereco->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pEntidadeLei->Visible) { // pEntidadeLei ?>
		<td data-name="pEntidadeLei"<?php echo $view_parceira_repase->pEntidadeLei->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pEntidadeLei" class="view_parceira_repase_pEntidadeLei">
<span<?php echo $view_parceira_repase->pEntidadeLei->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pEntidadeLei->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pEntidadeCebas->Visible) { // pEntidadeCebas ?>
		<td data-name="pEntidadeCebas"<?php echo $view_parceira_repase->pEntidadeCebas->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pEntidadeCebas" class="view_parceira_repase_pEntidadeCebas">
<span<?php echo $view_parceira_repase->pEntidadeCebas->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pEntidadeCebas->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pRespNome->Visible) { // pRespNome ?>
		<td data-name="pRespNome"<?php echo $view_parceira_repase->pRespNome->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pRespNome" class="view_parceira_repase_pRespNome">
<span<?php echo $view_parceira_repase->pRespNome->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pRespNome->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pRespCargo->Visible) { // pRespCargo ?>
		<td data-name="pRespCargo"<?php echo $view_parceira_repase->pRespCargo->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pRespCargo" class="view_parceira_repase_pRespCargo">
<span<?php echo $view_parceira_repase->pRespCargo->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pRespCargo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pRespEdereco->Visible) { // pRespEdereco ?>
		<td data-name="pRespEdereco"<?php echo $view_parceira_repase->pRespEdereco->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pRespEdereco" class="view_parceira_repase_pRespEdereco">
<span<?php echo $view_parceira_repase->pRespEdereco->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pRespEdereco->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pRespContato->Visible) { // pRespContato ?>
		<td data-name="pRespContato"<?php echo $view_parceira_repase->pRespContato->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pRespContato" class="view_parceira_repase_pRespContato">
<span<?php echo $view_parceira_repase->pRespContato->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pRespContato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pRespAta->Visible) { // pRespAta ?>
		<td data-name="pRespAta"<?php echo $view_parceira_repase->pRespAta->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pRespAta" class="view_parceira_repase_pRespAta">
<span<?php echo $view_parceira_repase->pRespAta->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pRespAta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pContNome->Visible) { // pContNome ?>
		<td data-name="pContNome"<?php echo $view_parceira_repase->pContNome->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pContNome" class="view_parceira_repase_pContNome">
<span<?php echo $view_parceira_repase->pContNome->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pContNome->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pContEndereco->Visible) { // pContEndereco ?>
		<td data-name="pContEndereco"<?php echo $view_parceira_repase->pContEndereco->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pContEndereco" class="view_parceira_repase_pContEndereco">
<span<?php echo $view_parceira_repase->pContEndereco->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pContEndereco->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pContContato->Visible) { // pContContato ?>
		<td data-name="pContContato"<?php echo $view_parceira_repase->pContContato->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pContContato" class="view_parceira_repase_pContContato">
<span<?php echo $view_parceira_repase->pContContato->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pContContato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pContDocumento->Visible) { // pContDocumento ?>
		<td data-name="pContDocumento"<?php echo $view_parceira_repase->pContDocumento->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pContDocumento" class="view_parceira_repase_pContDocumento">
<span<?php echo $view_parceira_repase->pContDocumento->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pContDocumento->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pPrencherNome->Visible) { // pPrencherNome ?>
		<td data-name="pPrencherNome"<?php echo $view_parceira_repase->pPrencherNome->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pPrencherNome" class="view_parceira_repase_pPrencherNome">
<span<?php echo $view_parceira_repase->pPrencherNome->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pPrencherNome->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pPrencherCargo->Visible) { // pPrencherCargo ?>
		<td data-name="pPrencherCargo"<?php echo $view_parceira_repase->pPrencherCargo->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pPrencherCargo" class="view_parceira_repase_pPrencherCargo">
<span<?php echo $view_parceira_repase->pPrencherCargo->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pPrencherCargo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pPrencherEndereco->Visible) { // pPrencherEndereco ?>
		<td data-name="pPrencherEndereco"<?php echo $view_parceira_repase->pPrencherEndereco->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pPrencherEndereco" class="view_parceira_repase_pPrencherEndereco">
<span<?php echo $view_parceira_repase->pPrencherEndereco->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pPrencherEndereco->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pPrencherContato->Visible) { // pPrencherContato ?>
		<td data-name="pPrencherContato"<?php echo $view_parceira_repase->pPrencherContato->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pPrencherContato" class="view_parceira_repase_pPrencherContato">
<span<?php echo $view_parceira_repase->pPrencherContato->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pPrencherContato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->pPrencherDocumento->Visible) { // pPrencherDocumento ?>
		<td data-name="pPrencherDocumento"<?php echo $view_parceira_repase->pPrencherDocumento->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_pPrencherDocumento" class="view_parceira_repase_pPrencherDocumento">
<span<?php echo $view_parceira_repase->pPrencherDocumento->ViewAttributes() ?>>
<?php echo $view_parceira_repase->pPrencherDocumento->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rIDRepasse->Visible) { // rIDRepasse ?>
		<td data-name="rIDRepasse"<?php echo $view_parceira_repase->rIDRepasse->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rIDRepasse" class="view_parceira_repase_rIDRepasse">
<span<?php echo $view_parceira_repase->rIDRepasse->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rIDRepasse->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rFaixaEtaria->Visible) { // rFaixaEtaria ?>
		<td data-name="rFaixaEtaria"<?php echo $view_parceira_repase->rFaixaEtaria->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rFaixaEtaria" class="view_parceira_repase_rFaixaEtaria">
<span<?php echo $view_parceira_repase->rFaixaEtaria->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rFaixaEtaria->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rMeta->Visible) { // rMeta ?>
		<td data-name="rMeta"<?php echo $view_parceira_repase->rMeta->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rMeta" class="view_parceira_repase_rMeta">
<span<?php echo $view_parceira_repase->rMeta->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rMeta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rValorUnitario->Visible) { // rValorUnitario ?>
		<td data-name="rValorUnitario"<?php echo $view_parceira_repase->rValorUnitario->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rValorUnitario" class="view_parceira_repase_rValorUnitario">
<span<?php echo $view_parceira_repase->rValorUnitario->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rValorUnitario->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rValorMensal->Visible) { // rValorMensal ?>
		<td data-name="rValorMensal"<?php echo $view_parceira_repase->rValorMensal->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rValorMensal" class="view_parceira_repase_rValorMensal">
<span<?php echo $view_parceira_repase->rValorMensal->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rValorMensal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_parceira_repase->rValorPrevisto->Visible) { // rValorPrevisto ?>
		<td data-name="rValorPrevisto"<?php echo $view_parceira_repase->rValorPrevisto->CellAttributes() ?>>
<span id="el<?php echo $view_parceira_repase_list->RowCnt ?>_view_parceira_repase_rValorPrevisto" class="view_parceira_repase_rValorPrevisto">
<span<?php echo $view_parceira_repase->rValorPrevisto->ViewAttributes() ?>>
<?php echo $view_parceira_repase->rValorPrevisto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_parceira_repase_list->ListOptions->Render("body", "right", $view_parceira_repase_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($view_parceira_repase->CurrentAction <> "gridadd")
		$view_parceira_repase_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($view_parceira_repase->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($view_parceira_repase_list->Recordset)
	$view_parceira_repase_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($view_parceira_repase->CurrentAction <> "gridadd" && $view_parceira_repase->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($view_parceira_repase_list->Pager)) $view_parceira_repase_list->Pager = new cPrevNextPager($view_parceira_repase_list->StartRec, $view_parceira_repase_list->DisplayRecs, $view_parceira_repase_list->TotalRecs, $view_parceira_repase_list->AutoHidePager) ?>
<?php if ($view_parceira_repase_list->Pager->RecordCount > 0 && $view_parceira_repase_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($view_parceira_repase_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($view_parceira_repase_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $view_parceira_repase_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($view_parceira_repase_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($view_parceira_repase_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $view_parceira_repase_list->PageUrl() ?>start=<?php echo $view_parceira_repase_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($view_parceira_repase_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $view_parceira_repase_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($view_parceira_repase_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($view_parceira_repase_list->TotalRecs == 0 && $view_parceira_repase->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($view_parceira_repase_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
fview_parceira_repaselistsrch.FilterList = <?php echo $view_parceira_repase_list->GetFilterList() ?>;
fview_parceira_repaselistsrch.Init();
fview_parceira_repaselist.Init();
</script>
<?php
$view_parceira_repase_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$view_parceira_repase_list->Page_Terminate();
?>
