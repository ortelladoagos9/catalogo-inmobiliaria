export function initDeleteImage() {

    document.addEventListener('click', function (e) {
    
        if (!e.target.classList.contains('delete-image-btn')) return;
  
        const button = e.target;

        const imageId = button.dataset.imageId;
        const propertyId = button.dataset.propertyId;

        if (!confirm('¿Eliminar esta imagen?')) return;

        fetch(`/properties/${propertyId}/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
        })
        .then(res => {
            if (!res.ok) throw new Error('Error en request');
            return res.json();
        })
        .then(() => {
            button.closest('.relative').remove();
        })
        .catch(err => {
            console.error(err);
            alert('Error al eliminar imagen');
        });
    });
}