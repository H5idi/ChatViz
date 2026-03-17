<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ChatViz - Analysez vos conversations WhatsApp</title>

        <!-- Polices -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased bg-slate-950 text-white min-h-screen">
        
        <!-- Navigation -->
        <nav x-data="{ mobileMenuOpen: false }" class="fixed top-0 w-full z-50 px-6 py-4 bg-slate-950/50 backdrop-blur-xl border-b border-white/5">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="z-50">
                    <x-application-logo class="h-10 w-auto" />
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-8">
                    <div class="flex gap-6 text-sm font-medium text-slate-400">
                        <a href="{{ route('menu') }}" class="hover:text-white transition">Menu</a>
                        <a href="{{ route('about') }}" class="hover:text-white transition">À propos</a>
                        <a href="{{ route('contact') }}" class="hover:text-white transition flex items-center gap-2">
                            Contact
                            <span class="text-[10px] bg-red-500/10 text-red-500 px-2 py-0.5 rounded-full border border-red-500/20">Anti-Cyberharcèlement</span>
                        </a>
                    </div>

                    <div class="h-4 w-px bg-white/10 mx-2"></div>

                    <div class="flex gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-indigo-400 transition">Mon Tableau de bord</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium px-4 py-2 rounded-full hover:bg-white/5 transition">Connexion</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary text-sm font-bold px-6 py-2 rounded-full shadow-lg">S'inscrire</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden z-50 text-slate-400 hover:text-white transition">
                    <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Mobile Menu Overlay -->
                <div x-show="mobileMenuOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-x-full"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 translate-x-full"
                     class="fixed inset-0 bg-slate-950 flex flex-col justify-center items-center gap-8 z-40 md:hidden">
                    <a @click="mobileMenuOpen = false" href="{{ route('menu') }}" class="text-2xl font-bold hover:text-indigo-400">Menu</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('about') }}" class="text-2xl font-bold hover:text-indigo-400">À propos</a>
                    <a @click="mobileMenuOpen = false" href="{{ route('contact') }}" class="text-2xl font-bold hover:text-indigo-400 text-center">
                        Contact<br>
                        <span class="text-xs text-red-500 uppercase tracking-widest">Anti-Cyberharcèlement</span>
                    </a>
                    <div class="h-px w-24 bg-white/10"></div>
                    @auth
                        <a @click="mobileMenuOpen = false" href="{{ url('/dashboard') }}" class="text-xl font-bold text-indigo-400">Tableau de bord</a>
                    @else
                        <a @click="mobileMenuOpen = false" href="{{ route('login') }}" class="text-xl font-bold">Connexion</a>
                        <a @click="mobileMenuOpen = false" href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-full text-xl font-bold">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Contenu Hero -->
        <section class="relative min-h-screen flex flex-col items-center justify-center pt-20">
            <!-- Aperçu du Dashboard en arrière-plan (Flouté) -->
            <div class="dashboard-preview absolute inset-0 grid grid-cols-1 md:grid-cols-3 gap-6 p-12 opacity-30 pt-32">
                <!-- Fausses cartes -->
                <div class="h-64 glass rounded-3xl p-6 flex flex-col justify-between">
                    <div class="h-4 w-24 bg-indigo-500/30 rounded-full"></div>
                    <div class="space-y-3">
                        <div class="h-8 w-full bg-slate-800 rounded-lg"></div>
                        <div class="h-8 w-2/3 bg-slate-800 rounded-lg"></div>
                    </div>
                </div>
                <div class="h-64 glass rounded-3xl p-6 flex flex-col justify-between border-indigo-500/20">
                    <div class="flex justify-center flex-1 items-center">
                        <div class="h-32 w-32 border-8 border-indigo-500/20 rounded-full border-t-indigo-500"></div>
                    </div>
                    <div class="h-4 w-1/2 bg-indigo-500/30 rounded-full mx-auto"></div>
                </div>
                <div class="h-64 glass rounded-3xl p-6 flex flex-col justify-between">
                    <div class="h-4 w-24 bg-indigo-500/30 rounded-full"></div>
                    <div class="space-y-3">
                        <div class="h-8 w-full bg-slate-800 rounded-lg"></div>
                        <div class="h-8 w-2/3 bg-slate-800 rounded-lg"></div>
                    </div>
                </div>
                <div class="md:col-span-2 h-80 glass rounded-3xl p-6 relative overflow-hidden">
                    <div class="absolute inset-0 flex items-end p-6 gap-2">
                        <div class="h-1/2 w-8 bg-indigo-500/50 rounded-t"></div>
                        <div class="h-2/3 w-8 bg-purple-500/50 rounded-t"></div>
                        <div class="h-1/3 w-8 bg-indigo-500/50 rounded-t"></div>
                        <div class="h-3/4 w-8 bg-purple-500/50 rounded-t"></div>
                        <div class="h-1/2 w-8 bg-indigo-500/50 rounded-t"></div>
                        <div class="h-full w-8 bg-pink-500/50 rounded-t"></div>
                    </div>
                </div>
            </div>

            <!-- Contenu Principal (Centré & Net) -->
            <div class="relative z-10 flex flex-col items-center justify-center px-6 text-center max-w-5xl">
                <h1 class="text-5xl md:text-8xl font-bold tracking-tight mb-8 leading-[1]">
                    Le verdict de votre <br>
                    <span class="gradient-text">relation WhatsApp</span>
                </h1>
                
                <p class="text-lg md:text-2xl text-slate-400 max-w-3xl mb-12 leading-relaxed">
                    Obtenez des statistiques précises et un portrait robot de vos conversations grâce à l'alliance de nos <span class="text-white font-medium italic">algorithmes</span> et de notre <span class="text-white font-medium italic">IA</span>. <br>
                    <span class="text-indigo-400 font-semibold bg-indigo-400/10 px-4 py-1 rounded-full border border-indigo-400/20">100% sécurisé : vos données ne quittent jamais votre navigateur.</span>
                </p>

                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="{{ route('register') }}" class="btn-primary px-10 py-5 rounded-full text-xl font-bold shadow-2xl flex items-center justify-center gap-3 hover:scale-105 transition transform">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 7.5 7.5M12 3v13.5" />
                        </svg>
                        Importer ma conversation
                    </a>
                </div>

                <div class="mt-12 flex items-center gap-4 text-sm text-slate-500">
                    <div class="flex -space-x-3">
                        <div class="size-10 rounded-full border-2 border-slate-950 bg-indigo-500"></div>
                        <div class="size-10 rounded-full border-2 border-slate-950 bg-purple-500"></div>
                        <div class="size-10 rounded-full border-2 border-slate-950 bg-pink-500"></div>
                    </div>
                    <span class="font-medium italic">Déjà +1,000 analyses effectuées aujourd'hui</span>
                </div>
            </div>
        </section>

        <!-- Pied de page (Footer) -->
        <footer class="relative z-10 bg-slate-950 border-t border-white/5 pt-20 pb-10 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <x-application-logo class="h-10 w-auto mb-6" />
                    <p class="text-slate-400 max-w-sm leading-relaxed">
                        L'outil ultime pour comprendre vos dynamiques de chat. Analysez, visualisez et protégez vos interactions sociales en un clic.
                    </p>
                </div>

                <!-- Navigation -->
                <div>
                    <h4 class="text-white font-bold mb-6">Navigation</h4>
                    <ul class="flex flex-col gap-4 text-slate-400 text-sm">
                        <li><a href="{{ route('menu') }}" class="hover:text-indigo-400 transition">Menu</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-indigo-400 transition">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-indigo-400 transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Légal & Sécurité -->
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

            <!-- Bas de page -->
            <div class="max-w-7xl mx-auto pt-10 border-t border-white/5 flex flex-col md:row items-center justify-between gap-6 text-slate-500 text-xs">
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

        <!-- Éléments décoratifs flottants -->
        <div class="fixed top-0 left-0 -translate-x-1/2 -translate-y-1/2 size-[600px] bg-indigo-600/10 blur-[150px] rounded-full pointer-events-none"></div>
        <div class="fixed bottom-0 right-0 translate-x-1/2 translate-y-1/2 size-[600px] bg-pink-600/10 blur-[150px] rounded-full pointer-events-none"></div>

    </body>
</html>
