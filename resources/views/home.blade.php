@extends('layouts.app')

@section('content')
<link href="{{asset('css/lightbox.css')}}" rel="stylesheet" />
{{-- <script src="{{asset('js/lightbox.js')}}"></script> --}}
<div class="container" style="max-width: 1400px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import</div>

                <br>
                <div class="col"><small>Choose excel file for import products</small></div>
                <form class="card-body" action="{{route('uploadExcel')}}" method="post" enctype="multipart/form-data">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($file = Session::get('file'))
                        <div class="alert alert-success">
                            <strong>{{ $file }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="no-list-style">
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @csrf
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="excel" type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile04">Choose Excell file</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
                      </div>
                    </div>
                </form>

                <hr>
                <div class="col"><small>Choose images</small></div>
                <form class="card-body" action="{{route('uploadImages')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="images[]" multiple type="file" class="custom-file-input" id="inputGroupFile05" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile05">Choose images</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Upload</button>
                      </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="row mini-cards">
        @foreach($images as $image)
        <div class="mini-card">
            <a href="{{asset('storage/images/'.$image)}}" data-lightbox="set"><img src="{{asset('storage/images/'.$image)}}" alt=""></a>
            <div class="caption">{{$image}}</div>
            <a class="delete-btn" href="{{route('deleteImage', $image)}}">&times;</a>
        </div>
        @endforeach
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    $('.custom-file-input').on('change',function(){
        var fileName = $(this).val();
        // console.log(fileName)
        if(fileName) fileName = fileName.replace(/^.*[\\\/]/, '')
        $(this).next('.custom-file-label').html(fileName);
    })
});
</script>
@endsection
