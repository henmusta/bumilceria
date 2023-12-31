@extends('backend.layouts.master')

@section('title') {{ $config['page_title'] }} @endsection

@section('content')

    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-header mb-3">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    {{-- <h5 class="card-title mb-3">Transaction</h5> --}}
                </div>
                <div class="flex-shrink-0">
                    <a class="btn btn-primary " href="{{ route('backend.lb3ibubersalin.create') }}">
                        Tambah
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>

        </div>
        <input hidden id="user_puskes_id" value="{{Auth::user()->puskesmas->id ?? ''}}">
        <div class="card-body">
            <section class="datatables">
              <div class="table-responsive">
                <table id="Datatable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Bulan Tahun</th>
                            <th>Puskesmas</th>
                            <th>Aksi</th>
                          </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
              </div>
            </section>


        </div>
    </div>

 {{--Modal--}}



  <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDeleteLabel">Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @method('DELETE')
        <div class="modal-body">
          <a href="" class="urlDelete" type="hidden"></a>
          Apa anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button id="formDelete" type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('css')

@endsection
@section('script')

  <script>

     $(document).ready(function () {

      let modalDelete = document.getElementById('modalDelete');
      const bsDelete = new bootstrap.Modal(modalDelete);

    let dataTable = $('#Datatable').DataTable({
        responsive: true,
        scrollX: false,
        processing: true,
        serverSide: true,
        order: [[1, 'desc']],
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        pageLength: 10,
        ajax: {
          url: "{{ route('backend.lb3ibubersalin.index') }}",
          data: function (d) {
            d.puskesmas_id = $('#user_puskes_id').val();
          }
        },
        columns: [
        //   {data: 'image', name: 'image'},
          {data: 'tanggal', name: 'tanggal'},
          {data: 'puskesmas.name', name: 'puskesmas.name'},
          {data: 'action', name: 'action', width:"10px", orderable: false, searchable: false},
        ],
        columnDefs: [
          {
            className: 'dt-center',
            orderable: false,
            targets: 2,
          },
        ],
      });




      modalDelete.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let id = button.getAttribute('data-bs-id');
        this.querySelector('.urlDelete').setAttribute('href', '{{ route("backend.lb3ibubersalin.index") }}/' + id);
      });
      modalDelete.addEventListener('hidden.bs.modal', function (event) {
        this.querySelector('.urlDelete').setAttribute('href', '');
      });





      $("#formDelete").click(function (e) {
        e.preventDefault();
        let form = $(this);
        let url = modalDelete.querySelector('.urlDelete').getAttribute('href');
        let btnHtml = form.html();
        let spinner = $("<span aria-hidden='true' class='spinner-border spinner-border-sm' role='status'></span>");
        $.ajax({
          beforeSend: function () {
            form.text(' Loading. . .').prepend(spinner).prop("disabled", "disabled");
          },
          type: 'DELETE',
          url: url,
          dataType: 'json',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (response) {
            toastr.success(response.message, 'Success !');
            form.text('Submit').html(btnHtml).removeAttr('disabled');
            dataTable.draw();
            bsDelete.hide();
          },
          error: function (response) {
            toastr.error(response.responseJSON.message, 'Failed !');
            form.text('Submit').html(btnHtml).removeAttr('disabled');
            bsDelete.hide();
          }
        });
      });
    });
  </script>
@endsection
