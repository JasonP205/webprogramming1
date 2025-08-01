<div class="bg-white glassmorphism rounded-3xl px-10 p-10">
    <button onclick="window.history.back()" 
            class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
    </button>
    
    <h2 class="text-2xl font-semibold text-gray-800 mb-2 text-center">
        Edit information for 
        <?=htmlspecialchars($selectedUser['fullName'],ENT_QUOTES, 'UTF-8')?>
    </h2>
    <div class="border-b-2 border-gray-400 pb-2 mb-6"></div>
    <form action="../admin/editMember.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="userId" value="<?= htmlspecialchars($selectedUser['userId'],ENT_QUOTES, 'UTF-8') ?>">
        <div class="mb-6 flex items-center">
            <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Full name</span>
            <input 
                type="text" 
                id="fullName" 
                name="fullName" 
                required 
                value="<?= htmlspecialchars($selectedUser['fullName'], ENT_QUOTES, 'UTF-8') ?>"
                placeholder="Enter new fullname..."
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
            >
        </div>

        <div class="mb-6 flex items-center">
            <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Email</span>
            <input 
                    type="text" 
                    id="email" 
                    name="email" 
                    required 
                    value="<?= htmlspecialchars($selectedUser['email'], ENT_QUOTES, 'UTF-8') ?>"
                    placeholder="Enter new email..."
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
                    value="<?= htmlspecialchars($selectedUser['address'], ENT_QUOTES, 'UTF-8') ?>"
                    placeholder="Enter new address..."
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
                    value="<?= htmlspecialchars($selectedUser['phoneNumber'], ENT_QUOTES, 'UTF-8') ?>"
                    placeholder="Enter your phone number"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                >
        </div>

        <div class="mb-6 flex items-center">
            <span class="w-40 pr-6 text-gray-700 font-semibold text-lg">Account Type</span>
            <select name="roleId" required
                class="appearance-none flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                <?php foreach ($roles as $role): ?>
                    <option value="<?=htmlspecialchars($role['roleId'], ENT_QUOTES, 'UTF-8')?>" <?= $role['roleId'] === $selectedUser['roleId'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($role['roleName'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Update</button>
    </form>
</div>