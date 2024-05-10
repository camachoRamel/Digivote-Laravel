<?php

include("connect.php");

    $dataset = [];
    $query = "SELECT vote FROM candidates";

    $result = mysqli_query($conn, $query);

    if($result){
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            $votes = $row['vote'];
            $data[$i] = [ 'votes' => $votes ];
            $i += 1;
        }
    }

    // header('Content-Type: application/json');
    // header('Content-Type: application/json');
    // print_r($data);
    echo json_encode($data);

    // print_r($test);


?>
