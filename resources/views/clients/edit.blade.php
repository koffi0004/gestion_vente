@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le client</h1>

    <form action="{{ route('clients.update', $client) }}" method="POST">
        @method('PUT')
        @include('clients.partials.form')
    </form>
</div>
@endsection