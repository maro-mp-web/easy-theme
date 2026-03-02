<?php
/**
 * The main template file
 *
 * @package EasyTheme
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">
    <div class="test-gsap my-16 p-8 bg-white shadow-xl rounded-2xl relative overflow-hidden">
        <h1 class="text-4xl font-serif text-blue-900 mb-4 flex items-center gap-3">
            <i data-lucide="compass" class="text-blue-500 w-10 h-10"></i>
            Welcome to Easy Theme
        </h1>
        <p class="text-lg text-gray-600 mb-6 font-sans">
            This is an advanced OOP WordPress starter theme powered by Vite, Tailwind CSS, GSAP, Three.js, and Lucide Icons.
        </p>
        <div class="flex gap-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
                <i data-lucide="info"></i>
                Learn More
            </button>
            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors flex items-center gap-2">
                <i data-lucide="map"></i>
                Explore
            </button>
        </div>
    </div>

    <!-- Three.js Canvas Container -->
    <div class="my-16 rounded-2xl overflow-hidden shadow-lg bg-gray-900">
        <canvas id="three-canvas" class="w-full h-64"></canvas>
    </div>

</main>

<?php
get_footer();
