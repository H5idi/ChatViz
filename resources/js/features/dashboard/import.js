/**
 * import.js
 * Responsabilité : Gérer uniquement l'interface utilisateur du Drag & Drop
 * et du bouton d'importation. Délègue le parsing à parser.js.
 */

import { parseChat } from './parser.js';

/**
 * Fonction utilitaire : affiche ou cache l'overlay de drop.
 */
function setOverlayVisible(overlay, visible) {
    if (visible) {
        overlay.classList.remove('opacity-0', 'pointer-events-none');
        overlay.classList.add('opacity-100');
    } else {
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0', 'pointer-events-none');
    }
}

/**
 * Traite un fichier File : vérifie l'extension, lance le parsing.
 */
async function handleFile(file) {
    if (!file.name.toLowerCase().endsWith('.txt')) {
        alert('Format invalide : seul les fichiers .txt sont acceptés.');
        return;
    }

    const messages = await parseChat(file);

    // Pour l'instant on affiche dans la console.
    // Prochaine étape : on passera les données aux fonctions de stats et de rendu.
    console.log('[ChatViz] Données prêtes :', messages);
}

/**
 * Initialise tous les événements Drag & Drop et le bouton d'import.
 */
export function initImport() {
    const dropOverlay = document.getElementById('drop-overlay');
    const fileInput   = document.getElementById('chat_file');

    if (!dropOverlay || !fileInput) return;

    let dragCounter = 0;

    // --- Blocage des comportements par défaut du navigateur ---
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        window.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    // --- Apparition de l'overlay ---
    window.addEventListener('dragenter', () => {
        dragCounter++;
        if (dragCounter === 1) setOverlayVisible(dropOverlay, true);
    });

    window.addEventListener('dragleave', () => {
        dragCounter--;
        if (dragCounter <= 0) {
            dragCounter = 0;
            setOverlayVisible(dropOverlay, false);
        }
    });

    // Nécessaire pour autoriser le "drop"
    window.addEventListener('dragover', (e) => {
        e.dataTransfer.dropEffect = 'copy';
    });

    // --- Réception du fichier par glisser-déposer ---
    window.addEventListener('drop', (e) => {
        dragCounter = 0;
        setOverlayVisible(dropOverlay, false);

        const files = e.dataTransfer.files;
        if (files && files.length > 0) {
            handleFile(files[0]);
        }
    });

    // --- Réception du fichier via le bouton d'importation ---
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            handleFile(fileInput.files[0]);
        }
    });
}