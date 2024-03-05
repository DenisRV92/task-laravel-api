@extends('welcome')
@section('content')
    <section style="margin-top: 20px" class="phone">
        @if(Session::has('success'))
            <div style="position: absolute;top: 0;right: 0" class="alert alert-success" id="alert">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('error'))
            <div style="position: absolute;top: 0;right: 0" class="alert alert-danger" id="alert">
                {{Session::get('error')}}
            </div>
        @endif
        <div class="container">
            <a href="{{route('create')}}" class="btn btn-success">Добавить номер</a>
            <a href="{{route('phone.index')}}" class="btn btn-success">На главную</a>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">
                        <form action="{{route('phone.search')}}" id="client-form">
                            <input type="text" name="number" placeholder="Номер Телефона"
                                   style="border:0;background-color: var(--bs-body-bg);">
                            <input type="submit" class="btn btn-dark" value="Найти">
                        </form>
                    </th>
                    <th scope="col">
                        <form action="{{route('phone.search')}}" id="client-form">
                            <input type="text" name="name" placeholder="Имя"
                                   style="border:0;background-color: var(--bs-body-bg);">
                            <input type="submit" class="btn btn-dark" value="Найти">
                        </form>
                    </th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($phones as $phone)
                    <tr>
                        @if(@isset($oneBack))
                            <form action="{{ route('phone.update', $phone) }}" method="POST" id="client-form">
                                @csrf
                                @method('PATCH')
                                @if($oneBack->id ==$phone->id)
                                    <th scope="row">{{$phone->id}}</th>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="number" name="number"
                                                   class="form-control @error('number') is-invalid @enderror"
                                                   value="{{$phone->number}}">
                                            @error('number')
                                            <span id="number-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="name" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{$phone->name}}">
                                            @error('name')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>

                                    <td width="30px">
                                        <input type="submit" class="btn btn-success" value="Сохранить">
                                    </td>
                            </form>
                            <td width="30px">
                                <form style="margin-left: 0" action="{{ route('phone.delete', $phone) }}" method="POST"
                                      class="d-inline"
                                      style="margin-left: 15px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="delete-form-btn btn btn-danger btn-sm"
                                           value="Удалить">
                                </form>
                            </td>
                        @else
                            <th scope="row">{{$phone->id}}</th>
                            <td>{{$phone->number}}</td>
                            <td>{{$phone->name}}</td>
                            <td width="30px"><a href="{{ route('phone.edit', $phone) }}"
                                                class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                    Редактировать
                                </a>
                            </td>
                            <td width="30px">
                                <form action="{{ route('phone.delete', $phone) }}" method="POST"
                                      class="d-inline"
                                      style="margin-left: 15px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="delete-form-btn btn btn-danger btn-sm"
                                           value="Удалить">
                                </form>
                            </td>
                        @endif
                        @else
                            <th scope="row">{{$phone->id}}</th>
                            <td>{{$phone->number}}</td>
                            <td>{{$phone->name}}</td>
                            <td width="30px"><a href="{{ route('phone.edit', $phone) }}"
                                                class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                    Редактировать
                                </a>
                            </td>
                            <td width="30px">
                                <form action="{{ route('phone.delete', $phone) }}" method="POST"
                                      class="d-inline"
                                      style="margin-left: 15px;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="delete-form-btn btn btn-danger btn-sm"
                                           value="Удалить">
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
