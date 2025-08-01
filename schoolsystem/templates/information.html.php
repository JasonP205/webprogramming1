<?php session_start(); ?>
<div class="bg-white/80 backdrop-blur-lg rounded-2xl p-6 sm:p-8 shadow-2xl mb-8 w-full max-w-4xl mx-auto border border-gray-100/50">
    <h2 class="text-gray-800 text-center font-bold text-2xl sm:text-3xl mb-8 tracking-tight">Your Profile</h2>

    <form id="avatarForm" action="../changeAvatar.php" method="post" enctype="multipart/form-data">
        <input type="file" name="userAvatar" id="avatarInput" accept="image/*" class="hidden"
            onchange="document.getElementById('avatarForm').submit();">
        
        <img src="data:image/jpeg;base64,<?= base64_encode($_SESSION['userAvatar']) ?>" 
            alt="Profile Image"
            class="transition-transform duration-200 hover:scale-110 cursor-pointer mx-auto w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-full mb-6 border-2 border-gray-400 bg-gray-50 shadow-md"
            onclick="document.getElementById('avatarInput').click();"
            title="Click to change your profile picture">
    </form>

    
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 text-center mb-6">
        Welcome, <?php echo htmlspecialchars($_SESSION['fullName'], ENT_QUOTES, 'UTF-8'); ?>
    </h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 text-sm sm:text-base">
        <p class="flex items-center">
            <span class="font-semibold mr-2">Email:</span> 
            <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="flex items-center">
            <span class="font-semibold mr-2">Phone Number:</span> 
            <?php echo htmlspecialchars($_SESSION['phoneNumber'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="flex items-center">
            <span class="font-semibold mr-2">Address:</span> 
            <?php echo htmlspecialchars($_SESSION['address'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="capitalize flex items-center">
            <span class="font-semibold mr-2">Account Type:</span> 
            <span class="flex items-center justify-center gap-1 bg-<?= $_SESSION['roleId'] == 1 ? 'yellow' : 'blue' ?>-200 text-<?= $_SESSION['roleId'] == 1 ? 'yellow' : 'blue' ?>-600 rounded-full px-2 py-1">
                <?php if($_SESSION['roleId']==1): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                    </svg>
                <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                <?php endif; ?>
                <?= htmlspecialchars($_SESSION['roleName'], ENT_QUOTES, 'UTF-8') ?>
            </span>
        </p>
        <p class="flex items-center">
            <span class="font-semibold mr-2">Birthday:</span> 
            <?php echo htmlspecialchars($_SESSION['DoB'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="flex items-center">
            <span class="font-semibold mr-2">Username:</span> 
            <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="flex items-center">
            <span class="font-semibold mr-2">Joined:</span> 
            <?php echo htmlspecialchars($_SESSION['createDate'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
        <p class="capitalize flex items-center">
            <span class="font-semibold mr-2">Account Status:</span> 
            <?php echo htmlspecialchars($_SESSION['userStatus'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
    </div>
    
    <div class="flex space-x-4 mt-8">
        <button onclick="toggleEditProfile()"
            class="transition-transform duration-200 hover:scale-105 flex items-center justify-center space-x-2 w-full mt-8 bg-gradient-to-r from-blue-400 to-blue-500 text-white px-4 py-2.5 rounded-full hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            <span>Update Profile</span>
        </button>
        <form action="../deleteUser.php" method="post" class="w-full" onsubmit="return confirm('Are you sure you want to delete your account?');">
            <input type="hidden" name="userId" value="<?= htmlspecialchars($_SESSION['userId'], ENT_QUOTES, 'UTF-8') ?>">            
            <button type="submit" 
                class="transition-transform duration-200 hover:scale-105 flex items-center justify-center space-x-2 w-full mt-8 bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2.5 rounded-full hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                </svg>
                <span>Delete Account</span>
            </button>
        </form>
    </div>
</div>

<div id="overlay" class="overlay">
    <div id="updateProfile" class="relative p-6 glassmorphism rounded-3xl shadow-xl w-[768px]">
        <button onclick="toggleEditProfile()" 
            class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 class="border-b-2 border-gray-400 pb-2 text-2xl font-semibold text-gray-800 mb-6 text-center">Edit your profile</h2>
        <div class="px-10 pb-10">
            <form action="../updateProfile.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="userId" value="<?= $_SESSION['userId'] ?>">
                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Fullname</span>
                    <input 
                        type="text" 
                        name="fullName" 
                        required 
                        value="<?= htmlspecialchars($_SESSION['fullName'], ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="Enter your full name"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Password</span>
                    <input 
                        type="text" 
                        name="password" 
                        required 
                        value="<?= htmlspecialchars($_SESSION['password'], ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="Enter your password"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Email</span>
                    <input 
                            type="text" 
                            name="email" 
                            required 
                            value="<?= htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Enter your email"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Address</span>
                    <input 
                            type="text" 
                            name="address" 
                            required 
                            value="<?= htmlspecialchars($_SESSION['address'], ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Enter your address"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Birthday</span>
                    <input 
                            type="date" 
                            name="DoB" 
                            value="<?= htmlspecialchars($_SESSION['DoB'], ENT_QUOTES, 'UTF-8') ?>"
                            required 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Phone number</span>
                    <input 
                            type="text" 
                            name="phoneNumber" 
                            required 
                            value="<?= htmlspecialchars($_SESSION['phoneNumber'], ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="Enter your phone number"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>
                <div class="mb-6 flex items-center">
                    <label for="userAvatar" class="w-40 pr-6 text-gray-700 font-semibold text-lg">New avatar</label>
                    <input type="file" name="userAvatar" accept="image/*" 
                        class="bg-gray-50 flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    <?php if (isset($_SESSION['errorUpdateFail'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "<?= addslashes($_SESSION['errorUpdateFail']); ?>"
        });
        <?php unset($_SESSION['errorUpdateFail']); ?>
        toggleEditProfile();
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "<?= addslashes($_SESSION['message']); ?>"
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    function toggleEditProfile() {
        const overlay = document.getElementById('overlay');
        const isVisible = overlay.style.display === 'flex';
        overlay.style.display = isVisible ? 'none' : 'flex';
        if (!isVisible) {
            window.focus();
            document.getElementById('username').focus();
        }
    }

    document.getElementById('overlay').addEventListener('click', function(event) {
        if (event.target === this) {
            toggleEditProfile();
        }
    });
</script>