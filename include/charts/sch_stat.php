<?php
	 $result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<($class_limit) GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 $chart_data = "";
	 if(mysqli_num_rows($result) == true){
		 foreach ($result as $row) { 
			$classes[]  = getClass($row['class_id']).getCategory($row['cat_id']);
		 }
	 } else {
		$classes[] = 'Class';
	 }


	 $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(sex_id) AS male FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sex_id='1' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<($class_limit)  GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 if(mysqli_num_rows($result) == true){
		 foreach ($result as $row){
			$male[] = $row['male']; 
		 }
	} else {
		$male[] = '0';
	}
	
	 $result = mysqli_query($conn,"SELECT DISTINCT *, COUNT(sex_id) AS female FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sex_id='2' AND stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<($class_limit)  GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	 if(mysqli_num_rows($result) == true){
		 foreach ($result as $row){
			$female[] = $row['female']; 
		 }
	 } else {
		 $female[] = '0';
	 }

    $result = mysqli_query($conn,"SELECT DISTINCT class_id, COUNT(class_id) AS num FROM stdnt_info WHERE sch_id='$sch_id'  AND stdnt_info.class_id<($class_limit) ");
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row){
			$number[] = $row['num'];
		}
	} else {
		$number[] = '0';
	}
	
	 $result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND class_info.class_id<($class_limit) GROUP BY stdnt_info.class_id ORDER BY stdnt_info.class_id");
	 $chart_data = "";
	 if(mysqli_num_rows($result) == true){
		 foreach ($result as $row) { 
			$class[] = getClass($row['class_id']);
		 }
	 } else {
		 $class[] = 'Class';
	 }
	 
	 $result = mysqli_query($conn,"SELECT DISTINCT user_id, COUNT(user_id) AS numclass FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND class_info.class_id<($class_limit) GROUP BY stdnt_info.class_id ORDER BY stdnt_info.class_id");
	 if(mysqli_num_rows($result) == true){
		 foreach ($result as $row){
			$numclass[] = $row['numclass']; 
		 }
	 } else {
		 $numclass[] = '0';
	 }

	$result = mysqli_query($conn,"SELECT DISTINCT * FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id < $class_limit GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
			$class_num[]  = getClass($row['class_id']).getCategory($row['cat_id']);
		}
	} else {
		$class_num[] = '0';
	}
	
	$result = mysqli_query($conn,"SELECT DISTINCT user_id, COUNT(user_id) AS num_in_class FROM stdnt_info JOIN class_info ON stdnt_info.class_id=class_info.class_id WHERE stdnt_info.sch_id='$sch_id' AND stdnt_info.class_id = class_info.class_id AND stdnt_info.status_id = '1' AND stdnt_info.class_id<($class_limit) GROUP BY stdnt_info.class_id,stdnt_info.cat_id ORDER BY stdnt_info.class_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
			$num_class[] = $row['num_in_class'];
		}
	} else {
		$num_class[] = '0';
	}

	//Number of teacher per subject
	$subj_name = mysqli_query($conn,"SELECT DISTINCT subj_id FROM staff_info WHERE sch_id='$sch_id' AND subj_id !=0 GROUP BY subj_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($subj_name as $row) { 
			$subject[]  = getSubject($row['subj_id']);//Subjects
			$sct = $row['subj_id'];

		$result = mysqli_query($conn,"SELECT *, COUNT(DISTINCT user_id) AS num_staff FROM staff_info WHERE sch_id = '$sch_id' AND subj_id = '$sct' GROUP BY user_id AND class_id");
		
		$row = mysqli_fetch_array($result);
		$staff_num[]  = $row['num_staff']; 
		}
	} else {
		$subject[] = 'Subject';
		$staff_num[] = '0';
	}
	
	//Department
	$result = mysqli_query($conn,"SELECT DISTINCT dept_id FROM staff_info WHERE sch_id='$sch_id' AND dept_id!='0' GROUP BY dept_id ORDER BY dept_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
			$dept[]  = getDept($row['dept_id']);
			$dpt = $row['dept_id'];
	 
		//Number of Staff in department
		$result = mysqli_query($conn,"SELECT user_id, COUNT(DISTINCT user_id) AS deptnum_staff FROM staff_info WHERE sch_id = '$sch_id' AND dept_id = '$dpt' AND dept_id!='0'");
		//"SELECT *, COUNT(staff_info.dept_id) AS deptnum_staff FROM staff_info JOIN sch_users ON staff_info.user_id=sch_users.user_id WHERE staff_info.sch_id = '$sch_id' AND staff_info.subj_id !=0 GROUP BY  staff_info.dept_id,sch_users.user_id ORDER BY staff_info.dept_id"
		$chart_data="";
		$row = mysqli_fetch_array($result); 
			$deptstaff_num[]  = $row['deptnum_staff'];
		}
	} else {
		$dept[] = 'Department';
		$deptstaff_num[] = '0';
	}
	
	//Clubs and Society
	$result = mysqli_query($conn,"SELECT DISTINCT club_id FROM stdnt_info WHERE sch_id='$sch_id' AND club_id!='0' GROUP BY club_id ORDER BY club_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
			$club[]  = getClub($row['club_id']);
			$clb = $row['club_id'];
		 
		//Number of Students in Club and Society
		$result = mysqli_query($conn,"SELECT user_id, COUNT(DISTINCT user_id) AS num_club FROM stdnt_info WHERE sch_id = '$sch_id' AND club_id = '$clb' AND club_id!='0'");
		$chart_data = "";
			$row = mysqli_fetch_array($result); 
			$club_num[]  = $row['num_club'];
		}
	} else {
		$club[] = 'Clubs & Societies';
		$club_num[] = '0';
	}
	
	//House
	$result = mysqli_query($conn,"SELECT DISTINCT house_id FROM stdnt_info WHERE sch_id='$sch_id' AND house_id!='0' GROUP BY house_id ORDER BY house_id");
	$chart_data="";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
			$house[]  = getHouse($row['house_id']);
			$hous = $row['house_id'];
		 
		//Number of Students in Club and Society
		$result = mysqli_query($conn,"SELECT user_id, COUNT(DISTINCT user_id) AS num_house FROM stdnt_info WHERE sch_id = '$sch_id' AND house_id = '$hous' AND house_id!='0'");
		$chart_data = "";
			$row = mysqli_fetch_array($result); 
			$house_num[]  = $row['num_house'];
		}
	} else {
		$house[] = 'House';
		$house_num[] = '0';
	}
 
	// Assuming $house_colors is an array of colors associated with each house
	$hc = mysqli_query($conn,"SELECT house_color FROM house_info WHERE sch_id='$sch_id'");
	if(mysqli_num_rows($hc) == true){
		foreach ($hc as $row) { 
			$house_colors[] = $row['house_color'];
		}
	} else {
		$house_colors[] = '0';
	}
	
	//Graduated Students
	$result = mysqli_query($conn,"SELECT DISTINCT yid FROM stdnt_info WHERE sch_id='$sch_id' AND class_id > ($class_limit - 1) ORDER BY yid");// 
	$chart_data = "";
	if(mysqli_num_rows($result) == true){
		foreach ($result as $row) { 
		$year[]  = getYear($row['yid']);
		$ryear = $row['yid'];

		$result = mysqli_query($conn,"SELECT DISTINCT yid, COUNT(user_id) AS num_grad FROM stdnt_info WHERE sch_id='$sch_id' AND yid='$ryear'");
		$row = mysqli_fetch_array($result);
			$numGrad[] = $row['num_grad']; 	
		}
	} else {
		$year[]  = 'Year of graduation';
		$numGrad[] = '0'; 	
	}
