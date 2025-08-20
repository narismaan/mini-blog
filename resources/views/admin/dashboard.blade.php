@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div id="admin-dashboard"
         data-users='@json($users)'
         data-posts='@json($posts)'>
    </div> {{-- React mounts here --}}
@endsection
