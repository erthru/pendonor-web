<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="card">
            <div class="card-body">
              <h2>Data Pengguna</h2>
              <table class="table table-striped" id="tablePengguna">
                <thead class="bg-primary" style="color:#FFFFFF">
                  <tr>
                    <th scope="col" style="width:5%">ID</th>
                    <th scope="col" style="width:40%">Nama Lengkap</th>
                    <th scope="col" style="width:30%">Email</th>
                    <th scope="col" style="width:10%">Foto</th>
                    <!-- <th scope="col" style="width:5%">Aksi</th> -->
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.loadPengguna();
  },
  methods: {
    loadPengguna() {
      let pendonorApi = this.pendonorApi;
      let router = this.$router;
      let asset = this.asset;
      $(document).ready(function() {
        let dataTable = $("#tablePengguna").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: pendonorApi + "pengguna/datatable/show",
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "nama_lengkap" },
            { data: "email" },
            {
              render: function(data, type, full, meta) {
                return (
                  "<img src='"+asset+"/uploads/" +
                  full.foto +
                  "'/ width='80px' height='80px'>"
                );
              }
            },
            // {
            //   render: function(data, type, full, meta) {
            //     return "<button class='btn btn-danger'>Hapus</button>";
            //   }
            // }
          ]
        });
        $("#tablePengguna_paginate").attr("style", "float:right;");
        $("#tablePengguna_filter").attr("style", "float:right;");
        $("#tablePengguna").on("click", "button", function() {
          deletePengguna(dataTable.row($(this).closest("tr")).data().id);
        });
        function deletePengguna(id) {
          swal({
            title: "Konfirmasi",
            text: "Hapus data ini ?",
            icon: "warning",
            buttons: ["BATAL", "HAPUS"],
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              axios.delete(pendonorApi + "pengguna/" + id).then(response => {
                $("#tablePengguna")
                  .DataTable()
                  .ajax.reload();
              });
            }
          });
        }
      });
    }
  }
};
</script>

