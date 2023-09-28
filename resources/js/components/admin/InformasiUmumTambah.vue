<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="card">
            <div class="card-body">
              <h2>Tambah Informasi Umum</h2>
              <form @submit.prevent="addInformasiUmum()">
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
                <label>Thumbnail</label>
                <br>
                <input type="file" id="fileThumbnail">
                <br>
                <br>
                <button class="btn btn-success" id="btnTambah">TAMBAH</button>
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
  },
  methods: {
    setKontenEditor() {
      $(document).ready(function() {
        CKEDITOR.replace("txKonten");
      });
    },
    addInformasiUmum() {
      $("#btnTambah")
        .attr("disabled", "")
        .text("Memproses...");
      let data = new FormData();
      data.append("judul", $("#txJudul").val());
      data.append(
        "konten",
        CKEDITOR.instances["txKonten"].document.$.body.innerHTML
      );
      data.append("thumbnail", $("#fileThumbnail").prop("files")[0]);
      data.append("admin_id", localStorage.getItem("id"));
      axios
        .post(this.pendonorApi + "informasi_umum", data, {
          headers: {
            "content-type": "multipart/form-data"
          }
        })
        .then(response => {
          this.$router.push("/master/informasi_umum");
        });
    }
  }
};
</script>

