<?php
@include 'config.php';
function filterData(&$str){
$str = preg_replace("/\t/", "\\t", $str);
$str = preg_replace("/\r?\n/", "\\n", $str);
if(strstr($str, '"')) $str = '"' . str_replace('"','""', $str) . '"';

}
//excel file name download
$filename = "student-data_" . date('Y-m-d') . ".xls";

$fields = array('ID', 'Student Name', 'Payment', 'DATE of Inscription', 'Phone Num');

$exceldata = implode("\t", array_values($fields)) . "\n";

$sql = "SELECT * FROM std_add ORDER BY id ASC";
$result = mysqli_query($conn, $sql); 
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $linedata = array($row['id'], $row['nam'], $row['prix'], $row['date'], $row['tele']);
        array_walk($linedata, 'filterData');
        $exceldata .= implode("\t", array_values($linedata)) . "\n";
        
    }
}else{
    $exceldata .= 'NO RECORD FOUND !!'. "\n";
}
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=\"$filename\"");

echo $exceldata;

exit;

?>