<script>
$(document).ready(function() {    
    $('#payment-dropdown').on('change', function() {
            var payment_id = this.value;
            $.ajax({
                url: "include/fetch_request.php",
                type: "POST",
                data: {
                    payment_id: payment_id
                },
                cache: false,
                success: function(result){
                    $("#amount-dropdown").html(result);
                }
            });
		});
	});
</script>
