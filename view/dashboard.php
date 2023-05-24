<?php
   include ("../config/dbconnection.php");
   include ("../config/navigationbar.php");

   $sql1 = "SELECT COUNT(*) FROM form WHERE form_state = 99";
   $result_1 = mysqli_query($conn, $sql1);
   $c_completed = mysqli_fetch_row($result_1)[0];

   $sql2 = "SELECT COUNT(*) FROM form WHERE form_state = 98";
   $result_2 = mysqli_query($conn, $sql2);
   $c_rejected = mysqli_fetch_row($result_2)[0];

   $sql3 = "SELECT COUNT(*) FROM form WHERE form_state NOT IN (99, 98)";
   $result_3 = mysqli_query($conn, $sql3);
   $c_pending = mysqli_fetch_row($result_3)[0];

   $sql4 = "SELECT COUNT(*) FROM form WHERE disposition_chk = 'Write Off'";
   $result_4 = mysqli_query($conn, $sql4);
   $c_wo = mysqli_fetch_row($result_4)[0];

?>

<?php
   // Pie Chart
   // Query to fetch all records and group by category
   $sql = "SELECT defect_cat, COUNT(*) AS total FROM form GROUP BY defect_cat";

   // Execute the query
   $result = mysqli_query($conn, $sql);

   // Initialize an empty array to store the data
   $chart_data = array(
      'labels' => array(),
      'datasets' => array(
         array(
            'data' => array(),
            'backgroundColor' => array('#CB4335', '#1F618D', '#F1C40F', '#884EA0')
            // backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0'],
         )
      )
   );

   // Loop through the result set and store the data in the array
   while ($row = mysqli_fetch_assoc($result)) {
      $chart_data['labels'][] = $row['defect_cat'];
      $chart_data['datasets'][0]['data'][] = $row['total'];
   }

   // Set chart options
   $chart_options = array(
      'title' => array(
         'display' => true,
         'text' => 'NCMR by Defect Category',
         'fontSize' => 16,
         'fontStyle' => 'bold',
         'padding' => 20
      ),
      'legend' => array(
         'position' => 'bottom'
      )
   )
?>
<!-- Add a new canvas for the bar chart -->

<?php
   // Bar Chart
   // Query to fetch the latest 5 months of records and group by month
   $sql2 = "SELECT DATE_FORMAT(issue_date, '%M %Y') AS month_year, COUNT(*) AS total FROM form WHERE issue_date >= DATE_FORMAT(CURRENT_DATE - INTERVAL 5 MONTH, '%Y-%m-01') GROUP BY month_year ORDER BY issue_date DESC";

   // Execute the query
   $result2 = mysqli_query($conn, $sql2);

   // Initialize an empty array to store the data
   $chart_data2 = array(
      'labels' => array(),
      'datasets' => array(
         array(
            'label' => 'No of NCMR',
            'data' => array(),
            'backgroundColor' => array('#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0')
         )
      )
   );

   // Loop through the result set and store the data in the array
   while ($row2 = mysqli_fetch_assoc($result2)) {
      $chart_data2['labels'][] = $row2['month_year'];
      $chart_data2['datasets'][0]['data'][] = $row2['total'];
   }

   // Set chart options
   $chart_options2 = array(
      'title' => array(
         'display' => true,
         'text' => 'NCMR by Last 5 Months',
         'position' => 'top',
         'fontSize' => 16,
         'fontStyle' => 'bold',
         'padding' => 20
      ),
      'legend' => array(
         'display' => false,
      ),
      'scales' => array(
         'yAxes' => array(
            array(
               'ticks' => array(
                  'beginAtZero' => true,
                  'stepSize' => 1
               )
            )
         )
      )
   );
?>

