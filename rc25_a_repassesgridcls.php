<?php include_once "rc25_a_repassesinfo.php" ?>
<?php

//
// Page class
//

$rc25_a_repasses_grid = NULL; // Initialize page object first

class crc25_a_repasses_grid extends crc25_a_repasses {

	// Page ID
	var $PageID = 'gridcls';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_repasses';

	// Page object name
	var $PageObjName = 'rc25_a_repasses_grid';

	// Grid form hidden field names
	var $FormName = 'frc25_a_repassesgrid';
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
		$this->FormActionName .= '_' . $this->FormName;
		$this->FormKeyName .= '_' . $this->FormName;
		$this->FormOldKeyName .= '_' . $this->FormName;
		$this->FormBlankRowName .= '_' . $this->FormName;
		$this->FormKeyCountName .= '_' . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (rc25_a_repasses)
		if (!isset($GLOBALS["rc25_a_repasses"]) || get_class($GLOBALS["rc25_a_repasses"]) == "crc25_a_repasses") {
			$GLOBALS["rc25_a_repasses"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["rc25_a_repasses"];

		}
		$this->AddUrl = "rc25_a_repassesadd.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'gridcls', TRUE);

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

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

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

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url == "")
			return;
		$this->Page_Redirecting($url);

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
	var $ShowOtherOptions = FALSE;
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

