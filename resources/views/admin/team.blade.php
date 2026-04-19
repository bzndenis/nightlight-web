@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Team Management</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Add Team Member</h2>
        <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                <label for="quote">Quote</label>
                <textarea id="quote" name="quote" required></textarea>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="350">
                <label for="avatar">Avatar Photo</label>
                <input type="file" id="avatar" name="avatar" accept="image/*">
                <small>Leave empty to use default avatar</small>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="400">Add Team Member</button>
        </form>
    </div>

    <div class="card" data-aos="fade-up" data-aos-delay="100">
        <h2>Team Members</h2>
        <table data-aos="fade-up" data-aos-delay="200">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
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
                        <td>
                            <a href="{{ route('admin.team.edit', $member->id) }}" style="margin-right: 0.5rem;">Edit</a>
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
                        <td colspan="6" style="text-align: center;">No team members found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
