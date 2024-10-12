<form id="myform" role="form text-left" enctype="multipart/form-data" method="PUT">
    @csrf
    <!-- Baris 1 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-text-input" class="form-label">Title</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" id="example-text-input" name="title"
                value="{{ $task->title }}">
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="example-email-input" class="form-label">Description</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="text" name="description" id="description"
                value="{{ $task->description }}">
        </div>
    </div>

    <!-- Baris 3 -->
       <div class="row mb-3">
        <div class="col-md-3">
            <label for="link" class="form-label">Status</label>
        </div>
        <div class="col-md-9">
            <select class="form-control" name="status">
	        <option value="pending"  {{ $task->status == "pending" ? 'selected' : '' }}>Pending</option>
		<option value="inprogress" {{ $task->status == "inprogress" ? 'selected' : '' }}>Inprogress</option>
		<option value="completed" {{ $task->status == "completed" ? 'selected' : '' }}>Completed</option>
                    
	</select>

        </div>
    </div>

    <!-- Baris 4 -->
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="link" class="form-label">Due Date</label>
        </div>
        <div class="col-md-9">
            <input class="form-control" type="date" name="due_date" id="due_date" value={{$task->due_date}}>
        </div>
    </div>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="CloseModal()">Cancel</button>
        <button type="submit" class="btn btn-primary" onclick="storeupdatetask({{ $task->id }})">Update</button>
    </div>
</form>
<script src="{{ asset('/assets') }}/js/file-upload.js"></script>
