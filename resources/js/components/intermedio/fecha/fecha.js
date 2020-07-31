import React , {useState }from 'react';
import PropTypes from 'prop-types';
import Label from '../../base/Label';
import InputText from '../../base/inputText';

const Fecha = ({
                    Etiqueta="Fecha",
                    Id="fecha",
                    PlaceHolder="introduzca su fecha", 
                    Valor="", 
                    ValorSet=(valor)=>{
                        console.log("falta agregar la función para asignación fecha.");
                    }
                } )=>{

    let [fecha, fechaSet] = useState(Valor);

    function actualizarFecha(nuevoValor){
        fechaSet(nuevoValor);
        ValorSet(nuevoValor);
    }

    return (
        <div className="w3-container">
        <Label texto={Etiqueta} htmlFor={Id} />
        <InputText 
            Id={Id} 
            Tipo="date" 
            PlaceHolder={PlaceHolder} 
            Valor={fecha} 
            ValorSet={actualizarFecha}  
        />
    
    </div>

    );
}

Fecha.propTypes = {
    Label: PropTypes.string.isRequired,
    Id : PropTypes.any.isRequired,
    PlaceHolder : PropTypes.string,
    Valor : PropTypes.string.isRequired,
    ValorSet: PropTypes.func    
}

export default Fecha;