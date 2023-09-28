<template>
  <div>
    <div class="container">
      <br>
      <div class="row" style="margin-top:15px">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <h2>Data Admin</h2>
                </div>
                <div class="col-md-2">
                  <router-link
                    class="btn btn-success w-100"
                    to="/master/admin/tambah"
                  >+ Tambah</router-link>
                </div>
              </div>
              <br>
              <table class="table table-striped" id="tableAdmin">
                <thead class="bg-primary" style="color:#FFFFFF">
                  <tr>
                    <th scope="col" style="width:5%">ID</th>
                    <th scope="col" style="width:30%">Nama Lengkap</th>
                    <th scope="col" style="width:30%">Alamat</th>
                    <th scope="col" style="width:10%">Email</th>
                    <th scope="col" style="width:10%">Level</th>
                    <th scope="col" style="width:5%">Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    this.loadTableAdmin();
  },
  methods: {
    loadTableAdmin() {
      let pendonorApi = this.pendonorApi;
      let router = this.$router;
      let adminId = localStorage.getItem("id");
      $(document).ready(function() {
        let dataTable = $("#tableAdmin").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: pendonorApi + "admin/datatable_without_self/show/" + adminId,
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "nama_lengkap" },
            { data: "alamat" },
            { data: "email" },
            { data: "level" },
            {
              render: function(data, type, full, meta) {
                return "<button class='btn btn-danger'>Hapus</button>";
              }
            }
          ]
        });
        $("#tableAdmin_paginate").attr("style", "float:right;");
        $("#tableAdmin_filter").attr("style", "float:right;");
        $("#tableAdmin").on("click", "button", function() {
          deleteAdmin(dataTable.row($(this).closest("tr")).data().id);
        });
        function deleteAdmin(id) {
          swal({
            title: "Konfrimasi",
            text: "Hapus data ini ?",
            icon: "warning",
            buttons: ["BATAL", "HAPUS"],
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              axios.delete(pendonorApi + "admin/" + id).then(response => {
                $("#tableAdmin")
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