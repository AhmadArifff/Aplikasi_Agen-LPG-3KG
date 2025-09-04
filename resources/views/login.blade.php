<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pertamina</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Local & CDN Stylesheets -->
    <link rel="stylesheet" href="https://simelon-cbdkdzc9fsbebget.a01.azurefd.net/res/css/icons/icomoon/styles.min.css?ver=1.0.0" type="text/css">
  
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Logo -->
    <div class="flex flex-col items-center mt-16">
        <div class="w-full max-w-md px-4">
            <img src="{{ asset('assets/img/Pertamina-Logo.wine.png') }}"
                alt="Pertamina Logo"
                class="h-100 mx-auto object-contain">
        </div>
    </div>


    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5 w-full max-w-md mx-auto px-4">
        @csrf

        <!-- Tampilkan pesan error jika login gagal -->
        @if ($errors->has('login_error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ $errors->first('login_error') }}</span>
            </div>
        @endif

        <!-- Username -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i class="icon-user text-muted"></i>
            </span>
            <input type="text" name="u_username" value="{{ old('u_username') }}" required placeholder="Username"
               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50 text-gray-700 h-10">
        </div>

        <!-- Password -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i class="icon-lock2 text-muted"></i>
            </span>
            <input type="password" name="u_password" required placeholder="Password"
               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-gray-50 text-gray-700 h-10">
        </div>

        <!-- Button -->
        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-md shadow-md transition">
            Login
        </button>

        <!-- Lupa Password -->
        <div class="text-center mt-2">
            <a href="{{ route('password.request') }}" class="text-blue-600 text-sm hover:underline">
                Lupa Password ?
            </a>
        </div>
    </form>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 w-full py-3 bg-transparent">
        <p class="text-center text-xs text-gray-500">
            © 2025 by PT. Pertamina (PERSERO)
        </p>
    </footer>

</body>
</html>
