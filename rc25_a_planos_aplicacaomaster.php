<?php

// plano_exercicio
// plano_despesa
// plano_custo_mensal
// plano_custo_exercicio
// plano_recurso_municipal
// plano_outros_recursos

?>
<?php if ($rc25_a_planos_aplicacao->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_rc25_a_planos_aplicacaomaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($rc25_a_planos_aplicacao->plano_exercicio->Visible) { // plano_exercicio ?>
		<tr id="r_plano_exercicio">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_exercicio->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_exercicio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_despesa->Visible) { // plano_despesa ?>
		<tr id="r_plano_despesa">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_despesa->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_despesa->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_despesa">
<span<?php echo $rc25_a_planos_aplicacao->plano_despesa->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_despesa->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_mensal->Visible) { // plano_custo_mensal ?>
		<tr id="r_plano_custo_mensal">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_mensal">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_mensal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_custo_exercicio->Visible) { // plano_custo_exercicio ?>
		<tr id="r_plano_custo_exercicio">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_custo_exercicio">
<span<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_custo_exercicio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_recurso_municipal->Visible) { // plano_recurso_municipal ?>
		<tr id="r_plano_recurso_municipal">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_recurso_municipal">
<span<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_recurso_municipal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($rc25_a_planos_aplicacao->plano_outros_recursos->Visible) { // plano_outros_recursos ?>
		<tr id="r_plano_outros_recursos">
			<td class="col-sm-2"><?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->FldCaption() ?></td>
			<td<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->CellAttributes() ?>>
<span id="el_rc25_a_planos_aplicacao_plano_outros_recursos">
<span<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ViewAttributes() ?>>
<?php echo $rc25_a_planos_aplicacao->plano_outros_recursos->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
