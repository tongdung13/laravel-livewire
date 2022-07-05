<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="form-group">
            <label for="blog_title" class="mb-2"><strong>Blog Title</strong></label>
            <div class="col-md-12 mb-3">
                <input wire:model="blog_title" type="text"
                    class="form-control @error('blog_title') is-invalid @enderror" autofocus>
                @error('blog_title')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="blog_title" class="mb-2"><strong>Blog Image</strong></label>
            <div class="col-md-12 mb-3">
                <input type="file" class="form-control" wire:model="image">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-dark">
                    Create Blog
                </button>
            </div>
        </div>
    </form>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>#</th>
                <th>Blog Title</th>
                <th>Slug</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $key => $blog)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $blog->blog_title }}</td>
                    <td>{{ $blog->slug }}</td>
                    <td>
                        <img src="{{ $blog->image }}" style="height:100px" alt="">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $blogs->links('pagination::bootstrap-4') }}
</div>
