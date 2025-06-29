<?php
try {
    $db = new PDO('sqlite:s:\web\dev\acwc-b1.0\areocraft.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 创建新闻表
    $db->exec("CREATE TABLE IF NOT EXISTS news (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP,
        updated_at TEXT,
        original_link TEXT
    )");

    // 创建管理员表
    $db->exec("CREATE TABLE IF NOT EXISTS admins (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    )");

    // 创建玩家表
    $db->exec("CREATE TABLE IF NOT EXISTS players (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        registered_at TEXT DEFAULT CURRENT_TIMESTAMP,
        whitelisted INTEGER DEFAULT 0,
        updated_at TEXT,
        last_modified_ip TEXT
    )");

    // 插入默认管理员账号
    $stmt = $db->prepare("INSERT OR IGNORE INTO admins (username, password) VALUES (:username, :password)");
    $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt->bindValue(':username', 'admin');
    $stmt->bindValue(':password', $defaultPassword);
    $stmt->execute();

    echo '数据库初始化成功';
} catch (PDOException $e) {
    echo '数据库初始化失败: '. $e->getMessage();
}