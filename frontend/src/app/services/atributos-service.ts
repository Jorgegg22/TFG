import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Atributo } from '../common/atributos-interface';

@Injectable({
  providedIn: 'root'
})
export class AtributoService {
  //private URI: string = "http://localhost/univibe/backend/public/index.php/api/atributos";  //XAMPP
  private URI: string = "http://localhost:8080/public/api/atributos"; //DOCKER
  constructor(private http: HttpClient) {
   
  }

  getAtributos(): Observable<Atributo[]>{
    return this.http.get<Atributo[]>(this.URI);
  }
  

  sendAtributos(atributosData:any):Observable<any>{
    //Cogemos la sesion
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };
    return this.http.post(`${this.URI}/send`,atributosData,httpOptions)
  }


  



}

