/**
 * parser.js
 * Responsabilité : Lire un fichier .txt WhatsApp et transformer
 * le texte brut en un tableau d'objets JS structurés.
 * (Privacy First : tout se passe dans le navigateur, rien n'est envoyé)
 */

// Le motif d'une ligne WhatsApp : [DATE HEURE] AUTEUR: MESSAGE
const WHATSAPP_REGEX = /^\[(\d{2}\/\d{2}\/\d{4}),?\s(\d{2}:\d{2}:\d{2})\]\s([^:]+):\s(.+)$/;

/**
 * Prend un fichier File et retourne une Promise qui résout
 * avec un tableau de messages structurés.
 *
 * @param {File} file - Le fichier .txt WhatsApp
 * @returns {Promise<Array>} - Tableau d'objets { date, heure, auteur, message }
 */
export function parseChat(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = (event) => {
            const texte = event.target.result;
            const messages = [];

            // On découpe le texte ligne par ligne (compatible Windows \r\n et Mac \n)
            const lignes = texte.split(/\r?\n/);

            lignes.forEach((ligne) => {
                // .trim() enlève les espaces et \r invisibles pour que la regex fonctionne
                const match = ligne.trim().match(WHATSAPP_REGEX);
                if (match) {
                    messages.push({
                        date: match[1], // ex: "28/01/2025"
                        heure: match[2], // ex: "09:53:30"
                        auteur: match[3], // ex: "Elias"
                        message: match[4], // ex: "J'ai merge dans la branche dev"
                    });
                }
            });

            console.log(`[ChatViz] Parsing terminé : ${messages.length} messages extraits.`);
            resolve(messages);
        };

        reader.onerror = () => {
            reject(new Error('Impossible de lire le fichier.'));
        };

        reader.readAsText(file);
    });
}
