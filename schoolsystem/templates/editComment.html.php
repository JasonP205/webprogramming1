<div class="flex flex-cols bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8 gap-3">
    <form action="" method="post" enctype="multipart/form-data" class="flex items-start w-full gap-2">
        <img src="data:image/jpeg;base64,<?=base64_encode($selectedComment['authorAvatar'])?>" alt="User Avatar" 
            class="w-12 h-12 rounded-full border-2 border-gray-300 object-cover">
        <div class="flex-1">
            <input type="hidden" name="postId" value="<?=htmlspecialchars($selectedPost['postId'], ENT_QUOTES, 'UTF-8')?>">

            <div class="flex items-center gap-2 mb-2">
                <input type="text" id="commentContent" name="commentContent" required 
                    placeholder="Say something about this post..."
                    value="<?= htmlspecialchars($selectedComment['commentContent'], ENT_QUOTES, 'UTF-8') ?>"
                    class="bg-gray-100 border-none w-full px-4 py-3 rounded-full text-lg focus:outline-none focus:ring-0 focus:border-none">
                

                <button type="submit" class="hover:scale-110 bg-blue-100 hover:bg-blue-200 transition-colors px-4 py-1 rounded-full transition-transform duration-300 text-blue-500 hover:text-blue-600 py-3 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                    </svg>
                </button>
            </div>
            <div>
                <input type="file" name="commentImage" accept="image/*"
                    class="text-sm focus:outline-none">
            </div>
        </div>
    </form>
</div>