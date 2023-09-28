<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="card">
            <div class="card-body">
              <h2>Perbarui Informasi Umum</h2>
              <form @submit.prevent="updateInformasiUmum()">
                <div class="form-group">
                  <label>Judul</label>
                  <input
                    type="textfield"
                    placeholder="Judul"
                    class="form-control"
                    id="txJudul"
                    required
                  >
                </div>
                <div class="form-group">
                  <label>Konten</label>
                  <textarea
                    name="txKonten"
                    placeholder="Konten"
                    class="form-control"
                    id="txKonten"
                    required
                  ></textarea>
                </div>
                <label>Click Gambar Untuk Perbarui Thumbnail</label>
                <br>
                <input type="file" id="fileThumbnail" @change="updateThumbnail()" hidden>
                <div id="loadingThumbnail" class="spinner-border text-primary" role="status" hidden></div>
                <img
                  id="imgThumbnail"
                  onclick="$('#fileThumbnail').click()"
                  src
                  width="250px"
                  height="250px"
                >
                <br>
                <br>
                <button class="btn btn-success" id="btnUpdate">PERBARUI</button>
                <button class="btn btn-danger" @click="deleteInformasiUmum" id="btnDelete">HAPUS</button>
              </form>
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
    this.setKontenEditor();
    this.loadInformasiUmum();
  },
  methods: {
    setKontenEditor() {
      $(document).ready(function() {
        CKEDITOR.replace("txKonten");
      });
    },
    loadInformasiUmum() {
      axios
        .get(this.pendonorApi + "informasi_umum/" + this.$route.params.id)
        .then(response => {
          $("#txJudul").val(response.data.result.judul);
          CKEDITOR.instances["txKonten"].document.$.body.innerHTML =
            response.data.result.konten;
          $("#imgThumbnail").attr(
            "src",
            this.asset+"/uploads/" + response.data.result.thumbnail
          );
        });
    },
    updateThumbnail() {
      $("#loadingThumbnail").removeAttr("hidden");
      $("#imgThumbnail").attr("hidden", "");
      let data = new FormData();
      data.append("thumbnail", $("#fileThumbnail").prop("files")[0]);
      axios
        .post(
          this.pendonorApi +
            "informasi_umum/thumbnail/" +
            this.$route.params.id,
          data,
          {
            headers: {
              "content-type": "multipart/form-data"
            }
          }
        )
        .then(response => {
          $("#loadingThumbnail").attr("hidden", "");
          $("#imgThumbnail").removeAttr("hidden");
          $("#imgThumbnail").attr(
            "src",
            this.asset+"/uploads/" + response.data.result.thumbnail
          );
        })
        .catch(error => {
          console.log(error.response.data);
        });
    },
    updateInformasiUmum() {
      $("#btnUpdate")
        .attr("disabled", "")
        .text("Memproses...");
      axios
        .put(this.pendonorApi + "informasi_umum/" + this.$route.params.id, {
          judul: $("#txJudul").val(),
          konten: CKEDITOR.instances["txKonten"].document.$.body.innerHTML,
          admin_id: localStorage.getItem("id")
        })
        .then(response => {
          this.$router.push("/master/informasi_umum");
        });
    },
    deleteInformasiUmum(e) {
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
            .text("Memproses...");
          axios
            .delete(this.pendonorApi + "informasi_umum/" + this.$route.params.id)
            .then(response => {
              this.$router.push("/master/informasi_umum");
            });
        }
      });
    }
  }
};
</script>

