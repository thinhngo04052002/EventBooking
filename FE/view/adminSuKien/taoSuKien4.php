<?php
include './controller/productService.php';

$events = callProductService('ve/get-all-ve');
?>
<ul>
    <?php
    if ($events) {
        foreach ($events as $event) {
            echo "<li>{$event['trangThaiBan']}</li>";
        }
    } else {
        echo "<li>Không có sự kiện nào</li>";
    }
    ?>
</ul>