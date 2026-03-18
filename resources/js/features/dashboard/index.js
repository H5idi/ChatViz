/**
 * index.js
 * Point d'entrée du module Dashboard.
 * Son seul rôle : importer et démarrer chaque fonctionnalité dans le bon ordre.
 *
 * Prochaines fonctionnalités à ajouter ici :
 *   - import { initStats }  from './stats.js';
 *   - import { initCharts } from './charts.js';
 */

import { initImport } from './import.js';

document.addEventListener('DOMContentLoaded', () => {
    initImport();
});