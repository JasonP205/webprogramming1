<?php session_start(); ?>
<div class="bg-white backdrop-blur-lg rounded-2xl p-6 sm:p-8 shadow-2xl mb-8 w-full max-w-4xl mx-auto border border-gray-100/50">
    <h2 class="text-lg font-semibold mb-4 text-center">Compose New Mail</h2>
    <div class="border-b border-gray-300 mb-4"></div>
    <form action="" method="post" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="to" class="block text-gray-700 font-semibold">To:</label>
            <select id="to" name="to" required class="appearance-none w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <option value="" disabled selected>Select recipient</option>
                <?php foreach ($receiver as $user): ?>
                    <option value="<?= htmlspecialchars($user['userId'], ENT_QUOTES, 'UTF-8') ?>" <?= $_SESSION['userId'] == $user['userId'] ? 'disabled' : '' ?>>
                        <?=$user['roleId']==1?"[Admin] - ":""?><?= htmlspecialchars($user['fullName'], ENT_QUOTES, 'UTF-8') ?> - <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="subject" class="block text-gray-700 font-semibold">Subject:</label>
            <input type="text" id="subject" name="subject" required class="w-full font-semibold px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label for="message" class="block text-gray-700 font-semibold">Message:</label>
            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded-full font-semibold hover:bg-blue-700 transition-colors">Send Mail</button>
        </div>
    </form>
</div>
<div class="bg-white backdrop-blur-lg rounded-2xl p-6 sm:p-8 shadow-2xl mb-8 w-full max-w-4xl mx-auto border border-gray-100/50">
    <h2 class="text-lg font-semibold mb-4">Sent Mail</h2>
    <ul>
        <?php if(empty($sentsMail)): ?>
            <span class="text-gray-500 text-center italic py-4">Empty</span>
        <?php endif; ?>
        <?php foreach ($sentsMail as $mail): ?>
            <li class="border-b border-gray-200 py-4 flex items-center gap-4">
                <img src="data:image/jpeg;base64,<?=base64_encode($_SESSION['userAvatar'])?>" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
                <div class="flex-1">
                    <div class="flex gap-2 items-center">
                        <span class="font-semibold text-blue-700">To:</span>
                        <span><?=htmlspecialchars($mail['receiverName']); ?></span>
                        <span class="text-gray-400 text-xs">| <?=htmlspecialchars($mail['sentDate']); ?></span>
                        <span class="ml-auto"><a href="../deleteMail.php?mailId=<?=htmlspecialchars($mail['mailId']); ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this mail?');">Delete</a></span>
                    </div>
                    <strong class="block mt-1"><?=htmlspecialchars($mail['mailSubject']); ?></strong>
                    <p class="text-sm text-gray-600 mt-1"><?=htmlspecialchars($mail['mailMessage']); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <h2 class="text-lg font-semibold mt-6 mb-4">Received Mail</h2>
    <ul>
        <?php if(empty($receivedMail)): ?>
            <span class="text-gray-500 text-center italic py-4">No email received</span>
        <?php endif; ?>
        <?php foreach ($receivedMail as $mail): ?>
            <li class="border-b border-gray-200 py-4 flex items-center gap-4">
                <img src="data:image/jpeg;base64,<?=base64_encode($mail['senderAvatar'])?>" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
                <div class="flex-1">
                    <div class="flex gap-2 items-center">
                        <span class="font-semibold text-blue-700">From:</span>
                        <span><?=htmlspecialchars($mail['senderName']); ?></span>
                        <span class="text-gray-400 text-xs">| <?=htmlspecialchars($mail['receivedDate']); ?></span>
                        <span class="ml-auto"><a href="../deleteMail.php?mailId=<?=htmlspecialchars($mail['mailId']); ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this mail?');">Delete</a></span>
                    </div>
                    <strong class="block mt-1"><?=htmlspecialchars($mail['mailSubject']); ?></strong>
                    <p class="text-sm text-gray-600 mt-1"><?=htmlspecialchars($mail['mailMessage']); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<script>
    <?php if (isset($_SESSION['message'])): ?>
        Swal.fire({
            icon: 'success',
            title: 'Successfully',
            text: "<?= addslashes($_SESSION['message']); ?>"
        });
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>