<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

        .form-box {
            display: flex;
            flex-direction: column;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 5px;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #2575fc;
            outline: none;
        }

        .btn {
            background-color: #2575fc;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #1e62d8;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        @media (max-width: 500px) {
            h2 {
                font-size: 24px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="../controllers/loginController.php" method="POST" class="form-box">
            <h2>Login Admin</h2>

            <!-- Tampilkan pesan error jika ada -->
            <?php if (isset($_GET['error'])) : ?>
                <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" type="email" required placeholder="Masukkan email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn">Sign In</button>
        </form>
    </div>
</body>

</html>
