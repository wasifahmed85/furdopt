@extends('backend.master')

@section('title', 'Pages')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.bootstrap5.min.css">
@endpush

@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Pet Listing</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pet Listing</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <div class="app-content">
        <div class="container-fluid">



            <h1 class="text-center mb-4">Pet Details</h1>

            <!-- Pet Information -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Pet Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Title/Name:</strong> {{ $pet->name }}</p>
                            <p><strong>Age:</strong> {{ $pet->age }} months</p>
                            <p><strong>Gender:</strong> {{ ucfirst($pet->gender) }}</p>
                            <p><strong>Size:</strong> {{ $pet->size }}</p>
                            <p><strong>Price:</strong> £{{ number_format($pet->price, 2) }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($pet->status) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Category:</strong> {{ $pet->category->name }}</p>
                            <p><strong>Breed:</strong> {{ $pet->breed->name }}</p>
                            <p><strong>Ad Type:</strong> {{ ucfirst($pet->ad_type) }}</p>
                            <p><strong>Owner:</strong> {{ $pet->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Information -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Health Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Microchipped:</strong> {{ $pet->microchipped_status ? 'Yes' : 'No' }}</li>
                        <li><strong>Neutered:</strong> {{ $pet->neutered_status ? 'Yes' : 'No' }}</li>
                        <li><strong>Vaccinations Up to Date:</strong> {{ $pet->vaccinations_status ? 'Yes' : 'No' }}</li>
                        <li><strong>Worm and Flea Treated:</strong> {{ $pet->worm_status ? 'Yes' : 'No' }}</li>
                        <li><strong>Health Checked:</strong> {{ $pet->health_checked ? 'Yes' : 'No' }}</li>
                        <li><strong>Health Guarantee:</strong> {{ $pet->health_guarantee }} months</li>
                    </ul>
                </div>
            </div>

            <!-- Location and Contact -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Location and Contact</h5>
                </div>
                <div class="card-body">
                    <p><strong>State:</strong> {{ $pet->state->state }}</p>
                    <p><strong>Address:</strong> {{ $pet->location }}</p>
                    <p><strong>Website:</strong> <a href="{{ $pet->website_link }}"
                            target="_blank">{{ $pet->website_link }}</a></p>
                    <p><strong>Map Link:</strong> <a href="{{ $pet->map_link }}" target="_blank">View on Map</a></p>
                </div>
            </div>

            <!-- Description and Features -->
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Description and Features</h5>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {!! $pet->description !!}</p>
                    <p><strong>Feature List:</strong> {!! $pet->feature_list !!}</p>
                </div>
            </div>

            <!-- Images -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Images</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!--@if ($pet->thumbnail)-->
                        <!--    <div class="col-md-3">-->
                        <!--        <img src="{{ asset('images/' . $pet->thumbnail) }}" class="img-fluid" alt="Thumbnail">-->
                        <!--    </div>-->
                        <!--@endif-->
                        @foreach ($petimages as $img)
                            <div class="col-md-3">
                                <img src="{{ asset('images/' . $img->image) }}" class="img-fluid" alt="Pet Image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('css')
    <style>
        .card-header {
            font-size: 1.2rem;
        }

        img.img-fluid {
            max-height: 150px;
            object-fit: cover;
        }
    </style>
@endpush
