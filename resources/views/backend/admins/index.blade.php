@extends('backend.layouts.app')
@section('title', 'Adminstrator')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Admins</h2>
                </div>
                @if ($ad->admin_status_id == 1)
                    <div class="col-lg-6">
                        <a class="btn btn-primary float-end" href="{{ route('admin.create') }}">Create new admin</a>
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:25%;">Tên</th>
                                        <th style="width:25%;">Email</th>
                                        <th style="width:25%;">Trạng Thái</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($admins as $admin)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->admin_status->name }}</td>
                                            <td class="actions">
                                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.show', $admin->id) }}">Show</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @if ($ad->admin_status_id == 1)
                                                        <a class="btn btn-primary"
                                                            href="{{ route('admin.edit', $admin->id) }}">Edit</a>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $admins->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
