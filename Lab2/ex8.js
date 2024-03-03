(function(){
    let screen = document.querySelector('.screen')
    let buttons = document.querySelectorAll('.btn')
    let clear = document.querySelector('.clear')
    let equal = document.querySelector('.equal')

    buttons.forEach(function(button){
        button.addEventListener('click', function(e){
            if(screen.value != "Syntax Error" && screen.value != "NaN"){
                let value = e.target.dataset.num
                screen.value += value
            }
        })
    })

    equal.addEventListener('click', function(e){
        if(screen.value === ''){
            screen.value = ""
        }
        else{
            try{
                var ans = eval(screen.value)
                screen.value = ans
            }catch(ex){
                screen.value = "Syntax Error"
            }
        }
    })

    clear.addEventListener('click', function(e){
        screen.value = ""
    })
})();