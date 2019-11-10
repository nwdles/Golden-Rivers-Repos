@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <nav class="my-2 my-md-0 mr-md-3">

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" onclick="location.href='{{ route('admin.panel') }}'" class="btn btn-secondary">Пользователи</button>
                    <button type="button" onclick="location.href='{{ route('admin.panel.shows') }}'"class="btn btn-secondary">Выставки</button>
                    <button type="button" onclick="location.href='{{ route('admin.panel.auctions') }}'" class="btn btn-secondary">Аукционы</button>
                    <button type="button" class="btn btn-secondary">Билеты</button>
                </div>
            </nav>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Цена билета</th>
                <th>Дата открытия</th>
                <th>Пользователь</th>
                <th>Статус</th>
                <th>Доп-но</th>
            </tr>
            </thead>
            <tbody>

            @php $i = 0; @endphp
            @foreach($auctions as $item)
                <tr>
                    @php $i++;
                        $user = \App\Models\User::find($item->user_id)['user_login'];
                        if($item->auction_status == false)
                            $status = 'Не подтвержден';
                        else
                            $status = 'Подтвержден';

                    @endphp
                    <td>{{$i}}</td>
                    <td><a href="{{ route('auction.items',$item->auction_id) }}">{{$item->auction_name}}</a></td>
                    <td>{{$item->auction_cost_ticket}}</td>
                    <td>{{$item->auction_date}}</td>
                    <td>{{$user}}</td>
                    @if ($item->auction_status == false)
                        <td><b>{{$status}}</b></td>
                        <td>
                            <form action="#" method="post">
                                {{ csrf_field() }}
                                <input type="submit"
                                       onclick="return confirm('Вы уверены, что хотите подтвердить аукцион?')"
                                       class="btn btn-outline-success btn-sm"
                                       value="Подтвердить">
                            </form>
                        </td>
                    @else
                        <td>{{$status}}</td>
                        <td></td>
                    @endif
                </tr>
            @endforeach


            </tbody>
        </table>

    </div>
@endsection