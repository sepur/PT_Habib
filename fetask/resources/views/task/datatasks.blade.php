<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tilte</th>
            <th scope="col">description</th>
            <th scope="col">Status</th>
            <th scope="col">Due Date</th>
	    <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
    
            <tr>
                <th scope="row">
                    {{ $loop->iteration }}
                </th>
                <td class="text-wrap">
                    {{ $item->title }}</td>
                <td class="text-wrap">
                    {{ $item->description }}
                </td>
                <td class="text-wrap">
                  {{ $item->status }}
                </td>
                <td class="text-wrap">
                  {{ \Carbon\Carbon::parse($item->due_date)->format('d F Y') }}
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="update({{ $item->id }})">
                        <span class="mdi mdi-pencil-outline"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">
                        <span class="mdi mdi-trash-can-outline"></span>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
