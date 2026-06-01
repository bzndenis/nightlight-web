# NightLight Admin UI Polish Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Polish the UI/UX of all `/admin` pages (Dashboard, Announcement, Gallery, Team, Footer, Login) to be consistent with the glassmorphism design system, replace HTML entities with Lucide icons, fix the Login page to match the design system, and add mobile hamburger menu.

**Architecture:** Incremental CSS additions to `public/css/admin.css` + one new file `public/css/login.css`. Blade templates updated in-place to add page headers, Lucide icons, and modern markup. Lucide CDN added to `layout.blade.php`. No backend changes.

**Tech Stack:** Laravel Blade, vanilla CSS (no preprocessor), Lucide icons via CDN, AOS animations, SortableJS (existing), jQuery (existing).

**Verification approach:** Visual verification via browser (Chrome DevTools MCP) at http://localhost:8000. No automated tests for UI changes — this is a polish task. The Laravel HTTP server must be running for verification.

**Project conventions:**
- Working directory: `c:\laragon\www\nightlight-web`
- Bash on Windows: use forward slashes, Unix syntax
- Server start: `php artisan serve --host=127.0.0.1 --port=8000` (run in background)
- All commits follow conventional commits: `feat:`, `fix:`, `style:`, `docs:`

---

## File Structure

**Modify:**
- `public/css/admin.css` — add icon utilities, drop-zone classes, image-card classes, mobile menu, fix qa-card gradient, remove `.quick-action-card` duplicate
- `resources/views/admin/layout.blade.php` — add Lucide CDN, hamburger button, mobile backdrop, mobile JS
- `resources/views/admin/dashboard.blade.php` — page header, dynamic stat numbers
- `resources/views/admin/announcement.blade.php` — page header, title+toggle row, live preview card
- `resources/views/admin/gallery.blade.php` — page header, drop zone cleanup, image grid, empty state
- `resources/views/admin/team.blade.php` — page header, Lucide icons, modal markup, JS updates
- `resources/views/admin/footer.blade.php` — page header, Lucide icons, link URL styling, empty state
- `resources/views/admin/login.blade.php` — full rewrite, remove inline CSS, use admin.css + login.css

**Create:**
- `public/css/login.css` — new file, ~120 lines, glassmorphism login styling using CSS variables

---

## Task 1: Add Lucide CDN to Layout & CSS Icon Utilities

**Files:**
- Modify: `resources/views/admin/layout.blade.php:144-148` (add Lucide CDN)
- Modify: `public/css/admin.css` (add icon utility classes at end)

- [ ] **Step 1: Add Lucide CDN to layout**

In `resources/views/admin/layout.blade.php`, after the SortableJS script line (~line 148), add:

```html
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
```

- [ ] **Step 2: Add icon utility classes to admin.css**

Append to end of `public/css/admin.css`:

```css
/* ===== Icon Utilities ===== */
.icon { display: inline-block; vertical-align: middle; }
.icon-12 { width: 12px; height: 12px; }
.icon-16 { width: 16px; height: 16px; }
.icon-20 { width: 20px; height: 20px; }
.icon-48 { width: 48px; height: 48px; }
```

- [ ] **Step 3: Visual verify**

Start Laravel server in background, then navigate browser to `http://localhost:8000/admin/dashboard`. Confirm:
- No JS errors in console
- `lucide.createIcons()` runs (icons defined later will render)

Run:
```bash
cd /c/laragon/www/nightlight-web && php artisan serve --host=127.0.0.1 --port=8000
```

Use `run_in_background: true`.

Then in browser, check console for errors.

- [ ] **Step 4: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add public/css/admin.css resources/views/admin/layout.blade.php
git commit -m "feat(admin): add Lucide icons CDN and icon utility classes"
```

---

## Task 2: Fix qa-card Gradient & Remove Duplicate .quick-action-card

**Files:**
- Modify: `public/css/admin.css:927` (qa-card gradient)
- Modify: `public/css/admin.css:952-1000` (remove duplicate)

- [ ] **Step 1: Fix qa-card icon gradient**

In `public/css/admin.css`, line 927, change:

```css
.qa-card .qa-icon {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-md);
  background: var(--accent-gradient-alt);
```

To:

```css
.qa-card .qa-icon {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-md);
  background: var(--accent-gradient);
