<script>
export default {
  created() {
    localStorage.removeItem("id");
    this.$router.push("/");
  }
};
</script>