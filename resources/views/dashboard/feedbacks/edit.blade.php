@extends('layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('header-title', 'Detail Feedback')
@section('header-right')
<div class="toggle-switch">
    <a href="{{ route('feedbacks.index') }}" class="btn btn-primary btn-sm">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left"
            class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512">
            <path fill="currentColor"
                d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z">
            </path>
        </svg>
        Kembali
    </a>
</div>
@endsection
@section('content')
<div id="tooltip" class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form action="{{ route('feedbacks.update', $feedback->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div id="content-container">
                        <div class="form-group">
                            <label for="question">Divisi (*)</label>
                            <select class="custom-select @error('division_id') is-invalid @enderror" required
                                name="division_id">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ optional($feedback->division)->name == $division->name ? 'selected' : null }}>
                                    {{ $division->name }}</option>
                                @endforeach
                            </select>
                            @error('division_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="question">Pertanyaan (*)</label>
                            <textarea id="summernote" required name="question">{!! $feedback->question !!}</textarea>
                            @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if (!in_array(optional(auth()->user()->division)->name, ['Admin', 'User']))
                        <div class="form-group">
                            <label for="answer">Jawaban (*)</label>
                            <textarea id="summernote1" required name="answer">{{ $feedback->answer }}</textarea>
                            @error('answer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @endif
                        <div class="form-group mt-3">
                            <button class="btn btn-outline-primary mb-2">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote1').summernote();
    });
</script>
@endsection
