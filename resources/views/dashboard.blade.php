@extends('layouts.template')

@section('content')
<div class="row mt-2 mb-2">
@if ($paymentNotification)
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle me-2"></i> <b>Attention:</b> {{ $paymentNotification }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@else

@endif
</div>
    <div class="container mt-5">
        <h1 class="mb-4">Tableau de bord</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Départements</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalsDepartement }}</h5>
                        <p class="card-text">Nombre total de départements</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Employés</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalsEmploye }}</h5>
                        <p class="card-text">Nombre total d'employés</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">Administrateurs</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalsAdministrateurs }}</h5>
                        <p class="card-text">Nombre total d'administrateurs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
