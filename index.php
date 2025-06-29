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
                        <p>这里可以放置更多服务器宣传文案</p>
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
                        <p>IP: areocraft.example.com</p>
                        <p>版本: 1.19.4</p>
                    </div>
                </div>
            </div>
            <div class="mdui-col-md-4">
                <div class="mdui-card">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">加入我们</div>
                    </div>
                    <div class="mdui-card-content">
                        <p>点击下方按钮加入 Discord 社区</p>
                        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">加入社区</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="static/js/mdui.min.js"></script>
</body>
</html>