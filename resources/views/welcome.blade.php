<!--common page to all users that displays images. This is the "repository" page-->

@extends('layouts.app')
@section('content')
<div class="container">
    <a href="/home" class="btn btn-warning">Upload</a>
</div>
<div class="container mt-2">
    <div class="row">
        @forelse($images as $image)
        <div class="col-xl-4 col-lg-4 col-md-6 col-xs-12"> <!-- 3 cols, 3 cols, 2 cols, 1 col-->
            <div class="card mb-3">
                <img src="{{ asset($image->image) }}" class="card-img-top img-fluid" alt="not working" height="220"> <!--get the corresponding image from public/images-->
                    @if(Auth::check()) <!--check if user is authenticated-->
                        @if($image->user_id == Auth::user()->id) <!--only allow remove action if user is logged on and it is his/her upload(s)-->
                            <div class="card-body">
                                <form action="/image/{{ $image->id }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </div>
                        @endif
                    @endif
            </div>
        </div>
            @empty
            <h1 class="text-danger">There is no uploads<h1>
        @endforelse
    </div>

    <!--pagination-->
    <div class="row justify-content-center">
        {{ $images->links('pagination::bootstrap-4') }}
    </div>

</div>
@endsection