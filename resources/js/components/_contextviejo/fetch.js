const tokenName = "token";
const urlBase = "http://localhost:8000/api/";


const MyLogin= async ()=>{
    let url = urlBase + "login.php";

    let data = {
        email: "akouvach@yahoo.com",
        password : "akouvach"
    }

    let rta , json = "";
    
    // cambio AK
    let miInit = { 
                    method: 'POST',
                    headers: {
                        'Content-Type': 'text/plain'
                    },
                    mode: 'cors',
                    cache: 'no-cache' , 
                    crossDomain: true,
                    body : JSON.stringify(data)
                };

    try {
        rta = await fetch(url,miInit);
        json = await rta.json();
    } catch (err){
        return {"ok":false, "mensaje":err.message};
    }

    if(json.ok)
        sessionStorage.setItem(tokenName, JSON.stringify(json));    
    else    
        console.log("Login fetch: ", json);

    return rta;
    
}



const Fetch = async (myUrl, myFilter)=>{

    try {

        // console.log(myUrl, myFilter)

        let url = urlBase + myUrl;
        let token = JSON.parse(sessionStorage.getItem(tokenName));
        if(!token){
            try {
                console.log("no había token. la voy a buscar...", token);
                let rta=  await MyLogin();
                // console.log("me trajo esto: ", rta);
                if(rta.ok)
                    token = JSON.parse(sessionStorage.getItem(tokenName));
                else    
                    return {"ok":false, "payload":"el login falló"};
            } catch (err){
                throw Error("falló el login");
            }

        } 
        // console.log("jwt: ", token);       
        let data = {"payload":myFilter};
        
        //token.jwt +="pepe";

        // mode: 'cors',
        // cache: 'no-cache' , 

        let miInit = { 
                        method: 'POST',
                        headers: {
                            'Content-Type': 'text/plain',
                            'Authorization': 'Bearer ' + token.jwt
                        },
                        mode: 'cors',
                        cache: 'no-cache' , 
                        crossDomain: true,
                        body : JSON.stringify(data)
                    };

        let rta = await fetch(url,miInit);
        let miJson = await rta.json();
        // console.log(miJson);
        return miJson;

    } catch (err){

        return {"ok":false, "payload":"falló el fetch"}

    }
 
}

export default Fetch;