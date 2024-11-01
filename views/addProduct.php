<?php
// Include file Database.php
include_once '../models/Database.php';


// Membuat instance dari class Database dan menghubungkan ke database
$database = new Database();
$conn = $database->connect();

// Folder penyimpanan gambar
$target_dir = "../uploads/";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];

    // Proses upload gambar
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah gambar sebenarnya
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<div class='error'>File bukan gambar.</div>";
        $uploadOk = 0;
    }

    // Cek jika file sudah ada
    if (file_exists($target_file)) {
        echo "<div class='error'>File sudah ada. Silakan upload file lain.</div>";
        $uploadOk = 0;
    }

    // Batasi jenis file gambar
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<div class='error'>Hanya file JPG, JPEG, dan PNG yang diizinkan.</div>";
        $uploadOk = 0;
    }

    // Batasi ukuran file (contoh 2MB maksimal)
    if ($_FILES["image"]["size"] > 2000000) {
        echo "<div class='error'>Ukuran file terlalu besar. Maksimal 2MB.</div>";
        $uploadOk = 0;
    }

    // Cek apakah uploadOk bernilai 0
    if ($uploadOk == 0) {
        echo "<div class='error'>File tidak dapat diunggah.</div>";
    } else {
        // Jika file valid, upload ke server
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $sql_insert = "INSERT INTO products (name, price, stock, image, description) 
                           VALUES ('$name', '$price', '$stock', '$target_file', '$description')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "<div class='success'>Produk berhasil ditambahkan!</div>";
            } else {
                echo "<div class='error'>Error: " . $sql_insert . "<br>" . $conn->error . "</div>";
            }
        } else {
            echo "<div class='error'>Terjadi kesalahan saat mengunggah file.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
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
    <h2 style="text-align: center;">Tambah Produk Baru</h2>
    <div class="form-container">
        <form action="addProduct.php" method="POST" enctype="multipart/form-data">
            <label for="name">Nama Produk:</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Harga Produk:</label>
            <input type="text" id="price" name="price" required>

            <label for="stock">Stok Produk:</label>
            <input type="number" id="stock" name="stock" required>

            <label for="image">Upload Image:</label>
            <input name="image" type="file" required>

            <label for="description">Deskripsi Produk:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit">Tambah Produk</button>
        </form>
    </div>
</body>
</html>
