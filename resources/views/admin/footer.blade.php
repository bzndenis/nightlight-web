@extends('admin.layout')
@section('page-title', 'Footer & Links')
@section('page-subtitle', 'Manage footer content, copyright text, and community social links')

@section('content')
    <div class="page-header" data-aos="fade-up">
        <div class="page-header__left">
            <h1 class="page-header__title">Footer Settings & Social Links</h1>
            <p class="page-header__desc">
                Configure your guild mission statement, copyright notice, and links to Discord, YouTube, Twitch, and community forums.
            </p>
        </div>
        <div class="page-header__actions">
            <a href="{{ url('/') }}#footer" target="_blank" rel="noopener" class="btn btn-secondary">
                <i data-lucide="external-link"></i>
                <span>View Public Footer</span>
            </a>
        </div>
    </div>

    {{-- Footer Content Settings --}}
    <div class="glass-card" data-aos="fade-up">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="file-text"></i>
                <span>Guild Footer Content & Legal</span>
            </div>
            <span class="badge badge--purple">Public Site Footer</span>
        </div>

        <form method="POST" action="{{ route('admin.footer.update') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="description">
                    <span>Guild Mission / Footer Description</span>
                    <span class="form-label-hint">Shown in footer columns</span>
                </label>
                <textarea id="description" name="description" class="form-textarea" rows="3" required>{{ $footer->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures.' }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="copyright_text">Copyright Notice</label>
                <input type="text" id="copyright_text" name="copyright_text" class="form-input"
                       value="{{ $footer->copyright_text ?? 'All Rights Reserved NightLight Guild.' }}" required>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="save"></i>
                    <span>Save Footer Settings</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Footer & Community Links --}}
    <div class="glass-card" data-aos="fade-up" data-aos-delay="60">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="link-2"></i>
                <span>Community & Navigation Links</span>
            </div>
            <span class="badge badge--cyan">{{ count($footerLinks ?? []) }} Configured</span>
        </div>

        {{-- Add Link Form with Social Presets --}}
        <div style="background:rgba(255,255,255,0.02); border:1px solid var(--border); border-radius:var(--radius-md); padding:20px; margin-bottom:24px;">
            <div style="font-weight:700; font-size:0.95rem; color:var(--text-primary); margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                <i data-lucide="plus-circle" style="width:16px;height:16px;color:var(--accent-cyan);"></i>
                <span>Add New Link</span>
            </div>

            <form method="POST" action="{{ route('admin.footer.link.add') }}" id="addLinkForm">
                @csrf
                <div class="form-row">
                    <div class="form-group" style="margin-bottom:12px;">
                        <label class="form-label" for="link_name">Link Label</label>
                        <input type="text" id="link_name" name="link_name" class="form-input" placeholder="e.g. Discord Community" required>
                    </div>

                    <div class="form-group" style="margin-bottom:12px;">
                        <label class="form-label" for="link_url">URL Address</label>
                        <input type="text" id="link_url" name="link_url" class="form-input" placeholder="e.g. https://discord.gg/nightlight" required>
                    </div>
                </div>

                {{-- Preset Quick Chips --}}
                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-top:8px; margin-bottom:16px;">
                    <span style="font-size:0.75rem; color:var(--text-muted); font-weight:600;">Quick Presets:</span>
                    <button type="button" class="badge" onclick="setLinkPreset('Discord', 'https://discord.gg/yourguild')">Discord</button>
                    <button type="button" class="badge" onclick="setLinkPreset('YouTube', 'https://youtube.com/@nightlightguild')">YouTube</button>
                    <button type="button" class="badge" onclick="setLinkPreset('Twitch', 'https://twitch.tv/nightlight')">Twitch</button>
                    <button type="button" class="badge" onclick="setLinkPreset('Twitter / X', 'https://x.com/nightlight')">Twitter / X</button>
                    <button type="button" class="badge" onclick="setLinkPreset('GitHub', 'https://github.com/nightlight')">GitHub</button>
                </div>

                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="plus"></i>
                        <span>Add Link</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Links List Table with Drag & Drop Reorder --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
            <div style="font-size:0.85rem; font-weight:600; color:var(--text-secondary); display:flex; align-items:center; gap:6px;">
                <i data-lucide="grip-vertical" style="width:14px;height:14px;color:var(--accent-purple-glow);"></i>
                <span>Drag rows to change display order</span>
            </div>
        </div>

        @if(isset($footerLinks) && count($footerLinks) > 0)
            <div class="glass-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 44px;" aria-label="Reorder"></th>
                            <th style="width: 60px;">Icon</th>
                            <th>Label</th>
                            <th>Destination URL</th>
                            <th style="text-align: center; width: 80px;">Order</th>
                            <th style="width: 110px;">Status</th>
                            <th style="text-align: right; width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="footer-links-table-body">
                        @foreach($footerLinks as $link)
                            @php
                                $lowerUrl = strtolower($link->url);
                                $icon = 'link';
                                if (str_contains($lowerUrl, 'discord')) $icon = 'message-square';
                                elseif (str_contains($lowerUrl, 'youtube')) $icon = 'video';
                                elseif (str_contains($lowerUrl, 'twitch')) $icon = 'tv';
                                elseif (str_contains($lowerUrl, 'twitter') || str_contains($lowerUrl, 'x.com')) $icon = 'twitter';
                                elseif (str_contains($lowerUrl, 'github')) $icon = 'github';
                            @endphp
                            <tr data-id="{{ $link->id }}" class="draggable-row">
                                <td>
                                    <span class="drag-handle" title="Drag to reorder link">
                                        <i data-lucide="grip-vertical"></i>
                                    </span>
                                </td>
                                <td>
                                    <div style="width:36px; height:36px; border-radius:var(--radius-xs); background:rgba(6,182,212,0.12); border:1px solid rgba(6,182,212,0.25); display:flex; align-items:center; justify-content:center; color:var(--accent-cyan);">
                                        <i data-lucide="{{ $icon }}"></i>
                                    </div>
                                </td>
                                <td>
                                    <span style="font-weight:700; color:var(--text-primary);">{{ $link->name }}</span>
                                </td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener" 
                                       style="color:var(--accent-cyan); font-family:var(--font-mono); font-size:0.84rem; text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
                                        <span>{{ Str::limit($link->url, 45) }}</span>
                                        <i data-lucide="external-link" style="width:12px;height:12px;"></i>
                                    </a>
                                </td>
                                <td style="text-align: center;" class="order-cell">
                                    <span class="order-badge">{{ $link->order }}</span>
                                </td>
                                <td>
                                    @if($link->is_active)
                                        <span class="status-pill status-pill--active"><i data-lucide="check"></i> Active</span>
                                    @else
                                        <span class="status-pill status-pill--inactive"><i data-lucide="minus"></i> Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-icon btn-icon--edit" title="Edit Link"
                                                onclick='openEditLinkModal(@json($link))'>
                                            <i data-lucide="pencil"></i>
                                        </button>
                                        <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}" class="inline-form" id="delLink-{{ $link->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-icon btn-icon--delete" title="Delete Link"
                                                    onclick="confirmLinkDelete('{{ $link->id }}', '{{ addslashes($link->name) }}')">
                                                <i data-lucide="trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 48px 20px;">
                <i data-lucide="link-2-off" style="width:36px; height:36px; color:var(--text-dim); margin-bottom:10px;"></i>
                <h4 style="color:var(--text-primary); margin-bottom:4px;">No footer links added yet</h4>
                <p style="font-size:0.85rem; color:var(--text-muted);">Use the form above to add your Discord, YouTube, or guild website links.</p>
            </div>
        @endif
    </div>

    {{-- Edit Link Modal --}}
    <div id="editLinkModal" class="modal-overlay" style="display: none;" role="dialog" aria-modal="true" aria-labelledby="editLinkTitle">
        <div class="modal-panel" style="max-width: 480px;">
            <div class="modal-header">
                <h2 id="editLinkTitle"><i data-lucide="link"></i> Edit Link</h2>
                <button type="button" class="modal-close" onclick="closeEditLinkModal()" aria-label="Close">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <form method="POST" action="" id="editLinkForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="edit_link_name">Link Label</label>
                    <input type="text" id="edit_link_name" name="name" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit_link_url">URL Address</label>
                    <input type="text" id="edit_link_url" name="url" class="form-input" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Visibility Status</label>
                    <label class="toggle">
                        <input type="checkbox" id="edit_link_is_active" name="is_active" value="1">
                        <span class="toggle-track">
                            <span class="toggle-thumb"></span>
                        </span>
                        <span class="toggle-text" id="editLinkToggleText">Active</span>
                    </label>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditLinkModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save"></i>
                        <span>Save Link</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
const FOOTER_UPDATE_BASE_URL = @json(url('/admin/footer/link'));

function setLinkPreset(name, url) {
    document.getElementById('link_name').value = name;
    document.getElementById('link_url').value = url;
}

function openEditLinkModal(link) {
    document.getElementById('edit_link_name').value = link.name;
    document.getElementById('edit_link_url').value = link.url;
    document.getElementById('edit_link_is_active').checked = !!link.is_active;
    document.getElementById('editLinkToggleText').textContent = link.is_active ? 'Active' : 'Inactive';
    document.getElementById('editLinkForm').action = FOOTER_UPDATE_BASE_URL + '/' + link.id;

    document.getElementById('editLinkModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    if (window.lucide) lucide.createIcons();
}

function closeEditLinkModal() {
    document.getElementById('editLinkModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('edit_link_is_active')?.addEventListener('change', (e) => {
    document.getElementById('editLinkToggleText').textContent = e.target.checked ? 'Active' : 'Inactive';
});

document.getElementById('editLinkModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'editLinkModal') closeEditLinkModal();
});

// Confirm Link Delete
window.confirmLinkDelete = function(linkId, linkName) {
    if (window.confirmAction) {
        window.confirmAction({
            title: 'Delete Footer Link',
            message: `Are you sure you want to delete "${linkName}"?`,
            btnText: 'Delete Link',
            onConfirm: function() {
                const form = document.getElementById('delLink-' + linkId);
                if (form) form.submit();
            }
        });
    } else {
        if (confirm(`Delete "${linkName}"?`)) {
            const form = document.getElementById('delLink-' + linkId);
            if (form) form.submit();
        }
    }
};

// Sortable Links Reorder
const linkListEl = document.getElementById('footer-links-table-body');
if (linkListEl) {
    Sortable.create(linkListEl, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        onEnd: function() {
            const rows = linkListEl.querySelectorAll('tr[data-id]');
            const ids = Array.from(rows).map(r => r.dataset.id);
            rows.forEach((row, i) => {
                const cell = row.querySelector('.order-cell .order-badge');
                if (cell) cell.textContent = i + 1;
            });

            fetch(@json(route('admin.footer.link.reorder')), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && window.showToast) {
                    showToast('Footer link order saved!', 'success');
                }
            })
            .catch(() => {
                if (window.showToast) showToast('Failed to save link order', 'error');
            });
        }
    });
}

if (window.lucide) lucide.createIcons();
</script>
@endpush