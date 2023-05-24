<?php
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
            'backgroundColor' => array('#FF6384', '#36A2EB', '#FFCE56', '#7BDCB5')
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
         'text' => 'Total NCMR by Defect Category'
      ),
      'tooltips' => array(
         'callbacks' => array(
            'label' => 'function(tooltipItem, data) {
               var label = data.labels[tooltipItem.index];
               var value = data.datasets[0].data[tooltipItem.index];
               var total = data.datasets[0].data.reduce(function(a, b) {
                  return a + b;
               }, 0);
               var percentage = Math.round((value / total) * 100);
               return label + ": " + value + " (" + percentage + "%)";
            }'
         )
      )
   )
?>
<!-- Add a new canvas for the bar chart -->

<?php
   // Query to fetch the latest 5 months of records and group by month
   // $sql2 = "SELECT DATE_FORMAT(issue_date, '%M %Y') AS month_year, COUNT(*) AS total FROM form WHERE issue_date >= DATE_FORMAT(CURRENT_DATE - INTERVAL 5 MONTH, '%Y-%m-01') GROUP BY month_year ORDER BY issue_date DESC";
   $sql2 = "SELECT COUNT(*) AS total FROM form GROUP BY form_state ORDER BY form_state DESC";

   // Execute the query
   $result2 = mysqli_query($conn, $sql2);

   // Initialize an empty array to store the data
   $chart_data2 = array(
      'labels' => array(),
      'datasets' => array(
         array(
            'label' => 'Number of Records',
            'data' => array(),
            'backgroundColor' => array('#FF6384', '#36A2EB', '#FFCE56', '#7BDCB5', '#4BC0C0')
         )
      )
   );

   // Loop through the result set and store the data in the array
   while ($row2 = mysqli_fetch_assoc($result2)) {
      $chart_data2['labels'][] = $row2['disposition_chk'];
      $chart_data2['datasets'][0]['data'][] = $row2['total'];
   }

   // Set chart options
   $chart_options2 = array(
      'title' => array(
         'display' => true,
         'text' => 'Total NCMR Forms Issued by Months',
         'position' => 'bottom'
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