<?php 
    class TopUpReport{
        protected $id_transaksi_saldo, $tanggal_transaksi_saldo, $nominal_pengisian, $saldo_awal, $saldo_akhir, $status_verifikasi;

        public function __construct($id_transaksi_saldo, $tanggal_transaksi_saldo, $nominal_pengisian, $saldo_awal, $saldo_akhir, $status_verifikasi){
            $this->id_transaksi_saldo = $id_transaksi_saldo;
            $this->tanggal_transaksi_saldo = $tanggal_transaksi_saldo;
            $this->nominal_pengisian = $nominal_pengisian;
            $this->saldo_awal = $saldo_awal;
            $this->saldo_akhir = $saldo_akhir;
            $this->status_verifikasi = $status_verifikasi;
        }

        public function getIDTopUp(){
            return $this->id_transaksi_saldo;
        }

        public function getTanggalTopUp(){
            return $this->tanggal_transaksi_saldo;
        }

        public function getNominal(){
            return $this->nominal_pengisian;
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
    }
?>