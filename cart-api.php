<?php include __DIR__ . '/parts/config.php';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$output = [];
// 1.列表, 2.加入, 3.變更數量, 4.移除項目
// 1.list, 2.add, 3.update, 4.delete

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
$pqty = isset($_GET['pqty']) ? $_GET['pqty'] : 0;

switch ($action) {
    case 'add':
        $_SESSION['cart']['pid'] = $pqty;
        break;
    case 'update':
        break;
    case 'delete':
        break;
    case 'list':
        break;
}
$output['cart'] = $_SESSION['cart'];
echo json_encode($output, JSON_UNESCAPED_UNICODE);
