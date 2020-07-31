import React from 'react';
import PropTypes from 'prop-types';

import Label from '../../base/Label';

const Titulo3 = ({
                Texto="Titulo 3",
                Clase="w3-teal w3-padding"
            })=>{
    return (
        <div className="w3-container">
            <h3>
                <Label Clase={Clase} Texto={Texto} />
            </h3>
        </div>
    );

}

Titulo3.propTypes = {
    Texto: PropTypes.string.isRequired,
    Clase: PropTypes.string
}

export default Titulo3 ;