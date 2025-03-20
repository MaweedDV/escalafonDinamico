@extends('layouts.backend')

@section('content')
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <div>
                    <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Dashboard</h1>

                </div>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Inicio</li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>Grado</th>
                        <th>Calif.</th>
                        <th>Lista</th>
                        <th>Antig. Cargo</th>
                        <th>Antig. Grado</th>
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
                          <a href="be_pages_generic_profile.html">Alice Moore</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-warning">Trial</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">2</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Justin Hunt</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-info">Business</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">3</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Betty Kelley</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-success">VIP</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">4</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Marie Duncan</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-danger">Disabled</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">5</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Melissa Rice</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-info">Business</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="text-center" scope="row">6</th>
                        <td class="fw-semibold">
                          <a href="be_pages_generic_profile.html">Brian Cruz</a>
                        </td>
                        <td class="d-none d-sm-table-cell">
                          <span class="badge bg-primary">Personal</span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                              <i class="fa fa-pencil-alt"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                              <i class="fa fa-times"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
@endsection
