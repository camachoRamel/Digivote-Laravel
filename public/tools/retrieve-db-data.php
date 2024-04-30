<?php

include("connect.php");

    $dataset = [];
    $query = "SELECT stud_id, stud_firstname, stud_middlename, stud_lastname FROM students WHERE stud_id NOT IN(SELECT stud_id FROM candidates)";

    $result = mysqli_query($conn, $query);

    if($result){
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $fullName = $row['stud_lastname'] . ', ' . $row['stud_firstname'] . ' ' . $row['stud_middlename'];
            $data[$i] = [ 'name' => $fullName, 'id' => $row['stud_id'] ];
            $i += 1;
        }
    }

    // header('Content-Type: application/json');
    // header('Content-Type: application/json');
    // print_r($data);
    echo json_encode($data);

    // print_r($test);


?>
