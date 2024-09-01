@extends('layouts.admin')

@section('title', 'Entretiens')

@section('header-title', 'Entretiens')
@section('breadcrumb')
    <div class="pagetitle">
        <!-- <h1>Dashboard</h1> -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Entretiens</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </div>

        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Orders</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center" method="GET"
                                    action="{{ route('entretiens.search') }}">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="search"
                                            class="form-control search-orders" placeholder="Search"
                                            value="{{ isset($search) ? $search : '' }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Search</button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">

                                <form method="GET" action="">
                                    <select id="category" name="category_id" class="form-control"
                                        onchange="this.form.submit()">
                                        <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>
                                            Toutes les catégories
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="statut" value="{{ request('statut') }}">
                                </form>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('entretiens.create') }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                        </path>
                                    </svg>
                                    Planifier un Entretien
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->


            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4"
                role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'all' || request('statut') === null ? 'active' : '' }}"
                    href="{{ route('entretiens.index', ['statut' => 'all', 'category_id' => request('category_id')]) }}"
                    role="tab">Tous</a>

                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'programme' ? 'active' : '' }}"
                    href="{{ route('entretiens.index', ['statut' => 'programme', 'category_id' => request('category_id')]) }}"
                    role="tab">Programme</a>

                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'terminé' ? 'active' : '' }}"
                    href="{{ route('entretiens.index', ['statut' => 'terminé', 'category_id' => request('category_id')]) }}"
                    role="tab">Terminé</a>
            </nav>


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">#</th>
                                            <th class="cell">Nom</th>
                                            <th class="cell">Prénom</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Time</th>
                                            <th class="cell">profil</th>
                                            <th class="cell">Status</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($entretiens as $entre)
                                            <tr>
                                                <td class="cell">{{ $entre->id }}</td>
                                                <td class="cell"><span
                                                        class="truncate">{{ $entre->candidatures->name }}</span>
                                                </td>
                                                <td class="cell">{{ $entre->candidatures->firstname }}</td>
                                                <td class="cell">
                                                    <span class="truncate">{{ $entre->date }} </span>
                                                </td>
                                                <td class="cell">{{ $entre->time }}</td>
                                                <td class="cell">
                                                    {{ $entre->candidatures->category ? $entre->candidatures->category->nom : 'Aucune catégorie' }}
                                                </td>
                                                <td class="cell">
                                                    <span
                                                        class="badge bg-{{ $entre->candidatures->statut == 'terminé' ? 'success' : ($entre->candidatures->statut == 'en attente' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($entre->candidatures->statut) }}
                                                    </span>
                                                </td>
                                                <td class="cell">
                                                    @if ($entre->candidatures)
                                                        @if ($entre->candidatures->statut === 'programmé')
                                                            <a class="btn-sm app-btn-secondary me-2"
                                                                href="{{ route('entretiens.edit', $entre->id) }}">Modifier
                                                            </a>
                                                        @endif

                                                        @if ($entre->candidatures->statut === 'programmé')
                                                            <!-- Bouton pour changer le statut -->
                                                            <a class="btn-sm app-btn-secondary me-2" title="Changer Statut"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#statutmodal-{{ $entre->id }}"
                                                                href="#">
                                                                Changer le statut
                                                            </a>
                                                        @endif

                                                        @if ($entre->candidatures->statut == 'terminé')
                                                            <!-- Formulaire caché pour la suppression -->
                                                            <form action="{{ route('entretiens.destroy', [$entre->id]) }}"
                                                                method="POST" id="delete-form-{{ $entre->id }}"
                                                                style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <a href="#"
                                                                class="btn-sm app-btn-secondary me-2 deleteBtn"
                                                                title="Supprimer"
                                                                onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette catégorie ?')) { document.getElementById('delete-form-{{ $entre->id }}').submit(); }">
                                                                Supprimer
                                                            </a>
                                                        @endif
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="cell" colspan="7">
                                                    Aucune entretien n'a été ajouté
                                                </td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $entretiens->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->
            </div><!--//tab-content-->

            @foreach ($entretiens as $entre)
                <!-- Modal pour changer le statut -->
                <div class="modal fade" id="statutmodal-{{ $entre->id }}" tabindex="-1"
                    aria-labelledby="statutmodalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="statutmodalLabel">Changer
                                    le Statut de l'Entretien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('entretiens.updateStatut', [$entre->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <div class="mb-3">
                                        <label for="statut" class="form-label">Statut</label>
                                        <select name="statut" id="statut" class="form-select" required>
                                            <option value="terminé"{{ $entre->statut == 'terminé' ? ' selected' : '' }}>
                                                Terminé
                                            </option>
                                            <!-- Ajoutez d'autres options si nécessaire -->
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Changer le
                                        Statut</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
    </div>
    </div>
@endsection
