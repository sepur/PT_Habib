<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            <th scope="col">Handle</th>
            <th scope="col">Handle</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            @php
                $endpoint = api_url_getimage('aplikasi/');
            @endphp
            <tr>
                <th scope="row">
                    {{ $loop->iteration }}
                </th>
                <td>{{ $item->nama }}</td>
                <td class="text-wrap">
                    {{ $item->keterangan }}</td>
                <td>
                    <a href="{{ $item->link }}" target="blank">{{ $item->link }}</a>
                </td>
                <td>
                    <img src="{{ $endpoint }}{{ $item->gambar }}" class="rounded" width="300px">
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
