import { motion } from 'framer-motion';
import React from 'react';
import appConfig from '../config/appConfig';

const Hero: React.FC = () => {
  // 文字动画序列
  const textAnimations = [
    { initial: { x: -50, opacity: 0 }, animate: { x: 0, opacity: 1 }, transition: { duration: 0.5 } },
    { initial: { x: -50, opacity: 0 }, animate: { x: 0, opacity: 1 }, transition: { duration: 0.5, delay: 0.2 } },
    { initial: { x: -50, opacity: 0 }, animate: { x: 0, opacity: 1 }, transition: { duration: 0.5, delay: 0.4 } },
  ];

  return (
    <section className="relative h-screen flex items-center justify-start overflow-hidden">
      {/* 背景图片 */}
      <div className="absolute inset-0 z-0">
        <div className="absolute inset-0 bg-black/40 backdrop-blur-sm z-10"></div>
        <img
          src="https://picsum.photos/id/1035/1920/1080"
          alt="Minecraft Server Background"
          className="w-full h-full object-cover object-center"
        />
      </div>

      {/* 文字内容 */}
      <div className="container mx-auto px-6 z-10 mt-16">
        <div className="max-w-2xl">
          <motion.div
            className="text-blue-400 font-medium mb-2"
            {...textAnimations[0]}
          >
            {appConfig.heroConfig.subtitle}
          </motion.div>
          <motion.h1
            className="text-[clamp(2.5rem,8vw,5rem)] font-bold text-white leading-tight mb-4"
            {...textAnimations[1]}
          >
            {appConfig.heroConfig.title}
          </motion.h1>
          <motion.div
            className="text-gray-300 text-lg md:text-xl"
            {...textAnimations[2]}
          >
            {appConfig.heroConfig.versionText}
          </motion.div>
        </div>
      </div>
    </section>
  );
};

export default Hero;