# NightLight Admin Glassmorphism Redesign — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Redesain semua halaman admin NightLight dengan gaya Glassmorphism Dark — sidebar mini→expand, dark/light toggle, card glass blur, aksen ungu/cyan.

**Architecture:** CSS variables untuk theming, single layout blade yang di-extend semua halaman. Sidebar JS untuk expand behavior, localStorage untuk theme preference.

**Tech Stack:** Laravel Blade, CSS Custom Properties, Vanilla JS, Lucide Icons CDN, AOS library (already installed), SortableJS (already installed).

---

## Files Overview

```
resources/views/admin/
  layout.blade.php          ← restructure: sidebar + header + CSS (Phase 1)
  dashboard.blade.php       ← stats + quick actions (Phase 2)
  announcement.blade.php    ← glass form styling (Phase 3)
  gallery.blade.php         ← glass form + image grid (Phase 3)
  team.blade.php            ← glass table + modal (Phase 4)
  footer.blade.php          ← glass table + form (Phase 4)
public/css/
  admin.css                 ← Create: all glassmorphism CSS
```

---

## Task 1: Create `admin.css` — Glassmorphism CSS Foundation

**Files:**
- Create: `public/css/admin.css`
- Modify: `resources/views/admin/layout.blade.php` (add link to admin.css)

- [ ] **Step 1: Create admin.css with CSS variables and base styles**

