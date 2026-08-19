@extends('layouts.app')
@section('content_title', 'Data Kategori')
@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Data Kategori</h4>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger d-flex flex-column">
            @foreach ($errors->all() as $error)
            <small class="text-white my-2">{{ $error }}</small>
                
            @endforeach
        </div>
            
        @endif
        <div class="d-flex justify-content-end mb-2">
            <x-kategori.form-kategori/>
        </div>
    </div>
    <div class="table-responsive">
        <table id="table2" class="table table-bordered table-hover w-100">
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="12%" class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <x-kategori.form-kategori :id="$item->id"/>
                                    <a href="{{ route('master-data.kategori.destroy', $item->id) }}" class="btn btn-danger btn-sm mx-1" data-confirm-delete="true">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection