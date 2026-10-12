@props([
    'name',
    'id' => null,
    'value' => '',
    'label' => null,
    'dir' => 'ltr',
    'placeholder' => 'Write formatted content here...',
    'minHeight' => '160px',
    'help' => null,
    'required' => false,
])

@php
    $editorId = $id ?: 'editor_' . str_replace(['[', ']', '.'], '_', $name) . '_' . uniqid();
    $isRtl = $dir === 'rtl';
@endphp

<div class="space-y-1.5"
     x-data="richTextEditor({
         id: '{{ $editorId }}',
         name: '{{ $name }}',
         dir: '{{ $dir }}',
         placeholder: @js($placeholder),
     })"
     x-init="initEditor()">

    <!-- Header: Label + RichText / HTML Toggle Switch -->
    <div class="flex items-center justify-between gap-2">
        <div>
            @if($label)
                <label for="{{ $editorId }}" class="block text-[11px] font-bold text-slate-700">
                    {{ $label }}
                    @if($required)
                        <span class="text-rose-500">*</span>
                    @endif
                </label>
            @endif
        </div>

        <!-- Mode Toggle Pill -->
        <div class="inline-flex items-center bg-slate-100 p-0.5 rounded-lg border border-slate-200/80 shadow-2xs">
            <button type="button"
                    @click="setMode('rich')"
                    :class="mode === 'rich' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                    class="px-2.5 py-1 rounded-md text-[10px] sm:text-[11px] flex items-center gap-1.5 transition-all cursor-pointer"
                    title="Visual Rich Text Editor">
                <svg class="w-3.5 h-3.5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span>Rich Text</span>
            </button>
            <button type="button"
                    @click="setMode('html')"
                    :class="mode === 'html' ? 'bg-white text-navy-950 font-bold shadow-xs' : 'text-slate-500 hover:text-slate-800'"
                    class="px-2.5 py-1 rounded-md text-[10px] sm:text-[11px] flex items-center gap-1.5 transition-all cursor-pointer"
                    title="Direct HTML Source Code">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
                <span>HTML Source</span>
            </button>
        </div>
    </div>

    <!-- Rich Editor Container -->
    <div class="relative rounded-xl border border-slate-200 bg-white transition-all focus-within:border-gold-500 focus-within:ring-1 focus-within:ring-gold-500/50 shadow-2xs">
        
        <!-- Quill Editor Wrapper (Shown when mode is 'rich') -->
        <div x-show="mode === 'rich'" class="quill-wrapper">
            <!-- Custom Toolbar -->
            <div x-ref="toolbar" class="ql-toolbar-custom bg-slate-50/90 border-b border-slate-200 px-2 py-1.5 rounded-t-xl flex flex-wrap items-center gap-1 text-xs">
                <!-- Headings -->
                <select class="ql-header text-xs rounded-lg border border-slate-200 bg-white px-2 py-1 outline-none text-slate-700">
                    <option value="" selected>Normal Text</option>
                    <option value="2">Heading 2</option>
                    <option value="3">Heading 3</option>
                    <option value="4">Heading 4</option>
                </select>

                <span class="w-px h-5 bg-slate-200 mx-1"></span>

                <!-- Inlines -->
                <button type="button" class="ql-bold p-1 rounded hover:bg-slate-200 text-slate-700" title="Bold"></button>
                <button type="button" class="ql-italic p-1 rounded hover:bg-slate-200 text-slate-700" title="Italic"></button>
                <button type="button" class="ql-underline p-1 rounded hover:bg-slate-200 text-slate-700" title="Underline"></button>

                <span class="w-px h-5 bg-slate-200 mx-1"></span>

                <!-- Lists -->
                <button type="button" class="ql-list p-1 rounded hover:bg-slate-200 text-slate-700" value="ordered" title="Numbered List"></button>
                <button type="button" class="ql-list p-1 rounded hover:bg-slate-200 text-slate-700" value="bullet" title="Bullet List"></button>

                <span class="w-px h-5 bg-slate-200 mx-1"></span>

                <!-- Alignments -->
                <select class="ql-align text-xs rounded-lg border border-slate-200 bg-white px-1.5 py-1 outline-none text-slate-700">
                    <option selected></option>
                    <option value="center"></option>
                    <option value="right"></option>
                    <option value="justify"></option>
                </select>

                <span class="w-px h-5 bg-slate-200 mx-1"></span>

                <!-- Extras -->
                <button type="button" class="ql-blockquote p-1 rounded hover:bg-slate-200 text-slate-700" title="Quote"></button>
                <button type="button" class="ql-link p-1 rounded hover:bg-slate-200 text-slate-700" title="Insert Link"></button>
                <button type="button" class="ql-clean p-1 rounded hover:bg-slate-200 text-slate-700" title="Clear Formatting"></button>
            </div>

            <!-- Quill Editable Container -->
            <div x-ref="quillContainer"
                 class="rich-text-content"
                 dir="{{ $dir }}"
                 style="min-height: {{ $minHeight }};"></div>
        </div>

        <!-- Raw HTML Source Textarea (Shown when mode is 'html', or kept hidden as underlying form field) -->
        <textarea name="{{ $name }}"
                  id="{{ $editorId }}"
                  x-ref="rawTextarea"
                  dir="{{ $dir }}"
                  :class="mode === 'html' ? 'block' : 'hidden'"
                  style="min-height: {{ $minHeight }};"
                  class="w-full text-xs font-mono rounded-xl p-3 text-slate-800 bg-slate-50/50 outline-none leading-relaxed border-0 focus:ring-0 resize-y"
                  placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    </div>

    @if($help)
        <p class="text-[11px] text-slate-400">{{ $help }}</p>
    @endif
