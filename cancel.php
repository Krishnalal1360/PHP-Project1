<?php
    include("./db_connect.php");
    //
    if(isset($_POST["RID"])){
        //
        global $conn;
        //
        $rid = $_POST["RID"];
        //
        $query = "UPDATE `records` SET `Status`='Cancelled' WHERE `ID`='$rid'";
        mysqli_query($conn, $query);
        //
        echo "
            <script>
                window.location.href = 'http://localhost/E-commerce1/User/user_store.php';
            </script>
        ";
    }
    //
    if(isset($_POST["ON"])){
        //
        global $conn;
        //
        $on = $_POST["ON"];
        //
        $query = "UPDATE `records` SET `Status`='Cancelled' WHERE `Order_Number`='$on'";
        mysqli_query($conn, $query);
        //
        echo "
            <script>
                window.location.href = 'http://localhost/E-commerce1/User/user_store.php';
            </script>
        ";
    }
?>