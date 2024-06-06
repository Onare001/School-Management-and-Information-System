<?php
//For Labels
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT DISTINCT class_id,term_id,sid FROM score_info WHERE sch_id='$sch_id' AND user_id='$user_id' GROUP BY class_id ORDER BY sid");
	$chart_data = "";
	foreach ($result as $row) { 
		$term[]  = getClass($row['class_id']).'--'.getSession($row['sid']);
	}

//First Term
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT DISTINCT aggregate_score,term_id,sid FROM score_info WHERE sch_id='$sch_id' AND user_id='$user_id' AND term_id = '1' AND status='1' GROUP BY sid ORDER BY sid");
	$chart_data = "";
	foreach ($result as $row) { 
		$aggregate1[]  = $row['aggregate_score'];
	}

//Second Term
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT DISTINCT aggregate_score,term_id,sid FROM score_info WHERE sch_id='$sch_id' AND user_id='$user_id' AND term_id = '2' AND status='1' GROUP BY sid ORDER BY sid");
	$chart_data = "";
	foreach ($result as $row) { 
		$aggregate2[]  = $row['aggregate_score'];
	}

//Third Term
	include "include/connection.php";
	$result = mysqli_query($conn,"SELECT DISTINCT aggregate_score,term_id,sid FROM score_info WHERE sch_id='$sch_id' AND user_id='$user_id' AND term_id = '3' AND status='1' GROUP BY sid ORDER BY sid");
	$chart_data = "";
	foreach ($result as $row) { 
		$aggregate3[]  = $row['aggregate_score'];
	}
?>
<script>
var ctx = document.getElementById("myChart").getContext("2d");

var data = {
    labels: <?php echo json_encode($term); ?>,
    datasets: [
        {
            label: "First Term",
            backgroundColor: "blue",
            data: <?php echo (!empty($aggregate1)) ? json_encode($aggregate1) : '[0,0,0]'; ?>
			},
        {
            label: "Second term",
            backgroundColor: "red",
            data: <?php echo (!empty($aggregate2)) ? json_encode($aggregate2) : '[0,0,0]'; ?>
        },
        {
            label: "Third Term",
            backgroundColor: "green",
            data: <?php echo (!empty($aggregate3)) ? json_encode($aggregate3) : '[0,0,0]'; ?>
        }
    ]
};

var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        barValueSpacing: 20,
        scales: {
            yAxes: [{
                ticks: {
                    min: 0,
                }
            }]
        }
    }
});
</script>
