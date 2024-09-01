@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header-title', 'Dashboard')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row mt-2 mb-2 p-2">
                {{-- @if ($date)
                    <div class="alert alert-warning">
                        <b>Rappel: </b> Vous avez des entretiens aujourd'hui {{ $date }} {{ $time}}
                    </div>
                @endif --}}
            </div>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $candidaturestotal }}</h3>
                            <p>Totales Candidatures</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <a href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $categoriespostes }}</h3>
                            <p>Postes Ouverts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <a href="{{ route('categories.index')}}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $entretiensprogramme }}</h3>
                            <p>Candidatures Programmées</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $entretienstermine }}</h3>
                            <p>Candidatures Terminées</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>


            {{-- <div class="card">
                <div class="card-header border-0 ui-sortable-handle bg-primary" style="cursor: move; height: 100px;">
                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                        <!-- button with a dropdown -->
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="collapse"
                            data-bs-target="#calendarCollapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="collapse show" id="calendarCollapse">
                    <div style="width: 100%">
                        <div class="bootstrap-datetimepicker-widget usetwentyfour">
                            <div class="card-body" id="calendar" style="height: 300px;">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div> --}}

    </section>
@endsection
