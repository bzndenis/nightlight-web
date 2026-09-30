@extends('admin.layout')
@section('page-title', 'Guild Team')
@section('page-subtitle', 'Manage leadership, officers, and active guild members')

@section('content')
    @php
        $totalCount = $teamMembers->count();
        $activeCount = $teamMembers->where('is_active', true)->count();
        $inactiveCount = $totalCount - $activeCount;
    @endphp

    <div class="page-header" data-aos="fade-up">
        <div class="page-header__left">
            <h1 class="page-header__title">Guild Roster & Leadership</h1>
            <p class="page-header__desc">
                Configure guild members, leadership titles, quotes, avatars, and their display order on the public site.
            </p>
        </div>
        <div class="page-header__actions">
            <a href="{{ url('/') }}#team" target="_blank" rel="noopener" class="btn btn-secondary">
                <i data-lucide="external-link"></i>
                <span>View on Website</span>
            </a>
            <button type="button" class="btn btn-primary" onclick="toggleAddMemberDrawer()">
                <i data-lucide="user-plus"></i>
                <span>Add Members</span>
            </button>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="stat-grid stat-grid--3" data-aos="fade-up">
        <div class="stat-card stat-card--purple">
            <div class="stat-card__top">
                <div class="stat-icon"><i data-lucide="users"></i></div>
                <span class="stat-badge">Total</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalCount }}</div>
                <div class="stat-label">Total Roster Entries</div>
                <div class="stat-meta">Guild members and officers</div>
            </div>
        </div>

        <div class="stat-card stat-card--emerald">
            <div class="stat-card__top">
                <div class="stat-icon"><i data-lucide="user-check"></i></div>
                <span class="stat-badge stat-badge--live">Visible</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $activeCount }}</div>
                <div class="stat-label">Active on Public Site</div>
                <div class="stat-meta">Displayed to all visitors</div>
            </div>
        </div>

        <div class="stat-card stat-card--cyan">
            <div class="stat-card__top">
                <div class="stat-icon"><i data-lucide="user-x"></i></div>
                <span class="stat-badge">Hidden</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $inactiveCount }}</div>
                <div class="stat-label">Inactive / Draft Members</div>
                <div class="stat-meta">Kept in database, hidden on site</div>
            </div>
        </div>
    </div>

    {{-- Add Member Collapsible Form --}}
    <div class="glass-card team-add-card {{ $totalCount === 0 ? 'is-open' : '' }}" id="addFormCard" data-aos="fade-up" data-aos-delay="40">
        <button type="button" class="team-add-toggle" id="addFormToggle" aria-expanded="{{ $totalCount === 0 ? 'true' : 'false' }}">
            <div class="team-add-toggle__left">
                <div class="team-add-toggle__icon">
                    <i data-lucide="user-plus"></i>
                </div>
                <div class="team-add-toggle__text">
                    <span class="team-add-toggle__title">Batch Add Team Members</span>
                    <span class="team-add-toggle__desc">Add one or multiple guild members in one submission</span>
                </div>
            </div>
            <div class="team-add-toggle__right">
                <span class="team-add-toggle__status-badge" id="addFormToggleState">
                    {{ $totalCount === 0 ? 'Collapse Form' : 'Expand Form' }}
                </span>
                <i data-lucide="chevron-down" class="team-add-toggle__chevron"></i>
            </div>
        </button>

        <div class="team-add-body" id="addFormBody">
            <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" id="batch-form">
                @csrf
                <div id="member-fields-container">
                    <div class="member-row" data-row="0">
                        <div class="member-row__header">
                            <div class="member-row__title-wrap">
                                <span class="member-row__badge">Member #1</span>
                                <span class="member-row__hint">Fill member details & optional avatar</span>
                            </div>
                            <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove this member entry" aria-label="Remove entry">
                                <i data-lucide="trash-2"></i>
                                <span>Remove</span>
                            </button>
                        </div>
                        <div class="member-row__grid">
                            <div class="form-group">
                                <label class="form-label">Full Name <span class="required-star">*</span></label>
                                <input type="text" name="name[]" class="form-input" placeholder="e.g. Dennis Bradley" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Guild Role / Title <span class="required-star">*</span></label>
                                <input type="text" name="role[]" class="form-input" placeholder="e.g. Guild Master / Raid Leader" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quote or Bio <span class="required-star">*</span></label>
                                <textarea name="quote[]" class="form-textarea member-textarea" rows="3" placeholder="e.g. Leading the guild through dark dungeons and high-tier raids." required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Avatar Image</label>
                                <label class="file-upload member-file-upload">
                                    <input type="file" name="avatar[]" accept="image/*" onchange="previewBatchAvatar(this)">
                                    <span class="file-upload__box">
                                        <i data-lucide="upload-cloud"></i>
                                        <span class="file-upload__text">Choose photo (JPG, PNG, WebP)</span>
                                    </span>
                                </label>
                                <div class="file-upload__preview"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="batch-actions">
                    <button type="button" class="btn btn-secondary" onclick="addBatchRow()">
                        <i data-lucide="plus"></i>
                        <span>Add Another Member Row</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="user-check"></i>
                        <span>Save All Members</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Team Roster Section --}}
    <div class="glass-card" data-aos="fade-up" data-aos-delay="80">
        {{-- Toolbar --}}
        <div class="toolbar">
            <div class="toolbar__search">
                <i data-lucide="search" style="color:var(--text-muted); width:16px; height:16px;"></i>
                <input type="text" id="memberSearchInput" placeholder="Filter by name, role or quote...">
            </div>

            <div class="toolbar__filters">
                <button type="button" class="filter-btn is-active" data-filter="all">All ({{ $totalCount }})</button>
                <button type="button" class="filter-btn" data-filter="active">Active ({{ $activeCount }})</button>
                <button type="button" class="filter-btn" data-filter="inactive">Inactive ({{ $inactiveCount }})</button>
            </div>

            <div class="toolbar__actions">
                <span class="badge badge--cyan" style="display:inline-flex; align-items:center; gap:5px;">
                    <i data-lucide="grip-vertical" style="width:13px; height:13px;"></i>
                    <span>Drag rows to reorder</span>
                </span>

                <div class="view-toggle">
                    <button type="button" class="view-toggle-btn is-active" id="teamTableViewBtn" title="Table View">
                        <i data-lucide="list"></i>
                    </button>
                    <button type="button" class="view-toggle-btn" id="teamGridViewBtn" title="Cards View">
                        <i data-lucide="grid"></i>
                    </button>
                </div>
            </div>
        </div>

        @if($totalCount > 0)
            {{-- Table View --}}
            <div class="glass-table-wrap" id="teamTableViewWrap">
                <table class="admin-table team-table">
                    <thead>
                        <tr>
                            <th style="width: 44px;" aria-label="Reorder"></th>
                            <th style="width: 72px;">Avatar</th>
                            <th>
                                <a href="{{ route('admin.team', ['sort' => 'name', 'dir' => $sortBy === 'name' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort">
                                    <span>Name</span>
                                    @if($sortBy === 'name')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('admin.team', ['sort' => 'role', 'dir' => $sortBy === 'role' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort">
                                    <span>Role</span>
                                    @if($sortBy === 'role')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th>Quote</th>
                            <th style="text-align: center; width: 80px;">Order</th>
                            <th style="width: 110px;">Status</th>
                            <th style="text-align: right; width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="team-table-body">
                        @foreach($teamMembers as $member)
                            <tr data-id="{{ $member->id }}" 
                                data-name="{{ strtolower($member->name) }}"
                                data-role="{{ strtolower($member->role) }}"
                                data-quote="{{ strtolower($member->quote) }}"
                                data-status="{{ $member->is_active ? 'active' : 'inactive' }}"
                                class="team-row draggable-row">
                                <td>
                                    <span class="drag-handle" title="Drag to reorder on public site">
                                        <i data-lucide="grip-vertical"></i>
                                    </span>
                                </td>
                                <td>
                                    <div class="team-avatar">
                                        <img src="{{ $member->avatar ? asset($member->avatar) : asset('images/avatars/user-01.jpg') }}"
                                             alt="{{ $member->name }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="team-name">{{ $member->name }}</span>
                                    <span class="team-id">#{{ $member->id }}</span>
                                </td>
                                <td>
                                    <span class="team-role">{{ $member->role }}</span>
                                </td>
                                <td>
                                    <span class="team-quote" title="{{ $member->quote }}">{{ Str::limit($member->quote, 70) }}</span>
                                </td>
                                <td style="text-align: center;" class="order-cell">
                                    <span class="order-badge">{{ $member->order }}</span>
                                </td>
                                <td>
                                    @if($member->is_active)
                                        <span class="status-pill status-pill--active"><i data-lucide="check"></i> Active</span>
                                    @else
                                        <span class="status-pill status-pill--inactive"><i data-lucide="minus"></i> Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-icon btn-icon--edit" title="Edit Member"
                                                onclick='openEditModal(@json($member))'>
                                            <i data-lucide="pencil"></i>
                                        </button>
                                        <form method="POST" action="{{ route('admin.team.delete', $member->id) }}" class="inline-form" id="delMember-{{ $member->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-icon btn-icon--delete" title="Delete Member"
                                                    onclick="confirmMemberDelete('{{ $member->id }}', '{{ addslashes($member->name) }}')">
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

            {{-- Cards Grid View (Initially Hidden) --}}
            <div class="team-grid" id="teamGridViewWrap" style="display: none;">
                @foreach($teamMembers as $member)
                    <div class="team-card" 
                         data-id="{{ $member->id }}"
                         data-name="{{ strtolower($member->name) }}"
                         data-role="{{ strtolower($member->role) }}"
                         data-quote="{{ strtolower($member->quote) }}"
                         data-status="{{ $member->is_active ? 'active' : 'inactive' }}">
                        <div class="team-card__avatar">
                            <img src="{{ $member->avatar ? asset($member->avatar) : asset('images/avatars/user-01.jpg') }}" alt="{{ $member->name }}">
                        </div>
                        <h3 class="team-card__name">{{ $member->name }}</h3>
                        <div class="team-card__role">{{ $member->role }}</div>
                        <p class="team-card__quote">"{{ $member->quote }}"</p>
                        
                        <div class="team-card__footer">
                            <span class="status-pill {{ $member->is_active ? 'status-pill--active' : 'status-pill--inactive' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>

                            <div style="display:flex; align-items:center; gap:8px;">
                                <button type="button" class="btn-icon btn-icon--edit" title="Edit Member"
                                        onclick='openEditModal(@json($member))'>
                                    <i data-lucide="pencil"></i>
                                </button>
                                <button type="button" class="btn-icon btn-icon--delete" title="Delete Member"
                                        onclick="confirmMemberDelete('{{ $member->id }}', '{{ addslashes($member->name) }}')">
                                    <i data-lucide="trash-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="noTeamMatches" style="display: none; text-align: center; padding: 48px 20px;">
                <i data-lucide="user-x" style="width:40px; height:40px; color:var(--text-dim); margin-bottom:12px;"></i>
                <h4 style="color:var(--text-primary); margin-bottom:6px;">No matching members found</h4>
                <p style="font-size:0.85rem; color:var(--text-muted);">Try a different search keyword or switch the active status filter.</p>
            </div>
        @else
            <div style="text-align: center; padding: 56px 20px;">
                <div style="width:68px; height:68px; border-radius:var(--radius-lg); background:rgba(124,58,237,0.1); border:1px solid rgba(124,58,237,0.25); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; color:var(--accent-purple-glow);">
                    <i data-lucide="users" style="width:32px; height:32px;"></i>
                </div>
                <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-primary); margin-bottom:6px;">No Guild Members Added Yet</h3>
                <p style="font-size:0.88rem; color:var(--text-muted); max-width:420px; margin:0 auto 20px;">
                    Build your guild roster by adding officers, raid leads, and prominent members.
                </p>
                <button type="button" class="btn btn-primary" onclick="toggleAddMemberDrawer()">
                    <i data-lucide="user-plus"></i>
                    <span>Add First Member</span>
                </button>
            </div>
        @endif
    </div>

    {{-- Edit Member Modal --}}
    <div id="edit-modal" class="modal-overlay" style="display:none;" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
        <div class="modal-panel team-edit-modal">
            <div class="modal-header">
                <h2 id="editModalTitle"><i data-lucide="user-cog"></i> Edit Team Member</h2>
                <button type="button" class="modal-close" onclick="closeEditModal()" aria-label="Close">
                    <i data-lucide="x"></i>
                </button>
            </div>

            <form method="POST" action="" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="team-edit-preview">
                    <div class="team-edit-avatar" id="edit-avatar-preview">
                        <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Avatar preview">
                    </div>
                    <div class="team-edit-preview-info">
                        <span class="team-edit-preview-name" id="edit-preview-name">—</span>
                        <span class="team-edit-preview-role" id="edit-preview-role">—</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="edit-name">Full Name</label>
                        <input type="text" id="edit-name" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-role">Guild Role</label>
                        <input type="text" id="edit-role" name="role" class="form-input" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit-quote">Quote or Tagline</label>
                    <textarea id="edit-quote" name="quote" class="form-textarea" rows="3" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="edit-order">Display Order Index</label>
                        <input type="number" id="edit-order" name="order" class="form-input" min="1">
                    </div>
                    <div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">
                        <label class="form-label">Visibility Status</label>
                        <label class="toggle">
                            <input type="checkbox" id="edit-is_active" name="is_active" value="1">
                            <span class="toggle-track">
                                <span class="toggle-thumb"></span>
                            </span>
                            <span class="toggle-text" id="edit-toggle-text">Active</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="edit-avatar">Replace Photo</label>
                    <label class="file-upload">
                        <input type="file" id="edit-avatar" name="avatar" accept="image/*" onchange="previewEditAvatar(this)">
                        <span class="file-upload__box">
                            <i data-lucide="image-plus"></i>
                            <span class="file-upload__text">Upload new avatar file (optional)</span>
                        </span>
                    </label>
                    <p class="form-hint">Leave blank to retain current member photo.</p>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
const TEAM_UPDATE_URL = @json(url('/admin/team'));
const DEFAULT_AVATAR = @json(asset('images/avatars/user-01.jpg'));
const ASSET_URL = @json(rtrim(asset(''), '/'));

function memberAvatarUrl(path) {
    if (!path) return DEFAULT_AVATAR;
    if (path.startsWith('http')) return path;
    return ASSET_URL + '/' + path.replace(/^\//, '');
}

function refreshIcons() {
    if (window.lucide) lucide.createIcons();
}

function updateRowBadges() {
    document.querySelectorAll('.member-row').forEach((row, i) => {
        const badge = row.querySelector('.member-row__badge');
        if (badge) badge.textContent = 'Member #' + (i + 1);
        row.dataset.row = i;
    });
}

function addBatchRow() {
    const container = document.getElementById('member-fields-container');
    const index = container.querySelectorAll('.member-row').length;
    const num = index + 1;
    const html = `<div class="member-row" data-row="${index}">
        <div class="member-row__header">
            <div class="member-row__title-wrap">
                <span class="member-row__badge">Member #${num}</span>
                <span class="member-row__hint">Fill member details & optional avatar</span>
            </div>
            <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove this member entry" aria-label="Remove entry">
                <i data-lucide="trash-2"></i>
                <span>Remove</span>
            </button>
        </div>
        <div class="member-row__grid">
            <div class="form-group">
                <label class="form-label">Full Name <span class="required-star">*</span></label>
                <input type="text" name="name[]" class="form-input" placeholder="e.g. Dennis Bradley" required>
            </div>
            <div class="form-group">
                <label class="form-label">Guild Role / Title <span class="required-star">*</span></label>
                <input type="text" name="role[]" class="form-input" placeholder="e.g. Guild Master / Raid Leader" required>
            </div>
            <div class="form-group">
                <label class="form-label">Quote or Bio <span class="required-star">*</span></label>
                <textarea name="quote[]" class="form-textarea member-textarea" rows="3" placeholder="e.g. Leading the guild through dark dungeons and high-tier raids." required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Avatar Image</label>
                <label class="file-upload member-file-upload">
                    <input type="file" name="avatar[]" accept="image/*" onchange="previewBatchAvatar(this)">
                    <span class="file-upload__box">
                        <i data-lucide="upload-cloud"></i>
                        <span class="file-upload__text">Choose photo (JPG, PNG, WebP)</span>
                    </span>
                </label>
                <div class="file-upload__preview"></div>
            </div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    refreshIcons();
}

function removeBatchRow(btn) {
    const rows = document.querySelectorAll('.member-row');
    if (rows.length > 1) {
        btn.closest('.member-row').remove();
        updateRowBadges();
    } else if (window.showToast) {
        showToast('At least one member entry is required.', 'error');
    }
}

function previewBatchAvatar(input) {
    const preview = input.closest('.form-group').querySelector('.file-upload__preview');
    const text = input.closest('.file-upload').querySelector('.file-upload__text');
    if (input.files && input.files[0]) {
        const url = URL.createObjectURL(input.files[0]);
        preview.innerHTML = `<img src="${url}" alt="Preview" style="width:48px;height:48px;border-radius:50%;object-fit:cover;margin-top:8px;border:2px solid var(--accent-purple);">`;
        text.textContent = input.files[0].name;
    } else {
        preview.innerHTML = '';
        text.textContent = 'Choose photo (JPG, PNG, WebP)';
    }
}

// Drawer Toggle
function toggleAddMemberDrawer() {
    const card = document.getElementById('addFormCard');
    const toggle = document.getElementById('addFormToggle');
    const badge = document.getElementById('addFormToggleState');
    const isOpen = card.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (badge) {
        badge.textContent = isOpen ? 'Collapse Form' : 'Expand Form';
    }
    if (isOpen) {
        card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}
document.getElementById('addFormToggle')?.addEventListener('click', toggleAddMemberDrawer);

// Edit Modal
function openEditModal(member) {
    document.getElementById('edit-name').value = member.name;
    document.getElementById('edit-role').value = member.role;
    document.getElementById('edit-quote').value = member.quote;
    document.getElementById('edit-order').value = member.order;
    document.getElementById('edit-is_active').checked = !!member.is_active;
    document.getElementById('edit-toggle-text').textContent = member.is_active ? 'Active' : 'Inactive';
    document.getElementById('edit-form').action = TEAM_UPDATE_URL + '/' + member.id;

    const img = document.querySelector('#edit-avatar-preview img');
    img.src = memberAvatarUrl(member.avatar);
    document.getElementById('edit-preview-name').textContent = member.name;
    document.getElementById('edit-preview-role').textContent = member.role;

    document.getElementById('edit-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    refreshIcons();
}

function closeEditModal() {
    document.getElementById('edit-modal').style.display = 'none';
    document.body.style.overflow = '';
    document.getElementById('edit-avatar').value = '';
}

function previewEditAvatar(input) {
    if (input.files && input.files[0]) {
        document.querySelector('#edit-avatar-preview img').src = URL.createObjectURL(input.files[0]);
    }
}

document.getElementById('edit-name')?.addEventListener('input', e => {
    document.getElementById('edit-preview-name').textContent = e.target.value || '—';
});
document.getElementById('edit-role')?.addEventListener('input', e => {
    document.getElementById('edit-preview-role').textContent = e.target.value || '—';
});
document.getElementById('edit-is_active')?.addEventListener('change', e => {
    document.getElementById('edit-toggle-text').textContent = e.target.checked ? 'Active' : 'Inactive';
});

document.getElementById('edit-modal')?.addEventListener('click', e => {
    if (e.target.id === 'edit-modal') closeEditModal();
});

// Confirm Member Delete
window.confirmMemberDelete = function(memberId, memberName) {
    if (window.confirmAction) {
        window.confirmAction({
            title: 'Remove Team Member',
            message: `Are you sure you want to remove "${memberName}" from the guild roster? This action cannot be undone.`,
            btnText: 'Delete Member',
            onConfirm: function() {
                const form = document.getElementById('delMember-' + memberId);
                if (form) form.submit();
            }
        });
    } else {
        if (confirm(`Delete ${memberName}?`)) {
            const form = document.getElementById('delMember-' + memberId);
            if (form) form.submit();
        }
    }
};

// Search & Filter Toolbar
const searchInput = document.getElementById('memberSearchInput');
const filterBtns = document.querySelectorAll('.filter-btn');
const tableRows = document.querySelectorAll('.team-row');
const gridCards = document.querySelectorAll('.team-card');
const noTeamMatches = document.getElementById('noTeamMatches');
let currentFilter = 'all';

function applyTeamFilters() {
    const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
    let visibleCount = 0;

    tableRows.forEach(row => {
        const name = row.dataset.name || '';
        const role = row.dataset.role || '';
        const quote = row.dataset.quote || '';
        const status = row.dataset.status || '';

        const matchesQuery = !query || name.includes(query) || role.includes(query) || quote.includes(query);
        const matchesFilter = currentFilter === 'all' || status === currentFilter;

        const isVisible = matchesQuery && matchesFilter;
        row.style.display = isVisible ? '' : 'none';
        if (isVisible) visibleCount++;
    });

    gridCards.forEach(card => {
        const name = card.dataset.name || '';
        const role = card.dataset.role || '';
        const quote = card.dataset.quote || '';
        const status = card.dataset.status || '';

        const matchesQuery = !query || name.includes(query) || role.includes(query) || quote.includes(query);
        const matchesFilter = currentFilter === 'all' || status === currentFilter;

        card.style.display = matchesQuery && matchesFilter ? 'flex' : 'none';
    });

    if (noTeamMatches) {
        noTeamMatches.style.display = visibleCount === 0 ? 'block' : 'none';
    }
}

searchInput?.addEventListener('input', applyTeamFilters);

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('is-active'));
        btn.classList.add('is-active');
        currentFilter = btn.dataset.filter;
        applyTeamFilters();
    });
});

// View Toggle (Table vs Cards Grid)
const teamTableViewBtn = document.getElementById('teamTableViewBtn');
const teamGridViewBtn = document.getElementById('teamGridViewBtn');
const teamTableWrap = document.getElementById('teamTableViewWrap');
const teamGridWrap = document.getElementById('teamGridViewWrap');

teamTableViewBtn?.addEventListener('click', () => {
    teamTableViewBtn.classList.add('is-active');
    teamGridViewBtn.classList.remove('is-active');
    if (teamTableWrap) teamTableWrap.style.display = 'block';
    if (teamGridWrap) teamGridWrap.style.display = 'none';
});

teamGridViewBtn?.addEventListener('click', () => {
    teamGridViewBtn.classList.add('is-active');
    teamTableViewBtn.classList.remove('is-active');
    if (teamTableWrap) teamTableWrap.style.display = 'none';
    if (teamGridWrap) teamGridWrap.style.display = 'grid';
});

// Sortable Reordering
const el = document.getElementById('team-table-body');
if (el) {
    Sortable.create(el, {
        animation: 200,
        handle: '.drag-handle',
        ghostClass: 'sortable-ghost',
        onEnd: function () {
            const rows = el.querySelectorAll('tr[data-id]');
            const ids = Array.from(rows).map(r => r.dataset.id);
            rows.forEach((row, i) => {
                const cell = row.querySelector('.order-cell .order-badge');
                if (cell) cell.textContent = i + 1;
            });

            fetch(@json(route('admin.team.reorder')), {
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
                    showToast('Team roster order updated successfully!', 'success');
                }
            })
            .catch(() => {
                if (window.showToast) showToast('Failed to save team order', 'error');
            });
        }
    });
}

// Auto open edit modal if query param is set
@if(request('edit'))
    (function() {
        const member = @json($teamMembers->firstWhere('id', request('edit')));
        if (member) openEditModal(member);
    })();
@endif

refreshIcons();
</script>
@endpush
