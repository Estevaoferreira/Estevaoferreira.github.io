document.addEventListener('DOMContentLoaded', function () {
    const reservationForm = document.getElementById('jantar-reservation-form');
    const quantidadeInput = document.getElementById('quantidade');
    const convidadosNomesContainer = document.getElementById('convidados-nomes-container');
    const nomePrincipalInput = document.getElementById('nome_principal');
    const telefoneInput = document.getElementById('telefone');
    const formMessage = document.getElementById('form-message');

    // Número de WhatsApp para onde as mensagens serão enviadas
    const WHATSAPP_NUMBER = '5511943356283'; // Formato DDI + DDD + Número

    // Função para gerar dinamicamente os campos de nome dos convidados adicionais
    function generateGuestNameInputs(quantidade) {
        convidadosNomesContainer.innerHTML = ''; // Limpa campos anteriores

        const numConvidadosAdicionais = quantidade - 1;

        if (numConvidadosAdicionais > 0) {
            const heading = document.createElement('p');
            heading.textContent = `Nome(s) do(s) Convidado(s) Adicional(is):`;
            heading.style.fontWeight = 'bold';
            heading.style.marginTop = '15px';
            heading.style.marginBottom = '10px';
            heading.style.textAlign = 'left';
            convidadosNomesContainer.appendChild(heading);

            for (let i = 1; i <= numConvidadosAdicionais; i++) {
                const formGroup = document.createElement('div');
                formGroup.classList.add('form-group');

                const label = document.createElement('label');
                label.setAttribute('for', `nome_convidado_${i}`);
                label.textContent = `Convidado ${i}:`;

                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('id', `nome_convidado_${i}`);
                input.setAttribute('name', `nome_convidado_${i}`);
                input.setAttribute('required', 'true'); // Torna os campos de convidados obrigatórios

                formGroup.appendChild(label);
                formGroup.appendChild(input);
                convidadosNomesContainer.appendChild(formGroup);
            }
        }
    }

    // Event listener para o input de quantidade
    quantidadeInput.addEventListener('input', function () {
        const quantidade = parseInt(quantidadeInput.value, 10);
        // Garante que a quantidade é um número positivo
        if (!isNaN(quantidade) && quantidade >= 1) {
            generateGuestNameInputs(quantidade);
        } else {
            // Se o valor for inválido (ex: 0 ou texto), limpa os campos adicionais
            convidadosNomesContainer.innerHTML = '';
        }
    });

    // Função para lidar com o envio do formulário
    function handleReservationSubmit(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        formMessage.textContent = ''; // Limpa mensagens anteriores
        formMessage.className = 'form-message'; // Reseta classes

        const nomePrincipal = nomePrincipalInput.value.trim();
        const quantidade = parseInt(quantidadeInput.value, 10);
        const confirmacao = document.getElementById('confirmacao').checked;
        const telefone = telefoneInput.value.trim(); // Telefone é opcional

        // Coleta os nomes dos convidados adicionais
        const nomesConvidadosAdicionais = [];
        const inputsConvidados = convidadosNomesContainer.querySelectorAll('input[type="text"]');
        let allGuestsNamesFilled = true; // Flag para verificar se todos os nomes foram preenchidos

        inputsConvidados.forEach(input => {
            const guestName = input.value.trim();
            if (guestName) {
                nomesConvidadosAdicionais.push(guestName);
            } else {
                allGuestsNamesFilled = false; // Marca como falso se algum campo estiver vazio
            }
        });

        // Validação
        if (!nomePrincipal || isNaN(quantidade) || quantidade < 1 || !confirmacao || !allGuestsNamesFilled) {
            formMessage.textContent = 'Por favor, preencha todos os campos obrigatórios corretamente.';
            formMessage.classList.add('error');
            return;
        }

        // Verifica se a quantidade de nomes de convidados adicionais corresponde ao esperado
        // (quantidade total - 1)
        if (nomesConvidadosAdicionais.length !== (quantidade - 1)) {
            console.error("Mismatch between quantity and number of guest name inputs.");
            formMessage.textContent = 'Erro interno na validação dos nomes. Tente recarregar.';
            formMessage.classList.add('error');
            return;
        }

        // Desabilitar o botão para evitar envios múltiplos
        const submitButton = reservationForm.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Gerando Link...';

        // Formatar a mensagem para o WhatsApp
        let message = `Confirmação de Presença para o Jantar:\n\n`;
        message += `Nome Principal: ${nomePrincipal}\n`;
        message += `Quantidade Total de Pessoas: ${quantidade}\n`;

        if (nomesConvidadosAdicionais.length > 0) {
            message += `Convidados Adicionais: ${nomesConvidadosAdicionais.join(', ')}\n`;
        }

        if (telefone) {
            message += `Telefone para Contato: ${telefone}\n`;
        }

        // Codificar a mensagem para URL
        const encodedMessage = encodeURIComponent(message);

        // Criar o link do WhatsApp
        const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodedMessage}`;

        // Abrir o link em uma nova aba
        window.open(whatsappUrl, '_blank');

        // Exibir mensagem de sucesso e limpar o formulário
        formMessage.textContent = 'Link do WhatsApp gerado! Por favor, envie a mensagem.';
        formMessage.classList.add('success');

        // Limpar o formulário após um pequeno atraso (opcional)
        setTimeout(() => {
            reservationForm.reset();
            convidadosNomesContainer.innerHTML = ''; // Limpa os campos de convidados gerados
            generateGuestNameInputs(parseInt(quantidadeInput.value, 10)); // Regenera para quantidade 1
            formMessage.textContent = ''; // Limpa a mensagem
            formMessage.className = 'form-message'; // Reseta classes
            submitButton.disabled = false;
            submitButton.textContent = 'Enviar Confirmação via WhatsApp';
        }, 3000); // Limpa após 3 segundos


        // Reabilitar o botão (imediatamente ou após o timeout)
        // Se limpar o formulário após o timeout, reabilite o botão dentro do timeout
        // submitButton.disabled = false;
        // submitButton.textContent = 'Enviar Confirmação via WhatsApp';
    }

    // Adicionar event listener para o envio do formulário
    reservationForm.addEventListener('submit', handleReservationSubmit);

    // Chamar a geração de campos inicialmente para a quantidade padrão (1)
    generateGuestNameInputs(parseInt(quantidadeInput.value, 10));
});
