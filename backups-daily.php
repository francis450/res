<?php
ob_start();
session_start();
function backup_mysql_database($options){
$mtables = array(); $contents = "-- Database: `".$options['db_to_backup']."` --\n";

$mysqli = new mysqli($options['db_host'], $options['db_uname'], $options['db_password'], $options['db_to_backup']);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$results = $mysqli->query("SHOW TABLES");

while($row = $results->fetch_array()){
    if (!in_array($row[0], $options['db_exclude_tables'])){
        $mtables[] = $row[0];
    }
}

foreach($mtables as $table){
    $contents .= "-- Table `".$table."` --\n";

    $results = $mysqli->query("SHOW CREATE TABLE ".$table);
    while($row = $results->fetch_array()){
        $contents .= $row[1].";\n\n";
    }

    $results = $mysqli->query("SELECT * FROM ".$table);
    $row_count = $results->num_rows;
    $fields = $results->fetch_fields();
    $fields_count = count($fields);

    $insert_head = "INSERT INTO `".$table."` (";
    for($i=0; $i < $fields_count; $i++){
        $insert_head  .= "`".$fields[$i]->name."`";
            if($i < $fields_count-1){
                    $insert_head  .= ', ';
                }
    }
    $insert_head .=  ")";
    $insert_head .= " VALUES\n";        

    if($row_count>0){
        $r = 0;
        while($row = $results->fetch_array()){
            if(($r % 400)  == 0){
                $contents .= $insert_head;
            }
            $contents .= "(";
            for($i=0; $i < $fields_count; $i++){
                $row_content =  str_replace("\n","\\n",$mysqli->real_escape_string($row[$i]));

                switch($fields[$i]->type){
                    case 8: case 3:
                        $contents .=  $row_content;
                        break;
                    default:
                        $contents .= "'". $row_content ."'";
                }
                if($i < $fields_count-1){
                        $contents  .= ', ';
                    }
            }
            if(($r+1) == $row_count || ($r % 400) == 399){
                $contents .= ");\n\n";
            }else{
                $contents .= "),\n";
            }
            $r++;
        }
    }
}

if (!is_dir ( $options['db_backup_path'] )) {
        mkdir ( $options['db_backup_path'], 0777, true );
 }

$backup_file_name = $options['db_to_backup'] . "backup by- ".$_SESSION['username']."-" . date( "d-m-Y--h-i-s").".sql";

$fp = fopen($options['db_backup_path'] . '/' . $backup_file_name ,'w+');
if (($result = fwrite($fp, $contents))) {
    $routepage = $_GET['id'];
    header("Location: ".$routepage.".php");
    // echo "Backup file created '--$backup_file_name' ($result)"; 
}


// if($result = fwrite($fp, $contents)){
	//$form = '<form action="" method="POST" enctype="multipart/form-data"><input type="file" name="file" value="'.$backup_file_name.'"/><button type="submit" name="submit">Uploading file....</button></form>';
	//echo $form;
	
// 	if($routepage=='main'){
// 		header("Location: main.php");
// 	}else{
		//header("Location: pos.php");
		
// 	}
// }


fclose($fp);
return $backup_file_name;
}

$dbfile = "settings/db.txt";
$db = file_get_contents("settings/db.txt");

$options = array(
    'db_host'=> 'localhost',  //mysql host
    'db_uname' => 'infodata_francis',  //user
    'db_password' => 'Franc!s2001', //pass
    'db_to_backup' => $db, //database name
    'db_backup_path' => 'backups/', //where to backup
    'db_exclude_tables' => array() //tables to exclude
);
$backup_file_name=backup_mysql_database($options);

?>