<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

// Get a field value
// NOTE: Modify your SQL here, replace the table name, field name and the condition

$MyCor = ew_ExecuteScalar("SELECT config_cor FROM rca25_configurar WHERE config_id = 1");

//echo $MyCor;
?>
