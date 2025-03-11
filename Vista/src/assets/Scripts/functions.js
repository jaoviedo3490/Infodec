const temperature_switch_badge = (param) => {
    try {
        let rangos = {
            "temperatura": {
                "danger": [[-500, -10], [40, 10000]],
                "warning": [[-9, 0], [36, 39]],
                "info": [[1, 19]],
                "success": [[20, 35]]
            }
        };

        let subRango = rangos["temperatura"];

        for (const tipo in subRango) {
            let valores = subRango[tipo];
            for (const rango of valores) {
                if (param >= rango[0] && param <= rango[1]) {
                    return tipo;
                }
            }
        }
        return "default";
    } catch (error) {
        alert(`Excepcion encontrada ${error}`);
    }
};


window.temperature_switch_badge = temperature_switch_badge;
