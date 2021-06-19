<div class="content1">
    <div class="tulisanPutih hurufBesar">Course Transaction Verification</div>
</div>
<div class="table">
    <table>
        <tr>
            <th>Id Transaksi</th>
            <th>Nama</th>
            <th>Nama Course</th>
            <th>Harga Course</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Verifikasi</th>
        </tr>
        <!-- Test Contoh -->
        <tr>
            <td>1</td>
            <td>Tasha</td>
            <td>Java Basic Programming</td>
            <td>50.000</td>
            <td>50.000</td>
            <td>0</td>
            <td class="button">
                <button type="submit" class="button-kiri">Accept</button>
                <button type="submit" class="button-kanan">Reject</button>
            </td>
        </tr>

        <tr>
            <td>2</td>
            <td>Tasha Boen</td>
            <td>Pengantar Hukum Indonesia</td>
            <td>60.000</td>
            <td>120.000</td>
            <td>60.000</td>
            <td class="button">
                <button class="button-verified">Verified</button>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td>Natasha</td>
            <td>Apa itu Seni</td>
            <td>45.000</td>
            <td>30.000</td>
            <td>0</td>
            <td class="button">
                <button class="button-rejected">Rejected</button>
            </td>
        </tr>
    </table>
</div>
<button class="button" id="back">
    <a href="verificationAdmin">Back</a>
</button>