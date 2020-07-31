import React, {useState, useEffect} from 'react';
import PropTypes from 'prop-types';
import Label from '../../base/Label';
import Select from '../../base/Select';

const Estado = ({
                    Titulo="Estado",
                    Id="estado",
                    Valor="",
                    ValorSet=()=>console.log("falta definir la función para actualizar estado")
            })=>{

    let [estado, estadoSet]=useState(Valor);
    let [estados, estadosSet]=useState();

    useEffect(() => {
        // Inicializo los valores para los paises
        estadosSet([
            {"id":1, "valor":"Buenos Aires", "idPais":"ar"},
            {"id":2, "valor":"Ciudad Autónoma de Buenos Aires", "idPais":"ar"},
            {"id":3, "valor":"Cordoba", "idPais":"ar"},
            {"id":4, "valor":"Montevideo", "idPais":"uy"},
            {"id":5, "valor":"Cordoba", "idPais":"ar"},
            {"id":6, "valor":"Cordoba", "idPais":"ar"},
            {"id":7, "valor":"Cordoba", "idPais":"ar"},
            {"id":8, "valor":"Cordoba", "idPais":"ar"},
            {"id":9, "valor":"Cordoba", "idPais":"ar"}
        ]);
        console.log(estados);

    },[estados]);

    function actualizarValor(nuevoValor){
        estadoSet(nuevoValor);
        ValorSet(nuevoValor);
    }

    return (
        <div className="w3-container">
            <Label 
                Texto={Titulo} 
                HtmlFor={Id}
            />
            <Select  
                Id={Id} 
                Valor={estado}
                ValorSet={actualizarValor}
                Valores={estados}
            />
        </div>

    );
}

Estado.propTypes = {
    Titulo: PropTypes.string,
    Id: PropTypes.string.isRequired,
    Valor: PropTypes.string,
    ValorSet: PropTypes.func

}

export default Estado;

