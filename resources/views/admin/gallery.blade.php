@extends('admin.layout')
@section('page-title', 'Media Gallery')
@section('page-subtitle', 'Upload and organize guild screenshots, raid highlights, and artwork')

@section('content')
    <div class="page-header" data-aos="fade-up">
        <div class="page-header__left">
            <h1 class="page-header__title">Guild Media Gallery</h1>
            <p class="page-header__desc">
                Showcase epic adventures, boss kills, and guild gatherings in a rich responsive media gallery.
            </p>
        </div>
        <div class="page-header__actions">
            <a href="{{ url('/') }}#gallery" target="_blank" rel="noopener" class="btn btn-secondary">
                <i data-lucide="external-link"></i>
                <span>View on Website</span>
            </a>
            <button type="button" class="btn btn-primary" onclick="document.getElementById('imageFileInput').click()">
                <i data-lucide="upload-cloud"></i>
                <span>Upload Media</span>
            </button>
        </div>
    </div>

    {{-- Gallery Section Info & Status Settings --}}
    <div class="glass-card" data-aos="fade-up">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="sliders"></i>
                <span>Gallery Section Settings</span>
            </div>
            <span class="badge {{ ($gallery->is_active ?? true) ? 'badge--emerald' : 'badge--purple' }}">
                {{ ($gallery->is_active ?? true) ? 'Visible on Website' : 'Section Hidden' }}
            </span>
        </div>

        <form method="POST" action="{{ route('admin.gallery.update') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="gallery_title">Section Title</label>
                    <input class="form-input" type="text" id="gallery_title" name="title" 
                           value="{{ $gallery->title ?? 'GALLERY' }}" required>
                </div>

                <div class="form-group" style="display:flex; flex-direction:column; justify-content:center;">
                    <label class="form-label">Visibility on Public Site</label>
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" id="galleryIsActive"
                            {{ ($gallery->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-track">
                            <span class="toggle-thumb"></span>
                        </span>
                        <span class="toggle-text" id="galleryToggleText">
                            {{ ($gallery->is_active ?? true) ? 'Active & Displayed' : 'Hidden from public' }}
                        </span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="gallery_description">Section Description</label>
                <textarea class="form-textarea" id="gallery_description" name="description" rows="2" required>{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings.' }}</textarea>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="save"></i>
                    <span>Update Section Info</span>
                </button>
            </div>
        </form>
    </div>

    {{-- Modern Drag and Drop Upload Card --}}
    <div class="glass-card" data-aos="fade-up" data-aos-delay="40">
        <div class="card-header">
            <div class="card-title">
                <i data-lucide="upload-cloud"></i>
                <span>Upload New Media</span>
            </div>
            <span class="badge badge--cyan">Supports multi-file upload</span>
        </div>

        <form method="POST" action="{{ route('admin.gallery.image.add') }}" enctype="multipart/form-data" id="galleryUploadForm">
            @csrf

            <div class="drop-zone" id="dropZoneArea">
                <div class="drop-zone__icon-wrap">
                    <i data-lucide="image-plus"></i>
                </div>
                <h3 class="drop-zone__title">Drag & drop image files here</h3>
                <p class="drop-zone__subtitle">
                    or click to browse your computer. Supports <strong>JPG, PNG, GIF, WebP</strong> up to 5MB each.
                </p>
                <input type="file" id="imageFileInput" name="images[]" accept="image/jpeg,image/png,image/gif,image/webp" multiple style="display: none;">
            </div>

            {{-- Selected Files Preview Tray --}}
            <div id="stagedFilesContainer" style="display: none; margin-top: 20px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 12px;">
                    <div style="font-weight:700; font-size:0.9rem; color:var(--text-primary);">
                        <span id="stagedCount">0</span> image(s) ready to upload:
                    </div>
                    <button type="button" class="btn btn-ghost btn-sm" id="clearStagedBtn">
                        <i data-lucide="trash-2"></i> Clear Selection
                    </button>
                </div>
                <div class="staged-files" id="stagedFilesGrid"></div>

                <div style="margin-top: 18px; display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary" id="startUploadBtn">
                        <i data-lucide="upload"></i>
                        <span>Upload Selected Files</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Gallery Media Library --}}
    <div class="glass-card" data-aos="fade-up" data-aos-delay="80">
        <div class="toolbar">
            <div class="toolbar__search">
                <i data-lucide="search" style="color:var(--text-muted); width:16px; height:16px;"></i>
                <input type="text" id="gallerySearchInput" placeholder="Filter images by filename...">
            </div>

            <div style="display:flex; align-items:center; gap:14px;">
                <span class="badge badge--purple" id="galleryCountBadge">
                    {{ count($images ?? []) }} {{ Str::plural('Image', count($images ?? [])) }}
                </span>

                <div class="view-toggle">
                    <button type="button" class="view-toggle-btn is-active" id="viewGridBtn" title="Grid View">
                        <i data-lucide="grid"></i>
                    </button>
                    <button type="button" class="view-toggle-btn" id="viewTableBtn" title="Table View">
                        <i data-lucide="list"></i>
                    </button>
                </div>
            </div>
        </div>

        @if(isset($images) && count($images) > 0)
            {{-- Visual Grid View --}}
            <div class="gallery-grid" id="galleryGridView">
                @foreach($images as $image)
                    <div class="gallery-card" data-filename="{{ strtolower($image->filename) }}">
                        <div class="gallery-img-wrap">
                            <img src="{{ asset($image->path) }}" alt="{{ $image->filename }}" class="gallery-img" loading="lazy">
                            <div class="gallery-overlay">
                                <button type="button" class="gallery-overlay-btn" title="View Fullsize" onclick="openLightbox('{{ asset($image->path) }}', '{{ addslashes($image->filename) }}')">
                                    <i data-lucide="maximize-2"></i>
                                </button>
                                <button type="button" class="gallery-overlay-btn" title="Copy Image URL" onclick="copyImageUrl('{{ asset($image->path) }}')">
                                    <i data-lucide="copy"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.gallery.image.delete', $image->filename) }}" class="inline-form" id="delForm-{{ md5($image->filename) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="gallery-overlay-btn gallery-overlay-btn--danger" title="Delete Image"
                                            onclick="confirmImageDelete('{{ md5($image->filename) }}', '{{ addslashes($image->filename) }}')">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="gallery-meta">
                            <div class="gallery-filename" title="{{ $image->filename }}">{{ $image->filename }}</div>
                            <div class="gallery-details">
                                <span>{{ $image->size ?? 'File' }}</span>
                                <span>{{ $image->date ?? 'Uploaded' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Compact Table View (Initially Hidden) --}}
            <div class="glass-table-wrap" id="galleryTableView" style="display: none; margin-top: 14px;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Thumbnail</th>
                            <th>Filename</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($images as $image)
                            <tr data-filename="{{ strtolower($image->filename) }}">
                                <td>
                                    <img src="{{ asset($image->path) }}" alt="Thumb" 
                                         style="width:52px; height:52px; object-fit:cover; border-radius:var(--radius-xs); border:1px solid var(--border); cursor:pointer;"
                                         onclick="openLightbox('{{ asset($image->path) }}', '{{ addslashes($image->filename) }}')">
                                </td>
                                <td>
                                    <div style="font-family:var(--font-mono); font-size:0.85rem; font-weight:600; color:var(--text-primary);">
                                        {{ $image->filename }}
                                    </div>
                                </td>
                                <td><span class="badge">{{ $image->size ?? 'N/A' }}</span></td>
                                <td><span style="font-size:0.82rem; color:var(--text-muted);">{{ $image->date ?? 'Recent' }}</span></td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-icon" title="View Fullsize" onclick="openLightbox('{{ asset($image->path) }}', '{{ addslashes($image->filename) }}')">
                                            <i data-lucide="eye"></i>
                                        </button>
                                        <button type="button" class="btn-icon" title="Copy URL" onclick="copyImageUrl('{{ asset($image->path) }}')">
                                            <i data-lucide="copy"></i>
                                        </button>
                                        <button type="button" class="btn-icon btn-icon--delete" title="Delete"
                                                onclick="confirmImageDelete('{{ md5($image->filename) }}', '{{ addslashes($image->filename) }}')">
                                            <i data-lucide="trash-2"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="noMatchMessage" style="display: none; text-align:center; padding: 48px 20px;">
                <i data-lucide="search-x" style="width:40px; height:40px; color:var(--text-dim); margin-bottom:12px;"></i>
                <h4 style="color:var(--text-primary); margin-bottom:6px;">No matching images</h4>
                <p style="font-size:0.85rem; color:var(--text-muted);">Try a different search query or clear the filter.</p>
            </div>
        @else
            <div style="text-align: center; padding: 56px 20px;">
                <div style="width:68px; height:68px; border-radius:var(--radius-lg); background:rgba(6,182,212,0.1); border:1px solid rgba(6,182,212,0.25); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; color:var(--accent-cyan);">
                    <i data-lucide="image" style="width:32px; height:32px;"></i>
                </div>
                <h3 style="font-size:1.15rem; font-weight:700; color:var(--text-primary); margin-bottom:6px;">No Gallery Images Yet</h3>
                <p style="font-size:0.88rem; color:var(--text-muted); max-width:400px; margin:0 auto 20px;">
                    Upload high-resolution screenshots from your guild raids, tournaments, or discord community.
                </p>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('imageFileInput').click()">
                    <i data-lucide="upload-cloud"></i>
                    <span>Upload First Image</span>
                </button>
            </div>
        @endif
    </div>

    {{-- Lightbox Fullscreen Image Modal --}}
    <div id="galleryLightbox" class="lightbox-modal" role="dialog" aria-modal="true">
        <button type="button" class="lightbox-close" onclick="closeLightbox()" aria-label="Close Lightbox">
            <i data-lucide="x"></i>
        </button>
        <div class="lightbox-img-wrap">
            <img src="" alt="Enlarged gallery view" id="lightboxTargetImg">
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function() {
    // Dropzone & File Staging
    const dropZoneArea = document.getElementById('dropZoneArea');
    const fileInput = document.getElementById('imageFileInput');
    const stagedContainer = document.getElementById('stagedFilesContainer');
    const stagedGrid = document.getElementById('stagedFilesGrid');
    const stagedCount = document.getElementById('stagedCount');
    const clearStagedBtn = document.getElementById('clearStagedBtn');
    let stagedDataTransfer = new DataTransfer();

    dropZoneArea.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZoneArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.classList.add('drag-over');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZoneArea.addEventListener(eventName, (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZoneArea.classList.remove('drag-over');
        });
    });

    dropZoneArea.addEventListener('drop', (e) => {
        if (e.dataTransfer && e.dataTransfer.files) {
            handleFiles(e.dataTransfer.files);
        }
    });

    function handleFiles(files) {
        for (let i = 0; i < files.length; i++) {
            stagedDataTransfer.items.add(files[i]);
        }
        fileInput.files = stagedDataTransfer.files;
        renderStagedFiles();
    }

    function renderStagedFiles() {
        const files = stagedDataTransfer.files;
        stagedGrid.innerHTML = '';
        if (files.length === 0) {
            stagedContainer.style.display = 'none';
            return;
        }

        stagedCount.textContent = files.length;
        stagedContainer.style.display = 'block';

        Array.from(files).forEach((file, index) => {
            const card = document.createElement('div');
            card.className = 'staged-file-card';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            card.appendChild(img);

            const name = document.createElement('span');
            name.className = 'staged-file-card__name';
            name.textContent = file.name;
            card.appendChild(name);

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-remove-row';
            removeBtn.style.position = 'absolute';
            removeBtn.style.top = '4px';
            removeBtn.style.right = '4px';
            removeBtn.innerHTML = '<i data-lucide="x" style="width:14px;height:14px;"></i>';
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                removeStagedFile(index);
            });
            card.appendChild(removeBtn);

            stagedGrid.appendChild(card);
        });

        if (window.lucide) lucide.createIcons();
    }

    function removeStagedFile(indexToRemove) {
        const newDt = new DataTransfer();
        const files = stagedDataTransfer.files;
        for (let i = 0; i < files.length; i++) {
            if (i !== indexToRemove) {
                newDt.items.add(files[i]);
            }
        }
        stagedDataTransfer = newDt;
        fileInput.files = stagedDataTransfer.files;
        renderStagedFiles();
    }

    clearStagedBtn?.addEventListener('click', () => {
        stagedDataTransfer = new DataTransfer();
        fileInput.files = stagedDataTransfer.files;
        renderStagedFiles();
    });

    // Search and Filter Gallery
    const searchInput = document.getElementById('gallerySearchInput');
    const gridCards = document.querySelectorAll('#galleryGridView .gallery-card');
    const tableRows = document.querySelectorAll('#galleryTableView tbody tr');
    const noMatchMessage = document.getElementById('noMatchMessage');
    const countBadge = document.getElementById('galleryCountBadge');

    searchInput?.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase().trim();
        let matches = 0;

        gridCards.forEach(card => {
            const fname = card.dataset.filename || '';
            const isMatch = fname.includes(query);
            card.style.display = isMatch ? 'flex' : 'none';
            if (isMatch) matches++;
        });

        tableRows.forEach(row => {
            const fname = row.dataset.filename || '';
            const isMatch = fname.includes(query);
            row.style.display = isMatch ? '' : 'none';
        });

        if (noMatchMessage) {
            noMatchMessage.style.display = matches === 0 && query !== '' ? 'block' : 'none';
        }
        if (countBadge) {
            countBadge.textContent = matches + ' ' + (matches === 1 ? 'Image' : 'Images');
        }
    });

    // View Switcher (Grid vs Table)
    const viewGridBtn = document.getElementById('viewGridBtn');
    const viewTableBtn = document.getElementById('viewTableBtn');
    const gridView = document.getElementById('galleryGridView');
    const tableView = document.getElementById('galleryTableView');

    viewGridBtn?.addEventListener('click', () => {
        viewGridBtn.classList.add('is-active');
        viewTableBtn.classList.remove('is-active');
        if (gridView) gridView.style.display = 'grid';
        if (tableView) tableView.style.display = 'none';
    });

    viewTableBtn?.addEventListener('click', () => {
        viewTableBtn.classList.add('is-active');
        viewGridBtn.classList.remove('is-active');
        if (gridView) gridView.style.display = 'none';
        if (tableView) tableView.style.display = 'block';
    });

    // Lightbox Controls
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImg = document.getElementById('lightboxTargetImg');

    window.openLightbox = function(url, title) {
        if (!lightbox || !lightboxImg) return;
        lightboxImg.src = url;
        lightboxImg.alt = title;
        lightbox.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    };

    window.closeLightbox = function() {
        if (!lightbox) return;
        lightbox.classList.remove('is-active');
        document.body.style.overflow = '';
        if (lightboxImg) lightboxImg.src = '';
    };

    lightbox?.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox?.classList.contains('is-active')) {
            closeLightbox();
        }
    });

    // Copy URL to Clipboard
    window.copyImageUrl = function(url) {
        navigator.clipboard.writeText(url).then(() => {
            if (window.showToast) showToast('Image URL copied to clipboard!', 'info');
        }).catch(() => {
            if (window.showToast) showToast('Failed to copy URL', 'error');
        });
    };

    // Confirm Delete
    window.confirmImageDelete = function(formId, filename) {
        if (window.confirmAction) {
            window.confirmAction({
                title: 'Delete Image',
                message: `Are you sure you want to delete "${filename}"? This file will be permanently removed from disk.`,
                btnText: 'Delete Permanently',
                onConfirm: function() {
                    const form = document.getElementById('delForm-' + formId);
                    if (form) form.submit();
                }
            });
        } else {
            if (confirm(`Delete "${filename}"?`)) {
                const form = document.getElementById('delForm-' + formId);
                if (form) form.submit();
            }
        }
    };

    // Toggle Text Update
    const galleryToggle = document.getElementById('galleryIsActive');
    const galleryToggleText = document.getElementById('galleryToggleText');
    galleryToggle?.addEventListener('change', () => {
        galleryToggleText.textContent = galleryToggle.checked ? 'Active & Displayed' : 'Hidden from public';
    });

    if (window.lucide) lucide.createIcons();
})();
</script>
@endpush