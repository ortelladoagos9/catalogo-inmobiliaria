export function initDeleteProperty() {

    document.addEventListener('click', function (e) {

        // Verificar si el elemento clickeado es un botón de eliminación
        if (!e.target.classList.contains('delete-property-btn')) return;

        const button = e.target;

        const propertyId = button.dataset.id;
        const propertyTitle = button.dataset.title;
        const type = button.dataset.type;

        const formId = type === 'mobile'
            ? `delete-form-mobile-${propertyId}`
            : `delete-form-${propertyId}`;

        if (!confirm(`¿Estás seguro de que quieres eliminar la propiedad "${propertyTitle}"?\n\nEsta acción marcará la propiedad como inactiva.`)) {
            return;
        }

        document.getElementById(formId).submit();
    });
}