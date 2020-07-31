import React from 'react';
import PropTypes from 'prop-types';
import Select from '../../base/Select';
import Label from '../../base/Label';

const Ciudad = ({
    Id="",
})=>{
    return (
        <div className="w3-container">
            <Label texto="Ciudad" HtmlFor={Id} />
            <Select Id={Id} />
        </div>
    );
}

Ciudad.propTypes = {
    Id : PropTypes.any.isRequired
}

export default Ciudad;