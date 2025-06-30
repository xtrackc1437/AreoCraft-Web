<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AreoCraft 公益服务器</title>
    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" href="static/css/mdui.min.css">
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
    <header class="mdui-appbar mdui-appbar-fixed">
        <div class="mdui-toolbar mdui-color-theme">
            <a href="#" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer', overlay: true, swipe: true, closeOnClickOverlay: true}"><i class="mdui-icon material-icons">menu</i></a>
            <a href="#" class="mdui-typo-title">AreoCraft</a>
            <div class="mdui-toolbar-spacer"></div>
            <a href="news.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">article</i></a>
            <a href="admin/login.php" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">admin_panel_settings</i></a>
            <a href="#" class="mdui-btn mdui-btn-icon" onclick="toggleDarkMode()"><i class="mdui-icon material-icons">brightness_6</i></a>
        </div>
    </header>
    <div class="mdui-drawer" id="drawer">
        <ul class="mdui-list">
            <li class="mdui-list-item mdui-ripple">
                <a href="index.php">首页</a>
            </li>
            <li class="mdui-list-item mdui-ripple">
                <a href="news.php">新闻</a>
            </li>
        </ul>
    </div>

    <main class="mdui-container">
        <div class="mdui-row">
            <div class="mdui-col-md-12">
                <div class="mdui-card mdui-m-t-2">
                    <div class="mdui-card-media">
                        <img src="static/images/banner.jpg" alt="服务器宣传图">
                        <div class="mdui-card-media-covered">
                            <div class="mdui-card-primary">
                                <div class="mdui-card-primary-title">欢迎来到 AreoCraft 公益服务器</div>
                                <div class="mdui-card-primary-subtitle">畅享精彩游戏体验</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-row mdui-m-t-2">
            <div class="mdui-col-md-12">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">服务器宣传</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>宣传文案区</p>
                        <img src="static/images/promo1.jpg" alt="宣传图1" class="mdui-img-fluid">
                        <img src="static/images/promo2.jpg" alt="宣传图2" class="mdui-img-fluid mdui-m-t-2">
                    </div>
                </div>
            </div>
        </div>

        <div class="mdui-row mdui-m-t-2">
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">游戏特色</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>独特的游戏模式</p>
                        <p>活跃的社区氛围</p>
                        <p>定期的活动</p>
                    </div>
                </div>
            </div>
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">服务器信息</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>IP: 150.138.77.119:59918</p>
                        <p>版本: MinecraftJE 1.21.6 (追逐天空)</p>
                        <p>当前状态：<b><span style="color:green;">正常运行</span></b></p>
                    </div>
                </div>
            </div>
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">加入我们</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>点击下方按钮加入 官方QQ群</p>
                        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">加入群聊</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="static/js/mdui.min.js"></script>
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