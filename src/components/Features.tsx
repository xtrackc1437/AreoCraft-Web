import { motion } from 'framer-motion';
import React, { useState, useEffect } from 'react';

const Features: React.FC = () => {
  const [visibleSections, setVisibleSections] = useState<Record<number, boolean>>({});

  // 监听元素可见性以触发动画
  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setVisibleSections((prev) => ({ ...prev, [parseInt(entry.target.id)]: true }));
          }
        });
      },
      { threshold: 0.1 }
    );

    document.querySelectorAll('.feature-card').forEach((el) => observer.observe(el));
    return () => document.querySelectorAll('.feature-card').forEach((el) => observer.unobserve(el));
  }, []);

  // 特色功能数据
  const features = [
    {
      title: '稳定性能',
      description: '采用高性能服务器硬件，24/7全天候运行，确保流畅游戏体验，最低延迟保障。',
      icon: '⚡',
    },
    {
      title: '特色玩法',
      description: '自定义游戏模式、专属任务系统和独特副本设计，带来与众不同的游戏体验。',
      icon: '🎮',
    },
    {
      title: '活跃社区',
      description: '友好的玩家社区，定期举办线上活动，建立和谐游戏环境，新手也能快速融入。',
      icon: '👥',
    },
    {
      title: '安全保障',
      description: '严格的反作弊系统和账号保护机制，确保公平游戏环境，让每位玩家安心游戏。',
      icon: '🛡️',
    },
    {
      title: '定期更新',
      description: '开发团队持续更新内容，添加新功能、地图和活动，保持游戏新鲜感。',
      icon: '🔄',
    },
    {
      title: '专属福利',
      description: '为活跃玩家提供专属奖励，支持服务器可获得独特称号和游戏内物品。',
      icon: '🎁',
    },
  ];

  return (
    <section id="特色" className="py-20 bg-white dark:bg-gray-900">
      <div className="container mx-auto px-6">
        <motion.div
          className="text-center mb-16"
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            为什么选择我们的服务器
          </h2>
          <p className="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            我们提供独特的游戏体验和完善的服务支持，让您在方块世界中创造无限可能
          </p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {features.map((feature, index) => (
            <motion.div
  key={feature.title}
  id={index.toString()}
  className="feature-card bg-gray-50 dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow"
  initial={{ opacity: 0, y: 50 }}
  animate={visibleSections[index] ? { opacity: 1, y: 0 } : { opacity: 0, y: 50 }}
  transition={{ duration: 0.5, delay: 0.1 * index }}
>
              <div className="text-4xl mb-4">{feature.icon}</div>
              <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">
                {feature.title}
              </h3>
              <p className="text-gray-600 dark:text-gray-400">{feature.description}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Features;