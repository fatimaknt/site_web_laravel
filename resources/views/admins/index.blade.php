@extends('layouts.template')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Administrateurs</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                        <form class="table-search-form row gx-1 align-items-center" method="GET"
                            action="{{ route('administrateurs.index') }}">
                            <div class="col-auto">
                                <input type="text" id="search-orders" name="search" class="form-control search-orders"
                                    placeholder="Rechercher..." value="{{ request('search') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn app-btn-secondary">Rechercher</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto">
                        <a class="btn app-btn-primary" href="{{ route('administrateurs.create') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle me-1"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path fill-rule="evenodd"
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                            Ajouter un administrateur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">ID</th>
                            <th class="cell">Nom Complet</th>
                            <th class="cell">Email</th>
                            <th class="cell text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($admins as $admin)
                            <tr>
                                <td class="cell">#{{ $admin->id }}</td>
                                <td class="cell">{{ $admin->name }}</td>
                                <td class="cell">{{ $admin->email }}</td>

                                <td class="cell text-end">
                                    <form action="{{ route('administrateurs.delete', $admin->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm app-btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Aucun employé trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $admins->links() }}
    </div>
@endsection
