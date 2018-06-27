@extends('layout')

@section('content')
    <h1>Check List</h1>

    @if (isset($date))
        <div>{{$date}}</div>
    @else
        {{$date = date('20y-m-d')}}
        <!--<div>{{$date}}</div>-->
    @endif

    {{Form::open(['action' => 'CheckController@list'])}}
    {{Form::label('date', 'Date:')}} {{Form::text('date', '', ['id' => 'datepicker'])}}
    {{Form::submit('Change')}}
    {{Form::close()}}

    <h2>Check</h2>

    @if (! isset($status))
        <?php $status = NULL; ?>
    @endif

    @if ($status == "success")
        <div class="alert alert-success" role="alert">Succeed to check!</div>
    @elseif ($status == "error")
        <div class="alert alert-danger" role="alert">This user is already checked!</div>
    @elseif ($status == "null_user")
        <div class="alert alert-danger" role="alert">This user is not enrolled!</div>
    @elseif ($status == NULL)
    @else
        <div class="alert alert-warning" role="alert">
            Debug: <?php echo $status ?>
        </div>
    @endif

    {{Form::open(['action' => 'CheckController@store'])}}
    {{Form::label('name', 'Name')}} {{Form::text('name')}}
    {{Form::submit('Check')}}
    {{Form::close()}}

    <h2>Check list</h2>

    <table class="table">
        <tr>
            <td><span class='island-list' id="island-1">1</span></td>
            <td><span class='island-list' id="island-2">2</span></td>
            <td><span class='island-list' id="island-3">3</span></td>
            <td><span class='island-list' id="island-4">4</span></td>
            <td><span class='island-list' id="island-5">5</span></td>
        </tr>
        <tr>
            <td><span class='island-list' id="island-6">6</span></td>
            <td><span class='island-list' id="island-7">7</span></td>
            <td><span class='island-list' id="island-8">8</span></td>
            <td><span class='island-list' id="island-9">9</span></td>
            <td><span class='island-list' id="island-10">10</span></td>
        </tr>
        <tr>
            <td><span class='island-list' id="island-11">11</span></td>
            <td><span class='island-list' id="island-12">12</span></td>
            <td><span class='island-list' id="island-13">13</span></td>
            <td><span class='island-list' id="island-14">14</span></td>
            <td><span class='island-list' id="island-15">15</span></td>
        </tr>
    </table>

    <table class="table">
        <thead>
        <th>User</th>
        <th>Island</th>
        <th>Alphabet</th>
        <th>Checked?</th>
        </thead>
        <tbody>
        @foreach ($checks as $user)
            <tr class="checklist island-{{$user->island}}">
                <td>{{$user->name}}</td>
                <td>{{$user->island}}</td>
                <td>{{$user->alphabet}}</td>
                {{-- チェック済みならチェックマークそうでないなら! --}}
                @if ($user->checked == 1)
                    <td><span class="ui-icon ui-icon-check"></span></td>

                    {{-- 当日のチェックリストだけ修正ボタン表示 --}}
                    @if ($date == date('20y-m-d'))
                        {{--<td>
                            {{Form::open(['action' => 'CheckController@submit'])}}
                            {{Form::submit('Report the miss check')}}
                            {{Form::close()}}
                        </td>--}}
                    @endif

                @else
                    <td><span class="ui-icon ui-icon-notice"></span></td>
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>

@endsection