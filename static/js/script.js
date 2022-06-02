
document.querySelector(".submit").addEventListener("click", function(e){
    
    var value_string = document.querySelector('input').value;
    var value_json = {
        "value": value_string
    };

    if (Boolean(value_string)){

        async function post_rest(){
            return fetch("/brackets/",{
                method: 'POST',
                headers: {'Content-Type': 'application/json;charset=utf-8'},
                body: JSON.stringify(value_json)
            })
        }

        post_rest() .then( result => result.json() )
                    .then( function (responce) {

                        console.log(document.querySelector('.result'));
                        document.querySelector('.result').insertAdjacentHTML("afterbegin", `

                            <tr class="table-${responce.validate ? "success" : "danger"}">
                            <td>${value_string}</td>
                            <td>${responce.validate ? "Успех" : "Провал"}</td>
                            </tr>

                        `);
                        document.querySelector('.warning').innerHTML = '';
                        document.querySelector('input').value = '';

                    })

    } else {
        document.querySelector('.warning').insertAdjacentHTML("afterbegin", `Нужно ввести значение`);
    }  
})


