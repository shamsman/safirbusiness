@extends('layouts.admin')

@section('title', 'Pages Management')
@section('header_title', 'Pages Management')
@section('header_subtitle', 'Manage custom landing pages, About Us, and executive content')

@section('content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200/90 shadow-2xs">
        <div>
            <h2 class="text-base font-bold text-slate-900 tracking-tight">Institutional & Custom Pages</h2>
            <p class="text-xs text-slate-500">Create, customize, and publish institutional pages and executive profiles.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-navy-950 bg-gradient-to-r from-gold-400 via-gold-500 to-gold-600 hover:brightness-105 shadow-sm shadow-gold-500/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Create New Page</span>
            </a>
        </div>
    </div>

    <!-- Filters & Search -->
    <form method="GET" action="{{ route('admin.pages.index') }}" class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-2xs flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[240px] relative">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search pages by title or slug..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-lg border border-slate-200 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>

        <select name="status" class="py-2 px-3 text-xs rounded-lg border border-slate-200 focus:border-gold-500 outline-none bg-white text-slate-700">
            <option value="">All Statuses</option>
            <option value="1" {{ $status === '1' ? 'selected' : '' }}>Published</option>
            <option value="0" {{ $status === '0' ? 'selected' : '' }}>Draft</option>
        </select>

        <button type="submit" class="px-4 py-2 rounded-lg text-xs font-semibold bg-slate-900 text-white hover:bg-slate-800 transition-colors">
            Filter
        </button>

        @if($search || $status !== null && $status !== '')
            <a href="{{ route('admin.pages.index') }}" class="px-3 py-2 text-xs text-slate-500 hover:text-slate-800 transition-colors">
                Clear
            </a>
        @endif
    </form>

    <!-- Pages Table -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/75 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <th class="py-3.5 px-6">Page Details</th>
                        <th class="py-3.5 px-6">Slug & URL</th>
                        <th class="py-3.5 px-4">Template</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center">Order</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($pages as $p)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-sm flex items-center gap-2">
                                    <span>{{ $p->getLocalized('title', 'en') ?: $p->title_text }}</span>
                                    @if($p->slug === 'about')
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gold-50 text-gold-800 border border-gold-200">Featured Core</span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-2">
                                    <span>AR: {{ Str::limit($p->getLocalized('title', 'ar') ?: '—', 35) }}</span>
                                    <span>•</span>
                                    <span>TR: {{ Str::limit($p->getLocalized('title', 'tr') ?: '—', 35) }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-mono text-slate-600 bg-slate-100/70 px-2.5 py-1 rounded-md inline-flex items-center gap-1.5 text-[11px]">
                                    <span>/{{ $p->slug }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-medium {{ $p->template === 'about' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $p->template === 'about' ? 'About Us (Founders CVs)' : 'Standard Dynamic' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <form action="{{ route('admin.pages.toggle', $p) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-bold cursor-pointer transition-all {{ $p->is_published ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $p->is_published ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        <span>{{ $p->is_published ? 'Published' : 'Draft' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-4 text-center font-mono text-slate-500">
                                {{ $p->sort_order }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ $p->url() }}" target="_blank" class="p-1.5 text-slate-400 hover:text-gold-600 hover:bg-gold-50 rounded-lg transition-colors" title="View Public Page">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    <a href="{{ route('admin.pages.edit', $p) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-gold-500 hover:text-navy-950 transition-all">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete page &quot;{{ $p->title_text }}&quot;?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <p class="text-sm font-semibold text-slate-600">No pages found</p>
                                <p class="text-xs text-slate-400 mt-1">Get started by creating your first page.</p>
                                <div class="mt-4">
                                    <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-navy-950 bg-gold-500 hover:bg-gold-400">
                                        + Create Page
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
