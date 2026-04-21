// Validación del lado del cliente
export function initValidations() {

    // Validar inputs numéricos para no permitir negativos
    const numericInputs = document.querySelectorAll('input[type="number"]');
    numericInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value < 0) {
                this.value = 0;
            }
        });

        input.addEventListener('keydown', function(e) {
            // Prevenir entrada de números negativos
            if (e.key === '-' || e.key === 'e') {
                e.preventDefault();
            }
        });
    });

    // Validar campo de calle para solo letras y espacios
    const streetInput = document.querySelector('input[name="street"]');
    if (streetInput) {
        streetInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });
    }

    // Validar título para asegurar que tenga al menos una letra
    const titleInput = document.querySelector('input[name="title"]');
    if (titleInput) {
        titleInput.addEventListener('input', function() {
            // Remover números del inicio si no hay letras
            if (!/[a-zA-Z]/.test(this.value)) {
                this.value = this.value.replace(/^\d+/, '');
            }
        });
    }
}