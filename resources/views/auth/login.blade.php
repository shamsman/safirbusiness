<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#060D1A]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Executive Login | {{ setting('site_name', 'Safir Business Hub') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex items-center justify-center p-6 bg-[#060D1A] text-slate-200 font-sans selection:bg-gold-500 selection:text-navy-950 relative overflow-hidden">

    <!-- Ambient background luxury glow -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-navy-700/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo Branding Header -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 flex items-center justify-center shadow-xl shadow-gold-500/20 text-navy-950 font-bold text-2xl tracking-wider group-hover:scale-105 transition-transform">
                    S
                </div>
                <div class="text-left">
                    <span class="block text-xl font-bold tracking-tight text-white group-hover:text-gold-400 transition-colors">
                        SAFIR <span class="text-gold-400">BUSINESS</span>
                    </span>
                    <span class="block text-[11px] tracking-widest uppercase text-slate-400 font-medium">Strategic Gateway</span>
                </div>
            </a>
            <h2 class="mt-6 text-2xl font-bold tracking-tight text-white">Executive Sign In</h2>
            <p class="mt-1 text-xs text-slate-400">Authenticate to access governance and operational telemetry</p>
        </div>

        <!-- Login Card -->
        <div class="bg-[#0A192F]/90 backdrop-blur-xl border border-gold-500/20 rounded-2xl p-8 shadow-2xl shadow-navy-950/80">
            
            @if (session('status'))
                <div class="mb-5 p-3.5 rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-300 text-xs font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-300 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                        Official Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path>
                            </svg>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               value="{{ old('email', 'shamsman1@gmail.com') }}"
                               class="w-full pl-10 pr-4 py-3 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                            Security Credentials
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               placeholder="••••••••••••"
                               class="w-full pl-10 pr-4 py-3 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-slate-300">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-700 bg-[#060D1A] text-gold-500 focus:ring-gold-500 focus:ring-offset-0">
                        <span>Remember session on this device</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-3.5 px-4 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-sm rounded-xl shadow-lg shadow-gold-500/25 transition-all transform active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer">
                    <span>Access Executive Portal</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <!-- Admin credentials quick reminder info -->
            <div class="mt-6 pt-5 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-400">
                    Need new credentials? 
                    <a href="{{ route('register') }}" class="text-gold-400 hover:text-gold-300 font-semibold underline underline-offset-4 ml-1">
                        Register Account
                    </a>
                </p>
                <div class="mt-3 inline-block px-3 py-1.5 rounded-lg bg-slate-900/80 border border-slate-800 text-[11px] text-slate-400">
                    Default Superadmin: <span class="text-gold-300 font-mono">shamsman1@gmail.com</span>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-xs text-slate-400 hover:text-white transition-colors inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Return to Safir Public Portal</span>
            </a>
        </div>
    </div>

</body>
</html>
