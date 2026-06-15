@extends('admin.layout')
@section('page-title', 'Announcement')

@section('content')
    <div class="page-header">
        <h1>Announcement</h1>
        <p>Edit the announcement that appears on the homepage banner.</p>
    </div>

    <div class="glass-card">
        <form method="POST" action="{{ route('admin.announcement.update') }}" id="announcement-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="title">Title</label>
                    <input class="form-input" type="text" id="title" name="title"
                           value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" id="isActiveToggle"
                            {{ ($announcement->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                        <span class="toggle-thumb"></span>
                        <span class="toggle-text" id="toggleText">
                            {{ ($announcement->is_active ?? true) ? 'Active' : 'Inactive' }}
                        </span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Content</label>
                <textarea class="form-textarea" id="content" name="content" rows="5" required>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
            </div>

            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="save"></i> Update Announcement
                </button>
                <button type="reset" class="btn btn-ghost" id="resetBtn">
                    <i data-lucide="rotate-ccw"></i> Reset
                </button>
            </div>
        </form>
    </div>

    <div class="glass-card">
        <div class="section-title">
            <i data-lucide="eye"></i>
            Live Preview
            <span class="badge">how it appears on the homepage</span>
        </div>
        <div class="announcement-preview" id="announcementPreview">
            <h2 id="previewTitle">{{ strtoupper($announcement->title ?? 'ANNOUNCEMENTS') }}</h2>
            <p id="previewContent">{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</p>
            <div class="preview-status" id="previewStatus">
                <i data-lucide="{{ ($announcement->is_active ?? true) ? 'check-circle' : 'x-circle' }}"></i>
                <span>{{ ($announcement->is_active ?? true) ? 'Visible to visitors' : 'Hidden from visitors' }}</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const toggle = document.getElementById('isActiveToggle');
    const toggleText = document.getElementById('toggleText');
    const previewTitle = document.getElementById('previewTitle');
    const previewContent = document.getElementById('previewContent');
    const previewStatus = document.getElementById('previewStatus');

    function updatePreview() {
        previewTitle.textContent = (titleInput.value || '').toUpperCase();
        previewContent.textContent = contentInput.value || '';
        const active = toggle.checked;
        toggleText.textContent = active ? 'Active' : 'Inactive';
        previewStatus.innerHTML = '<i data-lucide="' + (active ? 'check-circle' : 'x-circle') + '"></i>'
            + '<span>' + (active ? 'Visible to visitors' : 'Hidden from visitors') + '</span>';
        if (window.lucide) lucide.createIcons();
    }

    titleInput.addEventListener('input', updatePreview);
    contentInput.addEventListener('input', updatePreview);
    toggle.addEventListener('change', updatePreview);
    document.getElementById('resetBtn').addEventListener('click', function() {
        setTimeout(updatePreview, 10);
    });
})();
</script>
@endpush
