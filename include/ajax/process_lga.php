<script>
$(document).ready(function() {    
    $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "include/fetch_request.php",
                type: "POST",
                data: {
                    state_id: state_id
                },
                cache: false,
                success: function(result){
                    $("#lga-dropdown").html(result);
                }
            });
		});
	});
</script>
