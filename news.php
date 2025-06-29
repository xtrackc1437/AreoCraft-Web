<?php
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreoCraft 新闻</title>
    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" href="static/css/mdui.min.css">
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
            <a href="index.php" class="mdui-typo-title">AreoCraft</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="news.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">article</i></a>
            <a href="admin/login.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">admin_panel_settings</i></a>
        </div>
    </header>

    <main class="mdui-container mdui-m-t-2">
        <h2 class="mdui-text-center">最新消息</h2>
        <?php
        try {
            $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $db->query('SELECT *, updated_at FROM news ORDER BY id DESC');
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($news as $item) {
                echo '<div class="mdui-card mdui-m-b-2">';
                echo '<div class="mdui-card-primary">';
                echo '<div class="mdui-card-primary-title">' . $item['title'] . '</div>';
                echo '<div class="mdui-card-primary-subtitle">发布时间: ' . $item['created_at'] . '</div>';
                echo '</div>';
                echo '<div class="mdui-card-content">' . $item['content'] . '</div>';
                if ($item['updated_at']) {
                    echo '<div class="mdui-card-content"><i class="mdui-text-color-grey-500">已修改，最后修改时间: ' . $item['updated_at'] . '</i></div>';
                }
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '<div class="mdui-alert mdui-color-red">数据库错误: ' . $e->getMessage() . '</div>';
        }
        ?>
    </main>

    <script src="static/js/mdui.min.js"></script>
</body>
</html>