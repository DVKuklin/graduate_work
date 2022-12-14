@extends(backpack_view('blank'))

@php
    $widgets['after_content'][] = [
        'type'        => 'jumbotron',
        'heading'     => 'Новый виджет',
        'content'     => $my_data,
        'button_link' => backpack_url('user'),
        'button_text' => 'Перейти',
    ];
@endphp


@section('content')
    <h1>Это административная панель</h1>
    {{$my_data}}
@endsection