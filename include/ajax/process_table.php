<script>
$(document).ready(function() {    
	$('#select_year').on('change', function() {
		$("#loader").show();
			var yid = this.value;
			$.ajax({
				url: "process_table.php",
				type: "POST",
				data: {
					yid: yid
				},
				cache: false,
				success: function(result){
					$("#loader").hide();
					$("#graduated_students").show();
					$("#graduated_students").html(result);
				}
			});
		});
	});
</script>