```css
/* ===== CSS Variables ===== */
:root {
  --bg-primary: #0f0f1a;
  --bg-secondary: #1a1a2e;
  --bg-card: rgba(255, 255, 255, 0.05);
  --bg-card-hover: rgba(255, 255, 255, 0.08);
  --accent-purple: #7c3aed;
  --accent-cyan: #06b6d4;
  --accent-gradient: linear-gradient(135deg, #7c3aed, #06b6d4);
  --accent-gradient-alt: linear-gradient(135deg, #06b6d4, #7c3aed);
  --text-primary: #f1f5f9;
  --text-secondary: #94a3b8;
  --text-muted: #64748b;
  --border: rgba(255, 255, 255, 0.1);
  --border-hover: rgba(255, 255, 255, 0.2);
  --glass-blur: blur(20px);
  --shadow-card: 0 8px 32px rgba(0, 0, 0, 0.3);
  --shadow-glow: 0 0 20px rgba(124, 58, 237, 0.3);
  --shadow-glow-cyan: 0 0 20px rgba(6, 182, 212, 0.3);
  --radius-sm: 8px;
  --radius-md: 12px;
  --radius-lg: 16px;
  --sidebar-width: 72px;
  --sidebar-expanded: 260px;
  --header-height: 64px;
  --transition-fast: 0.2s ease;
  --transition-sidebar: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

html.light-mode {
  --bg-primary: #f8fafc;
  --bg-secondary: #e2e8f0;
  --bg-card: rgba(255, 255, 255, 0.85);
  --bg-card-hover: rgba(255, 255, 255, 1);
  --text-primary: #0f172a;
  --text-secondary: #475569;
  --text-muted: #94a3b8;
  --border: rgba(0, 0, 0, 0.1);
  --border-hover: rgba(0, 0, 0, 0.2);
  --shadow-card: 0 8px 32px rgba(0, 0, 0, 0.08);
  --shadow-glow: 0 0 20px rgba(124, 58, 237, 0.15);
}

/* ===== Base Reset ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  background: var(--bg-primary);
  color: var(--text-primary);
  font-family: 'Montserrat', 'Segoe UI', sans-serif;
  min-height: 100vh;
  transition: background var(--transition-fast), color var(--transition-fast);
}

/* ===== Admin Container ===== */
.admin-container {
  display: flex;
  min-height: 100vh;
}

/* ===== Sidebar ===== */
.admin-sidebar {
  width: var(--sidebar-width);
  background: var(--bg-secondary);
  border-right: 1px solid var(--border);
  position: fixed;
  height: 100vh;
  overflow: hidden;
  transition: var(--transition-sidebar);
  z-index: 100;
  display: flex;
  flex-direction: column;
  padding: 0;
}

.admin-sidebar.expanded {
  width: var(--sidebar-expanded);
  box-shadow: 4px 0 24px rgba(0, 0, 0, 0.3);
}

.admin-sidebar .logo-area {
  height: var(--header-height);
  display: flex;
  align-items: center;
  padding: 0 20px;
  border-bottom: 1px solid var(--border);
  gap: 12px;
  white-space: nowrap;
  overflow: hidden;
  flex-shrink: 0;
}

.admin-sidebar .logo-glyph {
  font-size: 1.25rem;
  font-weight: 800;
  background: var(--accent-gradient);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  flex-shrink: 0;
  width: 32px;
}

.admin-sidebar .logo-text {
  font-size: 0.875rem;
  font-weight: 700;
  color: var(--text-primary);
  letter-spacing: 0.05em;
  opacity: 0;
  transition: opacity var(--transition-fast);
}

.admin-sidebar.expanded .logo-text { opacity: 1; }

.admin-sidebar nav {
  flex: 1;
  padding: 16px 12px;
  overflow-y: auto;
  overflow-x: hidden;
}

.admin-sidebar nav ul {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.admin-sidebar nav li {
  position: relative;
}

.admin-sidebar nav .nav-label {
  opacity: 0;
  transition: opacity var(--transition-fast);
  white-space: nowrap;
}

.admin-sidebar.expanded nav .nav-label { opacity: 1; }

.admin-sidebar nav a {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 12px 14px;
  border-radius: var(--radius-md);
  color: var(--text-secondary);
  text-decoration: none;
  font-size: 0.875rem;
  font-weight: 500;
  transition: all var(--transition-fast);
  white-space: nowrap;
  border: 1px solid transparent;
  position: relative;
}

.admin-sidebar nav a i {
  flex-shrink: 0;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.admin-sidebar nav a:hover {
  background: var(--bg-card-hover);
  color: var(--text-primary);
}

.admin-sidebar nav a.active {
  background: var(--bg-card);
  color: var(--text-primary);
  border-color: var(--accent-purple);
  box-shadow: inset 0 0 0 1px var(--accent-purple);
}

.admin-sidebar nav a.active::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 3px;
  height: 20px;
  background: var(--accent-purple);
  border-radius: 0 2px 2px 0;
}

.admin-sidebar nav .nav-divider {
  height: 1px;
  background: var(--border);
  margin: 12px 14px;
}

.admin-sidebar nav a.logout-link {
  color: #f87171;
}

.admin-sidebar nav a.logout-link:hover {
  background: rgba(248, 113, 113, 0.1);
  color: #f87171;
}

/* Tooltip for mini state */
.admin-sidebar nav a::after {
  content: attr(data-tooltip);
  position: absolute;
  left: calc(100% + 12px);
  top: 50%;
  transform: translateY(-50%);
  background: var(--bg-secondary);
  border: 1px solid var(--border);
  color: var(--text-primary);
  padding: 6px 12px;
  border-radius: var(--radius-sm);
  font-size: 0.8rem;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: opacity var(--transition-fast);
  z-index: 200;
}

.admin-sidebar:not(.expanded) nav a:hover::after {
  opacity: 1;
}

/* ===== Main Content ===== */
.admin-main {
  margin-left: var(--sidebar-width);
  flex: 1;
  min-height: 100vh;
  transition: margin-left var(--transition-sidebar);
}

/* ===== Top Header ===== */
.admin-header {
  height: var(--header-height);
  background: var(--bg-card);
  backdrop-filter: var(--glass-blur);
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 32px;
  position: sticky;
  top: 0;
  z-index: 50;
}

.admin-header .page-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--text-primary);
}

.admin-header .header-right {
  display: flex;
  align-items: center;
  gap: 16px;
}

/* Theme Toggle */
.theme-toggle {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}

.theme-toggle .toggle-track {
  width: 44px;
  height: 24px;
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 12px;
  position: relative;
  transition: all var(--transition-fast);
}

.theme-toggle .toggle-thumb {
  width: 18px;
  height: 18px;
  background: var(--accent-purple);
  border-radius: 50%;
  position: absolute;
  top: 2px;
  left: 2px;
  transition: transform var(--transition-fast), background var(--transition-fast);
  box-shadow: 0 0 8px rgba(124, 58, 237, 0.5);
}

html.light-mode .theme-toggle .toggle-thumb {
  transform: translateX(20px);
  background: var(--accent-cyan);
  box-shadow: 0 0 8px rgba(6, 182, 212, 0.5);
}

.theme-toggle .toggle-label {
  font-size: 0.8rem;
  color: var(--text-secondary);
}

/* User Avatar */
.admin-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: var(--accent-gradient);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.875rem;
  font-weight: 700;
  color: white;
  cursor: pointer;
  border: 2px solid var(--border);
  transition: border-color var(--transition-fast);
}

.admin-avatar:hover { border-color: var(--accent-purple); }

/* ===== Page Content ===== */
.admin-page {
  padding: 32px;
  max-width: 1400px;
}

.admin-page .page-header {
  margin-bottom: 32px;
}

.admin-page .page-header h1 {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.admin-page .page-header p {
  font-size: 0.875rem;
  color: var(--text-secondary);
}

.admin-page .page-header::after {
  content: '';
  display: block;
  width: 60px;
  height: 3px;
  background: var(--accent-gradient);
  border-radius: 2px;
  margin-top: 16px;
}

/* ===== Card ===== */
.glass-card {
  background: var(--bg-card);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-card);
  padding: 24px;
  transition: all var(--transition-fast);
  margin-bottom: 24px;
}

.glass-card:hover {
  background: var(--bg-card-hover);
  transform: translateY(-2px);
  box-shadow: var(--shadow-card), var(--shadow-glow);
}

.glass-card .card-title {
  font-size: 1.125rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 10px;
}

.glass-card .card-title i {
  color: var(--accent-purple);
}

/* ===== Form Elements ===== */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 8px;
}

.form-input,
.form-textarea {
  width: 100%;
  padding: 12px 16px;
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  color: var(--text-primary);
  font-size: 0.9rem;
  font-family: inherit;
  transition: all var(--transition-fast);
  outline: none;
}

.form-input:focus,
.form-textarea:focus {
  border-color: var(--accent-purple);
  box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
  background: var(--bg-card-hover);
}

.form-textarea {
  min-height: 120px;
  resize: vertical;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

/* ===== Buttons ===== */
.btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 24px;
  border-radius: var(--radius-sm);
  font-size: 0.875rem;
  font-weight: 600;
  font-family: inherit;
  cursor: pointer;
  transition: all var(--transition-fast);
  border: none;
  text-decoration: none;
}

.btn-primary {
  background: var(--accent-gradient);
  color: white;
  box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
}

.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
}

.btn-danger {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

.btn-ghost {
  background: transparent;
  color: var(--text-secondary);
  border: 1px solid var(--border);
}

.btn-ghost:hover {
  background: var(--bg-card);
  color: var(--text-primary);
  border-color: var(--border-hover);
}

.btn-sm {
  padding: 6px 14px;
  font-size: 0.8rem;
}

/* ===== Toggle / Checkbox ===== */
.toggle-wrapper {
  display: flex;
  align-items: center;
  gap: 12px;
}

.toggle {
  position: relative;
  width: 44px;
  height: 24px;
  cursor: pointer;
}

.toggle input {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle .toggle-track {
  position: absolute;
  inset: 0;
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 12px;
  transition: all var(--transition-fast);
}

.toggle input:checked + .toggle-track {
  background: var(--accent-purple);
  border-color: var(--accent-purple);
}

.toggle .toggle-thumb {
  position: absolute;
  width: 18px;
  height: 18px;
  background: var(--text-secondary);
  border-radius: 50%;
  top: 2px;
  left: 2px;
  transition: all var(--transition-fast);
}

.toggle input:checked ~ .toggle-thumb {
  transform: translateX(20px);
  background: white;
}

/* ===== Table ===== */
.glass-table-wrap {
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid var(--border);
}

.glass-table {
  width: 100%;
  border-collapse: collapse;
}

.glass-table thead tr th {
  padding: 14px 16px;
  text-align: left;
  background: var(--accent-gradient);
  color: white;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  white-space: nowrap;
}

.glass-table tbody tr {
  border-bottom: 1px solid var(--border);
  transition: background var(--transition-fast);
}

.glass-table tbody tr:last-child { border-bottom: none; }

.glass-table tbody tr:nth-child(even) {
  background: rgba(255,255,255,0.02);
}

.glass-table tbody tr:hover {
  background: var(--bg-card-hover);
}

.glass-table tbody tr td {
  padding: 14px 16px;
  font-size: 0.875rem;
  color: var(--text-primary);
  vertical-align: middle;
}

/* ===== Alert ===== */
.alert {
  padding: 14px 20px;
  border-radius: var(--radius-md);
  margin-bottom: 24px;
  font-size: 0.875rem;
  border: 1px solid;
  animation: slideDown 0.4s ease;
}

@keyframes slideDown {
  from { opacity: 0; transform: translateY(-12px); }
  to { opacity: 1; transform: translateY(0); }
}

.alert-success {
  background: rgba(34, 197, 94, 0.1);
  border-color: rgba(34, 197, 94, 0.3);
  color: #4ade80;
}

.alert-error {
  background: rgba(248, 113, 113, 0.1);
  border-color: rgba(248, 113, 113, 0.3);
  color: #f87171;
}

.alert-info {
  background: rgba(6, 182, 212, 0.1);
  border-color: rgba(6, 182, 212, 0.3);
  color: #06b6d4;
}

/* ===== Toast ===== */
.toast-container {
  position: fixed;
  top: 80px;
  right: 24px;
  z-index: 9999;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.toast {
  padding: 12px 20px;
  border-radius: var(--radius-md);
  font-size: 0.875rem;
  min-width: 280px;
  max-width: 400px;
  box-shadow: var(--shadow-card);
  animation: slideInRight 0.4s ease;
}

@keyframes slideInRight {
  from { opacity: 0; transform: translateX(100px); }
  to { opacity: 1; transform: translateX(0); }
}

.toast-success {
  background: rgba(34, 197, 94, 0.95);
  color: white;
  border: 1px solid rgba(34, 197, 94, 0.5);
}

.toast-error {
  background: rgba(239, 68, 68, 0.95);
  color: white;
  border: 1px solid rgba(239, 68, 68, 0.5);
}

/* ===== Modal ===== */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(4px);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
  animation: fadeIn 0.2s ease;
}

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.modal-box {
  background: var(--bg-secondary);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px;
  width: 100%;
  max-width: 560px;
  max-height: 90vh;
  overflow-y: auto;
  animation: scaleIn 0.25s ease;
}

@keyframes scaleIn {
  from { opacity: 0; transform: scale(0.92); }
  to { opacity: 1; transform: scale(1); }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
  padding-bottom: 16px;
  border-bottom: 1px solid var(--border);
}

.modal-header h2 {
  font-size: 1.125rem;
  font-weight: 700;
  color: var(--text-primary);
}

.modal-close {
  background: none;
  border: none;
  color: var(--text-muted);
  font-size: 1.5rem;
  cursor: pointer;
  line-height: 1;
  transition: color var(--transition-fast);
}

.modal-close:hover { color: var(--text-primary); }

.modal-footer {
  display: flex;
  gap: 12px;
  margin-top: 24px;
  padding-top: 16px;
  border-top: 1px solid var(--border);
}

/* ===== Drop Zone ===== */
.drop-zone {
  border: 2px dashed var(--border);
  border-radius: var(--radius-lg);
  padding: 48px 24px;
  text-align: center;
  cursor: pointer;
  transition: all var(--transition-fast);
  background: var(--bg-card);
}

.drop-zone:hover,
.drop-zone.drag-over {
  border-color: var(--accent-cyan);
  background: rgba(6, 182, 212, 0.05);
  box-shadow: var(--shadow-glow-cyan);
}

.drop-zone .dz-icon {
  font-size: 3rem;
  margin-bottom: 12px;
  color: var(--accent-purple);
}

.drop-zone .dz-text {
  font-size: 0.9rem;
  color: var(--text-secondary);
}

.drop-zone .dz-text strong {
  color: var(--accent-cyan);
}

/* ===== Image Grid ===== */
.image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 16px;
  margin-top: 20px;
}

.image-card {
  position: relative;
  border-radius: var(--radius-md);
  overflow: hidden;
  border: 1px solid var(--border);
  aspect-ratio: 1;
  background: var(--bg-card);
}

.image-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--transition-fast);
}

.image-card:hover img { transform: scale(1.05); }

.image-card .image-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity var(--transition-fast);
}

.image-card:hover .image-overlay { opacity: 1; }

/* ===== Stat Card ===== */
.stat-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-bottom: 32px;
}

.stat-card {
  background: var(--bg-card);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 24px;
  display: flex;
  align-items: center;
  gap: 16px;
  transition: all var(--transition-fast);
}

.stat-card:hover {
  transform: translateY(-2px);
  border-color: var(--accent-purple);
  box-shadow: var(--shadow-glow);
}

.stat-card .stat-icon {
  width: 52px;
  height: 52px;
  border-radius: var(--radius-md);
  background: var(--accent-gradient);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
}

.stat-card .stat-icon svg {
  width: 24px;
  height: 24px;
  color: white;
}

.stat-card .stat-info .stat-num {
  font-size: 1.75rem;
  font-weight: 800;
  color: var(--text-primary);
  line-height: 1;
}

.stat-card .stat-info .stat-label {
  font-size: 0.8rem;
  color: var(--text-secondary);
  margin-top: 4px;
}

/* ===== Quick Action Card ===== */
.qa-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
}

.qa-card {
  background: var(--bg-card);
  backdrop-filter: var(--glass-blur);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px;
  display: flex;
  align-items: center;
  gap: 20px;
  cursor: pointer;
  text-decoration: none;
  transition: all var(--transition-fast);
}

.qa-card:hover {
  transform: translateY(-2px);
  border-color: var(--accent-cyan);
  box-shadow: var(--shadow-glow-cyan);
}

.qa-card .qa-icon {
  width: 56px;
  height: 56px;
  border-radius: var(--radius-md);
  background: var(--accent-gradient-alt);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.qa-card .qa-icon svg {
  width: 28px;
  height: 28px;
  color: white;
}

.qa-card .qa-text h3 {
  font-size: 1rem;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.qa-card .qa-text p {
  font-size: 0.8rem;
  color: var(--text-secondary);
}

/* ===== Drag Handle ===== */
.drag-handle {
  cursor: grab;
  color: var(--text-muted);
  padding: 4px;
  display: inline-flex;
  transition: color var(--transition-fast);
}

.drag-handle:hover { color: var(--accent-purple); }
.drag-handle:active { cursor: grabbing; }

.sortable-ghost {
  opacity: 0.3;
  background: var(--accent-purple) !important;
}

/* ===== Responsive ===== */
@media (max-width: 1024px) {
  .stat-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
  .admin-sidebar { width: 0 !important; }
  .admin-main { margin-left: 0 !important; }
  .admin-page { padding: 16px; }
  .stat-grid { grid-template-columns: repeat(2, 1fr); }
  .qa-grid { grid-template-columns: 1fr; }
  .form-row { grid-template-columns: 1fr; }
}
```

