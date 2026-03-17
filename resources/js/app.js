import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const dropOverlay = document.getElementById('drop-overlay');
const fileInput = document.getElementById('chat_file');
const uploadForm = document.getElementById('uploadForm');

if (dropOverlay) {

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        window.addEventListener(eventName, e => {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    window.addEventListener('dragenter', (e) => {
        dropOverlay.classList.remove('opacity-0', 'pointer-events-none');
        dropOverlay.classList.add('opacity-100');
    });


    window.addEventListener('dragleave', (e) => {
        if (e.relatedTarget === null) {
            dropOverlay.classList.remove('opacity-100');
            dropOverlay.classList.add('opacity-0', 'pointer-events-none');
        }
    });

    window.addEventListener('drop', (e) => {
        dropOverlay.classList.remove('opacity-100');
        dropOverlay.classList.add('opacity-0', 'pointer-events-none');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.name.endsWith('.txt')) {
                fileInput.files = files; 
                uploadForm.submit();
            } else {
                alert("Oups ! Veuillez déposer un fichier .txt uniquement.");
            }
        }
    });

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            uploadForm.submit();
        }
    });
}