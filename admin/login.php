<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreoCraft 管理员登录</title>
    <link rel="icon" href="../favicon.png">
    <link rel="stylesheet" href="../static/css/mdui.min.css">
    <link rel="stylesheet" href="../static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="../index.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">arrow_back</i></a>
            <a href="#" class="mdui-typo-title">管理员登录</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="#" class="mdui-btn mdui-btn-icon" onclick="toggleDarkMode()"><i class="mdui-icon material-icons">brightness_6</i></a>
        </div>
    </header>
    <div class="mdui-container mdui-valign">
        <div class="mdui-row">
            <div class="mdui-col-md-4 mdui-col-offset-md-4">
                <div class="mdui-card mdui-m-t-5">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">管理员登录</div>
                    </div>
                    <div class="mdui-card-content">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            
                            try {
                                $db = new PDO('sqlite:s:\web\dev\acwc-b1.0\areocraft.db');
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $db->prepare('SELECT * FROM admins WHERE username = :username');
                                $stmt->bindParam(':username', $username);
                                $stmt->execute();
                                $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                                if ($admin && password_verify($password, $admin['password'])) {
                                    session_start();
                                    $_SESSION['admin'] = $username;
                                    $_SESSION['permission'] = $admin['permission'];
                                    header('Location: dashboard.php');
                                    exit;
                                } else {
                                    echo '<div class="mdui-alert mdui-color-red">用户名或密码错误</div>';
                                }
                            } catch (PDOException $e) {
                                echo '<div class="mdui-alert mdui-color-red">数据库错误: ' . $e->getMessage() . '</div>';
                            }
                        }
                        ?>
                        <form method="post">
                            <div class="mdui-textfield">
                                <label class="mdui-textfield-label">用户名</label>
                                <input class="mdui-textfield-input" type="text" name="username" required>
                            </div>
                            <div class="mdui-textfield">
                                <label class="mdui-textfield-label">密码</label>
                                <input class="mdui-textfield-input" type="password" name="password" required>
                            </div>
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent mdui-m-t-2">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../static/js/mdui.min.js"></script>
    <script>
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('mdui-theme-layout-dark');
            const icon = document.querySelector('[onclick="toggleDarkMode()"] i');
            icon.textContent = body.classList.contains('mdui-theme-layout-dark') ? 'light_mode' : 'dark_mode';
        }
    </script>
</body>
</html>