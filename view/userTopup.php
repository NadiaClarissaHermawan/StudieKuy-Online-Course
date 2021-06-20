<div id="topup-content">
    <div id="topup-content1">
        <h1 id="judulTopup" class="tulisanPutih hurufBesar">Top up Menu</h1>
    </div>
    <hr id="pembatasTopup">

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
    <img src="view/images/topup1.png" id="topup-image1">
</div> 

<script>
    const nominal = document.getElementById("topup-content2-isi");
    const button = document.getElementById("topup-content2-submit");
    let isiError = document.getElementById("userError");

    function checkValidation(){
        if(checkNominal()){
            return true;
        }else{
            event.preventDefault();
            isiError.textContent = "Nominal minimum adalah Rp.5000";
            return false;
        }
    }

    function checkNominal(){
        if(nominal.value < 5000){
            isiError.textContent = "Nominal minimum adalah Rp.5000";
            return false;
        }else{
            isiError.textContent = "";
            return true;
        }
    }
</script>