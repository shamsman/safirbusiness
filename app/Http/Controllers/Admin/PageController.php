<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of custom pages.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $pages = Page::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('slug', 'like', "%{$search}%")
                      ->orWhere('title', 'like', "%{$search}%");
                });
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_published', (bool) $status);
            })
            ->orderBy('sort_order', 'asc')
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.index', compact('pages', 'search', 'status'));
    }

    /**
     * Show form for creating a new page.
     */
    public function create(): View
    {
        $page = new Page([
            'template' => 'default',
            'is_published' => true,
            'sort_order' => 0,
        ]);

        return view('admin.pages.form', compact('page'));
    }

    /**
     * Store a newly created page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePage($request);

        $page = Page::create($validated);

        return redirect()
            ->route('admin.pages.index')
            ->with('status', "Page '{$page->title_text}' created successfully.");
    }

    /**
     * Show form for editing a page.
     */
    public function edit(Page $page): View
    {
        return view('admin.pages.form', compact('page'));
    }

    /**
     * Update an existing page.
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validatePage($request, $page->id);

        $page->update($validated);

        if ($page->template === 'about' || in_array($page->slug, ['about', 'about-us'], true)) {
            // Synchronize any sister 'about' page so both 'about' and 'about-us' slugs share identical blocks/content
            Page::whereIn('slug', ['about', 'about-us'])
                ->where('id', '!=', $page->id)
                ->update([
                    'template' => 'about',
                    'blocks' => $validated['blocks'] ?? $page->blocks,
                    'title' => $validated['title'] ?? $page->title,
                    'summary' => $validated['summary'] ?? $page->summary,
                    'content' => $validated['content'] ?? $page->content,
                ]);
        }

        return redirect()
            ->route('admin.pages.index')
            ->with('status', "Page '{$page->title_text}' updated successfully.");
    }

    /**
     * Remove the specified page.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $title = $page->title_text;
        $page->delete();

        return redirect()
            ->route('admin.pages.index')
            ->with('status', "Page '{$title}' has been deleted.");
    }

    /**
     * Toggle publication status.
     */
    public function toggle(Page $page): RedirectResponse
    {
        $page->update([
            'is_published' => !$page->is_published,
        ]);

        $statusStr = $page->is_published ? 'published' : 'draft';

        return back()->with('status', "Page '{$page->title_text}' is now {$statusStr}.");
    }

    /**
     * Validate page request data and assemble multilingual arrays.
     */
    protected function validatePage(Request $request, ?int $pageId = null): array
    {
        $request->validate([
            'slug' => ['nullable', 'string', 'max:100', 'alpha_dash'],
            'template' => ['required', 'string', 'in:default,about,embassies,corporates,contact'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_tr' => ['nullable', 'string', 'max:255'],
            'summary_en' => ['nullable', 'string'],
            'summary_ar' => ['nullable', 'string'],
            'summary_tr' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content_ar' => ['nullable', 'string'],
            'content_tr' => ['nullable', 'string'],
            'meta_title_en' => ['nullable', 'string', 'max:255'],
            'meta_title_ar' => ['nullable', 'string', 'max:255'],
            'meta_title_tr' => ['nullable', 'string', 'max:255'],
            'meta_description_en' => ['nullable', 'string', 'max:500'],
            'meta_description_ar' => ['nullable', 'string', 'max:500'],
            'meta_description_tr' => ['nullable', 'string', 'max:500'],
            'is_published' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $rawSlug = $request->input('slug') ?: $request->input('title_en');
        $slug = Str::slug($rawSlug);

        // Ensure uniqueness
        $originalSlug = $slug;
        $counter = 1;
        while (Page::where('slug', $slug)->when($pageId, fn($q) => $q->where('id', '!=', $pageId))->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $blocks = null;
        if ($request->filled('blocks_json')) {
            $decoded = json_decode($request->input('blocks_json'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $blocks = $decoded;
            }
        } elseif ($request->input('template') === 'about' || $request->has('founder1_name') || $request->has('founder2_name')) {
            // Reconstruct founders array if provided via dedicated founder inputs
            $blocks = [
                'founders' => [
                    [
                        'id' => 'founder-1',
                        'name' => $request->input('founder1_name'),
                        'role' => [
                            'en' => $request->input('founder1_role_en'),
                            'ar' => $request->input('founder1_role_ar'),
                            'tr' => $request->input('founder1_role_tr'),
                        ],
                        'badge' => [
                            'en' => $request->input('founder1_badge_en'),
                            'ar' => $request->input('founder1_badge_ar'),
                            'tr' => $request->input('founder1_badge_tr'),
                        ],
                        'bio' => [
                            'en' => $request->input('founder1_bio_en'),
                            'ar' => $request->input('founder1_bio_ar'),
                            'tr' => $request->input('founder1_bio_tr'),
                        ],
                        'highlights' => [
                            'en' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_highlights_en')))),
                            'ar' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_highlights_ar')))),
                            'tr' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_highlights_tr')))),
                        ],
                        'education' => [
                            'en' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_education_en')))),
                            'ar' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_education_ar')))),
                            'tr' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder1_education_tr')))),
                        ],
                        'linkedin' => $request->input('founder1_linkedin'),
                        'email' => $request->input('founder1_email'),
                    ],
                    [
                        'id' => 'founder-2',
                        'name' => $request->input('founder2_name'),
                        'role' => [
                            'en' => $request->input('founder2_role_en'),
                            'ar' => $request->input('founder2_role_ar'),
                            'tr' => $request->input('founder2_role_tr'),
                        ],
                        'badge' => [
                            'en' => $request->input('founder2_badge_en'),
                            'ar' => $request->input('founder2_badge_ar'),
                            'tr' => $request->input('founder2_badge_tr'),
                        ],
                        'bio' => [
                            'en' => $request->input('founder2_bio_en'),
                            'ar' => $request->input('founder2_bio_ar'),
                            'tr' => $request->input('founder2_bio_tr'),
                        ],
                        'highlights' => [
                            'en' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_highlights_en')))),
                            'ar' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_highlights_ar')))),
                            'tr' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_highlights_tr')))),
                        ],
                        'education' => [
                            'en' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_education_en')))),
                            'ar' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_education_ar')))),
                            'tr' => array_filter(array_map('trim', explode("\n", (string) $request->input('founder2_education_tr')))),
                        ],
                        'linkedin' => $request->input('founder2_linkedin'),
                        'email' => $request->input('founder2_email'),
                    ],
                ],
            ];
        }

        return [
            'slug' => $slug,
            'template' => $request->input('template', 'default'),
            'title' => [
                'en' => $request->input('title_en'),
                'ar' => $request->input('title_ar') ?: $request->input('title_en'),
                'tr' => $request->input('title_tr') ?: $request->input('title_en'),
            ],
            'summary' => [
                'en' => $request->input('summary_en'),
                'ar' => $request->input('summary_ar') ?: $request->input('summary_en'),
                'tr' => $request->input('summary_tr') ?: $request->input('summary_en'),
            ],
            'content' => [
                'en' => $request->input('content_en'),
                'ar' => $request->input('content_ar') ?: $request->input('content_en'),
                'tr' => $request->input('content_tr') ?: $request->input('content_en'),
            ],
            'meta_title' => [
                'en' => $request->input('meta_title_en'),
                'ar' => $request->input('meta_title_ar') ?: $request->input('meta_title_en'),
                'tr' => $request->input('meta_title_tr') ?: $request->input('meta_title_en'),
            ],
            'meta_description' => [
                'en' => $request->input('meta_description_en'),
                'ar' => $request->input('meta_description_ar') ?: $request->input('meta_description_en'),
                'tr' => $request->input('meta_description_tr') ?: $request->input('meta_description_en'),
            ],
            'blocks' => $blocks,
            'is_published' => $request->boolean('is_published', true),
            'sort_order' => (int) $request->input('sort_order', 0),
        ];
    }
}
