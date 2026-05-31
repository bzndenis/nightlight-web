@section('page-title', 'Announcement')
@extends('admin.layout')

@section('content')
    <div class="glass-card">
        <form method="POST" action="{{ route('admin.announcement.update') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="title">Title</label>
                    <input class="form-input" type="text" id="title" name="title" value="{{ $announcement->title ?? 'ANNOUNCEMENTS' }}" required>
                </div>
                <div class="form-group form-group--toggle">
                    <label class="toggle-label">
                        <input type="checkbox" name="is_active" value="1" {{ ($announcement->is_active ?? true) ? 'checked' : '' }}>
                        <span>Active</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="content">Content</label>
                <textarea class="form-textarea" id="content" name="content" required>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</textarea>
            </div>
            <button type="submit" class="btn-primary">Update Announcement</button>
        </form>
    </div>
@endsection

@push('styles')
<style>
.form-row {
    display: flex;
    gap: 1rem;
    align-items: flex-end;
}
.toggle-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    padding-bottom: 0.5rem;
}
</style>
@endpush