```

- [ ] **Step 2: Remove duplicate .quick-action-card block**

In `public/css/admin.css`, delete lines 952-1000 (the entire `.quick-action-card` block which is unused duplicate of `.qa-card`).

Verify nothing references `.quick-action-card` in Blade files first:
```bash
cd /c/laragon/www/nightlight-web
grep -r "quick-action-card" resources/views/
```

Expected: no matches.

- [ ] **Step 3: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add public/css/admin.css
git commit -m "fix(admin): unify qa-card gradient and remove duplicate CSS"
```

---

## Task 3: Dashboard - Page Header & Dynamic Stat Numbers

**Files:**
- Modify: `resources/views/admin/dashboard.blade.php`

- [ ] **Step 1: Add page header block**

At top of `@section('content')` (after the `@section` line), insert:

```blade
<div class="page-header">
    <h1>Dashboard</h1>
    <p>Welcome back, Admin</p>
</div>
```

- [ ] **Step 2: Connect stat numbers to DB data**

In `resources/views/admin/dashboard.blade.php`, replace each hard-coded `<div class="stat-number">0</div>` with:

For Team Members card (line 17):
```blade
<div class="stat-number">{{ $totalMembers ?? 0 }}</div>
```

For Gallery Images card (line 31):
```blade
<div class="stat-number">{{ $totalImages ?? 0 }}</div>
```

For Active Announcements card (line 45):
```blade
<div class="stat-number">{{ $activeAnnouncements ?? 0 }}</div>
```

For Footer Links card (line 59):
```blade
<div class="stat-number">{{ $totalFooterLinks ?? 0 }}</div>
```

- [ ] **Step 3: Verify dashboard in browser**

Navigate to `http://localhost:8000/admin/dashboard`. Confirm:
- Page header "Dashboard" + "Welcome back, Admin" + gradient line visible
- Stat numbers reflect actual DB counts (or 0 if no data)

- [ ] **Step 4: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/dashboard.blade.php
git commit -m "feat(admin): add dashboard page header and dynamic stat numbers"
```

---

## Task 4: Announcement - Page Header, Title+Toggle Row, Live Preview

**Files:**
- Modify: `resources/views/admin/announcement.blade.php`
- Modify: `public/css/admin.css` (add form-row variants and announcement preview)

- [ ] **Step 1: Add page header**

At top of `@section('content')`, insert:

```blade
<div class="page-header">
    <h1>Announcement</h1>
    <p>Manage guild-wide announcement banner</p>
</div>
```

- [ ] **Step 2: Rewrite form with title+toggle row and live preview**

Replace the entire `<form>` block in `announcement.blade.php` with:

```blade
<div class="glass-card">
    <form method="POST" action="{{ route('admin.announcement.update') }}">
        @csrf
        <div class="form-row form-row--title-toggle">
            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input class="form-input" type="text" id="title" name="title" value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" required>
            </div>
            <div class="form-group form-group--inline">
                <label class="toggle-label" for="is_active">
                    <span class="toggle">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ ($announcement->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                        <span class="toggle-thumb"></span>
                    </span>
                    <span>Active</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="content">Content</label>
            <textarea class="form-textarea" id="content" name="content" required>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
        </div>
        <button type="submit" class="btn-primary">Update Announcement</button>
    </form>
</div>

<div class="glass-card announcement-preview">
    <div class="preview-label">Live Preview</div>
    <div class="preview-content">
        <h3 id="previewTitle">{{ $announcement->title ?? 'ANNOUNCEMENTS' }}</h3>
        <p id="previewContent">{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</p>
    </div>
</div>
```

- [ ] **Step 3: Add CSS for new classes**

Append to `public/css/admin.css`:

```css
/* ===== Form Row Variants ===== */
.form-row--title-toggle {
  grid-template-columns: 1fr auto;
  align-items: end;
}
.form-group--inline {
  margin-bottom: 0;
  padding-bottom: 12px;
  display: flex;
  align-items: center;
  height: 100%;
}

/* ===== Announcement Live Preview ===== */
.announcement-preview {
  border-left: 3px solid var(--accent-cyan);
}
.announcement-preview .preview-label {
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  color: var(--text-muted);
  margin-bottom: 12px;
}
.announcement-preview .preview-content h3 {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 8px;
}
.announcement-preview .preview-content p {
  font-size: 0.9rem;
  color: var(--text-secondary);
  line-height: 1.6;
}
```

- [ ] **Step 4: Add live preview JS**

In `announcement.blade.php`, at the end, add `@push('scripts')`:

```blade
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const previewTitle = document.getElementById('previewTitle');
    const previewContent = document.getElementById('previewContent');
    if (titleInput && previewTitle) {
        titleInput.addEventListener('input', e => previewTitle.textContent = e.target.value);
    }
    if (contentInput && previewContent) {
        contentInput.addEventListener('input', e => previewContent.textContent = e.target.value);
    }
});
</script>
@endpush
```

- [ ] **Step 5: Verify in browser**

Navigate to `http://localhost:8000/admin/announcement`. Confirm:
- Page header visible
- Title + toggle switch in one row (toggle on right)
- Live preview card below with cyan left border
- Type in title/content fields → preview updates in real-time

