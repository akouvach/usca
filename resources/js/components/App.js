import React from "react";
import Menu from "./navigation/menu";
import { UsuarioProvider } from "../context/usuarioContext";

class App extends React.Component {
  render() {
    return (
      <div className="w3-container w3-padding-16">
        <UsuarioProvider>
          <div className="w3-row">
            <Menu />
          </div>

          <div className="w3-row">{this.props.children}</div>
        </UsuarioProvider>
      </div>
    );
  }
}

export default App;
