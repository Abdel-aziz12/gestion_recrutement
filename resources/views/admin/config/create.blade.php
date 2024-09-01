@extends('layouts.admin')

@section('title', 'Ajouter Configuration')

@section('header-title', 'Ajouter Configuration')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            {{-- <h1 class="m-0">Catégories</h1> --}}
            <h1 class="app-page-title">Configurations</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Create</a></li>
                <li class="breadcrumb-item active">Configurations</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajout</h3>
            <div class="section-intro">Ajouter une nouvelle Configuration.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" action="{{ route('configurations.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Type de la configuration</label>
                            <select name="type" id="type" class="form-control">
                                <option value=""></option>
                                <option value="APP_NAME">Nom de l'application</option>
                                <option value="ANOTHER">Autre Options</option>
                            </select>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">Valeur</label>
                            <input type="text" class="form-control" id="value" name="value" placeholder="Entrer la valeur" value="{{ old('value')}}">
                            @error('value')
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
