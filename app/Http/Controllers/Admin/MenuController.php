<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of navigation menus.
     */
    public function index(): View
    {
        $menus = Menu::withCount('items')->latest()->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Store a new navigation menu.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'location' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:menus,location'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $menu = Menu::create([
            'name' => $request->input('name'),
            'location' => strtolower($request->input('location')),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.menus.show', $menu)
            ->with('status', "Menu '{$menu->name}' created successfully.");
    }

    /**
     * Show menu builder / items manager.
     */
    public function show(Menu $menu): View
    {
        $menu->load(['items' => function ($query) {
            $query->orderBy('sort_order', 'asc');
        }, 'items.page', 'items.children']);

        $pages = Page::orderBy('sort_order', 'asc')->get();
        $rootItems = $menu->items->whereNull('parent_id')->values();

        return view('admin.menus.show', compact('menu', 'pages', 'rootItems'));
    }

    /**
     * Update navigation menu basic info.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'location' => ['required', 'string', 'max:50', 'alpha_dash', "unique:menus,location,{$menu->id}"],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $menu->update([
            'name' => $request->input('name'),
            'location' => strtolower($request->input('location')),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('status', "Menu '{$menu->name}' updated.");
    }

    /**
     * Remove navigation menu and all its items.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        $name = $menu->name;
        $menu->delete();

        return redirect()
            ->route('admin.menus.index')
            ->with('status', "Menu '{$name}' has been deleted.");
    }
}
