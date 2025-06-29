<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    try {
        $db = new PDO('sqlite:s:\web\dev\acwc-b1.0\areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare('INSERT INTO players (username) VALUES (:username)');
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        header('Location: dashboard.php');
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            echo '<div class="mdui-alert mdui-color-red">玩家已存在</div>';
        } else {
            echo '<div class="mdui-alert mdui-color-red">玩家登记失败: ' . $e->getMessage() . '</div>';
        }
        echo '<a href="dashboard.php" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">返回仪表盘</a>';
    }
}