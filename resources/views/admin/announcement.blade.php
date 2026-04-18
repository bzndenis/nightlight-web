@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Announcement Management</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Edit Announcement</h2>
        <form method="POST" action="{{ route('admin.announcement.update') }}">
            @csrf

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                <label for="content">Content</label>
                <textarea id="content" name="content" required>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="300">Update Announcement</button>
        </form>
    </div>
@endsection
