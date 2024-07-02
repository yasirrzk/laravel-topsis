@extends('layouts.app')

@section('title', 'pages / calculate')

@section('contents')
<div class="col-md-6">
  <div class="panel panel-default">
      <div class="panel-heading text-center">
          Tabel Alternatif
      </div>
      <div class="panel-body">
          <div class="row">
              <div class="col-lg-12">
                  <table class="table table-striped table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>ID Alternatif</th>
                              <th>Nama Alternatif</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
