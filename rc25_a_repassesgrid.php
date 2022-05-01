<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_repasses_grid)) $rc25_a_repasses_grid = new crc25_a_repasses_grid();

// Page init
$rc25_a_repasses_grid->Page_Init();

// Page main
$rc25_a_repasses_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_repasses_grid->Page_Render();
?>
<?php if ($rc25_a_repasses->Export == "") { ?>
<script type="text/javascript">

// Form object
var frc25_a_repassesgrid = new ew_Form("frc25_a_repassesgrid", "grid");
frc25_a_repassesgrid.FormKeyCountName = '<?php echo $rc25_a_repasses_grid->FormKeyCountName ?>';

// Validate form
frc25_a_repassesgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_repasse_faixa_etaria");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_repasses->repasse_faixa_etaria->FldCaption(), $rc25_a_repasses->repasse_faixa_etaria->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_repasse_meta");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_repasses->repasse_meta->FldCaption(), $rc25_a_repasses->repasse_meta->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_repasse_meta");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_meta->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_unitario");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_unitario->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_mes");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_mes->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_repasse_valor_previsto");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rc25_a_repasses->repasse_valor_previsto->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
frc25_a_repassesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "repasse_id_termos", false)) return false;
	if (ew_ValueChanged(fobj, infix, "repasse_faixa_etaria", false)) return false;
	if (ew_ValueChanged(fobj, infix, "repasse_meta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "repasse_valor_unitario", false)) return false;
	if (ew_ValueChanged(fobj, infix, "repasse_valor_mes", false)) return false;
	if (ew_ValueChanged(fobj, infix, "repasse_valor_previsto", false)) return false;
	return true;
}

// Form_CustomValidate event
frc25_a_repassesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_repassesgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
frc25_a_repassesgrid.Lists["x_repasse_id_termos"] = {"LinkField":"x_processo_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_processo_termo_num","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"rc25_a_termos"};
frc25_a_repassesgrid.Lists["x_repasse_id_termos"].Data = "<?php echo $rc25_a_repasses_grid->repasse_id_termos->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($rc25_a_repasses->CurrentAction == "gridadd") {
	if ($rc25_a_repasses->CurrentMode == "copy") {
		$bSelectLimit = $rc25_a_repasses_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$rc25_a_repasses_grid->TotalRecs = $rc25_a_repasses->ListRecordCount();
			$rc25_a_repasses_grid->Recordset = $rc25_a_repasses_grid->LoadRecordset($rc25_a_repasses_grid->StartRec-1, $rc25_a_repasses_grid->DisplayRecs);
		} else {
			if ($rc25_a_repasses_grid->Recordset = $rc25_a_repasses_grid->LoadRecordset())
				$rc25_a_repasses_grid->TotalRecs = $rc25_a_repasses_grid->Recordset->RecordCount();
		}
		$rc25_a_repasses_grid->StartRec = 1;
		$rc25_a_repasses_grid->DisplayRecs = $rc25_a_repasses_grid->TotalRecs;
	} else {
		$rc25_a_repasses->CurrentFilter = "0=1";
		$rc25_a_repasses_grid->StartRec = 1;
		$rc25_a_repasses_grid->DisplayRecs = $rc25_a_repasses->GridAddRowCount;
	}
	$rc25_a_repasses_grid->TotalRecs = $rc25_a_repasses_grid->DisplayRecs;
	$rc25_a_repasses_grid->StopRec = $rc25_a_repasses_grid->DisplayRecs;
} else {
	$bSelectLimit = $rc25_a_repasses_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_repasses_grid->TotalRecs <= 0)
			$rc25_a_repasses_grid->TotalRecs = $rc25_a_repasses->ListRecordCount();
	} else {
		if (!$rc25_a_repasses_grid->Recordset && ($rc25_a_repasses_grid->Recordset = $rc25_a_repasses_grid->LoadRecordset()))
			$rc25_a_repasses_grid->TotalRecs = $rc25_a_repasses_grid->Recordset->RecordCount();
	}
	$rc25_a_repasses_grid->StartRec = 1;
	$rc25_a_repasses_grid->DisplayRecs = $rc25_a_repasses_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$rc25_a_repasses_grid->Recordset = $rc25_a_repasses_grid->LoadRecordset($rc25_a_repasses_grid->StartRec-1, $rc25_a_repasses_grid->DisplayRecs);

	// Set no record found message
	if ($rc25_a_repasses->CurrentAction == "" && $rc25_a_repasses_grid->TotalRecs == 0) {
		if ($rc25_a_repasses_grid->SearchWhere == "0=101")
			$rc25_a_repasses_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_repasses_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$rc25_a_repasses_grid->RenderOtherOptions();
?>
<?php $rc25_a_repasses_grid->ShowPageHeader(); ?>
<?php
$rc25_a_repasses_grid->ShowMessage();
?>
<?php if ($rc25_a_repasses_grid->TotalRecs > 0 || $rc25_a_repasses->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_repasses_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_repasses">
<div id="frc25_a_repassesgrid" class="ewForm ewListForm form-inline">
<?php if ($rc25_a_repasses_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($rc25_a_repasses_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_rc25_a_repasses" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_rc25_a_repassesgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_repasses_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_repasses_grid->RenderListOptions();

// Render list options (header, left)
$rc25_a_repasses_grid->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_id_termos) == "") { ?>
		<th data-name="repasse_id_termos" class="<?php echo $rc25_a_repasses->repasse_id_termos->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_id_termos" class="<?php echo $rc25_a_repasses->repasse_id_termos->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_id_termos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_id_termos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_faixa_etaria) == "") { ?>
		<th data-name="repasse_faixa_etaria" class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_faixa_etaria" class="<?php echo $rc25_a_repasses->repasse_faixa_etaria->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_faixa_etaria->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_faixa_etaria->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_faixa_etaria->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_meta) == "") { ?>
		<th data-name="repasse_meta" class="<?php echo $rc25_a_repasses->repasse_meta->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_meta" class="<?php echo $rc25_a_repasses->repasse_meta->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_meta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_meta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_meta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_unitario) == "") { ?>
		<th data-name="repasse_valor_unitario" class="<?php echo $rc25_a_repasses->repasse_valor_unitario->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_unitario" class="<?php echo $rc25_a_repasses->repasse_valor_unitario->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_unitario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_unitario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_unitario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_mes) == "") { ?>
		<th data-name="repasse_valor_mes" class="<?php echo $rc25_a_repasses->repasse_valor_mes->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_mes" class="<?php echo $rc25_a_repasses->repasse_valor_mes->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_mes->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_mes->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_mes->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
	<?php if ($rc25_a_repasses->SortUrl($rc25_a_repasses->repasse_valor_previsto) == "") { ?>
		<th data-name="repasse_valor_previsto" class="<?php echo $rc25_a_repasses->repasse_valor_previsto->HeaderCellClass() ?>"><div id="elh_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto"><div class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="repasse_valor_previsto" class="<?php echo $rc25_a_repasses->repasse_valor_previsto->HeaderCellClass() ?>"><div><div id="elh_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_repasses->repasse_valor_previsto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_repasses->repasse_valor_previsto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_repasses->repasse_valor_previsto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_repasses_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$rc25_a_repasses_grid->StartRec = 1;
$rc25_a_repasses_grid->StopRec = $rc25_a_repasses_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($rc25_a_repasses_grid->FormKeyCountName) && ($rc25_a_repasses->CurrentAction == "gridadd" || $rc25_a_repasses->CurrentAction == "gridedit" || $rc25_a_repasses->CurrentAction == "F")) {
		$rc25_a_repasses_grid->KeyCount = $objForm->GetValue($rc25_a_repasses_grid->FormKeyCountName);
		$rc25_a_repasses_grid->StopRec = $rc25_a_repasses_grid->StartRec + $rc25_a_repasses_grid->KeyCount - 1;
	}
}
$rc25_a_repasses_grid->RecCnt = $rc25_a_repasses_grid->StartRec - 1;
if ($rc25_a_repasses_grid->Recordset && !$rc25_a_repasses_grid->Recordset->EOF) {
	$rc25_a_repasses_grid->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_repasses_grid->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_repasses_grid->StartRec > 1)
		$rc25_a_repasses_grid->Recordset->Move($rc25_a_repasses_grid->StartRec - 1);
} elseif (!$rc25_a_repasses->AllowAddDeleteRow && $rc25_a_repasses_grid->StopRec == 0) {
	$rc25_a_repasses_grid->StopRec = $rc25_a_repasses->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_repasses->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_repasses->ResetAttrs();
$rc25_a_repasses_grid->RenderRow();
if ($rc25_a_repasses->CurrentAction == "gridadd")
	$rc25_a_repasses_grid->RowIndex = 0;
if ($rc25_a_repasses->CurrentAction == "gridedit")
	$rc25_a_repasses_grid->RowIndex = 0;
while ($rc25_a_repasses_grid->RecCnt < $rc25_a_repasses_grid->StopRec) {
	$rc25_a_repasses_grid->RecCnt++;
	if (intval($rc25_a_repasses_grid->RecCnt) >= intval($rc25_a_repasses_grid->StartRec)) {
		$rc25_a_repasses_grid->RowCnt++;
		if ($rc25_a_repasses->CurrentAction == "gridadd" || $rc25_a_repasses->CurrentAction == "gridedit" || $rc25_a_repasses->CurrentAction == "F") {
			$rc25_a_repasses_grid->RowIndex++;
			$objForm->Index = $rc25_a_repasses_grid->RowIndex;
			if ($objForm->HasValue($rc25_a_repasses_grid->FormActionName))
				$rc25_a_repasses_grid->RowAction = strval($objForm->GetValue($rc25_a_repasses_grid->FormActionName));
			elseif ($rc25_a_repasses->CurrentAction == "gridadd")
				$rc25_a_repasses_grid->RowAction = "insert";
			else
				$rc25_a_repasses_grid->RowAction = "";
		}

		// Set up key count
		$rc25_a_repasses_grid->KeyCount = $rc25_a_repasses_grid->RowIndex;

		// Init row class and style
		$rc25_a_repasses->ResetAttrs();
		$rc25_a_repasses->CssClass = "";
		if ($rc25_a_repasses->CurrentAction == "gridadd") {
			if ($rc25_a_repasses->CurrentMode == "copy") {
				$rc25_a_repasses_grid->LoadRowValues($rc25_a_repasses_grid->Recordset); // Load row values
				$rc25_a_repasses_grid->SetRecordKey($rc25_a_repasses_grid->RowOldKey, $rc25_a_repasses_grid->Recordset); // Set old record key
			} else {
				$rc25_a_repasses_grid->LoadRowValues(); // Load default values
				$rc25_a_repasses_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$rc25_a_repasses_grid->LoadRowValues($rc25_a_repasses_grid->Recordset); // Load row values
		}
		$rc25_a_repasses->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($rc25_a_repasses->CurrentAction == "gridadd") // Grid add
			$rc25_a_repasses->RowType = EW_ROWTYPE_ADD; // Render add
		if ($rc25_a_repasses->CurrentAction == "gridadd" && $rc25_a_repasses->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$rc25_a_repasses_grid->RestoreCurrentRowFormValues($rc25_a_repasses_grid->RowIndex); // Restore form values
		if ($rc25_a_repasses->CurrentAction == "gridedit") { // Grid edit
			if ($rc25_a_repasses->EventCancelled) {
				$rc25_a_repasses_grid->RestoreCurrentRowFormValues($rc25_a_repasses_grid->RowIndex); // Restore form values
			}
			if ($rc25_a_repasses_grid->RowAction == "insert")
				$rc25_a_repasses->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$rc25_a_repasses->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($rc25_a_repasses->CurrentAction == "gridedit" && ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT || $rc25_a_repasses->RowType == EW_ROWTYPE_ADD) && $rc25_a_repasses->EventCancelled) // Update failed
			$rc25_a_repasses_grid->RestoreCurrentRowFormValues($rc25_a_repasses_grid->RowIndex); // Restore form values
		if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) // Edit row
			$rc25_a_repasses_grid->EditRowCnt++;
		if ($rc25_a_repasses->CurrentAction == "F") // Confirm row
			$rc25_a_repasses_grid->RestoreCurrentRowFormValues($rc25_a_repasses_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$rc25_a_repasses->RowAttrs = array_merge($rc25_a_repasses->RowAttrs, array('data-rowindex'=>$rc25_a_repasses_grid->RowCnt, 'id'=>'r' . $rc25_a_repasses_grid->RowCnt . '_rc25_a_repasses', 'data-rowtype'=>$rc25_a_repasses->RowType));

		// Render row
		$rc25_a_repasses_grid->RenderRow();

		// Render list options
		$rc25_a_repasses_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rc25_a_repasses_grid->RowAction <> "delete" && $rc25_a_repasses_grid->RowAction <> "insertdelete" && !($rc25_a_repasses_grid->RowAction == "insert" && $rc25_a_repasses->CurrentAction == "F" && $rc25_a_repasses_grid->EmptyRow())) {
?>
	<tr<?php echo $rc25_a_repasses->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_repasses_grid->ListOptions->Render("body", "left", $rc25_a_repasses_grid->RowCnt);
?>
	<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<td data-name="repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($rc25_a_repasses->repasse_id_termos->getSessionValue() <> "") { ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_id_termos->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<select data-table="rc25_a_repasses" data-field="x_repasse_id_termos" data-value-separator="<?php echo $rc25_a_repasses->repasse_id_termos->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->EditAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->SelectOptionListHtml("x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_repasses->repasse_id_termos->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos',url:'rc25_a_termosaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span></button>
</span>
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($rc25_a_repasses->repasse_id_termos->getSessionValue() <> "") { ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_id_termos->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<select data-table="rc25_a_repasses" data-field="x_repasse_id_termos" data-value-separator="<?php echo $rc25_a_repasses->repasse_id_termos->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->EditAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->SelectOptionListHtml("x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_repasses->repasse_id_termos->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos',url:'rc25_a_termosaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span></button>
</span>
<?php } ?>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_id_termos" class="rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id->CurrentValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT || $rc25_a_repasses->CurrentMode == "edit") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<td data-name="repasse_faixa_etaria"<?php echo $rc25_a_repasses->repasse_faixa_etaria->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_faixa_etaria" class="form-group rc25_a_repasses_repasse_faixa_etaria">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditValue ?>"<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_faixa_etaria" class="form-group rc25_a_repasses_repasse_faixa_etaria">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditValue ?>"<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_faixa_etaria" class="rc25_a_repasses_repasse_faixa_etaria">
<span<?php echo $rc25_a_repasses->repasse_faixa_etaria->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_faixa_etaria->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<td data-name="repasse_meta"<?php echo $rc25_a_repasses->repasse_meta->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_meta" class="form-group rc25_a_repasses_repasse_meta">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_meta->EditValue ?>"<?php echo $rc25_a_repasses->repasse_meta->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_meta" class="form-group rc25_a_repasses_repasse_meta">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_meta->EditValue ?>"<?php echo $rc25_a_repasses->repasse_meta->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_meta" class="rc25_a_repasses_repasse_meta">
<span<?php echo $rc25_a_repasses->repasse_meta->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_meta->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<td data-name="repasse_valor_unitario"<?php echo $rc25_a_repasses->repasse_valor_unitario->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_unitario" class="form-group rc25_a_repasses_repasse_valor_unitario">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_unitario->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_unitario->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_unitario" class="form-group rc25_a_repasses_repasse_valor_unitario">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_unitario->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_unitario->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_unitario" class="rc25_a_repasses_repasse_valor_unitario">
<span<?php echo $rc25_a_repasses->repasse_valor_unitario->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_unitario->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<td data-name="repasse_valor_mes"<?php echo $rc25_a_repasses->repasse_valor_mes->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_mes" class="form-group rc25_a_repasses_repasse_valor_mes">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_mes->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_mes->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_mes" class="form-group rc25_a_repasses_repasse_valor_mes">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_mes->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_mes->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_mes" class="rc25_a_repasses_repasse_valor_mes">
<span<?php echo $rc25_a_repasses->repasse_valor_mes->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_mes->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<td data-name="repasse_valor_previsto"<?php echo $rc25_a_repasses->repasse_valor_previsto->CellAttributes() ?>>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_previsto" class="form-group rc25_a_repasses_repasse_valor_previsto">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_previsto->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_previsto->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_previsto" class="form-group rc25_a_repasses_repasse_valor_previsto">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_previsto->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_previsto->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_repasses_grid->RowCnt ?>_rc25_a_repasses_repasse_valor_previsto" class="rc25_a_repasses_repasse_valor_previsto">
<span<?php echo $rc25_a_repasses->repasse_valor_previsto->ViewAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_valor_previsto->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="frc25_a_repassesgrid$x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->FormValue) ?>">
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="frc25_a_repassesgrid$o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_repasses_grid->ListOptions->Render("body", "right", $rc25_a_repasses_grid->RowCnt);
?>
	</tr>
<?php if ($rc25_a_repasses->RowType == EW_ROWTYPE_ADD || $rc25_a_repasses->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
frc25_a_repassesgrid.UpdateOpts(<?php echo $rc25_a_repasses_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($rc25_a_repasses->CurrentAction <> "gridadd" || $rc25_a_repasses->CurrentMode == "copy")
		if (!$rc25_a_repasses_grid->Recordset->EOF) $rc25_a_repasses_grid->Recordset->MoveNext();
}
?>
<?php
	if ($rc25_a_repasses->CurrentMode == "add" || $rc25_a_repasses->CurrentMode == "copy" || $rc25_a_repasses->CurrentMode == "edit") {
		$rc25_a_repasses_grid->RowIndex = '$rowindex$';
		$rc25_a_repasses_grid->LoadRowValues();

		// Set row properties
		$rc25_a_repasses->ResetAttrs();
		$rc25_a_repasses->RowAttrs = array_merge($rc25_a_repasses->RowAttrs, array('data-rowindex'=>$rc25_a_repasses_grid->RowIndex, 'id'=>'r0_rc25_a_repasses', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($rc25_a_repasses->RowAttrs["class"], "ewTemplate");
		$rc25_a_repasses->RowType = EW_ROWTYPE_ADD;

		// Render row
		$rc25_a_repasses_grid->RenderRow();

		// Render list options
		$rc25_a_repasses_grid->RenderListOptions();
		$rc25_a_repasses_grid->StartRowCnt = 0;
?>
	<tr<?php echo $rc25_a_repasses->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_repasses_grid->ListOptions->Render("body", "left", $rc25_a_repasses_grid->RowIndex);
?>
	<?php if ($rc25_a_repasses->repasse_id_termos->Visible) { // repasse_id_termos ?>
		<td data-name="repasse_id_termos">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<?php if ($rc25_a_repasses->repasse_id_termos->getSessionValue() <> "") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_id_termos->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<select data-table="rc25_a_repasses" data-field="x_repasse_id_termos" data-value-separator="<?php echo $rc25_a_repasses->repasse_id_termos->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"<?php echo $rc25_a_repasses->repasse_id_termos->EditAttributes() ?>>
<?php echo $rc25_a_repasses->repasse_id_termos->SelectOptionListHtml("x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos") ?>
</select>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $rc25_a_repasses->repasse_id_termos->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos',url:'rc25_a_termosaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $rc25_a_repasses->repasse_id_termos->FldCaption() ?></span></button>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_id_termos" class="form-group rc25_a_repasses_repasse_id_termos">
<span<?php echo $rc25_a_repasses->repasse_id_termos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_id_termos->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_id_termos" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_id_termos" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_id_termos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_faixa_etaria->Visible) { // repasse_faixa_etaria ?>
		<td data-name="repasse_faixa_etaria">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_faixa_etaria" class="form-group rc25_a_repasses_repasse_faixa_etaria">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditValue ?>"<?php echo $rc25_a_repasses->repasse_faixa_etaria->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_faixa_etaria" class="form-group rc25_a_repasses_repasse_faixa_etaria">
<span<?php echo $rc25_a_repasses->repasse_faixa_etaria->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_faixa_etaria->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_faixa_etaria" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_faixa_etaria" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_faixa_etaria->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_meta->Visible) { // repasse_meta ?>
		<td data-name="repasse_meta">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_meta" class="form-group rc25_a_repasses_repasse_meta">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_meta->EditValue ?>"<?php echo $rc25_a_repasses->repasse_meta->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_meta" class="form-group rc25_a_repasses_repasse_meta">
<span<?php echo $rc25_a_repasses->repasse_meta->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_meta->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_meta" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_meta" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_meta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_unitario->Visible) { // repasse_valor_unitario ?>
		<td data-name="repasse_valor_unitario">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_unitario" class="form-group rc25_a_repasses_repasse_valor_unitario">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_unitario->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_unitario->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_unitario" class="form-group rc25_a_repasses_repasse_valor_unitario">
<span<?php echo $rc25_a_repasses->repasse_valor_unitario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_valor_unitario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_unitario" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_unitario" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_unitario->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_mes->Visible) { // repasse_valor_mes ?>
		<td data-name="repasse_valor_mes">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_mes" class="form-group rc25_a_repasses_repasse_valor_mes">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_mes->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_mes->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_mes" class="form-group rc25_a_repasses_repasse_valor_mes">
<span<?php echo $rc25_a_repasses->repasse_valor_mes->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_valor_mes->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_mes" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_mes" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_mes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($rc25_a_repasses->repasse_valor_previsto->Visible) { // repasse_valor_previsto ?>
		<td data-name="repasse_valor_previsto">
<?php if ($rc25_a_repasses->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_previsto" class="form-group rc25_a_repasses_repasse_valor_previsto">
<input type="text" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" size="30" placeholder="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->getPlaceHolder()) ?>" value="<?php echo $rc25_a_repasses->repasse_valor_previsto->EditValue ?>"<?php echo $rc25_a_repasses->repasse_valor_previsto->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_repasses_repasse_valor_previsto" class="form-group rc25_a_repasses_repasse_valor_previsto">
<span<?php echo $rc25_a_repasses->repasse_valor_previsto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_repasses->repasse_valor_previsto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="x<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_repasses" data-field="x_repasse_valor_previsto" name="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" id="o<?php echo $rc25_a_repasses_grid->RowIndex ?>_repasse_valor_previsto" value="<?php echo ew_HtmlEncode($rc25_a_repasses->repasse_valor_previsto->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_repasses_grid->ListOptions->Render("body", "right", $rc25_a_repasses_grid->RowIndex);
?>
<script type="text/javascript">
frc25_a_repassesgrid.UpdateOpts(<?php echo $rc25_a_repasses_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($rc25_a_repasses->CurrentMode == "add" || $rc25_a_repasses->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $rc25_a_repasses_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_repasses_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_repasses_grid->KeyCount ?>">
<?php echo $rc25_a_repasses_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_repasses->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $rc25_a_repasses_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_repasses_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_repasses_grid->KeyCount ?>">
<?php echo $rc25_a_repasses_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_repasses->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frc25_a_repassesgrid">
</div>
<?php

// Close recordset
if ($rc25_a_repasses_grid->Recordset)
	$rc25_a_repasses_grid->Recordset->Close();
?>
<?php if ($rc25_a_repasses_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($rc25_a_repasses_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_repasses_grid->TotalRecs == 0 && $rc25_a_repasses->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_repasses_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($rc25_a_repasses->Export == "") { ?>
<script type="text/javascript">
frc25_a_repassesgrid.Init();
</script>
<?php } ?>
<?php
$rc25_a_repasses_grid->Page_Terminate();
?>
