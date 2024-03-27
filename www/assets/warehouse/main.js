function d(x,str = '')
{
    if (str === '')
    {
        console.log(x);
    }
    else
    {
        console.log(str,' = ',x);
    }
}

window.addEventListener('load', function(){
    // document.querySelector('select').addEventListener('click', function(){
    //   console.log(this);
    // });
    document.querySelector('select').addEventListener('change', function(e){
        // console.log('e = ',e);
        // console.log('e.target = ',e.target); 
        // console.log('e.target.options = ',e.target.options);
        // let language_change = e.target.options.selectedIndex;
        // console.log('language_change = ',language_change);
        
        let response = fetch('action/language', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({language: '1'})
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });

        
        
        // window.location = 'action/language?lang='+e.target.options.selectedIndex;
        window.location.reload();
    });
   

    document.getElementById('button-addon2').addEventListener('click',(e) => {
        // d(e.target,'была нажата');
        fetch('search', {
                method: 'POST',
                body: JSON.stringify({search: ''})
            })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('search').value = '';
                    document.querySelector('tbody').innerHTML = data;
                });
    });
});