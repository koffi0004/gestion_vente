@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tableau de Bord</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Produits</h5>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clients</h5>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ventes</h5>
                   
                </div>
            </div>
        </div>
    </div>

@endsection