- [ ] **Step 2: Add link to admin.css in layout.blade.php head section**

Add this line after existing stylesheet links:
```html
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
```

- [ ] **Step 3: Commit**

```bash
git add public/css/admin.css resources/views/admin/layout.blade.php
git commit -m "feat(admin): add glassmorphism CSS foundation with CSS variables"
```

---

## Task 2: Restructure `layout.blade.php` — Sidebar + Header + Dark/Light Toggle

**Files:**
- Modify: `resources/views/admin/layout.blade.php`

- [ ] **Step 1: Replace entire body section of layout.blade.php**

Replace everything between `<body>` and the closing `</body>` with:

```html
<body>

    <div class="admin-container">

        {{-- Sidebar --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="logo-area">
                <span class="logo-glyph">NL</span>
                <span class="logo-text">NightLight</span>
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"
                           data-tooltip="Dashboard">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            </i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcement') }}"
                           class="{{ request()->is('admin/announcement') ? 'active' : '' }}"
                           data-tooltip="Announcement">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                            </i>
                            <span class="nav-label">Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery') }}"
                           class="{{ request()->is('admin/gallery') ? 'active' : '' }}"
                           data-tooltip="Gallery">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </i>
                            <span class="nav-label">Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.team') }}"
                           class="{{ request()->is('admin/team') ? 'active' : '' }}"
                           data-tooltip="Team">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </i>
                            <span class="nav-label">Team</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.footer') }}"
                           class="{{ request()->is('admin.footer') ? 'active' : '' }}"
                           data-tooltip="Footer">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </i>
                            <span class="nav-label">Footer</span>
                        </a>
                    </li>
                    <li class="nav-divider"></li>
                    <li>
                        <a href="{{ route('admin.logout') }}" class="logout-link" data-tooltip="Logout">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            </i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="admin-main">
            <header class="admin-header">
                <div class="page-title">@yield('page-title', 'Dashboard')</div>
                <div class="header-right">
                    <div class="theme-toggle" id="themeToggle" title="Toggle dark/light mode">
                        <span class="toggle-label">Dark</span>
                        <div class="toggle-track">
                            <div class="toggle-thumb"></div>
                        </div>
                        <span class="toggle-label">Light</span>
                    </div>
                    <div class="admin-avatar" title="Admin">A</div>
                </div>
            </header>

            <div class="admin-page">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <!-- JavaScript -->
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        // AOS init
        AOS.init({ duration: 600, easing: 'ease-in-out', once: true, offset: 60 });

        // Sidebar expand on hover
        const sidebar = document.getElementById('adminSidebar');
        sidebar.addEventListener('mouseenter', () => sidebar.classList.add('expanded'));
        sidebar.addEventListener('mouseleave', () => sidebar.classList.remove('expanded'));

        // Theme toggle
        function applyTheme(isLight) {
            if (isLight) {
                document.documentElement.classList.add('light-mode');
            } else {
                document.documentElement.classList.remove('light-mode');
            }
        }

        const savedTheme = localStorage.getItem('admin-theme');
        applyTheme(savedTheme === 'light');

        document.getElementById('themeToggle').addEventListener('click', () => {
            const isLight = document.documentElement.classList.toggle('light-mode');
            localStorage.setItem('admin-theme', isLight ? 'light' : 'dark');
        });

        // Toast helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>

    @stack('scripts')

</body>
</html>
```

