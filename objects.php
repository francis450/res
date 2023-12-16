 <?php
        include('connection.php');
        
        $query = "select distinct(foodcode),food,cost,price from menu ORDER BY food DESC";
        
        $results = array();
        
        if ($result = mysqli_query($con, $query)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $temp = [];
                $temp[] = $row['foodcode'];
                $temp[] = $row['food'];
                $temp[] = $row['cost'];
                $temp[] = $row['price'];
                $temp[] = '&#x270E; Edit';
                $temp[] = '&#x1F5D1;';
                $results[] = $temp;
            }
        }else{
            mysqli_error($con);
        }
         $return_array = array('data'=>$results);
        echo json_encode($return_array);
?>