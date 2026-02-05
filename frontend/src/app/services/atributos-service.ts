import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Atributo } from '../common/atributos-interface';

@Injectable({
  providedIn: 'root'
})
export class AtributoService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/atributos"; // http://localhost/univibe/backend/public/index.php/api/atributos xampp - http://localhost:8080/public/api/atributos docker

  constructor(private http: HttpClient) {
   
  }

  getAtributos(): Observable<Atributo[]>{
    return this.http.get<Atributo[]>(this.URI);
  }
  

  sendAtributos(atributosData:any):Observable<any>{
    return this.http.post(`${this.URI}/send`,atributosData)
  }



}

