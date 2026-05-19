# 📚 Inspirational Quotes App

![Inspirational Quotes UI](../quote-app//docs//images/home.png)

A full-stack web application that scrapes inspirational quotes from the web, stores them in a database, and displays them beautifully on a responsive UI using Laravel + Livewire + Puppeteer.

---

## 🎯 Project Overview

This application demonstrates a complete modern web development workflow:

- **Web Scraping**: Extract quotes from `quotes.toscrape.com` using Puppeteer
- **RESTful API**: Build a Laravel API to manage quotes
- **Frontend**: Display quotes with beautiful UI using Livewire
- **Real-time Updates**: Interactive search, sort, and delete functionality

---

## 📋 Project Specification

### Tech Stack

| Component       | Technology          | Version  |
| --------------- | ------------------- | -------- |
| **Backend**     | Laravel             | 11.x     |
| **Frontend**    | Livewire            | 3.x      |
| **Database**    | SQLite              | Built-in |
| **Scraper**     | Puppeteer (Node.js) | 21.x     |
| **HTTP Client** | Axios               | 1.x      |

### Core Features

✅ **Web Scraping** - Extract 10+ quotes using Puppeteer  
✅ **REST API** - Full CRUD operations for quotes  
✅ **Database** - SQLite with Eloquent ORM  
✅ **Live Search** - Real-time quote & author search  
✅ **Smart Sort** - Sort by newest, oldest, or author  
✅ **Statistics** - Display total quotes and unique authors  
✅ **Delete Feature** - Remove quotes with confirmation  
✅ **Responsive Design** - Mobile-friendly UI  
✅ **Beautiful Styling** - Gradient backgrounds, animations, hover effects

---

## 📂 Complete Folder Structure

```
quote-app/
│
├── 📄 README.md                          (Project documentation)
├── 📄 .env                               (Environment variables)
├── 📄 composer.json                      (PHP dependencies)
├── 📄 package.json                       (JS dependencies)
├── 📄 artisan                            (Laravel CLI)
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Api/
│   │           └── QuoteController.php   (API endpoints)
│   ├── Livewire/
│   │   └── QuotesDisplay.php             (Livewire component)
│   ├── Models/
│   │   └── Quote.php                     (Quote model)
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── RouteServiceProvider.php
│
├── bootstrap/
│   ├── app.php
│   └── providers.php                     (Registered providers)
│
├── config/
│   ├── app.php
│   ├── database.php
│   └── ...
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2026_05_13_073322_create_quotes_table.php  (Quotes table)
│   │   └── ...
│   └── seeders/
│
├── public/
│   ├── index.php                         (Entry point)
│   └── ...
│
├── resources/
│   ├── views/
│   │   ├── quotes.blade.php              (Main layout)
│   │   └── livewire/
│   │       └── quotes-display.blade.php  (Quote component view)
│   └── css/
│
├── routes/
│   ├── api.php                           (API routes)
│   ├── web.php                           (Web routes)
│   └── console.php
│
├── storage/
│   ├── app/
│   ├── logs/
│   └── framework/
│
├── tests/
│   └── ...
│
├── vendor/
│   └── (Composer packages)
│
└── scraper/                              (Node.js Web Scraper)
    ├── scrape.js                         (Main scraper script)
    ├── package.json                      (Node dependencies)
    ├── package-lock.json
    └── node_modules/
        ├── puppeteer/                    (Browser automation)
        └── axios/                        (HTTP client)
```

---

## 🔄 Complete Application Flow

### Workflow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                      APPLICATION FLOW DIAGRAM                   │
└─────────────────────────────────────────────────────────────────┘

STEP 1: WEB SCRAPING
═══════════════════════════════════════════════════════════════════

    npm run scrape
         │
         ▼
    ┌─────────────────────┐
    │ Puppeteer Browser   │
    │ (headless: true)    │
    └─────────────────────┘
         │
         ▼
    Visit: https://quotes.toscrape.com/
         │
         ▼
    Extract Quote Data:
    - quote text
    - author name
         │
         ▼
    Array of 10+ Quotes
    [
      { quote: "...", author: "..." },
      { quote: "...", author: "..." },
      ...
    ]


STEP 2: SEND TO LARAVEL API
═══════════════════════════════════════════════════════════════════

    For Each Quote:
         │
         ▼
    POST /api/quotes
    (JSON body: { quote, author })
         │
         ▼
    ┌──────────────────────────────┐
    │  Laravel API Controller       │
    │  (QuoteController@store)      │
    └──────────────────────────────┘
         │
         ▼
    Validate Data:
    - quote: required|string|min:5
    - author: required|string|min:2
         │
         ▼
    ┌──────────────────────────────┐
    │  Quote Model (Eloquent ORM)  │
    │  Quote::create($validated)   │
    └──────────────────────────────┘
         │
         ▼
    Database Insert


STEP 3: DATABASE STORAGE
═══════════════════════════════════════════════════════════════════

    ┌────────────────────────────────┐
    │     SQLite Database            │
    │  (database/database.sqlite)    │
    └────────────────────────────────┘
         │
    ┌────────────────────────────────┐
    │     quotes table               │
    ├────────────────────────────────┤
    │ id | quote | author | dates    │
    ├────────────────────────────────┤
    │ 1  | "Be yourself..." | Oscar  │
    │ 2  | "The way to..." | Steve   │
    │ ... (10+ quotes stored)        │
    └────────────────────────────────┘


STEP 4: USER VISITS WEBSITE
═══════════════════════════════════════════════════════════════════

    Browser: http://localhost:8000
         │
         ▼
    ┌──────────────────────────────┐
    │  Laravel Web Route            │
    │  Route::get('/', ...)         │
    └──────────────────────────────┘
         │
         ▼
    Load View: resources/views/quotes.blade.php
         │
         ▼
    ┌──────────────────────────────┐
    │  Livewire Component           │
    │  (QuotesDisplay)              │
    └──────────────────────────────┘
         │
         ▼
    mount() function
    loadQuotes() → fetches from DB
         │
         ▼
    Pass $quotes to view


STEP 5: DISPLAY WITH INTERACTIVE FEATURES
═══════════════════════════════════════════════════════════════════

    ┌─────────────────────────────────────────┐
    │  Beautiful UI Rendered                  │
    ├─────────────────────────────────────────┤
    │  ✨ Inspirational Quotes                │
    │  [Search Input] [Sort Dropdown] [🔄]   │
    │                                         │
    │  Total Quotes: 10  |  Authors: 8      │
    │                                         │
    │  ┌─────────────────────────────────┐   │
    │  │ "Be yourself; everyone else..."│   │
    │  │ — Oscar Wilde           [🗑️]   │   │
    │  └─────────────────────────────────┘   │
    │  ┌─────────────────────────────────┐   │
    │  │ "The way to get started..."     │   │
    │  │ — Steve Martin          [🗑️]   │   │
    │  └─────────────────────────────────┘   │
    │  (10+ quote cards...)                  │
    └─────────────────────────────────────────┘


STEP 6: USER INTERACTIONS
═══════════════════════════════════════════════════════════════════

    ┌──────────────────────────────────────┐
    │  User Actions (Live Updates)         │
    ├──────────────────────────────────────┤
    │  🔍 Search Input                     │
    │     wire:model.live="searchTerm"    │
    │     → Filters quotes in real-time    │
    │                                      │
    │  📊 Sort Dropdown                    │
    │     wire:model.live="sortBy"         │
    │     → Sort: newest/oldest/author    │
    │                                      │
    │  🔄 Refresh Button                   │
    │     wire:click="refreshQuotes"       │
    │     → Reloads from database          │
    │                                      │
    │  🗑️ Delete Button                     │
    │     wire:click="deleteQuote($id)"    │
    │     → Removes quote from DB          │
    └──────────────────────────────────────┘
         │
         ▼
    Livewire Updates Component
         │
         ▼
    Re-render View
         │
         ▼
    UI Updates (No page reload!)
```

---

## 🛠️ API Endpoints

### Base URL

```
http://localhost:8000/api
```

### Endpoints

| Method     | Endpoint       | Description         |
| ---------- | -------------- | ------------------- |
| **GET**    | `/quotes`      | Retrieve all quotes |
| **POST**   | `/quotes`      | Create a new quote  |
| **GET**    | `/quotes/{id}` | Get a single quote  |
| **PUT**    | `/quotes/{id}` | Update a quote      |
| **DELETE** | `/quotes/{id}` | Delete a quote      |

### Example Requests

**GET All Quotes**

```bash
curl http://localhost:8000/api/quotes
```

**Create Quote**

```bash
curl -X POST http://localhost:8000/api/quotes \
  -H "Content-Type: application/json" \
  -d '{"quote":"Be yourself","author":"Oscar Wilde"}'
```

**Delete Quote**

```bash
curl -X DELETE http://localhost:8000/api/quotes/1
```

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 16+
- npm

### Installation

#### 1. Install PHP Dependencies

```bash
composer install
```

#### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

#### 3. Database Setup

```bash
php artisan migrate
```

#### 4. Setup Node.js Scraper

```bash
cd scraper
npm install
cd ..
```

### Running the Application

#### Terminal 1: Start Laravel Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

#### Terminal 2: Run Web Scraper

```bash
cd scraper
npm run scrape
```

---

## 📊 Database Schema

### Quotes Table

```sql
CREATE TABLE quotes (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    quote TEXT NOT NULL,
    author VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Example Data

```
id | quote | author | created_at | updated_at
---|-------|--------|------------|------------
1  | "Be yourself; everyone else is already taken." | Oscar Wilde | 2026-05-13 | 2026-05-13
2  | "The way to get started is to quit talking..." | Steve Martin | 2026-05-13 | 2026-05-13
...
```

---

## 🎨 UI Features & Interface

### Application Overview

The Inspirational Quotes app presents a beautifully designed dark-themed interface with an elegant color scheme featuring purple and blue gradients. The interface is intuitive, modern, and fully responsive.

### Header Section

```
╔════════════════════════════════════════════════╗
║  ✨ Daily Inspiration                          ║
║                                                ║
║  Inspirational Quotes                         ║
║  Discover wisdom, motivation, and positivity  ║
║  from great minds around the world.           ║
╚════════════════════════════════════════════════╝
```

**Features:**

- Bold, centered title: "Inspirational Quotes"
- Inspirational subtitle explaining the app's purpose
- Premium gradient background with dark theme

### Interactive Controls Section

The app includes powerful search and filter controls:

```
┌─────────────────────────────────────────────┐
│ 🔍 [Search quotes or authors...] [▼ Author] │
│                          [🔄 Refresh]        │
└─────────────────────────────────────────────┘
```

**Components:**

- **Search Input** - Real-time search across quotes and authors
- **Author Filter Dropdown** - Filter quotes by specific authors
- **Refresh Button** - Reload latest quotes from database
- All controls use Livewire for instant, no-reload updates

### Statistics Dashboard

Displays key metrics at a glance:

```
┌──────────────────────┐  ┌──────────────────────┐
│ 📊 10                │  │ 👥 8                 │
│    Total Quotes      │  │    Authors           │
└──────────────────────┘  └──────────────────────┘
```

**Shows:**

- Total number of quotes in the database
- Number of unique authors
- Real-time updates as quotes are added/deleted

### Quote Cards Grid

The quotes are displayed in a beautiful responsive grid layout with the following features:

```
┌─────────────────────────────────────┐
│  " The way to get started is to     │
│    quit talking and begin doing."   │
│                                     │
│  👤 Albert Einstein                 │
│     May 13, 2026                    │
│                           [🗑️ Delete] │
└─────────────────────────────────────┘
```

**Card Features:**

- **Quote Text** - Displayed with quotation marks for emphasis
- **Author Name** - Clearly attributed to the quote source
- **Date Created** - Shows when the quote was added to the database
- **Delete Button** - One-click removal with visual feedback
- Minimum width of 350px per card
- Beautiful hover effects with smooth animations
- Gradient backgrounds matching the theme

### Visual Design Elements

**Styling Highlights:**

- Dark background (#1a2332 or similar dark blue/purple)
- Gradient accents (purple to blue to pink)
- Card backgrounds with subtle transparency
- Smooth transitions and hover animations
- Clear contrast for readability
- Professional typography with proper line spacing
- Responsive design that works on:
    - 💻 Desktop (full grid layout)
    - 📱 Tablet (2-3 columns)
    - 📱 Mobile (1-2 columns)

### Components

- **Header Section** - Title and subtitle
- **Search Box** - Real-time search with Livewire
- **Author Filter** - Dropdown to filter by author
- **Refresh Button** - Reload quotes from database
- **Statistics Cards** - Total quotes and authors count
- **Quote Grid** - Responsive card layout (auto-columns)
- **Quote Cards** - Beautiful design with animations
- **Delete Buttons** - Remove quotes with confirmation
- **Empty State** - Message when no quotes found

### Styling Highlights

- Dark theme with purple/blue color scheme
- Gradient backgrounds for visual depth
- Smooth animations and transitions
- Hover effects on cards with scale transformation
- Mobile responsive design with flexible grid
- 350px minimum card width for readability
- Clean typography with proper spacing and hierarchy
- Semi-transparent overlays for depth
- Professional box shadows and borders

---

## 🔧 Key Technologies

### Backend

- **Laravel 11** - PHP web framework
- **Eloquent ORM** - Database abstraction
- **Livewire 3** - Real-time UI components

### Frontend

- **Blade Templates** - PHP templating
- **CSS3** - Styling with animations
- **JavaScript** - Interactivity

### Data Scraping

- **Puppeteer** - Browser automation
- **Axios** - HTTP requests

### Database

- **SQLite** - Lightweight SQL database

---

## 📁 File Descriptions

### Core Files

| File                                                | Purpose                                   |
| --------------------------------------------------- | ----------------------------------------- |
| `app/Models/Quote.php`                              | Quote data model with fillable properties |
| `app/Http/Controllers/Api/QuoteController.php`      | API controller with CRUD methods          |
| `app/Livewire/QuotesDisplay.php`                    | Component logic (search, sort, delete)    |
| `routes/api.php`                                    | API route definitions                     |
| `routes/web.php`                                    | Web route definitions                     |
| `database/migrations/create_quotes_table.php`       | Database schema migration                 |
| `resources/views/quotes.blade.php`                  | Main layout template                      |
| `resources/views/livewire/quotes-display.blade.php` | Quote display component                   |
| `scraper/scrape.js`                                 | Web scraping script                       |

---

## 📈 Project Statistics

- **Lines of PHP Code**: ~150
- **Lines of HTML/CSS**: ~250
- **Lines of JavaScript**: ~80
- **API Endpoints**: 5
- **Database Tables**: 1
- **Livewire Components**: 1
- **Quotes Scraped**: 10+

---

## ✅ Completion Checklist

- [x] Web scraper with Puppeteer
- [x] Laravel REST API
- [x] Database migration & model
- [x] Livewire component with search
- [x] Livewire component with sort
- [x] Livewire component with delete
- [x] Beautiful responsive UI
- [x] Real-time updates
- [x] API documentation

---

## 📝 Notes

- **SQLite Database**: Data is stored in `database/database.sqlite`
- **Livewire Real-time**: Uses `wire:model.live` for instant updates
- **Responsive Design**: Works on desktop, tablet, and mobile
- **No Page Reload**: All interactions use Livewire AJAX
- **CORS Enabled**: API accessible from frontend

---

## 🎓 Learning Outcomes

This project demonstrates:

1. Full-stack web development workflow
2. Web scraping techniques
3. RESTful API design
4. Database design and migrations
5. Real-time component development
6. Responsive UI design
7. Modern PHP/Laravel practices
8. JavaScript automation

---

## 📞 Support

For issues or questions:

1. Check the API routes: `php artisan route:list`
2. Verify database: `php artisan tinker` → `Quote::all()`
3. Check Laravel logs: `storage/logs/`

---

## 📄 License

This project is open-source and available under the MIT License.

---

**Built with ❤️ using Laravel + Livewire + Puppeteer**
