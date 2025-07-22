<?php
    include("./db_connect.php");
    //
    if(isset($_POST["login-submit"])){
        $name = $_POST["name"];
        $gmail = $_POST["gmail"];
        $password = $_POST["password"];
        global $conn;
        $query = "SELECT * FROM `user_cred` WHERE `Gmail`='$gmail'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        //
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        //
        if($rows == 0){
            $query = "INSERT INTO `user_cred`(`Name`, `Gmail`, `Password`) VALUES ('$name', '$gmail','$password')"; 
            $result = mysqli_query($conn, $query);
            if($result){
                echo "<script>
                alert('Login successfully!')
                window.location.href='http://localhost/E-commerce1/User/user_store.php'
                </script>";
                $_SESSION['name'] = $name;
                $_SESSION['gmail'] = $gmail;
            }else{
                echo "<script>
                alert('Invalid Login!')
                window.location.href='http://localhost/E-commerce1/User/login.php'
                </script>";
            }
        }elseif($rows == 1){
            $rows = mysqli_fetch_assoc($result);
            $name1 = $rows['Name'];
            $password1 = $rows['Password'];
            if(($name == $name1) && ($password == $password1)){
                $_SESSION['name'] = $name;
                $_SESSION['gmail'] = $gmail;
                echo "<script>
                alert('Login successfully!')
                window.location.href='http://localhost/E-commerce1/User/user_store.php'
                </script>";
            }else{
                echo "<script>
                alert('Invalid Login!')
                window.location.href='http://localhost/E-commerce1/User/login.php'
                </script>";
            }
        }
    }
    //
    function getProducts(){
        global $conn;
        $qry = "SELECT * FROM `product_details`";
        $res = mysqli_query($conn, $qry);
        $nrs = mysqli_num_rows($res);
        if($nrs == 0){
          echo "<h3 class='text-center'>No products available!</h3>";
          exit();
        }
        while($row=mysqli_fetch_assoc($res)){
          $pt = $row["Title"];
          $pd = $row["Description"];
          //$pk = $row["Keyword"];
          $pb = $row["Brand"];
          $pc = $row["Category"];
          //
          $pi = $row["Image"];
          $pr = $row["Price"];
          //
          echo "
              <div class='col-md-4 mb-4'>
                <div class='card h-100'>
                    <img src='../Uploads/$pi' class='card-img-top' alt='$pi' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>$pt</h5>
                        <p class='card-text'>Description: $pd</p>
                        <p class='card-text'>Brand: $pb</p>
                        <p class='card-text'>Category: $pc</p>
                        <p class='card-text fw-bold'>Price: ₹$pr</p>
                    </div>
                </div>
            </div>
            ";
        }
    }
    //
    function getUserProducts(){
        global $conn;
        $qry = "SELECT * FROM `product_details`";
        $res = mysqli_query($conn, $qry);
        $nrs = mysqli_num_rows($res);
        if($nrs == 0){
          echo "<h3 class='text-center'>No products available!</h3>";
          exit();
        }
        //
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        $name = $_SESSION['name'];
        $gmail = $_SESSION['gmail'];
        $query = "SELECT `ID` FROM `user_cred` WHERE `Name`='$name' AND `Gmail`='$gmail'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($result);
        $id2 = $rows["ID"];
        while($row=mysqli_fetch_assoc($res)){
          $id1 = $row["ID"];  
          $pt = $row["Title"];
          $pd = $row["Description"];
          $pb = $row["Brand"];
          $pc = $row["Category"];
          //
          $pi = $row["Image"];
          $pr = $row["Price"];
          //
          echo "
              <div class='col-md-4 mb-4'>
                <div class='card h-100'>
                    <img src='../Uploads/$pi' class='card-img-top' alt='$pi' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'>$pt</h5>
                        <p class='card-text'>Description: $pd</p>
                        <p class='card-text'>Brand: $pb</p>
                        <p class='card-text'>Category: $pc</p>
                        <p class='card-text fw-bold'>Price: ₹$pr</p>
                        <a href='http://localhost/E-commerce1/User/wishlist.php?uid=$id2&pid=$id1' class='btn btn-info w-100'>Add to cart</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
?>