<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h3>Tambah Pendonor</h3>
                  <form @submit.prevent="addPendonor()" style="margin-top:15px">
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
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Tentukan Garis Lintang (Latitude)</label>
                          <input
                            type="textfield"
                            id="txLat"
                            class="form-control"
                            placeholder="Latitude"
                            value="0.5367302"
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
                            value="123.0592347"
                            v-on:keydown.enter.prevent
                            required
                          >
                        </div>
                        <div class="form-group">
                          <label>Cari berdasarkan alamat</label>
                          <input
                            type="text"
                            id="txAlamatMap"
                            class="form-control"
                            placeholder="Input alamat"
                            v-on:keydown.enter.prevent
                          >
                        </div>
                        <div class="form-group">
                          <div id="lokasiPiker" style="height: 400px;"></div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Tgl Terakhir Donor (optional)</label>
                          <datepicker
                            placeholder="Tanggal Terakhir Donor"
                            type="text"
                            id="datePickerTglDonor"
                            format="yyyy-MM-dd"
                            input-class="form-control bg-white"
                          ></datepicker>
                        </div>
                      </div>
                    </div>
                    <div
                      class="alert alert-danger"
                      id="alertError"
                      role="alert"
                      hidden
                    >Koneksi bermasalah. Coba Lagi.</div>
                    <button type="submit" id="btnTambah" class="btn btn-success">TAMBAH</button>
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
  created() {
    this.prepareMap();
  },
  methods: {
    prepareMap() {
      $(document).ready(function() {
        console.log("preparing map");
        setMap();
      });
      function setMap() {
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
          enableAutocomplete: true,
        });
      }
    },
    addPendonor() {
      $("#btnTambah")
        .attr("disabled", "")
        .text("Memproses...");
      $("#alertError").attr("hidden", "");
      axios
        .post(this.pendonorApi + "pendonor/checkdata", {
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
        })
        .then(response => {
          if(!response.data.result){
              this.realAddPendonor();
          }else{
              swal("Kesalahan", "Data yang sama persis telah terdaftar.");
              $("#btnTambah")
                .removeAttr("disabled")
                .text("TAMBAH");
          }
          console.log(response);
        })
    },
    addRiwayat(pendonor_id) {
      axios
        .post(this.pendonorApi + "riwayat", {
          tgl_donor: $("#datePickerTglDonor").val(),
          keterangan: "Inputan data baru.",
          pendonor_id: pendonor_id
        })
        .then(response => {
          this.$router.push("/master/pendonor");
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    realAddPendonor(){
        axios
            .post(this.pendonorApi + "pendonor", {
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
              lng: $("#txLng").val(),
            })
            .then(response => {
              if ($("#datePickerTglDonor").val() == "") {
                let router = this.$router;
                swal({
                    title: "Sukses",
                    text: "Pendonor ditambahkan",
                    icon: "success"
                }).then((ok) => {
                    router.push("/master/pendonor");
                });
              } else {
                this.addRiwayat(response.data.result.id);
              }
            })
            .catch(error => {
              $("#btnTambah")
                .removeAttr("disabled")
                .text("TAMBAH");
              $("#alertError").removeAttr("hidden", "");
              console.log(error.response.data);
            });
    }
  }
};
</script>
