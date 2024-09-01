@extends('layouts.admin')

@section('title', 'Historiques')

@section('header-title', 'Historiques')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Historiques</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Historiques</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
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
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->


            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4"
                role="tablist">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
                    href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Toutes les historiques</font>
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
                                                    <font style="vertical-align: inherit;">Nom</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Prénom</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Téléphone</font>
                                                </font>
                                            </th>
                                            <th class="cell">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Catégories</font>
                                                </font>
                                            </th>
                                            <th class="cell">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($historiques as $historique)
                                            <tr>
                                                <td class="cell">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">{{ $historique->id }}</font>
                                                    </font>
                                                </td>
                                                <td class="cell"><span class="truncate">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $historique->candidatures->name }}
                                                            </font>
                                                        </font>
                                                    </span></td>
                                                <td class="cell"><span class="truncate">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $historique->candidatures->firstname }}
                                                            </font>
                                                        </font>
                                                    </span></td>
                                                <td class="cell"><span class="truncate">
                                                        <font style="vertical-align: inherit;">
                                                            <font style="vertical-align: inherit;">{{ $historique->candidatures->phone }}
                                                            </font>
                                                        </font>
                                                    </span></td>
                                                <td class="cell">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">{{ $historique->candidatures->category->nom }}</font>
                                                    </font>
                                                </td>
                                                <td class="cell">
                                                    <a class="btn-sm app-btn-secondary me-2"
                                                    href="#">View
                                                </a>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td class="cell" colspan="5">
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
                        {{ $historiques->links() }}
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->
            </div><!--//tab-content-->



        </div><!--//container-fluid-->
    </div>
@endsection
