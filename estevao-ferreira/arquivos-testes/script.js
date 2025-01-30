/* function initScrollReveal() {
    function revealElements() {
        var elements = document.querySelectorAll('[data-animation]');
        var triggerBottom = window.innerHeight * 0.9;

        elements.forEach(function(element) {
            var elementTop = element.getBoundingClientRect().top;

            if (elementTop < triggerBottom) {
                var animationClass = element.dataset.animation || 'section-visible';
                element.classList.add(animationClass);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        revealElements(); // Call it once to reveal elements already in view on load
        window.addEventListener('scroll', revealElements);
    });
} */

// Initialize scroll reveal
/* initScrollReveal();
function initScrollReveal() {
    // Função interna para revelar elementos
    function revealElements() {
        // Seleciona todos os elementos que correspondem ao seletor fornecido
        var elements = document.querySelectorAll('[data-animation]');
        
        // Define a altura do gatilho para revelar elementos (90% da altura da janela)
        var triggerBottom = window.innerHeight * 0.9;

        // Itera sobre cada elemento selecionado
        elements.forEach(function(element) {
            // Obtém a posição superior do elemento em relação ao viewport
            var elementTop = element.getBoundingClientRect().top;

            // Verifica se o topo do elemento está acima do ponto de gatilho
            if (elementTop < triggerBottom) {
                // Obtém a classe de animação do atributo data-animation ou usa uma classe padrão
                var animationClass = element.dataset.animation || 'section-visible';
                // Adiciona a classe de animação ao elemento
                element.classList.add(animationClass);
            }
        });
    }

    // Executa revealElements quando o conteúdo do DOM for carregado
    document.addEventListener('DOMContentLoaded', function() {
        revealElements(); // Chama a função uma vez para revelar elementos já visíveis na carga
        // Adiciona um ouvinte de evento para revelar elementos ao rolar a página
        window.addEventListener('scroll', revealElements);
    });
}

// Chama a função initScrollReveal com o seletor '.hidden'
initScrollReveal(); */


document.addEventListener('DOMContentLoaded', function() {
    function revealElements() {
        var elements = document.querySelectorAll('.hidden');
        var triggerBottom = window.innerHeight * 0.9;

        elements.forEach(function(element) {
            var elementTop = element.getBoundingClientRect().top;

            if (elementTop < triggerBottom) {
                var animationClass = element.dataset.animation || 'fade-in';
                element.classList.add(animationClass);
                element.classList.remove('hidden');
            }
        });
    }

    // Revele os elementos já visíveis ao carregar a página
    revealElements();
    window.addEventListener('scroll', revealElements);
});
