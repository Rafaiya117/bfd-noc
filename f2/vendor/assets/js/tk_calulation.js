$(document).ready(function(){
    let str_decoration =(amount)=>{
        return `${amount}/-`; 
    },
    options = {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
        style: "currency",
        currency: "BDT",
         numberingSystem: "latin"
      };
    ;

    $('.tk').each((id, e)=>{
        console.log(id, e);
        let amount = parseFloat($(e).text());
        amount = amount.toLocaleString('en-IN', options);
        $(e).html(str_decoration(amount));
    });
});