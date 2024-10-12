<table class="table table-striped align-items-center">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                No
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Nama
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Email
            </th>
            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Creation Date
            </th> --}}
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Action
            </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($list as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                {{-- <td>{{ $item->created_at }}</td> --}}
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
