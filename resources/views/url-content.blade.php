<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-10">
            <table class="table table-striped">
                <thead class="table-header fixed-header">
                    <tr class="table-warning">
                        <th class="text-center">Id</th>
                        <th class="text-center">Filename</th>
                        <th class="text-center">Url</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                    <tr>
                        <td class="text-center" title="Id">{{ $content->id }}.</td>
                        <td class="text-center" title="Filename">{{ $content->filename }}</td>
                        @if(\App\Enums\Status::COMPLETE === $content->status)
                        <td class="text-center" title="Url">
                            <a href="{{ route('download-content', ['id' => $content->id, 'filename' => $content->filename]) }}">
                                {{ $content->url }}</a>
                        </td>
                        @else
                        <td class="text-center" title="Url">{{ $content->url }}</td>
                        @endif
                        <td class="text-center" title="Status">{{ $content->status }}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <form action="{{ route('queue-url') }}" method="POST">
            <input type="text" id="url" name="url" placeholder="Enter url">
            @csrf
            <button type="submit" class="btn action-button">Queue Url</button>
        </form>
    </div>
</div>