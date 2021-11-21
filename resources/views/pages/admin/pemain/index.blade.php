@extends('layouts.default')

@section('title')
Pemain
@endsection

@push('before-script')

@if (session('status'))
<x-sweetalertsession tipe="{{session('tipe')}}" status="{{session('status')}}"/>
@endif
@endpush


@section('content')
<section class="section">
    <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
            {{-- <div class="breadcrumb-item"><a href="#">Layout</a></div> --}}
            <div class="breadcrumb-item">@yield('title')</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">

                <div class="d-flex bd-highlight mb-3 align-items-center">

                    <div class="p-2 bd-highlight">

                        <form action="{{ route('pemain.cari',$tahunpenilaian->id) }}" method="GET">
                            <input type="text" class="babeng babeng-select  ml-0" name="cari">
                        </div>
                        <div class="p-2 bd-highlight">
                            <span>
                                <input class="btn btn-info ml-1 mt-2 mt-sm-0" type="submit" id="babeng-submit"
                                    value="Cari">
                            </span>
                        </div>

                        <div class="ml-auto p-2 bd-highlight">
                            <x-button-create link="{{route('pemain.create',$tahunpenilaian->id)}}"></x-button-create>
                        </form>

                    </div>
                </div>




                @if($datas->count()>0)
                    <x-jsdatatable/>
                @endif

                <x-jsmultidel link="{{route('pemain.multidel',$tahunpenilaian->id)}}" />

                <table id="example" class="table table-striped table-bordered mt-1 table-sm" style="width:100%">
                    <thead>
                        <tr style="background-color: #F1F1F1">
                            <th class="text-center py-2 babeng-min-row"> <input type="checkbox" id="chkCheckAll"> All</th>
                            <th >Nama </th>
                            <th >Username </th>
                            <th >Jenis Kelamin</th>
                            <th >Telp</th>
                            <th >Photo</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($datas as $data)
                        <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass " value="{{ $data->id }}">
                                    {{ ((($loop->index)+1)+(($datas->currentPage()-1)*$datas->perPage())) }}</td>
                                <td>
                                    {{$data->nama}}
                                </td>
                                <td>
                                    {{$data->users?$data->users->username:'Data tidak ditemukan'}}
                                </td>
                                <td>
                                    {{$data->jk}}
                                </td>
                                <td>
                                    {{$data->telp}}
                                </td>
                                <td  class="text-center babeng-min-row">
                                    @php
                                    $gambar=$data->photo;
                                    $randomimg='https://ui-avatars.com/api/?name='.$data->nama.'&color=7F9CF5&background=EBF4FF';
                                    @endphp
                                    @if($data->photo!=null AND $data->photo!=url('storage') AND $data->photo!='')
                                    <img alt="image" src="{{$gambar}}" class="img-thumbnail" data-toggle="tooltip" title="{{$data->nama}}" width="60px" height="60px" style="object-fit:cover;">
                                    @else
                                    <img alt="image" src="{{$randomimg}}" class="img-thumbnail" data-toggle="tooltip" title="{{$data->nama}}" width="60px" height="60px" style="object-fit:cover;">

                                    @endif

                                </td>

                                <td class="text-center babeng-min-row">
                                    {{-- <x-button-reset-pass link="/admin/{{ $pages }}/{{$data->id}}/reset" /> --}}
                                    <x-button-edit link="{{route('pemain.edit',[$tahunpenilaian->id,$data->id])}}" />
                                    <x-button-delete link="{{route('pemain.destroy',[$tahunpenilaian->id,$data->id])}}" />
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

@php
$cari=$request->cari;
@endphp
<div class="d-flex justify-content-between flex-row-reverse mt-3">
    <div >
{{ $datas->onEachSide(1)
    ->links() }}
    </div>
    <div>
<a href="#" class="btn btn-sm  btn-danger mb-2" id="deleteAllSelectedRecord"
            onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"  data-toggle="tooltip" data-placement="top" title="Hapus Terpilih">
            <i class="fas fa-trash-alt mr-2"></i> Hapus Terpilih</i>
        </a></div></div>

            </div>
        </div>
    </div>
</section>
@endsection


@section('containermodal')

@endsection
