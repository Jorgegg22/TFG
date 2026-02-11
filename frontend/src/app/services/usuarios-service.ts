import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../common/usuarios-interface';
import { InfoPerfil } from '../common/usuarioPerfil-interface';
import { Solicitud } from '../common/pisoDetalle-interface';

@Injectable({
  providedIn: 'root',
})
export class UsuarioService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/usuarios/";  // XAMPP
  //private URI: string = 'http://localhost:8080/api/usuarios/'; //DOCKER

  constructor(private http: HttpClient) {}

  getUsuarios(): Observable<Usuario> {
    return this.http.get<Usuario>(this.URI);
  }

  getUsuarioByToken(): Observable<Usuario> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };
    return this.http.get<Usuario>(`${this.URI}usuario`, httpOptions);
  }

  postDatosPerfi(userdata: any): Observable<any> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };
    return this.http.post(`${this.URI}guardarDatos`, userdata,httpOptions);
  }

  getSolicitudesUsuario(): Observable<any> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };

    return this.http.get<any>(`${this.URI}solicitudes`, httpOptions);
  }

  getPerfilUsuario(userId?: string): Observable<InfoPerfil> {
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

    if (!userId) {
      return this.http.get<InfoPerfil>(`${this.URI}perfil`, httpOptions);
    } else {
      return this.http.get<InfoPerfil>(`${this.URI}perfil/` + userId, httpOptions);
    }
  }
}
