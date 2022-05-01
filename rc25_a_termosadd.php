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

$rc25_a_termos_add = NULL; // Initialize page object first

class crc25_a_termos_add extends crc25_a_termos {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{4608F4F3-4555-4766-9AD8-B0379A4856EE}';

	// Table name
	var $TableName = 'rc25_a_termos';

	// Page object name
	var $PageObjName = 'rc25_a_termos_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->processo_exercicio->SetVisibility();
		$this->processo_termo_num->SetVisibility();
		$this->processo_numero->SetVisibility();
		$this->processo_vigencia_ini->SetVisibility();
		$this->processo_vigencia_fim->SetVisibility();
		$this->processo_data->SetVisibility();
		$this->processo_valor->SetVisibility();
		$this->processo_objeto->SetVisibility();
		$this->processo_metas->SetVisibility();
		$this->processo_origem->SetVisibility();
		$this->processo_ent_endereco->SetVisibility();
		$this->processo_ent_estatuto->SetVisibility();
		$this->processo_ent_lei->SetVisibility();
		$this->processo_ent_cebas->SetVisibility();
		$this->processo_resp_nome->SetVisibility();
		$this->processo_resp_cargo->SetVisibility();
		$this->processo_resp_end->SetVisibility();
		$this->processo_resp_contato->SetVisibility();
		$this->processo_resp_ata->SetVisibility();
		$this->processo_cont_nome->SetVisibility();
		$this->processo_cont_end->SetVisibility();
		$this->processo_cont_contato->SetVisibility();
		$this->processo_cont_indent->SetVisibility();
		$this->processo_preenc_nome->SetVisibility();
		$this->processo_preenc_carg->SetVisibility();
		$this->processo_preenc_end->SetVisibility();
		$this->processo_preenc_contato->SetVisibility();
		$this->processo_preenc_indentifica->SetVisibility();

