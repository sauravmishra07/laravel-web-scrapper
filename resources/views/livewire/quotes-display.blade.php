<div class="quotes-container">
    <!-- Animated Background -->
    <div class="bg-blur bg-blur-1"></div>
    <div class="bg-blur bg-blur-2"></div>

    <!-- Header -->
    <div class="header-section">
        <span class="badge">✨ Daily Inspiration</span>

        <h1 class="main-title">
            Inspirational <span>Quotes</span>
        </h1>

        <p class="subtitle">
            Discover wisdom, motivation, and positivity from great minds around the world.
        </p>
    </div>

    <!-- Controls -->
    <div class="controls-wrapper">
        <div class="controls-section">

            <div class="search-box">
                <span class="search-icon">🔍</span>

                <input
                    type="text"
                    wire:model.live="searchTerm"
                    placeholder="Search quotes or authors..."
                    class="search-input">
            </div>

            <div class="action-buttons">

                <select wire:model.live="sortBy" class="sort-select">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="author">By Author</option>
                </select>

                <button wire:click="refreshQuotes" class="refresh-btn">
                    <span>🔄</span>
                    Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-section">

        <div class="stat-card">
            <div class="stat-icon">💬</div>

            <div>
                <span class="stat-number">
                    {{ count($quotes) }}
                </span>

                <span class="stat-label">
                    Total Quotes
                </span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👤</div>

            <div>
                <span class="stat-number">
                    {{ collect($quotes)->pluck('author')->unique()->count() }}
                </span>

                <span class="stat-label">
                    Authors
                </span>
            </div>
        </div>
    </div>

    <!-- Quotes -->
    @if (count($quotes) > 0)

        <div class="quotes-grid">

            @foreach ($quotes as $quote)

                <div class="quote-card" wire:key="quote-{{ $quote->id }}">

                    <div class="quote-glow"></div>

                    <div class="quote-content">

                        <div class="quote-icon">❝</div>

                        <p class="quote-text">
                            {{ $quote->quote }}
                        </p>

                        <div class="author-row">
                            <div class="author-avatar">
                                {{ strtoupper(substr($quote->author, 0, 1)) }}
                            </div>

                            <div>
                                <p class="quote-author">
                                    {{ $quote->author }}
                                </p>

                                <small class="quote-date">
                                    {{ $quote->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="quote-footer">

                        <button
                            wire:click="deleteQuote({{ $quote->id }})"
                            wire:confirm="Are you sure you want to delete this quote?"
                            class="delete-btn">

                            🗑 Delete
                        </button>
                    </div>
                </div>

            @endforeach

        </div>

    @else

        <div class="empty-state">

            <div class="empty-icon">📭</div>

            <h3>No Quotes Found</h3>

            <p>
                Try adjusting your search or refresh the quote collection.
            </p>
        </div>

    @endif


    <!-- Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow-x: hidden;
        }

        .quotes-container {
            position: relative;
            min-height: 100vh;
            padding: 60px 24px;
            overflow: hidden;
            background:
                radial-gradient(circle at top left, #4f46e5 0%, transparent 30%),
                radial-gradient(circle at bottom right, #9333ea 0%, transparent 30%),
                linear-gradient(135deg, #0f172a, #111827, #1e1b4b);
            font-family: 'Inter', sans-serif;
        }

        /* Background Glow */
        .bg-blur {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: .25;
            z-index: 0;
        }

        .bg-blur-1 {
            width: 300px;
            height: 300px;
            background: #8b5cf6;
            top: -100px;
            left: -100px;
        }

        .bg-blur-2 {
            width: 350px;
            height: 350px;
            background: #06b6d4;
            bottom: -120px;
            right: -100px;
        }

        /* Header */
        .header-section {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 50px;
            animation: fadeUp .7s ease;
        }

        .badge {
            display: inline-block;
            padding: 8px 18px;
            border-radius: 999px;
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            backdrop-filter: blur(12px);
            color: #fff;
            margin-bottom: 20px;
            font-size: .9rem;
            font-weight: 600;
        }

        .main-title {
            font-size: clamp(2.8rem, 6vw, 5rem);
            color: white;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -2px;
        }

        .main-title span {
            background: linear-gradient(90deg, #a78bfa, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            color: rgba(255,255,255,.75);
            font-size: 1.1rem;
            max-width: 700px;
            margin: auto;
            line-height: 1.7;
        }

        /* Controls */
        .controls-wrapper {
            position: relative;
            z-index: 2;
            max-width: 1100px;
            margin: auto;
        }

        .controls-section {
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            border-radius: 24px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(20px);
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            position: relative;
            min-width: 260px;
        }

        .search-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            opacity: .6;
        }

        .search-input {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,.1);
            background: rgba(255,255,255,.08);
            color: white;
            font-size: 1rem;
            transition: .3s ease;
        }

        .search-input::placeholder {
            color: rgba(255,255,255,.5);
        }

        .search-input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139,92,246,.2);
        }

        .action-buttons {
            display: flex;
            gap: 14px;
        }

        .sort-select,
        .refresh-btn {
            border: none;
            padding: 14px 20px;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s ease;
        }

        .sort-select {
            background: rgba(255,255,255,.08);
            color: white;
            border: 1px solid rgba(255,255,255,.1);
        }

        .refresh-btn {
            background: linear-gradient(135deg, #8b5cf6, #06b6d4);
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(139,92,246,.4);
        }

        /* Stats */
        .stats-section {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: auto auto 40px;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 24px;
            border-radius: 24px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(16px);
            color: white;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #8b5cf6, #06b6d4);
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 800;
        }

        .stat-label {
            color: rgba(255,255,255,.6);
        }

        /* Quotes Grid */
        .quotes-grid {
            position: relative;
            z-index: 2;
            max-width: 1400px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: 24px;
        }

        .quote-card {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            padding: 28px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.08);
            backdrop-filter: blur(16px);
            transition: .4s ease;
        }

        .quote-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255,255,255,.2);
            box-shadow: 0 20px 40px rgba(0,0,0,.25);
        }

        .quote-glow {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(139,92,246,.15),
                rgba(6,182,212,.05)
            );
            opacity: 0;
            transition: .4s ease;
        }

        .quote-card:hover .quote-glow {
            opacity: 1;
        }

        .quote-content {
            position: relative;
            z-index: 2;
        }

        .quote-icon {
            font-size: 3rem;
            color: #8b5cf6;
            margin-bottom: 12px;
            line-height: 1;
        }

        .quote-text {
            color: white;
            font-size: 1.08rem;
            line-height: 1.9;
            margin-bottom: 28px;
        }

        .author-row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8b5cf6, #06b6d4);
            display: grid;
            place-items: center;
            color: white;
            font-weight: 700;
        }

        .quote-author {
            color: white;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .quote-date {
            color: rgba(255,255,255,.55);
        }

        .quote-footer {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.08);
            display: flex;
            justify-content: flex-end;
        }

        .delete-btn {
            border: none;
            padding: 10px 16px;
            border-radius: 14px;
            background: rgba(239,68,68,.15);
            color: #f87171;
            cursor: pointer;
            transition: .3s ease;
            font-weight: 600;
        }

        .delete-btn:hover {
            background: #ef4444;
            color: white;
        }

        /* Empty State */
        .empty-state {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: auto;
            text-align: center;
            padding: 80px 20px;
            color: white;
        }

        .empty-icon {
            font-size: 5rem;
            margin-bottom: 18px;
        }

        .empty-state h3 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: rgba(255,255,255,.7);
            line-height: 1.7;
        }

        /* Animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {

            .quotes-container {
                padding: 40px 16px;
            }

            .controls-section {
                flex-direction: column;
                align-items: stretch;
            }

            .action-buttons {
                width: 100%;
                flex-direction: column;
            }

            .sort-select,
            .refresh-btn {
                width: 100%;
            }

            .quotes-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Livewire Loading */
        [wire\:loading] {
            opacity: .6;
            pointer-events: none;
        }
    </style>
</div>