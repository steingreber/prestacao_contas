<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rc25_a_planos_despesas_grid)) $rc25_a_planos_despesas_grid = new crc25_a_planos_despesas_grid();

// Page init
$rc25_a_planos_despesas_grid->Page_Init();

// Page main
$rc25_a_planos_despesas_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rc25_a_planos_despesas_grid->Page_Render();
?>
<?php if ($rc25_a_planos_despesas->Export == "") { ?>
<script type="text/javascript">

// Form object
var frc25_a_planos_despesasgrid = new ew_Form("frc25_a_planos_despesasgrid", "grid");
frc25_a_planos_despesasgrid.FormKeyCountName = '<?php echo $rc25_a_planos_despesas_grid->FormKeyCountName ?>';

// Validate form
frc25_a_planos_despesasgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_despesa_nome");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rc25_a_planos_despesas->despesa_nome->FldCaption(), $rc25_a_planos_despesas->despesa_nome->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
frc25_a_planos_despesasgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "despesa_nome", false)) return false;
	return true;
}

// Form_CustomValidate event
frc25_a_planos_despesasgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
frc25_a_planos_despesasgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($rc25_a_planos_despesas->CurrentAction == "gridadd") {
	if ($rc25_a_planos_despesas->CurrentMode == "copy") {
		$bSelectLimit = $rc25_a_planos_despesas_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$rc25_a_planos_despesas_grid->TotalRecs = $rc25_a_planos_despesas->ListRecordCount();
			$rc25_a_planos_despesas_grid->Recordset = $rc25_a_planos_despesas_grid->LoadRecordset($rc25_a_planos_despesas_grid->StartRec-1, $rc25_a_planos_despesas_grid->DisplayRecs);
		} else {
			if ($rc25_a_planos_despesas_grid->Recordset = $rc25_a_planos_despesas_grid->LoadRecordset())
				$rc25_a_planos_despesas_grid->TotalRecs = $rc25_a_planos_despesas_grid->Recordset->RecordCount();
		}
		$rc25_a_planos_despesas_grid->StartRec = 1;
		$rc25_a_planos_despesas_grid->DisplayRecs = $rc25_a_planos_despesas_grid->TotalRecs;
	} else {
		$rc25_a_planos_despesas->CurrentFilter = "0=1";
		$rc25_a_planos_despesas_grid->StartRec = 1;
		$rc25_a_planos_despesas_grid->DisplayRecs = $rc25_a_planos_despesas->GridAddRowCount;
	}
	$rc25_a_planos_despesas_grid->TotalRecs = $rc25_a_planos_despesas_grid->DisplayRecs;
	$rc25_a_planos_despesas_grid->StopRec = $rc25_a_planos_despesas_grid->DisplayRecs;
} else {
	$bSelectLimit = $rc25_a_planos_despesas_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($rc25_a_planos_despesas_grid->TotalRecs <= 0)
			$rc25_a_planos_despesas_grid->TotalRecs = $rc25_a_planos_despesas->ListRecordCount();
	} else {
		if (!$rc25_a_planos_despesas_grid->Recordset && ($rc25_a_planos_despesas_grid->Recordset = $rc25_a_planos_despesas_grid->LoadRecordset()))
			$rc25_a_planos_despesas_grid->TotalRecs = $rc25_a_planos_despesas_grid->Recordset->RecordCount();
	}
	$rc25_a_planos_despesas_grid->StartRec = 1;
	$rc25_a_planos_despesas_grid->DisplayRecs = $rc25_a_planos_despesas_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$rc25_a_planos_despesas_grid->Recordset = $rc25_a_planos_despesas_grid->LoadRecordset($rc25_a_planos_despesas_grid->StartRec-1, $rc25_a_planos_despesas_grid->DisplayRecs);

	// Set no record found message
	if ($rc25_a_planos_despesas->CurrentAction == "" && $rc25_a_planos_despesas_grid->TotalRecs == 0) {
		if ($rc25_a_planos_despesas_grid->SearchWhere == "0=101")
			$rc25_a_planos_despesas_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$rc25_a_planos_despesas_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$rc25_a_planos_despesas_grid->RenderOtherOptions();
?>
<?php $rc25_a_planos_despesas_grid->ShowPageHeader(); ?>
<?php
$rc25_a_planos_despesas_grid->ShowMessage();
?>
<?php if ($rc25_a_planos_despesas_grid->TotalRecs > 0 || $rc25_a_planos_despesas->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($rc25_a_planos_despesas_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> rc25_a_planos_despesas">
<div id="frc25_a_planos_despesasgrid" class="ewForm ewListForm form-inline">
<?php if ($rc25_a_planos_despesas_grid->ShowOtherOptions) { ?>
<div class="box-header ewGridUpperPanel">
<?php
	foreach ($rc25_a_planos_despesas_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_rc25_a_planos_despesas" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_rc25_a_planos_despesasgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$rc25_a_planos_despesas_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$rc25_a_planos_despesas_grid->RenderListOptions();

// Render list options (header, left)
$rc25_a_planos_despesas_grid->ListOptions->Render("header", "left");
?>
<?php if ($rc25_a_planos_despesas->despesa_nome->Visible) { // despesa_nome ?>
	<?php if ($rc25_a_planos_despesas->SortUrl($rc25_a_planos_despesas->despesa_nome) == "") { ?>
		<th data-name="despesa_nome" class="<?php echo $rc25_a_planos_despesas->despesa_nome->HeaderCellClass() ?>"><div id="elh_rc25_a_planos_despesas_despesa_nome" class="rc25_a_planos_despesas_despesa_nome"><div class="ewTableHeaderCaption"><?php echo $rc25_a_planos_despesas->despesa_nome->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="despesa_nome" class="<?php echo $rc25_a_planos_despesas->despesa_nome->HeaderCellClass() ?>"><div><div id="elh_rc25_a_planos_despesas_despesa_nome" class="rc25_a_planos_despesas_despesa_nome">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $rc25_a_planos_despesas->despesa_nome->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($rc25_a_planos_despesas->despesa_nome->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($rc25_a_planos_despesas->despesa_nome->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rc25_a_planos_despesas_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$rc25_a_planos_despesas_grid->StartRec = 1;
$rc25_a_planos_despesas_grid->StopRec = $rc25_a_planos_despesas_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($rc25_a_planos_despesas_grid->FormKeyCountName) && ($rc25_a_planos_despesas->CurrentAction == "gridadd" || $rc25_a_planos_despesas->CurrentAction == "gridedit" || $rc25_a_planos_despesas->CurrentAction == "F")) {
		$rc25_a_planos_despesas_grid->KeyCount = $objForm->GetValue($rc25_a_planos_despesas_grid->FormKeyCountName);
		$rc25_a_planos_despesas_grid->StopRec = $rc25_a_planos_despesas_grid->StartRec + $rc25_a_planos_despesas_grid->KeyCount - 1;
	}
}
$rc25_a_planos_despesas_grid->RecCnt = $rc25_a_planos_despesas_grid->StartRec - 1;
if ($rc25_a_planos_despesas_grid->Recordset && !$rc25_a_planos_despesas_grid->Recordset->EOF) {
	$rc25_a_planos_despesas_grid->Recordset->MoveFirst();
	$bSelectLimit = $rc25_a_planos_despesas_grid->UseSelectLimit;
	if (!$bSelectLimit && $rc25_a_planos_despesas_grid->StartRec > 1)
		$rc25_a_planos_despesas_grid->Recordset->Move($rc25_a_planos_despesas_grid->StartRec - 1);
} elseif (!$rc25_a_planos_despesas->AllowAddDeleteRow && $rc25_a_planos_despesas_grid->StopRec == 0) {
	$rc25_a_planos_despesas_grid->StopRec = $rc25_a_planos_despesas->GridAddRowCount;
}

// Initialize aggregate
$rc25_a_planos_despesas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$rc25_a_planos_despesas->ResetAttrs();
$rc25_a_planos_despesas_grid->RenderRow();
if ($rc25_a_planos_despesas->CurrentAction == "gridadd")
	$rc25_a_planos_despesas_grid->RowIndex = 0;
if ($rc25_a_planos_despesas->CurrentAction == "gridedit")
	$rc25_a_planos_despesas_grid->RowIndex = 0;
while ($rc25_a_planos_despesas_grid->RecCnt < $rc25_a_planos_despesas_grid->StopRec) {
	$rc25_a_planos_despesas_grid->RecCnt++;
	if (intval($rc25_a_planos_despesas_grid->RecCnt) >= intval($rc25_a_planos_despesas_grid->StartRec)) {
		$rc25_a_planos_despesas_grid->RowCnt++;
		if ($rc25_a_planos_despesas->CurrentAction == "gridadd" || $rc25_a_planos_despesas->CurrentAction == "gridedit" || $rc25_a_planos_despesas->CurrentAction == "F") {
			$rc25_a_planos_despesas_grid->RowIndex++;
			$objForm->Index = $rc25_a_planos_despesas_grid->RowIndex;
			if ($objForm->HasValue($rc25_a_planos_despesas_grid->FormActionName))
				$rc25_a_planos_despesas_grid->RowAction = strval($objForm->GetValue($rc25_a_planos_despesas_grid->FormActionName));
			elseif ($rc25_a_planos_despesas->CurrentAction == "gridadd")
				$rc25_a_planos_despesas_grid->RowAction = "insert";
			else
				$rc25_a_planos_despesas_grid->RowAction = "";
		}

		// Set up key count
		$rc25_a_planos_despesas_grid->KeyCount = $rc25_a_planos_despesas_grid->RowIndex;

		// Init row class and style
		$rc25_a_planos_despesas->ResetAttrs();
		$rc25_a_planos_despesas->CssClass = "";
		if ($rc25_a_planos_despesas->CurrentAction == "gridadd") {
			if ($rc25_a_planos_despesas->CurrentMode == "copy") {
				$rc25_a_planos_despesas_grid->LoadRowValues($rc25_a_planos_despesas_grid->Recordset); // Load row values
				$rc25_a_planos_despesas_grid->SetRecordKey($rc25_a_planos_despesas_grid->RowOldKey, $rc25_a_planos_despesas_grid->Recordset); // Set old record key
			} else {
				$rc25_a_planos_despesas_grid->LoadRowValues(); // Load default values
				$rc25_a_planos_despesas_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$rc25_a_planos_despesas_grid->LoadRowValues($rc25_a_planos_despesas_grid->Recordset); // Load row values
		}
		$rc25_a_planos_despesas->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($rc25_a_planos_despesas->CurrentAction == "gridadd") // Grid add
			$rc25_a_planos_despesas->RowType = EW_ROWTYPE_ADD; // Render add
		if ($rc25_a_planos_despesas->CurrentAction == "gridadd" && $rc25_a_planos_despesas->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$rc25_a_planos_despesas_grid->RestoreCurrentRowFormValues($rc25_a_planos_despesas_grid->RowIndex); // Restore form values
		if ($rc25_a_planos_despesas->CurrentAction == "gridedit") { // Grid edit
			if ($rc25_a_planos_despesas->EventCancelled) {
				$rc25_a_planos_despesas_grid->RestoreCurrentRowFormValues($rc25_a_planos_despesas_grid->RowIndex); // Restore form values
			}
			if ($rc25_a_planos_despesas_grid->RowAction == "insert")
				$rc25_a_planos_despesas->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$rc25_a_planos_despesas->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($rc25_a_planos_despesas->CurrentAction == "gridedit" && ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_EDIT || $rc25_a_planos_despesas->RowType == EW_ROWTYPE_ADD) && $rc25_a_planos_despesas->EventCancelled) // Update failed
			$rc25_a_planos_despesas_grid->RestoreCurrentRowFormValues($rc25_a_planos_despesas_grid->RowIndex); // Restore form values
		if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_EDIT) // Edit row
			$rc25_a_planos_despesas_grid->EditRowCnt++;
		if ($rc25_a_planos_despesas->CurrentAction == "F") // Confirm row
			$rc25_a_planos_despesas_grid->RestoreCurrentRowFormValues($rc25_a_planos_despesas_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$rc25_a_planos_despesas->RowAttrs = array_merge($rc25_a_planos_despesas->RowAttrs, array('data-rowindex'=>$rc25_a_planos_despesas_grid->RowCnt, 'id'=>'r' . $rc25_a_planos_despesas_grid->RowCnt . '_rc25_a_planos_despesas', 'data-rowtype'=>$rc25_a_planos_despesas->RowType));

		// Render row
		$rc25_a_planos_despesas_grid->RenderRow();

		// Render list options
		$rc25_a_planos_despesas_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($rc25_a_planos_despesas_grid->RowAction <> "delete" && $rc25_a_planos_despesas_grid->RowAction <> "insertdelete" && !($rc25_a_planos_despesas_grid->RowAction == "insert" && $rc25_a_planos_despesas->CurrentAction == "F" && $rc25_a_planos_despesas_grid->EmptyRow())) {
?>
	<tr<?php echo $rc25_a_planos_despesas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_planos_despesas_grid->ListOptions->Render("body", "left", $rc25_a_planos_despesas_grid->RowCnt);
?>
	<?php if ($rc25_a_planos_despesas->despesa_nome->Visible) { // despesa_nome ?>
		<td data-name="despesa_nome"<?php echo $rc25_a_planos_despesas->despesa_nome->CellAttributes() ?>>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $rc25_a_planos_despesas_grid->RowCnt ?>_rc25_a_planos_despesas_despesa_nome" class="form-group rc25_a_planos_despesas_despesa_nome">
<input type="text" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_despesas->despesa_nome->EditValue ?>"<?php echo $rc25_a_planos_despesas->despesa_nome->EditAttributes() ?>>
</span>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $rc25_a_planos_despesas_grid->RowCnt ?>_rc25_a_planos_despesas_despesa_nome" class="form-group rc25_a_planos_despesas_despesa_nome">
<input type="text" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_despesas->despesa_nome->EditValue ?>"<?php echo $rc25_a_planos_despesas->despesa_nome->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $rc25_a_planos_despesas_grid->RowCnt ?>_rc25_a_planos_despesas_despesa_nome" class="rc25_a_planos_despesas_despesa_nome">
<span<?php echo $rc25_a_planos_despesas->despesa_nome->ViewAttributes() ?>>
<?php echo $rc25_a_planos_despesas->despesa_nome->ListViewValue() ?></span>
</span>
<?php if ($rc25_a_planos_despesas->CurrentAction <> "F") { ?>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="frc25_a_planos_despesasgrid$x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="frc25_a_planos_despesasgrid$x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->FormValue) ?>">
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="frc25_a_planos_despesasgrid$o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="frc25_a_planos_despesasgrid$o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_id" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_id->CurrentValue) ?>">
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_id" name="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" id="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_id->OldValue) ?>">
<?php } ?>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_EDIT || $rc25_a_planos_despesas->CurrentMode == "edit") { ?>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_id" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_id" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_planos_despesas_grid->ListOptions->Render("body", "right", $rc25_a_planos_despesas_grid->RowCnt);
?>
	</tr>
<?php if ($rc25_a_planos_despesas->RowType == EW_ROWTYPE_ADD || $rc25_a_planos_despesas->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
frc25_a_planos_despesasgrid.UpdateOpts(<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($rc25_a_planos_despesas->CurrentAction <> "gridadd" || $rc25_a_planos_despesas->CurrentMode == "copy")
		if (!$rc25_a_planos_despesas_grid->Recordset->EOF) $rc25_a_planos_despesas_grid->Recordset->MoveNext();
}
?>
<?php
	if ($rc25_a_planos_despesas->CurrentMode == "add" || $rc25_a_planos_despesas->CurrentMode == "copy" || $rc25_a_planos_despesas->CurrentMode == "edit") {
		$rc25_a_planos_despesas_grid->RowIndex = '$rowindex$';
		$rc25_a_planos_despesas_grid->LoadRowValues();

		// Set row properties
		$rc25_a_planos_despesas->ResetAttrs();
		$rc25_a_planos_despesas->RowAttrs = array_merge($rc25_a_planos_despesas->RowAttrs, array('data-rowindex'=>$rc25_a_planos_despesas_grid->RowIndex, 'id'=>'r0_rc25_a_planos_despesas', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($rc25_a_planos_despesas->RowAttrs["class"], "ewTemplate");
		$rc25_a_planos_despesas->RowType = EW_ROWTYPE_ADD;

		// Render row
		$rc25_a_planos_despesas_grid->RenderRow();

		// Render list options
		$rc25_a_planos_despesas_grid->RenderListOptions();
		$rc25_a_planos_despesas_grid->StartRowCnt = 0;
?>
	<tr<?php echo $rc25_a_planos_despesas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$rc25_a_planos_despesas_grid->ListOptions->Render("body", "left", $rc25_a_planos_despesas_grid->RowIndex);
?>
	<?php if ($rc25_a_planos_despesas->despesa_nome->Visible) { // despesa_nome ?>
		<td data-name="despesa_nome">
<?php if ($rc25_a_planos_despesas->CurrentAction <> "F") { ?>
<span id="el$rowindex$_rc25_a_planos_despesas_despesa_nome" class="form-group rc25_a_planos_despesas_despesa_nome">
<input type="text" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->getPlaceHolder()) ?>" value="<?php echo $rc25_a_planos_despesas->despesa_nome->EditValue ?>"<?php echo $rc25_a_planos_despesas->despesa_nome->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_rc25_a_planos_despesas_despesa_nome" class="form-group rc25_a_planos_despesas_despesa_nome">
<span<?php echo $rc25_a_planos_despesas->despesa_nome->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rc25_a_planos_despesas->despesa_nome->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="x<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="rc25_a_planos_despesas" data-field="x_despesa_nome" name="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" id="o<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>_despesa_nome" value="<?php echo ew_HtmlEncode($rc25_a_planos_despesas->despesa_nome->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rc25_a_planos_despesas_grid->ListOptions->Render("body", "right", $rc25_a_planos_despesas_grid->RowIndex);
?>
<script type="text/javascript">
frc25_a_planos_despesasgrid.UpdateOpts(<?php echo $rc25_a_planos_despesas_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($rc25_a_planos_despesas->CurrentMode == "add" || $rc25_a_planos_despesas->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $rc25_a_planos_despesas_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_planos_despesas_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_planos_despesas_grid->KeyCount ?>">
<?php echo $rc25_a_planos_despesas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_planos_despesas->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $rc25_a_planos_despesas_grid->FormKeyCountName ?>" id="<?php echo $rc25_a_planos_despesas_grid->FormKeyCountName ?>" value="<?php echo $rc25_a_planos_despesas_grid->KeyCount ?>">
<?php echo $rc25_a_planos_despesas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($rc25_a_planos_despesas->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="frc25_a_planos_despesasgrid">
</div>
<?php

// Close recordset
if ($rc25_a_planos_despesas_grid->Recordset)
	$rc25_a_planos_despesas_grid->Recordset->Close();
?>
<?php if ($rc25_a_planos_despesas_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($rc25_a_planos_despesas_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($rc25_a_planos_despesas_grid->TotalRecs == 0 && $rc25_a_planos_despesas->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($rc25_a_planos_despesas_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($rc25_a_planos_despesas->Export == "") { ?>
<script type="text/javascript">
frc25_a_planos_despesasgrid.Init();
</script>
<?php } ?>
<?php
$rc25_a_planos_despesas_grid->Page_Terminate();
?>
