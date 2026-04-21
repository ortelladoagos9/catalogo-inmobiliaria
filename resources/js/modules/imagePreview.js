// Preview de imágenes nuevas
export function initImagePreview() {

    const imagesInput = document.getElementById('images-input');
    const imagesPreview = document.getElementById('images-preview');

    if (!imagesInput || !imagesPreview) return;

    imagesInput.addEventListener('change', function () {

        imagesPreview.innerHTML = '';

        if (this.files.length === 0) {
            imagesPreview.classList.add('hidden');
            return;
        }

        imagesPreview.classList.remove('hidden');

        Array.from(this.files).forEach((file, index) => {

            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {

                const container = document.createElement('div');
                container.className = 'relative group';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-20 h-20 object-cover rounded-lg border border-white/20';

                const btn = document.createElement('button');
                btn.type = 'button';
                btn.innerHTML = '×';
                btn.className = 'absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs opacity-0 group-hover:opacity-100 flex items-center justify-center';

                btn.onclick = function () {

                    const dt = new DataTransfer();
                    const files = Array.from(imagesInput.files);

                    files.splice(index, 1);

                    files.forEach(f => dt.items.add(f));
                    imagesInput.files = dt.files;

                    container.remove();

                    if (imagesInput.files.length === 0) {
                        imagesPreview.classList.add('hidden');
                    }
                };

                container.appendChild(img);
                container.appendChild(btn);
                imagesPreview.appendChild(container);
            };

            reader.readAsDataURL(file);
        });
    });
}