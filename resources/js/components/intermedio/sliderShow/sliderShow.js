import React, { useState } from 'react';


const Slider=( {images} )=>{

    let [index , indexSet ] = useState(0);
    let imagenes = useState(images)[0];


    const plusDivs= (n)=>{

        if(n===1 || n===-1){

            if(n>0)
                (index>=imagenes.length-1) ? indexSet(0): indexSet(index + n);
            else
                (index<=0) ? indexSet(imagenes.length-1): indexSet(index + n);
        
        } else {
            console.log("indice incorrecto en el sliderShow");
        }
        
    }


    return (

        <div className="w3-container">            

            <div className="w3-content w3-display-container">

                <div className="w3-display-container">
                    <img src={"./images/" + imagenes[index].imagen} style={{width:"100%"}} alt={imagenes[index].descripcion} />
                    <div className="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
                        {imagenes[index].descripcion}
                    </div>
                </div>
                <button className="w3-button w3-display-left w3-black" alt="Anterior" onClick={()=>plusDivs(-1)}>&#10094;</button>
                <button className="w3-button w3-display-right w3-black" onClick={()=>plusDivs(1)}>&#10095;</button>

            </div>


        </div>

    );
}
export default Slider;

