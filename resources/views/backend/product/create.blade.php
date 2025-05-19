@extends('backend.layouts.master')

@section('main-content')
    <style>
        /* Flexbox to arrange items in columns */
        #photo-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Space between items */
        }
        
        .photo-item {
            flex: 0 0 10%;
            /* Adjust width to fit 4 items in a row */
            text-align: center;
        }

        .photo-item {
            position: relative;
            margin-right: 15px;
            /* Add some spacing between photo items */
        }

        .remove-photo {
            color: #dc3545;
            /* Red color for the cross */
            font-size: 23px;
            /* Adjust size as needed */
            font-weight: bold;
            margin-left: 5%;
            transition: color 0.3s ease;
        }

        .remove-photo:hover {
            color: #b02a37;
            /* Darker red on hover */
        }

        .image-holder {
            width: 100%;
            max-width: 200px;
            /* Adjust as needed */
            height: 150px;
            /* Adjust as needed */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .input-group {
            justify-content: center;
        }

        .image-holder {
            width: 100%;
            height: 150px;
            /* Adjust height as needed */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            /* Optional background color */
        }

        .image-holder img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .d-none {
            display: none !important;
            /* Hide the input field */
        }

        .video-item {
            text-align: left;
            /* Align to the left */
        }

        .input-group {
            justify-content: flex-start;
            /* Align to the left */
        }

        .video-holder {
            width: 100%;
            max-width: 300px;
            /* Adjust width as needed */
            height: 200px;
            /* Adjust height as needed */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            /* Optional background color */
        }

        .video-holder video {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
            /* Make the readonly input field visually distinct */
            opacity: 1;
        }

        .form-text {
            font-size: 0.85rem;
            color: #6c757d;
            /* Muted text color */
        }

        #selected-categories-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Space between tags */
        }

        .category-tag {
            display: inline-flex;
            align-items: center;
            background-color: #e9ecef;
            /* Light gray background */
            color: #333;
            /* Darker text for contrast */
            padding: 6px 12px;
            border-radius: 20px;
            /* Rounded corners */
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .category-tag:hover {
            background-color: #d1d4d7;
            /* Slightly darker on hover */
        }

        .category-tag .remove-category {
            background: none;
            border: none;
            color: #dc3545;
            /* Red color for the 'x' */
            font-weight: bold;
            margin-left: 8px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            transition: color 0.3s ease;
        }

        .category-tag .remove-category:hover {
            color: #b02a37;
            /* Darker red on hover */
        }

        #selected-categories-list:empty::before {
            content: "No categories selected.";
            color: #6c757d;
            /* Gray text for empty state */
            font-style: italic;
        }
    </style>
    <div class="card">
        <h5 class="card-header">Add Product</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                        value="{{ old('title') }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                    @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="is_featured">Is Featured</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                </div>
                {{-- @dd($categories); --}}

                <div class="form-group">
                    <label for="cat_id">Category <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Select any category--</option>
                        @foreach ($categories as $key => $cat_data)
                            <option value="{{ $cat_data->id }}">{{ $cat_data->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-none" id="child_cat_div">
                    <label for="child_cat_id">Sub Category</label>
                    <select name="child_cat_id" id="child_cat_id" class="form-control">
                        <option value="">--Select any category--</option>
                        <!-- Options will be populated dynamically via AJAX -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Price($) <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Enter price"
                        value="{{ old('price') }}" class="form-control">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Discount(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100"
                        placeholder="Enter discount" value="{{ old('discount') }}" class="form-control">
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                <label for="size">Size</label>
                <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
                    <option value="">--Select any size--</option>
                    <option value="S">Small (S)</option>
                    <option value="M">Medium (M)</option>
                    <option value="L">Large (L)</option>
                    <option value="XL">Extra Large (XL)</option>
                    <option value="2XL">Double Extra Large (2XL)</option>
                    <option value="7US">7 US</option>
                    <option value="8US">8 US</option>
                    <option value="9US">9 US</option>
                    <option value="10US">10 US</option>
                    <option value="11US">11 US</option>
                    <option value="12US">12 US</option>
                    <option value="13US">13 US</option>



                </select>
                </div> --}}

                        {{-- <div class="form-group">
                <label for="brand_id">Brand</label>
                {{$brands}}

                <select name="brand_id" class="form-control">
                    <option value="">--Select Brand--</option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                </select>
                </div> --}}

                <div class="form-group">
                    <label for="condition">Condition</label>
                    <select name="condition" class="form-control">
                        <option value="">--Select Condition--</option>
                        <option value="default">Default</option>
                        <option value="new">New</option>
                        <option value="hot">Hot</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Quantity <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity"
                        value="{{ old('stock') }}" class="form-control">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-form-label">Photos <span class="text-danger">*</span></label>
                    <div id="photo-wrapper" class="d-flex flex-wrap">
                        <div class="photo-item">
                            <div class="input-group mb-2">
                                <span class="input-group-btn">
                                    <a data-input="photo0" data-preview="holder0"
                                        class="btn btn-secondary lfm text-white">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="photo0" class="form-control d-none" type="text" name="photos[]"
                                    readonly>
                                <!-- Revert to the × symbol using a span -->
                                <span class="remove-photo ms-2" style="cursor: pointer;">❌</span>
                            </div>
                            <div id="holder0" class="image-holder"></div>
                        </div>
                    </div>
                    <button type="button" id="add-photo" class="btn btn-sm btn-primary mt-2">Add More Photos</button>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Video </label>
                    <div id="video-wrapper">
                        <div class="video-item">
                            <div class="input-group mb-2">
                                <span class="input-group-btn">
                                    <!-- Change the data-input and ensure type=file -->
                                    <a data-input="video0" data-preview="videoHolder0" data-type="file"
                                        class="btn btn-secondary lfm text-white">
                                        <i class="fa fa-video-camera"></i> Choose
                                    </a>
                                </span>
                                <input id="video0" class="form-control" type="text" name="video" readonly>
                            </div>
                            <small class="form-text text-muted">Maximum video size allowed: 100 MB.</small>
                            <div id="videoHolder0" class="video-holder"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 100
            });
        });

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
        // $('select').selectpicker();
    </script>

