@extends('admin.layout')
@section('page-title', 'Announcements')
@section('page-subtitle', 'Broadcast news, events, and updates to the guild homepage')

@section('content')
    <div class="page-header" data-aos="fade-up">
        <div class="page-header__left">
            <h1 class="page-header__title">Guild Announcements</h1>
            <p class="page-header__desc">
                Customize the headline banner that greets every visitor and guild member on the public homepage.
            </p>
        </div>
        <div class="page-header__actions">
            <a href="{{ url('/') }}#announcement" target="_blank" rel="noopener" class="btn btn-secondary">
                <i data-lucide="external-link"></i>
                <span>View on Website</span>
            </a>
        </div>
    </div>

    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 28px; align-items: start;" class="announcement-grid">
        {{-- Left Column: Editor Form --}}
        <div class="glass-card" data-aos="fade-up">
            <div class="card-header">
                <div class="card-title">
                    <i data-lucide="edit-3"></i>
                    <span>Banner Content</span>
                </div>
                <span class="badge badge--cyan" id="editorStatusBadge">
                    {{ ($announcement->is_active ?? true) ? 'Active' : 'Draft' }}
                </span>
            </div>

            <form method="POST" action="{{ route('admin.announcement.update') }}" id="announcement-form">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="title">
                        <span>Headline Title</span>
                        <span class="form-label-hint" id="titleCharCount">0 / 60</span>
                    </label>
                    <input class="form-input" type="text" id="title" name="title"
                           value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" 
                           placeholder="e.g. ANNOUNCEMENTS OR SPECIAL EVENT" required maxlength="60">
                </div>

                <div class="form-group">
                    <label class="form-label" for="content">
                        <span>Announcement Body</span>
                        <span class="form-label-hint" id="contentCharCount">0 / 400</span>
                    </label>
                    <textarea class="form-textarea" id="content" name="content" rows="5" 
                              placeholder="Write your guild announcement message here..." required maxlength="400">{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
                </div>

                <div class="form-group" style="padding:16px; background:rgba(255,255,255,0.02); border:1px solid var(--border); border-radius:var(--radius-sm);">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px;">
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; color:var(--text-primary);">Broadcast Status</div>
                            <div style="font-size:0.78rem; color:var(--text-muted); margin-top:2px;">
                                When enabled, this banner is displayed prominently on the homepage.
                            </div>
                        </div>

                        <label class="toggle">
                            <input type="checkbox" name="is_active" value="1" id="isActiveToggle"
                                {{ ($announcement->is_active ?? true) ? 'checked' : '' }}>
                            <span class="toggle-track">
                                <span class="toggle-thumb"></span>
                            </span>
                            <span class="toggle-text" id="toggleText">
                                {{ ($announcement->is_active ?? true) ? 'Active' : 'Hidden' }}
                            </span>
                        </label>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:12px; margin-top:24px;">
                    <button type="submit" class="btn btn-primary" id="saveBtn">
                        <i data-lucide="save"></i>
                        <span>Save & Publish</span>
                    </button>
                    <button type="reset" class="btn btn-ghost" id="resetBtn">
                        <i data-lucide="rotate-ccw"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Right Column: Live Interactive Simulation Preview --}}
        <div class="glass-card" data-aos="fade-up" data-aos-delay="80">
            <div class="card-header">
                <div class="card-title">
                    <i data-lucide="eye"></i>
                    <span>Live Public Preview</span>
                </div>
                <span class="badge badge--purple">Real-time simulation</span>
            </div>

            <p style="font-size:0.84rem; color:var(--text-muted); margin-bottom:18px;">
                This simulator mirrors how visitors and members view the banner on the public site.
            </p>

            {{-- Realistic Simulation Mockup --}}
            <div style="background:#090913; border:1px solid var(--border); border-radius:var(--radius-lg); padding:32px 24px; text-align:center; position:relative; overflow:hidden; box-shadow:0 14px 40px rgba(0,0,0,0.6);" id="previewWrapper">
                {{-- Glow Orb --}}
                <div style="position:absolute; top:-40px; left:50%; transform:translateX(-50%); width:180px; height:80px; background:radial-gradient(circle, rgba(124, 58, 237, 0.45), transparent 70%); filter:blur(24px); pointer-events:none;"></div>
                
                {{-- Simulated Badge --}}
                <div style="display:inline-flex; align-items:center; gap:6px; padding:4px 14px; border-radius:var(--radius-full); background:rgba(124,58,237,0.15); border:1px solid rgba(124,58,237,0.35); color:var(--accent-purple-glow); font-size:0.75rem; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; margin-bottom:14px;">
                    <i data-lucide="bell" style="width:13px; height:13px;"></i>
                    <span>Official Broadcast</span>
                </div>

                <h2 id="previewTitle" style="font-family:var(--font-heading); font-size:1.6rem; font-weight:800; letter-spacing:0.04em; background:linear-gradient(135deg, #ffffff 40%, var(--accent-cyan-glow) 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; margin-bottom:12px; text-transform:uppercase;">
                    {{ strtoupper($announcement->title ?? 'ANNOUNCEMENTS') }}
                </h2>

                <p id="previewContent" style="font-size:0.95rem; color:#cbd5e1; line-height:1.65; max-width:480px; margin:0 auto 20px;">
                    {{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}
                </p>

                <div style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:var(--radius-full); font-size:0.78rem; font-weight:600;" id="previewStatusBadge">
                    <span id="previewStatusDot" style="width:8px; height:8px; border-radius:50%; background:var(--accent-emerald); box-shadow:0 0 10px var(--accent-emerald-glow);"></span>
                    <span id="previewStatusText" style="color:var(--text-secondary);">Visible to all visitors</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    @media (max-width: 992px) {
        .announcement-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
(function() {
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const toggle = document.getElementById('isActiveToggle');
    const toggleText = document.getElementById('toggleText');
    const previewTitle = document.getElementById('previewTitle');
    const previewContent = document.getElementById('previewContent');
    const previewStatusDot = document.getElementById('previewStatusDot');
    const previewStatusText = document.getElementById('previewStatusText');
    const previewWrapper = document.getElementById('previewWrapper');
    const editorStatusBadge = document.getElementById('editorStatusBadge');
    const titleCharCount = document.getElementById('titleCharCount');
    const contentCharCount = document.getElementById('contentCharCount');

    function updatePreview() {
        const titleVal = titleInput.value || '';
        const contentVal = contentInput.value || '';
        const active = toggle.checked;

        previewTitle.textContent = titleVal ? titleVal.toUpperCase() : 'ANNOUNCEMENTS';
        previewContent.textContent = contentVal || 'Welcome to NightLight Guild! Stay tuned for updates and news.';
        
        titleCharCount.textContent = titleVal.length + ' / 60';
        contentCharCount.textContent = contentVal.length + ' / 400';

        toggleText.textContent = active ? 'Active' : 'Hidden';
        editorStatusBadge.textContent = active ? 'Active' : 'Draft';
        editorStatusBadge.className = 'badge ' + (active ? 'badge--cyan' : 'badge--purple');

        if (active) {
            previewStatusDot.style.background = 'var(--accent-emerald)';
            previewStatusDot.style.boxShadow = '0 0 10px var(--accent-emerald-glow)';
            previewStatusText.textContent = 'Visible to all visitors';
            previewWrapper.style.opacity = '1';
            previewWrapper.style.filter = 'none';
        } else {
            previewStatusDot.style.background = 'var(--accent-amber)';
            previewStatusDot.style.boxShadow = 'none';
            previewStatusText.textContent = 'Hidden (Draft Mode)';
            previewWrapper.style.opacity = '0.75';
        }

        if (window.lucide) lucide.createIcons();
    }

    titleInput.addEventListener('input', updatePreview);
    contentInput.addEventListener('input', updatePreview);
    toggle.addEventListener('change', updatePreview);

    document.getElementById('resetBtn').addEventListener('click', function() {
        setTimeout(updatePreview, 20);
    });

    updatePreview();
})();
</script>
@endpush
