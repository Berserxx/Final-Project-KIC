<?php
// Include file Database.php
include_once '../models/Database.php';

// Membuat instance dari class Database dan menghubungkan ke database
$database = new Database();
$conn = $database->connect();

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek jika ada permintaan untuk menghapus produk
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Hapus produk dari database
    $sql_delete = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<div class='success'>Produk berhasil dihapus!</div>";
    } else {
        echo "<div class='error'>Error saat menghapus produk: " . $conn->error . "</div>";
    }
}

// Ambil data produk dari database
$sql = "SELECT id, name, price, stock, image, description FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .add-product-button {
            display: block;
            width: 150px;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .add-product-button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        td img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        td.description {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .delete-button {
            color: red;
            cursor: pointer;
        }
        .success, .error {
            text-align: center;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php include"../tamplate/navigasi.php"?>
    <div class="container">
        <h2>Daftar Produk</h2>
        <a href="addProduct.php" class="add-product-button">Tambah Produk</a>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga (Rp)</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Menampilkan data produk
                    while ($row = $result->fetch_assoc()) {
                        // Mengkonversi harga menjadi float
                        $price = floatval($row["price"]);
                        echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . number_format($price, 2, ',', '.') . "</td> <!-- Format dengan pemisah ribuan -->
                                <td>" . htmlspecialchars($row["stock"]) . "</td>
                                <td><img src='" . htmlspecialchars($row["image"]) . "' alt='Gambar Produk'></td>
                                <td class='description'>" . htmlspecialchars($row["description"]) . "</td>
                                <td><a href='?delete_id=" . $row["id"] . "' class='delete-button' onclick='return confirm(\"Anda yakin ingin menghapus produk ini?\");'>Hapus</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada produk ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
