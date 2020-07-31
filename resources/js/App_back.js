import React, { useState, Suspense } from 'react';
import Login from './components/login/login';
import { CTXUsuario, usuario }  from './components/context/usuario';

const Grupos = React.lazy( ()=>  import('./components/grupos/grupos')); 

const App = ()=> {
  const [show, showSet ] = useState(false);

  return (
    <div className="w3-container">
      <CTXUsuario.Provider value={usuario}>
        <header>
          <h1>Hola</h1>
        </header>
        
        <button onClick= { ()=> {
          showSet(false);
        } }>Ocultar</button>

        <button onClick= { ()=> {
          showSet(true);
        } }>Mostrar</button>


        { show && <Suspense fallback={ <p>...</p> }><Grupos usuarioId="Andres"/></Suspense> }

        <Login />

        <br />
        Hola:{ CTXUsuario.nombre }
        

      </CTXUsuario.Provider>
    </div>
  );
}

export default App;