- [ ] **Step 2: Remove old inline `<style>` block from layout.blade.php `<head>`**

Remove the entire `<style>` block (lines 31-283) from `<head>` since those styles are now in `admin.css`.

- [ ] **Step 3: Update `<title>` in head**

```html
<title>@yield('page-title', 'Dashboard') — NightLight Admin</title>
```

- [ ] **Step 4: Commit**

```bash
git add resources/views/admin/layout.blade.php
git commit -m "feat(admin): restructure layout with glassmorphism sidebar + header + dark/light toggle"
```

---

## Task 3: Redesign `dashboard.blade.php` — Stats + Quick Actions

**Files:**
- Modify: `resources/views/admin/dashboard.blade.php`

- [ ] **Step 1: Replace entire dashboard content**

```blade
@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div class="page-header" data-aos="fade-down">
    <h1>Dashboard</h1>
    <p>Welcome back, Admin. Here's what's happening.</p>
</div>

{{-- Stats Grid --}}
<div class="stat-grid">
    <div class="stat-card" data-aos="fade-up" data-aos-delay="50">
        <div class="stat-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $teamCount ?? 0 }}</div>
            <div class="stat-label">Team Members</div>
        </div>
    </div>

    <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-icon" style="background: linear-gradient(135deg, #06b6d4, #0ea5e9);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $galleryCount ?? 0 }}</div>
            <div class="stat-label">Gallery Images</div>
        </div>
    </div>

    <div class="stat-card" data-aos="fade-up" data-aos-delay="150">
        <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #f97316);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $announcementCount ?? 0 }}</div>
            <div class="stat-label">Announcements</div>
        </div>
    </div>

    <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
        </div>
        <div class="stat-info">
            <div class="stat-num">{{ $footerLinksCount ?? 0 }}</div>
            <div class="stat-label">Footer Links</div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="page-header" data-aos="fade-up" style="margin-top: 40px;">
    <h1 style="font-size: 1.25rem;">Quick Actions</h1>
</div>

<div class="qa-grid">
    <a href="{{ route('admin.announcement') }}" class="qa-card" data-aos="fade-up" data-aos-delay="50">
        <div class="qa-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
        </div>
        <div class="qa-text">
            <h3>Announcement</h3>
            <p>Manage announcement content</p>
        </div>
    </a>

    <a href="{{ route('admin.gallery') }}" class="qa-card" data-aos="fade-up" data-aos-delay="100">
        <div class="qa-icon" style="background: linear-gradient(135deg, #7c3aed, #6d28d9);">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
        </div>
        <div class="qa-text">
            <h3>Gallery</h3>
            <p>Manage gallery images</p>
        </div>
    </a>

    <a href="{{ route('admin.team') }}" class="qa-card" data-aos="fade-up" data-aos-delay="150">
        <div class="qa-icon" style="background: linear-gradient(135deg, #ec4899, #db2777);">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="qa-text">
            <h3>Team</h3>
            <p>Manage team members</p>
        </div>
    </a>

    <a href="{{ route('admin.footer') }}" class="qa-card" data-aos="fade-up" data-aos-delay="200">
        <div class="qa-icon" style="background: linear-gradient(135deg, #14b8a6, #0d9488);">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
        </div>
        <div class="qa-text">
            <h3>Footer</h3>
            <p>Manage footer links</p>
        </div>
    </a>
</div>

@endsection
```

