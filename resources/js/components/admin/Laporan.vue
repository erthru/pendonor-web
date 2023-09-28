<template>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>Laporan</h2>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-5">
                                        <select class="form-control" id="selectBulan">
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select class="form-control" id="selectTahun">
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success w-100" id="btnCari" v-on:click="cari()">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="divContent" hidden>
                            <br>
                            <br>
                            <h4>Banyaknya pencarian berdasarkan golongan darah (by bulan dan tahun)</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td>Banyaknya pencarian</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A</td>
                                        <td>{{ byTglA }}</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>{{ byTglB }}</td>
                                    </tr>
                                    <tr>
                                        <td>AB</td>
                                        <td>{{ byTglAB }}</td>
                                    </tr>
                                    <tr>
                                        <td>O</td>
                                        <td>{{ byTglO }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <h4>Banyaknya pencarian berdasarkan golongan darah (keseluruhan)</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Golongan Darah</td>
                                        <td>Banyaknya pencarian</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A</td>
                                        <td>{{ allA }}</td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>{{ allB }}</td>
                                    </tr>
                                    <tr>
                                        <td>AB</td>
                                        <td>{{ allAB }}</td>
                                    </tr>
                                    <tr>
                                        <td>O</td>
                                        <td>{{ allO }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <h4>Riwayat Donor</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Donor dari</td>
                                        <td>Keterangan</td>
                                        <td>Tgl Donor</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="riwayat in riwayats" :key="riwayat.id">
                                        <td>{{ riwayat.pendonor.nama_lengkap }}</td>
                                        <td>{{ riwayat.keterangan }}</td>
                                        <td>{{ riwayat.tgl_donor }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        <button id="btnPrint" class="btn btn-success" style="float:right" v-print="'#divContent'" hidden>Cetak</button>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                byTglA: 0,
                byTglB: 0,
                byTglAB: 0,
                byTglO: 0,
                allA: 0,
                allB: 0,
                allAB: 0,
                allO: 0,
                riwayats: []
            }
        },
        created(){
            this.loadTahun();
        },
        methods:{
            loadTahun(){
                axios.get(this.pendonorApi+"custom/stok/darah").then(response=>{
                   let tahun = response.data.data.tahun;
                   console.log(tahun);
                   for(let i=0; i<tahun.length; i++){
                       console.log(tahun[i].tahun);
                       $("#selectTahun").append("<option value="+tahun[i].tahun+">"+tahun[i].tahun+"</option>");
                   }
                });
            },
            cari(){
                $("#divContent").removeAttr("hidden");
                $("#btnPrint").removeAttr("hidden");
                let bulan = $("#selectBulan").find(":selected").val();
                let tahun = $("#selectTahun").find(":selected").val();
                let tgl = tahun+"-"+bulan+"-01";
                console.log(tgl);
                
                axios.get(this.pendonorApi+"search_history/by_tgl?tgl="+tgl).then(response=>{
                    console.log(response.data);
                    this.byTglA = response.data.data.A;
                    this.byTglB = response.data.data.B;
                    this.byTglAB = response.data.data.AB;
                    this.byTglO = response.data.data.O;
                });
                
                axios.get(this.pendonorApi+"search_history").then(response=>{
                    console.log(response.data);
                    this.allA = response.data.data.A;
                    this.allB = response.data.data.B;
                    this.allAB = response.data.data.AB;
                    this.allO = response.data.data.O;
                });
                
                axios.get(this.pendonorApi+"riwayat/by/tgl?tgl="+tgl).then(response=>{
                    console.log(response.data);
                    this.riwayats = response.data.result;
                });
            }
        }
    }
</script>