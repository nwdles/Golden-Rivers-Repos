@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <nav class="my-2 my-md-0 mr-md-3">

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" onclick="location.href='{{ route('admin.panel') }}'" class="btn btn-secondary">Пользователи</button>
                    <button type="button" onclick="location.href='{{ route('admin.panel.shows') }}'" class="btn btn-secondary">Выставки</button>
                    <button type="button" onclick="location.href='{{ route('admin.panel.auctions') }}'" class="btn btn-secondary">Аукционы</button>
                    <button type="button" onclick="location.href='{{ route('admin.panel.tickets') }}'"class="btn btn-secondary">Билеты</button>
                </div>
            </nav>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Логин</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>ФИО</th>
                <th>Пол</th>
                <th>Статус</th>
                <th>Доп-но</th>
            </tr>
            </thead>
            <tbody>

                @php $i = 0; @endphp
                @foreach($users['payload'] as $item)
                    <tr>
                        @php $i++;
                        if($item->user_sex == false)
                            $sex = 'Женский';
                        else
                            $sex = 'Мужской';

                        if($item->user_status == false)
                            $status = 'Не подтвержден';
                        else
                            $status = 'Подтвержден';

                        @endphp
                        <td>{{$i}}</td>
                        <td>{{$item->user_login}}</td>
                        <td>{{$item->user_email}}</td>
                        <td>{{$item->user_phone}}</td>
                        <td>{{$item->user_fullname}}</td>
                        <td>{{$sex}}</td>
                        @if ($item->user_status == false)
                            <td><b>{{$status}}</b></td>
                            <td>
                                <form action="{{route('user.activate', $item->user_id)}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="submit"
                                           onclick="return confirm('Вы уверены, что хотите подтвердить пользователя?')"
                                           class="btn btn-outline-success btn-sm"
                                           value="Подтвердить">
                                </form>
                            </td>
                        @else
                            <td>{{$status}}</td>
                            <td> - </td>
                        @endif
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>
@endsection