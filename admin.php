<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

<main>
    <h2>Admin Panel</h2>
    
    <section id="add-product">
        <h3>Add Product</h3>
        <form action="admin.php" method="post" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required><br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br>
            <input type="submit" name="add_product" value="Add Product">
        </form>
    </section>

    <section id="send-notification">
        <h3>Send Notification</h3>
        <form action="admin.php" method="post">
            <label for="notification">Notification Message:</label>
            <textarea id="notification" name="notification" required></textarea><br>
            <input type="submit" name="send_notification" value="Send Notification">
        </form>
    </section>

    <?php
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);

        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$image')";
        if ($conn->query($sql) === TRUE) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "<p>Product added successfully.</p>";
            } else {
                echo "<p>Failed to upload image.</p>";
            }
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['send_notification'])) {
        $message = $_POST['notification'];
        
        $sql = "INSERT INTO notifications (message) VALUES ('$message')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Notification sent successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
    ?>

</main>

<?php include('includes/footer.php'); ?>
