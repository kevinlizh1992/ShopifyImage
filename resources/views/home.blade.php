<!--page where user can upload one or multiple images at once-->

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Image (select single or multiple)') }}</div>
                    <div class="card-body">
                        <form action="/image" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="image[]" id="" class="form-control-image" multiple accept="image/*">
                            </div>
                                <input type="submit" value="Upload" class="btn btn-primary">
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
