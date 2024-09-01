@extends('layouts.admin')

@section('title', 'Configuration')

@section('header-title', 'Configuration')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Configurations</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Configurations</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">Ordres</font>
                        </font>
                    </h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center" method="GET"
                                    action="{{ route('categories.search') }}">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="search"
                                            class="form-control search-orders" placeholder="Recherche"
                                            value="{{ isset($search) ? $search : '' }}">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Recherche</font>
                                            </font>
                                        </button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('configurations.create') }}">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z">
                                        </path>
                                    </svg>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            Nouvelle configuration
                                        </font>
                                    </font>
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->


            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4"
                role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
                    href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Toutes les configurations</font>
                    </font>
                </a>
            </nav>


            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade active show" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">#</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Type</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Valeur</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allconfigurations as $config)
                                            <tr>
                                                <td class="cell"> {{ $config->id }}</td>

                                                <td class="cell">
                                                    <span class="truncate">
                                                        @if ($config->type == 'APP_NAME')
                                                            Nom de l'application
                                                        @endif
                                                        {{-- {{ $config->type }} --}}
                                                    </span>
                                                </td>
                                                <td class="cell">
                                                    {{ $config->value }}
                                                </td>
                                                <td class="cell">

                                                    <!-- Formulaire de suppression caché -->
                                                    <form action="{{ route('configurations.destroy', $config->id) }}"
                                                        method="POST" id="delete-form-{{ $config->id }}"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>

                                                    <!-- Lien pour déclencher la suppression -->
                                                    <a href="#" class="btn-sm app-btn-secondary me-2"
                                                        title="Supprimer"
                                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $config->id }}').submit();">
                                                        Supprimer
                                                    </a>

                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="cell" colspan="4">
                                                    Aucune configuration enregistrer
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        {{ $allconfigurations->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->
            </div><!--//tab-content-->



        </div><!--//container-fluid-->
    </div>
@endsection
