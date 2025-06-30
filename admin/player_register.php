<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreoCraft 玩家登记</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true}"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">玩家登记</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="logout.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">logout</i></a>
        </div>
    </header>
    
    <div class="mdui-drawer" id="drawer">
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
                <a href="player_search.php">玩家查询</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <a href="news_management.php">新闻管理</a>
            </li>
        </ul>
    </div>

    <main class="mdui-container mdui-m-t-2">
        <div class="mdui-card">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">玩家登记</div>
            </div>
            <div class="mdui-card-content">
                <form method="post" action="register_player.php">
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">玩家用户名</label>
                        <input class="mdui-textfield-input" type="text" name="username" required>
                    </div>
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">登记</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../static/js/mdui.min.js"></script>
</body>
</html>