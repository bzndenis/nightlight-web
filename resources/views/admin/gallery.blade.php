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
        <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data" id="dropZone">
            @csrf
            <div class="form-group" data-aos="fade-up" data-aos-delay="100" style="text-align: center;">
                <div id="dropZoneArea" style="border: 3px dashed #8815d8; border-radius: 16px; padding: 3rem; background: rgba(136, 21, 216, 0.05); cursor: pointer; transition: all 0.3s ease;">
                    <div id="dropZoneContent">
                        <div style="font-size: 4rem; margin-bottom: 1rem;">📁</div>
                        <p style="font-size: 1.6rem; color: #46305e; margin-bottom: 1rem;">Drag & Drop images here</p>
                        <p style="font-size: 1.4rem; color: #999;">or click to browse (multiple files supported)</p>
                    </div>
                    <input type="file" id="image" name="images[]" accept="image/*" multiple required style="display: none;">
                </div>
            </div>
            <button type="submit" data-aos="fade-up" data-aos-delay="200" style="width: 100%;">Upload Images</button>
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
                        <td><img src="{{ asset($image->path) }}" alt="Gallery Image" style="max-width: 150px; border-radius: 8px;"></td>
                        <td>
                            <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this image?');">
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

    <script>
        // Drag and drop functionality
        const dropZoneArea = document.getElementById('dropZoneArea');
        const dropZoneContent = document.getElementById('dropZoneContent');
        const fileInput = document.getElementById('image');
        const dropZone = document.getElementById('dropZone');

        // Click to browse
        dropZoneArea.addEventListener('click', function() {
            fileInput.click();
        });

        // File input change
        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const fileCount = e.target.files.length;
                const fileText = fileCount === 1 ? e.target.files[0].name : `${fileCount} images selected`;
                dropZoneContent.innerHTML = `
                    <div style="font-size: 4rem; margin-bottom: 1rem;">✅</div>
                    <p style="font-size: 1.6rem; color: #46305e;">${fileText}</p>
                    <p style="font-size: 1.4rem; color: #999;">Click to change</p>
                `;
            }
        });

        // Drag over
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.style.background = 'rgba(136, 21, 216, 0.1)';
            dropZoneArea.style.borderColor = '#a855f7';
        });

        // Drag leave
        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.style.background = 'rgba(136, 21, 216, 0.05)';
            dropZoneArea.style.borderColor = '#8815d8';
        });

        // Drop
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.style.background = 'rgba(136, 21, 216, 0.05)';
            dropZoneArea.style.borderColor = '#8815d8';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                const fileCount = files.length;
                const fileText = fileCount === 1 ? files[0].name : `${fileCount} images selected`;
                dropZoneContent.innerHTML = `
                    <div style="font-size: 4rem; margin-bottom: 1rem;">✅</div>
                    <p style="font-size: 1.6rem; color: #46305e;">${fileText}</p>
                    <p style="font-size: 1.4rem; color: #999;">Click to change</p>
                `;
            }
        });
    </script>
@endsection
