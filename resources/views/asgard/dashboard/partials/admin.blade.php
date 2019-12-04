<div class="box-header">
  <div class="row">
    <div class="col-md-12">
      <h3 class="box-title">
        Contactos
      </h3>
    </div>
    <div class="col-md-3">
      {!! Form:: normalSelect('tipo_filtro', 'Tipo', $errors, ['todos' => '--','Sugerencia' => 'Sugerencia','Contacto' => 'Contacto','Reporte' => 'Reporte'], null, ['id' => 'tipo_filtro']) !!}
    </div>
    <div class="col-md-3">
      <label style="color:white">x</label>
      {!! Form:: normalCheckbox('importante_filtro', 'Solo importantes', $errors) !!}
    </div>
  </div>
</div>
@php
  $contactos = \Contacto::all();
@endphp
<div class="box-body">
    <div class="table-responsive">
        <table class="data-table table table-bordered table-hover">
            <thead>
            <tr>
                <th width="5%" style="text-align:center"></th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th width="5%">Import.</th>
                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
              <th></th>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Fecha</th>
              <th>Tipo</th>
              <th>Import.</th>
              <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
          </tr>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
