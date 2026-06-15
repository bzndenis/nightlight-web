@extends('admin.layout')
@section('page-title', 'Team')

@section('content')
    {{-- Batch Add Form --}}
    <div class="glass-card">
        <h2 class="section-title">Add Team Members</h2>
        <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" id="batch-form" class="glass-form">
            @csrf
            <div id="member-fields-container">
                <div class="member-row batch-grid">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name[]" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <input type="text" name="role[]" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Quote</label>
                        <textarea name="quote[]" class="form-textarea" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Avatar</label>
                        <input type="file" name="avatar[]" class="form-input" accept="image/*">
                    </div>
                    <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">&#10005;</button>
                </div>
            </div>
            <div class="batch-actions">
                <button type="button" class="btn-add-row" onclick="addBatchRow()">+ Add Another</button>
                <button type="submit" class="btn-primary">Add Team Members</button>
            </div>
        </form>
    </div>

    {{-- Team Members Table with Sorting --}}
    <div class="glass-card">
        <h2 class="section-title">Team Members <span class="badge">drag rows to reorder</span></h2>
        <div class="glass-table">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="drag-col"></th>
                        <th><a href="{{ route('admin.team', ['sort' => 'id', 'dir' => $sortBy === 'id' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">ID {!! $sortBy === 'id' ? ($sortDir === 'asc' ? '&#8593;' : '&#8595;') : '' !!}</a></th>
                        <th>Avatar</th>
                        <th><a href="{{ route('admin.team', ['sort' => 'name', 'dir' => $sortBy === 'name' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Name {!! $sortBy === 'name' ? ($sortDir === 'asc' ? '&#8593;' : '&#8595;') : '' !!}</a></th>
                        <th><a href="{{ route('admin.team', ['sort' => 'role', 'dir' => $sortBy === 'role' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Role {!! $sortBy === 'role' ? ($sortDir === 'asc' ? '&#8593;' : '&#8595;') : '' !!}</a></th>
                        <th>Quote</th>
                        <th><a href="{{ route('admin.team', ['sort' => 'order', 'dir' => $sortBy === 'order' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Order {!! $sortBy === 'order' ? ($sortDir === 'asc' ? '&#8593;' : '&#8595;') : '' !!}</a></th>
                        <th><a href="{{ route('admin.team', ['sort' => 'is_active', 'dir' => $sortBy === 'is_active' && $sortDir === 'asc' ? 'desc' : 'asc']) }}">Active {!! $sortBy === 'is_active' ? ($sortDir === 'asc' ? '&#8593;' : '&#8595;') : '' !!}</a></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="team-table-body">
                    @if(isset($teamMembers) && count($teamMembers) > 0)
                        @foreach($teamMembers as $member)
                        <tr data-id="{{ $member->id }}" class="draggable-row">
                            <td><span class="drag-handle" title="Drag to reorder">&#9776;</span></td>
                            <td>{{ $member->id }}</td>
                            <td>
                                @if($member->avatar)
                                    <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}" class="avatar-sm">
                                @else
                                    <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Default" class="avatar-sm">
                                @endif
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->role }}</td>
                            <td>{{ Str::limit($member->quote, 50) }}</td>
                            <td class="order-cell">{{ $member->order }}</td>
                            <td>{!! $member->is_active ? '<span class="status-active">&#10003;</span>' : '<span class="status-inactive">&#10005;</span>' !!}</td>
                            <td class="table-actions">
                                <button type="button" class="btn-edit-inline" onclick='openEditModal({{ json_encode($member) }})'>Edit</button>
                                <form method="POST" action="{{ route('admin.team.delete', $member->id) }}" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this team member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No team members found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Inline Edit Modal --}}
    <div id="edit-modal" class="modal-overlay" style="display:none;">
        <div class="modal-panel">
            <div class="modal-header">
                <h2>Edit Team Member</h2>
                <button type="button" class="modal-close" onclick="closeEditModal()">×</button>
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
                <div class="modal-actions">
                    <button type="submit" class="btn-primary">Update</button>
                    <button type="button" class="btn-secondary" onclick="closeEditModal()">Cancel</button>
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
    const html = `<div class="member-row batch-grid">
        <div class="form-group"><label class="form-label">Name</label><input type="text" name="name[]" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Role</label><input type="text" name="role[]" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Quote</label><textarea name="quote[]" class="form-textarea" required></textarea></div>
        <div class="form-group"><label class="form-label">Avatar</label><input type="file" name="avatar[]" class="form-input" accept="image/*"></div>
        <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">&#10005;</button>
    </div>`;
    container.insertAdjacentHTML('beforeend', html);
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
    document.getElementById('edit-modal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('edit-modal').style.display = 'none';
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
            const orders = [];
            rows.forEach((row, index) => {
                ids.push(row.dataset.id);
                orders.push(index + 1);
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