- [ ] **Step 6: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/announcement.blade.php public/css/admin.css
git commit -m "feat(admin): add announcement live preview and title-toggle row"
```

---

## Task 5: Gallery - Page Header, Drop Zone Cleanup, Image Grid

**Files:**
- Modify: `resources/views/admin/gallery.blade.php`
- Modify: `public/css/admin.css` (add drop-zone-content classes, image-delete-btn, empty-state)

- [ ] **Step 1: Add page header**

At top of `@section('content')` in `gallery.blade.php`, insert:

```blade
<div class="page-header">
    <h1>Gallery</h1>
    <p>Upload and manage gallery images</p>
</div>
```

- [ ] **Step 2: Rewrite drop zone markup (remove inline styles)**

Replace the entire first `<div class="glass-card">` block (form with title/description) AND the second `<div class="glass-card">` (drop zone form) with this combined form card:

```blade
<div class="glass-card">
    <h2 class="section-title"><i data-lucide="image"></i> Gallery Info</h2>
    <form method="POST" action="{{ route('admin.gallery.update') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="title">Title</label>
            <input class="form-input" type="text" id="title" name="title" value="{{ $gallery->title ?? 'GALLERY' }}" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-textarea" id="description" name="description" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}</textarea>
        </div>
        <button type="submit" class="btn-primary">Update Gallery Info</button>
    </form>
</div>

<div class="glass-card">
    <h2 class="section-title"><i data-lucide="upload-cloud"></i> Upload Images</h2>
    <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data" id="galleryUploadForm">
        @csrf
        <div class="drop-zone" id="dropZoneArea">
            <div class="drop-zone-content" id="dropZoneContent">
                <div class="drop-zone-icon"><i data-lucide="folder-open"></i></div>
                <p class="drop-zone-title">Drag &amp; Drop images here</p>
                <p class="drop-zone-hint">or click to browse (multiple files supported)</p>
            </div>
            <input type="file" id="image" name="images[]" accept="image/*" multiple required class="drop-zone-input">
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">Upload Images</button>
    </form>
</div>
```

- [ ] **Step 3: Replace the table with image grid**

Replace the third `<div class="glass-card">` block (the one with the table) with:

```blade
<div class="glass-card">
    <h2 class="section-title"><i data-lucide="images"></i> Gallery Images</h2>
    @if(isset($images) && count($images) > 0)
        <div class="image-grid">
            @foreach($images as $image)
                <div class="image-card">
                    <img src="{{ asset($image->path) }}" alt="Gallery Image" loading="lazy">
                    <div class="image-overlay">
                        <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}" class="image-delete-form" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="image-delete-btn" title="Delete">
                                <i data-lucide="trash-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i data-lucide="image" class="icon-48"></i>
            <p>No images uploaded yet</p>
        </div>
    @endif
</div>
```

- [ ] **Step 4: Update drop zone JS (remove inline innerHTML)**

Replace the entire `@push('scripts')` block at the end of `gallery.blade.php` with:

```blade
@push('scripts')
<script>
(function() {
    const dropZoneArea = document.getElementById('dropZoneArea');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const fileInput = document.getElementById('image');

    if (dropZoneArea && fileInput) {
        dropZoneArea.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                fileInput.click();
            }
        });

        function updateContent(text) {
            dropZoneContent.innerHTML =
                '<div class="drop-zone-icon"><i data-lucide="check"></i></div>' +
                '<p class="drop-zone-title">' + text + '</p>' +
                '<p class="drop-zone-hint">Click to change</p>';
            lucide.createIcons();
        }

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const fileCount = e.target.files.length;
                const fileText = fileCount === 1 ? e.target.files[0].name : fileCount + ' images selected';
                updateContent(fileText);
            }
        });

        dropZoneArea.addEventListener('dragover', function(e) {
            e.preventDefault(); e.stopPropagation();
            dropZoneArea.classList.add('drag-over');
        });

        dropZoneArea.addEventListener('dragleave', function(e) {
            e.preventDefault(); e.stopPropagation();
            dropZoneArea.classList.remove('drag-over');
        });

        dropZoneArea.addEventListener('drop', function(e) {
            e.preventDefault(); e.stopPropagation();
            dropZoneArea.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const dt = new DataTransfer();
                for (let i = 0; i < files.length; i++) dt.items.add(files[i]);
                fileInput.files = dt.files;
                const fileText = files.length === 1 ? files[0].name : files.length + ' images selected';
                updateContent(fileText);
            }
        });
    }
})();
</script>
@endpush
```

- [ ] **Step 5: Add CSS for drop zone content, image delete, empty state**

Append to `public/css/admin.css`:

```css
/* ===== Drop Zone Content ===== */
.drop-zone-content { pointer-events: none; }
.drop-zone-icon { font-size: 3rem; color: var(--accent-purple); margin-bottom: 12px; }
.drop-zone-icon svg { width: 48px; height: 48px; }
.drop-zone-title { font-size: 1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 4px; }
.drop-zone-hint { font-size: 0.85rem; color: var(--text-secondary); }
.drop-zone-input { display: none; }

