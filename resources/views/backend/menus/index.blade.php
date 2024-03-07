@extends('backend.layouts.app')
@section('title', 'Menus Sản phẩm')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Menus</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.menu.create') }}">Create new Menu</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:30%;">STT</th>
                                        <th style="width:50%;">Tên menu</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($menus as $menu)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->name }}</td>
                                            <td class="actions">
                                                <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.menu.show', $menu->id) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.menu.edit', $menu->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $menus->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