- [ ] **Step 2: Update dashboard controller to pass counts**

Check if the dashboard controller passes the counts. If not, modify the controller to add:
```php
$teamCount = \App\Models\TeamMember::count();
$galleryCount = \App\Models\GalleryImage::count();
$announcementCount = \App\Models\Announcement::count();
$footerLinksCount = \App\Models\FooterLink::count();

return view('admin.dashboard', compact('teamCount', 'galleryCount', 'announcementCount', 'footerLinksCount'));
```

- [ ] **Step 3: Commit**

```bash
git add resources/views/admin/dashboard.blade.php
git commit -m "feat(admin): redesign dashboard with stats cards and quick actions"
```

---

## Task 4: Redesign `announcement.blade.php` + `gallery.blade.php`

**Files:**
- Modify: `resources/views/admin/announcement.blade.php`
- Modify: `resources/views/admin/gallery.blade.php`

### Announcement

- [ ] **Step 1: Replace announcement.blade.php content**

```blade
@extends('admin.layout')

@section('page-title', 'Announcement')

@section('content')

<div class="page-header" data-aos="fade-down">
    <h1>Announcement</h1>
    <p>Manage your guild announcement content</p>
</div>

<div class="glass-card" data-aos="fade-up">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
        </i>
        Edit Announcement
    </div>
    <form method="POST" action="{{ route('admin.announcement.update') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-input"
                       value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="toggle-wrapper" style="padding-top: 8px;">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1"
                               {{ ($announcement->is_active ?? true) ? 'checked' : '' }}>
                        <div class="toggle-track"></div>
                        <div class="toggle-thumb"></div>
                    </label>
                    <span style="font-size: 0.875rem; color: var(--text-secondary);">
                        {{ ($announcement->is_active ?? true) ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea id="content" name="content" class="form-textarea" required>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Update Announcement
        </button>
    </form>
</div>

@endsection
```

