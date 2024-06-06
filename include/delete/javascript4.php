<script>
function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=1000,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>

<script>
$(document).ready(function() {    
    $('#state-dropdown').on('change', function() {
            var state_id = this.value;
            $.ajax({
                url: "include/process-request.php",
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

<script>
$(document).ready(function() {    
    $('#payment-dropdown').on('change', function() {
            var payment_id = this.value;
            $.ajax({
                url: "include/process-request.php",
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

