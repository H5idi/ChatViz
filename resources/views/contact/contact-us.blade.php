<<!DOCTYPE html>
<html lang="fr" class="h-full bg-black">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | ChatViz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full text-white antialiased flex items-center justify-center py-12 px-4 bg-black">

    {{--formulaire--}}
    <div class="max-w-md w-full bg-gray-900 p-8 rounded-2xl shadow-2xl border border-gray-800">
        
        <header class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-white tracking-tight">
                Contactez <span class="text-indigo-500">ChatViz</span>
            </h1>
            <p class="mt-2 text-sm text-gray-400">Fond noir, style épuré.</p>
        </header>

        {{-- Alerte de succès--}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-indigo-900/30 border border-indigo-500 text-white text-sm rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
            @csrf 

            {{-- Nom --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-white mb-2">Nom</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}"
                    class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-600"
                    placeholder="Votre nom">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-white mb-2">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}"
                    class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-600"
                    placeholder="nom@exemple.com">
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-semibold text-white mb-2">Message</label>
                <textarea id="message" name="message" rows="4" required
                    class="w-full bg-black border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all placeholder-gray-600"
                    placeholder="Comment pouvons-nous vous aider ?">{{ old('message') }}</textarea>
            </div>

            {{-- Le bouton--}}
            <button type="submit" 
                class="w-full bg-indigo-500 hover:bg-fuchsia-500 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 shadow-lg shadow-indigo-500/20 uppercase tracking-widest text-sm">
            </button>
        </form>
    </div>

</body>
</html>