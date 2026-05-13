<div class="quotes-container">
    <!-- Header Section -->
    <div class="header-section">
        <h1 class="main-title">✨ Inspirational Quotes</h1>
        <p class="subtitle">A collection of motivational quotes from around the world</p>
    </div>

    <!-- Controls Section -->
    <div class="controls-section">
        <div class="search-box">
            <input type="text" wire:model.live="searchTerm" placeholder="🔍 Search quotes or authors..."
                class="search-input">
        </div>

        <div class="action-buttons">
            <select wire:model.live="sortBy" class="sort-select">
                <option value="newest">📅 Newest First</option>
                <option value="oldest">📅 Oldest First</option>
                <option value="author">👤 By Author</option>
            </select>

            <button wire:click="refreshQuotes" class="refresh-btn">
                🔄 Refresh
            </button>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stat-card">
            <span class="stat-number">{{ count($quotes) }}</span>
            <span class="stat-label">Total Quotes</span>
        </div>
        <div class="stat-card">
            <span class="stat-number">{{ collect($quotes)->pluck('author')->unique()->count() }}</span>
            <span class="stat-label">Authors</span>
        </div>
    </div>

    <!-- Quotes List -->
    @if (count($quotes) > 0)
        <div class="quotes-grid">
            @foreach ($quotes as $quote)
                <div class="quote-card" wire:key="quote-{{ $quote->id }}">
                    <div class="quote-content">
                        <p class="quote-text">
                            <span class="quote-mark">"</span>{{ $quote->quote }}<span class="quote-mark">"</span>
                        </p>
                        <p class="quote-author">— {{ $quote->author }}</p>
                    </div>
                    <div class="quote-footer">
                        <small class="quote-date">{{ $quote->created_at->format('M d, Y') }}</small>
                        <button wire:click="deleteQuote({{ $quote->id }})"
                            wire:confirm="Are you sure you want to delete this quote?" class="delete-btn"
                            title="Delete quote">
                            🗑️
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3>No Quotes Found</h3>
            <p>Try adjusting your search or run the scraper to load quotes!</p>
        </div>
    @endif

    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .quotes-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header Section */
        .header-section {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            animation: slideDown 0.6s ease-out;
        }

        .main-title {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        .subtitle {
            font-size: 1.2em;
            opacity: 0.95;
            font-weight: 300;
        }

        /* Controls Section */
        .controls-section {
            max-width: 1000px;
            margin: 0 auto 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .search-box {
            display: flex;
            justify-content: center;
        }

        .search-input {
            width: 100%;
            max-width: 500px;
            padding: 14px 20px;
            font-size: 1.1em;
            border: none;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transform: scale(1.02);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .sort-select,
        .refresh-btn {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .sort-select {
            background-color: white;
            color: #667eea;
            min-width: 180px;
        }

        .sort-select:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .refresh-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .refresh-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.4);
        }

        .refresh-btn:active {
            transform: translateY(0) scale(1);
        }

        /* Stats Section */
        .stats-section {
            display: flex;
            gap: 20px;
            justify-content: center;
            max-width: 1000px;
            margin: 0 auto 40px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            padding: 25px 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 150px;
        }

        .stat-number {
            display: block;
            font-size: 2.5em;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #999;
            font-size: 0.95em;
            font-weight: 500;
        }

        /* Quotes Grid */
        .quotes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            max-width: 1400px;
            margin: 0 auto;
            animation: fadeIn 0.6s ease-out;
        }

        .quote-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-left: 5px solid #667eea;
            position: relative;
            overflow: hidden;
        }

        .quote-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quote-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .quote-card:hover::before {
            opacity: 1;
        }

        .quote-content {
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .quote-text {
            font-size: 1.1em;
            font-style: italic;
            color: #333;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .quote-mark {
            font-size: 2em;
            color: #667eea;
            opacity: 0.3;
            margin: 0 2px;
        }

        .quote-author {
            font-weight: 700;
            color: #764ba2;
            font-size: 1em;
            text-align: right;
        }

        .quote-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
            font-size: 0.9em;
        }

        .quote-date {
            color: #999;
        }

        .delete-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            transition: all 0.3s ease;
            padding: 5px 10px;
        }

        .delete-btn:hover {
            transform: scale(1.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            color: white;
            padding: 60px 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .empty-icon {
            font-size: 5em;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .quotes-container {
                padding: 20px 15px;
            }

            .main-title {
                font-size: 2.5em;
            }

            .subtitle {
                font-size: 1em;
            }

            .controls-section {
                margin-bottom: 30px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .sort-select,
            .refresh-btn {
                width: 100%;
            }

            .quotes-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .quote-card {
                padding: 20px;
            }

            .quote-text {
                font-size: 1em;
            }

            .stats-section {
                flex-direction: column;
            }

            .stat-card {
                width: 100%;
            }
        }

        /* Loading State */
        [wire\:loading] {
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
</div>
