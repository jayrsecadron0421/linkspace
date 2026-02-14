<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password - Linkspace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <div class="mx-auto h-12 w-12 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Security Check</h2>
            <p class="mt-2 text-sm text-gray-500 px-6">This is a secure area. Please confirm your password before continuing.</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-[400px]">
            <div class="bg-white px-6 py-10 shadow sm:rounded-lg sm:px-12">
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password" class="form-input mt-2">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <button type="submit" class="btn-primary">Confirm Access</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>