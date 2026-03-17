<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ChatViz - Analysez vos conversations WhatsApp</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-950 text-white min-h-screen overflow-x-hidden">
        
        <div id="drop-overlay" class="fixed inset-0 z-[100] flex items-center justify-center bg-indigo-600/20 backdrop-blur-md border-4 border-dashed border-indigo-500 m-6 rounded-3xl pointer-events-none opacity-0 transition-opacity duration-300">
            <div class="text-center">
                <div class="bg-indigo-500 text-white p-6 rounded-full shadow-2xl mb-4 inline-block animate-bounce">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 7.5 7.5M12 3v13.5" />
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-white text-shadow-lg">Lâchez votre fichier ici</h2>
                <p class="text-indigo-200 mt-2 text-lg">Analyse immédiate de votre conversation WhatsApp</p>
            </div>
        </div>

        <nav class="fixed top-0 w-full z-50 px-6 py-4 bg-slate-950/80 backdrop-blur-xl border-b border-white/5">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="text-2xl font-bold tracking-tight">
                    <span class="gradient-text">ChatViz</span>
                </div>

                <div class="flex items-center gap-8">
                    <div class="hidden md:flex gap-6 text-sm font-medium text-slate-400">
                        <a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a>
                        <a href="{{ route('about') }}" class="hover:text-white transition">À propos</a>
                        <a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a>
                    </div>

                    <div class="hidden md:block h-4 w-px bg-white/10 mx-2"></div>

                    <div class="flex gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-indigo-400 transition">Tableau de bord</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium px-4 py-2 rounded-full hover:bg-white/5 transition">Connexion</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary text-sm font-bold px-6 py-2 rounded-full shadow-lg">S'inscrire</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <section class="relative min-h-screen flex items-center justify-center py-20 overflow-hidden">
    
        @guest
            <div class="absolute inset-0 z-0 opacity-30 blur-2xl pointer-events-none select-none scale-105">
                <div class="max-w-5xl mx-auto px-6 py-12 flex flex-col gap-12">
                    <div class="h-12 w-48 bg-slate-800 rounded-2xl mx-auto"></div>
                    <div class="grid grid-cols-1 gap-10">
                        <div class="h-64 glass rounded-[3rem] border border-white/5"></div>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="h-40 glass rounded-[2.5rem] border border-white/5"></div>
                            <div class="h-40 glass rounded-[2.5rem] border border-white/5"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endguest

        <div class="relative z-10 flex flex-col items-center justify-center px-6 text-center max-w-4xl w-full">
            
            @auth
                <div class="space-y-10">
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tight leading-tight">
                        Bonjour, <br>
                        <span class="gradient-text">{{ explode(' ', Auth::user()->name)[0] }}</span> 👋
                    </h1>
                    <a href="{{ route('dashboard') }}" class="btn-primary px-10 py-5 rounded-full text-lg font-bold shadow-2xl hover:scale-105 transition transform inline-block">
                        Accéder au Tableau de Bord
                    </a>
                </div>
            @else
                <div class="glass p-10 md:p-16 rounded-[4rem] border border-white/10 shadow-[0_0_100px_rgba(79,70,229,0.25)] backdrop-blur-3xl w-full flex flex-col items-center gap-12">
                    
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.1] text-white">
                        Le verdict de votre <br>
                        <span class="gradient-text">relation WhatsApp</span>
                    </h1>
                    
                    <div class="space-y-6">
                        <p class="text-base md:text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
                            Obtenez des statistiques précises et un portrait robot de vos conversations grâce à l'alliance de nos <span class="italic font-medium">algorithmes</span> et de notre <span class="italic font-medium">IA</span>.
                        </p>
                        <div class="inline-flex px-5 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 font-medium text-xs md:text-sm">
                            100% sécurisé : vos données ne quittent jamais votre navigateur.
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-10 w-full">
                        <a href="{{ route('register') }}" class="btn-primary w-full sm:w-auto px-12 py-5 rounded-full text-xl font-bold shadow-xl flex items-center justify-center gap-4 hover:scale-105 transition transform group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 7.5 7.5M12 3v13.5" />
                            </svg>
                            Importer ma conversation
                        </a>
                        
                        <div class="flex flex-col items-center gap-3">
                            <div class="flex -space-x-3">
                                <div class="size-9 rounded-full border-2 border-slate-950 bg-indigo-500"></div>
                                <div class="size-9 rounded-full border-2 border-slate-950 bg-purple-500"></div>
                                <div class="size-9 rounded-full border-2 border-slate-950 bg-pink-500"></div>
                            </div>
                            <span class="text-xs text-slate-500 font-medium italic">Déjà +1,000 analyses effectuées aujourd'hui</span>
                        </div>
                    </div>
                </div>
            @endauth

        </div>

        <div class="fixed top-0 left-0 -translate-x-1/2 -translate-y-1/2 size-[500px] bg-indigo-600/10 blur-[120px] rounded-full pointer-events-none z-[-1]"></div>
        <div class="fixed bottom-0 right-0 translate-x-1/2 translate-y-1/2 size-[500px] bg-purple-600/10 blur-[120px] rounded-full pointer-events-none z-[-1]"></div>
    </section>

        <footer class="relative z-10 bg-slate-950 border-t border-white/5 pt-20 pb-10 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
                <div class="md:col-span-2">
                    <div class="text-2xl font-bold tracking-tight mb-6">
                        <span class="gradient-text">ChatViz</span>
                    </div>
                    <p class="text-slate-400 max-w-sm leading-relaxed">
                        L'outil ultime pour comprendre vos dynamiques de chat. Analysez, visualisez et protégez vos interactions sociales en un clic.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Navigation</h4>
                    <ul class="flex flex-col gap-4 text-slate-400 text-sm">
                        <li><a href="{{ route('menu') }}" class="hover:text-indigo-400 transition">Menu</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-indigo-400 transition">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-indigo-400 transition">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Sécurité</h4>
                    <ul class="flex flex-col gap-4 text-slate-400 text-sm">
                        <li>
                            <a href="{{ route('safe-zone') }}" class="text-red-500 font-bold hover:text-red-400 flex items-center gap-2 group transition">
                                <span class="size-2 bg-red-500 rounded-full group-hover:animate-ping"></span>
                                SAFE ZONE
                            </a>
                        </li>
                        <li><span class="italic text-slate-500">Protection des données OK</span></li>
                        <li><span class="italic text-slate-500">Conformité RGPD OK</span></li>
                    </ul>
                </div>
            </div>

            <div class="max-w-7xl mx-auto pt-10 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6 text-slate-500 text-xs">
                <div class="flex items-center gap-2">
                    <span>&copy; {{ date('Y') }} ChatViz Team.</span>
                    <span class="h-3 w-px bg-white/10"></span>
                    <span>Tous droits réservés.</span>
                </div>
                <div class="flex gap-6">
                    <span class="text-indigo-400 font-semibold tracking-widest text-[10px] uppercase">Fait avec ❤️ par l'Équipe ChatViz</span>
                </div>
            </div>
        </footer>

        <div class="fixed top-0 left-0 -translate-x-1/2 -translate-y-1/2 size-[600px] bg-indigo-600/10 blur-[150px] rounded-full pointer-events-none"></div>
        <div class="fixed bottom-0 right-0 translate-x-1/2 translate-y-1/2 size-[600px] bg-pink-600/10 blur-[150px] rounded-full pointer-events-none"></div>

    </body>
</html>