<template>
  <div>
    <!-- modal riwayat -->
    <div class="modal fade" id="modalRiwayat" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Riwayat Pendonor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Tambah Riwayat</h4>
            <form @submit.prevent="addRiwayat()">
              <div class="form-group">
                <datepicker
                  placeholder="Tanggal Donor"
                  type="text"
                  id="datepickerTglDonorModal"
                  format="yyyy-MM-dd"
                  input-class="form-control bg-white"
                  required
                ></datepicker>
              </div>
              <div class="form-group">
                <textarea
                  placeholder="Keterangan"
                  type="textfield"
                  id="txKeteranganModal"
                  class="form-control"
                  required
                ></textarea>
              </div>
              <button class="btn btn-success" id="btnTambahModal">TAMBAH</button>
            </form>
            <div
              class="alert alert-danger"
              id="alertErrorModal"
              role="alert"
              hidden
            >Koneksi bermasalah.</div>
            <br>
            <h4>Data Riwayat</h4>
            <table class="table table-striped w-100" id="tableRiwayat">
              <thead class="bg-primary" style="color:#FFFFFF">
                <tr>
                  <th scope="col" style="width:2%">ID</th>
                  <th scope="col" style="width:30%">Tgl Donor</th>
                  <th scope="col" style="width:60%">Keterangan</th>
                  <th scope="col" style="width:7%">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal riwayat -->
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h3>Perbarui Pendonor</h3>
                  <div class="row">
                    <div class="col-md-10">
                      <small id="lbCreated">Data dibuat: 0000-00-00</small>
                      <br>
                      <small id="lbUpdated">Data diperbarui: 0000-00-00</small>
                    </div>
                    <div class="col-md-2">
                      <button
                        class="btn btn-success w-100"
                        @click="toggleModalRiwayat"
                      >RIWAYAT DONOR</button>
                    </div>
                  </div>
                  <form @submit.prevent="updatePendonor()" style="margin-top:15px">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input
                            id="txNamaLengkap"
                            type="textfield"
                            placeholder="Nama Lengkap"
                            class="form-control"
                            required
                          >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Telp</label>
                          <input
                            id="txTelp"
                            type="number"
                            placeholder="Telp"
                            class="form-control"
                            required
                          >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <select id="selectJenkel" class="form-control">
                            <option value="LAKI-LAKI">Laki-Laki</option>
                            <option value="PEREMPUAN">Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Umur</label>
                          <input
                            id="txUmur"
                            type="number"
                            placeholder="Umur"
                            class="form-control"
                            required
                          >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Alamat</label>
                              <textarea
                                id="txAlamat"
                                type="textfield"
                                placeholder="Alamat"
                                class="form-control"
                                required
                              ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label>Pekerjaan</label>
                              <input
                                id="txPekerjaan"
                                type="textfield"
                                placeholder="Pekerjaan"
                                class="form-control"
                                required
                              >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Golongan Darah</label>
                          <select id="selectGolonganDarah" class="form-control">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Resus</label>
                          <select id="selectResus" class="form-control">
                            <option value="POSITIF">Positif</option>
                            <option value="NEGATIF">Negatif</option>
                            <option value="-">Tidak Diketahui</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tentukan Garis Lintang (Latitude)</label>
                            <input
                              type="textfield"
                              id="txLat"
                              class="form-control"
                              placeholder="Latitude"
                              v-on:keydown.enter.prevent
                              required
                            >
                          </div>
                          <div class="form-group">
                            <label>Tentukan Garis Bujur (Longitude)</label>
                            <input
                              type="textfield"
                              id="txLng"
                              class="form-control"
                              placeholder="Longitude"
                              v-on:keydown.enter.prevent
                              required
                            >
                          </div>
                          <div class="form-group">
                            <label>Cari berdasarkan alamat</label>
                            <input
                              type="textfield"
                              id="txAlamatMap"
                              class="form-control"
                              placeholder="Cari berdasarkan alamat"
                              v-on:keydown.enter.prevent
                            >
                          </div>
                          <div class="form-group">
                            <div id="lokasiPiker" style="height: 400px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="alert alert-danger"
                      id="alertError"
                      role="alert"
                      hidden
                    >Koneksi bermasalah. Coba Lagi.</div>
                    <button type="submit" id="btnUpdate" class="btn btn-success">PERBARUI</button>
                    <button
                      type="submit"
                      id="btnDelete"
                      @click="deletePendonor"
                      class="btn btn-danger"
                    >HAPUS</button>
                  </form>
                </div>
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
export default {
  components: {
    Datepicker
  },
  data() {
    return {};
  },
  created() {
    this.loadDataPendonor();
    this.loadRiwayat();
  },
  methods: {
    toggleModalRiwayat(e) {
      e.preventDefault();
      $("#modalRiwayat").modal("toggle");
    },
    loadDataPendonor() {
      axios
        .get(this.pendonorApi + "pendonor/" + this.$route.params.id)
        .then(response => {
          console.log(response.data.result);
          $("#txNamaLengkap").val(response.data.result.nama_lengkap);
          $("#txTelp").val(response.data.result.telp);
          $("#txAlamat").val(response.data.result.alamat);
          $("#txUmur").val(response.data.result.umur);
          $("#txPekerjaan").val(response.data.result.pekerjaan);
          $("#selectJenkel").val(response.data.result.jenkel);
          $("#selectGolonganDarah").val(response.data.result.golongan_darah);
          $("#selectResus").val(response.data.result.resus);
          $("#lbCreated").text(
            "data dibuat: " + response.data.result.created_at
          );
          $("#lbUpdated").text(
            "data terakhir diperbarui: " + response.data.result.updated_at
          );
          $("#txLat").val(response.data.result.lat);
          $("#txLng").val(response.data.result.lng);
          this.setLocationPicker();
        });
    },
    setLocationPicker(lat, lng) {
      $("#lokasiPiker").locationpicker({
        location: {
          latitude: $("#txLat").val(),
          longitude: $("#txLng").val()
        },
        zoom: 16,
        inputBinding: {
          latitudeInput: $("#txLat"),
          longitudeInput: $("#txLng"),
          locationNameInput: $("#txAlamatMap"),
        },
        enableAutocomplete: true
      });
    },
    updatePendonor() {
      $("#btnUpdate")
        .attr("disabled", "")
        .text("Memproses...");
      $("#alertError").attr("hidden", "");
      axios
        .put(this.pendonorApi + "pendonor/" + this.$route.params.id, {
          nama_lengkap: $("#txNamaLengkap").val(),
          alamat: $("#txAlamat").val(),
          telp: $("#txTelp").val(),
          jenkel: $("#selectJenkel")
            .find(":selected")
            .val(),
          golongan_darah: $("#selectGolonganDarah")
            .find(":selected")
            .val(),
          resus: $("#selectResus")
            .find(":selected")
            .val(),
          umur: $("#txUmur").val(),
          pekerjaan: $("#txPekerjaan").val(),
          lat: $("#txLat").val(),
          lng: $("#txLng").val()
        })
        .then(response => {
          this.$router.push("/master/pendonor");
        })
        .catch(error => {
          $("#btnUpdate")
            .removeAttr("disabled")
            .text("PERBARUI");
          $("#alertError").removeAttr("hidden", "");
          console.log(error.response.data);
        });
    },
    deletePendonor(e) {
      e.preventDefault();
      swal({
        title: "Konfirmasi",
        text: "Hapus data ini ?",
        icon: "warning",
        buttons: ["BATAL", "HAPUS"],
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          $("#btnDelete")
            .attr("disabled", "")
            .text("Proses...");
          axios
            .delete(this.pendonorApi + "pendonor/" + this.$route.params.id)
            .then(response => {
              $("#modalDelete").modal("toggle");
              this.$router.push("/master/pendonor");
            })
            .catch(error => {
              console.log(error.response.data);
            });
        }
      });
    },
    loadRiwayat() {
      let pendonorApi = this.pendonorApi;
      let router = this.$router;
      let pendonorId = this.$route.params.id;
      $(document).ready(function() {
        let dataTable = $("#tableRiwayat").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: pendonorApi + "riwayat/pendonor/datatable/show/" + pendonorId,
            type: "GET"
          },
          columns: [
            { data: "id" },
            { data: "tgl_donor" },
            { data: "keterangan" },
            {
              render: function(data, type, full, meta) {
                return "<button class='btn btn-danger'>Hapus</button>";
              }
            }
          ]
        });
        $("#tableRiwayat_paginate").attr("style", "float:right;");
        $("#tableRiwayat_filter").attr("style", "float:right;");
        $("#tableRiwayat").on("click", "button", function() {
          prepareDelete(dataTable.row($(this).closest("tr")).data().id);
        });
        function prepareDelete(id) {
          swal({
            title: "Konfirmasi",
            text: "Hapus data ini ?",
            icon: "warning",
            buttons: ["BATAL", "HAPUS"],
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              axios.delete(pendonorApi + "riwayat/" + id).then(response => {
                $("#tableRiwayat")
                  .DataTable()
                  .ajax.reload();
              });
            }
          });
        }
      });
    },
    addRiwayat() {
      $("#btnTambahModal")
        .attr("disabled", "")
        .text("Memproses...");
      $("#alertErrorModal").attr("hidden", "");
      axios
        .post(this.pendonorApi + "riwayat", {
          tgl_donor: $("#datepickerTglDonorModal").val(),
          keterangan: $("#txKeteranganModal").val(),
          pendonor_id: this.$route.params.id
        })
        .then(response => {
          $("#btnTambahModal")
            .removeAttr("disabled")
            .text("TAMBAH");
          $("#tableRiwayat")
            .DataTable()
            .ajax.reload();
          $("#datepickerTglDonorModal").val("");
          $("#txKeteranganModal").val("");
        })
        .catch(error => {
          $("#alertErrorModal").removeAttr("hidden");
          $("#btnTambahModal")
            .removeAttr("disabled")
            .text("TAMBAH");
        });
    }
  }
};
</script>
