<?php

// processo_exercicio
// processo_termo_num
// processo_numero
// processo_vigencia_ini
// processo_vigencia_fim

?>
<?php if ($rc25_a_termos->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_rc25_a_termosmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($rc25_a_termos->processo_exercicio->Visible) { // processo_exercicio ?>
		<tr id="r_processo_exercicio">
			<td class="col-sm-2"><?php echo $rc25_a_termos->processo_exercicio->FldCaption() ?></td>
			<td<?php echo $rc25_a_termos->processo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_exercicio">
<span<?php echo $rc25_a_termos->processo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_exercicio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_termo_num->Visible) { // processo_termo_num ?>
		<tr id="r_processo_termo_num">
			<td class="col-sm-2"><?php echo $rc25_a_termos->processo_termo_num->FldCaption() ?></td>
			<td<?php echo $rc25_a_termos->processo_termo_num->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_termo_num">
<span<?php echo $rc25_a_termos->processo_termo_num->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_termo_num->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_numero->Visible) { // processo_numero ?>
		<tr id="r_processo_numero">
			<td class="col-sm-2"><?php echo $rc25_a_termos->processo_numero->FldCaption() ?></td>
			<td<?php echo $rc25_a_termos->processo_numero->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_numero">
<span<?php echo $rc25_a_termos->processo_numero->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_numero->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_ini->Visible) { // processo_vigencia_ini ?>
		<tr id="r_processo_vigencia_ini">
			<td class="col-sm-2"><?php echo $rc25_a_termos->processo_vigencia_ini->FldCaption() ?></td>
			<td<?php echo $rc25_a_termos->processo_vigencia_ini->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_ini">
<span<?php echo $rc25_a_termos->processo_vigencia_ini->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_ini->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_termos->processo_vigencia_fim->Visible) { // processo_vigencia_fim ?>
		<tr id="r_processo_vigencia_fim">
			<td class="col-sm-2"><?php echo $rc25_a_termos->processo_vigencia_fim->FldCaption() ?></td>
			<td<?php echo $rc25_a_termos->processo_vigencia_fim->CellAttributes() ?>>
<span id="el_rc25_a_termos_processo_vigencia_fim">
<span<?php echo $rc25_a_termos->processo_vigencia_fim->ViewAttributes() ?>>
<?php echo $rc25_a_termos->processo_vigencia_fim->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
