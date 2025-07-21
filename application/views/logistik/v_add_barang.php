<style>
  /* .table-condensed{
    font-size: 14px;
  }
  th {
    font-size: 16px;
  } */
</style>
<?php
    date_default_timezone_set('Asia/Jakarta');
    // $user = $this->m_user->get_all_data();
    function format_hari_tanggal($waktu)
    {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date( 'H:i:s', strtotime($waktu));
        
        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";
    
        //untuk menampilkan hari, tanggal bulan tahun
        return "$tanggal-$bulan-$tahun";
    }

    function format_hari_tanggal1($waktu)
    {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];
        $tanggal = date('j', strtotime($waktu));
        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];
        $tahun = date('Y', strtotime($waktu));
        $jam = date( 'H:i', strtotime($waktu));
        
        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";
    
        //untuk menampilkan hari, tanggal bulan tahun
        return "$tanggal-$bulan-$tahun $jam";
    }
?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Form Barang</h3>

        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="messages"></div>
          
            <?php if($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>
                <?php echo $this->session->flashdata('success'); ?>
                </h5>
              </div>
            <?php elseif($this->session->flashdata('error')): ?>
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="bi bi-x-circle-fill"></i>
                <?php echo $this->session->flashdata('error'); ?>
                </h5>
              </div>
            <?php endif; ?>

            <?php
              if (isset($error_upload)) {
                  echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i>'.$error_upload.'<h5></div>';
              }
            ?>

            <form enctype="multipart/form-data" action="<?php echo base_url('Logistik/createBarang') ?>" method="POST" id="createForm">

            <div class="modal-body">
              <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <video id="previewKamera" style="width: 300px;height: 300px;"></video>
                      <select id="pilihKamera" style="max-width:400px"></select>
                  </div>

                  <div class="form-group">
                      <label for="brand_name">Kode Barang</label>
                      <input type="text" id="hasilscan" name="kode_barang" class="form-control" placeholder="Kode Barang">
                      <button type="button" id="btn_scan" class="btn btn-primary"  onclick="initScanner()" style="display: none;">Scan</button>
                      <button type="button" id="btn_clear" class="btn btn-danger">Bersihkan</button>
                  </div>

                  <div class="form-group">
                    <label for="brand_name">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" autocomplete="off">
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Spesifikasi Barang</label>
                    <textarea class="form-control" id="spesifikasi_barang" name="spesifikasi_barang" rows="3"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="category">Kategori</label>
                    <select class="form-control select_group" id="kategori" name="kategori">
                      <?php foreach ($kategori as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_kategori'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="category">Satuan</label>
                    <select class="form-control select_group" id="satuan" name="satuan">
                      <?php foreach ($satuan as $s => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_satuan'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Foto Barang</label>
                    <input type="file" name="userfile" class="form-control" id="preview_gambar1" required>
                  </div>

                  <div class="form-group">
                      <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load1" width="300px">
                  </div>

                  
                </div>
              </div>
              </div>
            </div>

            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button> -->
              <a href="<?php echo base_url('Logistik/barang') ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // $('#hasilscan').val("").focus();
        $('#hasilscan').keyup(function(e){
        var tex = $(this).val();
        if(tex !=="" || e.keyCode===13){
            $('#hasilscan').val(tex).focus();
            cari();
            // $.ajax({
            // type: 'POST',
            // //   url: 'cari.php',
            // url: 'fetchBarangDataByKode/'+tex,
            // //   data: {"hasilscan":tex},
            // dataType: 'json',
            // beforeSend:function(response) {
            //     $('#message_info').html("Sedang memproses data, silahkan tunggu...");
            //     swal({
            //         title:"", 
            //         text:"Loading...",
            //         icon: "<?= base_url() ?>assets/img/load.gif",
            //         buttons: false,      
            //         closeOnClickOutside: false,
            //         // timer: 3000,
            //         //icon: "success"
            //     });
            // },
            // success:function(response) {
            //     swal.close();
            //     $('#message_info').html('');
            //     $("#kode_barang").val(response.kode_barang);
            //     $("#nama_barang").val(response.nama_barang);
            //     $("#spesifikasi_barang").val(response.spesifikasi);
            //     $("#kategori").val(response.kategori);
            //     $("#satuan").val(response.satuan);
            //     var image = document.getElementById('gambar_load'); 
            //         image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
            // }
            // });
        }
        // if(tex !=="" && e.keyCode===13){
        //     $('#hasilscan').val(tex).focus();
        //     $.ajax({
        //     type: 'POST',
        //     //   url: 'cari.php',
        //     url: 'fetchBarangDataByKode/'+tex,
        //     //   data: {"hasilscan":tex},
        //     dataType: 'json',
        //     beforeSend:function(response) {
        //         $('#message_info').html("Sedang memproses data, silahkan tunggu...");
        //     },
        //     success:function(response) {
        //         $('#message_info').html('');
        //         $("#kode_barang").val(response.kode_barang);
        //         $("#nama_barang").val(response.nama_barang);
        //         $("#spesifikasi_barang").val(response.spesifikasi);
        //         $("#kategori").val(response.kategori);
        //         $("#satuan").val(response.satuan);
        //         var image = document.getElementById('gambar_load'); 
        //             image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
        //     }
        //     });
        // }
        e.preventDefault();
        });
        $('#btn_clear').click(function(){
            $('#hasilscan').val("").focus();
        });
    });

    function cari() {       
        var tex = document.getElementById("hasilscan").value;
        if(tex !==""){
            // document.getElementById("hasilscan").val(tex).focus();
            $.ajax({
            type: 'POST',
            //   url: 'cari.php',
            url: 'fetchBarangDataByKode/'+tex,
            //   data: {"hasilscan":tex},
            dataType: 'json',
            beforeSend:function(response) {
                // $('#message_info').html("Sedang memproses data, silahkan tunggu...");
                swal({
                    title:"", 
                    text:"Sedang memproses data, silahkan tunggu...",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    // icon: "<?= base_url() ?>assets/img/load.gif",
                    buttons: false,      
                    closeOnClickOutside: false,
                    timer: 30000,
                    //icon: "success"
                });
                
            },
            success:function(response) {
                swal.close()
                $('#message_info').html('');
                $("#kode_barang").val(response.kode_barang);
                $("#nama_barang").val(response.nama_barang);
                $("#spesifikasi_barang").val(response.spesifikasi);
                $("#kategori").val(response.kategori);
                $("#satuan").val(response.satuan);
                var image = document.getElementById('gambar_load'); 
                    image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
            },
            error: function(response){
                playSound2();
                swal({
                    title: "Informasi",
                    text: "Data tidak ditemukan",
                    icon: "error",
                    timer: "3000",
                    buttons: false,
                });
            }
            });
        }
    }

    function playSound1() {
    var audio = new Audio('http://codeskulptor-demos.commondatastorage.googleapis.com/GalaxyInvaders/alien_shoot.wav');
        audio.play();
    }

    function playSound2() {
    var audio = new Audio('http://commondatastorage.googleapis.com/codeskulptor-assets/jump.ogg');
        audio.play();
    }
</script>

<script>
    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const sourceSelect = $("#pilihKamera");

    $(document).on('change','#pilihKamera',function(){
        selectedDeviceId = $(this).val();
        if(codeReader){
            codeReader.reset()
            initScanner()
        }
    })

    function initScanner() {
        codeReader
        .listVideoInputDevices()
        .then(videoInputDevices => {
            videoInputDevices.forEach(device =>
                console.log(`${device.label}, ${device.deviceId}`)
            );

            if(videoInputDevices.length > 0){
                
                if(selectedDeviceId == null){
                    if(videoInputDevices.length > 1){
                        selectedDeviceId = videoInputDevices[1].deviceId
                    } else {
                        selectedDeviceId = videoInputDevices[0].deviceId
                    }
                }
                
                
                if (videoInputDevices.length >= 1) {
                    sourceSelect.html('');
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        if(element.deviceId == selectedDeviceId){
                            sourceOption.selected = 'selected';
                        }
                        sourceSelect.append(sourceOption)
                    })
            
                }

                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {

                            //hasil scan
                            console.log(result.text)
                            $("#hasilscan").val(result.text);
                            playSound1();
                            cari();
                            document.getElementById('btn_scan').style.display = 'block';
                        
                            if(codeReader){
                                codeReader.reset()
                            }
                    })
                    .catch(err => console.error(err));
                
            } else {
                alert("Camera not found!")
            }
        })
        .catch(err => console.error(err));
    }


    if (navigator.mediaDevices) {
        

        initScanner()
        

    } else {
        alert('Cannot access camera.');
    }
    
</script>

<script>
  function bacaGambar1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $("#gambar_load1").attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
          
      }
  }

  $("#preview_gambar1").change(function() {
      bacaGambar1(this); 
  });


  function editbacaGambar1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $("#edit_gambar_load1").attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
          
      }
  }

  $("#edit_preview_gambar1").change(function() {
      editbacaGambar1(this); 
  });
</script>