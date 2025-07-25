@extends('layouts.app')

@section('title', 'Nexify – Smart Web Search')

@section('head')
    <style>
        :root {
            --primary: #6e44ff;
            --accent: #ff2e63;
            --bg: #f7f9fc;
            --text: #1a1a1a;
            --white: #fff;
        }

        body {
            background: var(--bg);
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            margin: 0;
        }

        .search-hero {
            text-align: center;
            padding: 6rem 1rem 2rem;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            transition: background-image 1s ease;
            color: var(--white);
        }

        .search-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .search-hero h1,
        .search-hero p {
            position: relative;
            z-index: 2;
        }

        .search-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .search-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin: 2rem 0 1rem;
        }

        .tab-btn {
            background: var(--white);
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: var(--text);
        }

        .tab-btn.active,
        .tab-btn:hover {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: var(--white);
            border: none;
        }

        .search-box-wrapper {
            max-width: 800px;
            margin: 0 auto 2rem;
            background: var(--white);
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            z-index: 3;
            position: relative;
        }

        .gcse-search {
            width: 100%;
        }

        /* Ensure space for search results */
        .search-results-container {
            max-width: 1200px;
            margin: 0 auto 4rem; /* Added padding below to make room for results */
            padding: 0 1rem;
            z-index: 2;
        }

        .search-footer {
            text-align: center;
            padding: 3rem 1rem;
            color: #777;
        }

        .gsc-tabHeader.gsc-inline-block,
        .gsc-tabsArea {
            display: none !important;
        }

        .widget-section {
            max-width: 1200px;
            margin: 10rem auto; /* Keeping the lower position */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding: 0 1rem;
            z-index: 3;
            position: relative;
        }

        .widget-card {
            background: var(--white);
            border-radius: 20px; /* Slightly increased for a futuristic look */
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent; /* Base border for aura effect */
        }

        .widget-card:hover {
            transform: translateY(-5px);
            border: 2px solid transparent; /* Maintains transparent base border */
            box-shadow: 0 10px 30px rgba(110, 68, 255, 0.3), /* Lift shadow */
                       0 0 15px rgba(110, 68, 255, 0.6), /* Primary aura glow */
                       0 0 20px rgba(255, 46, 99, 0.6); /* Accent aura glow */
        }

        .widget-card h3 {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--primary);
            position: relative;
            z-index: 2;
        }

        .weather-widget .weather-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .weather-widget img {
            width: 50px;
        }

        .crypto-widget ul,
        .stock-widget ul,
        .reddit-widget ul {
            list-style: none;
            padding: 0;
            position: relative;
            z-index: 2;
        }

        .crypto-widget li,
        .stock-widget li,
        .reddit-widget li {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
            position: relative;
            z-index: 2;
        }

        .news-ticker {
            overflow: hidden;
            white-space: nowrap;
            position: relative;
            background: var(--primary);
            color: var(--white);
            padding: 0.5rem;
            border-radius: 10px;
            position: relative;
            z-index: 2;
        }

        .news-ticker span {
            display: inline-block;
            padding-left: 100%;
            animation: ticker 20s linear infinite;
            position: relative;
            z-index: 2;
        }

        @keyframes ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        .youtube-widget .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            position: relative;
            z-index: 2;
        }

        .youtube-widget iframe {
            border-radius: 10px;
            width: 100%;
            height: 150px;
        }

        .quote-widget {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .quote-widget p {
            font-style: italic;
            margin-bottom: 0.5rem;
        }

        .quote-widget small {
            color: #777;
        }

        .reddit-widget a {
            color: var(--primary);
            text-decoration: none;
            position: relative;
            z-index: 2;
        }

        .reddit-widget a:hover {
            text-decoration: underline;
        }

        .notification-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--primary);
            color: var(--white);
            padding: 0.8rem;
            text-align: center;
            transform: translateY(100%);
            transition: transform 0.5s ease;
            z-index: 1000;
        }

        .notification-bar.active {
            transform: translateY(0);
        }

        .notification-bar span {
            margin-right: 1rem;
        }

        .notification-bar .close-btn {
            background: none;
            border: none;
            color: var(--white);
            font-weight: bold;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .search-hero h1 { font-size: 2.3rem; }
            .search-box-wrapper { padding: 0.5rem 1rem; }
            .widget-section { grid-template-columns: 1fr; }
            .search-results-container { margin-bottom: 2rem; }
        }

        @media (max-width: 480px) {
            .search-hero h1 { font-size: 1.8rem; }
            .search-hero p { font-size: 1rem; }
            .youtube-widget iframe { height: 120px; }
        }
    </style>
