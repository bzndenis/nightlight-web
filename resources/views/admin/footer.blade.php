@section('page-title', 'Footer')
@extends('admin.layout')

@section('content')
    {{-- Footer Description --}}
    <div class="glass-card">
        <h2 class="section-title">Footer Description</h2>
        <form method="POST" action="{{ route('admin.footer.update') }}" class="glass-form">
            @csrf
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="description" class="form-textarea" required>{{ $footer->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.' }}</textarea>
            </div>
            <button type="submit" class="btn-primary">Update Footer</button>
        </form>
    </div>

    {{-- Footer Links --}}
    <div class="glass-card">
        <h2 class="section-title">Footer Links</h2>

        {{-- Add Link Form --}}
        <form method="POST" action="{{ route('admin.footer.link.add') }}" class="glass-form">
            @csrf
            <div class="form-group">
                <label class="form-label" for="link_name">Link Name</label>
                <input type="text" id="link_name" name="link_name" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="link_url">Link URL</label>
                <input type="text" id="link_url" name="link_url" class="form-input" required>
            </div>
            <button type="submit" class="btn-primary">Add Link</button>
        </form>

        {{-- Links Table --}}
        <div class="glass-table">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($footerLinks) && count($footerLinks) > 0)
                        @foreach($footerLinks as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>{{ $link->name }}</td>
                            <td>{{ $link->url }}</td>
                            <td class="table-actions">
                                <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}" onsubmit="return confirm('Are you sure you want to delete this link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No links found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@endpush