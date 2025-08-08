import { motion } from 'framer-motion';
import React, { useState, useEffect } from 'react';
import appConfig from '../config/appConfig';

const JoinSection: React.FC = () => {
  const [isVisible, setIsVisible] = useState(false);

  // 监听元素可见性以触发动画
  useEffect(() => {
    const observer = new IntersectionObserver<HTMLDivElement>(
      ([entry]) => entry && setIsVisible(entry.isIntersecting),
      { threshold: 0.1 }
    );

    const element = document.getElementById('join-section');
    if (element) observer.observe(element);
    return () => element && observer.unobserve(element);
  }, []);

  // 从配置文件获取链接数据
  const links = appConfig.joinSectionConfig.links;

  return (
    <section id="join-section" className="py-20 bg-gradient-to-br from-blue-600 to-purple-700 text-white">
      <div className="container mx-auto px-6">
        <motion.div
          className="text-center mb-16"
          initial={{ opacity: 0, y: 20 }}
          animate={isVisible ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-3xl md:text-4xl font-bold mb-4">{appConfig.joinSectionConfig.title}</h2>
          <p className="text-xl text-blue-100 max-w-2xl mx-auto">
            {appConfig.joinSectionConfig.subtitle}
          </p>
        </motion.div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {links.map((link, index) => (
            <motion.a
              key={link.title}
              href={link.url}
              className={`group p-6 sm:p-8 rounded-xl transition-all duration-300 min-h-[280px] ${link.primary
                ? 'bg-white text-blue-600 hover:shadow-lg hover:-translate-y-2'
                : 'bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 hover:-translate-y-2'}
              `}
              initial={{ opacity: 0, y: 50 }}
              animate={isVisible ? { opacity: 1, y: 0 } : { opacity: 0, y: 50 }}
              transition={{ duration: 0.5, delay: 0.1 * index }}
            >
              <div className="text-4xl mb-4 group-hover:scale-110 transition-transform">{link.icon}</div>
              <h3 className="text-lg sm:text-xl font-bold mb-2">{link.title}</h3>
              <p className={`${link.primary ? 'text-blue-700' : 'text-blue-100'}`}>{link.description}</p>
              <div className="mt-6 inline-block pt-2 group-hover:translate-x-2 transition-transform">
                <span>了解更多</span>
                <span className="ml-2">→</span>
              </div>
            </motion.a>
          ))}
        </div>
      </div>
    </section>
  );
};

export default JoinSection;