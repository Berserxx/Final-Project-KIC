<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Shop</title>
    <style>
        /* Reset beberapa styling bawaan */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        /* Styling Navbar */
        nav {
            background-color: #2C3E50; /* Warna gelap */
            padding: 1em 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        /* Styling untuk logo atau judul */
        nav .logo {
            font-size: 28px;
            color: #ECF0F1; /* Warna logo */
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Styling untuk menu */
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 30px; /* Menggunakan gap untuk spasi antar item */
        }

        /* Styling untuk setiap item dalam menu */
        nav ul li {
            position: relative; /* Untuk efek hover */
        }

        /* Styling untuk tautan menu */
        nav ul li a {
            color: #ECF0F1; /* Warna tautan */
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s, box-shadow 0.3s ease;
        }

        /* Styling saat tautan di-hover */
        nav ul li a:hover {
            background-color: #3498DB; /* Warna biru saat hover */
            color: white;
            transform: translateY(-2px); /* Efek sedikit naik saat hover */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Bayangan saat hover */
        }

        /* Menandai item aktif dengan warna hijau */
        nav ul li a.active {
            background-color: #1ABC9C; /* Warna untuk item aktif */
            color: white;
        }

        /* Responsif */
        @media (max-width: 768px) {
            nav {
                flex-direction: column; /* Menjadi kolom untuk tampilan kecil */
                align-items: flex-start;
            }
            nav ul {
                flex-direction: column; /* Menu menjadi kolom */
                width: 100%; /* Menyesuaikan lebar */
                padding-top: 1em; /* Jarak atas untuk menu */
            }
            nav ul li {
                width: 100%; /* Item menu memenuhi lebar */
                text-align: center; /* Meratakan teks di tengah */
            }
            nav ul li a {
                padding: 10px 0; /* Mengurangi padding di tampilan kecil */
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Electronic Shop</div>
        
        <ul id="navbar">
            <li><a href="Dashboard.php">Dashboard</a></li>
            <li><a href="transactions.php">Transactions</a></li>
            <li><a href="report.php">Report</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="admins.php">Admins</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <script>
        // Mendapatkan URL halaman saat ini
        const currentLocation = window.location.pathname.split('/').pop();
        
        // Mendapatkan semua tautan di navbar
        const menuItems = document.querySelectorAll('#navbar a');
        
        // Menambahkan kelas 'active' pada tautan yang sesuai dengan halaman saat ini
        menuItems.forEach(item => {
            if (item.getAttribute('href') === currentLocation) {
                item.classList.add('active');
            }
        });
    </script>
</body>
</html>
