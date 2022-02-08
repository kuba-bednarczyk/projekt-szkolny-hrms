const pricingFormBox = document.querySelector('.pricing__form');

const pgYes = document.querySelector('#pg-yes');
const pgNo = document.querySelector('#pg-no');
const staticPageNum = document.querySelector('#staticPageNum');
const cmsYes = document.querySelector('#cms-yes');
const cmsNo = document.querySelector('#cms-no');
const timeExpress = document.querySelector('#express');
const timeUsual = document.querySelector('#usual');
const seoYes = document.querySelector('#seo-yes');
const seoNo = document.querySelector('#seo-no');
const calculateBtn = document.querySelector('#calculateBtn');

const price = document.querySelector('.price');
const resetBtn = document.querySelector('.resetBtn');

// default values
pgNo.checked = true;
cmsNo.checked = true;
staticPageNum.value = '';
timeUsual.checked = true;
seoNo.checked = true;
price.innerHTML = '00,00 zł';

let p = document.createElement("p");

function wrongInput(){
    staticPageNum.classList.remove('input-ok');
    staticPageNum.classList.add('input-wrong');

    pricingFormBox.append(p);
    p.classList.add('info-wrong-input');
    p.innerText = "Musisz wpisać poprawną liczbę podstron!";
    staticPageNum.value = '';
}

function okInput(){
    staticPageNum.classList.remove('input-wrong');
    staticPageNum.classList.add('input-ok');
    p.remove();
}

function resetValues(){
    pgNo.checked = true;
    cmsNo.checked = true;
    staticPageNum.value = '';
    timeUsual.checked = true;
    seoNo.checked = true;
    price.innerHTML = '00,00 zł';
}

function calculatePrice(){
   let priceCount = 0;

   if(staticPageNum.value === ''){
        wrongInput();   
        staticPageNum.value = '';
        price.innerText = '00,00 zł';
   } else {
        okInput();
        if(pgYes.checked){ priceCount+=500; }
        if(cmsYes.checked){ priceCount+=1200; } else { priceCount+=600; }
        if(seoYes.checked){ priceCount+=600; }
        priceCount += parseFloat(staticPageNum.value) * 50;
        if(timeExpress.checked){ priceCount = priceCount * 1.2; }

        price.innerText = `${priceCount} zł`;
        staticPageNum.value = '';
    }
}

calculateBtn.addEventListener('click', calculatePrice);
resetBtn.addEventListener('click', resetValues);