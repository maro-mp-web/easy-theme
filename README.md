# Easy - Starter Theme

**Easy** is an advanced, modern WordPress starter theme designed for performance and rapid development. Built with object-oriented PHP and powered by a modern front-end stack including Vite, Tailwind CSS, GSAP, Three.js, and Lucide Icons.

## Features

- **Object-Oriented PHP**: Uses PSR-4 autoloading via Composer for a clean and maintainable codebase.
- **Built-in Security & Performance**: Emojis removed, XML-RPC disabled, Rest API restricted, unnecessary head tags cleaned up.
- **Vite Setup**: Hot Module Replacement (HMR) for incredibly fast development.
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development.
- **Tailwind to Gutenberg Sync**: Automatically restricts the WordPress Editor color palette sizes to your Tailwind setup to prevent user design breaks!
- **Tailwind Image Breakpoints**: Dynamically adds WordPress image resizer points matching SM, MD, LG, and XL logic!
- **.env Support**: Keeps your API keys (Google Maps, Stripe, etc.) secure using `vlucas/phpdotenv`.
- **Pre-commit Hooks & Formatting**: Keeps your codebase beautifully clean using Husky, Lint-Staged, and Prettier (including PHP!). It automatically reformats code upon `git commit`.
- **WP-CLI Block Generator**: Instantly generate ACF/SCF Block Boilerplates (`block.json` & PHP templates).
- **Auto-loading Gutenberg Blocks**: You NEVER need to register blocks manually! The theme dynamically scans `template-parts/blocks/` and registers every `block.json` it finds upon WP Init!
- **SVG Helper Component**: Safely and easily load inline SVGs directly from the theme.
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
If you are building a blog and you _need_ RSS feeds, or you are building a headless setup and _need_ the public REST API, you can easily toggle these settings by commenting out the respective lines inside the `register()` method located in `inc/Setup/Security.php`.

## SVGs & Local Helpers

To safely embed an object-oriented SVG into your template without generic HTML image tags, use the built-in helper. Just point to any SVG stored inside `/assets/images/`:

```php
echo \EasyTheme\Helpers\Svg::render('icon-name', 'w-6 h-6 text-blue-500');
```

## Secure Custom Fields (SCF) / ACF Integration

This theme is pre-configured to automatically save and load SCF/ACF field groups directly inside the `acf-json/` directory.
By keeping your fields in JSON format, they are fully trackable via Git, allowing your team to sync CPT metas, options pages, and blocks without touching databases.

**Note on Custom Post Types**: With modern versions of SCF (and ACF 6.1+), you can now natively create Custom Post Types and Taxonomies securely through the plugin UI. Since these register directly into the `acf-json` sync, using a boilerplate PHP class for CPTs is highly discouraged in Easy Theme. Let the plugin handle the heavy lifting!

## CLI Core Generators

This starter theme supercharges development by bundling its own WP-CLI commands capable of scaffolding SCF/ACF Gutenberg blocks instantly. If you have WP-CLI installed globally, simply navigate to your WordPress installation via terminal and run:

**Generate a Custom SCF Block:**

```bash
wp easy make:block HeroSection
```

This automatically generates a proper `block.json` and a fresh OOP-ready PHP structure in `template-parts/blocks/hero-section/`. Since we built an **Auto-Loader**, you DO NOT need to write any PHP to register this block! The theme scans `template-parts/blocks/` and injects the `block.json` file instantly.

## Pre-commit Hooks

This theme guarantees high-quality, readable code by integrating **Husky**, **Lint-Staged**, and **Prettier** (with `@prettier/plugin-php`).
Whenever you or your team runs `git commit`, Husky will automatically intercept the process, format any modified `*.php`, `*.js`, or `*.css` files, and then successfully commit them beautifully structured.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[GPL v2 or later](http://www.gnu.org/licenses/gpl-2.0.html)
