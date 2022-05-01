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

$rc25_a_recursos_humanos_delete = NULL; // Initialize page object first

class crc25_a_recursos_humanos_delete extends crc25_a_recursos_humanos {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_recursos_humanos';

	// Page object name
	var $PageObjName = 'rc25_a_recursos_humanos_delete';

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

		// Table object (rc25_a_recursos_humanos)
		if (!isset($GLOBALS["rc25_a_recursos_humanos"]) || get_class($GLOBALS["rc25_a_recursos_humanos"]) == "crc25_a_recursos_humanos") {
			$GLOBALS["rc25_a_recursos_humanos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rc25_a_recursos_humanos"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
			$this->Page_Terminate("rc25_a_recursos_humanoslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rc25_a_recursos_humanos class, rc25_a_recursos_humanosinfo.php

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
				$this->Page_Terminate("rc25_a_recursos_humanoslist.php"); // Return to list
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

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
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
				$sThisKey .= $row['rh_id'];

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_recursos_humanoslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rc25_a_recursos_humanos_delete)) $rc25_a_recursos_humanos_delete = new crc25_a_recursos_humanos_delete();

// Page init
$rc25_a_recursos_humanos_delete->Page_Init();

// Page main
$rc25_a_recursos_humanos_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_recursos_humanos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frc25_a_recursos_humanosdelete = new ew_Form("frc25_a_recursos_humanosdelete", "delete");

// Form_CustomValidate event
frc25_a_recursos_humanosdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_recursos_humanosdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_recursos_humanosdelete.Lists["x_rh_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_recursos_humanosdelete.Lists["x_rh_exercicio"].Data = "<?php echo $rc25_a_recursos_humanos_delete->rh_exercicio->LookupFilterQuery(FALSE, "delete") ?>";
frc25_a_recursos_humanosdelete.Lists["x_rh_nome"] = {"LinkField":"x_rhp_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhp_nome","x_rhp_documento","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhpessoas"};
frc25_a_recursos_humanosdelete.Lists["x_rh_nome"].Data = "<?php echo $rc25_a_recursos_humanos_delete->rh_nome->LookupFilterQuery(FALSE, "delete") ?>";
frc25_a_recursos_humanosdelete.Lists["x_rh_funcao"] = {"LinkField":"x_rhf_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_rhf_funcao","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_rhfuncoes"};
frc25_a_recursos_humanosdelete.Lists["x_rh_funcao"].Data = "<?php echo $rc25_a_recursos_humanos_delete->rh_funcao->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_recursos_humanos_delete->ShowPageHeader(); ?>
<?php
$rc25_a_recursos_humanos_delete->ShowMessage();
?>
<form name="frc25_a_recursos_humanosdelete" id="frc25_a_recursos_humanosdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_recursos_humanos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_recursos_humanos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_recursos_humanos">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rc25_a_recursos_humanos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
		<th class="<?php echo $rc25_a_recursos_humanos->rh_exercicio->HeaderCellClass() ?>"><span id="elh_rc25_a_recursos_humanos_rh_exercicio" class="rc25_a_recursos_humanos_rh_exercicio"><?php echo $rc25_a_recursos_humanos->rh_exercicio->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
		<th class="<?php echo $rc25_a_recursos_humanos->rh_nome->HeaderCellClass() ?>"><span id="elh_rc25_a_recursos_humanos_rh_nome" class="rc25_a_recursos_humanos_rh_nome"><?php echo $rc25_a_recursos_humanos->rh_nome->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
		<th class="<?php echo $rc25_a_recursos_humanos->rh_funcao->HeaderCellClass() ?>"><span id="elh_rc25_a_recursos_humanos_rh_funcao" class="rc25_a_recursos_humanos_rh_funcao"><?php echo $rc25_a_recursos_humanos->rh_funcao->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
		<th class="<?php echo $rc25_a_recursos_humanos->rh_sala_turma->HeaderCellClass() ?>"><span id="elh_rc25_a_recursos_humanos_rh_sala_turma" class="rc25_a_recursos_humanos_rh_sala_turma"><?php echo $rc25_a_recursos_humanos->rh_sala_turma->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rc25_a_recursos_humanos_delete->RecCnt = 0;
$i = 0;
while (!$rc25_a_recursos_humanos_delete->Recordset->EOF) {
	$rc25_a_recursos_humanos_delete->RecCnt++;
	$rc25_a_recursos_humanos_delete->RowCnt++;

	// Set row properties
	$rc25_a_recursos_humanos->ResetAttrs();
	$rc25_a_recursos_humanos->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rc25_a_recursos_humanos_delete->LoadRowValues($rc25_a_recursos_humanos_delete->Recordset);

	// Render row
	$rc25_a_recursos_humanos_delete->RenderRow();
?>
	<tr<?php echo $rc25_a_recursos_humanos->RowAttributes() ?>>
<?php if ($rc25_a_recursos_humanos->rh_exercicio->Visible) { // rh_exercicio ?>
		<td<?php echo $rc25_a_recursos_humanos->rh_exercicio->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_delete->RowCnt ?>_rc25_a_recursos_humanos_rh_exercicio" class="rc25_a_recursos_humanos_rh_exercicio">
<span<?php echo $rc25_a_recursos_humanos->rh_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_exercicio->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_nome->Visible) { // rh_nome ?>
		<td<?php echo $rc25_a_recursos_humanos->rh_nome->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_delete->RowCnt ?>_rc25_a_recursos_humanos_rh_nome" class="rc25_a_recursos_humanos_rh_nome">
<span<?php echo $rc25_a_recursos_humanos->rh_nome->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_nome->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_funcao->Visible) { // rh_funcao ?>
		<td<?php echo $rc25_a_recursos_humanos->rh_funcao->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_delete->RowCnt ?>_rc25_a_recursos_humanos_rh_funcao" class="rc25_a_recursos_humanos_rh_funcao">
<span<?php echo $rc25_a_recursos_humanos->rh_funcao->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_funcao->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rc25_a_recursos_humanos->rh_sala_turma->Visible) { // rh_sala_turma ?>
		<td<?php echo $rc25_a_recursos_humanos->rh_sala_turma->CellAttributes() ?>>
<span id="el<?php echo $rc25_a_recursos_humanos_delete->RowCnt ?>_rc25_a_recursos_humanos_rh_sala_turma" class="rc25_a_recursos_humanos_rh_sala_turma">
<span<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ViewAttributes() ?>>
<?php echo $rc25_a_recursos_humanos->rh_sala_turma->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rc25_a_recursos_humanos_delete->Recordset->MoveNext();
}
$rc25_a_recursos_humanos_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_recursos_humanos_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frc25_a_recursos_humanosdelete.Init();
</script>
<?php
$rc25_a_recursos_humanos_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_recursos_humanos_delete->Page_Terminate();
?>
