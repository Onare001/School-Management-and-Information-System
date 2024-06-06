<script>
$(document).ready(function() {
    $('.custom-control-input').change(function() {
        var isChecked = $(this).prop('checked');
        var id = $(this).data('tid');
        var state = $(this).data('state');
		var table = $(this).data('table');
        var statusCell = $('#status-' + id);

        $.ajax({
            url: 'include/switch.php',
            type: 'POST',
            data: {id: id, state: state, table: table, isChecked: isChecked},
            success: function(response) {
                //toastr.success("Successful...");
                if (isChecked) {
                    statusCell.text('Active');
					toastr.success("Activated");
                } else {
                    statusCell.text('Inactive');
					toastr.success("Deactivated");
                }
            }
        });
    });
});
</script>
