<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

<main>
    <h2>Products</h2>
    <div class="products">
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p>$" . $row['price'] . "</p>";
                echo "<button class='add-to-cart' data-id='" . $row['id'] . "'>Add to Cart</button>";
                echo "</div>";
            }
        } else {
            echo "No products found.";
        }
        ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>
