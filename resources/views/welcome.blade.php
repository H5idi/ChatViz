<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ChatViz - Analysez vos conversations WhatsApp</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased bg-slate-950 text-white overflow-hidden">
        
        <!-- Navigation -->
        <nav class="absolute top-0 w-full z-50 px-6 py-4 flex justify-between items-center bg-transparent">
            <div class="text-2xl font-bold tracking-tight">
                <span class="gradient-text">ChatViz</span>
            </div>
            <div class="flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-indigo-400 transition">Mon Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium border border-indigo-500/50 px-4 py-2 rounded-full hover:bg-indigo-500/10 transition">Connexion</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-medium border border-indigo-500/50 px-4 py-2 rounded-full hover:bg-indigo-500/10 transition">S'inscrire</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Background Dashboard Preview (Blurred) -->
        <div class="dashboard-preview absolute inset-0 grid grid-cols-1 md:grid-cols-3 gap-6 p-12 opacity-40">
            <!-- Mock Cards -->
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
            <div class="h-80 glass rounded-3xl p-6 border-pink-500/20">
                <div class="h-20 w-20 bg-pink-500/20 rounded-2xl mb-4"></div>
                <div class="space-y-3">
                    <div class="h-4 w-full bg-slate-800 rounded-full"></div>
                    <div class="h-4 w-full bg-slate-800 rounded-full"></div>
                    <div class="h-4 w-2/3 bg-slate-800 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Hero Content (Centered & Clear) -->
        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 text-center">
            <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-6 leading-[1.1]">
                Le verdict de votre <br>
                <span class="gradient-text">relation WhatsApp</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-400 max-w-2xl mb-10 leading-relaxed">
                Obtenez des statistiques précises et un portrait robot de vos conversations grâce à notre IA. <br>
                <span class="text-indigo-400 font-semibold">100% sécurisé : vos données ne quittent jamais votre navigateur.</span>
            </p>

            <a href="{{ route('register') }}" class="btn-primary px-8 py-4 rounded-full text-lg font-bold shadow-xl flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 7.5 7.5M12 3v13.5" />
                </svg>
                Importer ma conversation
            </a>

            <div class="mt-8 flex items-center gap-4 text-sm text-slate-500">
                <div class="flex -space-x-2">
                    <div class="size-8 rounded-full border-2 border-slate-950 bg-indigo-500"></div>
                    <div class="size-8 rounded-full border-2 border-slate-950 bg-purple-500"></div>
                    <div class="size-8 rounded-full border-2 border-slate-950 bg-pink-500"></div>
                </div>
                <span>Déjà +1,000 analyses effectuées aujourd'hui</span>
            </div>
        </div>

        <!-- Floating Decorative Elements -->
        <div class="absolute -top-24 -left-24 size-96 bg-indigo-600/20 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 size-96 bg-pink-600/20 blur-[120px] rounded-full pointer-events-none"></div>

    </body>
</html>
