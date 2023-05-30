function validate(theForm)
{
    var invalid;
    invalid = false;
    if(requiredFieldEmpty(document.getElementById("year")))
    {
        document.getElementById("yearError").style.display = "inline-block";
        document.getElementById("year").style.outline = "2px solid red";
        invalid = true;
    }
    else
    {
        document.getElementById("yearError").style.display = "none";
        document.getElementById("year").style.outline = "none";
    }
    if(fieldsetInvalid(document.getElementById("income1"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("income2"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("income3"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("income4"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("income5"))) invalid = true;

    if(fieldsetInvalid(document.getElementById("expense1"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("expense2"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("expense3"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("expense4"))) invalid = true;
    if(fieldsetInvalid(document.getElementById("expense5"))) invalid = true;

    if(invalid)
    {
        return false;
    }
    else
        return true;
}

function totalAll()
{
    var income = document.getElementsByClassName("income");
    var expense = document.getElementsByClassName("expense");
    var totalIncome = 0;
    var totalExpense = 0;
    var maxTotal = 0;

    for(let i = 0; i < income.length; i++)
    {
        if(income[i].value.length)
            totalIncome += parseInt(income[i].value);
    }

    for(let i = 0; i < expense.length; i++)
    {
        if(expense[i].value.length)
            totalExpense += parseInt(expense[i].value);
    }
    maxTotal = totalIncome - totalExpense;
    document.getElementById("totalIncome").textContent = totalIncome.toString();
    document.getElementById("totalExpense").textContent = totalExpense.toString();
    document.getElementById("totalAll").textContent = maxTotal.toString();

    document.querySelector('input[name="incomeInput"]').value = totalIncome;
    document.querySelector('input[name="expenseInput"]').value = totalExpense;
    document.querySelector('input[name="totalInput"]').value = maxTotal;

    if(maxTotal >= (totalIncome*0.25))
    {
        document.body.style.backgroundColor = 'green';
    }
    else if (maxTotal >= 0)
    {
        document.body.style.backgroundColor = 'orange';
    }
    else if (maxTotal < 0)
    {
        document.body.style.backgroundColor = 'red';
    }
}
 
function fieldsetInvalid(element) {
    var date, description, amount;
    date = false;
    description = false;
    amount = false;
    date = DateEmpty(element.querySelector('.date'))
    description = descriptionFieldEmpty(element.querySelector(".description"))
    amount = requiredFieldEmpty(element.querySelector(".amount"))


    if((date && description && amount) || (!date && !description && !amount))
    {
        element.querySelector(".error").style.display = "inline-block";
        element.querySelector(".error").style.display = "none";
        element.querySelector('.date').style.outline = 'none';
        element.querySelector('.amount').style.outline = 'none';
        element.querySelector('.description').style.outline = 'none'
        return false;
    }
    else
    {
        if(date)
        {
            element.querySelector('.date').style.outline = '2px solid red';
        }
        else
        {
            element.querySelector('.date').style.outline = 'none';
        }

        if(description)
        {
            element.querySelector('.description').style.outline = '2px solid red';
        }
        else
        {
            element.querySelector('.description').style.outline = 'none';
        }

        if(amount)
        {
            element.querySelector('.amount').style.outline = '2px solid red';
        }
        else
        {
            element.querySelector('.amount').style.outline = 'none';
        }
    
        element.querySelector(".error").style.display = "inline-block";
        return true;
    } 
}

function DateEmpty(element) {
    if(!element.value)
    {
        return true;
    }
}

function descriptionFieldEmpty(element) {
    if(element.value == "none")
    {
        return true;
    }
}

function requiredFieldEmpty(element) {
    if(!element.value.length) {
        return true;
    }
}