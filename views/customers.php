<?php include "../tamplate/navigasi.php"; ?>
<?php
// Fungsi untuk koneksi ke database
include_once '../models/Database.php';

// Buat instance dari kelas Database dan lakukan koneksi
$db = new Database();
$conn = $db->connect();

// Ambil daftar pelanggan dari database
$query = "SELECT * FROM customers";
$result = $conn->query($query);

// Cek apakah ada pesan dari penghapusan
$message = "";
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            color: #2f6627;
            background-color: #e7f9e7;
            border: 1px solid #04AA6D;
            transition: all 0.3s ease;
        }

        .message.error {
            background-color: #f9e7e7;
            color: #662727;
            border: 1px solid #AA0404;
        }

        .add-customer-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 15px;
            background-color: #04AA6D;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 25px;
            font-size: 1.2em;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .add-customer-btn:hover {
            background-color: #038B52;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        th {
            background-color: #04AA6D;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1; /* Background ketika hover */
        }

        .action-link {
            color: #e74c3c; /* Warna merah untuk link hapus */
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .action-link:hover {
            text-decoration: underline;
            color: #c0392b; /* Warna merah lebih gelap saat hover */
        }

        /* Responsivitas */
        @media (max-width: 600px) {
            .add-customer-btn {
                width: 100%;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <main>
        <h2>Daftar Pelanggan</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <a href="addCustomer.php" class="add-customer-btn">Tambah Customer</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($customer = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($customer['id']); ?></td>
                            <td><?php echo htmlspecialchars($customer['name']); ?></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                            <td>
                                <a href="delete_customer.php?id=<?php echo $customer['id']; ?>" 
                                   class="action-link" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada pelanggan ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
