import { initDeleteProperty } from '../modules/deleteProperty';

export function initPropertyIndex() {

    if (!document.querySelector('.delete-property-btn')) return;

    initDeleteProperty();
}