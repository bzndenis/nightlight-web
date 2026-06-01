# NightLight Admin — UI/UX Final Polish Design

## Overview

Menyempurnakan UI/UX semua halaman `/admin` (dashboard, announcement, gallery, team, footer, login) agar konsisten dengan glassmorphism design system yang sudah ada di `public/css/admin.css`. Pendekatan: perbaiki inkonsistensi, lengkapi komponen yang hilang, dan konversi semua HTML entity ke Lucide icons.

Spec ini **melengkapi** spec glassmorphism existing (`2026-06-01-nightlight-admin-glassmorphism-design.md`), bukan menggantinya. CSS variables, layout shell, dark/light toggle sudah final dan tidak diubah.

---

## Scope

**In scope:**
- Dashboard, Announcement, Gallery, Team, Footer, Login
- `public/css/admin.css` (perubahan tambahan, tidak replace)
- `public/css/login.css` (file baru)
- `resources/views/admin/*.blade.php` (semua halaman)
- `resources/views/admin/layout.blade.php` (tambah Lucide CDN, hamburger menu)

**Out of scope:**
- Backend logic, route, controller
- Database schema, migration
- Frontend public pages (homepage dll)
- Auth flow / middleware
- Performance optimization

---

## A. Icon System (global)

Tambah Lucide icons via CDN di `layout.blade.php`:

```html
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
```

Tambah CSS utility di `admin.css`:

```css
.icon { display: inline-block; vertical-align: middle; }
.icon-16 { width: 16px; height: 16px; }
.icon-20 { width: 20px; height: 20px; }
```

**Mapping entity → Lucide:**
| HTML entity | Lucide | Lokasi |
|---|---|---|
| `&times;` (modal close, alert close) | `x` | layout, team modal |
| `&#10005;` (inactive status, remove row) | `x` | team, batch add |
| `&#10003;` (active status) | `check` | team |
| `&#8593;` / `&#8595;` (sort arrows) | `arrow-up` / `arrow-down` | team table header |
| `&#9776;` (drag handle) | `grip-vertical` | team table |
| `&#128193;` (📁) | `folder-open` | gallery drop zone |
| `+ Add Another` (text) | `plus` | team batch add |

**Tata cara:** Pakai `<i data-lucide="x"></i>` di Blade. Setelah DOMContentLoaded / setelah dynamic content insert, panggil `lucide.createIcons()`.

Untuk dynamic content (gallery image cards, batch add rows, sort indicators), script push harus memanggil `lucide.createIcons()` setelah `insertAdjacentHTML` atau `innerHTML` mutation.

---

## B. Dashboard

**File:** `resources/views/admin/dashboard.blade.php`

### Perubahan

1. **Page header** di atas stat-grid:
   ```blade
   <div class="page-header">
     <h1>Dashboard</h1>
     <p>Welcome back, Admin</p>
   </div>
   ```

2. **Stat numbers** — ganti hard-coded `0` dengan data dari route:
   - `{{ $totalMembers }}` (sudah di-passing route)
   - `{{ $totalImages }}`
   - `{{ $activeAnnouncements }}`
   - `{{ $totalFooterLinks }}`

3. **Gradient konsistensi** — `.qa-card .qa-icon` ubah dari `var(--accent-gradient-alt)` ke `var(--accent-gradient)` (line 927 di `admin.css`) agar sama dengan stat card.

4. **Hapus duplikat class** `.quick-action-card` di `admin.css` (lines 952-1000) — tidak dipakai di Blade manapun.

---

## C. Announcement

**File:** `resources/views/admin/announcement.blade.php`

### Perubahan

1. **Page header** ditambahkan.

2. **Form layout** — title + toggle di satu baris, content full-width:
   ```blade
   <div class="form-row form-row--title-toggle">
     <div class="form-group">
       <label class="form-label" for="title">Title</label>
       <input class="form-input" type="text" id="title" name="title" value="..." required>
     </div>
     <div class="form-group form-group--inline">
       <label class="toggle-label" for="is_active">
         <span class="toggle">
           <input type="checkbox" id="is_active" name="is_active" value="1" {{ checked }}>
           <span class="toggle-track"></span>
           <span class="toggle-thumb"></span>
         </span>
         <span>Active</span>
       </label>
     </div>
   </div>
   ```

3. **CSS additions** di `admin.css`:
   ```css
   .form-row--title-toggle {
     grid-template-columns: 1fr auto;
     align-items: end;
   }
   .form-group--inline {
     margin-bottom: 0;
     padding-bottom: 12px;
   }
   ```

