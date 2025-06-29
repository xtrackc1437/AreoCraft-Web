<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->prepare('DELETE FROM news WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('Location: news_management.php');
        exit;
    } catch (PDOException $e) {
        echo '<div class="mdui-alert mdui-color-red">数据库错误: '. $e->getMessage() .'</div>';
    }
}
?>