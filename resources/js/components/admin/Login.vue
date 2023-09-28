<template>
  <div>
    <div class="row">
      <div class="col-md-5 mx-auto">
        <br>
        <br>
        <br>
        <br>
        <div class="card bg-white mb-3">
          <div class="card-header bg-primary" style="color:white">ADMINISTRATOR LOGIN</div>
          <div class="p-4">
            <form @submit.prevent="auth()">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input
                  type="email"
                  class="form-control"
                  id="txEmail"
                  aria-describedby="emailHelp"
                  placeholder="Enter email"
                  required
                >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="txPassword"
                  placeholder="Password"
                  required
                >
              </div>
              <button type="submit" id="btnLogin" class="btn btn-success">LOGIN</button>
            </form>
            <div
              class="alert alert-danger"
              id="alertFail"
              role="alert"
              hidden
            >Login gagal. Cek Email atau Password</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    if (localStorage.getItem("id") != null) {
      this.$router.push("/master");
    }
  },
  methods: {
    auth() {
      $("#btnLogin")
        .attr("disabled", "")
        .text("Memproses..");
      $("#alertFail").attr("hidden", "");
      axios
        .post(this.pendonorApi + "admin/login", {
          email: $("#txEmail").val(),
          password: $("#txPassword").val()
        })
        .then(response => {
          console.log(response.data.msg);
          if (response.data.msg == "success.") {
            localStorage.setItem("id", response.data.result.id);
            this.$router.push("/master");
          } else {
            $("#btnLogin")
              .removeAttr("disabled")
              .text("LOGIN");
            $("#alertFail").removeAttr("hidden");
          }
        })
        .catch(error => {
          console.log(error.response.data);
        });
    }
  }
};
</script>