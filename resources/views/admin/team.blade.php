@extends('admin.layout')
@section('page-title', 'Team')
@section('page-subtitle', 'Manage guild members and roles')

@section('content')
    @php
        $totalCount = $teamMembers->count();
        $activeCount = $teamMembers->where('is_active', true)->count();
        $inactiveCount = $totalCount - $activeCount;
    @endphp

    {{-- Stats --}}
    <div class="team-stats">
        <div class="team-stat">
            <span class="team-stat__icon team-stat__icon--purple"><i data-lucide="users"></i></span>
            <div>
                <span class="team-stat__num">{{ $totalCount }}</span>
                <span class="team-stat__label">Total Members</span>
            </div>
        </div>
        <div class="team-stat">
            <span class="team-stat__icon team-stat__icon--green"><i data-lucide="user-check"></i></span>
            <div>
                <span class="team-stat__num">{{ $activeCount }}</span>
                <span class="team-stat__label">Active</span>
            </div>
        </div>
        <div class="team-stat">
            <span class="team-stat__icon team-stat__icon--red"><i data-lucide="user-x"></i></span>
            <div>
                <span class="team-stat__num">{{ $inactiveCount }}</span>
                <span class="team-stat__label">Inactive</span>
            </div>
        </div>
    </div>

    {{-- Add Members (collapsible) --}}
    <div class="glass-card team-add-card {{ $totalCount === 0 ? 'is-open' : '' }}" id="addFormCard">
        <button type="button" class="team-add-toggle" id="addFormToggle" aria-expanded="{{ $totalCount === 0 ? 'true' : 'false' }}">
            <span class="team-add-toggle__left">
                <i data-lucide="user-plus"></i>
                <span>
                    <strong>Add Team Members</strong>
                    <small>Batch add one or more members at once</small>
                </span>
            </span>
            <i data-lucide="chevron-down" class="team-add-toggle__chevron"></i>
        </button>

        <div class="team-add-body" id="addFormBody">
            <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" id="batch-form">
                @csrf
                <div id="member-fields-container">
                    <div class="member-row" data-row="0">
                        <div class="member-row__header">
                            <span class="member-row__badge">Member 1</span>
                            <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove row" aria-label="Remove row">
                                <i data-lucide="x"></i>
                            </button>
                        </div>
                        <div class="member-row__grid">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" name="name[]" class="form-input" placeholder="Member name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <input type="text" name="role[]" class="form-input" placeholder="e.g. Guild Leader" required>
                            </div>
                            <div class="form-group member-row__quote">
                                <label class="form-label">Quote</label>
                                <textarea name="quote[]" class="form-textarea" rows="2" placeholder="A short quote or tagline" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Avatar</label>
                                <label class="file-upload">
                                    <input type="file" name="avatar[]" accept="image/*" onchange="previewBatchAvatar(this)">
                                    <span class="file-upload__box">
                                        <i data-lucide="upload"></i>
                                        <span class="file-upload__text">Choose image</span>
                                    </span>
                                </label>
                                <div class="file-upload__preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="batch-actions">
                    <button type="button" class="btn btn-ghost" onclick="addBatchRow()">
                        <i data-lucide="plus"></i> Add Another
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="user-plus"></i> Save Members
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Roster Table --}}
    <div class="glass-card team-roster-card">
        <div class="team-roster-head">
            <div class="section-title">
                <i data-lucide="users"></i>
                Team Roster
                <span class="badge">{{ $totalCount }} {{ Str::plural('member', $totalCount) }}</span>
                <span class="badge badge--hint"><i data-lucide="grip-vertical"></i> Drag to reorder</span>
            </div>
            @if($totalCount > 0)
                <button type="button" class="btn btn-ghost btn-sm" onclick="document.getElementById('addFormToggle').click()">
                    <i data-lucide="user-plus"></i> Add
                </button>
            @endif
        </div>

        @if($totalCount > 0)
            <div class="team-table-wrap">
                <table class="team-table">
                    <colgroup>
                        <col class="col-drag">
                        <col class="col-avatar">
                        <col class="col-name">
                        <col class="col-role">
                        <col class="col-quote">
                        <col class="col-order">
                        <col class="col-status">
                        <col class="col-actions">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col" aria-label="Reorder"></th>
                            <th scope="col">Avatar</th>
                            <th scope="col">
                                <a href="{{ route('admin.team', ['sort' => 'name', 'dir' => $sortBy === 'name' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort {{ $sortBy === 'name' ? 'is-active' : '' }}">
                                    Name
                                    @if($sortBy === 'name')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('admin.team', ['sort' => 'role', 'dir' => $sortBy === 'role' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort {{ $sortBy === 'role' ? 'is-active' : '' }}">
                                    Role
                                    @if($sortBy === 'role')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">Quote</th>
                            <th scope="col">
                                <a href="{{ route('admin.team', ['sort' => 'order', 'dir' => $sortBy === 'order' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort {{ $sortBy === 'order' ? 'is-active' : '' }}">
                                    Order
                                    @if($sortBy === 'order')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('admin.team', ['sort' => 'is_active', 'dir' => $sortBy === 'is_active' && $sortDir === 'asc' ? 'desc' : 'asc']) }}" class="th-sort {{ $sortBy === 'is_active' ? 'is-active' : '' }}">
                                    Status
                                    @if($sortBy === 'is_active')
                                        <i data-lucide="{{ $sortDir === 'asc' ? 'arrow-up' : 'arrow-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="team-table-body">
                        @foreach($teamMembers as $member)
                            <tr data-id="{{ $member->id }}" class="draggable-row">
                                <td>
                                    <span class="drag-handle" title="Drag to reorder">
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
                                <td><span class="team-role">{{ $member->role }}</span></td>
                                <td>
                                    <span class="team-quote" title="{{ $member->quote }}">{{ Str::limit($member->quote, 60) }}</span>
                                </td>
                                <td class="order-cell">
                                    <span class="order-badge">{{ $member->order }}</span>
                                </td>
                                <td>
                                    @if($member->is_active)
                                        <span class="status-pill status-pill--active"><i data-lucide="check"></i> Active</span>
                                    @else
                                        <span class="status-pill status-pill--inactive"><i data-lucide="minus"></i> Inactive</span>
                                    @endif
                                </td>
                                <td class="col-actions">
                                    <div class="table-actions">
                                        <button type="button" class="btn-icon btn-icon--edit" title="Edit"
                                                onclick='openEditModal(@json($member))'>
                                            <i data-lucide="pencil"></i>
                                        </button>
                                        <form method="POST" action="{{ route('admin.team.delete', $member->id) }}" class="inline-form"
                                              onsubmit="return confirm('Delete {{ addslashes($member->name) }}? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-icon--delete" title="Delete">
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
            <div class="team-empty">
                <div class="team-empty__icon"><i data-lucide="users"></i></div>
                <h3>No team members yet</h3>
                <p>Add your first guild member using the form above. They will appear on the public team section.</p>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('addFormToggle').click()">
                    <i data-lucide="user-plus"></i> Add First Member
                </button>
            </div>
        @endif
    </div>

    {{-- Edit Modal --}}
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
                        <label class="form-label" for="edit-name">Name</label>
                        <input type="text" id="edit-name" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-role">Role</label>
                        <input type="text" id="edit-role" name="role" class="form-input" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit-quote">Quote</label>
                    <textarea id="edit-quote" name="quote" class="form-textarea" rows="3" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="edit-order">Display Order</label>
                        <input type="number" id="edit-order" name="order" class="form-input" min="1">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Visibility</label>
                        <label class="toggle">
                            <input type="checkbox" id="edit-is_active" name="is_active" value="1">
                            <span class="toggle-track"></span>
                            <span class="toggle-thumb"></span>
                            <span class="toggle-text" id="edit-toggle-text">Active</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="edit-avatar">Replace Avatar</label>
                    <label class="file-upload file-upload--inline">
                        <input type="file" id="edit-avatar" name="avatar" accept="image/*" onchange="previewEditAvatar(this)">
                        <span class="file-upload__box">
                            <i data-lucide="image-plus"></i>
                            <span class="file-upload__text">Upload new photo</span>
                        </span>
                    </label>
                    <p class="form-hint">Leave empty to keep the current avatar.</p>
                </div>
                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
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