4. **Live preview** card di bawah form:
   ```blade
   <div class="glass-card announcement-preview">
     <div class="preview-label">Live Preview</div>
     <div class="preview-content">
       <h3 id="previewTitle">...</h3>
       <p id="previewContent">...</p>
     </div>
   </div>
   ```

5. **JS** — tambahkan di `@push('scripts')`:
   ```js
   document.getElementById('title').addEventListener('input', e => {
     document.getElementById('previewTitle').textContent = e.target.value;
   });
   document.getElementById('content').addEventListener('input', e => {
     document.getElementById('previewContent').textContent = e.target.value;
   });
   ```

6. **CSS untuk preview:**
   ```css
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

---

## D. Gallery

**File:** `resources/views/admin/gallery.blade.php`

### Perubahan

1. **Page header** ditambahkan.

2. **Drop zone cleanup** — hapus inline style, pakai class CSS:
   ```blade
   <div class="drop-zone" id="dropZoneArea">
     <div class="drop-zone-content" id="dropZoneContent">
       <div class="drop-zone-icon"><i data-lucide="folder-open"></i></div>
       <p class="drop-zone-title">Drag &amp; Drop images here</p>
       <p class="drop-zone-hint">or click to browse (multiple files supported)</p>
     </div>
     <input type="file" id="image" name="images[]" accept="image/*" multiple required class="drop-zone-input">
   </div>
   ```

3. **CSS drop zone cleanup** — tambahkan:
   ```css
   .drop-zone-content { pointer-events: none; }
   .drop-zone-icon { font-size: 3rem; color: var(--accent-purple); margin-bottom: 12px; }
   .drop-zone-icon svg { width: 48px; height: 48px; }
   .drop-zone-title { font-size: 1rem; font-weight: 600; color: var(--text-primary); margin-bottom: 4px; }
   .drop-zone-hint { font-size: 0.85rem; color: var(--text-secondary); }
   .drop-zone-input { display: none; }
   ```

4. **Image grid** (ganti `<table>`):
   ```blade
   <div class="image-grid">
     @foreach($images as $image)
       <div class="image-card">
         <img src="{{ asset($image->path) }}" alt="Gallery Image" loading="lazy">
         <div class="image-overlay">
           <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}" class="image-delete-form">
             @csrf @method('DELETE')
             <button type="submit" class="image-delete-btn" title="Delete">
               <i data-lucide="trash-2"></i>
             </button>
           </form>
         </div>
       </div>
     @endforeach
   </div>
   @if(!isset($images) || count($images) === 0)
     <div class="empty-state">
       <i data-lucide="image" class="icon-48"></i>
       <p>No images uploaded yet</p>
     </div>
   @endif
   ```

5. **CSS untuk image cards & delete:**
   ```css
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

   .empty-state {
     text-align: center;
     padding: 48px 24px;
     color: var(--text-muted);
   }
   .empty-state svg { width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.4; }
   .empty-state p { font-size: 0.9rem; }
   ```

6. **JS updates** — `innerHTML` di dropzone diganti dengan class-based content + panggil `lucide.createIcons()`. Konfirmasi delete pakai toast atau confirm() yang konsisten.

---

## E. Team

**File:** `resources/views/admin/team.blade.php`

### Perubahan

1. **Page header** ditambahkan.

2. **Section title** dengan Lucide icons:
   ```blade
   <h2 class="section-title">
     <i data-lucide="user-plus"></i>
     Add Team Members
   </h2>
   ```

3. **Batch add button** dengan icon:
   ```blade
   <button type="button" class="btn-add-row" onclick="addBatchRow()">
     <i data-lucide="plus"></i> Add Another
   </button>
   ```

4. **Remove row button** dengan icon:
   ```blade
   <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">
     <i data-lucide="x"></i>
   </button>
   ```

5. **Sort indicator** di table header — ganti `&#8593;`/`&#8595;` dengan Lucide. Pakai conditional inline:
   ```blade
   <th><a href="...">Name @if($sortBy === 'name')<i data-lucide="arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }}" class="icon-12"></i>@endif</a></th>
   ```

6. **Drag handle** dengan Lucide:
   ```blade
   <td><i data-lucide="grip-vertical" class="drag-handle" title="Drag to reorder"></i></td>
   ```

