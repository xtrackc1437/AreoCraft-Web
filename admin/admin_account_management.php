<?php
session_start();

if (!isset($_SESSION['admin']) || !isset($_SESSION['permission']) || $_SESSION['permission'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    try {
        $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_POST['action'] === 'add') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $permission = $_POST['permission'];
            $stmt = $db->prepare('INSERT INTO admins (username, password, permission) VALUES (:username, :password, :permission)');
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':permission', $permission);
            $stmt->execute();
            $success = '管理员账号添加成功';
        }
        elseif ($_POST['action'] === 'update') {
            $id = $_POST['id'];
            if (isset($_POST['password']) && !empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt = $db->prepare('UPDATE admins SET password = :password WHERE id = :id');
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
            }
            $permission = $_POST['permission'];
            $stmt = $db->prepare('UPDATE admins SET permission = :permission WHERE id = :id');
            $stmt->bindValue(':permission', $permission);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $success = '管理员信息更新成功';
        }
        elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $stmt = $db->prepare('DELETE FROM admins WHERE id = :id');
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $success = '管理员账号删除成功';
        }
    } catch (PDOException $e) {
        $error = '数据库错误: '. $e->getMessage();
    }
}

if (!isset($_SESSION['admin'])) {
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
    <style>
        .mdui-table-responsive {
            overflow-x: auto;
        }
    </style>
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
            <a href="#" class="mdui-btn mdui-btn-icon" onclick="toggleDarkMode()"><i class="mdui-icon material-icons">brightness_6</i></a>
        </div>
    </header>
    <main class="mdui-container mdui-m-t-2">
        <?php if (isset($error)): ?>
            <div class="mdui-alert mdui-color-red"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="mdui-alert mdui-color-green"><?php echo $success; ?></div>
        <?php endif; ?>

        <div class="mdui-card">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">添加管理员</div>
            </div>
            <div class="mdui-card-content">
                <form method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">用户名</label>
                        <input class="mdui-textfield-input" type="text" name="username" required>
                    </div>
                    <div class="mdui-textfield">
                        <label class="mdui-textfield-label">密码</label>
                        <input class="mdui-textfield-input" type="password" name="password" required>
                    </div>
                    <div class="mdui-select mdui-m-t-2">
                        <select name="permission" required>
                            <option value="admin">admin</option>
                            <option value="coadmin">coadmin</option>
                        </select>
                        <label>权限</label>
                    </div>
                    <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">添加</button>
                </form>
            </div>
        </div>

        <div class="mdui-card mdui-m-t-2">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">管理员列表</div>
            </div>
            <div class="mdui-card-content">
                <div class="mdui-table-responsive">
                    <table class="mdui-table mdui-table-hoverable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户名</th>
                                <th>权限</th>
                                <th>最后登录时间</th>
                                <th>最后登录IP</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $db = new PDO('sqlite:s:/web/dev/acwc-b1.0/areocraft.db');
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $stmt = $db->prepare('SELECT * FROM admins');
                                $stmt->execute();
                                $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($admins as $admin) {
                                    if ($admin['username'] === 'admin') continue;
                            ?>
                            <tr>
                                <td><?php echo $admin['id']; ?></td>
                                <td><?php echo $admin['username']; ?></td>
                                <td><?php echo $admin['permission']; ?></td>
                                <td><?php echo $admin['last_login_time'] ?? '-'; ?></td>
                                <td><?php echo $admin['last_login_ip'] ?? '-'; ?></td>
                                <td>
                                    <button class="mdui-btn mdui-btn-icon mdui-ripple" mdui-dialog="{target: '#edit-dialog-<?php echo $admin['id']; ?>'}">
                                        <i class="mdui-icon material-icons">edit</i>
                                    </button>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                        <button type="submit" class="mdui-btn mdui-btn-icon mdui-ripple" onclick="return confirm('确定要删除该管理员吗？');">
                                            <i class="mdui-icon material-icons">delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="mdui-dialog" id="edit-dialog-<?php echo $admin['id']; ?>">
                                <div class="mdui-dialog-title">编辑管理员</div>
                                <div class="mdui-dialog-content">
                                    <form method="post">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="id" value="<?php echo $admin['id']; ?>">
                                        <div class="mdui-textfield">
                                            <label class="mdui-textfield-label">新密码 (留空则不修改)</label>
                                            <input class="mdui-textfield-input" type="password" name="password">
                                        </div>
                                        <div class="mdui-select mdui-m-t-2">
                                            <select name="permission" required>
                                                <option value="admin" <?php echo $admin['permission'] === 'admin' ? 'selected' : ''; ?>>admin</option>
                                                <option value="coadmin" <?php echo $admin['permission'] === 'coadmin' ? 'selected' : ''; ?>>coadmin</option>
                                            </select>
                                            <label>权限</label>
                                        </div>
                                </div>
                                <div class="mdui-dialog-actions">
                                    <button type="button" class="mdui-btn mdui-text-color-theme-accent" mdui-dialog-close>取消</button>
                                    <button type="submit" class="mdui-btn mdui-text-color-theme-accent">保存</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo '<tr><td colspan="6">数据库错误: '. $e->getMessage(). '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="../static/js/mdui.min.js"></script>
</body>
</html>