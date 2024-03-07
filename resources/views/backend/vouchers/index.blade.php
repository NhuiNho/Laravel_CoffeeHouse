@extends('backend.layouts.app')
@section('title', 'Vouchers')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Vouchers</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.voucher.create') }}">Create new
                        voucher</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:30%;">Mã voucher</th>
                                        <th style="width:30%;">Giảm giá %</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($vouchers as $voucher)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $voucher->code }}</td>
                                            <td>{{ $voucher->discount }}</td>
                                            <td class="actions">
                                                <form action="{{ route('admin.voucher.destroy', $voucher->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.voucher.show', $voucher->id) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.voucher.edit', $voucher->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $vouchers->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
