<div class="bg-white glassmorphism rounded-3xl p-8 shadow-xl">
    <button onclick="window.history.back()" 
            class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>

    <div class="border-b-2 border-gray-400 pb-2 text-xl font-semibold text-gray-800 mb-4 text-center">  
        Edit Module <?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?>
    </div>

    <form action="../admin/editModule.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="moduleId" value="<?= htmlspecialchars($module['moduleId'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="mb-4">
            <label for="moduleCode" class="block text-gray-700 font-medium mb-1">Module Code:</label>
            <input
                type="text" 
                id="moduleCode" 
                name="moduleCode" 
                required 
                class="uppercase w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                value="<?=htmlspecialchars($module['moduleCode'], ENT_QUOTES, 'UTF-8')?>">
        </div>
        <div class="mb-4">
            <label for="moduleName" class="block text-gray-700 font-medium mb-1">Module Name:</label>
            <input
                type="text" 
                id="moduleName" 
                name="moduleName" 
                required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                value="<?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8')?>">

        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-1">Module Description:</label>
            <input
                type="text" 
                id="description" 
                name="description" 
                required 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                value="<?=htmlspecialchars($module['description'], ENT_QUOTES, 'UTF-8')?>">
        </div>
        <div class="mb-4">
            <label for="moduleImage" class="block text-gray-700 font-medium mb-1">Module Image</label>
            <input 
                type="file" 
                id="moduleImage" 
                name="moduleImage" 
                accept="image/*" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
            >
        </div>
        <button 
            type="submit" 
            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors"
        >
            Save Changes
        </button>
    </form>
</div>