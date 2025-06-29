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
    <title>AreoCraft 玩家查询</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true, swipe: true, closeOnClickOverlay: true}"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">玩家查询</a>
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
        </ul>
    </div>

    <main class="mdui-container mdui-m-t-2">
        <div class="mdui-card">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">玩家查询</div>
            </div>
            <div class="mdui-card-content">
                <form method="post">
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">搜索玩家</label>
                        <input class="mdui-textfield-input" type="text" name="search">
                    </div>
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">查询</button>
                </form>
                <?php
                try {
                    $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $search = isset($_POST['search']) ? '%' . $_POST['search'] . '%' : '%';
                    $stmt = $db->prepare('SELECT * FROM players WHERE username LIKE :search');
                    $stmt->bindParam(':search', $search);
                    $stmt->execute();
                    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if ($players) {
                        echo '<table class="mdui-table mdui-table-hoverable">';
                        echo '<thead><tr><th>ID</th><th>用户名</th><th>登记时间</th><th>白名单状态</th><th>操作</th></tr></thead>';
                                echo '<tbody>';
                                foreach ($players as $player) {
                                    echo '<tr>';
                                    echo '<td>' . $player['id'] . '</td>';
                                    echo '<td>' . $player['username'] . '</td>';
                                    echo '<td>' . $player['registered_at'] . '</td>';
                                    echo '<td>' . ($player['whitelisted'] ? '是' : '否') . '</td>';
                                    echo '<td><a href="edit_player.php?id='. $player['id'] .'" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">修改</a></td>';
                                    echo '</tr>';
                                }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<div class="mdui-alert mdui-color-grey">未找到玩家记录</div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="mdui-alert mdui-color-red">数据库错误: ' . $e->getMessage() . '</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <script src="../static/js/mdui.min.js"></script>
</body>
</html>