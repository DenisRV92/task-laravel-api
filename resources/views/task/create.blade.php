@extends('welcome')
@section('content')
    <div style="width: 400px;min-height: 100%" class="container d-flex align-items-center">
        <form class="m-auto" style="width: 100%;" action="{{ route('phone.add') }}" method="POST" class="d-inline"
              style="margin-left: 15px;">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="number">Номер телефона</label>
                <input type="tel" id="number" name="number"
                       class="form-control @error('number') is-invalid @enderror">
                @error('number')
                <span id="number-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <input style="margin-top: 15px" type="submit" class="btn btn-success" value="Добавить номер">
        </form>
    </div>
@endsection
