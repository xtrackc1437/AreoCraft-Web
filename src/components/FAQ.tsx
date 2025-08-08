import { motion, useAnimate } from 'framer-motion';
import React, { useState, useEffect, useRef } from 'react';
import appConfig from '../config/appConfig';

interface FAQItem {
  question: string;
  answer: string;
}

const FAQ: React.FC = () => {
  const [openIndex, setOpenIndex] = useState<number | null>(null);
  const [visible, setVisible] = useState(false);
  const [scope, animate] = useAnimate();
  const faqRef = useRef<HTMLDivElement>(null);

  // 从配置文件获取FAQ数据
  const faqItems: FAQItem[] = appConfig.faqConfig.items;

  // 监听元素可见性以触发动画
  useEffect(() => {
    const observer = new IntersectionObserver<HTMLDivElement>(
      ([entry]) => entry && setVisible(entry.isIntersecting),
      { threshold: 0.1 }
    );

    if (faqRef.current) observer.observe(faqRef.current);
    return () => faqRef.current && observer.unobserve(faqRef.current);
  }, []);

  // 处理FAQ项点击
  const toggleFaq = (index: number) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  // FAQ项动画
  useEffect(() => {
    if (visible) {
      animate(
        scope.current?.querySelectorAll('li'),
        { opacity: 1, y: 0 },
        { stagger: 0.1, duration: 0.5, ease: 'easeOut' }
      );
    }
  }, [visible, animate]);

  return (
    <section ref={faqRef} className="py-20 bg-gray-100 dark:bg-gray-900">
      <div className="container mx-auto px-6">
        <motion.div
          className="text-center mb-16"
          initial={{ opacity: 0, y: 20 }}
          animate={visible ? { opacity: 1, y: 0 } : { opacity: 0, y: 20 }}
          transition={{ duration: 0.6 }}
        >
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {appConfig.faqConfig.title}
          </h2>
          <p className="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            {appConfig.faqConfig.subtitle}
          </p>
        </motion.div>

        <div ref={scope} className="max-w-3xl mx-auto">
          <ul className="space-y-4">
            {faqItems.map((item, index) => (
              <li
                key={index}
                className="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden"
                style={{ opacity: 0, transform: 'translateY(20px)' }}
              >
                <button
                  className="w-full px-4 sm:px-6 py-4 sm:py-6 text-left flex justify-between items-center focus:outline-none"
                  onClick={() => toggleFaq(index)}
                >
                  <span className="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">
                    {item.question}
                  </span>
                  <motion.span
                    animate={{ rotate: openIndex === index ? 180 : 0 }}
                    transition={{ type: 'spring', stiffness: 300, damping: 30 }}
                  >
                    ▼
                  </motion.span>
                </button>
                <motion.div
                  initial={{ height: 0, opacity: 0 }}
                  animate={{ height: openIndex === index ? 'auto' : 0, opacity: openIndex === index ? 1 : 0 }}
                  transition={{ duration: 0.3, ease: 'easeInOut' }}
                  className="px-4 sm:px-6 pb-4 overflow-hidden"
                >
                  <p className="text-gray-600 dark:text-gray-400">{item.answer}</p>
                </motion.div>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </section>
  );
};

export default FAQ;