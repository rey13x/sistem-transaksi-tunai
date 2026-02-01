<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk Aplikasi Premium</title>

<style>
*{margin:0;padding:0;box-sizing:border-box}
html,body{scroll-behavior:smooth}

body{
    font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Inter,sans-serif;
    overflow-x:hidden;
}

/* ================= HERO ================= */
.hero{
    position:fixed;
    inset:0;
    background:url('{{ asset("assets/hero.jpg") }}') center/cover no-repeat;
    z-index:5;
    transition:transform .9s ease;
}
.hero.hide{transform:translateY(-100%)}
.hero::after{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.25);
}

/* ================= FORM BG ================= */
.form-bg{
    margin-top:100vh;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:80px 6vw;
}
.form-wrapper{
    width:100%;
    max-width:1400px;
    background:url('{{ asset("assets/hijau.jpeg") }}') center/cover no-repeat;
    border-radius:60px;
    padding:80px 0;
    position:relative;
}
.form-wrapper::before{
    content:'';
    position:absolute;
    inset:0;
    backdrop-filter:blur(18px);
    background:rgba(0,0,0,.35);
}

/* ================= CARD ================= */
.card{
    position:relative;
    z-index:2;
    width:42%;
    max-width:995px;
    margin:0 auto;
    padding:40px;
    border-radius:60px;
    background:rgba(255,255,255,.22);
    backdrop-filter:blur(25px);
    border:1px solid rgba(255,255,255,.35);
    box-shadow:0 30px 80px rgba(0,0,0,.35);
}

/* ================= TEXT ================= */
.title{font-size:36px;font-weight:700;color:#fff}
.desc{font-size:18px;color:#eee;margin-bottom:28px}

/* ================= INPUT ================= */
input,select{
    width:100%;
    height:72px;
    padding:0 24px;
    margin-bottom:20px;
    border-radius:24px;
    border:none;
    font-size:18px;
}

/* ================= QTY ================= */
.qty{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:20px;
}
.qty button{
    width:48px;height:48px;
    border:none;
    border-radius:50%;
    background:#000;
    color:#fff;
    font-size:24px;
}
.qty span{
    font-size:22px;
    color:#fff;
    font-weight:600;
}

/* ================= TOTAL ================= */
.total{
    font-size:20px;
    color:#fff;
    margin-bottom:26px;
}

/* ================= SLIDER ================= */
.slider{
    height:76px;
    background:#000;
    border-radius:999px;
    position:relative;
    overflow:hidden;
}
.slider-text{
    position:absolute;
    right:32px;
    top:50%;
    transform:translateY(-50%);
    color:#fff;
    font-size:22px;
}
.slider-handle{
    position:absolute;
    left:6px;
    top:6px;
    width:64px;
    height:64px;
    background:#fff;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    cursor:pointer;
}

/* ================= POPUP ================= */
.popup{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.7);
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:99;
    opacity:0;
    pointer-events:none;
    transition:opacity .6s ease;
}
.popup.show{
    opacity:1;
    pointer-events:auto;
}
.popup-box{
    background:#000;
    color:#fff;
    padding:40px;
    border-radius:30px;
    text-align:center;
    width:80%;
    max-width:320px;
}
.loader{
    width:40px;height:40px;
    border:4px solid #333;
    border-top:4px solid #fff;
    border-radius:50%;
    margin:0 auto 20px;
    animation:spin 1s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}

/* ================= RESPONSIVE ================= */
@media (max-width:768px){
    .card{width:100%;padding:24px;border-radius:28px}
    input,select{height:56px;font-size:16px}
}
</style>
</head>

<body>

<!-- HERO -->
<div class="hero" id="hero"></div>

<!-- FORM -->
<section class="form-bg">
<div class="form-wrapper">
<div class="card">

<div class="title">Produk Aplikasi Premium</div>
<div class="desc">Langganan premium cepat & terpercaya</div>

<form id="orderForm">
@csrf
<input name="name" placeholder="Nama" required>
<input name="phone" placeholder="No HP" required>
<input name="address" placeholder="Alamat" required>

<select id="product">
<option value="10000">Capcut Premium – Rp 10.000</option>
<option value="5000">Viu Platinum – Rp 5.000</option>
<option value="5000">YouTube Premium – Rp 5.000</option>
</select>

<select id="duration">
<option value="1 Bulan">1 Bulan</option>
<option value="3 Bulan">3 Bulan</option>
</select>

<div class="qty">
<button type="button" id="minus">−</button>
<span id="qty">1</span>
<button type="button" id="plus">+</button>
</div>

<div class="total">Total: <b id="totalText">Rp 10.000</b></div>

<div class="slider" id="slider">
<div class="slider-text">Bayar Tunai!</div>
<div class="slider-handle" id="handle">››</div>
</div>

</form>

</div>
</div>
</section>

<!-- POPUP -->
<div class="popup" id="popup">
<div class="popup-box">
<div class="loader"></div>
<p>Mantap!<br>Segera bayar orderanmu ya</p>
</div>
</div>

<script>
/* ===== DATA ===== */
const hero = document.getElementById('hero');
const popup = document.getElementById('popup');
const slider = document.getElementById('slider');
const handle = document.getElementById('handle');
const product = document.getElementById('product');
const qtySpan = document.getElementById('qty');
const totalText = document.getElementById('totalText');
const form = document.getElementById('orderForm');

let qty = 1;

/* ===== HITUNG TOTAL ===== */
function updateTotal(){
    const price = parseInt(product.value);
    const total = price * qty;
    qtySpan.innerText = qty;
    totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
}
updateTotal();

document.getElementById('plus').onclick=()=>{qty++;updateTotal()}
document.getElementById('minus').onclick=()=>{if(qty>1)qty--;updateTotal()}
product.onchange=updateTotal;

/* ===== HERO SCROLL ===== */
let locked=true,scrollPower=0;
window.addEventListener('wheel',e=>{
    if(!locked) return;
    scrollPower+=e.deltaY;
    window.scrollTo({top:0});
    if(scrollPower>250){
        hero.classList.add('hide');
        locked=false;
        setTimeout(()=>window.scrollTo({top:innerHeight,behavior:'smooth'}),200);
    }
},{passive:false});
window.addEventListener('scroll',()=>{
    if(scrollY===0){
        hero.classList.remove('hide');
        locked=true;
        scrollPower=0;
    }
});

/* ===== SLIDER → POPUP → SAVE → FADE → SCROLL ===== */
let drag=false,start=0;
handle.onmousedown=e=>{drag=true;start=e.clientX};
document.onmousemove=e=>{
    if(!drag) return;
    let diff=e.clientX-start;
    let max=slider.offsetWidth-handle.offsetWidth-8;

    if(diff>max){
        drag=false;

        popup.classList.add('show');

        /* SIMPAN DATA (TANPA RELOAD) */
        fetch('/checkout',{
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                name: form.name.value,
                phone: form.phone.value,
                address: form.address.value,
                product: product.options[product.selectedIndex].text,
                duration: duration.value,
                qty: qty,
                total: parseInt(product.value) * qty
            })
        });

        /* DIEM 5 DETIK */
        setTimeout(()=>popup.classList.remove('show'),5000);

        /* BALIK KE HERO */
        setTimeout(()=>{
            window.scrollTo({top:0,behavior:'smooth'});
        },5600);
    }
    if(diff<0) diff=0;
    handle.style.left=diff+6+'px';
};
document.onmouseup=()=>{drag=false;handle.style.left='6px'};
</script>

</body>
</html>
