<?php
// You can work with the variable passed to the view file
?>
<input id="btnAlertDate" type="button" value="Alert date" />
<script type="text/javascript">
$('#btnAlertDate').click(function(){
	alert('<?php echo $date; ?>');
});
</script>