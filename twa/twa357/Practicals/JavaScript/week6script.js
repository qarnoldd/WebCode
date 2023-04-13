function validateForm(theForm){
    var invalid;
    invalid = false;
    if(requiredFieldEmpty(theForm.firstName)) invalid = true;
    
    if(document.getElementById("expenseType").value == 'income')
    {
        if(requiredFieldEmpty(theForm.incdescription)) invalid = true;
    }
    if(document.getElementById("expenseType").value == 'expense')
    {
        if(requiredFieldEmpty(theForm.exdescription)) invalid = true;
    }
    if(outOfBounds(theForm.amount)) invalid = true;
    {
        document.getElementById("errorAmount").style.display = "inline-block";
    }
    if(requiredFieldEmpty(theForm.amount)) invalid = true;
    if(requiredFieldEmpty(theForm.date)) invalid = true;
    if(outOfBounds(theForm.amount)) invalid = true;

    if(invalid) {
        document.getElementById("form-error").style.display =  "inline-block";
        return false;
    }
    return true;
}

function outOfBounds(element){
    if(element.value < 0)
        return true;
}

function requiredFieldEmpty(element){
    if(!element.value.length){
        return true;
    }
}

function ifIncomeOrExpense()
{
    if(document.getElementById("expenseType").value = "income")
    {
        document.getElementByClass("income").style.display = "inline-block";
    }
    if(document.getElementById("expenseType").value = "expense")
    {
        document.getElementByClass("expense").style.display = "inline-block";
    }
}