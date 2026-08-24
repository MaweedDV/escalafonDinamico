@extends('layouts.backendPublic')

@section('content')
    <style>
        /* --- ESTILOS RESPONSIVOS --- */

        @media (max-width: 768px) {
            h1.fw-bold {
                font-size: 1.4rem !important;
            }

            header img {
                max-width: 170px !important;
            }

            .card p {
                font-size: 0.85rem;
            }

            .card-header {
                font-size: 0.9rem;
            }

            .table-responsive {
                display: none;
                /* Ocultar tabla en móvil */
            }

            .mobile-card {
                display: block !important;
                /* Mostrar cards en móvil */
            }
        }

        @media (min-width: 769px) {
            .mobile-card {
                display: none !important;
                /* Ocultar cards en escritorio */
            }
        }
    </style>

    <div class="container-fluid px-3 px-md-5 my-4">

        <!-- Encabezado -->
        {{-- <header class="text-left mb-3">
        <img src="{{ asset('images/encabezado.png') }}"
             class="img-fluid"
             style="max-width: 250px;"
             alt="Encabezado">
    </header> --}}
        <div class="hero-inner">
            <div class="content content-full">
                <div class="px-3 py-5 text-center">
                    <div class="mb-3">
                        <a class="link-fx fw-bold fs-1" href="https://www.puertomontt.cl">
                            <img src="{{ asset('images/encabezado.png') }}" class="img-fluid" style="max-width: 250px;"
                                alt="Encabezado">
                        </a>
                        <p class="text-uppercase fw-bold fs-sm text-muted">Modo Mantenimiento</p>
                    </div>
                    <h1 class="text-black fw-bold mt-5 mb-3">Trabajando en algunas cosas..</h1>
                    <h2 class="h3 text-black-75 fw-normal text-muted mb-5">No te preocupes, ¡volveremos pronto!</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
