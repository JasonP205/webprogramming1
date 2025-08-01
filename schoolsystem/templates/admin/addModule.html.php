<div class="bg-white glassmorphism rounded-3xl p-8 shadow-xl">
    <button onclick="window.history.back()" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
        &larr; Back
    </button>
    <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Add New Module</h2>
                <form action="../admin/addModule.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="moduleCode" class="block text-gray-700 font-medium mb-1 ">Module Code:</label>
                        <input 
                            type="text" 
                            id="moduleCode" 
                            name="moduleCode" 
                            required 
                            class="uppercase w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>
                    <div class="mb-4">
                        <label for="moduleName" class="block text-gray-700 font-medium mb-1">Module Name:</label>
                        <input 
                            type="text" 
                            id="moduleName" 
                            name="moduleName" 
                            required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-1">Module Description:</label>
                        <input 
                            type="text" 
                            id="description" 
                            name="description" 
                            required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>
                    <div class="mb-4">
                        <label for="moduleImage" class="block text-gray-700 font-medium mb-1">Avatar for Module:</label>
                        <input 
                            type="file" 
                            id="moduleImage" 
                            name="moduleImage" 
                            accept="image/*" 
                            required 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        >
                    </div>
                    <button 
                        type="submit" 
                        class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors"
                    >
                        Add Module
                    </button>
                </form>
</div>