@extends('layouts.app')
@section('content')
    <body>
    <div class="container">
        <div class="row">
            <div class="content">
                <div class="links">
                    <ul class="list-group">
                        @foreach ($links as $link)
                        <li class="list-group-item">
                            <a href="{{ $link->url }}">{{ $link->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection

