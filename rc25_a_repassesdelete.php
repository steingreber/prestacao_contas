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

$rc25_a_repasses_delete = NULL; // Initialize page object first

class crc25_a_repasses_delete extends crc25_a_repasses {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_repasses';

	// Page object name
	var $PageObjName = 'rc25_a_repasses_delete';

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

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS['rc25_a_termos'])) $GLOBALS['rc25_a_termos'] = new crc25_a_termos();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("rc25_a_repasseslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rc25_a_repasses class, rc25_a_repassesinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("rc25_a_repasseslist.php"); // Return to list
			}
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

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
		$conn->BeginTrans();

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
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_repasseslist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_repasses_delete)) $rc25_a_repasses_delete = new crc25_a_repasses_delete();

// Page init
$rc25_a_repasses_delete->Page_Init();

// Page main
$rc25_a_repasses_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_repasses_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frc25_a_repassesdelete = new ew_Form("frc25_a_repassesdelete", "delete");

// Form_CustomValidate event
frc25_a_repassesdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_repassesdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_repassesdelete.Lists["x_repasse_id_termos"] = {"LinkField":"x_processo_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_processo_termo_num","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_termos"};
frc25_a_repassesdelete.Lists["x_repasse_id_termos"].Data = "<?php echo $rc25_a_repasses_delete->repasse_id_termos->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_repasses_delete->ShowPageHeader(); ?>
<?php
$rc25_a_repasses_delete->ShowMessage();
?>
<form name="frc25_a_repassesdelete" id="frc25_a_repassesdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_repasses_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_repasses_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_repasses">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rc25_a_repasses_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<th class="<?php echo $rc25_a_repasses->repasse_id_termos->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<th class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<th class="<?php echo $rc25_a_repasses->repasse_meta->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<th class="<?php echo $rc25_a_repasses->repasse_valor_unitario->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<th class="<?php echo $rc25_a_repasses->repasse_valor_mes->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<th class="<?php echo $rc25_a_repasses->repasse_valor_previsto->HeaderCellClass() ?>"><span id="elh_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rc25_a_repasses_delete->RecCnt = 0;
$i = 0;
while (!$rc25_a_repasses_delete->Recordset->EOF) {
	$rc25_a_repasses_delete->RecCnt++;
	$rc25_a_repasses_delete->RowCnt++;

	// Set row properties
	$rc25_a_repasses->ResetAttrs();
	$rc25_a_repasses->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rc25_a_repasses_delete->LoadRowValues($rc25_a_repasses_delete->Recordset);

	// Render row
	$rc25_a_repasses_delete->RenderRow();
?>
	<tr<?php echo $rc25_a_repasses->RowAttributes() ?>>
<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<td<?php echo $rc25_a_repasses->repasse_id_termos->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<td<?php echo $rc25_a_repasses->repasse_faixa_etaria->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
<span<?php echo $rc25_a_repasses->repasse_faixa_etaria->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_faixa_etaria->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<td<?php echo $rc25_a_repasses->repasse_meta->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
<span<?php echo $rc25_a_repasses->repasse_meta->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_meta->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<td<?php echo $rc25_a_repasses->repasse_valor_unitario->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
<span<?php echo $rc25_a_repasses->repasse_valor_unitario->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_unitario->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<td<?php echo $rc25_a_repasses->repasse_valor_mes->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
<span<?php echo $rc25_a_repasses->repasse_valor_mes->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_mes->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<td<?php echo $rc25_a_repasses->repasse_valor_previsto->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_repasses_delete->RowCnt ?>_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
<span<?php echo $rc25_a_repasses->repasse_valor_previsto->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_previsto->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rc25_a_repasses_delete->Recordset->MoveNext();
}
$rc25_a_repasses_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_repasses_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frc25_a_repassesdelete.Init();
</script>
<?php
$rc25_a_repasses_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_repasses_delete->Page_Terminate();
?>
