<template>
  <div>
    <div class="container">
      <br>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h2>Tambah Data Admin</h2>
                  <form @submit.prevent="addAdmin()">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap</label>
                          <input
                            type="textfield"
                            class="form-control"
                            placeholder="Nama Lengkap"
                            id="txNamaLengkap"
                            required
                          >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input
                            type="email"
                            class="form-control"
                            placeholder="Email"
                            aria-describedby="emailHelp"
                            id="txEmail"
                            required
                          >
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea
                        type="textfield"
                        class="form-control"
                        placeholder="Alamat"
                        id="txAlamat"
                        required
                      ></textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Password</label>
                          <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            id="txPassword"
                            required
                          >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Konfirmasi Password</label>
                          <input
                            type="password"
                            class="form-control"
                            placeholder="Password"
                            id="txPasswordRe"
                            required
                          >
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-success" id="btnTambah">TAMBAH</button>
                  </form>
                  <div class="alert alert-danger" id="alertError" role="alert" hidden></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    addAdmin() {
      $("#btnTambah")
        .attr("disabled", "")
        .text("Memproses...");
      $("#alertError").attr("hidden", "");
      if ($("#txPassword").val() != $("#txPasswordRe").val()) {
        $("#alertError")
          .removeAttr("hidden")
          .text("Password tidak sama.");
        $("#btnTambah")
          .removeAttr("disabled")
          .text("TAMBAH");
      } else {
        console.log("posting data...");
        axios
          .post(this.pendonorApi + "admin", {
            nama_lengkap: $("#txNamaLengkap").val(),
            alamat: $("#txAlamat").val(),
            email: $("#txEmail").val(),
            password: $("#txPassword").val(),
            level: "REGULAR"
          })
          .then(response => {
            this.$router.push("/master/admin");
          })
          .catch(error => {
            console.log(error.response.data);
            $("#alertError")
              .removeAttr("hidden")
              .text("Koneksi bermasalah.");
          });
      }
    }
  }
};
</script>

