<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <header class="bg-white dark:bg-gray-800 shadow w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="h-10 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:underline">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Register</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8 mt-8">
        <h1 class="text-3xl font-bold mb-6">Bem-vindo à Loja Virtual!</h1>

        <!-- Formulário de Filtro -->
        <form method="GET" action="{{ url('/') }}" class="mb-8 flex items-end gap-4">
            <div class="w-full sm:w-1/3">
                <label for="type_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Filtrar por Tipo</label>
                <select name="type_id" id="type_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">Todos os tipos</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <x-primary-button type="submit">Filtrar</x-primary-button>
            @if(request('type_id'))
                <a href="{{ url('/') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline mb-2 border-b border-transparent">Limpar</a>
            @endif
        </form>

        <!-- Grid de Produtos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col border border-gray-200 dark:border-gray-700">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-500 dark:text-gray-400">Sem imagem</span>
                        </div>
                    @endif
                    <div class="p-4 flex flex-col flex-grow">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 flex-grow">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-xl font-bold text-indigo-600 dark:text-indigo-400">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Qtd: {{ $product->quantity }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
                    Nenhum produto encontrado.
                </div>
            @endforelse
        </div>
    </main>

</body>

</html>