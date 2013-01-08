<script>
$('#office_id').change(function(){

	
	//return
	var office_id = $(this)[0].value.toString();
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			$('#employee_id').append("<option value='" + key + "'>" + val + "</option>");

		});
	});

});

$('#go').click(function(){

	if ($('#employee_id').val() == 0)
	{
		alert("Please select employee");
		return false
	}

});
$(document).ready(function(){

	
	//return
	var office_id = $('#office_id').val()
	
	var selected = "";
		
	$.getJSON('<?php echo base_url();?>pds/employees/' + office_id, null, function (data) {
		
		$('#employee_id').empty().append("<option value='0'>--All--</option>");
		$.each(data, function (key, val) {
			
			if ( key == "<?php echo $employee_id;?>")
			{
				selected = "selected";
			}
			else
			{
				selected = "";
			}
			
			$('#employee_id').append("<option value='" + key + "' "+ selected +">" + val + "</option>");

		});
		
		$('#employee_id').sort();
	});
	

});

$(".remove_dtr").click(function(){
 	
	var sure = confirm("Remove?");
	
	if ( sure == false)
	{
		return false;
	}
		
	$('#messages').hide('fast');
		
	$('#messages').addClass("clean-green");
		
	$('#messages').load("<?php echo base_url().('ajax/remove_dtr/'); ?>" + $(this).attr("dtr_id"));
	
	$('#messages').show('fast');
	
	// hide the dtr
	$('#'+$(this).attr("dtr_id")).hide('fast');	
});
</script>