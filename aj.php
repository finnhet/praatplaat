<?php

include('extra\database.con.php');

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if(isset($_POST['uploadEle'])){
            $NaamNL = $_POST['NaamNL'];
            $NaamFR = $_POST['NaamFR'];
            $NaamEN = $_POST['NaamEN'];
            $cat = $_POST['cat'];

            $query = mysqli_query($conn, "INSERT INTO elementen (NaamNL, NaamFR, NaamEN, cat) VALUE( '$NaamNL', '$NaamFR', '$NaamEN', '$cat')");
            if($query){
                echo "<script>alert('wel')</script>";
            } else {
                echo "<script>alert('niet')</script>";
            }
        }
?>
