@extends('layouts.admin')

@section('title', 'Navigation Menus')
@section('header_title', 'Navigation Menus')
@section('header_subtitle', 'Manage header links, footer pillars, and public navigation architecture')

@section('content')
<div class="space-y-6" x-data="{ showNewMenuModal: false }">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs">
        <div>
            <h2 class="text-base font-bold text-slate-900 tracking-tight">Navigation Zones & Menus</h2>
            <p class="text-xs text-slate-500">Configure menus for the header navigation, footer quick links, and pillars.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" @click="showNewMenuModal = true" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 hover:brightness-105 shadow-sm shadow-gold-500/20 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Navigation Menu</span>
            </button>
        </div>
    </div>

    <!-- Menus Grid / Table -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6">Menu Name</th>
                        <th class="py-3.5 px-6">Zone Location Key</th>
                        <th class="py-3.5 px-4 text-center">Items Count</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($menus as $menu)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900 text-sm">
                                <a href="{{ route('admin.menus.show', $menu) }}" class="hover:text-gold-600 transition-colors">
                                    {{ $menu->name }}
                                </a>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-mono text-[11px] bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md">
                                    {{ $menu->location }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center font-bold text-slate-700">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gold-50 text-gold-800 border border-gold-200">
                                    {{ $menu->items_count }} {{ Str::plural('item', $menu->items_count) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold {{ $menu->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $menu->is_active ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                    <span>{{ $menu->is_active ? 'Active' : 'Disabled' }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.menus.show', $menu) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-navy-950 text-gold-300 hover:bg-navy-900 transition-all">
                                        <span>Manage Items</span>
                                        <span>→</span>
                                    </a>

                                    @if(!in_array($menu->location, ['header', 'footer_quick_links']))
                                    <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Delete Menu">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold text-slate-600">No menus registered</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Create New Menu -->
    <div x-show="showNewMenuModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4" style="display: none;">
        
        <div @click.away="showNewMenuModal = false" class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900">Add Navigation Menu</h3>
                <button type="button" @click="showNewMenuModal = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Menu Label / Name</label>
                    <input type="text" name="name" required placeholder="e.g. Footer Secondary" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Location Identifier Key</label>
                    <input type="text" name="location" required placeholder="e.g. footer_secondary" class="w-full text-xs font-mono rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                    <p class="text-[11px] text-slate-400 mt-1">Lowercase letters, numbers and underscores only.</p>
                </div>

                <div>
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-gold-600">
                        <span class="text-xs font-bold text-slate-700">Active</span>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" @click="showNewMenuModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-navy-950 bg-gold-500 hover:bg-gold-400 transition-colors">
                        Create Menu
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