@endsection

@section('content')
    <div class="search-hero" id="search-hero">
        <h1>Nexify</h1>
        <p>Discover the internet, beautifully. Powered by Google CSE.</p>
    </div>

    <div class="tabs">
        @if (!empty($engines) && !empty($activeEngine))
            @foreach ($engines as $engine)
                <a href="{{ route('search.index', ['engine' => $engine->id, 'q' => request('q')]) }}"
                   class="tab-btn {{ $engine->id === $activeEngine->id ? 'active' : '' }}">
                    {{ $engine->name }}
                </a>
            @endforeach
        @else
            <p>No search engines available.</p>
        @endif
    </div>

    <div class="search-box-wrapper">
        <div class="gcse-search" id="gcse-box"></div>
    </div>

    <!-- Container for search results to ensure space -->
    <div class="search-results-container">
        <div id="gcse-results"></div> <!-- Placeholder for Google CSE results -->
    </div>

    <section class="widget-section">
        <!-- Weather Widget -->
        <div class="widget-card weather-widget">
            <h3>🌦️ Weather</h3>
            <div class="weather-info">
                <img id="weather-icon" src="" alt="Weather Icon">
                <div>
                    <p id="weather-city">Loading...</p>
                    <p id="weather-temp"></p>
                    <p id="weather-desc"></p>
                </div>
            </div>
        </div>

        <!-- Crypto Prices Widget -->
        <div class="widget-card crypto-widget">
            <h3>💸 Crypto Prices</h3>
            <ul id="crypto-list">
                <li>Loading...</li>
            </ul>
        </div>

        <!-- News Ticker -->
        <div class="widget-card news-ticker">
            <h3>📢 Breaking News</h3>
            <span id="news-ticker-text">Loading news...</span>
        </div>

        <!-- YouTube Trending -->
        <div class="widget-card youtube-widget">
            <h3>📺 Trending on YouTube</h3>
            <div class="video-grid" id="youtube-videos"></div>
        </div>

        <!-- Stock Prices Widget -->
        <div class="widget-card stock-widget">
            <h3>📈 Stock Prices</h3>
            <ul id="stock-list">
                <li>Loading...</li>
            </ul>
        </div>

        <!-- Quote Widget -->
        <div class="widget-card quote-widget">
            <h3>💡 Daily Quote</h3>
            <p id="quote-text">Loading...</p>
            <small id="quote-author"></small>
        </div>

        <!-- Reddit Posts Widget -->
        <div class="widget-card reddit-widget">
            <h3>🔥 Reddit Trends</h3>
            <ul id="reddit-posts">
                <li>Loading...</li>
            </ul>
        </div>
    </section>

    <div class="notification-bar" id="notification-bar">
        <span id="notification-text"></span>
        <button class="close-btn" onclick="closeNotification()">✕</button>
    </div>

    <div class="search-footer">
        <small>© {{ date('Y') }} Nexify Search. Built for modern discovery.</small>
    </div>

    <script>
        const query = @json($query ?? '');
        window.__gcse = {
            callback: function () {
                const maxAttempts = 10;
                let attempts = 0;
                const interval = setInterval(() => {
                    const input = document.querySelector('.gsc-input');
                    if (input) {
                        input.value = query;
                        input.dispatchEvent(new Event('input'));
                        const button = document.querySelector('.gsc-search-button input');
                        if (button) button.click();
                        clearInterval(interval);
                    } else if (attempts >= maxAttempts) {
                        clearInterval(interval);
                        console.warn('CSE input not found.');
                    }
                    attempts++;
                }, 500);
            }
        };

        // Weather API (OpenWeatherMap)
        async function fetchWeather() {
            const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY'; // Replace with your API key
            const city = 'London';
            const weatherCity = document.getElementById('weather-city');
            const weatherTemp = document.getElementById('weather-temp');
            const weatherDesc = document.getElementById('weather-desc');
            const weatherIcon = document.getElementById('weather-icon');
            weatherCity.textContent = 'Loading...';
            if (!apiKey || apiKey.includes('YOUR_')) {
                weatherCity.textContent = 'London';
                weatherTemp.textContent = '20°C';
                weatherDesc.textContent = 'Sunny';
                weatherIcon.src = 'http://openweathermap.org/img/wn/01d.png';
                return;
            }
            try {
                const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`);
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                weatherCity.textContent = data.name;
                weatherTemp.textContent = `${Math.round(data.main.temp)}°C`;
                weatherDesc.textContent = data.weather[0].description;
                weatherIcon.src = `http://openweathermap.org/img/wn/${data.weather[0].icon}.png`;
            } catch (error) {
                weatherCity.textContent = 'Weather unavailable';
                weatherTemp.textContent = '';
                weatherDesc.textContent = '';
                weatherIcon.src = '';
                console.error('Weather fetch error:', error);
            }
        }

        // Crypto Prices API (CoinGecko)
        async function fetchCrypto() {
            const cryptoList = document.getElementById('crypto-list');
            cryptoList.innerHTML = '<li>Loading...</li>';
            try {
                const response = await fetch('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin,ethereum,binancecoin&order=market_cap_desc');
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                cryptoList.innerHTML = '';
                data.forEach(coin => {
                    const li = document.createElement('li');
                    li.innerHTML = `${coin.name}: $${coin.current_price.toFixed(2)} <span style="color: ${coin.price_change_percentage_24h >= 0 ? 'green' : 'red'};">(${coin.price_change_percentage_24h.toFixed(2)}%)</span>`;
                    cryptoList.appendChild(li);
                });
            } catch (error) {
                cryptoList.innerHTML = '<li>Prices unavailable</li>';
                console.error('Crypto fetch error:', error);
            }
        }

        // News Ticker API (NewsAPI)
        async function fetchNews() {
            const apiKey = 'YOUR_NEWSAPI_KEY'; // Replace with your API key
            const ticker = document.getElementById('news-ticker-text');
            ticker.textContent = 'Loading news...';
            if (!apiKey || apiKey.includes('YOUR_')) {
                ticker.textContent = 'Sample News • Breaking Story • Update';
                return;
            }
            try {
                const response = await fetch(`https://newsapi.org/v2/top-headlines?language=en&apiKey=${apiKey}`);
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                const headlines = data.articles.slice(0, 5).map(article => article.title).join(' • ');
                ticker.textContent = headlines || 'No news available';
            } catch (error) {
                ticker.textContent = 'News unavailable';
                console.error('News fetch error:', error);
            }
        }

        // YouTube Trending API
        async function fetchYouTubeTrending() {
            const apiKey = 'YOUR_YOUTUBE_API_KEY'; // Replace with your API key
            const videoGrid = document.getElementById('youtube-videos');
            videoGrid.innerHTML = '';
            if (!apiKey || apiKey.includes('YOUR_')) {
                videoGrid.innerHTML = '<p>Sample video placeholder</p>';
                return;
            }
            try {
                const response = await fetch(`https://www.googleapis.com/youtube/v3/videos?part=snippet&chart=mostPopular&maxResults=3&key=${apiKey}`);
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                videoGrid.innerHTML = '';
                data.items.forEach(video => {
                    const div = document.createElement('div');
                    div.innerHTML = `<iframe src="https://www.youtube.com/embed/${video.id}" frameborder="0" allowfullscreen></iframe>`;
                    videoGrid.appendChild(div);
                });
            } catch (error) {
                videoGrid.innerHTML = '<p>Videos unavailable</p>';
                console.error('YouTube fetch error:', error);
            }
        }

        // Stock Prices API (Alpha Vantage)
        async function fetchStocks() {
            const apiKey = 'YOUR_ALPHA_VANTAGE_API_KEY'; // Replace with your API key
            const symbols = ['AAPL', 'TSLA', 'MSFT'];
            const stockList = document.getElementById('stock-list');
            stockList.innerHTML = '<li>Loading...</li>';
            if (!apiKey || apiKey.includes('YOUR_')) {
                stockList.innerHTML = '<li>AAPL: $200.00 (+1.5%)</li><li>TSLA: $250.00 (-0.5%)</li><li>MSFT: $300.00 (+2.0%)</li>';
                return;
            }
            try {
                stockList.innerHTML = '';
                for (const symbol of symbols) {
                    const response = await fetch(`https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=${symbol}&apikey=${apiKey}`);
                    if (!response.ok) throw new Error('API request failed');
                    const data = await response.json();
                    const quote = data['Global Quote'];
                    if (quote) {
                        const li = document.createElement('li');
                        li.innerHTML = `${quote['01. symbol']}: $${parseFloat(quote['05. price']).toFixed(2)} <span style="color: ${parseFloat(quote['10. change percent']) >= 0 ? 'green' : 'red'};">(${parseFloat(quote['10. change percent']).toFixed(2)}%)</span>`;
                        stockList.appendChild(li);
                    }
                }
            } catch (error) {
                stockList.innerHTML = '<li>Prices unavailable</li>';
                console.error('Stock fetch error:', error);
            }
        }

        // Quote API (ZenQuotes)
        async function fetchQuote() {
            const quoteText = document.getElementById('quote-text');
            const quoteAuthor = document.getElementById('quote-author');
            quoteText.textContent = 'Loading...';
            try {
                const response = await fetch('https://zenquotes.io/api/random');
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                const quote = data[0];
                quoteText.textContent = `"${quote.q}"`;
                quoteAuthor.textContent = `— ${quote.a}`;
            } catch (error) {
                quoteText.textContent = '"Failure is the opportunity to begin again more intelligently."';
                quoteAuthor.textContent = '— Henry Ford';
                console.error('Quote fetch error:', error);
            }
        }

        // Reddit Posts API
        async function fetchRedditPosts() {
            const redditList = document.getElementById('reddit-posts');
            redditList.innerHTML = '<li>Loading...</li>';
            try {
                const response = await fetch('https://www.reddit.com/r/technology/hot.json?limit=5');
                if (!response.ok) throw new Error('API request failed');
                const data = await response.json();
                redditList.innerHTML = '';
                data.data.children.forEach(post => {
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.href = `https://reddit.com${post.data.permalink}`;
                    a.textContent = post.data.title;
                    a.target = '_blank';
                    li.appendChild(a);
                    redditList.appendChild(li);
                });
            } catch (error) {
                redditList.innerHTML = '<li>Posts unavailable</li>';
                console.error('Reddit fetch error:', error);
            }
        }

        const notifications = [
            'Welcome to Nexify! Try our new search features.',
            'Check out trending YouTube videos below!',
            'Stay updated with real-time stock and crypto prices.'
        ];
        let currentNotification = 0;

        function showNotification() {
            const bar = document.getElementById('notification-bar');
            document.getElementById('notification-text').textContent = notifications[currentNotification];
            bar.classList.add('active');
            setTimeout(() => {
                bar.classList.remove('active');
                currentNotification = (currentNotification + 1) % notifications.length;
                setTimeout(showNotification, 1000);
            }, 5000);
        }

        function closeNotification() {
            document.getElementById('notification-bar').classList.remove('active');
        }

        const backgroundImages = [
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NTY4NDJ8MHwxfGFsbHwxfHx8fHx8Mnx8MTcyMTg4NDg2MHw&ixlib=rb-4.0.3&q=80&w=1080',
            'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NTY4NDJ8MHwxfGFsbHwxfHx8fHx8Mnx8MTcyMTg4NDg2MHw&ixlib=rb-4.0.3&q=80&w=1080',
            'https://images.unsplash.com/photo-1501854140801-50d01698950b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NTY4NDJ8MHwxfGFsbHwxfHx8fHx8Mnx8MTcyMTg4NDg2MHw&ixlib=rb-4.0.3&q=80&w=1080'
        ];
        let currentImageIndex = 0;

        function updateBackground() {
            const hero = document.getElementById('search-hero');
            hero.style.backgroundImage = `url(${backgroundImages[currentImageIndex]})`;
            currentImageIndex = (currentImageIndex + 1) % backgroundImages.length;
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateBackground();
            setInterval(updateBackground, 10000);
            fetchWeather();
            fetchCrypto();
            fetchNews();
            fetchYouTubeTrending();
            fetchStocks();
            fetchQuote();
            fetchRedditPosts();
            setTimeout(showNotification, 1000);
        });
    </script>
    <script async src="https://cse.google.com/cse.js?cx=a16165892717b4ccc"></script>
@endsection