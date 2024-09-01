@extends('layouts.admin')

@section('title', 'Afficher Notification')

@section('header-title', 'Afficher Notification')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Notifications</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Show</a></li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    <div class="container col-12 col-lg-6 d-flex justify-content-between align-items-start">
        {{-- {{ $noti->candidatures->motivation }} --}}

        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start col-md-9">
            <div class="app-card-body px-4 w-100">
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-data"><img class="profile-image"
                                    src="https://ui-avatars.com/api?name={{ $notifications->interviews->candidatures->name }} {{ $notifications->interviews->candidatures->firstname }}"
                                    alt="" style="border-radius: 50%"></div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Nom et Prénom
                                        </font>
                                    </font>
                                </strong></div>
                            <div class="item-data">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{ $notifications->interviews->candidatures->name }}
                                        {{ $notifications->interviews->candidatures->firstname }}
                                    </font>
                                </font>
                            </div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Adresse </font>
                                    </font>
                                </strong></div>
                            <div class="item-data">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{ $notifications->interviews->candidatures->adresse }} </font>
                                </font>
                            </div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Email</font>
                                    </font>
                                </strong></div>
                            <div class="item-data">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{ $notifications->interviews->candidatures->email }}
                                    </font>
                                </font>
                            </div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">Motivation
                                        </font>
                                    </font>
                                </strong></div>
                            <div class="item-data">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{ $notifications->interviews->candidatures->motivation }}
                                    </font>
                                </font>
                            </div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
                <a class="btn app-btn-secondary"
                    href="{{ route('candidatures.showPdf', ['id' => $notifications->interviews->candidatures->id]) }}" target="_bank">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Voir le CV</font>
                    </font>
                </a>
            </div><!--//app-card-footer-->


        </div><!--//app-card-->

        <div class="text-center mt-4 col-md-3">
            <a class="btn app-btn-secondary" href="{{ route('notification.index') }}">
                Retour
            </a>
        </div>
    </div>
@endsection
