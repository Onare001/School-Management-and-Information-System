<style>
.button-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 10vh; /* Set the height of the container to the full viewport height */
}

#buttonn {
  margin: 0 10px; /* Add some space between the buttons */
}
</style>
<script>
  const checkAllCheckbox = document.getElementById('check-all');
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  
  checkAllCheckbox.addEventListener('click', () => {
    checkboxes.forEach((checkbox) => {
      checkbox.checked = checkAllCheckbox.checked;
    });
  });
  
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('click', () => {
      const allChecked = [...checkboxes].every((cb) => cb.checked);
      checkAllCheckbox.checked = allChecked;
    });
  });
</script>
<script>
	// Set the timeout period to 5 minutes (in milliseconds)
	const timeoutPeriod = 5 * 60 * 1000;

	// Set a timer to log out the user after the timeout period
	let timeoutId = setTimeout(logoutUser, timeoutPeriod);

	// Reset the timer if the user interacts with the page
	document.addEventListener("click", resetTimer);
	document.addEventListener("keypress", resetTimer);

	function resetTimer() {
	  clearTimeout(timeoutId);
	  timeoutId = setTimeout(logoutUser, timeoutPeriod);
	}

	function logoutUser() {
	  // Redirect the user to the logout page or execute any other logout logic
	  window.location.href = "lock_screen<?php echo '?u='.$user_id; ?>";
	}
	
</script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<script src="dist/js/demo.js"></script>

<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<4 GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 $chart_data = "";
	 foreach ($result as $row) { 
		$classes[]  = getClass($row['class_id']).getCategory($row['cat_id']);
	 }
?>
<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(sex_id) AS male FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sex_id='1' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<4  GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 foreach ($result as $row){
		$male[] = $row['male']; 
	 }
?>
<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(sex_id) AS female FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sex_id='2' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<4  GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 foreach ($result as $row){
		$female[] = $row['female']; 
	 }
?>
<?php
    $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(class_id) AS num FROM stdnt_info WHERE sch_id='$sch_id'  AND stdnt_info.class_id<4 ");
    foreach ($result as $row){
		$number[] = $row['num'];
	}
?>
<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND class_info.class_id<4 GROUP BY stdnt_info.class_id ORDER BY stdnt_info.class_id");
	 $chart_data = "";
	 foreach ($result as $row) { 
	 $class[]  = getClass($row['class_id']);
	 }
?>
<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(user_id) AS numclass FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND class_info.class_id<4 GROUP BY stdnt_info.class_id ORDER BY stdnt_info.class_id");
	 foreach ($result as $row){
	 $numclass[] = $row['numclass']; 
	 }
?>

<script src="dist/js/pages/dashboard2.js"></script>
<script>
  $(function () {
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#barChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : <?php echo json_encode($classes); ?>,
      datasets: [
        {
          label               : 'Female',
          backgroundColor     : 'pink',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($female); ?>
        },
        {
          label               : 'Male',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($male); ?>
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#barChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
    var donutData        = {
      labels: <?php echo json_encode($class); ?>,
      datasets: [
        {
          data: <?php echo json_encode($numclass); ?>,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'pie',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

 //-------------
    //- BAR CHART1 -
    //-------------
    var barChartCanvas = $('#barChart1').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

 //-------------
    //- BAR CHART2 -
    //-------------
    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    //var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    //barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>