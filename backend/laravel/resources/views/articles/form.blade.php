@extends('layouts.app')
@section('content')



    <div class="row mt-5">
        <div class="col-10">
            <h1>{{ !empty($article) ? "Edit" : "Create" }} Article</h1>

            <form id="article-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="article-id" name="id" value="{{ !empty($article) ? $article['id'] : '' }}">
                <input type="hidden" name="_method" value="{{ !empty($article) ? "PUT" : "POST" }}">
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ !empty($article) ? $article['title'] : '' }}" class="form-control">
                    <div class="text-danger" id="title-error"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control">{{ !empty($article) ? $article['content'] : '' }}</textarea>
                    <div class="text-danger" id="content-error"></div>
                </div>

                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <br>
                    @if(!empty($article->image))
                        <img width="100" height="100" src="{{config('constants.IMG_BASE_URL')}}{{$article->image}}">
                    @endif
                    <br>
                    <input type="file" name="image" id="image" class="form-control">
                    <div class="text-danger" id="image-error"></div>
                </div>

                <button type="submit" id="submit-btn" class="btn btn-primary mt-3">{{ !empty($article) ? "Update" : "Create" }} Article</button>
            </form>

        </div>
    </div>
@endsection
@push('scripts-footer')
    <script>
        $(document).ready(function() {
            // Handle form submission for creating and updating
            $('#article-form').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let articleId = $('#article-id').val();
                let url = articleId ? `/api/articles/${articleId}` : '/api/articles';
                $(".text-danger").text('');
                $("#submit-btn").prop("disabled",true);
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#article-form')[0].reset();
                        $('#title-error, #content-error, #image-error').text('');
                        $('#article-id').val('');
                        toastr.options.timeOut = 10000;
                        toastr.success("Record save successfully");
                        setTimeout(function (){
                            location.href = '{{route('home')}}';
                        },2000)

                    },
                    error: function (xhr) {
                        $("#submit-btn").prop("disabled",true);
                        let errors = xhr.responseJSON.errors;
                        $('#title-error').text(errors.title ? errors.title[0] : '');
                        $('#content-error').text(errors.content ? errors.content[0] : '');
                        $('#image-error').text(errors.image ? errors.image[0] : '');
                        if(xhr.responseJSON.error){
                            alert(xhr.responseJSON.error);
                        }else if(!errors){
                            alert("something went wrong")
                        }

                    }
                });
            });
        });
    </script>


@endpush
