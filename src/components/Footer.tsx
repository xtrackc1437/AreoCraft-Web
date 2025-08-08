import { motion } from 'framer-motion';
import React from 'react';

const Footer: React.FC = () => {
  // 服务器状态数据
  const serverStatus = {
    online: true,
    players: 42,
    maxPlayers: 100,
    uptime: '128天',
  };

  // 链接数据
  const footerLinks = [
    {
      title: '快速链接',
      links: ['首页', '关于我们', '游戏规则', '更新日志', '联系我们'],
    },
    {
      title: '资源中心',
      links: ['服务器文档', '插件下载', '地图存档', '材质包', '教程视频'],
    },
    {
      title: '社区平台',
      links: ['Discord', 'QQ群', 'B站', 'YouTube', '微博'],
    },
    {
      title: '友情链接',
      links: ['Minecraft官网', 'MCBBS', 'Planet Minecraft', 'Mineplex', 'Hypixel'],
    },
  ];

  return (
    <footer className="bg-gray-900 text-white pt-16 pb-8">
      <div className="container mx-auto px-6">
        {/* 服务器状态 */}
        <div className="mb-12 bg-gray-800 rounded-xl p-6 shadow-lg">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <div className="mb-6 md:mb-0">
              <h3 className="text-xl font-bold mb-2">服务器状态</h3>
              <p className="text-gray-400">实时监控服务器运行情况</p>
            </div>
            <div className="flex items-center gap-8">
              <div className="flex items-center">
                <span className={`w-3 h-3 rounded-full mr-2 ${serverStatus.online ? 'bg-green-500' : 'bg-red-500'}`}></span>
                <span>{serverStatus.online ? '在线' : '离线'}</span>
              </div>
              <div>
                <span className="text-2xl font-bold">{serverStatus.players}</span>
                <span className="text-gray-400">/{serverStatus.maxPlayers} 玩家</span>
              </div>
              <div className="text-gray-400">已运行: {serverStatus.uptime}</div>
              <motion.button
                className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full transition-all"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
              >
                查看详情
              </motion.button>
            </div>
          </div>
          {/* 服务器状态条 */}
          <div className="mt-4 h-2 bg-gray-700 rounded-full overflow-hidden">
            <div
              className="h-full bg-green-500"
              style={{ width: `${(serverStatus.players / serverStatus.maxPlayers) * 100}%` }}
            ></div>
          </div>
        </div>

        {/* 链接区域 */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
          {footerLinks.map((column, index) => (
            <div key={column.title}>
              <h4 className="text-lg font-bold mb-4 text-blue-400">{column.title}</h4>
              <ul className="space-y-2">
                {column.links.map((link, linkIndex) => (
                  <li key={link}>
                    <motion.a
                      href={`#${link.toLowerCase().replace(/\s+/g, '-')}`}
                      className="text-gray-400 hover:text-white transition-colors"
                      initial={{ opacity: 0, y: 10 }}
                      animate={{ opacity: 1, y: 0 }}
                      transition={{ duration: 0.3, delay: 0.05 * (index * 5 + linkIndex) }}
                    >
                      {link}
                    </motion.a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>

        {/* 总结文字 */}
        <div className="text-center max-w-3xl mx-auto mb-12 p-6 border-t border-b border-gray-800">
          <motion.p
            className="text-lg text-gray-300"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 1 }}
          >
            【幻想大陆】Minecraft服务器自2023年开服以来，始终致力于为玩家提供最优质的游戏体验。我们相信，每一个方块都能创造无限可能，每一次冒险都能留下美好回忆。
          </motion.p>
        </div>

        {/* 版权信息 */}
        <div className="text-center text-gray-500 text-sm">
          <p>© 2023-2024 幻想大陆 Minecraft服务器 版权所有</p>
          <p className="mt-1">服务器IP: mc.fantasyland.com | 版本: 1.20.1</p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;