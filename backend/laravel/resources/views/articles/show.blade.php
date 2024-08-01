@extends('layouts.app')
@section('content')



    <div class="row mt-5">
        <div class="col-10">
            <h2>Find Article</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('article.fetch') }}" method="POST" id="article-form">
                @csrf
                <div class="form-group mt-3">
                    <label class="mb-3" for="id">Article ID:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Find Article</button>
            </form>

            @if ($article)
                <div id="article-details" class="mt-3">
                    <h3>Article Details</h3>
                    <div class="card">
                        <div class="card-body">
                            @if(!empty($article->title))
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->content }}</p>
                                @if ($article->image)
                                    <img width="300" height="300" src="{{config('constants.IMG_BASE_URL')}}{{$article->image}}" alt="Article Image" class="img-fluid">
                                @endif
                                <p class="card-text"><small class="text-muted">Created at: {{ $article->created_at }}</small></p>
                            @else
                                <h5 class="card-title">Not found</h5>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts-footer')
    <script>
        $(document).ready(function() {
            // Handle form submission for creating and updating
            $('#article-form').on('submit', function (e) {
                e.preventDefault();
                $(this).find('button').prop('disabled', true).text('Fetching...');
                this.submit();
            });
        });
    </script>


@endpush
