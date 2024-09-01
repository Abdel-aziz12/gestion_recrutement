@extends('layouts.admin')

@section('title', 'Notification')

@section('header-title', 'Notification')
@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Notifications</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection

@section('content')
    {{-- <div class="container">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
    </div> --}}

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="container-xl">
                <div class="position-relative mb-3">
                    <div class="row g-3 justify-content-between">
                        <div class="col-auto">
                            <h1 class="app-page-title mb-0">Notifications</h1>
                        </div>
                        <div class="col-auto">
                            <div class="page-utilities">
                                <select class="form-select form-select-sm w-auto">
                                    <option selected value="option-1">All</option>
                                    <option value="option-2">News</option>
                                    <option value="option-3">Product</option>
                                    <option value="option-4">Project</option>
                                    <option value="option-4">Billing</option>
                                </select>
                            </div><!--//page-utilities-->
                        </div>
                    </div>
                </div>

                @foreach ($notifications as $noti)
                    @php
                        $interview = $noti->interviews;
                        $candidature = $interview ? $interview->candidatures : null;
                    @endphp

                    @if ($candidature)
                        @if ($noti->is_read == 1)
                            <div class="app-card app-card-notification shadow-sm mb-4">
                                <div class="app-card-header px-4 py-3">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 col-lg-auto text-center text-lg-start">
                                            <img class="profile-image"
                                                src="https://ui-avatars.com/api?name={{ $candidature->name }} {{ $candidature->firstname }}"
                                                alt="">
                                        </div><!--//col-->
                                        <div class="col-12 col-lg-auto text-center text-lg-start">
                                            <div class="notification-type mb-2"><span
                                                    class="badge bg-info">{{ $noti->interviews->candidatures->category->nom }}</span>
                                            </div>
                                            <h4 class="notification-title mb-1">Notification Heading Lorem Ipsum</h4>

                                            <ul class="notification-meta list-inline mb-0">
                                                <li class="list-inline-item">{{ $noti->interviews->time}}</li>
                                                <li class="list-inline-item">|</li>
                                                <li class="list-inline-item">{{ $noti->interviews->candidatures->name }}
                                                    {{ $noti->interviews->candidatures->firstname }}</li>
                                            </ul>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body p-4">
                                    <div class="notification-content">{{ $candidature->motivation }}</div>
                                </div><!--//app-card-body-->
                                <div class="app-card-footer px-4 py-3">
                                    <a class="action-link {{ $noti->is_read ? 'read' : 'unread' }}"
                                        href="{{ route('notification.show', $noti->id) }}">Voir tous<svg width="1em"
                                            height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                        </svg></a>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-->
                        @else
                            <div class="app-card app-card-notification shadow-sm mb-4" style="background-color: #d3d3d3">
                                <div class="app-card-header px-4 py-3" style="background-color: #d3d3d3;">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 col-lg-auto text-center text-lg-start">
                                            <img class="profile-image"
                                                src="https://ui-avatars.com/api?name={{ $candidature->name }} {{ $candidature->firstname }}"
                                                alt="">
                                        </div><!--//col-->
                                        <div class="col-12 col-lg-auto text-center text-lg-start"
                                            style="background-color: #d3d3d3;">
                                            <div class="notification-type mb-2"><span
                                                    class="badge bg-info">{{ $candidature->category->nom }}</span>
                                            </div>
                                            <h4 class="notification-title mb-1">Notification Heading Lorem Ipsum</h4>

                                            <ul class="notification-meta list-inline mb-0">
                                                <li class="list-inline-item">{{ $noti->interviews->time }}</li>
                                                <li class="list-inline-item">|</li>
                                                <li class="list-inline-item">{{ $candidature->name }}
                                                    {{ $candidature->firstname }}</li>
                                            </ul>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body p-4" style="background-color: #d3d3d3;">
                                    <div class="notification-content">{{ $candidature->motivation }}</div>
                                </div><!--//app-card-body-->
                                <div class="app-card-footer px-4 py-3" style="background-color: #d3d3d3;">
                                    <a class="action-link" href="{{ route('notification.show', $noti->id) }}">Voir tous<svg
                                            width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right ms-2"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                        </svg></a>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-->
                        @endif
                    @endif
                @endforeach

                <div class="text-center mt-4"><a class="btn app-btn-secondary" href="#">Load more notifications</a>
                </div>

            </div><!--//container-fluid-->


        </div><!--//container-fluid-->
    </div>
@endsection
