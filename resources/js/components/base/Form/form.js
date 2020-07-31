import React from 'react';
import PropTypes from 'prop-types';

const Form = ({
                children,
                Id="falta el id del form", 
                OnSubmit=()=>console.log("falta definir el handler del formulario")
            })=>{
    return (
        <form 
            id={Id} 
            onSubmit={OnSubmit}
        >
            {children}
        </form>

    );
}

Form.propTypes = {
    Id : PropTypes.string.isRequired,
    OnSubmit: PropTypes.func.isRequired
}

export default Form;