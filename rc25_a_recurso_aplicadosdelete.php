<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_recurso_aplicadosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_recurso_aplicados_delete = NULL; // Initialize page object first

class crc25_a_recurso_aplicados_delete extends crc25_a_recurso_aplicados {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recurso_aplicados';

	// Page object name
	var $PageObjName = 'rc25_a_recurso_aplicados_delete';

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

		// Table object (rc25_a_recurso_aplicados)
		if (!isset($GLOBALS["rc25_a_recurso_aplicados"]) || get_class($GLOBALS["rc25_a_recurso_aplicados"]) == "crc25_a_recurso_aplicados") {
			$GLOBALS["rc25_a_recurso_aplicados"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recurso_aplicados"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rc25_a_recurso_aplicados', TRUE);

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
		$this->ra_exercicio->SetVisibility();
		$this->ra_data_pagamento->SetVisibility();
		$this->ra_especificacoes->SetVisibility();
		$this->ra_identificador->SetVisibility();
		$this->ra_natureza->SetVisibility();
		$this->ra_valor->SetVisibility();

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
		global $EW_EXPORT, $rc25_a_recurso_aplicados;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rc25_a_recurso_aplicados);
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

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("rc25_a_recurso_aplicadoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rc25_a_recurso_aplicados class, rc25_a_recurso_aplicadosinfo.php

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
				$this->Page_Terminate("rc25_a_recurso_aplicadoslist.php"); // Return to list
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
		$this->ra_id->setDbValue($row['ra_id']);
		$this->ra_exercicio->setDbValue($row['ra_exercicio']);
		$this->ra_data_cadastro->setDbValue($row['ra_data_cadastro']);
		$this->ra_data_pagamento->setDbValue($row['ra_data_pagamento']);
		$this->ra_especificacoes->setDbValue($row['ra_especificacoes']);
		$this->ra_credor->setDbValue($row['ra_credor']);
		$this->ra_identificador->setDbValue($row['ra_identificador']);
		$this->ra_plano->setDbValue($row['ra_plano']);
		$this->ra_natureza->setDbValue($row['ra_natureza']);
		$this->ra_valor->setDbValue($row['ra_valor']);
		$this->ra_comprovante->setDbValue($row['ra_comprovante']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['ra_id'] = NULL;
		$row['ra_exercicio'] = NULL;
		$row['ra_data_cadastro'] = NULL;
		$row['ra_data_pagamento'] = NULL;
		$row['ra_especificacoes'] = NULL;
		$row['ra_credor'] = NULL;
		$row['ra_identificador'] = NULL;
		$row['ra_plano'] = NULL;
		$row['ra_natureza'] = NULL;
		$row['ra_valor'] = NULL;
		$row['ra_comprovante'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ra_id->DbValue = $row['ra_id'];
		$this->ra_exercicio->DbValue = $row['ra_exercicio'];
		$this->ra_data_cadastro->DbValue = $row['ra_data_cadastro'];
		$this->ra_data_pagamento->DbValue = $row['ra_data_pagamento'];
		$this->ra_especificacoes->DbValue = $row['ra_especificacoes'];
		$this->ra_credor->DbValue = $row['ra_credor'];
		$this->ra_identificador->DbValue = $row['ra_identificador'];
		$this->ra_plano->DbValue = $row['ra_plano'];
		$this->ra_natureza->DbValue = $row['ra_natureza'];
		$this->ra_valor->DbValue = $row['ra_valor'];
		$this->ra_comprovante->DbValue = $row['ra_comprovante'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->ra_valor->FormValue == $this->ra_valor->CurrentValue && is_numeric(ew_StrToFloat($this->ra_valor->CurrentValue)))
			$this->ra_valor->CurrentValue = ew_StrToFloat($this->ra_valor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ra_id

		$this->ra_id->CellCssStyle = "white-space: nowrap;";

		// ra_exercicio
		// ra_data_cadastro

		$this->ra_data_cadastro->CellCssStyle = "white-space: nowrap;";

		// ra_data_pagamento
		$this->ra_data_pagamento->CellCssStyle = "white-space: nowrap;";

		// ra_especificacoes
		$this->ra_especificacoes->CellCssStyle = "white-space: nowrap;";

		// ra_credor
		$this->ra_credor->CellCssStyle = "white-space: nowrap;";

		// ra_identificador
		$this->ra_identificador->CellCssStyle = "white-space: nowrap;";

		// ra_plano
		$this->ra_plano->CellCssStyle = "white-space: nowrap;";

		// ra_natureza
		$this->ra_natureza->CellCssStyle = "white-space: nowrap;";

		// ra_valor
		$this->ra_valor->CellCssStyle = "white-space: nowrap;";

		// ra_comprovante
		$this->ra_comprovante->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// ra_exercicio
		if (strval($this->ra_exercicio->CurrentValue) <> "") {
			$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->ra_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ano_ano`, `ano_ano` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_ano_vigente`";
		$sWhereWrk = "";
		$this->ra_exercicio->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_exercicio, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_exercicio->ViewValue = $this->ra_exercicio->CurrentValue;
			}
		} else {
			$this->ra_exercicio->ViewValue = NULL;
		}
		$this->ra_exercicio->ViewCustomAttributes = "";

		// ra_data_pagamento
		$this->ra_data_pagamento->ViewValue = $this->ra_data_pagamento->CurrentValue;
		$this->ra_data_pagamento->ViewValue = ew_FormatDateTime($this->ra_data_pagamento->ViewValue, 7);
		$this->ra_data_pagamento->ViewCustomAttributes = "";

		// ra_especificacoes
		$this->ra_especificacoes->ViewValue = $this->ra_especificacoes->CurrentValue;
		$this->ra_especificacoes->ViewCustomAttributes = "";

		// ra_identificador
		if (strval($this->ra_identificador->CurrentValue) <> "") {
			$sFilterWrk = "`rhp_id`" . ew_SearchString("=", $this->ra_identificador->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `rhp_id`, `rhp_nome` AS `DispFld`, `rhp_documento` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_rhpessoas`";
		$sWhereWrk = "";
		$this->ra_identificador->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_identificador, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->ra_identificador->ViewValue = $this->ra_identificador->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_identificador->ViewValue = $this->ra_identificador->CurrentValue;
			}
		} else {
			$this->ra_identificador->ViewValue = NULL;
		}
		$this->ra_identificador->ViewCustomAttributes = "";

		// ra_natureza
		if (strval($this->ra_natureza->CurrentValue) <> "") {
			$sFilterWrk = "`ran_id`" . ew_SearchString("=", $this->ra_natureza->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `ran_id`, `ran_descricao` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `rc25_a_ra_natureza`";
		$sWhereWrk = "";
		$this->ra_natureza->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->ra_natureza, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->ra_natureza->ViewValue = $this->ra_natureza->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->ra_natureza->ViewValue = $this->ra_natureza->CurrentValue;
			}
		} else {
			$this->ra_natureza->ViewValue = NULL;
		}
		$this->ra_natureza->ViewCustomAttributes = "";

		// ra_valor
		$this->ra_valor->ViewValue = $this->ra_valor->CurrentValue;
		$this->ra_valor->ViewValue = ew_FormatCurrency($this->ra_valor->ViewValue, 2, -1, -2, -2);
		$this->ra_valor->CellCssStyle .= "text-align: right;";
		$this->ra_valor->ViewCustomAttributes = "";

			// ra_exercicio
			$this->ra_exercicio->LinkCustomAttributes = "";
			$this->ra_exercicio->HrefValue = "";
			$this->ra_exercicio->TooltipValue = "";

			// ra_data_pagamento
			$this->ra_data_pagamento->LinkCustomAttributes = "";
			$this->ra_data_pagamento->HrefValue = "";
			$this->ra_data_pagamento->TooltipValue = "";

			// ra_especificacoes
			$this->ra_especificacoes->LinkCustomAttributes = "";
			$this->ra_especificacoes->HrefValue = "";
			$this->ra_especificacoes->TooltipValue = "";

			// ra_identificador
			$this->ra_identificador->LinkCustomAttributes = "";
			$this->ra_identificador->HrefValue = "";
			$this->ra_identificador->TooltipValue = "";

			// ra_natureza
			$this->ra_natureza->LinkCustomAttributes = "";
			$this->ra_natureza->HrefValue = "";
			$this->ra_natureza->TooltipValue = "";

			// ra_valor
			$this->ra_valor->LinkCustomAttributes = "";
			$this->ra_valor->HrefValue = "";
			$this->ra_valor->TooltipValue = "";
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
				$sThisKey .= $row['ra_id'];

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recurso_aplicadoslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rc25_a_recurso_aplicados_delete)) $rc25_a_recurso_aplicados_delete = new crc25_a_recurso_aplicados_delete();

// Page init
$rc25_a_recurso_aplicados_delete->Page_Init();

// Page main
$rc25_a_recurso_aplicados_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recurso_aplicados_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frc25_a_recurso_aplicadosdelete = new ew_Form("frc25_a_recurso_aplicadosdelete", "delete");

// Form_CustomValidate event
frc25_a_recurso_aplicadosdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recurso_aplicadosdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recurso_aplicadosdelete.Lists["x_ra_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recurso_aplicadosdelete.Lists["x_ra_exercicio"].Data = "<?php echo $rc25_a_recurso_aplicados_delete->ra_exercicio->LookupFilterQuery(FALSE, "delete") ?>";
frc25_a_recurso_aplicadosdelete.Lists["x_ra_identificador"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recurso_aplicadosdelete.Lists["x_ra_identificador"].Data = "<?php echo $rc25_a_recurso_aplicados_delete->ra_identificador->LookupFilterQuery(FALSE, "delete") ?>";
frc25_a_recurso_aplicadosdelete.Lists["x_ra_natureza"] = {"LinkField":"x_ran_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_ran_descricao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_ra_natureza"};
frc25_a_recurso_aplicadosdelete.Lists["x_ra_natureza"].Data = "<?php echo $rc25_a_recurso_aplicados_delete->ra_natureza->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_recurso_aplicados_delete->ShowPageHeader(); ?>
<?php
$rc25_a_recurso_aplicados_delete->ShowMessage();
?>
<form name="frc25_a_recurso_aplicadosdelete" id="frc25_a_recurso_aplicadosdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recurso_aplicados_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recurso_aplicados_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recurso_aplicados">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rc25_a_recurso_aplicados_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($rc25_a_recurso_aplicados->ra_exercicio->Visible) { // ra_exercicio ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_exercicio->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_exercicio" class="rc25_a_recurso_aplicados_ra_exercicio"><?php echo $rc25_a_recurso_aplicados->ra_exercicio->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_data_pagamento->Visible) { // ra_data_pagamento ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_data_pagamento" class="rc25_a_recurso_aplicados_ra_data_pagamento"><?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_especificacoes->Visible) { // ra_especificacoes ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_especificacoes" class="rc25_a_recurso_aplicados_ra_especificacoes"><?php echo $rc25_a_recurso_aplicados->ra_especificacoes->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_identificador->Visible) { // ra_identificador ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_identificador->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_identificador" class="rc25_a_recurso_aplicados_ra_identificador"><?php echo $rc25_a_recurso_aplicados->ra_identificador->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_natureza->Visible) { // ra_natureza ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_natureza->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_natureza" class="rc25_a_recurso_aplicados_ra_natureza"><?php echo $rc25_a_recurso_aplicados->ra_natureza->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_valor->Visible) { // ra_valor ?>
		<th class="<?php echo $rc25_a_recurso_aplicados->ra_valor->HeaderCellClass() ?>"><span id="elh_rc25_a_recurso_aplicados_ra_valor" class="rc25_a_recurso_aplicados_ra_valor"><?php echo $rc25_a_recurso_aplicados->ra_valor->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rc25_a_recurso_aplicados_delete->RecCnt = 0;
$i = 0;
while (!$rc25_a_recurso_aplicados_delete->Recordset->EOF) {
	$rc25_a_recurso_aplicados_delete->RecCnt++;
	$rc25_a_recurso_aplicados_delete->RowCnt++;

	// Set row properties
	$rc25_a_recurso_aplicados->ResetAttrs();
	$rc25_a_recurso_aplicados->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rc25_a_recurso_aplicados_delete->LoadRowValues($rc25_a_recurso_aplicados_delete->Recordset);

	// Render row
	$rc25_a_recurso_aplicados_delete->RenderRow();
?>
	<tr<?php echo $rc25_a_recurso_aplicados->RowAttributes() ?>>
<?php if ($rc25_a_recurso_aplicados->ra_exercicio->Visible) { // ra_exercicio ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_exercicio" class="rc25_a_recurso_aplicados_ra_exercicio">
<span<?php echo $rc25_a_recurso_aplicados->ra_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_exercicio->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_data_pagamento->Visible) { // ra_data_pagamento ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_data_pagamento" class="rc25_a_recurso_aplicados_ra_data_pagamento">
<span<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_data_pagamento->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_especificacoes->Visible) { // ra_especificacoes ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_especificacoes" class="rc25_a_recurso_aplicados_ra_especificacoes">
<span<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_especificacoes->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_identificador->Visible) { // ra_identificador ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_identificador->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_identificador" class="rc25_a_recurso_aplicados_ra_identificador">
<span<?php echo $rc25_a_recurso_aplicados->ra_identificador->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_identificador->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_natureza->Visible) { // ra_natureza ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_natureza->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_natureza" class="rc25_a_recurso_aplicados_ra_natureza">
<span<?php echo $rc25_a_recurso_aplicados->ra_natureza->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_natureza->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recurso_aplicados->ra_valor->Visible) { // ra_valor ?>
		<td<?php echo $rc25_a_recurso_aplicados->ra_valor->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recurso_aplicados_delete->RowCnt ?>_rc25_a_recurso_aplicados_ra_valor" class="rc25_a_recurso_aplicados_ra_valor">
<span<?php echo $rc25_a_recurso_aplicados->ra_valor->ViewAttributes() ?>>
<?php echo $rc25_a_recurso_aplicados->ra_valor->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rc25_a_recurso_aplicados_delete->Recordset->MoveNext();
}
$rc25_a_recurso_aplicados_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_recurso_aplicados_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frc25_a_recurso_aplicadosdelete.Init();
</script>
<?php
$rc25_a_recurso_aplicados_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recurso_aplicados_delete->Page_Terminate();
?>
