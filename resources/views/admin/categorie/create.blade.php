@extends('layouts.admin')

@section('title', 'Ajouter Catégories')

@section('header-title', 'Ajouter Catégories')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Catégories</h1> --}}
            <h1 class="app-page-title">Catégories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Create</a></li>
                <li class="breadcrumb-item active">Catégories</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajout</h3>
            <div class="section-intro">Ajouter une nouvelle catégorie.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Profil</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn app-btn-primary">Enregistrer</button>
                    </form>
                </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->
@endsection