</div>

@pushOnce('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
/* Safir Hub Executive Quill Theme Styles */
.ql-toolbar-custom .ql-stroke {
    stroke: #475569 !important;
}
.ql-toolbar-custom .ql-fill {
    fill: #475569 !important;
}
.ql-toolbar-custom button:hover .ql-stroke,
.ql-toolbar-custom button.ql-active .ql-stroke {
    stroke: #A88438 !important;
}
.ql-toolbar-custom button:hover .ql-fill,
.ql-toolbar-custom button.ql-active .ql-fill {
    fill: #A88438 !important;
}
.ql-toolbar-custom .ql-picker-label:hover {
    color: #A88438 !important;
}

/* Editor typography overrides */
.rich-text-content.ql-container {
    border: none !important;
    font-family: inherit !important;
    font-size: 0.8125rem !important;
}
.rich-text-content .ql-editor {
    font-family: inherit !important;
    font-size: 0.8125rem !important;
    line-height: 1.65 !important;
    color: #1E293B !important;
    padding: 0.875rem 1rem !important;
}
.rich-text-content .ql-editor[dir="rtl"] {
    direction: rtl !important;
    text-align: right !important;
    font-family: 'Tajawal', 'Cairo', system-ui, sans-serif !important;
}
.rich-text-content .ql-editor p {
    margin-bottom: 0.625rem !important;
}
.rich-text-content .ql-editor h2 {
    font-size: 1.2rem !important;
    font-weight: 700 !important;
    color: #0A192F !important;
    margin-top: 1rem !important;
    margin-bottom: 0.5rem !important;
}
.rich-text-content .ql-editor h3 {
    font-size: 1.05rem !important;
    font-weight: 600 !important;
    color: #0A192F !important;
    margin-top: 0.75rem !important;
    margin-bottom: 0.375rem !important;
}
.rich-text-content .ql-editor h4 {
    font-size: 0.95rem !important;
    font-weight: 600 !important;
    color: #0A192F !important;
    margin-top: 0.625rem !important;
    margin-bottom: 0.25rem !important;
}
.rich-text-content .ql-editor ul {
    list-style-type: disc !important;
    padding-left: 1.25rem !important;
    margin-bottom: 0.625rem !important;
}
.rich-text-content .ql-editor ol {
    list-style-type: decimal !important;
    padding-left: 1.25rem !important;
    margin-bottom: 0.625rem !important;
}
.rich-text-content .ql-editor[dir="rtl"] ul,
.rich-text-content .ql-editor[dir="rtl"] ol {
    padding-left: 0 !important;
    padding-right: 1.25rem !important;
}
.rich-text-content .ql-editor li {
    margin-bottom: 0.25rem !important;
}
.rich-text-content .ql-editor a {
    color: #A88438 !important;
    text-decoration: underline !important;
    font-weight: 500 !important;
}
.rich-text-content .ql-editor blockquote {
    border-left: 3px solid #C5A059 !important;
    padding-left: 0.75rem !important;
    color: #475569 !important;
    font-style: italic !important;
    margin: 0.625rem 0 !important;
}
.rich-text-content .ql-editor[dir="rtl"] blockquote {
    border-left: none !important;
    border-right: 3px solid #C5A059 !important;
    padding-left: 0 !important;
    padding-right: 0.75rem !important;
}
.rich-text-content .ql-editor.ql-blank::before {
    color: #94A3B8 !important;
    font-style: normal !important;
    font-size: 0.8125rem !important;
    left: 1rem !important;
    right: 1rem !important;
}
.rich-text-content .ql-editor[dir="rtl"].ql-blank::before {
    text-align: right !important;
}
</style>
@endpushOnce

@pushOnce('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
window.richTextEditor = function(config) {
    return {
        mode: 'rich',
        quill: null,
        dir: config.dir || 'ltr',
        
        initEditor() {
            this.$nextTick(() => {
                const container = this.$refs.quillContainer;
                const toolbar = this.$refs.toolbar;
                const textarea = this.$refs.rawTextarea;
                if (!container || !textarea || this.quill) return;

                this.quill = new Quill(container, {
                    theme: 'snow',
                    placeholder: config.placeholder || 'Type formatted content here...',
                    modules: {
                        toolbar: toolbar
                    }
                });

                // Load initial HTML from textarea
                const initialContent = textarea.value || '';
                if (initialContent.trim().length > 0) {
                    this.quill.root.innerHTML = initialContent;
                }

                // If RTL, enforce on editor root
                if (this.dir === 'rtl') {
                    this.quill.root.setAttribute('dir', 'rtl');
                    this.quill.root.style.textAlign = 'right';
                    this.quill.root.style.fontFamily = "'Tajawal', 'Cairo', system-ui, sans-serif";
                }

                // Sync to hidden textarea on change
                this.quill.on('text-change', () => {
                    this.syncToTextarea();
                });

                // Attach to form submit for guaranteed data synchronization
                const form = textarea.closest('form');
                if (form && !form._quillSyncSetup) {
                    form.addEventListener('submit', () => {
                        window.dispatchEvent(new CustomEvent('safir-quill-sync-all'));
                    });
                    form._quillSyncSetup = true;
                }

                window.addEventListener('safir-quill-sync-all', () => {
                    if (this.mode === 'rich') {
                        this.syncToTextarea();
                    }
                });

                // Trigger update on resize / tab switch
                window.addEventListener('resize', () => {
                    if (this.quill && typeof this.quill.update === 'function') {
                        this.quill.update();
                    }
                });
            });
        },

        syncToTextarea() {
            if (!this.quill) return;
            const text = this.quill.getText().trim();
            if (text.length === 0) {
                this.$refs.rawTextarea.value = '';
            } else {
                this.$refs.rawTextarea.value = this.quill.root.innerHTML;
            }
        },

        syncFromTextarea() {
            if (!this.quill) return;
            this.quill.root.innerHTML = this.$refs.rawTextarea.value || '';
        },

        setMode(newMode) {
            if (this.mode === newMode) return;
            if (newMode === 'html') {
                this.syncToTextarea();
                this.mode = 'html';
            } else {
                this.syncFromTextarea();
                this.mode = 'rich';
                this.$nextTick(() => {
                    if (this.quill) {
                        this.quill.update();
                        this.quill.focus();
                    }
                });
            }
        }
    };
};
</script>
@endpushOnce
