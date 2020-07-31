import React from 'react';
import PropTypes from 'prop-types';

import Label from '../../base/Label';

const Titulo2 = ({
                Texto="titulo 2",
                Clase="w3-teal w3-padding"
            })=>{
    return (
        <div className="w3-container">
            <h2>
                <Label Clase={Clase} Texto={Texto} />
            </h2>
        </div>
    );

}

Titulo2.propTypes = {
    Texto: PropTypes.string.isRequired,
    Clase: PropTypes.string
}

export default Titulo2 ;