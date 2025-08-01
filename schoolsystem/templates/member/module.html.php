<div class="bg-white glassmorphism rounded-3xl p-8 shadow-xl">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($modules as $module): ?>
            <div class="module bg-blue-50 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-semibold text-blue-600 mb-2">
                    <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                </h3>
                <span class="text-gray-500 text-sm block mb-2">
                    Create date: <?= htmlspecialchars($module['createDate'], ENT_QUOTES, 'UTF-8') ?>
                </span>
                <img 
                    src="data:image/jpeg;base64,<?=base64_encode($module['moduleImage'])?>" 
                    alt="Module Image" 
                    class="module-image w-full h-48 object-cover rounded-md mb-4">
                <p class="text-md text-gray-700">
                    <?= htmlspecialchars($module['description'], ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>


