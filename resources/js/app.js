// resources/js/app.js

import './bootstrap';

// Importar Dropzone
import { Dropzone } from 'dropzone';
import 'dropzone/dist/dropzone.css';

// Hacer que Dropzone esté disponible globalmente
window.Dropzone = Dropzone;

// Importar Alpine.js
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
