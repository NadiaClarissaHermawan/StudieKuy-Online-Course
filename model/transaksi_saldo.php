<?php 
    class Transaksi_Saldo{
        protected $saldo_awal, $saldo_akhir, $status_verifikasi, $tanggal_transaksi_saldo, $nominal_pengisian, $saldo;

        public function __construct($saldo_awal, $saldo_akhir, $status_verifikasi, $tanggal_transaksi_saldo, $nominal_pengisian, $saldo){
            $this->saldo_awal= $saldo_awal;
            $this->saldo_akhir = $saldo_akhir;
            $this->status_verifikasi = $status_verifikasi;
            $this->tanggal_transaksi_saldo = $tanggal_transaksi_saldo;
            $this->nominal_pengisian = $nominal_pengisian;
            $this->saldo = $saldo;
        }

        public function getSaldoAwal(){
            return $this->saldo_awal;
        }

        public function getSaldoAkhir(){
            return $this->saldo_akhir;
        }

        public function getStatusVerifikasi(){
            return $this->status_verifikasi;
        }

        public function getTanggal(){
            return $this->tanggal_transaksi_saldo;
        }

        public function getNominal(){
            return $this->nominal_pengisian;
        }

        public function getSaldo(){
            return $this->saldo;
        }
    }
?>