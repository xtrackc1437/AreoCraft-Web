<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $db = new PDO('sqlite:s:\web\dev\acwc-b1.0\areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare('INSERT INTO news (title, content, created_at) VALUES (:title, :content, datetime())');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->execute();

        header('Location: dashboard.php');
        exit;
    } catch (PDOException $e) {
        echo '数据库错误: ' . $e->getMessage();
    }
}