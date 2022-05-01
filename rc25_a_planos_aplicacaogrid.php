<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_planos_aplicacao_grid)) $rc25_a_planos_aplicacao_grid = new crc25_a_planos_aplicacao_grid();

// Page init
$rc25_a_planos_aplicacao_grid->Page_Init();

// Page main
$rc25_a_planos_aplicacao_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_planos_aplicacao_grid->Page_Render();
?>
<?php if ($rc25_a_planos_aplicacao->Export == "") { ?>
<script type="text/javascript">

// Form object
var frc25_a_planos_aplicacaogrid = new ew_Form("frc25_a_planos_aplicacaogrid", "grid");
frc25_a_planos_aplicacaogrid.FormKeyCountName = '<?php echo $rc25_a_planos_aplicacao_grid->FormKeyCountName ?>';

// Validate form
frc25_a_planos_aplicacaogrid.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_plano_exercicio");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_planos_aplicacao->plano_exercicio->FldCaption(), $rc25_a_planos_aplicacao->plano_exercicio->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_plano_custo_mensal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_custo_mensal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_custo_exercicio");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_custo_exercicio->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_recurso_municipal");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_recurso_municipal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_plano_outros_recursos");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_planos_aplicacao->plano_outros_recursos->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
frc25_a_planos_aplicacaogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "plano_exercicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plano_despesa", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plano_custo_mensal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plano_custo_exercicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plano_recurso_municipal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plano_outros_recursos", false)) return false;
	return true;
}