/*SELECT DISTINCT *, COUNT(staff_info.user_id AND staff_info.subj_id) AS num_staff FROM staff_info WHERE staff_info.sch_id = '$sch_id' AND staff_info.subj_id !=0 GROUP BY staff_info.subj_id,staff_info.class_id ORDER BY staff_info.subj_id ------- 2. latest ----- SELECT *, COUNT(user_id AND subj_id) AS num_staff FROM staff_info WHERE sch_id = '$sch_id' GROUP BY user_id,class_id,cat_id HAVING COUNT(user_id) > 0 ORDER BY staff_info.subj_id*/
/*perfect for one teacher, one subject per class  $result = mysqli_query($conn,"SELECT *, COUNT(DISTINCT user_id) AS num_staff FROM staff_info WHERE sch_id = '$sch_id' AND subj_id = '$sct' GROUP BY user_id AND class_id");*/
//Number of Staff //SELECT subj_id, COUNT(DISTINCT staff_id) AS num_staff FROM staff_info GROUP BY subj_id FROM staff_info GROUP BY subj_id	
?>
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

var ctx = document.getElementById("Chart2").getContext("2d");
var data = {
    labels: <?php echo json_encode($class_num); ?>,
    datasets: [
        {
			label               : 'Number in Class',
			backgroundColor     : 'rgba(60,141,188,0.9)',
			borderColor         : 'rgba(60,141,188,0.8)',
			pointRadius         : false,
			pointColor          : 'rgba(210, 214, 222, 1)',
			pointStrokeColor    : '#c1c7d1',
			pointHighlightFill  : '#fff',
			pointHighlightStroke: 'rgba(220,220,220,1)',
			data                : <?php echo json_encode($num_class); ?>
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

var ctx1 = document.getElementById("staffChart").getContext("2d");
var data = {
    labels: <?php echo json_encode($subject); ?>,
    datasets: [
        {
          label               : 'Number of Subject Teachers',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($staff_num); ?>
        }
    ]
};

var myBarChart = new Chart(ctx1, {
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

var ctx2 = document.getElementById("deptChart").getContext("2d");
var data = {
    labels: <?php echo json_encode($dept); ?>,
    datasets: [
        {
			label               : 'Number of Staff',
          backgroundColor     : 'hsl(120, 43%, 34%)',
          borderColor         : 'hsl(120, 43%, 34%)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : <?php echo json_encode($deptstaff_num); ?>
        }
    ]
};

var myBarChart = new Chart(ctx2, {
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

var ctx3 = document.getElementById("clubChart").getContext("2d");
var data = {
    labels: <?php echo json_encode($club); ?>,
    datasets: [
        {
			label               : 'Number of Student',
			backgroundColor     : 'hsl(990, 53%, 40%)',
			borderColor         : 'hsl(120, 43%, 34%)',
			pointRadius         : false,
			pointColor          : 'rgba(210, 214, 222, 1)',
			pointStrokeColor    : '#c1c7d1',
			pointHighlightFill  : '#fff',
			pointHighlightStroke: 'rgba(220,220,220,1)',
			data                : <?php echo json_encode($club_num); ?>
        }
    ]
};

var myBarChart = new Chart(ctx3, {
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

var ctx4 = document.getElementById("houseChart").getContext("2d");

// Assuming $house_colors is an array of colors associated with each house
var data = {
    labels: <?php echo json_encode($house); ?>,
    datasets: [
        {
            //label: 'Number of Student',
            backgroundColor: <?php echo json_encode($house_colors); ?>,
            borderColor: 'hsl(120, 43%, 34%)', // Border color for all bars
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: <?php echo json_encode($house_num); // An array of data values corresponding to each bar ?>
        }
    ]
};

var myBarChart = new Chart(ctx4, {
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

var gradxChart = document.getElementById("gradChart").getContext("2d");
var data = {
    labels: <?php echo json_encode($year); ?>,
    datasets: [
        {
			label               : 'Number of Graduated Student',
			backgroundColor     : 'hsl(790, 53%, 40%)',
			borderColor         : 'hsl(120, 43%, 34%)',
			pointRadius         : false,
			pointColor          : 'rgba(210, 214, 222, 1)',
			pointStrokeColor    : '#c1c7d1',
			pointHighlightFill  : '#fff',
			pointHighlightStroke: 'rgba(220,220,220,1)',
			data                : <?php echo json_encode($numGrad); ?>
        }
    ]
};

var myBarChart = new Chart(gradxChart, {
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
