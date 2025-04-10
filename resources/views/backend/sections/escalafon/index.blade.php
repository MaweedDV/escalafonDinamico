@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Escalafón</h1>

                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Administración</li>
                        <li class="breadcrumb-item active" aria-current="page">Escalafón</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row items-push">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                  <h3 class="block-title">JEFATURA GRADO 7 (8 CARGOS)</h3>
                  <div class="block-options">
                    {{-- <div class="block-options-item">
                      <code>.table-bordered</code>
                    </div> --}}
                  </div>
                </div>
                <div class="block-content">
                  <table class="table table-bordered table-vcenter">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 50px;">Lugar</th>
                        <th class="text-center" style="width: 200px">Nombre</th>
                        <th class="text-center" style="width: 150px">Rut</th>
                        <th>Grado</th>
                        <th>Calif.</th>
                        <th>Lista</th>
                        <th class="text-center" style="width: 150px">Antig. Cargo</th>
                        <th class="text-center" style="width: 150px">Antig. Grado</th>
                        <th>Antig. Mismo Municipio</th>
                        <th>Antig. Mismo Municipio En Detalle (Años-Meses-Dias)</th>
                        <th>Antig.Administ. Estado</th>
                        <th>Educación Formal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="text-center" scope="row">1</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">HENANDEZ ALVAREZ VIOLA</a>
                        </td>
                        <td class="text-center">
                          <h6>8204335-7</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-04-1978</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span> <span>
                        </td>
                        <td class="text-center">
                            <h6>SECRETARIA ADMINISTRATIVA</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">2</th>
                        <td class="fw-semibold">
                            <a href="be_pages_generic_profile.html">VARGAS GONZALEZ MONICA</a>
                        </td>
                        <td class="text-center">
                          <h6>6836668-2</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-08-1978</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span> <span>
                        </td>
                        <td class="text-center">
                            <h6>ENSEÑANZA MEDIA</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">3</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">CASTILLO ZUÑIGA VERÓNICA</a>
                        </td>
                        <td class="text-center">
                          <h6>8552913-7</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-01-1982</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span>Decreto N° 4823 del 04-04-2024 empate<span>
                        </td>
                        <td class="text-center">
                            <h6>SECRETARIA EJECUTIVA</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">4</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">ARRIAGADA ESPAÑA SERGIO</a>
                        </td>
                        <td class="text-center">
                          <h6>7951080-7</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>02-01-2019</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-01-1982</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span>Decreto N° 4823 del 04-04-2024 empate<span>
                        </td>
                        <td class="text-center">
                            <h6>CONTADOR GENERAL</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">5</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">VERA ALVARADO BERNARDITA</a>
                        </td>
                        <td class="text-center">
                          <h6>7874672-6</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>17-01-2020</h6>
                        </td>
                        <td class="text-center">
                            <h6>17-01-2020</h6>
                        </td>
                        <td class="text-center">
                            <h6>15-05-1979</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span> <span>
                        </td>
                        <td class="text-center">
                            <h6>ENSEÑADA MEDIA</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">6</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">REBOLLEDO OYARZUN WILIAMS</a>
                        </td>
                        <td class="text-center">
                          <h6>8059490-9</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-05-2021</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-05-2021</h6>
                        </td>
                        <td class="text-center">
                            <h6>15-01-1982</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span> <span>
                        </td>
                        <td class="text-center">
                            <h6>CONTADOR AUDITOR</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">7</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">ALFARO VELASQUEZ MARGARITA</a>
                        </td>
                        <td class="text-center">
                          <h6>6173327-2</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>06-06-2023</h6>
                        </td>
                        <td class="text-center">
                            <h6>06-06-2023</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-07-1979</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span> <span>
                        </td>
                        <td class="text-center">
                            <h6>ENSEÑANZA MEDIA</h6>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">8</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">OYARZUN GALLARDO FRANCISCO</a>
                        </td>
                        <td class="text-center">
                          <h6>5885182-5</h6>
                        </td>
                        <td class="text-center">
                            <h6>7</h6>
                        </td>
                        <td class="text-center">
                            <h6>70</h6>
                        </td>
                        <td class="text-center">
                            <h6>1</h6>
                        </td>
                        <td class="text-center">
                            <h6>09-02-2020</h6>
                        </td>
                        <td class="text-center">
                            <h6>09-02-2020</h6>
                        </td>
                        <td class="text-center">
                            <h6>01-01-1982</h6>
                        </td>
                        <td class="text-center">
                            <h6> </h6>
                        </td>
                        <td class="text-center">
                            <span>7 Años 7 Meses Tesorería <span>
                        </td>
                        <td class="text-center">
                            <h6>ENSEÑANZA MEDIA</h6>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
@endsection
