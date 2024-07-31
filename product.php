<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

<main>
    <?php
    // Check if the product ID is provided
    if (isset($_GET['id'])) {
        $product_id = intval($_GET['id']);

        // Fetch product details from the database
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            ?>

            <div class="product-detail">
                <img src="<?php echo 'images/' . $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                    <input type="number" name="quantity" min="1" value="1" required>
                    <input type="submit" name="add_to_cart" value="Add to Cart">
                </form>
            </div>

            <?php
        } else {
            echo "<p>Product not found.</p>";
        }
    } else {
        echo "<p>Invalid product ID.</p>";
    }
    ?>

</main>

<?php include('includes/footer.php'); ?>
