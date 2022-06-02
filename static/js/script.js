
document.querySelector(".submit").addEventListener("click", function(e){
    
    var value_string = document.querySelector('input').value
    var val = {
        "value": value_string
    };
    if (Boolean(value_string)){
        fetch("/rest/brackets/",{
            method: 'POST',
            headers: {
              'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(val)
          }).then( result => result.json() )
            .then( function (responce) {
                console.log(document.querySelector('.result'));
                document.querySelector('.result').insertAdjacentHTML("afterbegin", `
                    <tr class="table-${responce.validate ? "success" : "danger"}">
                    <td>${value_string}</td>
                    <td>${responce.validate ? "Прошел" : "Провалил"}</td>
                    </tr>
                `);
                document.querySelector('.warning').innerHTML = '';
                document.querySelector('input').value = '';
            })
    } else {
        document.querySelector('.warning').insertAdjacentHTML("afterbegin", `
                    Нужно ввести значение
                `);
    }  
})
document.querySelector(".history_list").addEventListener("click", function(e){
    var table = document.querySelector("table");
    table.classList.toggle('.display-none');
})