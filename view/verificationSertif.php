<div class="content1">
    <div class="tulisanPutih hurufSedang">Sertificate Verification</div>
</div>
<div class="table">
    <table id="sertif">
        <tr>
            <th>Id Course</th>
            <th>Nama</th>
            <th>Nama Course</th>
            <th>Nilai Ujian</th>
            <th>Nilai Minimum</th>
            <th>Verifikasi</th>
        </tr>
        <!-- Test Contoh -->
        <tr>
            <td>1</td>
            <td>Tasha</td>
            <td>Java Basic Programming</td>
            <td>90</td>
            <td>50</td>
            <td class="button">
                <button type="submit" class="button-kiri">Accept</button>
                <button type="submit" class="button-kanan">Reject</button>
            </td>
        </tr>

        <tr>
            <td>1</td>
            <td>Natasha Benedicta Bunnardi</td>
            <td>Java Basic Programming</td>
            <td>85</td>
            <td>50</td>
            <td class="button">
                <button class="button-verified">Verified</button>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td>Tasha Boen</td>
            <td>Hukum Tenaga Kerja</td>
            <td>55</td>
            <td>60</td>
            <td class="button">
                <button class="button-rejected">Rejected</button>
            </td>
        </tr>

        <!-- Coba pke php -->
        
        <tr>
            <td>3</td>
            <td>Tasha Boen</td>
            <td>Hukum Tenaga Kerja</td>
            <td>55</td>
            <td>60</td>
            <?php
                $statusVerif = 0;

                if(isset($_SESSION['status']) == false){
                    echo 
                    '<td class="button">
                        <button class="button-kiri">Accept</button>
                        <button class="button-kanan">Reject</button>
                    </td>';
                }
                else{
                    
                }
            ?>
            
        </tr>
    </table>
</div>