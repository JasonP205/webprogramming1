<div id="Postform" class="relative p-6 glassmorphism rounded-3xl shadow-xl w-[1024px] mx-auto">
    <button onclick="window.history.back()" 
        class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </button>
    <h2 class="border-b-2 border-gray-400 pb-2 text-2xl font-semibold text-gray-800 mb-6 text-center">Edit this post</h2>
    <div class="flex items-center mb-6">
        <img src="data:image/jpeg;base64,<?=base64_encode($selectedPost['authorAvatar'])?>" 
            alt="User Avatar" class="object-cover w-10 h-10 rounded-full mr-4 border-2 border-gray-300">
        <span class="text-gray-800 font-semibold text-xl"><?= htmlspecialchars($selectedPost['authorName'], ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <div class="px-10 pb-10">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-6">
                <input type="hidden" name="postId" value="<?=htmlspecialchars( $selectedPost['postId'],ENT_QUOTES,'UTF-8')?>">
                <input type="text" id="postTitle" name="postTitle" required 
                    placeholder="Enter post title..."
                    value="<?= htmlspecialchars($selectedPost['postTitle'], ENT_QUOTES, 'UTF-8') ?>"
                    class="bg-transparent border-none w-full px-4 py-3 rounded-md text-2xl focus:outline-none focus:ring-0 focus:border-none font-semibold">
            </div>
            <div class="mb-6">
                <textarea type="text" id="postContent" name="postContent" required rows="6" cols="1"
                    placeholder="What's on your mind?"
                    class="appearance-none bg-transparent border-none ml-8 w-full px-4 py-3 rounded-md text-lg focus:outline-none focus:ring-0 focus:border-none"><?=htmlspecialchars($selectedPost['postContent'],ENT_QUOTES,'UTF-8')?></textarea>
            </div>
            
            <div class="mb-6 flex items-center">
                <span class="flex-shrink-0 pr-6 text-gray-700 font-semibold text-lg">Choose module</span>
                <select name="moduleId" required 
                    class="flex-1 appearance-none bg-transparent px-4 py-3 rounded-md text-lg focus:outline-none focus:ring-0 focus:border-none">
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= htmlspecialchars($module['moduleId'], ENT_QUOTES, 'UTF-8') ?>" <?= $module['roleId'] === $selectedPost['moduleId'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>
                        </option> 
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-6 flex items-center">
                <label for="image" class="flex-shrink-0 pr-6 text-gray-700 font-semibold text-lg">Post Image</label>
                <input type="file" name="image" accept="image/*" 
                    class="w-full px-4 py-3 rounded-md text-lg focus:outline-none">
            </div>
            <button type="submit" class="hover:scale-105 transition-transform duration-300 w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Post</button>
        </form>
    </div>
</div>