### Gallery

- [ ] **Step 2: Replace gallery.blade.php content**

```blade
@extends('admin.layout')

@section('page-title', 'Gallery')

@section('content')

<div class="page-header" data-aos="fade-down">
    <h1>Gallery</h1>
    <p>Manage gallery images and description</p>
</div>

{{-- Gallery Info --}}
<div class="glass-card" data-aos="fade-up">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        </i>
        Gallery Info
    </div>
    <form method="POST" action="{{ route('admin.gallery.update') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-input"
                   value="{{ $gallery->title ?? 'GALLERY' }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-textarea" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings.' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Update Info
        </button>
    </form>
</div>

{{-- Upload Section --}}
<div class="glass-card" data-aos="fade-up" data-aos-delay="100">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
        </i>
        Upload Images
    </div>
    <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data" id="galleryDropZone">
        @csrf
        <div class="drop-zone" id="dropZoneArea">
            <div id="dropZoneContent">
                <div class="dz-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                </div>
                <p class="dz-text"><strong>Drag & drop images here</strong><br>or click to browse</p>
                <p class="dz-text" style="font-size:0.75rem; margin-top:4px; color: var(--text-muted);">Supports JPG, PNG, GIF — multiple files allowed</p>
            </div>
            <input type="file" id="galleryImage" name="images[]" accept="image/*" multiple style="display: none;">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 16px; width: 100%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
            Upload Images
        </button>
    </form>
</div>

{{-- Image Grid --}}
@if(isset($images) && count($images) > 0)
<div class="glass-card" data-aos="fade-up" data-aos-delay="150">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
        </i>
        Gallery Images ({{ count($images) }})
    </div>
    <div class="image-grid">
        @foreach($images as $image)
        <div class="image-card">
            <img src="{{ asset($image->path) }}" alt="Gallery Image">
            <div class="image-overlay">
                <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}"
                      onsubmit="return confirm('Delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@push('scripts')
<script>
(function() {
    const dropZoneArea = document.getElementById('dropZoneArea');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const fileInput = document.getElementById('galleryImage');
    const form = document.getElementById('galleryDropZone');

    dropZoneArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            const count = fileInput.files.length;
            dropZoneContent.innerHTML = `
                <div class="dz-icon" style="color: #06b6d4;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <p class="dz-text"><strong>${count} image${count > 1 ? 's' : ''} selected</strong></p>
                <p class="dz-text" style="font-size:0.75rem; margin-top:4px; color: var(--text-muted);">Click to change</p>`;
        }
    });

    dropZoneArea.addEventListener('dragover', e => { e.preventDefault(); dropZoneArea.classList.add('drag-over'); });
    dropZoneArea.addEventListener('dragleave', () => dropZoneArea.classList.remove('drag-over'));
    dropZoneArea.addEventListener('drop', e => {
        e.preventDefault();
        dropZoneArea.classList.remove('drag-over');
        const dt = new DataTransfer();
        for (let f of e.dataTransfer.files) dt.items.add(f);
        fileInput.files = dt.files;
        fileInput.dispatchEvent(new Event('change'));
    });
})();
</script>
@endpush

@endsection
```

- [ ] **Step 3: Commit**

```bash
git add resources/views/admin/announcement.blade.php resources/views/admin/gallery.blade.php
git commit -m "feat(admin): glassmorphism redesign for announcement and gallery pages"
```

