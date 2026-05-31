@extends('admin.layout')

@section('content')
    <div class="page-header" data-aos="fade-up">
        <h1>Gallery</h1>
        <p class="page-subtitle">Manage your guild gallery</p>
    </div>

    <div class="glass-card" data-aos="fade-up" data-aos-delay="100">
        <h2 class="section-title">Gallery Info</h2>
        <form method="POST" action="{{ route('admin.gallery.update') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ $gallery->title ?? 'GALLERY' }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Gallery Info</button>
        </form>
    </div>

    <div class="glass-card" data-aos="fade-up" data-aos-delay="200">
        <h2 class="section-title">Gallery Images</h2>

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
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Upload Images</button>
        </form>

        <div class="image-grid" style="margin-top: 2rem;">
            @if(isset($images) && count($images) > 0)
                @foreach($images as $image)
                <div class="image-grid-item">
                    <img src="{{ asset($image->path) }}" alt="Gallery Image">
                    <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
                @endforeach
            @else
                <p style="text-align: center; color: #999; grid-column: 1 / -1;">No images found</p>
            @endif
        </div>
    </div>

@push('scripts')
<script>
(function() {
    const dropZoneArea = document.getElementById('dropZoneArea');
    const dropZoneContent = document.getElementById('dropZoneContent');
    const fileInput = document.getElementById('image');
    const galleryUploadForm = document.getElementById('galleryUploadForm');

    dropZoneArea.addEventListener('click', function(e) {
        if (e.target.tagName !== 'INPUT') {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const fileCount = e.target.files.length;
            const fileText = fileCount === 1 ? e.target.files[0].name : fileCount + ' images selected';
            dropZoneContent.innerHTML = `
                <div style="font-size: 4rem; margin-bottom: 1rem;">&#10003;</div>
                <p style="font-size: 1.6rem; color: #46305e;">${fileText}</p>
                <p style="font-size: 1.4rem; color: #999;">Click to change</p>
            `;
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
            dropZoneContent.innerHTML = `
                <div style="font-size: 4rem; margin-bottom: 1rem;">&#10003;</div>
                <p style="font-size: 1.6rem; color: #46305e;">${fileText}</p>
                <p style="font-size: 1.4rem; color: #999;">Click to change</p>
            `;
        }
    });

    // Delegated confirmation for delete forms
    document.querySelector('.image-grid').addEventListener('submit', function(e) {
        if (e.target.matches('form[action*="delete"]')) {
            if (!confirm('Are you sure you want to delete this image?')) {
                e.preventDefault();
            }
        }
    });
})();
</script>
@endpush
@endsection