# NightLight Admin — Glassmorphism Redesign Spec

## Overview

Redesain semua halaman admin NightLight dengan gaya **Glassmorphism Dark**: latar gelap, efek glass blur, warna neon accents (ungu/cyan). Pendekatan bertahap agar bisa di-test setiap tahap.

---

## Color System (CSS Variables)

```
--bg-primary: #0f0f1a
--bg-secondary: #1a1a2e
--bg-card: rgba(255,255,255,0.05)
--bg-card-hover: rgba(255,255,255,0.08)
--accent-purple: #7c3aed
--accent-cyan: #06b6d4
--accent-gradient: linear-gradient(135deg, #7c3aed, #06b6d4)
--accent-gradient-alt: linear-gradient(135deg, #06b6d4, #7c3aed)
--text-primary: #f1f5f9
--text-secondary: #94a3b8
--text-muted: #64748b
--border: rgba(255,255,255,0.1)
--border-hover: rgba(255,255,255,0.2)
--glass-blur: blur(20px)
--shadow-card: 0 8px 32px rgba(0,0,0,0.3)
--shadow-glow: 0 0 20px rgba(124,58,237,0.3)
--radius-sm: 8px
--radius-md: 12px
--radius-lg: 16px
```

### Light Mode Overrides

```
--bg-primary-light: #f8fafc
--bg-secondary-light: #e2e8f0
--bg-card-light: rgba(255,255,255,0.8)
--text-primary-light: #0f172a
--text-secondary-light: #475569
--border-light: rgba(0,0,0,0.1)
```

---

## Layout & Shell

### Sidebar — Mini → Expand on Hover

- **Default state**: 72px width, icon-only
- **Expanded state**: 260px width, icon + label
- **Trigger**: hover (mouseenter) → expand, mouse leave → collapse
- **Transition**: `width 0.3s cubic-bezier(0.4, 0, 0.2, 1)`
- **Logo area**: "NL" glyph (24px) saat mini; "NightLight" text saat expanded
- **Menu items**:
  - Dashboard (grid icon)
  - Announcement (megaphone icon)
  - Gallery (image icon)
  - Team (users icon)
  - Footer (link icon)
  - Divider
  - Logout (logout icon, warna merah)
- **Icon style**: Lucide icons via CDN, 20px, `var(--text-secondary)`
- **Active item**: background `var(--bg-card)`, border-left accent `var(--accent-purple)`, icon/text `var(--text-primary)`
- **Tooltip**: saat mini, hover icon → tooltip label muncul di kanan

### Main Content Area

- `margin-left: 72px` (saat sidebar mini)
- Full viewport height, scrollable
- Padding: 32px

### Top Header Bar

- Fixed di atas content area
- Kiri: breadcrumb/page title
- Kanan: Dark/Light toggle switch + user avatar circle
- Background: `var(--bg-card)` dengan blur
- Border-bottom: 1px solid `var(--border)`

---

## Shared Components

### Card

```css
background: var(--bg-card);
backdrop-filter: var(--glass-blur);
border: 1px solid var(--border);
border-radius: var(--radius-lg);
box-shadow: var(--shadow-card);
padding: 24px;
transition: all 0.3s ease;
```

Hover: background lighten, `translateY(-2px)`, shadow lebih terang.

### Page Header

- H1: `var(--text-primary)`, font-size 1.75rem, font-weight 700
- Subtitle: `var(--text-secondary)`, font-size 0.875rem
- Bottom border: gradient line (ungu → cyan)

### Form Elements

**Input / Textarea**
- Background: `rgba(255,255,255,0.05)`
- Border: 1px solid `var(--border)`
- Focus: border `var(--accent-purple)`, box-shadow glow `rgba(124,58,237,0.3)`
- Border-radius: var(--radius-sm)
- Padding: 12px 16px
- Color: `var(--text-primary)`

**Button Primary**
- Background: `var(--accent-gradient)`
- Color: white, font-weight 600
- Padding: 12px 24px
- Border-radius: var(--radius-sm)
- Hover: shadow glow, `translateY(-1px)`

**Button Danger**
- Background: `linear-gradient(135deg, #ef4444, #dc2626)`
- Same shape as primary

**Checkbox / Toggle**
- Custom styled, accent-purple ketika checked
- Toggle switch untuk is_active

### Table

- Container: `border-radius: var(--radius-lg)`, overflow hidden
- Header: gradient `var(--accent-gradient)`, text white, uppercase, 0.75rem, letter-spacing
- Row: alternating `var(--bg-card)` / transparent
- Hover: `var(--bg-card-hover)`
- Cell: padding 16px, vertical-align middle
- Border-bottom: 1px solid `var(--border)`

### Alert / Toast

- Toast: fixed top-right, slide-in dari kanan
- Success: hijau; Error: merah; Info: cyan
- Auto-dismiss: 3s dengan fade-out animation
- Session flash messages: tetap di dalam content area (bukan toast)

---

## Dashboard Redesign

Hapus card-based welcome grid, ganti dengan:

### Stats Row (4 cards)
1. Total Team Members — icon: users, angka dari DB count
2. Gallery Images — icon: image, angka dari DB count
3. Active Announcements — icon: megaphone, angka dari DB
4. Footer Links — icon: link, angka dari DB

Setiap stat card: icon besar, angka bold, label muted, hover glow.

### Quick Actions (2x2 grid)
4 card besar untuk navigasi cepat:
- Announcement — megaphone icon
- Gallery — image icon
- Team — users icon
- Footer — link icon

Masing-masing: glass card, hover lift + glow, click ke halaman terkait.

---

## Page-Specific Changes

### Announcement
- Form fields: title + is_active toggle di baris yang sama (2 kolom)
- Preview box: live preview card seperti tampilan announcement di frontend

### Gallery
- Drop zone: lebih besar, visual drag-over state (border cyan, bg lighten)
- Image list: grid 3 kolom, setiap image card dengan hover overlay (delete button)
- Delete: konfirmasi toast, animasi fade-out saat dihapus

### Team
- Batch add: card-based rows dengan remove button per row
- Table: avatar bulat, drag handle lebih jelas
- Edit modal: glassmorphism modal overlay

### Footer
- Links list: setiap item inline edit (click to edit) atau modal
- Add form: di atas list
- Delete: animasi slide-out

---

## Animations

- **AOS**: fade-up untuk cards, fade-left untuk sidebar items
- **Sidebar expand**: CSS transition width
- **Card hover**: translateY + shadow
- **Button hover**: translateY + glow shadow
- **Toggle dark/light**: CSS variable swap via class di `<html>`, transition 0.3s
- **Toast**: slideInRight animation, auto-dismiss fadeOut

---

## Tech Approach

1. Buat `admin-dark.css` dan `admin-light.css` untuk CSS variables
2. Modifikasi `layout.blade.php` dengan struktur sidebar baru + header
3. Update setiap halaman: `dashboard.blade.php`, `announcement.blade.php`, `gallery.blade.php`, `team.blade.php`, `footer.blade.php`
4. Include Lucide icons via CDN
5. Dark/light toggle: toggle class `dark-mode` / `light-mode` di `<html>`, simpan preference di `localStorage`

---

## Implementation Phases

**Phase 1**: `layout.blade.php` — sidebar mini→expand, header, CSS variables, dark/light toggle  
**Phase 2**: `dashboard.blade.php` — stats row, quick actions  
**Phase 3**: `announcement.blade.php` + `gallery.blade.php` — forms, gallery grid  
**Phase 4**: `team.blade.php` + `footer.blade.php` — tables, modals, animations
