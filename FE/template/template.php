<?php $VIEW ?>
<?php $token ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>20120591_BTUDPT2</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <div id="header">
        <!-- lấy tên user -->
        <?php $username = 'JohnDoe'; ?>
        <!-- nếu chưa đăng nhập thì trả về header này -->
        <?php require("./view/header_chuaDangNhap.php"); ?>

        <!-- nếu là admin sự kiện hoặc hệ thống thì trả về header này -->
        <?php require("./view/header_admin.php"); ?>
        <!-- nếu là khách hàng thì trả về header này -->
        <?php require("./view/header_khachHang.php"); ?>
    </div>
    <div id="container">

        <nav id="navbar">
            <!-- nếu chưa đăng nhập thì trả về navbar này -->
            <?php require("./view/navigationBar_khachHang.php"); ?>
            <!-- nếu là admin sự kiện thì trả về navbar này -->
            <?php require("./view/navigationBar_adminSuKien.php"); ?>
            <!-- nếu là admin hệ thống thì trả về navbar này -->
            <?php require("./view/navigationBar_adminHeThong.php"); ?>
            <!-- nếu là khách hàng thì trả về navbar này -->
            <?php require("./view/navigationBar_khachHang.php"); ?>
        </nav>
        <!-- <div id="line"></div> -->
        <div id="content">
            <?php require($VIEW); ?>
        </div>
    </div>
    <div id="footer"><img style="width: 100%;    height: auto;" src="./css/images/footer.png" alt="footer"></div>
</body>
<!-- css cho menu sidebar -->
<script>
    var view = "<?php echo $VIEW ?>";
    // Get the container element
    var navbar = document.getElementById("navbar");

    // Get all buttons with class="btn" innav the container
    var navbarItems = navbar.getElementsByClassName("navbarItem");
    var fleg = 0;
    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < navbarItems.length; i++) {
        var navbarItem = navbarItems[i];
        console.log(navbarItems[i]);
        if (view.includes("home")) {
            fleg = 0;

            navbarItem.classList.add("active");
        } else if (view.includes("addTask")) {
            fleg = 1;

            navbarItem.classList.add("active");
        } else if (view.includes("listCategory")) {
            fleg = 3;

            navbarItem.classList.add("active");
        } else {
            fleg = 2;
            navbarItem.classList.add("active");
        }
        for (var j = 0; j < navbarItems.length; j++) {
            if (j != fleg) {
                navbarItems[j].classList.remove("active");
            }
        }

    }
</script>

</html>