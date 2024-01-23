@extends('layouts.cgp-app')

@vite(['resources/js/cgpLoadUsers.js'])

@section('content')
    <h1 clas="table-padding">Users</h1>

    <table id="usersTable" class="text-center border-r border-gray-300">
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Images Count</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <svg id="loaderAnimation" viewBox="25 25 50 50">
        <circle r="20" cy="50" cx="50"></circle>
    </svg>
@endsection

@include('components.message')
