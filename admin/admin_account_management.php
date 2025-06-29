<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['access_password'])) {
    $access_password = $_POST['access_password'];
    try {
        $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare('SELECT access_password FROM admin_settings LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result && password_verify($access_password, $result['access_password'])) {
            $_SESSION['account_management_access'] = true;
        } else {
            $error = '访问密码错误';
        }
    } catch (PDOException $e) {
        $error = '数据库错误: '. $e->getMessage();
    }
}

if (!isset($_SESSION['account_management_access'])) {
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员账号管理</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <div class="mdui-container mdui-valign">
        <div class="mdui-row">
            <div class="mdui-col-md-4 mdui-col-offset-md-4">
                <div class="mdui-card mdui-m-t-5">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">管理员账号管理</div>
                    </div>
                    <div class="mdui-card-content">
                        <?php if (isset($error)): ?>
                            <div class="mdui-alert mdui-color-red"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="mdui-textfield">
                                <label class="mdui-textfield-label">独立访问密码</label>
                                <input class="mdui-textfield-input" type="password" name="access_password" required>
                            </div>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent mdui-m-t-2">进入</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../static/js/mdui.min.js"></script>
</body>
</html>
<?php
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    $new_password = $_POST['new_password'];
    try {
        $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $stmt = $db->prepare('CREATE TABLE IF NOT EXISTS admin_settings (access_password TEXT)');
        $stmt->execute();
        
        $stmt = $db->prepare('SELECT COUNT(*) as count FROM admin_settings');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            $stmt = $db->prepare('UPDATE admin_settings SET access_password = :password');
        } else {
            $stmt = $db->prepare('INSERT INTO admin_settings (access_password) VALUES (:password)');
        }
        $stmt->bindValue(':password', $hashed_password);
        $stmt->execute();
        $success = '访问密码修改成功';
    } catch (PDOException $e) {
        $error = '数据库错误: '. $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员账号管理</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="dashboard.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">arrow_back</i></a>
            <a href="#" class="mdui-typo-title">管理员账号管理</a>
            <div class="mdui-toolbar-spacer"></div>
        </div>
    </header>
    <main class="mdui-container mdui-m-t-2">
        <div class="mdui-card">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">修改独立访问密码</div>
            </div>
            <div class="mdui-card-content">
                <?php if (isset($error)): ?>
                    <div class="mdui-alert mdui-color-red"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="mdui-alert mdui-color-green"><?php echo $success; ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">新独立访问密码</label>
                        <input class="mdui-textfield-input" type="password" name="new_password" required>
                    </div>
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">修改</button>
                </form>
            </div>
        </div>
    </main>
    <script src="../static/js/mdui.min.js"></script>
</body>
</html>