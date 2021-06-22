<?php 
    class TransactionCourseReport{
        protected $id_transaksi, $tanggal, $harga_course, $saldo_awal, $saldo_akhir, $nama_course;

        public function __construct($id_transaksi, $tanggal, $harga_course, $saldo_awal, $saldo_akhir, $nama_course){
            $this->id_transaksi = $id_transaksi;
            $this->tanggal = $tanggal;
            $this->harga_course = $harga_course;
            $this->saldo_awal = $saldo_awal;
            $this->saldo_akhir = $saldo_akhir;
            $this->nama_course = $nama_course;
        }

        public function getIdTransaksi(){
            return $this->id_transaksi;
        }

        public function getTanggal(){
            return $this->tanggal;
        }
        public function getHarga(){
            return $this->harga_course;
        }
        public function getSaldoAwal(){
            return $this->saldo_awal;
        }
        public function getSaldoAkhir(){
            return $this->saldo_akhir;
        }
        public function getNamaCourse(){
            return $this->nama_course;
        }
    }
?>