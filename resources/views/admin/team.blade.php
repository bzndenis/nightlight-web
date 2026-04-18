@extends('admin.layout')

@section('content')
    <div class="admin-header">
        <h1>Team Management</h1>
    </div>

    <div class="card">
        <h2>Add Team Member</h2>
        <form method="POST" action="{{ route('admin.team.store') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" required>
            </div>

            <div class="form-group">
                <label for="quote">Quote</label>
                <textarea id="quote" name="quote" required></textarea>
            </div>

            <button type="submit">Add Team Member</button>
        </form>
    </div>

    <div class="card">
        <h2>Team Members</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Quote</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($teamMembers) && count($teamMembers) > 0)
                    @foreach($teamMembers as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>{{ Str::limit($member->quote, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.team.edit', $member->id) }}" style="margin-right: 0.5rem;">Edit</a>
                            <form method="POST" action="{{ route('admin.team.delete', $member->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center;">No team members found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
