@extends('layouts.admin')

@section('title', 'Candidatures')

@section('header-title', 'Candidatures')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Candidatures</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Candidatures</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <div class="row">
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
                                    action="{{ route('candidatures.search') }}">
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
                                            Toutes les catégories</option>
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
                            {{-- <div class="col-auto">
                                <a class="btn app-btn-secondary" href="#">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                        </path>
                                    </svg>
                                    Download CSV
                                </a>
                            </div> --}}
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->


            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4"
                role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'all' || request('statut') === null ? 'active' : '' }}"
                    href="{{ route('candidatures.index', ['statut' => 'all', 'category_id' => request('category_id')]) }}"
                    role="tab">Tous</a>

                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'en attente' ? 'active' : '' }}"
                    href="{{ route('candidatures.index', ['statut' => 'en attente', 'category_id' => request('category_id')]) }}"
                    role="tab">En attente</a>

                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'programme' ? 'active' : '' }}"
                    href="{{ route('candidatures.index', ['statut' => 'programme', 'category_id' => request('category_id')]) }}"
                    role="tab">Programme</a>

                <a class="flex-sm-fill text-sm-center nav-link {{ request('statut') == 'terminé' ? 'active' : '' }}"
                    href="{{ route('candidatures.index', ['statut' => 'terminé', 'category_id' => request('category_id')]) }}"
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
                                            <th class="cell">Sexe</th>
                                            <th class="cell">Téléphone</th>
                                            <th class="cell">Profil</th>
                                            <th class="cell">Status</th>
                                            <th class="cell"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($candidatures as $candidature)
                                            <tr>
                                                <td class="cell">{{ $candidature->id }}</td>
                                                <td class="cell"><span class="truncate">{{ $candidature->name }}</span>
                                                </td>
                                                <td class="cell">{{ $candidature->firstname }}</td>
                                                <td class="cell">
                                                    {{ $candidature->sexe === 'M' ? 'Masculin' : 'Féminin' }}</span>
                                                </td>
                                                <td class="cell">{{ $candidature->phone }}</td>
                                                <td class="cell">{{ $candidature->category->nom }}</td>
                                                <td class="cell">
                                                    <span
                                                        class="badge bg-{{ $candidature->statut == 'terminé' ? 'success' : ($candidature->statut == 'en attente' ? 'danger' : 'warning') }}">
                                                        {{ ucfirst($candidature->statut) }}
                                                    </span>
                                                </td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary me-2"
                                                        href="{{ route('candidatures.show', $candidature->id) }}">View
                                                    </a>

                                                    @if ($candidature->statut == 'terminé')
                                                        <!-- Formulaire caché pour la suppression -->
                                                        <form
                                                            action="{{ route('candidatures.destroy', [$candidature->id]) }}"
                                                            method="POST" id="delete-form-{{ $candidature->id }}"
                                                            style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <a href="#" class="btn-sm app-btn-secondary me-2 deleteBtn"
                                                            title="Supprimer"
                                                            onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette catégorie ?')) { document.getElementById('delete-form-{{ $candidature->id }}').submit(); }">
                                                            Supprimer
                                                        </a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="cell" colspan="8">
                                                    Aucune catégorie ajoutée
                                                </td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $candidatures->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->
            </div><!--//tab-content-->



        </div>

    </div>
@endsection