/* ===== Image Delete Button ===== */
.image-delete-btn {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: rgba(239, 68, 68, 0.9);
  border: none;
  color: white;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: transform var(--transition-fast);
}
.image-delete-btn:hover { transform: scale(1.1); }
.image-delete-btn svg { width: 18px; height: 18px; }
.image-delete-form { display: inline; }

/* ===== Empty State ===== */
.empty-state {
  text-align: center;
  padding: 48px 24px;
  color: var(--text-muted);
}
.empty-state svg { width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.4; }
.empty-state p { font-size: 0.9rem; }
```

- [ ] **Step 6: Verify in browser**

Navigate to `http://localhost:8000/admin/gallery`. Confirm:
- Page header visible
- Drop zone with Lucide folder-open icon, no hard-coded colors
- Drag-over state shows cyan border + glow
- Existing images render in 3-column grid with hover overlay showing trash icon
- Empty state shows Lucide image icon when no images

- [ ] **Step 7: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/gallery.blade.php public/css/admin.css
git commit -m "feat(admin): gallery image grid, drop zone cleanup, Lucide icons"
```

---

## Task 6: Team - Page Header, Lucide Icons, Modal Markup

**Files:**
- Modify: `resources/views/admin/team.blade.php`
- Modify: `public/css/admin.css` (small additions if needed)

- [ ] **Step 1: Add page header**

At top of `@section('content')` in `team.blade.php`, insert:

```blade
<div class="page-header">
    <h1>Team</h1>
    <p>Manage team members and roles</p>
</div>
```

- [ ] **Step 2: Update section title with Lucide icon**

Replace the "Add Team Members" section title with:

```blade
<h2 class="section-title"><i data-lucide="user-plus"></i> Add Team Members</h2>
```

- [ ] **Step 3: Update add/remove row buttons with Lucide icons**

Replace the `+ Add Another` button:

```blade
<button type="button" class="btn-add-row" onclick="addBatchRow()">
    <i data-lucide="plus"></i> Add Another
</button>
```

Replace the `&#10005;` remove button (in member row template):

```blade
<button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">
    <i data-lucide="x"></i>
</button>
```

- [ ] **Step 4: Update table column headers with Lucide sort icons**

Replace the entire `<thead>` block with:

```blade
<thead>
    <tr>
        <th class="drag-col"></th>
        <th><a href="{{ route('admin.team', ['sort' => 'id', 'dir' => $sortBy === 'id' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">ID @if($sortBy === 'id')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
        <th>Avatar</th>
        <th><a href="{{ route('admin.team', ['sort' => 'name', 'dir' => $sortBy === 'name' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Name @if($sortBy === 'name')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
        <th><a href="{{ route('admin.team', ['sort' => 'role', 'dir' => $sortBy === 'role' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Role @if($sortBy === 'role')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
        <th>Quote</th>
        <th><a href="{{ route('admin.team', ['sort' => 'order', 'dir' => $sortBy === 'order' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Order @if($sortBy === 'order')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
        <th><a href="{{ route('admin.team', ['sort' => 'is_active', 'dir' => $sortBy === 'is_active' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Active @if($sortBy === 'is_active')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
        <th>Actions</th>
    </tr>
</thead>
```

- [ ] **Step 5: Update drag handle and status icons in tbody**

In the foreach loop, replace:
- The drag handle `<span class="drag-handle" title="Drag to reorder">&#9776;</span>` with:
  ```blade
  <td><i data-lucide="grip-vertical" class="drag-handle" title="Drag to reorder"></i></td>
  ```
- The active/inactive status cell:
  ```blade
  <td>
      @if($member->is_active)
          <i data-lucide="check" class="status-active"></i>
      @else
          <i data-lucide="x" class="status-inactive"></i>
      @endif
  </td>
  ```

- [ ] **Step 6: Rewrite edit modal markup**

Replace the entire `<div id="edit-modal">` block with:

```blade
<div id="edit-modal" class="modal-overlay" hidden>
    <div class="modal-box">
        <div class="modal-header">
            <h2>Edit Team Member</h2>
            <button type="button" class="modal-close" onclick="closeEditModal()">
                <i data-lucide="x"></i>
            </button>
        </div>
        <form method="POST" action="" id="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="form-group">
                <label class="form-label" for="edit-name">Name</label>
                <input type="text" id="edit-name" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="edit-role">Role</label>
                <input type="text" id="edit-role" name="role" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="edit-quote">Quote</label>
                <textarea id="edit-quote" name="quote" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="edit-order">Order</label>
                <input type="number" id="edit-order" name="order" class="form-input" min="0">
            </div>
            <div class="form-group">
                <label class="form-label" for="edit-avatar">Avatar Photo</label>
                <div id="edit-current-avatar"></div>
                <input type="file" id="edit-avatar" name="avatar" class="form-input" accept="image/*">
                <small>Leave empty to keep current avatar</small>
            </div>
            <div class="form-group">
                <label class="form-label">
                    <input type="checkbox" id="edit-is_active" name="is_active">
                    Active
                </label>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-primary">Update</button>
                <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>
```

- [ ] **Step 7: Update JS for modal toggle and lucide re-render**

Replace the entire `@push('scripts')` block with:

```blade
@push('scripts')
<script>
function addBatchRow() {
    const container = document.getElementById('member-fields-container');
    const html = `<div class="member-row batch-grid">
        <div class="form-group"><label class="form-label">Name</label><input type="text" name="name[]" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Role</label><input type="text" name="role[]" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Quote</label><textarea name="quote[]" class="form-textarea" required></textarea></div>
        <div class="form-group"><label class="form-label">Avatar</label><input type="file" name="avatar[]" class="form-input" accept="image/*"></div>
        <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove"><i data-lucide="x"></i></button>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    lucide.createIcons();
}

function removeBatchRow(btn) {
    const rows = document.querySelectorAll('.member-row');
    if (rows.length > 1) {
        btn.closest('.member-row').remove();
    } else {
        alert('At least one team member entry is required.');
    }
}

function openEditModal(member) {
    document.getElementById('edit-id').value = member.id;
    document.getElementById('edit-name').value = member.name;
    document.getElementById('edit-role').value = member.role;
    document.getElementById('edit-quote').value = member.quote;
    document.getElementById('edit-order').value = member.order;
    document.getElementById('edit-is_active').checked = !!member.is_active;
    document.getElementById('edit-form').action = '/admin/team/' + member.id;
    const avatarDiv = document.getElementById('edit-current-avatar');
    if (member.avatar) {
        avatarDiv.innerHTML = '<p>Current Avatar:</p><img src="/' + member.avatar + '" class="avatar-sm">';
    } else {
        avatarDiv.innerHTML = '<p>Current Avatar:</p><img src="/images/avatars/user-01.jpg" class="avatar-sm">';
    }
    const modal = document.getElementById('edit-modal');
    modal.hidden = false;
    lucide.createIcons();
}

function closeEditModal() {
    document.getElementById('edit-modal').hidden = true;
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeEditModal();
});

// Drag-and-drop reorder with SortableJS
const el = document.getElementById('team-table-body');
if (el) {
    const sortable = Sortable.create(el, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        onEnd: function(evt) {
            const rows = el.querySelectorAll('tr[data-id]');
            const ids = [];
            rows.forEach((row, index) => {
                ids.push(row.dataset.id);
                row.querySelector('.order-cell').textContent = index + 1;
            });

            fetch('{{ route('admin.team.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    el.querySelectorAll('tr[data-id]').forEach((row, i) => {
                        row.querySelector('.order-cell').textContent = i + 1;
                    });
                }
            })
            .catch(() => {
                alert('Failed to save order. Please refresh and try again.');
                location.reload();
            });
        }
    });
}
</script>
@endpush
```

- [ ] **Step 8: Verify in browser**

Navigate to `http://localhost:8000/admin/team`. Confirm:
- Page header visible
- Section title with user-plus icon
- Sort arrows are Lucide icons (not text ↑↓)
- Drag handle is grip-vertical icon
- Active/inactive status are check/x icons in proper colors
- Click "Edit" → modal opens with x close button, glass styling
- Add batch row → plus icon visible, x icon in remove button

