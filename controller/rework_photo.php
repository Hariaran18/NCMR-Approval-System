<?php
    include ("../config/dbconnection.php");
    session_start();
    
    if(isset($_SESSION['username'])){ // Fetching variables of the form which travels in URL

        $ncmr_no = $_POST['ncmr_no'];

        // Image rename and storing
        $target_dir = "../src/images/";

        // Image 2
        $filetoupload2 = basename($_FILES["file2"]["name"]);
        if($filetoupload2 == "") {
            $newFileName2 = "";
        } else {
            $imageFileType2 = pathinfo($filetoupload2,PATHINFO_EXTENSION);
            $newFileName2 = $ncmr_no . '_img_2.'.$imageFileType2;
            $target_file2 = $target_dir . $newFileName2;
            $file2= $_FILES["file2"]["tmp_name"];

            $rework_sql = "UPDATE form SET 
                        img_2='$newFileName2'                        
                        WHERE `ncmr_no`= '$ncmr_no'";

            if (move_uploaded_file($file2, $target_file2) && mysqli_query($conn, $rework_sql)) {
                echo "<script>alert('Photo has been uploaded successfully!')</script>";
?>
                <meta http-equiv="refresh" content="0; url=../view/view.php?edit=<?php echo $ncmr_no; ?>"/>
<?php                
            } else {
?>
                <meta http-equiv="refresh" content="0; url=../view/view.php?edit=<?php echo $ncmr_no; ?>"/>
<?php
                echo "<script>alert('Error uploading photo!')</script>";
            }
        }
    }

    mysqli_close($conn); // Closing Connection with Server
?>