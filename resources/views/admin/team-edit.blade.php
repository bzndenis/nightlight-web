@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Edit Team Member</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Edit Team Member</h2>
        <form method="POST" action="{{ route('admin.team.update', $member->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $member->name }}" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" value="{{ $member->role }}" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="300">
                <label for="quote">Quote</label>
                <textarea id="quote" name="quote" required>{{ $member->quote }}</textarea>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="350">
                <label for="avatar">Avatar Photo</label>
                @if($member->avatar)
                    <div style="margin-bottom: 10px;">
                        <p>Current Avatar:</p>
                        <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                    </div>
                @endif
                <input type="file" id="avatar" name="avatar" accept="image/*">
                <small>Leave empty to keep current avatar</small>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="400">
                <label>
                    <input type="checkbox" name="is_active" {{ $member->is_active ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="500">Update Team Member</button>
            <a href="{{ route('admin.team') }}" style="margin-left: 10px;">Cancel</a>
        </form>
    </div>
@endsection
