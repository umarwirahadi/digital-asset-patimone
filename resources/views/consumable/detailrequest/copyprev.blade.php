<div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Copy from Previous Month</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{$form['url']}}" method="post" id="formItemRequest" @if ($form['files']) enctype="multipart/form-data" @endif  >
            @csrf
            <input type="hidden" name="request_id" value="{{$requisition['id']}}">
            <div class="mb-3 mt-3">
                <label for="prev_request_id" class="form-label">Request Number (from Previous)</label>
                <select name="prev_request_id" id="prev_request_id" class="form-select ">
                     @foreach ($requisitions as $requisition)
                        <option value="{{ $requisition->id }}">{{ $requisition->requisition_no }} - {{ $requisition->requisition_month }} - {{ $requisition->requisition_year }}</option>                         
                     @endforeach
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="description_item" class="form-label">Description item</label>
                <textarea class="form-control" name="description_item" id="description_item" cols="30" rows="4"></textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="preferred_brand" class="form-label">Request number</label>
                <input type="text" class="form-control form-control-disabled" id="preferred_brand" name="preferred_brand" value="{{$requisition->requisition_no}}" disabled>
            </div>
            <div class="mb-3 mt-3">
                <label for="month" class="form-label">Month</label>
                <input type="text" class="form-control" id="month" name="month" value="{{$requisition->requisition_month}}" disabled>
            </div>
            <div class="mb-3 mt-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" value="{{$requisition->requisition_year}}" disabled>
            </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="formItemRequest" class="btn btn-primary" id="saveItem"><i class="bi bi-copy"></i> Copy</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>