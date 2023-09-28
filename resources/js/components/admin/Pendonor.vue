<template>
  <div>
    <div class="container">
      <br>
      <div class="row" style="margin-top:15px">
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="text-primary">
                    <b id="lbPendonorTerdaftar">0</b>
                  </h4>Pendonor Terdaftar
                </div>
              </div>
              <div class="col-md-4 bg-primary" style="background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="text-success">
                    <b id="lbPendonorBisaDonor">0</b>
                  </h4>Pendonor Bisa Donor
                </div>
              </div>
              <div class="col-md-4 bg-success" style="background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user_checked.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="text-warning">
                    <b id="lbPendonorBisaDonorA">0</b>
                  </h4>Gol. A Bisa Donor
                </div>
              </div>
              <div class="col-md-4 bg-warning" style="background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user_checked_a.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top:15px">
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 style="color:#30336b">
                    <b id="lbPendonorBisaDonorB">0</b>
                  </h4>Gol. B Bisa Donor
                </div>
              </div>
              <div class="col-md-4" style="background-color:#30336b; background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user_checked_b.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 style="color:#686de0">
                    <b id="lbPendonorBisaDonorAB">0</b>
                  </h4>Gol. AB Bisa Donor
                </div>
              </div>
              <div class="col-md-4" style="background-color:#686de0; background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user_checked_ab.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="row">
              <div class="col-md-8">
                <div class="card-body">
                  <h4 style="color:#535c68">
                    <b id="lbPendonorBisaDonorO">0</b>
                  </h4>Gol. O Bisa Donor
                </div>
              </div>
              <div class="col-md-4" style="background-color:#535c68; background-clip: content-box;">
                <div class="row justify-content-center card-body">
                  <img height="50" width="50" :src="this.asset+'/images/img_user_checked_o.png'">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-10">
                  <h2>Data Pendonor</h2>
                </div>
                <div class="col-md-2">
                  <router-link
                    class="btn btn-success w-100"
                    to="/master/pendonor/tambah"
                  >+ Tambah</router-link>
                </div>
              </div>
              <div class="row" style="margin-top:15px">
                <div class="col-md-12">
                  <table class="table table-striped" id="tablePendonor">
                    <thead class="bg-primary" style="color:#FFFFFF">
                      <tr>
                        <th scope="col" style="width:2%">ID</th>
                        <th scope="col" style="width:20%">Nama Lengkap</th>
                        <th scope="col" style="width:20%">Alamat</th>
                        <th scope="col" style="width:10%">Telp</th>
                        <th scope="col" style="width:10%">Jenkel</th>
                        <th scope="col" style="width:15%">Gol. Darah</th>
                        <th scope="col" style="width:5%">Resus</th>
                        <th scope="col" style="width:5%">Aksi</th>
                      </tr>
                    </thead>
                  </table>
                  <br>
                </div>
              </div>
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
    this.loadData();
    this.loadTablePendonor();
  },
  methods: {
    loadData() {
      axios.get(this.pendonorApi + "custom/stok/darah").then(response => {
        let pendonorTotal = response.data.data.pendonor.total;
        let pendonorBisaDonor = response.data.data.bisa_donor.total;
        let pendonorBisaDonorA = response.data.data.bisa_donor_a.total;
        let pendonorBisaDonorB = response.data.data.bisa_donor_b.total;
        let pendonorBisaDonorAB = response.data.data.bisa_donor_ab.total;
        let pendonorBisaDonorO = response.data.data.bisa_donor_o.total;
        $("#lbPendonorTerdaftar").text(pendonorTotal);
        $("#lbPendonorBisaDonor").text(pendonorBisaDonor);
        $("#lbPendonorBisaDonorA").text(pendonorBisaDonorA);
        $("#lbPendonorBisaDonorB").text(pendonorBisaDonorB);
        $("#lbPendonorBisaDonorAB").text(pendonorBisaDonorAB);
        $("#lbPendonorBisaDonorO").text(pendonorBisaDonorO);
      });
    },
    loadTablePendonor() {
      let pendonorApi = this.pendonorApi;
      let router = this.$router;
      $(document).ready(function() {
        let dataTable = $("#tablePendonor").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: pendonorApi + "pendonor/datatable/show",
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "nama_lengkap" },
            { data: "alamat" },
            { data: "telp" },
            { data: "jenkel" },
            { data: "golongan_darah" },
            { data: "resus" },
            {
              render: function(data, type, full, meta) {
                return "<button class='btn btn-warning'>Detail</button>";
              }
            }
          ]
        });
        $("#tablePendonor_paginate").attr("style", "float:right;");
        $("#tablePendonor_filter").attr("style", "float:right;");
        $("#tablePendonor").on("click", "button", function() {
          router.push(
            "/master/pendonor/detail/" +
              dataTable.row($(this).closest("tr")).data().id
          );
        });
      });
    }
  }
};
</script>