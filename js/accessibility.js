document.addEventListener('DOMContentLoaded', function() { 

    // Elementos alterables del DOM.
    const domElements =
        "a:not(.not-resize),p:not(.not-resize),span:not(.not-resize),h1:not(.not-resize),h2:not(.not-resize),h3:not(.not-resize),h4:not(.not-resize),h5:not(.not-resize),h6:not(.not-resize)";


    // AGRANDAR //
    /** * Cambiar tamaño de texto */
    let sizeStep = 4;
    // Cantidad de pasos para alterar el texto - 4 es default.

    /** Aumentar tamaño */
    const upFontSize = (el, currentStep) => {
        let element = document.querySelectorAll(el);

        element.forEach((el) => {
            let style = getComputedStyle(el);
            let fontNum = parseFloat(style.fontSize.replace("px", ""));
            let newCss = parseFloat(fontNum + currentStep);

            el.style.fontSize = `${newCss}px`;
        });
    };

    // Función de incremento
    const increaseFontSize = () => {
        if (sizeStep < 7) {
            sizeStep++;
            upFontSize(domElements, 3);
        }
    };

    const increaseBtn = document.querySelector("#agrandar");
    increaseBtn.addEventListener("click", (e) => {
        e.preventDefault();
        increaseFontSize();
    });

    

    // DISMINUIR //
    /** Disminur tamaño */
    const downFontSize = (el, currentStep) => {
        let element = document.querySelectorAll(el);

        element.forEach((el) => {
            let style = getComputedStyle(el);
            let fontNum = parseFloat(style.fontSize.replace("px", ""));
            let newCss = parseFloat(fontNum - currentStep);

            el.style.fontSize = `${newCss}px`;
        });
    };

    // Función de decremento
    const decreaseFontSize = () => {
        if (sizeStep > 1) {
            sizeStep--;
            downFontSize(domElements, 3);
        }
    };

    const decreaseBtn = document.querySelector("#disminuir");
    decreaseBtn.addEventListener("click", (e) => {
        e.preventDefault();
        decreaseFontSize();
    });

    /** * FIN Cambiar tamaño de texto */



    // CONTRASTE //
    const contrastBtn = document.querySelector("#contraste");
    contrastBtn.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector("body").classList.toggle("marca-chile-card-high-contrast");
    });



    // GUÍA DE LECTURA //    
    /* Identificar posición del cursor */
    const cursorHL = document.querySelector(".highlight");
    document.addEventListener("mousemove", (e) => {
        cursorHL.setAttribute("style", `top: ${e.clientY}px;`);
    });

    const lineaBtn = document.querySelector("#lectura");
    lineaBtn.addEventListener("click", (e) => {
        e.preventDefault();
        document.querySelector(".marca-chile-guia-lectura").classList.toggle("activo");
        lineaBtn.classList.toggle("active-btn");
    });



    // AGRANDAR CURSOR //
    const cursorBtn = document.querySelector("#cursor");
    cursorBtn.addEventListener("click", (e) => {
        e.preventDefault();
        document.body.classList.toggle("marca-chile-cursor");
        cursorBtn.classList.toggle("active-btn");
    });



    // RESALTAR OBJETOS //
    /** * Destacar Elementos */
    const highlightObjects = (el) => {
        let element = document.querySelectorAll(el);
        element.forEach((el) => {
            el.classList.toggle("marca-chile-highlights");
        });
    };

    const resaltarBtn = document.querySelector("#resaltar");
    resaltarBtn.addEventListener("click", (e) => {
        e.preventDefault();
        highlightObjects(domElements);
        resaltarBtn.classList.toggle("active-btn");
    });

});

