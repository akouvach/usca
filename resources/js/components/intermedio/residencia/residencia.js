import React , {useState} from 'react';
import PropTypes from 'prop-types';
import Pais from '../pais';
import Estado from '../estado';
import Ciudad from '../ciudad';


const Residencia = ( 
        {
            PaisId="pais", 
            PaisTitulo="Pais",
            PaisValor="0", 
            PaisValorSet=()=>console.log("falta setear la función de regreso de pais") 
        } )=>{
    
    let [pais, paisSet]=useState(PaisValor);

    function actualizarPais(nuevoValor){
        paisSet(nuevoValor);
        PaisValorSet(nuevoValor);
    }

    return (
        <div>

            <Pais 
                Titulo = {PaisTitulo}
                Id={PaisId} 
                Valor={pais} 
                ValorSet={actualizarPais}
            />

            <Estado />
            <Ciudad /> 
        </div>
    );
}

Residencia.propTypes = {
    PaisId: PropTypes.any.isRequired,
    PaisTitulo: PropTypes.string,
    PaisValor: PropTypes.any,
    PaisValorSet: PropTypes.func
}

export default Residencia;