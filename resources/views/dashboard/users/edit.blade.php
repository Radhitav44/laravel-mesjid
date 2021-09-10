@extends('layouts.app')
@section('header-title', 'Perbarui User')
@section('header-right')
<div class="toggle-switch">
    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left"
            class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512">
            <path fill="currentColor"
                d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z">
            </path>
        </svg>
        Back
    </a>
</div>
@endsection
@section('content')
<div id="tooltip" class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div id="content-container">
                        <div class="form-group">
                            <label for="title">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ $user->name }}" placeholder="Nama">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile">Kontak</label>
                            <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                                name="mobile" value="{{ $user->mobile }}" placeholder="Kontak">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ $user->email }}" placeholder="Email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea type="address" class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" placeholder="Alamat">{{ $user->address }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="custom-select @error('division_id') is-invalid @enderror" name="division_id">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}"
                                    {{ optional($user->division)->name == $division->name ? 'selected' : null }}>
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
                            <label for="password">Kata Sandi</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Kata Sandi">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
