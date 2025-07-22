<?php
function getUserProducts() {
    global $conn;

    //$id = $_SESSION["UID"] ?? '';
    
    $query = "SELECT * FROM `product_details`";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {
        $title = $row["Title"];
        $desc = $row["Description"];
        $brand = $row["Brand"];
        $category = $row["Category"];
        $image = $row["Image"];
        $price = $row["Price"];

        // Fetch quantity from order_stock
        $query1 = "SELECT * FROM `order_stock` WHERE `Product`='$title'";
        $result1 = mysqli_query($conn, $query1);
        $quantity = 0; // Default
        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row1 = mysqli_fetch_assoc($result1);
            $quantity = $row1["Quantity"];
        }

        // Output card regardless of record existence
        echo "
        <div class='col-md-4 mb-4'>
            <div class='card h-100'>
                <img src='../Uploads/$image' class='card-img-top' alt='$image' style='height: 200px; object-fit: cover;'>
                <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <p class='card-text'>Description: $desc</p>
                    <p class='card-text'>Brand: $brand</p>
                    <p class='card-text'>Category: $category</p>
                    <p class='card-text fw-bold'>Price: ₹$price</p>
                    <div class='d-flex gap-2'>
                        <form action='http://localhost/E-commerce1/Includes/wishlist.php' method='POST' class='w-50'>
                            <input type='hidden' name='title' value='$title'>
                            <button type='submit' class='btn btn-info w-100'>Add to Cart</button>
                        </form>
                        <form action='http://localhost/E-commerce1/Includes/buy_now.php' method='POST' class='w-50'>
                            <input type='hidden' name='title' value='$title'>
                            <button type='submit' class='btn btn-success w-100'>Buy Now</button>
                        </form>
                    </div>";

        if($quantity == 0){
            echo "
                <p class='mt-2 mb-0 text-center text-danger'>
                    <small><i class='fas fa-box-open me-1'></i>Out of Stock</small>
                </p>";
        }else{
            echo "
                <p class='mt-2 mb-0 text-center text-danger'>
                    <small><i class='fas fa-box-open me-1'></i>$quantity Left In Stock</small>
                </p>";
        }

        echo "
                </div>
            </div>
        </div>
        ";
    }
}
?>
