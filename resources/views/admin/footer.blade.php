@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Footer Management</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Footer Description</h2>
        <form method="POST" action="{{ route('admin.footer.update') }}">
            @csrf

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ $footer->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.' }}</textarea>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="200">Update Footer</button>
        </form>
    </div>

    <div class="card" data-aos="fade-up" data-aos-delay="100">
        <h2>Footer Links</h2>
        <form method="POST" action="{{ route('admin.footer.link.add') }}">
            @csrf

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="link_name">Link Name</label>
                <input type="text" id="link_name" name="link_name" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                <label for="link_url">Link URL</label>
                <input type="text" id="link_url" name="link_url" required>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="300">Add Link</button>
        </form>

        <table data-aos="fade-up" data-aos-delay="400">
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
                        <td>
                            <form method="POST" action="{{ route('admin.footer.link.delete', $link->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">No links found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
