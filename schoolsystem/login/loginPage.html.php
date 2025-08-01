<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Bluewich Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.689);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        .login-menu {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-200 to-sky-300 h-64 w-full">
    <header class="glassmorphism shadow-lg rounded-b-2xl sticky top-0 z-10">
        <!-- <div class="container mx-auto px-6 py-4 flex justify-between items-center"> -->
            <h1 class="text-3xl font-semibold text-gray-800 text-center m-6">Bluewich Forum Portal</h1>
        <!-- </div> -->
    </header>

    <div id="login-menu" class="mx-auto my-20 relative px-6 py-8 glassmorphism rounded-3xl shadow-xl max-w-md">
        <div class="px-10 pb-10">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Login to Bluewich Forum</h2>
            <form action="validateUser.php" method="post" class="space-y-4">
                <div class="mb-3">
                    <label for="username" class="block text-gray-700 font-medium text-lg mb-2">Username</label>
                    <input type="text" id="username" name="username" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <label for="password" class="block text-gray-700 font-medium text-lg mb-2">Password</label>
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full text-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your password">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Login</button>
            </form>
        </div>
    </div>
    <script>
        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "<?= addslashes($_SESSION['error']); ?>"
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>

</body>
</html>