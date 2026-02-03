import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../common/usuarios-interface';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/usuarios/";

  constructor(private http: HttpClient) {
   
  }

  getUsuarios(): Observable<Usuario>{
    return this.http.get<Usuario>(this.URI);
  }

  getUsuarioById(id:any): Observable<any>{
    return this.http.post(`${this.URI}usuario`,id)
  }
  



}

