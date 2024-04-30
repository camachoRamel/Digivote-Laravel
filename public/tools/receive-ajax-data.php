<?php
    function soloAdd(){
        include 'connect.php';
        $datas = $_POST['myData'];
        foreach ($datas as $data) {
            $position = $data['position'];
            $id = $data['id'];
            $query = "INSERT INTO candidates(stud_id, position_id) VALUES('$id', (SELECT position_id FROM positions WHERE position_name = '$position'))";
            mysqli_query($conn, $query);
        }

        unset($_POST['myData']);
        echo json_encode("successful");
    }


    function partyAdd(){
        include 'connect.php';
        $datas = $_POST['partyData'];
        $partyName;
        for($i = 3; $i > -1; $i--){
            //adds the party name and image to the parties table
            if($i != 0){
                $partyName = $datas['partyName'];
                $partyImg = $datas['partyIcon'];
                $partyQuery = "INSERT INTO parties(party_name, party_img) VALUES('$partyName', '$partyImg')";
                mysqli_query($conn, $partyQuery);
                echo $partyName;

            }
            //populates the candidates table
            else{
                $positionNames = array('president', 'vicePresident', 'secretary', 'treasurer', 'auditor', 'businessManager1', 'businessManager2');
                foreach ($positionNames as $positionName) {
                    $studID = $datas['partyContent'][$positionName]['id'];

                    // echo Str::length(srtval($studID));
                    $candidatesQuery = "INSERT INTO candidates(position_id, stud_id, party_id) VALUE((SELECT position_id FROM positions WHERE position_name = '$positionName' LIMIT 1), '$studID', (SELECT party_id FROM parties WHERE party_name = '$partyName' LIMIT 1))";
                    mysqli_query($conn, $candidatesQuery);
                    
                }
            }
        }

        unset($_POST['partyData']);
        mysqli_close($conn);
    }   

    if(isset($_POST['partyData'])){
        partyAdd();
    }else if(isset($_POST['myData'])){
        soloAdd();
    }


        // print_r($datas['partyContent']);
        // echo $datas['partyContent']['auditor']['id'];
            // if($data != 'icon'){
            //     // $position = $data;
            //     // $id = $data['id'];
            //     print_r($data);
            //     // echo $id;
            // }

            // print_r($datas['partyContent']['president']['id']);

            // $query = "INSERT INTO candidates(stud_id, position_id) VALUES('$id', (SELECT position_id FROM positions WHERE position_name = '$position'))";
            // mysqli_query($conn, $query);
        

?>
