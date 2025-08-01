<?php
//Basic Function
    function updateImage($pdo, $tableName, $imageColumnName, $imageFile, $idColumnName, $id) {
        // Chỉ cho phép chữ, số, dấu _ cho tên bảng và cột
        $tableName = preg_replace('/[^a-zA-Z0-9_]/', '', $tableName);
        $imageColumnName = preg_replace('/[^a-zA-Z0-9_]/', '', $imageColumnName);
        $idColumnName = preg_replace('/[^a-zA-Z0-9_]/', '', $idColumnName);
        $sql = "UPDATE $tableName SET $imageColumnName = :image WHERE $idColumnName = :id";
        $parameters = [
            ':image' => file_get_contents($imageFile),
            ':id' => $id
        ];
        query($pdo, $sql, $parameters);
    }

    function query($pdo, $sql, $parameters = []) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($parameters);
        return $stmt;
    }

    function handleHeader($pdo, $userId, $pathForAdmin, $pathForMember) {
        $user = getUserById($pdo, $userId);
        if ($user['roleId']==1) {
            header("Location: $pathForAdmin");
            exit();
        } 
        if ($user['roleId']==2) {
            header("Location: $pathForMember");
            exit();
        } else {
            session_start();
            $_SESSION['error'] = "You do not have permission to access this page.";
            session_unset();
            session_destroy();
            header('Location: ../login/loginPage.html.php');
            exit();
        }
    }


