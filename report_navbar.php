<?php
$ano = intval($_GET['ano'])
?>

<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">

<nav class="navbar navbar-expand navbar-light bg-light navbar0">
    <ul class="nav navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="report_anosreport.php">Voltar<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report_parceria_repassereport.php?ano=<?php echo $ano ?>">Parcerias</a>
        </li>        
        <li class="nav-item">
            <a class="nav-link" href="report_planos_aplicacao_report.php?ano=<?php echo $ano ?>">Plano de Aplicação</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report_rh_report.php?ano=<?php echo $ano ?>">Recursos Humanos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report_terceiros_report.php?ano=<?php echo $ano ?>">Serviços de Terceiros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report_recursos_apl_report.php?ano=<?php echo $ano ?>">Recursos Aplicados</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#<?php echo $ano ?>">Anexo Parceria</a>
        </li>        
    </ul>
</nav>

</div>
    </div> 
        </div>