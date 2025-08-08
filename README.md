# AreoCraft Minecraft Server Website

A modern, responsive website for the AreoCraft Minecraft server built with React and TypeScript.

## Project Overview
This website serves as the official landing page for the AreoCraft Minecraft server, providing information about the server, features, gallery, FAQ, and community joining options. The site features smooth animations, responsive design, and a centralized configuration system for easy content management.

## Key Features
- Responsive design optimized for all device sizes
- Smooth animations and transitions using Framer Motion
- Centralized configuration system for easy content updates
- Modern UI with Tailwind CSS
- Type-safe development with TypeScript
- SEO-friendly structure

## Technical Stack
- **Frontend Framework**: React 18
- **Language**: TypeScript
- **Build Tool**: Vite
- **Styling**: Tailwind CSS
- **Animations**: Framer Motion
- **Package Manager**: npm

## Installation
1. Clone the repository
```bash
git clone https://github.com/yourusername/acweb-next.git
cd acweb-next
```

2. Install dependencies
```bash
npm install
```

3. Start development server
```bash
npm run dev
```

4. Build for production
```bash
npm run build
```

## Configuration
All website content is managed through the `src/config/appConfig.ts` file. This includes:
- Server information and version
- Navigation links
- Hero section content
- Gallery images
- FAQ items
- Join section links

Modify this file to update website content without changing component code.

## Project Structure
- `src/components`: React components
- `src/config`: Application configuration
- `src/assets`: Static assets
- `src/index.css`: Global styles

## License
This project is licensed under the Apache-2.0 License.
