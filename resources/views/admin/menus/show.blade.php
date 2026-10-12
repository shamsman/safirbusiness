@extends('layouts.admin')

@section('title', 'Manage Menu: ' . $menu->name)
@section('header_title', 'Menu Items: ' . $menu->name)
@section('header_subtitle', 'Location: ' . $menu->location . ' — Add, reorder, and configure navigation links')

@section('content')
<div class="space-y-6" x-data="{
    showAddItemModal: false,
    editModalOpen: false,
    editItem: { id: null, label_en: '', label_ar: '', label_tr: '', type: 'url', url: '', page_id: '', route_name: '', target: '_self', is_active: true, parent_id: '' },
    openEdit(item) {
        this.editItem = {
            id: item.id,
            label_en: item.label && item.label.en ? item.label.en : '',
            label_ar: item.label && item.label.ar ? item.label.ar : '',
            label_tr: item.label && item.label.tr ? item.label.tr : '',
            type: item.type || 'url',
            url: item.url || '',
            page_id: item.page_id || '',
            route_name: item.route_name || '',
            target: item.target || '_self',
            is_active: item.is_active,
            parent_id: item.parent_id || ''
        };
        this.editModalOpen = true;
    }
}">

    <!-- Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-navy-950 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to All Menus</span>
        </a>

        <div class="flex items-center gap-2">
            <button type="button" @click="showAddItemModal = true" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 hover:brightness-105 shadow-sm shadow-gold-500/20 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Add Navigation Item</span>
            </button>
        </div>
    </div>

    <!-- Menu Overview & Update -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h3 class="text-base font-bold text-slate-900">{{ $menu->name }}</h3>
                <span class="font-mono text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded">{{ $menu->location }}</span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Controls links rendered in the <code>{{ $menu->location }}</code> zone across all localized site instances.</p>
        </div>

        <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="flex items-center gap-3">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $menu->name }}" class="text-xs rounded-xl border border-slate-200 p-2 outline-none">
            <input type="hidden" name="location" value="{{ $menu->location }}">
            <label class="inline-flex items-center gap-1.5 text-xs text-slate-700 font-semibold cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-gold-600">
                <span>Active</span>
            </label>
            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">
                Save
            </button>
        </form>
    </div>

    <!-- Menu Items List -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700">Configured Links & Order</h4>
            <span class="text-xs text-slate-400">{{ $menu->items->count() }} Total Items</span>
        </div>

        <div class="divide-y divide-slate-100 text-xs">
            @forelse($menu->items as $index => $item)
                <div class="p-4 hover:bg-slate-50/70 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-3 {{ $item->parent_id ? 'pl-8 sm:pl-12 bg-slate-50/30' : '' }}">
                    
                    <div class="flex items-center gap-3 min-w-0">
                        <!-- Order Badge -->
                        <span class="w-6 h-6 rounded-md bg-slate-100 text-slate-500 font-mono text-[11px] font-bold flex items-center justify-center shrink-0">
                            {{ $item->sort_order }}
                        </span>

                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                @if($item->parent_id)
                                    <span class="text-slate-400 text-xs">↳</span>
                                @endif
                                <span class="font-bold text-slate-900 text-sm truncate">
                                    {{ $item->getLocalized('label', 'en') }}
                                </span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider {{ $item->type === 'page' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $item->type }}
                                </span>
                                @if(!$item->is_active)
                                    <span class="text-[10px] px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold">Inactive</span>
                                @endif
                            </div>

                            <div class="text-[11px] text-slate-400 mt-0.5 flex flex-wrap items-center gap-2">
                                <span>AR: {{ $item->getLocalized('label', 'ar') ?: '—' }}</span>
                                <span>•</span>
                                <span>Target: <code>{{ $item->target }}</code></span>
                                <span>•</span>
                                <span class="font-mono text-slate-500">
                                    @if($item->type === 'page' && $item->page)
                                        Page: /{{ $item->page->slug }}
                                    @elseif($item->type === 'route')
                                        Route: {{ $item->route_name }}
                                    @else
                                        URL: {{ $item->url ?: '#' }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Item Actions -->
                    <div class="flex items-center gap-2 self-end sm:self-center shrink-0">
                        <button type="button" @click='openEdit(@json($item))' class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-gold-500 hover:text-navy-950 transition-all cursor-pointer">
                            Edit
                        </button>

                        <form action="{{ route('admin.menus.items.destroy', [$menu, $item]) }}" method="POST" class="inline" onsubmit="return confirm('Remove link item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="p-10 text-center text-slate-400">
                    <p class="text-sm font-semibold text-slate-600">No items configured in this menu</p>
                    <p class="text-xs text-slate-400 mt-1">Click "Add Navigation Item" to add your first link.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal: Add New Menu Item -->
    <div x-show="showAddItemModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4" style="display: none;">
        
        <div @click.away="showAddItemModal = false" class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900">Add Menu Item to {{ $menu->name }}</h3>
                <button type="button" @click="showAddItemModal = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ route('admin.menus.items.store', $menu) }}" method="POST" class="space-y-4" x-data="{ itemType: 'page' }">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Item Label (English) <span class="text-rose-500">*</span></label>
                        <input type="text" name="label_en" required placeholder="e.g. About Us" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Label (Arabic)</label>
                            <input type="text" name="label_ar" dir="rtl" placeholder="عن المنصة" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Label (Turkish)</label>
                            <input type="text" name="label_tr" placeholder="Hakkımızda" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Link Destination Type</label>
                        <select name="type" x-model="itemType" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500 bg-white">
                            <option value="page">Dynamic Page</option>
                            <option value="url">Direct URL / Path</option>
                            <option value="route">Named Route</option>
                        </select>
                    </div>

                    <div x-show="itemType === 'page'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Select Page</label>
                        <select name="page_id" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500 bg-white">
                            <option value="">-- Choose Page --</option>
                            @foreach($pages as $p)
                                <option value="{{ $p->id }}">{{ $p->title_text }} (/{{ $p->slug }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="itemType === 'url'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Target URL or Path</label>
                        <input type="text" name="url" placeholder="e.g. /services or https://..." class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none font-mono">
                    </div>

                    <div x-show="itemType === 'route'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Route Name</label>
                        <input type="text" name="route_name" placeholder="e.g. contact or reports.index" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none font-mono">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Window</label>
                            <select name="target" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none bg-white">
                                <option value="_self">Same Tab (_self)</option>
                                <option value="_blank">New Tab (_blank)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Sort Order</label>
                            <input type="number" name="sort_order" value="0" min="0" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-gold-600">
                            <span class="text-xs font-bold text-slate-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" @click="showAddItemModal = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-navy-950 bg-gold-500 hover:bg-gold-400 transition-colors">
                        Add Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Edit Menu Item -->
    <div x-show="editModalOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4" style="display: none;">
        
        <div @click.away="editModalOpen = false" class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900">Edit Menu Item</h3>
                <button type="button" @click="editModalOpen = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form :action="'{{ route('admin.menus.items.update', [$menu, 'PLACEHOLDER']) }}'.replace('PLACEHOLDER', editItem.id)" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Item Label (English) <span class="text-rose-500">*</span></label>
                        <input type="text" name="label_en" x-model="editItem.label_en" required class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Label (Arabic)</label>
                            <input type="text" name="label_ar" x-model="editItem.label_ar" dir="rtl" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Label (Turkish)</label>
                            <input type="text" name="label_tr" x-model="editItem.label_tr" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Link Destination Type</label>
                        <select name="type" x-model="editItem.type" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500 bg-white">
                            <option value="page">Dynamic Page</option>
                            <option value="url">Direct URL / Path</option>
                            <option value="route">Named Route</option>
                        </select>
                    </div>

                    <div x-show="editItem.type === 'page'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Select Page</label>
                        <select name="page_id" x-model="editItem.page_id" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none focus:border-gold-500 bg-white">
                            <option value="">-- Choose Page --</option>
                            @foreach($pages as $p)
                                <option value="{{ $p->id }}">{{ $p->title_text }} (/{{ $p->slug }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-show="editItem.type === 'url'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Target URL or Path</label>
                        <input type="text" name="url" x-model="editItem.url" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none font-mono">
                    </div>

                    <div x-show="editItem.type === 'route'">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Route Name</label>
                        <input type="text" name="route_name" x-model="editItem.route_name" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none font-mono">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Target Window</label>
                            <select name="target" x-model="editItem.target" class="w-full text-xs rounded-xl border border-slate-200 p-2.5 outline-none bg-white">
                                <option value="_self">Same Tab (_self)</option>
                                <option value="_blank">New Tab (_blank)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" :checked="editItem.is_active" class="rounded border-slate-300 text-gold-600">
                            <span class="text-xs font-bold text-slate-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" @click="editModalOpen = false" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold text-navy-950 bg-gold-500 hover:bg-gold-400 transition-colors">
                        Update Item
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
