<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        body
        {
            background-color: var(--tg-theme-bg-color);
            color: var(--tg-theme-text-color);
        }
        button
        {
            background-color: var(--tg-theme-button-color);
            color: var(--tg-theme-button-text-color);
            padding: 5px 15px;
        }
    </style>
  </head>
  <body>
      <div class='container'>
        <h1>this my one web-app main</h1>
        <button id='toggle-main-btn'>Main Button</button>
        <button id='close-app'>Close</button>
        <!--<p>-->
        <!--    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.-->
        <!--</p>-->
        <h3>Subscribe</h3>
        <form class='row g-3 needs-validation' novalidate>
            <div class='col-md-6'>
                <label for='name' class='form-label'>Name</label>
                <input type='text' class='form-control' id='name' required>
            </div>
            <div class='col-md-6'>
                <label for='email' class='form-label'>Email</label>
                <input type='email' class='form-control' id='email' required>
            </div>
        </form>
      </div>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const telegram = window.Telegram.WebApp;
        console.log(telegram);
        telegram.ready(
            
            );
        telegram.expand();
        
        // telegram.sendData(JSON.stringify('121212'));
        
        
        // document.querySelector('#toggle-main-btn').addEventListener('click',function(){
        //     console.log('press button = toggle-main-btn');
        //     if (telegram.MainButton.isVisible)
        //     {
        //         telegram.MainButton.hide();
        //     }
        //     else
        //     {
        //         telegram.MainButton.show();
        //         telegram.MainButton.setParams({
        //             text: 'Send Form',
        //             color: '#d260aa',
        //             text_color: '#fff'
        //         });
                
        //     }
        // });
        document.getElementById('close-app').addEventListener('click',function(){
            console.log('press button = close');
            telegram.close();
        });
        
        // telegram.MainButton.show();
        // telegram.MainButton.onClick(() => {
        //     telegram.showAlert('Hello');
        // });
        // telegram.onEvent('mainButtonClicked',() => {
        //     telegram.showAlert('Hello 2');
        // });
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        
        const data = {name: '', email: ''};
        
        
        
        telegram.onEvent('mainButtonClicked',() => {
            telegram.sendData(JSON.stringify(data));
        });
        
        nameInput.addEventListener('input',()=>{
            let val=nameInput.value.trim();
            if (val === '')
            {
                data.name = '';
                toggleClass(nameInput,'is-invalid','is-valid');
            }
            else
            {
                data.name = val;
                toggleClass(nameInput,'is-valid','is-invalid');
            }
            checkForm();
        });
        
        emailInput.addEventListener('input',()=>{
            let val=emailInput.value.trim();
            const re=/\w+@\w+\.\w{2,6}/;
            if (re.test(val))
            {
                data.email = val;
                toggleClass(emailInput,'is-valid','is-invalid');
            }
            else
            {
                data.email = '';
                toggleClass(emailInput,'is-invalid','is-valid');
            }
            checkForm();
        });
        
        function checkForm()
        {
            if (!data.name || !data.email)
            {
                telegram.MainButton.hide();
            }
            else
            {
                telegram.MainButton.setParams({
                    text: 'Send Form',
                    color: '#d260aa',
                    text_color: '#fff'
                });
                telegram.MainButton.show();
            }
        }
        
        function toggleClass(field, class_add, class_remove)
        {
            field.classList.add(class_add);
            field.classList.remove(class_remove);
        }
        
    </script>
  </body>
</html>