<?php
   // Bar Chart
   // Query to fetch all records and group by category
   $sql3 = "SELECT detected_at, COUNT(*) AS total FROM form GROUP BY detected_at";

   // Execute the query
   $result3 = mysqli_query($conn, $sql3);

   // Initialize an empty array to store the data
   $chart_data3 = array(
      'labels' => array(),
      'datasets' => array(
         array(
            'label' => 'Number of Records',
            'data' => array(),
            'backgroundColor' => array('#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0','#E67E22','#3498DB','#16A085','8E44AD'),
            'borderWidth' => 1
         )
      )
   );

   // Loop through the result set and store the data in the array
   while ($row3 = mysqli_fetch_assoc($result3)) {
      $chart_data3['labels'][] = $row3['detected_at'];
      $chart_data3['datasets'][0]['data'][] = $row3['total'];
   }

   // Set chart options
   $chart_options3 = array(
      'title' => array(
         'display' => true,
         'text' => 'NCMR by Detected Place',
         'fontSize' => 16,
         'fontStyle' => 'bold',
         'padding' => 20
      ),
      'legend' => array(
         'display' => false
      ),
      'scales' => array(
         'yAxes' => array(
            array(
               'ticks' => array(
                  'beginAtZero' => true,
                  'stepSize' => 1
               )
            )
         )
      )
   );
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
      <style>
         .chart-container {
            width: 50%;
            margin: auto;
         }
         .chart-box {
            display: inline-block;
            width: 100%;
         }
      </style>
   </head>
   <body>
      <br>
      <div class="container-fluid pt-3">
         <div class="row row-cols-md-4 g-3">
            <div class="col mb-3">
               <div class="card text-white bg-success">
                  <div class="card-body text-center">
                     <p class="card-text" style="font-size:68px;"><b><?php echo $c_completed; ?></b></p>
                  </div>
                  <h5 class="card-footer text-center"><i class="fa fa-check-circle"></i>    COMPLETED</h5>
               </div>
            </div>
            <div class="col mb-3">
               <div class="card text-white bg-warning">
                  <div class="card-body text-center">
                     <p class="card-text" style="font-size:68px;"><b><?php echo $c_pending; ?></b></p>
                  </div>
                  <h5 class="card-footer text-center"><i class="fa fa-clock"></i>    PENDING</h5>
               </div>
            </div>
            <div class="col mb-3">
               <div class="card text-white bg-danger">
                  <div class="card-body text-center">
                     <p class="card-text" style="font-size:68px;"><b><?php echo $c_rejected; ?></b></p>
                  </div>
                  <h5 class="card-footer text-center"><i class="fa fa-times-circle"></i>    REJECTED</h5>
               </div>
            </div>
            <div class="col mb-3">
               <div class="card text-white bg-info">
                  <div class="card-body text-center">
                     <p class="card-text" style="font-size:68px;"><b><?php echo $c_wo; ?></b></p>
                  </div>
                  <h5 class="card-footer text-center"><i class="fa fa-recycle"></i>    WRITE OFF</h5>
               </div>
            </div>
         </div>
      </div>
      <br>
      <div class="container-fluid">
			<div class="row">
				<div class="col">
               <div class="chart-box">
                  <div>
                     <canvas id="pie-chart"></canvas>
                  </div>
               </div>
				</div>
            <div class="col">
               <div class="chart-box">
                  <div>
                     <canvas id="bar-chart"></canvas>
                  </div>
					</div>
				</div>
         </div>
         <!-- <div class="row">
            <div class="col">
               <div class="chart-box">
                  <div>
                     <canvas id="myChart4"></canvas>
                  </div>
					</div>
				</div>
            <div class="col">
               <div class="chart-box">
                  <div>
                     <canvas id="myChart"></canvas>
                  </div>
					</div>
				</div>
         </div> -->
         <div class="row">
            <div class="col col-md-1"></div>
            <div class="col">
               <div class="chart-box">
                  <div>
                     <canvas id="myChart"></canvas>
                  </div>
               </div>
            </div>
            <div class="col col-md-1"></div>
         </div>
		</div>
   </body>
</html>

<script>
   var ctx = document.getElementById("pie-chart").getContext("2d");
   var myChart = new Chart(ctx, {
      type: "pie",
      data: <?php echo json_encode($chart_data); ?>,
      options: <?php echo json_encode($chart_options); ?>
   });
</script>
<script>
   // Initialize a new bar chart
   var ctx2 = document.getElementById("bar-chart").getContext("2d");
   var myChart2 = new Chart(ctx2, {
      type: "bar",
      data: <?php echo json_encode($chart_data2); ?>,
      options: <?php echo json_encode($chart_options2); ?>
   });
</script>

<!-- Script to generate the chart using Chart.js -->
<script>
   var ctx3 = document.getElementById('myChart').getContext('2d');
   var myChart3 = new Chart(ctx3, {
      type: 'bar',
      data: <?php echo json_encode($chart_data3); ?>,
      options: <?php echo json_encode($chart_options3); ?>
   });
</script>