---

## Task 5: Redesign `team.blade.php` + `footer.blade.php`

**Files:**
- Modify: `resources/views/admin/team.blade.php`
- Modify: `resources/views/admin/footer.blade.php`

### Team

- [ ] **Step 1: Replace team.blade.php content**

```blade
@extends('admin.layout')

@section('page-title', 'Team')

@section('content')

<div class="page-header" data-aos="fade-down">
    <h1>Team</h1>
    <p>Manage your guild team members</p>
</div>

{{-- Add Team Members --}}
<div class="glass-card" data-aos="fade-up">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
        </i>
        Add Team Members
    </div>
    <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
        @csrf
        <div id="member-fields-container">
            <div class="member-row batch-row" data-index="0">
                <div class="form-group"><label>Name</label><input type="text" name="name[]" class="form-input" required></div>
                <div class="form-group"><label>Role</label><input type="text" name="role[]" class="form-input" required></div>
                <div class="form-group"><label>Quote</label><textarea name="quote[]" class="form-textarea" required></textarea></div>
                <div class="form-group"><label>Avatar</label><input type="file" name="avatar[]" accept="image/*"></div>
                <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
        </div>
        <div class="batch-actions" style="display:flex;gap:12px;margin-top:12px;align-items:center;">
            <button type="button" class="btn btn-ghost btn-sm" onclick="addBatchRow()">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Another
            </button>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Add Members
            </button>
        </div>
    </form>
</div>

{{-- Team Members Table --}}
<div class="glass-card" data-aos="fade-up" data-aos-delay="100">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </i>
        Team Members <small style="font-weight:400;color:var(--text-muted);font-size:0.75rem;margin-left:8px;">(drag rows to reorder)</small>
    </div>
    <div class="glass-table-wrap">
        <table class="glass-table" data-aos="fade-up" data-aos-delay="200">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Quote</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="team-table-body">
                @if(isset($teamMembers) && count($teamMembers) > 0)
                    @foreach($teamMembers as $member)
                    <tr data-id="{{ $member->id }}" class="draggable-row">
                        <td><span class="drag-handle" title="Drag to reorder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="12" r="1"/><circle cx="9" cy="5" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                        </span></td>
                        <td>{{ $member->id }}</td>
                        <td>
                            @if($member->avatar)
                                <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}"
                                     style="width:44px;height:44px;object-fit:cover;border-radius:50%;border:2px solid var(--border);">
                            @else
                                <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Default"
                                     style="width:44px;height:44px;object-fit:cover;border-radius:50%;border:2px solid var(--border);">
                            @endif
                        </td>
                        <td style="font-weight:600;">{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td style="color:var(--text-secondary);font-size:0.8rem;">{{ Str::limit($member->quote, 40) }}</td>
                        <td class="order-cell">{{ $member->order }}</td>
                        <td>
                            @if($member->is_active)
                                <span style="color:#4ade80;font-size:1.1rem;">&#10003;</span>
                            @else
                                <span style="color:#f87171;font-size:1.1rem;">&#10005;</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <button type="button" class="btn btn-ghost btn-sm" onclick='openEditModal({{ json_encode($member) }})'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                    Edit
                                </button>
                                <form method="POST" action="{{ route('admin.team.delete', $member->id) }}"
                                      onsubmit="return confirm('Delete this team member?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="9" style="text-align:center;padding:40px;color:var(--text-muted);">No team members found</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Edit Modal --}}
<div id="edit-modal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <div class="modal-header">
            <h2>Edit Team Member</h2>
            <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <form method="POST" action="" id="edit-form" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="form-group">
                <label for="edit-name">Name</label>
                <input type="text" id="edit-name" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="edit-role">Role</label>
                <input type="text" id="edit-role" name="role" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="edit-quote">Quote</label>
                <textarea id="edit-quote" name="quote" class="form-textarea" required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="edit-order">Order</label>
                    <input type="number" id="edit-order" name="order" class="form-input" min="0">
                </div>
                <div class="form-group">
                    <label>Active</label>
                    <div class="toggle-wrapper" style="padding-top:8px;">
                        <label class="toggle">
                            <input type="checkbox" id="edit-is_active" name="is_active" value="1">
                            <div class="toggle-track"></div>
                            <div class="toggle-thumb"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="edit-avatar">Avatar Photo</label>
                <div id="edit-current-avatar" style="margin-bottom:8px;"></div>
                <input type="file" id="edit-avatar" name="avatar" accept="image/*" class="form-input">
                <small style="color:var(--text-muted);font-size:0.75rem;">Leave empty to keep current avatar</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-ghost" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
function addBatchRow() {
    const container = document.getElementById('member-fields-container');
    const index = container.querySelectorAll('.member-row').length;
    container.insertAdjacentHTML('beforeend', `<div class="member-row batch-row" data-index="${index}">
        <div class="form-group"><label>Name</label><input type="text" name="name[]" class="form-input" required></div>
        <div class="form-group"><label>Role</label><input type="text" name="role[]" class="form-input" required></div>
        <div class="form-group"><label>Quote</label><textarea name="quote[]" class="form-textarea" required></textarea></div>
        <div class="form-group"><label>Avatar</label><input type="file" name="avatar[]" accept="image/*"></div>
        <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg></button>
    </div>`);
}

function removeBatchRow(btn) {
    const rows = document.querySelectorAll('.member-row');
    if (rows.length > 1) btn.closest('.member-row').remove();
    else alert('At least one entry is required.');
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
    avatarDiv.innerHTML = `<img src="/${member.avatar || 'images/avatars/user-01.jpg'}" style="width:60px;height:60px;object-fit:cover;border-radius:50%;border:2px solid var(--border);">`;
    document.getElementById('edit-modal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('edit-modal').style.display = 'none';
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeEditModal(); });

// SortableJS drag-and-drop reorder
const el = document.getElementById('team-table-body');
if (el) {
    Sortable.create(el, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        onEnd: function(evt) {
            const ids = [];
            el.querySelectorAll('tr[data-id]').forEach((row, i) => {
                ids.push(row.dataset.id);
                row.querySelector('.order-cell').textContent = i + 1;
            });
            fetch('{{ route('admin.team.reorder') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
            }).then(res => res.json())
              .catch(() => { alert('Failed to save order.'); location.reload(); });
        }
    });
}
</script>
@endpush

@push('styles')
<style>
.batch-row {
    display: grid;
    grid-template-columns: 1fr 1fr 2fr 1fr auto;
    gap: 12px;
    align-items: end;
    padding: 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    margin-bottom: 12px;
    background: rgba(255,255,255,0.02);
}
.batch-row .form-group { margin-bottom: 0; }
.batch-row input, .batch-row textarea { width: 100%; }
.btn-remove-row {
    background: rgba(239,68,68,0.1);
    color: #f87171;
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: var(--radius-sm);
    width: 36px;
    height: 36px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-fast);
}
.btn-remove-row:hover { background: rgba(239,68,68,0.2); }
</style>
@endpush
```

