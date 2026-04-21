import './bootstrap';
import { initPropertyForm } from './pages/property-form';
import { initPropertyIndex } from './pages/property-index';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    initPropertyForm();
    initPropertyIndex();

});