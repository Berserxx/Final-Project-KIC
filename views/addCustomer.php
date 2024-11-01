<?php include "../tamplate/navigasi.php"; ?>
<?php
// Fungsi untuk koneksi ke database
include_once '../models/Database.php';

// Inisialisasi variabel
$name = $email = $phone = "";
$message = "";

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Buat instance dari kelas Database dan lakukan koneksi
    $db = new Database();
    $conn = $db->connect();

    // Query untuk menyimpan data customer
    $query = "INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $name, $email, $phone);

    if ($stmt->execute()) {
        $message = "Customer berhasil ditambahkan!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
    <style>
        /* Styling untuk form */
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #04AA6D;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #038B52;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            color: #04AA6D; /* Warna hijau */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Customer</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telepon:</label>
            <input type="text" id="phone" name="phone" required>

            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>
