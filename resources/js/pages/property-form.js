import { initValidations } from '../modules/validations';
import { initImagePreview } from '../modules/imagePreview';
import { initDeleteImage } from '../modules/deleteImage';

export function initPropertyForm() {

    if (!document.querySelector('form')) return;

    initValidations();
    initImagePreview();
    initDeleteImage();
}