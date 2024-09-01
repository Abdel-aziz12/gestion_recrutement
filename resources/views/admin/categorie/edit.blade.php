@extends('layouts.admin')

@section('title', 'éditer Catégories')

@section('header-title', 'éditer Catégories')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Catégories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">edit</a></li>
                <li class="breadcrumb-item active">Catégories</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="container-xl">
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">Editer</h3>
                        <div class="section-intro">Editer une catégorie.</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <form class="settings-form" action="{{ route('categories.update', $categories->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $categories->id }}">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Profil</label>
                                        <input type="text" class="form-control" id="nom" name="nom"
                                            value="{{ old('nom', $categories->nom) }}">
                                        @error('nom')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn app-btn-primary">Mettre à jour</button>
                                </form>
                            </div><!--//app-card-body-->

                        </div><!--//app-card-->
                    </div>
                </div><!--//row-->
            </div><!--//container-fluid-->

        </div><!-- /.container-fluid -->
    </section>
@endsection
