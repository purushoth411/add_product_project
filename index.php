<?php
require_once("server.php");


if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="home.css">
</head>

<body>

    <div class="home_header">
        <h2>Add Product</h2>
    </div>

    <div class="home_content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>


        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <div class="tag">
                <div class="logout">
                    <button style=" background-color: #5F9EA0;width:70px;border-radius:5px;"> <a href="index.php?logout='1'" style="color: white;width:10%;background-color: #5F9EA0;;text-align:right">Logout</a> </button>
                </div>
                <h>Welcome <strong><?php echo $_SESSION['username'] . "!"; ?></strong></h>

            </div>
        <?php endif ?>
        <?php
        if (isset($message)) {
            foreach ($message as $message) {
                echo '<span class="message">' . $message . '</span>';
            }
        }
        ?>
        <!-- form to add product -->
        <form action="index.php" method="post" enctype="multipart/form-data">
            <?php
            include("errors.php");
            ?>
            <div class="addproduct">
                <div class="field">
                    <label>Name of Product:</label>
                    <input type="text" id="product_name" name="product_name" required placeholder="Enter the product name">
                </div>
                <div class="field">
                    <label>Price:</label>
                    <input type="text" id="price" name="price" required placeholder="Enter the price">
                </div>
                <div class="field">
                    <label>Image:</label>
                    <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg" required />
                </div>
                <div class="field">
                    <label>Available Quantity:</label>
                    <input type="number" id="quantity" name="quantity" required placeholder="Enter the available quantity">
                </div>
                <div class="field">
                    <button type="submit" name="add_product" class="addproductbtn">Add Product</button>
                </div>
            </div>
        </form>

        <!-- display the product -->
        <?php
        $select = mysqli_query($db, "SELECT * FROM product");
        ?>
        <div class="displayproduct">
            <table>
                <thead>
                    <tr>
                        <td>Product Name</td>
                        <td>Price</td>
                        <td>Image</td>
                        <td>Quantity</td>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_assoc($select)) {
                ?>
                    <tr>

                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>

                <?php }; ?>
            </table>

        </div>
    </div>
</body>
</html>