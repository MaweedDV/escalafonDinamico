@extends('layouts.backend')

@section('content')
            <!-- Hero -->
                    <div class="bg-image" style="background-image: url({{ asset('images/municipalidad.jpg') }});">
                      <div class="hero bg-black-50">
                        <div class="hero-inner">
                          <div class="content content-full text-center">
                            <h1 class="display-4 fw-bold text-white mb-3">
                              SISTEMA ESCALAFÓN MUNICIPAL
                            </h1>
                            <h2 class="h3 fw-normal text-white-75 mb-5">Bienvenido: {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }} {{ Auth::user()->apellido_materno }}</h2>
                            <div>
                              <a class="btn btn-primary" href="{{ route('escalafon.index') }}">
                                <i class="fa fa-fw fa-share opacity-50 me-1"></i> IR A ESCALAFÓN
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
            <!-- END Hero -->
@endsection
