<?php 
session_start();
?>
<div class="bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8">
    <div class="flex mb-4">
            <img src="data:image/jpeg;base64,<?=base64_encode($selectedPost['authorAvatar'])?>" alt="Avatar" 
                class="w-12 h-12 rounded-full mr-3 border-2 border-gray-300 object-cover">
            <div>    
                <div class="flex items-center font-semibold text-blue-700 text-lg gap-2">
                    <span>
                        <?= htmlspecialchars($selectedPost['authorName'], ENT_QUOTES, 'UTF-8') ?>
                        <?php if ($selectedPost['authorRole'] == 1): ?>
                            <div class="bg-yellow-200 rounded-full px-2 py-1 text-xs inline-flex items-center gap-1 text-yellow-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                                Admin
                            </div>
                        <?php endif; ?>
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="size-4 transform rotate-90">
                        <path fill-rule="evenodd"
                            d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003Z"
                            clip-rule="evenodd"/>
                    </svg>
                    <span><?= htmlspecialchars($selectedPost['moduleName'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <span class="text-gray-500 text-sm"><?= htmlspecialchars($selectedPost['postDate'], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <?php if($_SESSION['roleId']==1 || $selectedPost['authorId']==$_SESSION['userId']):?>
                <div class="flex items-center ml-auto">
                    <div class="relative inline-block text-left text-blue-600">
                        <button type="button" class="menu-btn p-2 rounded-full hover:bg-gray-200 focus:outline-none" onclick="toggleMenu(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </button>
                        <div class="menu-dropdown hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <div class="py-1">
                                <a href="../admin/editPost.php?postId=<?= htmlspecialchars($selectedPost['postId'], ENT_QUOTES, 'UTF-8') ?>" 
                                    class="flex gap-2  px-4 py-2 text-blue-600 hover:bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                    </svg>
                                    <span>Edit post</span>
                                </a>
                                <a href="../deletePost.php?postId=<?= htmlspecialchars($selectedPost['postId'], ENT_QUOTES, 'UTF-8') ?>" 
                                    onclick="return confirm('Are you sure you want to delete this post?');" 
                                    class="flex gap-2  px-4 py-2 text-red-600 hover:bg-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Delete post</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($selectedPost['postTitle'], ENT_QUOTES, 'UTF-8') ?></h3>
        <p class="text-gray-700 mb-4"><?= htmlspecialchars($selectedPost['postContent'], ENT_QUOTES, 'UTF-8') ?></p>
        <?php if (!empty($selectedPost['image'])): ?>
                <img src="data:image/jpeg;base64,<?=base64_encode($selectedPost['image'])?>" alt="Post Image" 
                    class="bg-gray-100 w-full max-h-[600px] object-cover rounded-lg mb-4 mx-auto border-2 border-gray-100">
        <?php endif; ?>
</div>

<div class="flex flex-cols bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8 gap-3">
    <form action="../addComment.php" method="post" enctype="multipart/form-data" class="flex items-start w-full gap-2">
        <img src="data:image/jpeg;base64,<?=base64_encode($_SESSION['userAvatar'])?>" alt="User Avatar" 
            class="w-12 h-12 rounded-full border-2 border-gray-300 object-cover">

        <div class="flex-1">
            <input type="hidden" name="postId" value="<?=htmlspecialchars($selectedPost['postId'], ENT_QUOTES, 'UTF-8')?>">

            <div class="flex items-center gap-2 mb-2">
                <input type="text" id="commentContent" name="commentContent" required 
                    placeholder="Say something about this post..."
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


<div class="bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8">
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-2">Comments</h4>
        <?php if (empty($comments)): ?>
            <p class="text-gray-500">No comments yet.</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="bg-gray-50 p-4 rounded-lg mb-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <img src="data:image/jpeg;base64,<?=base64_encode($comment['authorAvatar'])?>" alt="Avatar" 
                            class="w-8 h-8 rounded-full mr-3 border-2 border-gray-300 object-cover">
                        <div>
                            <span class="font-semibold text-blue-700">
                                <?= htmlspecialchars($comment['authorName'], ENT_QUOTES, 'UTF-8') ?>
                                <?php if ($comment['authorRole'] == 1): ?>
                                        <div class="bg-yellow-200 rounded-full px-2 py-1 text-xs inline-flex items-center gap-1 text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                            </svg>
                                            Admin
                                        </div>
                                    <?php endif; ?>
                            </span>
                            <span class="text-gray-500 text-sm"> - <?= htmlspecialchars($comment['commentDate'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <?php if($_SESSION['roleId']==1 || $comment['authorId']==$_SESSION['userId']):?>
                        <div class="flex items-center ml-auto">
                            <div class="relative inline-block text-left text-blue-600">
                                <button type="button" class="menu-btn p-2 rounded-full hover:bg-gray-200 focus:outline-none" onclick="toggleMenu(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>
                                <div class="menu-dropdown hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <a href="../editComment.php?commentId=<?= htmlspecialchars($comment['commentId'], ENT_QUOTES, 'UTF-8') ?>&postId=<?= htmlspecialchars($comment['postId'], ENT_QUOTES, 'UTF-8') ?>" 
                                            class="flex gap-2  px-4 py-2 text-blue-600 hover:bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                            <span>Edit comment</span>
                                        </a>
                                        <a href="../deleteComment.php?commentId=<?= htmlspecialchars($comment['commentId'], ENT_QUOTES, 'UTF-8') ?>&postId=<?= htmlspecialchars($comment['postId'], ENT_QUOTES, 'UTF-8') ?>" 
                                            onclick="return confirm('Are you sure you want to delete this comment?');" 
                                            class="flex gap-2  px-4 py-2 text-red-600 hover:bg-red-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                            </svg>
                                            <span>Delete comment</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-700"><?= htmlspecialchars($comment['commentContent'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php if (!empty($comment['commentImage'])): ?>
                        <img src="data:image/jpeg;base64,<?=base64_encode($comment['commentImage'])?>" alt="Comment Image" 
                            class="mt-2 max-h-48 object-cover rounded-lg border-2 border-gray-100">
                    <?php endif; ?>              
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script>
<?php if (isset($_SESSION['errorUploadComment'])): ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "<?= addslashes($_SESSION['errorUploadComment']); ?>"
    });
    <?php unset($_SESSION['errorUploadComment']); ?>
    togglePost();
<?php endif; ?>

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

</script>
