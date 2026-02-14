<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset your password - Linkspace</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">

    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <h2 class="text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Forgot password?
            </h2>
            <p class="mt-2 text-sm leading-6 text-gray-500 px-4">
                No problem. Enter your email and we'll send you a link to reset it.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-10 shadow sm:rounded-lg sm:px-12">
                
                <x-auth-session-status class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-md border border-green-200" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                            Email address
                        </label>
                        <div class="mt-2">
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   required 
                                   autofocus
                                   maxlength="50"
                                   pattern="[^\s]+"
                                   title="Email address cannot contain spaces"
                                   value="{{ $errors->any() ? '' : old('email') }}"
                                   class="form-input"
                                   placeholder="name@company.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="btn-primary">
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-500 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        // Auto-clear fields when there are errors
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            // Auto-focus on email field
            document.getElementById('email').focus();
        });
    </script>
    @endif
</body>
</html>