<script>
$('#cat_id').change(function() {
    var cat_id = $(this).val();
    if (cat_id) {
        // AJAX call to fetch subcategories
        $.ajax({
            url: "/admin/category/" + cat_id + "/child",
            data: {
                _token: "{{ csrf_token() }}",
                id: cat_id
            },
            type: "POST",
            success: function(response) {
                var html_option = "<option value=''>--Select sub category--</option>";
                
                // Parse response if it’s not an object
                if (typeof(response) != 'object') {
                    response = $.parseJSON(response);
                }

                // If subcategories exist, populate the dropdown
                if (response.status && response.data) {
                    $('#child_cat_div').removeClass('d-none'); // Show the subcategory dropdown
                    $.each(response.data, function(id, title) {
                        html_option += "<option value='" + id + "'>" + title + "</option>";
                    });
                } else {
                    $('#child_cat_div').addClass('d-none'); // Hide if no subcategories
                }
                
                $('#child_cat_id').html(html_option); // Update the dropdown options
            },
            error: function(xhr, status, error) {
                console.error('Error fetching subcategories:', error);
                $('#child_cat_div').addClass('d-none'); // Hide on error
                $('#child_cat_id').html("<option value=''>--Select sub category--</option>");
            }
        });
    } else {
        $('#child_cat_div').addClass('d-none'); // Hide if no parent category selected
        $('#child_cat_id').html("<option value=''>--Select sub category--</option>");
    }
});
       
       //Photo js
        let photoIndex = 1;
        const maxPhotos = 10; // Maximum allowed photos
        function activateLFM(button) {
            button.filemanager('image', {
                prefix: '/laravel-filemanager'
            });
        }
        $(document).ready(function() {
            activateLFM($('.lfm'));

            $('#add-photo').on('click', function() {
                const currentPhotoCount = $('#photo-wrapper .photo-item').length;

                if (currentPhotoCount >= maxPhotos) {
                    alert('You can only upload a maximum of 10 photos.');
                    $(this).prop('disabled', true).text('Max Photos Reached');
                    return;
                }

                // Add new photo item with the × symbol for removal
                const newInput = `
                    <div class="photo-item">
                        <div class="input-group mb-2">
                            <span class="input-group-btn">
                                <a data-input="photo${photoIndex}" data-preview="holder${photoIndex}" class="btn btn-secondary lfm text-white">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="photo${photoIndex}" class="form-control d-none" type="text" name="photos[]" readonly>
                            <span class="remove-photo ms-2" style="cursor: pointer;">❌</span>
                        </div>
                        <div id="holder${photoIndex}" class="image-holder"></div>
                    </div>
                `;
                $('#photo-wrapper').append(newInput);

                activateLFM($(`a[data-input=photo${photoIndex}]`));
                photoIndex++;
            });

            // Event listener for the Remove cross symbol
            $('#photo-wrapper').on('click', '.remove-photo', function() {
                $(this).closest('.photo-item').remove(); // Remove the photo item

                // Update the Add More Photos button state
                const currentPhotoCount = $('#photo-wrapper .photo-item').length;
                if (currentPhotoCount < maxPhotos) {
                    $('#add-photo').prop('disabled', false).text('Add More Photos');
                }
            });
        });

        //Video js
        $(document).ready(function() {
            // Activate LFM for video upload
            function activateLFM(button) {
                button.filemanager('file', {
                    prefix: '/laravel-filemanager',
                    type: 'file'
                }); // Explicitly set type to 'file'
            }
            activateLFM($('#video-wrapper .lfm'));

            // Function to render video preview
            function renderVideoPreview() {
                const videoPath = $('#video0').val(); // Get the video path
                const videoHolder = $('#videoHolder0');

                // Clear the holder first
                videoHolder.empty();

                if (videoPath) {
                    // Create a video element
                    const videoElement = $('<video>', {
                        src: videoPath,
                        controls: true, // Add controls to play the video
                        class: 'video-preview',
                        style: 'max-width: 100%; max-height: 100%; object-fit: cover;'
                    });

                    // Append the video element to the holder
                    videoHolder.append(videoElement);

                    // Add error handling in case the video fails to load
                    videoElement.on('error', function() {
                        videoHolder.empty();
                        videoHolder.append(
                            '<p style="color: red;">Failed to load video. Check the file path or server access.</p>'
                            );
                    });
                }
            }

            // Listen for changes to the video input field
            $('#video0').on('change', function() {
                renderVideoPreview();
            });

            // Since LFM might set the value programmatically, manually check after LFM interaction
            $('#video-wrapper .lfm').on('click', function() {
                // Poll for changes in the input value after LFM interaction
                setTimeout(function checkInputValue() {
                    const currentValue = $('#video0').val();
                    if (currentValue) {
                        $('#video0').trigger('change'); // Manually trigger the change event
                    } else {
                        // Keep polling until the value is set or timeout after 5 seconds
                        setTimeout(checkInputValue, 500);
                    }
                }, 500);
            });
        });
    </script>
@endpush