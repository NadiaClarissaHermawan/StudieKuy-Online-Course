<?php 
    class TopUpRequest {
        protected $id_transaksi_saldo, $tanggal_transaksi_saldo, $real_name, $nominal_pengisian, $saldo_awal, $saldo_akhir, $bukti_trf, $status_verifikasi, $id_member;

        public function __construct($id_transaksi_saldo, $tanggal_transaksi_saldo, $real_name, $nominal_pengisian, $saldo_awal, $saldo_akhir, $bukti_trf, $status_verifikasi, $id_member){
            $this->id_transaksi_saldo = $id_transaksi_saldo;
            $this->tanggal_transaksi_saldo = $tanggal_transaksi_saldo;
            $this->real_name = $real_name;
            $this->nominal_pengisian = $nominal_pengisian;
            $this->saldo_awal = $saldo_awal;
            $this->saldo_akhir = $saldo_akhir;
            $this->bukti_trf = $bukti_trf;
            $this->status_verifikasi = $status_verifikasi;
            $this->id_member = $id_member;
        }

        public function getID(){
            return $this->id_transaksi_saldo;
        }

        public function getTanggal(){
            return $this->tanggal_transaksi_saldo;
        }

        public function getRealName(){
            return $this->real_name;
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
        
        public function getBuktiTrf(){
            return $this->bukti_trf;
        }

        public function getStatus(){
            return $this->status_verifikasi;
        }

        public function getIDMember(){
            return $this->id_member;
        }
    }
?>