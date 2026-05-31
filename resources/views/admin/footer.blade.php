@extends('admin.layout')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1>Footer</h1>
        <p class="page-subtitle">Manage your website footer</p>
    </div>

    {{-- Footer Description --}}
    <div class="glass-card" data-aos="fade-up">
        <h2 class="section-title">Footer Description</h2>
        <form method="POST" action="{{ route('admin.footer.update') }}" class="glass-form">
            @csrf
            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label class="form-label" for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required>{{ $footer->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="200">Update Footer</button>
        </form>
    </div>

    {{-- Footer Links --}}
    <div class="glass-card" data-aos="fade-up" data-aos-delay="100">
        <h2 class="section-title">Footer Links</h2>

        {{-- Add Link Form --}}
        <form method="POST" action="{{ route('admin.footer.link.add') }}" class="glass-form" data-aos="fade-up" data-aos-delay="100">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="link_name">Link Name</label>
                    <input type="text" id="link_name" name="link_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="link_url">Link URL</label>
                    <input type="text" id="link_url" name="link_url" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" data-aos="fade-up" data-aos-delay="200">Add Link</button>
        </form>

        {{-- Links Table --}}
        <table class="admin-table" data-aos="fade-up" data-aos-delay="300">
            <thead>
                <tr>
                    <th class="table-th">ID</th>
                    <th class="table-th">Name</th>
                    <th class="table-th">URL</th>
                    <th class="table-th">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($footerLinks) && count($footerLinks) > 0)
                    @foreach($footerLinks as $link)
                    <tr>
                        <td class="table-td">{{ $link->id }}</td>
                        <td class="table-td">{{ $link->name }}</td>
                        <td class="table-td">{{ $link->url }}</td>
                        <td class="table-td">
                            <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}" onsubmit="return confirm('Are you sure you want to delete this link?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="table-td text-center" colspan="4">No links found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
<style>
.text-center { text-align: center; }
</style>
@endpush
