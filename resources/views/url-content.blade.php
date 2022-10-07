<div>
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Filename</th>
                        <th>Url</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                    <tr>
                        <td title="Id">{{ $content->id }}.</td>
                        <td title="Filename">{{ $content->filename }}</td>
                        @if(\App\Enums\Status::COMPLETE === $content->status)
                        <td title="Url">
                            <a href="{{ route('download-content', ['id' => $content->id, 'filename' => $content->filename]) }}">
                                {{ $content->url }}</a>
                        </td>
                        @else
                        <td title="Url">{{ $content->url }}</td>
                        @endif
                        <td title="Status">{{ $content->status }}</td>
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