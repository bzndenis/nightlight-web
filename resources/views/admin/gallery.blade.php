@extends('admin.layout')
@section('page-title', 'Gallery')

@section('content')
    <div class="glass-card">
        <form method="POST" action="{{ route('admin.gallery.update') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input class="form-input" type="text" id="title" name="title" value="{{ $gallery->title ?? 'GALLERY' }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-textarea" id="description" name="description" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}</textarea>
            </div>
            <button type="submit" class="btn-primary">Update Gallery Info</button>
        </form>
    </div>

    <div class="glass-card">
        <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data" id="galleryUploadForm">
            @csrf
            <div class="drop-zone" id="dropZoneArea">
                <div id="dropZoneContent">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">&#128193;</div>
                    <p style="font-size: 1.6rem; color: #46305e; margin-bottom: 1rem;">Drag & Drop images here</p>
                    <p style="font-size: 1.4rem; color: #999;">or click to browse (multiple files supported)</p>
                </div>
                <input type="file" id="image" name="images[]" accept="image/*" multiple required style="display: none;">
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem;">Upload Images</button>
        </form>
    </div>

    <div class="glass-card">
        <div class="glass-table">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Filename</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($images) && count($images) > 0)
                        @foreach($images as $image)
                        <tr>
                            <td><img class="gallery-thumb" src="{{ asset($image->path) }}" alt="Gallery Image"></td>
                            <td>{{ $image->filename }}</td>
                            <td class="table-actions">
                                <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" style="text-align: center; color: #999;">No images found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
    (function() {
        const dropZoneArea = document.getElementById('dropZoneArea');
        const dropZoneContent = document.getElementById('dropZoneContent');
        const fileInput = document.getElementById('image');

        dropZoneArea.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') {
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                const fileCount = e.target.files.length;
                const fileText = fileCount === 1 ? e.target.files[0].name : fileCount + ' images selected';
                dropZoneContent.innerHTML = '
                    <div style="font-size: 4rem; margin-bottom: 1rem;">&#10003;</div>
                    <p style="font-size: 1.6rem; color: #46305e;">' + fileText + '</p>
                    <p style="font-size: 1.4rem; color: #999;">Click to change</p>
                ';
            }
        });

        dropZoneArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.classList.add('drag-over');
        });

        dropZoneArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.classList.remove('drag-over');
        });

        dropZoneArea.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const dt = new DataTransfer();
                for (let i = 0; i < files.length; i++) dt.items.add(files[i]);
                fileInput.files = dt.files;
                const fileCount = files.length;
                const fileText = fileCount === 1 ? files[0].name : fileCount + ' images selected';
                dropZoneContent.innerHTML = '
                    <div style="font-size: 4rem; margin-bottom: 1rem;">&#10003;</div>
                    <p style="font-size: 1.6rem; color: #46305e;">' + fileText + '</p>
                    <p style="font-size: 1.4rem; color: #999;">Click to change</p>
                ';
            }
        });

        const table = document.querySelector('.admin-table');
        if (table) {
            table.addEventListener('submit', function(e) {
                if (e.target.matches('form[action*="delete"]')) {
                    if (!confirm('Are you sure you want to delete this image?')) {
                        e.preventDefault();
                    }
                }
            });
        }
    })();
    </script>
    @endpush
@endsection