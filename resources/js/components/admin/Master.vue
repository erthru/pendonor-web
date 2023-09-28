<style>
.sidenav {
  margin-bottom: -5000px;
  padding-bottom: 5000px;
  width: 0px;
  position: absolute;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #e03e3c;
  overflow-x: hidden;
  padding-top: 52px;
  transition: 0.5s;
}

.sidenav a {
  padding: 8px 8px 8px 42px;
  text-decoration: none;
  font-size: 19px;
  color: #ffffff;
  display: block;
  transition: 0.3s;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.sidebar-item {
    margin-top: -10px;
    margin-bottom: -10px;
}

.sidebar-item-img{
    margin-top:6px;
}

@media screen and (max-height: 450px) {
  .sidenav {
    padding-top: 15px;
  }
  .sidenav a {
    font-size: 18px;
  }
}
</style>
<template>
  <div style="background-color:#FAFAFA; overflow: auto; height:100%">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
          <button
            type="button"
            style="background-color: Transparent; background-repeat:no-repeat; border: none;"
            v-on:click="toggleNav()"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#" style="margin-left:20px">DASHBOARD ADMIN</a>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <router-link
                id="navAdmin"
                class="nav-link"
                :to="'/master/admin/detail/'+adminId"
              >Hai, Admin</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/logout">Logout</router-link>
            </li>
          </ul>
        </nav>
        <div id="sidebar" class="sidenav">
          <router-link
            @click.native="toggleNav()"
            to="#"
            class="closebtn"
            onclick="closeNav()"
          >&times;</router-link>
          <br>
          <div class="container">
              <div class="row sidebar-item">
                  <div class="col-md-2">
                      <img class="sidebar-item-img" :src="this.asset+'images/img_people_collection.png'" height="32" widht="32" style="margin-left:30">
                  </div>
                  <div class="col-md-10">
                      <router-link to="/master/pendonor" @click.native="toggleNav()" style="margin-left:-11">Pendonor</router-link>
                  </div>
              </div>
              <hr>
              <div class="row sidebar-item">
                  <div class="col-md-2">
                      <img class="sidebar-item-img" :src="this.asset+'images/img_admin.png'" height="32" widht="32" style="margin-left:30">
                  </div>
                  <div class="col-md-10">
                      <router-link to="/master/admin" @click.native="toggleNav()" id="routerAdmin" style="margin-left:-11">Admin</router-link>
                  </div>
              </div>
              <hr>
              <div class="row sidebar-item">
                  <div class="col-md-2">
                      <img class="sidebar-item-img" :src="this.asset+'images/img_user_side.png'" height="32" widht="32" style="margin-left:30">
                  </div>
                  <div class="col-md-10">
                      <router-link to="/master/pengguna" @click.native="toggleNav()" style="margin-left:-11">Pengguna</router-link>
                  </div>
              </div>
              <hr>
              <div class="row sidebar-item">
                  <div class="col-md-2">
                      <img class="sidebar-item-img" :src="this.asset+'images/img_info.png'" height="32" widht="32" style="margin-left:30">
                  </div>
                  <div class="col-md-10">
                      <router-link to="/master/informasi_umum" @click.native="toggleNav()" style="margin-left:-11">Informasi Umum</router-link>
                  </div>
              </div>
              <hr>
              <div class="row sidebar-item">
                  <div class="col-md-2">
                      <img class="sidebar-item-img" :src="this.asset+'images/img_report.png'" height="32" widht="32" style="margin-left:30">
                  </div>
                  <div class="col-md-10">
                      <router-link to="/master/laporan" @click.native="toggleNav()" style="margin-left:-11">Laporan</router-link>
                  </div>
              </div>
              <hr>
          </div>
        </div>
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      onToggle: false,
      adminId: 0
    };
  },
  created() {
    this.loadAdminDetail();
    if (localStorage.getItem("id") == null) {
      this.$router.push("/login");
    }
  },
  methods: {
    toggleNav() {
      if (this.onToggle) {
        $("#sidebar").attr("style", "width:0px");
        this.onToggle = false;
      } else {
        $("#sidebar").attr("style", "width:300px");
        this.onToggle = true;
      }
    },
    loadAdminDetail() {
      let id = localStorage.getItem("id");
      axios.get(this.pendonorApi + "admin/" + id).then(response => {
        $("#navAdmin").text("Hai, " + response.data.result.nama_lengkap);
        this.adminId = response.data.result.id;
        if (response.data.result.level != "ADMIN") {
          $("#routerAdmin").attr("hidden", "");
        }
      });
    }
  }
};
</script>