
# 🚀 Nexify – Smart Web Search Platform (Laravel Blade + Google CSE)

**Nexify** is a beautifully designed, fully functional smart web search interface built with Laravel Blade and powered by Google Custom Search Engine (CSE). It enhances traditional search with real-time widgets like weather, crypto, stocks, YouTube trends, Reddit posts, and more.

---

## 🌟 Features

### 🔍 Search Engine Interface
- Google CSE integrated search
- Tabbed engine switcher
- Custom background with smooth transitions
- Auto-query reload with history retention

### 🧠 Instant Smart Widgets
- **🌦 Weather** (OpenWeatherMap API)
- **💸 Cryptocurrency Prices** (CoinGecko API)
- **📈 Stock Prices** (Alpha Vantage API)
- **📢 News Headlines Ticker** (NewsAPI.org)
- **📺 YouTube Trending Videos** (YouTube Data API)
- **💬 Reddit Top Posts** (r/technology via Reddit API)
- **💡 Daily Motivational Quote** (ZenQuotes API)

### 📦 UI and UX
- Elegant design with animated cards and floating tabs
- Live background transitions (random Unsplash images)
- Notification bar cycling tips or messages
- Fully responsive layout with mobile-first optimizations

---

## ⚙️ Installation

> **Requirements:**
> - PHP >= 8.0
> - Laravel >= 9.x
> - Composer
> - Internet connection for API widgets

### 1. Clone the Project

```bash
git clone https://your-repo-url/nexify.git
cd nexify
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Environment Setup

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database and app config.

### 4. Set Up Google CSE

Create a [Google Custom Search Engine](https://programmablesearchengine.google.com/controlpanel/all), then update your `cx` value in the Blade file or controller:
```blade
<script async src="https://cse.google.com/cse.js?cx=YOUR_SEARCH_ENGINE_ID"></script>
```

### 5. Add API Keys in JS

Replace the placeholders inside your `search.blade.php` script section:

```js
const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY';
const apiKey = 'YOUR_NEWSAPI_KEY';
const apiKey = 'YOUR_YOUTUBE_API_KEY';
const apiKey = 'YOUR_ALPHA_VANTAGE_API_KEY';
```

Get your keys from:
- [OpenWeatherMap](https://openweathermap.org/api)
- [NewsAPI](https://newsapi.org/)
- [YouTube Data API](https://console.developers.google.com/)
- [Alpha Vantage](https://www.alphavantage.co/)
- [ZenQuotes (no key needed)](https://zenquotes.io/)

---

## 🧪 Demo Setup for Codester

> If selling on Codester:

1. Zip the project folder excluding `vendor/` and `node_modules/`.
2. Include:
    - `README.md`
    - `installation.txt` (can be extracted from this README)
    - Screenshots folder
3. Set `cx` in `search.blade.php` to your public CSE ID.
4. Ensure homepage is `search.blade.php`.

---

## 📸 Screenshots

- Full search experience
- Animated widget cards
- Responsive design on desktop and mobile
- Light and beautiful UI with useful data overlays

---

## 📌 Credits

- Laravel Blade
- Google CSE
- APIs: CoinGecko, OpenWeatherMap, NewsAPI, YouTube, Reddit, ZenQuotes
- Background images via [Unsplash](https://unsplash.com)

---

## 📄 License

This template is free for personal/commercial use on Codester. Attribution appreciated but not required.