//Post
    function editPost($pdo,$postId,$postTitle,$postContent,$image, $moduleId){
        $params = [
            ':postId' => $postId,
            ':postTitle' => $postTitle,
            ':postContent' => $postContent,
            ':moduleId' => $moduleId
        ];
        query($pdo, 'UPDATE post SET
        postTitle = :postTitle,
        postContent = :postContent,
        moduleId = :moduleId 
        WHERE postId = :postId',$params);
        if ($image){
            updateImage (
                $pdo,
                'post',
                'postImage',
                $image,
                'postId',
                $postId
            );
        }
        
    }
    function getAllPosts ($pdo) {
        $posts = query($pdo, "SELECT postId, authorId, postContent, postTitle, postDate, image, reactionLike, fullName as authorName, userAvatar as authorAvatar, moduleName, user.roleId as authorRole FROM post 
                inner join user on user.userId = post.authorId 
                inner join module on module.moduleId = post.moduleId order by postDate DESC;");
        return $posts->fetchAll();
    }

    function getPostById($pdo, $postId) {
        $post = query($pdo, "SELECT postId, authorId, postContent, postTitle, postDate, image, reactionLike, fullName as authorName, userAvatar as authorAvatar, moduleName, user.roleId as authorRole FROM post 
                inner join user on user.userId = post.authorId 
                inner join module on module.moduleId = post.moduleId WHERE postId = :postId", [':postId' => $postId]);
        return $post->fetch();
    }

    function addNewPost($pdo, $postTitle, $postContent, $image, $authorId, $moduleId) {
        $parameters = [
            ':postTitle' => $postTitle,
            ':postContent' => $postContent,
            ':authorId' => $authorId,
            ':moduleId' => $moduleId
        ];
        query($pdo, 'INSERT INTO post SET
            postTitle = :postTitle,
            postContent = :postContent,
            authorId = :authorId,
            moduleId = :moduleId,
            postDate = NOW()', $parameters);
        if ($image) {
            updateImage($pdo, 
            'post', 
            'image', 
            $image, 
            'postId', 
            $pdo->lastInsertId());
        }
    }

    function deletePost($pdo, $postId) {
        $parameters = [':postId' => $postId];
        query($pdo, 'DELETE FROM post WHERE postId = :postId', $parameters);
    }

//Comment
    function deleteComment($pdo, $commentId) {
        $parameters = [':commentId' => $commentId];
        query($pdo, 'DELETE FROM comment WHERE commentId = :commentId', $parameters);
    }
    function addComment($pdo, $postId, $userId, $commentContent, $commentImage){
        $parameters = [
            ':postId' => $postId,
            ':authorId' => $userId,
            ':commentContent' => $commentContent
        ];
        query($pdo, 'INSERT INTO comment SET
            postId = :postId,
            authorId = :authorId,
            commentContent = :commentContent,
            commentDate = NOW()', $parameters);
        if ($commentImage) {
            updateImage($pdo, 
            'comment', 
            'commentImage', 
            $commentImage, 
            'commentId', 
            $pdo->lastInsertId());
        }   
    }

    function getCommentById($pdo, $commentId) {
        $parameters = [':commentId' => $commentId];
        $stmt = query($pdo, 'SELECT commentId, postId, userId, user.roleId as authorRole, commentContent, commentDate, user.fullName as authorName, user.userAvatar as authorAvatar, commentImage FROM comment 
            INNER JOIN user ON comment.authorId = user.userId WHERE commentId = :commentId', $parameters);
        return $stmt->fetch();
    }

    function updateComment($pdo, $commentId, $commentContent, $commentImage) {
        $parameters = [
            ':commentId' => $commentId,
            ':commentContent' => $commentContent
        ];
        query($pdo, 'UPDATE comment SET
            commentContent = :commentContent
            WHERE commentId = :commentId', $parameters);
        if ($commentImage) {
            updateImage($pdo, 
            'comment', 
            'commentImage', 
            $commentImage, 
            'commentId', 
            $commentId);
        }
    }

    function getCommentsByPostId($pdo, $postId) {
        $parameters = [':postId' => $postId];
        $stmt = query($pdo, 'SELECT commentId, postId, userId as authorId, user.roleId as authorRole, commentContent, commentDate, user.fullName as authorName, user.userAvatar as authorAvatar, commentImage FROM comment 
            INNER JOIN user ON comment.authorId = user.userId WHERE postId = :postId ORDER BY commentDate DESC', $parameters);
        return $stmt->fetchAll();
    }

    function totalCommentOfPost ($pdo, $postId) {
        $stmt = query($pdo, 'SELECT COUNT(*) FROM comment WHERE postId = :postId', [':postId' => $postId]);
        return $stmt->fetchColumn();
    }

    function getLikedPostByUser($pdo, $userId) {
        $stmt = query($pdo, 'SELECT postId FROM reaction WHERE userId = :userId', [':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


//User
    function addUser($pdo, $username, $password, $email, $DoB, $address, $userAvatar, $roleId) {
        $parameters = [
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':email' => $email,
            ':DoB' => $DoB,
            ':address' => $address,
            ':userAvatar' => file_get_contents($userAvatar),
            ':roleId' => $roleId
        ];
        query($pdo, 'INSERT INTO user SET
            username = :username,
            password = :password,
            email = :email,
            DoB = :DoB,
            address = :address,
            userAvatar = :userAvatar,
            roleId = :roleId', $parameters);
    }

    function updateProfile($pdo, $userId, $fullName,$password, $DoB, $email, $phoneNumber, $address, $avatar) {
        $parameters = [ 
            ':userId' => $userId,
            ':fullName' => $fullName,
            ':password' => $password,
            ':DoB' => $DoB,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':address' => $address
        ];
        query($pdo, 'UPDATE user SET
            fullName = :fullName,
            password = :password,
            DoB = :DoB,
            email = :email,
            phoneNumber = :phoneNumber,
            address = :address
            WHERE userId = :userId', $parameters);
        
        if ($avatar){
            updateImage($pdo, 
            'user', 
            'userAvatar', 
            $avatar, 
            'userId', 
            $userId);
        }
    }

    function handleUserStatus ($pdo, $userId) {
        $parameters = [
            ':userId' => $userId,
        ];
        query($pdo, 'UPDATE user SET
            userStatus = IF(userStatus = "active", "disable", "active")
            WHERE userId = :userId', $parameters);
    }   

    function getAllUsers($pdo) {
        $users = query($pdo, "SELECT userId, username, fullName, DoB, email, phoneNumber, address, userAvatar, createDate, userStatus, role.roleName, user.roleId FROM user 
            INNER JOIN role ON user.roleId = role.roleId order by roleName ASC");
        return $users->fetchAll();
    }

    function getUserByUsername($pdo, $username){
        $parameters =[
            ':username' => $username,
        ];
        $user = query($pdo, 'SELECT userId, username, password, fullName, DoB, email, phoneNumber, address, user.roleId, userStatus, role.roleName, userAvatar, createDate 
            FROM user inner join role on user.roleId = role.roleId WHERE user.username = :username', $parameters);
        return $user->fetch();
    }
    function getUserById($pdo, $userId){
        $parameters =[
            ':userId' => $userId,
        ];
        $user = query($pdo, 'SELECT userId, username, password, fullName, DoB, email, phoneNumber, address, user.roleId, userStatus, role.roleName, userAvatar, createDate 
            FROM user inner join role on user.roleId = role.roleId WHERE user.userId = :userId', $parameters);
        return $user->fetch();
    }

    function isExistingUser($pdo, $username) {
        $parameters = [
            ':username' => $username
        ];
        $stmt = query($pdo, 'SELECT * FROM user WHERE username = :username', $parameters);
        return $stmt->fetch() !== false;
    }   

    function addNewUser($pdo, $username, $password, $fullName, $DoB, $email, $phoneNumber, $address, $userAvatar, $roleId) {
        $parameters = [
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':fullName' => $fullName,
            ':DoB' => $DoB,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':address' => $address,
            ':roleId' => $roleId
        ];
        query($pdo, 'INSERT INTO user SET
            username = :username,
            password = :password,
            fullName = :fullName,
            DoB = :DoB,
            email = :email,
            phoneNumber = :phoneNumber,
            address = :address,
            roleId = :roleId,
            createDate = CURDATE()',
            $parameters);
        if ($userAvatar) {
            updateImage($pdo, 
            'user', 
            'userAvatar', 
            $userAvatar, 
            'userId', 
            $pdo->lastInsertId());   
        }
    }
    function isActive($pdo, $userId) {
        $parameters = [':userId' => $userId];
        $stmt = query($pdo, 'SELECT userStatus FROM user WHERE userId = :userId', $parameters);
        $result = $stmt->fetch();
        return $result ? $result['userStatus'] === 'active' : false;
    }

    function editMember($pdo, $userId, $fullName, $email, $phoneNumber, $address, $roleId) {
        $parameters = [
            ':userId' => $userId,
            ':fullName' => $fullName,
            ':email' => $email,
            ':phoneNumber' => $phoneNumber,
            ':address' => $address,
            ':roleId' => $roleId
        ];
        query($pdo, 'UPDATE user SET
            fullName = :fullName,
            email = :email,
            phoneNumber = :phoneNumber,
            address = :address,
            roleId = :roleId
            WHERE userId = :userId', $parameters);
    }
    function deleteUser($pdo, $userId) {
        $parameters = [':userId' => $userId];
        query($pdo, 'DELETE FROM user WHERE userId = :userId', $parameters);
    }

//Module
    function addModule($pdo,$moduleCode, $moduleName, $moduleImage, $description){
        $parameters = [
            ':moduleName' => $moduleName,
            ':moduleCode' => $moduleCode,
            ':moduleImage' => file_get_contents($moduleImage),
            ':description' => $description
        ];
        query($pdo, 'INSERT INTO module SET
            moduleName = :moduleName,
            moduleCode = :moduleCode,
            moduleImage = :moduleImage,
            createDate = CURDATE(),
            description = :description', $parameters);
    }

    function deleteModule($pdo, $moduleId) {
        $parameters = [':moduleId' => $moduleId];
        $stmt = query($pdo, 'DELETE FROM module WHERE moduleId = :moduleId', $parameters);
        return $stmt;
    }
    function getModuleById($pdo, $moduleId) {
        $parameters = [
            ':moduleId' => $moduleId
        ];
        $stmt = query($pdo, 'SELECT * FROM module WHERE moduleId = :moduleId', $parameters);
        return $stmt->fetch();
    }

    function editModule($pdo, $moduleId, $moduleName, $moduleCode, $description) {
        $parameters = [
            ':moduleId' => $moduleId,
            ':moduleName' => $moduleName,
            ':moduleCode' => $moduleCode,
            ':description' => $description
        ];
        query($pdo, 'UPDATE module SET
            moduleName = :moduleName,
            moduleCode = :moduleCode,
            description = :description
            WHERE moduleId = :moduleId', $parameters);
    }

    
//Role
    function addRole($pdo, $roleName){
        $parameters = [
            ':roleName' => $roleName
        ];
        query($pdo, 'INSERT INTO role SET
            roleName = :roleName', $parameters);
    }
    function getAllModules($pdo){
        $stmt = query($pdo, "SELECT * FROM module");
        return $stmt->fetchAll();
    }
    
    function getAllRoles($pdo){
        $stmt = query($pdo, "SELECT * FROM role");
        return $stmt->fetchAll();
    }

    function getRoleById($pdo, $id){
        $stmt = query($pdo, "SELECT * FROM role WHERE id = :id", [':id' => $id]);
        return $stmt->fetch();
    }

    function updateRole($pdo, $id, $roleName){
        $parameters = [
            ':id' => $id,
            ':roleName' => $roleName
        ];
        query($pdo, 'UPDATE role SET
            roleName = :roleName
            WHERE id = :id', $parameters);
    }

//Reaction
     
    function totalReactionOfPost ($pdo, $postId) {
        $stmt = query($pdo, 'SELECT COUNT(*) FROM reaction WHERE postId = :postId', [':postId' => $postId]);
        return $stmt->fetchColumn();
    }   

    function likePost ($pdo, $postId, $userId) {
        $parameters = [
            ':postId' => $postId,
            ':userId' => $userId
        ];
        query($pdo, 'INSERT INTO reaction SET 
            postId = :postId, 
            userId = :userId', $parameters);
    }

    function unlikePost ($pdo, $postId, $userId) {
        $parameters = [
            ':postId' => $postId,
            ':userId' => $userId
        ];
        query($pdo, 'DELETE FROM reaction WHERE postId = :postId AND userId = :userId', $parameters);
    }


//Mail
    function sendMail($pdo, $from, $to, $subject, $message) {
        $parameters = [
            ':from' => $from,
            ':to' => $to,
            ':mailSubject' => $subject,
            ':mailMessage' => $message
        ];
        query($pdo, 'INSERT INTO mail SET 
            mailFrom = :from, 
            mailTo = :to, 
            mailSubject = :mailSubject, 
            mailMessage = :mailMessage, 
            sentDate = NOW()', $parameters);
    }   


    function getAllReceivedMailOfUser($pdo, $userId) {
        $sql= 'SELECT 
                    m.mailId,
                    sender.fullName AS senderName,
                    sender.userAvatar AS senderAvatar,
                    receiver.fullName AS receiverName,
                    m.mailSubject,
                    m.mailMessage,
                    m.sentDate AS receivedDate
                FROM 
                    mail AS m
                INNER JOIN 
                    user AS sender ON m.mailFrom = sender.userId
                INNER JOIN 
                    user AS receiver ON m.mailTo = receiver.userId
                WHERE 
                    m.mailTo = :userId
                ORDER BY 
                    m.sentDate DESC';
        $stmt = query($pdo, $sql, [':userId' => $userId]);
        return $stmt->fetchAll();
    }

    function getAllSentMailOfUser($pdo, $userId) {
        $sql= 'SELECT 
                    m.mailId,
                    sender.fullName AS senderName,
                    receiver.fullName AS receiverName,
                    receiver.userAvatar AS receiverAvatar,
                    m.mailSubject,
                    m.mailMessage,
                    m.sentDate AS sentDate
                FROM 
                    mail AS m
                INNER JOIN 
                    user AS sender ON m.mailFrom = sender.userId
                INNER JOIN 
                    user AS receiver ON m.mailTo = receiver.userId
                WHERE 
                    m.mailFrom = :userId
                ORDER BY 
                    m.sentDate DESC';
        $stmt = query($pdo, $sql, [':userId' => $userId]);
        return $stmt->fetchAll();
    }

    function deleteMail($pdo, $mailId) {
        $parameters = [':mailId' => $mailId];
        query($pdo, 'DELETE FROM mail WHERE mailId = :mailId', $parameters);
    }
    