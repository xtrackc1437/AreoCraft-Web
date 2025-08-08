import { motion, useScroll, AnimatePresence } from 'framer-motion';
import React, { useState } from 'react';
import appConfig from '../config/appConfig';

const Navbar: React.FC = () => {
  const { scrollY } = useScroll();
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const isScrolled = scrollY.get() > 50;

  return (
    <motion.nav
      className="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
      style={{
        backgroundColor: isScrolled ? '#1a1a1a/90' : 'transparent',
        color: isScrolled ? 'white' : 'black',
        backdropFilter: isScrolled ? 'blur(8px)' : 'none',
        padding: isScrolled ? '0.75rem 5%' : '1rem 5%',
      }}
    >
      <div className="container mx-auto flex justify-between items-center">
        <motion.div
          className={`font-bold text-xl ${isScrolled ? 'text-white' : 'text-black'}`}
          initial={{ opacity: 0, y: -10 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
        >
          MC Server
        </motion.div>
        
        {/* 桌面端菜单 */}
        <div className="hidden md:flex space-x-8 items-center">
          {appConfig.navbarConfig.links.map((item, index) => (
            <motion.a
              key={item.label}
              href={item.href}
              className={`transition-colors ${isScrolled ? 'text-white/80 hover:text-white' : 'text-black/80 hover:text-black'}`}
              initial={{ opacity: 0, x: 20 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.3, delay: 0.1 * index }}
            >
              {item.label}
            </motion.a>
          ))}
          <motion.button
            className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full transition-all transform hover:scale-105"
            initial={{ opacity: 0, x: 20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.3, delay: 0.5 }}
          >
            {appConfig.navbarConfig.ctaButton}
          </motion.button>
        </div>

        {/* 移动端菜单按钮 */}
        <motion.button
          className={`md:hidden text-2xl ${isScrolled ? 'text-white' : 'text-black'}`}
          initial={{ opacity: 0, x: 20 }}
          animate={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.3, delay: 0.5 }}
          onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
        >
          {mobileMenuOpen ? '✕' : '☰'}
        </motion.button>
      </div>

      {/* 移动端菜单 */}
      <AnimatePresence>
        {mobileMenuOpen && (
          <motion.div
            className="md:hidden absolute top-full left-0 right-0 bg-white dark:bg-gray-900 shadow-lg"
            initial={{ opacity: 0, y: -10 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -10 }}
            transition={{ duration: 0.3 }}
          >
            <div className="container mx-auto py-4 px-6 flex flex-col space-y-4">
              {appConfig.navbarConfig.links.map((item) => (
                <a
                  key={item.label}
                  href={item.href}
                  className="py-2 border-b border-gray-100 dark:border-gray-800"
                  onClick={() => setMobileMenuOpen(false)}
                >
                  {item.label}
                </a>
              ))}
              <button className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-full transition-all">
                立即加入
              </button>
            </div>
          </motion.div>
        )}
      </AnimatePresence>
    </motion.nav>
  );
};

export default Navbar;