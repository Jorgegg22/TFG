import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Atributo } from '../common/atributos-interface';

@Injectable({
  providedIn: 'root'
})
export class AtributoService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/atributos";

  constructor(private http: HttpClient) {
   
  }

  getAtributos(): Observable<Atributo[]>{
    return this.http.get<Atributo[]>(this.URI);
  }
  

  sendAtributos(atributosData:any):Observable<any>{
    return this.http.post<any>(`${this.URI}/send`,atributosData)
  }



}

