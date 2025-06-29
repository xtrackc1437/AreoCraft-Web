<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// 确保 news 表有 updated_at 字段
try {
    $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec('ALTER TABLE news ADD COLUMN updated_at DATETIME');
} catch (PDOException $e) {
    // 字段已存在，忽略错误
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreoCraft 管理员仪表盘</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">管理员仪表盘</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="logout.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">logout</i></a>
        </div>
    </header>

    <div class="mdui-drawer mdui-drawer-close" id="drawer">
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple">
                <a href="dashboard.php">仪表盘</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <a href="news_publish.php">新闻发布</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <a href="player_register.php">玩家登记</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <a href="news_management.php">新闻管理</a>
            </li>
        </ul>
    </div>

    <main class="mdui-container mdui-m-t-2">
        <div class="mdui-row">
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">站点信息</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>当前系统: AreoCraft 公益服务器</p>
                        <p>数据库状态: 正常</p>
                    </div>
                </div>
            </div>
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">新闻信息</div>
                    </div>
                    <div class="mdui-card-content">
                        <?php
                        try {
                            $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            // 获取最新新闻时间
                            $stmt = $db->query('SELECT created_at FROM news ORDER BY id DESC LIMIT 1');
                            $latest_news = $stmt->fetch(PDO::FETCH_ASSOC);
                            $latest_news_time = $latest_news ? $latest_news['created_at'] : '无';
                            
                            // 获取新闻总数
                            $stmt = $db->query('SELECT COUNT(*) as count FROM news');
                            $news_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                            
                            echo '<p>最新发布时间: '. $latest_news_time .'</p>';
                            echo '<p>共计新闻数: '. $news_count .'</p>';
                        } catch (PDOException $e) {
                            echo '<div class="mdui-alert mdui-color-red">数据库错误: '. $e->getMessage() .'</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">玩家信息</div>
                    </div>
                    <div class="mdui-card-content">
                        <?php
                        try {
                            $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            // 获取玩家总数
                            $stmt = $db->query('SELECT COUNT(*) as count FROM players');
                            $player_count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                            
                            echo '<p>已注册玩家数: '. $player_count .'</p>';
                        } catch (PDOException $e) {
                            echo '<div class="mdui-alert mdui-color-red">数据库错误: '. $e->getMessage() .'</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-row mdui-m-t-2">
            <div class="mdui-col-md-12">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">管理员操作</div>
                    </div>
                    <div class="mdui-card-content">
                        <form method="post">
                            <div class="mdui-textfield">
                                <label class="mdui-textfield-label">新密码</label>
                                <input class="mdui-textfield-input" type="password" name="new_password" required>
                            </div>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">修改密码</button>
                        </form>
                        
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
                            $new_password = $_POST['new_password'];
                            try {
                                $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                                $stmt = $db->prepare('UPDATE admins SET password = :password WHERE username = :username');
                                $stmt->bindValue(':password', $hashed_password);
                                $stmt->bindValue(':username', $_SESSION['admin']);
                                $stmt->execute();
                                echo '<div class="mdui-alert mdui-color-green">密码修改成功</div>';
                            } catch (PDOException $e) {
                                echo '<div class="mdui-alert mdui-color-red">数据库错误: '. $e->getMessage() . '</div>';
                            }
                        }
                        ?>
                        <a href="admin_account_management.php" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">管理员账号管理</a>
                        <a href="logout.php" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">退出登录</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../static/js/mdui.min.js"></script>
</body>
</html>