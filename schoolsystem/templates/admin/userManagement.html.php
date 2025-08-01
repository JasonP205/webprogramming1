<?php session_start();?>
<div class="flex bg-white glassmorphism rounded-3xl p-8 shadow-xl mb-8">
    <div class="w-full">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">User Management</h2>
        <div class="mb-6">
            <button onclick="toggleAddUser()" 
                class="transition-transform duration-200 hover:scale-110 flex space-x-2 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
                <span>Add New User</span>
            </button>
        </div>
        <table class="min-w-full bg-white text-sm">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Avatar</th>
                    <th class="py-2 px-4 border-b">Username</th>
                    <th class="py-2 px-4 border-b">Full Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Account status</th>
                    <th class="py-2 px-4 border-b">Actions</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="py-2 px-4 border-b text-center ">
                            <a href="../admin/detailUserInformation.php?userId=<?= htmlspecialchars($user['userId'], ENT_QUOTES, 'UTF-8') ?>">
                                <img id="userAvatarValue" 
                                    class="border-2 border-gray-100 w-12 h-12 rounded-full object-cover bg-gray-50 transition-transform duration-200 hover:scale-110" 
                                    src="data:image/jpeg;base64,<?=base64_encode($user['userAvatar'])?>"
                                    title="Click to view details information">
                            </a>
                        </td>
                        <td id="username" class="py-2 px-4 border-b text-center"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td id="fullName" class="py-2 px-4 border-b text-center"><?= htmlspecialchars($user['fullName'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td id="email" class="py-2 px-4 border-b text-center"><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td id="roleName" class="capitalize py-2 px-4 border-b text-center">
                            <div class="flex items-center justify-center gap-1 bg-<?= $user['roleId'] == 1 ? 'yellow' : 'blue' ?>-200 text-<?= $user['roleId'] == 1 ? 'yellow' : 'blue' ?>-600 rounded-full px-2 py-1">
                                <?php if($user['roleId']==1): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                    </svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                                    </svg>
                                <?php endif; ?>
                                <?= htmlspecialchars($user['roleName'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <?php if ($user['userStatus'] == "active"): ?>
                                <span id="statusValue" class="text-green-500 transition-transform duration-200 hover:scale-110">Active</span>
                            <?php else: ?>
                                <span id="statusValue transition-transform duration-200 hover:scale-110" class="text-red-500">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <div class="flex justify-center space-x-2">
                                <?php if ($user['roleId'] == 2):?>
                                    <form action="../admin/editMember.php" method="post">
                                        <input type="hidden" name="userId" value="<?= htmlspecialchars($user['userId'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" 
                                            class="text-gray-50 text-center rounded-full bg-blue-500 hover:bg-blue-600 transition-transform duration-200 hover:scale-110 transition-colors duration-300 px-4 py-1">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="../admin/handleUserStatus.php?userId=<?=htmlspecialchars($user['userId'],ENT_QUOTES,'UTF-8');?>" method="post" onsubmit="return confirm('Are you sure you want to <?= $user['userStatus'] == 'active' ? 'deactivate' : 'activate' ?> this user?');">
                                        <input type="hidden" name="userId" value="<?= htmlspecialchars($user['userId'], ENT_QUOTES, 'UTF-8') ?>">
                                        <button type="submit" 
                                            class="transition-transform duration-200 hover:scale-110 text-gray-50 text-center rounded-full bg-<?= $user['userStatus'] == 'active' ? 'red' : 'green' ?>-500 hover:bg-<?= $user['userStatus'] == 'active' ? 'red' : 'green' ?>-600 transition-colors duration-300 px-4 py-1">
                                            <?php if ($user['userStatus'] == "active"): ?>
                                                Deactivate
                                            <?php else: ?>
                                                Activate
                                            <?php endif; ?>
                                        </button>    
                                    </form>
                                <?php elseif ($user['roleId'] == 1 && $user['username'] != $_SESSION['username']):?>
                                    <span 
                                        class="flex space-x-2 text-gray-50 text-center rounded-full bg-blue-200 transition-colors duration-300 px-4 py-1 cursor-not-allowed">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        <p>You can not change this user</p>
                                    </span>
                                <?php else: ?>
                                    <a href="../admin/information.php" 
                                        class="transition-transform duration-200 hover:scale-110 flex space-x-2 text-gray-50 text-center rounded-full bg-blue-500 hover:bg-blue-600 transition-colors duration-300 px-4 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <p>View Profile</p>
                                    </a>
                                <?php endif;?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<div id="overlayAddUser" class="overlay">
    <div id="addUser" class="relative p-6 glassmorphism rounded-3xl shadow-xl w-[1024px]">
        <button onclick="toggleAddUser()" 
            class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 class="border-b-2 border-gray-400 pb-2 text-2xl font-semibold text-gray-800 mb-6 text-center">Add New User</h2>
        <div class="px-10 pb-10">
            <form action="../admin/addUser.php" method="post" enctype="multipart/form-data">
                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Username</span>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required 
                        placeholder="Enter username..."
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Password</span>
                    <input 
                        type="text" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="Enter Password..."
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Fullname</span>
                    <input 
                        type="text" 
                        id="fullName" 
                        name="fullName" 
                        required 
                        placeholder="Enter full name..."
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                    >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Email</span>
                    <input 
                            type="email" 
                            name="email" 
                            required 
                            placeholder="Enter email..."
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Date of Birth</span>
                    <input 
                            type="date" 
                            name="DoB" 
                            required 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Address</span>
                    <input 
                            type="text" 
                            id="address" 
                            name="address" 
                            required 
                            placeholder="Enter address..."
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Phone number</span>
                    <input 
                            type="text" 
                            id="phoneNumber" 
                            name="phoneNumber" 
                            required 
                            placeholder="Enter phone number..."
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                </div>

                <div class="mb-6 flex items-center">
                    <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Account Type</span>
                    <select name="roleId" required
                        class="appearance-none flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="" disabled selected>Select account type</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?=htmlspecialchars($role['roleId'], ENT_QUOTES, 'UTF-8')?>">
                                <?= htmlspecialchars($role['roleName'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-6 flex items-center">
                    <label for="userAvatar" class="w-40 pr-6 text-gray-700 font-semibold text-lg">Avatar</label>
                    <input type="file" name="userAvatar" accept="image/*" 
                        class="bg-gray-50 flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Add</button>
            </form>
        </div>
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
        toggleAddUser();
    <?php endif; ?>
    
    <?php if (isset($_SESSION['errorEditFail'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "<?= addslashes($_SESSION['errorEditFail']); ?>"
        });
        <?php unset($_SESSION['errorEditFail']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "<?= addslashes($_SESSION['message']); ?>"
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    function toggleAddUser() {
        const overlay = document.getElementById('overlayAddUser');
        const isVisible = overlay.style.display === 'flex';
        overlay.style.display = isVisible ? 'none' : 'flex';
        if (!isVisible) {
            window.focus();
            document.getElementById('username').focus();
        }
    }


    document.getElementById('overlayAddUser').addEventListener('click', function(event) {
        if (event.target === this) {
            toggleAddUser();
        }
    });
    
</script>
