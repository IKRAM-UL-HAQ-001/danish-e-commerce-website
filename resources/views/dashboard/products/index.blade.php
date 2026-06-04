@extends('dashboard.layouts.app')

@section('title', 'Products')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Products Management</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="mdi mdi-plus"></i> Add New Product
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="productsTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    @if($product->image_mobile)
                                        <img src="{{ asset('storage/' . $product->image_mobile) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; border-radius: 5px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                                            <i class="mdi mdi-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if($product->category)
                                        <span class="badge badge-outline-info">{{ $product->category->name }}</span>
                                    @else
                                        <span class="text-muted">No Category</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->brand)
                                        <span class="badge badge-outline-secondary">{{ $product->brand->name }}</span>
                                    @else
                                        <span class="text-muted">No Brand</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->color_name || $product->color_hex)
                                        <div style="display:flex; align-items:center; gap:8px;">
                                            <div style="width:20px; height:20px; border-radius:4px; background: {{ $product->color_hex ?? '#ffffff' }}; border:1px solid #ddd;"></div>
                                            <span>{{ $product->color_name ?? $product->color_hex }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>£{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <label class="badge {{ $product->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-slug="{{ $product->slug }}" 
                                        data-name="{{ $product->name }}"
                                        data-category="{{ $product->category_id }}"
                                        data-brand="{{ $product->brand_id }}"
                                        data-product='@json($product, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_UNESCAPED_SLASHES)'
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}"
                                        data-sku="{{ $product->sku }}"
                                        data-tags="{{ $product->tags }}"
                                        data-color_name="{{ $product->color_name }}"
                                        data-color_hex="{{ $product->color_hex }}"
                                        data-image_mobile="{{ $product->image_mobile ? asset('storage/' . $product->image_mobile) : '' }}"
                                        data-image_laptop="{{ $product->image_laptop ? asset('storage/' . $product->image_laptop) : '' }}"
                                        data-status="{{ $product->status }}"
                                        data-bs-toggle="modal" data-bs-target="#editProductModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('products.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Are you sure?')">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" class="form-select">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5">
                            {{ old('description') }}
                        </textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="tags">Tags (Comma separated)</label>
                        <input type="text" name="tags" class="form-control" placeholder="Cream, Beauty, Skin">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image_mobile">Product Image (Mobile)</label>
                        <input type="file" name="image_mobile" class="form-control">
                    </div>
                    <!-- <div class="col-md-6 mb-3">
                        <label for="image_laptop">Product Image (Laptop)</label>
                        <input type="file" name="image_laptop" class="form-control">
                    </div> -->
                    <div class="col-md-6 mb-3">
                        <label for="color_name">Color Name (optional)</label>
                        <input type="text" name="color_name" class="form-control" placeholder="e.g. Midnight Blue">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="color_hex">Color (pick)</label>
                        <input type="hidden" name="color_hex" id="color_hex" value="">
                        <div id="colorPickerAdd" style="display:inline-block; vertical-align:middle;"></div>
                            <select id="color_mode" class="form-select form-select-sm" style="width:120px; display:inline-block; margin-left:8px; vertical-align:middle;">
                                <option value="">Select format</option>
                                <option value="hex">HEX</option>
                                <option value="rgba">RGBA</option>
                                <option value="hsla">HSLA</option>
                            </select>
                            <input type="text" id="color_hex_input" class="form-control form-control-sm" placeholder="" style="width:160px; display:inline-block; margin-left:8px; vertical-align:middle;">
                            <button type="button" id="openColorAdd" class="btn btn-sm btn-outline-secondary" style="margin-left:8px; vertical-align:middle;">Open Picker</button>
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Product</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form id="editProductForm" action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="slug" id="edit_slug">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_name">Product Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_category_id">Category</label>
                        <select name="category_id" id="edit_category_id" class="form-select" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_brand_id">Brand</label>
                        <select name="brand_id" id="edit_brand_id" class="form-select">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_price">Price</label>
                        <input type="number" step="0.01" name="price" id="edit_price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_sku">SKU</label>
                        <input type="text" name="sku" id="edit_sku" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_stock">Stock</label>
                        <input type="number" name="stock" id="edit_stock" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_description">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_tags">Tags</label>
                        <input type="text" name="tags" id="edit_tags" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image_mobile">Update Image (Mobile) (Leave blank to keep current)</label>
                        <input type="file" name="image_mobile" id="edit_image_mobile" class="form-control">
                        <div id="current_image_mobile_preview" class="mt-2"></div>
                    </div>
                    <!-- <div class="col-md-6 mb-3">
                        <label for="image_laptop">Update Image (Laptop) (Leave blank to keep current)</label>
                        <input type="file" name="image_laptop" id="edit_image_laptop" class="form-control">
                        <div id="current_image_laptop_preview" class="mt-2"></div>
                    </div> -->
                    <div class="col-md-6 mb-3">
                        <label for="edit_color_name">Color Name (optional)</label>
                        <input type="text" name="color_name" id="edit_color_name" class="form-control" placeholder="e.g. Midnight Blue">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_color_hex">Color (pick)</label>
                        <input type="hidden" name="color_hex" id="edit_color_hex" value="">
                        <div id="colorPickerEdit" style="display:inline-block; vertical-align:middle;"></div>
                        <select id="edit_color_mode" class="form-select form-select-sm" style="width:120px; display:inline-block; margin-left:8px; vertical-align:middle;">
                            <option value="">Select format</option>
                            <option value="hex">HEX</option>
                            <option value="rgba">RGBA</option>
                            <option value="hsla">HSLA</option>
                        </select>
                        <input type="text" id="edit_color_hex_input" class="form-control form-control-sm" placeholder="" style="width:160px; display:inline-block; margin-left:8px; vertical-align:middle;">
                        <button type="button" id="openColorEdit" class="btn btn-sm btn-outline-secondary" style="margin-left:8px; vertical-align:middle;">Open Picker</button>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_status">Status</label>
                        <select name="status" id="edit_status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<!-- Pickr color picker (shows hex, rgba, hsla inputs) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<script>
    // -----------------------------
    // CKEditor for Add Description
    // -----------------------------
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });

    // -----------------------------
    // CKEditor for Edit Description
    // -----------------------------
    let editEditor = null;
    let pendingEditDescription = '';

    ClassicEditor
        .create(document.querySelector('#edit_description'))
        .then(editor => {
            editEditor = editor;

            if (pendingEditDescription) {
                editEditor.setData(pendingEditDescription);
                pendingEditDescription = '';
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
$(document).ready(function () {

    // -----------------------------
    // Initialize DataTable
    // -----------------------------
    $('#productsTable').DataTable();

    // -----------------------------
    // Edit Button Click (Delegated)
    // -----------------------------
    $(document).on('click', '.edit-btn', function () {

        // Safe product data extraction
        let productData = $(this).data('product') || {};

        if (typeof productData === 'string') {
            try {
                productData = JSON.parse(productData);
            } catch (e) {
                console.error("Invalid product JSON", e);
                productData = {};
            }
        }

        // -----------------------------
        // Fill form fields
        // -----------------------------
        $('#edit_slug').val(productData.slug || '');
        $('#edit_name').val(productData.name || '');
        $('#edit_category_id').val(productData.category_id || '');
        $('#edit_brand_id').val(productData.brand_id || '');
        $('#edit_price').val(productData.price || '');
        $('#edit_stock').val(productData.stock || '');
        $('#edit_sku').val(productData.sku || '');
        $('#edit_tags').val(productData.tags || '');
        $('#edit_status').val(productData.status ?? '');

        // -----------------------------
        // CKEditor Description
        // -----------------------------
        let desc = productData.description || '';

        if (editEditor) {
            editEditor.setData(desc);
        } else {
            pendingEditDescription = desc;
        }

        // -----------------------------
        // Color Fields
        // -----------------------------
        $('#edit_color_name').val(productData.color_name || '');
        $('#edit_color_hex').val(productData.color_hex || '');
        // set edit color mode and visible input
        if (productData.color_hex) {
            $('#edit_color_mode').val('hex');
            $('#edit_color_hex_input').val(productData.color_hex);
        } else {
            $('#edit_color_mode').val('');
            $('#edit_color_hex_input').val('');
        }

        // -----------------------------
        // Image Preview (Safe URLs)
        // -----------------------------
        let image_mobile = productData.image_mobile
            ? ('{{ asset("storage") }}/' + productData.image_mobile).replace(/\\/g, '/')
            : '';

        // let image_laptop = productData.image_laptop
        //     ? ('{{ asset("storage") }}/' + productData.image_laptop).replace(/\\/g, '/')
        //     : '';

        // Mobile image preview
        if (image_mobile) {
            $('#current_image_mobile_preview').html(
                `<img src="${image_mobile}" style="width:100px;height:100px;object-fit:cover;border-radius:5px;">`
            );
        } else {
            $('#current_image_mobile_preview').html('');
        }

        // Laptop image preview
        // if (image_laptop) {
        //     $('#current_image_laptop_preview').html(
        //         `<img src="${image_laptop}" style="width:100px;height:100px;object-fit:cover;border-radius:5px;">`
        //     );
        // } else {
        //     $('#current_image_laptop_preview').html('');
        // }
    });

});
</script>

<script>
// Create Pickr when modals are shown to avoid rendering issues while hidden
let pickrAdd = null;
let pickrEdit = null;

$('#addProductModal').on('shown.bs.modal', function () {
    // clear default values so user starts empty
    $('#color_mode').val('');
    $('#color_hex_input').val('');
    $('#color_hex').val('');
    if (!pickrAdd) {
        pickrAdd = Pickr.create({
            el: '#colorPickerAdd',
            theme: 'classic',
            default: document.querySelector('#color_hex')?.value || null,
            appendTo: document.querySelector('#addProductModal .modal-body'),
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: { hex: true, rgba: true, hsla: true, input: true, save: true }
            }
        });
        pickrAdd.on('change', (color) => {
            const mode = $('#color_mode').val();
            const input = document.querySelector('#color_hex_input');
            if (mode === 'rgba') {
                const rgba = color.toRGBA();
                const str = `rgba(${Math.round(rgba[0])}, ${Math.round(rgba[1])}, ${Math.round(rgba[2])}, ${+rgba[3].toFixed(2)})`;
                if (input) input.value = str;
            } else if (mode === 'hsla') {
                const hsla = color.toHSLA();
                const str = `hsla(${Math.round(hsla[0])}, ${Math.round(hsla[1]*100)}%, ${Math.round(hsla[2]*100)}%, ${+hsla[3].toFixed(2)})`;
                if (input) input.value = str;
            } else {
                const hex = color.toHEXA().toString();
                if (input) input.value = hex;
            }
            // always update hidden hex value
            const hexHidden = color.toHEXA().toString();
            document.querySelector('#color_hex').value = hexHidden;
        });
        pickrAdd.on('save', (color) => {
            pickrAdd.emit('change', color);
            pickrAdd.hide();
        });
    } else {
        try { pickrAdd.setColor(document.querySelector('#color_hex').value || '#ffffff'); } catch (e) {}
    }
});

$('#editProductModal').on('shown.bs.modal', function () {
    if (!pickrEdit) {
        pickrEdit = Pickr.create({
            el: '#colorPickerEdit',
            theme: 'classic',
            default: document.querySelector('#edit_color_hex')?.value || null,
            appendTo: document.querySelector('#editProductModal .modal-body'),
            components: {
                preview: true,
                opacity: true,
                hue: true,
                interaction: { hex: true, rgba: true, hsla: true, input: true, save: true }
            }
        });
        pickrEdit.on('change', (color) => {
            const mode = $('#edit_color_mode').val();
            const input = document.querySelector('#edit_color_hex_input');
            if (mode === 'rgba') {
                const rgba = color.toRGBA();
                const str = `rgba(${Math.round(rgba[0])}, ${Math.round(rgba[1])}, ${Math.round(rgba[2])}, ${+rgba[3].toFixed(2)})`;
                if (input) input.value = str;
            } else if (mode === 'hsla') {
                const hsla = color.toHSLA();
                const str = `hsla(${Math.round(hsla[0])}, ${Math.round(hsla[1]*100)}%, ${Math.round(hsla[2]*100)}%, ${+hsla[3].toFixed(2)})`;
                if (input) input.value = str;
            } else {
                const hex = color.toHEXA().toString();
                if (input) input.value = hex;
            }
            const hexHidden = color.toHEXA().toString();
            document.querySelector('#edit_color_hex').value = hexHidden;
        });
        pickrEdit.on('save', (color) => {
            pickrEdit.emit('change', color);
            pickrEdit.hide();
        });
    }

    // update pickr color from hidden input when modal opens
    setTimeout(function(){
        const hex = document.querySelector('#edit_color_hex').value || '#ffffff';
        try { pickrEdit.setColor(hex); } catch (e) {}
    }, 50);
});
</script>

<style>
/* Ensure Pickr popup is above modal and clickable */
.pcr-app, .pcr-picker, .pickr, .pcr { z-index: 20000 !important; pointer-events: auto !important; }
/* On small screens avoid translating modal dialog when keyboard opens */
@media (max-width: 767.98px) {
    .modal.show .modal-dialog { transform: none !important; top: 0 !important; }
}
</style>

<script>
// Debug helpers and fallback open buttons
document.addEventListener('DOMContentLoaded', function() {
    $('#openColorAdd').on('click', function(){
        if (pickrAdd) { pickrAdd.show(); console.log('pickrAdd.show() called'); }
    });
    $('#openColorEdit').on('click', function(){
        if (pickrEdit) { pickrEdit.show(); console.log('pickrEdit.show() called'); }
    });

    // Log if pickr instances exist
    console.log('Pickr instances initial state:', { pickrAdd: !!pickrAdd, pickrEdit: !!pickrEdit });
    // Manual input syncing
    // Helper conversions
    function componentToHex(c) {
        const hex = Number(c).toString(16);
        return hex.length == 1 ? '0' + hex : hex;
    }
    function rgbToHex(r,g,b) {
        return '#' + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }
    function hslToRgb(h, s, l){
        s = s; l = l;
        h /= 360;
        let r, g, b;
        if(s === 0){ r = g = b = l; }
        else {
            const hue2rgb = function(p, q, t){
                if(t < 0) t += 1;
                if(t > 1) t -= 1;
                if(t < 1/6) return p + (q - p) * 6 * t;
                if(t < 1/2) return q;
                if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            };
            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }
        return [Math.round(r * 255), Math.round(g * 255), Math.round(b * 255)];
    }

    function parseAndSetHiddenFromInput(val, mode, hiddenSelector){
        if(!val) return;
        if(mode === 'hex'){
            const m = val.trim();
            if(/^#([0-9a-f]{3}|[0-9a-f]{6})$/i.test(m)){
                // normalize to 6-digit
                if(m.length === 4){
                    const r = m[1], g = m[2], b = m[3];
                    const full = '#' + r + r + g + g + b + b;
                    $(hiddenSelector).val(full);
                } else { $(hiddenSelector).val(m); }
            }
        } else if(mode === 'rgba'){
            const m = val.replace(/\s+/g,'');
            const rg = m.match(/^rgba?\((\d{1,3}),(\d{1,3}),(\d{1,3})(?:,(0|1|0?\.\d+))?\)$/i);
            if(rg){ const r=+rg[1], g=+rg[2], b=+rg[3]; $(hiddenSelector).val(rgbToHex(r,g,b)); }
        } else if(mode === 'hsla'){
            const m = val.replace(/\s+/g,'');
            const hs = m.match(/^hsla?\((\d{1,3}),(\d{1,3})%(?:,(\d{1,3})%)?(?:,(0|1|0?\.\d+))?\)$/i);
            if(hs){ const h=+hs[1], s=+hs[2]/100, l=+(hs[3]||50)/100; const rgb = hslToRgb(h,s,l); $(hiddenSelector).val(rgbToHex(rgb[0],rgb[1],rgb[2])); }
        }
    }

    $('#color_hex_input').on('input', function(){
        const val = $(this).val().trim();
        const mode = $('#color_mode').val();
        if (!val) return;
        parseAndSetHiddenFromInput(val, mode, '#color_hex');
        if (pickrAdd) {
            try { pickrAdd.setColor(val); } catch (e) { console.warn('pickrAdd.setColor failed', e); }
        }
    });
    $('#edit_color_hex_input').on('input', function(){
        const val = $(this).val().trim();
        const mode = $('#edit_color_mode').val();
        if (!val) return;
        parseAndSetHiddenFromInput(val, mode, '#edit_color_hex');
        if (pickrEdit) {
            try { pickrEdit.setColor(val); } catch (e) { console.warn('pickrEdit.setColor failed', e); }
        }
    });

    // Mode change handlers
    $('#color_mode').on('change', function(){
        const m = $(this).val();
        const inp = $('#color_hex_input'); inp.val(''); $('#color_hex').val('');
        if(m === 'hex') inp.attr('placeholder','#rrggbb');
        else if(m === 'rgba') inp.attr('placeholder','rgba(255,255,255,1)');
        else if(m === 'hsla') inp.attr('placeholder','hsla(210,50%,50%,1)');
        else inp.attr('placeholder','');
    });
    $('#edit_color_mode').on('change', function(){
        const m = $(this).val();
        const inp = $('#edit_color_hex_input'); inp.val(''); $('#edit_color_hex').val('');
        if(m === 'hex') inp.attr('placeholder','#rrggbb');
        else if(m === 'rgba') inp.attr('placeholder','rgba(255,255,255,1)');
        else if(m === 'hsla') inp.attr('placeholder','hsla(210,50%,50%,1)');
        else inp.attr('placeholder','');
    });
});
</script>
@endpush

@endsection
