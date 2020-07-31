import React  from 'react';
import SliderShow from '../intermedio/sliderShow';


const Inicio = ()=>{



    return (
        <div className="w3-container">


          <div className="w3-panel w3-leftbar w3-light-grey">
            <p className="w3-xlarge w3-serif">
            <i>"Para llegar rápido vé solo.  Para llegar lejos, ve en grupo."</i></p>
            <p>proverbio oriental</p>
          </div>
               
          <SliderShow images={[
              {"imagen":"cero.jpg", "descripcion":"Cero"},
              {"imagen":"uno.jpg", "descripcion":"Uno"}, 
              {"imagen":"dos.jpg", "descripcion":"dos"},
              {"imagen":"tres.jpg", "descripcion":"Tres"},
              {"imagen":"cuatro.jpg", "descripcion":"Cuatro"},
              {"imagen":"seis.jpg", "descripcion":"Seis"}
            ]} />

        </div>
        
    );
}

export default Inicio;