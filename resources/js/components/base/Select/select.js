import React, {useState, useEffect} from 'react';
import PropTypes from 'prop-types';
import Loading from '../../intermedio/loading';
const Select = ( {
                    Id="falta Id",
                    Valor="",
                    Valores=[],
                    ValorSet=()=>console.log("falta definir el handler para el select")
                })=>{
    let [miValor, miValorSet] = useState(Valor);

    function actualizarValor(nuevoValor){
        miValorSet(nuevoValor);
        ValorSet(nuevoValor);
    }
    useEffect(() => {
        console.log("me ejecuté dentro de select.js");
        console.log(miValor);
        return () => {
          console.log("estoy saliendo");
        };
      });


    if(!Array.isArray(Valores)){
        return (
            <Loading />
        )
    } else {

        return (
            <select 
                id={Id} 
                className="w3-select" 
                value={miValor} 
                onChange={(ev)=>actualizarValor(ev.target.value)}
            >

            {Valores.map((item) =>{
                    return (
                        <option key={item.id} value={item.id}>
                            {item.descripcion}
                        </option>
                    )
            })}

            </select>
        );
    }
}

Select.propTypes = {
    Id: PropTypes.string.isRequired,
    Valor: PropTypes.string,
    Valores: PropTypes.array.isRequired,
    ValorSet : PropTypes.func
}

export default Select;