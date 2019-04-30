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
                                    <a href="{{ $article['link'] }}"><h5 class="card-title">{{$article['title']}}</h5>
                                    </a>
                                    <button onclick="vote('{{ $article['id'] }}')"
                                            class="btn btn-primary">{!! emoji(':+1:') !!} <span id="{{ $article['id'] }}">{{ $article['votes'] }}</span></button>
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

<script type="text/javascript">
    function vote(article) {
        axios.post('/vote/', {
            article
        }).then(response => {
            if (response.data.is_success === false) {
                return alert('You can\'t give a vote.');
            }
            document.getElementById(article).innerText = Number((document.getElementById(article).innerText)) + 1
        }).catch(error => {
            console.log(error);
        });
    }
</script>
