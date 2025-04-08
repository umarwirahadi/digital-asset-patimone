<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" style="overflow-y: auto; max-height: 120vh;">
        <form action="{{$form['url']}}" method="post" id="formItem" @if ($form['files']) enctype="multipart/form-data" @endif  >
            @csrf
            <div class="mb-3 mt-3">
                <label for="item_code" class="form-label">Request ID</label>
                <input type="text" class="form-control" id="request_id" name="request_id" placeholder="Enter item code" readonly value="{{$requisition['id']}}">
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Category</label>
                <select name="category" id="category" class="form-select ">
                    <option value="office consumable">office consumable</option>
                    <option value="office supplies">office Supplies</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="description_item" class="form-label">Description item</label>
                <textarea class="form-control" name="description_item" id="description_item" cols="30" rows="4"></textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="preferred_brand" class="form-label">Preferred Brand</label>
                <input type="text" class="form-control" id="preferred_brand" name="preferred_brand" placeholder="Enter preferred brand" required>
            </div>
            
            <div class="mb-3 mt-3">
                <label for="unit" class="form-label">Unit</label>
                <select name="unit" id="unit" class="form-select ">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->item_code }}">{{ $unit->item_name }}</option>                        
                    @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="photo" class="form-label">Picture</label>
                <input type="file" class="form-control" id="photo" name="photos[]"  multiple accept="image/*" required>
                <div id="preview" class="mt-2"></div>
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
        <button type="button" class="btn btn-primary" id="saveItem">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>