window?.addEventListener('load', function() {

    document.querySelector('#loan_value')?.addEventListener('keyup', function (event){
        calculate();
    });

    document.querySelector('#fee')?.addEventListener('keyup', function (event){
        calculate();
    });

    document.querySelector('#interest')?.addEventListener('keyup', function (event){
        calculate();
    });

    document.querySelector('#monthly_interest')?.addEventListener('keyup', function (event){
        
    });

    document.querySelector('#total_interest')?.addEventListener('keyup', function (event){
        
    });

    document.querySelector('#total_to_pay')?.addEventListener('keyup', function (event){
        
    });

    document.querySelector('#monthly_fee')?.addEventListener('keyup', function (event){
        
    });

    function calculate(){
        const loan_value = parseFloat(document.querySelector('#loan_value').value);
        const fee = parseFloat(document.querySelector('#fee').value);
        const interest = parseFloat(document.querySelector('#interest').value);
        
        if (loan_value>0 && fee>0 && interest>0) {
            const mi = (loan_value*interest)/100;
            document.querySelector('#monthly_interest').value = mi.toFixed(2);
            const ti = mi*fee;
            document.querySelector('#total_interest').value = ti.toFixed(2);
            const tp = loan_value+ti;
            document.querySelector('#total_to_pay').value = tp.toFixed(2);
            const mf = tp/fee;
            document.querySelector('#monthly_fee').value = mf.toFixed(2);
            document.querySelector('#monthly_fee_text').textContent = (fee+' cuotas de');
        }
    }

});