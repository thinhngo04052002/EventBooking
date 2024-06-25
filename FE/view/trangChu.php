<!-- danh sách sự kiện chưa xảy ra theo thể loại -->
<?php
include './controller/productService.php';

$events = callProductService('sukien/getAllSuKien');
?>
<ul>
    <?php
    if ($events) {
        foreach ($events as $event) {
            echo "<li>{$event['tenSuKien']}</li>";
        }
    } else {
        echo "<li>Không có sự kiện nào</li>";
    }
    ?>
</ul>