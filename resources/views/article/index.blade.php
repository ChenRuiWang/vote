@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Articles</div>

                    <div class="card-body">
                        @foreach($articles as $article)
                            <div class="card text-center" style="margin-top: 10px;">
                                <div class="card-body">
                                    <a href="{{ $article['link'] }}"><h5 class="card-title">{{$article['title']}}</h5></a>
                                    <button class="btn btn-primary">{!! emoji(':+1:') !!} {{ $article['votes'] }}</button>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ Carbon\Carbon::createFromTimestamp($article['time'])->diffForHumans() }}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