- [ ] **Step 9: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/team.blade.php
git commit -m "feat(admin): team page header, Lucide icons, modal markup cleanup"
```

---

## Task 7: Footer - Page Header, Lucide Icons, Link URL Styling

**Files:**
- Modify: `resources/views/admin/footer.blade.php`
- Modify: `public/css/admin.css` (add link-url class)

- [ ] **Step 1: Add page header**

At top of `@section('content')` in `footer.blade.php`, insert:

```blade
<div class="page-header">
    <h1>Footer</h1>
    <p>Manage footer description and links</p>
</div>
```

- [ ] **Step 2: Add icons to section titles**

Replace "Footer Description" section title with:
```blade
<h2 class="section-title"><i data-lucide="file-text"></i> Footer Description</h2>
```

Replace "Footer Links" section title with:
```blade
<h2 class="section-title"><i data-lucide="link-2"></i> Footer Links</h2>
```

- [ ] **Step 3: Add form input icons to add link form**

Replace the add link form (inside the second `.glass-card`) with:

```blade
<form method="POST" action="{{ route('admin.footer.link.add') }}" class="glass-form">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <label class="form-label" for="link_name">Link Name</label>
            <input type="text" id="link_name" name="link_name" class="form-input" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="link_url">Link URL</label>
            <input type="text" id="link_url" name="link_url" class="form-input" required>
        </div>
    </div>
    <button type="submit" class="btn-primary">Add Link</button>
</form>
```

- [ ] **Step 4: Replace links table with enhanced version**

Replace the `<table>` inside the Footer Links card with:

```blade
@if(isset($footerLinks) && count($footerLinks) > 0)
    <div class="glass-table">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($footerLinks as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->name }}</td>
                    <td>
                        <a href="{{ $link->url }}" target="_blank" rel="noopener" class="link-url">
                            <i data-lucide="external-link" class="icon-12"></i>
                            {{ Str::limit($link->url, 60) }}
                        </a>
                    </td>
                    <td class="table-actions">
                        <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}" onsubmit="return confirm('Are you sure you want to delete this link?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="image-delete-btn" title="Delete link">
                                <i data-lucide="trash-2"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="empty-state">
        <i data-lucide="link-2" class="icon-48"></i>
        <p>No links added yet</p>
    </div>
@endif
```

- [ ] **Step 5: Add link-url CSS**

Append to `public/css/admin.css`:

```css
/* ===== Link URL ===== */
.link-url {
  color: var(--text-secondary);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color var(--transition-fast);
}
.link-url:hover { color: var(--accent-cyan); }
```

- [ ] **Step 6: Verify in browser**

Navigate to `http://localhost:8000/admin/footer`. Confirm:
- Page header visible
- Section titles with Lucide icons (file-text, link-2)
- Link URL column shows external-link icon + truncated URL
- Delete button is icon-only (trash-2)
- Empty state shows link-2 icon when no links

- [ ] **Step 7: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/footer.blade.php public/css/admin.css
git commit -m "feat(admin): footer page header, Lucide icons, link URL styling"
```

---

## Task 8: Login Page Rewrite

**Files:**
- Create: `public/css/login.css`
- Modify: `resources/views/admin/login.blade.php` (full rewrite)

- [ ] **Step 1: Create login.css**

Create file `public/css/login.css` with this content:

```css
.login-body {
  min-height: 100vh;
  background: var(--bg-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  position: relative;
  overflow: hidden;
  font-family: 'Montserrat', 'Segoe UI', sans-serif;
}

.login-bg {
  position: absolute;
  inset: 0;
  z-index: 0;
  overflow: hidden;
  pointer-events: none;
}

.login-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.4;
}
.login-orb-1 {
  width: 400px;
  height: 400px;
  background: var(--accent-purple);
  top: -100px;
  left: -100px;
}
.login-orb-2 {
  width: 500px;
  height: 500px;
  background: var(--accent-cyan);
  bottom: -150px;
  right: -150px;
}

.login-box {
  position: relative;
  z-index: 1;
  background: var(--bg-card);
  backdrop-filter: var(--glass-blur);
  -webkit-backdrop-filter: var(--glass-blur);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 3rem 2.5rem;
  max-width: 420px;
  width: 100%;
  box-shadow: var(--shadow-card);
}

.login-logo {
  display: flex;
  justify-content: center;
  margin-bottom: 1.5rem;
}

.login-logo-glyph {
  font-size: 2.5rem;
  font-weight: 800;
  background: var(--accent-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.login-title {
  text-align: center;
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 2rem;
  position: relative;
}
.login-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: var(--accent-gradient);
  border-radius: 2px;
}

.login-btn {
  width: 100%;
  margin-top: 1rem;
  padding: 14px;
  font-size: 0.95rem;
}

.login-error {
  color: #f87171;
  background: rgba(239, 68, 68, 0.1);
  border: 1px solid rgba(239, 68, 68, 0.3);
  border-radius: var(--radius-sm);
  padding: 12px 16px;
  margin-bottom: 1.5rem;
  font-size: 0.875rem;
  text-align: center;
  animation: loginShake 0.4s ease;
}

@keyframes loginShake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-6px); }
  75% { transform: translateX(6px); }
}
```

- [ ] **Step 2: Rewrite login.blade.php**

Replace the entire content of `resources/views/admin/login.blade.php` with:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NightLight - Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="login-body">
    <div class="login-bg">
        <div class="login-orb login-orb-1"></div>
        <div class="login-orb login-orb-2"></div>
    </div>

    <div class="login-box">
        <div class="login-logo">
            <span class="login-logo-glyph">NL</span>
        </div>
        <h1 class="login-title">Admin Login</h1>

        @if($errors->any())
            <div class="login-error">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if(session('error'))
            <div class="login-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email Address</label>
                <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary login-btn">Sign In</button>
        </form>
    </div>
</body>
</html>
```