7. **Status icon** dengan Lucide:
   ```blade
   <td>
     @if($member->is_active)
       <i data-lucide="check" class="status-active"></i>
     @else
       <i data-lucide="x" class="status-inactive"></i>
     @endif
   </td>
   ```

8. **Modal** — pakai class `.modal-overlay` + `.modal-box` (sudah ada CSS line 700-755), hapus `style="display:none"`:
   ```blade
   <div id="edit-modal" class="modal-overlay" hidden>
     <div class="modal-box">
       <div class="modal-header">
         <h2>Edit Team Member</h2>
         <button type="button" class="modal-close" onclick="closeEditModal()">
           <i data-lucide="x"></i>
         </button>
       </div>
       <form ...>
         ...
         <div class="modal-footer">
           <button type="submit" class="btn-primary">Update</button>
           <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
         </div>
       </form>
     </div>
   </div>
   ```

9. **JS update untuk modal** — toggle `hidden` attribute bukan `style.display`. Panggil `lucide.createIcons()` setelah modal dibuka.

10. **CSS tambahan:**
    ```css
    .icon-12 { width: 12px; height: 12px; }
    .icon-48 { width: 48px; height: 48px; }
    ```

11. **`addBatchRow()`** update — panggil `lucide.createIcons()` setelah `insertAdjacentHTML`.

---

## F. Footer

**File:** `resources/views/admin/footer.blade.php`

### Perubahan

1. **Page header** ditambahkan.

2. **Section title** dengan icon:
   ```blade
   <h2 class="section-title">
     <i data-lucide="file-text"></i>
     Footer Description
   </h2>
   ```

3. **Add Link form** dengan label icon:
   ```blade
   <div class="form-group">
     <label class="form-label" for="link_name">
       <i data-lucide="type"></i> Link Name
     </label>
     <input ...>
   </div>
   ```

4. **Links table** — kolom URL dengan external link icon:
   ```blade
   <td>
     <a href="{{ $link->url }}" target="_blank" class="link-url">
       <i data-lucide="external-link" class="icon-12"></i>
       {{ Str::limit($link->url, 60) }}
     </a>
   </td>
   ```

5. **Action button** — ganti text "Delete" dengan icon button:
   ```blade
   <button type="submit" class="image-delete-btn" title="Delete link">
     <i data-lucide="trash-2"></i>
   </button>
   ```

6. **CSS untuk link URL:**
    ```css
    .link-url {
      color: var(--text-secondary);
      text-decoration: none;
      display: inline-flex; align-items: center; gap: 6px;
      transition: color var(--transition-fast);
    }
    .link-url:hover { color: var(--accent-cyan); }
    ```

7. **Empty state** untuk tabel kosong (sama seperti Gallery):
   ```blade
   @if(!isset($footerLinks) || count($footerLinks) === 0)
     <div class="empty-state">
       <i data-lucide="link-2"></i>
       <p>No links added yet</p>
     </div>
   @endif
   ```

---

## G. Login Redesain

**File:** `resources/views/admin/login.blade.php` (rewrite)
**File baru:** `public/css/login.css`

### Perubahan

Hapus total inline `<style>` (lines 27-307, 280 baris) dan `<body>` lama. Ganti dengan:

```blade
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>NightLight - Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
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

  <script>lucide.createIcons();</script>
</body>
</html>
```

**File baru `public/css/login.css`:**

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
}

