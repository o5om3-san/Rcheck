@extends('layout')

@section('content')
    <h1>Users</h1>

    <h2>Add User</h2>
    <form action="/users" method="POST">
        {{ csrf_field() }}

        <div>
            <label for="user-name" class="col-sm-3 control-label">User Name</label>
            <input type="text" name="name" id="user-name">
            <label for="user-island">Island</label>
            <select name='island' id='user-island'>
                @foreach (range(1, 15) as $island_num)
                    <option value="{{$island_num}}">{{$island_num}}</option>
                @endforeach
            </select>
            <label for="user-alphabet">Alphabet</label>
            <select name='alphabet' id='user-alphabet'>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>

        <div>
            <button type="submit">Add User</button>
        </div>
    </form>

    <h2>User list</h2>
    <table class="table">
        <thead>
        <th>User</th>
        <th>Island</th>
        <th>Alphabet</th></thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->island}}</td>
                <td>{{$user->alphabet}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection