<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
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
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $content)
                    <tr>
                        <td class="text-center" title="Id">{{ $content->id }}.</td>
                        <td  class="text-center"title="Filename">{{ $content->filename }}</td>
                        <td  class="text-center" title="Url">{{ $content->url }}</td>
                        <td class="text-center" title="Status">{{ $content->status }}</td>
                        <td  class="text-center" title="Download">
                        @if(\App\Enums\Status::COMPLETE === $content->status)
                            <a href="{{ route('download-content', ['id' => $content->id, 'filename' => $content->filename]) }}">
                                <button type="action" class="btn btn-primary">Download Resource</button>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="action-buttons-wrapper">
            <form  method="POST" action="{{ route('queue-url') }}">
                <!-- <input type="text" id="url" name="url" placeholder="Enter url">
                @csrf
                <button type="submit" class="btn btn-primary">Queue Url</button> -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="https://example.com/resource" aria-label="Url" name="url" aria-describedby="basic-addon2">
                    @csrf
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Queue Url</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>