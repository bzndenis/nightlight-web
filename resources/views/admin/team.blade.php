@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Team Management</h1>
    </div>

    {{-- Batch Add Form --}}
    <div class="card" data-aos="fade-up">
        <h2>Add Team Members</h2>
        <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" id="batch-form">
            @csrf
            <div id="member-fields-container">
                <div class="member-row batch-row" data-index="0">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name[]" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" name="role[]" required>
                    </div>
                    <div class="form-group">
                        <label>Quote</label>
                        <textarea name="quote[]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="avatar[]" accept="image/*">
                    </div>
                    <button type="button" class="btn-remove-row" onclick="removeBatchRow(this)" title="Remove">&#10005;</button>
                </div>
            </div>
            <div class="batch-actions">
                <button type="button" class="btn-add-row" onclick="addBatchRow()">+ Add Another</button>
                <button type="submit" data-aos="fade-up" data-aos-delay="400">Add Team Members</button>
            </div>
        </form>
    </div>

    {{-- Team Members Table with Sorting --}}
    <div class="card" data-aos="fade-up" data-aos-delay="100">
        <h2>Team Members <small style="font-weight:400;color:#64748b;">(drag rows to reorder)</small></h2>
        <table data-aos="fade-up" data-aos-delay="200">
            <thead>
                <tr>
                    <th style="width:40px;"></th>
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
                                <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            @else
                                <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Default" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>{{ Str::limit($member->quote, 50) }}</td>
                        <td class="order-cell">{{ $member->order }}</td>
                        <td>{!! $member->is_active ? '<span style="color:#4ade80;">&#10003;</span>' : '<span style="color:#f87171;">&#10005;</span>' !!}</td>
                        <td>
                            <button type="button" class="btn-edit-inline" onclick='openEditModal({{ json_encode($member) }})'>Edit</button>
                            <form method="POST" action="{{ route('admin.team.delete', $member->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this team member?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center;">No team members found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Inline Edit Modal --}}
    <div id="edit-modal" class="modal-overlay" style="display:none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Team Member</h2>
                <button type="button" class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form method="POST" action="" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div class="form-group">
                    <label for="edit-name">Name</label>
                    <input type="text" id="edit-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="edit-role">Role</label>
                    <input type="text" id="edit-role" name="role" required>
                </div>
                <div class="form-group">
                    <label for="edit-quote">Quote</label>
                    <textarea id="edit-quote" name="quote" required></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-order">Order</label>
                    <input type="number" id="edit-order" name="order" min="0">
                </div>
                <div class="form-group">
                    <label for="edit-avatar">Avatar Photo</label>
                    <div id="edit-current-avatar"></div>
                    <input type="file" id="edit-avatar" name="avatar" accept="image/*">
                    <small>Leave empty to keep current avatar</small>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="edit-is_active" name="is_active">
                        Active
                    </label>
                </div>
                <div class="modal-actions">
                    <button type="submit">Update</button>
                    <button type="button" onclick="closeEditModal()">Cancel</button>
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
    const html = `<div class="member-row batch-row" data-index="${index}">
        <div class="form-group"><label>Name</label><input type="text" name="name[]" required></div>
        <div class="form-group"><label>Role</label><input type="text" name="role[]" required></div>
        <div class="form-group"><label>Quote</label><textarea name="quote[]" required></textarea></div>
        <div class="form-group"><label>Avatar</label><input type="file" name="avatar[]" accept="image/*"></div>
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
        avatarDiv.innerHTML = '<p>Current Avatar:</p><img src="/' + member.avatar + '" style="width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:8px;">';
    } else {
        avatarDiv.innerHTML = '<p>Current Avatar:</p><img src="/images/avatars/user-01.jpg" style="width:80px;height:80px;object-fit:cover;border-radius:50%;margin-bottom:8px;">';
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
                    // visually confirm
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

@push('styles')
<style>
.batch-row { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr auto; gap: 0.75rem; align-items: end; padding: 0.75rem; border: 1px solid #333; border-radius: 8px; margin-bottom: 0.5rem; }
.batch-row .form-group { margin-bottom: 0; }
.batch-row input, .batch-row textarea { width: 100%; }
.btn-remove-row { background: #ef4444; color: #fff; border: none; border-radius: 4px; width: 32px; height: 32px; cursor: pointer; font-size: 1rem; flex-shrink: 0; }
.btn-add-row { background: #1e293b; color: #94a3b8; border: 1px dashed #334155; border-radius: 6px; padding: 0.5rem 1rem; cursor: pointer; font-size: 0.875rem; }
.batch-actions { display: flex; align-items: center; gap: 1rem; margin-top: 0.5rem; }
.batch-actions button[type="submit"] { background: var(--btn-bg, #3b82f6); color: #fff; border: none; border-radius: 6px; padding: 0.5rem 1.5rem; cursor: pointer; }
table th a { color: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
table th a:hover { color: #3b82f6; }
.btn-edit-inline { background: #1e293b; color: #94a3b8; border: 1px solid #334155; border-radius: 4px; padding: 0.25rem 0.75rem; cursor: pointer; font-size: 0.875rem; }
.drag-handle { cursor: grab; color: #475569; font-size: 1.1rem; padding: 4px; display: inline-block; }
.drag-handle:active { cursor: grabbing; }
.draggable-row td { vertical-align: middle; }
.sortable-ghost { opacity: 0.4; background: #1e293b; border-radius: 4px; }
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 1000; }
.modal-content { background: #0f172a; border: 1px solid #1e293b; border-radius: 12px; padding: 2rem; width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto; }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
.modal-header h2 { margin: 0; font-size: 1.25rem; }
.modal-close { background: none; border: none; color: #64748b; font-size: 1.5rem; cursor: pointer; line-height: 1; }
.modal-close:hover { color: #f1f5f9; }
.modal-actions { display: flex; gap: 0.75rem; margin-top: 1.5rem; }
.modal-actions button[type="submit"] { background: #3b82f6; color: #fff; border: none; border-radius: 6px; padding: 0.5rem 1.5rem; cursor: pointer; }
.modal-actions button[type="button"] { background: #1e293b; color: #94a3b8; border: 1px solid #334155; border-radius: 6px; padding: 0.5rem 1.5rem; cursor: pointer; }
</style>
@endpush