			// Handle reset command
			$this->ResetCmd();

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
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
	}

	// Exit inline mode
	function ClearInlineMode() {
		$this->repasse_valor_unitario->FormValue = ""; // Clear form value
		$this->repasse_valor_mes->FormValue = ""; // Clear form value
		$this->repasse_valor_previsto->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
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

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue($this->FormOldKeyName));
				$this->LoadOldRecord(); // Load old record
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->repasse_id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_repasse_id_termos") && $objForm->HasValue("o_repasse_id_termos") && $this->repasse_id_termos->CurrentValue <> $this->repasse_id_termos->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_repasse_faixa_etaria") && $objForm->HasValue("o_repasse_faixa_etaria") && $this->repasse_faixa_etaria->CurrentValue <> $this->repasse_faixa_etaria->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_repasse_meta") && $objForm->HasValue("o_repasse_meta") && $this->repasse_meta->CurrentValue <> $this->repasse_meta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_repasse_valor_unitario") && $objForm->HasValue("o_repasse_valor_unitario") && $this->repasse_valor_unitario->CurrentValue <> $this->repasse_valor_unitario->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_repasse_valor_mes") && $objForm->HasValue("o_repasse_valor_mes") && $this->repasse_valor_mes->CurrentValue <> $this->repasse_valor_mes->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_repasse_valor_previsto") && $objForm->HasValue("o_repasse_valor_previsto") && $this->repasse_valor_previsto->CurrentValue <> $this->repasse_valor_previsto->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
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
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($objForm->GetValue($this->FormOldKeyName));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $OldKeyName . "\" id=\"" . $OldKeyName . "\" value=\"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
			}
		}
		if ($this->CurrentMode == "view") { // View mode

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
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->repasse_id->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('repasse_id');
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$option = &$this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;
		$option->ButtonClass = "btn-sm"; // Class for button group
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->Add("add");
			$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
			$this->AddUrl = $this->GetAddUrl();
			$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
			$item->Visible = ($this->AddUrl <> "");
		}
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && $this->CurrentAction != "F") { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = &$options["addedit"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
				$item = &$option->Add("addblankrow");
				$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
				$item->Visible = TRUE;
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = &$options["addedit"];
			$item = &$option->GetItem("add");
			$this->ShowOtherOptions = $item && $item->Visible;
		}
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->repasse_id->CurrentValue = NULL;
		$this->repasse_id->OldValue = $this->repasse_id->CurrentValue;
		$this->repasse_id_termos->CurrentValue = NULL;
		$this->repasse_id_termos->OldValue = $this->repasse_id_termos->CurrentValue;
		$this->repasse_faixa_etaria->CurrentValue = NULL;
		$this->repasse_faixa_etaria->OldValue = $this->repasse_faixa_etaria->CurrentValue;
		$this->repasse_meta->CurrentValue = NULL;
		$this->repasse_meta->OldValue = $this->repasse_meta->CurrentValue;
		$this->repasse_valor_unitario->CurrentValue = NULL;
		$this->repasse_valor_unitario->OldValue = $this->repasse_valor_unitario->CurrentValue;
		$this->repasse_valor_mes->CurrentValue = NULL;
		$this->repasse_valor_mes->OldValue = $this->repasse_valor_mes->CurrentValue;
		$this->repasse_valor_previsto->CurrentValue = NULL;
		$this->repasse_valor_previsto->OldValue = $this->repasse_valor_previsto->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->repasse_id_termos->FldIsDetailKey) {
			$this->repasse_id_termos->setFormValue($objForm->GetValue("x_repasse_id_termos"));
		}
		$this->repasse_id_termos->setOldValue($objForm->GetValue("o_repasse_id_termos"));
		if (!$this->repasse_faixa_etaria->FldIsDetailKey) {
			$this->repasse_faixa_etaria->setFormValue($objForm->GetValue("x_repasse_faixa_etaria"));
		}
		$this->repasse_faixa_etaria->setOldValue($objForm->GetValue("o_repasse_faixa_etaria"));
		if (!$this->repasse_meta->FldIsDetailKey) {
			$this->repasse_meta->setFormValue($objForm->GetValue("x_repasse_meta"));
		}
		$this->repasse_meta->setOldValue($objForm->GetValue("o_repasse_meta"));
		if (!$this->repasse_valor_unitario->FldIsDetailKey) {
			$this->repasse_valor_unitario->setFormValue($objForm->GetValue("x_repasse_valor_unitario"));
		}
		$this->repasse_valor_unitario->setOldValue($objForm->GetValue("o_repasse_valor_unitario"));
		if (!$this->repasse_valor_mes->FldIsDetailKey) {
			$this->repasse_valor_mes->setFormValue($objForm->GetValue("x_repasse_valor_mes"));
		}
		$this->repasse_valor_mes->setOldValue($objForm->GetValue("o_repasse_valor_mes"));
		if (!$this->repasse_valor_previsto->FldIsDetailKey) {
			$this->repasse_valor_previsto->setFormValue($objForm->GetValue("x_repasse_valor_previsto"));
		}
		$this->repasse_valor_previsto->setOldValue($objForm->GetValue("o_repasse_valor_previsto"));
		if (!$this->repasse_id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->repasse_id->setFormValue($objForm->GetValue("x_repasse_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->repasse_id->CurrentValue = $this->repasse_id->FormValue;
		$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->FormValue;
		$this->repasse_faixa_etaria->CurrentValue = $this->repasse_faixa_etaria->FormValue;
		$this->repasse_meta->CurrentValue = $this->repasse_meta->FormValue;
		$this->repasse_valor_unitario->CurrentValue = $this->repasse_valor_unitario->FormValue;
		$this->repasse_valor_mes->CurrentValue = $this->repasse_valor_mes->FormValue;
		$this->repasse_valor_previsto->CurrentValue = $this->repasse_valor_previsto->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['repasse_id'] = $this->repasse_id->CurrentValue;
		$row['repasse_id_termos'] = $this->repasse_id_termos->CurrentValue;
		$row['repasse_faixa_etaria'] = $this->repasse_faixa_etaria->CurrentValue;
		$row['repasse_meta'] = $this->repasse_meta->CurrentValue;
		$row['repasse_valor_unitario'] = $this->repasse_valor_unitario->CurrentValue;
		$row['repasse_valor_mes'] = $this->repasse_valor_mes->CurrentValue;
		$row['repasse_valor_previsto'] = $this->repasse_valor_previsto->CurrentValue;
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
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->repasse_id->CurrentValue = strval($arKeys[0]); // repasse_id
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

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
		$this->CopyUrl = $this->GetCopyUrl();
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// repasse_id_termos
			$this->repasse_id_termos->EditAttrs["class"] = "form-control";
			$this->repasse_id_termos->EditCustomAttributes = "";
			if ($this->repasse_id_termos->getSessionValue() <> "") {
				$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->getSessionValue();
				$this->repasse_id_termos->OldValue = $this->repasse_id_termos->CurrentValue;
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
			} else {
			if (trim(strval($this->repasse_id_termos->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`processo_id`" . ew_SearchString("=", $this->repasse_id_termos->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `processo_id`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_termos`";
			$sWhereWrk = "";
			$this->repasse_id_termos->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->repasse_id_termos->EditValue = $arwrk;
			}

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->EditAttrs["class"] = "form-control";
			$this->repasse_faixa_etaria->EditCustomAttributes = "";
			$this->repasse_faixa_etaria->EditValue = ew_HtmlEncode($this->repasse_faixa_etaria->CurrentValue);
			$this->repasse_faixa_etaria->PlaceHolder = ew_RemoveHtml($this->repasse_faixa_etaria->FldCaption());

			// repasse_meta
			$this->repasse_meta->EditAttrs["class"] = "form-control";
			$this->repasse_meta->EditCustomAttributes = "";
			$this->repasse_meta->EditValue = ew_HtmlEncode($this->repasse_meta->CurrentValue);
			$this->repasse_meta->PlaceHolder = ew_RemoveHtml($this->repasse_meta->FldCaption());

			// repasse_valor_unitario
			$this->repasse_valor_unitario->EditAttrs["class"] = "form-control";
			$this->repasse_valor_unitario->EditCustomAttributes = "";
			$this->repasse_valor_unitario->EditValue = ew_HtmlEncode($this->repasse_valor_unitario->CurrentValue);
			$this->repasse_valor_unitario->PlaceHolder = ew_RemoveHtml($this->repasse_valor_unitario->FldCaption());
			if (strval($this->repasse_valor_unitario->EditValue) <> "" && is_numeric($this->repasse_valor_unitario->EditValue)) {
			$this->repasse_valor_unitario->EditValue = ew_FormatNumber($this->repasse_valor_unitario->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_unitario->OldValue = $this->repasse_valor_unitario->EditValue;
			}

			// repasse_valor_mes
			$this->repasse_valor_mes->EditAttrs["class"] = "form-control";
			$this->repasse_valor_mes->EditCustomAttributes = "";
			$this->repasse_valor_mes->EditValue = ew_HtmlEncode($this->repasse_valor_mes->CurrentValue);
			$this->repasse_valor_mes->PlaceHolder = ew_RemoveHtml($this->repasse_valor_mes->FldCaption());
			if (strval($this->repasse_valor_mes->EditValue) <> "" && is_numeric($this->repasse_valor_mes->EditValue)) {
			$this->repasse_valor_mes->EditValue = ew_FormatNumber($this->repasse_valor_mes->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_mes->OldValue = $this->repasse_valor_mes->EditValue;
			}

			// repasse_valor_previsto
			$this->repasse_valor_previsto->EditAttrs["class"] = "form-control";
			$this->repasse_valor_previsto->EditCustomAttributes = "";
			$this->repasse_valor_previsto->EditValue = ew_HtmlEncode($this->repasse_valor_previsto->CurrentValue);
			$this->repasse_valor_previsto->PlaceHolder = ew_RemoveHtml($this->repasse_valor_previsto->FldCaption());
			if (strval($this->repasse_valor_previsto->EditValue) <> "" && is_numeric($this->repasse_valor_previsto->EditValue)) {
			$this->repasse_valor_previsto->EditValue = ew_FormatNumber($this->repasse_valor_previsto->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_previsto->OldValue = $this->repasse_valor_previsto->EditValue;
			}

			// Add refer script
			// repasse_id_termos

			$this->repasse_id_termos->LinkCustomAttributes = "";
			$this->repasse_id_termos->HrefValue = "";

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->LinkCustomAttributes = "";
			$this->repasse_faixa_etaria->HrefValue = "";

			// repasse_meta
			$this->repasse_meta->LinkCustomAttributes = "";
			$this->repasse_meta->HrefValue = "";

			// repasse_valor_unitario
			$this->repasse_valor_unitario->LinkCustomAttributes = "";
			$this->repasse_valor_unitario->HrefValue = "";

			// repasse_valor_mes
			$this->repasse_valor_mes->LinkCustomAttributes = "";
			$this->repasse_valor_mes->HrefValue = "";

			// repasse_valor_previsto
			$this->repasse_valor_previsto->LinkCustomAttributes = "";
			$this->repasse_valor_previsto->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// repasse_id_termos
			$this->repasse_id_termos->EditAttrs["class"] = "form-control";
			$this->repasse_id_termos->EditCustomAttributes = "";
			if ($this->repasse_id_termos->getSessionValue() <> "") {
				$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->getSessionValue();
				$this->repasse_id_termos->OldValue = $this->repasse_id_termos->CurrentValue;
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
			} else {
			if (trim(strval($this->repasse_id_termos->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`processo_id`" . ew_SearchString("=", $this->repasse_id_termos->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `processo_id`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `rc25_a_termos`";
			$sWhereWrk = "";
			$this->repasse_id_termos->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->repasse_id_termos->EditValue = $arwrk;
			}

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->EditAttrs["class"] = "form-control";
			$this->repasse_faixa_etaria->EditCustomAttributes = "";
			$this->repasse_faixa_etaria->EditValue = ew_HtmlEncode($this->repasse_faixa_etaria->CurrentValue);
			$this->repasse_faixa_etaria->PlaceHolder = ew_RemoveHtml($this->repasse_faixa_etaria->FldCaption());

			// repasse_meta
			$this->repasse_meta->EditAttrs["class"] = "form-control";
			$this->repasse_meta->EditCustomAttributes = "";
			$this->repasse_meta->EditValue = ew_HtmlEncode($this->repasse_meta->CurrentValue);
			$this->repasse_meta->PlaceHolder = ew_RemoveHtml($this->repasse_meta->FldCaption());

			// repasse_valor_unitario
			$this->repasse_valor_unitario->EditAttrs["class"] = "form-control";
			$this->repasse_valor_unitario->EditCustomAttributes = "";
			$this->repasse_valor_unitario->EditValue = ew_HtmlEncode($this->repasse_valor_unitario->CurrentValue);
			$this->repasse_valor_unitario->PlaceHolder = ew_RemoveHtml($this->repasse_valor_unitario->FldCaption());
			if (strval($this->repasse_valor_unitario->EditValue) <> "" && is_numeric($this->repasse_valor_unitario->EditValue)) {
			$this->repasse_valor_unitario->EditValue = ew_FormatNumber($this->repasse_valor_unitario->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_unitario->OldValue = $this->repasse_valor_unitario->EditValue;
			}

			// repasse_valor_mes
			$this->repasse_valor_mes->EditAttrs["class"] = "form-control";
			$this->repasse_valor_mes->EditCustomAttributes = "";
			$this->repasse_valor_mes->EditValue = ew_HtmlEncode($this->repasse_valor_mes->CurrentValue);
			$this->repasse_valor_mes->PlaceHolder = ew_RemoveHtml($this->repasse_valor_mes->FldCaption());
			if (strval($this->repasse_valor_mes->EditValue) <> "" && is_numeric($this->repasse_valor_mes->EditValue)) {
			$this->repasse_valor_mes->EditValue = ew_FormatNumber($this->repasse_valor_mes->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_mes->OldValue = $this->repasse_valor_mes->EditValue;
			}

			// repasse_valor_previsto
			$this->repasse_valor_previsto->EditAttrs["class"] = "form-control";
			$this->repasse_valor_previsto->EditCustomAttributes = "";
			$this->repasse_valor_previsto->EditValue = ew_HtmlEncode($this->repasse_valor_previsto->CurrentValue);
			$this->repasse_valor_previsto->PlaceHolder = ew_RemoveHtml($this->repasse_valor_previsto->FldCaption());
			if (strval($this->repasse_valor_previsto->EditValue) <> "" && is_numeric($this->repasse_valor_previsto->EditValue)) {
			$this->repasse_valor_previsto->EditValue = ew_FormatNumber($this->repasse_valor_previsto->EditValue, -2, -2, -2, -2);
			$this->repasse_valor_previsto->OldValue = $this->repasse_valor_previsto->EditValue;
			}

			// Edit refer script
			// repasse_id_termos

			$this->repasse_id_termos->LinkCustomAttributes = "";
			$this->repasse_id_termos->HrefValue = "";

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->LinkCustomAttributes = "";
			$this->repasse_faixa_etaria->HrefValue = "";

			// repasse_meta
			$this->repasse_meta->LinkCustomAttributes = "";
			$this->repasse_meta->HrefValue = "";

			// repasse_valor_unitario
			$this->repasse_valor_unitario->LinkCustomAttributes = "";
			$this->repasse_valor_unitario->HrefValue = "";

			// repasse_valor_mes
			$this->repasse_valor_mes->LinkCustomAttributes = "";
			$this->repasse_valor_mes->HrefValue = "";

			// repasse_valor_previsto
			$this->repasse_valor_previsto->LinkCustomAttributes = "";
			$this->repasse_valor_previsto->HrefValue = "";
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

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->repasse_faixa_etaria->FldIsDetailKey && !is_null($this->repasse_faixa_etaria->FormValue) && $this->repasse_faixa_etaria->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->repasse_faixa_etaria->FldCaption(), $this->repasse_faixa_etaria->ReqErrMsg));
		}
		if (!$this->repasse_meta->FldIsDetailKey && !is_null($this->repasse_meta->FormValue) && $this->repasse_meta->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->repasse_meta->FldCaption(), $this->repasse_meta->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->repasse_meta->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_meta->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_unitario->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_unitario->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_mes->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_mes->FldErrMsg());
		}
		if (!ew_CheckNumber($this->repasse_valor_previsto->FormValue)) {
			ew_AddMessage($gsFormError, $this->repasse_valor_previsto->FldErrMsg());
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

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['repasse_id'];

				// Delete old files
				$this->LoadDbValues($row);
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

			// repasse_id_termos
			$this->repasse_id_termos->SetDbValueDef($rsnew, $this->repasse_id_termos->CurrentValue, NULL, $this->repasse_id_termos->ReadOnly);

			// repasse_faixa_etaria
			$this->repasse_faixa_etaria->SetDbValueDef($rsnew, $this->repasse_faixa_etaria->CurrentValue, NULL, $this->repasse_faixa_etaria->ReadOnly);

			// repasse_meta
			$this->repasse_meta->SetDbValueDef($rsnew, $this->repasse_meta->CurrentValue, NULL, $this->repasse_meta->ReadOnly);

			// repasse_valor_unitario
			$this->repasse_valor_unitario->SetDbValueDef($rsnew, $this->repasse_valor_unitario->CurrentValue, NULL, $this->repasse_valor_unitario->ReadOnly);

			// repasse_valor_mes
			$this->repasse_valor_mes->SetDbValueDef($rsnew, $this->repasse_valor_mes->CurrentValue, NULL, $this->repasse_valor_mes->ReadOnly);

			// repasse_valor_previsto
			$this->repasse_valor_previsto->SetDbValueDef($rsnew, $this->repasse_valor_previsto->CurrentValue, NULL, $this->repasse_valor_previsto->ReadOnly);

			// Check referential integrity for master table 'rc25_a_termos'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_rc25_a_termos();
			$KeyValue = isset($rsnew['repasse_id_termos']) ? $rsnew['repasse_id_termos'] : $rsold['repasse_id_termos'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@processo_id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["rc25_a_termos"])) $GLOBALS["rc25_a_termos"] = new crc25_a_termos();
				$rsmaster = $GLOBALS["rc25_a_termos"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "rc25_a_termos", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "rc25_a_termos") {
				$this->repasse_id_termos->CurrentValue = $this->repasse_id_termos->getSessionValue();
			}

		// Check referential integrity for master table 'rc25_a_termos'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_rc25_a_termos();
		if (strval($this->repasse_id_termos->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@processo_id@", ew_AdjustSql($this->repasse_id_termos->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["rc25_a_termos"])) $GLOBALS["rc25_a_termos"] = new crc25_a_termos();
			$rsmaster = $GLOBALS["rc25_a_termos"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "rc25_a_termos", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// repasse_id_termos
		$this->repasse_id_termos->SetDbValueDef($rsnew, $this->repasse_id_termos->CurrentValue, NULL, FALSE);

		// repasse_faixa_etaria
		$this->repasse_faixa_etaria->SetDbValueDef($rsnew, $this->repasse_faixa_etaria->CurrentValue, NULL, FALSE);

		// repasse_meta
		$this->repasse_meta->SetDbValueDef($rsnew, $this->repasse_meta->CurrentValue, NULL, FALSE);

		// repasse_valor_unitario
		$this->repasse_valor_unitario->SetDbValueDef($rsnew, $this->repasse_valor_unitario->CurrentValue, NULL, FALSE);

		// repasse_valor_mes
		$this->repasse_valor_mes->SetDbValueDef($rsnew, $this->repasse_valor_mes->CurrentValue, NULL, FALSE);

		// repasse_valor_previsto
		$this->repasse_valor_previsto->SetDbValueDef($rsnew, $this->repasse_valor_previsto->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetupMasterParms() {

		// Hide foreign keys
		$sMasterTblVar = $this->getCurrentMasterTable();
		if ($sMasterTblVar == "rc25_a_termos") {
			$this->repasse_id_termos->Visible = FALSE;
			if ($GLOBALS["rc25_a_termos"]->EventCancelled) $this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_repasse_id_termos":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `processo_id` AS `LinkFld`, `processo_termo_num` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_termos`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`processo_id` IN ({filter_value})', "t0" => "21", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->repasse_id_termos, $sWhereWrk); // Call Lookup Selecting
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