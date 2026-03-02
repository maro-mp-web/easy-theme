import '@fontsource/inter/400.css';
import '@fontsource/inter/600.css';
import '@fontsource/inter/700.css';
import '@fontsource/playfair-display/400.css';
import '@fontsource/playfair-display/700.css';
import '../css/main.css';

import gsap from 'gsap';
import * as THREE from 'three';
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide Icons
    createIcons({ icons });

    // GSAP test
    gsap.from('h1', { duration: 1, y: -50, opacity: 0, ease: 'bounce' });

    console.log('Main JS loaded - Fonts from @fontsource are injected locally.');

    // Basic Three.js setup if there is a canvas element
    const canvas = document.querySelector('#three-canvas');
    if (canvas) {
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 200, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas, alpha: true });

        renderer.setSize(window.innerWidth, 200);
        const geometry = new THREE.BoxGeometry();
        const material = new THREE.MeshBasicMaterial({ color: 0x00ff00, wireframe: true });
        const cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        camera.position.z = 5;

        function animate() {
            requestAnimationFrame(animate);
            cube.rotation.x += 0.01;
            cube.rotation.y += 0.01;
            renderer.render(scene, camera);
        }
        animate();
    }
});
