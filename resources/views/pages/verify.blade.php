<?php
    include '../tools/connect.php';
    session_start();

    $current_id = $_SESSION['current_user_id'];

    $query = "SELECT stud_id, stud_firstname, stud_middlename, stud_lastname, stud_cp_num FROM students WHERE stud_id = (SELECT stud_id FROM users WHERE user_id = '$current_id')";
    $result = mysqli_query($conn, $query);

    if($result){
        $row = $result->fetch_assoc();
        $stud_id = $row['stud_id'];            
        $firstname = $row['stud_firstname'];            
        $middlename = $row['stud_middlename'];            
        $lastname = $row['stud_lastname'];            
        $cp_num = $row['stud_cp_num'];            
    }

    if(isset($_POST['submit'])){
        $fullname  = mysqli_real_escape_string($conn, $_POST['fullname']);
        $username  = mysqli_real_escape_string($conn, $_POST['fullname']);
        $stud_id  = mysqli_real_escape_string($conn, $_POST['fullname']);
        $cp_number  = mysqli_real_escape_string($conn, $_POST['fullname']);
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<?php
    $pageTitle = "Verify"; 
    include('../includes/head.php');
?>
<body class="bg-light">
    <main>
        <div class="container d-flex vh-100 justify-content-center align-items-center">
            <form action="" method="POST" class="shadow p-5 bg-white rounded-4 d-flex flex-column gap-3">
                <h3>Review your personal Information</h3>
                <div class="container">
                    <label for="fullname"> Fullname</label>
                    <input name="fullname" class="form-control" type="text" value=<?php echo $lastname . ", " . $firstname . ', ' . $middlename; ?> aria-label=".form-control-lg example">
                </div>
                <div class="container">
                    <label for="username">Username</label>
                    <input name="username" class="form-control" type="text" value="tagaKanto123@gmail.com" aria-label=".form-control-lg example">
                </div>
                <div class="container">
                    <label for="student-id">Student ID</label>
                    <input name="stud-id" class="form-control" type="text" value="0000-000001" aria-label=".form-control-lg example">
                </div>
                <div class="container">
                    <label for="cp-number">Cellphone Number</label>
                    <input name="cp-number" class="form-control" type="tel" value="0912345678" aria-label=".form-control-lg example">
                </div>
                <div class="container d-flex justify-content-end mt-2">
                    <button name="submit" type="submit" class="btn btn-submit btn-dark">Submit</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>