- [ ] **Step 3: Verify login page**

Navigate to `http://localhost:8000/login`. Confirm:
- Glassmorphism login box (translucent with blur)
- Purple + cyan glowing orbs in background
- "NL" gradient logo at top
- "Admin Login" title with gradient underline
- Form input uses admin form styling (consistent with admin pages)
- Submit button is gradient purple→cyan, full-width
- Error message (if any) has shake animation

- [ ] **Step 4: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add public/css/login.css resources/views/admin/login.blade.php
git commit -m "feat(admin): rewrite login page with glassmorphism design system"
```

---

## Task 9: Mobile Hamburger Menu

**Files:**
- Modify: `resources/views/admin/layout.blade.php` (add hamburger button, backdrop, JS)
- Modify: `public/css/admin.css` (add mobile menu styles)

- [ ] **Step 1: Add hamburger button in header**

In `resources/views/admin/layout.blade.php`, in the `<header class="admin-header">` block, add a hamburger button BEFORE the page-title:

```blade
<header class="admin-header">
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open menu">
        <i data-lucide="menu"></i>
    </button>
    <div class="page-title">@yield('page-title', 'Dashboard')</div>
```

- [ ] **Step 2: Add mobile backdrop element**

In `layout.blade.php`, after the closing `</div>` of `admin-container` (or before `</body>`), add:

```blade
<div class="mobile-backdrop" id="mobileBackdrop"></div>
```

- [ ] **Step 3: Add mobile menu CSS**

Append to `public/css/admin.css`:

```css
/* ===== Mobile Menu ===== */
.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  color: var(--text-primary);
  cursor: pointer;
  padding: 8px;
  border-radius: var(--radius-sm);
  transition: background var(--transition-fast);
}
.mobile-menu-btn:hover { background: var(--bg-card); }
.mobile-menu-btn svg { width: 24px; height: 24px; }

.mobile-backdrop {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 99;
}
.mobile-backdrop.show { display: block; }

