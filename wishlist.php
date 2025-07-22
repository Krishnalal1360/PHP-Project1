<?php
    include("./db_connect.php");
?>
<?php
    //
    global $conn;
    if(isset($_GET["uid"]) && (isset($_GET["pid"]))){
        //
        $id1 = $_GET["uid"];
        $id2 = $_GET["pid"];
        global $conn;
        $query = "SELECT * FROM `product_details` WHERE `ID` = '$id2'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($result);
        $title = $rows["Title"];
        $brand = $rows["Brand"];
        $category = $rows["Category"];
        $image = $rows["Image"];
        $price = $rows["Price"];
        if($result){
            $query = "SELECT `Name`, `Gmail` FROM `user_cred` WHERE `ID` = '$id1'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_assoc($result);
            $name = $rows["Name"];
            $gmail = $rows["Gmail"];
            //
            $query = "SELECT * FROM `records` WHERE `Name`='$name' AND `Gmail`='$gmail' AND `Title`='$title' AND `Brand`='$brand' AND `Category`='$category'";
            $result = mysqli_query($conn, $query);
            $nr = mysqli_num_rows($result);
            if($nr > 0){
                echo "<script>
                alert('Item Already Added to Wishlist Cart')
                window.location.href='http://localhost/E-commerce1/User/user_store.php'
                </script>";
            }else{
                $query = "INSERT INTO `records`(`Name`, `Gmail`, `Title`, `Brand`, `Category`, `Image`, `Price`, `Order_Placed`, `Status`, `Order_Received`)
                VALUES('$name', '$gmail', '$title', '$brand', '$category', '$image', '$price', '', 'In Cart', '')";
                $result = mysqli_query($conn, $query);
                if($result){
                    echo "<script>
                    alert('Item Added to Wishlist Cart Successfully')
                    window.location.href='http://localhost/E-commerce1/User/user_store.php'
                    </script>";
                }else{
                    die(mysqli_error($conn));
                }
            }
        }else{
            die(mysqli_error($conn));
        }
    }
?>