		// Set up multi page object
		$this->SetupMultiPages();

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "rc25_a_termosview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["processo_id"] != "") {
				$this->processo_id->setQueryStringValue($_GET["processo_id"]);
				$this->setKey("processo_id", $this->processo_id->CurrentValue); // Set up key
			} else {
				$this->setKey("processo_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->SetupDetailParms();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("rc25_a_termoslist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "rc25_a_termoslist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "rc25_a_termosview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->processo_ent_estatuto->Upload->Index = $objForm->Index;
		$this->processo_ent_estatuto->Upload->UploadFile();
	}

	// Load default values
	function LoadDefaultValues() {
		$this->processo_id->CurrentValue = NULL;
		$this->processo_id->OldValue = $this->processo_id->CurrentValue;
		$this->processo_exercicio->CurrentValue = NULL;
		$this->processo_exercicio->OldValue = $this->processo_exercicio->CurrentValue;
		$this->processo_termo_num->CurrentValue = NULL;
		$this->processo_termo_num->OldValue = $this->processo_termo_num->CurrentValue;
		$this->processo_numero->CurrentValue = NULL;
		$this->processo_numero->OldValue = $this->processo_numero->CurrentValue;
		$this->processo_vigencia_ini->CurrentValue = NULL;
		$this->processo_vigencia_ini->OldValue = $this->processo_vigencia_ini->CurrentValue;
		$this->processo_vigencia_fim->CurrentValue = NULL;
		$this->processo_vigencia_fim->OldValue = $this->processo_vigencia_fim->CurrentValue;
		$this->processo_data->CurrentValue = NULL;
		$this->processo_data->OldValue = $this->processo_data->CurrentValue;
		$this->processo_valor->CurrentValue = NULL;
		$this->processo_valor->OldValue = $this->processo_valor->CurrentValue;
		$this->processo_objeto->CurrentValue = NULL;
		$this->processo_objeto->OldValue = $this->processo_objeto->CurrentValue;
		$this->processo_metas->CurrentValue = NULL;
		$this->processo_metas->OldValue = $this->processo_metas->CurrentValue;
		$this->processo_origem->CurrentValue = NULL;
		$this->processo_origem->OldValue = $this->processo_origem->CurrentValue;
		$this->processo_ent_endereco->CurrentValue = NULL;
		$this->processo_ent_endereco->OldValue = $this->processo_ent_endereco->CurrentValue;
		$this->processo_ent_estatuto->Upload->DbValue = NULL;
		$this->processo_ent_estatuto->OldValue = $this->processo_ent_estatuto->Upload->DbValue;
		$this->processo_ent_lei->CurrentValue = NULL;
		$this->processo_ent_lei->OldValue = $this->processo_ent_lei->CurrentValue;
		$this->processo_ent_cebas->CurrentValue = NULL;
		$this->processo_ent_cebas->OldValue = $this->processo_ent_cebas->CurrentValue;
		$this->processo_resp_nome->CurrentValue = NULL;
		$this->processo_resp_nome->OldValue = $this->processo_resp_nome->CurrentValue;
		$this->processo_resp_cargo->CurrentValue = NULL;
		$this->processo_resp_cargo->OldValue = $this->processo_resp_cargo->CurrentValue;
		$this->processo_resp_end->CurrentValue = NULL;
		$this->processo_resp_end->OldValue = $this->processo_resp_end->CurrentValue;
		$this->processo_resp_contato->CurrentValue = NULL;
		$this->processo_resp_contato->OldValue = $this->processo_resp_contato->CurrentValue;
		$this->processo_resp_ata->CurrentValue = NULL;
		$this->processo_resp_ata->OldValue = $this->processo_resp_ata->CurrentValue;
		$this->processo_cont_nome->CurrentValue = NULL;
		$this->processo_cont_nome->OldValue = $this->processo_cont_nome->CurrentValue;
		$this->processo_cont_end->CurrentValue = NULL;
		$this->processo_cont_end->OldValue = $this->processo_cont_end->CurrentValue;
		$this->processo_cont_contato->CurrentValue = NULL;
		$this->processo_cont_contato->OldValue = $this->processo_cont_contato->CurrentValue;
		$this->processo_cont_indent->CurrentValue = NULL;
		$this->processo_cont_indent->OldValue = $this->processo_cont_indent->CurrentValue;
		$this->processo_preenc_nome->CurrentValue = NULL;
		$this->processo_preenc_nome->OldValue = $this->processo_preenc_nome->CurrentValue;
		$this->processo_preenc_carg->CurrentValue = NULL;
		$this->processo_preenc_carg->OldValue = $this->processo_preenc_carg->CurrentValue;
		$this->processo_preenc_end->CurrentValue = NULL;
		$this->processo_preenc_end->OldValue = $this->processo_preenc_end->CurrentValue;
		$this->processo_preenc_contato->CurrentValue = NULL;
		$this->processo_preenc_contato->OldValue = $this->processo_preenc_contato->CurrentValue;
		$this->processo_preenc_indentifica->CurrentValue = NULL;
		$this->processo_preenc_indentifica->OldValue = $this->processo_preenc_indentifica->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->processo_exercicio->FldIsDetailKey) {
			$this->processo_exercicio->setFormValue($objForm->GetValue("x_processo_exercicio"));
		}
		if (!$this->processo_termo_num->FldIsDetailKey) {
			$this->processo_termo_num->setFormValue($objForm->GetValue("x_processo_termo_num"));
		}
		if (!$this->processo_numero->FldIsDetailKey) {
			$this->processo_numero->setFormValue($objForm->GetValue("x_processo_numero"));
		}
		if (!$this->processo_vigencia_ini->FldIsDetailKey) {
			$this->processo_vigencia_ini->setFormValue($objForm->GetValue("x_processo_vigencia_ini"));
			$this->processo_vigencia_ini->CurrentValue = ew_UnFormatDateTime($this->processo_vigencia_ini->CurrentValue, 6);
		}
		if (!$this->processo_vigencia_fim->FldIsDetailKey) {
			$this->processo_vigencia_fim->setFormValue($objForm->GetValue("x_processo_vigencia_fim"));
			$this->processo_vigencia_fim->CurrentValue = ew_UnFormatDateTime($this->processo_vigencia_fim->CurrentValue, 7);
		}
		if (!$this->processo_data->FldIsDetailKey) {
			$this->processo_data->setFormValue($objForm->GetValue("x_processo_data"));
			$this->processo_data->CurrentValue = ew_UnFormatDateTime($this->processo_data->CurrentValue, 7);
		}
		if (!$this->processo_valor->FldIsDetailKey) {
			$this->processo_valor->setFormValue($objForm->GetValue("x_processo_valor"));
		}
		if (!$this->processo_objeto->FldIsDetailKey) {
			$this->processo_objeto->setFormValue($objForm->GetValue("x_processo_objeto"));
		}
		if (!$this->processo_metas->FldIsDetailKey) {
			$this->processo_metas->setFormValue($objForm->GetValue("x_processo_metas"));
		}
		if (!$this->processo_origem->FldIsDetailKey) {
			$this->processo_origem->setFormValue($objForm->GetValue("x_processo_origem"));
		}
		if (!$this->processo_ent_endereco->FldIsDetailKey) {
			$this->processo_ent_endereco->setFormValue($objForm->GetValue("x_processo_ent_endereco"));
		}
		if (!$this->processo_ent_lei->FldIsDetailKey) {
			$this->processo_ent_lei->setFormValue($objForm->GetValue("x_processo_ent_lei"));
		}
		if (!$this->processo_ent_cebas->FldIsDetailKey) {
			$this->processo_ent_cebas->setFormValue($objForm->GetValue("x_processo_ent_cebas"));
		}
		if (!$this->processo_resp_nome->FldIsDetailKey) {
			$this->processo_resp_nome->setFormValue($objForm->GetValue("x_processo_resp_nome"));
		}
		if (!$this->processo_resp_cargo->FldIsDetailKey) {
			$this->processo_resp_cargo->setFormValue($objForm->GetValue("x_processo_resp_cargo"));
		}
		if (!$this->processo_resp_end->FldIsDetailKey) {
			$this->processo_resp_end->setFormValue($objForm->GetValue("x_processo_resp_end"));
		}
		if (!$this->processo_resp_contato->FldIsDetailKey) {
			$this->processo_resp_contato->setFormValue($objForm->GetValue("x_processo_resp_contato"));
		}
		if (!$this->processo_resp_ata->FldIsDetailKey) {
			$this->processo_resp_ata->setFormValue($objForm->GetValue("x_processo_resp_ata"));
		}
		if (!$this->processo_cont_nome->FldIsDetailKey) {
			$this->processo_cont_nome->setFormValue($objForm->GetValue("x_processo_cont_nome"));
		}
		if (!$this->processo_cont_end->FldIsDetailKey) {
			$this->processo_cont_end->setFormValue($objForm->GetValue("x_processo_cont_end"));
		}
		if (!$this->processo_cont_contato->FldIsDetailKey) {
			$this->processo_cont_contato->setFormValue($objForm->GetValue("x_processo_cont_contato"));
		}
		if (!$this->processo_cont_indent->FldIsDetailKey) {
			$this->processo_cont_indent->setFormValue($objForm->GetValue("x_processo_cont_indent"));
		}
		if (!$this->processo_preenc_nome->FldIsDetailKey) {
			$this->processo_preenc_nome->setFormValue($objForm->GetValue("x_processo_preenc_nome"));
		}
		if (!$this->processo_preenc_carg->FldIsDetailKey) {
			$this->processo_preenc_carg->setFormValue($objForm->GetValue("x_processo_preenc_carg"));
		}
		if (!$this->processo_preenc_end->FldIsDetailKey) {
			$this->processo_preenc_end->setFormValue($objForm->GetValue("x_processo_preenc_end"));
		}
		if (!$this->processo_preenc_contato->FldIsDetailKey) {
			$this->processo_preenc_contato->setFormValue($objForm->GetValue("x_processo_preenc_contato"));
		}
		if (!$this->processo_preenc_indentifica->FldIsDetailKey) {
			$this->processo_preenc_indentifica->setFormValue($objForm->GetValue("x_processo_preenc_indentifica"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->processo_exercicio->CurrentValue = $this->processo_exercicio->FormValue;
		$this->processo_termo_num->CurrentValue = $this->processo_termo_num->FormValue;
		$this->processo_numero->CurrentValue = $this->processo_numero->FormValue;
		$this->processo_vigencia_ini->CurrentValue = $this->processo_vigencia_ini->FormValue;
		$this->processo_vigencia_ini->CurrentValue = ew_UnFormatDateTime($this->processo_vigencia_ini->CurrentValue, 6);
		$this->processo_vigencia_fim->CurrentValue = $this->processo_vigencia_fim->FormValue;
		$this->processo_vigencia_fim->CurrentValue = ew_UnFormatDateTime($this->processo_vigencia_fim->CurrentValue, 7);
		$this->processo_data->CurrentValue = $this->processo_data->FormValue;
		$this->processo_data->CurrentValue = ew_UnFormatDateTime($this->processo_data->CurrentValue, 7);
		$this->processo_valor->CurrentValue = $this->processo_valor->FormValue;
		$this->processo_objeto->CurrentValue = $this->processo_objeto->FormValue;
		$this->processo_metas->CurrentValue = $this->processo_metas->FormValue;
		$this->processo_origem->CurrentValue = $this->processo_origem->FormValue;
		$this->processo_ent_endereco->CurrentValue = $this->processo_ent_endereco->FormValue;
		$this->processo_ent_lei->CurrentValue = $this->processo_ent_lei->FormValue;
		$this->processo_ent_cebas->CurrentValue = $this->processo_ent_cebas->FormValue;
		$this->processo_resp_nome->CurrentValue = $this->processo_resp_nome->FormValue;
		$this->processo_resp_cargo->CurrentValue = $this->processo_resp_cargo->FormValue;
		$this->processo_resp_end->CurrentValue = $this->processo_resp_end->FormValue;
		$this->processo_resp_contato->CurrentValue = $this->processo_resp_contato->FormValue;
		$this->processo_resp_ata->CurrentValue = $this->processo_resp_ata->FormValue;
		$this->processo_cont_nome->CurrentValue = $this->processo_cont_nome->FormValue;
		$this->processo_cont_end->CurrentValue = $this->processo_cont_end->FormValue;
		$this->processo_cont_contato->CurrentValue = $this->processo_cont_contato->FormValue;
		$this->processo_cont_indent->CurrentValue = $this->processo_cont_indent->FormValue;
		$this->processo_preenc_nome->CurrentValue = $this->processo_preenc_nome->FormValue;
		$this->processo_preenc_carg->CurrentValue = $this->processo_preenc_carg->FormValue;
		$this->processo_preenc_end->CurrentValue = $this->processo_preenc_end->FormValue;
		$this->processo_preenc_contato->CurrentValue = $this->processo_preenc_contato->FormValue;
		$this->processo_preenc_indentifica->CurrentValue = $this->processo_preenc_indentifica->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['processo_id'] = $this->processo_id->CurrentValue;
		$row['processo_exercicio'] = $this->processo_exercicio->CurrentValue;
		$row['processo_termo_num'] = $this->processo_termo_num->CurrentValue;
		$row['processo_numero'] = $this->processo_numero->CurrentValue;
		$row['processo_vigencia_ini'] = $this->processo_vigencia_ini->CurrentValue;
		$row['processo_vigencia_fim'] = $this->processo_vigencia_fim->CurrentValue;
		$row['processo_data'] = $this->processo_data->CurrentValue;
		$row['processo_valor'] = $this->processo_valor->CurrentValue;
		$row['processo_objeto'] = $this->processo_objeto->CurrentValue;
		$row['processo_metas'] = $this->processo_metas->CurrentValue;
		$row['processo_origem'] = $this->processo_origem->CurrentValue;
		$row['processo_ent_endereco'] = $this->processo_ent_endereco->CurrentValue;
		$row['processo_ent_estatuto'] = $this->processo_ent_estatuto->Upload->DbValue;
		$row['processo_ent_lei'] = $this->processo_ent_lei->CurrentValue;
		$row['processo_ent_cebas'] = $this->processo_ent_cebas->CurrentValue;
		$row['processo_resp_nome'] = $this->processo_resp_nome->CurrentValue;
		$row['processo_resp_cargo'] = $this->processo_resp_cargo->CurrentValue;
		$row['processo_resp_end'] = $this->processo_resp_end->CurrentValue;
		$row['processo_resp_contato'] = $this->processo_resp_contato->CurrentValue;
		$row['processo_resp_ata'] = $this->processo_resp_ata->CurrentValue;
		$row['processo_cont_nome'] = $this->processo_cont_nome->CurrentValue;
		$row['processo_cont_end'] = $this->processo_cont_end->CurrentValue;
		$row['processo_cont_contato'] = $this->processo_cont_contato->CurrentValue;
		$row['processo_cont_indent'] = $this->processo_cont_indent->CurrentValue;
		$row['processo_preenc_nome'] = $this->processo_preenc_nome->CurrentValue;
		$row['processo_preenc_carg'] = $this->processo_preenc_carg->CurrentValue;
		$row['processo_preenc_end'] = $this->processo_preenc_end->CurrentValue;
		$row['processo_preenc_contato'] = $this->processo_preenc_contato->CurrentValue;
		$row['processo_preenc_indentifica'] = $this->processo_preenc_indentifica->CurrentValue;
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
		// Convert decimal values if posted back

		if ($this->processo_valor->FormValue == $this->processo_valor->CurrentValue && is_numeric(ew_StrToFloat($this->processo_valor->CurrentValue)))
			$this->processo_valor->CurrentValue = ew_StrToFloat($this->processo_valor->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// processo_id
		// processo_exercicio
		// processo_termo_num
		// processo_numero
		// processo_vigencia_ini
		// processo_vigencia_fim
		// processo_data
		// processo_valor
		// processo_objeto
		// processo_metas
		// processo_origem
		// processo_ent_endereco
		// processo_ent_estatuto
		// processo_ent_lei
		// processo_ent_cebas
		// processo_resp_nome
		// processo_resp_cargo
		// processo_resp_end
		// processo_resp_contato
		// processo_resp_ata
		// processo_cont_nome
		// processo_cont_end
		// processo_cont_contato
		// processo_cont_indent
		// processo_preenc_nome
		// processo_preenc_carg
		// processo_preenc_end
		// processo_preenc_contato
		// processo_preenc_indentifica

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

		// processo_data
		$this->processo_data->ViewValue = $this->processo_data->CurrentValue;
		$this->processo_data->ViewValue = ew_FormatDateTime($this->processo_data->ViewValue, 7);
		$this->processo_data->ViewCustomAttributes = "";

		// processo_valor
		$this->processo_valor->ViewValue = $this->processo_valor->CurrentValue;
		$this->processo_valor->ViewValue = ew_FormatCurrency($this->processo_valor->ViewValue, 2, -1, -2, -2);
		$this->processo_valor->ViewCustomAttributes = "";

		// processo_objeto
		$this->processo_objeto->ViewValue = $this->processo_objeto->CurrentValue;
		$this->processo_objeto->ViewCustomAttributes = "";

		// processo_metas
		$this->processo_metas->ViewValue = $this->processo_metas->CurrentValue;
		$this->processo_metas->ViewCustomAttributes = "";

		// processo_origem
		$this->processo_origem->ViewValue = $this->processo_origem->CurrentValue;
		$this->processo_origem->ViewCustomAttributes = "";

		// processo_ent_endereco
		$this->processo_ent_endereco->ViewValue = $this->processo_ent_endereco->CurrentValue;
		$this->processo_ent_endereco->ViewCustomAttributes = "";

		// processo_ent_estatuto
		if (!ew_Empty($this->processo_ent_estatuto->Upload->DbValue)) {
			$this->processo_ent_estatuto->ViewValue = "rc25_a_termos_processo_ent_estatuto_bv.php?" . "processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->processo_ent_estatuto->Upload->DbValue, 0, 11)));
		} else {
			$this->processo_ent_estatuto->ViewValue = "";
		}
		$this->processo_ent_estatuto->ViewCustomAttributes = "";

		// processo_ent_lei
		$this->processo_ent_lei->ViewValue = $this->processo_ent_lei->CurrentValue;
		$this->processo_ent_lei->ViewCustomAttributes = "";

		// processo_ent_cebas
		$this->processo_ent_cebas->ViewValue = $this->processo_ent_cebas->CurrentValue;
		$this->processo_ent_cebas->ViewCustomAttributes = "";

		// processo_resp_nome
		$this->processo_resp_nome->ViewValue = $this->processo_resp_nome->CurrentValue;
		$this->processo_resp_nome->ViewCustomAttributes = "";

		// processo_resp_cargo
		$this->processo_resp_cargo->ViewValue = $this->processo_resp_cargo->CurrentValue;
		$this->processo_resp_cargo->ViewCustomAttributes = "";

		// processo_resp_end
		$this->processo_resp_end->ViewValue = $this->processo_resp_end->CurrentValue;
		$this->processo_resp_end->ViewCustomAttributes = "";

		// processo_resp_contato
		$this->processo_resp_contato->ViewValue = $this->processo_resp_contato->CurrentValue;
		$this->processo_resp_contato->ViewCustomAttributes = "";

		// processo_resp_ata
		$this->processo_resp_ata->ViewValue = $this->processo_resp_ata->CurrentValue;
		$this->processo_resp_ata->ViewCustomAttributes = "";

		// processo_cont_nome
		$this->processo_cont_nome->ViewValue = $this->processo_cont_nome->CurrentValue;
		$this->processo_cont_nome->ViewCustomAttributes = "";

		// processo_cont_end
		$this->processo_cont_end->ViewValue = $this->processo_cont_end->CurrentValue;
		$this->processo_cont_end->ViewCustomAttributes = "";

		// processo_cont_contato
		$this->processo_cont_contato->ViewValue = $this->processo_cont_contato->CurrentValue;
		$this->processo_cont_contato->ViewCustomAttributes = "";

		// processo_cont_indent
		$this->processo_cont_indent->ViewValue = $this->processo_cont_indent->CurrentValue;
		$this->processo_cont_indent->ViewCustomAttributes = "";

		// processo_preenc_nome
		$this->processo_preenc_nome->ViewValue = $this->processo_preenc_nome->CurrentValue;
		$this->processo_preenc_nome->ViewCustomAttributes = "";

		// processo_preenc_carg
		$this->processo_preenc_carg->ViewValue = $this->processo_preenc_carg->CurrentValue;
		$this->processo_preenc_carg->ViewCustomAttributes = "";

		// processo_preenc_end
		$this->processo_preenc_end->ViewValue = $this->processo_preenc_end->CurrentValue;
		$this->processo_preenc_end->ViewCustomAttributes = "";

		// processo_preenc_contato
		$this->processo_preenc_contato->ViewValue = $this->processo_preenc_contato->CurrentValue;
		$this->processo_preenc_contato->ViewCustomAttributes = "";

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->ViewValue = $this->processo_preenc_indentifica->CurrentValue;
		$this->processo_preenc_indentifica->ViewCustomAttributes = "";

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

			// processo_data
			$this->processo_data->LinkCustomAttributes = "";
			$this->processo_data->HrefValue = "";
			$this->processo_data->TooltipValue = "";

			// processo_valor
			$this->processo_valor->LinkCustomAttributes = "";
			$this->processo_valor->HrefValue = "";
			if ($this->Export == "") {
				$this->processo_valor->TooltipValue = ($this->processo_valor->ViewValue <> "") ? $this->processo_valor->ViewValue : $this->processo_valor->CurrentValue;
				if ($this->processo_valor->HrefValue == "") $this->processo_valor->HrefValue = "javascript:void(0);";
				ew_AppendClass($this->processo_valor->LinkAttrs["class"], "ewTooltipLink");
				$this->processo_valor->LinkAttrs["data-tooltip-id"] = "tt_rc25_a_termos_x_processo_valor";
				$this->processo_valor->LinkAttrs["data-tooltip-width"] = $this->processo_valor->TooltipWidth;
				$this->processo_valor->LinkAttrs["data-placement"] = $GLOBALS["EW_CSS_FLIP"] ? "left" : "right";
			}

			// processo_objeto
			$this->processo_objeto->LinkCustomAttributes = "";
			$this->processo_objeto->HrefValue = "";
			$this->processo_objeto->TooltipValue = "";

			// processo_metas
			$this->processo_metas->LinkCustomAttributes = "";
			$this->processo_metas->HrefValue = "";
			$this->processo_metas->TooltipValue = "";

			// processo_origem
			$this->processo_origem->LinkCustomAttributes = "";
			$this->processo_origem->HrefValue = "";
			$this->processo_origem->TooltipValue = "";

			// processo_ent_endereco
			$this->processo_ent_endereco->LinkCustomAttributes = "";
			$this->processo_ent_endereco->HrefValue = "";
			$this->processo_ent_endereco->TooltipValue = "";

			// processo_ent_estatuto
			$this->processo_ent_estatuto->LinkCustomAttributes = "";
			if (!empty($this->processo_ent_estatuto->Upload->DbValue)) {
				$this->processo_ent_estatuto->HrefValue = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
				$this->processo_ent_estatuto->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->processo_ent_estatuto->HrefValue = ew_FullUrl($this->processo_ent_estatuto->HrefValue, "href");
			} else {
				$this->processo_ent_estatuto->HrefValue = "";
			}
			$this->processo_ent_estatuto->HrefValue2 = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
			$this->processo_ent_estatuto->TooltipValue = "";

			// processo_ent_lei
			$this->processo_ent_lei->LinkCustomAttributes = "";
			$this->processo_ent_lei->HrefValue = "";
			$this->processo_ent_lei->TooltipValue = "";

			// processo_ent_cebas
			$this->processo_ent_cebas->LinkCustomAttributes = "";
			$this->processo_ent_cebas->HrefValue = "";
			$this->processo_ent_cebas->TooltipValue = "";

			// processo_resp_nome
			$this->processo_resp_nome->LinkCustomAttributes = "";
			$this->processo_resp_nome->HrefValue = "";
			$this->processo_resp_nome->TooltipValue = "";

			// processo_resp_cargo
			$this->processo_resp_cargo->LinkCustomAttributes = "";
			$this->processo_resp_cargo->HrefValue = "";
			$this->processo_resp_cargo->TooltipValue = "";

			// processo_resp_end
			$this->processo_resp_end->LinkCustomAttributes = "";
			$this->processo_resp_end->HrefValue = "";
			$this->processo_resp_end->TooltipValue = "";

			// processo_resp_contato
			$this->processo_resp_contato->LinkCustomAttributes = "";
			$this->processo_resp_contato->HrefValue = "";
			$this->processo_resp_contato->TooltipValue = "";

			// processo_resp_ata
			$this->processo_resp_ata->LinkCustomAttributes = "";
			$this->processo_resp_ata->HrefValue = "";
			$this->processo_resp_ata->TooltipValue = "";

			// processo_cont_nome
			$this->processo_cont_nome->LinkCustomAttributes = "";
			$this->processo_cont_nome->HrefValue = "";
			$this->processo_cont_nome->TooltipValue = "";

			// processo_cont_end
			$this->processo_cont_end->LinkCustomAttributes = "";
			$this->processo_cont_end->HrefValue = "";
			$this->processo_cont_end->TooltipValue = "";

			// processo_cont_contato
			$this->processo_cont_contato->LinkCustomAttributes = "";
			$this->processo_cont_contato->HrefValue = "";
			$this->processo_cont_contato->TooltipValue = "";

			// processo_cont_indent
			$this->processo_cont_indent->LinkCustomAttributes = "";
			$this->processo_cont_indent->HrefValue = "";
			$this->processo_cont_indent->TooltipValue = "";

			// processo_preenc_nome
			$this->processo_preenc_nome->LinkCustomAttributes = "";
			$this->processo_preenc_nome->HrefValue = "";
			$this->processo_preenc_nome->TooltipValue = "";

			// processo_preenc_carg
			$this->processo_preenc_carg->LinkCustomAttributes = "";
			$this->processo_preenc_carg->HrefValue = "";
			$this->processo_preenc_carg->TooltipValue = "";

			// processo_preenc_end
			$this->processo_preenc_end->LinkCustomAttributes = "";
			$this->processo_preenc_end->HrefValue = "";
			$this->processo_preenc_end->TooltipValue = "";

			// processo_preenc_contato
			$this->processo_preenc_contato->LinkCustomAttributes = "";
			$this->processo_preenc_contato->HrefValue = "";
			$this->processo_preenc_contato->TooltipValue = "";

			// processo_preenc_indentifica
			$this->processo_preenc_indentifica->LinkCustomAttributes = "";
			$this->processo_preenc_indentifica->HrefValue = "";
			$this->processo_preenc_indentifica->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// processo_exercicio
			$this->processo_exercicio->EditAttrs["class"] = "form-control";
			$this->processo_exercicio->EditCustomAttributes = "";
			if (trim(strval($this->processo_exercicio->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`ano_ano`" . ew_SearchString("=", $this->processo_exercicio->CurrentValue, EW_DATATYPE_NUMBER, "");
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
			$this->processo_termo_num->EditValue = ew_HtmlEncode($this->processo_termo_num->CurrentValue);
			$this->processo_termo_num->PlaceHolder = ew_RemoveHtml($this->processo_termo_num->FldCaption());

			// processo_numero
			$this->processo_numero->EditAttrs["class"] = "form-control";
			$this->processo_numero->EditCustomAttributes = "";
			$this->processo_numero->EditValue = ew_HtmlEncode($this->processo_numero->CurrentValue);
			$this->processo_numero->PlaceHolder = ew_RemoveHtml($this->processo_numero->FldCaption());

			// processo_vigencia_ini
			$this->processo_vigencia_ini->EditAttrs["class"] = "form-control";
			$this->processo_vigencia_ini->EditCustomAttributes = "";
			$this->processo_vigencia_ini->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->processo_vigencia_ini->CurrentValue, 6));
			$this->processo_vigencia_ini->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_ini->FldCaption());

			// processo_vigencia_fim
			$this->processo_vigencia_fim->EditAttrs["class"] = "form-control";
			$this->processo_vigencia_fim->EditCustomAttributes = "";
			$this->processo_vigencia_fim->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->processo_vigencia_fim->CurrentValue, 7));
			$this->processo_vigencia_fim->PlaceHolder = ew_RemoveHtml($this->processo_vigencia_fim->FldCaption());

			// processo_data
			$this->processo_data->EditAttrs["class"] = "form-control";
			$this->processo_data->EditCustomAttributes = "";
			$this->processo_data->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->processo_data->CurrentValue, 7));
			$this->processo_data->PlaceHolder = ew_RemoveHtml($this->processo_data->FldCaption());

			// processo_valor
			$this->processo_valor->EditAttrs["class"] = "form-control";
			$this->processo_valor->EditCustomAttributes = "";
			$this->processo_valor->EditValue = ew_HtmlEncode($this->processo_valor->CurrentValue);
			$this->processo_valor->PlaceHolder = ew_RemoveHtml($this->processo_valor->FldCaption());
			if (strval($this->processo_valor->EditValue) <> "" && is_numeric($this->processo_valor->EditValue)) $this->processo_valor->EditValue = ew_FormatNumber($this->processo_valor->EditValue, -2, -1, -2, -2);

			// processo_objeto
			$this->processo_objeto->EditAttrs["class"] = "form-control";
			$this->processo_objeto->EditCustomAttributes = "";
			$this->processo_objeto->EditValue = ew_HtmlEncode($this->processo_objeto->CurrentValue);
			$this->processo_objeto->PlaceHolder = ew_RemoveHtml($this->processo_objeto->FldCaption());

			// processo_metas
			$this->processo_metas->EditAttrs["class"] = "form-control";
			$this->processo_metas->EditCustomAttributes = "";
			$this->processo_metas->EditValue = ew_HtmlEncode($this->processo_metas->CurrentValue);
			$this->processo_metas->PlaceHolder = ew_RemoveHtml($this->processo_metas->FldCaption());

			// processo_origem
			$this->processo_origem->EditAttrs["class"] = "form-control";
			$this->processo_origem->EditCustomAttributes = "";
			$this->processo_origem->EditValue = ew_HtmlEncode($this->processo_origem->CurrentValue);
			$this->processo_origem->PlaceHolder = ew_RemoveHtml($this->processo_origem->FldCaption());

			// processo_ent_endereco
			$this->processo_ent_endereco->EditAttrs["class"] = "form-control";
			$this->processo_ent_endereco->EditCustomAttributes = "";
			$this->processo_ent_endereco->EditValue = ew_HtmlEncode($this->processo_ent_endereco->CurrentValue);
			$this->processo_ent_endereco->PlaceHolder = ew_RemoveHtml($this->processo_ent_endereco->FldCaption());

			// processo_ent_estatuto
			$this->processo_ent_estatuto->EditAttrs["class"] = "form-control";
			$this->processo_ent_estatuto->EditCustomAttributes = "";
			if (!ew_Empty($this->processo_ent_estatuto->Upload->DbValue)) {
				$this->processo_ent_estatuto->EditValue = "rc25_a_termos_processo_ent_estatuto_bv.php?" . "processo_id=" . $this->processo_id->CurrentValue;
				$this->processo_ent_estatuto->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->processo_ent_estatuto->Upload->DbValue, 0, 11)));
			} else {
				$this->processo_ent_estatuto->EditValue = "";
			}
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->processo_ent_estatuto);

			// processo_ent_lei
			$this->processo_ent_lei->EditAttrs["class"] = "form-control";
			$this->processo_ent_lei->EditCustomAttributes = "";
			$this->processo_ent_lei->EditValue = ew_HtmlEncode($this->processo_ent_lei->CurrentValue);
			$this->processo_ent_lei->PlaceHolder = ew_RemoveHtml($this->processo_ent_lei->FldCaption());

			// processo_ent_cebas
			$this->processo_ent_cebas->EditAttrs["class"] = "form-control";
			$this->processo_ent_cebas->EditCustomAttributes = "";
			$this->processo_ent_cebas->EditValue = ew_HtmlEncode($this->processo_ent_cebas->CurrentValue);
			$this->processo_ent_cebas->PlaceHolder = ew_RemoveHtml($this->processo_ent_cebas->FldCaption());

			// processo_resp_nome
			$this->processo_resp_nome->EditAttrs["class"] = "form-control";
			$this->processo_resp_nome->EditCustomAttributes = "";
			$this->processo_resp_nome->EditValue = ew_HtmlEncode($this->processo_resp_nome->CurrentValue);
			$this->processo_resp_nome->PlaceHolder = ew_RemoveHtml($this->processo_resp_nome->FldCaption());

			// processo_resp_cargo
			$this->processo_resp_cargo->EditAttrs["class"] = "form-control";
			$this->processo_resp_cargo->EditCustomAttributes = "";
			$this->processo_resp_cargo->EditValue = ew_HtmlEncode($this->processo_resp_cargo->CurrentValue);
			$this->processo_resp_cargo->PlaceHolder = ew_RemoveHtml($this->processo_resp_cargo->FldCaption());

			// processo_resp_end
			$this->processo_resp_end->EditAttrs["class"] = "form-control";
			$this->processo_resp_end->EditCustomAttributes = "";
			$this->processo_resp_end->EditValue = ew_HtmlEncode($this->processo_resp_end->CurrentValue);
			$this->processo_resp_end->PlaceHolder = ew_RemoveHtml($this->processo_resp_end->FldCaption());

			// processo_resp_contato
			$this->processo_resp_contato->EditAttrs["class"] = "form-control";
			$this->processo_resp_contato->EditCustomAttributes = "";
			$this->processo_resp_contato->EditValue = ew_HtmlEncode($this->processo_resp_contato->CurrentValue);
			$this->processo_resp_contato->PlaceHolder = ew_RemoveHtml($this->processo_resp_contato->FldCaption());

			// processo_resp_ata
			$this->processo_resp_ata->EditAttrs["class"] = "form-control";
			$this->processo_resp_ata->EditCustomAttributes = "";
			$this->processo_resp_ata->EditValue = ew_HtmlEncode($this->processo_resp_ata->CurrentValue);
			$this->processo_resp_ata->PlaceHolder = ew_RemoveHtml($this->processo_resp_ata->FldCaption());

			// processo_cont_nome
			$this->processo_cont_nome->EditAttrs["class"] = "form-control";
			$this->processo_cont_nome->EditCustomAttributes = "";
			$this->processo_cont_nome->EditValue = ew_HtmlEncode($this->processo_cont_nome->CurrentValue);
			$this->processo_cont_nome->PlaceHolder = ew_RemoveHtml($this->processo_cont_nome->FldCaption());

			// processo_cont_end
			$this->processo_cont_end->EditAttrs["class"] = "form-control";
			$this->processo_cont_end->EditCustomAttributes = "";
			$this->processo_cont_end->EditValue = ew_HtmlEncode($this->processo_cont_end->CurrentValue);
			$this->processo_cont_end->PlaceHolder = ew_RemoveHtml($this->processo_cont_end->FldCaption());

			// processo_cont_contato
			$this->processo_cont_contato->EditAttrs["class"] = "form-control";
			$this->processo_cont_contato->EditCustomAttributes = "";
			$this->processo_cont_contato->EditValue = ew_HtmlEncode($this->processo_cont_contato->CurrentValue);
			$this->processo_cont_contato->PlaceHolder = ew_RemoveHtml($this->processo_cont_contato->FldCaption());

			// processo_cont_indent
			$this->processo_cont_indent->EditAttrs["class"] = "form-control";
			$this->processo_cont_indent->EditCustomAttributes = "";
			$this->processo_cont_indent->EditValue = ew_HtmlEncode($this->processo_cont_indent->CurrentValue);
			$this->processo_cont_indent->PlaceHolder = ew_RemoveHtml($this->processo_cont_indent->FldCaption());

			// processo_preenc_nome
			$this->processo_preenc_nome->EditAttrs["class"] = "form-control";
			$this->processo_preenc_nome->EditCustomAttributes = "";
			$this->processo_preenc_nome->EditValue = ew_HtmlEncode($this->processo_preenc_nome->CurrentValue);
			$this->processo_preenc_nome->PlaceHolder = ew_RemoveHtml($this->processo_preenc_nome->FldCaption());

			// processo_preenc_carg
			$this->processo_preenc_carg->EditAttrs["class"] = "form-control";
			$this->processo_preenc_carg->EditCustomAttributes = "";
			$this->processo_preenc_carg->EditValue = ew_HtmlEncode($this->processo_preenc_carg->CurrentValue);
			$this->processo_preenc_carg->PlaceHolder = ew_RemoveHtml($this->processo_preenc_carg->FldCaption());

			// processo_preenc_end
			$this->processo_preenc_end->EditAttrs["class"] = "form-control";
			$this->processo_preenc_end->EditCustomAttributes = "";
			$this->processo_preenc_end->EditValue = ew_HtmlEncode($this->processo_preenc_end->CurrentValue);
			$this->processo_preenc_end->PlaceHolder = ew_RemoveHtml($this->processo_preenc_end->FldCaption());

			// processo_preenc_contato
			$this->processo_preenc_contato->EditAttrs["class"] = "form-control";
			$this->processo_preenc_contato->EditCustomAttributes = "";
			$this->processo_preenc_contato->EditValue = ew_HtmlEncode($this->processo_preenc_contato->CurrentValue);
			$this->processo_preenc_contato->PlaceHolder = ew_RemoveHtml($this->processo_preenc_contato->FldCaption());

			// processo_preenc_indentifica
			$this->processo_preenc_indentifica->EditAttrs["class"] = "form-control";
			$this->processo_preenc_indentifica->EditCustomAttributes = "";
			$this->processo_preenc_indentifica->EditValue = ew_HtmlEncode($this->processo_preenc_indentifica->CurrentValue);
			$this->processo_preenc_indentifica->PlaceHolder = ew_RemoveHtml($this->processo_preenc_indentifica->FldCaption());

			// Add refer script
			// processo_exercicio

			$this->processo_exercicio->LinkCustomAttributes = "";
			$this->processo_exercicio->HrefValue = "";

			// processo_termo_num
			$this->processo_termo_num->LinkCustomAttributes = "";
			$this->processo_termo_num->HrefValue = "";

			// processo_numero
			$this->processo_numero->LinkCustomAttributes = "";
			$this->processo_numero->HrefValue = "";

			// processo_vigencia_ini
			$this->processo_vigencia_ini->LinkCustomAttributes = "";
			$this->processo_vigencia_ini->HrefValue = "";

			// processo_vigencia_fim
			$this->processo_vigencia_fim->LinkCustomAttributes = "";
			$this->processo_vigencia_fim->HrefValue = "";

			// processo_data
			$this->processo_data->LinkCustomAttributes = "";
			$this->processo_data->HrefValue = "";

			// processo_valor
			$this->processo_valor->LinkCustomAttributes = "";
			$this->processo_valor->HrefValue = "";

			// processo_objeto
			$this->processo_objeto->LinkCustomAttributes = "";
			$this->processo_objeto->HrefValue = "";

			// processo_metas
			$this->processo_metas->LinkCustomAttributes = "";
			$this->processo_metas->HrefValue = "";

			// processo_origem
			$this->processo_origem->LinkCustomAttributes = "";
			$this->processo_origem->HrefValue = "";

			// processo_ent_endereco
			$this->processo_ent_endereco->LinkCustomAttributes = "";
			$this->processo_ent_endereco->HrefValue = "";

			// processo_ent_estatuto
			$this->processo_ent_estatuto->LinkCustomAttributes = "";
			if (!empty($this->processo_ent_estatuto->Upload->DbValue)) {
				$this->processo_ent_estatuto->HrefValue = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;
				$this->processo_ent_estatuto->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->processo_ent_estatuto->HrefValue = ew_FullUrl($this->processo_ent_estatuto->HrefValue, "href");
			} else {
				$this->processo_ent_estatuto->HrefValue = "";
			}
			$this->processo_ent_estatuto->HrefValue2 = "rc25_a_termos_processo_ent_estatuto_bv.php?processo_id=" . $this->processo_id->CurrentValue;

			// processo_ent_lei
			$this->processo_ent_lei->LinkCustomAttributes = "";
			$this->processo_ent_lei->HrefValue = "";

			// processo_ent_cebas
			$this->processo_ent_cebas->LinkCustomAttributes = "";
			$this->processo_ent_cebas->HrefValue = "";

			// processo_resp_nome
			$this->processo_resp_nome->LinkCustomAttributes = "";
			$this->processo_resp_nome->HrefValue = "";

			// processo_resp_cargo
			$this->processo_resp_cargo->LinkCustomAttributes = "";
			$this->processo_resp_cargo->HrefValue = "";

			// processo_resp_end
			$this->processo_resp_end->LinkCustomAttributes = "";
			$this->processo_resp_end->HrefValue = "";

			// processo_resp_contato
			$this->processo_resp_contato->LinkCustomAttributes = "";
			$this->processo_resp_contato->HrefValue = "";

			// processo_resp_ata
			$this->processo_resp_ata->LinkCustomAttributes = "";
			$this->processo_resp_ata->HrefValue = "";

			// processo_cont_nome
			$this->processo_cont_nome->LinkCustomAttributes = "";
			$this->processo_cont_nome->HrefValue = "";

			// processo_cont_end
			$this->processo_cont_end->LinkCustomAttributes = "";
			$this->processo_cont_end->HrefValue = "";

			// processo_cont_contato
			$this->processo_cont_contato->LinkCustomAttributes = "";
			$this->processo_cont_contato->HrefValue = "";

			// processo_cont_indent
			$this->processo_cont_indent->LinkCustomAttributes = "";
			$this->processo_cont_indent->HrefValue = "";

			// processo_preenc_nome
			$this->processo_preenc_nome->LinkCustomAttributes = "";
			$this->processo_preenc_nome->HrefValue = "";

			// processo_preenc_carg
			$this->processo_preenc_carg->LinkCustomAttributes = "";
			$this->processo_preenc_carg->HrefValue = "";

			// processo_preenc_end
			$this->processo_preenc_end->LinkCustomAttributes = "";
			$this->processo_preenc_end->HrefValue = "";

			// processo_preenc_contato
			$this->processo_preenc_contato->LinkCustomAttributes = "";
			$this->processo_preenc_contato->HrefValue = "";

			// processo_preenc_indentifica
			$this->processo_preenc_indentifica->LinkCustomAttributes = "";
			$this->processo_preenc_indentifica->HrefValue = "";
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

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->processo_exercicio->FldIsDetailKey && !is_null($this->processo_exercicio->FormValue) && $this->processo_exercicio->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->processo_exercicio->FldCaption(), $this->processo_exercicio->ReqErrMsg));
		}
		if (!$this->processo_termo_num->FldIsDetailKey && !is_null($this->processo_termo_num->FormValue) && $this->processo_termo_num->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->processo_termo_num->FldCaption(), $this->processo_termo_num->ReqErrMsg));
		}
		if (!$this->processo_numero->FldIsDetailKey && !is_null($this->processo_numero->FormValue) && $this->processo_numero->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->processo_numero->FldCaption(), $this->processo_numero->ReqErrMsg));
		}
		if (!ew_CheckUSDate($this->processo_vigencia_ini->FormValue)) {
			ew_AddMessage($gsFormError, $this->processo_vigencia_ini->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->processo_vigencia_fim->FormValue)) {
			ew_AddMessage($gsFormError, $this->processo_vigencia_fim->FldErrMsg());
		}
		if (!ew_CheckEuroDate($this->processo_data->FormValue)) {
			ew_AddMessage($gsFormError, $this->processo_data->FldErrMsg());
		}
		if (!ew_CheckNumber($this->processo_valor->FormValue)) {
			ew_AddMessage($gsFormError, $this->processo_valor->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("rc25_a_repasses", $DetailTblVar) && $GLOBALS["rc25_a_repasses"]->DetailAdd) {
			if (!isset($GLOBALS["rc25_a_repasses_grid"])) $GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid(); // get detail page object
			$GLOBALS["rc25_a_repasses_grid"]->ValidateGridForm();
		}
		if (in_array("rc25_a_planos_aplicacao", $DetailTblVar) && $GLOBALS["rc25_a_planos_aplicacao"]->DetailAdd) {
			if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"])) $GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid(); // get detail page object
			$GLOBALS["rc25_a_planos_aplicacao_grid"]->ValidateGridForm();
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// processo_exercicio
		$this->processo_exercicio->SetDbValueDef($rsnew, $this->processo_exercicio->CurrentValue, NULL, FALSE);

		// processo_termo_num
		$this->processo_termo_num->SetDbValueDef($rsnew, $this->processo_termo_num->CurrentValue, "", FALSE);

		// processo_numero
		$this->processo_numero->SetDbValueDef($rsnew, $this->processo_numero->CurrentValue, "", FALSE);

		// processo_vigencia_ini
		$this->processo_vigencia_ini->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->processo_vigencia_ini->CurrentValue, 6), NULL, FALSE);

		// processo_vigencia_fim
		$this->processo_vigencia_fim->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->processo_vigencia_fim->CurrentValue, 7), NULL, FALSE);

		// processo_data
		$this->processo_data->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->processo_data->CurrentValue, 7), NULL, FALSE);

		// processo_valor
		$this->processo_valor->SetDbValueDef($rsnew, $this->processo_valor->CurrentValue, NULL, FALSE);

		// processo_objeto
		$this->processo_objeto->SetDbValueDef($rsnew, $this->processo_objeto->CurrentValue, NULL, FALSE);

		// processo_metas
		$this->processo_metas->SetDbValueDef($rsnew, $this->processo_metas->CurrentValue, NULL, FALSE);

		// processo_origem
		$this->processo_origem->SetDbValueDef($rsnew, $this->processo_origem->CurrentValue, NULL, FALSE);

		// processo_ent_endereco
		$this->processo_ent_endereco->SetDbValueDef($rsnew, $this->processo_ent_endereco->CurrentValue, NULL, FALSE);

		// processo_ent_estatuto
		if ($this->processo_ent_estatuto->Visible && !$this->processo_ent_estatuto->Upload->KeepFile) {
			if (is_null($this->processo_ent_estatuto->Upload->Value)) {
				$rsnew['processo_ent_estatuto'] = NULL;
			} else {
				$rsnew['processo_ent_estatuto'] = $this->processo_ent_estatuto->Upload->Value;
			}
		}

		// processo_ent_lei
		$this->processo_ent_lei->SetDbValueDef($rsnew, $this->processo_ent_lei->CurrentValue, NULL, FALSE);

		// processo_ent_cebas
		$this->processo_ent_cebas->SetDbValueDef($rsnew, $this->processo_ent_cebas->CurrentValue, NULL, FALSE);

		// processo_resp_nome
		$this->processo_resp_nome->SetDbValueDef($rsnew, $this->processo_resp_nome->CurrentValue, NULL, FALSE);

		// processo_resp_cargo
		$this->processo_resp_cargo->SetDbValueDef($rsnew, $this->processo_resp_cargo->CurrentValue, NULL, FALSE);

		// processo_resp_end
		$this->processo_resp_end->SetDbValueDef($rsnew, $this->processo_resp_end->CurrentValue, NULL, FALSE);

		// processo_resp_contato
		$this->processo_resp_contato->SetDbValueDef($rsnew, $this->processo_resp_contato->CurrentValue, NULL, FALSE);

		// processo_resp_ata
		$this->processo_resp_ata->SetDbValueDef($rsnew, $this->processo_resp_ata->CurrentValue, NULL, FALSE);

		// processo_cont_nome
		$this->processo_cont_nome->SetDbValueDef($rsnew, $this->processo_cont_nome->CurrentValue, NULL, FALSE);

		// processo_cont_end
		$this->processo_cont_end->SetDbValueDef($rsnew, $this->processo_cont_end->CurrentValue, NULL, FALSE);

		// processo_cont_contato
		$this->processo_cont_contato->SetDbValueDef($rsnew, $this->processo_cont_contato->CurrentValue, NULL, FALSE);

		// processo_cont_indent
		$this->processo_cont_indent->SetDbValueDef($rsnew, $this->processo_cont_indent->CurrentValue, NULL, FALSE);

		// processo_preenc_nome
		$this->processo_preenc_nome->SetDbValueDef($rsnew, $this->processo_preenc_nome->CurrentValue, NULL, FALSE);

		// processo_preenc_carg
		$this->processo_preenc_carg->SetDbValueDef($rsnew, $this->processo_preenc_carg->CurrentValue, NULL, FALSE);

		// processo_preenc_end
		$this->processo_preenc_end->SetDbValueDef($rsnew, $this->processo_preenc_end->CurrentValue, NULL, FALSE);

		// processo_preenc_contato
		$this->processo_preenc_contato->SetDbValueDef($rsnew, $this->processo_preenc_contato->CurrentValue, NULL, FALSE);

		// processo_preenc_indentifica
		$this->processo_preenc_indentifica->SetDbValueDef($rsnew, $this->processo_preenc_indentifica->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("rc25_a_repasses", $DetailTblVar) && $GLOBALS["rc25_a_repasses"]->DetailAdd) {
				$GLOBALS["rc25_a_repasses"]->repasse_id_termos->setSessionValue($this->processo_id->CurrentValue); // Set master key
				if (!isset($GLOBALS["rc25_a_repasses_grid"])) $GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid(); // Get detail page object
				$AddRow = $GLOBALS["rc25_a_repasses_grid"]->GridInsert();
				if (!$AddRow)
					$GLOBALS["rc25_a_repasses"]->repasse_id_termos->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("rc25_a_planos_aplicacao", $DetailTblVar) && $GLOBALS["rc25_a_planos_aplicacao"]->DetailAdd) {
				$GLOBALS["rc25_a_planos_aplicacao"]->plano_exercicio->setSessionValue($this->processo_exercicio->CurrentValue); // Set master key
				if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"])) $GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid(); // Get detail page object
				$AddRow = $GLOBALS["rc25_a_planos_aplicacao_grid"]->GridInsert();
				if (!$AddRow)
					$GLOBALS["rc25_a_planos_aplicacao"]->plano_exercicio->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// processo_ent_estatuto
		ew_CleanUploadTempPath($this->processo_ent_estatuto, $this->processo_ent_estatuto->Upload->Index);
		return $AddRow;
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("rc25_a_repasses", $DetailTblVar)) {
				if (!isset($GLOBALS["rc25_a_repasses_grid"]))
					$GLOBALS["rc25_a_repasses_grid"] = new crc25_a_repasses_grid;
				if ($GLOBALS["rc25_a_repasses_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["rc25_a_repasses_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["rc25_a_repasses_grid"]->CurrentMode = "add";
					$GLOBALS["rc25_a_repasses_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["rc25_a_repasses_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["rc25_a_repasses_grid"]->setStartRecordNumber(1);
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->FldIsDetailKey = TRUE;
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->CurrentValue = $this->processo_id->CurrentValue;
					$GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->setSessionValue($GLOBALS["rc25_a_repasses_grid"]->repasse_id_termos->CurrentValue);
				}
			}
			if (in_array("rc25_a_planos_aplicacao", $DetailTblVar)) {
				if (!isset($GLOBALS["rc25_a_planos_aplicacao_grid"]))
					$GLOBALS["rc25_a_planos_aplicacao_grid"] = new crc25_a_planos_aplicacao_grid;
				if ($GLOBALS["rc25_a_planos_aplicacao_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["rc25_a_planos_aplicacao_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["rc25_a_planos_aplicacao_grid"]->CurrentMode = "add";
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->setStartRecordNumber(1);
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->FldIsDetailKey = TRUE;
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->CurrentValue = $this->processo_exercicio->CurrentValue;
					$GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->setSessionValue($GLOBALS["rc25_a_planos_aplicacao_grid"]->plano_exercicio->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rc25_a_termoslist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "pills";
		$pages->Add(0);
		$pages->Add(1);
		$pages->Add(2);
		$pages->Add(3);
		$pages->Add(4);
		$pages->Add(5);
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
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
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_termos_add)) $rc25_a_termos_add = new crc25_a_termos_add();

// Page init
$rc25_a_termos_add->Page_Init();

// Page main
$rc25_a_termos_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_termos_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = frc25_a_termosadd = new ew_Form("frc25_a_termosadd", "add");

// Validate form
frc25_a_termosadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_processo_exercicio");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_termos->processo_exercicio->FldCaption(), $rc25_a_termos->processo_exercicio->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_processo_termo_num");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_termos->processo_termo_num->FldCaption(), $rc25_a_termos->processo_termo_num->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_processo_numero");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_termos->processo_numero->FldCaption(), $rc25_a_termos->processo_numero->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_processo_vigencia_ini");
			if (elm && !ew_CheckUSDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_termos->processo_vigencia_ini->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_processo_vigencia_fim");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_termos->processo_vigencia_fim->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_processo_data");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_termos->processo_data->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_processo_valor");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_termos->processo_valor->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
frc25_a_termosadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_termosadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
frc25_a_termosadd.MultiPage = new ew_MultiPage("frc25_a_termosadd");

// Dynamic selection lists
frc25_a_termosadd.Lists["x_processo_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_termosadd.Lists["x_processo_exercicio"].Data = "<?php echo $rc25_a_termos_add->processo_exercicio->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $rc25_a_termos_add->ShowPageHeader(); ?>
<?php
$rc25_a_termos_add->ShowMessage();
?>
<form name="frc25_a_termosadd" id="frc25_a_termosadd" class="<?php echo $rc25_a_termos_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rc25_a_termos_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rc25_a_termos_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rc25_a_termos">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($rc25_a_termos_add->IsModal) ?>">
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="rc25_a_termos_add"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $rc25_a_termos_add->MultiPages->NavStyle() ?>">
		<li<?php echo $rc25_a_termos_add->MultiPages->TabStyle("1") ?>><a href="#tab_rc25_a_termos1" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(1) ?></a></li>
		<li<?php echo $rc25_a_termos_add->MultiPages->TabStyle("2") ?>><a href="#tab_rc25_a_termos2" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(2) ?></a></li>
		<li<?php echo $rc25_a_termos_add->MultiPages->TabStyle("3") ?>><a href="#tab_rc25_a_termos3" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(3) ?></a></li>
		<li<?php echo $rc25_a_termos_add->MultiPages->TabStyle("4") ?>><a href="#tab_rc25_a_termos4" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(4) ?></a></li>
		<li<?php echo $rc25_a_termos_add->MultiPages->TabStyle("5") ?>><a href="#tab_rc25_a_termos5" data-toggle="tab"><?php echo $rc25_a_termos->PageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $rc25_a_termos_add->MultiPages->PageStyle("1") ?>" id="tab_rc25_a_termos1"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
	<div id="r_processo_exercicio" class="form-group">
		<label id="elh_rc25_a_termos_processo_exercicio" for="x_processo_exercicio" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_exercicio">
<select data-table="rc25_a_termos" data-field="x_processo_exercicio" data-page="1" data-value-separator="<?php echo $rc25_a_termos->processo_exercicio->DisplayValueSeparatorAttribute() ?>" id="x_processo_exercicio" name="x_processo_exercicio"<?php echo $rc25_a_termos->processo_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->SelectOptionListHtml("x_processo_exercicio") ?>
</select>
</span>
<?php echo $rc25_a_termos->processo_exercicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
	<div id="r_processo_termo_num" class="form-group">
		<label id="elh_rc25_a_termos_processo_termo_num" for="x_processo_termo_num" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_termo_num->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_termo_num">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_termo_num" data-page="1" name="x_processo_termo_num" id="x_processo_termo_num" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_termo_num->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_termo_num->EditValue ?>"<?php echo $rc25_a_termos->processo_termo_num->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_termo_num->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
	<div id="r_processo_numero" class="form-group">
		<label id="elh_rc25_a_termos_processo_numero" for="x_processo_numero" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_numero->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_numero">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_numero" data-page="1" name="x_processo_numero" id="x_processo_numero" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_numero->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_numero->EditValue ?>"<?php echo $rc25_a_termos->processo_numero->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
	<div id="r_processo_vigencia_ini" class="form-group">
		<label id="elh_rc25_a_termos_processo_vigencia_ini" for="x_processo_vigencia_ini" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_vigencia_ini->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_ini">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_vigencia_ini" data-page="1" data-format="6" name="x_processo_vigencia_ini" id="x_processo_vigencia_ini" size="15" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_vigencia_ini->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_vigencia_ini->EditValue ?>"<?php echo $rc25_a_termos->processo_vigencia_ini->EditAttributes() ?>>
<?php if (!$rc25_a_termos->processo_vigencia_ini->ReadOnly && !$rc25_a_termos->processo_vigencia_ini->Disabled && !isset($rc25_a_termos->processo_vigencia_ini->EditAttrs["readonly"]) && !isset($rc25_a_termos->processo_vigencia_ini->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_a_termosadd", "x_processo_vigencia_ini", {"ignoreReadonly":true,"useCurrent":false,"format":6});
</script>
<?php } ?>
</span>
<?php echo $rc25_a_termos->processo_vigencia_ini->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
	<div id="r_processo_vigencia_fim" class="form-group">
		<label id="elh_rc25_a_termos_processo_vigencia_fim" for="x_processo_vigencia_fim" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_vigencia_fim->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_fim">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_vigencia_fim" data-page="1" data-format="7" name="x_processo_vigencia_fim" id="x_processo_vigencia_fim" size="15" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_vigencia_fim->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_vigencia_fim->EditValue ?>"<?php echo $rc25_a_termos->processo_vigencia_fim->EditAttributes() ?>>
<?php if (!$rc25_a_termos->processo_vigencia_fim->ReadOnly && !$rc25_a_termos->processo_vigencia_fim->Disabled && !isset($rc25_a_termos->processo_vigencia_fim->EditAttrs["readonly"]) && !isset($rc25_a_termos->processo_vigencia_fim->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_a_termosadd", "x_processo_vigencia_fim", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $rc25_a_termos->processo_vigencia_fim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_data->Visible) { // processo_data ?>
	<div id="r_processo_data" class="form-group">
		<label id="elh_rc25_a_termos_processo_data" for="x_processo_data" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_data->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_data->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_data">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_data" data-page="1" data-format="7" name="x_processo_data" id="x_processo_data" size="15" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_data->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_data->EditValue ?>"<?php echo $rc25_a_termos->processo_data->EditAttributes() ?>>
<?php if (!$rc25_a_termos->processo_data->ReadOnly && !$rc25_a_termos->processo_data->Disabled && !isset($rc25_a_termos->processo_data->EditAttrs["readonly"]) && !isset($rc25_a_termos->processo_data->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("frc25_a_termosadd", "x_processo_data", {"ignoreReadonly":true,"useCurrent":false,"format":7});
</script>
<?php } ?>
</span>
<?php echo $rc25_a_termos->processo_data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_valor->Visible) { // processo_valor ?>
	<div id="r_processo_valor" class="form-group">
		<label id="elh_rc25_a_termos_processo_valor" for="x_processo_valor" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_valor->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_valor->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_valor">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_valor" data-page="1" name="x_processo_valor" id="x_processo_valor" size="15" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_valor->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_valor->EditValue ?>"<?php echo $rc25_a_termos->processo_valor->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_objeto->Visible) { // processo_objeto ?>
	<div id="r_processo_objeto" class="form-group">
		<label id="elh_rc25_a_termos_processo_objeto" for="x_processo_objeto" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_objeto->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_objeto->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_objeto">
<textarea data-table="rc25_a_termos" data-field="x_processo_objeto" data-page="1" name="x_processo_objeto" id="x_processo_objeto" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_objeto->getPlaceHolder()) ?>"<?php echo $rc25_a_termos->processo_objeto->EditAttributes() ?>><?php echo $rc25_a_termos->processo_objeto->EditValue ?></textarea>
</span>
<?php echo $rc25_a_termos->processo_objeto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_metas->Visible) { // processo_metas ?>
	<div id="r_processo_metas" class="form-group">
		<label id="elh_rc25_a_termos_processo_metas" for="x_processo_metas" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_metas->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_metas->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_metas">
<textarea data-table="rc25_a_termos" data-field="x_processo_metas" data-page="1" name="x_processo_metas" id="x_processo_metas" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_metas->getPlaceHolder()) ?>"<?php echo $rc25_a_termos->processo_metas->EditAttributes() ?>><?php echo $rc25_a_termos->processo_metas->EditValue ?></textarea>
</span>
<?php echo $rc25_a_termos->processo_metas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_origem->Visible) { // processo_origem ?>
	<div id="r_processo_origem" class="form-group">
		<label id="elh_rc25_a_termos_processo_origem" for="x_processo_origem" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_origem->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_origem->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_origem">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_origem" data-page="1" name="x_processo_origem" id="x_processo_origem" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_origem->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_origem->EditValue ?>"<?php echo $rc25_a_termos->processo_origem->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_origem->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rc25_a_termos_add->MultiPages->PageStyle("2") ?>" id="tab_rc25_a_termos2"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_termos->processo_ent_endereco->Visible) { // processo_ent_endereco ?>
	<div id="r_processo_ent_endereco" class="form-group">
		<label id="elh_rc25_a_termos_processo_ent_endereco" for="x_processo_ent_endereco" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_ent_endereco->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_ent_endereco->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_endereco">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_ent_endereco" data-page="2" name="x_processo_ent_endereco" id="x_processo_ent_endereco" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_ent_endereco->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_ent_endereco->EditValue ?>"<?php echo $rc25_a_termos->processo_ent_endereco->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_ent_endereco->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_estatuto->Visible) { // processo_ent_estatuto ?>
	<div id="r_processo_ent_estatuto" class="form-group">
		<label id="elh_rc25_a_termos_processo_ent_estatuto" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_ent_estatuto->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_ent_estatuto->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_estatuto">
<div id="fd_x_processo_ent_estatuto">
<span title="<?php echo $rc25_a_termos->processo_ent_estatuto->FldTitle() ? $rc25_a_termos->processo_ent_estatuto->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($rc25_a_termos->processo_ent_estatuto->ReadOnly || $rc25_a_termos->processo_ent_estatuto->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="rc25_a_termos" data-field="x_processo_ent_estatuto" data-page="2" name="x_processo_ent_estatuto" id="x_processo_ent_estatuto"<?php echo $rc25_a_termos->processo_ent_estatuto->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_processo_ent_estatuto" id= "fn_x_processo_ent_estatuto" value="<?php echo $rc25_a_termos->processo_ent_estatuto->Upload->FileName ?>">
<input type="hidden" name="fa_x_processo_ent_estatuto" id= "fa_x_processo_ent_estatuto" value="0">
<input type="hidden" name="fs_x_processo_ent_estatuto" id= "fs_x_processo_ent_estatuto" value="0">
<input type="hidden" name="fx_x_processo_ent_estatuto" id= "fx_x_processo_ent_estatuto" value="<?php echo $rc25_a_termos->processo_ent_estatuto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_processo_ent_estatuto" id= "fm_x_processo_ent_estatuto" value="<?php echo $rc25_a_termos->processo_ent_estatuto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_processo_ent_estatuto" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $rc25_a_termos->processo_ent_estatuto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_lei->Visible) { // processo_ent_lei ?>
	<div id="r_processo_ent_lei" class="form-group">
		<label id="elh_rc25_a_termos_processo_ent_lei" for="x_processo_ent_lei" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_ent_lei->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_ent_lei->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_lei">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_ent_lei" data-page="2" name="x_processo_ent_lei" id="x_processo_ent_lei" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_ent_lei->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_ent_lei->EditValue ?>"<?php echo $rc25_a_termos->processo_ent_lei->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_ent_lei->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_ent_cebas->Visible) { // processo_ent_cebas ?>
	<div id="r_processo_ent_cebas" class="form-group">
		<label id="elh_rc25_a_termos_processo_ent_cebas" for="x_processo_ent_cebas" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_ent_cebas->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_ent_cebas->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_ent_cebas">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_ent_cebas" data-page="2" name="x_processo_ent_cebas" id="x_processo_ent_cebas" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_ent_cebas->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_ent_cebas->EditValue ?>"<?php echo $rc25_a_termos->processo_ent_cebas->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_ent_cebas->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rc25_a_termos_add->MultiPages->PageStyle("3") ?>" id="tab_rc25_a_termos3"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_termos->processo_resp_nome->Visible) { // processo_resp_nome ?>
	<div id="r_processo_resp_nome" class="form-group">
		<label id="elh_rc25_a_termos_processo_resp_nome" for="x_processo_resp_nome" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_resp_nome->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_resp_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_nome">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_resp_nome" data-page="3" name="x_processo_resp_nome" id="x_processo_resp_nome" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_resp_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_resp_nome->EditValue ?>"<?php echo $rc25_a_termos->processo_resp_nome->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_resp_nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_cargo->Visible) { // processo_resp_cargo ?>
	<div id="r_processo_resp_cargo" class="form-group">
		<label id="elh_rc25_a_termos_processo_resp_cargo" for="x_processo_resp_cargo" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_resp_cargo->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_resp_cargo->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_cargo">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_resp_cargo" data-page="3" name="x_processo_resp_cargo" id="x_processo_resp_cargo" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_resp_cargo->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_resp_cargo->EditValue ?>"<?php echo $rc25_a_termos->processo_resp_cargo->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_resp_cargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_end->Visible) { // processo_resp_end ?>
	<div id="r_processo_resp_end" class="form-group">
		<label id="elh_rc25_a_termos_processo_resp_end" for="x_processo_resp_end" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_resp_end->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_resp_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_end">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_resp_end" data-page="3" name="x_processo_resp_end" id="x_processo_resp_end" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_resp_end->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_resp_end->EditValue ?>"<?php echo $rc25_a_termos->processo_resp_end->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_resp_end->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_contato->Visible) { // processo_resp_contato ?>
	<div id="r_processo_resp_contato" class="form-group">
		<label id="elh_rc25_a_termos_processo_resp_contato" for="x_processo_resp_contato" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_resp_contato->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_resp_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_contato">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_resp_contato" data-page="3" name="x_processo_resp_contato" id="x_processo_resp_contato" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_resp_contato->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_resp_contato->EditValue ?>"<?php echo $rc25_a_termos->processo_resp_contato->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_resp_contato->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_resp_ata->Visible) { // processo_resp_ata ?>
	<div id="r_processo_resp_ata" class="form-group">
		<label id="elh_rc25_a_termos_processo_resp_ata" for="x_processo_resp_ata" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_resp_ata->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_resp_ata->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_resp_ata">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_resp_ata" data-page="3" name="x_processo_resp_ata" id="x_processo_resp_ata" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_resp_ata->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_resp_ata->EditValue ?>"<?php echo $rc25_a_termos->processo_resp_ata->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_resp_ata->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rc25_a_termos_add->MultiPages->PageStyle("4") ?>" id="tab_rc25_a_termos4"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_termos->processo_cont_nome->Visible) { // processo_cont_nome ?>
	<div id="r_processo_cont_nome" class="form-group">
		<label id="elh_rc25_a_termos_processo_cont_nome" for="x_processo_cont_nome" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_cont_nome->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_cont_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_nome">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_cont_nome" data-page="4" name="x_processo_cont_nome" id="x_processo_cont_nome" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_cont_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_cont_nome->EditValue ?>"<?php echo $rc25_a_termos->processo_cont_nome->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_cont_nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_end->Visible) { // processo_cont_end ?>
	<div id="r_processo_cont_end" class="form-group">
		<label id="elh_rc25_a_termos_processo_cont_end" for="x_processo_cont_end" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_cont_end->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_cont_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_end">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_cont_end" data-page="4" name="x_processo_cont_end" id="x_processo_cont_end" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_cont_end->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_cont_end->EditValue ?>"<?php echo $rc25_a_termos->processo_cont_end->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_cont_end->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_contato->Visible) { // processo_cont_contato ?>
	<div id="r_processo_cont_contato" class="form-group">
		<label id="elh_rc25_a_termos_processo_cont_contato" for="x_processo_cont_contato" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_cont_contato->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_cont_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_contato">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_cont_contato" data-page="4" name="x_processo_cont_contato" id="x_processo_cont_contato" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_cont_contato->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_cont_contato->EditValue ?>"<?php echo $rc25_a_termos->processo_cont_contato->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_cont_contato->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_cont_indent->Visible) { // processo_cont_indent ?>
	<div id="r_processo_cont_indent" class="form-group">
		<label id="elh_rc25_a_termos_processo_cont_indent" for="x_processo_cont_indent" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_cont_indent->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_cont_indent->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_cont_indent">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_cont_indent" data-page="4" name="x_processo_cont_indent" id="x_processo_cont_indent" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_cont_indent->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_cont_indent->EditValue ?>"<?php echo $rc25_a_termos->processo_cont_indent->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_cont_indent->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $rc25_a_termos_add->MultiPages->PageStyle("5") ?>" id="tab_rc25_a_termos5"><!-- multi-page .tab-pane -->
<div class="ewAddDiv"><!-- page* -->
<?php if ($rc25_a_termos->processo_preenc_nome->Visible) { // processo_preenc_nome ?>
	<div id="r_processo_preenc_nome" class="form-group">
		<label id="elh_rc25_a_termos_processo_preenc_nome" for="x_processo_preenc_nome" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_preenc_nome->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_preenc_nome->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_nome">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_preenc_nome" data-page="5" name="x_processo_preenc_nome" id="x_processo_preenc_nome" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_preenc_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_preenc_nome->EditValue ?>"<?php echo $rc25_a_termos->processo_preenc_nome->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_preenc_nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_carg->Visible) { // processo_preenc_carg ?>
	<div id="r_processo_preenc_carg" class="form-group">
		<label id="elh_rc25_a_termos_processo_preenc_carg" for="x_processo_preenc_carg" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_preenc_carg->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_preenc_carg->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_carg">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_preenc_carg" data-page="5" name="x_processo_preenc_carg" id="x_processo_preenc_carg" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_preenc_carg->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_preenc_carg->EditValue ?>"<?php echo $rc25_a_termos->processo_preenc_carg->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_preenc_carg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_end->Visible) { // processo_preenc_end ?>
	<div id="r_processo_preenc_end" class="form-group">
		<label id="elh_rc25_a_termos_processo_preenc_end" for="x_processo_preenc_end" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_preenc_end->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_preenc_end->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_end">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_preenc_end" data-page="5" name="x_processo_preenc_end" id="x_processo_preenc_end" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_preenc_end->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_preenc_end->EditValue ?>"<?php echo $rc25_a_termos->processo_preenc_end->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_preenc_end->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_contato->Visible) { // processo_preenc_contato ?>
	<div id="r_processo_preenc_contato" class="form-group">
		<label id="elh_rc25_a_termos_processo_preenc_contato" for="x_processo_preenc_contato" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_preenc_contato->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_preenc_contato->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_contato">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_preenc_contato" data-page="5" name="x_processo_preenc_contato" id="x_processo_preenc_contato" size="30" maxlength="80" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_preenc_contato->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_preenc_contato->EditValue ?>"<?php echo $rc25_a_termos->processo_preenc_contato->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_preenc_contato->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rc25_a_termos->processo_preenc_indentifica->Visible) { // processo_preenc_indentifica ?>
	<div id="r_processo_preenc_indentifica" class="form-group">
		<label id="elh_rc25_a_termos_processo_preenc_indentifica" for="x_processo_preenc_indentifica" class="<?php echo $rc25_a_termos_add->LeftColumnClass ?>"><?php echo $rc25_a_termos->processo_preenc_indentifica->FldCaption() ?></label>
		<div class="<?php echo $rc25_a_termos_add->RightColumnClass ?>"><div<?php echo $rc25_a_termos->processo_preenc_indentifica->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_preenc_indentifica">
<input type="text" data-table="rc25_a_termos" data-field="x_processo_preenc_indentifica" data-page="5" name="x_processo_preenc_indentifica" id="x_processo_preenc_indentifica" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_termos->processo_preenc_indentifica->getPlaceHolder()) ?>" value="<?php echo $rc25_a_termos->processo_preenc_indentifica->EditValue ?>"<?php echo $rc25_a_termos->processo_preenc_indentifica->EditAttributes() ?>>
</span>
<?php echo $rc25_a_termos->processo_preenc_indentifica->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<?php
	if (in_array("rc25_a_repasses", explode(",", $rc25_a_termos->getCurrentDetailTable())) && $rc25_a_repasses->DetailAdd) {
?>
<?php if ($rc25_a_termos->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("rc25_a_repasses", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rc25_a_repassesgrid.php" ?>
<?php } ?>
<?php
	if (in_array("rc25_a_planos_aplicacao", explode(",", $rc25_a_termos->getCurrentDetailTable())) && $rc25_a_planos_aplicacao->DetailAdd) {
?>
<?php if ($rc25_a_termos->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("rc25_a_planos_aplicacao", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "rc25_a_planos_aplicacaogrid.php" ?>
<?php } ?>
<?php if (!$rc25_a_termos_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $rc25_a_termos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rc25_a_termos_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
frc25_a_termosadd.Init();
</script>
<?php
$rc25_a_termos_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rc25_a_termos_add->Page_Terminate();
?>
