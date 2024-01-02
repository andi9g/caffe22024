@extends('layouts.master')

@section("warnameja", "active")

@section("judul", "Pesanan")


@section('content')
<div id="tambahmeja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="my-modal-title">Tambah Nomor Meja</h5>
            <button class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{ route('tambah.meja', []) }}" method="post">
            @csrf
            <div class="modal-body">
               <div class="form-group">
                  <label for="nomormeja">Nomor Meja</label>
                  <input id="nomormeja" class="form-control" type="number" name="nomormeja">
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success">Tambah Meja</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col-md-6">
               <h3 class="my-0 py-0">NOMOR MEJA</h3>
            </div>
            <div class="col-md-6 text-right">
               <button class="btn btn-success" type="button" data-toggle="modal" data-target="#tambahmeja">Tambah Nomor Meja</button>
            </div>

         </div>
      </div>
      <div class="card-body">
         <div class="row">
         @foreach ($meja as $m)
            <div class="col-md-4">
               <div class="card">
                  <div class="card-header text-right">
                     <form action='{{ route('hapus.meja', [$m->idmeja]) }}' method='post' class='d-inline'>
                          @csrf
                          @method('DELETE')
                          <button type='submit' onclick="return confirm('Yakin ingin menghapus meja ini?')" class='badge badge-danger badge-btn border-0'>
                              <i class="fa fa-times"></i>
                          </button>
                     </form>
                  </div>
                  <div class="card-body">
                     <button class="btn btn-primary btn-block text-lg text-bold" type="button" data-toggle="modal"    data-target="#pesanan{{ $m->idmeja }}">
                        <font class="text-lg">
                           MEJA {{ $m->nomormeja }}
                        </font>
                     </button>
                  </div>
               </div>
            </div>

            <div id="pesanan{{ $m->idmeja }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">MEJA {{ $m->nomormeja }}</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <table class="table table-striped table-sm p-2">
                           <thead>
                              <tr>
                                 <th width="5px">No</th>
                                 <th>Nama List</th>
                                 <th>Jml</th>
                                 <th>Harga</th>
                                 <th>ubah</th>
                              </tr>
                           </thead>
                           @php
                              $pesanan = App\Models\pesananM::where("pesanan.idmeja", $m->idmeja)
                              ->join("list", "list.idlist", "pesanan.idlist")
                              ->select("pesanan.*")
                              ->selectRaw("list.harga * pesanan.jumlah as total")
                              ->get();

                           @endphp
                           @foreach ($pesanan as $pesan)
                               <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $pesan->list->namalist }}</td>
                                 <td>{{ $pesan->jumlah }}</td>
                                 <td>Rp{{ number_format($pesan->total, 0, ",", ".") }}</td>
                                 <td>
                                    
            
                                    <form action="{{ route('bayarsatuan.pesanan', []) }}" method="post" class="d-inline">
                                       @csrf
                                       <input type="number" hidden value="{{ $pesan->idpesanan }}" name="idpesanan">
                        
                                       <button type="submit" class="badge badge-btn py-1 border-0 badge-success" onclick="return confirm('Bayar satuan?')">
                                          <i class="fa fa-check"></i>
                                       </button>
                                    </form>
                                 </td>
                               </tr>
            
                               <div id="editpemesanan{{ $pesan->idpesanan }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <form action="{{ route('ubah.jumlah', [$pesan->idpesanan]) }}" method="post">
                                          @csrf
                                          <div class="modal-body">
                                             <div class="form-group">
                                                <label for="jumlah">Jumlah Pesanan</label>
                                                <input id="jumlah" class="form-control" type="number" name="jumlah" value="{{ $pesan->jumlah }}">
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn-success">
                                                Ubah
                                             </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                               </div>
                           @endforeach
                           <tfoot>
                              <tr class="text-lg">
                                 <th colspan="3">TOTAL</th>
                                 <th colspan="1">Rp{{ number_format($pesanan->sum('total'), 0, ",", ".") }}</th>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                     <div class="card-footer w-100">

                        <form action="{{ route('bayar.pesanan', []) }}" method="post">
                           @csrf
                           <input type="number" hidden value="{{ $m->idmeja }}" name="idmeja">

                           <button type="submit" class="btn btn-block btn-secondary" onclick="return confirm('tekan ya untuk melanjutkan proses')">BAYAR LUNAS</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
      </div>
   </div>
</div>

@endsection