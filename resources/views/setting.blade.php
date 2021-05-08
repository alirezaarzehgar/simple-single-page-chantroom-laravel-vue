@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('home') }}" method="GET">
            <h4 class="text">Theme</h4>

            @foreach ($themes as $theme)
                <div class="form-check ml-4">
                    <input class="form-check-input" type="radio" name="theme" id="radio-{{ $theme }}"
                        value="{{ $theme }}" {{ $theme == session('theme', 'light') ? 'checked' : '' }}>
                    <label class="form-check-label text" for="radio-{{ $theme }}">
                        {{ $theme }}
                    </label>
                </div>
            @endforeach



            <button class="btn btn-primary mt-3">Apply Settings</button>
        </form>
    </div>
@endsection
