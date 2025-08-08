import { motion, AnimatePresence } from 'framer-motion';
import React, { useState, useEffect } from 'react';
import appConfig from '../config/appConfig';

const Gallery: React.FC = () => {
  const [currentImage, setCurrentImage] = useState(0);
  const [isVisible, setIsVisible] = useState(false);

  // 从配置文件获取图片数据
  const images = appConfig.galleryConfig.images;

  // 监听元素可见性以触发动画
  useEffect(() => {
    const observer = new IntersectionObserver<HTMLDivElement>(
      ([entry]) => entry && setIsVisible(entry.isIntersecting),
      { threshold: 0.1 }
    );

    const element = document.getElementById('gallery-section');
    if (element) observer.observe(element);

    return () => element && observer.unobserve(element);
  }, []);

  // 自动切换图片
  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentImage((prev) => (prev + 1) % images.length);
    }, 5000);
    return () => clearInterval(interval);
  }, [images.length]);

  return (
    <section id="gallery-section" className="py-20 bg-gray-50 dark:bg-gray-800">
      <div className="container mx-auto px-6">
        <div className="flex flex-col md:flex-row items-center justify-between gap-12 w-full">
          {/* 左侧宣传文案 */}
          <motion.div
            className="w-full md:w-1/2 p-4"
            initial={{ opacity: 0, x: -50 }}
            animate={isVisible ? { opacity: 1, x: 0 } : { opacity: 0, x: -50 }}
            transition={{ duration: 0.8 }}
          >
            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-6">
              {appConfig.galleryConfig.title}
            </h2>
            <p className="text-lg text-gray-700 dark:text-gray-300 mb-8 leading-relaxed">
              在【幻想大陆】中，我们打造了独一无二的游戏体验。从宏伟的城堡到神秘的地下城，从宁静的乡村到繁华的都市，每一处细节都凝聚着我们的心血。
            </p>
            <ul className="space-y-4 mb-8">
              {['自定义地形生成系统', '特色副本与BOSS挑战', '玩家创作展示平台', '定期举办的创意活动'].map((feature, index) => (
                <motion.li
                  key={feature}
                  className="flex items-start"
                  initial={{ opacity: 0, x: -30 }}
                  animate={isVisible ? { opacity: 1, x: 0 } : { opacity: 0, x: -30 }}
                  transition={{ duration: 0.5, delay: 0.1 * (index + 1) }}
                >
                  <span className="text-blue-600 mr-3 mt-1">●</span>
                  <span className="text-gray-700 dark:text-gray-300">{feature}</span>
                </motion.li>
              ))}
            </ul>
            <motion.button
              className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full transition-all transform hover:scale-105"
              initial={{ opacity: 0, y: 20 }}
              animate={isVisible ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
              transition={{ duration: 0.5, delay: 0.5 }}
            >
              查看更多截图
            </motion.button>
          </motion.div>

          {/* 右侧图片展示 */}
          <div className="w-full md:w-1/2 relative p-4">
            <div className="aspect-[4/3] rounded-xl overflow-hidden shadow-2xl relative">
              <AnimatePresence mode="wait">
                <motion.img
                  key={currentImage}
                  src={images[currentImage].url}
                  alt={images[currentImage].alt}
                  className="w-full h-full object-cover"
                  initial={{ opacity: 0, scale: 1.1 }}
                  animate={{ opacity: 1, scale: 1 }}
                  exit={{ opacity: 0, scale: 0.9 }}
                  transition={{ duration: 1 }}
                />
              </AnimatePresence>
              {/* 图片导航点 */}
              <div className="absolute bottom-4 left-0 right-0 flex justify-center gap-2">
                {images.map((_, index) => (
                  <button
                    key={index}
                    className={`w-3 h-3 rounded-full transition-all ${index === currentImage ? 'bg-white w-8' : 'bg-white/50'}`}
                    onClick={() => setCurrentImage(index)}
                  />
                ))}
              </div>
            </div>
            {/* 装饰元素 */}
            <div className="absolute -top-6 -left-6 w-32 h-32 border-4 border-blue-500 rounded-lg -z-10 hidden md:block"></div>
            <div className="absolute -bottom-6 -right-6 w-40 h-40 border-4 border-purple-500 rounded-lg -z-10 hidden md:block"></div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Gallery;