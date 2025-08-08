// import React from 'react';

// 配置类型定义
interface NavbarLink {
  label: string;
  href: string;
}

interface NavbarConfig {
  links: NavbarLink[];
  ctaButton: string;
}

interface HeroConfig {
  subtitle: string;
  title: string;
  versionText: string;
  backgroundImage: string;
}

interface GalleryImage {
  url: string;
  alt: string;
}

interface GalleryConfig {
  title: string;
  images: GalleryImage[];
}

interface FAQItem {
  question: string;
  answer: string;
}

interface FAQConfig {
  title: string;
  subtitle: string;
  items: FAQItem[];
}

interface JoinLink {
  title: string;
  description: string;
  icon: string;
  url: string;
  primary: boolean;
}

interface JoinSectionConfig {
  title: string;
  subtitle: string;
  links: JoinLink[];
}

interface FooterLink {
  label: string;
  href: string;
}

interface FooterConfig {
  copyright: string;
  links: FooterLink[];
}

interface SiteInfo {
  name: string;
  version: string;
  description: string;
}

// 网站基本信息
export const siteInfo = {
  name: 'MC Server',
  version: '1.21.8',
  description: '追逐天空！'
};

// 导航栏配置
export const navbarConfig = {
  links: [
    { label: '首页', href: '#首页' },
    { label: '特色', href: '#特色' },
    { label: '画廊', href: '#画廊' },
    { label: 'FAQ', href: '#faq' },
    { label: '加入我们', href: '#加入我们' }
  ],
  ctaButton: '立即加入'
};

// Hero区域配置
export const heroConfig = {
  subtitle: 'Minecraft 服务器',
  title: 'AreoCraft',
  versionText: `游戏版本: ${siteInfo.version} - ${siteInfo.description}`,
  backgroundImage: 'https://picsum.photos/id/1035/1920/1080'
};

// 画廊区域配置
export const galleryConfig = {
  title: '探索无限可能的像素世界',
  images: [
    { url: 'https://picsum.photos/id/1039/800/600', alt: '服务器主城全景' },
    { url: 'https://picsum.photos/id/1040/800/600', alt: '玩家建造的城堡' },
    { url: 'https://picsum.photos/id/1041/800/600', alt: '团队副本挑战' },
    { url: 'https://picsum.photos/id/1042/800/600', alt: '特色地形景观' }
  ]
};

// FAQ配置
export const faqConfig = {
  title: '常见问题解答',
  subtitle: '我们收集了玩家最常提出的问题，如果您有其他疑问，欢迎联系我们',
  items: [
    {
      question: '如何加入服务器？',
      answer: '加入服务器非常简单！首先确保你的Minecraft版本与服务器版本一致（1.20.1），然后在多人游戏中添加服务器地址：mc.fantasyland.com，点击连接即可。首次加入将获得新手礼包！'
    },
    {
      question: '服务器有什么特殊玩法？',
      answer: '我们提供多种特色玩法，包括自定义任务系统、副本挑战、玩家经济系统、领地保护、创意建筑比赛等。每周还会举办不同主题的活动，获胜者可获得稀有物品奖励。'
    },
    {
      question: '需要付费才能玩吗？',
      answer: '服务器完全免费开放！我们提供自愿赞助机制，赞助者可获得一些 cosmetic 外观奖励，但不会影响游戏平衡性。所有核心玩法对所有玩家平等开放。'
    },
    {
      question: '遇到问题如何寻求帮助？',
      answer: '你可以通过多种方式获取帮助：加入我们的Discord服务器（点击页面底部链接），在游戏内使用/help命令，或访问我们的Wiki文档。管理员和资深玩家会尽快回复你的问题。'
    },
    {
      question: '服务器有什么规则需要遵守？',
      answer: '我们的核心规则包括：禁止作弊/使用外挂、禁止欺凌或骚扰其他玩家、禁止利用漏洞、禁止恶意破坏他人建筑。完整规则可在维基页面查看。违反规则可能导致警告、禁言或永久封禁。'
    }
  ]
};

// 加入区域配置
export const joinSectionConfig = {
  title: '开始你的像素冒险',
  subtitle: '加入我们的社区，与来自世界各地的玩家一起创造、探索和冒险',
  links: [
    {
      title: '加入服务器',
      description: '立即连接到我们的Minecraft服务器',
      icon: '▶️',
      url: '#join-server',
      primary: true
    },
    {
      title: '赞助支持',
      description: '支持服务器运营，获得专属奖励',
      icon: '❤️',
      url: '#sponsor',
      primary: false
    },
    {
      title: '文档中心',
      description: '查看详细游戏指南和教程',
      icon: '📚',
      url: '#docs',
      primary: false
    },
    {
      title: '加入社群',
      description: '与其他玩家交流，获取最新资讯',
      icon: '👥',
      url: '#community',
      primary: false
    }
  ]
};

// 页脚配置
export const footerConfig = {
  copyright: '© 2025 AreoCraftMC. 保留所有权利.',
  links: [
    { label: '隐私政策', href: '#' },
    { label: '服务条款', href: '#' },
    { label: '联系我们', href: '#' }
  ]
};

export default {
  siteInfo,
  navbarConfig,
  heroConfig,
  galleryConfig,
  faqConfig,
  joinSectionConfig,
  footerConfig
};