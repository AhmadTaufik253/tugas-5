<?php
class Pegawai{
    protected $nip;
    public $nama;
    private $jabatan;
    private $agama;
    private $status;
    static $jml = 0;
    const PT = 'PT. HTP Indonesia';

    public function __construct($nip,$nama,$jabatan,$agama,$status){
        $this->nip = $nip;
        $this->nama = $nama;
        $this->jabatan = $jabatan;
        $this->agama = $agama;
        $this->status = $status;
        self::$jml++;
    }

    public function setGajiPokok($jabatan){
        $this->jabatan = $jabatan;
        switch ($jabatan) {
            case 'Manager': $gapok = 15000000; break;
            case 'Asisten Manager': $gapok = 10000000; break;
            case 'Kepala Bagian': $gapok = 7000000; break;
            case 'Staff': $gapok = 5000000; break;
            default: $gapok;
        }
        return $gapok;
    }

    public function setTunjab($gapok){
        $tunjab = 0.2*$gapok;
        return $tunjab;
    }

    public function setTunkel($gapok, $status){
        $tunkel = $status == 'Menikah' ? 0.1 * $gapok : 0;
        return $tunkel;    

    }

    public function setZakatProfesi($gapok, $agama){
        $gaji_kotor = $gapok + $this->setTunjab($gapok) + $this->setTunkel($gapok, $this->status);
        $zakat = ($agama == 'Islam' && $gaji_kotor >= 6000000) ? 0.025 * $gapok : 0;
        return $zakat;
    }

    public function cetak(){
        $gapok = $this->setGajiPokok($this->jabatan);


        echo 'NIP Pegawai : '.$this->nip;
        echo '<br>Nama Pegawai : '.$this->nama;
        echo '<br>Jabatan : '.$this->jabatan;
        echo '<br>Agama : '.$this->agama;
        echo '<br>Status : '.$this->status;
        // echo '<br>Gaji Pokok : '.$this->setGajiPokok($this->jabatan);
        echo '<br>Gaji Pokok : '.$gapok;
        echo '<br>Tunjangan Jabatan : '.$this->setTunjab($gapok);
        echo '<br>Tunjangan Keluarga : '.$this->setTunkel($gapok, $this->status);
        echo '<br>Zakat : '.$this->setZakatProfesi($gapok, $this->agama);
        echo '<br>Gaji Bersih : '.($gapok + $this->setTunjab($gapok) + $this->setTunkel($gapok, $this->status) - $this->setZakatProfesi($gapok, $this->agama));
        echo '<hr>';
    } 
}
?>

<!-- 
    Lengkapi file Pegawai. php sebagai berikut:
    1. setTunjab = 20% dari Gaji Pokok
    2. setTunkel= 10% dari Gaji Pokok untuk sudah menikah (ternary)
    3. setZakatProfesi= 2,5% dari GajiPokok untuk muslim dan Gaji Kotor minimal 6jt
    4. mencetak => nip, nama, jabatan, agama, status, Gaji Pokok, Tunj Jab, Tunkel, Zakat Gaji Bersih 
-->