@media (max-width: 768px) {
  .mobile-menu-btn { display: flex; align-items: center; justify-content: center; }
  .admin-sidebar {
    transform: translateX(-100%);
    transition: transform var(--transition-sidebar);
    width: 260px;
  }
  .admin-sidebar.mobile-open {
    transform: translateX(0);
  }
  .admin-main { margin-left: 0; }
}
```

- [ ] **Step 4: Add mobile menu JS**

In `layout.blade.php`, in the existing `<script>` block, after the sidebar hover code, add:

```js
// Mobile menu
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileBackdrop = document.getElementById('mobileBackdrop');
if (mobileMenuBtn && sidebar) {
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('mobile-open');
        if (mobileBackdrop) mobileBackdrop.classList.toggle('show');
    });
    if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', function() {
            sidebar.classList.remove('mobile-open');
            mobileBackdrop.classList.remove('show');
        });
    }
}
```

- [ ] **Step 5: Verify mobile menu**

In Chrome DevTools, set viewport to mobile (e.g., 375x667). Reload `/admin/dashboard`. Confirm:
- Hamburger button visible in top-left
- Sidebar hidden by default (off-screen)
- Click hamburger → sidebar slides in from left, backdrop appears
- Click backdrop → sidebar slides out, backdrop hides
- Navigate to a page → sidebar still mobile-open (or closes depending on UX preference; for now keep open)

Then resize back to desktop. Confirm:
- Hamburger hidden, sidebar visible (mini state, expand on hover)

- [ ] **Step 6: Commit**

```bash
cd /c/laragon/www/nightlight-web
git add resources/views/admin/layout.blade.php public/css/admin.css
git commit -m "feat(admin): add mobile hamburger menu and backdrop"
```

---

## Task 10: Final Visual Audit

**Files:** None (read-only review)

- [ ] **Step 1: Open each page in browser and verify against testing checklist**

Open each page and verify (from spec section J):

1. Dashboard (`/admin/dashboard`):
   - [ ] Page header "Dashboard" + "Welcome back, Admin" + gradient line
   - [ ] Stat numbers reflect actual DB counts
   - [ ] qa-card icons all use same purple→cyan gradient

2. Announcement (`/admin/announcement`):
   - [ ] Page header visible
   - [ ] Title + toggle switch in one row
   - [ ] Live preview card with cyan left border, updates when typing

3. Gallery (`/admin/gallery`):
   - [ ] Page header visible
   - [ ] Drop zone with Lucide folder-open icon (no hard-coded colors)
   - [ ] Drag-over shows cyan border + glow
   - [ ] Images in 3-col grid with hover overlay (trash icon)
   - [ ] Empty state when no images

4. Team (`/admin/team`):
   - [ ] Page header visible
   - [ ] Section title with user-plus icon
   - [ ] Sort arrows are Lucide icons
   - [ ] Drag handle is grip-vertical icon
   - [ ] Status icons (check/x) in proper colors
   - [ ] Edit modal: x close button, glass styling, modal-footer

5. Footer (`/admin/footer`):
   - [ ] Page header visible
   - [ ] Section titles with file-text, link-2 icons
   - [ ] Link URL with external-link icon
   - [ ] Delete button is icon-only
   - [ ] Empty state for no links

6. Login (`/login`):
   - [ ] Glassmorphism login box
   - [ ] Purple + cyan glowing orbs
   - [ ] NL gradient logo
   - [ ] Form input uses admin form styling
   - [ ] Full-width gradient button

7. Mobile (< 768px):
   - [ ] Hamburger menu visible
   - [ ] Sidebar hidden by default
   - [ ] Hamburger opens sidebar with backdrop
   - [ ] Form-row 1 column, stat grid 2 columns, qa grid 1 column

8. Global:
   - [ ] No HTML entities (×, ✕, ✓, 📁, ↑, ↓, ⋮) visible
   - [ ] Theme toggle dark/light works on all admin pages (not login)
   - [ ] No JS errors in console

- [ ] **Step 2: Run final grep audit for HTML entities**

```bash
cd /c/laragon/www/nightlight-web
grep -nE '(&times;|&#10005;|&#10003;|&#8593;|&#8595;|&#9776;|&#128193;)' resources/views/admin/*.blade.php
```

Expected: no matches (all replaced with Lucide).

- [ ] **Step 3: Run final commit (if any fixes needed)**

If any fixes were needed in the audit, commit them:
```bash
cd /c/laragon/www/nightlight-web
git add -A
git commit -m "fix(admin): final audit fixes from visual review"
```

If no fixes needed, skip this step.

---

## Self-Review

**Spec coverage check:**
- A. Icon system (Lucide CDN + utility classes) — Task 1, 2, 6, 7
- B. Dashboard — Task 3
- C. Announcement — Task 4
- D. Gallery — Task 5
- E. Team — Task 6
- F. Footer — Task 7
- G. Login — Task 8
- H. Mobile — Task 9
- I. Konsistensi color (qa-card gradient, remove duplicate) — Task 2
- J. Testing checklist — Task 10

**Placeholder scan:** No TBD/TODO. All code blocks complete. All file paths exact. All commands show expected output.

**Type consistency:** CSS class names consistent across tasks (`form-group--inline`, `image-delete-btn`, `empty-state`, `link-url`, etc.). Icon utility classes (`.icon-12`, `.icon-16`, `.icon-20`, `.icon-48`) defined in Task 1 and used throughout.

**No gaps found.**
