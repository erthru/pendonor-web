<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <h2>Informasi Umum</h2>
                </div>
                <div class="col-md-2">
                  <router-link class="btn btn-success w-100" to="/master/informasi_umum/tambah">+ Tambah</router-link>
                </div>
              </div>
              <table class="table table-striped" id="tableInformasiUmum">
                <thead class="bg-primary" style="color:#FFFFFF">
                  <tr>
                    <th scope="col" style="width:5%">ID</th>
                    <th scope="col" style="width:30%">Judul</th>
                    <th scope="col" style="width:40%">Konten</th>
                    <th scope="col" style="width:10%">Penulis</th>
                    <th scope="col" style="width:10%">Thumbnail</th>
                    <th scope="col" style="width:5%">Aksi</th>
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
    this.loadInformasiUmum();
  },
  methods: {
    loadInformasiUmum() {
      let pendonorApi = this.pendonorApi;
      let router = this.$router;
      let adminId = localStorage.getItem("id");
      let asset = this.asset;
      $(document).ready(function() {
        let dataTable = $("#tableInformasiUmum").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: pendonorApi + "informasi_umum/datatable/show",
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "judul" },
            {
              render: function(data, type, full, meta) {
                return (
                  "<p style='width:300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis'>"+full.rendered_konten+"</p>"
                );
              }
            },
            { data: "admin.nama_lengkap" },
            {
              render: function(data, type, full, meta) {
                return (
                  "<img src='"+asset+"/uploads/" +
                  full.thumbnail +
                  "'/ width='80px' height='80px'>"
                );
              }
            },
            {
              render: function(data, type, full, meta) {
                if(full.admin.id != adminId){
                    return "<button class='btn btn-warning' disabled>Detail</button>";
                }else{
                    return "<button class='btn btn-warning'>Detail</button>";
                }
              }
            }
          ]
        });
        $("#tableInformasiUmum_paginate").attr("style", "float:right;");
        $("#tableInformasiUmum_filter").attr("style", "float:right;");
        $("#tableInformasiUmum").on("click", "button", function() {
          router.push("/master/informasi_umum/detail/"+dataTable.row($(this).closest("tr")).data().id);
        });
      });
    }
  }
};
</script>

