// Defina a data do casamento (Ano, Mês - 1, Dia, Hora, Minuto, Segundo)
// Novembro é o mês 10 no JavaScript (janeiro é 0)
const weddingDate = new Date("November 8, 2025 00:00:00").getTime(); // Ajuste o ano e o horário se necessário

// Atualiza o cronômetro a cada segundo
const countdownTimer = setInterval(function () {

    // Pega a data e hora atuais
    const now = new Date().getTime();

    // Calcula a distância entre agora e a data do casamento
    const distance = weddingDate - now;

    // Cálculos de tempo para dias, horas, minutos e segundos
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Exibe o resultado nos elementos com os IDs correspondentes
    if (document.getElementById("days")) { // Verifica se os elementos existem antes de atualizar
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = ("0" + hours).slice(-2); // Adiciona zero à esquerda se for menor que 10
        document.getElementById("minutes").innerHTML = ("0" + minutes).slice(-2);
        document.getElementById("seconds").innerHTML = ("0" + seconds).slice(-2);
    }


    // Se o cronômetro terminar, escreve um texto
    if (distance < 0) {
        clearInterval(countdownTimer);
        if (document.getElementById("countdown")) {
            document.getElementById("countdown").innerHTML = "<h2>Estamos Casados!</h2>"; // Mensagem após a data
            document.getElementById("countdown").style.color = "white"; // Cor da mensagem
            document.getElementById("countdown").style.textShadow = "2px 2px 4px rgba(0,0,0,0.5)";
        }
    }
}, 1000); // Atualiza a cada 1000ms (1 segundo)
