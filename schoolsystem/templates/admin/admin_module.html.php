<div class="bg-white glassmorphism rounded-3xl p-8 shadow-xl">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="addModule.php" class="inline-flex flex-col items-center justify-center bg-blue-50 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-40 h-40 text-blue-600 mb-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span class="text-blue-600 text-xl font-semibold text-center">Add New Module</span>
        </a> 
    <?php foreach ($modules as $module): ?>
        <div class="module bg-blue-50 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">
                <?= htmlspecialchars($module['moduleCode'], ENT_QUOTES, 'UTF-8') ?> -
                <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
            </h3>
            <span class="text-gray-500 text-sm block mb-2">
                Create date: <?= htmlspecialchars($module['createDate'], ENT_QUOTES, 'UTF-8') ?>
            </span>
            <img 
                src="data:image/jpeg;base64,<?=base64_encode($module['moduleImage'])?>" 
                alt="Module Image" 
                class="module-image w-full h-48 object-cover rounded-md mb-4">
            <p class="text-sm italic text-gray-700">
                <?= htmlspecialchars($module['description'], ENT_QUOTES, 'UTF-8') ?>
            </p>
            <div class="flex space-x-2 pt-2 place-content-end">
                <form action="../admin/editModule.php" method="post" class="w-full max-w-[130px]">
                    <input type="hidden" name="moduleId" value="<?= htmlspecialchars($module['moduleId'], ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-blue-100 text-blue-600 hover:bg-blue-500 hover:text-white px-2 py-2 rounded-full font-semibold transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                        Edit
                    </button>
                </form>
                <form action="../admin/deleteModule.php" method="post" class="w-full max-w-[130px]">
                    <input type="hidden" name="moduleId" value="<?= htmlspecialchars($module['moduleId'], ENT_QUOTES, 'UTF-8') ?>">
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-600 hover:bg-red-500 hover:text-white px-2 py-2 rounded-full font-semibold transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
        
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

    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "<?= addslashes($_SESSION['message']); ?>"
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>


