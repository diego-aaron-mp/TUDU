(function () {
    // Variables
    var minutes = document.querySelector('#minutes');
    var seconds = document.querySelector('#seconds');
    var blocks = document.querySelector('#totalBlocks');
    var iterBlockNumber = document.querySelector('#iterBlockNumber');

    // Botones
    const start = document.querySelector('#start');
    const pause = document.querySelector('#pause');
    const stop = document.querySelector('#stop');
    const typeOne = document.querySelector('#btnTypeOne'); // 25 min
    const typeTwo = document.querySelector('#btnTypeTwo'); // 50 min

    // Sonidos de alerta
    const focusSound = new Audio('assets/sounds/focus.mp3');
    const breakSound = new Audio('assets/sounds/break.mp3');

    // Para indiciar si el cronometro esta corriendo
    let running = false;
    // El intervalo del cronometro
    let interval;
    // Indicar si es trabajo
    let isWork = true;
    // Obtener el numero de bloque
    let blockNumber = parseInt(iterBlockNumber.innerHTML);

    // Para indicar si el cronometro esta pausado
    if (!running) {
        // Deshabilitar los botones de pausa y stop
        pause.disabled = true;
        stop.disabled = true;
    }


    // Elegir Temporizador
    // Tipo 25:5
    typeOne.addEventListener('click', () => {
        minutes.textContent = 25;
        seconds.textContent = 00;
        blocks.textContent = 4;
        // Dar y quitar clases de activo e inactivo
        typeOne.classList.add('active');
        typeTwo.classList.remove('active');
    });

    // Tipo 50:10
    typeTwo.addEventListener('click', () => {
        minutes.textContent = 50;
        seconds.textContent = 00;
        blocks.textContent = 2;
        // Dar y quitar clases de activo e inactivo
        typeTwo.classList.add('active');
        typeOne.classList.remove('active');
    });

    // Iniciar contador al dar click en start
    start.addEventListener('click', () => {
        if (!running) {
            startTimer();
               
            running = true;
            // Deshablilitar los botones de typeOne y typeTwo
            typeOne.disabled = true;
            typeTwo.disabled = true;

            // Habilitar los botones de pausa y stop
            pause.disabled = false;
            stop.disabled = false;

            // Deshabilitar el boton de start
            start.disabled = true;
        }
    });

    function startTimer() {
        // Reproducir focusSound
        focusSound.play();

        // Se obtienen los minutos y los segundos
        let minutesValue;
        let secondsValue;
        // Si es tipo 1
        if (typeOne.classList.contains('active')) {
            minutesValue = 0;
            secondsValue = 5;
        } else {
            // Si es tipo 2
            minutesValue = 50;
            secondsValue = 0;
        }

        // Se obtiene el total de segundos
        let totalSeconds = minutesValue * 60 + secondsValue;


        interval = setInterval(() => {
            totalSeconds--;

            if (totalSeconds === 0) {
                clearInterval(interval);
                startBreak();

            } else {
                let minutesLeft = Math.floor(totalSeconds / 60);
                let secondsLeft = totalSeconds % 60;

                minutes.value = minutesLeft;
                seconds.value = secondsLeft;

                minutes.innerHTML = minutesLeft;
                seconds.innerHTML = secondsLeft;

            }
        }, 1000);

    }

    // Funcion para iniciar un intervalo de descanso
    function startBreak() {
        // Reproducir breakSound
        breakSound.play();

        if(typeOne.classList.contains('active')){
            breakMinutes = 5;
            breakSeconds = 0;
        }else{
            breakMinutes = 10;
            breakSeconds = 0;
        }

        let breakTotalSeconds = breakMinutes * 60 + breakSeconds;
        
        interval = setInterval(() => {
            breakTotalSeconds--;
            
            if (breakTotalSeconds === 0) {
                // Aumentar en 1 el numero de bloque
                blockNumber++;
                iterBlockNumber.innerHTML = blockNumber;
                clearInterval(interval);

                // Verificar si es el ultimo bloque
                if (blockNumber !== parseInt(blocks.textContent)) {
                    // Iniciar el siguiente bloque
                    startTimer();
                } else {
                    // Reiniciar todo con stopTimer
                    stopTimer();
                }

            } else {
                let breakMinutesLeft = Math.floor(breakTotalSeconds / 60);
                let breakSecondsLeft = breakTotalSeconds % 60;
                
                minutes.value = breakMinutesLeft;
                seconds.value = breakSecondsLeft;

                minutes.innerHTML = breakMinutesLeft;
                seconds.innerHTML = breakSecondsLeft;
            }
        }, 1000);
    }

    // Parar contador al dar click en pause
    pause.addEventListener('click', () => {
        if (running) {
            
            clearInterval(interval);
            running = false;

            // Deshabilitar los botones de pausa
            pause.disabled = true;

            // Habilitar el boton de start
            start.disabled = false;
        }
    });


    // Para detener el cronometro al dar click en stop con la funcion stopTimer
    stop.addEventListener('click', () => {
        stopTimer();
    });
    

    // Funcion para detener el cronometro
    function stopTimer(){
        clearInterval(interval);
        running = false;

        // Habilitar los botones de typeOne y typeTwo
        typeOne.disabled = false;
        typeTwo.disabled = false;

        // Deshabilitar los botones de pausa y stop
        pause.disabled = true;
        stop.disabled = true;

        // Habilitar el boton de start
        start.disabled = false;

        // Reiniciar el numero de bloques completados
        blockNumber = 0;
        iterBlockNumber.innerHTML = blockNumber;

        // Reiniciar el cronometro
        minutes.textContent = 25;
        seconds.textContent = 00;

        // Reiniciar el tipo de temporizador
        typeOne.classList.add('active');
        typeTwo.classList.remove('active');
    }
})();

    





