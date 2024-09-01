@extends('layouts.admin')

@section('title', 'Editer Entretiens')

@section('header-title', 'Editer Entretiens')
@section('breadcrumb')
    <div class="pagetitle">
        <!-- <h1>Dashboard</h1> -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">edit</a></li>
                <li class="breadcrumb-item active">Entretiens</li>
            </ol>
        </nav>
    </div>
    @endsection
    @section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="container mt-5">

                    <div class="container">
                        <div class="container-xl">
                            <hr class="mb-4">
                            <div class="row g-4 settings-section">
                                <div class="col-12 col-md-4">
                                    <h3 class="section-title">Modifier</h3>
                                    <div class="section-intro">Modifier l'entretien d'une candidature.</div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="app-card app-card-settings shadow-sm p-4">

                                        <div class="app-card-body">
                                            <form class="settings-form"
                                                action="{{ route('entretiens.update', $entretien->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="cand_id" class="form-label">Candidats</label>
                                                    <input type="text" class="form-control" id="cand_id" name="cand_id"
                                                        value="{{ old('cand_id', $entretien->candidatures->name . ' ' . $entretien->candidatures->firstname) }}" readonly>

                                                    @error('cand_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date"
                                                        value="{{ old('date', $entretien->date) }}">
                                                    @error('date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="time" class="form-label">Temps</label>
                                                    <input type="time" class="form-control" id="time" name="time"
                                                        value="{{ old('time', $entretien->time) }}">
                                                    @error('time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                {{-- <button type="submit" class="btn app-btn-primary">Retour</button> --}}
                                                <button type="submit" class="btn app-btn-primary">Mettre à jour</button>
                                            </form>
                                        </div><!--//app-card-body-->

                                    </div><!--//app-card-->
                                </div>

                            </div><!--//row-->
                        </div><!--//container-fluid-->
                    </div>
                </div>



            </div>

        </div>
    </section>


    </section>
    <script>
        function selectCandidate(candidateName, radioElement) {
            // Mettre à jour le texte du bouton dropdown
            const dropdownButton = document.getElementById('dropdownMenuButton');
            dropdownButton.textContent = candidateName;

            // Afficher le bouton "Programme entretien"
            const programmeBtn = document.getElementById('programmeBtn');
            programmeBtn.style.display = 'block';

            // Fermer la liste déroulante
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const bootstrapDropdown = new bootstrap.Dropdown(dropdownButton);
            bootstrapDropdown.hide(); // Utilisation de la méthode Bootstrap pour fermer la liste déroulante

            // Appeler la fonction toggleButton si vous avez besoin d'une logique spécifique pour gérer le bouton
            toggleButton();
        }
    </script>
@endsection
