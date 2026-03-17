<x-app-layout>
    <!-- Overlay de Drag & Drop (Global sur le Dashboard) -->
    <div id="drop-overlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-indigo-600/20 backdrop-blur-md border-4 border-dashed border-indigo-500 m-6 rounded-3xl pointer-events-none opacity-0 transition-opacity duration-300">
        <div class="text-center">
            <div class="bg-indigo-500 text-white p-6 rounded-full shadow-2xl mb-4 inline-block animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 7.5 7.5M12 3v13.5" />
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-white text-shadow-lg">Lâchez votre fichier ici</h2>
            <p class="text-indigo-200 mt-2 text-lg">Analysez cette conversation immédiatement</p>
        </div>
    </div>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- En-tête de section -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">
                        Bonjour, <span class="gradient-text">{{ explode(' ', Auth::user()->name)[0] }}</span> 👋
                    </h2>
                    <p class="text-slate-400 text-lg">Prêt à décrypter vos conversations ?</p>
                </div>

                <!-- Formulaire d'import rapide -->
                <form action="/analyze" method="POST" enctype="multipart/form-data" id="uploadForm" class="flex-shrink-0">
                    @csrf
                    <input type="file" name="chat_file" id="chat_file" class="hidden" accept=".txt">
                    <label for="chat_file" class="btn-primary px-8 py-4 rounded-full font-bold flex items-center gap-3 cursor-pointer hover:scale-105 transition transform shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Nouvelle Analyse
                    </label>
                </form>
            </div>

            <!-- Grille de Contenu -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Colonne Principale : Historique / Analyses -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="glass p-8 rounded-[2.5rem] border border-white/5 shadow-2xl">
                        <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
                            <span class="size-2 bg-indigo-500 rounded-full animate-pulse"></span>
                            Mes Importations Récentes
                        </h3>

                        @if(empty($files))
                            <div class="flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-white/5 rounded-3xl">
                                <div class="size-16 bg-white/5 rounded-full flex items-center justify-center mb-4 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <p class="text-slate-500 font-medium">Aucun fichier importé pour le moment.</p>
                                <p class="text-slate-600 text-sm mt-1">Glissez un fichier .txt n'importe où pour commencer.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($files as $file)
                                    <div class="group relative flex items-center justify-between p-5 rounded-2xl bg-white/5 border border-white/5 hover:bg-white/10 hover:border-indigo-500/30 transition-all cursor-pointer">
                                        <div class="flex items-center gap-5">
                                            <div class="size-12 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-200">{{ $file['name'] }}</h4>
                                                <p class="text-xs text-slate-500 mt-1">
                                                    <span>{{ $file['date'] }}</span>
                                                    <span class="mx-2">•</span>
                                                    <span>{{ $file['size'] }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <button class="bg-indigo-500 hover:bg-indigo-400 text-white px-5 py-2 rounded-xl text-sm font-bold opacity-0 group-hover:opacity-100 transition-all shadow-lg transform translate-x-4 group-hover:translate-x-0">
                                                Voir
                                            </button>
                                            
                                            <form action="{{ route('delete-chat') }}" method="POST" onsubmit="return confirm('Supprimer cette analyse définitivement ?');">
                                                @csrf
                                                <input type="hidden" name="path" value="{{ $file['path'] }}">
                                                <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2 rounded-xl opacity-0 group-hover:opacity-100 transition-all border border-red-500/20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Colonne Latérale : Statistiques Rapides -->
                <div class="space-y-8">
                    <div class="glass p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                        <div class="absolute -top-10 -right-10 size-40 bg-indigo-500/10 blur-3xl rounded-full group-hover:bg-indigo-500/20 transition-all"></div>
                        
                        <h4 class="text-sm font-bold uppercase tracking-widest text-slate-500 mb-6 font-mono">Statistiques Globales</h4>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="block text-2xl font-bold text-white">{{ count($files) }}</span>
                                <span class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">Analyses</span>
                            </div>
                            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                                <span class="block text-2xl font-bold text-indigo-400">100%</span>
                                <span class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">Sécurisé</span>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/5">
                            <h5 class="text-xs font-bold text-slate-400 mb-4 uppercase">Astuce du jour</h5>
                            <p class="text-sm text-slate-500 italic">
                                "Pour une analyse parfaite, assurez-vous que votre fichier est exporté 'Sans médias' depuis WhatsApp."
                            </p>
                        </div>
                    </div>

                    <div class="glass p-8 rounded-[2.5rem] border border-white/5 shadow-2xl bg-indigo-600/5">
                        <h4 class="font-bold text-slate-200 mb-4">Besoin d'aide ?</h4>
                        <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                            Vous ne savez pas comment récupérer votre fichier WhatsApp ? Consultez notre guide étape par étape.
                        </p>
                        <a href="{{ route('about') }}" class="text-indigo-400 text-sm font-bold hover:underline flex items-center gap-2">
                            Voir le guide
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
