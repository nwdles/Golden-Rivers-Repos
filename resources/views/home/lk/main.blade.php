@extends('layout')

@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white ">

        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                @if(isset($show['payload']))
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Мои выставки</span>
                    <span class="badge badge-secondary badge-pill">{{$show['payload']['shows'][0]->count_row}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($show['payload']['shows'] as $item)

                        @php
                            if($item->show_status == false)
                                $status = 'Не подтвержден';
                            else
                                $status = 'Подтвержден';

                        @endphp

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><a href="{{ route('show.items',$item->show_id) }}">{{$item->show_name}}</a></h6>

                        </div>
                        <small><span  @if($item->show_status == true) class="text-success" @endif>{{$status}}</span></small>
                    </li>
                    @endforeach

                </ul>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Мои аукционы</span>
                    <span class="badge badge-secondary badge-pill">{{$show['payload']['auctions'][0]->count_row}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($show['payload']['auctions'] as $item)

                        @php
                            if($item->auction_status == false)
                                $status = 'Не подтвержден';
                            else
                                $status = 'Подтвержден';

                        @endphp

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><a href="{{ route('auction.items',$item->auction_id) }}">{{$item->auction_name}}</a></h6>

                            </div>
                            <small><span  @if($item->auction_status == true) class="text-success" @endif>{{$status}}</span></small>
                        </li>
                    @endforeach

                </ul>

                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Мои билеты</span>
                    <span class="badge badge-secondary badge-pill">{{$show['payload']['tickets'][0]->count_row}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($show['payload']['tickets'] as $item)

                        @php
                            if($item->ticket_status == false)
                                $status = 'запрос';
                            else
                                $status = 'оплатить';

                        @endphp

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <small>#{{$item->ticket_id}}</small>
                            @if($item->auction_id!== null)
                            <div>
                                <h6 class="my-0"><a href="{{ route('auction.items',$item->auction_id) }}">{{$item->auction_name}}</a></h6>
                            </div>
                            @elseif($item->show_id!==null)
                                <div>
                                    <h6 class="my-0"><a href="{{ route('show.items',$item->show_id) }}">{{$item->show_name}}</a></h6>
                                </div>
                            @endif
                            <small><span  @if($item->ticket_status == true) class="text-success" @endif>{{$status}}</span></small>
                        </li>
                    @endforeach
                </ul>
                    @else
                {{$show['status']}}
                @endif
            </div>

            @php
                        if($data['payload']['user_sex'] == false)
                            $sex = 'Женский';
                        else
                            $sex = 'Мужской';

                        if($data['payload']['user_status'] == false)
                            $status = 'Не подтвержден';
                        else
                            $status = 'Подтвержден';

            @endphp

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Личная информация</h4>
                    <div class="mb-3">

                            <label for="firstName">ФИО</label>
                            <input type="text" class="form-control"  value="{{$data['payload']['user_fullname']}}" readonly>

                    </div>

                    <div class="mb-3">
                        <label for="username">Логин</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" value ="{{$data['payload']['user_login']}}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Почта </label>
                        <input type="email" class="form-control" value="{{$data['payload']['user_email']}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="address">Телефон</label>
                        <input type="text" class="form-control" value="{{$data['payload']['user_phone']}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Пол </label>
                        <input type="text" class="form-control" value="{{$sex}}" readonly>
                    </div>

                <div class="mb-3">
                    <label for="address2">Статус </label>
                    <input type="text" class="form-control" value="{{$status}}" readonly>
                </div>


            </div>
        </div>

    </div>
@endsection