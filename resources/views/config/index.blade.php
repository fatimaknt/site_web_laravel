@extends('layouts.template')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Configurations</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <form class="table-search-form row gx-1 align-items-center" method="GET"
                            action="{{ route('departements.index') }}">
                            <div class="col-auto">
                                <input type="text" id="search-orders" name="search" class="form-control search-orders"
                                    placeholder="Rechercher..." value="{{ request('search') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn app-btn-secondary">
                                    <i class="fas fa-search me-1"></i> Rechercher
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto">
                        <a class="btn app-btn-primary" href="{{ route('configurations.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Nouvelle configuration
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">#ID</th>
                            <th class="cell">Type</th>
                            <th class="cell">Valeur</th>
                            <th class="cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allconfig as $config)
                            <tr>
                                <td class="cell">#{{ $config->id }}</td>
                                <td class="cell">
                                    <span class="badge bg-primary rounded-pill me-2">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <strong>{{ $config->type }}</strong>

                                </td>
                                <td class="cell">
                                    <span class="badge bg-primary rounded-pill me-2">
                                        <i class="fas fa-building"></i>
                                    </span>
                                    <strong>{{ $config->value }}</strong>
                                    <strong>
                                        @if ($config->type === 'PAYMENT_DATE')
                                            de chaque mois
                                        @elseif ($config->type === 'APP_NAME')
                                            le nom de l'application
                                        @else
                                            {{ $config->type }}
                                        @endif
                                    </strong>
                                </td>

                                <td class="cell text-end">
                                    <form action="{{ route('configurations.delete', $config->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm app-btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce département? Tous les employés associés seront affectés.')">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-info-circle me-2"></i> Aucune configuration enregistrer
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $allconfig->links() }}
    </div>
@endsection
