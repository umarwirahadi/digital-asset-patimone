<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{$form['url']}}" method="post" id="formItemRequest" @if ($form['files']) enctype="multipart/form-data" @endif  >
            @csrf
            @if($form['method'] == 'PUT')
                @method('PUT')
            @endif
            <input type="hidden" name="request_id" value="{{$requisition_detail->id}}">            
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Category</label>
                <select name="category" id="category" class="form-select ">
                    @foreach ($units as $unit)
                        @if($unit->item_category == 'category of request')
                                <option value="{{ $unit->item_code }}" @if($unit->item_code == $requisition_detail->category) selected @endif >{{ $unit->item_name }}</option>
                        @endif
                    @endforeach    
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="description_item" class="form-label">Description item</label>
                <textarea class="form-control" name="description_item" id="description_item" cols="30" rows="4">{{ $requisition_detail->description_item }}</textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="preferred_brand" class="form-label">Preferred Brand</label>
                <input type="text" class="form-control" id="preferred_brand" name="preferred_brand" value="{{ $requisition_detail->preferred_brand }}" placeholder="Enter preferred brand" required>
            </div>
            
            <div class="mb-3 mt-3">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" id="unit" class="form-select ">
                    @foreach ($units as $unit)
                        @if($unit->item_category == 'unit')
                            <option value="{{ $unit->item_code }}" @if($unit->item_code == $requisition_detail->unit) selected @endif>{{ $unit->item_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" value="{{ $requisition_detail->quantity }}" >
            </div>
            <div class="mb-3 mt-3">
                <label for="photo" class="form-label">Picture</label>
                <input type="file" class="form-control" id="photo" name="photos[]"  multiple accept="image/*">
                <div id="preview" class="mt-2">
                    @if($requisition_detail->photo)                    
                        <label>Existing Images:</label><br>
                        @foreach (json_decode($requisition_detail->photo) as $photo)
                        {{-- add remove icon for each image--}}
                        <a href="javascript:void(0)" class="remove-image" data-image="{{ $photo }}" data-url="{{route('detailreq.remove-image',[$requisition_detail->id,$photo])}}" style="color: red; margin-right: 5px;"> <span class="bi bi-x-circle"></span></a>
                        {{-- end remove icon --}}                      
                        <img src="{{ asset('requisition_attachments/' . $photo) }}" alt="Image" style="width: 100px; margin-right: 10px;">
                        @endforeach                        
                    @endif
                </div>
                <script>
                    document.getElementById('photo').addEventListener('change', function(event) {
                        const preview = document.getElementById('preview');
                        preview.innerHTML = ''; // Clear previous previews
                        Array.from(event.target.files).forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.style.width = '100px'; // Set width for the image
                                img.style.marginRight = '10px'; // Add some space between images
                                preview.appendChild(img);
                            }
                            reader.readAsDataURL(file);
                        });
                    });
                </script>
            </div>

            <div class="mb-3 mt-3">
                <label for="request_date" class="form-label">Date Requested</label>
                <input type="date" class="form-control" id="request_date" name="request_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
        </form>
        


      </div>
      <div class="modal-footer">
        <button type="submit" form="formItemRequest" class="btn btn-primary" id="saveItem">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>