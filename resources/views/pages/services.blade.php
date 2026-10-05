@extends('layouts.app')

@section('title', __('safir.nav.services') . ' — ' . __('safir.brand_name'))
@section('meta_description', __('safir.short_bio'))

@section('content')

    <!-- Header -->
    <section class="py-16 md:py-20 bg-gradient-to-b from-white via-[#FAF9F5] to-[#F5F2EB] border-b border-[#E8E4DA] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gold-50 border border-gold-200 text-gold-700 text-xs font-semibold uppercase tracking-wider">
                    {{ __('safir.footer.services_title') }}
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0A192F] tracking-tight">
                    Four Pillars of Sovereign & Corporate Advisory
                </h1>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    {{ __('safir.short_bio') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Pillar Tabs Navigation -->
    <section class="py-4 bg-white/95 border-b border-[#E8E4DA] sticky top-20 z-40 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            <div class="flex items-center gap-3 overflow-x-auto pb-1 scrollbar-none">
                <a href="{{ route_ml('services.index') }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold shrink-0 transition-all {{ $activePillar === 'all' ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 shadow-sm' : 'bg-slate-100 text-slate-700 hover:text-gold-700 hover:bg-gold-50 border border-slate-200' }}">
                    All Pillars
                </a>
                <a href="{{ route_ml('services.pillar', ['pillar' => 'economy']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold shrink-0 transition-all {{ $activePillar === 'economy' ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 shadow-sm' : 'bg-slate-100 text-slate-700 hover:text-gold-700 hover:bg-gold-50 border border-slate-200' }}">
                    {{ __('safir.pillars.economy.title') }}
                </a>
                <a href="{{ route_ml('services.pillar', ['pillar' => 'relations']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold shrink-0 transition-all {{ $activePillar === 'relations' ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 shadow-sm' : 'bg-slate-100 text-slate-700 hover:text-gold-700 hover:bg-gold-50 border border-slate-200' }}">
                    {{ __('safir.pillars.relations.title') }}
                </a>
                <a href="{{ route_ml('services.pillar', ['pillar' => 'events']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold shrink-0 transition-all {{ $activePillar === 'events' ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 shadow-sm' : 'bg-slate-100 text-slate-700 hover:text-gold-700 hover:bg-gold-50 border border-slate-200' }}">
                    {{ __('safir.pillars.events.title') }}
                </a>
                <a href="{{ route_ml('services.pillar', ['pillar' => 'community']) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-bold shrink-0 transition-all {{ $activePillar === 'community' ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 shadow-sm' : 'bg-slate-100 text-slate-700 hover:text-gold-700 hover:bg-gold-50 border border-slate-200' }}">
                    {{ __('safir.pillars.community.title') }}
                </a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 bg-[#F8F7F2] min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-8">
            
            @if($activePillar === 'all')
                @foreach($services as $pillarKey => $pillarServices)
                    <div class="mb-20 last:mb-0">
                        <div class="border-b border-[#E8E4DA] pb-4 mb-8 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-mono font-bold text-gold-700 uppercase tracking-wider">PILLAR FOCUS</span>
                                <h2 class="text-2xl font-bold text-[#0A192F] mt-1">
                                    {{ __('safir.pillars.' . $pillarKey . '.title') }}
                                </h2>
                            </div>
                            <p class="text-slate-600 text-xs max-w-md hidden md:block">
                                {{ __('safir.pillars.' . $pillarKey . '.desc') }}
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pillarServices as $service)
                                <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-[#0A192F] mb-2">
                                            {{ $service->getLocalized('title') }}
                                        </h3>
                                        <p class="text-slate-600 text-xs leading-relaxed mb-4">
                                            {{ $service->getLocalized('summary') }}
                                        </p>

                                        @if($service->deliverables)
                                            <div class="space-y-1.5 border-t border-[#F0ECE1] pt-3">
                                                <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider mb-1">Key Deliverables:</div>
                                                @foreach($service->deliverables as $deliv)
                                                    <div class="flex items-start gap-2 text-xs text-slate-600">
                                                        <span class="text-gold-600 font-bold">✓</span>
                                                        <span>{{ $deliv }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-[#F0ECE1]">
                                        <a href="{{ route_ml('contact') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                                            Request Execution Scope →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <div class="bg-white p-6 rounded-2xl border border-[#E8E4DA] hover:border-gold-400 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-[#0A192F] mb-2">
                                    {{ $service->getLocalized('title') }}
                                </h3>
                                <p class="text-slate-600 text-xs leading-relaxed mb-4">
                                    {{ $service->getLocalized('summary') }}
                                </p>

                                @if($service->deliverables)
                                    <div class="space-y-1.5 border-t border-[#F0ECE1] pt-3">
                                        <div class="text-[11px] font-bold text-gold-700 uppercase tracking-wider mb-1">Key Deliverables:</div>
                                        @foreach($service->deliverables as $deliv)
                                            <div class="flex items-start gap-2 text-xs text-slate-600">
                                                <span class="text-gold-600 font-bold">✓</span>
                                                <span>{{ $deliv }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6 pt-4 border-t border-[#F0ECE1]">
                                <a href="{{ route_ml('contact') }}" class="text-xs font-bold text-gold-700 hover:text-gold-800">
                                    Request Execution Scope →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>

@endsection
