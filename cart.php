<?php include __DIR__ . '/parts/config.php'; ?>
<?php
$title = '購物車';
$pageName = 'cart';


// if (empty($_SESSION['cart'])) {
//     header('Location: product-list.php'); // 最好給個提示訊息
//     exit;
// }





?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if (empty($_SESSION['cart'])) : ?>
                <div class="alert alert-danger" role="alert">目前購物車裡沒有商品, 請至商品列表選購
                </div>
            <?php else : ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fas fa-trash-alt"></i></th>
                            <th scope="col">封面</th>
                            <th scope="col">書名</th>
                            <th scope="col">單價</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $v) : ?>
                            <tr data-sid="<?= $v['sid'] ?>">
                                <td>
                                    <a href="javascript:" onclick="deleteItem(event) ">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td>
                                    <img src="/proj/imgs/small/<?= $v['book_id'] ?>.jpg" class="card-img-top" alt="">
                                </td>
                                <td><?= $v['bookname'] ?></td>
                                <td><?= $v['price'] ?></td>
                                <td><?= $v['quantity'] ?></td>
                                <td><?= $v['price'] * $v['quantity'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    // 金額轉換, 加逗號
    const dallorCommas = function(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    };

    function deleteItem() {
        let me = $(event.currentTarget);
        let sid = me.closest('tr').attr('data-sid');
        $.get('cart-api.php', {
            action: 'delete',
            pid: sid
        }, function(data) {

            showCartCount(data);
            me.closest('tr').remove();


            if ($('tbody>tr').length < 1) {
                location.reload(); // 重新載入


            }


        }, 'json');
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>