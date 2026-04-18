@extends('admin.layout')

@section('content')
    <div class="admin-header" data-aos="fade-down">
        <h1>Gallery Management</h1>
    </div>

    <div class="card" data-aos="fade-up">
        <h2>Gallery Description</h2>
        <form method="POST" action="{{ route('admin.gallery.update') }}">
            @csrf

            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ $gallery->title ?? 'GALLERY' }}" required>
            </div>

            <div class="form-group" data-aos="fade-up" data-aos-delay="200">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}</textarea>
            </div>

            <button type="submit" data-aos="fade-up" data-aos-delay="300">Update Gallery Info</button>
        </form>
    </div>

    <div class="card" data-aos="fade-up" data-aos-delay="100">
        <h2>Gallery Images</h2>
        <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" data-aos="fade-up" data-aos-delay="100">
                <label for="image">Add New Image</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" data-aos="fade-up" data-aos-delay="200">Add Image</button>
        </form>

        <table data-aos="fade-up" data-aos-delay="300">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($images) && count($images) > 0)
                    @foreach($images as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td><img src="{{ asset('images/gallery/' . $image->filename) }}" alt="Gallery Image" style="max-width: 100px;"></td>
                        <td>
                            <form method="POST" action="{{ route('admin.gallery.image.delete', $image->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align: center;">No images found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
