<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Example user role from session
$userRole = isset($_SESSION['userRole']) ? $_SESSION['userRole'] : 'KH'; // Default to 'Kh' if not set
?>

<style>
/* body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: left;
    color: #333;
}

#comments-section {
    margin-top: 20px;
}

.comment-card {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    text-align: left;
}

.comment-card h3 {
    margin: 0;
    font-size: 1.2em;
    color: #007bff;
    text-align: left;
}

.comment-card p {
    margin: 10px 5px;
    color: #555;
    text-align: left;
}

.comment-card small {
    color: #888;
}

.btn btn-primary {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;

}  */

/* .btn-primary {
    margin-top: 10px;

}  */
/* .btn .btn-primary{
    margin-top: 10px;

}

 /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: left;
    color: #333;
}

#comments-section {
    margin-top: 20px;
}

.comment-card {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    text-align: left;
}

.comment-card h3 {
    margin: 0;
    font-size: 1.2em;
    color: #007bff;
    text-align: left;
}

.comment-card p {
    margin: 10px 5px;
    color: #555;
    text-align: left;
}

.comment-card small {
    color: #888;
}

.btn-primary {
    width: 50px
    /* display: inline-block; */
    padding: 10px 20px;
    background-color: #31a14a;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px; 
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>
<div class="container">
        <h1>Tất Cả Đánh Giá</h1>
        <div id="comments-section">
            <?php if (isset($data) && count($data) > 0): ?>
                <?php foreach ($data as $comment): ?>
                    <div class="comment-card">
                        <h3>Người dùng: <?php if (isset($_SESSION['username'])): // Check if the user's name is set in the session ?>
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        <?php endif; ?></h3>
                        <p><?php echo htmlspecialchars($comment['SoSao']); ?></p>                  
                        <?php if (strtolower($comment['phanhoi']) !== 'string'): // Check if the response is not "string" ?>
                            <p>Phản hồi: <?php echo htmlspecialchars($comment['phanhoi']); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($userRole === 'ADDVSK'): // Check if the user is an admin ?>
                            <a href="#>" class="btn btn-primary">Phản hồi</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có đánh giá nào.</p>
            <?php endif; ?>
        </div>
    </div>