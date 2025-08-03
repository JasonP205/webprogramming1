<?php
session_start();
?>

<div class="flex bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8">
    <a href="../admin/information.php">
        <img src="data:image/jpeg;base64,<?=base64_encode($_SESSION['userAvatar'])?>" 
        alt="User Avatar" class="object-cover w-12 h-12 rounded-full mr-4 border-2 border-gray-300 transition-transform duration-200 hover:scale-110">
    </a>
    <button onclick="togglePost()" 
        class="cursor-text w-full bg-gray-200 text-left text-gray-500 px-6 py-3 rounded-3xl hover:bg-gray-300 transition-colors ">
        Hi <?php echo $_SESSION['fullName']?>, What's on your mind?
    </button>
</div>

<div id="overlay" class="overlay">
    <div id="Postform" class="relative p-6 glassmorphism rounded-3xl shadow-xl w-[1024px]">
        <button onclick="togglePost()" 
            class="absolute top-4 right-4 text-blue-500 text-4xl px-3 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
        <h2 class="border-b-2 border-gray-400 pb-2 text-2xl font-semibold text-gray-800 mb-6 text-center">Create New Post</h2>
        <div class="flex items-center mb-6">
            <img src="data:image/jpeg;base64,<?=base64_encode($_SESSION['userAvatar'])?>" 
                alt="User Avatar" class="object-cover w-10 h-10 rounded-full mr-4 border-2 border-gray-300">
            <span class="text-gray-800 font-semibold text-xl"><?= htmlspecialchars($_SESSION['fullName'], ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div class="px-10 pb-10">
            <form action="../addNewPost.php" method="post" enctype="multipart/form-data">
                <div class="mb-6">
                    <input type="hidden" name="authorId" value="<?= $_SESSION['userId'] ?>">
                    <input type="text" id="postTitle" name="postTitle" required 
                        placeholder="Enter post title..."
                        class="bg-transparent border-none w-full px-4 py-3 rounded-md text-2xl focus:outline-none focus:ring-0 focus:border-none font-semibold">
                </div>
                <div class="mb-6">
                    <textarea type="text" id="postContent" name="postContent" required rows="6" cols="1"
                        placeholder="What's on your mind?"
                        class="appearance-none bg-transparent border-none ml-8 w-full px-4 py-3 rounded-md text-lg focus:outline-none focus:ring-0 focus:border-none"></textarea>
                </div>
                
                <div class="mb-6 flex items-center">
                    <span class="flex-shrink-0 pr-6 text-gray-700 font-semibold text-lg">Choose module</span>
                    <select name="moduleId" required 
                        class="flex-1 appearance-none bg-transparent px-4 py-3 rounded-md text-lg focus:outline-none focus:ring-0 focus:border-none">
                        <option value="" disabled selected >Select a module</option>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?= htmlspecialchars($module['moduleId'], ENT_QUOTES, 'UTF-8') ?>">
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
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-full text-lg hover:bg-blue-600 transition-colors">Post</button>
            </form>
        </div>
    </div>
</div>


<div class="bg-white glassmorphism rounded-3xl w-full max-w-4xl mx-auto p-8 shadow-xl mb-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Recent Posts</h2>
    <div class="grid gap-8">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="rounded-xl border border-gray-200 shadow-md p-6 hover:shadow-lg transition-shadow bg-blue-50">
                    <div class="flex mb-4">
                        <img src="data:image/jpeg;base64,<?=base64_encode($post['authorAvatar'])?>" alt="Avatar" 
                            class="w-12 h-12 rounded-full mr-3 border-2 border-gray-300 object-cover">
                        <div>    
                            <div class="flex items-center font-semibold text-blue-700 text-lg gap-2">
                                <span>
                                    <?= htmlspecialchars($post['authorName'], ENT_QUOTES, 'UTF-8') ?>
                                    <?php if ($post['authorRole'] == 1): ?>
                                        <div class="bg-yellow-200 rounded-full px-2 py-1 text-xs inline-flex items-center gap-1 text-yellow-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                            </svg>
                                            Admin
                                        </div>
                                    <?php endif; ?>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                </svg>
                                <span><?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <span class="text-gray-500 text-sm"><?= htmlspecialchars($post['postDate'], ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <?php if($_SESSION['roleId']==1 || $post['authorId']==$_SESSION['userId']):?>
                        <div class="flex items-center ml-auto">
                            <div class="relative inline-block text-left text-blue-600">
                                <button type="button" class="menu-btn p-2 rounded-full hover:bg-gray-200 focus:outline-none" onclick="toggleMenu(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>
                                <div class="menu-dropdown hidden absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <div class="py-1">
                                        <a href="../admin/editPost.php?postId=<?= htmlspecialchars($post['postId'], ENT_QUOTES, 'UTF-8') ?>" 
                                            class="flex gap-2  px-4 py-2 text-blue-600 hover:bg-blue-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                            <span>Edit post</span>
                                        </a>
                                        <a href="../deletePost.php?postId=<?= htmlspecialchars($post['postId'], ENT_QUOTES, 'UTF-8') ?>" 
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
                    <h3 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($post['postTitle'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($post['postContent'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php if (!empty($post['image'])): ?>
                            <img src="data:image/jpeg;base64,<?=base64_encode($post['image'])?>" alt="Post Image" 
                                class="bg-gray-100 w-full max-h-[450px] object-cover rounded-lg mb-4 mx-auto border-2 border-gray-100">
                    <?php endif; ?>
                    <div class="flex">
                        <span class="mr-auto text-gray-500"><?= htmlspecialchars($post['totalReactions'], ENT_QUOTES, 'UTF-8') ?> <?=$post['totalReactions'] <= 1 ? 'like' : 'likes'?></span>
                        <span class="ml-auto text-gray-500"><?= htmlspecialchars($post['totalComments'], ENT_QUOTES, 'UTF-8') ?> <?=$post['totalComments'] <= 1 ? 'comment' : 'comments'?></span>
                    </div>
                    <div class="border-b border-blue-400 pb-2 mb-4"></div>
                    <div class="flex items-center text-sm text-gray-500 gap-6 w-full">
                        <a href="../likePost.php?postId=<?= htmlspecialchars($post['postId'], ENT_QUOTES, 'UTF-8')?>" 
                            class="px-4 py-2 bg-<?= in_array($post['postId'], $likedPost) ? 'red' : 'blue' ?>-100 text-<?= in_array($post['postId'], $likedPost) ? 'red' : 'blue' ?>-600 hover:scale-110 rounded-full font-semibold transition duration-300">
                            <?php if (in_array($post['postId'], $likedPost)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                </svg>
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            <?php endif; ?>
                        </a>
                        <a href="../admin/detailPost.php?postId=<?= htmlspecialchars($post['postId'], ENT_QUOTES, 'UTF-8')?>" 
                            class="items-center justify-center flex w-full gap-2 bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white hover:scale-105 px-4 py-2 rounded-full font-semibold transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" 
                                    d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                            <span>Comment</span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 text-center">No posts found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    <?php if (isset($_SESSION['errorUploadPost'])): ?>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "<?= addslashes($_SESSION['errorUploadPost']); ?>"
        });
        <?php unset($_SESSION['errorUploadPost']); ?>
        togglePost();
    <?php endif; ?>

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

    function togglePost() {
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
            togglePost();
        }
    });

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