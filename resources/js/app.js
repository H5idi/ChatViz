import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// --- Logique de Drag & Drop Ultra-Robuste ---
document.addEventListener('DOMContentLoaded', () => {
    const dropOverlay = document.getElementById('drop-overlay');
    const fileInput = document.getElementById('chat_file');
    const uploadForm = document.getElementById('uploadForm');

    if (!dropOverlay || !fileInput || !uploadForm) return;

    let dragCounter = 0;

    // Fonction pour bloquer les comportements par défaut
    const preventDefaults = (e) => {
        e.preventDefault();
        e.stopPropagation();
    };

    // On applique la prévention sur tout le window
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        window.addEventListener(eventName, preventDefaults, false);
    });

    // Effet visuel lors du survol de la fenêtre
    window.addEventListener('dragenter', (e) => {
        dragCounter++;
        if (dragCounter === 1) {
            dropOverlay.classList.remove('opacity-0', 'pointer-events-none');
            dropOverlay.classList.add('opacity-100');
        }
    });

    window.addEventListener('dragleave', (e) => {
        dragCounter--;
        if (dragCounter <= 0) {
            dragCounter = 0;
            dropOverlay.classList.remove('opacity-100');
            dropOverlay.classList.add('opacity-0', 'pointer-events-none');
        }
    });

    // Indispensable pour que le 'drop' fonctionne
    window.addEventListener('dragover', (e) => {
        e.dataTransfer.dropEffect = 'copy';
    });

    // Traitement du fichier lors du lâcher
    window.addEventListener('drop', (e) => {
        dragCounter = 0;
        dropOverlay.classList.remove('opacity-100');
        dropOverlay.classList.add('opacity-0', 'pointer-events-none');

        const files = e.dataTransfer.files;
        
        if (files && files.length > 0) {
            const file = files[0];
            
            // On vérifie l'extension .txt (insensible à la casse)
            if (file.name.toLowerCase().endsWith('.txt')) {
                // Création d'un conteneur de fichiers compatible Safari/Mac
                const container = new DataTransfer();
                container.items.add(file);
                fileInput.files = container.files;
                
                // On simule un clic ou on soumet directement
                uploadForm.submit();
            } else {
                alert("Format invalide : seul les fichiers .txt sont acceptés.");
            }
        }
    });

    // Gestion de l'input classique (si on clique sur le bouton)
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            uploadForm.submit();
        }
    });
});