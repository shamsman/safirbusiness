<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#060D1A]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Executive Account | {{ setting('site_name', 'Safir Business Hub') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex items-center justify-center p-6 bg-[#060D1A] text-slate-200 font-sans selection:bg-gold-500 selection:text-navy-950 relative overflow-hidden">

    <!-- Ambient background luxury glow -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-gold-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-navy-700/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10 my-8">
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
            <h2 class="mt-6 text-2xl font-bold tracking-tight text-white">Register Account</h2>
            <p class="mt-1 text-xs text-slate-400">Apply for institutional credentials and strategic briefing portal access</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-[#0A192F]/90 backdrop-blur-xl border border-gold-500/20 rounded-2xl p-8 shadow-2xl shadow-navy-950/80">
            
            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl border border-rose-500/30 bg-rose-500/10 text-rose-300 text-xs">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Full Name & Title
                    </label>
                    <input id="name" name="name" type="text" required
                           value="{{ old('name') }}"
                           placeholder="e.g. Amb. Robert Hughes / Dr. Sarah Al-Sabah"
                           class="w-full px-4 py-2.5 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                </div>

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Official Institutional Email
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           value="{{ old('email') }}"
                           placeholder="name@embassy.gov or name@enterprise.com"
                           class="w-full px-4 py-2.5 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                </div>

                <!-- Phone Input -->
                <div>
                    <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                        Direct Phone / WhatsApp <span class="text-slate-500 text-[10px] lowercase">(optional)</span>
                    </label>
                    <input id="phone" name="phone" type="text"
                           value="{{ old('phone') }}"
                           placeholder="+90 (___) ___ __ __"
                           class="w-full px-4 py-2.5 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                </div>

                <!-- Password Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               placeholder="Minimum 8 characters"
                               class="w-full px-4 py-2.5 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-1.5">
                            Confirm Password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               placeholder="Repeat password"
                               class="w-full px-4 py-2.5 bg-[#060D1A] border border-slate-700 rounded-xl text-white placeholder-slate-500 text-sm focus:outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500 transition-all">
                    </div>
                </div>

                <!-- Notice regarding default Guest role -->
                <div class="p-3 rounded-xl bg-gold-500/10 border border-gold-500/20 text-[11px] text-gold-300/90 leading-relaxed">
                    <strong class="text-gold-300">Access Tier Policy:</strong> Newly registered accounts are initially assigned <span class="underline">Guest</span> status. Elevated analytical and ministerial clearance is granted upon executive verification.
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full mt-2 py-3 px-4 bg-gradient-to-r from-gold-500 via-gold-400 to-gold-600 hover:from-gold-400 hover:to-gold-500 text-navy-950 font-bold text-sm rounded-xl shadow-lg shadow-gold-500/25 transition-all transform active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer">
                    <span>Complete Registration</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-400">
                    Already registered? 
                    <a href="{{ route('login') }}" class="text-gold-400 hover:text-gold-300 font-semibold underline underline-offset-4 ml-1">
                        Sign In here
                    </a>
                </p>
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