### Footer

- [ ] **Step 2: Replace footer.blade.php content**

```blade
@extends('admin.layout')

@section('page-title', 'Footer')

@section('content')

<div class="page-header" data-aos="fade-down">
    <h1>Footer</h1>
    <p>Manage your website footer content and links</p>
</div>

{{-- Footer Description --}}
<div class="glass-card" data-aos="fade-up">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        </i>
        Footer Description
    </div>
    <form method="POST" action="{{ route('admin.footer.update') }}">
        @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-textarea" required>{{ $footer->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures.' }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Update Description
        </button>
    </form>
</div>

{{-- Footer Links --}}
<div class="glass-card" data-aos="fade-up" data-aos-delay="100">
    <div class="card-title">
        <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
        </i>
        Footer Links
    </div>

    {{-- Add Link Form --}}
    <form method="POST" action="{{ route('admin.footer.link.add') }}" style="display:flex;gap:12px;margin-bottom:24px;align-items:end;">
        @csrf
        <div class="form-group" style="flex:1;margin-bottom:0;">
            <label for="link_name">Link Name</label>
            <input type="text" id="link_name" name="link_name" class="form-input" placeholder="Discord" required>
        </div>
        <div class="form-group" style="flex:2;margin-bottom:0;">
            <label for="link_url">Link URL</label>
            <input type="text" id="link_url" name="link_url" class="form-input" placeholder="https://discord.gg/..." required>
        </div>
        <button type="submit" class="btn btn-primary" style="flex-shrink:0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Link
        </button>
    </form>

    {{-- Links Table --}}
    <div class="glass-table-wrap">
        <table class="glass-table">
            <thead>
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th style="width:120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($footerLinks) && count($footerLinks) > 0)
                    @foreach($footerLinks as $link)
                    <tr>
                        <td style="color:var(--text-muted);">{{ $link->id }}</td>
                        <td style="font-weight:600;">{{ $link->name }}</td>
                        <td><a href="{{ $link->url }}" target="_blank" style="color:var(--accent-cyan);text-decoration:none;font-size:0.8rem;">{{ $link->url }}</a></td>
                        <td>
                            <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}"
                                  onsubmit="return confirm('Delete this link?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--text-muted);">No links found</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
```

- [ ] **Step 3: Commit**

```bash
git add resources/views/admin/team.blade.php resources/views/admin/footer.blade.php
git commit -m "feat(admin): glassmorphism redesign for team and footer pages"
```

---

## Task 6: Verify & Final Polish

**Files:**
- Modify: `resources/views/admin/layout.blade.php` (final check)
- Check: dashboard controller passes all stats counts

- [ ] **Step 1: Check dashboard controller**

Read the admin dashboard controller to ensure it passes `teamCount`, `galleryCount`, `announcementCount`, `footerLinksCount` variables. If not, add them.

```bash
# Find the controller
find . -name "*.php" -exec grep -l "admin.dashboard" {} \;
```

- [ ] **Step 2: Update dashboard controller if needed**

If the controller doesn't exist or doesn't pass counts, add the counts.

- [ ] **Step 3: Test in browser**

Open the admin pages in browser:
1. Navigate to `http://localhost/nightlight-web/admin/dashboard`
2. Check sidebar expands on hover
3. Check dark/light toggle works
4. Navigate to each admin page and verify glassmorphism styles apply
5. Check responsive on mobile

- [ ] **Step 4: Commit final polish**

```bash
git add -A
git commit -m "feat(admin): complete glassmorphism admin redesign - all pages"
```
