<?php include('connection.php');?>

<link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">
	
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/searchPanes.dataTables.min.css">
<link rel="stylesheet" href="css/select.dataTables.min.css">
<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.select.min.js"></script>
<script src="js/dataTables.searchPanes.min.js"></script>
<script src="js/highcharts.js"></script>
<style>
.override {background-color:transparent !important;}
#particles-js{
	position : relative;
	z-index :2;
	}
	
canvas.particles-js-el{
	position:absolute;
	top:0;
	left:0
	z-index:1;
	width:100%;
	height:100%;
}
</style>
<script>
$(document).ready(function () {
    // Create DataTable
    var table = $('#example').DataTable({
        dom: 'Pfrtip',
		 initComplete: function () {
            var api = this.api();
            api.$('td').click(function () {
                api.search(this.innerHTML).draw();
            });
			
			
        },
		
		
		  footerCallback: function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(4,{search:'applied'})
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(4, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Update footer
            $(api.column(4).footer()).html('Ksh' + pageTotal + ' ( Ksh' + total + ' total)');
        },
    
		
		
    });
 
    // Create the chart with initial data
    var container = $('<div/>').insertBefore(table.table().container());
 
    var chart = Highcharts.chart(container[0], {
        chart: {
            type: 'pie',
        },
        title: {
            text: '<?php echo date("Y")?> Sales Analytics',
        },
        series: [
            {
                data: chartData(table),
            },
        ],
    });
 
    // On each draw, update the data in the chart
    table.on('draw', function () {
        chart.series[0].setData(chartData(table));
    });
	
	
	
	
});
 
function chartData(table) {
    var counts = {};
 
    // Count the number of entries for each position
    table
        .column(1, { search: 'applied' })
        .data()
        .each(function (val) {
            if (counts[val]) {
                counts[val] += 1;
            } else {
                counts[val] = 1;
            }
        });
 
    // And map it to the format highcharts uses
    return $.map(counts, function (val, key) {
        return {
            name: key,
            y: val,
        };
    });
}
</script>

<body class="override">

<table id="example" class="display override" style="width:100%">
        <thead>
            
			   <th>Department</th>
			  <th>Amount</th>
			  <th>Profit</th>
			
        </thead>
        <tbody>
		
		   <?php
			  $tds = date("Y");
			  $gettds= mysqli_query($con,"select department,SUM(price) as price,SUM(profit) as profit from cart where dated like '%$tds%' group by department");
			  while($getrec = mysqli_fetch_array($gettds)){
				  echo '<tr>';
				  echo '<td>'.$getrec['department'].'</td>';
				  echo '<td>'.$getrec['price'].'</td>';
				  echo '<td>'.$getrec['profit'].'</td>';
				 
				  echo '</tr>';
			  }
			  ?>
        
    </table>
	
	
	<script src="../js/particles.js"></script>
<script src="../js/app.js"></script>

<!-- stats.js 
<script src="../js/lib/stats.js"></script>-->
<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>
</body>
