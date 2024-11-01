<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include '../models/Database.php';
$db = new Database();
$conn = $db->connect();

// Query untuk mendapatkan total produk
$productQuery = "SELECT * FROM products";
$productResult = $conn->query($productQuery);

// Query untuk mendapatkan total penjualan
$salesQuery = "SELECT SUM(total) AS total_sales FROM sales"; // Asumsikan ada kolom total di tabel sales
$salesResult = $conn->query($salesQuery);
$salesRow = $salesResult->fetch_assoc();
$totalSales = $salesRow['total_sales'] ? $salesRow['total_sales'] : 0;

// Query untuk menghitung total pelanggan
$customerQuery = "SELECT COUNT(*) AS total_customers FROM customers";
$customerResult = $conn->query($customerQuery);
$customerRow = $customerResult->fetch_assoc();
$totalCustomers = $customerRow['total_customers'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMIh+SO6iS2tTTT2zP3rrVgmI5I5uH5iEr+Z4n" crossorigin="anonymous">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1, h2 {
            color: #333;
        }

        .dashboard-overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px;
            flex: 1;
            margin: 0 10px;
            text-align: center;
        }

        .card h2 {
            margin: 0 0 10px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product-item:hover {
            transform: scale(1.05);
        }

        .product-info {
            margin-top: 10px;
        }

        .product-info h3 {
            margin: 0;
        }

        .stock {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include "../tamplate/navigasi.php"; ?>
    
    <div class="container">
        <h1>Product Dashboard</h1>
        <div class="dashboard-overview">
            <div class="card">
                <h2>Total Products</h2>
                <p><?php echo $productResult->num_rows; ?></p>
            </div>
            <div class="card">
                <h2>Total Sales</h2>
                <p>Rp <?php echo number_format($totalSales, 0, ',', '.'); ?></p>
            </div>
            <div class="card">
                <h2>Total Customers</h2>
                <p><?php echo $totalCustomers; ?></p>
            </div>
        </div>

        <h2>Product List</h2>
        <div class="product-grid">
            <?php while ($row = $productResult->fetch_assoc()) { ?>
            <div class="product-item">
                <img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="max-width: 100%; border-radius: 5px;">
                <div class="product-info">
                    <h3><?php echo $row['name']; ?></h3>
                    <p>Price: <strong>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></strong></p>
                    <p>Stock: <span class="stock"><?php echo $row['stock']; ?></span></p>
                    <p><?php echo $row['description']; ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
