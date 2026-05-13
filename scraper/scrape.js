const puppeteer = require('puppeteer');
const axios = require('axios');


const API_URL = "http://localhost:8000/api/quotes";

// Function to scrape quotes from the website

async function scrapeQuotes() {
    console.log("Scraping quotes is started...");

    let browser;

    try {
        // launch browser 
        console.log("Launching the headless browser ...");

        browser = await puppeteer.launch({
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        })

        //  creating a new page 
        const page = await browser.newPage();

        // visting the website
        console.log("Visiting the website ... [https://quotes.toscrape.com/]");
        await page.goto('https://quotes.toscrape.com/', {
            waitUntil: 'networkidle2'
        });

        //  extract quotes data form the page 
        console.log("Extracting quotes data from the page ...");
        const quotes = await page.evaluate(() => {
            const quoteElements = document.querySelectorAll('.quote');
            const extractedQuotes = [];

            quoteElements.forEach((element) => {
                const quoteText = element.querySelector('.text')?.innerText.replace(/[""]/g, "");

                const authorName = element.querySelector('.author')?.innerText.replace("by ", "");

                // only added when both exists 
                if (quoteText && authorName) {
                    extractedQuotes.push({
                        quote: quoteText,
                        author: authorName,
                    });
                }
            });
            return extractedQuotes;
        });

        console.log(`\n✅ Successfully extracted ${quotes.length} quotes!\n`);
        console.log(" Quotes Found:");
        console.log(JSON.stringify(quotes, null, 2));

        console.log("\nSending quotes data to the laravel API ...");

        for (const quote of quotes) {
            try {
                const response = await axios.post(API_URL, quote);
                console.log(`✓ Saved: "${quote.quote.substring(0, 50)}..."`);
            } catch (error) {
                console.error(
                    `✗ Error saving quote: ${error.response?.data?.message || error.message}`,
                );
            }
        }
        console.log("All quotes has saved ");
        
    } catch (error) {
    console.error("❌ Error occurred:", error.message);
    console.error("  3. API endpoint exists: POST /api/quotes");
  } finally {
    // Step 7: Close browser
    if (browser) {
      await browser.close();
      console.log("🔌 Browser closed.\n");
    }
  }
}

// Run the scraper
scrapeQuotes();