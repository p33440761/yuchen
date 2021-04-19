<?php
require __DIR__ . '/parts/config.php';



$output = [
    'success' => false,
    'code' => 0,
    'error' => '資料沒有新增'
];

if (isset($_POST['email'])) {

    $a_sql = "SELECT `email` FROM `members` WHERE `email`=?";
    $a_stmt = $pdo->prepare($a_sql);
    $a_stmt->execute([$_POST['email']]);

    if ($a_stmt->rowCount()) {
        $output['error'] = '此email已經註冊過';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $hash = sha1($_POST['email'] . uniqid());
    $sql = "INSERT INTO `members`(
        `email`, `password`, `mobile`,
        `address`, `birthday`, `hash`,  
        `nickname`, `created_at`
        ) VALUES (
                  ?, ?, ?,
                  ?, ?, ?,
                  ?, NOW()
        )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        $_POST['mobile'],
        $_POST['address'],
        $_POST['birthday'],
        $hash,
        $_POST['nickname']
    ]);

    if ($stmt->rowcount()) {
        $output['success'] = true;
        $output['error'] = '';
    } else {
        $output['error'] = '註冊發生錯誤';
    }
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
