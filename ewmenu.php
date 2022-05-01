<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(47, "mi_inicial_php", $Language->MenuPhrase("47", "MenuText"), "inicial.php", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(46, "mci_Arquivo", $Language->MenuPhrase("46", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(2, "mi_rc25_ano_vigente", $Language->MenuPhrase("2", "MenuText"), "rc25_ano_vigentelist.php", 46, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(25, "mi_rc25_a_rhpessoas", $Language->MenuPhrase("25", "MenuText"), "rc25_a_rhpessoaslist.php", 46, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(23, "mi_rc25_a_rhfuncoes", $Language->MenuPhrase("23", "MenuText"), "rc25_a_rhfuncoeslist.php", 46, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(26, "mi_rc25_a_ra_natureza", $Language->MenuPhrase("26", "MenuText"), "rc25_a_ra_naturezalist.php", 46, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(21, "mi_rc25_a_planos_despesas", $Language->MenuPhrase("21", "MenuText"), "rc25_a_planos_despesaslist.php", 46, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(124, "mci_Configurar", $Language->MenuPhrase("124", "MenuText"), "rca25_configuraredit.php?config_id=1", 46, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(77, "mci_Exibir", $Language->MenuPhrase("77", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(48, "mi_report_anos", $Language->MenuPhrase("48", "MenuText"), "report_anosreport.php", 77, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(19, "mi_rc25_a_termos", $Language->MenuPhrase("19", "MenuText"), "rc25_a_termoslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(22, "mi_rc25_a_planos_aplicacao", $Language->MenuPhrase("22", "MenuText"), "rc25_a_planos_aplicacaolist.php?cmd=resetall", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(24, "mi_rc25_a_recursos_humanos", $Language->MenuPhrase("24", "MenuText"), "rc25_a_recursos_humanoslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(27, "mi_rc25_a_recurso_aplicados", $Language->MenuPhrase("27", "MenuText"), "rc25_a_recurso_aplicadoslist.php", -1, "", TRUE, FALSE, FALSE, "");
$RootMenu->AddMenuItem(18, "mi_rc25_a_repasses", $Language->MenuPhrase("18", "MenuText"), "rc25_a_repasseslist.php?cmd=resetall", -1, "", TRUE, FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
