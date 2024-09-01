@extends('layouts.admin')

@section('title', 'Ajouter Entretiens')

@section('header-title', 'Ajouter Entretiens')
@section('breadcrumb')
    <div class="pagetitle">
        <!-- <h1>Dashboard</h1> -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Create</a></li>
                <li class="breadcrumb-item active">Entretiens</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
                <hr class="mb-4">
                <div class="row g-4 settings-section">
                    <div class="col-12 col-md-4">
                        <h3 class="section-title">Ajout</h3>
                        <div class="section-intro">Ajouter une nouvelle candidature.</div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="app-card app-card-settings shadow-sm p-4">

                            <div class="app-card-body">
                                <form class="settings-form" action="{{ route('entretiens.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="cand_id" class="form-label">Profil</label>
                                        <select name="cand_id" id="cand_id" required class="form-control">
                                            <option value="">Sélectionner un candidat</option>
                                            @foreach ($candidatures as $candidature)
                                                <option value="{{ $candidature->id }}">{{ $candidature->name }}
                                                    {{ $candidature->firstname }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('cand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date">
                                        @error('date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Temps</label>
                                        <input type="time" class="form-control" id="time" name="time">
                                        @error('time')
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
