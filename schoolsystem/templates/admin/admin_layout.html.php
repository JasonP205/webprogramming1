<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .nav-link {
            transition: all 0.3s ease;
        }
        
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(27, 54, 85, 0.31);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .login-menu {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 font-sans antialiased">
    <header class="glassmorphism shadow-lg rounded-b-2xl sticky top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800"><?=$title?></h1>
            <nav>
                <ul class="flex space-x-8 place-items-center">
                    <li><a href="/schoolsystem/admin/admin_home.php" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Home</a></li>
                    <li>
                    <div class="relative inline-block text-left">
                        <button type="button" class="menu-btn nav-link text-gray-700 hover:text-blue-600 font-medium px-4 py-2 rounded-full transition-colors duration-200 focus:outline-none" onclick="toggleMenu(this)">
                        Management
                        </button>
                        <div class="menu-dropdown hidden absolute right-0 z-20 mt-2 w-48 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-2">
                            <a href="/schoolsystem/admin/module_management.php" class="block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-100 font-medium rounded-lg transition-colors">Module Management</a>
                            <a href="/schoolsystem/admin/user_management.php" class="block px-4 py-2 text-gray-700 hover:text-blue-600 hover:bg-blue-100 font-medium rounded-lg transition-colors">User Management</a>
                        </div>
                        </div>
                    </div>
                    </li>
                    <li><a href="/schoolsystem/admin/mail.php" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Mail</a></li>
                    <li><a href="/schoolsystem/admin/information.php" class="nav-link text-gray-700 hover:text-blue-600 font-medium">View Profile</a></li>
                    <li><a href="/schoolsystem/login/logout.php" class="nav-link text-gray-700 font-medium">
                        <span class="transition-transform duration-200 hover:scale-110 flex px-3 py-2 rounded-full bg-blue-100 hover:bg-neutral-300 transition-colors duration-300 space-x-1">
                            <div>  
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </div>  
                            <p>Sign out</p>
                        </span>
                    </a></li>
                    <li><img src="data:image/jpeg;base64,<?=base64_encode($_SESSION['userAvatar'])?>" alt="User Avatar" class="w-12 h-12 rounded-full border-2 border-gray-300 object-cover"></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="flex-1 container mx-auto px-6 py-12">
        <?=$content?>
    </main>
    <footer class="glassmorphism mt-12 py-6 rounded-t-2xl">
        <div class="container mx-auto px-6 text-center">
            <p class="text-gray-600 font-medium">© Bluewich Forum 2025</p>
        </div>
    </footer>
</body>
</html>

<script>
    function toggleMenu(btn) {
        document.querySelectorAll('.menu-dropdown').forEach(function(menu) {
            if (!menu.contains(btn.nextElementSibling)) menu.classList.add('hidden');
        });
        var menu = btn.nextElementSibling;
        menu.classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
        if (!e.target.closest('.menu-btn') && !e.target.closest('.menu-dropdown')) {
            document.querySelectorAll('.menu-dropdown').forEach(function(menu) {
            menu.classList.add('hidden');
            });
        }
        });

    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Successfully',
            text: "<?= addslashes($_SESSION['message']); ?>"
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>