// Form_CustomValidate event
frc25_a_planos_aplicacaogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_aplicacaogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_planos_aplicacaogrid.Lists["x_plano_exercicio"] = {"LinkField":"x_ano_ano","Ajax":true,"AutoFill":false,"DisplayFields":["x_ano_ano","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_ano_vigente"};
frc25_a_planos_aplicacaogrid.Lists["x_plano_exercicio"].Data = "<?php echo $rc25_a_planos_aplicacao_grid->plano_exercicio->LookupFilterQuery(FALSE, "grid") ?>";
frc25_a_planos_aplicacaogrid.Lists["x_plano_despesa"] = {"LinkField":"x_despesa_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_despesa_nome","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_planos_despesas"};
frc25_a_planos_aplicacaogrid.Lists["x_plano_despesa"].Data = "<?php echo $rc25_a_planos_aplicacao_grid->plano_despesa->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd") {
	if ($rc25_a_planos_aplicacao->CurrentMode == "copy") {
		$bSelectLimit = $rc25_a_planos_aplicacao_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$rc25_a_planos_aplicacao_grid->TotalRecs = $rc25_a_planos_aplicacao->ListRecordCount();
			$rc25_a_planos_aplicacao_grid->Recordset = $rc25_a_planos_aplicacao_grid->LoadRecordset($rc25_a_planos_aplicacao_grid->StartRec-1, $rc25_a_planos_aplicacao_grid->DisplayRecs);
		} else {
			if ($rc25_a_planos_aplicacao_grid->Recordset = $rc25_a_planos_aplicacao_grid->LoadRecordset())
				$rc25_a_planos_aplicacao_grid->TotalRecs = $rc25_a_planos_aplicacao_grid->Recordset->RecordCount();
		}
		$rc25_a_planos_aplicacao_grid->StartRec = 1;
		$rc25_a_planos_aplicacao_grid->DisplayRecs = $rc25_a_planos_aplicacao_grid->TotalRecs;
	} else {
		$rc25_a_planos_aplicacao->CurrentFilter = "0=1";
		$rc25_a_planos_aplicacao_grid->StartRec = 1;
		$rc25_a_planos_aplicacao_grid->DisplayRecs = $rc25_a_planos_aplicacao->GridAddRowCount;
	}
	$rc25_a_planos_aplicacao_grid->TotalRecs = $rc25_a_planos_aplicacao_grid->DisplayRecs;
	$rc25_a_planos_aplicacao_grid->StopRec = $rc25_a_planos_aplicacao_grid->DisplayRecs;
} else {
	$bSelectLimit = $rc25_a_planos_aplicacao_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_planos_aplicacao_grid->TotalRecs <= 0)
			$rc25_a_planos_aplicacao_grid->TotalRecs = $rc25_a_planos_aplicacao->ListRecordCount();
	} else {
		if (!$rc25_a_planos_aplicacao_grid->Recordset && ($rc25_a_planos_aplicacao_grid->Recordset = $rc25_a_planos_aplicacao_grid->LoadRecordset()))
			$rc25_a_planos_aplicacao_grid->TotalRecs = $rc25_a_planos_aplicacao_grid->Recordset->RecordCount();
	}
	$rc25_a_planos_aplicacao_grid->StartRec = 1;
	$rc25_a_planos_aplicacao_grid->DisplayRecs = $rc25_a_planos_aplicacao_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$rc25_a_planos_aplicacao_grid->Recordset = $rc25_a_planos_aplicacao_grid->LoadRecordset($rc25_a_planos_aplicacao_grid->StartRec-1, $rc25_a_planos_aplicacao_grid->DisplayRecs);

	// Set no record found message
	if ($rc25_a_planos_aplicacao->CurrentAction == "" && $rc25_a_planos_aplicacao_grid->TotalRecs == 0) {
		if ($rc25_a_planos_aplicacao_grid->SearchWhere == "0=101")
			$rc25_a_planos_aplicacao_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_planos_aplicacao_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$rc25_a_planos_aplicacao_grid->RenderOtherOptions();
?>
<?php $rc25_a_planos_aplicacao_grid->ShowPageHeader(); ?>
<?php
$rc25_a_planos_aplicacao_grid->ShowMessage();
?>
<?php if ($rc25_a_planos_aplicacao_grid->TotalRecs > 0 || $rc25_a_planos_aplicacao->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_planos_aplicacao_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_planos_aplicacao">
<div id="frc25_a_planos_aplicacaogrid" class="ewForm ewListForm form-inline">
<?php if ($rc25_a_planos_aplicacao_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($rc25_a_planos_aplicacao_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_rc25_a_planos_aplicacao" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_rc25_a_planos_aplicacaogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_planos_aplicacao_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_planos_aplicacao_grid->RenderListOptions();

// Render list options (header, left)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_exercicio) == "") { ?>
		<th data-name="plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio"><div class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_despesa) == "") { ?>
		<th data-name="plano_despesa" class="<?php echo $rc25_a_planos_aplicacao->plano_despesa->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_despesa" class="<?php echo $rc25_a_planos_aplicacao->plano_despesa->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_despesa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_despesa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_mensal) == "") { ?>
		<th data-name="plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_custo_mensal" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_custo_mensal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_custo_exercicio) == "") { ?>
		<th data-name="plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_custo_exercicio" class="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_custo_exercicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_recurso_municipal) == "") { ?>
		<th data-name="plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_recurso_municipal" class="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_recurso_municipal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
	<?php if ($rc25_a_planos_aplicacao->SortUrl($rc25_a_planos_aplicacao->plano_outros_recursos) == "") { ?>
		<th data-name="plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plano_outros_recursos" class="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_aplicacao->plano_outros_recursos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$rc25_a_planos_aplicacao_grid->StartRec = 1;
$rc25_a_planos_aplicacao_grid->StopRec = $rc25_a_planos_aplicacao_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($rc25_a_planos_aplicacao_grid->FormKeyCountName) && ($rc25_a_planos_aplicacao->CurrentAction == "gridadd" || $rc25_a_planos_aplicacao->CurrentAction == "gridedit" || $rc25_a_planos_aplicacao->CurrentAction == "F")) {
		$rc25_a_planos_aplicacao_grid->KeyCount = $objForm->GetValue($rc25_a_planos_aplicacao_grid->FormKeyCountName);
		$rc25_a_planos_aplicacao_grid->StopRec = $rc25_a_planos_aplicacao_grid->StartRec + $rc25_a_planos_aplicacao_grid->KeyCount - 1;
	}
}
$rc25_a_planos_aplicacao_grid->RecCnt = $rc25_a_planos_aplicacao_grid->StartRec - 1;
if ($rc25_a_planos_aplicacao_grid->Recordset && !$rc25_a_planos_aplicacao_grid->Recordset->EOF) {
	$rc25_a_planos_aplicacao_grid->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_planos_aplicacao_grid->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_planos_aplicacao_grid->StartRec > 1)
		$rc25_a_planos_aplicacao_grid->Recordset->Move($rc25_a_planos_aplicacao_grid->StartRec - 1);
} elseif (!$rc25_a_planos_aplicacao->AllowAddDeleteRow && $rc25_a_planos_aplicacao_grid->StopRec == 0) {
	$rc25_a_planos_aplicacao_grid->StopRec = $rc25_a_planos_aplicacao->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_planos_aplicacao->ResetAttrs();
$rc25_a_planos_aplicacao_grid->RenderRow();
if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd")
	$rc25_a_planos_aplicacao_grid->RowIndex = 0;
if ($rc25_a_planos_aplicacao->CurrentAction == "gridedit")
	$rc25_a_planos_aplicacao_grid->RowIndex = 0;
while ($rc25_a_planos_aplicacao_grid->RecCnt < $rc25_a_planos_aplicacao_grid->StopRec) {
	$rc25_a_planos_aplicacao_grid->RecCnt++;
	if (intval($rc25_a_planos_aplicacao_grid->RecCnt) >= intval($rc25_a_planos_aplicacao_grid->StartRec)) {
		$rc25_a_planos_aplicacao_grid->RowCnt++;
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd" || $rc25_a_planos_aplicacao->CurrentAction == "gridedit" || $rc25_a_planos_aplicacao->CurrentAction == "F") {
			$rc25_a_planos_aplicacao_grid->RowIndex++;
			$objForm->Index = $rc25_a_planos_aplicacao_grid->RowIndex;
			if ($objForm->HasValue($rc25_a_planos_aplicacao_grid->FormActionName))
				$rc25_a_planos_aplicacao_grid->RowAction = strval($objForm->GetValue($rc25_a_planos_aplicacao_grid->FormActionName));
			elseif ($rc25_a_planos_aplicacao->CurrentAction == "gridadd")
				$rc25_a_planos_aplicacao_grid->RowAction = "insert";
			else
				$rc25_a_planos_aplicacao_grid->RowAction = "";
		}

		// Set up key count
		$rc25_a_planos_aplicacao_grid->KeyCount = $rc25_a_planos_aplicacao_grid->RowIndex;

		// Init row class and style
		$rc25_a_planos_aplicacao->ResetAttrs();
		$rc25_a_planos_aplicacao->CssClass = "";
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd") {
			if ($rc25_a_planos_aplicacao->CurrentMode == "copy") {
				$rc25_a_planos_aplicacao_grid->LoadRowValues($rc25_a_planos_aplicacao_grid->Recordset); // Load row values
				$rc25_a_planos_aplicacao_grid->SetRecordKey($rc25_a_planos_aplicacao_grid->RowOldKey, $rc25_a_planos_aplicacao_grid->Recordset); // Set old record key
			} else {
				$rc25_a_planos_aplicacao_grid->LoadRowValues(); // Load default values
				$rc25_a_planos_aplicacao_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$rc25_a_planos_aplicacao_grid->LoadRowValues($rc25_a_planos_aplicacao_grid->Recordset); // Load row values
		}
		$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd") // Grid add
			$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_ADD; // Render add
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridadd" && $rc25_a_planos_aplicacao->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$rc25_a_planos_aplicacao_grid->RestoreCurrentRowFormValues($rc25_a_planos_aplicacao_grid->RowIndex); // Restore form values
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridedit") { // Grid edit
			if ($rc25_a_planos_aplicacao->EventCancelled) {
				$rc25_a_planos_aplicacao_grid->RestoreCurrentRowFormValues($rc25_a_planos_aplicacao_grid->RowIndex); // Restore form values
			}
			if ($rc25_a_planos_aplicacao_grid->RowAction == "insert")
				$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($rc25_a_planos_aplicacao->CurrentAction == "gridedit" && ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT || $rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) && $rc25_a_planos_aplicacao->EventCancelled) // Update failed
			$rc25_a_planos_aplicacao_grid->RestoreCurrentRowFormValues($rc25_a_planos_aplicacao_grid->RowIndex); // Restore form values
		if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) // Edit row
			$rc25_a_planos_aplicacao_grid->EditRowCnt++;
		if ($rc25_a_planos_aplicacao->CurrentAction == "F") // Confirm row
			$rc25_a_planos_aplicacao_grid->RestoreCurrentRowFormValues($rc25_a_planos_aplicacao_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$rc25_a_planos_aplicacao->RowAttrs = array_merge($rc25_a_planos_aplicacao->RowAttrs, array('data-rowindex'=>$rc25_a_planos_aplicacao_grid->RowCnt, 'id'=>'r' . $rc25_a_planos_aplicacao_grid->RowCnt . '_rc25_a_planos_aplicacao', 'data-rowtype'=>$rc25_a_planos_aplicacao->RowType));

		// Render row
		$rc25_a_planos_aplicacao_grid->RenderRow();

		// Render list options
		$rc25_a_planos_aplicacao_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rc25_a_planos_aplicacao_grid->RowAction <> "delete" && $rc25_a_planos_aplicacao_grid->RowAction <> "insertdelete" && !($rc25_a_planos_aplicacao_grid->RowAction == "insert" && $rc25_a_planos_aplicacao->CurrentAction == "F" && $rc25_a_planos_aplicacao_grid->EmptyRow())) {
?>
	<tr<?php echo $rc25_a_planos_aplicacao->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("body", "left", $rc25_a_planos_aplicacao_grid->RowCnt);
?>
	<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
		<td data-name="plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() <> "") { ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() <> "") { ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_exercicio" class="rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_id" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_id->CurrentValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_id" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_id->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT || $rc25_a_planos_aplicacao->CurrentMode == "edit") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_id" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
		<td data-name="plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_despesa" class="form-group rc25_a_planos_aplicacao_plano_despesa">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_despesa->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa',url:'rc25_a_planos_despesasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span></button>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_despesa" class="form-group rc25_a_planos_aplicacao_plano_despesa">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_despesa->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa',url:'rc25_a_planos_despesasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span></button>
</span>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_despesa" class="rc25_a_planos_aplicacao_plano_despesa">
<span<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
		<td data-name="plano_custo_mensal"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_mensal" class="form-group rc25_a_planos_aplicacao_plano_custo_mensal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_mensal" class="form-group rc25_a_planos_aplicacao_plano_custo_mensal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_mensal" class="rc25_a_planos_aplicacao_plano_custo_mensal">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
		<td data-name="plano_custo_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_exercicio" class="form-group rc25_a_planos_aplicacao_plano_custo_exercicio">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_exercicio" class="form-group rc25_a_planos_aplicacao_plano_custo_exercicio">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_custo_exercicio" class="rc25_a_planos_aplicacao_plano_custo_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
		<td data-name="plano_recurso_municipal"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_recurso_municipal" class="form-group rc25_a_planos_aplicacao_plano_recurso_municipal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_recurso_municipal" class="form-group rc25_a_planos_aplicacao_plano_recurso_municipal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_recurso_municipal" class="rc25_a_planos_aplicacao_plano_recurso_municipal">
<span<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
		<td data-name="plano_outros_recursos"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CellAttributes() ?>>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_outros_recursos" class="form-group rc25_a_planos_aplicacao_plano_outros_recursos">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_outros_recursos" class="form-group rc25_a_planos_aplicacao_plano_outros_recursos">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_aplicacao_grid->RowCnt ?>_rc25_a_planos_aplicacao_plano_outros_recursos" class="rc25_a_planos_aplicacao_plano_outros_recursos">
<span<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="frc25_a_planos_aplicacaogrid$x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="frc25_a_planos_aplicacaogrid$o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("body", "right", $rc25_a_planos_aplicacao_grid->RowCnt);
?>
	</tr>
<?php if ($rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_ADD || $rc25_a_planos_aplicacao->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
frc25_a_planos_aplicacaogrid.UpdateOpts(<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($rc25_a_planos_aplicacao->CurrentAction <> "gridadd" || $rc25_a_planos_aplicacao->CurrentMode == "copy")
		if (!$rc25_a_planos_aplicacao_grid->Recordset->EOF) $rc25_a_planos_aplicacao_grid->Recordset->MoveNext();
}
?>
<?php
	if ($rc25_a_planos_aplicacao->CurrentMode == "add" || $rc25_a_planos_aplicacao->CurrentMode == "copy" || $rc25_a_planos_aplicacao->CurrentMode == "edit") {
		$rc25_a_planos_aplicacao_grid->RowIndex = '$rowindex$';
		$rc25_a_planos_aplicacao_grid->LoadRowValues();

		// Set row properties
		$rc25_a_planos_aplicacao->ResetAttrs();
		$rc25_a_planos_aplicacao->RowAttrs = array_merge($rc25_a_planos_aplicacao->RowAttrs, array('data-rowindex'=>$rc25_a_planos_aplicacao_grid->RowIndex, 'id'=>'r0_rc25_a_planos_aplicacao', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($rc25_a_planos_aplicacao->RowAttrs["class"], "ewTemplate");
		$rc25_a_planos_aplicacao->RowType = EW_ROWTYPE_ADD;

		// Render row
		$rc25_a_planos_aplicacao_grid->RenderRow();

		// Render list options
		$rc25_a_planos_aplicacao_grid->RenderListOptions();
		$rc25_a_planos_aplicacao_grid->StartRowCnt = 0;
?>
	<tr<?php echo $rc25_a_planos_aplicacao->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("body", "left", $rc25_a_planos_aplicacao_grid->RowIndex);
?>
	<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
		<td data-name="plano_exercicio">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->getSessionValue() <> "") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_exercicio->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio"<?php echo $rc25_a_planos_aplicacao->plano_exercicio->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_exercicio" class="form-group rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_exercicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
		<td data-name="plano_despesa">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_despesa" class="form-group rc25_a_planos_aplicacao_plano_despesa">
<select data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" data-value-separator="<?php echo $rc25_a_planos_aplicacao->plano_despesa->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"<?php echo $rc25_a_planos_aplicacao->plano_despesa->EditAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->SelectOptionListHtml("x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa',url:'rc25_a_planos_despesasaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></span></button>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_despesa" class="form-group rc25_a_planos_aplicacao_plano_despesa">
<span<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_despesa" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_despesa" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_despesa->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
		<td data-name="plano_custo_mensal">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_custo_mensal" class="form-group rc25_a_planos_aplicacao_plano_custo_mensal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_custo_mensal" class="form-group rc25_a_planos_aplicacao_plano_custo_mensal">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_mensal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_mensal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_mensal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
		<td data-name="plano_custo_exercicio">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_custo_exercicio" class="form-group rc25_a_planos_aplicacao_plano_custo_exercicio">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_custo_exercicio" class="form-group rc25_a_planos_aplicacao_plano_custo_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_custo_exercicio" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_custo_exercicio" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_custo_exercicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
		<td data-name="plano_recurso_municipal">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_recurso_municipal" class="form-group rc25_a_planos_aplicacao_plano_recurso_municipal">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_recurso_municipal" class="form-group rc25_a_planos_aplicacao_plano_recurso_municipal">
<span<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_recurso_municipal" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_recurso_municipal" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_recurso_municipal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
		<td data-name="plano_outros_recursos">
<?php if ($rc25_a_planos_aplicacao->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_outros_recursos" class="form-group rc25_a_planos_aplicacao_plano_outros_recursos">
<input type="text" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditValue ?>"<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_aplicacao_plano_outros_recursos" class="form-group rc25_a_planos_aplicacao_plano_outros_recursos">
<span<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="x<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_aplicacao" data-field="x_plano_outros_recursos" name="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" id="o<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>_plano_outros_recursos" value="<?php echo ew_HtmlEncode($rc25_a_planos_aplicacao->plano_outros_recursos->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_planos_aplicacao_grid->ListOptions->Render("body", "right", $rc25_a_planos_aplicacao_grid->RowIndex);
?>
<script type="text/javascript">
frc25_a_planos_aplicacaogrid.UpdateOpts(<?php echo $rc25_a_planos_aplicacao_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($rc25_a_planos_aplicacao->CurrentMode == "add" || $rc25_a_planos_aplicacao->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $rc25_a_planos_aplicacao_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_planos_aplicacao_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_planos_aplicacao_grid->KeyCount ?>">
<?php echo $rc25_a_planos_aplicacao_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $rc25_a_planos_aplicacao_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_planos_aplicacao_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_planos_aplicacao_grid->KeyCount ?>">
<?php echo $rc25_a_planos_aplicacao_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frc25_a_planos_aplicacaogrid">
</div>
<?php

// Close recordset
if ($rc25_a_planos_aplicacao_grid->Recordset)
	$rc25_a_planos_aplicacao_grid->Recordset->Close();
?>
<?php if ($rc25_a_planos_aplicacao_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($rc25_a_planos_aplicacao_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao_grid->TotalRecs == 0 && $rc25_a_planos_aplicacao->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_planos_aplicacao_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->Export == "") { ?>
<script type="text/javascript">
frc25_a_planos_aplicacaogrid.Init();
</script>
<?php } ?>
<?php
$rc25_a_planos_aplicacao_grid->Page_Terminate();
?>
