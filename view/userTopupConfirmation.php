<div id="topup-content">
    <div id="topup-content1">
        <h1 id="judulTopup" class="tulisanPutih hurufBesar">Transaction</h1>
    </div>
    <hr id="pembatasTopup">
    <div id="topup-content1">
        <h1 id="judulTopup" class="tulisanPutih hurufBesar" style="font-size: 2vw;">Top Up Confirmation</h1>
    </div>

    <form id="topup-content2" action="topupConfirmation" method="GET">
        <div id="topup-content2-kesamping">
            <button type="submit" name="nominal" value="10" class="tulisanCoklat topup-content2-pilihan">Rp 10.000</button>
            <button type="submit" name="nominal" value="20" class="tulisanCoklat topup-content2-pilihan">Rp 20.000</button>
            <button type="submit" name="nominal" value="50" class="tulisanCoklat topup-content2-pilihan">Rp 50.000</button>
            <button type="submit" name="nominal" value="100" class="tulisanCoklat topup-content2-pilihan">Rp 100.000</button>
            <button type="submit" name="nominal" value="200" class="tulisanCoklat topup-content2-pilihan">Rp 200.000</button>
        </div>

        <div id="topup-content2-kesamping">
            <p class="hurufBesar tulisanPutih" style="margin-top: 90px; margin-bottom: 6px; margin-right: 20px;">Rp</p>
            <input type="number" name="nominalText" id="topup-content2-isi" class="hurufSedang" placeholder="enter the nominal" oninput="checkNominal()"/>
            <button type="submit" id="topup-content2-submit" class="hurufSedang" onclick="checkValidation()">Submit</button>
        </div>
        
        <div id="userError" style="color: red; width:18%; display:flex"></div>
    </form>
</div> 
<div id="topup-bottom">
    <img src="view/images/topup1.png" id="topup-image1">
</div>
