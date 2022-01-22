@extends('layouts.app')
@section("titulo")
    Menus y Roles
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Menu Roles</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Roles en los Menus
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table class="table table-responsive-sm table-bordered table-striped " id="menusroles-table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Menu</th>
                                        <th>Rol Asociado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($menuRols as $menuRol)
                                        <tr>
                                            <td>{{ $menuRol->id }}</td>
                                            <td>{{ $menuRol->name_menu}}</td>
                                            <td>{{ $menuRol->name_role}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

