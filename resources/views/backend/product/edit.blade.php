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
    </style>

    <div class="card">
        <h5 class="card-header">Edit Product</h5>
        <div class="card-body">
            <form method="post" action="{{route('product.update',$product->id)}}">
                @csrf 
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$product->title}}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
                    @error('summary')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="is_featured">Is Featured</label><br>
                    <input type="checkbox" name='is_featured' id='is_featured' value='1' {{($product->is_featured ? 'checked' : '')}}> Yes                        
                </div>

                <div class="form-group">
                    <label for="cat_id">Category <span class="text-danger">*</span></label>
                    <select name="cat_id" id="cat_id" class="form-control">
                        <option value="">--Select any category--</option>
                        @foreach($categories as $key=>$cat_data)
                            <option value='{{$cat_data->id}}' {{($product->cat_id==$cat_data->id ? 'selected' : '')}}>{{$cat_data->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{($product->child_cat_id ? '' : 'd-none')}}" id="child_cat_div">
                    <label for="child_cat_id">Sub Category</label>
                    <select name="child_cat_id" id="child_cat_id" class="form-control">
                        <option value="">--Select any sub category--</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Price(NRS) <span class="text-danger">*</span></label>
                    <input id="price" type="number" name="price" placeholder="Enter price" value="{{$product->price}}" class="form-control">
                    @error('price')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Discount(%)</label>
                    <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount" value="{{$product->discount}}" class="form-control">
                    @error('discount')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="size">Size</label>
                    <select name="size[]" class="form-control selectpicker" multiple data-live-search="true">
                        <option value="">--Select any size--</option>
                        @foreach($items as $item)              
                            @php 
                            $data = explode(',', $item->size);
                            @endphp
                            <option value="S" @if(in_array("S", $data)) selected @endif>Small</option>
                            <option value="M" @if(in_array("M", $data)) selected @endif>Medium</option>
                            <option value="L" @if(in_array("L", $data)) selected @endif>Large</option>
                            <option value="XL" @if(in_array("XL", $data)) selected @endif>Extra Large</option>
                            <option value="2XL" @if(in_array("2XL", $data)) selected @endif>Double Extra Large</option>
                            <option value="FS" @if(in_array("FS", $data)) selected @endif>Free Size</option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">--Select Brand--</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}" {{($product->brand_id==$brand->id ? 'selected' : '')}}>{{$brand->title}}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="condition">Condition</label>
                    <select name="condition" class="form-control">
                        <option value="">--Select Condition--</option>
                        <option value="default" {{($product->condition=='default' ? 'selected' : '')}}>Default</option>
                        <option value="new" {{($product->condition=='new' ? 'selected' : '')}}>New</option>
                        <option value="hot" {{($product->condition=='hot' ? 'selected' : '')}}>Hot</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stock">Quantity <span class="text-danger">*</span></label>
                    <input id="quantity" type="number" name="stock" min="0" placeholder="Enter quantity" value="{{$product->stock}}" class="form-control">
                    @error('stock')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="col-form-label">Photos <span class="text-danger">*</span></label>
                    <div id="photo-wrapper" class="d-flex flex-wrap">
                        @php
                            $photos = explode(',', $product->photo);
                            $photoIndex = 0;
                        @endphp
                        @foreach($photos as $photo)
                            <div class="photo-item">
                                <div class="input-group mb-2">
                                    <span class="input-group-btn">
                                        <a data-input="photo{{$photoIndex}}" data-preview="holder{{$photoIndex}}" class="btn btn-secondary lfm text-white">
                                            <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="photo{{$photoIndex}}" class="form-control d-none" type="text" name="photos[]" value="{{$photo}}" readonly>
                                    <span class="remove-photo ms-2" style="cursor: pointer;">❌</span>
                                </div>
                                <div id="holder{{$photoIndex}}" class="image-holder">
                                    <img src="{{$photo}}" alt="Product Photo">
                                </div>
                            </div>
                            @php $photoIndex++; @endphp
                        @endforeach
                    </div>
                    <button type="button" id="add-photo" class="btn btn-sm btn-primary mt-2">Add More Photos</button>
                </div>
                {{-- @dd($product->video) --}}
                <div class="form-group">
                    <label class="col-form-label">Video <span class="text-danger">*</span></label>
                    <div id="video-wrapper">
                        <div class="video-item">
                            <div class="input-group mb-2">
                                <span class="input-group-btn">
                                    <a data-input="video0" data-preview="videoHolder0" data-type="file" class="btn btn-secondary lfm text-white">
                                        <i class="fa fa-video-camera"></i> Choose
                                    </a>
                                </span>
                                <input id="video0" class="form-control" type="text" name="video" value="{{$product->video_url ?? ''}}" readonly>
                            </div>
                            <small class="form-text text-muted">Maximum video size allowed: 100 MB.</small>
                            <div id="videoHolder0" class="video-holder">
                                @if($product->video_url)
                                    <video src="{{$product->video_url}}" controls class="video-preview" style="max-width: 100%; max-height: 100%; object-fit: cover;"></video>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <option value="active" {{($product->status=='active' ? 'selected' : '')}}>Active</option>
                        <option value="inactive" {{($product->status=='inactive' ? 'selected' : '')}}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush

@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
            $('#description').summernote({
                placeholder: "Write detail Description.....",
                tabsize: 2,
                height: 150
            });
        });

        // Category AJAX
        var child_cat_id = '{{$product->child_cat_id}}';
        $('#cat_id').change(function() {
            var cat_id = $(this).val();
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}"
                    },
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response);
                        }
                        var html_option = "<option value=''>--Select any one--</option>";
                        if (response.status) {
                            var data = response.data;
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "' " + (child_cat_id == id ? 'selected' : '') + ">" + title + "</option>";
                                });
                            } else {
                                console.log('no response data');
                            }
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            }
        });
        if (child_cat_id != null) {
            $('#cat_id').change();
        }

        // Photo handling
        let photoIndex = {{$photoIndex}};
        const maxPhotos = 10;
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

            $('#photo-wrapper').on('click', '.remove-photo', function() {
                $(this).closest('.photo-item').remove();
                const currentPhotoCount = $('#photo-wrapper .photo-item').length;
                if (currentPhotoCount < maxPhotos) {
                    $('#add-photo').prop('disabled', false).text('Add More Photos');
                }
            });
        });

        // Video handling
        $(document).ready(function() {
            function activateLFM(button) {
                button.filemanager('file', {
                    prefix: '/laravel-filemanager',
                    type: 'file'
                });
            }
            activateLFM($('#video-wrapper .lfm'));

            function renderVideoPreview() {
                const videoPath = $('#video0').val();
                const videoHolder = $('#videoHolder0');
                videoHolder.empty();

                if (videoPath) {
                    const videoElement = $('<video>', {
                        src: videoPath,
                        controls: true,
                        class: 'video-preview',
                        style: 'max-width: 100%; max-height: 100%; object-fit: cover;'
                    });
                    videoHolder.append(videoElement);
                    videoElement.on('error', function() {
                        videoHolder.empty();
                        videoHolder.append(
                            '<p style="color: red;">Failed to load video. Check the file path or server access.</p>'
                        );
                    });
                }
            }

            $('#video0').on('change', function() {
                renderVideoPreview();
            });

            $('#video-wrapper .lfm').on('click', function() {
                setTimeout(function checkInputValue() {
                    const currentValue = $('#video0').val();
                    if (currentValue) {
                        $('#video0').trigger('change');
                    } else {
                        setTimeout(checkInputValue, 500);
                    }
                }, 500);
            });

            // Ensure initial render on page load if video exists
            if ($('#video0').val()) {
                renderVideoPreview();
            }
        });
    </script>
@endpush