import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../common/usuarios-interface';

@Injectable({
  providedIn: 'root'
})
export class UsuarioC {
  private URI: string = "http://localhost:8080/public/index.php/api/usuarios";

  constructor(private http: HttpClient) {
   
  }

  getUsuarios(): Observable<Usuario>{
    return this.http.get<Usuario>(this.URI);
  }
  



}

