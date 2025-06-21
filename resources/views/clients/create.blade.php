@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un client</h1>

    <form action="{{ route('clients.store') }}" method="POST">
        @include('clients.partials.form')
    </form>
</div>
@endsection