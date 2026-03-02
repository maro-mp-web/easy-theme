# Easy - Starter Theme

**Easy** is an advanced, modern WordPress starter theme designed for performance and rapid development. Built with object-oriented PHP and powered by a modern front-end stack including Vite, Tailwind CSS, GSAP, Three.js, and Lucide Icons.

## Features

- **Object-Oriented PHP**: Uses PSR-4 autoloading via Composer for a clean and maintainable codebase.
- **Built-in Security & Performance**: Emojis removed, XML-RPC disabled, Rest API restricted, unnecessary head tags cleaned up.
- **Vite Setup**: Hot Module Replacement (HMR) for incredibly fast development.
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development.
- **GSAP**: Robust JavaScript animation library.
- **Three.js**: Included setup for high-end 3D graphics on the web.
- **Lucide Icons**: Clean, consistent, and beautiful SVG icons.
- **Local Typography**: Uses `@fontsource` to load fonts locally for privacy and performance.

## Requirements

- PHP >= 8.0
- Composer
- Node.js & npm / yarn

## Installation & Setup

1. **Clone the repository** into your WordPress `wp-content/themes` directory:
   ```bash
   git clone https://github.com/yourusername/easy-theme.git easy-theme
   cd easy-theme
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**:
   ```bash
   npm install
   ```

## Development

To start the Vite development server with Hot Module Replacement:

```bash
npm run watch
# or
npm run dev
```

Vite runs on port `5173` by default. The theme automatically detects the development server and proxies assets appropriately.

## Production Build

To compile and minify assets for production, run:

```bash
npm run build
```

This will generate a `dist` folder inside your theme directory with optimized assets. The theme will automatically switch to using these production files if the Vite dev server is not running.

## Directory Structure

```text
easy-theme/
├── inc/                    # OOP Core functionality (EasyTheme namespace)
│   ├── Core/
│   │   └── Init.php        # Service registration
│   └── Setup/
│       ├── ThemeSupport.php# WP theme supports setup
│       └── Enqueue.php     # Asset enqueueing (Vite logic)
├── src/                    # Source front-end assets
│   ├── css/
│   │   └── main.css        # Tailwind directives
│   └── js/
│       └── main.js         # Main entry point (GSAP, Three.js, Lucide)
├── composer.json           # PHP dependencies & PSR-4 autoload
├── package.json            # Node.js dependencies & scripts
├── vite.config.js          # Vite bundler configuration
├── tailwind.config.js      # Tailwind configuration
├── style.css               # Required WP stylesheet
├── functions.php           # Autoloader & Theme initialization
├── index.php               # Main view template
├── header.php              # Header view template
└── footer.php              # Footer view template
```

## Security & Performance Optimizations

This starter theme includes a `Security` class (`inc/Setup/Security.php`) that automatically applies several best practices to harden your WordPress installation and improve frontend performance. By default it features:

1. **Emojis Disabled**: Removes the extra JS and CSS WordPress loads for older browser emoji support.
2. **XML-RPC Disabled**: Blocks `xmlrpc.php` to prevent proxy brute-force and DDoS attacks.
3. **RSS Feeds Disabled**: If you are building a corporate site or web app, removing feeds prevents content scraping.
4. **REST API Restricted**: The WP REST API is restricted strictly to logged-in users only to prevent user enumeration (`/wp-json/wp/v2/users`).
5. **Head Meta Cleanup**: Removes generator tags (WP Version), RSD links, WLW Manifest, and Shortlinks.
6. **File Editor Disabled**: Automatically defines `DISALLOW_FILE_EDIT` to prevent editing PHP files directly through the WP Admin dashboard.

**How to change this?**
If you are building a blog and you *need* RSS feeds, or you are building a headless setup and *need* the public REST API, you can easily toggle these settings by commenting out the respective lines inside the `register()` method located in `inc/Setup/Security.php`.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[GPL v2 or later](http://www.gnu.org/licenses/gpl-2.0.html)
