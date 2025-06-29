<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: player_search.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $registered_at = $_POST['registered_at'];
    $whitelisted = isset($_POST['whitelisted']) ? 1 : 0;
    $updated_at = date('Y-m-d H:i:s');
    $last_modified_ip = $_SERVER['REMOTE_ADDR'];

    try {
        $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare('UPDATE players SET username = :username, registered_at = :registered_at, whitelisted = :whitelisted, updated_at = :updated_at, last_modified_ip = :last_modified_ip WHERE id = :id');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':registered_at', $registered_at);
        $stmt->bindParam(':whitelisted', $whitelisted);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->bindParam(':last_modified_ip', $last_modified_ip);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('Location: player_search.php');
        exit;
    } catch (PDOException $e) {
        $error = '数据库错误: ' . $e->getMessage();
    }
}

try {
    $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare('SELECT * FROM players WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $player = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$player) {
        header('Location: player_search.php');
        exit;
    }
} catch (PDOException $e) {
    $error = '数据库错误: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑玩家信息</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true, swipe: true, closeOnClickOverlay: true}"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">编辑玩家信息</a>
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
                <div class="mdui-card-primary-title">编辑玩家信息</div>
            </div>
            <div class="mdui-card-content">
                ". "<?php if (isset($error)): ?>
                <div class="mdui-alert mdui-color-red"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">用户名</label>
                        <input class="mdui-textfield-input" type="text" name="username" value="<?php echo htmlspecialchars($player['username']); ?>">
                    </div>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">登记时间</label>
                        <input class="mdui-textfield-input" type="text" name="registered_at" value="<?php echo htmlspecialchars($player['registered_at']); ?>">
                    </div>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">白名单状态</label>
                        <input type="checkbox" name="whitelisted" ". "<?php echo $player['whitelisted'] ? 'checked' : ''; ?>">
                    </div>
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">保存</button>
                </form>
            </div>
        </div>
    </main>

    <script src="../static/js/mdui.min.js"></script>
</body>
</html>