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
    <title>新闻管理</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true, swipe: true, closeOnClickOverlay: true}"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">新闻管理</a>
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
                <div class="mdui-card-primary-title">新闻列表</div>
            </div>
            <div class="mdui-card-content">
                <?php
                try {
                    $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $db->query('SELECT id, title, created_at, updated_at FROM news ORDER BY id DESC');
                    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($news) {
                        echo '<table class="mdui-table mdui-table-hoverable">';
                        echo '<thead><tr><th>标题</th><th>发布时间</th><th>修改时间</th><th>操作</th></tr></thead>';
                        echo '<tbody>';
                        foreach ($news as $item) {
                            echo '<tr>';
                            echo '<td>'. $item['title'] . '</td>';
                            echo '<td>'. $item['created_at'] . '</td>';
                            echo '<td>'. ($item['updated_at'] ? $item['updated_at'] : '无') . '</td>';
                            echo '<td><a href="edit_news.php?id='. $item['id'] .'" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent mdui-btn-dense">修改</a></td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<div class="mdui-alert mdui-color-grey">暂无新闻记录</div>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="mdui-alert mdui-color-red">数据库错误: '. $e->getMessage() .'</div>';
                }
                ?>
            </div>
        </div>
    </main>

    <script src="../static/js/mdui.min.js"></script>
</body>
</html>