.login-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.4;
}
.login-orb-1 {
  width: 400px; height: 400px;
  background: var(--accent-purple);
  top: -100px; left: -100px;
}
.login-orb-2 {
  width: 500px; height: 500px;
  background: var(--accent-cyan);
  bottom: -150px; right: -150px;
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
  bottom: -10px; left: 50%;
  transform: translateX(-50%);
  width: 60px; height: 3px;
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
  animation: shake 0.4s ease;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-6px); }
  75% { transform: translateX(6px); }
}
```

**Batasan:** Login page tidak share `.admin-container` / `.admin-sidebar` — independen. Tidak ada theme toggle (selalu dark untuk konsistensi dengan brand image).

---

## H. Mobile / Hamburger Menu

**File:** `resources/views/admin/layout.blade.php`

### Perubahan

1. **Tombol hamburger** di header (mobile only):
   ```blade
   <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Open menu">
     <i data-lucide="menu"></i>
   </button>
   ```

2. **Mobile sidebar** state — saat mobile, sidebar default tersembunyi (translateX(-100%)), tombol hamburger toggle `mobile-open` class.

3. **CSS:**
   ```css
   .mobile-menu-btn {
     display: none;
     background: none;
     border: none;
     color: var(--text-primary);
     cursor: pointer;
     padding: 8px;
   }
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
     .mobile-menu-btn { display: flex; }
     .admin-sidebar {
       transform: translateX(-100%);
       transition: transform var(--transition-sidebar);
     }
     .admin-sidebar.expanded,
     .admin-sidebar.mobile-open {
       transform: translateX(0);
       width: 260px;
     }
     .admin-main { margin-left: 0; }
   }
   ```

4. **JS** di layout:
   ```js
   const mobileBtn = document.getElementById('mobileMenuBtn');
   const backdrop = document.getElementById('mobileBackdrop');
   if (mobileBtn && sidebar) {
     mobileBtn.addEventListener('click', () => {
       sidebar.classList.toggle('mobile-open');
       backdrop.classList.toggle('show');
     });
     backdrop.addEventListener('click', () => {
       sidebar.classList.remove('mobile-open');
       backdrop.classList.remove('show');
     });
   }
   ```

---

## I. Konsistensi Color & Spacing (audit)

| Aspek | Status | Fix |
|---|---|---|
| `qa-card .qa-icon` gradient | cyan→purple (line 927) | Ubah ke purple→cyan |
| `.quick-action-card` duplikat | Lines 952-1000 | Hapus |
| `.glass-card:hover` lift effect | Terlalu banyak gerakan | Pertahankan, scope `transform` only on `.stat-card` & `.qa-card` |
| Stat card icon size | 24px (line 877) | Konsisten, biarkan |
| Form label uppercase | Sudah | Biarkan |
| Border-radius card | `var(--radius-lg)` | Konsisten |
| Empty state | Tidak ada | Tambah di Gallery & Footer |

---

## J. Testing Checklist (visual)

Setelah implementasi, harus dicek di browser:

1. [ ] Login page render dengan glassmorphism, sama seperti design spec mockup
2. [ ] Login dark mode (tidak ada toggle, selalu dark)
3. [ ] Dashboard: stat numbers dari DB (cek dengan beberapa data)
4. [ ] Dashboard: page header "Dashboard" + subtitle + gradient line
5. [ ] Announcement: title + toggle di satu baris, preview card live update saat ketik
6. [ ] Gallery: image grid 3-kolom dengan hover overlay delete button
7. [ ] Gallery: drop zone dengan folder-open icon, drag-over glow cyan
8. [ ] Team: page header, sort arrows dengan Lucide, drag handle dengan grip-vertical
9. [ ] Team: edit modal pakai class glass, icon close, form input konsisten
10. [ ] Footer: page header, URL dengan external-link icon, empty state
11. [ ] Mobile (< 768px): hamburger muncul, sidebar slide-in, backdrop visible
12. [ ] Mobile: form-row jadi 1 kolom, stat grid 2 kolom, qa grid 1 kolom
13. [ ] Theme toggle dark/light di semua halaman (kecuali login)
14. [ ] Tidak ada HTML entity yang tertinggal (×, ✕, ✓, 📁, ↑, ↓, ⋮)

---

## Implementation Phases

1. **Phase 1 — Foundation**: Tambah Lucide CDN di `layout.blade.php`, CSS icon utilities, hapus `.quick-action-card` duplikat, fix `qa-card` gradient
2. **Phase 2 — Dashboard**: Page header, stat numbers dari DB
3. **Phase 3 — Announcement**: Page header, form-row title-toggle, live preview
4. **Phase 4 — Gallery**: Page header, drop zone cleanup, image grid (ganti tabel), empty state
5. **Phase 5 — Team**: Page header, Lucide icons, modal pakai class glass, sort indicators
6. **Phase 6 — Footer**: Page header, Lucide icons, link URL styling, empty state
7. **Phase 7 — Login**: Rewrite dengan glassmorphism CSS variables, file `login.css` baru
8. **Phase 8 — Mobile**: Hamburger menu, backdrop, sidebar slide-in
9. **Phase 9 — Final Audit**: Cek testing checklist, fix inkonsistensi sisa

---

## Out-of-Scope (deferred)

- Drag handle animation polish (ghost highlight)
- Toast notification positioning optimization
- Animation transitions pada form submit
- AOS animation per-element (sudah dipakai, tidak diubah)
- Print stylesheet untuk admin
