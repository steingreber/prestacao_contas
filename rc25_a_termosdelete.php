<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "rc25_a_termosinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$rc25_a_termos_delete = NULL; // Initialize page object first

class crc25_a_termos_delete extends crc25_a_termos {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_termos';

	// Page object name
	var $PageObjName = 'rc25_a_termos_delete';

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

		// Table object (rc25_a_termos)
		if (!isset($GLOBALS["rc25_a_termos"]) || get_class($GLOBALS["rc25_a_termos"]) == "crc25_a_termos") {
			$GLOBALS["rc25_a_termos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_termos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
			$this->Page_Terminate("rc25_a_termoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rc25_a_termos class, rc25_a_termosinfo.php

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
				$this->Page_Terminate("rc25_a_termoslist.php"); // Return to list
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

		// Check if records exist for detail table 'rc25_a_planos_aplicacao'
		if (!isset($GLOBALS["rc25_a_planos_aplicacao"])) $GLOBALS["rc25_a_planos_aplicacao"] = new crc25_a_planos_aplicacao();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["rc25_a_planos_aplicacao"]->LoadRs("`plano_exercicio` = " . ew_QuotedValue($row['processo_exercicio'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "rc25_a_planos_aplicacao", $Language->Phrase("RelatedRecordExists"));
				$this->setFailureMessage($sRelatedRecordMsg);
				return FALSE;
			}
		}
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
				$sThisKey .= $row['processo_id'];

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_termoslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rc25_a_termos_delete)) $rc25_a_termos_delete = new crc25_a_termos_delete();

// Page init
$rc25_a_termos_delete->Page_Init();

// Page main
$rc25_a_termos_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_termos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frc25_a_termosdelete = new ew_Form("frc25_a_termosdelete", "delete");

// Form_CustomValidate event
frc25_a_termosdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_termosdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_termosdelete.Lists["x_processo_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_termosdelete.Lists["x_processo_exercicio"].Data = "<?php echo $rc25_a_termos_delete->processo_exercicio->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_termos_delete->ShowPageHeader(); ?>
<?php
$rc25_a_termos_delete->ShowMessage();
?>
<form name="frc25_a_termosdelete" id="frc25_a_termosdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_termos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_termos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_termos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rc25_a_termos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
		<th class="<?php echo $rc25_a_termos->processo_exercicio->HeaderCellClass() ?>"><span id="elh_rc25_a_termos_processo_exercicio" class="rc25_a_termos_processo_exercicio"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
		<th class="<?php echo $rc25_a_termos->processo_termo_num->HeaderCellClass() ?>"><span id="elh_rc25_a_termos_processo_termo_num" class="rc25_a_termos_processo_termo_num"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
		<th class="<?php echo $rc25_a_termos->processo_numero->HeaderCellClass() ?>"><span id="elh_rc25_a_termos_processo_numero" class="rc25_a_termos_processo_numero"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
		<th class="<?php echo $rc25_a_termos->processo_vigencia_ini->HeaderCellClass() ?>"><span id="elh_rc25_a_termos_processo_vigencia_ini" class="rc25_a_termos_processo_vigencia_ini"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
		<th class="<?php echo $rc25_a_termos->processo_vigencia_fim->HeaderCellClass() ?>"><span id="elh_rc25_a_termos_processo_vigencia_fim" class="rc25_a_termos_processo_vigencia_fim"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rc25_a_termos_delete->RecCnt = 0;
$i = 0;
while (!$rc25_a_termos_delete->Recordset->EOF) {
	$rc25_a_termos_delete->RecCnt++;
	$rc25_a_termos_delete->RowCnt++;

	// Set row properties
	$rc25_a_termos->ResetAttrs();
	$rc25_a_termos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rc25_a_termos_delete->LoadRowValues($rc25_a_termos_delete->Recordset);

	// Render row
	$rc25_a_termos_delete->RenderRow();
?>
	<tr<?php echo $rc25_a_termos->RowAttributes() ?>>
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
		<td<?php echo $rc25_a_termos->processo_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_delete->RowCnt ?>_rc25_a_termos_processo_exercicio" class="rc25_a_termos_processo_exercicio">
<span<?php echo $rc25_a_termos->processo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
		<td<?php echo $rc25_a_termos->processo_termo_num->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_delete->RowCnt ?>_rc25_a_termos_processo_termo_num" class="rc25_a_termos_processo_termo_num">
<span<?php echo $rc25_a_termos->processo_termo_num->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_termo_num->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
		<td<?php echo $rc25_a_termos->processo_numero->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_delete->RowCnt ?>_rc25_a_termos_processo_numero" class="rc25_a_termos_processo_numero">
<span<?php echo $rc25_a_termos->processo_numero->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_numero->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
		<td<?php echo $rc25_a_termos->processo_vigencia_ini->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_delete->RowCnt ?>_rc25_a_termos_processo_vigencia_ini" class="rc25_a_termos_processo_vigencia_ini">
<span<?php echo $rc25_a_termos->processo_vigencia_ini->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_ini->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
		<td<?php echo $rc25_a_termos->processo_vigencia_fim->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_termos_delete->RowCnt ?>_rc25_a_termos_processo_vigencia_fim" class="rc25_a_termos_processo_vigencia_fim">
<span<?php echo $rc25_a_termos->processo_vigencia_fim->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_fim->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rc25_a_termos_delete->Recordset->MoveNext();
}
$rc25_a_termos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_termos_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frc25_a_termosdelete.Init();
</script>
<?php
$rc25_a_termos_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_termos_delete->Page_Terminate();
?>
