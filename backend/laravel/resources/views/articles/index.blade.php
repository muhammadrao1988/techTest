@extends('layouts.app')
@section('content')


    <h2 class="mt-5">Articles</h2>
    <div class="table-responsive mt-5" bis_skin_checked="1">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" width="30%">Title</th>
                <th scope="col" width="40%">Content</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr id="article-row-{{ $article->id }}">
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->content }}</td>
                    <td>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger delete-article" data-id="{{ $article->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    {{ $articles->links() }}
@endsection
@push('scripts-footer')
<script>
    $(document).on('click', '.delete-article', function(e) {
        e.preventDefault();

        var articleId = $(this).data('id');
        var row = $('#article-row-' + articleId);

        if (confirm('Are you sure you want to delete this article?')) {
            $.ajax({
                url: '/api/articles/' + articleId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(result) {
                    toastr.options.timeOut = 10000;
                    toastr.success("Record deleted successfully");
                    row.remove();
                },
                error: function(xhr, status, error) {
                    toastr.error('Error: ' + xhr.responseJSON.error);
                }
            });
        }
    });
</script>
@endpush
