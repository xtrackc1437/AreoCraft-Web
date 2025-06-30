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
        password TEXT NOT NULL,
        permission TEXT NOT NULL DEFAULT 'coadmin',
        last_login_time TEXT,
        last_login_ip TEXT
    )");

    // 创建登录记录表
    $db->exec("CREATE TABLE IF NOT EXISTS admin_login_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        admin_id INTEGER NOT NULL,
        login_time TEXT DEFAULT CURRENT_TIMESTAMP,
        login_ip TEXT NOT NULL,
        FOREIGN KEY (admin_id) REFERENCES admins(id)
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

    // 创建管理员设置表并插入默认独立访问密码
    $db->exec("CREATE TABLE IF NOT EXISTS admin_settings (access_password TEXT)");
    $defaultAccessPassword = password_hash('default123', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT OR IGNORE INTO admin_settings (access_password) VALUES (:password)");
    $stmt->bindValue(':password', $defaultAccessPassword);
    $stmt->execute();

    // 插入默认管理员账号
    $stmt = $db->prepare("INSERT OR IGNORE INTO admins (username, password, permission) VALUES (:username, :password, :permission)");
    $defaultPassword = password_hash('admin123', PASSWORD_DEFAULT);
    $stmt->bindValue(':username', 'admin');
    $stmt->bindValue(':password', $defaultPassword);
    $stmt->bindValue(':permission', 'admin');
    $stmt->execute();

    echo '数据库初始化成功';
} catch (PDOException $e) {
    echo '数据库初始化失败: '. $e->getMessage();
}