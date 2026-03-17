<nav x-data="{ open: false }" class="bg-slate-950/80 backdrop-blur-2xl border-b border-white/5 sticky top-0 z-50 px-8 py-2">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        
        <!-- Bloc Gauche : Identité & Navigation -->
        <div class="flex items-center gap-16">
            <!-- Logo & Nom -->
            <a href="{{ route('dashboard') }}" class="flex-shrink-0 group">
                <div class="flex items-center gap-4 transition-all duration-300 mr-8">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="ChatViz" class="h-9 w-auto group-hover:rotate-12 transition-transform duration-500">
                    <span class="gradient-text font-bold text-2xl tracking-tighter">ChatViz</span>
                </div>
            </a>

            <!-- Navigation Principale -->
            <div class="hidden lg:flex items-center gap-10">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-xs font-bold uppercase tracking-[0.2em] !text-slate-400 hover:!text-indigo-400 border-none">
                    {{ __('Tableau de bord') }}
                </x-nav-link>
                <!-- On peut rajouter d'autres liens ici si besoin -->
                <a href="{{ route('menu') }}" class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 hover:text-white transition">Menu</a>
                <a href="{{ route('about') }}" class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 hover:text-white transition">À propos</a>
            </div>
        </div>

        <!-- Bloc Droite : Profil & Actions -->
        <div class="flex items-center gap-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center gap-3 px-4 py-2 rounded-full bg-white/5 border border-white/5 hover:bg-white/10 hover:border-white/10 transition-all group">
                        <div class="size-8 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-[10px] font-bold">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div class="text-xs font-bold uppercase tracking-widest text-slate-400 group-hover:text-white transition">{{ Auth::user()->name }}</div>
                        <svg class="size-4 text-slate-500 group-hover:text-white transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="bg-slate-900 border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
                        <x-dropdown-link :href="route('profile.edit')" class="!text-slate-400 hover:!bg-white/5 hover:!text-white">
                            {{ __('Mon Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="!text-red-400 hover:!bg-red-500/10"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>

            <!-- Menu Burger (Mobile) -->
            <button @click="open = ! open" class="lg:hidden p-2 text-slate-400 hover:text-white transition">
                <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden mt-4 pt-4 border-t border-white/5 pb-6">
        <div class="flex flex-col gap-4">
            <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-widest text-white px-4">Tableau de bord</a>
            <a href="{{ route('menu') }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 px-4">Menu</a>
            <a href="{{ route('about') }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 px-4">À propos</a>
            <div class="border-t border-white/5 pt-4">
                <a href="{{ route('profile.edit') }}" class="text-xs font-bold uppercase tracking-widest text-slate-400 px-4 italic">Profil</a>
            </div>
        </div>
    </div>
</nav>