function refreshTeamIcons() {
    if (window.lucide) lucide.createIcons();
}

function updateRowBadges() {
    document.querySelectorAll('.member-row').forEach((row, i) => {
        const badge = row.querySelector('.member-row__badge');
        if (badge) badge.textContent = 'Member ' + (i + 1);
    });
}

function addBatchRow() {
    const container = document.getElementById('member-fields-container');
    const index = container.querySelectorAll('.member-row').length;
    const html = `<div class="member-row" data-row="${index}">
        <div class="member-row__header">
            <span class="member-row__badge">Member ${index + 1}</span>
            <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove row" aria-label="Remove row">
                <i data-lucide="x"></i>
            </button>
        </div>
        <div class="member-row__grid">
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name[]" class="form-input" placeholder="Member name" required>
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <input type="text" name="role[]" class="form-input" placeholder="e.g. Guild Leader" required>
            </div>
            <div class="form-group member-row__quote">
                <label class="form-label">Quote</label>
                <textarea name="quote[]" class="form-textarea" rows="2" placeholder="A short quote or tagline" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Avatar</label>
                <label class="file-upload">
                    <input type="file" name="avatar[]" accept="image/*" onchange="previewBatchAvatar(this)">
                    <span class="file-upload__box">
                        <i data-lucide="upload"></i>
                        <span class="file-upload__text">Choose image</span>
                    </span>
                </label>
                <div class="file-upload__preview"></div>
            </div>
        </div>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
    refreshTeamIcons();
}

function removeBatchRow(btn) {
    const rows = document.querySelectorAll('.member-row');
    if (rows.length > 1) {
        btn.closest('.member-row').remove();
        updateRowBadges();
    } else if (window.showToast) {
        showToast('At least one member row is required.', 'error');
    }
}

function previewBatchAvatar(input) {
    const preview = input.closest('.form-group').querySelector('.file-upload__preview');
    const text = input.closest('.file-upload').querySelector('.file-upload__text');
    if (input.files && input.files[0]) {
        const url = URL.createObjectURL(input.files[0]);
        preview.innerHTML = `<img src="${url}" alt="Preview">`;
        text.textContent = input.files[0].name;
    } else {
        preview.innerHTML = '';
        text.textContent = 'Choose image';
    }
}

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
    refreshTeamIcons();
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

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeEditModal();
});

// Collapsible add form
const addFormToggle = document.getElementById('addFormToggle');
const addFormCard = document.getElementById('addFormCard');
addFormToggle?.addEventListener('click', () => {
    const open = addFormCard.classList.toggle('is-open');
    addFormToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
});

// Sortable reorder
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
                if (data.success && window.showToast) showToast('Order saved', 'success');
            })
            .catch(() => {
                if (window.showToast) showToast('Failed to save order', 'error');
                setTimeout(() => location.reload(), 1500);
            });
        }
    });
}

refreshTeamIcons();
</script>
@endpush
