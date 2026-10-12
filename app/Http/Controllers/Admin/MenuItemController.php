<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Store a new menu item.
     */
    public function store(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $this->validateItem($request);

        $nextSort = ($menu->items()->max('sort_order') ?? 0) + 1;
        $validated['sort_order'] = $request->input('sort_order') !== null && $request->input('sort_order') !== ''
            ? (int) $request->input('sort_order')
            : $nextSort;

        $menu->items()->create($validated);

        return back()->with('status', 'Menu item added successfully.');
    }

    /**
     * Update an existing menu item.
     */
    public function update(Request $request, Menu $menu, MenuItem $item): RedirectResponse
    {
        $validated = $this->validateItem($request, $item->id);

        $item->update($validated);

        return back()->with('status', 'Menu item updated successfully.');
    }

    /**
     * Delete a menu item.
     */
    public function destroy(Menu $menu, MenuItem $item): RedirectResponse
    {
        $item->delete();

        return back()->with('status', 'Menu item deleted.');
    }

    /**
     * Reorder menu items.
     */
    public function reorder(Request $request, Menu $menu): RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer'],
        ]);

        $orderIds = $request->input('order');
        foreach ($orderIds as $position => $id) {
            MenuItem::where('id', $id)->where('menu_id', $menu->id)->update([
                'sort_order' => $position + 1,
            ]);
        }

        return back()->with('status', 'Menu items order updated.');
    }

    /**
     * Validate menu item data.
     */
    protected function validateItem(Request $request, ?int $itemId = null): array
    {
        $request->validate([
            'label_en' => ['required', 'string', 'max:150'],
            'label_ar' => ['nullable', 'string', 'max:150'],
            'label_tr' => ['nullable', 'string', 'max:150'],
            'type' => ['required', 'string', 'in:page,route,url'],
            'url' => ['nullable', 'string', 'max:255'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'parent_id' => ['nullable', 'exists:menu_items,id'],
            'target' => ['nullable', 'string', 'in:_self,_blank'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        return [
            'label' => [
                'en' => $request->input('label_en'),
                'ar' => $request->input('label_ar') ?: $request->input('label_en'),
                'tr' => $request->input('label_tr') ?: $request->input('label_en'),
            ],
            'type' => $request->input('type'),
            'url' => $request->input('url'),
            'page_id' => $request->input('type') === 'page' ? $request->input('page_id') : null,
            'route_name' => $request->input('type') === 'route' ? $request->input('route_name') : null,
            'parent_id' => $request->filled('parent_id') ? $request->input('parent_id') : null,
            'target' => $request->input('target', '_self'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }
}
